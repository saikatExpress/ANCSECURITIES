<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userDashboard()
    {
        $clientInfo = User::find(Auth::id());

        // Retrieve all PDFs from the Portfolio model
        $pdfs = Portfolio::all();

        $filePath = '';

        // Filter PDFs based on trading_code matching with the logged-in user's trading_code
        $matchedPDFs = $pdfs->filter(function ($pdf) use ($clientInfo) {
            // Check if the name of the PDF contains the trading_code of the logged-in user
            return strpos($pdf->name, $clientInfo->trading_code) !== false;
        });

        // Output the matched PDFs
        foreach ($matchedPDFs as $pdf) {
            $filePath = $pdf->file_path;
        }

        return view('authuser.index', compact('filePath'));
    }

    function extractDigits($string) {
        preg_match_all('/\d+/', $string, $matches);
        return implode('', $matches[0]);
    }
}
