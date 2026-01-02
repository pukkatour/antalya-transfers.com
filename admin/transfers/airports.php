<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$datas  = $Db->query("SELECT transfer_airports.*, agents.agent_id, agents.agent_person_company, agents.agent_agent_name, agents.agent_agent_surname, agents.agent_company_name FROM transfer_airports LEFT JOIN agents ON agents.agent_id = transfer_airports.airport_agent WHERE airport_lang_id = ?", array($_GET['lang']));
$agents = $Db->query("SELECT agent_id,agent_person_company,agent_agent_name,agent_agent_surname,agent_company_name FROM agents WHERE agent_status = ?", array('2'));

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
<li class="active">Havaalanları</li>
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
<h3 class="box-title">Havaalanları</h3>
</div>

<div class="box-body">

<table id="d_table" class="table table-striped table-hover table-bordered table-condensed">

<thead>
<tr>
<th>Havaalanı Adı</th>
<th>Satıcı</th>
<th>Kod</th>
<th>GPS</th>
<th>Shuttle</th>
<th>Ana Sayfa</th>
<th></th>
</tr>
</thead>

<tbody>
<?php if (!empty($datas)) { foreach ($datas as $data) { ?>
<tr>
<td><?php echo $data['airport_name']; ?></td>
<td>
<?php
if ($data['agent_person_company'] == 1) { echo $data['agent_agent_name']." ".$data['agent_agent_surname']; }
if ($data['agent_person_company'] == 2) { echo $data['agent_company_name']; }
?>
</td>
<td><?php echo $data['airport_code']; ?></td>
<td><?php echo $data['airport_geo']; ?></td>
<td>
<form action="airport_shuttle.php" method="POST">
<select class="form-control" name="show" onchange="this.form.submit()">
<option <?php if ($data['airport_shuttle'] == 1) { echo 'selected="selected"'; } ?> value="1">Hayır</option>
<option <?php if ($data['airport_shuttle'] == 2) { echo 'selected="selected"'; } ?> value="2">Evet</option>
</select>
<input type="hidden" name="airport_airport_id" value="<?php echo $data['airport_airport_id']; ?>">
</form>
</td>
<td>
<form action="airport_home_show.php" method="POST">
<select class="form-control" name="show" onchange="this.form.submit()">
<option <?php if ($data['airport_home_show'] == 0) { echo 'selected="selected"'; } ?> value="0">Hayır</option>
<option <?php if ($data['airport_home_show'] == 1) { echo 'selected="selected"'; } ?> value="1">Evet</option>
</select>
<input type="hidden" name="airport_airport_id" value="<?php echo $data['airport_airport_id']; ?>">
</form>
</td>
<td align="right">
<a href="#" data-toggle="modal" data-target="#myModal<?php echo $data['airport_id']; ?>" class="btn btn-sm btn-success editmodal" id="<?php echo $data['airport_id']; ?>">Düzenle</a> 
<a href="airport_remove.php?airport_airport_id=<?php echo $data['airport_airport_id']; ?>&airport_lang_id=<?php echo $_GET['lang']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istiyor musun?');">Sil</a>
</td>
</tr>


<div class="modal fade" id="myModal<?php echo $data['airport_id']; ?>" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Havaalanı Düzenleme</h4>
</div>

<div class="modal-body">
<div class="box-body">

<form id="edit_<?php echo $data['airport_id']; ?>" method="POST" action="airport_update.php">

<input type="hidden" name="airport_id" value="<?php echo $data['airport_id']; ?>">
<input type="hidden" name="airport_lang_id" value="<?php echo $data['airport_lang_id']; ?>">
<input type="hidden" name="airport_airport_id" value="<?php echo $data['airport_airport_id']; ?>">

<div class="form-group">
<label>Havaalanı Adı</label>
<input type="text" name="airport_name" class="form-control" value="<?php echo $data['airport_name']; ?>" maxlength="250" required="">
</div>

<div class="form-group">
<label>Kısa Kod</label>
<input type="text" name="airport_code" class="form-control" value="<?php echo $data['airport_code']; ?>" maxlength="5" required="">
</div>

<div class="form-group">
<label>Uydu Koordinatları</label>
<input type="text" name="airport_geo" class="form-control gpsupdate<?php echo $data['airport_id']; ?>" value="<?php echo $data['airport_geo']; ?>" maxlength="50" required="">
</div>

<div class="form-group">
<label>Satıcı Acenta</label>
<select class="form-control" name="airport_agent" required="">
<?php if (!empty($agents)) { foreach ($agents as $agent) { ?>
<option <?php if ($data['airport_agent'] == $agent['agent_id']) { echo 'selected="selected"'; } ?> value="<?php echo $agent['agent_id']; ?>">
<?php
if ($agent['agent_person_company'] == 1) { echo $agent['agent_agent_name']." ".$agent['agent_agent_surname']; }
if ($agent['agent_person_company'] == 2) { echo $agent['agent_company_name']; }
?>
</option>
<?php } } ?>
</select>
</div>

<div class="form-group">
<label>Shuttle Var mı?</label>
<select class="form-control" name="airport_shuttle" required="">
<option <?php if ($data['airport_shuttle'] == 1) { echo 'selected="selected"'; } ?> value="<?php echo $data['airport_shuttle']; ?>">Hayır</option>
<option <?php if ($data['airport_shuttle'] == 2) { echo 'selected="selected"'; } ?> value="<?php echo $data['airport_shuttle']; ?>">Evet</option>
</select>
</div>

<div class="form-group">
<label>Konum</label>
<div class="inner_map" id="i_map_<?php echo $data['airport_id']; ?>"></div>
</div>

</form>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Çık</button>
<button type="button" onclick="document.getElementById('edit_<?php echo $data['airport_id']; ?>').submit();" class="btn btn-primary">Kaydet</button>
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

<div class="box-body">

<form method="POST" action="airport_add_new.php">

<div class="row">

<div class="col-md-6">

<div class="row">

<div class="col-sm-12">
<div class="form-group">
<label>Türkçe Havaalanı Adı</label>
<input type="text" class="form-control" name="airport_name" maxlength="250" required="">
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label>Kısa Kod</label>
<input type="text" class="form-control" name="airport_code" maxlength="5" required="">
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label>Havaalanı Koordinatı</label>
<input type="text" class="form-control" name="airport_geo" id="gps" maxlength="50" required="">
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label>Satıcı Acenta</label>
<select class="form-control" name="airport_agent" required="">
<?php if (!empty($agents)) { foreach ($agents as $agent) { ?>
<option value="<?php echo $agent['agent_id']; ?>">
<?php
if ($agent['agent_person_company'] == 1) { echo $agent['agent_agent_name']." ".$agent['agent_agent_surname']; }
if ($agent['agent_person_company'] == 2) { echo $agent['agent_company_name']; }
?>
</option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label>Shuttle Var mı?</label>
<select class="form-control" name="airport_shuttle" required="">
<option value="1">Hayır</option>
<option value="2">Evet</option>
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

<div class="box-footer">
<button type="submit" class="btn btn-sm btn-primary pull-right">Kaydet</button>
</div>

<?php
$control = $Db->row("SELECT airport_airport_id FROM transfer_airports ORDER BY airport_airport_id DESC LIMIT ?", array('1'));
$new_air = $control['airport_airport_id'] + 1;
?>

<input type="hidden" name="airport_lang_id" value="<?php echo $_GET['lang']; ?>">
<input type="hidden" name="airport_airport_id" value="<?php echo $new_air; ?>">

</form>

</div>

</div>

</div>

</div>

</section>

</div>

<?php include_once("../footer.php"); ?>

</div>

<?php include_once("../footer_scripts.php"); ?>

<script>$(function () { $('#d_table').dataTable( {} ); });</script>

<script>
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