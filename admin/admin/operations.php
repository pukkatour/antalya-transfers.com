<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$action = $_GET['action'];
$id     = $_GET['id'];

if (!empty($id)) {

$Db->query("UPDATE admin SET admin_status = ? WHERE admin_id = ? ", array($action,$id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/admin/index.php"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/admin/index.php"); exit;

}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>