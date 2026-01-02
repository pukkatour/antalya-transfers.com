<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_GET)) {

$lang_id = $_GET['lang_id'];
$data    = $Db->row("SELECT * FROM translate WHERE tr_lang = ?", array($lang_id));

} else {

redirect(SITE_URL."admin/index.php"); exit;

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
<li class="active">Genel Çeviriler</li>
</ol>
</section>

<section class="content">

<div class="row">

<div class="col-md-4">
<div class="box box-primary">

<div class="box-header with-border">
<h3 class="box-title">Düzenlenecek Dili Seçin</h3>
</div>

<form method="get">
<div class="box-body">
<div class="form-group">
<label>Dil</label>
<select class="form-control" name="lang_id" onchange="this.form.submit()">
<?php if (!empty($languagelist)) { foreach ($languagelist as $lang) { ?>
<option <?php if ($_GET['lang_id'] == $lang['lang_id']) { echo 'selected="selected"'; } ?> value="<?php echo $lang['lang_id']; ?>"><?php echo $lang['lang_name_eng']; ?></option>
<?php } } ?>
</select>
</div>
</div>
</form>

</div>
</div>

</div>

<div class="row">

<div class="col-md-12">
<div class="box box-info">

<div class="box-header with-border">
<h3 class="box-title">Çevirileri Düzenleme</h3>
</div>

<form method="POST" action="update.php">

<div class="box-body">

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_001" value="<?php echo $data['tr_001']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_002" value="<?php echo $data['tr_002']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_003" value="<?php echo $data['tr_003']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_004" value="<?php echo $data['tr_004']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_005" value="<?php echo $data['tr_005']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_006" value="<?php echo $data['tr_006']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_007" value="<?php echo $data['tr_007']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_008" value="<?php echo $data['tr_008']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_009" value="<?php echo $data['tr_009']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_010" value="<?php echo $data['tr_010']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_011" value="<?php echo $data['tr_011']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_012" value="<?php echo $data['tr_012']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_013" value="<?php echo $data['tr_013']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_014" value="<?php echo $data['tr_014']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_015" value="<?php echo $data['tr_015']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_016" value="<?php echo $data['tr_016']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_017" value="<?php echo $data['tr_017']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_018" value="<?php echo $data['tr_018']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_019" value="<?php echo $data['tr_019']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_020" value="<?php echo $data['tr_020']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_021" value="<?php echo $data['tr_021']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_022" value="<?php echo $data['tr_022']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_023" value="<?php echo $data['tr_023']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_024" value="<?php echo $data['tr_024']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_025" value="<?php echo $data['tr_025']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_026" value="<?php echo $data['tr_026']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_027" value="<?php echo $data['tr_027']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_028" value="<?php echo $data['tr_028']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_029" value="<?php echo $data['tr_029']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_030" value="<?php echo $data['tr_030']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_031" value="<?php echo $data['tr_031']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_032" value="<?php echo $data['tr_032']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_033" value="<?php echo $data['tr_033']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_034" value="<?php echo $data['tr_034']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_035" value="<?php echo $data['tr_035']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_036" value="<?php echo $data['tr_036']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_037" value="<?php echo $data['tr_037']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_038" value="<?php echo $data['tr_038']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_039" value="<?php echo $data['tr_039']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_040" value="<?php echo $data['tr_040']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_041" value="<?php echo $data['tr_041']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_042" value="<?php echo $data['tr_042']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_043" value="<?php echo $data['tr_043']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_044" value="<?php echo $data['tr_044']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_045" value="<?php echo $data['tr_045']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_046" value="<?php echo $data['tr_046']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_047" value="<?php echo $data['tr_047']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_048" value="<?php echo $data['tr_048']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_049" value="<?php echo $data['tr_049']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_050" value="<?php echo $data['tr_050']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_051" value="<?php echo $data['tr_051']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_052" value="<?php echo $data['tr_052']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_053" value="<?php echo $data['tr_053']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_054" value="<?php echo $data['tr_054']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_055" value="<?php echo $data['tr_055']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_056" value="<?php echo $data['tr_056']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_057" value="<?php echo $data['tr_057']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_058" value="<?php echo $data['tr_058']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_059" value="<?php echo $data['tr_059']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_060" value="<?php echo $data['tr_060']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_061" value="<?php echo $data['tr_061']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_062" value="<?php echo $data['tr_062']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_063" value="<?php echo $data['tr_063']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_064" value="<?php echo $data['tr_064']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_065" value="<?php echo $data['tr_065']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_066" value="<?php echo $data['tr_066']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_067" value="<?php echo $data['tr_067']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_068" value="<?php echo $data['tr_068']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_069" value="<?php echo $data['tr_069']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_070" value="<?php echo $data['tr_070']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_071" value="<?php echo $data['tr_071']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_072" value="<?php echo $data['tr_072']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_073" value="<?php echo $data['tr_073']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_074" value="<?php echo $data['tr_074']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_075" value="<?php echo $data['tr_075']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_076" value="<?php echo $data['tr_076']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_077" value="<?php echo $data['tr_077']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_078" value="<?php echo $data['tr_078']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_079" value="<?php echo $data['tr_079']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_080" value="<?php echo $data['tr_080']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_081" value="<?php echo $data['tr_081']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_082" value="<?php echo $data['tr_082']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_083" value="<?php echo $data['tr_083']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_084" value="<?php echo $data['tr_084']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_085" value="<?php echo $data['tr_085']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_086" value="<?php echo $data['tr_086']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_087" value="<?php echo $data['tr_087']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_088" value="<?php echo $data['tr_088']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_089" value="<?php echo $data['tr_089']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_090" value="<?php echo $data['tr_090']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_091" value="<?php echo $data['tr_091']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_092" value="<?php echo $data['tr_092']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_093" value="<?php echo $data['tr_093']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_094" value="<?php echo $data['tr_094']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_095" value="<?php echo $data['tr_095']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_096" value="<?php echo $data['tr_096']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_097" value="<?php echo $data['tr_097']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_098" value="<?php echo $data['tr_098']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_099" value="<?php echo $data['tr_099']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_100" value="<?php echo $data['tr_100']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_101" value="<?php echo $data['tr_101']; ?>" maxlength="100" required="">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>***</label>
<input type="text" class="form-control" name="tr_102" value="<?php echo $data['tr_102']; ?>" maxlength="100" required="">
</div>
</div>

</div>

<input type="hidden" name="tr_lang" value="<?php echo $data['tr_lang']; ?>">

</div>

<div class="box-footer">
<button type="submit" class="btn btn-sm btn-primary pull-right">Güncelle</button>
</div>

</form>

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