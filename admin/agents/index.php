<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$sql          = "SELECT agents.agent_id, agents.agent_status, agents.agent_person_company, agents.agent_agent_name, agents.agent_agent_surname, agents.agent_agent_phone, agents.agent_company_name, agents.agent_company_phone, o_c.country_phone_code AS agent_c, o_c.country_name AS agent_cn, c_c.country_phone_code AS company_c, c_c.country_name AS company_cn FROM agents LEFT JOIN country_list AS o_c ON o_c.country_id = agents.agent_agent_country LEFT JOIN country_list AS c_c ON c_c.country_id = agents.agent_company_address_country WHERE agent_status != :stat ";
   
$prm['stat']  = '3';

$c_id            = $_GET['c_id'];
$c_agent_name    = $_GET['c_agent_name'];
$c_agent_surname = $_GET['c_agent_surname'];
$c_agent_phone   = $_GET['c_agent_phone'];
$c_company_name  = $_GET['c_company_name'];
$c_company_phone = $_GET['c_company_phone'];
$c_country       = $_GET['c_country'];

if (!empty($c_id))            { $sql .= "AND agent_id = :oid "; $prm['oid'] = $c_id; }
if (!empty($c_agent_name))    { $sql .= "AND agent_agent_name LIKE CONCAT ('%', :ona, '%') "; $prm['ona'] = $c_agent_name; }
if (!empty($c_agent_surname)) { $sql .= "AND agent_agent_surname LIKE CONCAT ('%), :osn, '%') "; $prm['osn'] = $c_agent_surname; }
if (!empty($c_agent_phone))   { $sql .= "AND agent_agent_phone LIKE CONCAT ('%', :oph, '%') "; $prm['oph'] = $c_agent_phone; }
if (!empty($c_company_name))  { $sql .= "AND agent_company_name LIKE CONCAT ('%', cna, '%') "; $prm['cna'] = $c_company_name; }
if (!empty($c_company_phone)) { $sql .= "AND agent_company_phone LIKE CONCAT ('%', cph, '%') "; $prm['cph'] = $c_company_phone; }
if (!empty($c_country))       { $sql .= "AND (agent_agent_country = :oco OR agent_company_address_country = :cco "; $prm['oco'] = $c_country; $prm['cco'] = $c_country; }

}

else {

$sql          = "SELECT agents.agent_id, agents.agent_status, agents.agent_person_company, agents.agent_agent_name, agents.agent_agent_surname, agents.agent_agent_phone, agents.agent_company_name, agents.agent_company_phone, o_c.country_phone_code AS agent_c, o_c.country_name AS agent_cn, c_c.country_phone_code AS company_c, c_c.country_name AS company_cn FROM agents LEFT JOIN country_list AS o_c ON o_c.country_id = agents.agent_agent_country LEFT JOIN country_list AS c_c ON c_c.country_id = agents.agent_company_address_country WHERE agent_status != :stat ";

$prm['stat']  = '3';

}

$agents_count = $Db->query($sql,$prm);


// Paging
$per_page    = 10;
$start       = 0;
$end         = $per_page;
$total_pages = ceil(count($agents_count) / $per_page);

if (!empty($_GET['sayfa'])) {
if (isset($_GET['sayfa']) && is_numeric($_GET['sayfa'])) {
if (empty($_GET['sayfa'])) { $_GET['sayfa'] = 1; }
$show_page = $_GET['sayfa'];
if(!is_numeric($show_page)) { $show_page = 0; }
if ($show_page > 0 && $show_page <= $total_pages) {
$start = ($show_page - 1) * $per_page;
$end = $start + $per_page;
} else {
$start = 0;
$end = $per_page;
}
}
} else {
$show_page = 0;
}

if (!is_numeric($show_page)) { $show_page = 0; }
$num_rows     = count($agents_count);
$page_amount2 = ceil($num_rows / $per_page);
$page_amount  = $page_amount2 - 1;
$page         = $show_page;

$sql .= " LIMIT " . $start . "," . $per_page;
// Paging


$agents = $Db->query($sql,$prm);

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
<li class="active">İlan Sahibi / Acenta Yönetimi</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-12">

<div class="box box-primary">

<div class="box-header with-border">
<h3 class="box-title">Filterler</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
</div>
</div>

<div class="box-body">

<form role="form" method="GET" action="">

