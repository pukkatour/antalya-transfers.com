<?php
include_once('site_id.php');
include_once('admin/include/initialize.inc.php');

$data = $Db->row("SELECT * FROM page_transfer WHERE page_lang_id = ?", array($site_lang));

if (!empty($_POST)) {

$b_type      = $_POST['b_type'];
$b_direction = $_POST['b_direction'];
$b_from      = $_POST['b_from'];
$b_to        = $_POST['b_to'];
$b_pax       = $_POST['b_pax'];
$b_way       = $_POST['b_way'];
$b_curr      = $_POST['b_curr'];


$transfer = $Db->row("SELECT * FROM transfer_routes WHERE route_airport_id = ? AND route_resort_id = ? AND route_pax >= ? ORDER BY route_pax ASC ", array($b_from,$b_to,$b_pax));
$airport  = $Db->row("SELECT * FROM transfer_airports WHERE airport_airport_id = ? AND airport_lang_id = ? ", array($b_from,$site_lang));
$resort   = $Db->row("SELECT * FROM transfer_resorts WHERE resort_resort_id = ? AND resort_lang_id = ? ", array($b_to,$site_lang));
$vehicle  = $Db->row("SELECT * FROM transfer_vehicles WHERE vehicle_vehicle_id = ? AND vehicle_lang_id = ? ", array($transfer['route_vehicle_id'],$site_lang));
$currcode = $Db->row("SELECT curr_code FROM currencies WHERE curr_id = ? ", array($b_curr));


if ($b_direction == 1) {
$from = $airport['airport_name'];
$to   = $resort['resort_name'];
$page_title = $from.", ".$to." ".$translate['tr_022'];
}
if ($b_direction == 2) {
$to   = $airport['airport_name'];
$from = $resort['resort_name'];
$page_title = $to.", ".$from." ".$translate['tr_022'];
}

$route_cost_curr  = $transfer['route_cost_curr'];


if ($b_type == 1) {
$route_cost_price = $transfer['route_single_cost'];
$route_sell_price = $transfer['route_single_sell'];
}

if ($b_type == 2) {
$route_cost_price = $transfer['route_cost_price'];
$route_sell_price = $transfer['route_sell_price'];
}


if ($b_curr == "1") { // TRY
if ($route_cost_curr == "1") { $route_sell_price = round($route_sell_price); }
if ($route_cost_curr == "2") { $route_sell_price = round($route_sell_price * $currency['rate_buy_usd']); }
if ($route_cost_curr == "3") { $route_sell_price = round($route_sell_price * $currency['rate_buy_eur']); }
if ($route_cost_curr == "4") { $route_sell_price = round($route_sell_price * $currency['rate_buy_gbp']); }
}

elseif ($b_curr == "2") { // USD
if ($route_cost_curr == "1") { $route_sell_price = round($route_sell_price / $currency['rate_buy_usd']); }
if ($route_cost_curr == "2") { $route_sell_price = round($route_sell_price); }
if ($route_cost_curr == "3") { $route_sell_price = round($route_sell_price * $currency['rate_buy_eur'] / $currency['rate_buy_usd']); }
if ($route_cost_curr == "4") { $route_sell_price = round($route_sell_price * $currency['rate_buy_gbp'] / $currency['rate_buy_usd']); }
}

elseif ($b_curr == "3") { // EUR
if ($route_cost_curr == "1") { $route_sell_price = round($route_sell_price / $currency['rate_buy_eur']); }
if ($route_cost_curr == "2") { $route_sell_price = round($route_sell_price * $currency['rate_buy_usd'] / $currency['rate_buy_eur']); }
if ($route_cost_curr == "3") { $route_sell_price = round($route_sell_price); }
if ($route_cost_curr == "4") { $route_sell_price = round($route_sell_price * $currency['rate_buy_gbp'] / $currency['rate_buy_eur']); }
}

elseif ($b_curr == "4") { // GBP
if ($route_cost_curr == "1") { $route_sell_price = round($route_sell_price / $currency['rate_buy_gbp']); }
if ($route_cost_curr == "2") { $route_sell_price = round($route_sell_price * $currency['rate_buy_usd'] / $currency['rate_buy_gbp']); }
if ($route_cost_curr == "3") { $route_sell_price = round($route_sell_price * $currency['rate_buy_eur'] / $currency['rate_buy_gbp']); }
if ($route_cost_curr == "4") { $route_sell_price = round($route_sell_price); }
}

if ($b_type == 1) {
$route_sell_price = $route_sell_price * $b_pax;
$vehicle_type = $translate['tr_004'];
}

if ($b_type == 2) {
$route_sell_price = $route_sell_price;
$vehicle_type = $translate['tr_005'];
}

if ($b_way == 1) { $last_price_cost = $route_cost_price; }
if ($b_way == 1) { $last_price_sell = $route_sell_price; }
if ($b_way == 2) { $last_price_cost = $route_cost_price * 2; }
if ($b_way == 2) { $last_price_sell = $route_sell_price * 2; }

}

