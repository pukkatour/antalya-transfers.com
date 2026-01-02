<?php
include_once('../site_id.php');
include_once('../../admin/include/initialize.inc.php');

$data      = $Db->row("SELECT * FROM page_transfer_list WHERE page_lang_id = ?", array($site_lang));

$airports  = $Db->query("SELECT airport_airport_id,airport_geo,airport_slug,airport_name FROM transfer_airports WHERE airport_lang_id = ? ORDER BY airport_name ASC", array($site_lang));

$districts = $Db->query("SELECT resort_resort_id,resort_name FROM transfer_resorts WHERE resort_lang_id = ? AND resort_is_hotel = ? ORDER BY resort_name ASC", array($site_lang,'1'));
$hotel_dis = $Db->query("SELECT transfer_resorts.resort_is_related, t2.resort_name AS reso_name FROM transfer_resorts LEFT JOIN transfer_resorts AS t2 ON t2.resort_resort_id = transfer_resorts.resort_is_related WHERE transfer_resorts.resort_lang_id = ? AND transfer_resorts.resort_is_hotel = ? GROUP BY transfer_resorts.resort_is_related ORDER BY reso_name ASC", array($site_lang,'2'));

$air       = $Db->row("SELECT airport_airport_id,airport_name,airport_geo FROM transfer_airports WHERE airport_slug = ? AND airport_lang_id = ? ORDER BY airport_name ASC", array($_GET['airport'],$site_lang));
$res       = $Db->row("SELECT resort_resort_id,resort_name,resort_geo FROM transfer_resorts WHERE resort_slug = ? AND resort_lang_id = ? ORDER BY resort_name ASC", array($_GET['resort'],$site_lang));


$from = $air['airport_name'];
$to   = $res['resort_name'];
$page_title = $from." - ".$to." ".$translate['tr_022'];


$pagename = "Transfer Details";
include_once("../../hit_counter.php");

include_once('../../admin/include/captcha/captcha.php');
$_SESSION['captcha'] = simple_php_captcha();

?>

<!DOCTYPE html>
<html lang="tr">

<head>

<title><?php echo $page_title." ".$data['page_title']; ?></title>
<meta name="description" content="<?php echo $page_title." ".$data['page_description']; ?>">
<meta name="keywords" content="<?php echo $page_title." ".$data['page_keywords']; ?>">

<?php include_once("../../head_meta.php"); ?>

</head>

<body>

<?php include_once("../head_menu.php"); ?>

<div class="more-features-container section-container dudeback">
<div class="container">

<div class="row">
<div class="col-sm-12 more-features section-description wow fadeIn">
<h1 class="white_col"><?php echo $page_title; ?></h1>
</div>
</div>

<div class="row">

<div class="col-sm-5 r-form-1-box wow fadeInLeft">

<div class="r-form-1-bottom">

<form>

<div class="form-group" id="__type">
<label><b><?php echo $translate['tr_003']; ?> <span class="text-warning">*</span></b></label>
<select class="r-form-1-first-name form-control" id="tr_type" onchange="transfer_type_Fnc()">
<option value="0"><?php echo $translate['tr_003']; ?></option>
<option value="1"><?php echo $translate['tr_004']; ?></option>
<option value="2"><?php echo $translate['tr_005']; ?></option>
</select>
</div>

<div class="form-group">
<label><b><?php echo $translate['tr_006']; ?> <span class="text-warning">*</span></b></label>
<select class="r-form-1-first-name form-control" id="tr_direction" onchange="transfer_direction_Fnc()">
<option value="0"><?php echo $translate['tr_006']; ?></option>
<option value="1"><?php echo $translate['tr_007']; ?></option>
<option value="2"><?php echo $translate['tr_008']; ?></option>
</select>
</div>

