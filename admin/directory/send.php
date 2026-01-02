<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
include_once('../include/class.phpmailer.php');
include_once('../include/class.smtp.php');

if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }

header("Content-type:text/html; charset=utf-8");


if ($_POST) {

$email_lng      = $_POST['email_lng'];
$email_cat      = $_POST['email_cat'];
$email_title    = tirnak($_POST['email_title']);
$email_text     = tirnak($_POST['email_text']);
$temp_lang      = $email_lng;

$emails         = $Db->query("SELECT directory_email FROM directory WHERE directory_cat = ? AND directory_lng = ? ", array($email_cat,$email_lng));

$emailbodytitle = $email_title;
$emailbodytext  = $email_text;

include_once('../../email_template.php');

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

$mail->AddAddress($sitesettings['site_contact_email']);

if (!empty($emails)) { foreach ($emails as $email) {

$address = $email['directory_email'];
$mail->AddBCC($address);

}

$mail->send();
$mail->ClearAllRecipients();
$mail->clearAttachments();

}

$_SESSION["swal"] = "ok";
redirect(SITE_URL."admin/directory/mass_email.php");

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>