<div class="col-md-3">
<div class="form-group">
<label>ID No</label>
<input type="text" class="form-control" name="c_id" placeholder="ID No Yazın" value="<?php if(!empty($_GET['c_id'])) { echo $_GET['c_id']; } ?>">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>İlan Sahibi Adı</label>
<input type="text" class="form-control" name="c_agent_name" placeholder="İlan Sahibi Adını Yazın" value="<?php if(!empty($_GET['c_agent_name'])) { echo $_GET['c_agent_name']; } ?>">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>İlan Sahibi Soyadı</label>
<input type="text" class="form-control" name="c_agent_surname" placeholder="İlan Sahibi Soyadını Yazın" value="<?php if(!empty($_GET['c_agent_surname'])) { echo $_GET['c_agent_surname']; } ?>">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>İlan Sahibi Telefon</label>
<input type="text" class="form-control" name="c_agent_phone" placeholder="Telefon Numarasını Yazın" value="<?php if(!empty($_GET['c_agent_phone'])) { echo $_GET['c_agent_phone']; } ?>" onkeypress="return h_isNumber(event)">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Şirket Adı</label>
<input type="text" class="form-control" name="c_company_name" placeholder="Şirket Adını Yazın" value="<?php if(!empty($_GET['c_company_name'])) { echo $_GET['c_company_name']; } ?>">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Şirket Telefon</label>
<input type="text" class="form-control" name="c_company_phone" placeholder="Telefon Numarasını Yazın" value="<?php if(!empty($_GET['c_company_phone'])) { echo $_GET['c_company_phone']; } ?>" onkeypress="return h_isNumber(event)">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Ülke</label>
<select class="form-control" name="c_country">
<option value="">Tümü</option>
<?php if (!empty($countrylist)) { foreach ($countrylist as $country) { ?>
<option <?php if(!empty($_GET['c_country'])) { if($_GET['c_country'] == $country['country_id']) { echo 'selected="selected"'; } } ?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-md-2">
<button type="submit" class="btn btn-primary pull-right btn-block" style="margin-top: 25px;">Ara</button>
</div>

<div class="col-md-1">
<a href="<?php echo SITE_URL."admin/agents/index.php"; ?>" class="btn btn-warning pull-right" style="margin-top: 25px;">Tümü</a>
</div>

</form>

</div>

</div>

<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">İlan Sahipleri</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
</div>
</div>

<div class="box-body">

<table class="table table-striped table-hover table-bordered table-condensed">
<tbody style="font-size: 11px;">

<tr>
<th>ID</th>
<th>Tip</th>
<th>İsim / Firma</th>
<th>Telefon</th>
<th>Ülke</th>
<th>Durum</th>
<th>İşlem</th>
</tr>

<?php if (!empty($agents)) { foreach ($agents as $agent) { ?>
<tr>
<td><?php echo $agent['agent_id']; ?></td>
<td>
<?php 
if ($agent['agent_person_company'] == 1) { echo '<span class="label pull-left bg-blue" style="padding: 5px;">Şahıs</span>';}
if ($agent['agent_person_company'] == 2) { echo '<span class="label pull-left bg-green" style="padding: 5px;">Firma</span>';}
?>
</td>
<?php if ($agent['agent_person_company'] == 1) { ?>
<td><?php echo $agent['agent_agent_name']." ".$agent['agent_agent_surname']; ?></td>
<td><?php echo $agent['agent_c']." ".$agent['agent_agent_phone']; ?></td>
<td><?php echo $agent['agent_cn']; ?></td>
<?php } ?>
<?php if ($agent['agent_person_company'] == 2) { ?>
<td><?php echo $agent['agent_company_name']; ?></td>
<td><?php echo $agent['company_c']." ".$agent['agent_company_phone']; ?></td>
<td><?php echo $agent['company_cn']; ?></td>
<?php } ?>
<td>
<?php 
if ($agent['agent_status'] == 1) { echo '<span class="label pull-right bg-red" style="padding: 5px;">Pasif</span>';}
if ($agent['agent_status'] == 2) { echo '<span class="label pull-right bg-green" style="padding: 5px;">Aktif</span>';}
?>
</td>
<td>
<div class="btn-group">
<button type="button" class="btn btn-xs btn-danger dropdown-toggle" data-toggle="dropdown">İşlem<span class="caret"></span></button>
<ul class="dropdown-menu dropdown-menu-right" role="menu">
<?php if ($agent['agent_status'] == "2") { ?><li <?php if ($agent['agent_status'] == "1") { echo 'class="disabled"'; } ?>><a href="operations.php?action=1&id=<?php echo $agent['agent_id']; ?>">Pasif Yap</a></li><?php } ?>
<?php if ($agent['agent_status'] == "1") { ?><li <?php if ($agent['agent_status'] == "2") { echo 'class="disabled"'; } ?>><a href="operations.php?action=2&id=<?php echo $agent['agent_id']; ?>">Aktif Yap</a></li><?php } ?>
<li><a href="operations.php?action=3&id=<?php echo $agent['agent_id']; ?>" onclick="return confirm('Emin misiniz?');">Sil</a></li>
<li class="divider"></li>
<li><a href="edit.php?agent_id=<?php echo $agent['agent_id']; ?>">Düzenle</a></li>
<li><a href="view.php?agent_id=<?php echo $agent['agent_id']; ?>">Görüntüle</a></li>
</ul>
</div>
</td>
</tr>
<?php } } ?>

</tbody>
</table>

</div>

<div class="box-footer">
<div class="pull-right"><?php if (!empty($agents)) { paging($urlsetted); } ?></div>
</div>

</div>

<div class="box box-danger collapsed-box">

<div class="box-header with-border">
<h3 class="box-title">İlan Sahibi / Acenta Ekleme</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
</div>
</div>

<div class="box-body">

<form role="form" method="POST" action="addnew.php">

<div class="row">

<div class="col-md-3">
<div class="form-group">
<label>Şahıs / Firma</label>
<select class="form-control" name="agent_person_company" required="" id="type_sel">
<option value="">Seçim Yapın</option>
<option value="1">Şahıs</option>
<option value="2">Firma</option>
</select>
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label>Durum</label>
<select class="form-control" name="agent_status" required="">
<option value="1">Pasif</option>
<option value="2">Aktif</option>
</select>
</div>
</div>

</div>

<div class="row" id="pers" style="display:none;">

<div class="col-md-4">
<div class="form-group">
<label>Şahıs Adı</label>
<input type="text" class="form-control h_firstcap" name="agent_agent_name" id="agent_agent_name" placeholder="Şahıs Adını Yazın" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Şahıs Soyadı</label>
<input type="text" class="form-control h_firstcap" name="agent_agent_surname" id="agent_agent_surname" placeholder="Şahıs Soyadını Yazın" maxlength="250">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Şahıs Email</label>
<input type="text" class="form-control" name="agent_agent_email" id="agent_agent_email" placeholder="Şahıs Emailini Yazın" maxlength="250">
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label>Şahıs Ülke</label>
<select class="form-control" name="agent_agent_country" id="agent_agent_country">
<option value="">Seçim Yapın</option>
<?php if (!empty($countrylist)) { foreach ($countrylist as $country) { ?>
<option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label>Şahıs Şehir</label>
<input type="text" class="form-control h_firstcap" name="agent_agent_city" id="agent_agent_city" placeholder="Şahıs Şehrini Yazın" maxlength="250">
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label>Şahıs İlçe</label>
<input type="text" class="form-control h_firstcap" name="agent_agent_county" id="agent_agent_county" placeholder="Şahıs İlçesini Yazın" maxlength="250">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Şahıs Telefon Numarası</label>
<input type="text" class="form-control" name="agent_agent_phone" id="agent_agent_phone" placeholder="Şahıs Telefon Numarasını Yazın" maxlength="30" onkeypress="return h_isNumber(event)">
</div>
</div>

</div>

<div class="row" id="comp" style="display:none;">

<div class="col-md-4">
<div class="form-group">
<label>Şirket Adı</label>
<input type="text" class="form-control h_firstcap" name="agent_company_name" id="agent_company_name" placeholder="Şirket Adını Yazın" maxlength="250">
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label>Şirket Ülkesi</label>
<select class="form-control" name="agent_company_address_country" id="agent_company_address_country">
<option value="">Seçim Yapın</option>
<?php if (!empty($countrylist)) { foreach ($countrylist as $country) { ?>
<option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
<?php } } ?>
</select>
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label>Şirket Şehir</label>
<input type="text" class="form-control h_firstcap" name="agent_company_address_city" id="agent_company_address_city" placeholder="Şirket Şehrini Yazın" maxlength="250">
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label>Şirket İlçe</label>
<input type="text" class="form-control h_firstcap" name="agent_company_address_county" id="agent_company_address_county" placeholder="Şirket İlçesini Yazın" maxlength="250">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Şirket Telefon Numarası</label>
<input type="text" class="form-control" name="agent_company_phone" id="agent_company_phone" placeholder="Şirket Telefon Numarasını Yazın" maxlength="30" onkeypress="return h_isNumber(event)">
</div>
</div>

</div>

<div class="row">

<div class="col-md-2">
<button type="submit" class="btn btn-warning pull-right btn-block" style="margin-top: 25px;">Kaydet</button>
</div>

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

<script>
$("select#type_sel").change(function() {
var sel = $("select#type_sel option:selected").attr('value');

if (sel == '1') {

$("#pers").show("fast");
$("#comp").hide("fast");

$("#agent_agent_name").prop('required',true);
$("#agent_agent_surname").prop('required',true);
$("#agent_agent_email").prop('required',true);
$("#agent_agent_country").prop('required',true);
$("#agent_agent_city").prop('required',true);
$("#agent_agent_county").prop('required',true);
$("#agent_agent_phone").prop('required',true);

$("#agent_company_name").prop('required',false);
$("#agent_company_address_country").prop('required',false);
$("#agent_company_address_city").prop('required',false);
$("#agent_company_address_county").prop('required',false);
$("#agent_company_phone").prop('required',false);

}

if (sel == '2') {

$("#comp").show("fast");
$("#pers").hide("fast");

$("#agent_company_name").prop('required',true);
$("#agent_company_address_country").prop('required',true);
$("#agent_company_address_city").prop('required',true);
$("#agent_company_address_county").prop('required',true);
$("#agent_company_phone").prop('required',true);

$("#agent_agent_name").prop('required',false);
$("#agent_agent_surname").prop('required',false);
$("#agent_agent_email").prop('required',false);
$("#agent_agent_country").prop('required',false);
$("#agent_agent_city").prop('required',false);
$("#agent_agent_county").prop('required',false);
$("#agent_agent_phone").prop('required',false);

}

});
</script>

<?php
function paging($urlsetted) {
global $num_rows;
global $page;
global $page_amount;

if (!empty($_GET['page'])) { $pagniation_page = $_GET['page']; } else { $pagniation_page = 1; }

$url = $urlsetted;
$str = substr(strrchr($url, ".php"), 4);

if (empty($str)) {

if ($page_amount != "0") {
echo '<ul class="pagination pagination">';
if ($page != "0") {
echo '<li><a href="'.SITE_URL.$urlsetted."?page=1".'">«</a></li>';
$prev = $page - 1;
echo '<li><a href="'.SITE_URL.$urlsetted."?page=".$prev.'">Önceki</a></li><li><a href="#">...</a></li>';
}
for ( $counter = max($pagniation_page - 4, 0); $counter <= $page_amount; $counter += 1 ) {
$pagee = $counter + 1;
echo '<li class="'; if ($pagniation_page == $pagee) { echo "active"; } echo '"><a href="'.SITE_URL.$urlsetted."?page=$pagee".'">'.$pagee.'</a></li>';
if ($pagee > $pagniation_page + 2) { break; }
}
if ($page < $page_amount + 1) {
$next = $page + 1;
if ($page == 0) {
$next = $page + 2;
}
echo '<li><a href="#">...</a></li><li><a href="'.SITE_URL.$urlsetted."?page=$next".'">Sonraki</a></li>';
}
echo '<li><a href="'.SITE_URL.$urlsetted."?page=".($page_amount + 1).'">»</a></li>';
echo "</ul>";
}

} else {

if ($page_amount != "0") {
echo '<ul class="pagination pagination">';
if ($page != "0") {
echo '<li><a href="'.SITE_URL.$urlsetted."&amp;page=1".'">«</a></li>';
$prev = $page - 1;
echo '<li><a href="'.SITE_URL.$urlsetted."&amp;page=1".'">Önceki</a></li><li><a href="#">...</a></li>';
}
for ($counter = max($pagniation_page - 4, 0); $counter <= $page_amount; $counter += 1) {
$pagee = $counter + 1;
echo '<li class="'; if ($pagniation_page == $pagee) {echo "active";} echo '"><a href="'.SITE_URL.$urlsetted."&amp;page=$pagee".'">'.$pagee.'</a></li>';
if ($pagee > $pagniation_page + 2) { break; }
}
if ( $page < $page_amount + 1) {
$next = $page + 1;
if ( $page == 0) {
$next = $page + 2;
}
echo '<li><a href="#">...</a></li><li><a href="'.SITE_URL.$urlsetted."&amp;page=$next".'">Sonraki</a></li>';
}
echo '<li><a href="'.SITE_URL.$urlsetted."&amp;page=".($page_amount + 1).'">»</a></li>';
echo "</ul>";
}

}

}
?>

</body>
</html>