$pagename = "Transfers";
include_once("hit_counter.php");

include_once('admin/include/captcha/captcha.php');
$_SESSION['captcha'] = simple_php_captcha();

?>

<!DOCTYPE html>
<html lang="en">

<head>

<title><?php echo $page_title." ".$data['page_title']; ?></title>
<meta name="description" content="<?php echo $page_title." ".$data['page_description']; ?>">
<meta name="keywords" content="<?php echo $page_title." ".$data['page_keywords']; ?>">

<?php include_once("head_meta.php"); ?>

</head>

<body>

<?php include_once("head_menu.php"); ?>

<div class="video-container section-container">
<div class="container">

<div class="row">

<div class="col-sm-12">
<h1><?php echo $page_title; ?></h1>
</div>

<div class="col-sm-5 fadeInUp animated">

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
<div class="carousel-inner" role="listbox">
<div class="item active">
<img src="<?php echo IMAGE_FOLDER; ?>transfer/<?php echo $vehicle['vehicle_img1']; ?>" alt="<?php echo $sitesettings['site_name']; ?>" title="<?php echo $sitesettings['site_name']; ?>" class="img-responsive">
</div>
<div class="item">
<img src="<?php echo IMAGE_FOLDER; ?>transfer/<?php echo $vehicle['vehicle_img2']; ?>" alt="<?php echo $sitesettings['site_name']; ?>" title="<?php echo $sitesettings['site_name']; ?>" class="img-responsive">
</div>
<div class="item">
<img src="<?php echo IMAGE_FOLDER; ?>transfer/<?php echo $vehicle['vehicle_img3']; ?>" alt="<?php echo $sitesettings['site_name']; ?>" title="<?php echo $sitesettings['site_name']; ?>" class="img-responsive">
</div>
</div>
</div>

</div>

<div class="col-sm-7 video-box video-box-right wow fadeInUp">
<h4><?php echo $from." -> ".$to; ?> <?php echo $data['page_name']; ?></h4>
<table class="table table-bordered">
<tbody> 
<tr><td><i class="fa fa-check featuresicons"></i> <?php echo $translate['tr_003']; ?>: </td><td><?php echo $vehicle_type; ?></td></tr>
<?php if ($b_direction == 1) { ?>
<tr><td><i class="fa fa-check featuresicons"></i> <?php echo $translate['tr_009']; ?>: </td><td><?php echo $from; ?></td></tr>
<tr><td><i class="fa fa-check featuresicons"></i> <?php echo $translate['tr_011']; ?>: </td><td><?php echo $to; ?></td></tr>
<?php } ?>
<?php if ($b_direction == 2) { ?>
<tr><td><i class="fa fa-check featuresicons"></i> <?php echo $translate['tr_009']; ?>: </td><td><?php echo $from; ?></td></tr>
<tr><td><i class="fa fa-check featuresicons"></i> <?php echo $translate['tr_011']; ?>: </td><td><?php echo $to; ?></td></tr>
<?php } ?>
<tr><td><i class="fa fa-check featuresicons"></i> <?php echo $translate['tr_023']; ?>: </td><td><?php echo $transfer['route_distance']; ?> <?php echo $translate['tr_024']; ?>. | <?php echo $transfer['route_minute']; ?> <?php echo $translate['tr_025']; ?>.</td></tr>
<tr><td><i class="fa fa-check featuresicons"></i> <?php echo $translate['tr_014']; ?>: </td><td><?php echo $b_pax; ?> <?php echo $translate['tr_015']; ?></td></tr>
<tr><td><i class="fa fa-check featuresicons"></i> <?php echo $translate['tr_018']; ?> | <?php echo $translate['tr_002']; ?>: </td><td><?php if ($b_way == 1) { echo $translate['tr_026']." | "; } else { echo $translate['tr_027']." | "; } echo "<b>".$last_price_sell." ".$currcode['curr_code']."</b>"; ?></td></tr>
</tbody>
</table>
</div>

</div>
</div>
</div>

<div class="more-features-container section-container section-container-gray-bg">
<div class="container">

