<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$temp_id          = $_POST['temp_id'];
$temp_lang_id     = $_POST['temp_lang_id'];
$box1_title       = $_POST['box1_title'];
$box1_text        = $_POST['box1_text'];
$box1_link        = $_POST['box1_link'];
$box1_link_text   = $_POST['box1_link_text'];
$box2_title       = $_POST['box2_title'];
$box2_text        = $_POST['box2_text'];
$box2_link        = $_POST['box2_link'];
$box2_link_text   = $_POST['box2_link_text'];
$box3_title       = $_POST['box3_title'];
$box3_text        = $_POST['box3_text'];
$box3_link        = $_POST['box3_link'];
$box3_link_text   = $_POST['box3_link_text'];
$bottom_box       = $_POST['bottom_box'];
$bottom_title     = $_POST['bottom_title'];
$bottom_text      = $_POST['bottom_text'];
$bottom_link      = $_POST['bottom_link'];
$bottom_link_text = $_POST['bottom_link_text'];
$social_link1     = $_POST['social_link1'];
$social_link2     = $_POST['social_link2'];
$contact_text     = $_POST['contact_text'];

$Db->query("UPDATE email_template SET
box1_title       = ?,
box1_text        = ?,
box1_link        = ?,
box1_link_text   = ?,
box2_title       = ?,
box2_text        = ?,
box2_link        = ?,
box2_link_text   = ?,
box3_title       = ?,
box3_text        = ?,
box3_link        = ?,
box3_link_text   = ?,
bottom_box       = ?,
bottom_title     = ?,
bottom_text      = ?,
bottom_link      = ?,
bottom_link_text = ?,
social_link1     = ?,
social_link2     = ?,
contact_text     = ?
WHERE temp_id    = ?"
, array($box1_title,$box1_text,$box1_link,$box1_link_text,$box2_title,$box2_text,$box2_link,$box2_link_text,$box3_title,$box3_text,$box3_link,$box3_link_text,$bottom_box,$bottom_title,$bottom_text,$bottom_link,$bottom_link_text,$social_link1,$social_link2,$contact_text,$temp_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/site_settings/email_template.php?lang_id=$temp_lang_id"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>