<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


$sql = "SELECT * FROM directory";

if(!empty($_GET)) {

if (isset($_GET['name']) && !empty($_GET['name'])) {
$_name        = $_GET['name'];
$sql         .= " WHERE directory_name LIKE :name ";
$par['name']  = '%'.$_name.'%';
}

if (isset($_GET['email']) && !empty($_GET['email'])) {
$_email       = $_GET['email'];
$sql         .= " WHERE directory_email LIKE :email";
$par['email'] = '%'.$_email.'%';
}

if (isset($_GET['cat']) && !empty($_GET['cat'])) {
$_cat         = $_GET['cat'];
$sql         .= " WHERE directory_cat = :cat ";
$par['cat']   = $_cat;
}

}


// Pagniation İçin
$urlsetted = $_SERVER['REQUEST_URI'];
if(!empty($urlsetted)) {
$urlsetted = ltrim($urlsetted, '/');
$konum = strpos($urlsetted, "&page");
if ($konum === false) { } else { $urlsetted = substr($urlsetted, 0, $konum); }
$konum = strpos($urlsetted, "?page");
if ($konum === false) { } else { $urlsetted = substr($urlsetted, 0, $konum); }
}
// Pagniation İçin


// İlanları topla
$totalresult = $Db->query($sql,$par);
// İlanları topla


