<?php
if(!empty($_GET['id'])){
   $primary = "id";
   $pid = $_GET['id'];
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



$field[] = array("type"=>"text","value"=>"name");
$field[] = array("type"=>"text","value"=>"age");
$field[] = array("type"=>"text","value"=>"address");
$field[] = array("type"=>"text","value"=>"contact");
$field[] = array("type"=>"text","value"=>"spouse");
$field[] = array("type"=>"text","value"=>"occupation");
$field[] = array("type"=>"text","value"=>"dependents");


$field[] = array("skip"=>"text","label"=>"CO MAKER 1");
$field[] = array("type"=>"text","value"=>"name1","label"=>"Name");
$field[] = array("type"=>"text","value"=>"occupation1","label"=>"Occupation");
$field[] = array("type"=>"text","value"=>"address1","label"=>"Address");
$field[] = array("type"=>"text","value"=>"contact1","label"=>"Contact Number");

$field[] = array("skip"=>"text","label"=>"CO MAKER 2");
$field[] = array("type"=>"text","value"=>"name2","label"=>"Name");
$field[] = array("type"=>"text","value"=>"occupation2","label"=>"Occupation");
$field[] = array("type"=>"text","value"=>"address2","label"=>"Address");
$field[] = array("type"=>"text","value"=>"contact2","label"=>"Contact Number");

$field[] = array("skip"=>"text","label"=>"CUSTOM LABEL");
$field[] = array("type"=>"text","value"=>"custom_label","label"=>"Label");
?>
<h2>Members</h2>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
     <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>
     <input type='hidden' name='<?php echo $primary; ?>' value='<?php echo $sdata[$primary];?>'>

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
            <tr>
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

<?php require("./action/members/loan-list.php"); ?>