<?php

namespace App\Http\Controllers\admin;

use App\Models\Staff;
use App\Models\BoAssign;
use App\Models\BoAccount;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
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
        try {
            if ($request->hasFile('pdfs')) {
                foreach ($request->file('pdfs') as $file) {
                    // Store the file in the 'storage/app/public/pdfs' directory
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
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to upload files.'], 500);
        }

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
        try {
            $allFiles = Portfolio::all();

            $filePaths = [];

            foreach ($allFiles as $file) {
                $filePaths[] = str_replace('/storage/', '', $file->file_path);
            }

            if (!empty($filePaths)) {
                Storage::disk('public')->delete($filePaths);
            }

            Portfolio::truncate();

            return redirect()->back()->with('message', 'All portfolio files and records deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete portfolio files and records. Error: ' . $e->getMessage());
        }
    }
}
