<?php
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$id  = $_GET['id'];
$img = $_GET['img'];

$Db->query("DELETE FROM home_slider WHERE slider_slider_id = ?", array($id));

$img = IMAGE_PATH."slider/".$img;
if (file_exists($img)) { unlink($img); }

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/home_settings/slider/index.php?lang_id=1"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>