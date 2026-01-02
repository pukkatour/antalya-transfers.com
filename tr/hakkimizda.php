<?php
include_once('site_id.php');
include_once('../admin/include/initialize.inc.php');

$data = $Db->row("SELECT * FROM page_about_us WHERE page_lang_id = ?", array($site_lang));

$pagename = "Hakkımızda";
include_once("../hit_counter.php");

?>

<!DOCTYPE html>
<html lang="tr">

<head>

<title><?php echo $data['page_title']; ?></title>
<meta name="description" content="<?php echo $data['page_description']; ?>">
<meta name="keywords" content="<?php echo $data['page_keywords']; ?>">

<?php include_once("../head_meta.php"); ?>

<link rel="alternate" href="<?php echo SITE_URL; ?>about-us" hreflang="en-US" />

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
<div class="more-features-box-text-description"><?php echo html_entity_decode($data['page_main_text']); ?></div>
</div>

</div>

<div class="col-xs-12 col-sm-4 more-features-box wow fadeInLeft">
<img src="<?php echo IMAGE_FOLDER."pages/".$data['page_image1']; ?>" alt="<?php echo $sitesettings['site_name']; ?>" title="<?php echo $sitesettings['site_name']; ?>">
</div>

<div class="hidden-xs col-sm-4 more-features-box wow fadeInLeft">
<img src="<?php echo IMAGE_FOLDER."pages/".$data['page_image2']; ?>" alt="<?php echo $sitesettings['site_name']; ?>" title="<?php echo $sitesettings['site_name']; ?>">
</div>

<div class="hidden-xs col-sm-4 more-features-box wow fadeInLeft">
<img src="<?php echo IMAGE_FOLDER."pages/".$data['page_image3']; ?>" alt="<?php echo $sitesettings['site_name']; ?>" title="<?php echo $sitesettings['site_name']; ?>">
</div>

</div>

</div>
</div>


<?php include_once("footer.php"); ?>

<?php include_once("../footer_scripts.php"); ?>

</body>

</html>

<?php ob_end_flush(); ?>