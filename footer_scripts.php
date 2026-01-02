<script src="<?php echo SITE_URL; ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo SITE_URL; ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo SITE_URL; ?>assets/js/scripts.js"></script>
<script src="<?php echo SITE_URL ;?>assets/js/bootstrap-datepicker.min.en.js"></script>
<script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $sitesettings['site_analytics_code']; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo $sitesettings['site_analytics_code']; ?>');
</script>

<script type="application/ld+json">
{"@context": "https://schema.org/","@type": "WebSite","name": "Antalya Transfers","url": "https://www.antalya-transfers.com/","potentialAction": {"@type": "SearchAction","target": "https://www.antalya-transfers.com/airport-transfers/{search_term_string}","query-input": "required name=search_term_string"}}
</script>