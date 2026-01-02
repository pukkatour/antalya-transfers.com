<?php
include_once('initialize.inc.php');

if($_GET) {

if(!empty($_GET['country_all'])) {

echo json_encode($countrylist);

}

if(!empty($_GET['country'])) {

$city = $Db->query("SELECT * FROM city_list WHERE city_country_id = ? ORDER BY city_name ", array($_GET['country']));
echo json_encode($city);

}

if(!empty($_GET['city'])) {

$county = $Db->query("SELECT * FROM county_list WHERE county_city_id = ? ORDER BY county_name ", array($_GET['city']));
echo json_encode($county);

}

}

?>