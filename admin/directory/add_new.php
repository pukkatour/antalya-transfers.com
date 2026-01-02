<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$directory_email   = $_POST['directory_email'];
$directory_name    = $_POST['directory_name'];
$directory_surname = $_POST['directory_surname'];
$directory_country = $_POST['directory_country'];
$directory_phone   = telefon($_POST['directory_phone']);
$directory_lng     = $_POST['directory_lng'];
$directory_cat     = $_POST['directory_cat'];

$Db->query("INSERT INTO directory (directory_email,directory_name,directory_surname,directory_country,directory_phone,directory_lng,directory_cat) VALUES (?,?,?,?,?,?,?)", array($directory_email,$directory_name,$directory_surname,$directory_country,$directory_phone,$directory_lng,$directory_cat));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/directory/index.php");

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>