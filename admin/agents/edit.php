<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$agent = $Db->row("SELECT * FROM agents WHERE agent_id = ?", array($_GET['agent_id']));

if ($agent['agent_logo'] != NULL) { $gorsel = IMAGE_PATH."agents/".$agent['agent_logo']; } else { $gorsel = ""; }

} else {

redirect(SITE_URL.'admin/agents/index.php'); exit;

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
<li class="active">İlan Sahibi Düzenleme</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-8">

<div class="box box-info">

<form role="form" method="POST" action="update.php">

<div class="box-header with-border">
<h3 class="box-title">İlan Sahibi Bilgileri</h3>
</div>

<div class="box-body">

<div class="row">

<div class="col-md-3">
<div class="form-group">
<label>Şahıs / Firma</label>
<select class="form-control" name="agent_person_company" id="type_sel">
<option <?php if ($agent['agent_person_company'] == 1) { echo 'selected="selected"'; } ?> value="1">Şahıs</option>
<option <?php if ($agent['agent_person_company'] == 2) { echo 'selected="selected"'; } ?> value="2">Firma</option>
</select>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Durum</label>
<select class="form-control" name="agent_status">
<option <?php if ($agent['agent_status'] == 1) { echo 'selected="selected"'; } ?> value="1">Pasif</option>
<option <?php if ($agent['agent_status'] == 2) { echo 'selected="selected"'; } ?> value="2">Aktif</option>
</select>
</div>
</div>

</div>

<hr>

<div class="row" id="pers" style="display:none;">

<div class="col-md-4">
<div class="form-group">
<label>Şahıs Adı</label>
<input type="text" class="form-control h_firstcap" name="agent_agent_name" id="agent_agent_name" value="<?php echo $agent['agent_agent_name']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Şahıs Soyadı</label>
<input type="text" class="form-control h_firstcap" name="agent_agent_surname" id="agent_agent_surname" value="<?php echo $agent['agent_agent_surname']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Şahıs Emaili</label>
<input type="email" class="form-control" name="agent_agent_email" id="agent_agent_email" value="<?php echo $agent['agent_agent_email']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Şahıs Ülke</label>
<select name="agent_agent_country" id="agent_agent_country" class="form-control">
<option value="">Seçim Yapın</option>
<?php if (!empty($countrylist)) { foreach ($countrylist as $country) { ?>
<option <?php if ($agent['agent_agent_country'] == $country['country_id']) { echo 'selected="selected"'; } ?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']." ".$country['country_phone_code']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Şahıs Şehir</label>
<input type="text" class="form-control h_firstcap" name="agent_agent_city" id="agent_agent_city" value="<?php echo $agent['agent_agent_city']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Şahıs İlçe</label>
<input type="text" class="form-control h_firstcap" name="agent_agent_county" id="agent_agent_county" value="<?php echo $agent['agent_agent_county']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Şahıs Posta Kodu</label>
<input type="text" class="form-control" name="agent_agent_address_post_code" value="<?php echo $agent['agent_agent_address_post_code']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Şahıs Telefonu</label>
<input type="text" class="form-control" name="agent_agent_phone" id="agent_agent_phone" value="<?php echo $agent['agent_agent_phone']; ?>" maxlength="30" onkeypress="return h_isNumber(event)">
</div>
</div>

<div class="col-md-9">
<div class="form-group">
<label>Şahıs Adres</label>
<input type="text" class="form-control" name="agent_agent_address" value="<?php echo $agent['agent_agent_address']; ?>" maxlength="250">
</div>
</div>

</div>

<hr>

<div class="row" id="comp" style="display:none;">

<div class="col-md-12">
<div class="form-group">
<label>Şirket Adı</label>
<input type="text" class="form-control h_firstcap" name="agent_company_name" id="agent_company_name" value="<?php echo $agent['agent_company_name']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Ülke</label>
<select name="agent_company_address_country" id="agent_company_address_country" class="form-control">
<option value="">Seçim Yapın</option>
<?php if (!empty($countrylist)) { foreach ($countrylist as $country) { ?>
<option <?php if ($agent['agent_company_address_country'] == $country['country_id']) { echo 'selected="selected"'; } ?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']." ".$country['country_phone_code']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Şirket Şehir</label>
<input type="text" class="form-control h_firstcap" name="agent_company_address_city" id="agent_company_address_city" value="<?php echo $agent['agent_company_address_city']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Şirket İlçe</label>
<input type="text" class="form-control h_firstcap" name="agent_company_address_county" id="agent_company_address_county" value="<?php echo $agent['agent_company_address_county']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Şirket Posta Kodu</label>
<input type="text" class="form-control" name="agent_company_address_post_code" value="<?php echo $agent['agent_company_address_post_code']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Şirket Adres</label>
<input type="text" class="form-control" name="agent_company_address" value="<?php echo $agent['agent_company_address']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Şirket Telefonu</label>
<input type="text" class="form-control" name="agent_company_phone" id="agent_company_phone" value="<?php echo $agent['agent_company_phone']; ?>" maxlength="30" onkeypress="return h_isNumber(event)">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Şirket Vergi Dairesi</label>
<input type="text" class="form-control h_firstcap" name="agent_company_tax_office" value="<?php echo $agent['agent_company_tax_office']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Şirket Vergi Numarası</label>
<input type="text" class="form-control" name="agent_company_tax_number" value="<?php echo $agent['agent_company_tax_number']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Şirket Email Adresi</label>
<input type="email" class="form-control" name="agent_company_email" value="<?php echo $agent['agent_company_email']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Şirket Web URL</label>
<input type="text" class="form-control" name="agent_company_web_url" value="<?php echo $agent['agent_company_web_url']; ?>" maxlength="250">
</div>
</div>

</div>

<hr>

<div class="row">

<div class="col-md-4">
<div class="form-group">
<label>1. Yetkili Ad</label>
<input type="text" class="form-control h_firstcap" name="agent_person1_name" value="<?php echo $agent['agent_person1_name']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>1. Yetkili Soyad</label>
<input type="text" class="form-control h_firstcap" name="agent_person1_surname" value="<?php echo $agent['agent_person1_surname']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>1. Yetkili Email</label>
<input type="email" class="form-control" name="agent_person1_email" value="<?php echo $agent['agent_person1_email']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>1. Yetkili Ülke</label>
<select name="agent_person1_country" class="form-control">
<option value="">Seçim Yapın</option>
<?php if (!empty($countrylist)) { foreach ($countrylist as $country) { ?>
<option <?php if ($agent['agent_person1_country'] == $country['country_id']) { echo 'selected="selected"'; } ?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']." ".$country['country_phone_code']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>1. Yetkili Telefon</label>
<input type="text" class="form-control" name="agent_person1_phone" value="<?php echo $agent['agent_person1_phone']; ?>" maxlength="30" onkeypress="return h_isNumber(event)">
</div>
</div>

</div>

<hr>

<div class="row">

<div class="col-md-4">
<div class="form-group">
<label>2. Yetkili Ad</label>
<input type="text" class="form-control h_firstcap" name="agent_person2_name" value="<?php echo $agent['agent_person2_name']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>2. Yetkili Soyad</label>
<input type="text" class="form-control h_firstcap" name="agent_person2_surname" value="<?php echo $agent['agent_person2_surname']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>2. Yetkili Email</label>
<input type="email" class="form-control" name="agent_person2_email" value="<?php echo $agent['agent_person2_email']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>2. Yetkili Ülke</label>
<select name="agent_person2_country" class="form-control">
<option value="">Seçim Yapın</option>
<?php if (!empty($countrylist)) { foreach ($countrylist as $country) { ?>
<option <?php if ($agent['agent_person2_country'] == $country['country_id']) { echo 'selected="selected"'; } ?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']." ".$country['country_phone_code']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>2. Yetkili Telefon</label>
<input type="text" class="form-control" name="agent_person2_phone" value="<?php echo $agent['agent_person2_phone']; ?>" maxlength="30" onkeypress="return h_isNumber(event)">
</div>
</div>

</div>

<hr>

<div class="row">

<div class="col-md-4">
<div class="form-group">
<label>3. Yetkili Ad</label>
<input type="text" class="form-control h_firstcap" name="agent_person3_name" value="<?php echo $agent['agent_person3_name']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>3. Yetkili Soyad</label>
<input type="text" class="form-control h_firstcap" name="agent_person3_surname" value="<?php echo $agent['agent_person3_surname']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>3. Yetkili Email</label>
<input type="email" class="form-control" name="agent_person3_email" value="<?php echo $agent['agent_person3_email']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>3. Yetkili Ülke</label>
<select name="agent_person3_country" class="form-control">
<option value="">Seçim Yapın</option>
<?php if (!empty($countrylist)) { foreach ($countrylist as $country) { ?>
<option <?php if ($agent['agent_person3_country'] == $country['country_id']) { echo 'selected="selected"'; } ?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']." ".$country['country_phone_code']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>3. Yetkili Telefon</label>
<input type="text" class="form-control" name="agent_person3_phone" value="<?php echo $agent['agent_person3_phone']; ?>" maxlength="30" onkeypress="return h_isNumber(event)">
</div>
</div>

</div>

<hr>

<div class="row">

<div class="col-md-12">
<div class="form-group">
<label>Açıklama</label>
<textarea rows="2" class="form-control" name="agent_text"><?php echo $agent['agent_text']; ?></textarea>
</div>
</div>

</div>

</div>

<div class="box-footer">
<button type="submit" class="btn btn-primary pull-right">Güncelle</button>
</div>

<input type="hidden" name="agent_id" value="<?php echo $agent['agent_id']; ?>">

</form>

</div>

</div>

<div class="col-md-4">

<form role="form" method="POST" action="bank_update.php">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Banka Hesap Bilgileri</h3>
</div>

<div class="box-body">

<div class="row">

<div class="col-md-12">
<div class="form-group">
<label>Döviz Cinsi</label>
<select class="form-control" name="agent_bank_curr" required="">
<?php if (!empty($currencylist)) { foreach ($currencylist as $currency) {?>
<option <?php if ($currency['curr_id'] == $agent['agent_bank_curr']) { echo 'selected="selected"'; } ?> value="<?php echo $currency['curr_id']; ?>"><?php echo $currency['curr_code']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Hesap Adı</label>
<input type="text" class="form-control" name="agent_bank_account" value="<?php echo $agent['agent_bank_account']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Banka Adı</label>
<input type="text" class="form-control" name="agent_bank_name" value="<?php echo $agent['agent_bank_name']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Şube Adı</label>
<input type="text" class="form-control" name="agent_bank_branch" value="<?php echo $agent['agent_bank_branch']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>SWIFT Kodu</label>
<input type="text" class="form-control" name="agent_bank_swift" value="<?php echo $agent['agent_bank_swift']; ?>" maxlength="50" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>IBAN</label>
<input type="text" class="form-control iban" name="agent_bank_iban" value="<?php echo $agent['agent_bank_iban']; ?>" maxlength="250" required="">
</div>
</div>

</div>

</div>

<div class="box-footer">
<button type="submit" class="btn btn-primary pull-right">Güncelle</button>
</div>

</div>

<input type="hidden" name="agent_id" value="<?php echo $agent['agent_id']; ?>">

</form>

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Kapak Fotoğrafı (700 x 500 px)</h3>
</div>

<a href="#" onclick="document.getElementById('file1').click()">
<img src="<?php if (file_exists($gorsel)) { echo IMAGE_FOLDER."agents/".$agent['agent_logo']."?".date_timestamp_get(date_create()); } else { echo IMAGE_FOLDER."no_photo.jpg"; } ?>" class="img-thumbnail">
</a>

<form name="foto1" id="foto1" enctype="multipart/form-data" method="POST" action="logo_upload.php">
<input type="file" id="file1" name="my_field" accept="image/*" style="display: none;" onchange="javascript:this.form.submit();">
<input type="hidden" name="id" value="<?php echo $agent['agent_id']; ?>">
<script>document.getElementById("file1").onchange = function() { document.getElementById("foto1").submit(); };</script>
</form>

</div>

</div>

</div>

</section>

</div>

<?php include_once("../footer.php"); ?>

</div>

<?php include_once("../footer_scripts.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
$( document ).ready(function() {
var select = $("select#type_sel option:selected").attr('value');
if (select == '1') { $("#pers").show(); }
if (select == '2') { $("#comp").show(); }
});

$("select#type_sel").change(function() {
var sel = $("select#type_sel option:selected").attr('value');

if (sel == '1') {

$("#comp").hide("slow");
$("#pers").show("slow");

$("#agent_agent_name").prop('required',true);
$("#agent_agent_surname").prop('required',true);
$("#agent_agent_email").prop('required',true);
$("#agent_agent_country").prop('required',true);
$("#agent_agent_city").prop('required',true);
$("#agent_agent_county").prop('required',true);
$("#agent_agent_phone").prop('required',true);

$("#agent_company_name").prop('required',false);
$("#agent_company_address_country").prop('required',false);
$("#agent_company_address_city").prop('required',false);
$("#agent_company_address_county").prop('required',false);
$("#agent_company_phone").prop('required',false);

}

if (sel == '2') {

$("#pers").hide("slow");
$("#comp").show("slow");

$("#agent_company_name").prop('required',true);
$("#agent_company_address_country").prop('required',true);
$("#agent_company_address_city").prop('required',true);
$("#agent_company_address_county").prop('required',true);
$("#agent_company_phone").prop('required',true);

$("#agent_agent_name").prop('required',false);
$("#agent_agent_surname").prop('required',false);
$("#agent_agent_email").prop('required',false);
$("#agent_agent_country").prop('required',false);
$("#agent_agent_city").prop('required',false);
$("#agent_agent_county").prop('required',false);
$("#agent_agent_phone").prop('required',false);

}

});

<?php
if (!empty($_GET['error'])) {
if ($_GET['error'] == "email1") { echo 'swal("Hata!", "Ev sahibi email adresi hatalı yazıldı!...", "error");'; }
if ($_GET['error'] == "email2") { echo 'swal("Hata!", "Şirket email adresi hatalı yazıldı!...", "error");'; }
if ($_GET['error'] == "email3") { echo 'swal("Hata!", "1. Yetkili email adresi hatalı yazıldı!...", "error");'; }
if ($_GET['error'] == "email4") { echo 'swal("Hata!", "2. Yetkili email adresi hatalı yazıldı!...", "error");'; }
if ($_GET['error'] == "email5") { echo 'swal("Hata!", "3. Yetkili email adresi hatalı yazıldı!...", "error");'; }
} ?>

$(document).ready(function() {
$('.iban').mask('SS00 0000 0000 0000 0000 0000 0000 0000 00', {
placeholder: '____ ____ ____ ____ ____ ____ ____ ____ __'
});
});
</script>

</body>
</html>