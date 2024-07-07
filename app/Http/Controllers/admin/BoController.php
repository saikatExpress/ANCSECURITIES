<?php

namespace App\Http\Controllers\admin;

use App\Models\BOForm;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BoController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function showForm($id)
    {
        $client = BOForm::findOrFail($id);
        // return $client;
        return view('admin.bo.show', compact('client'));
        $pdf = PDF::loadView('admin.bo.show', compact('client'));
        return $pdf->download('client_information.pdf');
    }
}