<div class="form-group" id="__from">
<label id="transfer_airport_label"><b><?php echo $translate['tr_009']; ?> <span class="text-warning">*</span></b></label>
<select class="r-form-1-first-name form-control" id="tr_from" onchange="transfer_from_Fnc()">
<option value="0"><?php echo $translate['tr_010']; ?></option>
<?php if (!empty($airports)) { foreach ($airports as $airport) { ?>
<option <?php if (!empty($_GET['airport'])) { if ($airport['airport_airport_id'] == $air['airport_airport_id']) { echo 'selected="selected"'; } } ?> value="<?php echo $airport['airport_airport_id']; ?>"><?php echo $airport['airport_name']; ?></option>
<?php } } ?>
</select>
</div>

<div class="form-group" id="__to">
<label id="transfer_resort_label"><b><?php echo $translate['tr_011']; ?> <span class="text-warning">*</span></b></label>
<select class="r-form-1-first-name form-control" id="tr_to" onchange="transfer_to_Fnc()">
<option value="0"><?php echo $translate['tr_012']; ?></option>
<?php if (!empty($districts)) { foreach ($districts as $dist) { ?>
<option <?php if (!empty($_GET['resort'])) { if ($dist['resort_resort_id'] == $res['resort_resort_id']) { echo 'selected="selected"'; } } ?> value="<?php echo $dist['resort_resort_id']; ?>"><?php echo $dist['resort_name']; ?></option>
<?php } } ?>

<?php
if (!empty($hotel_dis)) { foreach ($hotel_dis as $hotel_d) {
$hotels = $Db->query("SELECT resort_resort_id,resort_name FROM transfer_resorts WHERE resort_lang_id = ? AND resort_is_hotel = ? AND resort_is_related = ? ORDER BY resort_name ASC", array($site_lang,'2',$hotel_d['resort_is_related']));
?>
<optgroup label="<?php echo $hotel_d['reso_name']; ?> <?php echo $translate['tr_013']; ?>">
<?php if (!empty($hotels)) { foreach ($hotels as $hotel) { ?>
<option <?php if (!empty($_GET['resort'])) { if ($hotel['resort_resort_id'] == $res['resort_resort_id']) { echo 'selected="selected"'; } } ?> value="<?php echo $hotel['resort_resort_id']; ?>"><?php echo $hotel['resort_name']; ?></option>
<?php } } ?>
</optgroup>
<?php } } ?>

</select>
</div>

<div class="row">

<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<div class="form-group">
<label><b><?php echo $translate['tr_014']; ?> <span class="text-warning">*</span></b></label>
<select class="r-form-1-first-name form-control" id="guests" onchange="transfer_guest_Fnc()">
<option value="0"><?php echo $translate['tr_015']; ?></option>
<?php for ($x = 1; $x <= 14; $x++) { ?>
<option value="<?php echo $x; ?>"><?php echo $x; ?></option>
<?php } ?>
</select>
</div>
</div>

<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<div class="form-group">
<label><b><?php echo $translate['tr_016']; ?> <span class="text-warning">*</span></b></label>
<select class="r-form-1-first-name form-control" id="curr" onchange="transfer_curr_Fnc()">
<option value="0"><?php echo $translate['tr_017']; ?></option>
<?php if (!empty($currencylist)) { foreach ($currencylist as $currency) { ?>
<option value="<?php echo $currency['curr_id']; ?>"><?php echo $currency['curr_code']; ?></option>
<?php } } ?>
</select>
</div>
</div>

</div>

<div class="form-group" id="__ret">
<label><b><?php echo $translate['tr_018']; ?> <span class="text-warning">*</span></b></label>
<select class="r-form-1-first-name form-control" id="tr_booking" onchange="one_ret_Fnc()">
<option value="0"><?php echo $translate['tr_018']; ?></option>
<option value="1"><?php echo $translate['tr_019']; ?></option>
<option value="2"><?php echo $translate['tr_020']; ?></option>
</select>
</div>

<p class="terms"><?php echo $translate['tr_021']; ?></p>

<input type="hidden" id="new_from" value="<?php echo $air['airport_geo']; ?>">
<input type="hidden" id="new_to" value="<?php echo $res['resort_geo']; ?>">

</form>

</div>

</div>

<div class="col-sm-7 text wow fadeInUp containerx">

