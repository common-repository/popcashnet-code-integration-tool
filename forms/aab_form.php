<div class="aab">

<div class="alert alert-light text-center col-md-6 offset-md-3">
  <?php
  if (checkIntegration(2)) { ?>
    <span class='text-success'>Data successfully saved! </span>
  <?php } else { ?>
    Please insert your Popcash Api Key used for Anti AdBlock. <hr/>
    <span class='text-danger'>
      If you are using AdBlock please <strong>disable it</strong> before saving!
    </span>
  <?php } ?>
</div>

<div class="col-md-6 offset-md-3 error-msg text-center" style="padding:0; display:none;">
  <div class='alert alert-danger'>
    <span class='text-danger'>ApiKey or WebsiteID is not valid! Please check again!</span>
  </div>
</div>

<input name="popcash_net_uid" type="hidden" id="popcash_net_uid" class="form-control" value="<?php echo esc_html(get_option('popcash_net_uid')); ?>">

<div class="col-md-8 col-xs-10 offset-md-2 offset-xs-1 bm-3 mt-3">
  <div class="input-group">
    <span class="input-group-text" id="basic-addon3" style="width:30%">Anti AdBlock Api Key </span>
    <input name="popcash_net_api_key" type="text" id="popcash_net_api_key" class="form-control" value="<?php echo esc_html(get_option('popcash_net_api_key')); ?>">
  </div>
</div>

<div class="col-md-8 col-xs-10 offset-md-2 offset-xs-1 bm-3 mt-3">
  <div class="input-group">
    <span class="input-group-text" id="basic-addon3" style="width:30%">Website ID</span>
    <input name="popcash_net_wid" type="text" id="popcash_net_wid" class="form-control" value="<?php echo esc_html(get_option('popcash_net_wid')); ?>">
  </div>
</div>

<div style="display:none" class="text-center error-msg input-group col-md-6 col-xs-10 offset-md-3 col-xs-offset-1" style="margin-top:15px; margin-bottom:15px;">

</div>

<div class="col-md-8 col-xs-10 offset-md-2 offset-xs-1 bm-3 mt-3">
  <div class="input-group">
    <span class="input-group-text" id="basic-addon3" style="width:30%">Popunder Fallback</span>
    <select name="popcash_net_fallback" id="popcash_net_fallback" class="form-control">
      <option value="0" <?php if (esc_html(get_option('popcash_net_fallback')) == '0' ) echo 'selected' ; ?>>Tabunder</option>
      <option value="1" <?php if (esc_html(get_option('popcash_net_fallback')) == '1' ) echo 'selected' ; ?>>Popup</option>
    </select>
  </div>
</div>

<div class="col-md-8 col-xs-10 offset-md-2 offset-xs-1 bm-3 mt-3">
  <div class="input-group">
    <span class="input-group-text" id="basic-addon3" style="width:30%">Frequency Cap</span>
    <select name="popcash_net_fcap" id="popcash_net_fcap" class="form-control">
      <option value="1" selected> 1 </option>
    </select>
    <div class="ajax-loader" style="display:none"></div>
  </div>
</div>

</div>
