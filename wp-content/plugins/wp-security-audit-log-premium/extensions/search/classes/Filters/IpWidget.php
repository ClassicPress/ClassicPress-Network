<?php
/**
 * IP Widget
 *
 * IP widget class file.
 *
 * @package wsal
 * @subpackage search
 * @since 3.2.3
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WSAL_AS_Filters_IpWidget' ) ) {

	/**
	 * WSAL_AS_Filters_IpWidget.
	 *
	 * Class: IP Widget.
	 */
	class WSAL_AS_Filters_IpWidget extends WSAL_AS_Filters_AutoCompleteWidget {

		/**
		 * Render widget field.
		 */
		protected function RenderField() {
			?>
			<div class="wsal-widget-container">
				<input type="text" autocomplete="off"
					class="<?php echo esc_attr( $this->GetSafeName() ); ?>"
					id="<?php echo esc_attr( $this->id ); ?>"
					name="<?php echo esc_attr( $this->id ); ?>"
					data-prefix="<?php echo esc_attr( $this->prefix ); ?>"
					data-filter="<?php echo esc_attr( $this->filter->GetSafeName() ); ?>"
				/>
				<button id="wsal-add-ip-filter" class="wsal-add-button dashicons-before dashicons-plus"></button>
			</div>
			<?php
		}
	}
}
