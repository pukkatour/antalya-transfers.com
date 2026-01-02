<nav class="navbar navbar-inverse">
<div class="container">

<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
<span class="sr-only">Toggle</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="<?php echo $selectedlang['lang_url']; ?>" title="<?php echo $sitesettings['site_name']; ?>">
<img src="<?php echo IMAGE_FOLDER.$sitesettings['site_logo']; ?>" alt="<?php echo $sitesettings['site_name']; ?>" title="<?php echo $sitesettings['site_name']; ?>">
</a>
</div>

<div class="collapse navbar-collapse" id="top-navbar-1">
<ul class="nav navbar-nav navbar-right">
<li><a href="<?php echo $selectedlang['lang_url']; ?>" title="<?php echo $sitesettings['site_name']; ?>"><i class="fa fa-home"></i></a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>about-us" title="<?php echo $sitesettings['site_name']; ?>">ABOUT US</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>frequently-asked-questions" title="<?php echo $sitesettings['site_name']; ?>">FAQ</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>customer-reviews" title="<?php echo $sitesettings['site_name']; ?>">REVIEWS <span class="badge"><?php echo $totalreviews["revs"]; ?></span></a></li>
<li class="hidden-sm"><a href="<?php echo $selectedlang['lang_url']; ?>airport-transfers/" title="<?php echo $sitesettings['site_name']; ?>">ALL TRANSFERS</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>contact-us" title="<?php echo $sitesettings['site_name']; ?>">CONTACT</a></li>
<li class="hidden-sm"><a href="<?php echo $selectedlang['lang_url']; ?>my-booking" title="<?php echo $sitesettings['site_name']; ?>">MY BOOKING</a></li>

<?php
$aval_langs = $Db->query("SELECT * FROM language_list WHERE lang_status = ? AND lang_id != ?", array("1",$selectedlang['lang_id']));
if (!empty($aval_langs)) { foreach ($aval_langs as $aval_lang) {
?>
<li class="hidden-sm"><a href="<?php echo $aval_lang['lang_url']; ?>" title="<?php echo $sitesettings['site_name']; ?>"><img style="max-height: 20px;" src="<?php echo IMAGE_FOLDER."flags/".$aval_lang['lang_flag']; ?>" class="img-responsive" alt="<?php echo $sitesettings['site_name']; ?>"></a></li>
<?php } } ?>

</ul>
</div>

</div>
</nav>