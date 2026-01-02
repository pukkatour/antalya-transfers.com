<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


$cats = $Db->query("SELECT * FROM directory_categories");

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
<li class="active">Toplu Email Gönderimi</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-12">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Toplu Email Gönderimi</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-sm btn-default" data-widget="collapse"><i class="fa fa fa-minus"></i>
</button>
</div>
</div>

<form action="send.php" method="POST" enctype="multipart/form-data">

<div class="box-body">

<div class="col-md-4">
<label>Alıcılar</label>
<div class="form-group">
<select name="email_cat" class="form-control" required="">
<?php if (!empty($cats)) { foreach ($cats as $cat) { ?>
<option value="<?php echo $cat['category_id']; ?>"><?php echo $cat['category_name']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-md-4">
<label>Email Tema Dili</label>
<div class="form-group">
<select name="email_lng" class="form-control" required="">
<?php if (!empty($languagelist)) { foreach ($languagelist as $lang) { ?>
<option value="<?php echo $lang['lang_id']; ?>"><?php echo $lang['lang_name_eng']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-md-4">
<input type="hidden" name="MAX_FILE_SIZE" value="1000000"> Dosya Ekle:
<input name="userfile" type="file" style="margin-top: 10px;">
</div>

<div class="col-md-12">
<div class="form-group">
<input name="email_title" class="form-control" type="text" placeholder="Email Başlığı" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<textarea name="email_text" class="form-control h_inputs" style="height: 200px" placeholder="Konu" maxlength="10000" required=""></textarea>
</div>
</div>

</div>

<div class="box-footer">
<button type="submit" onclick="return confirm('Eminmisin?');" class="btn btn-sm btn-primary pull-right"><i class="fa fa-envelope-o"></i> Gönder</button>
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

<?php if (!empty($_SESSION["swal"]) && $_SESSION["swal"] == "ok") { ?>
<script>swal("Tebrikler!", "Email gönderimi başarılı!...", "success");</script>
<?php unset($_SESSION["swal"]); } ?>

</body>
</html>