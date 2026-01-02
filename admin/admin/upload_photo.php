<?php
namespace Verot\Upload;
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$id = $_POST['id'];

if (!empty($id)) {

$img_db = "admin-".$id.".jpg";
$img_up = "admin-".$id;

$foo = new Upload($_FILES['my_field']);
if ($foo->uploaded) {
$foo->file_new_name_body = $img_up;
$foo->file_overwrite = true;
$foo->image_convert = 'jpg';
$foo->image_resize = true;
$foo->image_ratio_crop = true;
$foo->allowed = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');
$foo->image_x = 400;
$foo->image_y = 400;
$foo->Process(IMAGE_PATH."admin/");
}
if ($foo->processed) {
$Db->query("UPDATE admin SET admin_image = ? WHERE admin_id = ?", array($img_db,$id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/admin/index.php"); exit;
}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/admin/index.php"); exit;

}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>