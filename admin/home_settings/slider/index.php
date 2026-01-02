<?php
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$lang_id = $_GET['lang_id'];
$data    = $Db->query("SELECT * FROM home_slider WHERE slider_lang_id = ?", array($_GET['lang_id']));

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
<li class="active">Slider</li>
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

<div class="col-md-9">
<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Fotoğraf Ekle</h3>
</div>

<div class="box-body">

<form name="fotoslider" id="fotoslider" enctype="multipart/form-data" method="POST" action="photo_upload.php">
<input type="file" id="fileslider" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<?php
$slide   = $Db->row("SELECT slider_slider_id FROM home_slider WHERE slider_lang_id = ? ORDER BY slider_slider_id DESC ", array('1'));
$noslide = $slide['slider_slider_id'] + 1;
?>
<input type="hidden" name="file_number" value="<?php echo $noslide; ?>">
<span style="font-size: 15px;">Yüklenecek fotoğraf 1920 x 1280 px ölçülerinde olmalıdır.</span>
<a href="#" id="loadimage" class="btn btn-sm btn-danger btn-flat pull-right" onclick="document.getElementById('fileslider').click()"><b>Yeni Slide Ekle</b></a>
</form>

</div>

</div>
</div>

</div>

<div class="row">

<?php if (!empty($data)) { foreach ($data as $dt) { ?>

<div class="col-md-3">
<div class="box box-info">

<a href="#" onclick="document.getElementById('file<?php echo $dt['slider_slider_id']; ?>').click()">
<img id="myimg<?php echo $dt['slider_slider_id']; ?>" src="" class="img-thumbnail img-responsive">
</a>

<form name="foto<?php echo $dt['slider_slider_id']; ?>" id="foto<?php echo $dt['slider_slider_id']; ?>" enctype="multipart/form-data" method="post" action="photo_update.php">
<input type="file" id="file<?php echo $dt['slider_slider_id']; ?>" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="slider_id" value="<?php echo $dt['slider_slider_id']; ?>">
<script>document.getElementById("file<?php echo $dt['slider_slider_id']; ?>").onchange = function() { document.getElementById("foto<?php echo $dt['slider_slider_id']; ?>").submit(); };</script>
</form>

<script>
d = new Date();
$("#myimg<?php echo $dt['slider_slider_id']; ?>").attr("src", "<?php echo IMAGE_FOLDER; ?>slider/<?php echo $dt['slider_img']; ?>?"+d.getTime());
</script>

</div>
</div>

<?php } } ?>

</div>

</section>

</div>

<?php include_once("../../footer.php"); ?>

</div>

<?php include_once("../../footer_scripts.php"); ?>

</body>
</html>