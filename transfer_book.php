<?php
include_once('site_id.php');
include_once('admin/include/initialize.inc.php');
include_once('admin/include/class.phpmailer.php');
include_once('admin/include/class.smtp.php');


if (!empty($_POST)) {




/// GELEN VERİ

$booking_code                 = substr(md5(date('dmyhis')),0,6);
$booking_shared 	             = $_POST['booking_shared'] ? $_POST['booking_shared'] : NULL;
$booking_from_to 	            = $_POST['booking_from_to'] ? $_POST['booking_from_to'] : NULL;
$booking_airport              = $_POST['booking_airport'] ? $_POST['booking_airport'] : NULL;
$booking_resort               = $_POST['booking_resort'] ? $_POST['booking_resort'] : NULL;
$booking_total_pax            = $_POST['booking_total_pax'] ? $_POST['booking_total_pax'] : NULL;
$booking_type                 = $_POST['booking_type'] ? $_POST['booking_type'] : NULL;
$booking_cost_curr            = $_POST['booking_cost_curr'] ? $_POST['booking_cost_curr'] : NULL;
$booking_cost_price           = $_POST['booking_cost_price'] ? $_POST['booking_cost_price'] : NULL;
$booking_sale_curr            = $_POST['booking_sale_curr'] ? $_POST['booking_sale_curr'] : NULL;
$booking_sale_price           = $_POST['booking_sale_price'] ? $_POST['booking_sale_price'] : NULL;

$booking_name 	               = $_POST['booking_name'] ? $_POST['booking_name'] : NULL;
$booking_surname              = $_POST['booking_surname'] ? $_POST['booking_surname'] : NULL;
$booking_email                = $_POST['booking_email'] ? $_POST['booking_email'] : NULL;
$booking_email_a              = $_POST['booking_email_a'] ? $_POST['booking_email_a'] : NULL;
$booking_country              = $_POST['booking_country'] ? $_POST['booking_country'] : NULL;
$booking_phone                = $_POST['booking_phone'] ? $_POST['booking_phone'] : NULL;

$booking_arv_flight_no        = $_POST['booking_arv_flight_no'] ? $_POST['booking_arv_flight_no'] : NULL;
$booking_arv_flight_date      = $_POST['booking_arv_flight_date'] ? $_POST['booking_arv_flight_date'] : NULL;
$booking_arv_flight_time      = $_POST['booking_arv_flight_time'] ? $_POST['booking_arv_flight_time'] : NULL;
$booking_dep_flight_no        = $_POST['booking_dep_flight_no'] ? $_POST['booking_dep_flight_no'] : NULL;
$booking_dep_flight_date      = $_POST['booking_dep_flight_date'] ? $_POST['booking_dep_flight_date'] : NULL;
$booking_dep_flight_time      = $_POST['booking_dep_flight_time'] ? $_POST['booking_dep_flight_time'] : NULL;

$booking_dep_flight_pickup    = $_POST['booking_dep_flight_pickup'] ? $_POST['booking_dep_flight_pickup'] : NULL;

$booking_stay_address         = $_POST['booking_stay_address'] ? $_POST['booking_stay_address'] : NULL;
$booking_child_seat           = $_POST['booking_child_seat'] ? $_POST['booking_child_seat'] : '0';
$booking_baby_seat 	          = $_POST['booking_baby_seat'] ? $_POST['booking_baby_seat'] : '0';
$booking_customer_note        = $_POST['booking_customer_note'] ? $_POST['booking_customer_note'] : NULL;

if ($booking_arv_flight_date != NULL) { $booking_arv_flight_date = date("Y-m-d", strtotime($booking_arv_flight_date)); }
if ($booking_dep_flight_date != NULL) { $booking_dep_flight_date = date("Y-m-d", strtotime($booking_dep_flight_date)); }


$vehicle_id                   = $Db->row("SELECT route_vehicle_id FROM transfer_routes WHERE route_airport_id = ? AND route_resort_id = ? AND route_pax >= ? ORDER BY route_pax ASC ", array($booking_airport,$booking_resort,$booking_total_pax));
$booking_vehicle              = $vehicle_id['route_vehicle_id'];

/// GELEN VERİ




/// KONTROLLER

if (empty($booking_name) OR strlen($booking_name) < 2) { $arr = array ('response'=>'empty_name'); echo json_encode($arr); exit; }
if (empty($booking_surname) OR strlen($booking_surname) < 2) { $arr = array ('response'=>'empty_surname'); echo json_encode($arr); exit; }
if (empty($booking_email) OR strlen($booking_email) < 8) { $arr = array ('response'=>'empty_email'); echo json_encode($arr); exit; }
if (!filter_var($booking_email, FILTER_VALIDATE_EMAIL)) { $arr = array ('response'=>'email'); echo json_encode($arr); exit; }
if (empty($booking_email_a) OR strlen($booking_email_a) < 8) { $arr = array ('response'=>'empty_email_a'); echo json_encode($arr); exit; }
if ($booking_email != $booking_email_a) { $arr = array ('response'=>'match_error'); echo json_encode($arr); exit; }
if ($booking_country === "nou") { $arr = array ('response'=>'empty_counrty'); echo json_encode($arr); exit; }
if (empty($booking_phone) OR strlen($booking_phone) < 5) { $arr = array ('response'=>'empty_phone'); echo json_encode($arr); exit; }

if ($booking_from_to == 1 && $booking_type == 1) {
if (empty($booking_arv_flight_no) OR strlen($booking_arv_flight_no) < 2) { $arr = array ('response'=>'empty_arrival_no'); echo json_encode($arr); exit; }
if (empty($booking_arv_flight_date)) { $arr = array ('response'=>'empty_arrival_day'); echo json_encode($arr); exit; }
if (empty($booking_arv_flight_time)) { $arr = array ('response'=>'empty_arrival_hour'); echo json_encode($arr); exit; }
}

if ($booking_from_to == 2 && $booking_type == 1) {
if (empty($booking_dep_flight_no) OR strlen($booking_dep_flight_no) < 2) { $arr = array ('response'=>'empty_departure_no'); echo json_encode($arr); exit; }
if (empty($booking_dep_flight_date)) { $arr = array ('response'=>'empty_departure_day'); echo json_encode($arr); exit; }
if (empty($booking_dep_flight_time)) { $arr = array ('response'=>'empty_departure_hour'); echo json_encode($arr); exit; }
}

if ($booking_type == 2) {
if (empty($booking_arv_flight_no) OR strlen($booking_arv_flight_no) < 2) { $arr = array ('response'=>'empty_arrival_no'); echo json_encode($arr); exit; }
if (empty($booking_arv_flight_date)) { $arr = array ('response'=>'empty_arrival_day'); echo json_encode($arr); exit; }
if (empty($booking_arv_flight_time)) { $arr = array ('response'=>'empty_arrival_hour'); echo json_encode($arr); exit; }
if (empty($booking_dep_flight_no) OR strlen($booking_dep_flight_no) < 2) { $arr = array ('response'=>'empty_departure_no'); echo json_encode($arr); exit; }
if (empty($booking_dep_flight_date)) { $arr = array ('response'=>'empty_departure_day'); echo json_encode($arr); exit; }
if (empty($booking_dep_flight_time)) { $arr = array ('response'=>'empty_departure_hour'); echo json_encode($arr); exit; }
}

if (empty($booking_total_pax) OR $booking_total_pax == 0) { $arr = array ('response'=>'adult'); echo json_encode($arr); exit; }
if (empty($booking_stay_address) OR strlen($booking_stay_address) < 4) { $arr = array ('response'=>'empty_address'); echo json_encode($arr); exit; }

/// KONTROLLER




/// DB KAYIT

if ($booking_from_to == 1 && $booking_type == 1) {
$Db->query("INSERT INTO transfer_bookings (booking_lang_id,booking_code,booking_ip,booking_shared,booking_from_to,booking_airport,booking_resort,booking_vehicle,booking_total_pax,booking_type,booking_cost_curr,booking_cost_price,booking_sale_curr,booking_sale_price,booking_name,booking_surname,booking_email,booking_country,booking_phone,booking_stay_address,booking_customer_note,booking_arv_flight_no,booking_arv_flight_date,booking_arv_flight_time,booking_child_seat,booking_baby_seat) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", array($site_lang,$booking_code,getIP(),$booking_shared,$booking_from_to,$booking_airport,$booking_resort,$booking_vehicle,$booking_total_pax,$booking_type,$booking_cost_curr,$booking_cost_price,$booking_sale_curr,$booking_sale_price,$booking_name,$booking_surname,$booking_email,$booking_country,$booking_phone,$booking_stay_address,$booking_customer_note,$booking_arv_flight_no,$booking_arv_flight_date,$booking_arv_flight_time,$booking_child_seat,$booking_baby_seat));
}

if ($booking_from_to == 2 && $booking_type == 1) {
$Db->query("INSERT INTO transfer_bookings (booking_lang_id,booking_code,booking_ip,booking_shared,booking_from_to,booking_airport,booking_resort,booking_vehicle,booking_total_pax,booking_type,booking_cost_curr,booking_cost_price,booking_sale_curr,booking_sale_price,booking_name,booking_surname,booking_email,booking_country,booking_phone,booking_stay_address,booking_customer_note,booking_dep_flight_no,booking_dep_flight_date,booking_dep_flight_time,booking_dep_flight_pickup,booking_child_seat,booking_baby_seat) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", array($site_lang,$booking_code,getIP(),$booking_shared,$booking_from_to,$booking_airport,$booking_resort,$booking_vehicle,$booking_total_pax,$booking_type,$booking_cost_curr,$booking_cost_price,$booking_sale_curr,$booking_sale_price,$booking_name,$booking_surname,$booking_email,$booking_country,$booking_phone,$booking_stay_address,$booking_customer_note,$booking_dep_flight_no,$booking_dep_flight_date,$booking_dep_flight_time,$booking_dep_flight_pickup,$booking_child_seat,$booking_baby_seat));
}

if ($booking_type == 2) {
$Db->query("INSERT INTO transfer_bookings (booking_lang_id,booking_code,booking_ip,booking_shared,booking_from_to,booking_airport,booking_resort,booking_vehicle,booking_total_pax,booking_type,booking_cost_curr,booking_cost_price,booking_sale_curr,booking_sale_price,booking_name,booking_surname,booking_email,booking_country,booking_phone,booking_stay_address,booking_customer_note,booking_arv_flight_no,booking_arv_flight_date,booking_arv_flight_time,booking_dep_flight_no,booking_dep_flight_date,booking_dep_flight_time,booking_dep_flight_pickup,booking_child_seat,booking_baby_seat) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", array($site_lang,$booking_code,getIP(),$booking_shared,$booking_from_to,$booking_airport,$booking_resort,$booking_vehicle,$booking_total_pax,$booking_type,$booking_cost_curr,$booking_cost_price,$booking_sale_curr,$booking_sale_price,$booking_name,$booking_surname,$booking_email,$booking_country,$booking_phone,$booking_stay_address,$booking_customer_note,$booking_arv_flight_no,$booking_arv_flight_date,$booking_arv_flight_time,$booking_dep_flight_no,$booking_dep_flight_date,$booking_dep_flight_time,$booking_dep_flight_pickup,$booking_child_seat,$booking_baby_seat));
}

/// DB KAYIT




/// VERİ ÇEKİMİ

$cntry         = $Db->row("SELECT * FROM country_list WHERE country_id = ?", array($booking_country));
$cntry_code    = $cntry['country_phone_code'];

$airport       = $Db->row("SELECT airport_name FROM transfer_airports WHERE airport_airport_id = ? AND airport_lang_id = ?", array($booking_airport,$site_lang));
$airport_name  = $airport['airport_name'];

$resort        = $Db->row("SELECT resort_name FROM transfer_resorts WHERE resort_resort_id = ? AND resort_lang_id = ? ", array($booking_resort,$site_lang));
$resort_name   = $resort['resort_name'];

$transfer_det  = $Db->row("SELECT route_minute,route_distance,route_vehicle_id FROM transfer_routes WHERE route_airport_id = ? AND route_resort_id = ? AND route_pax >= ? ORDER BY route_pax ASC", array($booking_airport,$booking_resort,$booking_total_pax));

$transfer_time = $transfer_det['route_minute'];
$transfer_dist = $transfer_det['route_distance'];
$transfer_car  = $transfer_det['route_vehicle_id'];

$vehicle       = $Db->row("SELECT vehicle_name FROM transfer_vehicles WHERE vehicle_vehicle_id = ? AND vehicle_lang_id = ? ", array($transfer_car,$site_lang));
$vehicle_name  = $vehicle['vehicle_name'];

$curr          = $Db->row("SELECT curr_code FROM currencies WHERE curr_id = ?", array($booking_sale_curr));
$curr_code     = $curr['curr_code'];

$booking       = $Db->row("SELECT booking_date FROM transfer_bookings WHERE booking_code = ?", array($booking_code));
$booking_date  = date("d-m-Y H:i:s", strtotime($booking['booking_date']));

/// VERİ ÇEKİMİ




/// VERİ DÜZENLEME

if ($b_direction == 1) {
$from = $airport['airport_name'];
$to   = $resort['resort_name'];
$page_title = $from." to ".$to." ".$translate['tr_022'];
}
if ($b_direction == 2) {
$to   = $airport['airport_name'];
$from = $resort['resort_name'];
$page_title = $to." to ".$from." ".$translate['tr_022'];
}


if ($booking_shared == 1)  { $v_type = $translate['tr_004']; } else { $v_type = $translate['tr_005']; }

if ($booking_from_to == 1) { $r_type = $translate['tr_007']; }
if ($booking_from_to == 2) { $r_type = $translate['tr_008']; }

if ($booking_type == 1)    { $t_type = $translate['tr_019']; } else { $t_type = $translate['tr_020']; }

if ($booking_child_seat == 0) { $_cs = $translate['tr_053']; } else { $_cs = $booking_child_seat; }
if ($booking_baby_seat == 0)  { $_bs = $translate['tr_053']; } else { $_bs = $booking_baby_seat; }

/// VERİ DÜZENLEME




/// FORM DÜZENLEME
$add_arrival = '
<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_038'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$booking_arv_flight_no.'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_039'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.date("d-m-Y", strtotime($booking_arv_flight_date)).'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_040'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$booking_arv_flight_time.'
</td>
</tr>
';


$add_departure = '
<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_043'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$booking_dep_flight_no.'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_044'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.date("d-m-Y", strtotime($booking_dep_flight_date)).'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_045'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$booking_dep_flight_time.'
</td>
</tr>
';


$add_both = '
<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_038'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$booking_arv_flight_no.'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_039'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.date("d-m-Y", strtotime($booking_arv_flight_date)).'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_040'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$booking_arv_flight_time.'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_043'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$booking_dep_flight_no.'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_044'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.date("d-m-Y", strtotime($booking_dep_flight_date)).'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_045'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$booking_dep_flight_time.'
</td>
</tr>
';



if ($booking_dep_flight_pickup != NULL) {
$pick_part = '
<tr>
<td align="left" style="padding-top: 20px;">
<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 800; line-height: 20px; padding: 10px; border-bottom: 3px solid #eeeeee;">
'.$translate['tr_047'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 800; line-height: 20px; padding: 10px; border-bottom: 3px solid #eeeeee;">
***'.$booking_dep_flight_pickup.'***
</td>
</tr>
</table>
</td>
</tr>
';
}

$price_part = '
<tr>
<td align="left" style="padding-top: 20px;">
<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>
<td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 800; line-height: 20px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
'.$translate['tr_002'].'
</td>
<td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 800; line-height: 20px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
'.number_format($booking_sale_price).' '.$curr_code.'
</td>
</tr>
</table>
</td>
</tr>
';


$address_part = '
<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_046'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$booking_stay_address.'
</td>
</tr>
';


$note_part = '
<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_054'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$booking_customer_note.'
</td>
</tr>
';


if ($booking_child_seat > 0) {
$child_part = '
<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_051'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$_cs.'
</td>
</tr>
';
}


if ($booking_baby_seat > 0) {
$baby_part = '
<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_052'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$_bs.'
</td>
</tr>
';
}
/// FORM DÜZENLEME




///////// ÜST KISIM /////////
$top_part = '
<tr>
<td width="50%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 800; line-height: 20px; padding: 10px;">
'.$translate['tr_079'].'
</td>
<td width="50%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 800; line-height: 20px; padding: 10px;">
'.$booking_code.'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_087'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$booking_date.' '.getIP().'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_030'].' '.$translate['tr_031'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$booking_name.' '.$booking_surname.'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_032'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$booking_email.'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_036'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$cntry_code.' '.$booking_phone.'
</td>
</tr>
';
///////// ÜST KISIM /////////



///////// TRANSFER BİLGİSİ /////////
$transfer_part = '
<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_003'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$v_type.'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_006'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$r_type.'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_009'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$airport_name.'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_011'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$resort_name.'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_089'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$vehicle_name.'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_014'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$booking_total_pax.' '.$translate['tr_082'].'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_023'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$transfer_dist.' '.$translate['tr_024'].' | '.$transfer_time.' '.$translate['tr_025'].'
</td>
</tr>

<tr>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$translate['tr_018'].'
</td>
<td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 20px; padding: 1px 10px;">
'.$t_type.'
</td>
</tr>
';
///////// TRANSFER BİLGİSİ /////////




///////// UÇUŞ KISMI /////////

if ($booking_from_to == 1) {
if ($booking_type == 1) {
$fligth_part = $add_arrival;
}
if ($booking_type == 2) {
$fligth_part = $add_both;
}
}

if ($booking_from_to == 2) {
if ($booking_type == 1) {
$fligth_part = $add_departure;
}
}

///////// UÇUŞ KISMI /////////




include_once('transfer_email_template.php');

$subject           = $booking_code." - ".$page_title;
$subject           = '=?UTF-8?B?'.base64_encode($subject).'?=';

///

$mail              = new PHPMailer();
$mail->IsSMTP();
$mail->CharSet     = "UTF-8";
$mail->SMTPDebug   = 0;
$mail->SMTPAuth    = true;
$mail->IsHTML(true);
$mail->SMTPSecure  = "tls";
$mail->Host        = "smtp.gmail.com";
$mail->Port        = 587;
$mail->Username    = $sitesettings['site_contact_email'];
$mail->Password    = $sitesettings['site_contact_email_pass'];
$mail->IsHTML(true);
$mail->SetFrom($sitesettings['site_contact_email'], $sitesettings['site_name']);
$mail->AddAttachment($_FILES['userfile']['tmp_name'],$_FILES['userfile']['name']);
$mail->Subject     = $subject;
$mail->MsgHTML($e_body);

$address1 = $booking_email;
$address2 = $sitesettings['site_contact_email'];

$mail->AddAddress($address1);
$mail->AddAddress($address2);

$mail->send();
$mail->ClearAllRecipients();

$arr = array ('response'=>'ok','booking_code'=>$booking_code);
echo json_encode($arr); exit;

}

else { $arr = array ('response'=>'error'); echo json_encode($arr); exit; }

?>