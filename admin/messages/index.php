<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


$sql       = "SELECT contact_messages.*, country_list.country_phone_code, language_list.lang_name_eng FROM contact_messages LEFT JOIN country_list ON country_list.country_id = contact_messages.message_country LEFT JOIN language_list ON language_list.lang_id = contact_messages.message_lang_id ";

$tot_count = $Db->query($sql);


// Paging
$per_page    = 16;
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


$datas = $Db->query($sql);

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
<li class="active">İletişim Mesajları</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-12">

<div class="box box-info">

<div class="box-header">
<h3 class="box-title">Mesajlar</h3>
</div>

<div class="box-body">

<table class="table table-striped table-hover table-bordered table-condensed">

<thead>
<tr>
<th>Gönderen</th>
<th>Email</th>
<th>Telefon</th>
<th>Konu</th>
<th>Dil</th>
<th>Tarih</th>
<th>IP</th>
<th>Durum</th>
<th></th>
</tr>
</thead>

<tbody>
<?php if (!empty($datas)) { foreach ($datas as $message) { ?>
<tr>
<td><?php echo $message['message_name']." ".$message['message_surname']; ?></td>
<td><?php echo $message['message_email']; ?></td>
<td><?php echo $message['country_phone_code']." ".$message['message_phone']; ?></td>
<td><?php echo mb_substr($message['message_title'], 0, 15,'UTF-8'); ?></td>
<td><?php echo $message['lang_name_eng']; ?></td>
<td><?php echo $message['message_date']; ?></td>
<td><?php echo $message['message_ip']; ?></td>
<td>
<?php 
if ($message['message_seen'] == "1") { echo '<span class="label pull-right bg-green" style="padding: 5px;">Okundu</span>';}
if ($message['message_seen'] == "0") { echo '<span class="label pull-right bg-red" style="padding: 5px;">Okunmadı</span>';}
?>
</td>
<td>
<div class="btn-group pull-right">
<button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown">İşlem <span class="caret"></span></button>
<ul class="dropdown-menu dropdown-menu-right" role="menu">
<?php if ($message['message_seen'] == "0") { ?><li><a href="operations.php?action=1&id=<?php echo $message['message_id']; ?>">Okundu Yap</a></li><?php } ?>
<?php if ($message['message_seen'] == "1") { ?><li><a href="operations.php?action=0&id=<?php echo $message['message_id']; ?>">Okunmadı Yap</a></li><?php } ?>
<li><a href="operations.php?action=3&id=<?php echo $message['message_id']; ?>" onclick="return confirm('Silmek istiyor musun?');">Sil</a></li>
<li class="divider"></li>
<li><a href="detail.php?message_id=<?php echo $message['message_id']; ?>">Detay / Cevap</a></li>
</ul>
</div>
</td>
</tr>

<?php } } ?>
</tbody>

</table>

</div>

<div class="box-footer">
<div class="pull-right"><?php if (!empty($datas)) { paging($urlsetted); } ?></div>
</div>

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