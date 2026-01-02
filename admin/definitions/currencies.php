<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


$currencies = $Db->query("SELECT * FROM currencies ");

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
<li class="active">Para Birimleri</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-12">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Para Birimleri</h3>
</div>

<div class="box-body">

<table id="data_table" class="table table-striped table-hover table-bordered table-condensed">

<thead>
<tr>
<th>ID</th>
<th>Birim Adı</th>
<th>Birim Kodu</th>
<th>Birim Sembolü</th>
</tr>
</thead>

<tbody>

<?php if (!empty($currencies)) { foreach ($currencies as $curr) { ?>
<tr>
<td><?php echo $curr['curr_id']; ?></td>
<td><?php echo $curr['curr_name']; ?></td>
<td><?php echo $curr['curr_code']; ?></td>
<td><?php echo $curr['curr_symbol']; ?></td>
</tr>
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

<script>$(function () { $('#data_table').dataTable(); });</script>

</body>
</html>