<?php
include("connect.php");
include("function.php");

$sqlquery = "SELECT a.id as myid ,(SELECT SUM(amount) FROM tbl_passbook WHERE actual BETWEEN '2020-09-29 10:15:55' AND '2021-01-01 14:15:55' AND user=myid AND ptype!='withdraw') as totaladd, (SELECT SUM(amount) FROM tbl_passbook WHERE actual BETWEEN '2020-09-29 10:15:55' AND '2021-01-01 14:15:55' AND user=myid AND ptype='withdraw') as totalsubtract FROM `tbl_members` as a  
ORDER BY `myid`  DESC";



if(date("W")=="02" && date("m")=="01" && date("l")=="Monday"){

$end =  date("Y-m-d h:i:s");
$date=date_create($end);
date_sub($date,date_interval_create_from_date_string("5 months"));
$start = date_format($date,"Y-m-t h:i:s");


$sqlquery = "SELECT a.stores,a.id as myid ,(SELECT SUM(amount) FROM tbl_passbook WHERE actual BETWEEN '{$start}' AND '{$end}' AND user=myid AND ptype!='withdraw') as totaladd, (SELECT SUM(amount) FROM tbl_passbook WHERE actual BETWEEN '{$start}' AND '{$end}' AND user=myid AND ptype='withdraw') as totalsubtract FROM `tbl_members` as a ORDER BY `myid` DESC";


$q = mysql_query_md($sqlquery);

while($row=mysql_fetch_md_array($q)){
	$final = $row['totaladd'] - $row['totalsubtract'];

	if($final >= 100000){
			$percent = 4;
	}else{

			$percent = 1;

	}
	$formula = $percent / 100;
	$dividend = $final * $formula;

	echo $dividend;

    $tbl = "tbl_passbook";
	$sqli = mysql_query_md_insert("INSERT INTO $tbl SET createdby='system',actual='{$end}',amount='{$dividend}',remarks='n-a',ptype='dividend',user='{$row['myid']}',stores='{$row['stores']}'");

}


}







if(date("W")=="02" && date("m")=="04" && date("l")=="Monday"){

$end =  date("Y-m-d h:i:s");
$date=date_create($end);
date_sub($date,date_interval_create_from_date_string("5 months"));
$start = date_format($date,"Y-m-t h:i:s");


$sqlquery = "SELECT a.stores,a.id as myid ,(SELECT SUM(amount) FROM tbl_passbook WHERE actual BETWEEN '{$start}' AND '{$end}' AND user=myid AND ptype!='withdraw') as totaladd, (SELECT SUM(amount) FROM tbl_passbook WHERE actual BETWEEN '{$start}' AND '{$end}' AND user=myid AND ptype='withdraw') as totalsubtract FROM `tbl_members` as a ORDER BY `myid` DESC";


$q = mysql_query_md($sqlquery);

while($row=mysql_fetch_md_array($q)){
	$final = $row['totaladd'] - $row['totalsubtract'];

	if($final >= 100000){
			$percent = 4;
	}else{

			$percent = 1;

	}
	$formula = $percent / 100;
	$dividend = $final * $formula;

	echo $dividend;

    $tbl = "tbl_passbook";
	$sqli = mysql_query_md_insert("INSERT INTO $tbl SET createdby='system',actual='{$end}',amount='{$dividend}',remarks='n-a',ptype='dividend',user='{$row['myid']}',stores='{$row['stores']}'");

}


}






if(date("W")=="02" && date("m")=="07" && date("l")=="Monday"){

$end =  date("Y-m-d h:i:s");
$date=date_create($end);
date_sub($date,date_interval_create_from_date_string("5 months"));
$start = date_format($date,"Y-m-t h:i:s");


$sqlquery = "SELECT a.stores,a.id as myid ,(SELECT SUM(amount) FROM tbl_passbook WHERE actual BETWEEN '{$start}' AND '{$end}' AND user=myid AND ptype!='withdraw') as totaladd, (SELECT SUM(amount) FROM tbl_passbook WHERE actual BETWEEN '{$start}' AND '{$end}' AND user=myid AND ptype='withdraw') as totalsubtract FROM `tbl_members` as a ORDER BY `myid` DESC";


$q = mysql_query_md($sqlquery);

while($row=mysql_fetch_md_array($q)){
	$final = $row['totaladd'] - $row['totalsubtract'];

	if($final >= 100000){
			$percent = 4;
	}else{

			$percent = 1;

	}
	$formula = $percent / 100;
	$dividend = $final * $formula;

	echo $dividend;

    $tbl = "tbl_passbook";
	$sqli = mysql_query_md_insert("INSERT INTO $tbl SET createdby='system',actual='{$end}',amount='{$dividend}',remarks='n-a',ptype='dividend',user='{$row['myid']}',stores='{$row['stores']}'");

}


}





if(date("W")=="02" && date("m")=="10" && date("l")=="Monday"){

$end =  date("Y-m-d h:i:s");
$date=date_create($end);
date_sub($date,date_interval_create_from_date_string("5 months"));
$start = date_format($date,"Y-m-t h:i:s");


$sqlquery = "SELECT a.stores,a.id as myid ,(SELECT SUM(amount) FROM tbl_passbook WHERE actual BETWEEN '{$start}' AND '{$end}' AND user=myid AND ptype!='withdraw') as totaladd, (SELECT SUM(amount) FROM tbl_passbook WHERE actual BETWEEN '{$start}' AND '{$end}' AND user=myid AND ptype='withdraw') as totalsubtract FROM `tbl_members` as a ORDER BY `myid` DESC";


$q = mysql_query_md($sqlquery);

while($row=mysql_fetch_md_array($q)){
	$final = $row['totaladd'] - $row['totalsubtract'];

	if($final >= 100000){
			$percent = 4;
	}else{

			$percent = 1;

	}
	$formula = $percent / 100;
	$dividend = $final * $formula;

	echo $dividend;

    $tbl = "tbl_passbook";
	$sqli = mysql_query_md_insert("INSERT INTO $tbl SET createdby='system',actual='{$end}',amount='{$dividend}',remarks='n-a',ptype='dividend',user='{$row['myid']}',stores='{$row['stores']}'");

}


}

?>
