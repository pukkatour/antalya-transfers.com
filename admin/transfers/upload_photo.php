<?php
namespace Verot\Upload;
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$vehicle_vehicle_id  = $_POST['vehicle_vehicle_id'];

$img_db = "transfer-".$vehicle_vehicle_id.".jpg";
$img_up = "transfer-".$vehicle_vehicle_id;

$foo = new Upload($_FILES['my_field']);
if ($foo->uploaded) {
$foo->file_new_name_body = $img_up;
$foo->file_overwrite = true;
$foo->image_convert = 'jpg';
$foo->image_resize = true;
$foo->image_ratio_crop = true;
$foo->allowed = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');
$foo->image_x = 600;
$foo->image_y = 400;
$foo->Process(IMAGE_PATH."transfer/");
}
if ($foo->processed) {
$Db->query("UPDATE transfer_vehicles SET vehicle_img = ? WHERE vehicle_vehicle_id = ?", array($img_db,$vehicle_vehicle_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/transfers/vehicles.php?lang=1");
}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>