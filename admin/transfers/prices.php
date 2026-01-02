<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$ports   = $Db->query("SELECT airport_airport_id, airport_name FROM transfer_airports WHERE airport_lang_id = ?", array('1'));


if ($_GET['port'] != 0) {

$airport = $Db->row("SELECT * FROM transfer_airports WHERE airport_airport_id = ? AND airport_lang_id = ?", array($_GET['port'],'1'));
$resos   = $Db->query("SELECT * FROM transfer_resorts WHERE resort_lang_id = ? AND resort_is_hotel = ?", array('1','1'));

if ($_GET['type'] == 1) {
$resorts = $Db->query("SELECT * FROM transfer_resorts WHERE resort_lang_id = ? AND resort_is_hotel = ? AND CONCAT(',', resort_airport, ',') like '%,".$airport['airport_airport_id'].",%' ", array('1','1'));
}

if ($_GET['type'] == 2 && !empty($_GET['area'])) {
$resorts = $Db->query("SELECT * FROM transfer_resorts WHERE resort_lang_id = ? AND resort_is_hotel = ? AND resort_is_related = ? AND CONCAT(',', resort_airport, ',') like '%,".$airport['airport_airport_id'].",%'", array('1','2',$_GET['area']));
}

}

} else {

redirect(SITE_URL."admin/index.php"); exit;

}

?>

<!DOCTYPE html>
<html lang="tr">

<?php include_once("../head_meta.php"); ?>

<div id="loader" style="display:none;"></div>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper" id="osman" style="">

<?php include_once("../header.php"); ?>

<?php include_once("../left_menu.php"); ?>

<div class="content-wrapper">

<section class="content-header">
<h1>Yönetim Paneli<small>Version 1.2</small></h1>
<ol class="breadcrumb">
<li><a href="<?php echo SITE_URL."admin/index.php"; ?>"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
<li><a href="<?php echo SITE_URL; ?>admin/transfers/index.php">Havalimanı Transferi</a></li>
<li class="active">Fiyatlandırma</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-4">
<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Düzenlenecek Havaalanını Seçin</h3>
</div>

<form method="get">
<div class="box-body">
<div class="form-group">
<label>Havaalanını</label>
<select class="form-control" name="port" onchange="this.form.submit()">
<option <?php if ($_GET['port'] == 0) { echo 'selected="selected"'; } ?> value="0">Lütfen Seçim Yapın</option>
<?php if (!empty($ports)) { foreach ($ports as $port) { ?>
<option <?php if (isset($_GET['port']) && !empty($_GET['port'])) { if ($_GET['port'] == $port['airport_airport_id']) { echo 'selected="selected"'; } } ?> value="<?php echo $port['airport_airport_id']; ?>"><?php echo $port['airport_name']; ?></option>
<?php } } ?>
</select>
</div>
</div>
<input type="hidden" name="type" value="<?php if (isset($_GET['type']) && !empty($_GET['type'])) { echo $_GET['type']; } ?>">
<input type="hidden" name="area" value="<?php if (isset($_GET['area']) && !empty($_GET['area'])) { echo $_GET['area']; } ?>">
</form>

</div>
</div>

<div class="col-md-4">
<div class="box box-primary">

<div class="box-header with-border">
<h3 class="box-title">Düzenleme Türünü Seçin</h3>
</div>

<form method="get">
<div class="box-body">
<div class="form-group">
<label>Bölge / Otel</label>
<select class="form-control" name="type" onchange="this.form.submit()">
<option value="">Seçim Yapın</option>
<option <?php if (isset($_GET['type']) && !empty($_GET['type'])) { if ($_GET['type'] == 1) { echo 'selected="selected"'; } } ?> value="1">Bölge</option>
<option <?php if (isset($_GET['type']) && !empty($_GET['type'])) { if ($_GET['type'] == 2) { echo 'selected="selected"'; } } ?> value="2">Otel</option>
</select>
</div>
</div>
<input type="hidden" name="area" value="<?php if (isset($_GET['area']) && !empty($_GET['area'])) { echo $_GET['area']; } ?>">
<input type="hidden" name="port" value="<?php if (isset($_GET['port']) && !empty($_GET['port'])) { echo $_GET['port']; } ?>">
</form>

