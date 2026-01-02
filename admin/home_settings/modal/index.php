<?php
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$lang_id = $_GET['lang_id'];
$data    = $Db->row("SELECT * FROM home_modal WHERE lang_id = ?", array($lang_id));

} else {

redirect(SITE_URL."admin/index.php"); exit;

}

?>

<!DOCTYPE html>
<html lang="tr">

<?php include_once("../../head_meta.php"); ?>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

<?php include_once("../../header.php"); ?>

<?php include_once("../../left_menu.php"); ?>

<div class="content-wrapper">

<section class="content-header">
<h1>Yönetim Paneli<small>Version 1.2</small></h1>
<ol class="breadcrumb">
<li><a href="<?php echo SITE_URL."admin/index.php"; ?>"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
<li class="active">Ana Sayfa Popup</li>
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
<select class="form-control" name="lang_id" onchange="this.form.submit()">
<?php if (!empty($languagelist)) { foreach ($languagelist as $lang) { ?>
<option <?php if ($_GET['lang_id'] == $lang['lang_id']) { echo 'selected="selected"'; } ?> value="<?php echo $lang['lang_id']; ?>"><?php echo $lang['lang_name_eng']; ?></option>
<?php } } ?>
</select>
</div>
</div>
</form>

</div>
</div>

<div class="col-md-4">
<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Popup Gösterim Durumu</h3>
</div>

<form method="GET" action="update.php">

<div class="box-body">
<div class="form-group">
<label>Popup Durumu</label>
<select class="form-control" name="stat" onchange="this.form.submit()">
<option <?php if ($data['stat'] == 1) { echo 'selected="selected"'; } ?> value="1">Pasif</option>
<option <?php if ($data['stat'] == 2) { echo 'selected="selected"'; } ?> value="2">Aktif</option>
</select>
</div>
</div>

<input type="hidden" name="lang_id" value="<?php echo $_GET['lang_id']; ?>">

</form>

</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="box box-primary">

<div class="box-header with-border">
<h3 class="box-title">URL</h3>
</div>

<form method="GET" action="update.php">

<div class="box-body">
<div class="form-group">
<label>Site İçi URL</label>
<input type="text" name="url" class="form-control" value="<?php echo $data['url']; ?>">
</div>
</div>

<input type="hidden" name="lang_id" value="<?php echo $_GET['lang_id']; ?>">

<div class="box-footer">
<button type="submit" class="btn btn-sm btn-primary pull-right">Güncelle</button>
</div>

</form>

</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Ana Sayfa Popup Reklam (1200 x 900 px)</h3>
</div>

<div class="box-body">

<a href="#" onclick="document.getElementById('file1').click()">
<img id="myimg1" src="" class="img-thumbnail">
</a>
<form name="foto1" id="foto1" enctype="multipart/form-data" method="POST" action="photo_upload.php">
<input type="file" id="file1" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="lang_id" value="<?php echo $data['lang_id']; ?>">
<script>document.getElementById("file1").onchange = function() { document.getElementById("foto1").submit(); };</script>
</form>
<script>
d = new Date();
$.ajax({
url:'<?php echo IMAGE_FOLDER."home/"; ?><?php echo $data['img']; ?>',
type:'HEAD',
error: function() { $("#myimg1").attr("src", "<?php echo IMAGE_FOLDER; ?>no_photo.jpg?"+d.getTime()); },
success: function() {  $("#myimg1").attr("src", "<?php echo IMAGE_FOLDER."home/"; ?><?php echo $data['img']; ?>?"+d.getTime()); }
});
</script>

</div>

</div>
</div>

</div>

</section>

</div>

<?php include_once("../../footer.php"); ?>

</div>

<?php include_once("../../footer_scripts.php"); ?>

</body>
</html>