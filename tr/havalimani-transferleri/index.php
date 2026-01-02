<?php
include_once('../site_id.php');
include_once('../../admin/include/initialize.inc.php');

$data = $Db->row("SELECT * FROM page_transfer_list WHERE page_lang_id = ?", array($site_lang));

$airports = $Db->query("SELECT * FROM transfer_airports WHERE airport_lang_id = ?", array($site_lang));

$pagename = $data['page_name'];
include_once("../../hit_counter.php");

?>

<!DOCTYPE html>
<html lang="tr">

<head>

<title><?php echo $data['page_title']; ?></title>
<meta name="description" content="<?php echo $data['page_description']; ?>">
<meta name="keywords" content="<?php echo $data['page_keywords']; ?>">

<?php include_once("../../head_meta.php"); ?>

<link rel="alternate" href="<?php echo SITE_URL; ?>airport-transfers/" hreflang="en-US" />

</head>

<body>

<?php include_once("../head_menu.php"); ?>

<div class="more-features-container section-container">
<div class="container">

<div class="row">
<div class="col-sm-12 more-features section-description wow fadeIn">
<h1><?php echo $data['page_name']; ?></h1>
<div class="divider-1"><div class="line"></div></div>
</div>
</div>

<div class="row">

<div class="col-sm-12 more-features-box wow fadeInLeft">



<ul class="nav nav-tabs nav-justified padbot30" role="tablist">
<?php if (!empty($airports)) { $no = 1; foreach ($airports as $airport) { ?>
<li class="hamdi <?php if ($no == 1) { echo "active"; } ?>">
<a class="btn btncezmi" data-toggle="pill" aria-selected="true" role="tab" href="#cat<?php echo $no; ?>"><?php echo $airport['airport_name']; ?></a>
</li>
<?php $no++; } } ?>
</ul>



<div class="tab-content">

<?php if (!empty($airports)) { $nox = 1; foreach ($airports as $airport) { ?>
<div class="tab-pane fade <?php if ($nox == 1) { echo "active in"; } ?>" id="cat<?php echo $nox; ?>" role="tabpanel" aria-labelledby="cat<?php echo $nox; ?>" style="background: none !important;">

<table class="table table-striped table-hover table-bordered table-condensed">

<thead>

<tr>
<th class="text-center"><?php echo $translate['tr_097']; ?></th>
<th class="text-center"><?php echo $translate['tr_098']; ?></th>
<th class="hidden-xs text-center"><?php echo $translate['tr_099']; ?></th>
<th class="hidden-xs text-center"><?php echo $translate['tr_100']; ?></th>
<th class="text-center"><?php echo $translate['tr_102']; ?></th>
<th class="hidden-xs"></th>
</tr>

</thead>

<tbody>
<?php
$routes  = $Db->query("SELECT route_resort_id,route_airport_id,route_sell_price,route_cost_curr,route_distance,route_minute FROM transfer_routes WHERE route_airport_id = ? AND route_vehicle_id = ?", array ($airport['airport_airport_id'],'1'));

if (!empty($routes)) { foreach ($routes as $route) {

$arport  = $Db->row("SELECT airport_airport_id,airport_name,airport_slug,airport_code FROM transfer_airports WHERE airport_airport_id = ? AND airport_lang_id = ? ", array($route['route_airport_id'],$site_lang));
$resort  = $Db->row("SELECT resort_slug,resort_name,resort_airport FROM transfer_resorts WHERE resort_resort_id = ? AND resort_lang_id = ? ", array($route['route_resort_id'],$site_lang));

$airs    = explode(',',$resort['resort_airport']);
if (!in_array($arport['airport_airport_id'], $airs)) { continue; }

$price = $route['route_sell_price'];

if ($kur == "1") { // TRY
if ($route['route_cost_curr'] == "1") { $price = round($price); }
if ($route['route_cost_curr'] == "2") { $price = round($price * $currency['rate_buy_usd']); }
if ($route['route_cost_curr'] == "3") { $price = round($price * $currency['rate_buy_eur']); }
if ($route['route_cost_curr'] == "4") { $price = round($price * $currency['rate_buy_gbp']); }
}

elseif ($kur == "2") { // USD
if ($route['route_cost_curr'] == "1") { $price = round($price / $currency['rate_buy_usd']); }
if ($route['route_cost_curr'] == "2") { $price = round($price); }
if ($route['route_cost_curr'] == "3") { $price = round($price * $currency['rate_buy_eur'] / $currency['rate_buy_usd']); }
if ($route['route_cost_curr'] == "4") { $price = round($price * $currency['rate_buy_gbp'] / $currency['rate_buy_usd']); }
}

elseif ($kur == "3") { // EUR
if ($route['route_cost_curr'] == "1") { $price = round($price / $currency['rate_buy_eur']); }
if ($route['route_cost_curr'] == "2") { $price = round($price * $currency['rate_buy_usd'] / $currency['rate_buy_eur']); }
if ($route['route_cost_curr'] == "3") { $price = round($price); }
if ($route['route_cost_curr'] == "4") { $price = round($price * $currency['rate_buy_gbp'] / $currency['rate_buy_eur']); }
}

elseif ($kur == "4") { // GBP
if ($route['route_cost_curr'] == "1") { $price = round($price / $currency['rate_buy_gbp']); }
if ($route['route_cost_curr'] == "2") { $price = round($price * $currency['rate_buy_usd'] / $currency['rate_buy_gbp']); }
if ($route['route_cost_curr'] == "3") { $price = round($price * $currency['rate_buy_eur'] / $currency['rate_buy_usd']); }
if ($route['route_cost_curr'] == "4") { $price = round($price); }
}

?>

<tr>
<td><span class="hidden-xs"><?php echo $arport['airport_name']; ?></span><span class="visible-xs"><?php echo $arport['airport_code']; ?></span></td>
<td><a href="<?php echo $arport['airport_slug']."/".$resort['resort_slug']; ?>/"><?php echo $resort['resort_name']; ?></a></td>
<td class="hidden-xs"><?php echo $route['route_distance']; ?> <?php echo $translate['tr_024']; ?></td>
<td class="hidden-xs"><?php echo $route['route_minute']; ?> <?php echo $translate['tr_025']; ?></td>
<td><b><?php echo $price." ".$kurcode; ?></b></td>
<td class="hidden-xs"><a class="btn btn-warning btn-block" href="<?php echo $arport['airport_slug']."/".$resort['resort_slug']; ?>/"><?php echo $translate['tr_101']; ?></a></td>
</tr>

<?php } } ?>

</tbody>

</table>

</div>
<?php $nox++; } } ?>

</div>



</div>

</div>

</div>
</div>


<?php include_once("../footer.php"); ?>

<?php include_once("../../footer_scripts.php"); ?>

</body>

</html>

<?php ob_end_flush(); ?>