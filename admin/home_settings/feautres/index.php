<?php
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$lang_id = $_GET['lang_id'];
$data    = $Db->row("SELECT * FROM home_feautres WHERE features_lang_id = ?", array($lang_id));

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
<li class="active">Hizmet Özellikleri Alanı</li>
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


<div class="col-md-3">
<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Sol Fotoğraf (800 x 600 px)</h3>
</div>

<div class="box-body">

<a href="#" onclick="document.getElementById('file1').click()">
<img id="myimg1" src="" class="img-thumbnail">
</a>
<form name="foto1" id="foto1" enctype="multipart/form-data" method="POST" action="photo_upload.php">
<input type="file" id="file1" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="lang_id" value="<?php echo $data['features_lang_id']; ?>">
<script>document.getElementById("file1").onchange = function() { document.getElementById("foto1").submit(); };</script>
</form>
<script>
d = new Date();
$.ajax({
url:'<?php echo IMAGE_FOLDER."home/"; ?><?php echo $data['features_img']; ?>',
type:'HEAD',
error: function() { $("#myimg1").attr("src", "<?php echo IMAGE_FOLDER; ?>no_photo.jpg?"+d.getTime()); },
success: function() {  $("#myimg1").attr("src", "<?php echo IMAGE_FOLDER."home/"; ?><?php echo $data['features_img']; ?>?"+d.getTime()); }
});
</script>

</div>

</div>
</div>


</div>

<div class="row">

<div class="col-md-12">
<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Hizmet Özellikleri Alanı Düzenleme</h3>
</div>

<form method="POST" action="update.php">

<div class="box-body">

<div class="row">

<div class="col-md-12">
<div class="form-group">
<label>Başlık</label>
<input type="text" class="form-control" name="features_title" value="<?php echo $data['features_title']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>1. Yazı</label>
<input type="text" class="form-control" name="features_text1" value="<?php echo $data['features_text1']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>2. Yazı</label>
<input type="text" class="form-control" name="features_text2" value="<?php echo $data['features_text2']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>3. Yazı</label>
<input type="text" class="form-control" name="features_text3" value="<?php echo $data['features_text3']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>4. Yazı</label>
<input type="text" class="form-control" name="features_text4" value="<?php echo $data['features_text4']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>5. Yazı</label>
<input type="text" class="form-control" name="features_text5" value="<?php echo $data['features_text5']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>6. Yazı</label>
<input type="text" class="form-control" name="features_text6" value="<?php echo $data['features_text6']; ?>" maxlength="250" required="">
</div>
</div>

</div>

<input type="hidden" name="features_id" value="<?php echo $data['features_id']; ?>">
<input type="hidden" name="features_lang_id" value="<?php echo $data['features_lang_id']; ?>">

</div>

<div class="box-footer">
<button type="submit" class="btn btn-sm btn-primary pull-right">Güncelle</button>
</div>

</form>

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