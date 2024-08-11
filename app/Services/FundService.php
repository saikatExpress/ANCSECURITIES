<?php

namespace App\Services;

use App\Models\Fund;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FundService
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function store($clientId,$code,$name,$mobile,$amount,$bankAccount,$date, $category)
    {
        try {
            DB::beginTransaction();
            $fundObj = new Fund();

            $fundObj->client_id     = $clientId;
            $fundObj->client_name   = $name;
            $fundObj->amount        = $amount;
            $fundObj->ac_no         = $bankAccount;
            $fundObj->description   = NULL;
            $fundObj->category      = $category;
            $fundObj->withdraw_date = $date;

            $res = $fundObj->save();

            DB::commit();
            if($res){
                return true;
            }else{
                return false;
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function depostore($clientId,$code,$name,$mobile,$amount,$bankAccount,$date,$category, $path)
    {
        try {
            DB::beginTransaction();
            $fundObj = new Fund();

            $fundObj->client_id     = $clientId;
            $fundObj->client_name   = $name;
            $fundObj->amount        = $amount;
            $fundObj->ac_no         = $bankAccount;
            $fundObj->bank_slip     = $path;
            $fundObj->description   = NULL;
            $fundObj->category      = $category;
            $fundObj->withdraw_date = $date;

            $res = $fundObj->save();

            DB::commit();
            if($res){
                return true;
            }else{
                return false;
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}
