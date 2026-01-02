<div class="row">

<?php $count1 = $Db->query("SELECT booking_id FROM transfer_bookings WHERE booking_status != ?", array('3')); ?>
<div class="col-lg-3 col-xs-6">
<div class="small-box bg-yellow">
<div class="inner"><h3><?php echo count($count1); ?></h3><p>Rezervasyon</p></div>
<div class="icon"><i class="fa fa-cart-plus"></i></div>
<a href="<?php echo SITE_URL; ?>admin/bookings/index.php" class="small-box-footer">Tümü <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>

<?php $count2 = $Db->query("SELECT airport_airport_id FROM transfer_airports WHERE airport_lang_id = ?", array('1')); ?>
<div class="col-lg-3 col-xs-6">
<div class="small-box bg-green">
<div class="inner"><h3><?php echo count($count2); ?></h3><p>Havalimanı</p></div>
<div class="icon"><i class="fa fa-plane"></i></div>
<a href="<?php echo SITE_URL; ?>admin/transfers/airports.php?lang=1" class="small-box-footer">Tümü <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>

<?php $count3 = $Db->query("SELECT resort_resort_id FROM transfer_resorts WHERE resort_lang_id = ?", array('1')); ?>
<div class="col-lg-3 col-xs-6">
<div class="small-box bg-red">
<div class="inner"><h3><?php echo count($count3); ?></h3><p>Destinasyon</p></div>
<div class="icon"><i class="fa fa-map-marker"></i></div>
<a href="<?php echo SITE_URL; ?>admin/transfers/resorts.php?lang=1" class="small-box-footer">Tümü <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>

<?php $count4 = $Db->query("SELECT vehicle_vehicle_id FROM transfer_vehicles WHERE vehicle_lang_id = ?", array('1')); ?>
<div class="col-lg-3 col-xs-6">
<div class="small-box bg-aqua">
<div class="inner"><h3><?php echo count($count4); ?></h3><p>Araç</p></div>
<div class="icon"><i class="fa fa-car"></i></div>
<a href="<?php echo SITE_URL; ?>admin/transfers/vehicles.php?lang=1" class="small-box-footer">Tümü <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>

</div>