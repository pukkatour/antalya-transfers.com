<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$lang_id = $_GET['lang_id'];
$data    = $Db->row("SELECT * FROM site_settings WHERE site_lang_id = ?", array($lang_id));

} else {

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
<li class="active">Genel Ayarlar</li>
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
<select class="form-control" name="lang_id" onchange="this.form.submit()">
<?php if (!empty($languagelist)) { foreach ($languagelist as $lang) { ?>
<option <?php if ($_GET['lang_id'] == $lang['lang_id']) { echo 'selected="selected"'; } ?> value="<?php echo $lang['lang_id']; ?>"><?php echo $lang['lang_name_eng']; ?></option>
<?php } } ?>
</select>
</div>
</div>
</form>

</div>
</div>

<div class="col-md-3">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Logo (245 x 40 px)</h3>
</div>

<a href="#" onclick="document.getElementById('file1').click()">
<img id="myimg1" src="" class="img-thumbnail">
</a>

<form name="foto1" id="foto1" enctype="multipart/form-data" method="POST" action="upload_logo.php">
<input type="file" id="file1" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="lang_id" value="<?php echo $data['site_lang_id']; ?>">
<script>document.getElementById("file1").onchange = function() { document.getElementById("foto1").submit(); };</script>
</form>

<script>
d = new Date();
$.ajax({
url:'<?php echo IMAGE_FOLDER."".$data['site_logo']; ?>',
type:'HEAD',
error: function() { $("#myimg1").attr("src", "<?php echo IMAGE_FOLDER; ?>no_photo.jpg?"+d.getTime()); },
success: function() {  $("#myimg1").attr("src", "<?php echo IMAGE_FOLDER."".$data['site_logo']; ?>?"+d.getTime()); }
});
</script>

</div>

</div>

<div class="col-md-3">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Favicon (60 x 60 px)</h3>
</div>

<a href="#" onclick="document.getElementById('file2').click()">
<img id="myimg2" src="" class="img-thumbnail">
</a>

<form name="foto2" id="foto2" enctype="multipart/form-data" method="POST" action="upload_favicon.php">
<input type="file" id="file2" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="lang_id" value="<?php echo $data['site_lang_id']; ?>">
<script>document.getElementById("file2").onchange = function() { document.getElementById("foto2").submit(); };</script>
</form>

<script>
d = new Date();
$.ajax({
url:'<?php echo IMAGE_FOLDER."".$data['site_favicon']; ?>',
type:'HEAD',
error: function() { $("#myimg2").attr("src", "<?php echo IMAGE_FOLDER; ?>no_photo.jpg?"+d.getTime()); },
success: function() {  $("#myimg2").attr("src", "<?php echo IMAGE_FOLDER."".$data['site_favicon']; ?>?"+d.getTime()); }
});
</script>

</div>

</div>

<div class="col-md-2">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Apple (400 x 400 px)</h3>
</div>

<a href="#" onclick="document.getElementById('file3').click()">
<img id="myimg3" src="" class="img-thumbnail">
</a>

<form name="foto3" id="foto3" enctype="multipart/form-data" method="POST" action="upload_apple.php">
<input type="file" id="file3" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="lang_id" value="<?php echo $data['site_lang_id']; ?>">
<script>document.getElementById("file3").onchange = function() { document.getElementById("foto3").submit(); };</script>
</form>

<script>
d = new Date();
$.ajax({
url:'<?php echo IMAGE_FOLDER."".$data['site_apple_logo']; ?>',
type:'HEAD',
error: function() { $("#myimg3").attr("src", "<?php echo IMAGE_FOLDER; ?>no_photo.jpg?"+d.getTime()); },
success: function() {  $("#myimg3").attr("src", "<?php echo IMAGE_FOLDER."".$data['site_apple_logo']; ?>?"+d.getTime()); }
});
</script>

</div>

</div>

</div>

<div class="row">

<div class="col-md-12">
<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Genel Ayarlar İçerik Düzenleme</h3>
</div>

<form method="POST" action="update.php">

<div class="box-body">

<div class="row">

<div class="col-md-12">
<div class="form-group">
<label>Site Adı ( 60 Karakter )</label>
<input type="text" class="form-control" name="site_name" value="<?php echo $data['site_name']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Site Başlığı ( OG Metatag için )</label>
<input type="text" class="form-control" name="site_title" value="<?php echo $data['site_title']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Site Açıklaması ( OG Metatag için )</label>
<input type="text" class="form-control" name="site_description" value="<?php echo $data['site_description']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Site Telefon Numarası</label>
<input type="text" class="form-control" name="site_phone" value="<?php echo $data['site_phone']; ?>" maxlength="20" onkeypress="return h_isNumber(event)" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Sistem Email Adresi</label>
<input type="email" class="form-control" name="site_contact_email" value="<?php echo $data['site_contact_email']; ?>" maxlength="150" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Sistem Email Şifresi</label>
<input type="text" class="form-control" name="site_contact_email_pass" value="<?php echo $data['site_contact_email_pass']; ?>" maxlength="150" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Footer Metni</label>
<input type="text" class="form-control" name="site_footer_text" value="<?php echo $data['site_footer_text']; ?>" maxlength="250" required="">
</div>
</div>

</div>

<hr>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Transfer Shuttle Gösterimi</label>
<select class="form-control" name="site_transfer_shuttle" required="">
<option <?php if ($data['site_transfer_shuttle'] == 1) { echo 'selected="selected"'; } ?> value="1">Hayır</option>
<option <?php if ($data['site_transfer_shuttle'] == 2) { echo 'selected="selected"'; } ?> value="2">Evet</option>
</select>
</div>
</div>

</div>

<hr>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Google Analytics Kodu</label>
<input type="text" class="form-control" name="site_analytics_code" value="<?php echo $data['site_analytics_code']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Google Webmasters Kodu</label>
<input type="text" class="form-control" name="site_google_webmasters_code" value="<?php echo $data['site_google_webmasters_code']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Bing Webmasters Kodu</label>
<input type="text" class="form-control" name="site_bing_webmasters_code" value="<?php echo $data['site_bing_webmasters_code']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Yandex Webmasters Kodu</label>
<input type="text" class="form-control" name="site_yandex_webmasters_code" value="<?php echo $data['site_yandex_webmasters_code']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Google Maps Key</label>
<input type="text" class="form-control" name="site_google_maps_key" value="<?php echo $data['site_google_maps_key']; ?>" maxlength="250">
</div>
</div>

</div>

<hr>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Facebook</label>
<input type="text" class="form-control" name="site_facebook" value="<?php echo $data['site_facebook']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Instagram</label>
<input type="text" class="form-control" name="site_instagram" value="<?php echo $data['site_instagram']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Twitter</label>
<input type="text" class="form-control" name="site_twitter" value="<?php echo $data['site_twitter']; ?>" maxlength="250">
</div>
</div>

</div>

<hr>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Şirket Adı</label>
<input type="text" class="form-control" name="site_company_name" value="<?php echo $data['site_company_name']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Adres 1</label>
<input type="text" class="form-control" name="site_address_1" value="<?php echo $data['site_address_1']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Adres 2</label>
<input type="text" class="form-control" name="site_address_2" value="<?php echo $data['site_address_2']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Telefon 1</label>
<input type="text" class="form-control" name="site_phone_1" value="<?php echo $data['site_phone_1']; ?>" maxlength="20" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Telefon 2</label>
<input type="text" class="form-control" name="site_phone_2" value="<?php echo $data['site_phone_2']; ?>" maxlength="20">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Email</label>
<input type="email" class="form-control" name="site_email" value="<?php echo $data['site_email']; ?>" maxlength="150" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>WhatssApp Numarası</label>
<input type="text" class="form-control" name="site_whatssapp" value="<?php echo $data['site_whatssapp']; ?>" maxlength="15" onkeypress="return h_isNumber(event)">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Tawk.to Chat Panel URL</label>
<input type="text" class="form-control" name="site_tawkto" value="<?php echo $data['site_tawkto']; ?>" maxlength="250">
</div>
</div>

</div>

<hr>

<div class="row">

<div class="col-lg-12">
<h5>SMS hizmeti kullanabilmeniz için NETGSM şirketinden hesap açıp, SMS kredisi yükleyip, SMS API hizmetini aktif etmeniz ve aşağıdaki bilgileri doldurmanız gerekmektedir.</h5>
</div>

<div class="col-md-4">
<div class="form-group">
<label>SMS Numarası</label>
<input type="text" class="form-control" name="site_sms_phone" value="<?php echo $data['site_sms_phone']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>SMS API Şifresi</label>
<input type="text" class="form-control" name="site_sms_pass" value="<?php echo $data['site_sms_pass']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>SMS Başlığı</label>
<input type="text" class="form-control" name="site_sms_title" value="<?php echo $data['site_sms_title']; ?>" maxlength="250">
</div>
</div>

</div>

<input type="hidden" name="site_id" value="<?php echo $data['site_id']; ?>">
<input type="hidden" name="site_lang_id" value="<?php echo $data['site_lang_id']; ?>">
<input type="hidden" id="gps" name="site_gps" value="<?php echo $data['site_gps']; ?>">

</div>

<div class="box-footer">
<button type="submit" class="btn btn-sm btn-primary pull-right">Güncelle</button>
</div>

</form>

</div>
</div>

</div>

<div class="row">

<div class="col-md-6">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Konum</h3>
</div>

<div class="box-body">
<div id="map-canvas2"></div>
</div>

</div>

</div>

</div>

</section>

</div>

<?php include_once("../footer.php"); ?>

</div>

<?php include_once("../footer_scripts.php"); ?>

<script>
$( document ).ready(function() {

maplatlng = "<?php echo $data['site_gps']; ?>";
var latlngStr = maplatlng.split(',', 2);
var lat = parseFloat(latlngStr[0]);
var lng = parseFloat(latlngStr[1]);
var geocoder = new google.maps.Geocoder();
var osman = "";

var latlng = new google.maps.LatLng(lat, lng);
var map = new google.maps.Map(document.getElementById('map-canvas2'), {
center: latlng,
zoom: 12,
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
</script>

</body>
</html>