<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$admin_name           = $_POST['admin_name'];
$admin_surname        = $_POST['admin_surname'];
$admin_email          = $_POST['admin_email'];
$admin_password       = $_POST['admin_password'];
$admin_country_id     = $_POST['admin_country_id'];
$admin_phone_number   = telefon($_POST['admin_phone_number']);
$admin_status         = $_POST['admin_status'];

$check_admin          = $Db->row("SELECT COUNT(admin_id) AS control FROM admin WHERE admin_email = ?", array($admin_email));

if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) { redirect(SITE_URL."admin/admin/index.php?error=email"); exit; }

if ($check_admin['control'] == 0) {

$Db->query("INSERT INTO admin (admin_name,admin_surname,admin_email,admin_password,admin_country_id,admin_phone_number,admin_status) VALUES (?,?,?,?,?,?,?)", array($admin_name,$admin_surname,$admin_email,md5($admin_password),$admin_country_id,$admin_phone_number,$admin_status));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/admin/index.php"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/admin/index.php?error=duplicate"); exit;

}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>