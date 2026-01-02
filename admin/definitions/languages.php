<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


$languages = $Db->query("SELECT * FROM language_list");

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
<li class="active">Dil Yönetimi</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-12">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Dil Düzenleme</h3>
</div>

<div class="box-body">

<table id="data_table" class="table table-striped table-hover table-bordered table-condensed">

<thead>

<tr>
<th>ID</th>
<th>İngilizce Adı</th>
<th>Orjinal Adı</th>
<th>URL</th>
<th>Fotoğraf</th>
<th>Durum</th>
<th></th>
</tr>

</thead>

<tbody>
<?php if (!empty($languages)) { foreach ($languages as $language) { ?>
<tr>
<td><?php echo $language['lang_id']; ?></td>
<td><?php echo $language['lang_name_eng']; ?></td>
<td><?php echo $language['lang_name_orj']; ?></td>
<td><?php echo $language['lang_url']; ?></td>
<td>
<a href="#" onclick="document.getElementById('file<?php echo $language['lang_id']; ?>').click()">
<img id="myimg<?php echo $language['lang_id']; ?>" src="" style="height: 70px;" class="img-thumbnail">
</a>
<form name="foto" id="foto<?php echo $language['lang_id']; ?>" enctype="multipart/form-data" method="post" action="language_upload.php">
<input type="file" id="file<?php echo $language['lang_id']; ?>" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="id" value="<?php echo $language['lang_id']; ?>">
<script>
document.getElementById("file<?php echo $language['lang_id']; ?>").onchange = function() { document.getElementById("foto<?php echo $language['lang_id']; ?>").submit(); };
</script>
</form>
</td>
<td><?php if ($language['lang_status'] == 1) { echo '<small class="label pull-right bg-green">Aktif</small>'; } else { echo '<small class="label pull-right bg-red">Pasif</small>'; } ?></td>
<td><a href="#" data-toggle="modal" data-target="#edit_<?php echo $language['lang_id']; ?>" class="btn btn-sm btn-success pull-right">Düzenle</a> </td>
</tr>

<script>
d = new Date();
$.ajax({
url:'<?php echo IMAGE_FOLDER."flags/"; ?><?php echo $language['lang_flag']; ?>',
type:'HEAD',
error: function() { $("#myimg<?php echo $language['lang_id']; ?>").attr("src", "<?php echo IMAGE_FOLDER; ?>no_photo.jpg?"+d.getTime()); },
success: function() {  $("#myimg<?php echo $language['lang_id']; ?>").attr("src", "<?php echo IMAGE_FOLDER."flags/"; ?><?php echo $language['lang_flag']; ?>?"+d.getTime()); }
});
</script>

<div class="modal fade" id="edit_<?php echo $language['lang_id']; ?>" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="edit_Label">Dil Düzenleme</h4>
</div>

<form id="edit_lang<?php echo $language['lang_id']; ?>" method="POST" action="language_update.php">

<div class="modal-body">

<div class="form-group">
<label>İngilizce Adı:</label>
<input type="text" name="lang_name_eng" class="form-control" value="<?php echo $language['lang_name_eng']; ?>" maxlength="30" required="">
</div>

<div class="form-group">
<label>Orjinal Adı:</label>
<input type="text" name="lang_name_orj" class="form-control" value="<?php echo $language['lang_name_orj']; ?>" maxlength="30" required="">
</div>

<div class="form-group">
<label>URL:</label>
<input type="text" name="lang_url" class="form-control" value="<?php echo $language['lang_url']; ?>" maxlength="250" required="">
</div>

<div class="form-group">
<label>Durum:</label>
<select class="form-control" name="lang_status" required="">
<option <?php if ($language['lang_status'] == 1) { echo 'selected="selected"'; } ?> value="1">Aktif</option>
<option <?php if ($language['lang_status'] == 0) { echo 'selected="selected"'; } ?> value="0">Pasif</option>
</select>
</div>

<input type="hidden" name="lang_id" value="<?php echo $language['lang_id']; ?>">

</div>

<div class="modal-footer">
<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Kapat</button>
<button type="submit" onclick="document.getElementById('edit_lang<?php echo $language['lang_id']; ?>').submit();" class="btn btn-sm btn-primary">Kaydet</button>
</div>

</form>

</div>
</div>
</div>
<?php } } ?>
</tbody>

</table>

</div>

</div>

</div>

</div>

</section>

</div>

<?php include_once("../footer.php"); ?>

</div>

<?php include_once("../footer_scripts.php"); ?>

<script>
$(function () { $('#data_table').dataTable(); });
</script>

</body>
</html>