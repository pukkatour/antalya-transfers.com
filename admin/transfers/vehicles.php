<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$datas = $Db->query("SELECT * FROM transfer_vehicles WHERE vehicle_lang_id = ?", array($_GET['lang']));

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>

<!DOCTYPE html>
<html lang="tr">

<?php include_once("../head_meta.php"); ?>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

<?php include_once("../header.php"); ?>

<?php include_once("../left_menu.php"); ?>

<div class="content-wrapper">

<section class="content-header">
<h1>Yönetim Paneli<small>Version 1.2</small></h1>
<ol class="breadcrumb">
<li><a href="<?php echo SITE_URL."admin/index.php"; ?>"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
<li><a href="<?php echo SITE_URL; ?>admin/transfers/index.php">Havalimanı Transferi</a></li>
<li class="active">Araçlar</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-4">
<div class="box box-primary">

<div class="box-header with-border">
<h3 class="box-title">Düzenlenecek Dili Seçin</h3>
</div>

<form method="get">
<div class="box-body">
<div class="form-group">
<label>Dil</label>
<select class="form-control" name="lang" onchange="this.form.submit()">
<?php if (!empty($languagelist)) { foreach ($languagelist as $lang) { ?>
<option <?php if ($_GET['lang'] == $lang['lang_id']) { echo 'selected="selected"'; } ?> value="<?php echo $lang['lang_id']; ?>"><?php echo $lang['lang_name_eng']; ?></option>
<?php } } ?>
</select>
</div>
</div>
</form>

</div>
</div>

</div>

<div class="row">

<div class="col-md-12">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Araçlar</h3>
</div>

<div class="box-body">

<table id="d_table" class="table table-striped table-hover table-bordered table-condensed">

<thead>
<tr>
<th>Araç Adı</th>
<th>Kapasite</th>
<th>Tip</th>
<th>Foto Kapak</th>
<th>Foto 1</th>
<th>Foto 2</th>
<th>Foto 3</th>
<th></th>
</tr>
</thead>

