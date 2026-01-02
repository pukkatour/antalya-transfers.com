<?php
$prevmonth = date("Y-m-01",strtotime("-1 month"));
$lastmonth = date("Y-m-31",strtotime("-1 month"));
$thismonth = date('Y-m-01');
$nextmonth = date('Y-m-31');

$hits_1all = $Db->row("SELECT SUM(hit_count) AS toplam1all FROM hit_counter WHERE hit_page = ?", array('Home'));
$hits_1    = $Db->row("SELECT SUM(hit_count) AS toplam1 FROM hit_counter WHERE hit_page = ? AND hit_date BETWEEN ? AND ? ", array('Home',$thismonth,$nextmonth));

$hits_2all = $Db->row("SELECT SUM(hit_count) AS toplam2all FROM hit_counter WHERE hit_page = ?", array('FAQ'));
$hits_2    = $Db->row("SELECT SUM(hit_count) AS toplam2 FROM hit_counter WHERE hit_page = ? AND hit_date BETWEEN ? AND ? ", array('FAQ',$thismonth,$nextmonth));

$hits_3all = $Db->row("SELECT SUM(hit_count) AS toplam3all FROM hit_counter WHERE hit_page = ?", array('Reviews'));
$hits_3    = $Db->row("SELECT SUM(hit_count) AS toplam3 FROM hit_counter WHERE hit_page = ? AND hit_date BETWEEN ? AND ? ", array('Reviews',$thismonth,$nextmonth));

$hits_4all = $Db->row("SELECT SUM(hit_count) AS toplam4all FROM hit_counter WHERE hit_page = ?", array('Transfers'));
$hits_4    = $Db->row("SELECT SUM(hit_count) AS toplam4 FROM hit_counter WHERE hit_page = ? AND hit_date BETWEEN ? AND ? ", array('Transfers',$thismonth,$nextmonth));

$hits_5all = $Db->row("SELECT SUM(hit_count) AS toplam5all FROM hit_counter WHERE hit_page = ?", array('About Us'));
$hits_5    = $Db->row("SELECT SUM(hit_count) AS toplam5 FROM hit_counter WHERE hit_page = ? AND hit_date BETWEEN ? AND ? ", array('About Us',$thismonth,$nextmonth));

$hits_total = $Db->row("SELECT SUM(hit_count) AS toplamall FROM hit_counter ");
$hits_this  = $Db->row("SELECT SUM(hit_count) AS toplamthis FROM hit_counter WHERE hit_date BETWEEN ? AND ? ", array($thismonth,$nextmonth));
$hits_last  = $Db->row("SELECT SUM(hit_count) AS toplamlast FROM hit_counter WHERE hit_date BETWEEN ? AND ? ", array($prevmonth,$lastmonth));
$hits_home  = $Db->row("SELECT SUM(hit_count) AS toplamhome FROM hit_counter WHERE hit_page = ?", array('home'));
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">

<div class="box box-solid bg-teal-gradient">

<div class="box-header"><i class="fa fa-th"></i><h3 class="box-title">Ziyaretçi İstatistik</h3></div>

<div class="box-body border-radius-none">
<div class="chart" id="revenue-chart" style="height: 250px;"></div>
</div>

<div class="box-footer no-border">
<div class="row">

<div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
<input type="text" class="knob" data-step="1000" data-min="0" data-max="<?php if (!empty($hits_total['toplamall'])) { echo $hits_total['toplamall'] * 2; } else { echo "0"; } ?>" data-step="1000" data-readonly="true" value="<?php if (!empty($hits_total['toplamall'])) { echo $hits_total['toplamall']; } else { echo "0"; } ?>" data-width="60" data-height="60" data-fgColor="#39CCCC">
<div class="knob-label">Toplam</div>
</div>

<div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
<input type="text" class="knob" data-step="1000" data-min="0" data-max="<?php if (!empty($hits_this['toplamthis'])) { echo $hits_this['toplamthis'] * 2; } else { echo "0"; } ?>" data-step="1000" data-readonly="true" value="<?php if (!empty($hits_this['toplamthis'])) { echo $hits_this['toplamthis']; } else { echo "0"; } ?>" data-width="60" data-height="60" data-fgColor="#39CCCC">
<div class="knob-label">Bu Ay Toplam</div>
</div>

<div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
<input type="text" class="knob" data-step="1000" data-min="0" data-max="<?php if (!empty($hits_last['toplamlast'])) { echo $hits_last['toplamlast'] * 2; } else { echo "0"; } ?>" data-step="1000" data-readonly="true" value="<?php if (!empty($hits_last['toplamlast'])) { echo $hits_last['toplamlast']; } else { echo "0"; } ?>" data-width="60" data-height="60" data-fgColor="#39CCCC">
<div class="knob-label">Geçen Ay Toplam</div>
</div>

<div class="col-xs-3 text-center">
<input type="text" class="knob" data-step="1000" data-min="0" data-max="<?php if (!empty($hits_home['toplamhome'])) { echo $hits_home['toplamhome'] * 2; } else { echo "0"; } ?>" data-step="1000" data-readonly="true" value="<?php if (!empty($hits_home['toplamhome'])) { echo $hits_home['toplamhome']; } else { echo "0"; } ?>" data-width="60" data-height="60" data-fgColor="#39CCCC">
<div class="knob-label">Ana Sayfa Toplam</div>
</div>

</div>
</div>

</div>

</div>