<div class="row">

<div class="col-md-8 col-md-push-2 text-left">

<form id='booking_form'>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<h2><?php echo $translate['tr_028']; ?></h2>
<h3><?php echo $translate['tr_029']; ?></h3>
<hr>
</div>
</div>

<div class="row">

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
<div class="form-group">
<label><?php echo $translate['tr_030']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control h_firstcap b-form" name="booking_name" minlength="2" maxlength="200" required="">
</div>
</div>

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
<div class="form-group">
<label><?php echo $translate['tr_031']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control h_firstcap b-form" name="booking_surname" minlength="2" maxlength="200" required="">
</div>
</div>

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
<div class="form-group">
<label><?php echo $translate['tr_032']; ?> <span class="text-danger">*</span></label>
<input type="email" class="form-control b-form" name="booking_email" minlength="8" maxlength="200" required="">
</div>
</div>

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
<div class="form-group">
<label><?php echo $translate['tr_033']; ?> <span class="text-danger">*</span></label>
<input type="email" class="form-control b-form" name="booking_email_a" minlength="8" maxlength="200" required="">
</div>
</div>

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
<div class="form-group">
<label><?php echo $translate['tr_034']; ?> <span class="text-danger">*</span></label>
<select class='form-control b-form' name='booking_country' required="">
<option value="nou"><?php echo $translate['tr_035']; ?></option>
<?php if (!empty($countrylist)) { foreach ($countrylist as $country) { ?>
<option <?php if ($country['country_id'] == 224) { echo 'selected="selected"'; } ?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_phone_code']." ".$country['country_name']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
<div class="form-group">
<label><?php echo $translate['tr_036']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form" name="booking_phone" minlength="5" maxlength="30" onkeypress="return h_isNumber(event)" required="">
</div>
</div>

</div>

<?php if ($b_direction == 1 && $b_way == 1) { ?>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<h3><?php echo $translate['tr_037']; ?></h3>
<hr>
</div>
</div>

<div class="row">

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_038']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form" name="booking_arv_flight_no" minlength="3" maxlength="15" required="">
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_039']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form" name="booking_arv_flight_date" id="booking_arv_flight_date" data-date-format="dd-mm-yyyy" required="">
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_040']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form" name="booking_arv_flight_time" id="booking_arv_flight_time" required="">
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="form-group">
<label><?php echo $translate['tr_041']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form" name="booking_stay_address" maxlength="250" required="">
</div>
</div>

</div>

<?php } ?>

<?php if ($b_direction == 1 && $b_way == 2) { ?>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<h3><?php echo $translate['tr_037']; ?></h3>
<hr>
</div>
</div>

<div class="row">

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_038']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form" name="booking_arv_flight_no" minlength="3" maxlength="15" required="">
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_039']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form" name="booking_arv_flight_date" id="booking_arv_flight_date" data-date-format="dd-mm-yyyy" required="">
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_040']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form" name="booking_arv_flight_time" id="booking_arv_flight_time" required="">
</div>
</div>

</div>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<h3><?php echo $translate['tr_042']; ?></h3>
<hr>
</div>
</div>

<div class="row">

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_043']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form" name="booking_dep_flight_no" minlength="3" maxlength="15" required="">
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_044']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form" name="booking_dep_flight_date" id="booking_dep_flight_date" data-date-format="dd-mm-yyyy" required="">
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_045']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form" name="booking_dep_flight_time" id="booking_dep_flight_time" required="">
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="form-group">
<label><?php echo $translate['tr_046']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form" name="booking_stay_address" maxlength="250" required="">
</div>
</div>

</div>

<div class="row dispno" id="pick_div">
<div class="alert alert-success" role="alert"> <i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $translate['tr_047']; ?> <h1><strong id="get_time"></strong></h1></div>
<hr>
</div>

<?php } ?>

<?php if ($b_direction == 2 && $b_way == 1) { ?>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<h3><?php echo $translate['tr_042']; ?></h3>
<hr>
</div>
</div>

<div class="row">

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_043']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form" name="booking_dep_flight_no" minlength="3" maxlength="15" required="">
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_044']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form" name="booking_dep_flight_date" id="booking_dep_flight_date" data-date-format="dd-mm-yyyy" required="">
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_045']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form" name="booking_dep_flight_time" id="booking_dep_flight_time" required="">
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="form-group">
<label><?php echo $translate['tr_046']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form" name="booking_stay_address" maxlength="250" required="">
</div>
</div>

</div>

<div class="row dispno" id="pick_div">
<div class="alert alert-success" role="alert"> <i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $translate['tr_047']; ?> <h1><strong id="get_time"></strong></h1></div>
<hr>
</div>

<?php } ?>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<h3><?php echo $translate['tr_049']; ?></h3>
<hr>
<div class="alert alert-warning" role="alert"> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $translate['tr_050']; ?></div>
</div>
</div>

<div class="row">

<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
<div class="form-group">
<label><?php echo $translate['tr_051']; ?></label>
<select class="form-control b-form" name="booking_child_seat">
<option value="0"><?php echo $translate['tr_053']; ?></option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
</select>
</div>
</div>

<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
<div class="form-group">
<label><?php echo $translate['tr_052']; ?></label>
<select class="form-control b-form" name="booking_baby_seat">
<option value="0"><?php echo $translate['tr_053']; ?></option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
</select>
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="form-group">
<label><?php echo $translate['tr_054']; ?></label>
<input type="text" class="form-control b-form" name="booking_customer_note">
</div>
</div>

</div>

<div class="row">
<hr>
</div>

<div class="row">

<div class="col-xs-6 col-sm-5 col-md-4 col-lg-4">
<div class="form-group">
<?php echo '<img src="'.$_SESSION['captcha']['image_src'].'" alt="'.$sitesettings['site_name'].'">'; ?>
</div>
</div>

<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
<div class="form-group mtop20">
<input type="text" class="form-control b-form" id="verify" name="verify" placeholder="<?php echo $translate['tr_055']; ?>" required="">
</div>
</div>

<div class="col-xs-12 col-sm-3 col-md-4 col-lg-4">
<div class="form-group mtop20">
<button type="submit" class="btn btn-warning btn-block btn-lg"><?php echo $translate['tr_056']; ?></button>
</div>
</div>

</div>

<input type="hidden" name="booking_shared" value="<?php echo $b_type; ?>">
<input type="hidden" name="booking_from_to" value="<?php echo $b_direction; ?>">
<input type="hidden" name="booking_airport" value="<?php echo $b_from; ?>">
<input type="hidden" name="booking_resort" value="<?php echo $b_to; ?>">
<input type="hidden" name="booking_total_pax" value="<?php echo $b_pax; ?>">
<input type="hidden" name="booking_type" value="<?php echo $b_way; ?>">
<input type="hidden" name="booking_cost_curr" value="<?php echo $route_cost_curr; ?>">
<input type="hidden" name="booking_cost_price" value="<?php echo $last_price_cost; ?>">
<input type="hidden" name="booking_sale_curr" value="<?php echo $b_curr; ?>">
<input type="hidden" name="booking_sale_price" value="<?php echo $last_price_sell; ?>">
<input type="hidden" name="booking_dep_flight_pickup" id="pickup" value=" ">

</form>

</div>

</div>

</div>
</div>


<?php include_once("footer.php"); ?>

<?php include_once("footer_scripts.php"); ?>

<?php if ($b_direction == 1 && $b_way == 1) { ?>
<script>
$(function() {
$('#booking_arv_flight_time').timepicker({ 'timeFormat': 'H:i', 'step': 15 });
});

$('#booking_arv_flight_date').datepicker({
todayHighlight: true,
autoclose: true,
format: 'dd-mm-yyyy',
startDate: "0",
language: 'tr'
});
</script>
<?php } ?>

<?php if ($b_direction == 1 && $b_way == 2) { ?>
<script>
$(function() {
$('#booking_arv_flight_time').timepicker({ 'timeFormat': 'H:i', 'step': 15 });
$('#booking_dep_flight_time').timepicker({ 'timeFormat': 'H:i', 'step': 15 });
});

var nowTemp = new Date();
var now     = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

var checkin = $('#booking_arv_flight_date').datepicker({
beforeShowDay: function (date) {
return date.valueOf() >= now.valueOf();
},
orientation: "top auto",
autoclose: true,
format: 'dd-mm-yyyy',
language: 'tr'
}).on('changeDate', function (ev) {
if (ev.date.valueOf() > checkout.datepicker("getDate").valueOf() || !checkout.datepicker("getDate").valueOf()) {
var newDate = new Date(ev.date);
newDate.setDate(newDate.getDate() + 0);
checkout.datepicker("update", newDate);
}
});
var checkout = $('#booking_dep_flight_date').datepicker({
beforeShowDay: function (date) {
if (!checkin.datepicker("getDate").valueOf()) {
return date.valueOf() >= new Date().valueOf();
} else {
return date.valueOf() > checkin.datepicker("getDate").valueOf();
}
},
orientation: "top auto",
autoclose: true,
format: 'dd-mm-yyyy',
language: 'tr'
}).on('changeDate', function (ev) {});

$('#booking_dep_flight_date').on('blur', function() {
$('#booking_dep_flight_time').val('');
$("#get_time").html('');
$('#pickup').val('');
});

$('#booking_dep_flight_time').on('blur', function() {
var datex = $('#booking_dep_flight_date').val();
var timex = $('#booking_dep_flight_time').val();
var distx = <?php echo $transfer['route_minute']; ?>;
$.post(
'<?php echo SITE_URL; ?>transfer_calculate.php',
{"datex": datex,"timex": timex,"distx": distx},
function(data) {
var objJSON = JSON.parse(data);
if(objJSON.response == "ok") {
$booking_check_in = objJSON.result;
$("#get_time").html($booking_check_in);
$('#pickup').val($booking_check_in);
$('#pick_div').show("slow");
}
});
});
</script>
<?php } ?>

<?php if ($b_direction == 2 && $b_way == 1) { ?>
<script>
$(function() {
$('#booking_dep_flight_time').timepicker({ 'timeFormat': 'H:i', 'step': 15 });
});

$('#booking_dep_flight_date').datepicker({
todayHighlight: true,
autoclose: true,
language: 'tr',
format: 'dd-mm-yyyy',
startDate: "0"
});

$('#booking_dep_flight_date').on('blur', function() {
$('#booking_dep_flight_time').val('');
$("#get_time").html('');
$('#pickup').val('');
});

$('#booking_dep_flight_time').on('blur', function() {
var datex = $('#booking_dep_flight_date').val();
var timex = $('#booking_dep_flight_time').val();
var distx = <?php echo $transfer['route_minute']; ?>;
$.post(
'<?php echo SITE_URL; ?>transfer_calculate.php',
{"datex": datex,"timex": timex,"distx": distx},
function(data) {
var objJSON = JSON.parse(data);
if(objJSON.response == "ok") {
$booking_check_in = objJSON.result;
$("#get_time").html($booking_check_in);
$('#pickup').val($booking_check_in);
$('#pick_div').show("slow");
}
});
});
</script>
<?php } ?>

<script>
$("#booking_form").submit(function( event ) {
event.preventDefault();

$.ajax({
url:  "<?php echo SITE_URL; ?>admin/include/captcha/capcontrol.php",
type: 'GET',
data: { field: $('#verify').val() },
success: function(response){
if(response == 2){
swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_057']; ?>", "error");
}
if(response == 1){
$.ajax({
url: "<?php echo SITE_URL; ?>transfer_book.php",
type: 'POST',
data: $('#booking_form').serialize(),
success: function(data){
var objJSON = JSON.parse(data);
if (objJSON.response === "ok") {
swal("<?php echo $translate['tr_058']; ?>", "<?php echo $translate['tr_059']; ?>", "success");
$('#booking_form')[0].reset();
setTimeout(function (){ window.location = "<?php echo $selectedlang['lang_url']; ?>";}, 3000);
}
else {
if(objJSON.response == "email"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_061']; ?>", "error"); }
if(objJSON.response == "error"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_062']; ?>", "error"); }
if(objJSON.response == "adult"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_063']; ?>", "error"); }
if(objJSON.response == "empty_name"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_064']; ?>", "error"); }
if(objJSON.response == "empty_surname"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_065']; ?>", "error"); }
if(objJSON.response == "empty_email"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_066']; ?>", "error"); }
if(objJSON.response == "empty_email_a"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_067']; ?>", "error"); }
if(objJSON.response == "match_error"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_068']; ?>", "error"); }
if(objJSON.response == "empty_counrty"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_069']; ?>", "error"); }
if(objJSON.response == "empty_phone"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_070']; ?>", "error"); }
if(objJSON.response == "empty_address"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_071']; ?>", "error"); }
if(objJSON.response == "empty_arrival_no"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_072']; ?>", "error"); }
if(objJSON.response == "empty_arrival_day"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_073']; ?>", "error"); }
if(objJSON.response == "empty_arrival_hour"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_074']; ?>", "error"); }
if(objJSON.response == "empty_departure_no"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_075']; ?>", "error"); }
if(objJSON.response == "empty_departure_day"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_076']; ?>", "error"); }
if(objJSON.response == "empty_departure_hour"){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_077']; ?>", "error"); }
}
}
});
}
}
});

});
</script>

</body>

</html>

<?php ob_end_flush(); ?>