<aside class="main-sidebar">
<section class="sidebar">

<div class="user-panel">
<div class="pull-left image"><img src="<?php echo IMAGE_FOLDER."admin/".$_SESSION['admin']['admin_image']; ?>" class="img-circle" alt=""></div>
<div class="pull-left info">
<p><?php echo $_SESSION['admin']['admin_name']." ".$_SESSION['admin']['admin_surname']; ?></p>
<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
</div>
</div>

<ul class="sidebar-menu" data-widget="tree">




<!---  --->
<li class="header">YÖNETİM PANELİ</li>
<!---  --->




<li class="<?php if (URL_NOQUERY == "/admin/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/index.php"><i class="fa fa-home"></i> <span>Ana Sayfa</span></a></li>
<li class="<?php if (URL_NOQUERY == "/admin/admin/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/admin/index.php"><i class="fa fa-user"></i> <span>Yöneticiler</span></a></li>
<li class="<?php if (URL_NOQUERY == "/admin/agents/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/agents/index.php"><i class="fa fa-users"></i> <span>Acenteler</span></a></li>
<li class="treeview <?php if (URL_PATH == "/admin/directory") { echo "active"; } ?>">

<a href="#">
<i class="fa fa-book"></i> <span>Rehber</span>
<span class="pull-right-container">
<i class="fa fa-angle-right pull-right"></i>
</span>
</a>

<ul class="treeview-menu">
<li class="<?php if (URL_NOQUERY == "/admin/directory/categories.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/directory/categories.php">
<i class="fa fa-id-card-o"></i> Kategoriler</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/directory/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/directory/index.php">
<i class="fa fa-book"></i> Rehber</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/directory/mass_email.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/directory/mass_email.php">
<i class="fa fa-book"></i> Email Gönderim</a>
</li>
</ul>

</li>




<!---  --->
<li class="header">REZERVASYON İŞLEMLERİ</li>
<!---  --->




<li class="treeview <?php if (URL_PATH == "/admin/bookings") { echo "active"; } ?>">

<a href="#">
<i class="fa fa fa-shopping-cart"></i> <span>Rezervasyonlar</span>
<span class="pull-right-container">
<i class="fa fa-angle-right pull-right"></i>
</span>
</a>

<ul class="treeview-menu">
<li class="<?php if (NO_DOMAIN_FOLDER_URL == "/admin/bookings/index.php?status=0") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/bookings/index.php?status=0">
<i class="fa fa-minus"></i> Bekleyen</a>
</li>
<li class="<?php if (NO_DOMAIN_FOLDER_URL == "/admin/bookings/index.php?status=1") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/bookings/index.php?status=1">
<i class="fa fa-check"></i> Onaylanmış</a>
</li>
<li class="<?php if (NO_DOMAIN_FOLDER_URL == "/admin/bookings/index.php?status=2") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/bookings/index.php?status=2">
<i class="fa fa-thumbs-o-up"></i> Tamamlanmış</a>
</li>
<li class="<?php if (NO_DOMAIN_FOLDER_URL == "/admin/bookings/index.php?status=3") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/bookings/index.php?status=3">
<i class="fa fa-times"></i> İptal</a>
</li>
</ul>

</li>
<!---  --->




<!---  --->
<li class="header">TRANSFER İŞLEMLERİ</li>
<!---  --->


<!---  --->
<li class="treeview <?php if (URL_PATH == "/admin/transfers") { echo "active"; } ?>">

<a href="#"><i class="fa fa-plane text-red"></i> Havalimanı Transferi
<span class="pull-right-container">
<i class="fa fa-angle-right pull-right"></i>
</span>
</a>

<ul class="treeview-menu">
<li class="<?php if (URL_NOQUERY == "/admin/transfers/airports.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/transfers/airports.php?lang=1">
<i class="fa fa-plane"></i> Havaalanları</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/transfers/vehicles.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/transfers/vehicles.php?lang=1">
<i class="fa fa-car"></i> Araç Türleri</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/transfers/resorts.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/transfers/resorts.php?lang=1&type=1">
<i class="fa fa-list"></i> Destinasyonlar</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/transfers/prices.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/transfers/prices.php?port=0">
<i class="fa fa-money"></i> Fiyat Düzenleme</a>
</li>
</ul>

</li>
<!---  --->




