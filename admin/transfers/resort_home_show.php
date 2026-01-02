<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$resort_resort_id = $_POST['resort_resort_id'];
$show             = $_POST['show'];

$Db->query("UPDATE transfer_resorts SET resort_home_show = ? WHERE resort_resort_id = ?", array($show,$resort_resort_id));

$_SESSION["alert"] = "ok";
redirect($_SERVER['HTTP_REFERER']); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>