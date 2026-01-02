<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$id    = $_POST['id'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

if ($pass1 === $pass2) {

$Db->query("UPDATE admin SET admin_password = ? WHERE admin_id = ?", array(md5($pass1),$id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/admin/edit.php?admin_id=$id"); exit;

} else {

redirect(SITE_URL."admin/admin/edit.php?admin_id=$id&error=pass"); exit;

}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>