<div id="map" style="height: 350px;width: 100%;border: 2px solid #e8a860;"></div>

<div class="r-form-1-bottom" id="result" style="margin-top: 51px;display:none;">

<form id="transfer_form">

<div class="row">

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
<img class="img-responsive img-thumbnail" id="result_vehicle" src="" alt="<?php echo $sitesettings['site_name']; ?>" title="<?php echo $sitesettings['site_name']; ?>">
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
<hr class="visible-xs">
<h1 id="result_duration" class="white_col">...</h1>
<p id="result_distance"></p>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
<hr class="visible-xs">
<h1 id="result_price" class="white_col">...</h1>
<p><?php echo $translate['tr_002']; ?></p>
</div>

<div class="col-md-12 text-center">
<hr>
<button type="submit" class="btn btn-link-1"><?php echo $translate['tr_001']; ?></button>
</div>

</div>

</form>

</div>

</div>

</div>

</div>
</div>

<div class="more-features-container section-container section-container-gray-bg padtop30" id="bok_form" style="display:none;">
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


<div id="arr_only">

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
<input type="text" class="form-control b-form arr" name="booking_arv_flight_no" id="booking_arv_flight_no1" minlength="3" maxlength="15" required="">
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_039']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form booking_arv_flight_date arr" name="booking_arv_flight_date" id="booking_arv_flight_date1" data-date-format="dd-mm-yyyy" required="">
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_040']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form booking_arv_flight_time arr" name="booking_arv_flight_time" id="booking_arv_flight_time1" required="">
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="form-group">
<label><?php echo $translate['tr_041']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form arr" name="booking_stay_address" id="booking_stay_address1" maxlength="250" required="">
</div>
</div>

</div>

</div>


<div id="both">

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
<input type="text" class="form-control b-form both" name="booking_arv_flight_no" id="booking_arv_flight_no2" minlength="3" maxlength="15" required="">
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_039']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form booking_arv_flight_date both" name="booking_arv_flight_date" id="booking_arv_flight_date2" data-date-format="dd-mm-yyyy" required="">
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_040']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form booking_arv_flight_time both" name="booking_arv_flight_time" id="booking_arv_flight_time2" required="">
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
<input type="text" class="form-control b-form both" name="booking_dep_flight_no" id="booking_dep_flight_no1" minlength="3" maxlength="15" required="">
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_044']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form booking_dep_flight_date both" name="booking_dep_flight_date" id="booking_dep_flight_date1" data-date-format="dd-mm-yyyy" required="">
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_045']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form booking_dep_flight_time both" name="booking_dep_flight_time" id="booking_dep_flight_time1" required="">
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="form-group">
<label><?php echo $translate['tr_046']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form both" name="booking_stay_address" id="booking_stay_address2" maxlength="250" required="">
</div>
</div>

</div>

<div class="row" id="pick_div" style="display:none;">
<div class="alert alert-success" role="alert"> <i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $translate['tr_047']; ?> <h1><strong id="get_time"></strong></h1></div>
<hr>
</div>

</div>


<div id="dep_only">

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
<input type="text" class="form-control b-form dep" name="booking_dep_flight_no" id="booking_dep_flight_no2" minlength="3" maxlength="15" required="">
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_044']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form booking_dep_flight_date dep" name="booking_dep_flight_date" id="booking_dep_flight_date2" data-date-format="dd-mm-yyyy" required="">
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="form-group">
<label><?php echo $translate['tr_045']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form booking_dep_flight_time dep" name="booking_dep_flight_time" id="booking_dep_flight_time2" required="">
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="form-group">
<label><?php echo $translate['tr_046']; ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control b-form dep" name="booking_stay_address" id="booking_stay_address3" maxlength="250" required="">
</div>
</div>

</div>

<div class="row" id="pick_div" style="display:none;">
<div class="alert alert-success" role="alert"> <i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $translate['tr_047']; ?> <h1><strong id="get_time"></strong></h1></div>
<hr>
</div>

</div>


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

<div class="row"><hr></div>

<div class="row">

