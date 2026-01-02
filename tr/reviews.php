<?php $reviews = $Db->query("SELECT * FROM reviews WHERE review_status = ? ORDER BY RAND() LIMIT 6", array('1')); ?>

<div class="more-features-container section-container">
<div class="container">

<div class="row">
<div class="col-sm-12 more-features section-description wow fadeIn">
<h2><?php echo $data['page_reviews_title']; ?></h2>
<div class="divider-1"><div class="line"></div></div>
<p class="medium-paragraph"><?php echo $data['page_reviews_text']; ?></p>
</div>
</div>

<div class="row">

<div class="col-sm-12 more-features-box wow fadeInLeft">

<?php if (!empty($reviews)) { foreach ($reviews as $review) { ?>
<div class="more-features-box-text">
<div class="more-features-box-text-icon"><i class="fa fa-comments"></i></div>
<h3><?php echo $review['review_name']; ?> <small><?php echo $review['review_date']; ?></small></h3>
<div class="more-features-box-text-description"><?php echo $review['review_text']; ?></div>
</div>
<?php } } ?>

</div>

</div>

<div class="row">
<div class="col-sm-12 section-bottom-button wow fadeInUp animated bac">
<a class="btn btn-link-1" href="<?php echo $selectedlang['lang_url']; ?>musteri-yorumlari" title="<?php echo $sitesettings['site_name']; ?>"><?php echo $data['page_reviews_button']; ?> <i class="fa fa-angle-right"></i></a>
</div>
</div>

</div>
</div>