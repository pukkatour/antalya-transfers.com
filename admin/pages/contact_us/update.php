<?php
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$_POST = array_map("tirnak", $_POST);

$page_id                 = $_POST['page_id'];
$page_lang_id            = $_POST['page_lang_id'];
$page_title              = $_POST['page_title'];
$page_description        = $_POST['page_description'];
$page_keywords           = $_POST['page_keywords'];
$page_name               = $_POST['page_name'];
$page_title1             = $_POST['page_title1'];
$page_text1              = $_POST['page_text1'];
$page_title2             = $_POST['page_title2'];
$page_text2              = $_POST['page_text2'];
$page_title3             = $_POST['page_title3'];
$page_text3              = $_POST['page_text3'];
$page_button1            = $_POST['page_button1'];
$page_button2            = $_POST['page_button2'];
$page_button3            = $_POST['page_button3'];
$page_form_title         = $_POST['page_form_title'];
$page_form_name          = $_POST['page_form_name'];
$page_form_surname       = $_POST['page_form_surname'];
$page_form_email         = $_POST['page_form_email'];
$page_form_country       = $_POST['page_form_country'];
$page_form_phone         = $_POST['page_form_phone'];
$page_form_subject       = $_POST['page_form_subject'];
$page_form_message       = $_POST['page_form_message'];
$page_form_code          = $_POST['page_form_code'];
$page_form_send          = $_POST['page_form_send'];
$page_form_type_name     = $_POST['page_form_type_name'];
$page_form_type_surname  = $_POST['page_form_type_surname'];
$page_form_type_email    = $_POST['page_form_type_email'];
$page_form_type_country  = $_POST['page_form_type_country'];
$page_form_type_phone    = $_POST['page_form_type_phone'];
$page_form_type_subject  = $_POST['page_form_type_subject'];
$page_form_type_message  = $_POST['page_form_type_message'];
$page_form_success       = $_POST['page_form_success'];
$page_form_error         = $_POST['page_form_error'];
$page_form_wrong_code    = $_POST['page_form_wrong_code'];
$page_form_short_name    = $_POST['page_form_short_name'];
$page_form_short_surname = $_POST['page_form_short_surname'];
$page_form_short_email   = $_POST['page_form_short_email'];
$page_form_short_phone   = $_POST['page_form_short_phone'];
$page_form_short_subject = $_POST['page_form_short_subject'];
$page_form_short_message = $_POST['page_form_short_message'];
$page_email_title        = $_POST['page_email_title'];
$page_email_hello        = $_POST['page_email_hello'];
$page_email_text         = $_POST['page_email_text'];
$page_email_name         = $_POST['page_email_name'];
$page_email_email        = $_POST['page_email_email'];
$page_email_phone        = $_POST['page_email_phone'];
$page_email_ip           = $_POST['page_email_ip'];
$page_email_date         = $_POST['page_email_date'];
$page_email_subject      = $_POST['page_email_subject'];
$page_email_message      = $_POST['page_email_message'];


$Db->query("UPDATE page_contact_us SET 
page_title               = ?,
page_description         = ?,
page_keywords            = ?,
page_name                = ?,
page_title1              = ?,
page_text1               = ?,
page_title2              = ?,
page_text2               = ?,
page_title3              = ?,
page_text3               = ?,
page_button1             = ?,
page_button2             = ?,
page_button3             = ?,
page_form_title          = ?,
page_form_name           = ?,
page_form_surname        = ?,
page_form_email          = ?,
page_form_country        = ?,
page_form_phone          = ?,
page_form_subject        = ?,
page_form_message        = ?,
page_form_code           = ?,
page_form_send           = ?,
page_form_type_name      = ?,
page_form_type_surname   = ?,
page_form_type_email     = ?,
page_form_type_country   = ?,
page_form_type_phone     = ?,
page_form_type_subject   = ?,
page_form_type_message   = ?,
page_form_success        = ?,
page_form_error          = ?,
page_form_wrong_code     = ?,
page_form_short_name     = ?,
page_form_short_surname  = ?,
page_form_short_email    = ?,
page_form_short_phone    = ?,
page_form_short_subject  = ?,
page_form_short_message  = ?,
page_email_title         = ?,
page_email_hello         = ?,
page_email_text          = ?,
page_email_name          = ?,
page_email_email         = ?,
page_email_phone         = ?,
page_email_ip            = ?,
page_email_date          = ?,
page_email_subject       = ?,
page_email_message       = ?
WHERE page_id            = ?
", array($page_title,$page_description,$page_keywords,$page_name,$page_title1,$page_text1,$page_title2,$page_text2,$page_title3,$page_text3,$page_button1,$page_button2,$page_button3,$page_form_title,$page_form_name,$page_form_surname,$page_form_email,$page_form_country,$page_form_phone,$page_form_subject,$page_form_message,$page_form_code,$page_form_send,$page_form_type_name,$page_form_type_surname,$page_form_type_email,$page_form_type_country,$page_form_type_phone,$page_form_type_subject,$page_form_type_message,$page_form_success,$page_form_error,$page_form_wrong_code,$page_form_short_name,$page_form_short_surname,$page_form_short_email,$page_form_short_phone,$page_form_short_subject,$page_form_short_message,$page_email_title,$page_email_hello,$page_email_text,$page_email_name,$page_email_email,$page_email_phone,$page_email_ip,$page_email_date,$page_email_subject,$page_email_message,$page_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/pages/contact_us/index.php?lang_id=$page_lang_id"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>