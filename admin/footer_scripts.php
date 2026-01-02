<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
<script src="<?php echo SITE_URL; ?>admin/dist/js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.9.1/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.14.1/jquery.timepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.0.0/pnotify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.0.0/pnotify.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.0.0/pnotify.nonblock.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $sitesettings['site_google_maps_key']; ?>"></script>

<script src="<?php echo SITE_URL; ?>admin/dist/js/h_customs.js"></script>

<?php
if (!empty($_SESSION["alert"]) && $_SESSION["alert"] == "hello") {
echo '<script>new PNotify( {title: "Merhaba",type: "success",text: "Hoşgeldin. İyi çalışmalar.",nonblock: { nonblock: true },addclass: "dark",styling: "bootstrap3",hide: true} );</script>';
}
if (!empty($_SESSION["alert"]) && $_SESSION["alert"] == "ok") {
echo '<script>new PNotify( {title: "Kaydedildi",type: "success",text: "Güncelleme başarılı.",nonblock: { nonblock: true },addclass: "dark",styling: "bootstrap3",hide: true} );</script>';
}
if (!empty($_SESSION["alert"]) && $_SESSION["alert"] == "nok") {
echo '<script>new PNotify( {title: "Hata",type: "error",text: "Tekrar Deneyin.",nonblock: { nonblock: true },addclass: "dark",styling: "bootstrap3",hide: true} );</script>';
}
if (!empty($_SESSION["alert"]) && $_SESSION["alert"] == "emailsent") {
echo '<script>new PNotify( {title: "Email Gönderidi.",type: "success",text: "Gönderim başarılı.",nonblock: { nonblock: true },addclass: "dark",styling: "bootstrap3",hide: true} );</script>';
}
if (!empty($_SESSION["alert"]) && $_SESSION["alert"] == "smssent") {
echo '<script>new PNotify( {title: "SMS Gönderidi.",type: "success",text: "Gönderim başarılı.",nonblock: { nonblock: true },addclass: "dark",styling: "bootstrap3",hide: true} );</script>';
}
if (!empty($_SESSION["alert"]) && $_SESSION["alert"] == "not_sent") {
echo '<script>new PNotify( {title: "Gönderim Başarısız.",type: "error",text: "Tekrar Deneyin.",nonblock: { nonblock: true },addclass: "dark",styling: "bootstrap3",hide: true} );</script>';
}
if (!empty($_SESSION["alert"]) && $_SESSION["alert"] == "existingdate") {
echo '<script>new PNotify( {title: "Hata.",type: "error",text: "Girilen tarih zaten sistemde var.",nonblock: { nonblock: true },addclass: "dark",styling: "bootstrap3",hide: true} );</script>';
}

unset($_SESSION["alert"]);

?>