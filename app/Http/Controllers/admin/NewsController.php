<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\NewsPortal;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {
        $data['pageTitle'] = 'News List';
        $data['news'] = NewsPortal::latest()->get();

        return view('admin.news.index')->with($data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'news_title'  => 'required',
                'quotes'      => 'required',
                'description' => 'required',
                'news_image'  => 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
                'tags'        => 'nullable|string',
            ]);

            if ($request->hasFile('news_image')) {
                $imagePath = $request->file('news_image')->store('news_image', 'public');
            }

            $newsPortalObj              = new NewsPortal();
            $newsPortalObj->news_title  = $request->input('news_title');
            $newsPortalObj->quotes      = $request->input('quotes');
            $newsPortalObj->description = $request->input('description');
            $newsPortalObj->news_image  = $imagePath;
            $newsPortalObj->tags        = $request->input('tags');
            $newsPortalObj->created_by  = auth()->user()->name;

            $res = $newsPortalObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'News added successfully.');
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

            $news = NewsPortal::find($id);

            if (!$news) {
                return response()->json(['message' => 'News not found.'], 404);
            }

            $res = $news->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'News deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}
