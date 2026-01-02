<?php
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$_POST = array_map("tirnak", $_POST);

$whyus_id      = $_POST['whyus_id'];
$whyus_lang_id = $_POST['whyus_lang_id'];
$whyus_title   = $_POST['whyus_title'];
$whyus_text    = $_POST['whyus_text'];
$whyus_icon1   = $_POST['whyus_icon1'];
$whyus_title1  = $_POST['whyus_title1'];
$whyus_text1   = $_POST['whyus_text1'];
$whyus_icon2   = $_POST['whyus_icon2'];
$whyus_title2  = $_POST['whyus_title2'];
$whyus_text2   = $_POST['whyus_text2'];
$whyus_icon3   = $_POST['whyus_icon3'];
$whyus_title3  = $_POST['whyus_title3'];
$whyus_text3   = $_POST['whyus_text3'];


$Db->query("UPDATE home_whyus SET 
whyus_title    = ?,
whyus_text    = ?,
whyus_icon1    = ?,
whyus_title1   = ?,
whyus_text1    = ?,
whyus_icon2    = ?,
whyus_title2   = ?,
whyus_text2    = ?,
whyus_icon3    = ?,
whyus_title3   = ?,
whyus_text3    = ?
WHERE whyus_id = ?
", array($whyus_title,$whyus_text,$whyus_icon1,$whyus_title1,$whyus_text1,$whyus_icon2,$whyus_title2,$whyus_text2,$whyus_icon3,$whyus_title3,$whyus_text3,$whyus_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/home_settings/why_us/index.php?lang_id=$whyus_lang_id"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>