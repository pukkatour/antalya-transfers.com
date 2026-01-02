<?php
include_once('site_id.php');
include_once('admin/include/initialize.inc.php');

$flight_date   = $_POST['datex'];
$flight_time   = $_POST['timex'];

$date = date('Y-m-d H:i', strtotime("$flight_date $flight_time"));

$transfer_time = $_POST['distx'] + 120;
$pickup_time   = date("d-m-Y H:i", strtotime($date) - ($transfer_time * 60));
	
$arr = array ('response'=>'ok','result'=>$pickup_time);
echo json_encode($arr); exit;

?>