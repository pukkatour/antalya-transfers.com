<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$datas = $Db->query("SELECT * FROM faq_list WHERE faq_lang_id = ?", array($_GET['lang']));

} else {

$_SESSION["alert"] = "nok";
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
<li class="active">Soru Cevaplar</li>
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
<h3 class="box-title">Soru Cevaplar</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-sm btn-default" data-widget="collapse"><i class="fa fa-plus"></i>
</button>
</div>
</div>

<div class="box-body">

<table id="d_table" class="table table-striped table-hover table-bordered table-condensed">

<thead>

<tr>
<th>Soru</th>
<th>Durum</th>
<th>Ana Sayfa</th>
<th></th>
</tr>

</thead>

<tbody>
<?php if (!empty($datas)) { foreach ($datas as $data) { ?>
<tr>
<td><?php echo $data['faq_question']; ?></td>
<td>
<?php
if ($data['faq_status'] == 0) { echo '<span class="label label-warning">Pasif</span>'; }
if ($data['faq_status'] == 1) { echo '<span class="label label-info">Aktif</span>'; }
?>
</td>
<td>
<form action="home_show.php" method="POST">
<select class="form-control" name="show" onchange="this.form.submit()">
<option <?php if ($data['faq_show_home'] == 0) { echo 'selected="selected"'; } ?> value="0">Hayır</option>
<option <?php if ($data['faq_show_home'] == 1) { echo 'selected="selected"'; } ?> value="1">Evet</option>
</select>
<input type="hidden" name="faq_id" value="<?php echo $data['faq_id']; ?>">
<input type="hidden" name="lang_id" value="<?php echo $data['faq_lang_id']; ?>">
</form>
</td>
<td align="right">
<a href="#" data-toggle="modal" data-target="#myModal<?php echo $data['faq_id']; ?>" class="btn btn-sm btn-success">Düzenle</a> 
<a href="remove.php?faq_id=<?php echo $data['faq_id']; ?>&lang=<?php echo $_GET['lang']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istiyor musun?');">Sil</a>
</td>
</tr>


<div class="modal fade" id="myModal<?php echo $data['faq_id']; ?>" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Soru Cevap Düzenleme</h4>
</div>

<div class="modal-body">
<div class="box-body">

<form id="edit_<?php echo $data['faq_id']; ?>" method="POST" action="update.php">

<input type="hidden" name="faq_id" value="<?php echo $data['faq_id']; ?>">
<input type="hidden" name="faq_lang_id" value="<?php echo $data['faq_lang_id']; ?>">

<div class="form-group">
<label>Soru</label>
<input type="text" name="faq_question" class="form-control" value="<?php echo $data['faq_question']; ?>" maxlength="250" required="">
</div>

<div class="form-group">
<label>Cevap</label>
<textarea rows="5" name="faq_answer" class="form-control" required=""><?php echo $data['faq_answer']; ?></textarea>
</div>

<div class="form-group">
<label>Durum</label>
<select class="form-control" name="faq_status">
<option <?php if ($data['faq_status'] == 0) { echo 'selected="selected"'; } ?> value="0">Pasif</option>
<option <?php if ($data['faq_status'] == 1) { echo 'selected="selected"'; } ?> value="1">Aktif</option>
</select>
</div>

</form>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Çık</button>
<button type="button" onclick="document.getElementById('edit_<?php echo $data['faq_id']; ?>').submit();" class="btn btn-primary">Kaydet</button>
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
<h3 class="box-title">Yeni Kayıt</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-sm btn-default" data-widget="collapse"><i class="fa fa-plus"></i>
</button>
</div>
</div>

<form method="POST" action="add_new.php">

<div class="box-body">

<div class="row">

<div class="col-sm-6">
<div class="form-group">
<label>Soru Dili</label>
<select class="form-control" name="faq_lang_id">
<?php if (!empty($languagelist)) { foreach ($languagelist as $lang) { ?>
<option <?php if ($_GET['lang'] == $lang['lang_id']) { echo 'selected="selected"'; } ?> value="<?php echo $lang['lang_id']; ?>"><?php echo $lang['lang_name_eng']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>Soru</label>
<input type="text" class="form-control" name="faq_question" maxlength="250" required="">
</div>
</div>

<div class="col-sm-12">
<div class="form-group">
<label>Cevap</label>
<textarea rows="5" class="form-control" name="faq_answer" required=""></textarea>
</div>
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

</body>
</html>