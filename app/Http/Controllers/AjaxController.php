<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cancelFundRequest(Request $request)
    {
        $fundId = $request->query('fundId');
        $clientId = $request->query('clientId');

        $fundInfo = Fund::where('id', $fundId)->where('client_id', $clientId)->first();

        if($fundInfo){
            $fundInfo->delete();
            return response()->json(['success' => true, 'message' => 'Fund withdraw request Cancel']);
        }
        return response()->json(['error' => false, 'message' => 'Fund not found']);
    }
}
