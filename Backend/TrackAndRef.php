<?php
namespace Backend;
	
require_once("AdminCore.php");
	 
class TrackAndRef extends AdminCore{

	protected function getByTrackOrRef($table, $codeName, $codeValue){

		//use tracking code for the db query:
		$shipmentDetailsByCode = parent::getShipmentByTrackOrRef($table, $codeName, $codeValue);

		return $shipmentDetailsByCode;
	}
}
?>