<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }

if (!empty($_GET)) {

$id = $_GET['id'];

if (!empty($id)) {

$Db->query("DELETE FROM reviews WHERE review_id = ?", array($id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/reviews/index.php"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>