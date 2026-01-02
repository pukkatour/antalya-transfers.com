<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

if (isset($_GET['type']) && !empty($_GET['type'])) { 
if ($_GET['type'] == 1) {
$datas = $Db->query("SELECT * FROM transfer_resorts WHERE resort_lang_id = ? AND resort_is_hotel = ?", array($_GET['lang'],'1'));
}
}

if (isset($_GET['type']) && !empty($_GET['type'])) {
if ($_GET['type'] == 2 && !empty($_GET['area'])) {
$datas = $Db->query("SELECT * FROM transfer_resorts WHERE resort_lang_id = ? AND resort_is_hotel = ? AND resort_is_related = ?", array($_GET['lang'],'2',$_GET['area']));
}
}

$resos = $Db->query("SELECT * FROM transfer_resorts WHERE resort_lang_id = ? AND resort_is_hotel = ?", array($_GET['lang'],'1'));
$airps = $Db->query("SELECT airport_airport_id,airport_name FROM transfer_airports WHERE airport_lang_id = ? ", array('1'));

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
<li><a href="<?php echo SITE_URL; ?>admin/transfers/index.php">Havalimanı Transferi</a></li>
<li class="active">Destinasyonlar</li>
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
<option <?php if (isset($_GET['lang']) && !empty($_GET['lang'])) { if ($_GET['lang'] == $lang['lang_id']) { echo 'selected="selected"'; } } ?> value="<?php echo $lang['lang_id']; ?>"><?php echo $lang['lang_name_eng']; ?></option>
<?php } } ?>
</select>
</div>
</div>
<input type="hidden" name="type" value="<?php if (isset($_GET['type']) && !empty($_GET['type'])) { echo $_GET['type']; } ?>">
<input type="hidden" name="area" value="<?php if (isset($_GET['area']) && !empty($_GET['area'])) { echo $_GET['area']; } ?>">
</form>

</div>
</div>

<div class="col-md-3">
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
<option <?php if (isset($_GET['type']) && !empty($_GET['area'])) { if ($_GET['type'] == 2) { echo 'selected="selected"'; } } ?> value="2">Otel</option>
</select>
</div>
</div>
<input type="hidden" name="area" value="<?php if (isset($_GET['area']) && !empty($_GET['area'])) { echo $_GET['area']; } ?>">
<input type="hidden" name="lang" value="<?php if (isset($_GET['lang']) && !empty($_GET['lang'])) { echo $_GET['lang']; } ?>">
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
<input type="hidden" name="lang" value="<?php if (isset($_GET['lang']) && !empty($_GET['lang'])) { echo $_GET['lang']; } ?>">
</form>

</div>
</div>
<?php } ?>

</div>

<div class="row">

<div class="col-md-12">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Destinasyonlar</h3>
</div>

<div class="box-body">

<table class="table table-striped table-hover table-bordered table-condensed">

<thead>
<tr>
<th>Destinasyon Adı</th>
<th>GPS</th>
<th>Ana Sayfa</th>
<th></th>
</tr>
</thead>

