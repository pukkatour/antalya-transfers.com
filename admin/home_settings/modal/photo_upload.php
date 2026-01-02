<?php
namespace Verot\Upload;
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$lang_id = $_POST['lang_id'];

if (!empty($lang_id)) {

$img_db = "modal-".$lang_id.".jpg";
$img_up = "modal-".$lang_id;

$foo = new Upload($_FILES['my_field']);
if ($foo->uploaded) {
$foo->file_new_name_body = $img_up;
$foo->file_overwrite = true;
$foo->image_convert = 'jpg';
$foo->image_resize = true;
$foo->image_ratio_crop = true;
$foo->allowed = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');
$foo->image_x = 1200;
$foo->image_y = 900;
$foo->Process(IMAGE_PATH."home/");
}
if ($foo->processed) {
$Db->query("UPDATE home_modal SET img = ? WHERE lang_id = ?", array($img_db,$lang_id));
$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/home_settings/modal/index.php?lang_id=$lang_id"); exit;
} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

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