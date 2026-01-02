<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET['id'])) {

$id = $_GET['id'];

$sql    = "SELECT city_list.*, country_list.country_name FROM city_list LEFT JOIN country_list on country_list.country_id = city_list.city_country_id WHERE city_list.city_country_id = ?";

$params    = array($id);
$tot_count = $Db->query($sql,$params);


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


$city_list = $Db->query($sql,$params);

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
<li class="active">Şehir Yönetimi</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-8">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Şehir Düzenleme</h3>
</div>

<div class="box-body">

<table class="table table-striped table-hover table-bordered table-condensed">

<thead>
<tr>
<th>ID</th>
<th>Ülke</th>
<th>Şehir</th>
<th></th>
<th></th>
</tr>
</thead>

<tbody>
<?php if (!empty($city_list)) { foreach ($city_list as $city) { ?>
<tr>
<td><?php echo $city['city_id']; ?></td>
<td><?php echo $city['country_name']; ?></td>
<td><?php echo $city['city_name']; ?></td>
<td><a href="#" data-toggle="modal" data-target="#edit_<?php echo $city['city_id']; ?>" class="btn btn-sm btn-success pull-right">Düzenle</a></td>
<td><a href="city_list_remove.php?city_id=<?php echo $city['city_id']; ?>&city_country_id=<?php if (!empty($id)) { echo $id; } ?>" onclick="return confirm('Emin misiniz?');" class="btn btn-sm btn-danger pull-right">Sil</a></td>
</tr>

<div class="modal fade" id="edit_<?php echo $city['city_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Şehir Düzenleme</h4>
</div>

<form id="edit_city_<?php echo $city['city_id']; ?>" method="POST" action="city_list_update.php">

<div class="modal-body">

<div class="form-group">
<label>Şehir Adı:</label>
<input type="text" class="form-control h_firstcap" name="city_name" value="<?php echo $city['city_name']; ?>" maxlength="250" required="">
</div>

<input type="hidden" name="city_id" value="<?php echo $city['city_id']; ?>">
<input type="hidden" name="city_country_id" value="<?php if (!empty($id)) { echo $id; } ?>">

</div>

<div class="modal-footer">
<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Kapat</button>
<button type="submit" class="btn btn-sm btn-primary" onclick="document.getElementById('edit_city<?php echo $city['city_id']; ?>').submit();">Kaydet</button>
</div>

</form>

</div>
</div>
</div>
<?php } } ?>
</tbody>

</table>

</div>

<div class="box-footer">
<div class="pull-right"><?php if (!empty($city_list)) { paging($urlsetted); } ?></div>
</div>

</div>

</div>

<div class="col-md-4">

<div class="box box-danger">

<div class="box-header with-border">
<h3 class="box-title">Şehir Ekleme</h3>
</div>

<form method="POST" action="city_list_addnew.php">

<div class="box-body">

<div class="col-md-12">
<div class="form-group">
<label>Ülke Seçin</label>
<select name="city_country_id" class="form-control" required="">
<option value="0" selected="selected">Lütfen Seçim Yapın</option>
<?php foreach ($countrylist as $country) { ?>
<option <?php if (!empty($id)) { if ($country['country_id'] == $id) { echo 'selected="selected"'; } }?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
<?php } ?>
</select>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Şehir Adını Yazın</label>
<input type="text" class="form-control h_firstcap" name="city_name" maxlength="250" required="">
</div>
</div>

<input type="hidden" name="city_country_id" value="<?php if (!empty($id)) { echo $id; } ?>">

</div>

<div class="box-footer">
<button type="submit" class="btn btn-sm btn-primary pull-right">Kaydet</button>
</div>

</form>

</div>

</div>

</div>

</section>

</div>

<?php include_once("../footer.php"); ?>

</div>

<?php include_once("../footer_scripts.php"); ?>

<?php if (empty($id)) { ?>
<script>$(document).ready(function() { $('#myModalxx').modal('show'); });</script>
<div class="modal fade" id="myModalxx" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">

<div class="modal-body">
<form id="secid" name="secid" method="GET">
<select name="id" id="idsec" class="form-control" required="">
<option value="">Seçim Yapın</option>
<?php if (!empty($countrylist)) { foreach ($countrylist as $code) { ?>
<option value="<?php echo $code['country_id']; ?>"><?php echo $code['country_name']." ".$code['country_phone_code']; ?></option>
<?php } } ?>
</select>
</form>
</div>

<script>
document.getElementById("idsec").onchange = function() {
document.getElementById("secid").submit();
};
</script>

</div>
</div>
</div>
<?php } ?>

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