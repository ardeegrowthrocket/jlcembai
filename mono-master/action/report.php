<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
if($_SESSION['role']!=1)
{
	#	exit("hey your not allowed here");
}
if($_GET['task']=='')
{
	
	include($_GET['pages']."/main.php");
}
if($_GET['task']!='')
{
	echo "<a href='?pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/".$_GET['task'].".php");
}


?>
