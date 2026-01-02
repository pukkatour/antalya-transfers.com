<?php
namespace Verot\Upload;
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$lang   = $_POST['lang_id'];

if (!empty($lang)) {


$img_db1 = "apple-logo.png";
$img_up1 = "apple-logo";

$img_up2 = "apple-logo-144";
$img_up3 = "apple-logo-114";
$img_up4 = "apple-logo-72";
$img_up5 = "apple-logo-57";

$foo = new Upload($_FILES['my_field']);

if ($foo->uploaded) {
$foo->file_new_name_body = $img_up1;
$foo->file_overwrite = true;
$foo->image_convert = 'png';
$foo->image_resize = true;
$foo->image_ratio_crop = true;
$foo->allowed = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');
$foo->image_x = 400;
$foo->image_y = 400;
$foo->Process(IMAGE_PATH);
}

if ($foo->uploaded) {
$foo->file_new_name_body = $img_up2;
$foo->file_overwrite = true;
$foo->image_convert = 'png';
$foo->image_resize = true;
$foo->image_ratio_crop = true;
$foo->allowed = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');
$foo->image_x = 144;
$foo->image_y = 144;
$foo->Process(IMAGE_PATH);
}

if ($foo->uploaded) {
$foo->file_new_name_body = $img_up3;
$foo->file_overwrite = true;
$foo->image_convert = 'png';
$foo->image_resize = true;
$foo->image_ratio_crop = true;
$foo->allowed = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');
$foo->image_x = 114;
$foo->image_y = 114;
$foo->Process(IMAGE_PATH);
}

if ($foo->uploaded) {
$foo->file_new_name_body = $img_up4;
$foo->file_overwrite = true;
$foo->image_convert = 'png';
$foo->image_resize = true;
$foo->image_ratio_crop = true;
$foo->allowed = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');
$foo->image_x = 72;
$foo->image_y = 72;
$foo->Process(IMAGE_PATH);
}

if ($foo->uploaded) {
$foo->file_new_name_body = $img_up5;
$foo->file_overwrite = true;
$foo->image_convert = 'png';
$foo->image_resize = true;
$foo->image_ratio_crop = true;
$foo->allowed = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');
$foo->image_x = 57;
$foo->image_y = 57;
$foo->Process(IMAGE_PATH);
}


if ($foo->processed) {
$Db->query("UPDATE site_settings SET site_apple_logo = ?", array($img_db1));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/site_settings/index.php?lang_id=$lang"); exit;
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