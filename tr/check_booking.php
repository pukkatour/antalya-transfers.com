<?php
include_once('site_id.php');
include_once('../admin/include/initialize.inc.php');

header("Content-type:text/html; charset=utf-8");

if (!empty($_POST)) {

$_POST = array_map("tirnak", $_POST);

$my_email = $_POST['my_email'];
$my_code  = $_POST['my_code'];

if (empty($my_code)) { $arr = array ('response'=>'voucher'); echo json_encode($arr); exit; }
if (!filter_var($my_email, FILTER_VALIDATE_EMAIL)) { $arr = array ('response'=>'email'); echo json_encode($arr); exit;}
if (empty($my_email) OR strlen($my_email) < 9) { $arr = array ('response'=>'email'); echo json_encode($arr); exit; }


$booking      = $Db->row("SELECT * FROM transfer_bookings WHERE booking_code = ? AND booking_email = ?", array($my_code,$my_email));

if (empty($booking)) {

$arr = array ('response'=>'both');
echo json_encode($arr); exit;

} else {

$booking_cntry = $Db->row("SELECT country_phone_code FROM country_list WHERE country_id = ?", array($booking['booking_country']));
$booking_curr  = $Db->row("SELECT curr_code FROM currencies WHERE curr_id = ?", array($booking['booking_sale_curr']));
$booking_air   = $Db->row("SELECT airport_name FROM transfer_airports WHERE airport_airport_id = ? AND airport_lang_id = ?", array($booking['booking_airport'],$site_lang));
$booking_res   = $Db->row("SELECT resort_name FROM transfer_resorts WHERE resort_resort_id = ? AND resort_lang_id = ?", array($booking['booking_resort'],$site_lang));
$booking_vch   = $Db->row("SELECT vehicle_name FROM transfer_vehicles WHERE vehicle_vehicle_id = ? AND vehicle_lang_id = ?", array($booking['booking_vehicle'],$site_lang));

if ($booking['booking_shared'] == 1) { $booking_shared = $translate['tr_004']; } else { $booking_shared = $translate['tr_005']; }
if ($booking['booking_from_to'] == 1) { $booking_from_to = $translate['tr_007']; } else { $booking_from_to = $translate['tr_008']; }
if ($booking['booking_type'] == 1) { $booking_type = $translate['tr_019']; } else { $booking_type = $translate['tr_020']; }

$b_name     = $booking['booking_name'];
$b_surname  = $booking['booking_surname'];
$b_email    = $booking['booking_email'];
$b_country  = $booking_cntry['country_phone_code'];
$b_phone    = $booking['booking_phone'];
$b_address  = $booking['booking_stay_address'];
$b_note     = $booking['booking_customer_note'];

$b_code     = $booking['booking_code'];
$b_ip       = $booking['booking_ip'];
$b_date     = $booking['booking_date'];
$b_shared   = $booking_shared;
$b_from_to  = $booking_from_to;
$b_airport  = $booking_air['airport_name'];
$b_resort   = $booking_res['resort_name'];
$b_vehicle  = $booking_vch['vehicle_name'];
$b_pax      = $booking['booking_total_pax'];
$b_type     = $booking_type;

$b_a_f_no   = $booking['booking_arv_flight_no'];
$b_a_f_date = date("d-m-Y", strtotime($booking['booking_arv_flight_date']));
$b_a_f_time = date('H:i', strtotime($booking['booking_arv_flight_time']));
$b_d_f_no   = $booking['booking_dep_flight_no'];
$b_d_f_date = date("d-m-Y", strtotime($booking['booking_dep_flight_date']));
$b_d_f_time = date('H:i', strtotime($booking['booking_dep_flight_time']));
$b_d_f_pick = $booking['booking_dep_flight_pickup'];

$b_cseat    = $booking['booking_child_seat'];
$b_bseat    = $booking['booking_baby_seat'];
$b_curr     = $booking_curr['curr_code'];
$b_price    = $booking['booking_sale_price'];

$arr = array (
'response'=>'success',
'b_name'=>$b_name,
'b_surname'=>$b_surname,
'b_email'=>$b_email,
'b_country'=>$b_country,
'b_phone'=>$b_phone,
'b_address'=>$b_address,
'b_note'=>$b_note,
'b_code'=>$b_code,
'b_ip'=>$b_ip,
'b_date'=>$b_date,
'b_shared'=>$b_shared,
'b_from_to'=>$b_from_to,
'b_airport'=>$b_airport,
'b_resort'=>$b_resort,
'b_vehicle'=>$b_vehicle,
'b_pax'=>$b_pax,
'b_type'=>$b_type,
'b_a_f_no'=>$b_a_f_no,
'b_a_f_date'=>$b_a_f_date,
'b_a_f_time'=>$b_a_f_time,
'b_d_f_no'=>$b_d_f_no,
'b_d_f_date'=>$b_d_f_date,
'b_d_f_time'=>$b_d_f_time,
'b_d_f_pick'=>$b_d_f_pick,
'b_cseat'=>$b_cseat,
'b_bseat'=>$b_bseat,
'b_curr'=>$b_curr,
'b_price'=>$b_price
);
echo json_encode($arr); exit;

}

} else {

$arr = array ('response'=>'problem');
echo json_encode($arr); exit;

}

?>