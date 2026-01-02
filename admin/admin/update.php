<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$admin_id             = $_POST['admin_id'];
$admin_name           = $_POST['admin_name'];
$admin_surname        = $_POST['admin_surname'];
$admin_email          = $_POST['admin_email'];
$admin_country_id     = $_POST['admin_country_id'];
$admin_phone_number   = telefon($_POST['admin_phone_number']);
$admin_status         = $_POST['admin_status'];
$admin_old_email      = $_POST['admin_old_email'];
$admin_old_phone      = $_POST['admin_old_phone'];

if (empty($admin_id)) { $_SESSION["alert"] = "nok"; redirect(SITE_URL."admin/admin/index.php"); exit; } else {

if ($admin_email != $admin_old_email) {
$check_admin      = $Db->row("SELECT COUNT(admin_id) AS control FROM admin WHERE admin_email = ?", array($admin_email));
}

if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) { redirect(SITE_URL."admin/admin/edit.php?admin_id=$admin_id&error=email"); exit; }

if (empty($check_admin['control']) OR $check_admin['control'] == 0) {

$Db->query("UPDATE admin SET
admin_name         = ?,
admin_surname      = ?,
admin_email        = ?,
admin_country_id   = ?,
admin_phone_number = ?,
admin_status       = ?
WHERE admin_id     = ?
", array($admin_name,$admin_surname,$admin_email,$admin_country_id,$admin_phone_number,$admin_status,$admin_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/admin/edit.php?admin_id=$admin_id"); exit;

} else {

redirect(SITE_URL."admin/admin/edit.php?admin_id=$admin_id&error=duplicate"); exit;

}

}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>