<?php
/**
 * Alert Widget
 *
 * Alert widget class file.
 *
 * @package wsal
 * @subpackage search
 * @since 3.2.3
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WSAL_AS_Filters_AlertWidget' ) ) :

	/**
	 * WSAL_AS_Filters_AlertWidget.
	 *
	 * Class: Alert Widget.
	 */
	class WSAL_AS_Filters_AlertWidget extends WSAL_AS_Filters_AbstractWidget {

		/**
		 * Method: Function to render field.
		 */
		protected function RenderField() {
			?>
			<div class="wsal-widget-container">
				<input type="number"
					class="<?php echo esc_attr( $this->GetSafeName() ); ?>"
					id="<?php echo esc_attr( $this->id ); ?>"
					data-prefix="<?php echo esc_attr( $this->prefix ); ?>"
					min="1000"
					max="9999"
				/>
				<button id="<?php echo esc_attr( "wsal-add-$this->prefix-filter" ); ?>" class="wsal-add-button dashicons-before dashicons-plus"></button>
			</div>
			<?php
		}

		/**
		 * Method: Render JS in footer regarding this widget.
		 */
		public function StaFooter() {
			?>
			<script type="text/javascript">
				jQuery( '<?php echo esc_attr( "#wsal-add-$this->prefix-filter" ); ?>' ).click( function( event ) {
					event.preventDefault();
					var event_id_input = jQuery( 'input.<?php echo esc_attr( $this->GetSafeName() ); ?>' );
					var event_id = event_id_input.val();
					if ( event_id.length == 0 ) return;
					var event_id_filter_value = event_id_input.attr( 'data-prefix' ) + ':' + event_id;
					window.WsalAs.AddFilter( event_id_filter_value );
				} );
				jQuery( document ).ready( function( $ ) {
					// Event ID validation.
					var event_id_error = jQuery( '<span />' );
					event_id_error.addClass( 'wsal-input-error' );
					event_id_error.text( '* Invalid Event ID' );
					var event_id_label = jQuery( 'label[for="<?php echo esc_attr( $this->id ); ?>"]' );
					event_id_label.append( event_id_error );

					$( 'input.<?php echo esc_attr( $this->GetSafeName() ); ?>' ).on( 'change keyup keydown paste', function( event ) {
						if ( event.keyCode === 13 ) {
							event.preventDefault();
						}
						var event_id_value = $( this ).val();
						var event_id_add_btn = $( '<?php echo esc_attr( "#wsal-add-$this->prefix-filter" ); ?>' );
						event_id_error.removeAttr( 'style' );
						event_id_add_btn.removeAttr( 'disabled' );

						if ( event_id_value.length && ( event_id_value.length < 4 || event_id_value.length > 4 ) ) {
							event_id_error.css( { 'display' : 'inline-block' } );
							event_id_add_btn.attr( 'disabled', 'disabled' );
						}
					} );
				} );
			</script><?php
		}
	}

endif;
