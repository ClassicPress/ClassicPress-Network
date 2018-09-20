<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/** Disable VC in gutenberg pages */
function vc_gutenberg_check_be( $result, $type ) {
	if ( function_exists( 'gutenberg_pre_init' ) && function_exists( 'gutenberg_init' ) ) {
		if ( isset( $_GET['classic-editor'] ) ) {
			return $result;
		}

		return ! gutenberg_can_edit_post( null );
	}

	return $result;
}

/**
 * @param \Vc_Settings $settings
 */
function vc_gutenberg_add_settings( $settings ) {
	if ( function_exists( 'gutenberg_pre_init' ) && function_exists( 'gutenberg_init' ) ) {

		$settings->addField( 'general', __( 'Disable Gutenberg Editor', 'js_composer' ), 'gutenberg_disable', 'vc_gutenberg_sanitize_disable_callback', 'vc_gutenberg_disable_render_callback' );
	}
}

/**
 * @param $rules
 *
 * @return mixed
 */
function vc_gutenberg_sanitize_disable_callback( $rules ) {
	return (bool) $rules;
}

/**
 * Not responsive checkbox callback function
 */
function vc_gutenberg_disable_render_callback() {
	$checked = ( $checked = get_option( 'wpb_js_gutenberg_disable' ) ) ? $checked : false;
	?>
	<label>
		<input type="checkbox"<?php echo( $checked ? ' checked' : '' ) ?> value="1"
				name="<?php echo 'wpb_js_gutenberg_disable' ?>">
		<?php _e( 'Disable', 'js_composer' ) ?>
	</label><br/>
	<p
			class="description indicator-hint"><?php _e( 'Disable Gutenberg Editor.', 'js_composer' ); ?></p>
	<?php
}

function vc_gutenberg_check_disabled( $result, $postType ) {
	if ( 'wpb_gutenberg_param' === $postType ) {
		return true;
	}
	if ( get_option( 'wpb_js_gutenberg_disable' ) ) {
		return false;
	}

	return $result;
}

function vc_gutenberg_map() {
	if ( function_exists( 'gutenberg_pre_init' ) && function_exists( 'gutenberg_init' ) ) {
		vc_lean_map( 'vc_gutenberg', null, dirname( __FILE__ ) . '/shortcode-vc-gutenberg.php' );
	}
}

add_filter( 'vc_is_valid_post_type_be', 'vc_gutenberg_check_be', 10, 2 );
add_filter( 'gutenberg_can_edit_post_type', 'vc_gutenberg_check_disabled', 10, 2 );
add_action( 'vc_settings_tab-general', 'vc_gutenberg_add_settings' );
add_action( 'plugins_loaded', 'vc_gutenberg_map' );

/** @see include/params/gutenberg/class-gutenberg-param.php */
require_once vc_path_dir( 'PARAMS_DIR', 'gutenberg/class-gutenberg-param.php' );
new Gutenberg_Param();
