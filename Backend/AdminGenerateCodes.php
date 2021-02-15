<?php
namespace Backend;
	
require_once("AdminCore.php");
	 
final class AdminGenerateCodes extends AdminCore{

	public function __construct(){
		//run the function below by default immediately this class is invoked:
		self::adminGenerateCodes();
	}

	public function adminGenerateCodes(){

		$referenceCode = parent::generateReferenceID();
		$trackingCode = parent::generateTrackingID();

		$resp = [
			"referenceCode" => $referenceCode,
			"trackingCode" => $trackingCode
		];

		//first send to the UI and then collect back later...
		echo json_encode($resp); 
	}
}

new AdminGenerateCodes();
?>