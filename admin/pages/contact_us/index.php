<?php
include_once('../../include/site_id.php');
include_once('../../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$lang_id = $_GET['lang_id'];
$data    = $Db->row("SELECT * FROM page_contact_us WHERE page_lang_id = ?", array($lang_id));

} else {

redirect(SITE_URL."admin/index.php"); exit;

}

?>

<!DOCTYPE html>
<html lang="tr">

<?php include_once("../../head_meta.php"); ?>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

<?php include_once("../../header.php"); ?>

<?php include_once("../../left_menu.php"); ?>

<div class="content-wrapper">

<section class="content-header">
<h1>Yönetim Paneli<small>Version 1.2</small></h1>
<ol class="breadcrumb">
<li><a href="<?php echo SITE_URL."admin/index.php"; ?>"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
<li class="active">İletişim Sayfası</li>
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

</div>

<div class="row">

<div class="col-md-12">
<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">İletişim Sayfası İçerik Düzenleme</h3>
</div>

<form method="POST" action="update.php">

<div class="box-body">

<div class="row">

<div class="col-md-12">
<div class="form-group">
<label>Sayfa Başlığı (Maks. 150 Karakter)</label>
<input type="text" class="form-control" name="page_title" value="<?php echo $data['page_title']; ?>" maxlength="150" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Sayfa Açıklaması (Maks. 250 Karakter)</label>
<input type="text" class="form-control" name="page_description" value="<?php echo $data['page_description']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Sayfa Keywordleri (Maks. 250 Karakter, virgül ile ayrılmış bitişik)</label>
<input type="text" class="form-control" name="page_keywords" value="<?php echo $data['page_keywords']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Sayfa Adı (Maks. 60 Karakter)</label>
<input type="text" class="form-control" name="page_name" value="<?php echo $data['page_name']; ?>" maxlength="250" required="">
</div>
</div>

</div>

<hr>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>1. Kutu 1. Satır</label>
<input type="text" class="form-control" name="page_title1" value="<?php echo $data['page_title1']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>1. Kutu 2. Satır</label>
<input type="text" class="form-control" name="page_text1" value="<?php echo $data['page_text1']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>1. Kutu Buton</label>
<input type="text" class="form-control" name="page_button1" value="<?php echo $data['page_button1']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>2. Kutu 1. Satır</label>
<input type="text" class="form-control" name="page_title2" value="<?php echo $data['page_title2']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>2. Kutu 2. Satır</label>
<input type="text" class="form-control" name="page_text2" value="<?php echo $data['page_text2']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>2. Kutu Buton</label>
<input type="text" class="form-control" name="page_button2" value="<?php echo $data['page_button2']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>3. Kutu 1. Satır</label>
<input type="text" class="form-control" name="page_title3" value="<?php echo $data['page_title3']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>3. Kutu 2. Satır</label>
<input type="text" class="form-control" name="page_text3" value="<?php echo $data['page_text3']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>3. Kutu Buton</label>
<input type="text" class="form-control" name="page_button3" value="<?php echo $data['page_button3']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Form Yazısı</label>
<input type="text" class="form-control" name="page_form_title" value="<?php echo $data['page_form_title']; ?>" maxlength="250">
</div>
</div>

</div>

<hr>

<div class="row">

