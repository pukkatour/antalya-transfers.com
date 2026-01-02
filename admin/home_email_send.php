<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

<div class="box box-info">

<div class="box-header"><i class="fa fa-envelope"></i><h3 class="box-title">Hızlı Email Gönder</h3></div>

<form action="home_email_deliver.php" method="POST" enctype="multipart/form-data">

<div class="box-body">

<div class="row">

<div class="col-md-6">
<label>Alıcı Email Adresi</label>
<div class="form-group">
<input type="email" class="form-control" name="emailto" placeholder="Alıcı Email Adresi" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<label>Email Tema Dili</label>
<div class="form-group">
<select name="temp_lang" class="form-control" required="">
<?php if (!empty($languagelist)) { foreach ($languagelist as $lang) { ?>
<option value="<?php echo $lang['lang_id']; ?>"><?php echo $lang['lang_name_eng']; ?></option>
<?php } } ?>
</select>
</div>
</div>

</div>

<div class="form-group">
<input type="text" class="form-control" name="subject" placeholder="Konu" maxlength="255" required="">
</div>

<div>
<textarea class="textarea h_inputs" placeholder="Mesaj" name="email_text" style="width: 98%; height: 120px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required=""></textarea>
</div>

</div>

<div class="box-footer clearfix">
<input type="hidden" name="MAX_FILE_SIZE" value="1000000"> Dosya Ekle:
<input name="userfile" type="file">
<button type="submit" class="pull-right btn btn-default" id="sendEmail">Gönder <i class="fa fa-arrow-circle-right"></i></button>
</div>

</form>

</div>

</div>