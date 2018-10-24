<?php
/**
 * Class: Date Widget
 *
 * Date widget for search extension.
 *
 * @since 1.0.0
 * @package wsal
 * @subpackage search
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class WSAL_AS_Filters_DateWidget
 *
 * @package search-wsal
 */
class WSAL_AS_Filters_DateWidget extends WSAL_AS_Filters_AbstractWidget {

	/**
	 * Method: Function to render field.
	 */
	protected function RenderField() {
		$date_format = WSAL_SearchExtension::GetInstance()->GetDateFormat();
		?>
		<div class="wsal-widget-container">
			<input type="text"
				class="<?php echo esc_attr( $this->GetSafeName() ); ?>"
				id="<?php echo esc_attr( $this->id ); ?>"
				placeholder="<?php echo esc_attr( $date_format ); ?>"
				data-prefix="<?php echo esc_attr( $this->prefix ); ?>"
			/>
			<button type="button" id="<?php echo esc_attr( "wsal-add-$this->prefix-filter" ); ?>" class="wsal-add-button dashicons-before dashicons-plus"></button>
		</div>
		<?php
	}

	/**
	 * Method: Render JS in footer regarding this widget.
	 */
	public function StaFooter() {
		?>
		<script type="text/javascript">
		window.WsalAs.Attach(function(){
			jQuery('input.<?php echo esc_attr( $this->GetSafeName() ); ?>').change(function(){
				if(this.value){
					WsalAs.AddFilter(jQuery(this).attr('data-prefix') + ':' + this.value);
					this.value = '';
				}
			});
		});
		</script><?php
	}
}
