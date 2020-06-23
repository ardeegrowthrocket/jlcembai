<?php
   $primary = "id";
   $tbl = "tbl_system";
   $query  = mysql_query_md("SELECT * FROM $tbl");
   while($row=mysql_fetch_md_assoc($query))
   {

          $sdata[$row['code']] = $row['value'];
      
   }



$field[] = array("type"=>"editor","value"=>"mission");
$field[] = array("type"=>"editor","value"=>"vision");
$field[] = array("type"=>"text","value"=>"email","label"=>"Receiver of contact form.");
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

         <?php echo multiformconfig("mutualterms","Mutual Fund Years",$sdata['mutualterms']); ?>


         <?php echo multiformconfig("weeklyterms","Weekly Statics",$sdata['weeklyterms']); ?>

         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='Save Configuration'></center>
      </form>
   </div>
</div> 
