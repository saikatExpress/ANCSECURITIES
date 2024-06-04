<?php

namespace App\Http\Controllers;

use App\Models\BOForm;
use App\Models\FormUpload;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $boFormObj = new BOForm();

            $client_name     = $request->input('client_name');
            $father_name     = $request->input('father_name');
            $mother_name     = $request->input('mother_name');
            $gender          = $request->input('gender');
            $dob             = $request->input('dob');
            $occupation      = $request->input('occupation');
            $address         = $request->input('address');
            $city            = $request->input('city');
            $postal_code     = $request->input('postal_code');
            $division        = $request->input('division');
            $country         = $request->input('country');
            $mobile          = $request->input('mobile');
            $nid_no          = $request->input('nid_no');
            $bank_name       = $request->input('bank_name');
            $branch_name     = $request->input('branch_name');
            $bank_account_no = $request->input('bank_account_no');
            $routing_number  = $request->input('routing_number');
            $nominee_name    = $request->input('nominee_name');
            $n_relationship  = $request->input('n_relationship');
            $percentage      = $request->input('percentage');
            $n_mobile        = $request->input('n_mobile');
            $n_nid           = $request->input('n_nid');
            $j_name          = $request->input('j_name');
            $j_mobile        = $request->input('j_mobile');
            $j_gender        = $request->input('j_gender');
            $j_nid           = $request->input('j_nid');

            if ($request->hasFile('nid_attachment')) {
                $image = $request->file('nid_attachment');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('nid_attachment'), $imageName);
                $boFormObj->nid_attachment = $imageName;
            }

            if ($request->hasFile('user_photo')) {
                $image = $request->file('user_photo');
                $user_photo = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('user_photo'), $user_photo);
                $boFormObj->nid_attachment = $user_photo;
            }

            if ($request->hasFile('user_signature')) {
                $image = $request->file('user_signature');
                $user_signature = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('user_signature'), $user_signature);
                $boFormObj->nid_attachment = $user_signature;
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function gallery()
    {
        $galleries = Gallery::where('status', '1')->get();

        return view('global.gallery', compact('galleries'));
    }

    public function formDownload($id)
    {
        $form = FormUpload::findOrFail($id);
        return Storage::download($form->form_file);
    }
}
