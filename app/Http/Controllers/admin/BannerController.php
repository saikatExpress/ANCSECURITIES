<?php

namespace App\Http\Controllers\admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {
        $data['pageTitle'] = 'Banner List';
        $data['banners'] = Banner::all();

        return view('admin.banner.index')->with($data);
    }

    public function create()
    {
        $pageTitle = 'Create Banner';

        return view('admin.banner.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image rules as needed
                'banner_title' => 'required|string|max:100',
                'short_title' => 'required|string|max:100',
                'short_description' => 'required|string|max:100',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $bannerObj = new Banner();

            if ($request->hasFile('banner_image')) {
                $image = $request->file('banner_image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('banner_images'), $imageName);
                $bannerObj->banner_image = $imageName;
            }

            $bannerObj->banner_title      = $request->input('banner_title');
            $bannerObj->short_title       = $request->input('short_title');
            $bannerObj->short_description = $request->input('short_description');
            $bannerObj->created_by        = auth()->user()->name;

            $res = $bannerObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Banner created successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $banner = Banner::find($id);

            if (!$banner) {
                return response()->json(['message' => 'Banner not found.'], 404);
            }

            $res = $banner->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Banner deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}
