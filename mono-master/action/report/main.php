<?php
 #$_GET['is_paid'] = 'yes';  
 $field = array("amount","remarks","is_paid");
 $where = getwheresearch($field);


 $datefield = "actual";


 if($_GET['date1'] == ''){
  $_GET['date1'] = date("Y-m-d");
 }

 if($_GET['date1'] != ''){

    if(empty($where)){

      $where = "WHERE $datefield LIKE '%{$_GET['date1']}%'";
    }else{

      $where .= "AND $datefield LIKE '%{$_GET['date1']}%'";
    }

 }




 $total = countquery("SELECT id FROM (SELECT id,user_id,actual,(payment + penalty + savings) as amount,createdby,(1) as tips FROM tbl_schedule
UNION
SELECT id,user_id,actual,(payment + penalty + savings) as amount,createdby,(2) as tips FROM tbl_schedule_mutual
UNION
SELECT id,user,actual,amount,createdby,(3) as tips FROM tbl_passbook) as tbl $where");


 #echo $where;

 //primary query
 $limit = getlimit(10000,$_GET['p']);

$query = "SELECT * FROM (SELECT id,user_id,actual,(payment + penalty + savings) as amount,createdby,(1) as tips FROM tbl_schedule
UNION
SELECT id,user_id,actual,(payment + penalty + savings) as amount,createdby,(2) as tips FROM tbl_schedule_mutual
UNION
SELECT id,user,actual,amount,createdby,(3) as tips FROM tbl_passbook) as tbl $where ORDER by actual ASC  $limit";

 $q = mysql_query_md($query);
 $pagecount = getpagecount($total,10000);


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
<h2>Daily Collection</h2>
<div class="panel panel-default">
   <div class="panel-body">
         <div class="row">

            <div class="col-md-12">
               <div class="panel panel-default">
                  <div class="panel-body">
                    Filter the date per day.


                    <form method=''>
                    <table>
<!--                       <tr>
                        <td>Search Keyword:</td>
                        <td><input type='text' value='<?php echo $_GET['search']; ?>' name='search'></td>
                      </tr>


                      <tr>
                        <td>From:</td>
                        <td><input type='date' value='<?php echo $_GET['date1']; ?>' name='date1'></td>
                      </tr>  -->                  
                      <tr>
                        <td>To:</td>
                        <td><input type='date' value='<?php echo $_GET['date1']; ?>' name='date1'></td>
                      </tr>    


                    </table>
                    <br/>
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
                  <th>Remarks</th>
                  <th>Amount</th> 
                  <th>C/O</th>  
               </tr>
            </thead>
            <tbody>
               <?php
                  while($row=mysql_fetch_md_array($q))
                  {
                    $pid = $row['id'];
                  ?>
               <tr>
                  <td><?php echo $row['tips']; ?></td>
                  <td><?php echo number_format($row['amount'],2); ?></td>
                  <td><?php echo $row['createdby']; ?></td>
                  
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
                          $url = "?search=".$_GET['search']."&pages=".$_GET['pages']."&search_button=Submit&p=".$c;
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
