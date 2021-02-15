<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\ModelEntitiesService;

use App\Model\UserAbstraction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ExampleController extends Controller
{
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

    public function UserTrackShipment(Request $request) : json 
    {   
        $status = array();

        try{

        	$track_code = $request->input('trackingCode');
        	$ref_code = $request->input('referenceCode');


            //validate here:
            $validate = $request->validate([
                'trackingCode' => 'unique:user',
                'referenceCode' => 'unique:user'
            ]);

            if($validate->fails()){
                throw new \Exception("Invalid Input provided!");
            }

        	$queryKeysValues = array();

        	if(isset($track_code) && $ref_code == ""){

        		$queryKeysValues = [

        			'trackingCode' => $track_code
        		];

	        }else if(isset($ref_code) && $track_code == ""){

	        	$queryKeysValues = [

        			'trackingCode' => $track_code
        		];

	        }

        	$user_details = ModelEntitiesService::readService(UserAbstraction::class, $queryKeysValues);

        	if(empty($user_details)){

        		throw new \Exception("Could not retrieve user details. Try Again!");
        			
        	}

        	$status = [
                'code' => 1,
                'serverStatus' => 'detailsFound',
                'userDetails' => json_encode($user_details)
            ];

            return response()->json($status, 200);

        }catch(\Exception $ex){

        	 $status = [
                'code' => 0,
                'serverStatus' => 'searchFailed',
                'short_description' => $ex->getMessage()
            ];

            return response()->json($status, 400);

        }
    }

    /*public function UserGetQuote(Request $request) : json 
    {   
        $status = array();

        try{



        }catch(\Exception $ex){

        }
    }*/

}
