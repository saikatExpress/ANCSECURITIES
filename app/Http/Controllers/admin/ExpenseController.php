<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Staff;
use App\Models\Account;
use App\Models\Expense;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index(Request $request)
    {
        $query = Expense::query();

        if ($request->filled('from_date')) {
            $query->whereDate('expense_date', '>=', $request->input('from_date'));
        }
        if ($request->filled('to_date')) {
            $query->whereDate('expense_date', '<=', $request->input('to_date'));
        }
        if ($request->filled('employee_id') && $request->input('employee_id') != 'All') {
            $query->where('staff_id', $request->input('employee_id'));
        }
        if($request->filled('category') && $request->input('category') != 'All'){
            $query->where('expense_category', $request->input('category'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $data['pageTitle'] = 'Expense List';
        $data['expenses'] = $query->orderBy('id', 'desc')->get();
        $data['employees'] = Staff::all();

        if ($request->ajax()) {
            return view('admin.account.expense.partials.index', $data)->render();
        }

        return view('admin.account.expense.index')->with($data);
    }

    public function todaysExpense(Request $request)
    {
        if(auth()->user()->role !== 'admin'){
            return back()->with('errors', 'You are not permitted for this page..!');
        }
        $data['pageTitle'] = 'Today Expense List';
        $data['employees'] = Staff::all();

        $query = Expense::query()->whereDate('expense_date', Carbon::today());

        if ($request->filled('employee_id') && $request->input('employee_id') != 'All') {
            $query->where('staff_id', $request->input('employee_id'));
        }
        if($request->filled('category') && $request->input('category') != 'All'){
            $query->where('expense_category', $request->input('category'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $data['expenses'] = $query->orderBy('id', 'desc')->get();

        return view('admin.account.expense.todayexpense')->with($data);
    }

    public function create()
    {
        $data['pageTitle'] = 'Create Expense';

        return view('admin.account.expense.create')->with($data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'expense_head' => 'required',
                'expense_date' => 'required',
                'amount'       => 'required',
                'category'     => 'required',
                'description'  => 'nullable',
                'receipt'      => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
            ]);

            $expenseObj = new Expense();

            $expenseObj->staff_id         = Auth::id();
            $expenseObj->expense_date     = $request->input('expense_date');
            $expenseObj->expense_head     = Str::title($request->input('expense_head'));
            $expenseObj->amount           = $request->input('amount');
            $expenseObj->expense_category = $request->input('category');
            $expenseObj->description      = $request->input('description', NULL);
            $expenseObj->status           = 'pending';

            if ($request->hasFile('receipt')) {
                $receiptPath = $request->file('receipt')->store('expenseVoucher', 'public');
                $expenseObj->receipt_image = $receiptPath;
            }

            $res = $expenseObj->save();
            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Expense added successfully.');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            Log::error('Expense creation failed: '.$e->getMessage());

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'expense_head' => 'required|string|max:255',
                'expense_date' => 'required|date',
                'amount' => 'required|numeric|min:0',
                'category' => 'required|string|max:255',
                'description' => 'required|string',
                'receipt' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $expense = Expense::findOrFail($request->input('expense_id'));

            if ($request->hasFile('receipt')) {
                // Delete the old receipt image if it exists
                if ($expense->receipt_image) {
                    Storage::delete($expense->receipt_image);
                }

                // Store the new receipt image
                $path = $request->file('receipt')->store('expenseVoucher', 'public');
                $expense->receipt_image = $path;
            }

            $expense->staff_id         = Auth::id();
            $expense->expense_date     = $request->input('expense_date');
            $expense->expense_head     = Str::title($request->input('expense_head'));
            $expense->amount           = $request->input('amount');
            $expense->expense_category = $request->input('category');
            $expense->description      = $request->input('description', NULL);
            $expense->status           = 'pending';
            $expense->updated_at       = Carbon::now();

            $res = $expense->save();
            DB::commit();
            if($res){
                return redirect()->route('expense.list')->with('message', 'Expense added successfully.');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            Log::error('Expense creation failed: '.$e->getMessage());

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data['pageTitle'] = 'Edit Expense';
        $data['expense'] = Expense::with('staff:id,name')->where('id', $id)->first();
        // return $data['expense'];
        return view('admin.account.expense.edit')->with($data);
    }

    public function assignExpenseAdmin($id)
    {
        $expense = Expense::find($id);

        if($expense){
            $expense->assign_to_ceo = 1;
            $expense->assign_to_hr = 1;

            $res = $expense->save();
            if($res){
                return response()->json(['success' => true]);
            }
        }
    }

    public function updateExpenseStatus(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'id'     => 'required|exists:expenses,id',
            'status' => 'required|string|in:pending,cancel,accepted',
        ]);

        $role = User::where('id', Auth::id())->pluck('role')->first();
        try {
            $status = $request->input('status');
            DB::commit();
            if($status === 'accepted'){
                $expense = Expense::findOrFail($request->input('id'));
                if($role === 'account'){
                    $accountBalance = Account::first();
                    $newBalance = $accountBalance->balance - $expense->amount;
                    $accountBalance->initial_balance = $newBalance;
                    $res = $accountBalance->save();
                    if($res){
                        $expense->status = $status;
                        $expense->save();
                        return response()->json(['success' => true], 200);
                    }

                }
                if($role === 'ceo'){
                    $expense->assign_to_ceo = 2;
                }
                if($role === 'hr'){
                    $expense->assign_to_hr = 2;
                }
                $res = $expense->save();

                if($res){
                    return response()->json(['success' => true], 200);
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Expense status update failed: '.$e->getMessage());

            return response()->json(['success' => false], 500);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $expense = Expense::find($id);

            if (!$expense) {
                return response()->json(['message' => 'Expense not found.'], 404);
            }

            $res = $expense->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Expense deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}
