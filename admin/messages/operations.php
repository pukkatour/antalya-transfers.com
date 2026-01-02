<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$action = $_GET['action'];
$id     = $_GET['id'];

if (!empty($id)) {

if ($action != 3) {
$Db->query("UPDATE contact_messages SET message_seen = ? WHERE message_id = ?", array($action,$id));
}

if ($action == 3) {

$Db->query("DELETE FROM contact_messages WHERE message_id = ?", array($id));

}

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/messages/index.php"); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/messages/index.php"); exit;

}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/messages/index.php"); exit;

}

?>