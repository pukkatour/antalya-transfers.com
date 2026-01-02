<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$county_country_id = $_POST['county_country_id'];
$county_city_id    = $_POST['county_city_id'];
$county_name       = $_POST['county_name'];

$Db->query("INSERT INTO county_list (county_country_id,county_city_id,county_name) VALUES (?,?,?)", array($county_country_id,$county_city_id,$county_name));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/definitions/county_list.php?id1=$county_country_id&id2=$county_city_id"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>