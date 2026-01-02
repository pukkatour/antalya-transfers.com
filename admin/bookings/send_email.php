<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
include_once('../include/class.phpmailer.php');
include_once('../include/class.smtp.php');

if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }

header("Content-type:text/html; charset=utf-8");


if (isset($_POST) || !empty($_POST)) {

$id        = $_POST['id'];
$temp_lang = $_POST['lang'];
$receiver  = $_POST['receiver'];
$type      = $_POST['type'];

$booking   = $Db->row("SELECT * FROM transfer_bookings WHERE booking_id = ?", array($id));

$booking_code              = $booking['booking_code'];
$booking_ip                = $booking['booking_ip'];
$booking_date              = $booking['booking_date'];
$booking_shared            = $booking['booking_shared'];
$booking_from_to           = $booking['booking_from_to'];
$booking_airport           = $booking['booking_airport'];
$booking_resort            = $booking['booking_resort'];
$booking_vehicle           = $booking['booking_vehicle'];
$booking_total_pax         = $booking['booking_total_pax'];
$booking_type              = $booking['booking_type'];
$booking_arv_flight_no     = $booking['booking_arv_flight_no'];
$booking_arv_flight_date   = $booking['booking_arv_flight_date'];
$booking_arv_flight_time   = $booking['booking_arv_flight_time'];
$booking_dep_flight_no     = $booking['booking_dep_flight_no'];
$booking_dep_flight_date   = $booking['booking_dep_flight_date'];
$booking_dep_flight_time   = $booking['booking_dep_flight_time'];
$booking_dep_flight_pickup = $booking['booking_dep_flight_pickup'];
$booking_child_seat        = $booking['booking_child_seat'];
$booking_baby_seat         = $booking['booking_baby_seat'];
$booking_sale_curr         = $booking['booking_sale_curr'];
$booking_sale_price        = $booking['booking_sale_price'];
$booking_name              = $booking['booking_name'];
$booking_surname           = $booking['booking_surname'];
$booking_email             = $booking['booking_email'];
$booking_country           = $booking['booking_country'];
$booking_phone             = $booking['booking_phone'];
$booking_stay_address      = $booking['booking_stay_address'];
$booking_customer_note     = $booking['booking_customer_note'];

///

$cntry         = $Db->row("SELECT * FROM country_list WHERE country_id = ?", array($booking_country));
$cntry_code    = $cntry['country_phone_code'];

$airport       = $Db->row("SELECT airport_name FROM transfer_airports WHERE airport_airport_id = ? AND airport_lang_id = ? ", array($booking_airport,$site_lang));
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

if ($booking_shared == 1)  { $v_type = $trans_details['tr_d_0142']; } else { $v_type = $trans_details['tr_d_0143']; }

if ($booking_from_to == 1) { $r_type = $trans_details['tr_d_0092']; }
if ($booking_from_to == 2) { $r_type = $trans_details['tr_d_0093']; }

if ($booking_type == 1)    { $t_type = $trans_details['tr_d_0098']; } else { $t_type = $trans_details['tr_d_0099']; }

if ($booking_child_seat == 0) { $_cs = $trans_details['tr_d_0009']; } else { $_cs = $booking_child_seat." ".$trans_details['tr_d_0040']; }
if ($booking_baby_seat == 0)  { $_bs = $trans_details['tr_d_0009']; } else { $_bs = $booking_baby_seat." ".$trans_details['tr_d_0040']; }

if ($booking_child_seat > 0) {
$add1 = '
<tr>
<td colspan="1" id="t887764_row_0col_0" width="200">'.$trans_details['tr_d_0128'].':</td>
<td colspan="1" id="t887764_row_0col_1" width="380">'.$_cs.'</td>
</tr>
';
}
if ($booking_baby_seat > 0) {
$add2 = '
<tr>
<td colspan="1" id="t887764_row_0col_0" width="200">'.$trans_details['tr_d_0129'].':</td>
<td colspan="1" id="t887764_row_0col_1" width="380">'.$_bs.'</td>
</tr>
';
}

$add3 = '
<table id="t887764" cellspacing="0" cellpadding="0" border="0" width="580">
<tbody>

<tr>
<td colspan="1" id="t697640_row_1col_0" width="200">'.$trans_form['tr_f_0047'].':</td>
<td colspan="1" id="t697640_row_1col_1" width="380">'.$booking_arv_flight_no.'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_1col_0" width="200">'.$trans_form['tr_f_0034'].':</td>
<td colspan="1" id="t697640_row_1col_1" width="380">'.date("d-m-Y", strtotime($booking_arv_flight_date)).'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_1col_0" width="200">'.$trans_form['tr_f_0035'].':</td>
<td colspan="1" id="t697640_row_1col_1" width="380">'.date("H:i", strtotime($booking_arv_flight_time)).'</td>
</tr>

</tbody>
</table>

<br>
';

$add4 = '
<table id="t887764" cellspacing="0" cellpadding="0" border="0" width="580">
<tbody>

<tr>
<td colspan="1" id="t697640_row_1col_0" width="200">'.$trans_form['tr_f_0049'].':</td>
<td colspan="1" id="t697640_row_1col_1" width="380">'.$booking_dep_flight_no.'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_1col_0" width="200">'.$trans_form['tr_f_0038'].':</td>
<td colspan="1" id="t697640_row_1col_1" width="380">'.date("d-m-Y", strtotime($booking_dep_flight_date)).'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_1col_0" width="200">'.$trans_form['tr_f_0039'].':</td>
<td colspan="1" id="t697640_row_1col_1" width="380">'.date("H:i", strtotime($booking_dep_flight_time)).'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_1col_0" width="200">'.$trans_form['tr_f_0041'].'***</td>
<td colspan="1" id="t697640_row_1col_1" width="380"><b>***'.$booking_dep_flight_pickup.'***</b></td>
</tr>

</tbody>
</table>

<br>
';

$add5 = '
<table id="t887764" cellspacing="0" cellpadding="0" border="0" width="580">
<tbody>

<tr>
<td colspan="1" id="t697640_row_1col_0" width="200">'.$trans_form['tr_f_0047'].':</td>
<td colspan="1" id="t697640_row_1col_1" width="380">'.$booking_arv_flight_no.'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_1col_0" width="200">'.$trans_form['tr_f_0034'].':</td>
<td colspan="1" id="t697640_row_1col_1" width="380">'.date("d-m-Y", strtotime($booking_arv_flight_date)).'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_1col_0" width="200">'.$trans_form['tr_f_0035'].':</td>
<td colspan="1" id="t697640_row_1col_1" width="380">'.date("H:i", strtotime($booking_arv_flight_time)).'</td>
</tr>

<br>

<tr>
<td colspan="1" id="t697640_row_1col_0" width="200">'.$trans_form['tr_f_0049'].':</td>
<td colspan="1" id="t697640_row_1col_1" width="380">'.$booking_dep_flight_no.'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_1col_0" width="200">'.$trans_form['tr_f_0038'].':</td>
<td colspan="1" id="t697640_row_1col_1" width="380">'.date("d-m-Y", strtotime($booking_dep_flight_date)).'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_1col_0" width="200">'.$trans_form['tr_f_0039'].':</td>
<td colspan="1" id="t697640_row_1col_1" width="380">'.date("H:i", strtotime($booking_dep_flight_time)).'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_1col_0" width="200">'.$trans_form['tr_f_0041'].'***</td>
<td colspan="1" id="t697640_row_1col_1" width="380"><b>***'.$booking_dep_flight_pickup.'***</b></td>
</tr>

</tbody>
</table>

<br>
';

if ($booking_from_to == 1) {
if ($booking_type == 1) {
$last_add = $add3;
}
if ($booking_type == 2) {
$last_add = $add5;
}
}
if ($booking_from_to == 2) {
if ($booking_type == 1) {
$last_add = $add4;
}
}

///

$emailbodytext = '

<table id="t19419" cellspacing="0" cellpadding="0" border="0" width="580">
<tbody>

<tr>
<td colspan="1" id="t19419_row_0col_0" width="200">'.$trans_form['tr_f_0004'].':</td>
<td colspan="1" id="t19419_row_0col_1" width="380">'.$booking_name.'</td>
</tr>

<tr>
<td colspan="1" id="t19419_row_1col_0" width="200">'.$trans_form['tr_f_0005'].':</td>
<td colspan="1" id="t19419_row_1col_1" width="380">'.$booking_surname.'</td>
</tr>

<tr>
<td colspan="1" id="t19419_row_2col_0" width="200">'.$trans_form['tr_f_0006'].':</td>
<td colspan="1" id="t19419_row_2col_1" width="380">'.$booking_email.'</td>
</tr>

<tr>
<td colspan="1" id="t19419_row_3col_0" width="200">'.$trans_form['tr_f_0009'].':</td>
<td colspan="1" id="t19419_row_3col_1" width="380">'.$cntry_code.' '.$booking_phone.'</td>
</tr>

<tr>
<td colspan="1" id="t19419_row_4col_0" width="200">'.$trans_form['tr_f_0073'].':</td>
<td colspan="1" id="t19419_row_4col_1" width="380">'.date("d-m-Y H:i:s", strtotime($booking_date)).'</td>
</tr>

<tr>
<td colspan="1" id="t19419_row_5col_0" width="200">'.$trans_form['tr_f_0074'].':</td>
<td colspan="1" id="t19419_row_5col_1" width="380">'.getIP().'</td>
</tr>

<tr>
<td colspan="1" id="t19419_row_6col_0" width="200">'.$trans_form['tr_f_0075'].':</td>
<td colspan="1" id="t19419_row_6col_1" width="380">'.$booking_code.'</td>
</tr>

</tbody>
</table>

<br>

<table id="t697640" cellspacing="0" cellpadding="0" border="0" width="580">
<tbody>

<tr>
<td colspan="1" id="t697640_row_2col_0" width="200">'.$trans_details['tr_d_0141'].':</td>
<td colspan="1" id="t697640_row_2col_1" width="380">'.$v_type.'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_2col_0" width="200">'.$trans_details['tr_d_0091'].':</td>
<td colspan="1" id="t697640_row_2col_1" width="380">'.$r_type.'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_2col_0" width="200">'.$trans_details['tr_d_0097'].':</td>
<td colspan="1" id="t697640_row_2col_1" width="380">'.$t_type.'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_2col_0" width="200">'.$trans_form['tr_f_0079'].':</td>
<td colspan="1" id="t697640_row_2col_1" width="380">'.$airport_name.'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_2col_0" width="200">'.$trans_details['tr_d_0108'].':</td>
<td colspan="1" id="t697640_row_2col_1" width="380">'.$resort_name.'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_2col_0" width="200">'.$trans_form['tr_f_0080'].':</td>
<td colspan="1" id="t697640_row_2col_1" width="380">'.$vehicle_name.'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_2col_0" width="200">'.$trans_details['tr_d_0109'].':</td>
<td colspan="1" id="t697640_row_2col_1" width="380">'.$transfer_dist.' '.$trans_details['tr_d_0110'].' - '.$transfer_time.' '.$trans_details['tr_d_0112'].'</td>
</tr>

<tr>
<td colspan="1" id="t697640_row_2col_0" width="200">'.$trans_details['tr_d_0055'].':</td>
<td colspan="1" id="t697640_row_2col_1" width="380">'.$booking_total_pax.' '.$trans_details['tr_d_0039'].'</td>
</tr>

'.$add1.'
'.$add2.'

</tbody>
</table>

<br>

'.$last_add.'

<table id="t887764" cellspacing="0" cellpadding="0" border="0" width="580">
<tbody>

<tr>
<td colspan="1" id="t887764_row_0col_0" width="200">'.$trans_form['tr_f_0017'].':</td>
<td colspan="1" id="t887764_row_0col_1" width="380">'.$booking_stay_address.'</td>
</tr>

<tr>
<td colspan="1" id="t887764_row_1col_0" width="200">'.$trans_form['tr_f_0018'].':</td>
<td colspan="1" id="t887764_row_1col_1" width="380">'.$booking_customer_note.'</td>
</tr>

<tr>
<td colspan="1" id="t887764_row_2col_0" width="200">'.mb_strtoupper($trans_form['tr_f_0029']).':</td>
<td colspan="1" id="t887764_row_2col_1" width="380"><b>'.number_format($booking_sale_price).' '.$curr_code.'</b></td>
</tr>

</tbody>
</table>
';

///

$emailbodytitle = $trans_form['tr_f_0085'];
$subject        = $booking_code." - ".$t_type." - ".$airport_name." - ".$resort_name;

///

include_once("../../email_template.php");

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
$address3 = $receiver;

if ($type == 2) {
$mail->AddAddress($address1);
}
if ($type == 1) {
$mail->AddAddress($address2);
}
if ($type == 3) {
$mail->AddAddress($address3);
}

$mail->send();
$mail->ClearAllRecipients();

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/bookings/view.php?id=$id&status=sent");

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>