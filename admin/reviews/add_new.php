<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }

if (!empty($_POST)) {

$_POST = array_map("tirnak", $_POST);

$review_name = $_POST['review_name'];
$review_date = date("Y-m-d", strtotime($_POST['review_date']));
$review_text = $_POST['review_text'];

$Db->query("INSERT INTO reviews (review_name,review_date,review_text) VALUES (?,?,?)", array($review_name,$review_date,$review_text));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/reviews/index.php"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>