<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


$datas = $Db->query("SELECT admin.*, country_list.country_phone_code FROM admin LEFT JOIN country_list ON country_list.country_id = admin.admin_country_id WHERE admin_status != ?", array('3'));

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
<li class="active">Yöneticiler</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-12">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Yöneticiler</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-sm btn-default" data-widget="collapse"><i class="fa fa fa-minus"></i>
</button>
</div>
</div>

<div class="box-body">

<table id="d_table" class="table table-striped table-hover table-bordered table-condensed">
<thead>

<tr>
<th>ID</th>
<th>Ad</th>
<th>Soyad</th>
<th>Email</th>
<th>Telefon</th>
<th>Son Giriş</th>
<th>Son IP</th>
<th>Durum</th>
<th>Fotoğraf</th>
<th>İşlem</th>
</tr>

</thead>

<tbody>
<?php if (!empty($datas)) { foreach ($datas as $admin) { ?>
<tr>
<td><?php echo $admin['admin_id']; ?></td>
<td><?php echo $admin['admin_name']; ?></td>
<td><?php echo $admin['admin_surname']; ?></td>
<td><?php echo $admin['admin_email']; ?></td>
<td><?php echo $admin['country_phone_code']." ".$admin['admin_phone_number']; ?></td>
<td><?php echo $admin['admin_last_visit']; ?></td>
<td><?php echo $admin['admin_last_ip']; ?></td>
<td>
<?php 
if ($admin['admin_status'] == 1) { echo '<span class="label pull-right bg-red" style="padding: 5px;">Pasif</span>';}
if ($admin['admin_status'] == 2) { echo '<span class="label pull-right bg-green" style="padding: 5px;">Aktif</span>';}
?>
</td>
<td>
<a href="#" onclick="document.getElementById('file<?php echo $admin['admin_id']; ?>').click()">
<img id="myimg<?php echo $admin['admin_id']; ?>" src="" style="height: 70px;" class="img-thumbnail">
</a>
<form name="foto" id="foto<?php echo $admin['admin_id']; ?>" enctype="multipart/form-data" method="post" action="upload_photo.php">
<input type="file" id="file<?php echo $admin['admin_id']; ?>" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" value="<?php echo $admin['admin_id']; ?>" name="id">
<script>
document.getElementById("file<?php echo $admin['admin_id']; ?>").onchange = function() { document.getElementById("foto<?php echo $admin['admin_id']; ?>").submit(); };
</script>
</form>
</td>
<td>
<div class="btn-group pull-right">
<button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown">İşlem <span class="caret"></span></button>
<ul class="dropdown-menu dropdown-menu-right" role="menu">
<?php if ($admin['admin_status'] == "2") { ?><li><a href="operations.php?action=1&id=<?php echo $admin['admin_id']; ?>">Pasif Yap</a></li><?php } ?>
<?php if ($admin['admin_status'] == "1") { ?><li><a href="operations.php?action=2&id=<?php echo $admin['admin_id']; ?>">Aktif Yap</a></li><?php } ?>
<?php if ($admin['admin_status'] != "3") { ?><li><a href="operations.php?action=3&id=<?php echo $admin['admin_id']; ?>" onclick="return confirm('Emin misiniz?');">Sil</a></li><?php } ?>
<li class="divider"></li>
<li><a href="edit.php?admin_id=<?php echo $admin['admin_id']; ?>">Düzenle</a></li>
</ul>
</div>
</td>
</tr>

<script>
d = new Date();
$.ajax({
url:'<?php echo IMAGE_FOLDER."admin/".$admin['admin_image']; ?>',
type:'HEAD',
error: function() { $("#myimg<?php echo $admin['admin_id']; ?>").attr("src", "<?php echo IMAGE_FOLDER; ?>no_photo.jpg?"+d.getTime()); },
success: function() { $("#myimg<?php echo $admin['admin_id']; ?>").attr("src", "<?php echo IMAGE_FOLDER."admin/".$admin['admin_image']; ?>?"+d.getTime()); }
});
</script>
<?php } } ?>
</tbody>
</table>

</div>

</div>

<div class="box box-danger collapsed-box">

<div class="box-header with-border">
<h3 class="box-title">Yönetici Ekleme</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-sm btn-default" data-widget="collapse"><i class="fa fa-plus"></i>
</button>
</div>
</div>

<form method="POST" action="addnew.php">

<div class="box-body">

<div class="col-md-3">
<div class="form-group">
<label>Ad</label>
<input type="text" class="form-control h_firstcap" name="admin_name" placeholder="Adı Yazın" maxlength="150" required="">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Soyad</label>
<input type="text" class="form-control h_firstcap" name="admin_surname" placeholder="Soyadı Yazın" maxlength="150" required="">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Email</label>
<input type="email" class="form-control" name="admin_email" placeholder="Email Adresini Yazın" maxlength="150" required="">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Şifre</label>
<input type="password" class="form-control" name="admin_password" placeholder="Şifre Yazın" maxlength="250" required="">
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label>Ülke / Telefon Kodu</label>
<select class="form-control" name="admin_country_id" required="">
<option value="">Tümü</option>
<?php if (!empty($countrylist)) { foreach ($countrylist as $country) { ?>
<option <?php if ($country['country_id'] == 224) { echo 'selected="selected"'; } ?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']." ".$country['country_phone_code']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label>Telefon</label>
<input type="text" class="form-control" name="admin_phone_number" placeholder="Telefon Numarasını Yazın" required="" maxlength="15" onkeypress="return h_isNumber(event)">
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label>Durum</label>
<select class="form-control" name="admin_status" required="">
<option value="1">Pasif</option>
<option value="2">Aktif</option>
</select>
</div>
</div>

</div>

<div class="box-footer">
<button type="submit" class="btn btn-sm btn-primary pull-right">Kaydet</button>
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

<script>$(function () { $('#d_table').dataTable( {} ); });</script>

<script>
<?php
if (!empty($_GET['error'])) {
if ($_GET['error'] == "email") { echo 'swal("Hata!", "Email Adresi Hatalı. Lütfen Kontrol Edin!...", "error");'; }
if ($_GET['error'] == "duplicate") { echo 'swal("Hata!", "Email Adresi Sisteme Kayıtlı!...", "warning");'; }
} ?>
</script>

</body>
</html>