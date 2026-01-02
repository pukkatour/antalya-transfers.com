<?php
namespace Verot\Upload;
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$page_page_id = $_POST['page_page_id'];
$img          = $_POST['img'];
$slug         = $_POST['slug'];
$id           = $_POST['id'];

$img_db = $slug."-".$id.".jpg";
$img_up = $slug."-".$id;

$foo = new Upload($_FILES['my_field']);
if ($foo->uploaded) {
$foo->file_new_name_body = $img_up;
$foo->file_overwrite = true;
$foo->image_convert = 'jpg';
$foo->image_resize = true;
$foo->image_ratio_crop = true;
$foo->allowed = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');
$foo->image_x = 800;
$foo->image_y = 600;
$foo->Process(IMAGE_PATH."pages/");
}
if ($foo->processed) {
$Db->query("UPDATE info_pages SET $img = ? WHERE page_page_id = ?", array($img_db,$page_page_id));

$_SESSION["alert"] = "ok";
redirect($_SERVER['HTTP_REFERER']); exit;
}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>