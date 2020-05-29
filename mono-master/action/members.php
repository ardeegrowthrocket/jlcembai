<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$tbl = "tbl_members";
$primary = "id";
/*SQL*/
$refresh = 0;
if($_POST['submit']!='' && $_POST['task']=='add')
{
	unset($_POST['submit']);
	unset($_POST['task']);
	$fields = formquery($_POST);
	mysql_query("INSERT INTO $tbl SET $fields");
	#setcookie('noti', "Done adding data",60, "/");

	$_SESSION['noti'] = "Done adding data.";

	$refresh = 1;
}

if($_POST['submit']!='' && $_POST['task']=='edit')
{
	unset($_POST['submit']);
	unset($_POST['task']);
	$fields = formquery($_POST);
	mysql_query("UPDATE $tbl SET $fields WHERE $primary=".$_POST[$primary]);
	#setcookie('noti', "Done editing data",60, "/");
	$_SESSION['noti'] = "Done editing data.";
	$refresh = 1;
}


if($_POST['submit']!='' && $_POST['task']=='delete')
{
	unset($_POST['submit']);
	unset($_POST['task']);
	$fields = formquery($_POST);
	mysql_query("DELETE FROM $tbl WHERE $primary=".$_POST[$primary]);
	$_SESSION['noti'] = "Done deleting data.";
	$refresh = 1;
}




if($_POST['submit']!='' && $_POST['task']=='loan-delete-delete')
{
	$tbl = "tbl_loan";
	mysql_query("DELETE FROM $tbl WHERE $primary=".$_POST[$primary]);
	$_SESSION['noti'] = "Done deleting loan data.";
	$refresh = 1;
	moveredirect("index.php?id={$_POST['user']}&task=edit&pages=members");
	exit();
}


if($_POST['submit']!='' && $_POST['task']=='processpay')
{
	$tbl = "tbl_schedule";
	mysql_query("UPDATE $tbl SET actual='{$_REQUEST['date_payment']}',savings='{$_REQUEST['savings_payment']}',penalty='{$_REQUEST['penalty_payment']}',remarks='{$_REQUEST['remarks_payment']}',is_paid='yes' WHERE id ='{$_REQUEST['schedule_id']}'");
	$_SESSION['noti'] = "Done marking the payment.";
	moveredirect($_POST['refer']."#loandataajax{$_REQUEST['schedule_id']}");
	exit();
}


if($_POST['submit']!='' && $_POST['task']=='loan-save')
{
	unset($_POST['submit']);
	unset($_POST['task']);
	$tbl = "tbl_loan";
	$_POST['loan_date'] = $_POST['loan_date']." 00:00:00";
	$_POST['loan_start'] = $_POST['loan_start']." 00:00:00";

	$_POST['net'] = $_POST['amount'] + ($_POST['amount'] * percentget($_POST['interest']));


	if($_POST['payment_type']=='weekly'){
		$_POST['loop_number'] =  ($_POST['terms'] * 4);
	}
	if($_POST['payment_type']=='monthly'){
		$_POST['loop_number'] =  ($_POST['terms'] * 1);
	}
	if($_POST['payment_type']=='cutoff'){
		$_POST['loop_number'] =  ($_POST['terms'] * 2);
	}


	$_POST['penalty_fee'] = ($_POST['amount'] * percentget($_POST['penalty'])) / $_POST['loop_number'];

	$_POST['loop_amount'] = $_POST['net'] / $_POST['loop_number'];

	$_POST['interest_amount'] = ($_POST['amount'] * percentget($_POST['interest']));
	
	$fields = formquery($_POST);
	$_SESSION['noti'] = "Done adding loan data.";
	$refresh = 1;
	$sqli = mysql_query_insert("INSERT INTO $tbl SET $fields");






	if($_POST['is_release']){

	
	$date = generatedate($_POST);




	foreach($date as $s){

		$array = array();

		$array['schedule'] = $s;
		$array['payment'] = $_POST['loop_amount'];
		$array['user_id'] = $_POST['user'];
		$array['loan_id'] = $sqli;
		$fieldsv2 = formquery($array);
		mysql_query("INSERT INTO tbl_schedule SET $fieldsv2");

	}




	}



	moveredirect("index.php?id={$sqli}&uid={$_POST['user']}&task=loan-edit&pages=".$_REQUEST['pages']);
	#moveredirect("index.php?id={$_POST['user']}&task=edit&pages=".$_REQUEST['pages']);





	exit();	
}

if($_POST['submit']!='' && $_POST['task']=='loan-edit-save')
{
	unset($_POST['submit']);
	unset($_POST['task']);
	$tbl = "tbl_loan";
	$_POST['loan_date'] = $_POST['loan_date']." 00:00:00";
	$_POST['loan_start'] = $_POST['loan_start']." 00:00:00";

	$_POST['net'] = $_POST['amount'] + ($_POST['amount'] * percentget($_POST['interest']));


	if($_POST['payment_type']=='weekly'){
		$_POST['loop_number'] =  ($_POST['terms'] * 4);
	}
	if($_POST['payment_type']=='monthly'){
		$_POST['loop_number'] =  ($_POST['terms'] * 1);
	}
	if($_POST['payment_type']=='cutoff'){
		$_POST['loop_number'] =  ($_POST['terms'] * 2);
	}


	$_POST['penalty_fee'] = ($_POST['amount'] * percentget($_POST['penalty'])) / $_POST['loop_number'];

	$_POST['loop_amount'] = $_POST['net'] / $_POST['loop_number'];

	$_POST['interest_amount'] = ($_POST['amount'] * percentget($_POST['interest']));
	$fields = formquery($_POST);
	$_SESSION['noti'] = "Done adding loan data.";
	$refresh = 1;







	if($_POST['is_release']){

	
	$date = generatedate($_POST);


	

	foreach($date as $s){

		$array = array();

		$array['schedule'] = $s;
		$array['payment'] = $_POST['loop_amount'];
		$array['user_id'] = $_POST['user'];
		$array['loan_id'] = $_POST['id'];
		$fieldsv2 = formquery($array);
		mysql_query("INSERT INTO tbl_schedule SET $fieldsv2");

	}




	}









	mysql_query("UPDATE $tbl SET $fields WHERE $primary=".$_POST[$primary]);
	moveredirect("index.php?id={$_POST['id']}&uid={$_POST['user']}&task=loan-edit&pages=".$_REQUEST['pages']);
	exit();	
}













/*SQL*/
if($refresh){
moveredirect("index.php?pages=".$_REQUEST['pages']);
exit();	
}

if($_SESSION['role']!=1)
{
	#	exit("hey your not allowed here");
}
if($_GET['task']=='')
{
	
	include($_GET['pages']."/main.php");
}
if($_GET['task']=='add')
{
	echo "<a href='?pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/add.php");
}
if($_GET['task']=='edit')
{
	echo "<a href='?pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/edit.php");
}
if($_GET['task']=='delete')
{
	echo "<a href='?pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/delete.php");
}


if($_GET['task']=='loan')
{
	echo "<a href='?id={$_GET['uid']}&task=edit&pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/loan.php");
}
if($_GET['task']=='loan-edit')
{
	echo "<a href='?id={$_GET['uid']}&task=edit&pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/loan-edit.php");
}
if($_GET['task']=='loan-delete')
{
	echo "<a href='?id={$_GET['uid']}&task=edit&pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/loan-delete.php");
}
?>
