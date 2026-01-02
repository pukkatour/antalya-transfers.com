<?php
include_once('site_id.php');
include_once('admin/include/initialize.inc.php');

header('Content-type: application/xml');

echo '<?xml version="1.0" encoding="UTF-8"?>
';

echo '
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
';

echo '
<url>
<loc>'; echo SITE_URL; echo '</loc>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
';

echo '
<url>
<loc>'; echo SITE_URL; echo 'about-us</loc>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
';

echo '
<url>
<loc>'; echo SITE_URL; echo 'frequently-asked-questions</loc>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
';

echo '
<url>
<loc>'; echo SITE_URL; echo 'customer-reviews</loc>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
';

$total_news  = $totalreviews["revs"];
$total_page  =  ceil($total_news/15);

for ($x = 2; $x <= $total_page; $x++) {
echo '
<url>
<loc>'; echo SITE_URL; echo 'customer-reviews?page='.$x.'</loc>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
';
}

echo '
<url>
<loc>'; echo SITE_URL; echo 'contact-us</loc>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
';

echo '
<url>
<loc>'; echo SITE_URL; echo 'my-booking</loc>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
';

echo '
<url>
<loc>'; echo SITE_URL; echo 'terms-and-conditions</loc>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
';

echo '
<url>
<loc>'; echo SITE_URL; echo 'cancellation-policy</loc>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
';

echo '
<url>
<loc>'; echo SITE_URL; echo 'privacy-policy</loc>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
';

echo '
<url>
<loc>'; echo SITE_URL; echo 'cookies</loc>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
';

echo '
<url>
<loc>'; echo SITE_URL; echo 'airport-transfers/index</loc>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
';

$airports  = $Db->query("SELECT * FROM transfer_airports WHERE airport_lang_id = ?", array('1'));

if (!empty($airports)) { foreach ($airports as $airport) {

$routes    = $Db->query("SELECT route_resort_id,route_airport_id,route_sell_price,route_cost_curr,route_distance,route_minute FROM transfer_routes WHERE route_airport_id = ? AND route_vehicle_id = ?", array ($airport['airport_airport_id'],'1'));

if (!empty($routes)) { foreach ($routes as $route) {

$arport  = $Db->row("SELECT airport_name,airport_slug FROM transfer_airports WHERE airport_airport_id = ? AND airport_lang_id = ? ", array($route['route_airport_id'],'1'));
$resort  = $Db->row("SELECT resort_slug,resort_name FROM transfer_resorts WHERE resort_resort_id = ? AND resort_lang_id = ? ", array($route['route_resort_id'],'1'));

echo '
<url>
<loc>'; echo SITE_URL; echo 'airport-transfers/'.$arport['airport_slug']."/".$resort['resort_slug'].'/</loc>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
';
} } } }

if (!empty($airports)) { foreach ($airports as $airport) {

$routes    = $Db->query("SELECT route_resort_id,route_airport_id,route_sell_price,route_cost_curr,route_distance,route_minute FROM transfer_routes WHERE route_airport_id = ? AND route_vehicle_id = ?", array ($airport['airport_airport_id'],'1'));

if (!empty($routes)) { foreach ($routes as $route) {

$arport  = $Db->row("SELECT airport_name,airport_slug FROM transfer_airports WHERE airport_airport_id = ? AND airport_lang_id = ? ", array($route['route_airport_id'],'1'));
$resort  = $Db->row("SELECT resort_slug,resort_name FROM transfer_resorts WHERE resort_resort_id = ? AND resort_lang_id = ? ", array($route['route_resort_id'],'1'));

echo '
<url>
<loc>'; echo SITE_URL; echo $arport['airport_slug']."-to-".$resort['resort_slug'].'-transfer/</loc>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
';
} } } }

echo '
</urlset>';

?>