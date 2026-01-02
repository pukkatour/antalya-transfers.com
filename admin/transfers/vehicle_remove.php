<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$vehicle_vehicle_id = $_GET['vehicle_vehicle_id'];
$vehicle_lang_id    = $_GET['vehicle_lang_id'];

$control = $Db->row("SELECT vehicle_img FROM transfer_vehicles WHERE vehicle_vehicle_id = ?", array($vehicle_vehicle_id));
$Db->query("DELETE FROM transfer_vehicles WHERE vehicle_vehicle_id = ?", array($vehicle_vehicle_id));

$filename = $control['vehicle_img'];
$filename = IMAGE_PATH."transfer/".$filename;
if (file_exists($filename)) { unlink($filename); }

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/transfers/vehicles.php?lang=$vehicle_lang_id");

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>