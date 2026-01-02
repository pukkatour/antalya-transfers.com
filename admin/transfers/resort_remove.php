<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$resort_resort_id = $_GET['resort_resort_id'];
$resort_lang_id   = $_GET['resort_lang_id'];

$Db->query("DELETE FROM transfer_resorts WHERE resort_resort_id = ?", array($resort_resort_id));
$Db->query("DELETE FROM transfer_routes WHERE route_resort_id = ?", array($resort_resort_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/transfers/resorts.php?lang=$resort_lang_id");

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>