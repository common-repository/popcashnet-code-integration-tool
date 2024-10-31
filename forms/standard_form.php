<div class='standard'>

<div class="text-center col-md-6 offset-md-3">
  <?php
  if (checkIntegration(1)) { ?>
      <span class='text-success'> Data successfully saved! </span>
   <?php } else { ?>
      Please insert your individual IDs (User ID and Website ID) into the forms below.
  <?php } ?>
</div>


<?php settings_errors('popcash_net_wid'); ?>
<?php settings_errors('popcash_net_uid'); ?>
<?php settings_errors('popcash_net_fallback'); ?>

<div class="col-md-8 col-xs-10 offset-md-2 offset-xs-1 bm-3 mt-3">
  <div class="input-group">
    <span class="input-group-text" id="basic-addon3" style="width:25%">User ID</span>
    <input name="popcash_net_uid" type="number" id="popcash_net_uid" class="form-control" value="<?php echo esc_html(get_option('popcash_net_uid')); ?>">
  </div>
</div>

<div class="col-md-8 col-xs-10 offset-md-2 offset-xs-1 bm-3 mt-3">
  <div class="input-group">
    <span class="input-group-text" id="basic-addon3" style="width:25%">Website ID</span>
    <input name="popcash_net_wid" type="number" id="popcash_net_wid" class="form-control" value="<?php echo esc_html(get_option('popcash_net_wid')); ?>">
  </div>
</div>

<div class="col-md-8 col-xs-10 offset-md-2 offset-xs-1 bm-3 mt-3">
  <div class="input-group">
    <span class="input-group-text" id="basic-addon3" style="width:25%">Popunder Fallback</span>
    <select name="popcash_net_fallback" id="popcash_net_fallback" class="form-control">
      <option value="0" <?php echo esc_html((get_option('popcash_net_fallback')) == '0' ) ? 'selected' : ''; ?>>Tabunder</option>
      <option value="1" <?php echo esc_html((get_option('popcash_net_fallback')) == '1' ) ? 'selected' : ''; ?>>Popup</option>
    </select>
  </div>
</div>

</div>
