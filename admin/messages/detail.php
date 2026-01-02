<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


$message_id = $_GET['message_id'];

$message    = $Db->row("SELECT contact_messages.*, country_list.country_phone_code, language_list.lang_name_eng FROM contact_messages LEFT JOIN country_list ON country_list.country_id = contact_messages.message_country LEFT JOIN language_list ON language_list.lang_id = contact_messages.message_lang_id WHERE message_id = ?", array($message_id));

$Db->query("UPDATE contact_messages SET message_seen = ? WHERE message_id = ?", array('1',$message_id));

?>

<!DOCTYPE html>
<html lang="tr">

<?php include_once("../head_meta.php"); ?>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

<?php include_once("../header.php"); ?>

<?php include_once("../left_menu.php"); ?>

<div class="content-wrapper">

<section class="content-header">
<h1>Yönetim Paneli<small>Version 1.2</small></h1>
<ol class="breadcrumb">
<li><a href="<?php echo SITE_URL."admin/index.php"; ?>"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
<li class="active">İletişim Mesaj Detayı</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-9">

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Mesaj Detay</h3>
</div>

<div class="box-body no-padding">

<div class="mailbox-read-info">
<h3><?php echo ucwords($message['message_name'])." ".ucwords($message['message_surname'])." | ".$message['country_phone_code']." ".$message['message_phone']; ?></h3><hr>
<h5><b style="color:#3C8DBC">Gönderen: <?php echo $message['message_email']; ?>
<span class="mailbox-read-time pull-right"><?php echo $message['message_date']." - ".$message['message_ip']; ?></span></b></h5>
</div>

<div class="mailbox-read-message">

<p><b>Dil/Site:</b> <?php echo $message['lang_name_eng']; ?></p>

<p><b>Başlık:</b> <?php echo $message['message_title']; ?></p>

<p><b>Mesaj:</b> <?php echo $message['message_text']; ?></p>

</div>

</div>

<div class="box-footer">

<form action="deliver.php" method="POST">

<div class="box-body">
<input type="hidden" name="email_reply_id" value="<?php echo $message['message_id']; ?>">
<input type="hidden" name="email_sender_id" value="<?php echo $_SESSION['admin']['admin_id']; ?>">
<input type="hidden" name="email_sender_email" value="<?php echo $sitesettings['site_contact_email']; ?>">
<input type="hidden" name="email_receiver_email" value="<?php echo $message['message_email']; ?>">
<input type="hidden" name="email_title" value="<?php echo $sitesettings['site_name']; ?>">
<input type="hidden" name="temp_lang" value="<?php echo $message['message_lang_id']; ?>">
<div class="form-group">
<textarea class="form-control h_inputs" name="email_text" rows="6" placeholder="Mesaj" required=""></textarea>
</div>
</div>

<div class="box-footer clearfix">
<button class="pull-right btn btn-default" id="sendEmail">Gönder <i class="fa fa-arrow-circle-right"></i></button>
</div>

</form>

</div>

</div>

</div>

</div>

</section>

</div>

<?php include_once("../footer.php"); ?>

</div>

<?php include_once("../footer_scripts.php"); ?>

</body>
</html>