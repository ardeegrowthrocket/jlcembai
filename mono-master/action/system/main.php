﻿<?php
   $primary = "id";
   $tbl = "tbl_system";
   $query  = mysql_query("SELECT * FROM $tbl");
   while($row=mysql_fetch_assoc($query))
   {

          $sdata[$row['code']] = $row['value'];
      
   }



$field[] = array("type"=>"editor","value"=>"mission");
$field[] = array("type"=>"editor","value"=>"vision");

#var_dump(generatedate($sdata));

?>
<h2>System Configuration</h2>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
    <input type='hidden' name='task' value='configsave'>
      <input type='hidden' name='user' value='<?php echo $_GET['uid'];?>'>
      <input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
         
         <?php echo loadform($field,$sdata); ?>

         <?php echo multiformconfig("loanclass","Loan Class",$sdata['loanclass']); ?>

         <?php echo multiformconfig("loanterms","Loan Terms",$sdata['loanterms']); ?>


         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='Edit Loan'></center>
      </form>
   </div>
</div> 