<?php

namespace App\Http\Controllers\admin;

use App\Models\BOForm;
use App\Imports\BoImport;
use App\Models\BoAccount;
use App\Models\BoNominee;
use App\Models\BoDocument;
use App\Models\CustomerBo;
use App\Models\BoAuthorize;
use App\Models\BoNomineeTwo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BoController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function create()
    {
        $data['pageTitle'] = 'BO List';
        $data['bos'] = BoAccount::latest()->get();

        return view('admin.bo.create')->with($data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'firstname'     => 'required|max:100',
                'lastname'      => 'required|max:30',
                'occupation'    => 'required',
                'date_of_birth' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray()
                ]);
            }

            $clientId = $request->input('user_id');

            $existClient = BOForm::find($clientId);

            if($existClient){
                $existClient->bo_type              = $request->input('bo_type');
                $existClient->type_of_client       = $request->input('type_of_client');
                $existClient->courtesy_title       = $request->input('courtesy_title');
                $existClient->firstname            = $request->input('firstname');
                $existClient->lastname             = $request->input('lastname');
                $existClient->occupation           = $request->input('occupation');
                $existClient->father_name          = $request->input('father_name');
                $existClient->mother_name          = $request->input('mother_name');
                $existClient->dob                  = $request->input('date_of_birth');
                $existClient->address_line_1       = $request->input('address_line_1', NULL);
                $existClient->address_line_2       = $request->input('address_line_2', NULL);
                $existClient->address_line_3       = $request->input('address_line_3', NULL);
                $existClient->city                 = $request->input('city');
                $existClient->postal_code          = $request->input('post_code');
                $existClient->division             = $request->input('division');
                $existClient->country              = $request->input('country');
                $existClient->mobile               = $request->input('mobile');
                $existClient->email                = $request->input('email');
                $existClient->telephone            = $request->input('telephone');
                $existClient->fax                  = $request->input('fax');
                $existClient->nationality          = $request->input('nationality');
                $existClient->nid_no               = $request->input('nid');
                $existClient->tin                  = $request->input('tin');
                $existClient->broker_branch        = $request->input('branch');
                $existClient->residency            = $request->input('residency');
                $existClient->gender               = $request->input('gender');
                $existClient->director_company     = $request->input('director_company');
                $existClient->joint_courtesy_title = $request->input('joint_courtesy_title');
                $existClient->joint_firstname      = $request->input('joint_firstname');
                $existClient->joint_lastname       = $request->input('joint_lastname');
                $existClient->joint_occupation     = $request->input('joint_occupation');
                $existClient->joint_date_of_birth  = $request->input('joint_date_of_birth');
                $existClient->joint_father_name    = $request->input('joint_father_name');
                $existClient->joint_mother_name    = $request->input('joint_mother_name');
                $existClient->joint_nid            = $request->input('joint_nid');
                $existClient->joint_address_line_1 = $request->input('joint_address_line_1');
                $existClient->joint_address_line_2 = $request->input('joint_address_line_2');
                $existClient->joint_address_line_3 = $request->input('joint_address_line_3');
                $existClient->joint_city           = $request->input('joint_city');
                $existClient->joint_post_code      = $request->input('joint_post_code');
                $existClient->joint_division       = $request->input('joint_division');
                $existClient->joint_country        = $request->input('joint_country');
                $existClient->joint_email          = $request->input('joint_email');
                $existClient->joint_mobile         = $request->input('joint_mobile');
                $existClient->joint_telephone      = $request->input('joint_telephone');
                $existClient->joint_fax            = $request->input('joint_fax');

                DB::commit();
                $existClient->save();
                return response()->json([
                    'success' => true,
                    'id' => $clientId
                ]);
            }

            $boFormObj = new BOForm();

            $boFormObj->bo_type              = $request->input('bo_type');
            $boFormObj->type_of_client       = $request->input('type_of_client');
            $boFormObj->courtesy_title       = $request->input('courtesy_title');
            $boFormObj->firstname            = $request->input('firstname');
            $boFormObj->lastname             = $request->input('lastname');
            $boFormObj->occupation           = $request->input('occupation');
            $boFormObj->father_name          = $request->input('father_name');
            $boFormObj->mother_name          = $request->input('mother_name');
            $boFormObj->dob                  = $request->input('date_of_birth');
            $boFormObj->address_line_2       = $request->input('address_line_2', NULL);
            $boFormObj->address_line_3       = $request->input('address_line_3', NULL);
            $boFormObj->city                 = $request->input('city');
            $boFormObj->postal_code          = $request->input('post_code');
            $boFormObj->division             = $request->input('division');
            $boFormObj->country              = $request->input('country');
            $boFormObj->mobile               = $request->input('mobile');
            $boFormObj->email                = $request->input('email');
            $boFormObj->telephone            = $request->input('telephone');
            $boFormObj->fax                  = $request->input('fax');
            $boFormObj->nationality          = $request->input('nationality');
            $boFormObj->nid_no               = $request->input('nid');
            $boFormObj->tin                  = $request->input('tin');
            $boFormObj->broker_branch        = $request->input('branch');
            $boFormObj->residency            = $request->input('residency');
            $boFormObj->gender               = $request->input('gender');
            $boFormObj->director_company     = $request->input('director_company');
            $boFormObj->joint_courtesy_title = $request->input('joint_courtesy_title');
            $boFormObj->joint_firstname      = $request->input('joint_firstname');
            $boFormObj->joint_lastname       = $request->input('joint_lastname');
            $boFormObj->joint_occupation     = $request->input('joint_occupation');
            $boFormObj->joint_date_of_birth  = $request->input('joint_date_of_birth');
            $boFormObj->joint_father_name    = $request->input('joint_father_name');
            $boFormObj->joint_mother_name    = $request->input('joint_mother_name');
            $boFormObj->joint_nid            = $request->input('joint_nid');
            $boFormObj->joint_address_line_1 = $request->input('joint_address_line_1');
            $boFormObj->joint_address_line_2 = $request->input('joint_address_line_2');
            $boFormObj->joint_address_line_3 = $request->input('joint_address_line_3');
            $boFormObj->joint_city           = $request->input('joint_city');
            $boFormObj->joint_post_code      = $request->input('joint_post_code');
            $boFormObj->joint_division       = $request->input('joint_division');
            $boFormObj->joint_country        = $request->input('joint_country');
            $boFormObj->joint_email          = $request->input('joint_email');
            $boFormObj->joint_mobile         = $request->input('joint_mobile');
            $boFormObj->joint_telephone      = $request->input('joint_telephone');
            $boFormObj->joint_fax            = $request->input('joint_fax');

            $boFormObj->save();
            DB::commit();

            return response()->json([
                'success' => true,
                'id' => $boFormObj->id
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again.']);
        }
    }

    public function bankStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'bank_id'             => 'required|integer',
                'branch_id'           => 'required|integer',
                'bank_account_number' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray()
                ]);
            }

            $lastBoId = $request->input('bo_last_id');

            $existBoBankInfo = CustomerBo::where('bo_id', $lastBoId)->first();

            if($existBoBankInfo){
                $existBoBankInfo->bo_id               = $lastBoId;
                $existBoBankInfo->bank_id             = $request->input('bank_id');
                $existBoBankInfo->branch_id           = $request->input('branch_id');
                $existBoBankInfo->bank_district_name  = $request->input('bank_district_name');
                $existBoBankInfo->bank_account_number = $request->input('bank_account_number');

                $res = $existBoBankInfo->save();

                DB::commit();
                if($res){
                    return response()->json([
                        'success' => true,
                        'id'      => $lastBoId
                    ]);
                }
            }

            $customerBoObj = new CustomerBo();

            $customerBoObj->bo_id               = $lastBoId;
            $customerBoObj->bank_id             = $request->input('bank_id');
            $customerBoObj->branch_id           = $request->input('branch_id');
            $customerBoObj->bank_district_name  = $request->input('bank_district_name');
            $customerBoObj->bank_account_number = $request->input('bank_account_number');

            $res = $customerBoObj->save();

            DB::commit();
            if($res){
                return response()->json([
                    'success' => true,
                    'id'      => $customerBoObj->bo_id
                ]);
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again.']);
        }
    }

    public function authorizeStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $userId = $request->input('user_id');

            $exitsauthorizeInfo = BoAuthorize::where('bo_id', $userId)->first();

            if($exitsauthorizeInfo){
                $exitsauthorizeInfo->bo_id               = $userId;
                $exitsauthorizeInfo->auth_courtesy_title = $request->input('auth_courtesy_title');
                $exitsauthorizeInfo->auth_firstname      = $request->input('auth_firstname');
                $exitsauthorizeInfo->auth_lastname       = $request->input('auth_lastname');
                $exitsauthorizeInfo->auth_occupation     = $request->input('auth_occupation');
                $exitsauthorizeInfo->auth_date_of_birth  = $request->input('auth_date_of_birth');
                $exitsauthorizeInfo->auth_nid            = $request->input('auth_nid');
                $exitsauthorizeInfo->auth_father_name    = $request->input('auth_father_name');
                $exitsauthorizeInfo->auth_mother_name    = $request->input('auth_mother_name');
                $exitsauthorizeInfo->auth_address_line_1 = $request->input('auth_address_line_1');
                $exitsauthorizeInfo->auth_address_line_2 = $request->input('auth_address_line_2');
                $exitsauthorizeInfo->auth_address_line_3 = $request->input('auth_address_line_3');
                $exitsauthorizeInfo->auth_city           = $request->input('auth_city');
                $exitsauthorizeInfo->auth_post_code      = $request->input('auth_post_code');
                $exitsauthorizeInfo->auth_division       = $request->input('auth_division');
                $exitsauthorizeInfo->auth_country        = $request->input('auth_country');
                $exitsauthorizeInfo->auth_email          = $request->input('auth_email');
                $exitsauthorizeInfo->auth_mobile         = $request->input('auth_mobile');
                $exitsauthorizeInfo->auth_telephone      = $request->input('auth_telephone');
                $exitsauthorizeInfo->auth_fax            = $request->input('auth_fax');

                $res = $exitsauthorizeInfo->save();

                DB::commit();
                if($res){
                    return response()->json([
                        'success' => true,
                        'id'      => $userId
                    ]);
                }
            }

            $boAuthorizeObj = new BoAuthorize();

            $boAuthorizeObj->bo_id               = $userId;
            $boAuthorizeObj->auth_courtesy_title = $request->input('auth_courtesy_title');
            $boAuthorizeObj->auth_firstname      = $request->input('auth_firstname');
            $boAuthorizeObj->auth_lastname       = $request->input('auth_lastname');
            $boAuthorizeObj->auth_occupation     = $request->input('auth_occupation');
            $boAuthorizeObj->auth_date_of_birth  = $request->input('auth_date_of_birth');
            $boAuthorizeObj->auth_nid            = $request->input('auth_nid');
            $boAuthorizeObj->auth_father_name    = $request->input('auth_father_name');
            $boAuthorizeObj->auth_mother_name    = $request->input('auth_mother_name');
            $boAuthorizeObj->auth_address_line_1 = $request->input('auth_address_line_1');
            $boAuthorizeObj->auth_address_line_2 = $request->input('auth_address_line_2');
            $boAuthorizeObj->auth_address_line_3 = $request->input('auth_address_line_3');
            $boAuthorizeObj->auth_city           = $request->input('auth_city');
            $boAuthorizeObj->auth_post_code      = $request->input('auth_post_code');
            $boAuthorizeObj->auth_division       = $request->input('auth_division');
            $boAuthorizeObj->auth_country        = $request->input('auth_country');
            $boAuthorizeObj->auth_email          = $request->input('auth_email');
            $boAuthorizeObj->auth_mobile         = $request->input('auth_mobile');
            $boAuthorizeObj->auth_telephone      = $request->input('auth_telephone');
            $boAuthorizeObj->auth_fax            = $request->input('auth_fax');

            $res = $boAuthorizeObj->save();

            DB::commit();
            if($res){
                return response()->json([
                    'success' => true,
                    'id'      => $boAuthorizeObj->bo_id
                ]);
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again.']);
        }
    }

    public function nomineeStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $userId = $request->input('user_id');

            $existBoNomineeInfo = BoNominee::where('bo_id', $userId)->first();

            if($existBoNomineeInfo){
                $existBoNomineeInfo->bo_id                    = $userId;
                $existBoNomineeInfo->nominee_1_courtesy_title = $request->input('nominee_1_courtesy_title');
                $existBoNomineeInfo->nominee_1_firstname      = $request->input('nominee_1_firstname');
                $existBoNomineeInfo->nominee_1_lastname       = $request->input('nominee_1_lastname');
                $existBoNomineeInfo->nominee_1_relationship   = $request->input('nominee_1_relationship');
                $existBoNomineeInfo->nominee_1_percentage     = $request->input('nominee_1_percentage');
                $existBoNomineeInfo->nominee_1_residency      = $request->input('nominee_1_residency');
                $existBoNomineeInfo->nominee_1_date_of_birth  = $request->input('nominee_1_date_of_birth');
                $existBoNomineeInfo->nominee_1_nid            = $request->input('nominee_1_nid');
                $existBoNomineeInfo->nominee_1_address_line_1 = $request->input('nominee_1_address_line_1');
                $existBoNomineeInfo->nominee_1_address_line_2 = $request->input('nominee_1_address_line_2');
                $existBoNomineeInfo->nominee_1_address_line_3 = $request->input('nominee_1_address_line_3');
                $existBoNomineeInfo->nominee_1_city           = $request->input('nominee_1_city');
                $existBoNomineeInfo->nominee_1_post_code      = $request->input('nominee_1_post_code');
                $existBoNomineeInfo->nominee_1_division       = $request->input('nominee_1_division');
                $existBoNomineeInfo->nominee_1_country        = $request->input('nominee_1_country');
                $existBoNomineeInfo->nominee_1_email          = $request->input('nominee_1_email');
                $existBoNomineeInfo->nominee_1_mobile         = $request->input('nominee_1_mobile');
                $existBoNomineeInfo->nominee_1_telephone      = $request->input('nominee_1_telephone');
                $existBoNomineeInfo->nominee_1_fax            = $request->input('nominee_1_fax');

                $res = $existBoNomineeInfo->save();
                DB::commit();
                if($res){

                    $existBoNomineeTwoInfo = BoNomineeTwo::where('bo_id', $userId)->first();

                    if($existBoNomineeTwoInfo){
                        $existBoNomineeTwoInfo->bo_id                                        = $request->input('user_id');
                        $existBoNomineeTwoInfo->nominee_id                                   = $existBoNomineeInfo->id;
                        $existBoNomineeTwoInfo->nominee_2_courtesy_title                     = $request->input('nominee_2_courtesy_title');
                        $existBoNomineeTwoInfo->nominee_2_firstname                          = $request->input('nominee_2_firstname');
                        $existBoNomineeTwoInfo->nominee_2_lastname                           = $request->input('nominee_2_lastname');
                        $existBoNomineeTwoInfo->nominee_2_relationship                       = $request->input('nominee_2_relationship');
                        $existBoNomineeTwoInfo->nominee_2_percentage                         = $request->input('nominee_2_percentage');
                        $existBoNomineeTwoInfo->nominee_2_residency                          = $request->input('nominee_2_residency');
                        $existBoNomineeTwoInfo->nominee_2_date_of_birth                      = $request->input('nominee_2_date_of_birth');
                        $existBoNomineeTwoInfo->nominee_2_nid                                = $request->input('nominee_2_nid');
                        $existBoNomineeTwoInfo->nominee_2_address_line_1                     = $request->input('nominee_2_address_line_1');
                        $existBoNomineeTwoInfo->nominee_2_address_line_2                     = $request->input('nominee_2_address_line_2');
                        $existBoNomineeTwoInfo->nominee_2_address_line_3                     = $request->input('nominee_2_address_line_3');
                        $existBoNomineeTwoInfo->nominee_2_city                               = $request->input('nominee_2_city');
                        $existBoNomineeTwoInfo->nominee_2_post_code                          = $request->input('nominee_2_post_code');
                        $existBoNomineeTwoInfo->nominee_2_division                           = $request->input('nominee_2_division');
                        $existBoNomineeTwoInfo->nominee_2_country                            = $request->input('nominee_2_country');
                        $existBoNomineeTwoInfo->nominee_2_email                              = $request->input('nominee_2_email');
                        $existBoNomineeTwoInfo->nominee_2_mobile                             = $request->input('nominee_2_mobile');
                        $existBoNomineeTwoInfo->nominee_2_telephone                          = $request->input('nominee_2_telephone');
                        $existBoNomineeTwoInfo->nominee_2_fax                                = $request->input('nominee_2_fax');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_courtesy_title         = $request->input('guardian_of_nominee_2_courtesy_title');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_firstname              = $request->input('guardian_of_nominee_2_firstname');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_lastname               = $request->input('guardian_of_nominee_2_lastname');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_relationship           = $request->input('guardian_of_nominee_2_relationship');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_maturity_date_of_minor = $request->input('guardian_of_nominee_2_maturity_date_of_minor');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_residency              = $request->input('guardian_of_nominee_2_residency');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_date_of_birth          = $request->input('guardian_of_nominee_2_date_of_birth');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_nid                    = $request->input('guardian_of_nominee_2_nid');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_address_line_1         = $request->input('guardian_of_nominee_2_address_line_1');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_address_line_2         = $request->input('guardian_of_nominee_2_address_line_2');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_address_line_3         = $request->input('guardian_of_nominee_2_address_line_3');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_city                   = $request->input('guardian_of_nominee_2_city');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_post_code              = $request->input('guardian_of_nominee_2_post_code');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_division               = $request->input('guardian_of_nominee_2_division');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_country                = $request->input('guardian_of_nominee_2_country');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_email                  = $request->input('guardian_of_nominee_2_email');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_mobile                 = $request->input('guardian_of_nominee_2_mobile');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_telephone              = $request->input('guardian_of_nominee_2_telephone');
                        $existBoNomineeTwoInfo->guardian_of_nominee_2_telephone              = $request->input('guardian_of_nominee_2_telephone');

                        $result = $existBoNomineeTwoInfo->save();

                        if($result){
                            return response()->json([
                                'success' => true,
                                'id'      => $userId
                            ]);
                        }
                    }
                }

                return response()->json([
                    'success' => true,
                    'id'      => $userId
                ]);
            }

            $boNomineeObj = new BoNominee();

            $boNomineeObj->bo_id                    = $userId;
            $boNomineeObj->nominee_1_courtesy_title = $request->input('nominee_1_courtesy_title');
            $boNomineeObj->nominee_1_firstname      = $request->input('nominee_1_firstname');
            $boNomineeObj->nominee_1_lastname       = $request->input('nominee_1_lastname');
            $boNomineeObj->nominee_1_relationship   = $request->input('nominee_1_relationship');
            $boNomineeObj->nominee_1_percentage     = $request->input('nominee_1_percentage');
            $boNomineeObj->nominee_1_residency      = $request->input('nominee_1_residency');
            $boNomineeObj->nominee_1_date_of_birth  = $request->input('nominee_1_date_of_birth');
            $boNomineeObj->nominee_1_nid            = $request->input('nominee_1_nid');
            $boNomineeObj->nominee_1_address_line_1 = $request->input('nominee_1_address_line_1');
            $boNomineeObj->nominee_1_address_line_2 = $request->input('nominee_1_address_line_2');
            $boNomineeObj->nominee_1_address_line_3 = $request->input('nominee_1_address_line_3');
            $boNomineeObj->nominee_1_city           = $request->input('nominee_1_city');
            $boNomineeObj->nominee_1_post_code      = $request->input('nominee_1_post_code');
            $boNomineeObj->nominee_1_division       = $request->input('nominee_1_division');
            $boNomineeObj->nominee_1_country        = $request->input('nominee_1_country');
            $boNomineeObj->nominee_1_email          = $request->input('nominee_1_email');
            $boNomineeObj->nominee_1_mobile         = $request->input('nominee_1_mobile');
            $boNomineeObj->nominee_1_telephone      = $request->input('nominee_1_telephone');
            $boNomineeObj->nominee_1_fax            = $request->input('nominee_1_fax');

            $res = $boNomineeObj->save();

            DB::commit();
            if($res){

                $boNomineeTwoObj = new BoNomineeTwo();

                $boNomineeTwoObj->bo_id                                        = $request->input('user_id');
                $boNomineeTwoObj->nominee_id                                   = $boNomineeObj->id;
                $boNomineeTwoObj->nominee_2_courtesy_title                     = $request->input('nominee_2_courtesy_title');
                $boNomineeTwoObj->nominee_2_firstname                          = $request->input('nominee_2_firstname');
                $boNomineeTwoObj->nominee_2_lastname                           = $request->input('nominee_2_lastname');
                $boNomineeTwoObj->nominee_2_relationship                       = $request->input('nominee_2_relationship');
                $boNomineeTwoObj->nominee_2_percentage                         = $request->input('nominee_2_percentage');
                $boNomineeTwoObj->nominee_2_residency                          = $request->input('nominee_2_residency');
                $boNomineeTwoObj->nominee_2_date_of_birth                      = $request->input('nominee_2_date_of_birth');
                $boNomineeTwoObj->nominee_2_nid                                = $request->input('nominee_2_nid');
                $boNomineeTwoObj->nominee_2_address_line_1                     = $request->input('nominee_2_address_line_1');
                $boNomineeTwoObj->nominee_2_address_line_2                     = $request->input('nominee_2_address_line_2');
                $boNomineeTwoObj->nominee_2_address_line_3                     = $request->input('nominee_2_address_line_3');
                $boNomineeTwoObj->nominee_2_city                               = $request->input('nominee_2_city');
                $boNomineeTwoObj->nominee_2_post_code                          = $request->input('nominee_2_post_code');
                $boNomineeTwoObj->nominee_2_division                           = $request->input('nominee_2_division');
                $boNomineeTwoObj->nominee_2_country                            = $request->input('nominee_2_country');
                $boNomineeTwoObj->nominee_2_email                              = $request->input('nominee_2_email');
                $boNomineeTwoObj->nominee_2_mobile                             = $request->input('nominee_2_mobile');
                $boNomineeTwoObj->nominee_2_telephone                          = $request->input('nominee_2_telephone');
                $boNomineeTwoObj->nominee_2_fax                                = $request->input('nominee_2_fax');
                $boNomineeTwoObj->guardian_of_nominee_2_courtesy_title         = $request->input('guardian_of_nominee_2_courtesy_title');
                $boNomineeTwoObj->guardian_of_nominee_2_firstname              = $request->input('guardian_of_nominee_2_firstname');
                $boNomineeTwoObj->guardian_of_nominee_2_lastname               = $request->input('guardian_of_nominee_2_lastname');
                $boNomineeTwoObj->guardian_of_nominee_2_relationship           = $request->input('guardian_of_nominee_2_relationship');
                $boNomineeTwoObj->guardian_of_nominee_2_maturity_date_of_minor = $request->input('guardian_of_nominee_2_maturity_date_of_minor');
                $boNomineeTwoObj->guardian_of_nominee_2_residency              = $request->input('guardian_of_nominee_2_residency');
                $boNomineeTwoObj->guardian_of_nominee_2_date_of_birth          = $request->input('guardian_of_nominee_2_date_of_birth');
                $boNomineeTwoObj->guardian_of_nominee_2_nid                    = $request->input('guardian_of_nominee_2_nid');
                $boNomineeTwoObj->guardian_of_nominee_2_address_line_1         = $request->input('guardian_of_nominee_2_address_line_1');
                $boNomineeTwoObj->guardian_of_nominee_2_address_line_2         = $request->input('guardian_of_nominee_2_address_line_2');
                $boNomineeTwoObj->guardian_of_nominee_2_address_line_3         = $request->input('guardian_of_nominee_2_address_line_3');
                $boNomineeTwoObj->guardian_of_nominee_2_city                   = $request->input('guardian_of_nominee_2_city');
                $boNomineeTwoObj->guardian_of_nominee_2_post_code              = $request->input('guardian_of_nominee_2_post_code');
                $boNomineeTwoObj->guardian_of_nominee_2_division               = $request->input('guardian_of_nominee_2_division');
                $boNomineeTwoObj->guardian_of_nominee_2_country                = $request->input('guardian_of_nominee_2_country');
                $boNomineeTwoObj->guardian_of_nominee_2_email                  = $request->input('guardian_of_nominee_2_email');
                $boNomineeTwoObj->guardian_of_nominee_2_mobile                 = $request->input('guardian_of_nominee_2_mobile');
                $boNomineeTwoObj->guardian_of_nominee_2_telephone              = $request->input('guardian_of_nominee_2_telephone');
                $boNomineeTwoObj->guardian_of_nominee_2_telephone              = $request->input('guardian_of_nominee_2_telephone');

                $result = $boNomineeTwoObj->save();

                if($result){
                    return response()->json([
                        'success' => true,
                        'id'      => $boNomineeObj->bo_id
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again.']);
        }
    }

    public function boDocumentupload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('first_applicant_images', 'public');

        $userId = $request->input('user_id');

        $existBoDocument = BoDocument::where('bo_id', $userId)->first();

        if($existBoDocument){
            $existBoDocument->bo_id                            = $request->input('user_id');
            $existBoDocument->first_applicant_1st_holder_photo = $filePath;
            $existBoDocument->save();

            return response()->json(['success' => 'Image uploaded successfully!']);
        }

        $boDocumentObj                                   = new BoDocument();
        $boDocumentObj->bo_id                            = $request->input('user_id');
        $boDocumentObj->first_applicant_1st_holder_photo = $filePath;
        $boDocumentObj->save();

        return response()->json(['success' => 'Image uploaded successfully!']);
    }

    public function boDocumentfirstPassportupload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('first_applicant_passport_images', 'public');

        $userId = $request->input('user_id');

        $existBoDocument = BoDocument::where('bo_id', $userId)->first();

        if($existBoDocument){
            $existBoDocument->bo_id                            = $request->input('user_id');
            $existBoDocument->first_applicant_1st_holder_NID_Passport_Driving_front_side = $filePath;
            $existBoDocument->save();

            return response()->json(['success' => 'Image uploaded successfully!']);
        }

        $boDocumentObj                                   = new BoDocument();
        $boDocumentObj->bo_id                            = $request->input('user_id');
        $boDocumentObj->first_applicant_1st_holder_NID_Passport_Driving_front_side = $filePath;
        $boDocumentObj->save();

        return response()->json(['success' => 'Image uploaded successfully!']);
    }

    public function boDocumentfirstPassportBackupload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('first_applicant_1st_holder_NID_Passport_Driving_back_side', 'public');

        $userId = $request->input('user_id');

        $existBoDocument = BoDocument::where('bo_id', $userId)->first();

        if($existBoDocument){
            $existBoDocument->bo_id                                                     = $request->input('user_id');
            $existBoDocument->first_applicant_1st_holder_NID_Passport_Driving_back_side = $filePath;
            $existBoDocument->save();

            return response()->json(['success' => 'Image uploaded successfully!']);
        }

        $boDocumentObj                                   = new BoDocument();
        $boDocumentObj->bo_id                            = $request->input('user_id');
        $boDocumentObj->first_applicant_1st_holder_NID_Passport_Driving_back_side = $filePath;
        $boDocumentObj->save();

        return response()->json(['success' => 'Image uploaded successfully!']);
    }

    public function boDocumentClear(Request $request, $id)
    {
        // Find the image record in the database
        $image = BoDocument::where('bo_id', $id)->first();

        if ($image) {
            Storage::delete($image->first_applicant_1st_holder_photo);

            $image->first_applicant_1st_holder_photo = null;
            $image->save();


            return response()->json(['message' => 'Image cleared successfully'], 200);
        } else {
            return response()->json(['message' => 'Image record not found'], 404);
        }
    }

    public function firstapplicantpassportFrontClear(Request $request, $id)
    {
        // Find the image record in the database
        $image = BoDocument::where('bo_id', $id)->first();

        if ($image) {
            Storage::delete($image->first_applicant_1st_holder_NID_Passport_Driving_front_side);

            $image->first_applicant_1st_holder_NID_Passport_Driving_front_side = null;
            $image->save();


            return response()->json(['message' => 'Image cleared successfully'], 200);
        } else {
            return response()->json(['message' => 'Image record not found'], 404);
        }
    }

    public function firstapplicantpassportBackClear(Request $request, $id)
    {
        // Find the image record in the database
        $image = BoDocument::where('bo_id', $id)->first();

        if ($image) {
            Storage::delete($image->first_applicant_1st_holder_NID_Passport_Driving_back_side);

            $image->first_applicant_1st_holder_NID_Passport_Driving_back_side = null;
            $image->save();


            return response()->json(['message' => 'Image cleared successfully'], 200);
        } else {
            return response()->json(['message' => 'Image record not found'], 404);
        }
    }

    public function uploadExcel(Request $request)
    {
        $request->validate([
            'bo_file' => 'required|file|mimes:xlsx,xls,csv|max:2048',
        ]);

        if ($request->hasFile('bo_file')) {
            $file = $request->file('bo_file');
            $filePath = $file->storeAs('uploads', $file->getClientOriginalName());

            // Import the data to the database
            Excel::import(new BoImport, $filePath);

            return redirect()->back()->with('message','File uploaded and data imported successfully');
        }

        return response()->json(['error' => 'File upload failed'], 500);
    }

    public function acStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'boId' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $boObj = new BoAccount();

            $boObj->bo_id = $request->input('boId');
            $boObj->name = ($request->input('client_name')) ?? 'N/A';
            $boObj->ac_type = ($request->input('ac_type')) ?? 'N/A';

            $res = $boObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Successfully added');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return false;
        }
    }

    public function openBoForm()
    {
        return view('admin.bo.bo');
    }

    public function showForm($id)
    {
        $client = BOForm::findOrFail($id);

        // return view('admin.bo.show', compact('client'));
        $pdf = PDF::loadView('admin.bo.test', compact('client'));
        return $pdf->download('client_information.pdf');
    }
}