<!---  --->
<li class="header">SİSTEM</li>
<!---  --->


<!---  --->
<li class="treeview <?php if (URL_PATH == "/admin/definitions") { echo "active"; } ?>">

<a href="#">
<i class="fa fa-list-ul text-aqua"></i> <span>Genel Tanımlar</span>
<span class="pull-right-container">
<i class="fa fa-angle-right pull-right"></i>
</span>
</a>

<ul class="treeview-menu">
<li class="<?php if (URL_NOQUERY == "/admin/definitions/languages.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/definitions/languages.php">
<i class="fa fa-language"></i> Diller</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/definitions/country_list.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/definitions/country_list.php">
<i class="fa fa-globe"></i> Ülke Listesi</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/definitions/city_list.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/definitions/city_list.php">
<i class="fa fa-globe"></i> Şehir Listesi</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/definitions/county_list.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/definitions/county_list.php">
<i class="fa fa-globe"></i> İlçe Listesi</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/definitions/currencies.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/definitions/currencies.php">
<i class="fa fa-money"></i> Para Birimleri</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/definitions/currency_list.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/definitions/currency_list.php">
<i class="fa fa-eur"></i> Döviz Kurları</a>
</li>
</ul>

</li>
<!---  --->



<!---  --->
<li class="treeview <?php if (URL_PATH == "/admin/site_settings" OR URL_PATH == "/admin/translate") { echo "active"; } ?>">

<a href="#">
<i class="fa fa-cogs text-red"></i> <span>Sistem Ayarları</span>
<span class="pull-right-container">
<i class="fa fa-angle-right pull-right"></i>
</span>
</a>

<ul class="treeview-menu">
<li class="<?php if (URL_NOQUERY == "/admin/site_settings/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/site_settings/index.php?lang_id=1">
<i class="fa fa-cogs"></i> Genel Ayarlar</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/site_settings/email_template.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/site_settings/email_template.php?lang_id=1">
<i class="fa fa-envelope"></i> Email Teması</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/site_settings/booking_template.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/site_settings/booking_template.php?lang_id=1">
<i class="fa fa-envelope"></i> Rezervasyon Teması</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/site_settings/footer.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/site_settings/footer.php?lang_id=1">
<i class="fa fa-envelope"></i> Footer </a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/translate/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/translate/index.php?lang_id=1">
<i class="fa fa-globe"></i> Çeviriler </a>
</li>
</ul>

</li>
<!---  --->



<!---  --->
<li class="header">İÇERİK</li>
<!---  --->


<!---  --->
<li class="treeview <?php if (URL_PATH == "/admin/pages/home" OR URL_PATH == "/admin/pages/about_us" OR URL_PATH == "/admin/pages/contact_us" OR URL_PATH == "/admin/pages/reviews" OR URL_PATH == "/admin/pages/faq" OR URL_PATH == "/admin/pages/transfer" OR URL_PATH == "/admin/pages/transfer_list" OR URL_PATH == "/admin/pages/my_booking" OR URL_PATH == "/admin/pages/terms_and_conditions" OR URL_PATH == "/admin/pages/cancellation_policy" OR URL_PATH == "/admin/pages/privacy_policy" OR URL_PATH == "/admin/pages/cookies" OR URL_PATH == "/admin/pages/404") { echo "active"; } ?>">

<a href="#">
<i class="fa fa-file text-yellow"></i> <span>Sabit Sayfalar</span>
<span class="pull-right-container">
<i class="fa fa-angle-right pull-right"></i>
</span>
</a>

