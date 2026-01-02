<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$faq_id = $_GET['faq_id'];
$lang   = $_GET['lang'];

if (!empty($faq_id)) {

$Db->query("DELETE FROM faq_list WHERE faq_id = '".$faq_id."' ");

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/faq/index.php?lang=$lang"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/faq/index.php?lang=$lang"); exit;

}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>