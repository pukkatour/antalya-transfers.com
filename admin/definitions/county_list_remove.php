<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$county_id         = $_GET['county_id'];
$county_country_id = $_GET['country_id'];
$county_city_id    = $_GET['city_id'];

if (!empty($county_id)) {

$Db->query("DELETE FROM county_list WHERE county_id = ?", array($county_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/definitions/county_list.php?id1=$county_country_id&id2=$county_city_id"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/definitions/county_list.php?id1=$county_country_id&id2=$county_city_id"); exit;

}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>