<form name="DateFilter" method="POST">
<?php echo "<b>Today is " . date("Y/m/d") . "</b><br>"; ?>
<input type="date" name="gdate" value="" />
<br>
SELECT DAY:
<select name="gday">
	<option value="monday">monday</option>
	<option value="tuesday">tuesday</option>
	<option value="wednesday">wednesday</option>
	<option value="thursday">thursday</option>
	<option value="friday">friday</option>
	<option value="saturday">saturday</option>
	<option value="sunday">sunday</option>
</select>
<br>
SELECT CYCLE:
<select name="cycle">
	<option value="weekly">Weekly</option>
	<option value="monthly">Monthly</option>
	<option value="cutoff">Cutoff (15th and end of month)</option>
</select>	
<br>			
repeat:  <input type="number" name="repeat" value="" />
<br>
<input type="submit" name="Submit" value="submit">
</form>

<?php




if($_POST['cycle']=='cutoff'){

	$given_date = strtotime($_POST['gdate']);
	$given_date_nearcutoff = strtotime(date("Y-m-15",strtotime($_POST['gdate'])));
	$current_date =strtotime(date("Y-m-d"));
	$given_num = $_POST['repeat'];



	if($given_date>=$given_date_nearcutoff)
	{
		$payment[] = date("Y-m-t",$given_date);
	}
	else
	{	
		$payment[] = date("Y-m-15",$given_date);
		$payment[] = date("Y-m-t",$given_date);
		//$given_date = strtotime('+1 month', $given_date);
	}
	$counter = 0;


	$given_date = strtotime('+1 month', $given_date);


	for ($i = count($payment) + 1; $i <= $given_num; $i++) {
	$counter++;
	if($counter==1){
		$for_end = ($given_date);
	}else{
		$for_end = strtotime('+'.($counter - 1).' month', $given_date);
	}
	

    $payment[] = date('Y-m-15', $for_end);
	$i++;
	if($i<=$given_num){
	$payment[] = date('Y-m-t', $for_end); 		
	}




	}




}

if($_POST['cycle']=='monthly'){

$given_date = strtotime($_POST['gdate']);
$is_end = 0;
if($given_date == strtotime(date("Y-m-t",$given_date)))
{
	$given_date = strtotime(date("Y-m",$given_date));
	$is_end = 1;
}
$current_date =strtotime(date("Y-m-d"));






$payment[] = date('l Y-m-d', strtotime($_POST['gdate']));

$given_num = $_POST['repeat'];


// $given_date = strtotime('now');
$given_day = $_POST['gday'];

// $for_start = strtotime('Friday', $given_date);
$for_start = strtotime($given_date);
$for_end = strtotime('+'.$given_num.' month', $given_date);
// $for_end = strtotime($_POST['edate']);
for ($i = 2; $i <= $given_num; $i++) {

	$for_end = strtotime('+'.($i - 1).' month', $given_date);
	if($is_end){
		$payment[] = date('l Y-m-t', $for_end);
	}else{
		$payment[] = date('l Y-m-d', $for_end);
	}
    
}


}
if($_POST['cycle']=='weekly'){

$given_date = strtotime($_POST['gdate']);


// $given_date = strtotime('now');
$given_day = $_POST['gday'];
$given_num = $_POST['repeat'];
// $for_start = strtotime('Friday', $given_date);
$for_start = strtotime($given_day, $given_date);
$for_end = strtotime('+'.$given_num.' week', $given_date);
// $for_end = strtotime($_POST['edate']);
for ($i = $for_start; $i <= $for_end; $i = strtotime('+1 week', $i)) {
    $payment[] = date('l Y-m-d', $i);
}

}

?>