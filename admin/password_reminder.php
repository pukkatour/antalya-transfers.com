<?php
include_once('include/site_id.php');
include_once('include/initialize.inc.php');
include_once('include/class.phpmailer.php');
include_once('include/class.smtp.php');
if (!empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$admin_email    = $_POST['admin_email'];

if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) { $error['email'] = true; }

if (empty($error)) {

$admin = $Db->row("SELECT * FROM admin WHERE admin_email = ? AND admin_status = ?", array($admin_email,'2'));

if (!empty($admin)) {

$name           = $admin['admin_name']." ".$admin['admin_surname'];
$alphabet       = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
$pass           = array();
$alphaLength    = strlen($alphabet) - 1;
for ($i = 0; $i < 8; $i++) {
$n      = rand(0, $alphaLength);
$pass[] = $alphabet[$n];
}

$newpass        = implode($pass);

$update_admin   = $Db->query("UPDATE admin SET admin_password = ? WHERE admin_id = ? ", array(md5($newpass),$admin['admin_id']));

$email_title    = "Şifre Hatırlatma";
$emailbodytitle = "Şifre Hatırlatma";
$emailbodytext  = "Merhaba ".$name."<br><br>Email: ".$admin_email."<br>IP: ".getIP()."<br>Yeni Şifre: <b>".$newpass."</b><br><br>Yeni şifreniz ile sisteme giriş yapabilirsiniz.";

include_once('../email_template.php');

$subject  = '=?UTF-8?B?'.base64_encode($email_title).'?=';

$mail              = new PHPMailer();
$mail->IsSMTP();
$mail->CharSet     = "UTF-8";
$mail->SMTPDebug   = 0;
$mail->SMTPAuth    = true;
$mail->IsHTML(true);
$mail->SMTPSecure  = "tls";
$mail->Host        = "smtp.gmail.com";
$mail->Port        = 587;
$mail->Username    = $sitesettings['site_contact_email'];
$mail->Password    = $sitesettings['site_contact_email_pass'];
$mail->IsHTML(true);
$mail->SetFrom($sitesettings['site_contact_email'], $sitesettings['site_name']);
$mail->AddAttachment($_FILES['userfile']['tmp_name'],$_FILES['userfile']['name']);
$mail->Subject     = $subject;
$mail->MsgHTML($e_body);

$address1 = $admin_email;

$mail->AddAddress($emailto);
$mail->AddAddress($address2);

$mail->send();
$mail->ClearAllRecipients();
$mail->clearAttachments();

$error['sent'] = true;

} else {

$error['email'] = true;

}

}

}

?>

<!DOCTYPE html>
<html lang="tr">

<?php include_once("head_meta.php"); ?>

<style>video {object-fit: cover;width: 100vw;height: 100vh;position: fixed;top: 0;left: 0;z-index:-1;}</style>

<body class="hold-transition login-page">

<video playsinline autoplay muted loop id="bgvid">
<source src="/images/login-back.mp4" type="video/mp4">
</video>

<div class="login-box">

<div class="login-logo"><b>Yönetim Paneli</b></div>

<div class="login-box-body">

<p class="login-box-msg">Şifre Hatırlatma</p>

<form method="POST" onsubmit="return checkform(this);">

<div class="form-group has-feedback">
<input type="email" name="admin_email" id="email" class="form-control input-lg" placeholder="Email Adresi" required="" style="box-shadow: 0px 0px 12px 1px #cbcbcb;">
<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
</div>

<div class="row">

<div class="col-xs-3" style="padding-top: 13px;padding-left: 20px;">
<span class="label label-danger" style="padding: 11px;font-size: 20px;" id="txtCaptchaDiv"></span>
</div>

<div class="col-xs-5">
<input type="hidden" id="txtCaptcha" />
<input type="text" class="form-control input-lg" name="txtInput" id="txtInput" placeholder="Kodu Yazın" required="" style="box-shadow: 0px 0px 12px 1px #cbcbcb;margin-left: 10px;">
</div>

<div class="col-xs-4"><button type="submit" class="btn btn-lg btn-primary btn-block btn-flat">Giriş</button></div>

</div>

</form>

<hr>

<a href="<?php echo SITE_URL; ?>admin/log_in.php">Giriş Sayfası</a>

<?php if (!empty($error)) { ?>
<?php if (!empty($error['email'])) { ?><h5 style="color:#ff2700;text-align:center">Hatalı Email</h5><?php } ?>
<?php if (!empty($error['sent'])) { ?><h5 style="color:#1bb100;text-align:center">Yeni şifre email adresinize gönderildi</h5><?php } ?>
<?php } ?>

</div>

</div>

<script>
window.onload = function() {var input = document.getElementById("email").focus();};

function checkform(theform){
var why = "";
if(theform.txtInput.value == ""){
why += "Güvenlik kodunu yazın";}
if(theform.txtInput.value != ""){
if(ValidCaptcha(theform.txtInput.value) == false){
why += "Güvenlik kodu hatalı";
}
}
if(why != ""){alert(why);return false;}
}

var a = Math.ceil(Math.random() * 9)+ '';
var b = Math.ceil(Math.random() * 9)+ '';
var c = Math.ceil(Math.random() * 9)+ '';
var d = Math.ceil(Math.random() * 9)+ '';
var e = Math.ceil(Math.random() * 9)+ '';
var code = a + b + c + d + e;
document.getElementById("txtCaptcha").value = code;
document.getElementById("txtCaptchaDiv").innerHTML = code;

function ValidCaptcha(){
var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
var str2 = removeSpaces(document.getElementById('txtInput').value);
if (str1 == str2){
return true;
}else{
return false;
}
}

function removeSpaces(string){
return string.split(' ').join('');
}
</script>

</body>

</html>