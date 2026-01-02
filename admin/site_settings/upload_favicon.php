<?php
namespace Verot\Upload;
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$lang   = $_POST['lang_id'];

if (!empty($lang)) {

$img_db = "favicon.png";
$img_up = "favicon";

$foo = new Upload($_FILES['my_field']);
if ($foo->uploaded) {
$foo->file_new_name_body = $img_up;
$foo->file_overwrite = true;
$foo->image_convert = 'png';
$foo->image_resize = true;
$foo->image_ratio_crop = true;
$foo->allowed = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');
$foo->image_x = 60;
$foo->image_y = 60;
$foo->Process(IMAGE_PATH);
}
if ($foo->processed) {
$Db->query("UPDATE site_settings SET site_favicon = ?", array($img_db));

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