<div class="well">
  Please insert your individual IDs (User ID and Website ID) into the forms below.
</div>
<div class="input-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1" style="margin-top:15px; margin-bottom:15px;">
  <span class="input-group-addon" id="basic-addon3" style="width:20%">User ID</span>
  <input name="popcash_net_uid" type="number" id="popcash_net_uid" class="form-control" value="<?php echo esc_html(get_option('popcash_net_uid')); ?>">
</div>
<div class="input-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1" style="margin-top:15px; margin-bottom:15px;">
  <span class="input-group-addon" id="basic-addon3" style="width:20%">Website ID</span>
  <input name="popcash_net_wid" type="number" id="popcash_net_wid" class="form-control" value="<?php echo esc_html(get_option('popcash_net_wid')); ?>">
</div>
<div class="input-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1" style="margin-top:15px; margin-bottom:15px;">
  <span class="input-group-addon" id="basic-addon3" style="width:20%">Popunder Fallback</span>
  <select name="popcash_net_fallback" id="popcash_net_fallback" class="form-control">
    <option value="0" <?php if (get_option('popcash_net_fallback') == '0' ) echo 'selected' ; ?>>Tabunder</option>
    <option value="1" <?php if (get_option('popcash_net_fallback') == '1' ) echo 'selected' ; ?>>Popup</option>
  </select>
</div>
