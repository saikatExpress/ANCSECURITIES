<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Fund;
use App\Models\User;
use App\Models\RequestFile;
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

    public function store($clientId,$name,$amount,$bankAccount,$date, $category)
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
            $fundObj->created_by    = auth()->user()->id;

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

    public function updateWithdrawStatus($id, $status)
    {
        $withdrawRequest = Fund::where('id', $id)->first();
        if($withdrawRequest->ceostatus === 'approved' || $withdrawRequest->mdstatus === 'approved'){
            return 'approved';
        }

        if(auth()->user()->role === 'Business Head'){
            $res = $this->handleBusinessHeadRequest($id, $status);
            if($res === true){
                return true;
            }
            return false;
        }

        if(auth()->user()->role === 'audit'){
            $res = $this->handleAuditRequest($id, $status);
            if($res === true){
                return true;
            }
            return false;
        }
    }

    private function handleBusinessHeadRequest($id, $status)
    {
        if($status === 'accept'){
            $res = $this->acceptRequestStatus($id);
            if($res === true){
                return true;
            }
            return false;
        }

        if($status === 'deny'){
            $res = $this->denyRequestStatus($id);
            if($res === true){
                return true;
            }
            return false;
        }
    }

    private function handleAuditRequest($id, $status)
    {
        if($status === 'accept'){
            $res = $this->acceptAuditRequestStatus($id);
            if($res === true){
                return true;
            }
            return false;
        }

        if($status === 'deny'){
            $res = $this->denyAuditRequestStatus($id);
            if($res === true){
                return true;
            }
            return false;
        }
    }

    private function acceptAuditRequestStatus($id)
    {
        $ceo = User::where('role', 'ceo')->where('status', 'active')->first();
        $withdrawRequest = Fund::where('id', $id)->first();

        $withdrawRequest->approved_by = auth()->user()->id;
        $withdrawRequest->declined_by = null;
        $withdrawRequest->ceo         = $ceo->name;
        $withdrawRequest->ceostatus   = 'assign';
        $withdrawRequest->remark      = 'handover to the ceo..thank you.' . ' - ' . auth()->user()->name . ' at ' . formatDateTime(Carbon::now());
        $withdrawRequest->flag        = 1;

        $res = $withdrawRequest->save();
        if($res){
            return true;
        }
        return false;
    }

    private function acceptRequestStatus($id)
    {
        $withdrawRequest = Fund::where('id', $id)->first();

        $withdrawRequest->approved_by = auth()->user()->id;
        $withdrawRequest->declined_by = null;
        $withdrawRequest->ceo         = null;
        $withdrawRequest->ceostatus   = null;
        $withdrawRequest->remark      = 'successfully reviewed..thank you.' . ' - ' . auth()->user()->name . ' at ' . formatDateTime(Carbon::now());
        $withdrawRequest->flag        = 1;

        $res = $withdrawRequest->save();
        if($res){
            return true;
        }
        return false;
    }

    private function denyAuditRequestStatus($id)
    {
        $withdrawRequest = Fund::where('id', $id)->first();

        $withdrawRequest->declined_by = auth()->user()->id;
        $withdrawRequest->approved_by = null;
        $withdrawRequest->ceo         = null;
        $withdrawRequest->ceostatus   = null;
        $withdrawRequest->remark      = 'declined this request..thank you.' . ' - ' . auth()->user()->name . ' at ' . formatDateTime(Carbon::now());
        $withdrawRequest->flag        = 0;

        $res = $withdrawRequest->save();
        if($res){
            $requestFile = RequestFile::where('request_id', $id)->first();
            if($requestFile){
                $requestFile->delete();
            }
            return true;
        }
        return false;
    }

    private function denyRequestStatus($id)
    {
        $withdrawRequest = Fund::where('id', $id)->first();

        $withdrawRequest->declined_by = auth()->user()->id;
        $withdrawRequest->approved_by = null;
        $withdrawRequest->ceo         = null;
        $withdrawRequest->ceostatus   = null;
        $withdrawRequest->remark      = 'declined this request..thank you.' . ' - ' . auth()->user()->name . ' at ' . formatDateTime(Carbon::now());
        $withdrawRequest->flag        = 0;

        $res = $withdrawRequest->save();
        if($res){
            $requestFile = RequestFile::where('request_id', $id)->first();
            if($requestFile){
                $requestFile->delete();
            }
            return true;
        }
        return false;
    }
}