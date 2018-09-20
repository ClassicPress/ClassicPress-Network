<?php
	/**
	 * The template for the header sticky bar.
	 *
	 * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
	 *
	 * @author 		Redux Framework
	 * @package 	ReduxFramework/Templates
	 * @version     3.4.3
	 */
?>
<div id="redux-sticky">

	<!-- Notification bar -->
	<div id="redux_notification_bar">
		<?php $this->notification_bar(); ?>
	</div>

	<div id="info_bar">
		
		<?php
		/*
		<a href="javascript:void(0);"
		   class="expand_options<?php echo ( $this->parent->args['open_expanded'] ) ? ' expanded' : ''; ?>"<?php echo $this->parent->args['hide_expand'] ? ' style="display: none;"' : '' ?>><?php esc_html_e( 'Expand', 'dfd-native' ); ?></a>
		*/
		?>

		<div class="redux-action_bar <?php echo ( false === $this->parent->args['hide_reset'] ) ? 'dev-mode' : '' ?>">
			<div class="dfd-nav-tabs-section"></div>
			<?php /* <span class="spinner"></span> */ ?>
			<div class="options-header-buttons-section">
				<div class="dfd-options-button-cover options-button-green">
					<?php submit_button( esc_html__( 'Save Changes', 'dfd-native' ), 'primary', 'redux_save', false, array('id' => 'redux_save_top') ); ?>
				</div>
				<?php if(defined('DFD_DEBUG_MODE') && DFD_DEBUG_MODE) : ?>
					<div class="dfd-options-button-cover options-button-green-border">
						<?php submit_button( esc_html__( 'Recompile All Styles', 'dfd-native' ), 'secondary', 'recompileStyleButton', false ,array("onclick"=>"return false;")); ?>
					</div>
					<?php if ( false === $this->parent->args['hide_reset'] && isset($this->parent->options['dev_mode']) && $this->parent->options['dev_mode'] == 'on' ) : ?>
					<?php /* ?>
						<div class="dfd-options-button-cover">
							<?php submit_button( esc_html__( 'Reset Section', 'dfd-native' ), 'secondary dfd-reset-button', $this->parent->args['opt_name'] . '[defaults-section]', false ); ?>
						</div>
					<?php */ ?>
						<div class="dfd-options-button-cover">
							<?php submit_button( esc_html__( 'Reset options', 'dfd-native' ), 'secondary dfd-reset-button', $this->parent->args['opt_name'] . '[defaults]', false ); ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="redux-ajax-loading" alt="<?php esc_attr_e( 'Working...', 'dfd-native' ) ?>">&nbsp;</div>
		<?php /*<div class="clear"></div>*/ ?>
	</div>

</div>