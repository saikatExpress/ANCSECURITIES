<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\BOForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {
        $data['totalUsers'] = User::where('role', 'user')->count();
        $data['latestUsers'] = User::where('role', 'user')->latest()->take(8)->get();

        return view('admin.home.index')->with($data);
    }

    public function create()
    {
        $pageTitle = 'Create Director';

        return view('admin.director.create', compact('pageTitle'));
    }

    public function boIndex()
    {
        $pageTitle = 'BO Form List';
        $boForms = BOForm::latest()->get();

        return view('admin.bo.index', compact('pageTitle', 'boForms'));
    }
}
