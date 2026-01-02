<?php
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$_POST = array_map("tirnak", $_POST);

$lang_id = $_GET['lang_id'];
$stat    = $_GET['stat'];
$url     = $_GET['url'];

if (isset($stat) && !empty($stat)) { $Db->query("UPDATE home_modal SET stat = ? WHERE lang_id = ?", array($stat,$lang_id)); }
if (!isset($stat) && empty($stat)) { $Db->query("UPDATE home_modal SET url = ? WHERE lang_id = ?", array($url,$lang_id)); }

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/home_settings/modal/index.php?lang_id=$lang_id"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>