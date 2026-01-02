<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$airport_airport_id = $_GET['airport_airport_id'];
$airport_lang_id    = $_GET['airport_lang_id'];

$Db->query("DELETE FROM transfer_airports WHERE airport_airport_id = ?", array($airport_airport_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/transfers/airports.php?lang=$airport_lang_id");

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>