<tbody>
<?php
if (!empty($datas)) { foreach ($datas as $data) {
$lget_ports = $data['resort_airport'];
if(!empty($lget_ports)) { $lget_ports = explode(",", $lget_ports); }
?>
<tr>
<td><?php echo $data['resort_name']; ?></td>
<td><?php echo $data['resort_geo']; ?></td>
<td>
<form action="resort_home_show.php" method="POST">
<select class="form-control" name="show" onchange="this.form.submit()">
<option <?php if ($data['resort_home_show'] == 0) { echo 'selected="selected"'; } ?> value="0">Hayır</option>
<option <?php if ($data['resort_home_show'] == 1) { echo 'selected="selected"'; } ?> value="1">Evet</option>
</select>
<input type="hidden" name="resort_resort_id" value="<?php echo $data['resort_resort_id']; ?>">
</form>
</td>
<td align="right">
<a href="#" data-toggle="modal" data-target="#myModal<?php echo $data['resort_id']; ?>" class="btn btn-sm btn-success editmodal" id="<?php echo $data['resort_id']; ?>">Düzenle</a> 
<a href="resort_remove.php?resort_resort_id=<?php echo $data['resort_resort_id']; ?>&resort_lang_id=<?php echo $_GET['lang']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istiyor musun?');">Sil</a>
</td>
</tr>


<div class="modal fade" id="myModal<?php echo $data['resort_id']; ?>" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Destinasyon Düzenleme</h4>
</div>

<div class="modal-body">
<div class="box-body">

<form id="edit_<?php echo $data['resort_id']; ?>" method="POST" action="resort_update.php">

<input type="hidden" name="resort_id" value="<?php echo $data['resort_id']; ?>">
<input type="hidden" name="resort_lang_id" value="<?php echo $data['resort_lang_id']; ?>">
<input type="hidden" name="resort_resort_id" value="<?php echo $data['resort_resort_id']; ?>">

<div class="form-group">
<label>Destinasyon Adı</label>
<input type="text" name="resort_name" class="form-control h_firstcap" value="<?php echo $data['resort_name']; ?>" maxlength="250" required="">
</div>

<div class="form-group">
<label>Uydu Koordinatları</label>
<input type="text" name="resort_geo" class="form-control gpsupdate<?php echo $data['resort_id']; ?>" value="<?php echo $data['resort_geo']; ?>" maxlength="250" required="">
</div>

<div class="form-group">
<label>Hangi Havalimanlarına Bağlı?</label>
<select class="form-control" multiple name="resort_airport[]">
<?php if (!empty($airps)) { foreach ($airps as $airp) { ?>
<option <?php if(!empty($lget_ports) && in_array($airp['airport_airport_id'], $lget_ports)) {echo 'selected="selected"';} ?> value="<?php echo $airp['airport_airport_id']; ?>"><?php echo $airp['airport_name']; ?></option>
<?php } } ?>
</select>
</div>

<div class="form-group">
<label>Konum</label>
<div class="inner_map" id="i_map_<?php echo $data['resort_id']; ?>"></div>
</div>

</form>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Çık</button>
<button type="button" onclick="document.getElementById('edit_<?php echo $data['resort_id']; ?>').submit();" class="btn btn-primary">Kaydet</button>
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
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
</button>
</div>
</div>

<form method="POST" action="resort_add_new.php">

<div class="box-body">

<div class="row">

<div class="col-md-6">

<div class="row">

<div class="col-sm-12">
<div class="form-group">
<label>Türkçe Destinasyon Adı</label>
<input type="text" class="form-control h_firstcap" name="resort_name" maxlength="250" required="">
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label>Destinasyon Koordinatı</label>
<input type="text" class="form-control" name="resort_geo" id="gps" maxlength="250" required="">
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label>Destinasyon mu Otel mi?</label>
<select class="form-control" name="resort_is_hotel" id="id_hotel" required="">
<option value="1">Destinasyon</option>
<option value="2">Otel</option>
</select>
</div>
</div>

<div class="col-sm-4" id='show_rel' style='display:none;'>
<div class="form-group">
<label>Nerede?</label>
<select class="form-control" name="resort_is_related">
<?php if (!empty($resos)) { foreach ($resos as $reso) { ?>
<option value="<?php echo $reso['resort_resort_id']; ?>"><?php echo $reso['resort_name']; ?></option>
<?php } } ?>
</select>
</div>
</div>

</div>

<div class="row">

<div class="col-sm-4">
<div class="form-group">
<label>Hangi Havalimanlarına Bağlı?</label>
<select class="form-control" multiple name="resort_airport[]">
<?php if (!empty($airps)) { foreach ($airps as $airp) { ?>
<option value="<?php echo $airp['airport_airport_id']; ?>"><?php echo $airp['airport_name']; ?></option>
<?php } } ?>
</select>
</div>
</div>

</div>

</div>

<div class="col-md-6">

<div class="row">

<div class="col-sm-12">
<div class="form-group">
<div id="map-canvas"></div>
</div>
</div>

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

<input type="hidden" name="resort_lang_id" value="<?php echo $_GET['lang']; ?>">
<input type="hidden" name="resort_resort_id" value="<?php echo $new_res; ?>">

</form>

</div>

</div>

</div>

</section>

</div>

<?php include_once("../footer.php"); ?>

</div>

<?php include_once("../footer_scripts.php"); ?>

<script>
$('#id_hotel').change(function() {
var selval = $("#id_hotel option:selected").val();
if (selval == 1) {
$('#show_rel').hide();
}
if (selval == 2) {
$('#show_rel').show();
}
});

$( document ).ready(function() {

maplatlng = "38.981939, 35.480933";
var latlngStr = maplatlng.split(',', 2);
var lat = parseFloat(latlngStr[0]);
var lng = parseFloat(latlngStr[1]);
var geocoder = new google.maps.Geocoder();
var osman = "";

var latlng = new google.maps.LatLng(lat, lng);
var map = new google.maps.Map(document.getElementById('map-canvas'), {
center: latlng,
zoom: 7,
mapTypeId: google.maps.MapTypeId.ROADMAP
});
setTimeout(function(){$('#gps').val(lat + ', ' + lng);}, 1000);

var marker = new google.maps.Marker({position: latlng,map: map,title: 'adrese taşıyın',draggable: true});

google.maps.event.addListener(marker, 'dragend', function(a) {
var sonuc = a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4);
var latlngx = {lat: parseFloat(a.latLng.lat().toFixed(4)), lng: parseFloat(a.latLng.lng().toFixed(4))};
geocoder.geocode({'latLng': latlngx }, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {if (results[0]) { osman = results[0].formatted_address; }}
});
$('#gps').val(sonuc);
});

function placeMarker(location) {
if ( marker ) { marker.setPosition(location); } else {
marker = new google.maps.Marker({position: location,map: map,title: 'adrese taşıyın'});
}
}

google.maps.event.addListener(map, 'click', function(event) {
placeMarker(event.latLng);
var sonuc = event.latLng.lat().toFixed(4) + ', ' + event.latLng.lng().toFixed(4);
var latlngx = {lat: parseFloat(event.latLng.lat().toFixed(4)), lng: parseFloat(event.latLng.lng().toFixed(4))};
geocoder.geocode({'latLng': latlngx }, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {if (results[0]) { osman = results[0].formatted_address; }}
});
$('#gps').val(sonuc);
});

});

