<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$data = $Db->row("SELECT * FROM booking_template WHERE temp_lang_id = ?", array($_GET['lang_id']));
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

<form method="POST" action="booking_template_update.php">

<div class="box-body">

<div class="row">

<div class="col-md-12">
<div class="form-group">
<label>Rezervasyon Başlığı</label>
<input type="text" class="form-control" name="info_title" value="<?php echo $data['info_title']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Rezervasyon Metni</label>
<textarea rows="2" class="form-control" name="info_text"><?php echo $data['info_text']; ?></textarea>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Reklam Alanı Yazı</label>
<input type="text" class="form-control" name="middle_text" value="<?php echo $data['middle_text']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Reklam Alanı Buton</label>
<input type="text" class="form-control" name="middle_button" value="<?php echo $data['middle_button']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Reklam Alanı URL</label>
<input type="text" class="form-control" name="middle_url" value="<?php echo $data['middle_url']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>İletişim Yazısı</label>
<input type="text" class="form-control" name="contact_text" value="<?php echo $data['contact_text']; ?>" maxlength="250" required="">
</div>
</div>

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
<h3 class="box-title">Büyük Fotoğraf (200 x 200 px)</h3>
</div>
<a href="#" onclick="document.getElementById('file1').click()"><br>
<center><img id="myimg2" src="" class="img-thumbnail"></center><br>
</a>
<form name="foto" id="foto1" enctype="multipart/form-data" method="post" action="booking_template_photo_upload.php">
<input type="file" id="file1" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="photo_type" value="header_photo">
<input type="hidden" name="photo_w" value="200">
<input type="hidden" name="photo_h" value="200">
<input type="hidden" name="photo_t" value="jpg">
<input type="hidden" name="lang_id" value="<?php echo $_GET['lang_id']; ?>">
<script>document.getElementById("file1").onchange = function() { document.getElementById("foto1").submit(); };</script>
</form>
<script>
d = new Date();
$("#myimg2").attr("src", "<?php echo IMAGE_FOLDER; ?>email_booking/<?php echo $data['header_photo']; ?>?"+d.getTime());
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
<?php include('../transfer_email_template.php'); ?>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Kapat</button>
</div>
</div>
</div>
</div>

</body>
</html>