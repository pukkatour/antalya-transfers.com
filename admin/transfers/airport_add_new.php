<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$airport_name       = $_POST['airport_name'];
$airport_slug       = url_slug($_POST['airport_name']);
$airport_code       = $_POST['airport_code'];
$airport_geo        = $_POST['airport_geo'];
$airport_lang_id    = $_POST['airport_lang_id'];
$airport_airport_id = $_POST['airport_airport_id'];
$airport_agent      = $_POST['airport_agent'];
$airport_shuttle    = $_POST['airport_shuttle'];

if (!empty($languagelist)) { foreach ($languagelist as $langs) {
$Db->query("INSERT INTO transfer_airports (airport_airport_id,airport_lang_id,airport_agent,airport_name,airport_slug,airport_code,airport_geo,airport_shuttle) VALUES (?,?,?,?,?,?,?,?)", array($airport_airport_id,$langs['lang_id'],$airport_agent,$airport_name,$airport_slug,$airport_code,$airport_geo,$airport_shuttle));
} }

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/transfers/airports.php?lang=$airport_lang_id");

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>