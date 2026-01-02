<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$temp_id          = $_POST['temp_id'];
$temp_lang_id     = $_POST['temp_lang_id'];
$info_title       = $_POST['info_title'];
$info_text        = $_POST['info_text'];
$middle_text      = $_POST['middle_text'];
$middle_button    = $_POST['middle_button'];
$middle_url       = $_POST['middle_url'];
$contact_text     = $_POST['contact_text'];

$Db->query("UPDATE booking_template SET
info_title       = ?,
info_text        = ?,
middle_text      = ?,
middle_button    = ?,
middle_url       = ?,
contact_text     = ?
WHERE temp_id    = ?"
, array($info_title,$info_text,$middle_text,$middle_button,$middle_url,$contact_text,$temp_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/site_settings/booking_template.php?lang_id=$temp_lang_id"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>