<div class="col-xs-6 col-sm-5 col-md-4 col-lg-4">
<div class="form-group">
<?php echo '<img src="'.$_SESSION['captcha']['image_src'].'" alt="'.$sitesettings['site_name'].'">'; ?>
</div>
</div>

<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
<div class="form-group" style="margin-top: 20px;">
<input type="text" class="form-control b-form" id="verify" name="verify" placeholder="<?php echo $translate['tr_055']; ?>" required="">
</div>
</div>

<div class="col-xs-12 col-sm-3 col-md-4 col-lg-4">
<div class="form-group" style="margin-top: 20px;">
<button type="submit" class="btn btn-warning btn-block btn-lg"><?php echo $translate['tr_056']; ?></button>
</div>
</div>

</div>

<input type="hidden" id="b_type" name="booking_shared" value="">
<input type="hidden" id="b_direction" name="booking_from_to" value="">
<input type="hidden" id="b_from" name="booking_airport" value="">
<input type="hidden" id="b_to" name="booking_resort" value="">
<input type="hidden" id="b_pax" name="booking_total_pax" value="">
<input type="hidden" id="b_way" name="booking_type" value="">
<input type="hidden" id="b_cost_curr" name="booking_cost_curr" value="">
<input type="hidden" id="b_cost_price" name="booking_cost_price" value="">
<input type="hidden" id="b_sale_curr" name="booking_sale_curr" value="">
<input type="hidden" id="b_sale_price" name="booking_sale_price" value="">
<input type="hidden" id="b_pickup" name="booking_dep_flight_pickup" value=" ">

</form>

</div>

</div>

</div>
</div>


<?php include_once("../footer.php"); ?>

<?php include_once("../../footer_scripts.php"); ?>

<?php if ($sitesettings['site_transfer_shuttle'] == 1) { ?>
<script>
$( document ).ready(function() {
$('#tr_type').val(2).trigger('change');
$('#__type').hide();
});
</script>
<?php } ?>

<script>
$( document ).ready(function() {
$('#tr_direction').val(1).trigger('change');
});
</script>

<script>
function initMap() {
var directionsService = new google.maps.DirectionsService();
var directionsRenderer = new google.maps.DirectionsRenderer();
var map = new google.maps.Map(document.getElementById('map'), {
zoom: 6,
disableDefaultUI: true,
mapTypeControl: false,
zoomControl: false,
streetViewControl: false,
center: {lat: 38.644497, lng: 34.832333}
});
directionsRenderer.setMap(map);
var onChangeHandler = function() { calculateAndDisplayRoute(directionsService, directionsRenderer); };
$(document).on('change', '#new_from', function() { onChangeHandler(); });
$(document).on('change', '#new_to', function() { onChangeHandler(); });
$(document).ready(function() { onChangeHandler(); transfer_from_Fnc(); transfer_to_Fnc(); });
}
function calculateAndDisplayRoute(directionsService, directionsRenderer) {
directionsService.route(
{
origin: {query: document.getElementById('new_from').value},
destination: {query: document.getElementById('new_to').value},
travelMode: 'DRIVING'
},
function(response, status) {
if (status === 'OK') {
directionsRenderer.setDirections(response);
}
});
}
</script>

<script>
var transfer_type;
var transfer_direction;
var transfer_booking;
var transfer_from;
var transfer_to;
var transfer_pax;
var transfer_curr;

function transfer_type_Fnc() {
transfer_type = $('#tr_type').find('option:selected').val();
hesaPLA();
};

function transfer_direction_Fnc() {
transfer_direction = $('#tr_direction').find('option:selected').val();

if (transfer_direction == 1) {

$("#__ret").show();

$("#transfer_airport_label").html('<b><?php echo $translate['tr_009']; ?> <span class="text-warning">**</span></b>');
$("#transfer_resort_label").html('<b><?php echo $translate['tr_011']; ?> <span class="text-warning">**</span></b>');

$("#__to").insertAfter("#__from");

hesaPLA();

}

if (transfer_direction == 2) {

$("#__ret").hide();
$('#tr_booking').val(1).trigger('change');

$("#transfer_airport_label").html('<b><?php echo $translate['tr_011']; ?> <span class="text-warning">**</span></b>');
$("#transfer_resort_label").html('<b><?php echo $translate['tr_009']; ?> <span class="text-warning">**</span></b>');

$("#__from").insertAfter("#__to");

one_Fnc();
hesaPLA();
}

};

