<?php
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$_POST = array_map("tirnak", $_POST);

$page_id             = $_POST['page_id'];
$page_lang_id        = $_POST['page_lang_id'];
$page_title          = $_POST['page_title'];
$page_description    = $_POST['page_description'];
$page_keywords       = $_POST['page_keywords'];
$page_name           = $_POST['page_name'];
$page_faq_title      = $_POST['page_faq_title'];
$page_faq_text       = $_POST['page_faq_text'];
$page_faq_button     = $_POST['page_faq_button'];
$page_reviews_title  = $_POST['page_reviews_title'];
$page_reviews_text   = $_POST['page_reviews_text'];
$page_reviews_button = $_POST['page_reviews_button'];


$Db->query("UPDATE page_home SET 
page_title          = ?,
page_description    = ?,
page_keywords       = ?,
page_name           = ?,
page_faq_title      = ?,
page_faq_text       = ?,
page_faq_button     = ?,
page_reviews_title  = ?,
page_reviews_text   = ?,
page_reviews_button = ?
WHERE page_id       = ?
", array($page_title,$page_description,$page_keywords,$page_name,$page_faq_title,$page_faq_text,$page_faq_button,$page_reviews_title,$page_reviews_text,$page_reviews_button,$page_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/pages/home/index.php?lang_id=$page_lang_id"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>