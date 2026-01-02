<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$sql    = "SELECT * FROM currency_rates WHERE 1 = 1 ";

if (!empty($_GET['rate_date'])) {

$rate_date = $_GET['rate_date'];
$sql      .= " AND rate_date LIKE '%".$rate_date."%' "; }

}

else {

$sql = "SELECT * FROM currency_rates ";

}


$tot_count = $Db->query($sql);


// Paging
$per_page    = 10;
$start       = 0;
$end         = $per_page;
$total_pages = ceil(count($tot_count) / $per_page);

if (!empty($_GET['page'])) {
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
if (empty($_GET['page'])) { $_GET['page'] = 1; }
$show_page = $_GET['page'];
if(!is_numeric($show_page)) { $show_page = 0; }
if ($show_page > 0 && $show_page <= $total_pages) {
$start = ($show_page - 1) * $per_page;
$end = $start + $per_page;
} else {
$start = 0;
$end = $per_page;
}
}
} else {
$show_page = 0;
}

if (!is_numeric($show_page)) { $show_page = 0; }
$num_rows     = count($tot_count);
$page_amount2 = ceil($num_rows / $per_page);
$page_amount  = $page_amount2 - 1;
$page         = $show_page;

$sql .= " LIMIT " . $start . "," . $per_page;
// Paging


$currencies = $Db->query($sql);

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
<li class="active">Döviz Kurları</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-12">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Filterler</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-sm btn-box-tool" data-widget="collapse"><i class="fa fa fa-minus"></i>
</button>
</div>
</div>

<div class="box-body">

<form method="GET">

<div class="box-body">

<div class="col-md-3">
<div class="form-group">
<label>Tarih Seçin</label>
<input type="text" class="form-control" name="rate_date" id="rate_date" placeholder="Tarih Seçin" value="<?php if (!empty($_GET)) { if (!empty($_GET['rate_date'])) { echo $_GET['rate_date']; } } ?>" required="">
</div>
</div>

<div class="col-md-3">
<button type="submit" class="btn btn-sm btn-primary pull-right" style="margin-top: 25px;">Ara</button>
</div>

</div>

</form>

</div>

</div>

</div>

<div class="col-md-12">

<div class="box box-danger">

<div class="box-header with-border">
<h3 class="box-title">Döviz Kurları</h3>
</div>

<div class="box-body">

<table class="table table-striped table-hover table-bordered table-condensed">

<thead>
<tr>
<th>Tarih</th>
<th>USD Al.</th>
<th>EUR Al.</th>
<th>GBP Al.</th>
<th>USD Sat.</th>
<th>EUR Sat.</th>
<th>GBP Sat.</th>
</tr>
</thead>

<tbody>

<?php if (!empty($currencies)) { foreach ($currencies as $curr) { ?>
<tr>
<td><?php echo $curr['rate_date']; ?></td>
<td><?php echo $curr['rate_buy_usd']; ?></td>
<td><?php echo $curr['rate_buy_eur']; ?></td>
<td><?php echo $curr['rate_buy_gbp']; ?></td>
<td><?php echo $curr['rate_sell_usd']; ?></td>
<td><?php echo $curr['rate_sell_eur']; ?></td>
<td><?php echo $curr['rate_sell_gbp']; ?></td>
</tr>
<?php } } ?>

</tbody>

</table>

</div>

<div class="box-footer">
<div class="pull-right"><?php if (!empty($currencies)) { paging($urlsetted); } ?></div>
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
$(function () { $('#data_table').dataTable(); });
$('#rate_date').datepicker({autoclose: true,format: 'yyyy-mm-dd',weekStart: 1});
</script>

<?php
function paging($urlsetted) {
global $num_rows;
global $page;
global $page_amount;

if (!empty($_GET['page'])) { $pagniation_page = $_GET['page']; } else { $pagniation_page = 1; }

$url = $urlsetted;
$str = substr(strrchr($url, ".php"), 4);

if (empty($str)) {

if ($page_amount != "0") {
echo '<ul class="pagination pagination">';
if ($page != "0") {
echo '<li><a href="'.SITE_URL.$urlsetted."?page=1".'">«</a></li>';
$prev = $page - 1;
echo '<li><a href="'.SITE_URL.$urlsetted."?page=".$prev.'">Önceki</a></li><li><a href="#">...</a></li>';
}
for ( $counter = max($pagniation_page - 4, 0); $counter <= $page_amount; $counter += 1 ) {
$pagee = $counter + 1;
echo '<li class="'; if ($pagniation_page == $pagee) { echo "active"; } echo '"><a href="'.SITE_URL.$urlsetted."?page=$pagee".'">'.$pagee.'</a></li>';
if ($pagee > $pagniation_page + 2) { break; }
}
if ($page < $page_amount + 1) {
$next = $page + 1;
if ($page == 0) {
$next = $page + 2;
}
echo '<li><a href="#">...</a></li><li><a href="'.SITE_URL.$urlsetted."?page=$next".'">Sonraki</a></li>';
}
echo '<li><a href="'.SITE_URL.$urlsetted."?page=".($page_amount + 1).'">»</a></li>';
echo "</ul>";
}

} else {

if ($page_amount != "0") {
echo '<ul class="pagination pagination">';
if ($page != "0") {
echo '<li><a href="'.SITE_URL.$urlsetted."&amp;page=1".'">«</a></li>';
$prev = $page - 1;
echo '<li><a href="'.SITE_URL.$urlsetted."&amp;page=1".'">Önceki</a></li><li><a href="#">...</a></li>';
}
for ($counter = max($pagniation_page - 4, 0); $counter <= $page_amount; $counter += 1) {
$pagee = $counter + 1;
echo '<li class="'; if ($pagniation_page == $pagee) {echo "active";} echo '"><a href="'.SITE_URL.$urlsetted."&amp;page=$pagee".'">'.$pagee.'</a></li>';
if ($pagee > $pagniation_page + 2) { break; }
}
if ( $page < $page_amount + 1) {
$next = $page + 1;
if ( $page == 0) {
$next = $page + 2;
}
echo '<li><a href="#">...</a></li><li><a href="'.SITE_URL.$urlsetted."&amp;page=$next".'">Sonraki</a></li>';
}
echo '<li><a href="'.SITE_URL.$urlsetted."&amp;page=".($page_amount + 1).'">»</a></li>';
echo "</ul>";
}

}

}
?>

</body>
</html>