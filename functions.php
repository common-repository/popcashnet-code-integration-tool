<?php

if(isset($_GET['page']) && sanitize_text_field($_GET['page']) == 'popcash-net' && isset($_GET['tab']) && !in_array(sanitize_text_field($_GET['tab']), ['standard-script', 'aab-script', 'manual-integration']) ||
  (isset($_GET['page']) && sanitize_text_field($_GET['page']) == 'popcash-net' && !isset($_GET['tab']))) {

  $integration = get_option('popcash_net_integration');
  $tab = 'standard-script';

  switch ($integration) {
    case 1:
        $tab = 'standard-script';
        break;
    case 2:
        $tab = 'aab-script';
        break;
  }

  header("Location: admin.php?page=popcash-net&tab=" . $tab);
  exit;
}

function pcit_popcash_logo()
{

  return "<img style='width:300px; padding-top:5px; padding-bottom:20px' src='" . plugins_url('images/logo.png', __FILE__) . "'/>";
}

function pcit_popcash_code_disabled()
{
  if (get_option('popcash_net_disabled') == true) { ?>

      <div class="alert alert-danger">
        PopCash.Net Popunder code is currently disabled for your website.
        Click <a href="<?php echo esc_url('admin.php?page=popcash-net&tab=' . htmlentities((isset($_GET['tab']) ? $_GET['tab'] : 'individual_ids')) . '&d_status=switch') ?>">
        here</a> to enable it!
      </div>

  <?php }
}

function pcit_popcash_integration_radio()
{
  if (get_option('popcash_net_disabled') == false) { ?>

  <div class='text-center'>
      <label class="radio-inline">
    <input type="radio" name="pcit_popcash_integration_type" onclick="window.location.href += '&tab=standard-script'" <?php echo (isset($_GET['tab']) && $_GET['tab'] == 'standard-script' ) || !isset($_GET['tab'])  ? 'checked' : ''; ?> > Standard Script <?php echo esc_html(get_option('popcash_net_integration')) == 1 ? '<strong>(Active)</strong>' : ''  ; ?>
      </label>
      <label class="radio-inline">
        <input type="radio" name="pcit_popcash_integration_type" onclick="window.location.href += '&tab=aab-script'"  <?php echo (isset($_GET['tab']) && $_GET['tab'] == 'aab-script' ) ? 'checked' :'' ; ?> > Anti Adblock <?php echo esc_html(get_option('popcash_net_integration')) == 2 ? '<strong>(Active)</strong>' : ''  ; ?>
      </label>

    </div>

  <?php }
}

function pcit_popcash_switch_enabled()
{

  $a           = "admin.php?page=popcash-net&tab=";
  $setting     = "popcash_net_disabled";
  $allowedTabs = ['individual_ids', 'code_integration'];

  $a .= (!isset($_GET['tab'])) || !in_array(sanitize_text_field($_GET['tab']), $allowedTabs) ? 'individual_ids' : sanitize_text_field( $_GET['tab']);

  if (isset($_GET['d_status'])) {
    if ($_GET['d_status'] == 'switch') {
      update_option($setting, !(bool)get_option($setting));
      wp_redirect($a);
      exit;
    }
  }
}

/////////////////////////
// Output Script
/////////////////////////

function pcit_popcash_add_individual_ids()
{
  global $popcash_it_vars;
  ?>
  <!-- Start PopCash Popunder Script -->
  <script type="text/javascript">
    var uid = '<?php echo esc_html($popcash_it_vars->uid) ?>';
    var wid = '<?php echo esc_html($popcash_it_vars->wid) ?>';
    <?php if ($popcash_it_vars->fallback == '1') {
      echo "var pop_fback = 'up'\n";
    } ?>
    var pop_tag = document.createElement('script');
    pop_tag.src = '//cdn.popcash.net/show.js';
    document.body.appendChild(pop_tag);
    pop_tag.onerror = function() {
      pop_tag = document.createElement('script');
      pop_tag.src = '//cdn2.popcash.net/show.js';
      document.body.appendChild(pop_tag)
    };
  </script>
  <!-- End PopCash.Net Popunder Script -->
<?php
}

function pcit_popcash_add_textarea()
{

  global $popcash_it_vars;

  echo "<!-- Start PopCash Popunder Script -->\n" . $popcash_it_vars->textarea . "\n<!-- End PopCash.Net Popunder Script -->\n\n";
}

function pcit_popcash_add_aab()
{

  include plugin_dir_path( __FILE__ ) . 'PopcashAab.php';
}

/////////////////////////
// Validation
/////////////////////////

function pcit_popcash_uid_validation($uid)
{
  $setting = 'popcash_net_uid';
  if (preg_match("/^[0-9]+$/", $uid)) {
    return $uid;
  } else {
    $message = 'User ID isn\'t properly formatted';
    add_settings_error($setting, 'uid-error', $message, 'error');
    return false;
  }
}

function pcit_popcash_wid_validation($wid)
{
  $setting = 'popcash_net_wid';
  if (preg_match("/^[0-9]+$/", $wid)) {
    return $wid;
  } else {
    $message = 'Website ID isn\'t properly formatted';
    add_settings_error($setting, 'wid-error', $message, 'error');
    return false;
  }
}

function pcit_popcash_fallback_validation($fallback)
{
  $setting = 'popcash_net_fallback';
  if (in_array($fallback, [0, 1])) {
    return $fallback;
  } else {
    $message = 'Fallback isn\'t properly formatted';
    add_settings_error($setting, 'wid-error', $message, 'error');
    return false;
  }
}


function checkIntegration($integration) {

  if($integration == 1) {
    $result = (isset($_GET['settings-updated']) && ($_GET['settings-updated']) == true
      && !count(get_settings_errors('popcash_net_wid'))
      && !count(get_settings_errors('popcash_net_uid'))
      && !count(get_settings_errors('popcash_net_fallback'))
      && (isset($_GET['tab']) && $_GET['tab'] == 'standard-script')
    );
  }

  if($integration == 2) {
    $result = (isset($_GET['settings-updated']) && ($_GET['settings-updated']) == true
      && !count(get_settings_errors('popcash_net_wid'))
      && !count(get_settings_errors('popcash_net_fallback'))
      && !count(get_settings_errors('popcash_net_fcap'))
      && !count(get_settings_errors('popcash_net_api_key'))
      && (isset($_GET['tab']) && $_GET['tab'] == 'aab-script')
    );
  }


  return $result;

}

/////////////////////////
// Pages
/////////////////////////
function pcit_popcash_popcash_net_publisher_code()
{

  include plugin_dir_path( __FILE__ ) . 'template/index.php';
  include plugin_dir_path( __FILE__ ) . 'template/forms.php';
}
