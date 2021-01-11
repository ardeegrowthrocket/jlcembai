<?php


function createcsv($list,$csvname){

$file = fopen("uploads/{$csvname}.csv","w");
if(empty($list)){
	return;
}
foreach ($list as $line) {

	#var_dump($list);

  fputcsv($file, $line);
}

fclose($file);
}




function getbaseme()
{
	$q = mysql_query_md("SELECT * FROM tbl_core_config_data WHERE path='web/unsecure/base_url'");
	$row = mysql_fetch_md_array($q);
	return $row['value'];
}
	function countfield($field,$value)
	{
		$query = mysql_query_md("SELECT * FROM tbl_accounts WHERE $field='$value'");
		return mysql_num_rows_md($query);
	}


	function loadmember($id){

		$query = mysql_query_md("SELECT * FROM tbl_members WHERE id='$id'");
		return mysql_fetch_md_array($query);

	}

	function loadrow($table,$field,$id){

		$query = mysql_query_md("SELECT * FROM $table WHERE $field='$id'");
		return mysql_fetch_md_array($query);

	}


	function formquery($post)
	{
	$return = array();
	foreach($post as $key=>$val)
	{
		$return[] = "$key='$val'";
	}
	 return implode(",",$return);
	}

	function randid()
	{
		return rand().strtotime("now");
	}
	function totalaccount()
	{
		$query = "SELECT username,accounts_id as aid,(SELECT COUNT(id) FROM tbl_cycle WHERE account_link = aid AND cycle_count=1 AND cycle_link = 0) as totalacct,account_count FROM tbl_accounts as acct
		JOIN tbl_package as pck WHERE pck.package_id = acct.package_id
		HAVING totalacct < account_count LIMIt 1";
		return mysql_query_md($query);

	}

	function autocreateaccount()
	{
		return;
		while($row=mysql_fetch_md_assoc(totalaccount()))
		{
			$limit  = $row['account_count'] - $row['totalacct'];
			$aid = $row['aid'];
			for ($x = 1; $x <= $limit; $x++) {
				$username = $row['username']."-".randid();
				mysql_query_md("INSERT INTO tbl_cycle SET username='$username',account_link='$aid',cycle_count='1',cycle_link='0'");
			}			
			return;
		}
	}
	function autodetectparent()
	{
		$query ="SELECT username,account_link,cycle_count,id as alink,(SELECT COUNT(id) FROM tbl_relation WHERE parent = alink) as checkparent FROM tbl_cycle HAVING checkparent < 2    ORDER by id ASC LIMIT 1 ";
		return mysql_query_md($query);
	}
	function autodetectchild($parentid)
	{
	$query = "SELECT username,account_link,cycle_count,id as alink,(SELECT COUNT(id) FROM tbl_relation WHERE child = alink) as checkchild FROM tbl_cycle WHERE id!=$parentid AND id > $parentid HAVING checkchild = 0 ORDER by id ASC LIMIT 1";
		return mysql_query_md($query);
	}
	function loadcycle($id)
	{
		$q = mysql_query_md("SELECT * FROM tbl_cycle WHERE id='$id'");
		$row = mysql_fetch_md_assoc($q);
		return $row;
	}
	function getRate($id)
	{
		$q = mysql_query_md("SELECT cycle_earn FROM tbl_package WHERE package_id='$id'");
		$row = mysql_fetch_md_assoc($q);
		return $row['cycle_earn'];
	}	
	function getUserPackage($id)
	{
		$q = mysql_query_md("SELECT package_id FROM tbl_accounts WHERE accounts_id='$id'");
		$row = mysql_fetch_md_assoc($q);
		return $row['package_id'];		
	}
	function addmoney($uid,$rate)
	{
		mysql_query_md("UPDATE tbl_accounts SET balance = balance + $rate WHERE accounts_id=$uid");
	}
	function totalbalance($uid,$rate)
	{
		mysql_query_md("UPDATE tbl_accounts SET total_earnings = total_earnings + $rate WHERE accounts_id=$uid");
	}	
	function exitlabel($id)
	{
		mysql_query_md("UPDATE tbl_cycle SET cycle_status = 1 WHERE id=$id");
	}
	function cycleinc($id)
	{
		$user = loadcycle($id);
		$inc = $user['cycle_count'] + 1;
		exitlabel($id);
		
		$userpackage = getUserPackage($user['account_link']);
		$rate = getRate($userpackage);
		totalbalance($user['account_link'],$rate);	 	
		if($inc==4)
		{
			addmoney($account_link,($rate * 3));	
			$username = "adminbonus-".randid();
			$account_link = 1;
			$cycle_count = 1;
			$cycle_link = 0;
			mysql_query_md("INSERT INTO tbl_cycle SET username='$username',account_link='$account_link',cycle_count='$cycle_count',cycle_link='$cycle_link'");			
		}
		else
		{
			$username = $user['username']."-".$inc;
			$account_link = $user['account_link'];
			$cycle_count = $inc;
			if($user['cycle_link']==0)
			{
				$cycle_link =$id;
			}
			else{
				$cycle_link = $user['cycle_link'];
			}
			
			

			$q = mysql_fetch_md_assoc(mysql_query_md("SELECT COUNT(id) as chet FROM tbl_cycle WHERE username='$username' AND account_link='$account_link' AND cycle_count='$cycle_count' AND cycle_link='$cycle_link'"));
			if($q['chet']==0):
			mysql_query_md("INSERT INTO tbl_cycle SET username='$username',account_link='$account_link',cycle_count='$cycle_count',cycle_link='$cycle_link'");
			endif;
		}
	}
	function cycleevent($row)
	{
		$rowx = mysql_fetch_md_assoc(autodetectchild($row['alink']));
		$parent = $row['alink'];
		$child = $rowx['alink'];
		if($child!='')
		{
			mysql_query_md("INSERT INTO tbl_relation SET parent='$parent',child='$child'");
			$q = mysql_fetch_md_assoc(mysql_query_md("SELECT COUNT(parent) as chet FROM tbl_relation WHERE parent='$parent'"));
			if($q['chet']==2)
			{
				cycleinc($parent);
			}
		}
		
	}
