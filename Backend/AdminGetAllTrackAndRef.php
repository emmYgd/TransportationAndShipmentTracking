<?php
namespace Backend;
	
require_once("AdminCore.php");
	 
final class AdminGetAllTrackAndRef extends AdminCore{

	public $adminTable = "admin";
	
	public function __construct(){
		//run the function below by default immediately this class is invoked:
		self::adminGetAllTrackAndRef();
	}

	//note the constants:
	/*$localhost = "localhost";
	$db_name = "";
	$db_username = ""; 
	$db_password = "";*/

	public function adminGetAllTrackAndRef(){
		//get all params saved in the database:

			$shipmentDetails = parent::getTrackAndRefCodes($this->adminTable);

			if(isset($shipmentDetails)){

				$response = array();
				$respCounter = 0;

				foreach($loadAllDetails as $shipmentDetails){

					$respCounter++;

					
					$response['TrackingCode'][$respCounter] = $shipmentDetails->TrackingCode;
					$response['ReferenceCode'][$respCounter] = $shipmentDetails->ReferenceCode;
					$response['code'] = 200;
				} 

				//add other response details:
				$response['serverStatus'] = "FetchSuccess";
				echo $response;
				
			}else{

				echo json_encode([
					"serverStatus"=>"FetchFailed",
					"code" => 400
				]);

			}
	}
}

new AdminGetAllTrackAndRef();
?>