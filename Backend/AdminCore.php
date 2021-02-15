<?php
namespace Backend;

require_once("ValidateCore.php");
require_once("Model.php");

class AdminCore{

	use ValidateCore;


	protected function getTrackAndRefCodes($adminTable) : array {

		$initDbase = setUp();

		if($initDbase){

			$loadAllDetails = readForTrackAndRef($adminTable);

			return $loadAllDetails;
			
		}
	}

	protected function getShipmentByTrackOrRef($tableName, $paramName, $paramValue){
		$loadDetailsWhere = adminReadModelAll($tableName, $paramName, ValidateCore::validate($paramValue));
		//adminReadModelOne($tableName, $paramName, ValidateCore::validate($paramValue));
		
		return $loadDetailsWhere;
	}


	protected function setShipmentDetails( $adminTable, $shipmentDetailsN, $shipmentDetailsV )
	{
		//initialize the database:
		$initDbase = setUp();

		if($initDbase){
			//create table and entity models in Dbase:
			createModel($adminTable, $shipmentDetailsN, ValidateCore::validate($shipmentDetailsV));
			return true;
		}
	}


	protected function updateShipmentDetails($returnModel, $shipmentDetailsN, $shipmentDetailsV)
	{
		//initialize the database:
		$initDbase = setUp();

		if($initDbase){
			//AdminUpdateModel(string $paramTable, string $paramName, $paramValue)

			//create table and entity models in Dbase:
			adminUpdateModels($returnModel, $shipmentDetailsN, ValidateCore::validate($shipmentDetailsV));
			return true;
		}
	}
	

	protected function generateReferenceID() : string {

		//generate a random number alpha numeric number:
		$strBase1 = "0123456789";
		$strBase2 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$strBase3 = "abcdefghijklmnopqrstuvwxyz";
		//$strBase4 = random_strings(10);

		$strCombine = $strBase1 . $strBase2 . $strBase3;

		$referenceID = substr( str_shuffle($strCombine), 0, 5 ) . substr( md5(time()), 0, 4 );
		return $referenceID;
	}

	protected function generateTrackingID() : string {

		//generate purely random numbers:
		$strBase = "0123456789";
		$strShuffle1 = str_shuffle($strBase);
		$strShuffle2 = str_shuffle($strBase);

		$strCombine = $strShuffle1 . $strShuffle2;

		$trackingPin = substr( $strCombine, 0, 9);
		return $trackingPin;
	}

	//Also return user's request quote submission to the admin :
	/*protected function returnRequestQuotesInfoToAdmin($userTable) : array {

		//initialize the database:
		$initDbase = setUp();

		if($initDbase){
				
			//read all table and entity models in Dbase:
			$adminProductDetails = adminReadModel($userTable);
			
			return $adminProductDetails;
		}
	}*/
}
?>
