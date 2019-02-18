<?php settings_errors(); ?>
<form method="post" action="options.php">
    <?php settings_fields( 'cam-market-price' ) ?>
    <?php do_settings_sections( 'cam_add_market' ); ?>
    <?php submit_button(); ?>
</form>