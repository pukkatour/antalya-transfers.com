<?php
include_once('include/site_id.php');
include_once('include/initialize.inc.php');

unset($_SESSION['admin']);
session_destroy();
redirect(SITE_URL);
exit;

?>