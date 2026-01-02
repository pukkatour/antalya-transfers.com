<?php $welcome = $Db->row("SELECT * FROM home_welcome WHERE welcome_lang_id = ?", array($site_lang)); ?>

<div class="top-content">

<div id="top-content" class="hidden-xs topcon"></div>

<div class="overlay"></div>

<div class="container">

<div class="row">

<div class="col-md-5 r-form-1-box wow fadeInLeft">

<div class="r-form-1-top">

<div class="r-form-1-top-left">
<h3><?php echo $welcome['welcome_left_title']; ?></h3>
<p><?php echo $welcome['welcome_left_text']; ?></p>
</div>

<div class="r-form-1-top-right">
<i class="fa fa-plane"></i>
</div>

</div>

<div class="r-form-1-bottom">

<?php include_once("form.php"); ?>

</div>

</div>

<div class="col-md-7 text wow fadeInUp containerx" id="scroll">

<h6 class="wlcome hidden-xs"><?php echo $welcome['welcome_right_title']; ?> <span class="typed-text"></span><span class="cursor">&nbsp;</span></h6>

<div class="description hidden-xs">
<p class="medium-paragraph"><?php echo $welcome['welcome_right_text']; ?></p>
</div>

<div class="top-buttons hidden-xs">
<a class="btn btn-link-1" href="<?php echo $selectedlang['lang_url'].$welcome['welcome_url1']; ?>" title="<?php echo $sitesettings['site_name']; ?>"><?php echo $welcome['welcome_button1']; ?> <i class="fa fa-angle-right"></i></a>
<a class="btn btn-link-2" href="<?php echo $selectedlang['lang_url'].$welcome['welcome_url2']; ?>" title="<?php echo $sitesettings['site_name']; ?>"><?php echo $welcome['welcome_button2']; ?> <i class="fa fa-lightbulb-o"></i></a>
</div>

<div id="getlostcanim" class="padtop30 hidden-xs">

<h4 id="text_1" class="padbot5 dispno"><?php echo $welcome['welcome_sub1']; ?></h4>
<h4 id="text_2" class="padbot5 dispno"><?php echo $welcome['welcome_sub2']; ?></h4>
<h4 id="text_3" class="padbot5 dispno"><?php echo $welcome['welcome_sub3']; ?></h4>
<h4 id="text_4" class="padbot5 dispno"><?php echo $welcome['welcome_sub4']; ?></h4>
<h4 id="text_5"><?php echo $welcome['welcome_sub5']; ?></h4>

</div>

<div class="r-form-1-bottom formrex" id="result">

<form id="transfer_form" method="POST">

<div class="row">

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
<img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" class="img-responsive img-thumbnail" id="result_vehicle" alt="<?php echo $sitesettings['site_name']; ?>" title="<?php echo $sitesettings['site_name']; ?>">
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
<hr class="visible-xs">
<p class="wlcome" id="result_duration"></p>
<p id="result_distance"></p>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
<hr class="visible-xs">
<p class="wlcome" id="result_price"></p>
<p><?php echo $translate['tr_002']; ?></p>
</div>

<div class="col-md-12 text-center">
<hr>
<button type="submit" class="btn btn-link-1"><?php echo $translate['tr_001']; ?></button>
</div>

</div>

<input type="hidden" id="b_type" name="b_type" value="">
<input type="hidden" id="b_direction" name="b_direction" value="">
<input type="hidden" id="b_from" name="b_from" value="">
<input type="hidden" id="b_to" name="b_to" value="">
<input type="hidden" id="b_pax" name="b_pax" value="">
<input type="hidden" id="b_curr" name="b_curr" value="">
<input type="hidden" id="b_way" name="b_way" value="">
<input type="hidden" id="b_price" name="b_price" value="">

</form>

</div>

</div>

</div>

</div>

</div>