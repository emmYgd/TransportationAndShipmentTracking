<?php
namespace Backend;
	
require_once("TrackAndRef.php");
	 
final class AdminGetDetailsByTrack_Ref extends TrackAndRef{

	public $adminTable = "admin";
	
	public function __construct(){
		//run the function below by default immediately this class is invoked:
		self::adminGetDetailsByTrack_Ref();
	}

	//note the constants:
	/*$localhost = "localhost";
	$db_name = "";
	$db_username = ""; 
	$db_password = "";*/

	public function adminGetDetailsByTrack_Ref(){
		
		//get tracking and ref codes:
		 $trackingCode = $_POST["trackingCode"];
		 $referenceCode = $_POST["referenceCode"];

		 if( ($referenceCode === "") && isset($trackingCode) ){

		 	//use tracking code for the db query:
		 	$shipmentDetailsByTrack_Ref = parent::getByTrackOrRef($this->adminTable, 
		 		"TrackingCode", $trackingCode);

		 	$jsonRespond = self::processResponse($shipmentDetailsByTrack_Ref);
		 	echo($jsonRespond);

		 }else if( ($trackingCode === "") && isset($referenceCode) ){

		 	//use tracking code for the db query:
		 	$shipmentDetailsByTrack_Ref = parent::getByTrackOrRef($this->adminTable, 
		 		"ReferenceCode", $referenceCode);

		 	$jsonRespond = self::processResponse($shipmentDetailsByTrack_Ref);
		 	echo($jsonRespond);
		}
	}

	private function processResponse($shipmentDetails)
	{
		$response = array();

		if(isset($shipmentDetails) && !empty($shipmentDetails)){

			$response['serverStatus'] = "FetchSuccess";
			$response['code'] = 200;
			$response['shipmentDetails'] = $shipmentDetails;

		}else{	

			$response = [
				"serverStatus"=>"FetchFailed",
				"code" => 400
			];
		}

		return json_encode($response);
		
	}
}

new AdminGetDetailsByTrack_Ref();
?>