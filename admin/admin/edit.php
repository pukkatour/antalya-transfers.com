<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

if (!empty($_GET['admin_id'])) { $ad_id = $_GET['admin_id']; }

$admin = $Db->row("SELECT admin.*, country_list.country_phone_code FROM admin LEFT JOIN country_list ON country_list.country_id = admin.admin_country_id WHERE admin.admin_id = ?", array($ad_id));

} else {

redirect(SITE_URL.'admin/admin/index.php'); exit;

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
<li><a href="<?php echo SITE_URL; ?>admin/admin/index.php">Yöneticiler</a></li>
<li class="active">Yönetici Düzenleme</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-4">

<div class="box box-widget widget-user-2">

<div class="widget-user-header bg-yellow">
<div class="widget-user-image">
<img class="img-circle" id="myimg<?php echo $admin['admin_id']; ?>" src="">
</div>
<h3 class="widget-user-username"><?php echo $admin['admin_name']." ".$admin['admin_surname']; ?></h3>
<h5 class="widget-user-desc">...</h5>
</div>

<div class="box-footer">
<ul class="nav nav-stacked">
<li><a href="javascript:void(0)">Telefon <span class="pull-right"><?php echo $admin['country_phone_code']." ".$admin['admin_phone_number'] ?></span></a></li>
<li><a href="javascript:void(0)">Email <span class="pull-right"><?php echo $admin['admin_email']; ?></span></a></li>
<li><a href="javascript:void(0)">Durum <span class="pull-right">
<?php
if ($admin['admin_status'] == 1) { echo 'Pasif'; }
if ($admin['admin_status'] == 2) { echo 'Aktif'; }
?>
</span></a></li>
<li><a href="javascript:void(0)">Son Ziyaret <span class="pull-right"><?php echo $admin['admin_last_visit']; ?></span></a></li>
<li><a href="javascript:void(0)">Son IP <span class="pull-right"><?php echo $admin['admin_last_ip']; ?></span></a></li>
</ul>
</div>

<script>
d = new Date();
$.ajax({
url:'<?php echo IMAGE_FOLDER."admin/".$admin['admin_image']; ?>',
type:'HEAD',
error: function() { $("#myimg<?php echo $admin['admin_id']; ?>").attr("src", "<?php echo IMAGE_FOLDER; ?>no_photo.jpg?"+d.getTime()); },
success: function() {  $("#myimg<?php echo $admin['admin_id']; ?>").attr("src", "<?php echo IMAGE_FOLDER."admin/".$admin['admin_image']; ?>?"+d.getTime()); }
});
</script>

</div>

<div class="box box-danger">
<div class="box-header with-border">
<h3 class="box-title">Şifre Değiştirme</h3>
</div>

<form class="form-horizontal" method="POST" action="password.php">

<div class="box-body">

<div class="form-group">
<label class="col-sm-4 control-label">Yeni Şifre</label>
<div class="col-sm-6">
<input type="password" class="form-control" name="pass1" required="" maxlength="250" placeholder="******">
</div>
</div>

<div class="form-group">
<label class="col-sm-4 control-label">Yeni Şifre Tekrar</label>
<div class="col-sm-6">
<input type="password" class="form-control" name="pass2" required="" maxlength="250" placeholder="******">
</div>
</div>

</div>

<input type="hidden" name="id" value="<?php echo $admin['admin_id']; ?>">

<div class="box-footer">
<button type="submit" class="btn btn-sm btn-danger pull-right">Kaydet</button>
</div>

</form>

</div>

</div>

<div class="col-md-8">

<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">Yönetici Bilgileri</h3>
</div>

<form class="form-horizontal" method="POST" action="update.php">

<div class="box-body">

<div class="form-group">
<label class="col-sm-3 control-label">Ad</label>
<div class="col-sm-9">
<input type="text" class="form-control h_firstcap" name="admin_name" value="<?php echo $admin['admin_name']; ?>" maxlength="150" required="">
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label">Soyad</label>
<div class="col-sm-9">
<input type="text" class="form-control h_firstcap" name="admin_surname" value="<?php echo $admin['admin_surname']; ?>" maxlength="150" required="">
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label">Email</label>
<div class="col-sm-9">
<input type="email" class="form-control" name="admin_email" value="<?php echo $admin['admin_email']; ?>" maxlength="150" required="">
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label">Ülke / Telefon Kodu</label>
<div class="col-sm-4">
<select name="admin_country_id" class="form-control" required="">
<?php if (!empty($countrylist)) { foreach ($countrylist as $country) { ?>
<option <?php if ($admin['admin_country_id'] == $country['country_id']) { echo 'selected="selected"'; } ?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']." ".$country['country_phone_code']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label">Telefon</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="admin_phone_number" value="<?php echo $admin['admin_phone_number']; ?>" required="" maxlength="15" onkeypress="return h_isNumber(event)">
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label">Durum</label>
<div class="col-sm-4">
<select class="form-control" name="admin_status" required="">
<option <?php if ($admin['admin_status'] == 1) { echo 'selected="selected"'; } ?> value="1">Pasif</option>
<option <?php if ($admin['admin_status'] == 2) { echo 'selected="selected"'; } ?> value="2">Aktif</option>
</select>
</div>
</div>

</div>

<input type="hidden" name="admin_id" value="<?php echo $admin['admin_id']; ?>">
<input type="hidden" name="admin_old_email" value="<?php echo $admin['admin_email']; ?>">
<input type="hidden" name="admin_old_phone" value="<?php echo $admin['admin_phone_number']; ?>">

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

<script>
<?php
if (!empty($_GET['error'])) {
if ($_GET['error'] == "pass") { echo 'swal("Hata!", "Girilen iki şifreninde aynı olması gerekmekte!...", "error");'; }
if ($_GET['error'] == "duplicate") { echo 'swal("Hata!", "Email adresi daha önceden bir kaydedilmiş. Başka email adresi kullanın!...", "error");'; }
if ($_GET['error'] == "email") { echo 'swal("Hata!", "Email adresi yanlış yazıldı. Lütfen düzeltip tekrar deneyin!...", "error");'; }
} ?>
</script>

</body>
</html>