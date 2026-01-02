<?php
include_once('site_id.php');
include_once('admin/include/initialize.inc.php');


if (!empty($_POST)) {


$booking_shared    = $_POST['transfer_shared'];
$booking_from_to   = $_POST['transfer_from'];
$booking_airport   = $_POST['transfer_airport'];
$booking_resort    = $_POST['transfer_resort'];
$booking_total_pax = $_POST['transfer_pax'];
$booking_type      = $_POST['transfer_type'];
$booking_curr      = $_POST['transfer_curr'];


$transfer = $Db->row("SELECT * FROM transfer_routes WHERE route_airport_id = ? AND route_resort_id = ? AND route_pax >= ? ORDER BY route_pax ASC ", array($booking_airport,$booking_resort,$booking_total_pax));

if ($booking_shared == 1) {
$vehicle  = $Db->row("SELECT * FROM transfer_vehicles WHERE vehicle_is_shared = ? AND vehicle_lang_id = ? ", array($booking_shared,$site_lang));
}
if ($booking_shared == 2) {
$vehicle  = $Db->row("SELECT * FROM transfer_vehicles WHERE vehicle_vehicle_id = ? AND vehicle_lang_id = ? ", array($transfer['route_vehicle_id'],$site_lang));
}

$currcode = $Db->row("SELECT curr_symbol FROM currencies WHERE curr_id = ? ", array($booking_curr));


$img = $vehicle['vehicle_img'];
$min = $transfer['route_minute'];
$dis = $transfer['route_distance'];
$cur = $transfer['route_cost_curr'];
$crr = $currcode['curr_symbol'];

if ($booking_shared == 1) {
$route_cost_price = $transfer['route_single_sell'];
$route_sell_price = $transfer['route_single_sell'];
}
if ($booking_shared == 2) {
$route_cost_price = $transfer['route_sell_price'];
$route_sell_price = $transfer['route_sell_price'];
}


if ($booking_curr == "1") { // TRY
if ($cur == "1") { $route_sell_price = round($route_sell_price); }
if ($cur == "2") { $route_sell_price = round($route_sell_price * $currency['rate_buy_usd']); }
if ($cur == "3") { $route_sell_price = round($route_sell_price * $currency['rate_buy_eur']); }
if ($cur == "4") { $route_sell_price = round($route_sell_price * $currency['rate_buy_gbp']); }
}

elseif ($booking_curr == "2") { // USD
if ($cur == "1") { $route_sell_price = round($route_sell_price / $currency['rate_buy_usd']); }
if ($cur == "2") { $route_sell_price = round($route_sell_price); }
if ($cur == "3") { $route_sell_price = round($route_sell_price * $currency['rate_buy_eur'] / $currency['rate_buy_usd']); }
if ($cur == "4") { $route_sell_price = round($route_sell_price * $currency['rate_buy_gbp'] / $currency['rate_buy_usd']); }
}

elseif ($booking_curr == "3") { // EUR
if ($cur == "1") { $route_sell_price = round($route_sell_price / $currency['rate_buy_eur']); }
if ($cur == "2") { $route_sell_price = round($route_sell_price * $currency['rate_buy_usd'] / $currency['rate_buy_eur']); }
if ($cur == "3") { $route_sell_price = round($route_sell_price); }
if ($cur == "4") { $route_sell_price = round($route_sell_price * $currency['rate_buy_gbp'] / $currency['rate_buy_eur']); }
}

elseif ($booking_curr == "4") { // GBP
if ($cur == "1") { $route_sell_price = round($route_sell_price / $currency['rate_buy_gbp']); }
if ($cur == "2") { $route_sell_price = round($route_sell_price * $currency['rate_buy_usd'] / $currency['rate_buy_gbp']); }
if ($cur == "3") { $route_sell_price = round($route_sell_price * $currency['rate_buy_eur'] / $currency['rate_buy_gbp']); }
if ($cur == "4") { $route_sell_price = round($route_sell_price); }
}

if ($booking_shared == 1) {
$route_sell_price = $route_sell_price * $booking_total_pax;
}

if ($booking_shared == 2) {
$route_sell_price = $route_sell_price;
}

if ($booking_type == 1) { $last_price_sell = $route_sell_price; }
if ($booking_type == 2) { $last_price_sell = $route_sell_price * 2; }

if ($booking_type == 1) { $last_price_cost = $route_cost_price; }
if ($booking_type == 2) { $last_price_cost = $route_cost_price * 2; }

$arr = array ('response'=>'ok','vehicle'=>$img,'duration'=>$min,'distance'=>$dis,'price'=>$last_price_sell,'curr'=>$crr,'cprice'=>$last_price_cost,'ccurr'=>$cur);

echo json_encode($arr); exit;

}

?>