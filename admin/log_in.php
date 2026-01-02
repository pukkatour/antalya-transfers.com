<?php
include_once('include/site_id.php');
include_once('include/initialize.inc.php');
if (!empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$admin_email = $_POST['admin_email'];
$admin_pass  = $_POST['admin_password'];

if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) { $error['email'] = true; }

if (empty($error['email'])) {

$admin = $Db->row("SELECT * FROM admin WHERE admin_email = ? AND admin_password = ? AND admin_status = ?", array($admin_email,md5($admin_pass),'2'));

if (!empty($admin)) {

$_SESSION['admin'] = $admin;

$Db->query("UPDATE admin SET admin_last_visit = ?, admin_last_ip = ? WHERE admin_id = ?", array($date_time,getIP(),$admin['admin_id']));

$_SESSION["alert"] = "hello";
redirect(SITE_URL."admin/index.php"); exit;

} else {

$error['pass'] = true;

}

} else {

$error['email'] = true;

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

<p class="login-box-msg">Sistem Girişi</p>

<form method="POST" onsubmit="return checkform(this);">

<div class="form-group has-feedback">
<input type="email" name="admin_email" id="email" class="form-control input-lg" placeholder="Email Adresi" required="" style="box-shadow: 0px 0px 12px 1px #cbcbcb;">
<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
</div>

<div class="form-group has-feedback">
<input type="password" name="admin_password" class="form-control input-lg" placeholder="Şifre" required="" style="box-shadow: 0px 0px 12px 1px #cbcbcb;">
<span class="glyphicon glyphicon-lock form-control-feedback"></span>
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

<a href="<?php echo SITE_URL; ?>admin/password_reminder.php">Şifremi Unuttum</a>

<?php if (!empty($error)) { ?>
<?php if (!empty($error['pass'])) { ?><h5 style="color:#ff2700;">Hatalı Email ya da Şifre</h5><?php } ?>
<?php if (!empty($error['email'])) { ?><h5 style="color:#ff2700;">Hatalı Email</h5><?php } ?>
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