<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$category_name = $_POST['category_name'];

$Db->query("INSERT INTO directory_categories (category_name) VALUES (?)", array($category_name));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/directory/categories.php");

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>