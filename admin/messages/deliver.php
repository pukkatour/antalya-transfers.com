<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
include_once('../include/class.phpmailer.php');
include_once("../include/class.smtp.php");
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }

header("Content-type:text/html; charset=utf-8");


if (!empty($_POST)) {

$email_reply_id       = $_POST['email_reply_id'];
$email_sender_id      = $_POST['email_sender_id'];
$email_sender_email   = $_POST['email_sender_email'];
$email_receiver_email = $_POST['email_receiver_email'];
$email_title          = $_POST['email_title'];
$email_text           = $_POST['email_text'];
$temp_lang            = $_POST['temp_lang'];

$emailbodytitle = $sitesettings['site_name'];
$emailbodytext  = $email_text;

include_once('../../email_template.php');

$to       = $email_receiver_email;

$subject  = '=?UTF-8?B?'.base64_encode($email_title).'?=';

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

$address = $email_receiver_email;
$mail->AddAddress($address);
$mail->send();
$mail->ClearAllRecipients();

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/messages/detail.php?message_id=$email_reply_id"); exit;

}

?>