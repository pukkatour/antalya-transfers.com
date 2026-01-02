<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$id   = $_GET['id'];

$data = $Db->row("SELECT * FROM transfer_bookings WHERE booking_id = ?", array($id));

$buyc = $Db->row("SELECT curr_code FROM currencies WHERE curr_id = ?", array($data['booking_cost_curr']));
$selc = $Db->row("SELECT curr_code FROM currencies WHERE curr_id = ?", array($data['booking_sale_curr']));
$cnty = $Db->row("SELECT country_phone_code FROM country_list WHERE country_id = ?", array($data['booking_country']));
$airp = $Db->row("SELECT airport_name FROM transfer_airports WHERE airport_airport_id = ? AND airport_lang_id = ?", array($data['booking_airport'],'1'));
$dest = $Db->row("SELECT resort_name FROM transfer_resorts WHERE resort_resort_id = ? AND resort_lang_id = ?", array($data['booking_resort'],'1'));
$vehc = $Db->row("SELECT vehicle_name FROM transfer_vehicles WHERE vehicle_vehicle_id = ? AND vehicle_lang_id = ?", array($data['booking_vehicle'],'1'));

if ($data['booking_from_to'] == 1) { $r_type = "Havalimanı - Otel"; }
if ($data['booking_from_to'] == 2) { $r_type = "Otel - Havalimanı"; }
if ($data['booking_type'] == 1) { $t_type = "Tek Yön"; } else { $t_type = "Gidiş Dönüş"; }



} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL.'admin/bookings/index.php'); exit;

}

?>

<!DOCTYPE html>
<html lang="tr">

<?php include_once("../head_meta.php"); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css">

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

<?php include_once("../header.php"); ?>

<?php include_once("../left_menu.php"); ?>

<div class="content-wrapper">

<section class="content-header">
<h1>Yönetim Paneli<small>Version 1.2</small></h1>
<ol class="breadcrumb">
<li><a href="<?php echo SITE_URL."admin/index.php"; ?>"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
<li><a href="<?php echo SITE_URL."admin/bookings/index.php?status=0"; ?>">Havalimanı Transferi Rezervasyonları</a></li>
<li class="active">Rezervasyon Detay</li>
</ol>
</section>

<?php if (!empty($_GET['status']) AND $_GET['status'] == "sent") { ?>
<div class="row">
<div class="col-md-12">
<div class="pad" id="sentMessage">
<div class="callout callout-danger" style="margin-bottom: 0!important;">
<h4><i class="fa fa-info"></i> Email Gönderildi</h4>
</div>
</div>
</div>
</div>
<?php } ?>

<div class="pad margin no-print">
<div class="callout callout-<?php
if ($data['booking_status'] == 0) { echo 'warning'; }
if ($data['booking_status'] == 1) { echo 'info'; }
if ($data['booking_status'] == 2) { echo 'success'; }
if ($data['booking_status'] == 3) { echo 'danger'; }
?>" style="margin-bottom: 0!important;">
<h4><i class="fa fa-info"></i> Rezervasyon Durumu: 
<?php
if ($data['booking_status'] == 0) { echo '<b>Yeni / Onaysız</b>'; }
if ($data['booking_status'] == 1) { echo '<b>Gelecek</b>'; }
if ($data['booking_status'] == 2) { echo '<b>Tamalanmış</b>'; }
if ($data['booking_status'] == 3) { echo '<b>İptal</b>'; }
?>
</h4>
</div>
</div>

<section class="invoice">

<div class="row">
<div class="col-xs-12">
<h2 class="page-header">
<i class="fa fa-globe"></i> Rezervasyon ID: <?php echo $data['booking_id']; ?>
</h2>
</div>
</div>

<div class="row invoice-info">

<div class="col-md-6 invoice-col">
<b>Voucher: <?php echo $data['booking_code']; ?></b><br><br>
<b>Rezervasyon ID:</b> <?php echo $data['booking_id']; ?><br>
<b>Rezervasyon Tarihi:</b> <?php echo date("d-m-Y H:i:s", strtotime($data['booking_date'])); ?><br>
<b>Rezervasyon IP:</b> <?php echo $data['booking_ip']; ?>
</div>