// Paging
$per_page = 15;
$start = 0;
$end = $per_page;
$total_pages = ceil(count($totalresult) / $per_page);
if ($_GET) {
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
if (empty($_GET['page'])) { $_GET['page'] = 1; }
$show_page = $_GET['page'];
if(!is_numeric($show_page)) {
$show_page = 0;
}
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
if(!is_numeric($show_page)) {
$show_page = 0;
}
$num_rows = count($totalresult);
$page_amount2 = ceil($num_rows / $per_page);
$page_amount = $page_amount2 - 1;
$page = $show_page;

$sql .= " LIMIT " . $start . "," . $per_page;
// Paging


// İlanları çek
$datas = $Db->query($sql,$par);
// İlanları çek

$cats = $Db->query("SELECT * FROM directory_categories");

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
<li class="active">Email Rehberi</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-12">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Email Rehberi</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-sm btn-default" data-widget="collapse"><i class="fa fa fa-minus"></i>
</button>
</div>
</div>

<div class="box-body">

<div class="row">

<div class="col-md-12">

<form method="GET">

<div class="col-xs-3">
<input type="text" class="form-control" name="name" id="search1" placeholder="Ad" onClick="this.form.reset()">
</div>

<div class="col-xs-3">
<input type="text" class="form-control" name="email" id="search2" placeholder="Email" onClick="this.form.reset()">
</div>

<div class="col-xs-2">
<select name="cat" class="form-control" id="search3">
<option value="">Seçim Yapın</option>
<?php if (!empty($cats)) { foreach ($cats as $cat) { ?>
<option <?php if (!empty($_GET['cat'])) { if ($_GET['cat'] == $cat['category_id']) { echo 'selected="selected"'; } } ?> value="<?php echo $cat['category_id']; ?>"><?php echo $cat['category_name']; ?></option>
<?php } } ?>
</select>
</div>

<div class="col-xs-2">
<button type="submit" class="btn btn-sm btn-primary pull-right">ARA</button>
</div>

<div class="col-xs-2">
<a href="<?php echo SITE_URL; ?>admin/directory/index.php" class="btn btn-sm btn-danger pull-right">TÜMÜ</a>
</div>

</form>

<script>
$(document).ready(function() {
$('#search1, #search2').on('click', function() {
$("#search3").val('');
});
$('#search3').on('click', function() {
$("#search1, #search2").val('');
});
});
</script>

</div>

<br>
<hr>
<br>

<div class="col-md-12">

<table class="table table-bordered table-striped">
<tbody>

<tr>
<th>Ad Soyad</th>
<th>Telefon</th>
<th>Email</th>
<th>Kategori</th>
<th>Dil</th>
<th></th>
</tr>

<?php
if (!empty($datas)) { foreach ($datas as $data) {
$cat = $Db->row("SELECT * FROM directory_categories WHERE category_id = ?", array($data['directory_cat']));
$lng = $Db->row("SELECT lang_name_eng FROM language_list WHERE lang_id = ?", array($data['directory_lng']));
$cnt = $Db->row("SELECT country_phone_code FROM country_list WHERE country_id = ?", array($data['directory_country']));
?>

<tr>
<td><?php echo $data['directory_name']." ".$data['directory_surname']; ?></td>
<td><?php echo $cnt['country_phone_code']." ".$data['directory_phone']; ?></td>
<td><?php echo $data['directory_email']; ?></td>
<td><?php echo $cat['category_name']; ?></td>
<td><?php echo $lng['lang_name_eng']; ?></td>
<td>
<div class="btn-group pull-right">
<button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown">İşlem <span class="caret"></span></button>
<ul class="dropdown-menu dropdown-menu-right" role="menu">
<li><a href="remove.php?id=<?php echo $data['directory_id']; ?>" onclick="return confirm('Emin misiniz?');">Sil</a></li>
<li class="divider"></li>
<li><a href="#" data-toggle="modal" data-target="#myModal<?php echo $data['directory_id']; ?>">Düzenle</a></li>
</ul>
</div>
</td>
</tr>

<div class="modal fade" id="myModal<?php echo $data['directory_id']; ?>" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Kayıt Düzenleme</h4>
</div>

<div class="modal-body">
<div class="box-body">

<form id="edit_mail<?php echo $data['directory_id']; ?>" method="POST" action="update.php">

<input type="hidden" name="directory_id" value="<?php echo $data['directory_id']; ?>">

<div class="col-xs-6">
<div class="form-group">
<label>Ad</label>
<input type="text" name="directory_name" class="form-control" value="<?php echo $data['directory_name']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-xs-6">
<div class="form-group">
<label>Soyad</label>
<input type="text" name="directory_surname" class="form-control" value="<?php echo $data['directory_surname']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-xs-6">
<div class="form-group">
<label>Email</label>
<input type="email" name="directory_email" class="form-control" value="<?php echo $data['directory_email']; ?>" maxlength="250" required="">
</div>
</div>

<div class="col-xs-6">
<label>Telefon</label>
<div class="form-group">
<input type="text" class="form-control" name="directory_phone" value="<?php echo $data['directory_phone']; ?>" onkeypress="return h_isNumber(event)" maxlength="15" required="">
</div>
</div>

<div class="col-xs-6">
<label>Ülke Kodu</label>
<div class="form-group">
<select name="directory_country" class="form-control" required="">
<?php if (!empty($countrylist)) { foreach ($countrylist as $count) { ?>
<option <?php if ($count['country_id'] == $data['directory_country']) { echo 'selected="selected"'; } ?> value="<?php echo $count['country_id']; ?>"><?php echo $count['country_phone_code']. " ".$count['country_name']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-xs-6">
<div class="form-group">
<label>Kategori</label>
<select class="form-control" name="directory_cat" required="">
<?php if (!empty($cats)) { foreach ($cats as $cat) { ?>
<option <?php if ($cat['category_id'] == $data['directory_cat']) { echo 'selected="selected"'; } ?> value="<?php echo $cat['category_id']; ?>"><?php echo $cat['category_name']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-xs-6">
<div class="form-group">
<label>Dil</label>
<select class="form-control" name="directory_lng" required="">
<?php if (!empty($languagelist)) { foreach ($languagelist as $lng) { ?>
<option <?php if ($lng['lang_id'] == $data['directory_lng']) { echo 'selected="selected"'; } ?> value="<?php echo $lng['lang_id']; ?>"><?php echo $lng['lang_name_eng']; ?></option>
<?php } } ?>
</select>
</div>
</div>

</form>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Çık</button>
<button type="button" onclick="document.getElementById('edit_mail<?php echo $data['directory_id']; ?>').submit();" class="btn btn-sm btn-primary">Kaydet</button>
</div>

</div>
</div>
</div>

<?php } } ?>
</tbody>
</table>

</div>

</div>

<div class="pull-right"><?php if (!empty($datas)) { paging($urlsetted); } ?></div>

</div>

</div>

<div class="box box-danger collapsed-box">

<div class="box-header with-border">
<h3 class="box-title">Email Ekleme</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-sm btn-default" data-widget="collapse"><i class="fa fa-plus"></i>
</button>
</div>
</div>

<div class="box-body">

<form action="add_new.php" method="POST">

<div class="col-xs-4">
<label>Ad</label>
<div class="form-group">
<input type="text" class="form-control h_firstcap" name="directory_name" placeholder="Ad" maxlength="250" required="">
</div>
</div>

<div class="col-xs-4">
<label>Soyad</label>
<div class="form-group">
<input type="text" class="form-control h_firstcap" name="directory_surname" placeholder="Soyad" maxlength="250" required="">
</div>
</div>

<div class="col-xs-4">
<label>Email Adresi</label>
<div class="form-group">
<input type="email" class="form-control" name="directory_email" placeholder="Email Adresi" maxlength="250" required="">
</div>
</div>

<div class="col-xs-3">
<label>Ülke Kodu</label>
<div class="form-group">
<select name="directory_country" class="form-control" required="">
<?php if (!empty($countrylist)) { foreach ($countrylist as $count) { ?>
<option <?php if ($count['country_id'] == 224) { echo 'selected="selected"'; } ?> value="<?php echo $count['country_id']; ?>"><?php echo $count['country_phone_code']. " ".$count['country_name']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-xs-3">
<label>Telefon</label>
<div class="form-group">
<input type="text" class="form-control" name="directory_phone" placeholder="Telefon No" onkeypress="return h_isNumber(event)" maxlength="15" required="">
</div>
</div>

<div class="col-xs-3">
<label>Dil</label>
<div class="form-group">
<select name="directory_lng" class="form-control" required="">
<?php if (!empty($languagelist)) { foreach ($languagelist as $lang) { ?>
<option value="<?php echo $lang['lang_id']; ?>"><?php echo $lang['lang_name_eng']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-xs-3">
<label>Kategori</label>
<div class="form-group">
<select name="directory_cat" class="form-control" required="">
<?php if (!empty($cats)) { foreach ($cats as $cat) { ?>
<option value="<?php echo $cat['category_id']; ?>"><?php echo $cat['category_name']; ?></option>
<?php } } ?>
</select>
</div>
</div>

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