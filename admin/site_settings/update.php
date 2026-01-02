<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$_POST = array_map("tirnak", $_POST);

$site_id                     = $_POST['site_id'];
$site_lang_id                = $_POST['site_lang_id'];
$site_name                   = $_POST['site_name'];
$site_title                  = $_POST['site_title'];
$site_description            = $_POST['site_description'];
$site_phone                  = $_POST['site_phone'];
$site_contact_email          = $_POST['site_contact_email'];
$site_contact_email_pass     = $_POST['site_contact_email_pass'];
$site_footer_text            = $_POST['site_footer_text'];
$site_analytics_code         = $_POST['site_analytics_code'];
$site_google_webmasters_code = $_POST['site_google_webmasters_code'];
$site_bing_webmasters_code   = $_POST['site_bing_webmasters_code'];
$site_yandex_webmasters_code = $_POST['site_yandex_webmasters_code'];
$site_google_maps_key        = $_POST['site_google_maps_key'];
$site_facebook               = $_POST['site_facebook'];
$site_twitter                = $_POST['site_twitter'];
$site_instagram              = $_POST['site_instagram'];
$site_company_name           = $_POST['site_company_name'];
$site_address_1              = $_POST['site_address_1'];
$site_address_2              = $_POST['site_address_2'];
$site_phone_1                = $_POST['site_phone_1'];
$site_phone_2                = $_POST['site_phone_2'];
$site_email                  = $_POST['site_email'];
$site_whatssapp              = $_POST['site_whatssapp'];
$site_tawkto                 = $_POST['site_tawkto'];
$site_gps                    = $_POST['site_gps'];
$site_sms_phone              = $_POST['site_sms_phone'];
$site_sms_pass               = $_POST['site_sms_pass'];
$site_sms_title              = $_POST['site_sms_title'];
$site_transfer_shuttle       = $_POST['site_transfer_shuttle'];


$Db->query("UPDATE site_settings SET 
site_name                   = ?,
site_title                  = ?,
site_description            = ?,
site_phone                  = ?,
site_contact_email          = ?,
site_contact_email_pass     = ?,
site_footer_text            = ?,
site_analytics_code         = ?,
site_google_webmasters_code = ?,
site_bing_webmasters_code   = ?,
site_yandex_webmasters_code = ?,
site_google_maps_key        = ?,
site_facebook               = ?,
site_twitter                = ?,
site_instagram              = ?,
site_company_name           = ?,
site_address_1              = ?,
site_address_2              = ?,
site_phone_1                = ?,
site_phone_2                = ?,
site_email                  = ?,
site_whatssapp              = ?,
site_tawkto                 = ?,
site_gps                    = ?,
site_sms_phone              = ?,
site_sms_pass               = ?,
site_sms_title              = ?,
site_transfer_shuttle       = ?
WHERE site_id               = ?
", array($site_name,$site_title,$site_description,$site_phone,$site_contact_email,$site_contact_email_pass,$site_footer_text,$site_analytics_code,$site_google_webmasters_code,$site_bing_webmasters_code,$site_yandex_webmasters_code,$site_google_maps_key,$site_facebook,$site_twitter,$site_instagram,$site_company_name,$site_address_1,$site_address_2,$site_phone_1,$site_phone_2,$site_email,$site_whatssapp,$site_tawkto,$site_gps,$site_sms_phone,$site_sms_pass,$site_sms_title,$site_transfer_shuttle,$site_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/site_settings/index.php?lang_id=$site_lang_id"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>