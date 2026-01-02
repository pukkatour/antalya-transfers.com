<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$lang_id       = $_POST['lang_id'];
$lang_name_eng = $_POST['lang_name_eng'];
$lang_name_orj = $_POST['lang_name_orj'];
$lang_url      = $_POST['lang_url'];
$lang_status   = $_POST['lang_status'];

$Db->query("UPDATE language_list SET
lang_name_eng = ?,
lang_name_orj = ?,
lang_url      = ?,
lang_status   = ?
WHERE lang_id = ?"
, array($lang_name_eng,$lang_name_orj,$lang_url,$lang_status,$lang_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/definitions/languages.php"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/admin/index.php"); exit;

}

?>