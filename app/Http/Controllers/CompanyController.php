<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function about()
    {
        return view('global.about');
    }

    public function contact()
    {
        return view('global.contact');
    }

    public function faq()
    {
        return view('global.faq');
    }

    public function boardDirector()
    {
        return view('global.boraddirector');
    }

    public function onlineBo()
    {
        return view('global.bo');
    }

    public function gallery()
    {
        return view('global.gallery');
    }
}
