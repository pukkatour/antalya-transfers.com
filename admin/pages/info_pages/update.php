<?php
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$page_id          = $_POST['page_id'];
$page_title       = $_POST['page_title'];
$page_description = $_POST['page_description'];
$page_keywords    = $_POST['page_keywords'];
$page_stat        = $_POST['page_stat'];
$page_name        = $_POST['page_name'];
$page_slug        = url_slug($_POST['page_name']);
$page_main_title  = tirnak($_POST['page_main_title']);
$page_main_text1  = tirnak($_POST['page_main_text1']);
$page_main_text2  = tirnak($_POST['page_main_text2']);
$page_main_text3  = tirnak($_POST['page_main_text3']);

$Db->query("UPDATE info_pages SET page_title = ?, page_description = ?, page_keywords = ?, page_stat = ?, page_name = ?, page_slug = ?, page_main_title = ?, page_main_text1 = ?, page_main_text2 = ?, page_main_text3 = ? WHERE page_id = ?", array($page_title,$page_description,$page_keywords,$page_stat,$page_name,$page_slug,$page_main_title,$page_main_text1,$page_main_text2,$page_main_text3,$page_id));

$_SESSION["alert"] = "ok";
redirect($_SERVER['HTTP_REFERER']); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>