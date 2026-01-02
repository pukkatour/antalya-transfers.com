<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$vehicle_id         = $_POST['vehicle_id'];
$vehicle_lang_id    = $_POST['vehicle_lang_id'];
$vehicle_vehicle_id = $_POST['vehicle_vehicle_id'];
$vehicle_name       = tirnak($_POST['vehicle_name']);
$vehicle_pax        = $_POST['vehicle_pax'];
$vehicle_is_shared  = $_POST['vehicle_is_shared'];

$Db->query("UPDATE transfer_vehicles SET vehicle_name = ? WHERE vehicle_id = ?", array($vehicle_name,$vehicle_id));

$Db->query("UPDATE transfer_vehicles SET vehicle_pax = ?, vehicle_is_shared = ? WHERE vehicle_vehicle_id = ?", array($vehicle_pax,$vehicle_is_shared,$vehicle_vehicle_id));

$_SESSION["alert"] = "ok";
redirect($_SERVER['HTTP_REFERER']); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>