function transfer_from_Fnc() {
transfer_from = $('#tr_from').find('option:selected').val();
$.post('<?php echo SITE_URL; ?>transfer_info_air.php',{"air_id": transfer_from},
function(data) {
var objJSON = JSON.parse(data);
if (objJSON.response == "ok") {
$from_slug    = objJSON.slug;
$from_latlng  = objJSON.latlng;
$('#new_air_slug').val($from_slug).trigger('change');
$('#new_from').val($from_latlng).trigger('change');
}
});
$("#getlostcanim").hide("fast");
$("#top-content").slideDown("slow");
setTimeout(function(){ $("#top-content").hide("slow"); }, 20000);
if (transfer_from === "0") { $("#result").hide("slow"); }
hesaPLA();
};

function transfer_to_Fnc() {
transfer_to = $('#tr_to').find('option:selected').val();
$.post('<?php echo SITE_URL; ?>transfer_info_des.php',{"des_id": transfer_to},
function(data) {
var objJSON = JSON.parse(data);
if (objJSON.response == "ok") {
$to_slug    = objJSON.slug;
$to_latlng  = objJSON.latlng;
$('#new_des_slug').val($to_slug).trigger('change');
$('#new_to').val($to_latlng).trigger('change');
}
});

if (transfer_to === "0") { $("#result").hide("slow"); }
hesaPLA();
};

function transfer_guest_Fnc() {
transfer_pax = $('#guests').find('option:selected').val();
if (transfer_pax === "0") { $("#result").hide("slow"); }
hesaPLA();
};

function transfer_curr_Fnc() {
transfer_curr = $('#curr').find('option:selected').val();
if (transfer_curr === "0") { $("#result").hide("slow"); }
hesaPLA();
};

function one_ret_Fnc() {
transfer_booking = $('#tr_booking').find('option:selected').val();
hesaPLA();
};

function hesaPLA() {
if (transfer_type != null && transfer_type != 0 && transfer_direction != null && transfer_direction != 0 && transfer_booking != null && transfer_booking != 0 && transfer_from != null && transfer_from != 0 && transfer_to != null && transfer_to != 0 && transfer_pax != null && transfer_pax != 0 && transfer_curr != null && transfer_curr != 0) {
$("#result").show("slow");
$.post('<?php echo SITE_URL."transfer_details.php"; ?>',
{"transfer_shared": transfer_type,"transfer_from": transfer_direction,"transfer_airport": transfer_from,"transfer_resort": transfer_to,"transfer_pax": transfer_pax,"transfer_type": transfer_booking,"transfer_curr": transfer_curr},
function(data) {
var objJSON = JSON.parse(data);
if(objJSON.response == "ok") {

$result_vehicle  = objJSON.vehicle;
$result_duration = objJSON.duration;
$result_distance = objJSON.distance;
$result_price    = objJSON.price;
$result_curr     = objJSON.curr;
$result_cost     = objJSON.cprice;
$result_costcur  = objJSON.ccurr;

$("#result_vehicle").attr("src","<?php echo IMAGE_FOLDER."transfer/"; ?>" + $result_vehicle);
$("#result_duration").html($result_duration + " <?php echo $translate['tr_025']; ?>");
$("#result_distance").html($result_distance + " <?php echo $translate['tr_024']; ?>");
$('#result_price').html($result_price + " " + $result_curr);

$('#b_type').val(transfer_type);
$('#b_direction').val(transfer_direction);
$('#b_from').val(transfer_from);
$('#b_to').val(transfer_to);
$('#b_pax').val(transfer_pax);
$('#b_sale_curr').val(transfer_curr);
$('#b_way').val(transfer_booking);
$('#b_sale_price').val($result_price);
$('#b_cost_curr').val($result_costcur);
$('#b_cost_price').val($result_cost);

}

});
}
};

