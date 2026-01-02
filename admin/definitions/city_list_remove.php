<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$city_country_id = $_GET['city_country_id'];
$city_id         = $_GET['city_id'];

$Db->query("DELETE FROM city_list WHERE city_id = ?", array($city_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/definitions/city_list.php?id=$city_country_id"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>