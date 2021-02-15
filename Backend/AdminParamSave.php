<?php
namespace Backend;
	
require_once("AdminCore.php");
	 
final class AdminParamSave extends AdminCore{
	
	public function __construct(){
		//run the function below by default immediately this class is invoked:
		self::adminParamSave();
	}

	//note the constants:
	/*$localhost = "localhost";
	$db_name = "";
	$db_username = ""; 
	$db_password = "";*/

	public function adminParamSave(){

		//Name for the rows in the database:
		$adminTableName = "admin";

		$shipmentDayN = "ShipmentDay";
		$shipmentMonthN = "ShipmentMonth";
		$shipmentYearN = "ShipmentYear";

		$shipmentHourN = "ShipmentHour";
		$shipmentMinuteN = "ShipmentMinute";
		$shipmentSecondN = "ShipmentSecond";

		$deliveryDayN = "DeliveryDay";
		$deliveryMonthN = "DeliveyMonth";
		$deliveryYearN = "DeliveryYear";

		$shiperFullNameN = "ShipperFullName";
		$shiperAddressN = "ShipperAddress";

		$receiverFullNameN = "ReceiverFullName";
		$receiverAddressN = "ReceiverAddress";

		$priceN = "Price";
		$statusN = "Status";//Processing, PickUp, In Transit, On Hold...
		$commodityN = "Commodity";
		$commodityTypesN = "CommodityTypes";//how many commodity types count are we tracking, is it one or many in this single bundle?
		$commodityQuantityN = "CommodityQuantity";
		$commodityContentN = "CommodityContent";

		$serviceTypeN = "ServiceType"; //e.g.3 day freight...
		$originN = "Origin";
		$portOriginN = "Port";
		$destinationN = "Destination";
		$modeN = "Mode";
		$weight_kgsN = "WeightKgs";
		$weight_cubicN = "WeightCubicMeters";
		$allocationN = "Allocation";
		$size_typeN = "SizeType";
		$add_infoN = "AdditionalInformation";
		$shipmentTravelHistory = "ShipmentTravelHistory";

		$trackingCodeN = "TrackingCode";
		$referenceCodeN = "ReferenceCode";



		//now get the parameters to be sent from the frontend:
		$shipmentDayV = $_POST["shipmentDay"];
		$shipmentMonthV = $_POST["shipmentMonth"];
		$shipmentYearV = $_POST["shipmentYear"];

		$shipmentHourV = $_POST["shipmentHour"];
		$shipmentMinuteV = $_POST["shipmentMinute"];
		$shipmentSecondV = $_POST["shipmentSecond"];

		$deliveryDayV = $_POST["shipmentDay"];
		$deliveryMonthV = $_POST["shipmentMonth"];
		$deliveryYearV= $_POST["shipmentYear"];

		$shiperFullNameV = $_POST["shiperFullName"];
		$shiperAddressV = $_POST["shiperAddress"];

		$receiverFullNameV = $_POST["receiverFullName"];
		$receiverAddressV = $_POST["receiverAddress"];

		$priceV = $_POST["price"];
		$statusV = $_POST["status"];//Processing, PickUp, In Transit, On Hold...
		$commodityV = $_POST["commodity"];
		$commodityTypesV = $_POST["commodityTypes"];//how many commodity types count are we tracking, is it one or many in this single bundle?
		$commodityQuantityV = $_POST["commodityQuantity"];
		$commodityContentV = $_POST["commodityContent"];
		$destinationV = $_POST["destination"];

		$originV = $_POST["origin"];
		$portOriginV = $_POST["portOrigin"];
		$modeV = $_POST["mode"];

		$serviceTypeV = $_POST["service_type"]; //e.g.3 day freight...
		
		$weight_kgsV = $_POST["weight_kgs"];
		$weight_cubicV = $_POST["weight_cubic"];
		$allocationV = $_POST["allocation"];

		$size_typeV = $_POST["size_type"];
		$add_infoV = $_POST["add_info"];
		$shipmentTravelHistoryV = $_POST["shipmentTravelHistory"];

		$trackingCodeV = $_POST["trackingCode"];
		$referenceCodeV = $_POST["referenceCode"];

		//put into Db:

			parent::setShipmentDetails( $adminTableName, $shipmentDayN, $shipmentDayV );
			parent::setShipmentDetails( $adminTableName, $shipmentMonthN, $shipmentMonthV );
			parent::setShipmentDetails( $adminTableName, $shipmentYearN, $shipmentYearV );

			parent::setShipmentDetails( $adminTableName, $shipmentHourN, $shipmentHourV);
			parent::setShipmentDetails( $adminTableName, $shipmentMinuteN, $shipmentMinuteV );
			parent::setShipmentDetails( $adminTableName, $shipmentSecondN, $shipmentSecondV );

			parent::setShipmentDetails( $adminTableName, $deliveryDayN, $deliveryDayV);
			parent::setShipmentDetails( $adminTableName, $deliveryMonthN, $deliveryMonthV );
			parent::setShipmentDetails( $adminTableName, $deliveryYearN, $deliveryYearV );

			parent::setShipmentDetails( $adminTableName, $shiperFullNameN, $shiperFullNameV );
			parent::setShipmentDetails( $adminTableName, $shiperAddressN, $shiperAddressV );

			parent::setShipmentDetails( $adminTableName, $receiverFullNameN, $receiverFullNameV );
			parent::setShipmentDetails( $adminTableName, $receiverAddressN, $receiverAddressV );

			parent::setShipmentDetails( $adminTableName, $priceN, $priceV );
			parent::setShipmentDetails( $adminTableName, $statusN, $statusV );
			parent::setShipmentDetails( $adminTableName, $commodityN, $commodityV );
			parent::setShipmentDetails( $adminTableName, $commodityTypesN, $commodityTypesV );
			parent::setShipmentDetails( $adminTableName, $commodityQuantityN, $commodityQuantityV);
			parent::setShipmentDetails( $adminTableName, $commodityContentN, $commodityContentV );
			parent::setShipmentDetails( $adminTableName, $serviceTypeN, $serviceTypeV );
			parent::setShipmentDetails( $adminTableName, $originN, $originV );
			parent::setShipmentDetails( $adminTableName, $portOriginN, $portOriginV );
			parent::setShipmentDetails( $adminTableName, $destinationN, $destinationV );
			parent::setShipmentDetails( $adminTableName, $modeN, $modeV );
			parent::setShipmentDetails( $adminTableName, $weight_kgsN, $weight_kgsV );
			parent::setShipmentDetails( $adminTableName, $weight_cubicN, $weight_cubicV );

			parent::setShipmentDetails( $adminTableName, $allocationN, $allocationV );
			parent::setShipmentDetails( $adminTableName, $size_typeN, $size_typeV );
			parent::setShipmentDetails( $adminTableName, $add_infoN, $add_infoV );
			parent::setShipmentDetails( $adminTableName, $shipmentTravelHistoryN, $shipmentTravelHistoryV );

			parent::setShipmentDetails( $adminTableName, $trackingPinN, $trackingPinV );
			parent::setShipmentDetails( $adminTableName, $referenceCodeN, $referenceCodeV );

			$resp;

			if(true){

				$resp = [
					"serverStatus" => "SuccessfullySaved",
					"code" => 200
				];

			}else{
				$resp = [
					"serverStatus"=>"NotSaved"
				];
			}
		echo json_encode($resp);
	}
}

new AdminParamSave();
?>
