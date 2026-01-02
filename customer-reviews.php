<?php
include_once('site_id.php');
include_once('admin/include/initialize.inc.php');

$data = $Db->row("SELECT * FROM page_reviews WHERE page_lang_id = ?", array($site_lang));

$sql         = "SELECT * FROM reviews WHERE review_status = :stat ORDER BY review_date DESC ";
$prm['stat'] = '1';

$total_news  = $totalreviews["revs"];

// Paging
$per_page    = 15;
$start       = 0;
$end         = $per_page;
$total_pages = ceil($total_news / $per_page);

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
$num_rows     = $total_news;
$page_amount2 = ceil($num_rows / $per_page);
$page_amount  = $page_amount2 - 1;
$page         = $show_page;

$sql .= " LIMIT " . $start . "," . $per_page;
// Paging


// İlanları çek
$reviews = $Db->query($sql,$prm);
// İlanları çek

$pagename = "Reviews";
include_once("hit_counter.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>

<title><?php echo $data['page_title']; ?></title>
<meta name="description" content="<?php echo $data['page_description']; ?>">
<meta name="keywords" content="<?php echo $data['page_keywords']; ?>">

<?php include_once("head_meta.php"); ?>

<link rel="alternate" href="<?php echo SITE_URL; ?>tr/musteri-yorumlari" hreflang="tr-TR" />

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

<?php if (!empty($reviews)) { foreach ($reviews as $review) { ?>
<div class="more-features-box-text">
<div class="more-features-box-text-icon"><i class="fa fa-comments"></i></div>
<h3><?php echo $review['review_name']; ?> <small class="pull-right"><?php echo $review['review_date']; ?></small></h3>
<div class="more-features-box-text-description"><?php echo $review['review_text']; ?></div>
</div>
<?php } } ?>

</div>

<div class="col-md-12">
<hr>
<div class="pull-left"><p><?php echo $show_page." / ".$total_pages." (".$translate['tr_096']." ".$total_news.")"; ?></p></div>
<div class="pull-right"><?php if (!empty($reviews)) { paging($urlsettedEN); } ?></div>
</div>

</div>

</div>
</div>


<?php include_once("footer.php"); ?>

<?php include_once("footer_scripts.php"); ?>

</body>

<?php
function paging($urlsettedEN) {
global $num_rows;
global $page;
global $page_amount;

if (!empty($_GET['page'])) { $pagniation_page = $_GET['page']; } else { $pagniation_page = 1; }

$url = $urlsettedEN;
$str = substr(strrchr($url, ".php"), 4);

if (empty($str)) {

if ($page_amount != "0") {
echo '<ul class="pagination pagination">';
if ($page != "0") {
echo '<li><a href="'.SITE_URL.$urlsettedEN."?page=1".'">«</a></li>';
$prev = $page - 1;
echo '<li><a href="'.SITE_URL.$urlsettedEN."?page=".$prev.'">Prev</a></li><li><a href="#">...</a></li>';
}
for ( $counter = max($pagniation_page - 4, 0); $counter <= $page_amount; $counter += 1 ) {
$pagee = $counter + 1;
echo '<li class="'; if ($pagniation_page == $pagee) { echo "active"; } echo '"><a href="'.SITE_URL.$urlsettedEN."?page=$pagee".'">'.$pagee.'</a></li>';
if ($pagee > $pagniation_page + 2) { break; }
}
if ($page < $page_amount + 1) {
$next = $page + 1;
if ($page == 0) {
$next = $page + 2;
}
echo '<li><a href="#">...</a></li><li><a href="'.SITE_URL.$urlsettedEN."?page=$next".'">Next</a></li>';
}
echo '<li><a href="'.SITE_URL.$urlsettedEN."?page=".($page_amount + 1).'">»</a></li>';
echo "</ul>";
}

} else {

if ($page_amount != "0") {
echo '<ul class="pagination pagination">';
if ($page != "0") {
echo '<li><a href="'.SITE_URL.$urlsettedEN."&amp;page=1".'">«</a></li>';
$prev = $page - 1;
echo '<li><a href="'.SITE_URL.$urlsettedEN."&amp;page=1".'">Prev</a></li><li><a href="#">...</a></li>';
}
for ($counter = max($pagniation_page - 4, 0); $counter <= $page_amount; $counter += 1) {
$pagee = $counter + 1;
echo '<li class="'; if ($pagniation_page == $pagee) {echo "active";} echo '"><a href="'.SITE_URL.$urlsettedEN."&amp;page=$pagee".'">'.$pagee.'</a></li>';
if ($pagee > $pagniation_page + 2) { break; }
}
if ( $page < $page_amount + 1) {
$next = $page + 1;
if ( $page == 0) {
$next = $page + 2;
}
echo '<li><a href="#">...</a></li><li><a href="'.SITE_URL.$urlsettedEN."&amp;page=$next".'">Next</a></li>';
}
echo '<li><a href="'.SITE_URL.$urlsettedEN."&amp;page=".($page_amount + 1).'">»</a></li>';
echo "</ul>";
}

}

}
?>

</html>

<?php ob_end_flush(); ?>