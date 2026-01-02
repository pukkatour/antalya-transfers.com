///
/// 1- class     : WYSWYG Editör        - h_inputs
/// 2- class     : Çift Datepicker      - h_datepicker1 h_datepicker2
/// 3- class     : Tek Datepicker       - h_datepicker
/// 4- class     : Time Picker          - h_timepicker
/// 5- class     : İlk Karakter Capital - h_firstcap
/// 6- functioun : Sadece Numara        - h_isNumber
///
/// Hakan ERENLER. www.hakanerenler.net



/// 1- WYSWYG Editör
$(function () {
$('.h_inputs').summernote({
tabsize: 2,
height: 120,
toolbar: [
['style', ['style']],
['font', ['bold', 'underline', 'clear']],
['color', ['color']],
['para', ['ul', 'ol', 'paragraph']],
['table', ['table']],
['insert', ['link', 'picture', 'video']],
['view', ['fullscreen', 'codeview', 'help']]
]
});
});
/// WYSWYG Editör



/// 2- Çift Datepicker
$('.h_datepicker1').datepicker({
todayBtn: "linked",
todayHighlight: true,
autoclose: true,
startDate: "0",
weekStart: 1
}).on('changeDate', function(e){
$('.h_datepicker2').datepicker({ 
autoclose: true,
}).datepicker('setStartDate', e.date);
$('.h_datepicker2').focus();
});
/// Çift Datepicker



/// 3- Tek Datepicker
$('.h_datepicker').datepicker({
startDate: '0',
autoclose: true,
weekStart: 1
});
/// Tek Datepicker



/// 4- Time Picker
$('.h_timepicker').timepicker({
'timeFormat': 'H:i'
});
/// Time Picker



/// 5- İlk Karakter Capital
$('.h_firstcap').keyup(function(evt){
var txt = $(this).val();
$(this).val(txt.replace(/^(.)|\s(.)/g, function($1){ return $1.toUpperCase( ); }));
});
/// İlk Karakter Capital



/// 6- Sadece Numara
function h_isNumber(evt) {
evt = (evt) ? evt : window.event;
var charCode = (evt.which) ? evt.which : evt.keyCode;
if (charCode > 31 && (charCode < 48 || charCode > 57)) { return false; }
return true;
}
/// Sadece Numara
