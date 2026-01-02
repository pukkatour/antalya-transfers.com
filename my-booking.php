<?php
include_once('site_id.php');
include_once('admin/include/initialize.inc.php');

$data = $Db->row("SELECT * FROM page_my_booking WHERE page_lang_id = ?", array($site_lang));

$pagename = $data['page_name'];
include_once("hit_counter.php");

include("admin/include/captcha/captcha.php");
$_SESSION['captcha'] = simple_php_captcha();

?>

<!DOCTYPE html>
<html lang="en">

<head>

<title><?php echo $data['page_title']; ?></title>
<meta name="description" content="<?php echo $data['page_description']; ?>">
<meta name="keywords" content="<?php echo $data['page_keywords']; ?>">

<?php include_once("head_meta.php"); ?>

<link rel="alternate" href="<?php echo SITE_URL; ?>tr/rezervasyonum" hreflang="tr-TR" />

</head>

<body>

<?php include_once("head_menu.php"); ?>

<div class="more-features-container section-container">
<div class="container">

<div class="row">
<div class="col-sm-12 more-features section-description wow fadeIn">
<h1><?php echo $data['page_name']; ?></h1>
<div class="divider-1"><div class="line"></div></div>
<p class="medium-paragraph"><?php echo $data['page_main_title']; ?></p>
</div>
</div>

<div class="row">

<div class="col-sm-12 more-features-box wow fadeInLeft">

<div class="more-features-box-text">
<div class="more-features-box-text-description"><?php echo $data['page_main_text']; ?></div>
</div>

</div>

</div>

</div>
</div>

<div class="more-features-container section-container section-container-gray-bg" id="hide_details">
<div class="container">

<div class="row">

<div class="col-md-8 col-md-push-2 text-left padtop30">

<form id='control_form'>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label><?php echo $translate['tr_078']; ?></label>
<input type="email" class="form-control b-form" placeholder="<?php echo $translate['tr_078']; ?>" name="my_email" minlength="6" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label><?php echo $translate['tr_079']; ?></label>
<input type="text" class="form-control h_firstcap b-form" placeholder="<?php echo $translate['tr_079']; ?>" name="my_code" minlength="2" required="">
</div>
</div>

</div>

<div class="row">

<div class="col-xs-6 col-sm-5 col-md-4 col-lg-4">
<div class="form-group">
<?php echo '<img src="'.$_SESSION['captcha']['image_src'].'" alt="'.$sitesettings['site_name'].'">'; ?>
</div>
</div>

<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4 mtop20">
<div class="form-group">
<input type="text" class="form-control b-form margin-top20" id="verify" name="verify" placeholder="<?php echo $translate['tr_055']; ?>" required="">
</div>
</div>

<div class="col-xs-12 col-sm-3 col-md-4 col-lg-4 mtop20">
<div class="form-group">
<button type="submit" class="btn btn-warning btn-block"><?php echo $translate['tr_080']; ?></button>
</div>
</div>

</div>

</form>

</div>

</div>

</div>
</div>

<div class="more-features-container section-container dispno" id="show_details">
<div class="container">

<div class="row">

<div class="col-sm-12 more-features-box wow fadeInLeft">

<div class="more-features-box-text">
<div class="more-features-box-text-description"><?php echo $translate['tr_081']; ?></div>
</div>

<table class="table table-hover table-bordered table-striped">
<tr>
<td class="text-left btncezmi"><?php echo $translate['tr_030']; ?></td>
<td id="b_name" class="text-right"></td>
<td class="text-left btncezmi"><?php echo $translate['tr_031']; ?></td>
<td id="b_email" class="text-right"></td>
</tr>
<tr>
<td class="text-left btncezmi"><?php echo $translate['tr_036']; ?></td>
<td id="b_phone" class="text-right"></td>
<td class="text-left btncezmi"><?php echo $translate['tr_090']; ?></td>
<td id="b_address" class="text-right"></td>
</tr>
<tr>
<td colspan="2" class="text-left btncezmi"><?php echo $translate['tr_054']; ?></td>
<td colspan="2" id="b_note" class="text-right"></td>
</tr>
<tr>
<td class="text-left btncezmi"><?php echo $translate['tr_087']; ?></td>
<td id="b_date" class="text-right"></td>
<td class="text-left btncezmi"><?php echo $translate['tr_088']; ?></td>
<td id="b_code" class="text-right"></td>
</tr>
<tr>
<td class="text-left btncezmi"><?php echo $translate['tr_003']; ?></td>
<td id="b_shared" class="text-right"></td>
<td class="text-left btncezmi"><?php echo $translate['tr_006']; ?></td>
<td id="b_from_to" class="text-right"></td>
</tr>
<tr>
<td class="text-left btncezmi"><?php echo $translate['tr_009']; ?></td>
<td id="b_airport" class="text-right"></td>
<td class="text-left btncezmi"><?php echo $translate['tr_011']; ?></td>
<td id="b_resort" class="text-right"></td>
</tr>
<tr>
<td class="text-left btncezmi"><?php echo $translate['tr_014']; ?></td>
<td id="b_pax" class="text-right"></td>
<td class="text-left btncezmi"><?php echo $translate['tr_089']; ?></td>
<td id="b_vehicle" class="text-right"></td>
</tr>
<tr>
<td class="text-left btncezmi"><?php echo $translate['tr_038']; ?></td>
<td id="b_a_f_no" class="text-right"></td>
<td class="text-left btncezmi"><?php echo $translate['tr_039']; ?></td>
<td id="b_a_f_date" class="text-right"></td>
</tr>
<tr>
<td class="text-left btncezmi"><?php echo $translate['tr_043']; ?></td>
<td id="b_d_f_no" class="text-right"></td>
<td class="text-left btncezmi"><?php echo $translate['tr_044']; ?></td>
<td id="b_d_f_date" class="text-right"></td>
</tr>
<tr>
<td class="text-left btncezmi"><?php echo $translate['tr_047']; ?></td>
<td id="b_d_f_pick" class="text-right"></td>
<td class="text-left btncezmi"><?php echo $translate['tr_018']; ?></td>
<td id="b_type" class="text-right"></td>
</tr>
<tr>
<td class="text-left btncezmi"><?php echo $translate['tr_051']; ?></td>
<td id="b_bseat" class="text-right"></td>
<td class="text-left btncezmi"><?php echo $translate['tr_052']; ?></td>
<td id="b_cseat" class="text-right"></td>
</tr>
<tr>
<td colspan="2" class="text-left btncezmi"><?php echo $translate['tr_002']; ?></td>
<td colspan="2" class="text-right" id="b_price"></td>
</tr>
</table>

