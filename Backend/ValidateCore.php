<?php

namespace Backend;

trait ValidateCore 
{
	//get certain functions such as htmlentities and other parameters......
	
	//the function:
	public function validate($anyDataEntity){
		$sanitizedData = self::sanitizedData($anyDataEntity);
		return $sanitizedData; 
	}

	/*public function SanitizedCore($anyDataEntity){
		if( ctype_alpha($anyDataEntity) || ctype_alnum($anyDataEntity) || 
				ctype_digit($anyDataEntity) || strlen($anyDataEntity) > 4
		){
			self::SanitizeLogic($anyDataEntity);
		} else {
			self::SanitizeLogic($anyDataEntity);
		}
	}*/

	public function sanitizedData($anyDataEntity){

		//Removes any html from the string and turns it into &lt;
		$anyDataEntity = htmlentities($anyDataEntity);

		//Strips html and PHP tags
		$anyDataEntity = strip_tags($anyDataEntity); 

		/*if (get_magic_quotes_gpc())
		{
			// Gets rid of unwanted quotes
			$anyDataEntity = stripslashes($anyDataEntity); 
		}*/
		return $anyDataEntity;
	}
}

?>