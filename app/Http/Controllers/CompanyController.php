<?php

namespace App\Http\Controllers;

use App\Models\FormUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function formDownload($id)
    {
        $form = FormUpload::findOrFail($id);
        return Storage::download($form->form_file);
    }
}
