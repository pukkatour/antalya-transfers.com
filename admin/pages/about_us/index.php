<?php
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$lang_id = $_GET['lang_id'];
$data    = $Db->row("SELECT * FROM page_about_us WHERE page_lang_id = ?", array($lang_id));

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
<li class="active">Hakkımızda Sayfası</li>
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

</div>

<div class="row">

<div class="col-md-12">
<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Hakkımızda Sayfası İçerik Düzenleme</h3>
</div>

<form method="POST" action="update.php">

<div class="box-body">

<div class="row">

<div class="col-md-12">
<div class="form-group">
<label>Sayfa Başlığı ( 60 Karakter )</label>
<input type="text" class="form-control" name="page_title" value="<?php echo $data['page_title']; ?>" maxlength="150" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Sayfa Açıklaması ( 250 Karakter )</label>
<input type="text" class="form-control" name="page_description" value="<?php echo $data['page_description']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Sayfa Keywordleri ( 250 Karakter, virgül ile ayrılmış bitişik)</label>
<input type="text" class="form-control" name="page_keywords" value="<?php echo $data['page_keywords']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Sayfa Adı ( 60 Karakter )</label>
<input type="text" class="form-control" name="page_name" value="<?php echo $data['page_name']; ?>" maxlength="250" required="">
</div>
</div>

</div>

<hr>

<div class="row">

<div class="col-md-12">
<div class="form-group">
<label>Ana Başlık</label>
<input type="text" class="form-control" name="page_main_title" value="<?php echo $data['page_main_title']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Ana Yazı</label>
<textarea rows="15" class="form-control h_inputs" name="page_main_text"><?php echo $data['page_main_text']; ?></textarea>
</div>
</div>

</div>

<input type="hidden" name="page_id" value="<?php echo $data['page_id']; ?>">
<input type="hidden" name="page_lang_id" value="<?php echo $data['page_lang_id']; ?>">

</div>

<div class="box-footer">
<button type="submit" class="btn btn-sm btn-primary pull-right">Güncelle</button>
</div>

</form>

</div>
</div>

</div>

<div class="row">

<div class="col-md-3">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">1. Fotoğraf (500 x 300 px)</h3>
</div>

<a href="#" onclick="document.getElementById('file1').click()">
<img id="myimg1" src="" class="img-thumbnail">
</a>

<form name="foto1" id="foto1" enctype="multipart/form-data" method="POST" action="upload_photo.php">
<input type="file" id="file1" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="lang_id" value="<?php echo $data['page_lang_id']; ?>">
<input type="hidden" name="img_id" value="page_image1">
<script>document.getElementById("file1").onchange = function() { document.getElementById("foto1").submit(); };</script>
</form>

<script>
d = new Date();
$.ajax({
url:'<?php echo IMAGE_FOLDER."pages/"; ?><?php echo $data['page_image1']; ?>',
type:'HEAD',
error: function() { $("#myimg1").attr("src", "<?php echo IMAGE_FOLDER; ?>no_photo.jpg?"+d.getTime()); },
success: function() {  $("#myimg1").attr("src", "<?php echo IMAGE_FOLDER."pages/"; ?><?php echo $data['page_image1']; ?>?"+d.getTime()); }
});
</script>

</div>

</div>

<div class="col-md-3">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">2. Fotoğraf (500 x 300 px)</h3>
</div>

<a href="#" onclick="document.getElementById('file2').click()">
<img id="myimg2" src="" class="img-thumbnail">
</a>

<form name="foto2" id="foto2" enctype="multipart/form-data" method="POST" action="upload_photo.php">
<input type="file" id="file2" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="lang_id" value="<?php echo $data['page_lang_id']; ?>">
<input type="hidden" name="img_id" value="page_image2">
<script>document.getElementById("file2").onchange = function() { document.getElementById("foto2").submit(); };</script>
</form>

<script>
d = new Date();
$.ajax({
url:'<?php echo IMAGE_FOLDER."pages/"; ?><?php echo $data['page_image2']; ?>',
type:'HEAD',
error: function() { $("#myimg2").attr("src", "<?php echo IMAGE_FOLDER; ?>no_photo.jpg?"+d.getTime()); },
success: function() {  $("#myimg2").attr("src", "<?php echo IMAGE_FOLDER."pages/"; ?><?php echo $data['page_image2']; ?>?"+d.getTime()); }
});
</script>

</div>

</div>

<div class="col-md-3">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">3. Fotoğraf (500 x 300 px)</h3>
</div>

<a href="#" onclick="document.getElementById('file3').click()">
<img id="myimg3" src="" class="img-thumbnail">
</a>

<form name="foto3" id="foto3" enctype="multipart/form-data" method="POST" action="upload_photo.php">
<input type="file" id="file3" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="lang_id" value="<?php echo $data['page_lang_id']; ?>">
<input type="hidden" name="img_id" value="page_image3">
<script>document.getElementById("file3").onchange = function() { document.getElementById("foto3").submit(); };</script>
</form>

<script>
d = new Date();
$.ajax({
url:'<?php echo IMAGE_FOLDER."pages/"; ?><?php echo $data['page_image3']; ?>',
type:'HEAD',
error: function() { $("#myimg3").attr("src", "<?php echo IMAGE_FOLDER; ?>no_photo.jpg?"+d.getTime()); },
success: function() {  $("#myimg3").attr("src", "<?php echo IMAGE_FOLDER."pages/"; ?><?php echo $data['page_image3']; ?>?"+d.getTime()); }
});
</script>

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