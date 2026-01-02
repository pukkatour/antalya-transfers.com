<?php
include_once('site_id.php');
include_once('admin/include/initialize.inc.php');

$data      = $Db->row("SELECT * FROM page_home WHERE page_lang_id = ?", array($site_lang));

$airports  = $Db->query("SELECT airport_airport_id,airport_geo,airport_slug,airport_name FROM transfer_airports WHERE airport_lang_id = ? ORDER BY airport_name ASC", array($site_lang));

$districts = $Db->query("SELECT resort_resort_id,resort_name FROM transfer_resorts WHERE resort_lang_id = ? AND resort_is_hotel = ? ORDER BY resort_name ASC", array($site_lang,'1'));
$hotel_dis = $Db->query("SELECT transfer_resorts.resort_is_related, t2.resort_name AS reso_name FROM transfer_resorts LEFT JOIN transfer_resorts AS t2 ON t2.resort_resort_id = transfer_resorts.resort_is_related WHERE transfer_resorts.resort_lang_id = ? AND transfer_resorts.resort_is_hotel = ? GROUP BY transfer_resorts.resort_is_related ORDER BY reso_name ASC", array($site_lang,'2'));

$pagename  = "Home";
include_once("hit_counter.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>

<title><?php echo $data['page_title']; ?></title>
<meta name="description" content="<?php echo $data['page_description']; ?>">
<meta name="keywords" content="<?php echo $data['page_keywords']; ?>">

<?php include_once("head_meta.php"); ?>

<link rel="alternate" href="<?php echo SITE_URL; ?>tr/" hreflang="tr-TR" />

</head>

<body>

<?php include_once("head_menu.php"); ?>
<?php include_once("welcome.php"); ?>
<?php include_once("why_us.php"); ?>
<?php include_once("features.php"); ?>
<?php include_once("faq.php"); ?>
<?php include_once("reviews.php"); ?>
<?php include_once("footer.php"); ?>
<?php include_once("footer_scripts.php"); ?>
<?php include_once("popup_modal.php"); ?>

<?php $sliders  = $Db->query("SELECT * FROM home_slider WHERE slider_lang_id = ?", array($site_lang)); ?>


<?php if ($sitesettings['site_transfer_shuttle'] == 1) { ?>
<script>
$( document ).ready(function() {
$('#tr_type').val(2).trigger('change');
$('#__type').hide();
});
</script>
<?php } ?>

<script>
$('.top-content').backstretch([
<?php if (!empty($sliders)) { foreach ($sliders as $slider) { ?>
{ url: "<?php echo IMAGE_FOLDER."slider/".$slider['slider_img']; ?>", alt: "<?php echo $sitesettings['site_name']; ?>", title: "<?php echo $sitesettings['site_name']; ?>" }, 
<?php } } ?>
], {fade: 2500,duration: 7000});
const typedTextSpan=document.querySelector(".typed-text"),cursorSpan=document.querySelector(".cursor"),textArray=["is nature","is history","is fun","is LOVE"],typingDelay=200,erasingDelay=100,newTextDelay=2e3;let textArrayIndex=0,charIndex=0;function type(){charIndex<textArray[textArrayIndex].length?(cursorSpan.classList.contains("typing")||cursorSpan.classList.add("typing"),typedTextSpan.textContent+=textArray[textArrayIndex].charAt(charIndex),charIndex++,setTimeout(type,typingDelay)):(cursorSpan.classList.remove("typing"),setTimeout(erase,newTextDelay));}function erase(){charIndex>0?(cursorSpan.classList.contains("typing")||cursorSpan.classList.add("typing"),typedTextSpan.textContent=textArray[textArrayIndex].substring(0,charIndex-1),charIndex--,setTimeout(erase,erasingDelay)):(cursorSpan.classList.remove("typing"),++textArrayIndex>=textArray.length&&(textArrayIndex=0),setTimeout(type,typingDelay+1100));}document.addEventListener("DOMContentLoaded",function(){textArray.length&&setTimeout(type,newTextDelay+250);});
function initMap() {
var directionsService = new google.maps.DirectionsService();
var directionsRenderer = new google.maps.DirectionsRenderer();
var map = new google.maps.Map(document.getElementById('top-content'), {
zoom: 6,
disableDefaultUI: true,
mapTypeControl: false,
zoomControl: false,
streetViewControl: false,
center: {lat: 38.644497, lng: 34.832333}
});
directionsRenderer.setMap(map);
var onChangeHandler = function() { calculateAndDisplayRoute(directionsService, directionsRenderer); };
$(document).on('change', '#new_from', function() { onChangeHandler(); });
$(document).on('change', '#new_to', function() { onChangeHandler(); });
}
function calculateAndDisplayRoute(directionsService, directionsRenderer) {
directionsService.route(
{
origin: {query: document.getElementById('new_from').value},
destination: {query: document.getElementById('new_to').value},
travelMode: 'DRIVING'
},
function(response, status) {
if (status === 'OK') {
directionsRenderer.setDirections(response);
}
});
}
</script>

<script>
var transfer_type;
var transfer_direction;
var transfer_booking;
var transfer_from;
var transfer_to;
var transfer_pax;
var transfer_curr;

function transfer_type_Fnc() {
transfer_type = $('#tr_type').find('option:selected').val();
hesaPLA();
};

function transfer_direction_Fnc() {
transfer_direction = $('#tr_direction').find('option:selected').val();

if (transfer_direction == 1) {

$("#__ret").show();

$("#transfer_airport_label").html('<b><?php echo $translate['tr_009']; ?> <span class="text-warning">**</span></b>');
$("#transfer_resort_label").html('<b><?php echo $translate['tr_011']; ?> <span class="text-warning">**</span></b>');

$("#__to").insertAfter("#__from");

hesaPLA();
urlYap();

}

if (transfer_direction == 2) {

$("#__ret").hide();
$('#tr_booking').val(1).trigger('change');

$("#transfer_airport_label").html('<b><?php echo $translate['tr_011']; ?> <span class="text-warning">**</span></b>');
$("#transfer_resort_label").html('<b><?php echo $translate['tr_009']; ?> <span class="text-warning">**</span></b>');

$("#__from").insertAfter("#__to");

one_Fnc();
hesaPLA();
urlYap();
}

};

function transfer_from_Fnc() {
transfer_from = $('#tr_from').find('option:selected').val();
$.post('<?php echo SITE_URL; ?>transfer_info_air.php',{"air_id": transfer_from},
function(data) {
var objJSON = JSON.parse(data);
if (objJSON.response == "ok") {
$from_slug    = objJSON.slug;
$from_latlng  = objJSON.latlng;
$('#new_air_slug').val($from_slug).trigger('change');
$('#new_from').val($from_latlng).trigger('change');
}
});
$("#getlostcanim").hide("fast");
$("#top-content").slideDown("slow");
setTimeout(function(){ $("#top-content").hide("slow"); }, 20000);
if (transfer_from === "0") { $("#result").hide("slow"); }
hesaPLA();
urlYap();
};

function transfer_to_Fnc() {
transfer_to = $('#tr_to').find('option:selected').val();
$.post('<?php echo SITE_URL; ?>transfer_info_des.php',{"des_id": transfer_to},
function(data) {
var objJSON = JSON.parse(data);
if (objJSON.response == "ok") {
$to_slug    = objJSON.slug;
$to_latlng  = objJSON.latlng;
$('#new_des_slug').val($to_slug).trigger('change');
$('#new_to').val($to_latlng).trigger('change');
}
});

if (transfer_to === "0") { $("#result").hide("slow"); }
hesaPLA();
urlYap();
};

function transfer_guest_Fnc() {
transfer_pax = $('#guests').find('option:selected').val();
if (transfer_pax === "0") { $("#result").hide("slow"); }
hesaPLA();
};

function transfer_curr_Fnc() {
transfer_curr = $('#curr').find('option:selected').val();
if (transfer_curr === "0") { $("#result").hide("slow"); }
hesaPLA();
};

function one_ret_Fnc() {
transfer_booking = $('#tr_booking').find('option:selected').val();
hesaPLA();
};

function hesaPLA() {
if (transfer_type != null && transfer_type != 0 && transfer_direction != null && transfer_direction != 0 && transfer_booking != null && transfer_booking != 0 && transfer_from != null && transfer_from != 0 && transfer_to != null && transfer_to != 0 && transfer_pax != null && transfer_pax != 0 && transfer_curr != null && transfer_curr != 0) {
$("#result").slideDown("slow");
$.post('<?php echo SITE_URL."transfer_details.php"; ?>',
{"transfer_shared": transfer_type,"transfer_from": transfer_direction,"transfer_airport": transfer_from,"transfer_resort": transfer_to,"transfer_pax": transfer_pax,"transfer_type": transfer_booking,"transfer_curr": transfer_curr},
function(data) {
var objJSON = JSON.parse(data);
if(objJSON.response == "ok") {
$result_vehicle  = objJSON.vehicle;
$result_duration = objJSON.duration;
$result_distance = objJSON.distance;
$result_price    = objJSON.price;
$result_curr     = objJSON.curr;
$("#result_vehicle").attr("src","<?php echo IMAGE_FOLDER."transfer/"; ?>" + $result_vehicle);
$("#result_duration").html($result_duration + " <?php echo $translate['tr_025']; ?>");
$("#result_distance").html($result_distance + " <?php echo $translate['tr_024']; ?>");
$('#result_price').html($result_price + " " + $result_curr);
$('#b_type').val(transfer_type);
$('#b_direction').val(transfer_direction);
$('#b_from').val(transfer_from);
$('#b_to').val(transfer_to);
$('#b_pax').val(transfer_pax);
$('#b_curr').val(transfer_curr);
$('#b_way').val(transfer_booking);
$('#b_price').val($result_price);
}
if (window.matchMedia("(max-width: 767px)").matches) { $(window).scrollTop($('#scroll').offset().top+ 100); }
});
}
};

$("#transfer_form").submit(function( event ) {
if (($("#transfer_from").val() == '2') && ($("#transfer_type").val() == '2')) { swal("!", "<?php echo $translate['tr_091']; ?>", "warning"); return false; };
if ($("#from").val() == '0') { swal("!", "<?php echo $translate['tr_092']; ?>", "warning"); return false; };
if ($("#to").val() == '0') { swal("!", "<?php echo $translate['tr_093']; ?>", "warning"); return false; };
if ($("#guests").val() == '0') { swal("!", "<?php echo $translate['tr_094']; ?>", "warning"); return false; };
if ($("#curr").val() == '0') { swal("!", "<?php echo $translate['tr_095']; ?>", "warning"); return false; };
});

function urlYap() {
setTimeout(function() {
if (transfer_direction == "1") {
var airport_sel = $('#new_air_slug').val();
var resort_sel  = $('#new_des_slug').val();
}
if (transfer_direction == "2") {
var airport_sel = $('#new_des_slug').val();
var resort_sel  = $('#new_air_slug').val();
}
$('#transfer_form').attr('action', airport_sel+'-to-'+resort_sel+'-transfer/');
}, 100);
};
$( document ).ready(function() {
setTimeout(function(){ $("#text_1").show("slow"); }, 2000);
setTimeout(function(){ $("#text_2").show("slow"); }, 3000);
setTimeout(function(){ $("#text_3").show("slow"); }, 4000);
setTimeout(function(){ $("#text_4").show("slow"); }, 5000);
setTimeout(function(){ $("#text_5").show("slow"); }, 6000);
});
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $sitesettings['site_google_maps_key']; ?>&callback=initMap&loading=async"></script>

</body>

</html>

<?php ob_end_flush(); ?>