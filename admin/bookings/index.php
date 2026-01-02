<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (isset($_GET['status']) || !empty($_GET['status'])) {
$datas = $Db->query("SELECT * FROM transfer_bookings WHERE booking_status = ?", array($_GET['status'])); 
} else {
$datas = $Db->query("SELECT * FROM transfer_bookings"); 
}

?>

<!DOCTYPE html>
<html>

<?php include_once('../head_meta.php'); ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include_once('../header.php'); ?>

<?php include_once('../left_menu.php'); ?>

<div class="content-wrapper">


<!-- BREADCRUMB -->
<section class="content-header">
<small>Yönetim Paneli</small>
<ol class="breadcrumb">
<li><a href="<?php echo SITE_URL; ?>admin/index.php"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
<li class="active">Rezervasyonlar</li>
</ol>
</section>
<!-- BREADCRUMB -->


<section class="content">

<div class="row">

<div class="col-md-12">
<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Havaalanı Transfer Rezervasyonları</h3>
</div>

<div class="box-body">

<table id="bookings" class="table table-bordered table-striped">
<thead>

<tr>
<th>ID</th>
<th>Tip</th>
<th>Voucher</th>
<th>Ad Soyad</th>
<th>Telefon</th>
<th>Tip</th>
<th>Havaalanı</th>
<th>Rota</th>
<th>Kişi</th>
<th>Geliş</th>
<th>Gidiş</th>
<th>Toplam Tutar</th>
<th>Durum</th>
<th></th>
</tr>

</thead>

<tbody>

<?php
if (!empty($datas)) { foreach ($datas as $data) {
$curr = $Db->row("SELECT curr_code FROM currencies WHERE curr_id = ?", array($data['booking_sale_curr']));
$cnty = $Db->row("SELECT country_phone_code FROM country_list WHERE country_id = ?", array($data['booking_country']));
$airp = $Db->row("SELECT airport_name FROM transfer_airports WHERE airport_airport_id = ? AND airport_lang_id = ?", array($data['booking_airport'],'1'));
$dest = $Db->row("SELECT resort_name FROM transfer_resorts WHERE resort_resort_id = ? AND resort_lang_id = ?", array($data['booking_resort'],'1'));
?>
<tr>
<td><?php echo $data['booking_id']; ?></td>
<td data-toggle="tooltip" data-placement="top" title="<?php if ($data['booking_shared'] == 1) { echo "Yaplaşımlı"; } else { echo "VIP Özel"; } ?>">
<?php 
if ($data['booking_shared'] == 1) { echo '<i class="fa fa-user" style="color: #3b98fd;" aria-hidden="true"></i>'; }
if ($data['booking_shared'] == 2) { echo '<i class="fa fa-users" style="color: #e6cf0a;" aria-hidden="true"></i>'; }
?>
</td>
<td data-toggle="tooltip" data-placement="top" title="<?php echo $data['booking_date']." | ".$data['booking_ip']; ?>"><?php echo $data['booking_code']; ?></td>
<td data-toggle="tooltip" data-placement="top" title="<?php echo $data['booking_email']; ?>"><?php echo $data['booking_name']." ".$data['booking_surname']; ?></td>
<td><?php echo $cnty['country_phone_code']." ".$data['booking_phone']; ?></td>
<td><?php if ($data['booking_type'] == 1) { echo "Tek Yön"; } else { echo "Gidiş Dönüş"; } ?></td>
<td><?php echo $airp['airport_name']; ?></td>
<td><?php echo $dest['resort_name']; ?></td>
<td><?php echo $data['booking_total_pax']; ?></td>
<td><?php if (!empty($data['booking_arv_flight_date'])) { echo date("d-m-Y", strtotime($data['booking_arv_flight_date']))." ".date('H:i', strtotime($data['booking_arv_flight_time'])); } ?></td>
<td><?php if (!empty($data['booking_dep_flight_date'])) { echo date("d-m-Y", strtotime($data['booking_dep_flight_date']))." ".date('H:i', strtotime($data['booking_dep_flight_time'])); } ?></td>
<td><?php echo number_format($data['booking_sale_price'])." ".$curr['curr_code']; ?></td>
<td>
<?php
if ($data['booking_status'] == 0) { echo '<small class="label pull-right bg-yellow">Yeni / Onaysız</small>'; }
if ($data['booking_status'] == 1) { echo '<small class="label pull-right bg-blue">Gelecek</small>'; }
if ($data['booking_status'] == 2) { echo '<small class="label pull-right bg-green">Tamalanmış</small>'; }
if ($data['booking_status'] == 3) { echo '<small class="label pull-right bg-red">İptal</small>'; }
?>
</td>
<td>
<div class="btn-group">
<button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown">İşlem<span class="caret"></span></button>
<ul class="dropdown-menu" role="menu">

<?php if ($data['booking_status'] == '1') { ?>
<li><a href="operation.php?id=<?php echo $data['booking_id']; ?>&action=0">Onaysız Yap</a></li>
<li class="divider"></li>
<?php } ?>
<?php if ($data['booking_status'] == '0') { ?>
<li><a href="operation.php?id=<?php echo $data['booking_id']; ?>&action=1&lang=<?php echo $data['booking_lang_id']; ?>">Onayla</a></li>
<li class="divider"></li>
<?php } ?>
<?php if ($data['booking_status'] == '1') { ?>
<li><a href="operation.php?id=<?php echo $data['booking_id']; ?>&action=2&lang=<?php echo $data['booking_lang_id']; ?>">Tamamla</a></li>
<li class="divider"></li>
<?php } ?>
<?php if ($data['booking_status'] == '1') { ?>
<li><a href="operation.php?id=<?php echo $data['booking_id']; ?>&action=3&lang=<?php echo $data['booking_lang_id']; ?>">İptal Et</a></li>
<li class="divider"></li>
<?php } ?>



<li><a href="view.php?id=<?php echo $data['booking_id']; ?>">Görüntüle</a></li>
<li><a href="remove.php?id=<?php echo $data['booking_id']; ?>" onclick="return confirm('Silmek istiyor musun?');">Sil</a></li>
</ul>
</div>
</td>
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

<?php include_once('../footer.php'); ?>

</div>

<?php include_once('../footer_scripts.php'); ?>

<script>
$(function () { $('#bookings').dataTable( { "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 6 ] } ] }); });
</script>


</body>
</html>