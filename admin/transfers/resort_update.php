<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$resort_id        = $_POST['resort_id'];
$resort_lang_id   = $_POST['resort_lang_id'];
$resort_resort_id = $_POST['resort_resort_id'];
$resort_name      = tirnak($_POST['resort_name']);
$resort_slug      = url_slug($_POST['resort_name']);
$resort_geo       = $_POST['resort_geo'];
$resort_airport   = $_POST['resort_airport'];

if(!empty($resort_airport)) {
$val  = "";
foreach ($resort_airport as $value) {
$val .= $value.",";
}
$resort_airport = rtrim($val, ",");
}

$Db->query("UPDATE transfer_resorts SET resort_name = ?, resort_slug = ? WHERE resort_id = ? ", array($resort_name,$resort_slug,$resort_id));

$Db->query("UPDATE transfer_resorts SET resort_geo = ?, resort_airport = ? WHERE resort_resort_id = ?", array($resort_geo,$resort_airport,$resort_resort_id));

$_SESSION["alert"] = "ok";
redirect($_SERVER['HTTP_REFERER']); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>