</div>

</div>

</div>
</div>

<?php include_once("footer.php"); ?>

<?php include_once("footer_scripts.php"); ?>

<script>
$("#control_form").submit(function( event ) {
event.preventDefault();
$.ajax({
url:  "<?php echo SITE_URL; ?>admin/include/captcha/capcontrol.php",
type: 'GET',
data: { field: $('#verify').val() },
success: function(response){

if(response == 2){ swal("<?php echo $translate['tr_060']; ?>", "<?php echo $translate['tr_057']; ?>", "info"); }

if(response == 1){
$.ajax({
url: "<?php echo SITE_URL; ?>check_booking.php",
type: 'POST',
data: $('#control_form').serialize(),
success: function(data){
var objJSON = JSON.parse(data);

if (objJSON.response == "success") {
$b_name     = objJSON.b_name;
$b_surname  = objJSON.b_surname;
$b_email    = objJSON.b_email;
$b_country  = objJSON.b_country;
$b_phone    = objJSON.b_phone;
$b_address  = objJSON.b_address;
$b_note     = objJSON.b_note;
$b_code     = objJSON.b_code;
$b_ip       = objJSON.b_ip;
$b_date     = objJSON.b_date;
$b_shared   = objJSON.b_shared;
$b_from_to  = objJSON.b_from_to;
$b_airport  = objJSON.b_airport;
$b_resort   = objJSON.b_resort;
$b_vehicle  = objJSON.b_vehicle;
$b_pax      = objJSON.b_pax;
$b_type     = objJSON.b_type;
$b_a_f_no   = objJSON.b_a_f_no;
$b_a_f_date = objJSON.b_a_f_date;
$b_a_f_time = objJSON.b_a_f_time;
$b_d_f_no   = objJSON.b_d_f_no;
$b_d_f_date = objJSON.b_d_f_date;
$b_d_f_time = objJSON.b_d_f_time;
$b_d_f_pick = objJSON.b_d_f_pick;
$b_cseat    = objJSON.b_cseat;
$b_bseat    = objJSON.b_bseat;
$b_curr     = objJSON.b_curr;
$b_price    = objJSON.b_price;

$("#hide_details").hide("fast");
$("#show_details").show("slow");

$("#b_name").html($b_name + ' ' + $b_surname);
$("#b_email").html($b_email);
$("#b_phone").html($b_country + ' ' + $b_phone);
$("#b_address").html($b_address);
$("#b_note").html($b_note);
$("#b_code").html($b_code);
$("#b_date").html($b_date + ' ' + $b_ip);
$("#b_shared").html($b_shared);
$("#b_from_to").html($b_from_to);
$("#b_airport").html($b_airport);
$("#b_resort").html($b_resort);
$("#b_vehicle").html($b_vehicle);
$("#b_pax").html($b_pax + ' <?php echo $translate['tr_082']; ?>');
$("#b_type").html($b_type);
$("#b_a_f_no").html($b_a_f_no);
$("#b_a_f_date").html($b_a_f_date + ' ' + $b_a_f_time);
$("#b_d_f_no").html($b_d_f_no);
$("#b_d_f_date").html('<b>' + $b_d_f_date + ' ' + $b_d_f_time + '</b>');
$("#b_d_f_pick").html($b_d_f_pick);
$("#b_cseat").html($b_cseat);
$("#b_bseat").html($b_bseat);
$("#b_price").html('<b>' + $b_price + ' ' + $b_curr + '</b>');
}

if (objJSON.response == "both") { swal("", "<?php echo $translate['tr_083']; ?>", "info"); }
if (objJSON.response == "problem") { swal("", "<?php echo $translate['tr_084']; ?>", "info"); }
if (objJSON.response == "voucher") { swal("", "<?php echo $translate['tr_085']; ?>", "info"); }
if (objJSON.response == "email") { swal("", "<?php echo $translate['tr_086']; ?>", "info"); }

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