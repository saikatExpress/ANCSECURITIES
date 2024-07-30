<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $data['pageTitle'] = 'Update Project Setting';

        return view('admin.setting.create')->with($data);
    }
}
