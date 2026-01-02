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

<a href="https://www.tursab.org.tr/tr/ddsv" target="_blank"><img src="<?php echo IMAGE_FOLDER."tursab-dds-18166.png"; ?>" alt="pravdatur" class="img-fluid" style="max-width: 200px;"></a>

</div>

</div>

<div class="row">

<div class="col-sm-12 footer-menu">
<ul class="text-center">
<li>Go to:</li>
<li><a class="scroll-link" href="#top-content">Top</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>hakkimizda" title="<?php echo $sitesettings['site_name']; ?>">Hakkımızda</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>iletisim" title="<?php echo $sitesettings['site_name']; ?>">İletişim</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>havalimani-transferleri/" title="<?php echo $sitesettings['site_name']; ?>">Tüm Transferler</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>rezervasyonum" title="<?php echo $sitesettings['site_name']; ?>">Rezervasyonum</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>musteri-yorumlari" title="<?php echo $sitesettings['site_name']; ?>">Yorumlar</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>sartlar-kosullar" title="<?php echo $sitesettings['site_name']; ?>">Şartlar & Koşullar</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>iptal-politikasi" title="<?php echo $sitesettings['site_name']; ?>">İptal Politikası</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>gizlilik-politikasi" title="<?php echo $sitesettings['site_name']; ?>">Gizlilik Politikası</a></li>
<li><a href="<?php echo $selectedlang['lang_url']; ?>cerezler" title="<?php echo $sitesettings['site_name']; ?>">Çerezler</a></li>
</ul>
</div>

<div class="col-sm-12 footer-copyright text-center havali">
<?php
$info_pages = $Db->query("SELECT page_name,page_slug FROM info_pages WHERE page_lang_id = ? AND page_stat = ? ", array($site_lang,'2'));
if (!empty($info_pages)) { $no = 1; foreach ($info_pages as $info_page) {
?>
<a href="<?php echo $selectedlang['lang_url']."antalya-rehberi/".$info_page['page_slug']; ?>/"><?php echo $info_page['page_name']; ?></a> <?php if ($no < count($info_pages)) { echo ' | '; } ?>
<?php $no++; } } ?>
</div>

<div class="row">

<div class="col-sm-12 footer-menu hidden-xs">
<ul class="text-center">
<li><a href="https://www.bodrum-transfers.com/tr/" title="Bodrum Transfer"><img src="<?php echo IMAGE_FOLDER; ?>bodrum-logo.png" style="height: 80px;filter: grayscale(80%);" alt="Bodrum Transfer"></a></li>
<li><a href="https://www.cappadocia-transfers.com/tr/" title="Kapadokya Transfer"><img src="<?php echo IMAGE_FOLDER; ?>cappadocia-logo.png" style="height: 80px;filter: grayscale(80%);" alt="Kapadokya Transfer"></a></li>
<li><a href="https://www.fethiye-transfers.com/tr/" title="Fethiye Transfer"><img src="<?php echo IMAGE_FOLDER; ?>fethiye-logo.png" style="height: 80px;filter: grayscale(80%);" alt="Fethiye Transfer"></a></li>
<li><a href="https://www.istanbul-transfers.com/tr/" title="İstanbul Transfer"><img src="<?php echo IMAGE_FOLDER; ?>istanbul-logo.png" style="height: 80px;filter: grayscale(80%);" alt="İstanbul Transfer"></a></li>
</ul>
</div>

</div>

<div class="col-sm-12 footer-copyright text-center">
<?php echo $sitesettings['site_footer_text']." ".date("Y"); ?> | <a href="https://www.hakanerenler.net" target="_blank" title="Hakan Erenler Turizm Web Yazılımı">Web Design</a>
</div>

</div>

</div>
</footer>

<?php if (!empty($sitesettings['site_whatssapp'])) { ?>
<a href="https://api.whatsapp.com/send?phone=<?php echo $sitesettings['site_whatssapp']; ?>" class="watfloat" target="_blank">
<img src="<?php echo IMAGE_FOLDER; ?>whatsapp.svg" alt="<?php echo $sitesettings['site_name']; ?>" title="<?php echo $sitesettings['site_name']; ?>">
</a>
<?php } ?>