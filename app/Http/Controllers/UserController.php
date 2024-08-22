<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data['pageTitle'] = 'Admin List';
        $data['admins']    = User::whereNot('role','user')->get();
        $data['roles']     = Role::all();

        return view('admin.user.admin')->with($data);
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|max:255',
                'mobile'   => 'required|string|max:255',
                'whatsapp' => 'required|string|max:255',
                'status'   => 'required',
                'role'     => 'required',
            ]);

            $userId = $request->input('userId');

            $userInfo = User::find($userId);

            if($userInfo){
                $file = $userInfo->profile_image;
                if($file){
                    Storage::disk('public')->delete('user_photo/profile/' . $file);

                    File::delete(public_path('user_photo/profile/' . $file));
                }
                if ($request->hasFile('profile_image')) {
                    $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('profile_image')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $request->file('profile_image')->storeAs('public/user_photo/profile', $fileNameToStore);
                }

                if ($request->hasFile('signature')) {
                    $file = $userInfo->signature;
                    if($file){
                        Storage::disk('public')->delete('user_photo/signature/' . $file);

                        File::delete(public_path('user_photo/signature/' . $file));
                    }
                    $filenameWithExt = $request->file('signature')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('signature')->getClientOriginalExtension();
                    $signature = $filename.'_'.time().'.'.$extension;
                    $request->file('signature')->storeAs('public/user_photo/signature', $signature);
                }

                $userInfo->profile_image = $fileNameToStore;
                $userInfo->signature     = $signature;
                $userInfo->name          = $validatedData['name'];
                $userInfo->email         = $validatedData['email'];
                $userInfo->mobile        = $validatedData['mobile'];
                $userInfo->whatsapp      = $validatedData['whatsapp'];
                $userInfo->status        = $validatedData['status'];
                $userInfo->role          = $validatedData['role'];

                $res = $userInfo->save();

                DB::commit();
                if($res){
                    return redirect()->back()->with('message', 'User update successfully');
                }
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return false;
        }
    }

    public function userDashboard()
    {
        Session::forget('withdraw');
        $clientInfo = User::find(Auth::id());

        $pdfs = Portfolio::all();

        $filePath = '';

        $matchedPDFs = $pdfs->filter(function ($pdf) use ($clientInfo) {
            return strpos($pdf->name, $clientInfo->trading_code) !== false;
        });

        foreach ($matchedPDFs as $pdf) {
            $filePath = $pdf->file_path;
        }

        return view('authuser.index', compact('filePath'));
    }

    function extractDigits($string) {
        preg_match_all('/\d+/', $string, $matches);
        return implode('', $matches[0]);
    }
}
