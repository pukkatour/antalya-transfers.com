<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }

$prevmonth = date("Y-m-01",strtotime("-1 month"));
$lastmonth = date("Y-m-31",strtotime("-1 month"));
$thismonth = date('Y-m-01');
$nextmonth = date('Y-m-31');

$lang_total1 = $Db->row("SELECT SUM(hit_count) AS langtotal1 FROM hit_counter WHERE hit_site_id = ?", array($languagelist[0]['lang_id']));
$lang_total2 = $Db->row("SELECT SUM(hit_count) AS langtotal2 FROM hit_counter WHERE hit_site_id = ?", array($languagelist[1]['lang_id']));
$lang_total3 = $Db->row("SELECT SUM(hit_count) AS langtotal3 FROM hit_counter WHERE hit_site_id = ?", array($languagelist[2]['lang_id']));
$lang_total4 = $Db->row("SELECT SUM(hit_count) AS langtotal4 FROM hit_counter WHERE hit_site_id = ?", array($languagelist[3]['lang_id']));
$lang_total5 = $Db->row("SELECT SUM(hit_count) AS langtotal5 FROM hit_counter WHERE hit_site_id = ?", array($languagelist[4]['lang_id']));
$lang_total6 = $Db->row("SELECT SUM(hit_count) AS langtotal6 FROM hit_counter WHERE hit_site_id = ?", array($languagelist[5]['lang_id']));
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
<li class="active">Ziyaretçi İstatistikleri</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-12">

<div class="nav-tabs-custom">

<ul class="nav nav-tabs">
<?php if (!empty($languagelist)) { $nol = 0; foreach ($languagelist as $ll) { ?>
<li class="<?php if ($nol == 0) { echo "active"; } ?>"><a href="#tab_<?php echo $nol; ?>" data-toggle="tab" aria-expanded="false"><?php echo $ll['lang_name_eng']; ?></a></li>
<?php $nol++; } } ?>
</ul>

<div class="tab-content">

<?php if (!empty($languagelist)) { $nol = 0; foreach ($languagelist as $ll) { ?>
<div class="tab-pane <?php if ($nol == 0) { echo "active"; } ?>" id="tab_<?php echo $nol; ?>">

<table id="analytics<?php echo $nol; ?>" class="table table-bordered table-hover">

<thead>
<tr>
<th>Sayfa Adı:</th>
<th>Bu Ay</th>
<th>Geçen Ay</th>
<th>Toplam</th>
</tr>
</thead>

<tbody>

<?php
$hits = $Db->query("SELECT * FROM hit_counter WHERE hit_site_id = ? GROUP BY hit_page", array($ll['lang_id']));
if (!empty($hits)) { foreach ($hits as $hit) {
$hitsa = $Db->row("SELECT SUM(hit_count) AS totala FROM hit_counter WHERE hit_page = ? AND hit_site_id = ? AND hit_date BETWEEN ? AND ? ", array($hit['hit_page'],$ll['lang_id'],$prevmonth,$lastmonth));
$hitsb = $Db->row("SELECT SUM(hit_count) AS totalb FROM hit_counter WHERE hit_page = ? AND hit_site_id = ? AND hit_date BETWEEN ? AND ? ", array($hit['hit_page'],$ll['lang_id'],$thismonth,$nextmonth));
$hitsc = $Db->row("SELECT SUM(hit_count) AS totalc FROM hit_counter WHERE hit_page = ? AND hit_site_id = ? ", array($hit['hit_page'],$ll['lang_id']));
?>
<tr>
<td><?php echo $hit['hit_page']; ?></td>
<td><span class="pull-right badge bg-red"><?php if (!empty($hitsb['totalb'])) { echo $hitsb['totalb']; } else { echo "0"; } ?></span></td>
<td><span class="pull-right badge bg-green"><?php if (!empty($hitsa['totala'])) { echo $hitsa['totala']; } else { echo "0"; } ?></span></td>
<td><span class="pull-right badge bg-blue"><?php if (!empty($hitsc['totalc'])) { echo $hitsc['totalc']; } else { echo "0"; } ?></span></td>
</tr>
<?php } } ?>

</tbody>

</table>

</div>
<?php $nol++; } } ?>

</div>

</div>

</div>

<div class="col-md-12">

<div class="row">

<div class="col-md-4 col-sm-6 col-xs-12">
<div class="info-box">
<span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
<div class="info-box-content">
<span class="info-box-text"><?php echo $languagelist[0]['lang_name_eng']; ?></span>
<span class="info-box-number"><?php if (!empty($lang_total1['langtotal1'])) { echo number_format($lang_total1['langtotal1']); } else { echo "0"; } ?></span>
</div>
</div>
</div>

<div class="col-md-4 col-sm-6 col-xs-12">
<div class="info-box">
<span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
<div class="info-box-content">
<span class="info-box-text"><?php echo $languagelist[1]['lang_name_eng']; ?></span>
<span class="info-box-number"><?php if (!empty($lang_total2['langtotal2'])) { echo number_format($lang_total2['langtotal2']); } else { echo "0"; } ?></span>
</div>
</div>
</div>

<div class="col-md-4 col-sm-6 col-xs-12">
<div class="info-box">
<span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
<div class="info-box-content">
<span class="info-box-text"><?php echo $languagelist[2]['lang_name_eng']; ?></span>
<span class="info-box-number"><?php if (!empty($lang_total3['langtotal3'])) { echo number_format($lang_total3['langtotal3']); } else { echo "0"; } ?></span>
</div>
</div>
</div>

<div class="col-md-4 col-sm-6 col-xs-12">
<div class="info-box">
<span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
<div class="info-box-content">
<span class="info-box-text"><?php echo $languagelist[3]['lang_name_eng']; ?></span>
<span class="info-box-number"><?php if (!empty($lang_total4['langtotal4'])) { echo number_format($lang_total4['langtotal4']); } else { echo "0"; } ?></span>
</div>
</div>
</div>

<div class="col-md-4 col-sm-6 col-xs-12">
<div class="info-box">
<span class="info-box-icon bg-maroon"><i class="fa fa-users"></i></span>
<div class="info-box-content">
<span class="info-box-text"><?php echo $languagelist[4]['lang_name_eng']; ?></span>
<span class="info-box-number"><?php if (!empty($lang_total5['langtotal5'])) { echo number_format($lang_total5['langtotal5']); } else { echo "0"; } ?></span>
</div>
</div>
</div>

<div class="col-md-4 col-sm-6 col-xs-12">
<div class="info-box">
<span class="info-box-icon bg-orange"><i class="fa fa-users"></i></span>
<div class="info-box-content">
<span class="info-box-text"><?php echo $languagelist[5]['lang_name_eng']; ?></span>
<span class="info-box-number"><?php if (!empty($lang_total6['langtotal6'])) { echo number_format($lang_total6['langtotal6']); } else { echo "0"; } ?></span>
</div>
</div>
</div>

</div>

</div>

</div>

</section>

</div>

<?php include_once("../footer.php"); ?>

</div>

<?php include_once("../footer_scripts.php"); ?>

<?php if (!empty($languagelist)) { $nol = 0; foreach ($languagelist as $ll) { ?>
<script>$(function () { $('#analytics<?php echo $nol; ?>').dataTable( { "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ ] } ] }); });</script>
<?php $nol++; } } ?>

</body>
</html>