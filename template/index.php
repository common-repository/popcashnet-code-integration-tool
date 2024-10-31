<div class="container p-0 mt-4 pb-5 border rounded-3  border-dark"  style="background:#f5f5f5; font-size: 14px">
  <div class="pcit_popcash-wrap text-center">
    <h4 class='mt-3 mb-3'>PopCash Publisher Code Integration</h4>

    <?php
    pcit_popcash_switch_enabled();

    if(checkIntegration(1)) update_option('popcash_net_integration', 1);
    if(checkIntegration(2)) update_option('popcash_net_integration', 2);
    ?>

  <div><?php echo pcit_popcash_logo(); ?></div>

      <div style="margin-bottom:15px;">
      <input
        type="button"
        onclick="<?php echo esc_attr("location.href='admin.php?page=popcash-net&tab=" . htmlentities((isset($_GET['tab']) ? $_GET['tab'] : 'individual_ids')) . "&d_status=switch'"); ?>"
        value="<?php echo esc_attr((get_option('popcash_net_disabled') == 1 ? 'Enable PopUnder Code' : 'Disable PopUnder Code')); ?>"
        class="button-<?php echo esc_attr(get_option('popcash_net_disabled') == 1 ? 'primary' : 'secondary') ?>"
      />
      </div>

      <div class="col-md-6 col-xs-8 offset-md-3 offset-xs-2 mt-2">
        <?php pcit_popcash_code_disabled(); ?>
      </div>

      <?php pcit_popcash_integration_radio(); ?>

  </div>
