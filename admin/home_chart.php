<?php
$lang_total1 = $Db->row("SELECT SUM(hit_count) AS langtotal1 FROM hit_counter WHERE hit_site_id = ?", array($languagelist[0]['lang_id']));
$lang_total2 = $Db->row("SELECT SUM(hit_count) AS langtotal2 FROM hit_counter WHERE hit_site_id = ?", array($languagelist[1]['lang_id']));
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">


<div class="box box-danger">
<div class="box-header with-border">
<h3 class="box-title">Dil İstatistikleri</h3>
<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button>
<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
</div>
</div>
<div class="box-body chart-responsive">
<div class="chart" id="sales-chart" style="height: 351px; position: relative;"></div>
</div>
</div>

</div>