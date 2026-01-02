<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$lang_id = $_GET['lang_id'];
$data    = $Db->row("SELECT * FROM footer WHERE footer_lang_id = ?", array($lang_id));

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
<li class="active">Footer Metinleri</li>
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
<h3 class="box-title">Footer Metinleri Düzenleme</h3>
</div>

<form method="POST" action="footer_update.php">

<div class="box-body">

<div class="row">

<div class="col-md-4">
<div class="form-group">
<label>Sol Başlık</label>
<input type="text" class="form-control" name="footer_title_1" value="<?php echo $data['footer_title_1']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Orta Başlık</label>
<input type="text" class="form-control" name="footer_title_2" value="<?php echo $data['footer_title_2']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Sağ Başlık</label>
<input type="text" class="form-control" name="footer_title_3" value="<?php echo $data['footer_title_3']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Sol Yazı</label>
<textarea rows="2" class="form-control" name="footer_text_1" required=""><?php echo $data['footer_text_1']; ?></textarea>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Orta 1. Başlık</label>
<input type="text" class="form-control" name="footer_text_2_1" value="<?php echo $data['footer_text_2_1']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Orta 3. Başlık</label>
<input type="text" class="form-control" name="footer_text_2_2" value="<?php echo $data['footer_text_2_2']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Orta 3. Başlık</label>
<input type="text" class="form-control" name="footer_text_2_3" value="<?php echo $data['footer_text_2_3']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Sağ Yazı</label>
<textarea rows="2" class="form-control" name="footer_text_3" required=""><?php echo $data['footer_text_3']; ?></textarea>
</div>
</div>

</div>

<input type="hidden" name="footer_id" value="<?php echo $data['footer_id']; ?>">
<input type="hidden" name="footer_lang_id" value="<?php echo $data['footer_lang_id']; ?>">

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

<?php include_once("../footer.php"); ?>

</div>

<?php include_once("../footer_scripts.php"); ?>

</body>
</html>