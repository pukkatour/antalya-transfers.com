<?php
if (!empty($_SESSION)) { if (!isset($_SESSION['home_modal']) && $_SESSION['home_modal'] != 1) {
$pop = $Db->row("SELECT * FROM home_modal WHERE lang_id = ?", array($site_lang));
$popdate = date_create();
?>

<?php if (!empty($pop['stat']) && ($pop['stat'] == 2)) { ?>
<div id="popup_bildirim" class="modal fade" role="dialog" tabindex="-1">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-body pad0">
<?php if (isset($pop['url']) && !empty($pop['url'])) { ?>
<a href="<?php echo $pop['url']; ?>" target="_blank" title="<?php echo $sitesettings['site_name']; ?>">
<?php } ?>
<img src="<?php echo IMAGE_FOLDER."home/".$pop['img']."?".date_timestamp_get($popdate); ?>" class="img-responsive" alt="<?php echo $sitesettings['site_name']; ?>">
<?php if (isset($pop['url']) && !empty($pop['url'])) { ?>
</a>
<?php } ?>
</div>
</div>
</div>
</div>

<script>$('#popup_bildirim').modal();</script>

<?php } } } $_SESSION['home_modal'] = 1; ?>