$(function() {
$('.booking_arv_flight_time').timepicker({ 'timeFormat': 'H:i', 'step': 15 });
$('.booking_dep_flight_time').timepicker({ 'timeFormat': 'H:i', 'step': 15 });
});

var nowTemp = new Date();
var now     = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

var checkin = $('.booking_arv_flight_date').datepicker({
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

var checkout = $('.booking_dep_flight_date').datepicker({
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
$('.booking_dep_flight_date').on('blur', function() {
$('.booking_dep_flight_time').val('');
$("#get_time").html('');
$('#b_pickup').val('');
});

$('#booking_dep_flight_time1').on('blur', function() {
var datex = $('#booking_dep_flight_date1').val();
var timex = $('#booking_dep_flight_time1').val();
var distx = $('#result_duration').val();
$.post(
'<?php echo SITE_URL; ?>transfer_calculate.php',
{"datex": datex,"timex": timex,"distx": distx},
function(data) {
var objJSON = JSON.parse(data);
if(objJSON.response == "ok") {
$booking_check_in = objJSON.result;
$("#get_time").html($booking_check_in);
$('#b_pickup').val($booking_check_in);
$('#pick_div').show("slow");
}
});
});

$('#booking_dep_flight_time2').on('blur', function() {
var datex = $('#booking_dep_flight_date2').val();
var timex = $('#booking_dep_flight_time2').val();
var distx = $('#result_duration').val();
$.post(
'<?php echo SITE_URL; ?>transfer_calculate.php',
{"datex": datex,"timex": timex,"distx": distx},
function(data) {
var objJSON = JSON.parse(data);
if(objJSON.response == "ok") {
$booking_check_in = objJSON.result;
$("#get_time").html($booking_check_in);
$('#b_pickup').val($booking_check_in);
$('#pick_div').show("slow");
}
});
});

$("#transfer_form").submit(function( event ) {
event.preventDefault();
if (($("#transfer_from").val() == '2') && ($("#transfer_type").val() == '2')) { swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_091']; ?>", "warning"); return false; };
if ($("#from").val() == '0') { swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_092']; ?>", "warning"); return false; };
if ($("#to").val() == '0') { swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_093']; ?>", "warning"); return false; };
if ($("#guests").val() == '0') { swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_094']; ?>", "warning"); return false; };
if ($("#curr").val() == '0') { swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_095']; ?>", "warning"); return false; };
if (($("#transfer_from").val() != '0') && ($("#from").val() != '0') && ($("#to").val() != '0') && ($("#guests").val() != '0') && ($("#curr").val() != '0')) {
event.preventDefault();
$("#bok_form").show("slow");
$('html, body').animate({ scrollTop: $("#bok_form").offset().top }, 2000);

if (transfer_direction == 1) {

if (transfer_booking == 1) {
$("#arr_only").show("fast");
$("#both").hide("fast");
$("#dep_only").hide("fast");
$(".arr").prop('required',true);
$(".both").prop('required',false);
$(".dep").prop('required',false);

$(".both").attr('name', '');
$(".dep").attr('name', '');

};

if (transfer_booking == 2) {
$("#arr_only").hide("fast");
$("#both").show("fast");
$("#dep_only").hide("fast");
$(".arr").prop('required',false);
$(".both").prop('required',true);
$(".dep").prop('required',false);

$(".arr").attr('name', '');
$(".dep").attr('name', '');

}

};

if (transfer_direction == 2) {
if (transfer_booking == 1) {
$("#arr_only").hide("fast");
$("#both").hide("fast");
$("#dep_only").show("fast");
$(".arr").prop('required',false);
$(".both").prop('required',false);
$(".dep").prop('required',true);

$(".arr").attr('name', '');
$(".both").attr('name', '');

}
};

}
});

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

<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $sitesettings['site_google_maps_key']; ?>&callback=initMap&loading=async"></script>

</body>

</html>

<?php ob_end_flush(); ?>