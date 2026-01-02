<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }

if (!empty($_POST)) {

$_POST = array_map("tirnak", $_POST);

$review_id     = $_POST['review_id'];
$review_name   = $_POST['review_name'];
$review_text   = $_POST['review_text'];
$review_date   = date("Y-m-d", strtotime($_POST['review_date']));
$review_status = $_POST['review_status'];

$Db->query("UPDATE reviews SET review_name = ?, review_text = ?, review_date = ?, review_status = ? WHERE review_id = ?", array($review_name,$review_text,$review_date,$review_status,$review_id));

$_SESSION["alert"] = "ok";
redirect($_SERVER['HTTP_REFERER']); exit;
} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>