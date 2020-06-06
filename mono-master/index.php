<?php
session_start();
include("connect.php");
include("function.php");
if($_SESSION['accounts_id']=='')
{
exit("<script> window.location='login.php' </script>");
}
$main = getrow("tbl_logo");
$tablerowxxx = "tbl_accounts";
$queryrowxxx = "SELECT * FROM $tablerowxxx WHERE accounts_id='".$_SESSION['accounts_id']."'";
$qrowxxx = mysql_query_md($queryrowxxx);
$rowxxx = mysql_fetch_md_assoc($qrowxxx);
foreach($rowxxx as $key=>$val)
{
$_SESSION[$key] = $val;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $main['title'];?> - Dashboard</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
   <link type="text/css" rel="stylesheet" href="assets/js/jquery-te-1.4.0.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">


   <style>
    @media (min-width: 1024px){
        .navbar {
            display:none;
        }
    }
   input[type="number"],input[type="date"],input[type="text"],input[type="email"] ,select , textarea , input[type="password"] {
      width:300px;
      height: 30px;
   }
   textarea {
    height: 150px;
   }
   tr.members-loan-helper  ,tr.members-loan-edit-helper{
    display: none;
}

input[readonly="readonly"]{
    background-color:#d6d6d6;
}
input.btn.btn-primary.btn-sm {
    width: 100%;
    margin-top: 5px;
}
.editor{
  height:250px;
}
.jqte_tool.jqte_tool_1 .jqte_tool_label {
  height:35px;
  }



  input.btn.btn-primary.btn-lg {
    margin-top: 16px;
}
   </style> 
</head>
<body>
    <div id="wrapper">
<div id="fade"></div>
<div id='fade2' class='fademe'>test</div>
<?php
include("inc/top.php");
include("inc/menu.php");
?>
<div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div id="maindash" class="col-md-12">
					
<?php
if($_SESSION['noti']){
    $noti = $_SESSION['noti'];
     unset($_SESSION['noti']);
    ?>
<div class="noti">
    <ul class="fa-ul">
        <li><i class="fa fa-check fa-li"></i>
           <?php echo $noti; ?>
        </li>
    </ul>
</div>
    <?php
   
}
		$currpage = $_GET['pages'];
		if($currpage=='')
		{
			$currpage = 'dashboard';
		}
		include("action/".$currpage.".php");
?>

  
					 
					 
					 
					 
					 
		 
					 
					 
					 
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/dataTables/jquery.dataTables.js"></script>
     <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

<script type="text/javascript" src="assets/js/jquery-te-1.4.0.min.js" charset="utf-8"></script>

<script>

jQuery(document).ready( function() {
jQuery('#dataTables-example').dataTable( {
 "paginate": false,
 "sort": false,
});
});

jQuery(document).ready( function() {
jQuery('.editor').jqte();
jQuery('#tabs').tabs();
});
</script>
<script>
jQuery( document ).ready(function() {
jQuery( "#payment_type" ).change(function() {
  if(jQuery( "#payment_type" ).val()=="weekly"){
      jQuery("tr.members-loan-helper").show();
      jQuery("tr.members-loan-edit-helper").show();
      jQuery("tr.members-mutual-helper").show();
      jQuery("tr.members-mutual-edit-helper").show();

  }else{
       jQuery("tr.members-loan-helper").hide();
       jQuery("tr.members-loan-edit-helper").hide();
       jQuery("tr.members-mutual-helper").hide();
       jQuery("tr.members-mutual-edit-helper").hide();       
  }
});

jQuery( "#payment_type" ).trigger('change');

});


function autogenloan(){

//interest_amount  net
  if(jQuery('#amount').length){
    var amount = parseFloat(jQuery('#amount').val());
    var interest = parseFloat(jQuery('#interest').val()) / 100;

    var interest_amount = interest * amount;
    var net = interest_amount + amount;


    jQuery('#interest_amount').val(interest_amount.toFixed(2));
    jQuery('#net').val(net.toFixed(2));

  }


}

function addtable(data){

  var newid = jQuery('.tbodyconfig'+data+' tr').length + 2;

  jQuery('.tbodyconfig'+data).append("<tr class='tr-"+data+"-"+newid+"'><td><input type='text' name='"+data+"["+newid+"][label]'></td><td><input type='text' name='"+data+"["+newid+"][value]'></td><td><a onclick='removeme(\"tr-"+data+"-"+newid+"\")' href='javascript:void(0)'>Remove</a></td></tr>");

}

function removeme(data){
  jQuery('.'+data).remove();
}


function printData(idtoprint)
{
   var divToPrint=document.getElementById(idtoprint);
   newWin= window.open("");
   var header = '';
   if(jQuery('.headerprint').html()){
    header = jQuery('.headerprint').html();
   }
   newWin.document.write(header+divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

</script>
 
   
</body>
</html>