function mytimestamp()
{
	return date('Y-m-d H:i:s');
} 

function getrow($var)
{
	$array['title'] = 'Joint Lineage Microfinancing';
	$array['image'] = 'logo.png';
	return $array;
}	



function countquery($query)
{
	$q = mysql_query_md($query);
	return mysql_num_rows_md($q);
}

function getpackagelist()
{
   $packrowq = mysql_query_md("SELECT * FROM tbl_package");
   while($packrow = mysql_fetch_md_assoc($packrowq))
   {
    $options[$packrow['package_id']] = $packrow['package_name'];
   }
   return $options;	
}

function getwheresearchv2($field)
{

if($_GET['pages']=='report'){

}

else{
	array_push($field,"stores");
}



  $where = "WHERE ";
  $warray = array();
  $warray2 = array();

  if($_GET['search']!='')
  {
    $search = $_GET['search'];
   
    foreach($field as $f)
    {
        $warray[]  = "$f LIKE '%$search%'";
    }
  }

  $matic = 0;
  foreach($field as $f){
  		if(!empty($_GET[$f])){
  			$warray2[]  = "$f = '{$_GET[$f]}'";
  		}		

  }



if($_GET['pages']=='report'){


	//$warray2[]  = "tips.stores = '{$_SESSION['stores']}'";
}



else{

	$warray2[]  = "stores = '{$_SESSION['stores']}'";
}








  if(count($warray)){
  	$where .= "(".implode(" OR ", $warray).")";
  }
  
   if(count($warray2)){
   	if(count($warray)){
   		$where .= " AND ";

   	}
  	$where .= implode(" AND ", $warray2)." ";
  }


  if(trim($where)=='WHERE'){
  		return ;
  	}

  return $where;	
}

function getwheresearch($field)
{

return getwheresearchv2($field);


  $where = "WHERE";
  if($_GET['search']!='')
  {
    $search = $_GET['search'];
   
    $where = "WHERE";

    foreach($field as $f)
    {
        $where .= " $f LIKE '%$search%' OR";
    }
        $where .= " 1=1";
        $where = str_replace("OR 1=1","",$where);
  }

$matic = 0;
  foreach($field as $f){

  		if(!empty($_GET[$f])){
  			$where .= " $f = '{$_GET[$f]}' OR";	
  		}		
  		$matic++;

  }
  	if(!empty($matic)){

 	$where .= " OR 1=1 ";
	$where = str_replace("OR 1=1","",$where);

  	}
  	if(trim($where)=='WHERE'){
  		return ;
  	}
  	echo $where;
  return $where;	
}

function getlimit($limit,$page)
{
	if($page=='')
	{
		$page = 0;
	}
	else
	{
		$page--;
	}
	$limitx = $limit * $page;

	return "LIMIT $limitx,$limit";
}
function getpagecount($total,$limit)
{
	return (ceil($total/$limit));
}










function csv()
{
		header('Content-Type: text/csv; charset=utf-8');

		header('Content-Disposition: attachment; filename=payout-'.$_GET['r']."-".rand().'.csv');

		// create a file pointer connected to the output stream

		$output = fopen('php://output', 'w');

		if($_GET['r']=='bank')

		{

		$rows = mysql_query_md("SELECT b.accounts_id,b.username,transnum,email,amount,bank_name,bank_accountnumber,bank_accountname FROM  tbl_withdraw_history as a JOIN tbl_accounts as b WHERE claim_status=0 AND a.accounts_id=b.accounts_id AND claimtype='".$_GET['r']."'

		");

		$array = explode(",","accounts_id,username,transnum,email,amount,bank_name,bank_accountnumber,bank_accountname");	

		}




		if($_GET['r']=='pickup')

		{

		$rows = mysql_query_md("SELECT b.accounts_id,b.username,transnum,email,amount FROM  tbl_withdraw_history as a JOIN tbl_accounts as b WHERE claim_status=0 AND a.accounts_id=b.accounts_id AND claimtype='".$_GET['r']."'");

		$array = explode(",","accounts_id,username,transnum,email,amount");	

		}







		fputcsv($output,$array);

		// loop over the rows, outputting them

		while ($row = mysql_fetch_md_assoc($rows)) 

		{

		foreach($row as $key=>$val)

		{

		$row[$key] = "\"".$val."\"";

		}

		fputcsv($output, $row);

		}	
}



?>