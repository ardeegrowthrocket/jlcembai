﻿<?php
$primary = "accounts_id";
$pid = $_GET['id'];
$tbl = "tbl_accounts";
$query  = mysql_query("SELECT * FROM $tbl WHERE $primary='$pid'");
while($row=mysql_fetch_assoc($query))
{
	foreach($row as $key=>$val)
	{
		 $sdata[$key] = $val;
	}
}
$field[] = array("type"=>"text","value"=>"username","label"=>"Username");
$field[] = array("type"=>"text","value"=>"password","label"=>"Password");
$field[] = array("type"=>"email","value"=>"email","label"=>"Email");
$field[] = array("type"=>"select","value"=>"role","label"=>"Role","option"=>array("0"=>"Teller","1"=>"Administrator"));
?>
<h2>Users</h2>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>
	  <input type='hidden' name='<?php echo $primary; ?>' value='<?php echo $sdata[$primary];?>'>
         <?php echo loadform($field,$sdata); ?>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='<?php echo ucwords($_GET['task']);?>'></center>
      </form>
   </div>
</div> 
