<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$resort_name       = tirnak($_POST['resort_name']);
$resort_slug       = url_slug($_POST['resort_name']);
$resort_geo        = $_POST['resort_geo'];
$resort_is_hotel   = $_POST['resort_is_hotel'];
$resort_is_related = $_POST['resort_is_related'] ? $_POST['resort_is_related'] : 0;
$resort_resort_id  = $_POST['resort_resort_id'];
$resort_airport    = $_POST['resort_airport'];

if(!empty($resort_airport)) {
$val  = "";
foreach ($resort_airport as $value) {
$val .= $value.",";
}
$resort_airport = rtrim($val, ",");
}

if (!empty($_POST['resort_lang_id'])) { $resort_lang_id = $_POST['resort_lang_id']; } else { $resort_lang_id = 1; }

if (!empty($languagelist)) { foreach ($languagelist as $langs) {
$Db->query("INSERT INTO transfer_resorts (resort_resort_id,resort_lang_id,resort_name,resort_slug,resort_geo,resort_is_hotel,resort_is_related,resort_airport) VALUES (?,?,?,?,?,?,?,?)", array($resort_resort_id,$langs['lang_id'],$resort_name,$resort_slug,$resort_geo,$resort_is_hotel,$resort_is_related,$resort_airport));
} }


$airport_list = $Db->query("SELECT airport_airport_id FROM transfer_airports WHERE airport_lang_id = ?", array('1'));
if (!empty($airport_list)) { foreach ($airport_list as $airport) {
$vehicle_list = $Db->query("SELECT vehicle_vehicle_id,vehicle_pax FROM transfer_vehicles WHERE vehicle_lang_id = ?", array('1'));
if (!empty($vehicle_list)) { foreach ($vehicle_list as $vehicle) {

$Db->query("INSERT INTO transfer_routes (route_pax,route_minute,route_distance,route_cost_price,route_sell_price,route_cost_curr,route_airport_id,route_resort_id,route_vehicle_id) 
VALUES (?,?,?,?,?,?,?,?,?)", array($vehicle['vehicle_pax'],'0','0','0','0','1',$airport['airport_airport_id'],$resort_resort_id,$vehicle['vehicle_vehicle_id']));

} } } }

$_SESSION["alert"] = "ok";
redirect($_SERVER['HTTP_REFERER']); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>