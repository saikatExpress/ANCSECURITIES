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

        $pdfs = Portfolio::all();

        $filePath = '';

        $matchedPDFs = $pdfs->filter(function ($pdf) use ($clientInfo) {
            return strpos($pdf->name, $clientInfo->trading_code) !== false;
        });

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
