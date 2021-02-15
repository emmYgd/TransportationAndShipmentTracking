<?php

namespace Backend;

require_once("ValidateCore.php");
require_once("SessionControlCore.php");
require_once("Constants.php");


final class AdminLogin {

	use ValidateCore;
	use SessionControlCore;
	use Constants;

	public function __construct(){
		//run the function below by default immediately this class is invoked:
		self::adminLogin();
	}

	public function adminLogin(){

		$supplied_admin_pass = $_POST["suppliedAdmin"];

		$adminPass = Constants::getAdminPass();

		//begin to structure the response format:
		$resp = array();

		if($supplied_admin_pass == $adminPass){

			//ensureUserSession("adminPass", md5(adminPass));

			$resp = [
				"serverStatus" => "adminFound",
				"code" => 200
			];
				
		}else{

			$resp = [
				"serverStatus" => "notFound",
				"code" => 400
			];

		}

		echo json_encode($resp);

	}


	public function ensureUserSession(string $paramName, string $paramValue) : void {

		$sessionStatus = getStatus();

		$startsession = startSession($sessionStatus);

		setAsSessionVariable($paramName, $paramValue);
	}	
}

new AdminLogin();

?>