<?php $why_us = $Db->row("SELECT * FROM home_whyus WHERE whyus_lang_id = ?", array($site_lang)); ?>

<div class="features-container section-container">
<div class="container">

<div class="row">
<div class="col-sm-12 features section-description wow fadeIn">
<h1 class="underline padbot30"><?php echo $sitesettings['site_name']; ?></h1>
<h2><?php echo $why_us['whyus_title']; ?></h2>
<div class="divider-1"><div class="line"></div></div>
<?php echo $why_us['whyus_text']; ?>
</div>
</div>

<div class="row">

<div class="col-sm-4 features-box wow fadeInUp">
<div class="features-box-icon"><i class="<?php echo $why_us['whyus_icon1']; ?>"></i></div>
<h3><?php echo $why_us['whyus_title1']; ?></h3>
<p><?php echo $why_us['whyus_text1']; ?></p>
</div>

<div class="col-sm-4 features-box wow fadeInDown">
<div class="features-box-icon"><i class="<?php echo $why_us['whyus_icon2']; ?>"></i></div>
<h3><?php echo $why_us['whyus_title2']; ?></h3>
<p><?php echo $why_us['whyus_text2']; ?></p>
</div>

<div class="col-sm-4 features-box wow fadeInUp">
<div class="features-box-icon"><i class="<?php echo $why_us['whyus_icon3']; ?>"></i></div>
<h3><?php echo $why_us['whyus_title3']; ?></h3>
<p><?php echo $why_us['whyus_text3']; ?></p>
</div>

</div>

</div>
</div>