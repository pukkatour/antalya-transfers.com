<form>

<div class="form-group" id="__type">
<label><b><?php echo $translate['tr_003']; ?> <span class="text-warning">*</span></b></label>
<select class="r-form-1-first-name form-control" id="tr_type" onchange="transfer_type_Fnc()">
<option value="0"><?php echo $translate['tr_003']; ?></option>
<option value="1"><?php echo $translate['tr_004']; ?></option>
<option value="2"><?php echo $translate['tr_005']; ?></option>
</select>
</div>

<div class="form-group">
<label><b><?php echo $translate['tr_006']; ?> <span class="text-warning">*</span></b></label>
<select class="r-form-1-first-name form-control" id="tr_direction" onchange="transfer_direction_Fnc()">
<option value="0"><?php echo $translate['tr_006']; ?></option>
<option value="1"><?php echo $translate['tr_007']; ?></option>
<option value="2"><?php echo $translate['tr_008']; ?></option>
</select>
</div>

<div class="form-group" id="__from">
<label id="transfer_airport_label"><b><?php echo $translate['tr_009']; ?> <span class="text-warning">*</span></b></label>
<select class="r-form-1-first-name form-control" id="tr_from" onchange="transfer_from_Fnc()">
<option value="0"><?php echo $translate['tr_010']; ?></option>
<?php if (!empty($airports)) { foreach ($airports as $airport) { ?>
<option value="<?php echo $airport['airport_airport_id']; ?>"><?php echo $airport['airport_name']; ?></option>
<?php } } ?>
</select>
</div>

<div class="form-group" id="__to">
<label id="transfer_resort_label"><b><?php echo $translate['tr_011']; ?> <span class="text-warning">*</span></b></label>
<select class="r-form-1-first-name form-control" id="tr_to" onchange="transfer_to_Fnc()">
<option value="0"><?php echo $translate['tr_012']; ?></option>
<?php if (!empty($districts)) { foreach ($districts as $dist) { ?>
<option value="<?php echo $dist['resort_resort_id']; ?>"><?php echo $dist['resort_name']; ?></option>
<?php } } ?>

<?php
if (!empty($hotel_dis)) { foreach ($hotel_dis as $hotel_d) {
$hotels = $Db->query("SELECT resort_resort_id,resort_name FROM transfer_resorts WHERE resort_lang_id = ? AND resort_is_hotel = ? AND resort_is_related = ? ORDER BY resort_name ASC", array($site_lang,'2',$hotel_d['resort_is_related']));
?>
<optgroup label="<?php echo $hotel_d['reso_name']; ?> <?php echo $translate['tr_013']; ?>">
<?php if (!empty($hotels)) { foreach ($hotels as $hotel) { ?>
<option value="<?php echo $hotel['resort_resort_id']; ?>"><?php echo $hotel['resort_name']; ?></option>
<?php } } ?>
</optgroup>
<?php } } ?>

</select>
</div>

<div class="row">

<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<div class="form-group">
<label><b><?php echo $translate['tr_014']; ?> <span class="text-warning">*</span></b></label>
<select class="r-form-1-first-name form-control" id="guests" onchange="transfer_guest_Fnc()">
<option value="0"><?php echo $translate['tr_015']; ?></option>
<?php for ($x = 1; $x <= 14; $x++) { ?>
<option value="<?php echo $x; ?>"><?php echo $x; ?></option>
<?php } ?>
</select>
</div>
</div>

<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<div class="form-group">
<label><b><?php echo $translate['tr_016']; ?> <span class="text-warning">*</span></b></label>
<select class="r-form-1-first-name form-control" id="curr" onchange="transfer_curr_Fnc()">
<option value="0"><?php echo $translate['tr_017']; ?></option>
<?php if (!empty($currencylist)) { foreach ($currencylist as $currency) { ?>
<option value="<?php echo $currency['curr_id']; ?>"><?php echo $currency['curr_code']; ?></option>
<?php } } ?>
</select>
</div>
</div>

</div>

<div class="form-group" id="__ret">
<label><b><?php echo $translate['tr_018']; ?> <span class="text-warning">*</span></b></label>
<select class="r-form-1-first-name form-control" id="tr_booking" onchange="one_ret_Fnc()">
<option value="0"><?php echo $translate['tr_018']; ?></option>
<option value="1"><?php echo $translate['tr_019']; ?></option>
<option value="2"><?php echo $translate['tr_020']; ?></option>
</select>
</div>

<p class="terms"><?php echo $translate['tr_021']; ?></p>

<input type="hidden" id="new_from" value="">
<input type="hidden" id="new_to" value="">
<input type="hidden" id="new_air_slug" value="">
<input type="hidden" id="new_des_slug" value="">

</form>