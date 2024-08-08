<?php

namespace App\Http\Controllers\admin;

use App\Models\Staff;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\BoAccount;
use App\Models\BoAssign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {
        $data['pageTitle'] = 'Portfolio List';
        $data['portfolios'] = Portfolio::all();

        return view('admin.portfolio.index')->with($data);
    }

    public function portfolioIndex()
    {
        $data['pageTitle'] = 'Assign Portfolio List';
        $data['assignPortfolios'] = BoAssign::all();

        $data['allPortfolios'] = Portfolio::all();

        return view('admin.portfolio.assignindex')->with($data);
    }

    public function create()
    {
        $data['pageTitle'] = 'Upload Portfolio';

        return view('admin.portfolio.create')->with($data);
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'employee_id' => 'required|exists:staff,id',
            'selected_items' => 'required|array',
            'selected_items.*' => 'exists:portfolios,id',
        ]);

        $employeeId = $request->input('employee_id');
        $selectedItems = $request->input('selected_items');

        foreach($selectedItems as $item){
            $existingAssignment = BoAssign::where('staff_id', $employeeId)
                                      ->where('bo_id', $item)
                                      ->first();

            if (!$existingAssignment) {
                $boAssignObj = new BoAssign();
                $boAssignObj->staff_id = $employeeId;
                $boAssignObj->bo_id = $item;
                $boAssignObj->save();
            }
        }

        return redirect()->back()->with('message', 'Portfolio assigned successfully.');
    }

    public function uploadPDFs(Request $request)
    {
        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                // Store the file in the public directory
                $originalName = $file->getClientOriginalName();
                $path = $file->storeAs('public/pdfs', $originalName);

                // Save the file path to the database
                Portfolio::create([
                    'name' => $originalName,
                    'file_path' => Storage::url($path),
                ]);
            }
        }

        return response()->json(['message' => 'Files uploaded successfully!'], 200);

    }

    public function assignPortfolio()
    {
        $data['pageTitle'] = 'Assign Portfolio';
        $data['employees'] = Staff::where('status', '1')->get();
        $data['bos']       = BoAccount::all();

        return view('admin.portfolio.assign')->with($data);
    }

    public function searchClient(Request $request)
    {
        $searchCode = $request->input('search_code');
        preg_match('/\d+$/', $searchCode, $matches);
        $numericCode = $matches[0] ?? '';

        if (empty($numericCode)) {
            return response()->json(['message' => 'No numeric code found in search input'], 400);
        }

        $portfolio = Portfolio::where('name', 'like', '%' . $numericCode . '%')->first();

        return response()->json(['pdf_url' => $portfolio->file_path]);
    }

    public function destroy()
    {
        $allFiles = Portfolio::all();

        // Delete each file from the storage
        foreach ($allFiles as $file) {
            Storage::delete($file->file_path);
        }

        // Truncate the portfolios table
        DB::table('portfolios')->truncate();

        return redirect()->back()->with('message', 'Previous Portfolio deleted');
    }
}