<div class="col-md-6 invoice-col">
<b>Müşteri: <?php echo $data['booking_name']." ".$data['booking_surname']; ?></b><br><br>
<b>Telefon:</b> <?php echo $cnty['country_phone_code']." ".$data['booking_phone']; ?><br>
<b>Email:</b> <?php echo $data['booking_email']; ?>
</div>

</div>

<hr>

<div class="row">
<div class="col-xs-12 table-responsive">

<table class="table table-striped">

<thead>
<tr>
<th>Yön</th>
<th>Havalimanı</th>
<th>Bölge</th>
<th>Araç</th>
<th>Kişi</th>
<th>Tip</th>
</tr>
</thead>

<tbody>
<tr>
<td><?php echo $r_type; ?></td>
<td><?php echo $airp['airport_name']; ?></td>
<td><?php echo $dest['resort_name']; ?></td>
<td><?php echo $vehc['vehicle_name']; ?></td>
<td><?php echo $data['booking_total_pax']; ?></td>
<td><?php echo $t_type; ?></td>
</tr>
</tbody>

</table>

<?php if ($data['booking_from_to'] == 1 && $data['booking_type'] == 1) { ?>
<table class="table table-striped">

<thead>
<tr>
<th>Geliş Uçuş No</th>
<th>Geliş Uçuş Tarihi</th>
<th>Geliş Uçuş Saati</th>
</tr>
</thead>

<tbody>
<tr>
<td><?php echo $data['booking_arv_flight_no']; ?></td>
<td><?php echo date("d-m-Y", strtotime($data['booking_arv_flight_date'])); ?></td>
<td><?php echo date('H:i', strtotime($data['booking_arv_flight_time'])); ?></td>
</tr>
</tbody>

</table>
<?php } ?>

<?php if ($data['booking_type'] == 2) { ?>
<table class="table table-striped">

<thead>
<tr>
<th>Geliş Uçuş No</th>
<th>Geliş Uçuş Tarihi</th>
<th>Geliş Uçuş Saati</th>
<th></th>
</tr>
</thead>

<tbody>
<tr>
<td><?php echo $data['booking_arv_flight_no']; ?></td>
<td><?php echo date("d-m-Y", strtotime($data['booking_arv_flight_date'])); ?></td>
<td><?php echo date('H:i', strtotime($data['booking_arv_flight_time'])); ?></td>
<td></td>
</tr>
</tbody>

<thead>
<tr>
<th>Gidiş Uçuş No</th>
<th>Gidiş Uçuş Tarihi</th>
<th>Gidiş Uçuş Saati</th>
<th>Pick Up Tarih / Saati</th>
</tr>
</thead>

<tbody>
<tr>
<td><?php echo $data['booking_dep_flight_no']; ?></td>
<td><?php echo date("d-m-Y", strtotime($data['booking_dep_flight_date'])); ?></td>
<td><?php echo date('H:i', strtotime($data['booking_dep_flight_time'])); ?></td>
<td><?php echo date('d-m-Y H:i', strtotime($data['booking_dep_flight_pickup'])); ?></td>
</tr>
</tbody>

</table>
<?php } ?>

<?php if ($data['booking_from_to'] == 2 && $data['booking_type'] == 1) { ?>
<table class="table table-striped">

<thead>
<tr>
<th>Gidiş Uçuş No</th>
<th>Gidiş Uçuş Tarihi</th>
<th>Gidiş Uçuş Saati</th>
<th>Pick Up Tarih / Saati</th>
</tr>
</thead>

<tbody>
<tr>
<td><?php echo $data['booking_dep_flight_no']; ?></td>
<td><?php echo date("d-m-Y", strtotime($data['booking_dep_flight_date'])); ?></td>
<td><?php echo date('H:i', strtotime($data['booking_dep_flight_time'])); ?></td>
<td><?php echo date('d-m-Y H:i', strtotime($data['booking_dep_flight_pickup'])); ?></td>
</tr>
</tbody>

</table>
<?php } ?>

</div>
</div>

<hr>

<div class="row">

<div class="col-md-12">

<div class="table-responsive">

<table class="table table-striped">

<thead>
<tr>
<th>Yolculuk Türü</th>
<th>Çocuk Koltuğu</th>
<th>Bebek Koltuğu</th>
</tr>
</thead>

