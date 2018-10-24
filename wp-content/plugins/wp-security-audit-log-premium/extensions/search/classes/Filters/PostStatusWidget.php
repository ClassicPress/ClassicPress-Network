<?php
/**
 * Post Status Widget
 *
 * Post Status widget class file.
 *
 * @package wsal
 * @subpackage search
 * @since 3.2.3
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WSAL_AS_Filters_PostStatusWidget' ) ) {

	/**
	 * WSAL_AS_Filters_PostStatusWidget.
	 *
	 * Class: Post Status Widget.
	 */
	class WSAL_AS_Filters_PostStatusWidget extends WSAL_AS_Filters_SingleSelectWidget {

		/**
		 * Render widget field.
		 */
		protected function RenderField() {
			?>
			<div class="wsal-widget-container">
				<select class="<?php echo esc_attr( $this->GetSafeName() ); ?>"
					id="<?php echo esc_attr( $this->id ); ?>"
					data-prefix="<?php echo esc_attr( $this->prefix ); ?>"
					>
					<option value=""></option>
					<?php
					foreach ( $this->items as $value => $text ) {
						if ( is_object( $text ) ) {
							// Render group (and items).
							echo '<optgroup label="' . esc_attr( $value ) . '">';
							foreach ( $text->items as $s_value => $s_text ) {
								echo '<option value="' . esc_attr( $s_value ) . '">' . esc_html( $s_text ) . '</option>';
							}
							echo '</optgroup>';
						} else {
							// Render item.
							echo '<option value="' . esc_attr( $value ) . '">' . esc_html( $text ) . '</option>';
						}
					}
					?>
				</select>
			</div>
			<?php
		}
	}
}
