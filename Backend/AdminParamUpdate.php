<?php
namespace Backend;
	
require_once("AdminCore.php");
	 
final class AdminParamUpdate extends AdminCore{

	public $adminTable = "admin";
	
	public function __construct(){
		//run the function below by default immediately this class is invoked:
		self::adminParamUpdate();
	}

	public function adminParamUpdate(){
		
		//get specific param from the user:
		$trackingCode = $_POST["trackingCode"];

		//only these two can be modified for consistency's sake:
		$newShipmentPrice = $_POST["price"];
		$newShipmentStatus = $_POST["status"];

		if($trackingCode !== ""){

			$isPriceUpdated = adminUpdateModelWhere($this->adminTable, "TrackingCode", $trackingCode, "Price", $newShipmentPrice);

			$isStatusUpdated = adminUpdateModelWhere($this->adminTable, "TrackingCode", $trackingCode, "Status", $newShipmentStatus);

			$response = array();

		if($isPriceUpdated && $isStatusUpdated){

			$response['serverStatus'] = "UpdateSuccess";
			$response['code'] = 200;

		}else{

			$response = [
				"serverStatus"=>"UpdateFailed",
				"code" => 400
			];
		}

		echo json_encode($response);
	}
}

new AdminParamUpdate();
?>