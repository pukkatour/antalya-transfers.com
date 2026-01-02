<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$faq_id       = $_POST['faq_id'];
$faq_lang_id  = $_POST['faq_lang_id'];
$faq_question = $_POST['faq_question'];
$faq_answer   = $_POST['faq_answer'];
$faq_status   = $_POST['faq_status'];

$Db->query("UPDATE faq_list SET faq_question = ?, faq_answer = ?, faq_status = ? WHERE faq_id = ?", array($faq_question,$faq_answer,$faq_status,$faq_id));

$_SESSION["alert"] = "ok";
redirect($_SERVER['HTTP_REFERER']); exit;


} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>