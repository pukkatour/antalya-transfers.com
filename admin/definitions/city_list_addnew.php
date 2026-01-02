<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$city_country_id = $_POST['city_country_id'];
$city_name       = $_POST['city_name'];

$Db->query("INSERT INTO city_list (city_country_id,city_name) VALUES (?,?)", array($city_country_id,$city_name));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/definitions/city_list.php?id=$city_country_id"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>