<?php
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$page_page_id = $_GET['page_page_id'];

$control = $Db->row("SELECT page_image1,page_image2,page_image3 FROM info_pages WHERE page_page_id = ?", array($page_page_id));
$Db->query("DELETE FROM info_pages WHERE page_page_id = ?", array($page_page_id));

$filename1 = $control['page_image1'];
$filename1 = IMAGE_PATH."pages/".$filename1;
if (file_exists($filename1)) { unlink($filename1); }

$filename2 = $control['page_image2'];
$filename2 = IMAGE_PATH."pages/".$filename2;
if (file_exists($filename2)) { unlink($filename2); }

$filename3 = $control['page_image3'];
$filename3 = IMAGE_PATH."pages/".$filename3;
if (file_exists($filename3)) { unlink($filename3); }

$_SESSION["alert"] = "ok";
redirect($_SERVER['HTTP_REFERER']); exit;

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>