﻿<?php
 $field = array("amount","terms","remarks","penalty","interest");
 $where = getwheresearch($field);
 $total = countquery("SELECT id FROM tbl_loan WHERE user='{$_GET['id']}'");
 //primary query
 $limit = getlimit(10,$_GET['p']);
 $query = "SELECT * FROM tbl_loan $where $limit";

 $q = mysql_query($query);
 $options = getpackagelist();
 $pagecount = getpagecount($total,10);


$field_data = array();
foreach($field as $ff){
    $field_data[] = ucfirst(str_replace("_", " ", $ff));
}
?>
<style>
#dataTables-example_filter , #dataTables-example_info , #dataTables-example_wrapper .row
{
    display:none;
}
</style>
<h2>Loans</h2>
<div class="panel panel-default">
   <div class="panel-body">
         <div class="row">
            <div class="col-md-3">
               <div class="panel panel-default">
                  <div class="panel-body">
                    <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=loan&uid={$_GET['id']}"; ?>';" type="button" class="btn btn-primary" value="Add New Loan">
                  </div>
               </div>
            </div>
            <div class="col-md-9">
               <div class="panel panel-default">
                  <div class="panel-body">
                    Search by: <?php echo (implode(", ", $field_data)); ?>
                    <form method=''>
                    <input type='text' value='<?php echo $_GET['search']; ?>' name='search'>
                    <input type='hidden' name='pages' value='<?php echo $_GET['pages'];?>'>
                    <input type='submit' name='search_button' class="btn btn-primary"/>
                    </form>
                  </div>
               </div>
            </div>            
         </div>    
      <div class="table-responsive">

         
         <br/>
         <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
            <thead>
               <tr role='row'>
                  
                  <th>Loan Amount</th>
                  <th>Net Amount</th>
                  <th>Terms</th>
                  <th>Remarks</th>
                  <th>Interest</th>
                  <th>Penalty</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  while($row=mysql_fetch_array($q))
                  {
                    $pid = $row['id'];
                    $roledata = ($row['role'] >= 1 ? 'Administrator' : 'Teller');
                  ?>
               <tr>
                  <td><?php echo number_format($row['amount'],2); ?></td>
                  <td><?php echo number_format($row['amount'] + ($row['amount'] * percentget($row['interest'])),2);  ?></td>
                  <td><?php echo $row['terms']; ?></td>
                  <td><?php echo $row['remarks']; ?></td>
                  <td><?php echo $row['interest']; ?>%</td>
                  <td><?php echo $row['penalty']; ?>%</td>
                  <td>
                     <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=loan-edit&id=$pid&uid={$_GET['id']}"; ?>';" type="button" class="btn btn-primary btn-sm" value="Edit">
                     <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=delete&id=$pid"; ?>';" type="button" class="btn btn-primary btn-sm" value="Delete">
                  </td>
               </tr>
               <?php
                  }
                  ?>
            </tbody>
         </table>
      </div>
            <div class="row">
               <div class="col-sm-6">
                  <div class="dataTables_paginate paging_simple_numbers">
                     <ul class="pagination">
                      <?php
                        for($c=1;$c<=$pagecount;$c++)
                        {
                          $active = '';

                          if($_GET['p']=='' && $c==1)
                          {
                            $active = 'active';
                          }
                          if($c==$_GET['p'])
                          {
                            $active = 'active';
                          }
                          $url = "?&id={$_GET['id']}&task=edit&search=".$_GET['search']."&pages=".$_GET['pages']."&search_button=Submit&p=".$c;
                      ?>
                        <li class="paginate_button <?php echo $active; ?>" aria-controls="dataTables-example" tabindex="0"><a href="<?php echo $url; ?>"><?php echo $c; ?></a></li>
                      <?php
                        }
                      ?>
                     </ul>
                  </div>
               </div>
            </div>      
   </div>
</div>
