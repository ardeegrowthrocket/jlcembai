﻿<?php
if(!empty($_GET['uid'])){
   $primary = "id";
   $pid = $_GET['uid'];
   $tbl = "tbl_members";
   $query  = mysql_query("SELECT * FROM $tbl WHERE $primary='$pid'");
   while($row=mysql_fetch_assoc($query))
   {
      foreach($row as $key=>$val)
      {
          $sdata[$key] = $val;
      }
   }

   $query  = mysql_query("SELECT * FROM tbl_loan WHERE $primary='{$_GET['id']}'");
   while($row=mysql_fetch_assoc($query))
   {
      foreach($row as $key=>$val)
      {
          $sdata[$key] = str_replace("00:00:00","",$val);
      }
   }



   if($sdata['loan_date']){
      $sdata['loan_date'] = formatedateinput($sdata['loan_date']);
   }
   if($sdata['loan_start']){
      $sdata['loan_start'] = formatedateinput($sdata['loan_start']);
   }

}


for($i=1;$i<=24;$i++){
   if($i==1){
      $terms[$i] = "$i month";
   }else{
      $terms[$i] = "$i months";
   }
   
}

$ptype = array();

$ptype['monthly'] = "Monthly";
$ptype['weekly'] = "Weekly";
$ptype['cutoff'] = "Cutoff (every 15th and end of month)";




$week = array();

$week['monday'] = "Monday";
$week['tuesday'] = "Tuesday";
$week['wednesday'] = "Wednesday";
$week['thursday'] = "Thursday";
$week['friday'] = "Friday";
$week['saturday'] = "Saturday";
$week['sunday'] = "Sunday";


$release = array();
$release['0'] = "No";
$release['1'] = "Yes";


$field[] = array("type"=>"select","value"=>"loandesc","label"=>"Loan Class","option"=>getarrayconfig('loanclass'));
$field[] = array("type"=>"select","value"=>"loan_type","option"=>array("Collateral"=>"Collateral","Not Collateral"=>"Not Collateral"),"label"=>"Type of Loan");
$field[] = array("type"=>"number","value"=>"amount","attributes"=>array("onkeyup"=>"autogenloan()"));
$field[] = array("type"=>"number","value"=>"interest","label"=>"Interest (%)","attributes"=>array("onkeyup"=>"autogenloan()"));
$field[] = array("type"=>"number","value"=>"interest_amount","label"=>"Interest Amount","attributes"=>array("readonly"=>"readonly"));
$field[] = array("type"=>"number","value"=>"net","label"=>"Net Amount","attributes"=>array("readonly"=>"readonly"));
$field[] = array("type"=>"number","value"=>"penalty","label"=>"Penalty Rate (%)");
$field[] = array("type"=>"select","value"=>"terms","label"=>"Number of Months","option"=>getarrayconfig('loanterms'));

$field[] = array("type"=>"select","value"=>"payment_type","label"=>"Payment Type","option"=>$ptype);
$field[] = array("type"=>"select","value"=>"helper","label"=>"What days of week(for weekly payment)","option"=>$week);
$field[] = array("type"=>"date","value"=>"loan_date","label"=>"Loan Date");
$field[] = array("type"=>"date","value"=>"loan_start","label"=>"Payment Start Date");
$field[] = array("type"=>"text","value"=>"remarks");
$field[] = array("type"=>"select","value"=>"is_release","label"=>"Loan Is Released?","option"=>$release);


$show = 1;
if($sdata['is_release']){
   $show = 0;
   $sdata['is_release'] = "Yes";
}

$show = 0;
?>
<h2>Delete Loan - <?php echo  $sdata['name']; ?></h2>

<?php
if($show) {
?>
<p>Warning: If you click the Loan is release to "Yes" you will not able to change anything and it will create a autommated scheduled payment</p>
<?php } ?>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>-delete'>
      <input type='hidden' name='user' value='<?php echo $_GET['uid'];?>'>
      <input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
         
         <?php echo loadform($field,$sdata,$show); ?>

         <hr>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='Delete Loan'></center>
      </form>
   </div>
</div> 