<tbody>
<tr>
<td><?php if ($data['booking_shared'] == 1) { echo "Yaplaşımlı"; } else { echo "VIP Özel"; } ?></td>
<td><?php echo $data['booking_child_seat']; ?> ad.</td>
<td><?php echo $data['booking_baby_seat']; ?> ad.</td>
</tr>
</tbody>

</table>

</div>

</div>

</div>

<hr>

<div class="row">
<div class="col-md-12">
<div class="table-responsive">
<table class="table table-striped">
<tbody>
<tr>
<th>Alış / Bırakış Adresi:</th>
<td><?php echo $data['booking_stay_address']; ?></td>
</tr>
<tr>
<th>Müşteri Notu:</th>
<td><?php echo $data['booking_customer_note']; ?></td>
</tr>
<tr class="no-print">
<th>Acente Notu:</th>
<td class="no_edit" data-type="textarea" data-pk="<?php echo $data['booking_id']; ?>" data-name="agent_note" data-placeholder="Not ekleyebilirsiniz..." data-url="update_agent_note.php" data-title="Notunuzu Yazın"><?php echo $data['booking_agent_note']; ?></td>
</tr>
<tr class="visible-print">
<th>Satış Fiyatı:</th>
<td><?php echo number_format($data['booking_sale_price'])." ".$selc['curr_code']; ?></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>

<hr>

<div class="row">

<div class="col-md-6">
<img src="<?php echo IMAGE_FOLDER; ?><?php echo $sitesettings['site_logo']; ?>" style="max-width: 250px;"><br>
<b>Adres:</b> <?php echo $sitesettings['site_address_1']; ?><br><?php echo $sitesettings['site_address_2']; ?><br>
<b>Telefon:</b> <?php echo $sitesettings['site_phone_1']; ?> <br>
<b>Telefon:</b> <?php echo $sitesettings['site_phone_2']; ?><br>
<b>Email:</b> <?php echo $sitesettings['site_email']; ?><br>
</div>

<div class="col-md-6 no-print">
<div class="table-responsive">
<table class="table">
<tbody>
<tr>
<th>Alış Fiyatı:</th>
<td><?php echo number_format($data['booking_cost_price'])." ".$buyc['curr_code']; ?></td>
</tr>
<tr>
<th>Satış Fiyatı:</th>
<td><?php echo number_format($data['booking_sale_price'])." ".$selc['curr_code']; ?></td>
</tr>
</tbody>
</table>
</div>
</div>

</div>

<hr>

<div class="row no-print">

<div class="col-xs-12">

<div class="col-md-2">
<button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Yazdır</button>
</div>

<div class="col-md-2">
<form action="send_email.php" method="POST" class="form-horizontal">
<button type="submit" class="btn btn-default">Email (Kendine)</button>
<input type="hidden" name="id" value="<?php echo $data['booking_id']; ?>">
<input type="hidden" name="type" value="1">
<input type="hidden" name="lang" value="<?php echo $data['booking_lang_id']; ?>">
</form>
</div>

<div class="col-md-2">
<form action="send_email.php" method="POST" class="form-horizontal">
<button type="submit" class="btn btn-default">Email (Müşteriye)</button>
<input type="hidden" name="id" value="<?php echo $data['booking_id']; ?>">
<input type="hidden" name="type" value="2">
<input type="hidden" name="lang" value="<?php echo $data['booking_lang_id']; ?>">
</form>
</div>

<div class="col-md-6">
<form action="send_email.php" method="POST" class="form-horizontal">
<div class="input-group input-group-md">
<input type="email" name="receiver" class="form-control">
<span class="input-group-btn">
<button type="submit" class="btn btn-info btn-flat">Adrese Gönder</button>
</span>
</div>
<input type="hidden" name="id" value="<?php echo $data['booking_id']; ?>">
<input type="hidden" name="type" value="3">
<input type="hidden" name="lang" value="<?php echo $data['booking_lang_id']; ?>">
</form>
</div>

</div>

</div>

</section>

</div>

<?php include_once("../footer.php"); ?>

</div>

<?php include_once("../footer_scripts.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<script>$('.no_edit').editable({type: 'text'});</script>

<script>
$(function() {
setTimeout(function() { $("#sentMessage").hide('blind', {}, 500); }, 5000);
});
</script>

</body>
</html>