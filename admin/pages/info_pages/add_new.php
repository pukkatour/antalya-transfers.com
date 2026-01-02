<?php
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$page_page_id     = $_POST['page_page_id'];
$page_title       = $_POST['page_title'];
$page_description = $_POST['page_description'];
$page_keywords    = $_POST['page_keywords'];
$page_name        = $_POST['page_name'];
$page_slug        = url_slug($_POST['page_name']);
$page_stat        = $_POST['page_stat'];

if (!empty($languagelist)) { foreach ($languagelist as $langs) {
$Db->query("INSERT INTO info_pages (page_page_id,page_lang_id,page_title,page_description,page_keywords,page_name,page_slug,page_stat) VALUES (?,?,?,?,?,?,?,?)", array($page_page_id,$langs['lang_id'],$page_title,$page_description,$page_keywords,$page_name,$page_slug,$page_stat));
} }

$_SESSION["alert"] = "ok";
redirect($_SERVER['HTTP_REFERER']); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>