</div>
</div>

<?php if (!empty($_GET['type']) && $_GET['type'] == 2) { ?>
<div class="col-md-4">
<div class="box box-primary">

<div class="box-header with-border">
<h3 class="box-title">Düzenleme Bölgesini Seçin</h3>
</div>

<form method="get">
<div class="box-body">
<div class="form-group">
<label>Bölge Seçimi</label>
<select class="form-control" name="area" onchange="this.form.submit()">
<option value="">Seçim Yapın</option>
<?php if (!empty($resos)) { foreach ($resos as $reso) { ?>
<option <?php if (isset($_GET['area']) && !empty($_GET['area'])) { if ($_GET['area'] == $reso['resort_resort_id']) { echo 'selected="selected"'; } } ?> value="<?php echo $reso['resort_resort_id']; ?>"><?php echo $reso['resort_name']; ?></option>
<?php } } ?>
</select>
</div>
</div>
<input type="hidden" name="type" value="<?php if (isset($_GET['type']) && !empty($_GET['type'])) { echo $_GET['type']; } ?>">
<input type="hidden" name="port" value="<?php if (isset($_GET['port']) && !empty($_GET['port'])) { echo $_GET['port']; } ?>">
</form>

</div>
</div>
<?php } ?>

</div>

<?php if ($_GET['port'] != 0) { ?>
<div class="row">

<div class="col-md-12">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Fiyatlandırma</h3>
</div>

<div class="box-body">

<table class="table table-striped table-hover table-bordered table-condensed" style="font-size: 10px;">

<thead>

<tr>
<th>H. Alanı</th>
<th>Rota</th>
<th>dk</th>
<th>km</th>
<th>1. Araç Al</th>
<th>1. Araç Sat</th>
<th>2. Araç Al</th>
<th>2. Araç Sat</th>
<?php if ($airport['airport_shuttle'] == 2) { ?>
<th>Sht Al</th>
<th>Sht Sat</th>
<?php } ?>
<th>Al Kur</th>
<th></th>
</tr>

</thead>

<tbody>
<?php if (!empty($resorts)) { foreach ($resorts as $resort) {
$routes = $Db->query("SELECT * FROM transfer_routes WHERE route_airport_id = ? AND route_resort_id = ? ORDER BY route_vehicle_id ASC ", array($airport['airport_airport_id'],$resort['resort_resort_id']));
?>

<tr>

<form method="POST" class="hayde" action="price_update.php">

<td><?php echo $airport['airport_code']; ?></td>
<td><?php echo $resort['resort_name']; ?> <small class="pull-right"><a href="javascript:void(0)" class="get_dis" from="<?php echo $airport['airport_geo']; ?>" to="<?php echo $resort['resort_geo']; ?>" title="Km ve Dk hesapla"><i class="fa fa-map-marker" aria-hidden="true"></i></a></small></td>
<td class="min"><input type="text" onkeypress="return h_isNumber(event)" class="form-control input-sm" name="route_minute" value="<?php echo $routes[0]['route_minute']; ?>" style="width: 50px;" required=""></td>
<td class="dis"><input type="text" onkeypress="return h_isNumber(event)" class="form-control input-sm" name="route_distance" value="<?php echo $routes[0]['route_distance']; ?>" style="width: 50px;" required=""></td>
<td><input type="text" onkeypress="return h_isNumber(event)" class="form-control input-sm" name="route_cost_price1" value="<?php echo $routes[0]['route_cost_price']; ?>" style="width: 50px;" required=""></td>
<td><input type="text" onkeypress="return h_isNumber(event)" class="form-control input-sm" name="route_sell_price1" value="<?php echo $routes[0]['route_sell_price']; ?>" style="width: 50px;" required=""></td>
<td><input type="text" onkeypress="return h_isNumber(event)" class="form-control input-sm" name="route_cost_price2" value="<?php echo $routes[1]['route_cost_price']; ?>" style="width: 50px;" required=""></td>
<td><input type="text" onkeypress="return h_isNumber(event)" class="form-control input-sm" name="route_sell_price2" value="<?php echo $routes[1]['route_sell_price']; ?>" style="width: 50px;" required=""></td>
<?php if ($airport['airport_shuttle'] == 2) { ?>
<td><input type="text" onkeypress="return h_isNumber(event)" class="form-control input-sm" name="route_single_cost" value="<?php echo $routes[0]['route_single_cost']; ?>" style="width: 50px;" required=""></td>
<td><input type="text" onkeypress="return h_isNumber(event)" class="form-control input-sm" name="route_single_sell" value="<?php echo $routes[0]['route_single_sell']; ?>" style="width: 50px;" required=""></td>
<?php } ?>

<td>
<select class="form-control input-sm" name="route_cost_curr" required="">
<?php if (!empty($currencylist)) { foreach ($currencylist as $currency) { ?>
<option <?php if ($routes[0]['route_cost_curr'] == $currency['curr_id']) { echo 'selected="selected"'; } ?> value="<?php echo $currency['curr_id']; ?>"><?php echo $currency['curr_code']; ?></option>
<?php } } ?>
</select>
</td>

<input type="hidden" name="route_airport_id" value="<?php echo $airport['airport_airport_id']; ?>">
<input type="hidden" name="route_resort_id" value="<?php echo $resort['resort_resort_id']; ?>">

</form>

</tr>

<?php } } ?>

</tbody>

<tfoot>
<tr><td><button type="button" class="btn btn-block btn-success btn-xs allsubmit">Kaydet</button></td></tr>
</tfoot>

</table>

</div>

</div>

<div class="box box-danger">

<div class="box-header with-border">
<h3 class="box-title">Yeni Kayıt</h3>
</div>

<form method="POST" action="resort_add_new.php">

<div class="box-body">

<div class="row">

<div class="col-sm-6">
<div class="form-group">
<label>Türkçe Destinasyon Adı</label>
<input type="text" class="form-control h_firstcap" name="resort_name" maxlength="250" required="">
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>Destinasyon Koordinatı</label>
<input type="text" class="form-control" name="resort_geo" maxlength="250" required="">
</div>
</div>

</div>

</div>

<div class="box-footer">
<button type="submit" class="btn btn-sm btn-primary pull-right">Kaydet</button>
</div>

<?php
$control = $Db->row("SELECT resort_resort_id FROM transfer_resorts ORDER BY resort_resort_id DESC LIMIT ?", array('1'));
$new_res = $control['resort_resort_id'] + 1;
?>

<input type="hidden" name="resort_resort_id" value="<?php echo $new_res; ?>">

</form>

</div>

</div>

</div>
<?php } ?>

