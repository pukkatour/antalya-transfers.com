<?php

ini_set('session.auto_start', 1);
ini_set('max_execution_time', 0);
ini_set('upload_max_filesize', '200M');
error_reporting(E_ALL ^ E_DEPRECATED);

define('SERVER_PATH', dirname(__FILE__).'/');
define('MAIN_DOMAIN', $_SERVER['HTTP_HOST']);
define('SITE_URL', 'https://'.MAIN_DOMAIN.'/');
define('CURRENT_URL', 'https://'.MAIN_DOMAIN.$_SERVER['PHP_SELF']);
define('URL_PATH', dirname($_SERVER['PHP_SELF']));
define('URL_NOQUERY', strtok($_SERVER["REQUEST_URI"],'?'));
define('LAST_FILE', basename(CURRENT_URL));
define('NO_DOMAIN_FOLDER_URL', $_SERVER['REQUEST_URI']);
define('FIRST_FOLDER', dirname(NO_DOMAIN_FOLDER_URL));


define('IMAGE_PATH', '/home/antalya-transfers.com/public_html/images/');
define('IMAGE_FOLDER', 'https://'.MAIN_DOMAIN.'/images/');

define('DB_HOST', 'localhost');
define('DB_NAME', 'antalya_transfers_com');
define('DB_USER', 'antalya_transfers_com');
define('DB_PASS', 'ant.2020_!@910');

define('CHARSET', 'UTF-8');
header('Content-Type: text/html; charset=utf-8');

if (!ob_start("ob_gzhandler")) ob_start();

date_default_timezone_set('Europe/Istanbul');
session_start();

require_once 'class.PDO.php';
require_once 'h_functions.php';
require_once 'class.upload.php';


#############


$Db              = new DB(DB_HOST, DB_NAME, DB_USER, DB_PASS);

$date_time       = date("Y-m-d H:i:s");
$date            = date("Y-m-d");

if (!empty($_SESSION['admin'])) { $admin_id = $_SESSION['admin']['admin_id']; }

$currencylist    = $Db->query("SELECT * FROM currencies");
$languagelist    = $Db->query("SELECT * FROM language_list");
$countrylist     = $Db->query("SELECT * FROM country_list");
$sitesettings    = $Db->row("SELECT * FROM site_settings WHERE site_lang_id = ?", array($site_lang));
$selectedlang    = $Db->row("SELECT * FROM language_list WHERE lang_id = ?", array($site_lang));
$translate       = $Db->row("SELECT * FROM translate WHERE tr_lang = ?", array($site_lang));
$hostname        = str_replace('www.', '', MAIN_DOMAIN);
$totalreviews    = $Db->row("SELECT count(review_id) AS revs FROM reviews WHERE review_status = ?", array('1'));
#############



$getcurrency     = $Db->row("SELECT * FROM currency_rates ORDER BY rate_id DESC");

if (isset($_SESSION['kur'])) {

$kur             = $_SESSION['kur'];
$getcode         = $Db->row("SELECT curr_code,curr_symbol FROM currencies WHERE curr_id = ?", array($kur));
$kurcode         = $getcode['curr_code'];
$kursymb         = $getcode['curr_symbol'];
$currency        = $getcurrency;

} else {

$_SESSION['kur'] = "3";
$kur             = "3";
$kurcode         = "EUR";
$kursymb         = "&#8364;";
$currency        = $getcurrency;

}

#############

// Pagniation İçin
$urlsetted       = $_SERVER['REQUEST_URI'];
$urlsettedEN     = $_SERVER['REQUEST_URI'];
$urlsettedTR     = $_SERVER['REQUEST_URI'];

if(!empty($urlsetted)) {
$urlsetted       = ltrim($urlsetted, '/');
$konum           = strpos($urlsetted, "&page");
if ($konum === false) { } else { $urlsetted = substr($urlsetted, 0, $konum); }
$konum = strpos($urlsetted, "?page");
if ($konum === false) { } else { $urlsetted = substr($urlsetted, 0, $konum); }
}

if(!empty($urlsettedEN)) {
$urlsettedEN     = ltrim($urlsettedEN, '/');
$konumEN         = strpos($urlsettedEN, "&page");
if ($konumEN === false) { } else { $urlsettedEN = substr($urlsettedEN, 0, $konumEN); }
$konumEN = strpos($urlsettedEN, "?page");
if ($konumEN === false) { } else { $urlsettedEN = substr($urlsettedEN, 0, $konumEN); }
}

if(!empty($urlsettedTR)) {
$urlsettedTR     = ltrim($urlsettedTR, '/');
$konumTR         = strpos($urlsettedTR, "&sayfa");
if ($konumTR === false) { } else { $urlsettedTR = substr($urlsettedTR, 0, $konumTR); }
$konumTR = strpos($urlsettedTR, "?sayfa");
if ($konumTR === false) { } else { $urlsettedTR = substr($urlsettedTR, 0, $konumTR); }
}

// Pagniation İçin

ob_start("compress_htmlcode");

function compress_htmlcode($codedata) 
{
$searchdata  = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');
$replacedata = array('>','<','\\1');
$codedata    = preg_replace($searchdata, $replacedata, $codedata);
return $codedata;
}

?>