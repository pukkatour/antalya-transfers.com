<?php $features = $Db->row("SELECT * FROM home_feautres WHERE features_lang_id = ?", array($site_lang)); ?>

<div class="video-container section-container section-container-gray-bg">
<div class="container">
<div class="row">

<div class="col-sm-5 fadeInUp animated">
<img src="<?php echo IMAGE_FOLDER."home/".$features['features_img']; ?>" class="img-responsive img-thumbnail" alt="<?php echo $sitesettings['site_name']; ?>" title="<?php echo $sitesettings['site_name']; ?>">
</div>

<div class="col-sm-6 col-sm-offset-1 video-box video-box-right wow fadeInUp">
<h3><?php echo $features['features_title']; ?></h3>
<p class="medium-paragraph"><i class="fa fa-check featuresicons"></i> <?php echo $features['features_text1']; ?></p>
<p class="medium-paragraph"><i class="fa fa-check featuresicons"></i> <?php echo $features['features_text2']; ?></p>
<p class="medium-paragraph"><i class="fa fa-check featuresicons"></i> <?php echo $features['features_text3']; ?></p>
<p class="medium-paragraph"><i class="fa fa-check featuresicons"></i> <?php echo $features['features_text4']; ?></p>
<p class="medium-paragraph"><i class="fa fa-check featuresicons"></i> <?php echo $features['features_text5']; ?></p>
<p class="medium-paragraph"><i class="fa fa-check featuresicons"></i> <?php echo $features['features_text6']; ?></p>
</div>

</div>
</div>
</div>