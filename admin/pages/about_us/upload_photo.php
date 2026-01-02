<?php
namespace Verot\Upload;
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$lang   = $_POST['lang_id'];
$img    = $_POST['img_id'];

if (!empty($lang)) {

$img_db = "about_us-".$img.".jpg";
$img_up = "about_us-".$img;

$foo = new Upload($_FILES['my_field']);
if ($foo->uploaded) {
$foo->file_new_name_body = $img_up;
$foo->file_overwrite = true;
$foo->image_convert = 'jpg';
$foo->image_resize = true;
$foo->image_ratio_crop = true;
$foo->allowed = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');
$foo->image_x = 500;
$foo->image_y = 300;
$foo->Process(IMAGE_PATH."pages/");
}
if ($foo->processed) {
$Db->query("UPDATE page_about_us SET $img = ?", array($img_db));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/pages/about_us/index.php?lang_id=$lang"); exit;
}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>