</section>

</div>

<?php include_once("../footer.php"); ?>

</div>

<?php include_once("../footer_scripts.php"); ?>

<script>
$('.get_dis').click(function () {

document.getElementById("loader").style.display = "block";

$("#osman").css("filter", "blur(2px)");

$this = $(this);
var fr = $(this).attr('from');
var to = $(this).attr('to');
$.ajax({
url: "<?php echo SITE_URL; ?>admin/transfers/get_dist_dur.php",
type: 'POST',
data: {st: fr, en: to},
success: function(data){
var objJSON = JSON.parse(data);
if (objJSON.response === "ok") {
$a1 = Math.round(objJSON.dist);
$a2 = Math.round(objJSON.time);
$this.closest('tr').find("input[name='route_minute']").val($a1);
$this.closest('tr').find("input[name='route_distance']").val($a2);

setTimeout(function(){
document.getElementById("loader").style.display = "none";
$("#osman").css("filter", "");
}, 1000);

}
else {
if(objJSON.response == "nok"){ swal("Problem!", "Google km ve süre bilgisi vermedi, Daha sonra tekrar deneyin.", "error"); }
}
}
});
});

$(function() {
$(".allsubmit").click(function(){
$('.hayde').each(function(){
valuesToSend = $(this).serialize();
$.ajax($(this).attr('action'),
{
method: $(this).attr('method'),
data: valuesToSend
}
);
});
swal("Ok!", "Kaydedildi.", "success");
});
});
</script>

</body>
</html>