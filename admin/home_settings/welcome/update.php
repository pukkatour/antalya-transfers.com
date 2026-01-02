<?php
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$_POST = array_map("tirnak", $_POST);

$welcome_id          = $_POST['welcome_id'];
$welcome_lang_id     = $_POST['welcome_lang_id'];
$welcome_left_title  = $_POST['welcome_left_title'];
$welcome_left_text   = $_POST['welcome_left_text'];
$welcome_right_title = $_POST['welcome_right_title'];
$welcome_right_text  = $_POST['welcome_right_text'];
$welcome_button1     = $_POST['welcome_button1'];
$welcome_url1        = $_POST['welcome_url1'];
$welcome_button2     = $_POST['welcome_button2'];
$welcome_url2        = $_POST['welcome_url2'];
$welcome_sub1        = $_POST['welcome_sub1'];
$welcome_sub2        = $_POST['welcome_sub2'];
$welcome_sub3        = $_POST['welcome_sub3'];
$welcome_sub4        = $_POST['welcome_sub4'];
$welcome_sub5        = $_POST['welcome_sub5'];


$Db->query("UPDATE home_welcome SET welcome_left_title = ?, welcome_left_text = ?, welcome_right_title = ?, welcome_right_text = ?, welcome_button1 = ?, welcome_url1 = ?, welcome_button2 = ?, welcome_url2 = ?, welcome_sub1 = ?, welcome_sub2 = ?, welcome_sub3 = ?, welcome_sub4 = ?, welcome_sub5 = ? WHERE welcome_id = ? ", array($welcome_left_title,$welcome_left_text,$welcome_right_title,$welcome_right_text,$welcome_button1,$welcome_url1,$welcome_button2,$welcome_url2,$welcome_sub1,$welcome_sub2,$welcome_sub3,$welcome_sub4,$welcome_sub5,$welcome_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/home_settings/welcome/index.php?lang_id=$welcome_lang_id"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>