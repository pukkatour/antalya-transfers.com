<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


$datas = $Db->query("SELECT * FROM directory_categories");

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
<li class="active">Rehber Kategorileri</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-12">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Rehber Kategorileri</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-sm btn-default" data-widget="collapse"><i class="fa fa fa-minus"></i>
</button>
</div>
</div>

<div class="box-body">

<table class="table table-striped table-hover table-bordered table-condensed">
<tbody>

<tr>
<th>Kategori Adı</th>
<th></th>
</tr>

<?php if (!empty($datas)) { foreach ($datas as $data) { ?>

<tr>
<td><?php echo $data['category_name']; ?></td>
<td>
<div class="btn-group pull-right">
<button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown">İşlem <span class="caret"></span></button>
<ul class="dropdown-menu dropdown-menu-right" role="menu">
<li><a href="#" data-toggle="modal" data-target="#myModal<?php echo $data['category_id']; ?>">Düzenle</a></li>
<li class="divider"></li>
<li><a href="remove_category.php?id=<?php echo $data['category_id']; ?>" onclick="return confirm('Silmek istiyor musun?');">Sil</a></li>
</ul>
</div>
</td>
</tr>

<div class="modal fade" id="myModal<?php echo $data['category_id']; ?>" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Kategori Düzenleme</h4>
</div>

<div class="modal-body">
<div class="box-body">

<form id="edit_cat<?php echo $data['category_id']; ?>" method="POST" action="update_category.php">

<input type="hidden" name="category_id" value="<?php echo $data['category_id']; ?>">

<div class="form-group">
<label>Kategori Adı</label>
<input type="text" name="category_name" class="form-control h_firstcap" value="<?php echo $data['category_name']; ?>">
</div>

</form>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Çık</button>
<button type="button" onclick="document.getElementById('edit_cat<?php echo $data['category_id']; ?>').submit();" class="btn btn-primary">Kaydet</button>
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
<h3 class="box-title">Kategori Ekleme</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-sm btn-default" data-widget="collapse"><i class="fa fa-plus"></i>
</button>
</div>
</div>

<form action="add_new_category.php" method="POST">

<div class="box-body">

<div class="col-xs-4">
<label>Kategori Adı</label>
<input type="text" class="form-control h_firstcap" name="category_name" placeholder="Kategori Adı" maxlength="250" required="">
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

</body>
</html>