<?php $footer = $Db->row("SELECT * FROM footer WHERE footer_lang_id = ?", array($site_lang)); ?>

<footer>
<div class="container">

<div class="row">

<div class="col-sm-4 footer-about wow fadeInUp">
<h3><?php echo $footer['footer_title_1']; ?></h3>
<p><?php echo $footer['footer_text_1']; ?></p>
</div>

<div class="col-sm-4 footer-contact-info wow fadeInDown">
<h3><?php echo $footer['footer_title_2']; ?></h3>
<p><i class="fa fa-map-marker"></i> <?php echo $sitesettings['site_address_1']." ".$sitesettings['site_address_2']; ?></p>
<p><i class="fa fa-phone"></i> <?php echo $footer['footer_text_2_1']; ?> <?php echo $sitesettings['site_phone_1']; ?></p>
<p><i class="fa fa-phone"></i> <?php echo $footer['footer_text_2_2']; ?> <?php echo $sitesettings['site_phone_2']; ?></p>
<p><i class="fa fa-envelope"></i> <?php echo $footer['footer_text_2_3']; ?> <a href="mailto:<?php echo $sitesettings['site_email']; ?>" title="<?php echo $sitesettings['site_name']; ?>"><?php echo $sitesettings['site_email']; ?></a></p>
</div>

<div class="col-sm-4 footer-social wow fadeInUp">
<h3><?php echo $footer['footer_title_3']; ?></h3>
<p><?php echo $footer['footer_text_3']; ?></p>
<p>
<a href="<?php echo $sitesettings['site_facebook']; ?>" target="_blank" title="<?php echo $sitesettings['site_name']; ?>"><i class="fa fa-facebook"></i></a>
<a href="<?php echo $sitesettings['site_instagram']; ?>" target="_blank" title="<?php echo $sitesettings['site_name']; ?>"><i class="fa fa-instagram"></i></a>
<a href="//www.dmca.com/Protection/Status.aspx?ID=000c0d45-3844-416a-9b3d-6c66567133c7" title="DMCA.com Protection Status" class="dmca-badge">
<img src="https://images.dmca.com/Badges/dmca_protected_17_120.png?ID=000c0d45-3844-416a-9b3d-6c66567133c7" alt="DMCA.com Protection Status" title="<?php echo $sitesettings['site_name']; ?>"/>
</a>
</p>

<a href="https://www.tursab.org.tr/tr/ddsv" target="_blank"><img src="<?php echo IMAGE_FOLDER."tursab-dvs-18166.png"; ?>" alt="pravdatur" class="img-fluid" style="max-width: 200px;"></a>

</div>

</div>

<div class="row">

<div class="col-sm-12 footer-menu">
<ul class="text-center">
<li>Go to:</li>
<li><a class="scroll-link" href="#top-content">Top</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>about-us" title="<?php echo $sitesettings['site_name']; ?>">About Us</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>contact-us" title="<?php echo $sitesettings['site_name']; ?>">Contact Us</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>airport-transfers/" title="<?php echo $sitesettings['site_name']; ?>">All Transfers</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>my-booking" title="<?php echo $sitesettings['site_name']; ?>">My Booking</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>customer-reviews" title="<?php echo $sitesettings['site_name']; ?>">Reviews</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>terms-and-conditions" title="<?php echo $sitesettings['site_name']; ?>">Terms & Conditions</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>cancellation-policy" title="<?php echo $sitesettings['site_name']; ?>">Cancellation Policy</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>privacy-policy" title="<?php echo $sitesettings['site_name']; ?>">Privacy Policy</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>cookies" title="<?php echo $sitesettings['site_name']; ?>">Cookies</a></li>
</ul>
</div>

<div class="col-sm-12 footer-copyright text-center havali">
<?php
$info_pages = $Db->query("SELECT page_name,page_slug FROM info_pages WHERE page_lang_id = ? AND page_stat = ? ", array($site_lang,'2'));
if (!empty($info_pages)) { $no = 1; foreach ($info_pages as $info_page) {
?>
<a href="<?php echo $selectedlang['lang_url']."antalya-guide/".$info_page['page_slug']; ?>/"><?php echo $info_page['page_name']; ?></a> <?php if ($no < count($info_pages)) { echo ' | '; } ?>
<?php $no++; } } ?>
</div>

<div class="row">

<div class="col-sm-12 footer-menu hidden-xs">
<ul class="text-center">
<li><a href="https://www.bodrum-transfers.com" title="Bodrum Transfers"><img src="<?php echo IMAGE_FOLDER; ?>bodrum-logo.png" style="height: 80px;filter: grayscale(80%);" alt="Bodrum Transfers"></a></li>
<li><a href="https://www.cappadocia-transfers.com" title="Cappadocia Transfers"><img src="<?php echo IMAGE_FOLDER; ?>cappadocia-logo.png" style="height: 80px;filter: grayscale(80%);" alt="Cappadocia Transfers"></a></li>
<li><a href="https://www.fethiye-transfers.com" title="Fethiye Transfers"><img src="<?php echo IMAGE_FOLDER; ?>fethiye-logo.png" style="height: 80px;filter: grayscale(80%);" alt="Fethiye Transfers"></a></li>
<li><a href="https://www.istanbul-transfers.com" title="Istanbul Transfers"><img src="<?php echo IMAGE_FOLDER; ?>istanbul-logo.png" style="height: 80px;filter: grayscale(80%);" alt="Istanbul Transfers"></a></li>
</ul>
</div>

</div>

<div class="col-sm-12 footer-copyright text-center">
<?php echo $sitesettings['site_footer_text']." ".date("Y"); ?> | <a href="https://www.hakanerenler.net" target="_blank" title="Hakan Erenler Tourism Web Developer">Web Design</a>
</div>

</div>

</div>
</footer>

<?php if (!empty($sitesettings['site_whatssapp'])) { ?>
<a href="https://api.whatsapp.com/send?phone=<?php echo $sitesettings['site_whatssapp']; ?>" class="watfloat" target="_blank">
<img src="<?php echo IMAGE_FOLDER; ?>whatsapp.svg" alt="<?php echo $sitesettings['site_name']; ?>" title="<?php echo $sitesettings['site_name']; ?>">
</a>
<?php } ?>