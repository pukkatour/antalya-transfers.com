<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$_POST = array_map("tirnak", $_POST);

$footer_id       = $_POST['footer_id'];
$footer_lang_id  = $_POST['footer_lang_id'];
$footer_title_1  = $_POST['footer_title_1'];
$footer_title_2  = $_POST['footer_title_2'];
$footer_title_3  = $_POST['footer_title_3'];
$footer_text_1   = $_POST['footer_text_1'];
$footer_text_2_1 = $_POST['footer_text_2_1'];
$footer_text_2_2 = $_POST['footer_text_2_2'];
$footer_text_2_3 = $_POST['footer_text_2_3'];
$footer_text_3   = $_POST['footer_text_3'];



$Db->query("UPDATE footer SET 
footer_title_1  = ?,
footer_title_2  = ?,
footer_title_3  = ?,
footer_text_1   = ?,
footer_text_2_1 = ?,
footer_text_2_2 = ?,
footer_text_2_3 = ?,
footer_text_3   = ?
WHERE footer_id = ?
", array($footer_title_1,$footer_title_2,$footer_title_3,$footer_text_1,$footer_text_2_1,$footer_text_2_2,$footer_text_2_3,$footer_text_3,$footer_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/site_settings/footer.php?lang_id=$footer_lang_id"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>