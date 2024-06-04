<?php

namespace App\Http\Controllers\admin;

use App\Models\About;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function create()
    {
        $data['pageTitle'] = 'Create About';
        $data['about']     = About::first();

        return view('admin.about.create')->with($data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $about = About::first();

            if($about){
                $filenames = [];

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $filename = time() . '_' . $image->getClientOriginalName();

                        $image->storeAs('public/about_images', $filename);

                        $filenames[] = $filename;
                    }
                }

                $filenamesString = implode(',', $filenames);

                $about->title        = Str::title($request->input('title'));
                $about->block_quote  = $request->input('block_quote');
                $about->description  = $request->input('description');
                $about->about_images = $filenamesString;
                $about->updated_by   = auth()->user()->name;

                $res = $about->save();
                DB::commit();
                if($res){
                    return back()->with('message', 'About added successfully.');
                }
            }else{
                $filenames = [];

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $filename = time() . '_' . $image->getClientOriginalName();

                        $image->storeAs('public/about_images', $filename);

                        $filenames[] = $filename;
                    }
                }

                $filenamesString = implode(',', $filenames);

                $aboutObj = new About();

                $aboutObj->title        = Str::title($request->input('title'));
                $aboutObj->block_quote  = $request->input('block_quote');
                $aboutObj->description  = $request->input('description');
                $aboutObj->about_images = $filenamesString;
                $aboutObj->created_by   = auth()->user()->name;

                $res = $aboutObj->save();
                DB::commit();
                if($res){
                    return back()->with('message', 'About created successfully.');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return;
        }
    }
}
