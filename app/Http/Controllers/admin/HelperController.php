<?php

namespace App\Http\Controllers\admin;

use App\Models\Fund;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HelperController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function updateReqStatus($id)
    {
        $withdraw = Fund::findOrFail($id);

        if($withdraw){
            $withdraw->md = auth()->user()->name;
            $withdraw->mdstatus = 'decline';

            $withdraw->save();

            return response()->json(['success' => true]);
        }
    }

    public function acceptReqStatus($id)
    {
        $withdraw = Fund::findOrFail($id);

        if($withdraw){
            $withdraw->md = auth()->user()->name;
            $withdraw->mdstatus = 'approved';

            $withdraw->save();

            return response()->json(['success' => true]);
        }
    }
}