<tbody>
<?php if (!empty($datas)) { foreach ($datas as $data) {
if ($data['vehicle_img'] != NULL) { $gorsel1 = IMAGE_PATH."transfer/".$data['vehicle_img']; } else { $gorsel1 = ""; }
if ($data['vehicle_img1'] != NULL) { $gorsel2 = IMAGE_PATH."transfer/".$data['vehicle_img1']; } else { $gorsel2 = ""; }
if ($data['vehicle_img2'] != NULL) { $gorsel3 = IMAGE_PATH."transfer/".$data['vehicle_img2']; } else { $gorsel3 = ""; }
if ($data['vehicle_img3'] != NULL) { $gorsel4 = IMAGE_PATH."transfer/".$data['vehicle_img3']; } else { $gorsel4 = ""; }
?>
<tr>
<td><?php echo $data['vehicle_name']; ?></td>
<td><?php echo $data['vehicle_pax']; ?></td>
<td>
<?php if ($data['vehicle_is_shared'] == 2) { echo "VIP"; } ?>
<?php if ($data['vehicle_is_shared'] == 1) { echo "Shuttle"; } ?>
</td>
<td>
<a href="#" onclick="document.getElementById('file<?php echo $data['vehicle_id']; ?>').click()">
<img src="<?php if (file_exists($gorsel1)) { echo IMAGE_FOLDER."transfer/".$data['vehicle_img']."?".date_timestamp_get(date_create()); } else { echo IMAGE_FOLDER."no_photo.jpg"; } ?>" style="height: 70px;" class="img-thumbnail">
</a>
<form name="foto" id="foto<?php echo $data['vehicle_id']; ?>" enctype="multipart/form-data" method="post" action="upload_photo.php">
<input type="file" id="file<?php echo $data['vehicle_id']; ?>" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="vehicle_vehicle_id" value="<?php echo $data['vehicle_vehicle_id']; ?>">
<script>
document.getElementById("file<?php echo $data['vehicle_id']; ?>").onchange = function() { document.getElementById("foto<?php echo $data['vehicle_id']; ?>").submit(); };
</script>
</form>
</td>
<td>
<a href="#" onclick="document.getElementById('file1<?php echo $data['vehicle_id']; ?>').click()">
<img src="<?php if (file_exists($gorsel2)) { echo IMAGE_FOLDER."transfer/".$data['vehicle_img1']."?".date_timestamp_get(date_create()); } else { echo IMAGE_FOLDER."no_photo.jpg"; } ?>" style="height: 70px;" class="img-thumbnail">
</a>
<form name="foto" id="foto1<?php echo $data['vehicle_id']; ?>" enctype="multipart/form-data" method="post" action="upload_photo2.php">
<input type="file" id="file1<?php echo $data['vehicle_id']; ?>" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="vehicle_vehicle_id" value="<?php echo $data['vehicle_vehicle_id']; ?>">
<input type="hidden" name="img" value="vehicle_img1">
<script>
document.getElementById("file1<?php echo $data['vehicle_id']; ?>").onchange = function() { document.getElementById("foto1<?php echo $data['vehicle_id']; ?>").submit(); };
</script>
</form>
</td>
<td>
<a href="#" onclick="document.getElementById('file2<?php echo $data['vehicle_id']; ?>').click()">
<img src="<?php if (file_exists($gorsel3)) { echo IMAGE_FOLDER."transfer/".$data['vehicle_img2']."?".date_timestamp_get(date_create()); } else { echo IMAGE_FOLDER."no_photo.jpg"; } ?>" style="height: 70px;" class="img-thumbnail">
</a>
<form name="foto" id="foto2<?php echo $data['vehicle_id']; ?>" enctype="multipart/form-data" method="post" action="upload_photo2.php">
<input type="file" id="file2<?php echo $data['vehicle_id']; ?>" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="vehicle_vehicle_id" value="<?php echo $data['vehicle_vehicle_id']; ?>">
<input type="hidden" name="img" value="vehicle_img2">
<script>
document.getElementById("file2<?php echo $data['vehicle_id']; ?>").onchange = function() { document.getElementById("foto2<?php echo $data['vehicle_id']; ?>").submit(); };
</script>
</form>
</td>
<td>
<a href="#" onclick="document.getElementById('file3<?php echo $data['vehicle_id']; ?>').click()">
<img src="<?php if (file_exists($gorsel4)) { echo IMAGE_FOLDER."transfer/".$data['vehicle_img3']."?".date_timestamp_get(date_create()); } else { echo IMAGE_FOLDER."no_photo.jpg"; } ?>" style="height: 70px;" class="img-thumbnail">
</a>
<form name="foto" id="foto3<?php echo $data['vehicle_id']; ?>" enctype="multipart/form-data" method="post" action="upload_photo2.php">
<input type="file" id="file3<?php echo $data['vehicle_id']; ?>" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="vehicle_vehicle_id" value="<?php echo $data['vehicle_vehicle_id']; ?>">
<input type="hidden" name="img" value="vehicle_img3">
<script>
document.getElementById("file3<?php echo $data['vehicle_id']; ?>").onchange = function() { document.getElementById("foto3<?php echo $data['vehicle_id']; ?>").submit(); };
</script>
</form>
</td>
<td align="right">
<a href="#" data-toggle="modal" data-target="#myModal<?php echo $data['vehicle_id']; ?>" class="btn btn-sm btn-success">Düzenle</a> 
</td>
</tr>


<div class="modal fade" id="myModal<?php echo $data['vehicle_id']; ?>" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Havaalanı Düzenleme</h4>
</div>

<div class="modal-body">
<div class="box-body">

<form id="edit_<?php echo $data['vehicle_id']; ?>" method="POST" action="vehicle_update.php">

<input type="hidden" name="vehicle_id" value="<?php echo $data['vehicle_id']; ?>">
<input type="hidden" name="vehicle_lang_id" value="<?php echo $data['vehicle_lang_id']; ?>">
<input type="hidden" name="vehicle_vehicle_id" value="<?php echo $data['vehicle_vehicle_id']; ?>">

<div class="form-group">
<label>Araç Adı</label>
<input type="text" name="vehicle_name" class="form-control" value="<?php echo $data['vehicle_name']; ?>" maxlength="250" required="">
</div>

<div class="form-group">
<label>Kapasite</label>
<input type="text" name="vehicle_pax" class="form-control" value="<?php echo $data['vehicle_pax']; ?>" onkeypress="return h_isNumber(event)" maxlength="2" required="">
</div>

<div class="form-group">
<label>Kapasite</label>
<select name="vehicle_is_shared" class="form-control" required="">
<option <?php if ($data['vehicle_is_shared'] == 2) { echo 'selected="selected"'; } ?> value="2">VIP</option>
<option <?php if ($data['vehicle_is_shared'] == 1) { echo 'selected="selected"'; } ?> value="1">Shuttle</option>
</select>
</div>

</form>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Çık</button>
<button type="button" onclick="document.getElementById('edit_<?php echo $data['vehicle_id']; ?>').submit();" class="btn btn-primary">Kaydet</button>
</div>

</div>
</div>
</div>

<?php } } ?>
</tbody>

</table>

</div>

</div>

</div>

</div>

</section>

</div>

<?php include_once("../footer.php"); ?>

</div>

<?php include_once("../footer_scripts.php"); ?>

<script>$(function () { $('#d_table').dataTable( {} ); });</script>

</body>
</html>