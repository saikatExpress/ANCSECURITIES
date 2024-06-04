<?php

namespace App\Http\Controllers\admin;

use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {
        $pageTitle = 'Gallery List';
        $galleries = Gallery::all();

        return view('admin.gallery.index', compact('pageTitle', 'galleries'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'gallery_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $gallaryObj = new Gallery();

            if($request->hasFile('gallery_image')){
                $image = $request->file('gallery_image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('gallery_images'), $imageName);
                $gallaryObj->gallery_images = $imageName;
            }

            $gallaryObj->title = Str::title($request->input('title'));
            $gallaryObj->description = $request->input('description');
            $gallaryObj->created_by = auth()->user()->name;

            $res = $gallaryObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Gallery added successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return;
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $gallery = Gallery::find($id);

            if (!$gallery) {
                return response()->json(['message' => 'Gallery not found.'], 404);
            }

            $res = $gallery->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Gallery deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}
