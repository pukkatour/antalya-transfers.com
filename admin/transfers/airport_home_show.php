<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$airport_airport_id = $_POST['airport_airport_id'];
$show               = $_POST['show'];

$Db->query("UPDATE transfer_airports SET airport_home_show = ? WHERE airport_airport_id = ?", array($show,$airport_airport_id));

$_SESSION["alert"] = "ok";
redirect($_SERVER['HTTP_REFERER']); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>