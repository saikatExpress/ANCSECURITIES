<?php

namespace App\Http\Controllers\admin;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function create()
    {
        $data['pageTitle'] = 'Upload Portfolio';

        return view('admin.portfolio.create')->with($data);
    }

    public function uploadPDFs(Request $request)
    {
        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                // Store the file in the public directory
                $originalName = $file->getClientOriginalName();
                $path = $file->storeAs('public/pdfs', $originalName); // Note the 'public/' prefix

                // Save the file path to the database
                Portfolio::create([
                    'name' => $originalName,
                    'file_path' => Storage::url($path), // Store the URL, not the path
                ]);
            }
        }

        return response()->json(['message' => 'Files uploaded successfully!'], 200);

    }

    public function getPortfolio(Request $request)
    {

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
