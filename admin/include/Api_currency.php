<?php
include_once('initialize.inc.php');

if (isset($_GET['kur'])) { $_SESSION['kur'] = $_GET['kur']; } else { $_SESSION['kur'] = '1'; }

$curr_url = $_SERVER['HTTP_REFERER'];

if (headers_sent()) { echo "<script>document.location='$curr_url';</script>"; } else { header('Location: ' . $curr_url); }

exit;

?>