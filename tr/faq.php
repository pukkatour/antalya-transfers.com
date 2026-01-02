<?php $faqs = $Db->query("SELECT * FROM faq_list WHERE faq_status = ? AND faq_show_home = ? AND faq_lang_id = ? LIMIT 4", array('1','1',$site_lang)); ?>

<div class="faq-container section-container">
<div class="container">

<div class="row">
<div class="col-sm-12 faq section-description wow fadeIn">
<h2><?php echo $data['page_faq_title']; ?></h2>
<div class="divider-1"><div class="line"></div></div>
<p class="medium-paragraph"><?php echo $data['page_faq_text']; ?></p>
</div>
</div>

<div class="row">

<div class="col-sm-6 col-md-6 faq-box activex wow fadeInUp minh400">
<div class="faq-number">1</div>
<h3><?php echo $faqs[0]['faq_question']; ?></h3>
<p><?php echo $faqs[0]['faq_answer']; ?></p>
</div>

<div class="col-sm-6 col-md-6 faq-box wow fadeInDown minh400">
<div class="faq-number">2</div>
<h3><?php echo $faqs[1]['faq_question']; ?></h3>
<p><?php echo $faqs[1]['faq_answer']; ?></p>
</div>

</div>

<div class="row">

<div class="col-sm-6 col-md-6 faq-box wow fadeInUp minh400">
<div class="faq-number">3</div>
<h3><?php echo $faqs[2]['faq_question']; ?></h3>
<p><?php echo $faqs[2]['faq_answer']; ?></p>
</div>

<div class="col-sm-6 col-md-6 faq-box activex wow fadeInDown minh400">
<div class="faq-number">4</div>
<h3><?php echo $faqs[3]['faq_question']; ?></h3>
<p><?php echo $faqs[3]['faq_answer']; ?></p>
</div>

</div>

<div class="row">
<div class="col-sm-12 section-bottom-button wow fadeInUp animated bac">
<a class="btn btn-link-1" href="<?php echo $selectedlang['lang_url']; ?>sik-sorulan-sorular" title="<?php echo $sitesettings['site_name']; ?>"><?php echo $data['page_faq_button']; ?> <i class="fa fa-angle-right"></i></a>
</div>
</div>

</div>
</div>