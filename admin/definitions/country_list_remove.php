<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$country_id = $_GET['country_id'];

if (!empty($country_id)) {

$Db->query("DELETE FROM country_list WHERE country_id = ?", array($country_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/definitions/country_list.php"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/definitions/country_list.php"); exit;

}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>