<div class="row">

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

<div class="box box-danger">

<?php if (empty($sitesettings['site_sms_pass'])) { ?><div class="box-header"><i class="fa fa-envelope"></i><h3 class="box-title">SMS hizmeti için APİ bilgileri eksik</h3></div><?php } else { ?>
<div class="box-header"><i class="fa fa-envelope"></i><h3 class="box-title">Hızlı SMS Gönder (TR numara için örn: 5300000000 | Yabancı numara için örn: 00447000000)</h3></div><?php } ?>

<form action="home_sms_deliver.php" method="POST">

<div class="box-body">

<input type="hidden" name="sms_sender_id" value="<?php echo $_SESSION['admin']['admin_id']; ?>">

<div class="col-md-2">
<div class="form-group">
<input type="text" class="form-control" name="smsto" placeholder="Alıcı Telefon" required="" maxlength="20" onkeypress="return isNumber(event)" <?php if (empty($sitesettings['site_sms_pass'])) { echo "disabled"; } ?>>
</div>
</div>

<div class="col-md-8">
<div class="form-group">
<input type="text" class="form-control" name="message" maxlength="160" placeholder="Mesaj 160 Karakter" required="" <?php if (empty($sitesettings['site_sms_pass'])) { echo "disabled"; } ?>>
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<button type="submit" class="btn btn-default" id="sendSms" <?php if (empty($sitesettings['site_sms_pass'])) { echo "disabled"; } ?>>Gönder <i class="fa fa-arrow-circle-right"></i></button>
</div>
</div>

</div>

</form>

</div>
</div>

</div>