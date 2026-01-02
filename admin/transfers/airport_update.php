<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$airport_id         = $_POST['airport_id'];
$airport_lang_id    = $_POST['airport_lang_id'];
$airport_airport_id = $_POST['airport_airport_id'];
$airport_name       = tirnak($_POST['airport_name']);
$airport_slug       = url_slug($_POST['airport_name']);
$airport_code       = $_POST['airport_code'];
$airport_geo        = $_POST['airport_geo'];
$airport_agent      = $_POST['airport_agent'];
$airport_shuttle    = $_POST['airport_shuttle'];

$Db->query("UPDATE transfer_airports SET airport_name = ?, airport_slug = ? WHERE airport_id = ?", array($airport_name,$airport_slug,$airport_id));

$Db->query("UPDATE transfer_airports SET airport_code = ?, airport_geo = ?, airport_agent = ?, airport_shuttle = ? WHERE airport_airport_id = ?", array($airport_code,$airport_geo,$airport_agent,$airport_shuttle,$airport_airport_id));

$_SESSION["alert"] = "ok";
redirect($_SERVER['HTTP_REFERER']); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>