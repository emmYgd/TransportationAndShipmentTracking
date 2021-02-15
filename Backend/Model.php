<?php

require("rb.php");

//trait Model{

	/*public*/ function setUp() : bool{

		//FOR PRODUCTION :
		//set db constants..
		//$localhost = "127.0.0.1"; 
		//$db_name = "emidexlogservice"; 
		//$db_username = "root";
		//$db_password = "emidex12log";//emidex12log

		//setUp Database //PYaeuZ1QXsru6zF5 - passHash
		/*try{
        	$db = new PDO('mysql:host=localhost;dbname=emidexlogservice','root','young@12emmy');
    	}catch(PDOException $e){
        	echo $e->getmessage();
        	echo("dat's all");
        	return false;
    	}*/

    	//return true;

		//R::setUp("mysql:host={$localhost};dbname= {$db_name}", $db_username, $db_password)
		//return true;

		//FOR TESTING:

		R::setUp("sqlite:/tmp/dbfile.db");
		return true;
	}


	/*public*/ function createModel(string $paramToSaveTableName, string $paramToSaveName, string $paramToSaveValue="")
	{
		$paramTableCreate = R::dispense($paramToSaveTableName);
		$paramTableCreate->$paramToSaveName = $paramToSaveValue;

		//save param:
		R::store( $paramTableCreate);

		return true;
	}


	//for general admin read:
	/*public*/ function adminReadModel(string $paramTable)
	{
		$paramValue = R::findAll($paramTable);
		return $paramValue;
	}



	function readForTrackAndRef(string $paramTable){

		$loadAllDetails = adminReadModel($paramTable);

		R::loadJoined($loadAllDetails, 'TrackingCode');
		R::loadJoined($loadAllDetails, 'ReferenceCode');

		return $loadAllDetails;
	}


	//admin read for specific value but returns only the queried bean:
	/*public*/ function adminReadModelOne(string $paramTable, string $paramToBeReadName, $paramValue=""){

		$entryFound = R::findOne($paramTable, $paramToBeReadName .  " = ?" , [$paramValue]);
		return $entryFound;

	}


	//admin read for specific value but returns all associated bean :
	/*public*/ function adminReadModelAll(string $paramTable, string $paramToBeReadName, $paramValue=""){
		$entryFound = R::find($paramTable, $paramToBeReadName . " == ". $paramValue);
		return $entryFound;
	}



	/*public*/ function adminUpdateModel(string $returnModel, string $paramName, $paramValue=""):bool{

		//change value:
		$paramTable-> $paramName = $paramValue;

		//store this in the database:
		return true;
	}


	//update table where $searchParamName = $searchParamValue...
	/*public*/ function adminUpdateModelWhere(string $paramTable, string $searchParamName, string $searchParamValue, string $toModifyName, string $toModifyValue):bool{

		//find where:
		$searchEntry = adminReadModelAll($paramTable, $searchParamName, $searchParamValue);

		//now modify:
		$searchEntry->$toModifyName = $toModifyValue;

		return true;
	}


	//only admin can delete Users:
	/*public*/ function adminDeleteModel(string $paramTable, string $paramName):bool{
		R::trash($paramTable, $paramName);
		return true;
	}
//}
?>