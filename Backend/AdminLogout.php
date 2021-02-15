<?php
//destroy user session and redirect
require_once("SessionControlCore.php");

class AdminLogout{

	use SessionControlCore;

	public public function __construct(){
		//run the function below by default immediately this class is invoked:
		self::adminLogout();
	}

	public function adminLogout(){
		$logout = SessionControlCore::stopSession();

		if($logout){
			//send over to the client:

			$resp = json_encode([
				"status" => "sessionDestroyed"
			]);

			echo($resp);
		}else{

			$resp = json_encode([
				"status" => "sessionNotDestroyed"
			]);
			echo($resp);
		}
	}
}

new AdminLogout();
?>