<?php
include_once('site_id.php');
include_once('admin/include/initialize.inc.php');
include_once('admin/include/class.phpmailer.php');
include_once('admin/include/class.smtp.php');

header("Content-type:text/html; charset=utf-8");

if (!empty($_POST)) {

$message_name    = $_POST['message_name'];
$message_surname = $_POST['message_surname'];
$message_email   = $_POST['message_email'];
$message_country = $_POST['message_country'];
$message_phone   = telefon($_POST['message_phone']);
$message_title   = $_POST['message_title'];
$message_text    = tagsil($_POST['message_text']);

if (empty($message_name)) { echo "name"; exit; }
if (empty($message_surname)) { echo "surname"; exit; }
if (!filter_var($message_email, FILTER_VALIDATE_EMAIL)) { echo "email"; exit; }
if (empty($message_email) OR strlen($message_email) < 9) { echo "email"; exit; }
if (empty($message_phone) OR strlen($message_phone) < 10) { echo "phone"; exit; }
if (empty($message_title)) { echo "title"; exit; }
if (empty($message_text)) { echo "message"; exit; }
if (strlen($message_text) < 15) { echo "message"; exit; }

if (contains($spam_list, $message_title) > 0) { echo "problem"; exit; }
if (contains($spam_list, $message_text) > 0) { echo "problem"; exit; }

$country_ctnl = $Db->row("SELECT country_phone_code FROM country_list WHERE country_id = ?", array($message_country));
$form_texts   = $Db->row("SELECT page_email_title,page_email_hello,page_email_text,page_email_name,page_email_phone,page_email_email,page_email_ip,page_email_date,page_email_subject,page_email_message FROM page_contact_us WHERE page_lang_id = ?", array($site_lang));

$Db->query("INSERT INTO contact_messages (message_name,message_surname,message_email,message_country,message_phone,message_title,message_text,message_ip,message_lang_id) VALUES (?,?,?,?,?,?,?,?,?)", array($message_name,$message_surname,$message_email,$message_country,$message_phone,$message_title,$message_text,getIP(),$site_lang));

$email_title    = $form_texts['page_email_title'];
$emailbodytitle = $form_texts['page_email_title'];
$emailbodytext  = $form_texts['page_email_hello']."<br><br>".$form_texts['page_email_text']."<br><br><b>".$form_texts['page_email_name'].": </b> ".$message_name." ".$message_surname."<br><b>".$form_texts['page_email_phone'].": </b> ".$country_ctnl['country_phone_code']." ".$message_phone."<br><b>".$form_texts['page_email_email'].": </b> ".$message_email."<br><b>".$form_texts['page_email_ip'].": </b> ".getIP()."<br><b>".$form_texts['page_email_date'].": </b> ".$date_time."<br><br><b>".$form_texts['page_email_subject'].": </b> ".$message_title."<br><b>".$form_texts['page_email_message'].": </b> ".$message_text;

include_once('email_template.php');

$subject           = '=?UTF-8?B?'.base64_encode($email_title).'?=';

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

$mail->AddAddress($address1);
$mail->AddAddress($address2);

$mail->send();
$mail->ClearAllRecipients();
$mail->clearAttachments();

echo "success"; exit;

} else {

echo "problem"; exit;

}

?>