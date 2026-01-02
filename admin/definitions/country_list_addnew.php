<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$country_name       = $_POST['country_name'];
$country_phone_code = $_POST['country_phone_code'];

$Db->query("INSERT INTO country_list (country_phone_code,country_name) VALUES (?,?)", array($country_phone_code,$country_name));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/definitions/country_list.php"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>