<?php
include_once('include/site_id.php');
include_once('include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }

set_time_limit(0);

if (!empty($_POST)) {

$sms_sender_id      = $_POST['sms_sender_id'];
$sms_receiver_phone = $_POST['smsto'];
$sms_text2          = $_POST['message'];
$sms_text1          = preg_replace('!\s+!', ' ', $sms_text2);
$sms_text           = str_replace(" ", "%20", $sms_text1);

function sendsms($u_name, $u_pass, $phone, $message, $header)
{
$s_url  ="https://api.netgsm.com.tr/bulkhttppost.asp?usercode=$u_name&password=$u_pass&gsmno=$phone&message=$message&msgheader=$header&startdate=&stopdate=";
$ch     = curl_init();
curl_setopt($ch,CURLOPT_URL,$s_url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$output = curl_exec($ch);
curl_close($ch);
return $output;
}

$u_name  = $sitesettings['site_sms_phone'];
$u_pass  = $sitesettings['site_sms_pass'];
$phone   = $sms_receiver_phone;
$message = $sms_text;
$header2 = $sitesettings['site_sms_title'];
$header1 = preg_replace('!\s+!', ' ', $header2);
$header  = str_replace(" ", "%20", $header1);
sendsms($u_name, $u_pass, $phone, $message, $header);

$_SESSION["alert"] = "smssent";
redirect($_SERVER['HTTP_REFERER']); exit;

} else {

$_SESSION["alert"] = "not_sent";
redirect($_SERVER['HTTP_REFERER']); exit;

}

?>