<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$agent = $Db->row("SELECT agents.*, country_1.country_phone_code AS o_code, country_1.country_name AS o_name, country_2.country_phone_code AS c_code, country_2.country_name AS c_name, country_lista1.country_phone_code AS person1, country_lista2.country_phone_code AS person2 FROM agents LEFT JOIN country_list AS country_1 ON country_1.country_id = agents.agent_agent_country LEFT JOIN country_list AS country_2 ON country_2.country_id = agents.agent_company_address_country LEFT JOIN country_list AS country_lista1 ON country_lista1.country_id = agents.agent_person1_country LEFT JOIN country_list AS country_lista2 ON country_lista2.country_id = agents.agent_person2_country WHERE agent_id = ?", array($_GET['agent_id']));

if ($agent['agent_logo'] != NULL) { $gorsel = IMAGE_PATH."agents/".$agent['agent_logo']; } else { $gorsel = ""; }

} else {

redirect(SITE_URL.'admin/agents/index.php'); exit;

}

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
<li class="active">İlan Sahibi / Acenta Görüntüleme</li>
</ol>
</section>

<section class="invoice">

<div class="row">
<div class="col-xs-12">
<h2 class="page-header"> <i class="fa fa-globe"></i> 
<?php 
if ($agent['agent_person_company'] == 1) { echo ' Şahıs - ';}
if ($agent['agent_person_company'] == 2) { echo ' Firma - ';}
if ($agent['agent_status'] == 1) { echo ' Pasif';}
if ($agent['agent_status'] == 2) { echo ' Aktif';}
?>
<small class="pull-right">ID: <b><?php echo $agent['agent_id']; ?></b></small> </h2>
</div>

</div>

<?php if ($agent['agent_person_company'] == 1) { ?>
<div class="row invoice-info">

<div class="col-sm-4 invoice-col">
<address>
Ad Soyad: <strong><?php echo $agent['agent_agent_name']." ".$agent['agent_agent_surname']; ?></strong><br>
Email: <strong><?php echo $agent['agent_agent_email']; ?></strong><br>
Telefon: <strong><?php echo $agent['o_code']." ".$agent['agent_agent_phone']; ?></strong><br>
</address>
</div>

<div class="col-sm-4 invoice-col">
<address>
Ülke | İl | İlçe: <strong><?php echo $agent['o_name']." ".$agent['agent_agent_city']." ".$agent['agent_agent_county']; ?></strong><br>
Adres: <strong><?php echo $agent['agent_agent_address']; ?></strong><br>
Posta Kodu: <strong><?php echo $agent['agent_agent_address_post_code']; ?></strong><br>
</address>
</div>

</div>

<?php } ?>

<?php if ($agent['agent_person_company'] == 2) { ?>
<div class="row invoice-info">

<div class="col-sm-4 invoice-col">
<address>
Ad Soyad: <strong><?php echo $agent['agent_company_name']; ?></strong><br>
Email: <strong><?php echo $agent['agent_company_email']; ?></strong><br>
Telefon: <strong><?php echo $agent['c_code']." ".$agent['agent_company_phone']; ?></strong><br>
</address>
</div>

<div class="col-sm-4 invoice-col">
<address>
Ülke | İl | İlçe: <strong><?php echo $agent['c_name']." ".$agent['agent_company_address_city']." ".$agent['agent_company_address_county']; ?></strong><br>
Adres: <strong><?php echo $agent['agent_company_address']; ?></strong><br>
Posta Kodu: <strong><?php echo $agent['agent_company_address_post_code']; ?></strong><br>
</address>
</div>

<div class="col-sm-4 invoice-col">
<address>
Vergi Dairesi: <strong><?php echo $agent['agent_company_tax_office']; ?></strong><br>
Vergi No: <strong><?php echo $agent['agent_company_tax_number']; ?></strong><br>
Web: <strong><?php echo $agent['agent_company_web_url']; ?></strong><br>
</address>
</div>

</div>

<?php } ?>

<?php if (!empty($agent['agent_person1_name'])) { ?>
<hr>

<div class="row">

<div class="col-xs-12 table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th></th>
<th>Yetkili Adı</th>
<th>Yetkili Emaili</th>
<th>Telefonu</th>
</tr>
</thead>
<tbody>
<tr>
<td>1</td>
<td><?php echo $agent['agent_person1_name']." ".$agent['agent_person1_surname']; ?></td>
<td><?php echo $agent['agent_person1_email']; ?></td>
<td><?php echo $agent['person1']." ".$agent['agent_person1_phone']; ?></td>
</tr>
<?php if (!empty($agent['agent_person2_name'])) { ?>
<tr>
<td>2</td>
<td><?php echo $agent['agent_person2_name']." ".$agent['agent_person2_surname']; ?></td>
<td><?php echo $agent['agent_person2_email']; ?></td>
<td><?php echo $agent['person2']." ".$agent['agent_person2_phone']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>

</div>
<?php } ?>

<hr>

<div class="row">

<div class="col-sm-2">
<img src="<?php if (file_exists($gorsel)) { echo IMAGE_FOLDER."agents/".$agent['agent_logo']."?".date_timestamp_get(date_create()); } else { echo IMAGE_FOLDER."no_photo.jpg"; } ?>" class="img-responsive">
</div>

<div class="col-xs-10">
<p class="lead">Açıklama:</p>
<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
<?php echo $agent['agent_text']; ?>
</p>
</div>

</div>

<div class="row no-print">
<div class="col-xs-12">
<button class="btn btn-primary pull-right" onclick="window.print();"><i class="fa fa-print"></i> Yazdır</button>
</div>
</div>

</section>

</div>

<?php include_once("../footer.php"); ?>

<?php include_once("../aside.php"); ?>

<div class="control-sidebar-bg"></div>

</div>

<?php include_once("../footer_scripts.php"); ?>

</body>
</html>