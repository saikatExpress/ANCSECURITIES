<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {
        $data['pageTitle'] = 'Expense List';
        $data['expenses'] = Expense::all();
        // return $data['expences'];
        return view('admin.account.expense.index')->with($data);
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
                'expense_date' => 'required',
                'amount'       => 'required',
                'category'     => 'required',
                'description'  => 'nullable',
                'receipt'      => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
            ]);

            $expenseObj = new Expense();

            $expenseObj->staff_id         = Auth::id();
            $expenseObj->expense_date     = $request->input('expense_date');
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
