<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\BOForm;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Gallery;
use App\Models\FormUpload;
use App\Models\NewsPortal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function welcome()
    {
        Session::forget('status_session');
        $data['news'] = NewsPortal::latest()->limit(3)->get();

        return view('welcome')->with($data);
    }
    public function about()
    {
        $about = About::first();

        return view('global.about', compact('about'));
    }

    public function contact()
    {
        return view('global.contact');
    }

    public function contactStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'name'    => ['required', 'string'],
                'email'   => ['required', 'email'],
                'subject' => ['required', 'string'],
                'message' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $contactObj = new Contact();

            $contactObj->name    = Str::title($request->input('name'));
            $contactObj->email   = $request->input('email');
            $contactObj->subject = Str::title($request->input('subject'));
            $contactObj->message = $request->input('message');

            $res = $contactObj->save();

            DB::commit();
            if($res){
                return response()->json(['success' => true]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return;
        }
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
        return view('global.boinfo');
    }

    public function newBo()
    {
        $countries = Country::all();

        return view('global.newbo', compact('countries'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $boFormObj = new BOForm();

            $client_name     = $request->input('client_name');
            $clientSlug      = Str::slug($request->input('client_name'), '-');
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
                $boFormObj->user_photo = $user_photo;
            }

            if ($request->hasFile('user_signature')) {
                $image = $request->file('user_signature');
                $user_signature = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('user_signature'), $user_signature);
                $boFormObj->user_signature = $user_signature;
            }

            if ($request->hasFile('cheque_leaf')) {
                $image = $request->file('cheque_leaf');
                $cheque_leaf = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('cheque_leaf'), $cheque_leaf);
                $boFormObj->cheque_leaf = $cheque_leaf;
            }

            if ($request->hasFile('n_nid_attachment')) {
                $image = $request->file('n_nid_attachment');
                $n_nid_attachment = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('n_nid_attachment'), $n_nid_attachment);
                $boFormObj->n_nid_attachment = $n_nid_attachment;
            }

            if ($request->hasFile('n_photo')) {
                $image = $request->file('n_photo');
                $n_photo = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('n_photo'), $n_photo);
                $boFormObj->n_photo = $n_photo;
            }

            if ($request->hasFile('n_signature')) {
                $image = $request->file('n_signature');
                $n_signature = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('n_signature'), $n_signature);
                $boFormObj->n_signature = $n_signature;
            }

            if ($request->hasFile('j_nid_attachment')) {
                $image = $request->file('j_nid_attachment');
                $j_nid_attachment = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('j_nid_attachment'), $j_nid_attachment);
                $boFormObj->j_nid_attachment = $j_nid_attachment;
            }

            if ($request->hasFile('j_signature')) {
                $image = $request->file('j_signature');
                $j_signature = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('j_signature'), $j_signature);
                $boFormObj->j_signature = $j_signature;
            }

            if ($request->hasFile('j_photo')) {
                $image = $request->file('j_photo');
                $j_photo = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('j_photo'), $j_photo);
                $boFormObj->j_photo = $j_photo;
            }

            $boFormObj->client_name     = Str::title($request->input('client_name'));
            $boFormObj->father_name     = Str::title($request->input('father_name'));
            $boFormObj->mother_name     = Str::title($request->input('mother_name'));
            $boFormObj->gender          = $request->input('gender');
            $boFormObj->dob             = $request->input('dob');
            $boFormObj->occupation      = $request->input('occupation');
            $boFormObj->address         = $request->input('address');
            $boFormObj->city            = $request->input('city');
            $boFormObj->postal_code     = $request->input('postal_code');
            $boFormObj->division        = $request->input('division');
            $boFormObj->country         = $request->input('country');
            $boFormObj->mobile          = $request->input('mobile');
            $boFormObj->email           = $request->input('email');
            $boFormObj->nid_no          = $request->input('nid_no');
            $boFormObj->bank_name       = Str::title($request->input('bank_name'));
            $boFormObj->branch_name     = Str::title($request->input('branch_name'));
            $boFormObj->bank_account_no = $request->input('bank_account_no');
            $boFormObj->routing_number  = $request->input('routing_number');
            $boFormObj->nominee_name    = Str::title($request->input('nominee_name'));
            $boFormObj->n_relationship  = $request->input('n_relationship');
            $boFormObj->percentage      = $request->input('percentage');
            $boFormObj->n_mobile        = $request->input('n_mobile');
            $boFormObj->n_nid           = $request->input('n_nid');
            $boFormObj->j_name          = $request->input('j_name');
            $boFormObj->j_mobile        = $request->input('j_mobile');
            $boFormObj->j_gender        = $request->input('j_gender');
            $boFormObj->j_nid           = $request->input('j_nid');

            $res = $boFormObj->save();

            DB::commit();
            if($res){
                return back()->with('message', 'Your form was submitted successfully');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function allNews()
    {
        $data['recentPosts'] = NewsPortal::latest()->limit(3)->get();
        $data['allPosts'] = NewsPortal::paginate(3);
        $data['allTags'] = NewsPortal::all();

        $tags = array();
        foreach($data['allTags'] as $post){
            $tags = array_merge($tags, explode(',', $post->tags));
        }

        $data['uniqueTags'] = array_unique($tags);

        return view('user.news.index')->with($data);
    }

    public function newsRead($id)
    {
        $news        = NewsPortal::findOrFail($id);
        $tags        = explode(',', $news->tags);
        $recentPosts = NewsPortal::whereNot('id', $id)->latest()->limit(3)->get();

        return view('user.news.read', compact('news', 'tags', 'recentPosts'));
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
