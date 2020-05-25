<?php
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

$field[] = array("type"=>"select","value"=>"loan_type","option"=>array("Collateral"=>"Collateral","Not Collateral"=>"Not Collateral"),"label"=>"Type of Loan");
$field[] = array("type"=>"number","value"=>"amount");
$field[] = array("type"=>"number","value"=>"interest","label"=>"Interest (%)");
$field[] = array("type"=>"number","value"=>"penalty","label"=>"Penalty Rate (%)");
$field[] = array("type"=>"select","value"=>"terms","label"=>"Number of Months","option"=>$terms);
$field[] = array("type"=>"select","value"=>"payment_type","label"=>"Payment Type","option"=>$ptype);
$field[] = array("type"=>"select","value"=>"helper","label"=>"What days of week(for weekly payment)","option"=>$week);
$field[] = array("type"=>"date","value"=>"loan_date","label"=>"Loan Date");
$field[] = array("type"=>"date","value"=>"loan_start","label"=>"Payment Start Date");
$field[] = array("type"=>"text","value"=>"remarks");
$field[] = array("type"=>"select","value"=>"is_release","label"=>"Loan Is Released?","option"=>$release);

?>
<h2>Add Loan - <?php echo  $sdata['name']; ?></h2>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>-save'>
      <input type='hidden' name='user' value='<?php echo $_GET['uid'];?>'>
         <table width="100%">
            <?php
               $is_editable_field = 1;
               foreach($field as $inputs)
               {

                                 if($inputs['label']!='')
                                 {
                                 $label = $inputs['label'];
                                 }
                                 else
                                 {
                                 $label = ucwords($inputs['value']);
                                 }
               ?>

               <?php
                     if($inputs['skip']){
                  ?>
                     <tr>
                        <td colspan="2"><hr></td>
                     </tr>
                      <tr>
                        <td colspan="2">
                           <strong><?php echo $inputs['label']; ?></strong>
                        </td>
                     </tr>                    
                      <tr>
                        <td colspan="2"><hr></td>
                     </tr>                    
                  <?php
                  continue;
                  }
               ?>
            <tr class='<?php echo $_GET['pages']; ?>-<?php echo $_GET['task']; ?>-<?php echo $inputs['value']; ?>'>
               <td style="width:180px;" class="key" valign="top" ><label for="accounts_name"><?php echo $label; ?><?php echo $req_fld?>:</label></td>
               <?php if ( $is_editable_field ) { ?>
               <td>
                  <?php
                     if ($inputs['type']=='select')
                     {                                                                                               
                        ?>
                  <select name="<?php echo $inputs['value']; ?>" id="<?php echo $inputs['value']; ?>" required <?php echo $inputs['attr']; ?>
                     >
                     <?php
                        foreach($inputs['option'] as $key=>$val)
                        {
                           ?>
                     <option <?php if($sdata[$inputs['value']]==$key){echo"selected='selected'";} ?> value='<?php echo $key;?>'><?php echo $val;?></option>
                     <?php
                        }
                        ?>
                  </select>
                  <span class="validation-status"></span>
                  <?php
                     }
                     else
                     {
                        ?>
                  <input required <?php echo $inputs['attr']; ?> type="<?php echo $inputs['type']; ?>" name="<?php echo $inputs['value']; ?>" id="<?php echo $inputs['value']; ?>" size="40" maxlength="255" value="<?php echo $sdata[$inputs['value']]; ?>" />
                  <span class="validation-status"></span>                                    
                  <?php
                     }
                     ?>
               </td>
               <?php } else { ?>
               <td><?php echo $sdata[$inputs['value']]; ?></td>
               <?php } ?>                                                                                                    
            </tr>
            <?php
               }
               ?>
         </table>

         <hr>

         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='<?php echo ucwords($_GET['task']);?>'></center>
      </form>
   </div>
</div> 
<style>
   input[type="number"],input[type="date"],input[type="text"] ,select{
      width:230px;
      height: 30px;
   }
   tr.members-loan-helper {
    display: none;
}
</style>
