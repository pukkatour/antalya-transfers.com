<?php
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$_POST = array_map("tirnak", $_POST);

$features_id      = $_POST['features_id'];
$features_lang_id = $_POST['features_lang_id'];
$features_title   = $_POST['features_title'];
$features_text1   = $_POST['features_text1'];
$features_text2   = $_POST['features_text2'];
$features_text3   = $_POST['features_text3'];
$features_text4   = $_POST['features_text4'];
$features_text5   = $_POST['features_text5'];
$features_text6   = $_POST['features_text6'];


$Db->query("UPDATE home_feautres SET features_title = ?, features_text1 = ?, features_text2 = ?, features_text3 = ?, features_text4 = ?, features_text5 = ?, features_text6 = ? WHERE features_id = ? ", array($features_title,$features_text1,$features_text2,$features_text3,$features_text4,$features_text5,$features_text6,$features_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/home_settings/feautres/index.php?lang_id=$features_lang_id"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>