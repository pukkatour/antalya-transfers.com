<?php
include_once('site_id.php');
include_once('../admin/include/initialize.inc.php');

$data = $Db->row("SELECT * FROM page_contact_us WHERE page_lang_id = ?", array($site_lang));

$pagename = "İletişim";
include_once("../hit_counter.php");

include("../admin/include/captcha/captcha.php");
$_SESSION['captcha'] = simple_php_captcha();

?>

<!DOCTYPE html>
<html lang="tr">

<head>

<title><?php echo $data['page_title']; ?></title>
<meta name="description" content="<?php echo $data['page_description']; ?>">
<meta name="keywords" content="<?php echo $data['page_keywords']; ?>">

<?php include_once("../head_meta.php"); ?>

<link rel="alternate" href="<?php echo SITE_URL; ?>contact-us" hreflang="en-US" />

</head>

<body>

<?php include_once("head_menu.php"); ?>

<div class="more-features-container section-container">
<div class="container">

<div class="row">
<div class="col-sm-12 more-features section-description wow fadeIn">
<h1><?php echo $data['page_name']; ?></h1>
<div class="divider-1"><div class="line"></div></div>
</div>
</div>

<div class="row">

<div class="col-lg-4">
<i class="fa fa-phone contact-icons" aria-hidden="true"></i>
<h3><?php echo $data['page_title1']; ?></h3>
<p><?php echo $data['page_text1']; ?></p>
<p><a class="btn btn-default" href="tel:<?php echo str_replace(' ', '', $sitesettings['site_phone_1']); ?>" role="button" title="<?php echo $sitesettings['site_name']; ?>"><?php echo $data['page_button1']; ?></a></p>
</div>

<div class="col-lg-4">
<i class="fa fa-envelope contact-icons" aria-hidden="true"></i>
<h3><?php echo $data['page_title2']; ?></h3>
<p><?php echo $data['page_text2']; ?></p>
<p><a class="btn btn-default" href="mailto:<?php echo $sitesettings['site_email']; ?>" target="_top" title="<?php echo $sitesettings['site_name']; ?>"><?php echo $data['page_button2']; ?></a></p>
</div>

<div class="col-lg-4">
<i class="fa fa-map-marker contact-icons" aria-hidden="true"></i>
<h3><?php echo $data['page_title3']; ?></h3>
<p><?php echo $data['page_text3']; ?></p>
<p><a class="btn btn-default" href="https://maps.google.com/?daddr=<?php echo str_replace(' ', '', $sitesettings['site_gps']); ?>" role="button" target="_blank" title="<?php echo $sitesettings['site_name']; ?>"><?php echo $data['page_button3']; ?></a></p>
</div>

</div>

<br>
<hr>

</div>
</div>

<div class="more-features-container section-container section-container-gray-bg">
<div class="container">

<div class="row">

<h4 class="padding-top-form"><?php echo $data['page_form_title']; ?></h4>

<div class="col-md-8 col-md-push-2 text-left">

<form id='contact_form'>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label><?php echo $data['page_form_name']; ?></label>
<input type="text" class="form-control h_firstcap b-form" placeholder="<?php echo $data['page_form_type_name']; ?>" name="message_name" minlength="2" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label><?php echo $data['page_form_surname']; ?></label>
<input type="text" class="form-control h_firstcap b-form" placeholder="<?php echo $data['page_form_type_surname']; ?>" name="message_surname" minlength="2" required="">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label><?php echo $data['page_form_email']; ?></label>
<input type="email" class="form-control b-form" placeholder="<?php echo $data['page_form_type_email']; ?>" name="message_email" minlength="6" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label><?php echo $data['page_form_country']; ?></label>
<select class='form-control b-form' name='message_country' required="">
<option value=""><?php echo $data['page_form_type_country']; ?></option>
<?php if (!empty($countrylist)) { foreach ($countrylist as $country) { ?>
<option <?php if ($country['country_id'] == 224) { echo 'selected="selected"'; } ?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_phone_code']." ".$country['country_name']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label><?php echo $data['page_form_phone']; ?></label>
<input type="text" class="form-control b-form" placeholder="<?php echo $data['page_form_type_phone']; ?>" name="message_phone" minlength="6" required="" onkeypress="return h_isNumber(event)">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label><?php echo $data['page_form_subject']; ?></label>
<input type="text" class="form-control b-form" placeholder="<?php echo $data['page_form_type_subject']; ?>" name="message_title" required="" minlength="4">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label><?php echo $data['page_form_message']; ?></label>
<textarea rows="3" class="form-control b-form" placeholder="<?php echo $data['page_form_type_message']; ?>" name="message_text" required="" minlength="20"></textarea>
</div>
</div>

</div>


<div class="row">
<div class="col-xs-5 col-sm-5 col-md-4 col-lg-4">
<div class="form-group">
<?php echo '<img src="'.$_SESSION['captcha']['image_src'].'" alt="'.$sitesettings['site_name'].'">'; ?>
</div>
</div>

<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 mtop20">
<div class="form-group">
<input type="text" class="form-control b-form margin-top20" id="verify" name="verify" placeholder="<?php echo $data['page_form_code']; ?>" required="">
</div>
</div>

<div class="col-xs-3 col-sm-3 col-md-4 col-lg-4 mtop20">
<div class="form-group">
<button type="submit" class="btn btn-warning bnt-block"><?php echo $data['page_form_send']; ?></button>
</div>
</div>
</div>

</form>

</div>

</div>

</div>
</div>

<?php include_once("footer.php"); ?>

<?php include_once("../footer_scripts.php"); ?>

<script>
$("#contact_form").submit(function( event ) {
event.preventDefault();
$.ajax({
url:  "<?php echo SITE_URL; ?>admin/include/captcha/capcontrol.php",
type: 'GET',
data: { field: $('#verify').val() },
success: function(response){

if(response == 2){ swal("", "<?php echo $data['page_form_wrong_code']; ?>", "info"); }

if(response == 1){
$.ajax({
url: "<?php echo SITE_URL; ?>send_contact.php",
type: 'POST',
data: $('#contact_form').serialize(),
success: function(response){ 
if (response === "success") { swal("", "<?php echo $data['page_form_success']; ?>", "success"); $("#contact_form")[0].reset(); }
if (response === "problem") { swal("", "<?php echo $data['page_form_error']; ?>", "info"); }
if (response === "name") { swal("", "<?php echo $data['page_form_short_name']; ?>", "info"); }
if (response === "surname") { swal("", "<?php echo $data['page_form_short_surname']; ?>", "info"); }
if (response === "email") { swal("", "<?php echo $data['page_form_short_email']; ?>", "info"); }
if (response === "phone") { swal("", "<?php echo $data['page_form_short_phone']; ?>", "info"); }
if (response === "title") { swal("", "<?php echo $data['page_form_short_subject']; ?>", "info"); }
if (response === "message") { swal("", "<?php echo $data['page_form_short_message']; ?>", "info"); }
}
});
}

}

});
});
</script>

</body>

</html>

<?php ob_end_flush(); ?>