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
?>