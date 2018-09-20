<?php
    /**
     * The template for the panel footer area.
     * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
     *
     * @author        Redux Framework
     * @package       ReduxFramework/Templates
     * @version       3.5.0.6
     */
?>
<div id="redux-sticky-padder" style="display: none;">&nbsp;</div>
<div id="redux-footer-sticky">
    <div id="redux-footer">

        <?php /*if ( isset( $this->parent->args['share_icons'] ) ) : ?>
            <div id="redux-share">
                <?php foreach ( $this->parent->args['share_icons'] as $link ) : ?>
                    <?php
                    // SHIM, use URL now
                    if ( isset( $link['link'] ) && ! empty( $link['link'] ) ) {
                        $link['url'] = $link['link'];
                        unset( $link['link'] );
                    }
                    ?>

                    <a href="<?php echo $link['url'] ?>" title="<?php echo $link['title']; ?>" target="_blank">

                        <?php if ( isset( $link['icon'] ) && ! empty( $link['icon'] ) ) : ?>
                            <i class="<?php
                                if ( strpos( $link['icon'], 'el-icon' ) !== false && strpos( $link['icon'], 'el ' ) === false ) {
                                    $link['icon'] = 'el ' . $link['icon'];
                                }
                                echo $link['icon'];
                            ?>"></i>
                        <?php else : ?>
                            <img src="<?php echo $link['img'] ?>"/>
                        <?php endif; ?>

                    </a>
                <?php endforeach; ?>

            </div>
        <?php endif;*/ ?>

		<?php /* <span class="spinner"></span> */ ?>
        <div class="redux-action_bar <?php echo ( false === $this->parent->args['hide_reset'] ) ? 'dev-mode' : '' ?>">
			<div class="dfd-nav-tabs-section"></div>
			<div class="options-header-buttons-section">
				<div class="dfd-options-button-cover options-button-green">
					<?php submit_button( esc_html__( 'Save Changes', 'dfd-native' ), 'primary', 'redux_save', false, array('id' => 'redux_save_bottom') ); ?>
				</div>
				<?php
				?>
				<?php if(isset($this->parent->options['dev_mode']) && $this->parent->options['dev_mode'] == 'on' && defined('DFD_DEBUG_MODE') && DFD_DEBUG_MODE) : ?>
					<?php if ( false === $this->parent->args['hide_reset'] ) : ?>
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
        <div class="clear"></div>

    </div>
</div>