<div class="col-md-4">
<div class="form-group">
<label>* Ad</label>
<input type="text" class="form-control" name="page_form_name" value="<?php echo $data['page_form_name']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>* Soyad</label>
<input type="text" class="form-control" name="page_form_surname" value="<?php echo $data['page_form_surname']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>* Email</label>
<input type="text" class="form-control" name="page_form_email" value="<?php echo $data['page_form_email']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>* Ülke</label>
<input type="text" class="form-control" name="page_form_country" value="<?php echo $data['page_form_country']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>* Telefon</label>
<input type="text" class="form-control" name="page_form_phone" value="<?php echo $data['page_form_phone']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>* Konu</label>
<input type="text" class="form-control" name="page_form_subject" value="<?php echo $data['page_form_subject']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>* Mesaj</label>
<input type="text" class="form-control" name="page_form_message" value="<?php echo $data['page_form_message']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>* Güvenlik Kodu</label>
<input type="text" class="form-control" name="page_form_code" value="<?php echo $data['page_form_code']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>* Gönder</label>
<input type="text" class="form-control" name="page_form_send" value="<?php echo $data['page_form_send']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Lütfen adınızı yazın</label>
<input type="text" class="form-control" name="page_form_type_name" value="<?php echo $data['page_form_type_name']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Lütfen soyadınızı yazın</label>
<input type="text" class="form-control" name="page_form_type_surname" value="<?php echo $data['page_form_type_surname']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Lütfen email adresinizi yazın</label>
<input type="text" class="form-control" name="page_form_type_email" value="<?php echo $data['page_form_type_email']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Lütfen ülkenizi seçin</label>
<input type="text" class="form-control" name="page_form_type_country" value="<?php echo $data['page_form_type_country']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Lütfen telefon numaranızı yazın</label>
<input type="text" class="form-control" name="page_form_type_phone" value="<?php echo $data['page_form_type_phone']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Lütfen konu başlığını yazın</label>
<input type="text" class="form-control" name="page_form_type_subject" value="<?php echo $data['page_form_type_subject']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Lütfen mesajınızı yazın</label>
<input type="text" class="form-control" name="page_form_type_message" value="<?php echo $data['page_form_type_message']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Teşekkürler, mesajınız iletildi</label>
<input type="text" class="form-control" name="page_form_success" value="<?php echo $data['page_form_success']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Üzgünüz, bir hata oluştu</label>
<input type="text" class="form-control" name="page_form_error" value="<?php echo $data['page_form_error']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Hatalı güvenlik kodu</label>
<input type="text" class="form-control" name="page_form_wrong_code" value="<?php echo $data['page_form_wrong_code']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Adınız eksik veya çok kısa</label>
<input type="text" class="form-control" name="page_form_short_name" value="<?php echo $data['page_form_short_name']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Soyadınız eksik veya çok kısa</label>
<input type="text" class="form-control" name="page_form_short_surname" value="<?php echo $data['page_form_short_surname']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Email adresiniz eksik veya hatalı</label>
<input type="text" class="form-control" name="page_form_short_email" value="<?php echo $data['page_form_short_email']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Telefon numaranız eksik veya hatalı</label>
<input type="text" class="form-control" name="page_form_short_phone" value="<?php echo $data['page_form_short_phone']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Konu çok kısa</label>
<input type="text" class="form-control" name="page_form_short_subject" value="<?php echo $data['page_form_short_subject']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Mesajınız çok kısa</label>
<input type="text" class="form-control" name="page_form_short_message" value="<?php echo $data['page_form_short_message']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Email - İletişim Formu</label>
<input type="text" class="form-control" name="page_email_title" value="<?php echo $data['page_email_title']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Email - Merhaba</label>
<input type="text" class="form-control" name="page_email_hello" value="<?php echo $data['page_email_hello']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Email - Email metni</label>
<input type="text" class="form-control" name="page_email_text" value="<?php echo $data['page_email_text']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Email - Ad Soyad</label>
<input type="text" class="form-control" name="page_email_name" value="<?php echo $data['page_email_name']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Email - Email adresiniz</label>
<input type="text" class="form-control" name="page_email_email" value="<?php echo $data['page_email_email']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Email - Telefon numaranız</label>
<input type="text" class="form-control" name="page_email_phone" value="<?php echo $data['page_email_phone']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Email - IP adresiniz</label>
<input type="text" class="form-control" name="page_email_ip" value="<?php echo $data['page_email_ip']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Email - İşlem tarihi</label>
<input type="text" class="form-control" name="page_email_date" value="<?php echo $data['page_email_date']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Email - Mesaj Konusu</label>
<input type="text" class="form-control" name="page_email_subject" value="<?php echo $data['page_email_subject']; ?>" maxlength="250">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>* Email - Mesajınız</label>
<input type="text" class="form-control" name="page_email_message" value="<?php echo $data['page_email_message']; ?>" maxlength="250">
</div>
</div>

</div>

<input type="hidden" name="page_id" value="<?php echo $data['page_id']; ?>">
<input type="hidden" name="page_lang_id" value="<?php echo $data['page_lang_id']; ?>">

</div>

<div class="box-footer">
<button type="submit" class="btn btn-sm btn-primary pull-right">Güncelle</button>
</div>

</form>

</div>
</div>

</div>

</section>

</div>

<?php include_once("../../footer.php"); ?>

</div>

<?php include_once("../../footer_scripts.php"); ?>

</body>
</html>