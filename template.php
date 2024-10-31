<div class="wrap">
  <h2>PopCash Publisher Code Integration</h2>
<?php

pcit_popcash_switch_enabled();
$active_tab = (isset($_GET[ 'tab' ])) ? sanitize_text_field($_GET[ 'tab' ]) : pcit_popcash_default_tab();

if ($active_tab == 'individual_ids') {

  $tab = 0;
} else {

  $tab = 1;
}
?>
<div class="row">
  <div><?php echo pcit_popcash_logo(); ?></div>
</div>

<div class="row">
  <div class="col-md-4 pull-left" style="margin-bottom:15px;">
  <input
    type="button"
    class="button-secondary"
    onclick="<?php echo esc_attr("location.href='admin.php?page=popcash-net&tab=" . htmlentities((isset($_GET['tab']) ? $_GET['tab'] : 'individual_ids')) . "&d_status=switch'"); ?>
    value="<?php echo esc_attr(get_option('popcash_net_disabled') == 1 ? 'Enable PopUnder Code' : 'Disable PopUnder Code'); ?>"
  />
  </div>
  <div class="col-md-4 col-xs-8 col-md-offset-0 col-xs-offset-2"><?php pcit_popcash_code_disabled(); ?></div>
</div>

<?php
  if ((bool)get_option('popcash_net_disabled') === false) {
?>

<ul class="nav nav-tabs">
  <li role="presentation" class="<?php echo $active_tab == 'individual_ids' ? 'active' : ''; ?>"><a href="?page=popcash-net&tab=individual_ids">Individual IDs</a></li>
  <li role="presentation" class="<?php echo $active_tab == 'code_integration' ? 'active' : ''; ?>"><a href="?page=popcash-net&tab=code_integration">Code Integration</a></li>
</ul>


  <form method="post" action="options.php" style="padding-top:20px"> <?php

if ($active_tab == 'individual_ids') {

  settings_fields( 'myoption-group' );
  do_settings_fields( 'popcash-net', 'myoption-group' ); ?>

    <input type="hidden" name="popcash_net_last" value="individual" /> <?php

  include 'ids_form.php';

} else {

  settings_fields( 'myoption-group2' );
  do_settings_fields( 'popcash-net', 'myoption-group2' );



  include 'textarea_form.php';
} ?>

    <input type="hidden" name="action" value="update" /> <?php

if (($tab == 0) && (isset($_GET['settings-updated']) && ($_GET['settings-updated']) == true)) {

delete_option('popcash_net_textarea'); ?>

    <input type="hidden" name="popcash_net_uid1" value="popcash_net_uid" />
    <input type="hidden" name="popcash_net_wid1" value="popcash_net_wid" />
    <input type="hidden" name="popcash_net_fallback1" value="popcash_net_fallback" /> <?php

} elseif (($tab == 1) && (isset($_GET['settings-updated']) && ($_GET['settings-updated']) == true)) {

delete_option('popcash_net_uid');
delete_option('popcash_net_wid');
delete_option('popcash_net_fallback'); ?>

    <input type="hidden" name="popcash_net_textarea1" value="popcash_net_textarea" /> <?php
} ?>
  <p>
    <input type="submit" name="submit" value="<?php _e('Save Changes') ?>" class="button-primary" />
  </p>
  </form>

<?php } ?>
</div>
