<?php
error_reporting(E_ALL & ~E_NOTICE);
function mysql_query($q){

		$mysqli = new mysqli("localhost","root","","jlc");

		// Check connection
		if ($mysqli -> connect_errno) {
		  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
		  exit();
		}

		// Perform query
		if ($result = $mysqli -> query($q)) {
		  // Free result set
		  
		}

		$mysqli -> close();

		return $result;
}

function mysql_num_rows($result){
	return mysqli_num_rows($result);
}

function mysql_fetch_assoc($result){
	return mysqli_fetch_assoc($result);
}

function mysql_fetch_array($result){
	return mysqli_fetch_assoc($result);
}


function percentget($value){
	return ($value / 100);
 }

 function formatedateinput($date){
 	return date("Y-m-d",strtotime($date));
}




function generatedate($postarray){



if($postarray['payment_type']=='cutoff'){

	$given_date = strtotime($postarray['loan_start']);
	$given_date_nearcutoff = strtotime(date("Y-m-15",strtotime($postarray['loan_start'])));
	$current_date =strtotime(date("Y-m-d"));
	$given_num = $postarray['loop_number'];



	if($given_date>=$given_date_nearcutoff)
	{
		$payment[] = date("Y-m-t",$given_date);
	}
	else
	{	
		$payment[] = date("Y-m-15",$given_date);
		$payment[] = date("Y-m-t",$given_date);
		//$given_date = strtotime('+1 month', $given_date);
	}
	$counter = 0;


	$given_date = strtotime('+1 month', $given_date);


	for ($i = count($payment) + 1; $i <= $given_num; $i++) {
	$counter++;
	if($counter==1){
		$for_end = ($given_date);
	}else{
		$for_end = strtotime('+'.($counter - 1).' month', $given_date);
	}
	

    $payment[] = date('Y-m-15', $for_end);
	$i++;
	if($i<=$given_num){
	$payment[] = date('Y-m-t', $for_end); 		
	}




	}




}

if($postarray['payment_type']=='monthly'){

$given_date = strtotime($postarray['loan_start']);
$is_end = 0;
if($given_date == strtotime(date("Y-m-t",$given_date)))
{
	$given_date = strtotime(date("Y-m",$given_date));
	$is_end = 1;
}
$current_date =strtotime(date("Y-m-d"));






$payment[] = date('Y-m-d', strtotime($postarray['loan_start']));

$given_num = $postarray['loop_number'];


// $given_date = strtotime('now');
$given_day = $postarray['helper'];

// $for_start = strtotime('Friday', $given_date);
$for_start = strtotime($given_date);
$for_end = strtotime('+'.$given_num.' month', $given_date);
// $for_end = strtotime($postarray['edate']);
for ($i = 2; $i <= $given_num; $i++) {

	$for_end = strtotime('+'.($i - 1).' month', $given_date);
	if($is_end){
		$payment[] = date('Y-m-t', $for_end);
	}else{
		$payment[] = date('Y-m-d', $for_end);
	}
    
}


}
if($postarray['payment_type']=='weekly'){

$given_date = strtotime($postarray['loan_start']);


// $given_date = strtotime('now');
$given_day = $postarray['helper'];
$given_num = $postarray['loop_number'];
// $for_start = strtotime('Friday', $given_date);
$for_start = strtotime($given_day, $given_date);
$for_end = strtotime('+'.$given_num.' week', $given_date);
// $for_end = strtotime($postarray['edate']);
for ($i = $for_start; $i <= $for_end; $i = strtotime('+1 week', $i)) {
    $payment[] = date('Y-m-d', $i);
}

}

	return $payment;
}
?>