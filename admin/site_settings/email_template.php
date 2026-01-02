<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$data = $Db->row("SELECT * FROM email_template WHERE temp_lang_id = ?", array($_GET['lang_id']));
$lng  = $Db->row("SELECT lang_name_eng FROM language_list WHERE lang_id = ?", array($_GET['lang_id']));

} else {

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
<li class="active">Email Teması</li>
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
<?php
$langs = $Db->query("SELECT lang_id,lang_name_eng FROM language_list");
if (!empty($langs)) { foreach ($langs as $lang) {
?>
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

<div class="col-md-9">

<div class="box box-warning">

<div class="box-header with-border">
<h3 class="box-title">Email Ayarları</h3>
</div>

<form method="POST" action="email_template_update.php">

<div class="box-body">

<div class="form-group">
<label>1. Kutu Başlık</label>
<input type="text" class="form-control" name="box1_title" value="<?php echo $data['box1_title']; ?>" maxlength="250" required="">
</div>

<div class="form-group">
<label>1. Kutu Yazı</label>
<input type="text" class="form-control" name="box1_text" value="<?php echo $data['box1_text']; ?>" maxlength="250" required="">
</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>1. Kutu Link</label>
<input type="text" class="form-control" name="box1_link" value="<?php echo $data['box1_link']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>1. Kutu Link Yazısı</label>
<input type="text" class="form-control" name="box1_link_text" value="<?php echo $data['box1_link_text']; ?>" maxlength="250" required="">
</div>
</div>

</div>

<div class="form-group">
<label>2. Kutu Başlık</label>
<input type="text" class="form-control" name="box2_title" value="<?php echo $data['box2_title']; ?>" maxlength="250" required="">
</div>

<div class="form-group">
<label>2. Kutu Yazı</label>
<input type="text" class="form-control" name="box2_text" value="<?php echo $data['box2_text']; ?>" maxlength="250" required="">
</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>2. Kutu Link</label>
<input type="text" class="form-control" name="box2_link" value="<?php echo $data['box2_link']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>2. Kutu Link Yazısı</label>
<input type="text" class="form-control" name="box2_link_text" value="<?php echo $data['box2_link_text']; ?>" maxlength="250" required="">
</div>
</div>

</div>

<div class="form-group">
<label>3. Kutu Başlık</label>
<input type="text" class="form-control" name="box3_title" value="<?php echo $data['box3_title']; ?>" maxlength="250" required="">
</div>

<div class="form-group">
<label>3. Kutu Yazı</label>
<input type="text" class="form-control" name="box3_text" value="<?php echo $data['box3_text']; ?>" maxlength="250" required="">
</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>3. Kutu Link</label>
<input type="text" class="form-control" name="box3_link" value="<?php echo $data['box3_link']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>3. Kutu Link Yazısı</label>
<input type="text" class="form-control" name="box3_link_text" value="<?php echo $data['box3_link_text']; ?>" maxlength="250" required="">
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Alt Kutu Yazısı</label>
<input type="text" class="form-control" name="bottom_box" value="<?php echo $data['bottom_box']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Alt Kutu Başlık</label>
<input type="text" class="form-control" name="bottom_title" value="<?php echo $data['bottom_title']; ?>" maxlength="250" required="">
</div>
</div>

</div>

<div class="form-group">
<label>Alt Kutu Metin</label>
<input type="text" class="form-control" name="bottom_text" value="<?php echo $data['bottom_text']; ?>" maxlength="250" required="">
</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Alt Kutu Link</label>
<input type="text" class="form-control" name="bottom_link" value="<?php echo $data['bottom_link']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Alt Kutu Link Yazısı</label>
<input type="text" class="form-control" name="bottom_link_text" value="<?php echo $data['bottom_link_text']; ?>" maxlength="250" required="">
</div>
</div>

</div>

<div class="row">

<div class="col-md-4">
<div class="form-group">
<label>Sosyal Link 1</label>
<input type="text" class="form-control" name="social_link1" value="<?php echo $data['social_link1']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Sosyal Link 2</label>
<input type="text" class="form-control" name="social_link2" value="<?php echo $data['social_link2']; ?>" maxlength="250" required="">
</div>
</div>

</div>

<div class="form-group">
<label>İletişim Yazısı</label>
<input type="text" class="form-control" name="contact_text" value="<?php echo $data['contact_text']; ?>" maxlength="250" required="">
</div>

</div>

<input type="hidden" name="temp_id" value="<?php echo $data['temp_id']; ?>">
<input type="hidden" name="temp_lang_id" value="<?php echo $data['temp_lang_id']; ?>">

<div class="box-footer">
<button type="submit" class="btn btn-sm btn-info pull-right">Kaydet</button>
</div>

</form>

</div>

</div>

<div class="col-md-3">

<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">Büyük Fotoğraf (600 x 226 px)</h3>
</div>
<a href="#" onclick="document.getElementById('file2').click()"><br>
<center><img id="myimg2" src="" class="img-thumbnail"></center><br>
</a>
<form name="foto2" id="foto2" enctype="multipart/form-data" method="post" action="email_template_photo_upload.php">
<input type="file" id="file2" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="photo_type" value="header_photo">
<input type="hidden" name="photo_w" value="600">
<input type="hidden" name="photo_h" value="226">
<input type="hidden" name="photo_t" value="jpg">
<input type="hidden" name="lang_id" value="<?php echo $_GET['lang_id']; ?>">
<script>document.getElementById("file2").onchange = function() { document.getElementById("foto2").submit(); };</script>
</form>
<script>
d = new Date();
$("#myimg2").attr("src", "<?php echo IMAGE_FOLDER; ?>email/<?php echo $data['header_photo']; ?>?"+d.getTime());
</script>
</div>

<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">1. Kutu Fotoğrafı (100 x 100 px)</h3>
</div>
<a href="#" onclick="document.getElementById('file4').click()"><br>
<center><img id="myimg4" src="" class="img-thumbnail"></center><br>
</a>
<form name="foto4" id="foto4" enctype="multipart/form-data" method="post" action="email_template_photo_upload.php">
<input type="file" id="file4" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="photo_type" value="box1_photo">
<input type="hidden" name="photo_w" value="100">
<input type="hidden" name="photo_h" value="100">
<input type="hidden" name="photo_t" value="png">
<input type="hidden" name="lang_id" value="<?php echo $_GET['lang_id']; ?>">
<script>document.getElementById("file4").onchange = function() { document.getElementById("foto4").submit(); };</script>
</form>
<script>
d = new Date();
$("#myimg4").attr("src", "<?php echo IMAGE_FOLDER; ?>email/<?php echo $data['box1_photo']; ?>?"+d.getTime());
</script>
</div>

<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">2. Kutu Fotoğrafı (100 x 100 px)</h3>
</div>
<a href="#" onclick="document.getElementById('file5').click()"><br>
<center><img id="myimg5" src="" class="img-thumbnail"></center><br>
</a>
<form name="foto5" id="foto5" enctype="multipart/form-data" method="post" action="email_template_photo_upload.php">
<input type="file" id="file5" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="photo_type" value="box2_photo">
<input type="hidden" name="photo_w" value="100">
<input type="hidden" name="photo_h" value="100">
<input type="hidden" name="photo_t" value="png">
<input type="hidden" name="lang_id" value="<?php echo $_GET['lang_id']; ?>">
<script>document.getElementById("file5").onchange = function() { document.getElementById("foto5").submit(); };</script>
</form>
<script>
d = new Date();
$("#myimg5").attr("src", "<?php echo IMAGE_FOLDER; ?>email/<?php echo $data['box2_photo']; ?>?"+d.getTime());
</script>
</div>

<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">3. Kutu Fotoğrafı (100 x 100 px)</h3>
</div>
<a href="#" onclick="document.getElementById('file6').click()"><br>
<center><img id="myimg6" src="" class="img-thumbnail"></center><br>
</a>
<form name="foto6" id="foto6" enctype="multipart/form-data" method="post" action="email_template_photo_upload.php">
<input type="file" id="file6" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="photo_type" value="box3_photo">
<input type="hidden" name="photo_w" value="100">
<input type="hidden" name="photo_h" value="100">
<input type="hidden" name="photo_t" value="png">
<input type="hidden" name="lang_id" value="<?php echo $_GET['lang_id']; ?>">
<script>document.getElementById("file6").onchange = function() { document.getElementById("foto6").submit(); };</script>
</form>
<script>
d = new Date();
$("#myimg6").attr("src", "<?php echo IMAGE_FOLDER; ?>email/<?php echo $data['box3_photo']; ?>?"+d.getTime());
</script>
</div>

<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">Sosyal Medya 1 (50 x 50 px)</h3>
</div>
<a href="#" onclick="document.getElementById('file7').click()"><br>
<center><img id="myimg7" src="" class="img-thumbnail"></center><br>
</a>
<form name="foto7" id="foto7" enctype="multipart/form-data" method="post" action="email_template_photo_upload.php">
<input type="file" id="file7" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="photo_type" value="social_logo1">
<input type="hidden" name="photo_w" value="50">
<input type="hidden" name="photo_h" value="50">
<input type="hidden" name="photo_t" value="png">
<input type="hidden" name="lang_id" value="<?php echo $_GET['lang_id']; ?>">
<script>document.getElementById("file7").onchange = function() { document.getElementById("foto7").submit(); };</script>
</form>
<script>
d = new Date();
$("#myimg7").attr("src", "<?php echo IMAGE_FOLDER; ?>email/<?php echo $data['social_logo1']; ?>?"+d.getTime());
</script>
</div>

<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">Sosyal Medya 2 (50 x 50 px)</h3>
</div>
<a href="#" onclick="document.getElementById('file8').click()"><br>
<center><img id="myimg8" src="" class="img-thumbnail"></center><br>
</a>
<form name="foto8" id="foto8" enctype="multipart/form-data" method="post" action="email_template_photo_upload.php">
<input type="file" id="file8" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="photo_type" value="social_logo2">
<input type="hidden" name="photo_w" value="50">
<input type="hidden" name="photo_h" value="50">
<input type="hidden" name="photo_t" value="png">
<input type="hidden" name="lang_id" value="<?php echo $_GET['lang_id']; ?>">
<script>document.getElementById("file8").onchange = function() { document.getElementById("foto8").submit(); };</script>
</form>
<script>
d = new Date();
$("#myimg8").attr("src", "<?php echo IMAGE_FOLDER; ?>email/<?php echo $data['social_logo2']; ?>?"+d.getTime());
</script>
</div>

<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Email_temp_modal">
Temayı Görüntüle
</button>

</div>

</div>

</section>

</div>

<?php include_once("../footer.php"); ?>

</div>

<?php include_once("../footer_scripts.php"); ?>

<div class="modal fade bs-example-modal-lg" id="Email_temp_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Email Teması</h4>
</div>
<div class="modal-body">
<?php include('../email_template.php'); ?>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Kapat</button>
</div>
</div>
</div>
</div>

</body>
</html>