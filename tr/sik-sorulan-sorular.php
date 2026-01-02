<?php
include_once('site_id.php');
include_once('../admin/include/initialize.inc.php');

$data = $Db->row("SELECT * FROM page_faq WHERE page_lang_id = ?", array($site_lang));

$faqs = $Db->query("SELECT * FROM faq_list WHERE faq_status = ? AND faq_lang_id = ?", array('1',$site_lang));

$pagename = "SSS";
include_once("../hit_counter.php");

?>

<!DOCTYPE html>
<html lang="tr">

<head>

<title><?php echo $data['page_title']; ?></title>
<meta name="description" content="<?php echo $data['page_description']; ?>">
<meta name="keywords" content="<?php echo $data['page_keywords']; ?>">

<?php include_once("../head_meta.php"); ?>

<link rel="alternate" href="<?php echo SITE_URL; ?>frequently-asked-questions" hreflang="en-US" />

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

<?php if (!empty($faqs)) { foreach ($faqs as $faq) { ?>
<div class="more-features-box-text">
<div class="more-features-box-text-icon"><i class="fa fa-question"></i></div>
<h3><?php echo $faq['faq_question']; ?></h3>
<div class="more-features-box-text-description"><?php echo $faq['faq_answer']; ?></div>
</div>
<?php } } ?>

</div>

</div>

</div>
</div>


<?php include_once("footer.php"); ?>

<?php include_once("../footer_scripts.php"); ?>

</body>

</html>

<?php ob_end_flush(); ?>