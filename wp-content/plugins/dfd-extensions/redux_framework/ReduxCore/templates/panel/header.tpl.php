<?php
	/**
	 * The template for the panel header area.
	 *
	 * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
	 *
	 * @author 	Redux Framework
	 * @package 	ReduxFramework/Templates
	 * @version     3.4.4
	 */

$tip_title  = esc_html__('Developer Mode Enabled', 'dfd-native');
/*
if ($this->parent->dev_mode_forced) {
    $is_debug       = false;
    $is_localhost   = false;
    
    $debug_bit = '';
    if (Redux_Helpers::isWpDebug ()) {
        $is_debug = true;
        $debug_bit = esc_html__('WP_DEBUG is enabled', 'dfd-native');
    }
    
    $localhost_bit = '';
    if (Redux_Helpers::isLocalHost ()) {
        $is_localhost = true;
        $localhost_bit = esc_html__('you are working in a localhost environment', 'dfd-native');
    }
    
    $conjunction_bit = '';
    if ($is_localhost && $is_debug) {
        $conjunction_bit = ' ' . esc_html__('and', 'dfd-native') . ' ';
    }
    
    $tip_msg    = esc_html__('Redux has enabled developer mode because', 'dfd-native') . ' ' . $debug_bit . $conjunction_bit . $localhost_bit . '.';
} else {
    $tip_msg    = esc_html__('If you are not a developer, your theme/plugin author shipped with developer mode enabled. Contact them directly to fix it.', 'dfd-native');
}
*/
?>
<div id="redux-header">
	<?php if ( ! empty( $this->parent->args['display_name'] ) ) { ?>
		<div class="display_header">

			<?php /*if ( isset( $this->parent->args['dev_mode'] ) && $this->parent->args['dev_mode'] ) { ?>
				<div class="redux-dev-mode-notice-container redux-dev-qtip" qtip-title="<?php echo $tip_title; ?>" qtip-content="<?php echo $tip_msg; ?>">
					<span class="redux-dev-mode-notice"><?php esc_html_e( 'Developer Mode Enabled', 'dfd-native' ); ?></span>
				</div>
			<?php }*/ ?>

			<h2>
				<?php echo $this->parent->args['display_name']; ?>
				<?php if ( ! empty( $this->parent->args['display_version'] ) ) { ?>
					<span><?php esc_html_e('Ver', 'dfd-native') ?>. <?php echo $this->parent->args['display_version']; ?></span>
				<?php } ?>
			</h2>
			
			<p class="clearfix">
				<?php esc_html_e('Any questions you can ask on our','dfd-native') ?> <a href="http://nativewptheme.net/support/" title="<?php esc_attr_e('Support forum', 'dfd-native') ?>" target="_blank"><?php esc_html_e('Support Forum','dfd-native') ?></a>
				<a class="docs-icon" href="http://nativewptheme.net/support/native-documentation" title="<?php esc_attr_e('Theme documentation','dfd-native') ?>" target="_blank"><?php esc_html_e('Native theme documentation','dfd-native') ?> <i class="dashicons dashicons-admin-comments"></i></a>
			</p>

		</div>
	<?php } ?>

	<div class="clear"></div>
</div>