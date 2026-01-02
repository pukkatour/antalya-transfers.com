<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$route_airport_id  = $_POST['route_airport_id'];
$route_resort_id   = $_POST['route_resort_id'];
$route_minute      = $_POST['route_minute'];
$route_distance    = $_POST['route_distance'];
$route_cost_price1 = $_POST['route_cost_price1'];
$route_sell_price1 = $_POST['route_sell_price1'];
$route_cost_price2 = $_POST['route_cost_price2'];
$route_sell_price2 = $_POST['route_sell_price2'];
$route_cost_curr   = $_POST['route_cost_curr'];

$route_single_cost = $_POST['route_single_cost'] ? $_POST['route_single_cost'] : 0;
$route_single_sell = $_POST['route_single_sell'] ? $_POST['route_single_sell'] : 0;

$cars = $Db->query("SELECT vehicle_vehicle_id FROM transfer_vehicles GROUP BY vehicle_vehicle_id ORDER BY vehicle_pax ASC ");


$control1 = $Db->row("SELECT route_id FROM transfer_routes WHERE route_airport_id = ? AND route_resort_id = ? AND route_vehicle_id = ? ", array($route_airport_id,$route_resort_id,$cars[0]['vehicle_vehicle_id']));

if (!empty($control1)) {

$Db->query("UPDATE transfer_routes SET route_pax = ?, route_minute = ?, route_distance = ?, route_cost_price = ?, route_sell_price = ?, route_cost_curr = ? WHERE route_airport_id = ? AND route_resort_id = ? AND route_vehicle_id = ? ", array('6',$route_minute,$route_distance,$route_cost_price1,$route_sell_price1,$route_cost_curr,$route_airport_id,$route_resort_id,$cars[0]['vehicle_vehicle_id']));

} else {

$Db->query("INSERT INTO transfer_routes (route_pax,route_minute,route_distance,route_cost_price,route_sell_price,route_cost_curr,route_airport_id,route_resort_id,route_vehicle_id) VALUES (?,?,?,?,?,?,?,?,?)", array('6',$route_minute,$route_distance,$route_cost_price1,$route_sell_price1,$route_cost_curr,$route_airport_id,$route_resort_id,$cars[0]['vehicle_vehicle_id']));

}


$control2 = $Db->row("SELECT route_id FROM transfer_routes WHERE route_airport_id = ? AND route_resort_id = ? AND route_vehicle_id = ? ", array($route_airport_id,$route_resort_id,$cars[1]['vehicle_vehicle_id']));

if (!empty($control2)) {

$Db->query("UPDATE transfer_routes SET route_pax = ?, route_minute = ?, route_distance = ?, route_cost_price = ?, route_sell_price = ?, route_cost_curr = ? WHERE route_airport_id = ? AND route_resort_id = ? AND route_vehicle_id = ? ", array('14',$route_minute,$route_distance,$route_cost_price2,$route_sell_price2,$route_cost_curr,$route_airport_id,$route_resort_id,$cars[1]['vehicle_vehicle_id']));

} else {

$Db->query("INSERT INTO transfer_routes (route_pax,route_minute,route_distance,route_cost_price,route_sell_price,route_cost_curr,route_airport_id,route_resort_id,route_vehicle_id) VALUES (?,?,?,?,?,?,?,?,?)", array('14',$route_minute,$route_distance,$route_cost_price2,$route_sell_price2,$route_cost_curr,$route_airport_id,$route_resort_id,$cars[1]['vehicle_vehicle_id']));

}


$Db->query("UPDATE transfer_routes SET route_single_cost = ?, route_single_sell = ? WHERE route_airport_id = ? AND route_resort_id = ? ", array($route_single_cost,$route_single_sell,$route_airport_id,$route_resort_id));

$_SESSION["alert"] = "ok";
redirect($_SERVER['HTTP_REFERER']); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>