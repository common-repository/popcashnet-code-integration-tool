<div class="pcit_popcash-wrap wrap">

<?php

if ((bool)get_option('popcash_net_disabled') === false) { ?>

<?php if((isset($_GET['tab']) && $_GET['tab'] == 'standard-script') || !isset($_GET['tab'])) { ?>
  <form method="post" action="options.php" style="padding-top:20px">
    <?php
      settings_fields('myoption-group');
      do_settings_fields('popcash-net', 'myoption-group');
      include  plugin_dir_path(__FILE__) . '../forms/standard_form.php';
      array_map('unlink', glob(plugin_dir_path( __FILE__ ) . "../ppch-h6IzF4iRLEdZV-QX82hhpzmvxX--*"));


    if (isset($_GET['settings-updated']) && ($_GET['settings-updated']) == true && (isset($_GET['tab']) && $_GET['tab'] == 'standard-script')) {
    ?>
        <input type="hidden" name="popcash_net_uid1" value="popcash_net_uid" />
        <input type="hidden" name="popcash_net_wid1" value="popcash_net_wid" />
        <input type="hidden" name="popcash_net_fallback1" value="popcash_net_fallback" />

    <?php } ?>


    <input type="hidden" name="action" value="update" />

    <div class="col-md-8 col-xs-10 offset-md-2 offset-xs-1 bm-3 mt-3">
      <div class="d-grid">
        <input <?php echo (get_option('popcash_net_uid') == false || get_option('popcash_net_wid')== false) ? 'disabled' : '' ; ?> type="submit" name="submit" value="<?php _e('Save Changes') ?>" class="button-primary" />
      </div>
    </div>

  </form>
<?php } ?>

<?php if(isset($_GET['tab']) && $_GET['tab'] == 'aab-script')  { ?>
  <form method="post" action="options.php" style="padding-top:20px">

    <?php
      settings_fields('myoption-group3');
      do_settings_fields('popcash-net', 'myoption-group3');
      include  plugin_dir_path(__FILE__) . '../forms/aab_form.php';

    if (isset($_GET['settings-updated']) && ($_GET['settings-updated']) == true && (isset($_GET['tab']) && $_GET['tab'] == 'aab-script')) {
      array_map('unlink', glob(plugin_dir_path( __FILE__ ) . "../ppch-h6IzF4iRLEdZV-QX82hhpzmvxX--*"));
    ?>
        <input type="hidden" name="popcash_net_uid1" value="popcash_net_uid" />
        <input type="hidden" name="popcash_net_api_key1" value="popcash_net_api_key" />
        <input type="hidden" name="popcash_net_wid1" value="popcash_net_wid" />
        <input type="hidden" name="popcash_net_fallback1" value="popcash_net_fallback" />
        <input type="hidden" name="popcash_net_fcap1" value="popcash_net_fcap" />

    <?php } ?>

    <input type="hidden" name="action" value="update" />
    <div class="col-md-8 col-xs-10 offset-md-2 offset-xs-1 bm-3 mt-3">
      <div class="d-grid">
        <input <?php echo (get_option('popcash_net_api_key') == false || get_option('popcash_net_wid')== false) ? 'disabled' : '' ; ?> type="submit" name="submit" value="<?php _e('Save Changes') ?>" class="button-primary" />
      </div>
    </div>
  </form>
<?php } ?>

<?php } ?>
</div>
</div>