$(".editmodal").click(function() {

var airid = this.id;

var nuri  = '.gpsupdate'+airid;
var hale  = '#edit_'+airid;
var smap  = 'i_map_'+airid;
var sgps  = $(nuri).val();

maplatlngx = sgps;
var latlngStrx = maplatlngx.split(',', 2);
var latx = parseFloat(latlngStrx[0]);
var lngx = parseFloat(latlngStrx[1]);
var geocoderx = new google.maps.Geocoder();
var jale = "";

var latlngx = new google.maps.LatLng(latx, lngx);
var mapx = new google.maps.Map(document.getElementById(smap), {
center: latlngx,
zoom: 7,
mapTypeId: google.maps.MapTypeId.ROADMAP
});

setTimeout(function(){$(nuri).val(latx + ', ' + lngx);}, 1000);

var markerx = new google.maps.Marker({position: latlngx,map: mapx,title: 'adrese taşıyın',draggable: true});

google.maps.event.addListener(markerx, 'dragend', function(a) {
var sonuc = a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4);
var latlngy = {lat: parseFloat(a.latLng.lat().toFixed(4)), lng: parseFloat(a.latLng.lng().toFixed(4))};
geocoderx.geocode({'latLng': latlngy }, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {if (results[0]) { jale = results[0].formatted_address; }}
});
$(nuri).val(sonuc);
});

function placeMarkerx(location) {
if ( markerx ) { markerx.setPosition(location); } else {
markerx = new google.maps.Marker({position: location,map: mapx,title: 'adrese taşıyın'});
}
}

google.maps.event.addListener(mapx, 'click', function(event) {
placeMarkerx(event.latLng);
var sonuc = event.latLng.lat().toFixed(4) + ', ' + event.latLng.lng().toFixed(4);
var latlngy = {lat: parseFloat(event.latLng.lat().toFixed(4)), lng: parseFloat(event.latLng.lng().toFixed(4))};
geocoderx.geocode({'latLng': latlngy }, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {if (results[0]) { jale = results[0].formatted_address; }}
});
$(nuri).val(sonuc);
});

$(hale).on("shown.bs.modal", function () { google.maps.event.trigger(mapx, "resize"); });

});
</script>

</body>
</html>