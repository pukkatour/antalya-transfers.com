<?php
namespace Verot\Upload;
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$photo_type = $_POST['photo_type'];
$photo_w    = $_POST['photo_w'];
$photo_h    = $_POST['photo_h'];
$photo_t    = $_POST['photo_t'];
$lang_id    = $_POST['lang_id'];

$img_db = $photo_type.".".$photo_t;
$img_up = $photo_type;

$foo = new Upload($_FILES['my_field']);
if ($foo->uploaded) {
$foo->file_new_name_body = $img_up;
$foo->file_overwrite = true;
$foo->image_convert = $photo_t;
$foo->image_resize = true;
$foo->image_ratio_crop = true;
$foo->allowed = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');
$foo->image_x = $photo_w;
$foo->image_y = $photo_h;
$foo->Process(IMAGE_PATH."email/");
}
if ($foo->processed) {
$Db->query("UPDATE email_template SET $photo_type = ?", array($img_db));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/site_settings/email_template.php?lang_id=$lang_id"); exit;
}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>