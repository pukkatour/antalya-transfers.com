<?php
include_once('include/site_id.php');
include_once('include/initialize.inc.php');
if (empty($_SESSION['admin']['admin_id'])) { redirect(SITE_URL.'admin/log_in.php'); exit; }

?>

<!DOCTYPE html>
<html>

<?php include_once('head_meta.php'); ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include_once('header.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

<?php include_once('left_menu.php'); ?>

<div class="content-wrapper">


<!-- BREADCRUMB -->
<section class="content-header">
<h1>Yönetim Paneli<small>Version 1.2</small></h1>
<ol class="breadcrumb">
<li><a href="<?php echo SITE_URL; ?>admin/index.php"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
<li class="active">Yönetim Paneli</li>
</ol>
</section>
<!-- BREADCRUMB -->


<section class="content">

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

<?php include_once('home_top_counters.php'); ?>

<div class="row">

<?php include_once("home_email_send.php"); ?>

</div>

<div class="row">

<?php include_once("home_hit_counter.php"); ?>

<?php include_once("home_chart.php"); ?>

</div>

<?php include_once("home_sms_send.php"); ?>

</section>

</div>

<?php include_once('footer.php'); ?>

</div>

<?php include_once('footer_scripts.php'); ?>

<script>
$(function() {
setTimeout(function() {
$("#sentMessage").hide('blind', {}, 500);
}, 5000);
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>

<script>
$(".knob").knob();

$(function () {

var area = new Morris.Area({
parseTime: false,
element: 'revenue-chart',
resize: true,
data: [
{y: 'Ana Sayfa', item1: <?php if (empty($hits_1all['toplam1all'])) { echo "0"; } else { echo $hits_1all['toplam1all']; } ?>, item2: <?php if (empty($hits_1['toplam1'])) { echo "0"; } else { echo $hits_1['toplam1']; } ?>},
{y: 'FAQ', item1: <?php if (empty($hits_2all['toplam2all'])) { echo "0"; } else { echo $hits_2all['toplam2all']; } ?>, item2: <?php if (empty($hits_2['toplam2'])) { echo "0"; } else { echo $hits_2['toplam2']; } ?>},
{y: 'Yorumlar', item1: <?php if (empty($hits_3all['toplam3all'])) { echo "0"; } else { echo $hits_3all['toplam3all']; } ?>, item2: <?php if (empty($hits_3['toplam3'])) { echo "0"; } else { echo $hits_3['toplam3']; } ?>},
{y: 'Transferler', item1: <?php if (empty($hits_4all['toplam4all'])) { echo "0"; } else { echo $hits_4all['toplam4all']; } ?>, item2: <?php if (empty($hits_4['toplam4'])) { echo "0"; } else { echo $hits_4['toplam4']; } ?>},
{y: 'Hakkımızda', item1: <?php if (empty($hits_5all['toplam5all'])) { echo "0"; } else { echo $hits_5all['toplam5all']; } ?>, item2: <?php if (empty($hits_5['toplam5'])) { echo "0"; } else { echo $hits_5['toplam5']; } ?>}
],
xkey: 'y',
ykeys: ['item1', 'item2'],
labels: ['Toplam', 'Bu Ay'],
lineColors: ['#a0d0e0', '#3c8dbc'],
hideHover: 'auto'
});
area.redraw();

var donut = new Morris.Donut({
element: 'sales-chart',
resize: true,
colors: ["#3c8dbc", "#f56954", "#00a65a"],
data: [
{label: "<?php echo $languagelist[0]['lang_name_eng']; ?>", value: <?php if (!empty($lang_total1['langtotal1'])) { echo $lang_total1['langtotal1']; } else { echo "0"; } ?>},
{label: "<?php echo $languagelist[1]['lang_name_eng']; ?>", value: <?php if (!empty($lang_total2['langtotal2'])) { echo $lang_total2['langtotal2']; } else { echo "0"; } ?>}
],
hideHover: 'auto'
});

});
</script>

</body>
</html>