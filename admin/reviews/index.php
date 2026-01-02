<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


$sql = "SELECT * FROM reviews ORDER BY review_date DESC";


// toplam
$tot_count = $Db->query($sql);
// toplam


// Paging
$per_page    = 15;
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


// İlanları çek
$reviews = $Db->query($sql);
// İlanları çek

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
<li class="active">Yorumlar</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-12">

<div class="box box-info">

<div class="box-header">
<h3 class="box-title">Yorumlar</h3>
</div>

<div class="box-body">

<table class="table table-striped table-hover table-bordered table-condensed">

<thead>
<tr>
<th>Ad Soyad</th>
<th>Tarih</th>
<th>Yorum</th>
<th>Durum</th>
<th></th>
<th></th>
</tr>
</thead>

<tbody>
<?php if (!empty($reviews)) { $no = 1; foreach ($reviews as $review) { ?>
<tr>
<td><?php echo $review['review_name']; ?></td>
<td><?php echo date("d-m-Y", strtotime($review['review_date'])); ?></td>
<td><?php echo mb_substr($review['review_text'], 0, 30,'UTF-8')."..."; ?></td>
<td>
<?php
if ($review['review_status'] == 0) { echo '<span class="label label-warning">Pasif</span>'; }
if ($review['review_status'] == 1) { echo '<span class="label label-info">Aktif</span>'; }
?>
</td>
<td><a href="#" data-toggle="modal" data-target="#myModal<?php echo $review['review_id']; ?>" class="btn btn-sm btn-success">Düzenle</a></td>
<td><a href="remove.php?id=<?php echo $review['review_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Sil</a></td>
</tr>

<div class="modal fade" id="myModal<?php echo $review['review_id']; ?>" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Yorum Düzenleme</h4>
</div>

<div class="modal-body">
<div class="box-body">

<form id="edit_faq<?php echo $review['review_id']; ?>" method="POST" action="update_edit.php">

<input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">

<div class="row">

<div class="col-md-4">
<div class="form-group">
<label>Ad Soyad</label>
<input type="text" name="review_name" class="form-control" value="<?php echo $review['review_name']; ?>">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Tarih</label>
<input type="text" name="review_date" class="form-control h_date" value="<?php echo date("d-m-Y", strtotime($review['review_date'])); ?>">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Durum</label>
<select class="form-control" name="review_status">
<option <?php if ($review['review_status'] == 0) { echo 'selected="selected"'; } ?> value="0">Hayır</option>
<option <?php if ($review['review_status'] == 1) { echo 'selected="selected"'; } ?> value="1">Evet</option>
</select>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Yorum</label>
<textarea rows="6" name="review_text" class="form-control"><?php echo $review['review_text']; ?></textarea>
</div>
</div>

</form>

</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
<button type="submit" onclick="document.getElementById('edit_faq<?php echo $review['review_id']; ?>').submit();" class="btn btn-primary">Güncelle</button>
</div>

</div>
</div>
</div>

<?php $no++; } } ?>
</tbody>

</table>
</div>

<div class="box-footer">
<div class="pull-right"><?php if (!empty($reviews)) { paging($urlsetted); } ?></div>
</div>

</div>

</div>

<div class="col-md-12">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Yorum Ekle</h3>
</div>

<form method="POST" action="add_new.php">

<div class="box-body">

<div class="row">

<div class="col-sm-6">
<div class="form-group">
<label>Ad Soyad</label>
<input type="text" class="form-control" name="review_name" required>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>Tarih</label>
<input type="text" class="form-control h_date" name="review_date" required>
</div>
</div>

<div class="col-sm-12">
<div class="form-group">
<label>Yorum</label>
<textarea rows="6" class="form-control" name="review_text" required></textarea>
</div>
</div>

</div>

</div>

<div class="box-footer">
<button type="submit" class="btn btn-info pull-right">Kaydet</button>
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

<script>
$('.h_date').datepicker({
format: 'dd-mm-yyyy',
autoclose: true,
weekStart: 1
});
</script>

</body>
</html>