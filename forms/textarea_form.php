<div class='manual-integration'>

<div class="alert alert-light text-center col-md-6 offset-md-3">
<?php
if (checkIntegration(3)) { ?>
    <span class='text-success'>Data successfully saved! </span>
   <?php } else { ?>
      Please copy and paste the popunder code in the textarea below.
  <?php } ?>
</div>

<?php settings_errors('popcash_net_textarea'); ?>

<div class="col-md-8 col-xs-10 offset-md-2 offset-xs-1 bm-3 mt-3">
    <textarea placeholder="<script type='text/javascript'>&#10;      ....... &#10;      .......  &#10; </script>" name="popcash_net_textarea" id="popcash_net_textarea" class="form-control" rows="5" style="margin-top:15px; margin-bottom:15px;"><?php echo esc_html(get_option('popcash_net_textarea')); ?></textarea>
</div>
</div>
