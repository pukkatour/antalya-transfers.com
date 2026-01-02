<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$text = $_POST['value'];
$id   = $_POST['pk'];

$Db->query("UPDATE transfer_bookings SET booking_agent_note = ? WHERE booking_id = ?", array($text,$id));

$_SESSION["alert"] = "ok";

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>