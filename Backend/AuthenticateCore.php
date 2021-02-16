<?php

namespace Backend\Core;

require_once("ValidateCore.php");
require_once("SessionControlCore.php");
//require_once("Model/InitDbase.php");
//require_once("Model/ReadModel.php");

class AuthenticateCore
{
	use ValidateCore;
	use SessionControlCore;
	//use InitDbase;
	//use ReadModel;

	private $_adminPassword = "";


	//setters and getters:
	/*protected function setSuppliedPassword(string $password){

		$this->_suppliedPassword = $password;

	}*/

	protected function getAdminPassword() : string {

		return $this->_adminPassword;
		//return validate($_suppliedPassword);

	}	

	/*protected function getSuppliedPasswordHash() : string {

		$password = $this->getSuppliedPassword(); 

		//sets password hash
		return password_hash($password, PASSWORD_DEFAULT);

	}*/


	//Check User Details:
	/*public function loginAdmin(string $adminTable, string $passwordN, string $passwordV) : array {

		//initialize the database:
		$initDbase = setUp();

		if($initDbase){
				
			//read table and entity models in Dbase:

			//check out the password :
			$entryFoundPass = ReadModelOne($adminTable, $passwordN, $passwordV);

			//check them out with logic:
			if(isset($entryFoundPass)){

				//put the current user in session:
				ensureUserSession($adminTable, $this->getSuppliedPasswordHash());

				//return all the model in the database: 
				$adminProductDetails = ReadModelAll($adminTable);
				return $adminProductDetails;

				//ensure to return all user request quote details after this...
				
			}
		}
	}*/


		

	public function ensureUserSession(string $paramName, string $paramValue) : void {

		$sessionStatus = getStatus();

		$startsession = startSession($sessionStatus);

		setAsSessionVariable($paramName, $paramValue);
	}

}

?>
