<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$directory_id      = $_POST['directory_id'];
$directory_name    = $_POST['directory_name'];
$directory_surname = $_POST['directory_surname'];
$directory_email   = $_POST['directory_email'];
$directory_country = $_POST['directory_country'];
$directory_phone   = telefon($_POST['directory_phone']);
$directory_cat     = $_POST['directory_cat'];
$directory_lng     = $_POST['directory_lng'];

$Db->query("UPDATE directory SET
directory_name     = ?,
directory_surname  = ?,
directory_email    = ?,
directory_country  = ?,
directory_phone    = ?,
directory_cat      = ?,
directory_lng      = ?
WHERE directory_id = ?"
, array($directory_name,$directory_surname,$directory_email,$directory_country,$directory_phone,$directory_cat,$directory_lng,$directory_id));

$_SESSION["alert"] = "ok";
redirect($_SERVER['HTTP_REFERER']);

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>