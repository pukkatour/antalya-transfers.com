<?php
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$datas = $Db->query("SELECT * FROM info_pages WHERE page_lang_id = ?", array($_GET['lang']));

} else {

$_SESSION["alert"] = "nok";
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
<li class="active">Tanıtım Sayfaları</li>
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
<select class="form-control" name="lang" onchange="this.form.submit()">
<?php if (!empty($languagelist)) { foreach ($languagelist as $lang) { ?>
<option <?php if ($_GET['lang'] == $lang['lang_id']) { echo 'selected="selected"'; } ?> value="<?php echo $lang['lang_id']; ?>"><?php echo $lang['lang_name_eng']; ?></option>
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
<h3 class="box-title">Sayfalar</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-sm btn-default" data-widget="collapse"><i class="fa fa-plus"></i>
</button>
</div>
</div>

<div class="box-body">

<table id="d_table" class="table table-striped table-hover table-bordered table-condensed">

<thead>

<tr>
<th>Sayfa Adı</th>
<th>Foto 1</th>
<th>Foto 2</th>
<th>Foto 3</th>
<th>Durum</th>
<th></th>
</tr>

</thead>

<tbody>
<?php if (!empty($datas)) { foreach ($datas as $data) { ?>
<tr>
<td><?php echo $data['page_name']; ?></td>
<td>
<a href="#" onclick="document.getElementById('file1<?php echo $data['page_id']; ?>').click()">
<img id="myimg1<?php echo $data['page_id']; ?>" src="" style="height: 70px;" class="img-thumbnail">
</a>
<form name="foto" id="foto1<?php echo $data['page_id']; ?>" enctype="multipart/form-data" method="post" action="upload.php">
<input type="file" id="file1<?php echo $data['page_id']; ?>" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="page_page_id" value="<?php echo $data['page_page_id']; ?>">
<input type="hidden" name="img" value="page_image1">
<input type="hidden" name="slug" value="<?php echo $data['page_slug']; ?>">
<input type="hidden" name="id" value="1">
<script>
document.getElementById("file1<?php echo $data['page_id']; ?>").onchange = function() { document.getElementById("foto1<?php echo $data['page_id']; ?>").submit(); };
</script>
</form>
</td>
<td>
<a href="#" onclick="document.getElementById('file2<?php echo $data['page_id']; ?>').click()">
<img id="myimg2<?php echo $data['page_id']; ?>" src="" style="height: 70px;" class="img-thumbnail">
</a>
<form name="foto" id="foto2<?php echo $data['page_id']; ?>" enctype="multipart/form-data" method="post" action="upload.php">
<input type="file" id="file2<?php echo $data['page_id']; ?>" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="page_page_id" value="<?php echo $data['page_page_id']; ?>">
<input type="hidden" name="img" value="page_image2">
<input type="hidden" name="slug" value="<?php echo $data['page_slug']; ?>">
<input type="hidden" name="id" value="2">
<script>
document.getElementById("file2<?php echo $data['page_id']; ?>").onchange = function() { document.getElementById("foto2<?php echo $data['page_id']; ?>").submit(); };
</script>
</form>
</td>
<td>
<a href="#" onclick="document.getElementById('file3<?php echo $data['page_id']; ?>').click()">
<img id="myimg3<?php echo $data['page_id']; ?>" src="" style="height: 70px;" class="img-thumbnail">
</a>
<form name="foto" id="foto3<?php echo $data['page_id']; ?>" enctype="multipart/form-data" method="post" action="upload.php">
<input type="file" id="file3<?php echo $data['page_id']; ?>" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="page_page_id" value="<?php echo $data['page_page_id']; ?>">
<input type="hidden" name="img" value="page_image3">
<input type="hidden" name="slug" value="<?php echo $data['page_slug']; ?>">
<input type="hidden" name="id" value="3">
<script>
document.getElementById("file3<?php echo $data['page_id']; ?>").onchange = function() { document.getElementById("foto3<?php echo $data['page_id']; ?>").submit(); };
</script>
</form>
</td>
<td>
<?php if ($data['page_stat'] == 2) { echo '<small class="label pull-right bg-green">Aktif</small>'; } ?>
<?php if ($data['page_stat'] == 1) { echo '<small class="label pull-right bg-red">Pasif</small>'; } ?>
</td>
<td align="right">
<a href="#" data-toggle="modal" data-target="#myModal<?php echo $data['page_id']; ?>" class="btn btn-sm btn-success">Düzenle</a> 
<a href="remove.php?page_page_id=<?php echo $data['page_page_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istiyor musun?');">Sil</a>
</td>
</tr>

<script>
d = new Date();
$.ajax({
url:'<?php echo IMAGE_FOLDER."pages/"; ?><?php echo $data['page_image1']; ?>',
type:'HEAD',
error: function() { $("#myimg1<?php echo $data['page_id']; ?>").attr("src", "<?php echo IMAGE_FOLDER; ?>no_photo.jpg?"+d.getTime()); },
success: function() { $("#myimg1<?php echo $data['page_id']; ?>").attr("src", "<?php echo IMAGE_FOLDER."pages/".$data['page_image1']; ?>?"+d.getTime()); }
});
$.ajax({
url:'<?php echo IMAGE_FOLDER."pages/"; ?><?php echo $data['page_image2']; ?>',
type:'HEAD',
error: function() { $("#myimg2<?php echo $data['page_id']; ?>").attr("src", "<?php echo IMAGE_FOLDER; ?>no_photo.jpg?"+d.getTime()); },
success: function() { $("#myimg2<?php echo $data['page_id']; ?>").attr("src", "<?php echo IMAGE_FOLDER."pages/".$data['page_image2']; ?>?"+d.getTime()); }
});
$.ajax({
url:'<?php echo IMAGE_FOLDER."pages/"; ?><?php echo $data['page_image3']; ?>',
type:'HEAD',
error: function() { $("#myimg3<?php echo $data['page_id']; ?>").attr("src", "<?php echo IMAGE_FOLDER; ?>no_photo.jpg?"+d.getTime()); },
success: function() { $("#myimg3<?php echo $data['page_id']; ?>").attr("src", "<?php echo IMAGE_FOLDER."pages/".$data['page_image3']; ?>?"+d.getTime()); }
});
</script>


<div class="modal fade" id="myModal<?php echo $data['page_id']; ?>" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Sayfa Düzenleme</h4>
</div>

<div class="modal-body">
<div class="box-body">

<form id="edit_<?php echo $data['page_id']; ?>" method="POST" action="update.php">

<input type="hidden" name="page_id" value="<?php echo $data['page_id']; ?>">

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
<label>Durum</label>
<select name="page_stat" class="form-control" required="">
<option <?php if ($data['page_stat'] == 2) { echo 'selected="selected"'; } ?> value="2">Aktif</option>
<option <?php if ($data['page_stat'] == 1) { echo 'selected="selected"'; } ?> value="1">Pasif</option>
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Sayfa Adı ( 60 Karakter )</label>
<input type="text" class="form-control" name="page_name" value="<?php echo $data['page_name']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Ana Başlık</label>
<input type="text" class="form-control" name="page_main_title" value="<?php echo $data['page_main_title']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>1. Paragraf</label>
<textarea rows="50" class="form-control h_inputs" name="page_main_text1"><?php echo $data['page_main_text1']; ?></textarea>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>1. Paragraf</label>
<textarea rows="50" class="form-control h_inputs" name="page_main_text2"><?php echo $data['page_main_text2']; ?></textarea>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>1. Paragraf</label>
<textarea rows="50" class="form-control h_inputs" name="page_main_text3"><?php echo $data['page_main_text3']; ?></textarea>
</div>
</div>

</form>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Çık</button>
<button type="button" onclick="document.getElementById('edit_<?php echo $data['page_id']; ?>').submit();" class="btn btn-primary">Kaydet</button>
</div>

</div>
</div>
</div>

<?php } } ?>
</tbody>

</table>

</div>

</div>

<div class="box box-danger collapsed-box">

<div class="box-header with-border">
<h3 class="box-title">Sayfa Ekleme</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-sm btn-default" data-widget="collapse"><i class="fa fa-plus"></i>
</button>
</div>
</div>

<form method="POST" action="add_new.php">

<div class="box-body">

<div class="row">

<div class="col-md-12">
<div class="form-group">
<label>Sayfa Başlığı ( 60 Karakter )</label>
<input type="text" class="form-control" name="page_title" maxlength="150" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Sayfa Açıklaması ( 250 Karakter )</label>
<input type="text" class="form-control" name="page_description" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Sayfa Keywordleri ( 250 Karakter, virgül ile ayrılmış bitişik)</label>
<input type="text" class="form-control" name="page_keywords" maxlength="250" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Sayfa Adı ( 60 Karakter )</label>
<input type="text" class="form-control" name="page_name" maxlength="250" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Durum</label>
<select name="page_stat" class="form-control" required="">
<option value="2">Aktif</option>
<option value="1">Pasif</option>
</select>
</div>
</div>

</div>

</div>

<div class="box-footer">
<button type="submit" class="btn btn-sm btn-primary pull-right">Kaydet</button>
</div>

<?php
$control = $Db->row("SELECT page_page_id FROM info_pages ORDER BY page_page_id DESC LIMIT ?", array('1'));
$new_car = $control['page_page_id'] + 1;
?>

<input type="hidden" name="page_page_id" value="<?php echo $new_car; ?>">

</form>

</div>

</div>

</div>

</section>

</div>

<?php include_once("../../footer.php"); ?>

</div>

<?php include_once("../../footer_scripts.php"); ?>

<script>$(function () { $('#d_table').dataTable( {} ); });</script>

</body>
</html>