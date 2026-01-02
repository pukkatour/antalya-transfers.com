<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$faq_id  = $_POST['faq_id'];
$lang_id = $_POST['lang_id'];
$show    = $_POST['show'];

$Db->query("UPDATE faq_list SET faq_show_home = ? WHERE faq_id = ?", array($show,$faq_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/faq/index.php?lang=$lang_id");

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>