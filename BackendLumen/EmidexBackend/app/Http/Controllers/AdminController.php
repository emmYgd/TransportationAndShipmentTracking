<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\ComputeTrack_RefService;
use App\Http\Controllers\Services\ModelEntitiesService;

use App\Model\AdminAbstraction;
use App\Model\UserAbstraction;
use App\Model\UserEntityAbstraction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    use ComputeTrack_RefService;
    use ModelEntitiesService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }

    public function AdminLogin(Request $request) : json 
    {   
        $status = array();

        try{

            $supplied_admin_name = $request->input('admin_name');
            $supplied_admin_pass = $request->input('password');

            //validate here:
            $validate = $request->validate([
                'admin_name' => 'required | unique:admin',
                'password' => 'required | unique:admin'
            ]);

            if($validate->fails()){
                throw new \Exception("Invalid Input provided!");
            }

            $pass_hash = md5(md5($password));

            //query KeyValue Pair:
            $queryKeysValues = [
                'admin_name' => $supplied_admin_name, 
                'password' => $pass_hash
            ];

            $isDetailsFound = ModelEntitiesService::readService(AdminAbstraction::class, $queryKeysValues);
            if(!empty(isDetailsFound){

                $status = [
                    'code' => 1,
                    'serverStatus' => 'adminFound'
                ];

            }else{
                throw new \Exception("adminNotFound");
            }

            return response()->json($status, 200);


        }catch(\Exception ex){

            $status = [
                'code' => 0,
                'serverStatus' => 'LoginFailed',
                'short_description' => $ex->getMessage()
            ];

            return response()->json($status, 400);
        }

    }



    public function AdminCreate(Request $request) : json
    {
        $status = array();

        try{
            //has validated request from the frontend...
            //create directly inside the database:
            $details_saved = ModelEntitiesService::createService($request);

            if(!$details_saved){

                throw new \Exception("saveError");   

            }else{

                $status = [
                    'code' => 1,
                    'serverStatus' => 'entrySaved'
                ];
            }

            return response()->json($status, 200);

        }catch(\Exception $ex){

            $status = [
                'code' => 0,
                'serverStatus' => 'saveFailed',
                'short_description' => $ex->getMessage()
            ];

            return response()->json($status, 400);
        }

    }



    public function AdminGetByTrackOrRef(Request $request) : json
    {
        $status = array();

        try{

            $track_code = $request->input('trackingCode');
            $ref_code = $request->input('referenceCode');

            //validate them:
            //validate here:
            $validate = $request->validate([
                'trackingCode' => 'unique:user',
                'referenceCode' => 'unique:user'
            ]);

            if($validate->fails()){
                throw new \Exception("Tracking and Reference codes cannot be duplicate!");
            }

            $queryKeysValues = array();

            switch($ref_code){

                case isset($ref_code)  :

                     $queryKeysValues = [
                        'referenceCode' => $ref_code
                    ];

                    break;

                case !isset($ref_code) :

                    $queryKeysValues = [
                        'trackingCode' => $track_code
                    ];

                    break;
                    
            }

            $details_read = ModelEntitiesService::readService(UserAbstraction::class, $queryKeysValues);
                    break;
            }

            if(empty($details_read){

                throw new \Exception("readError");   

            }else{

                $status = [
                    'code' => 1,
                    'serverStatus' => 'searchSuccess',
                    'readDetails' => json_encode($details_read);
                ];
            }

            return response()->json($status, 200);

        }catch(\Exception $ex){

            $status = [
                'code' => 0,
                'serverStatus' => 'searchError',
                'short_description' => $ex->getMessage()
            ];

            return response()->json($status, 400);
        }

    }


    public function AdminGetAllTrack_Ref(Request $request) : json
    {

        $status = array();

        try{

            if ($request->isMethod('get')){

                $details_read_all = ModelEntitiesService::readAllService(UserAbstraction::class);

                if(empty($details_read_all)){
                    throw new \Exception("readAllError");
                }
            
                //init params:
                $counter = 0;
                $track_array = array();
                $ref_array = array();

                $details_read_all->each(function($allModel){

                    $track_array[counter++] = $allModel->trackingCode;
                    $ref_array[counter++] = $allModel->referenceCode;

                });

                $status = [
                    'code' => 1,
                    'serverStatus' => 'readAllTrackAndRefSuccess',
                    'trackReadDetails' => json_encode($track_array);
                    'refReadDetails' => json_encode($ref_array);
                ];
            }

            return response()->json($status, 200);

        }catch(\Exception ex){

             $status = [
                'code' => 0,
                'serverStatus' => 'readAllTrackAndRefError',
                'short_description' => $ex->getMessage()
            ];

            return response()->json($status, 400);

        }

    }


    public function AdminUpdateParams(Request $request) : json
    {

        $status = array();

        try{

            $track_code = $request->input('trackingCode');
            $new_price = $request->input('price');
            $new_status = $request->input('status')

            //validate here:
            $validate = $request->validate([
                'trackingCode' => 'required | unique:user'
                'price' => 'required | unique:user',
                'status' => 'required | unique:user'
            ]);

            if($validate->fails()){
                throw new \Exception("Invalid Input provided!");
            }

            $queryKeysValues = [
                'trackingCode' => $track_code
            ];

            $updateKeysValues = [
                'price' => $price,
                'status' => $status 
            ];

            //update all models:
            $details_update = ModelEntitiesService::updateService(UserAbstraction::class, $queryKeysValues, $updateKeysValues);

            if(!$details_update){
                throw new \Exception("updateFailed");
            } 
            
            $status = [
                'code' => 1,
                'serverStatus' => 'updateSuccess',
            ];

            return response()->json($status, 200);

        }catch(\Exception ex){

            $status = [
                'code' => 0,
                'serverStatus' => 'updateFailed',
                'short_description' => $ex->getMessage()
            ];

            return response()->json($status, 400);

        }
    }


    public function AdminGenerateCodes(Request $request) : json
    {

        $status = array();

        try{

            if($request->isMethod('get')){

                $trackingCode = ComputeTrack_RefService::generateTrackingID();
                $referenceCode = ComputeTrack_RefService::generateReferenceID();

                if(!isset($trackingCode) && !isset($referenceCode)){

                    throw new \Exception("codeGenerationError");
            
                }
            
                $status = [
                    'code' => 1
                    'serverStatus' => 'codeGenerationSuccess'
                    'referenceCode' => $referenceCode,
                    'trackingCode' => $trackingCode
                ];
            }

            return reponse()->json($status, 200);

        }catch(\Exception ex){

             $status = [
                'code' => 0,
                'serverStatus' => 'codeGenerationError',
                'short_description' => $ex->getMessage()
            ];

            return response()->json($status, 400);

        }
    }

}

?>
