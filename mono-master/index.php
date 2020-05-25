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
$qrowxxx = mysql_query($queryrowxxx);
$rowxxx = mysql_fetch_assoc($qrowxxx);
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
   <style>
    @media (min-width: 1024px){
        .navbar {
            display:none;
        }
    }
   input[type="number"],input[type="date"],input[type="text"] ,select{
      width:230px;
      height: 30px;
   }
   tr.members-loan-helper  ,tr.members-loan-edit-helper{
    display: none;
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
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/dataTables/jquery.dataTables.js"></script>
     <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
	
<script>
jQuery(document).ready( function() {
jQuery('#dataTables-example').dataTable( {
 "paginate": false,
 "sort": true
});
});
</script>
<script>
jQuery( document ).ready(function() {

jQuery( "#payment_type" ).change(function() {
  if(jQuery( "#payment_type" ).val()=="weekly"){
      jQuery("tr.members-loan-helper").show();
      jQuery("tr.members-loan-edit-helper").show();
  }else{
       jQuery("tr.members-loan-helper").hide();
       jQuery("tr.members-loan-edit-helper").hide();
  }
});

jQuery( "#payment_type" ).trigger('change');

});
</script>
 
   
</body>
</html>
