<?php

namespace App\Http\Controllers\admin;

use App\Models\FormUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\BOForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {
        $data['pageTitle'] = 'Form List';
        $data['forms']     = FormUpload::all();

        return view('admin.form.index')->with($data);
    }

    public function create()
    {
        $pageTitle = 'Create Form';

        return view('admin.form.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

             $validator = Validator::make($request->all(), [
                'form_file'        => 'required|file|mimes:pdf|max:2048',
                'form_name'        => 'required|string|max:100',
                'form_title'       => 'required|string|max:100',
                'form_description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($request->hasFile('form_file')) {
                $path = $request->file('form_file')->store('pdfs');

                $formObj                   = new FormUpload();
                $formObj->form_name        = $request->input('form_name');
                $formObj->form_title       = $request->input('form_title');
                $formObj->form_description = $request->input('form_description');
                $formObj->form_file        = $path;
                $formObj->created_by       = auth()->user()->name;

                $res = $formObj->save();

                DB::commit();
                if($res){
                    return redirect()->back()->with('message', 'Form uploaded successfully!');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return;
        }
    }

    public function download($id)
    {
        $form = FormUpload::findOrFail($id);
        return Storage::download($form->form_file);
    }

    public function showTest($id)
    {
        $client = BOForm::findOrFail($id);

        return view('admin.bo.test', compact('client'));
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $form = FormUpload::find($id);

            if (!$form) {
                return response()->json(['message' => 'Form not found.'], 404);
            }

            $res = $form->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Form deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}
