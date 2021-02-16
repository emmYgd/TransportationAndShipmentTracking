<?php
/*require('rb.php');
R::setup();

$test = R::dispense('test');
$test->fav_food = 'rice';
$test->fav_color = 'red';
$test->fav_place = 'church';

R::store($test);*/

//retrieve:
//$test = R::findAll('test');
//echo($test);

/*try{
	$bytes = str_shuffle("Coolguy");
	$rand = md5(time());
	//echo($rand);

	$resp = [
		"status" => "notFound",
		"message" => 200
	];

	echo json_encode($resp);

	if($rand !== 0){
		throw new Exception("Error here");
	}
}catch(Exception $ex){
	echo $ex->getMessage();
}
?>
*/

/*$bearer_string = "";

$bytes = str_shuffle(str_shuffle($bearer_string));
echo $bytes;*/

//echo password_hash('', PASSWORD_DEFAULT);
?> 

<br/>

<?php  
//echo password_hash('', PASSWORD_DEFAULT); 
?>

<br/>

<?php  

$value1 = md5(md5(''));

echo $value1;

?>
<br/>

<?php

$value2 = md5(md5('')); 

echo $value2;

?>
<br/>
<?php
$value3 = md5(md5('')); 

echo $value3;

?>

<br/>

<?php

if($value1 == $value2){

	echo "Both are equal!";

}else{
	echo "Not equal";
}
?>
