<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$faq_lang_id  = $_POST['faq_lang_id'];
$faq_question = $_POST['faq_question'];
$faq_answer   = $_POST['faq_answer'];

$Db->query("INSERT INTO faq_list (faq_lang_id,faq_question,faq_answer) VALUES ('".$faq_lang_id."','".$faq_question."','".$faq_answer."') ");

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/faq/index.php?lang=$faq_lang_id"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>