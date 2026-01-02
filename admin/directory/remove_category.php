<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$id = $_GET['id'];

$Db->query("DELETE FROM directory_categories WHERE category_id = ?", array($id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/directory/categories.php");

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>