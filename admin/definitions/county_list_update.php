<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$county_name = $_POST['county_name'];
$county_id   = $_POST['county_id'];
$country_id  = $_POST['country_id'];
$city_id     = $_POST['city_id'];

$Db->query("UPDATE county_list SET county_name = ? WHERE county_id = ? ", array($county_name,$county_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/definitions/county_list.php?id1=$country_id&id2=$city_id"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>