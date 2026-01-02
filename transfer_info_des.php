<?php
include_once('site_id.php');
include_once('admin/include/initialize.inc.php');

$des_id = $_POST['des_id'];

$data   = $Db->row("SELECT resort_slug,resort_geo FROM transfer_resorts WHERE resort_resort_id = ? AND resort_lang_id = ?", array($des_id,$site_lang));

$latlng = $data['resort_geo'];
$slug   = $data['resort_slug'];
	
$arr = array ('response'=>'ok','latlng'=>$latlng,'slug'=>$slug);
echo json_encode($arr); exit;

?>