<ul class="treeview-menu">
<li class="<?php if (URL_NOQUERY == "/admin/pages/home/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/pages/home/index.php?lang_id=1">
<i class="fa fa-file-o"></i> Ana Sayfa</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/pages/about_us/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/pages/about_us/index.php?lang_id=1">
<i class="fa fa-file-o"></i> Hakkımızda</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/pages/contact_us/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/pages/contact_us/index.php?lang_id=1">
<i class="fa fa-file-o"></i> İletişim</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/pages/reviews/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/pages/reviews/index.php?lang_id=1">
<i class="fa fa-file-o"></i> Yorumlar</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/pages/faq/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/pages/faq/index.php?lang_id=1">
<i class="fa fa-file-o"></i> Sık Sorulan Sorular</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/pages/transfer/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/pages/transfer/index.php?lang_id=1">
<i class="fa fa-file-o"></i> Transfer Detay</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/pages/transfer_list/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/pages/transfer_list/index.php?lang_id=1">
<i class="fa fa-file-o"></i> Transfer Listesi</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/pages/my_booking/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/pages/my_booking/index.php?lang_id=1">
<i class="fa fa-file-o"></i> Rezervasyonum</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/pages/terms_and_conditions/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/pages/terms_and_conditions/index.php?lang_id=1">
<i class="fa fa-file-o"></i> Şartlar & Koşullar</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/pages/cancellation_policy/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/pages/cancellation_policy/index.php?lang_id=1">
<i class="fa fa-file-o"></i> İptal Politikası</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/pages/privacy_policy/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/pages/privacy_policy/index.php?lang_id=1">
<i class="fa fa-file-o"></i> Gizlilik Politikası</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/pages/cookies/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/pages/cookies/index.php?lang_id=1">
<i class="fa fa-file-o"></i> Cookie'ler</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/pages/404/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/pages/404/index.php?lang_id=1">
<i class="fa fa-file-o"></i> 404</a>
</li>
</ul>

</li>
<!---  --->


<!---  --->
<li class="treeview <?php if (URL_PATH == "/admin/home_settings/slider" OR URL_PATH == "/admin/home_settings/welcome" OR URL_PATH == "/admin/home_settings/modal" OR URL_PATH == "/admin/home_settings/why_us" OR URL_PATH == "/admin/home_settings/feautres") { echo "active"; } ?>">

<a href="#">
<i class="fa fa-home text-green"></i> <span>Ana Sayfa Ayarları</span>
<span class="pull-right-container">
<i class="fa fa-angle-right pull-right"></i>
</span>
</a>

<ul class="treeview-menu">
<li class="<?php if (URL_NOQUERY == "/admin/home_settings/slider/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/home_settings/slider/index.php?lang_id=1">
<i class="fa fa-picture-o"></i> Slider</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/home_settings/welcome/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/home_settings/welcome/index.php?lang_id=1">
<i class="fa fa-hand-spock-o"></i> Karşılama Alanı</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/home_settings/why_us/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/home_settings/why_us/index.php?lang_id=1">
<i class="fa fa-outdent"></i> Neden Biz Bölümü</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/home_settings/feautres/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/home_settings/feautres/index.php?lang_id=1">
<i class="fa fa-outdent"></i> Özellikler Bölümü</a>
</li>
<li class="<?php if (URL_NOQUERY == "/admin/home_settings/modal/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/home_settings/modal/index.php?lang_id=1">
<i class="fa fa-comment"></i> Popup Bildirim</a>
</li>
</ul>

</li>


<li class="<?php if (URL_NOQUERY == "/admin/pages/info_pages/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/pages/info_pages/index.php?lang=1"><i class="fa fa-file-text"></i> <span>Tanıtım Sayfaları</span></a></li>
<li class="<?php if (URL_NOQUERY == "/admin/reviews/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/reviews/index.php"><i class="fa fa-users"></i> <span>Yorumlar</span></a></li>
<li class="<?php if (URL_NOQUERY == "/admin/faq/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/faq/index.php?lang=1"><i class="fa fa-question"></i> <span>Sorular</span></a></li>
<!---  --->



<!---  --->
<li class="header">...</li>
<!---  --->



<!---  --->
<li class="<?php if (URL_NOQUERY == "/admin/messages/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/messages/index.php"><i class="fa fa-pie-chart"></i> <span>İletişim Formu</span></a></li>
<li class="<?php if (URL_NOQUERY == "/admin/analytics/index.php") { echo "active"; } ?>"><a href="<?php echo SITE_URL; ?>admin/analytics/index.php"><i class="fa fa-pie-chart"></i> <span>Trafik / İstatistik</span></a></li>
<li><a href="<?php echo SITE_URL; ?>" target="_blank"><i class="fa fa-arrow-circle-o-right text-blue"></i> <span>Siteye Geçiş</span></a></li>
<li><a href="<?php echo SITE_URL; ?>admin/log_out.php"><i class="fa fa-sign-out text-red"></i> <span>Çıkış</span></a></li>
<!---  --->



</ul>

</section>
</aside>