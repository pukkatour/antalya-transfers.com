<?php
include_once('include/site_id.php');
include_once('include/initialize.inc.php');
include_once('include/class.phpmailer.php');
include_once('include/class.smtp.php');

if (empty($admin_id)) { redirect(SITE_URL.'admin/login.php'); exit; }

if ($_POST) {

$emailto    = $_POST['emailto'];
$temp_lang  = $_POST['temp_lang'];
$subject    = $_POST['subject'];
$email_text = $_POST['email_text'];
$email_date = $date_time;

$email_title    = $subject;
$emailbodytitle = $subject;
$emailbodytext  = $email_text;

include_once('../email_template.php');

$subject  = '=?UTF-8?B?'.base64_encode($subject).'?=';

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

$address1 = $message_email;
$address2 = $sitesettings['site_contact_email'];

$mail->AddAddress($emailto);
$mail->AddAddress($address2);

$mail->send();
$mail->ClearAllRecipients();
$mail->clearAttachments();


$_SESSION["alert"] = "emailsent";
redirect($_SERVER['HTTP_REFERER']); exit;

} else {

$_SESSION["alert"] = "not_sent";
redirect(SITE_URL."admin/index.php"); exit;

}

?>