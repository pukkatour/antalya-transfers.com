<?php
include_once('site_id.php');
include_once('admin/include/initialize.inc.php');

$air_id = $_POST['air_id'];

$data   = $Db->row("SELECT airport_slug,airport_geo FROM transfer_airports WHERE airport_airport_id = ? AND airport_lang_id = ?", array($air_id,$site_lang));

$latlng = $data['airport_geo'];
$slug   = $data['airport_slug'];
	
$arr = array ('response'=>'ok','latlng'=>$latlng,'slug'=>$slug);
echo json_encode($arr); exit;

?>