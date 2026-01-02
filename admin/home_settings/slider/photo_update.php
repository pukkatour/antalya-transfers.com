<?php
namespace Verot\Upload;
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$slider_id = $_POST['slider_id'];

if (!empty($slider_id)) {

$img_db = "slide-".$slider_id.".jpg";
$img_up = "slide-".$slider_id;

$foo = new Upload($_FILES['my_field']);
if ($foo->uploaded) {
$foo->file_new_name_body = $img_up;
$foo->file_overwrite = true;
$foo->image_convert = 'jpg';
$foo->image_resize = true;
$foo->image_ratio_crop = true;
$foo->allowed = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');
$foo->image_x = 1920;
$foo->image_y = 1280;
$foo->Process(IMAGE_PATH."slider/");
}
if ($foo->processed) {
$Db->query("UPDATE home_slider SET slider_img = ? WHERE slider_slider_id = ? ", array($img_db,$slider_id));
$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/home_settings/slider/index.php?lang_id=1"); exit;
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