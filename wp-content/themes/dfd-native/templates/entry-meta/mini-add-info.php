<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$button_url = get_post_meta(get_the_ID(), 'folio_client_site', true);
$button_text = get_post_meta(get_the_ID(), 'folio_client_name', true);
if(!$button_text || empty($button_text)) {
	$button_text = esc_html__('Visit project', 'dfd-native');
}
if (!empty($button_url)) { ?>

	<div class="folio-inside-add-info clearfix">
		<div class="folio-client">
			<a href="<?php echo esc_url($button_url); ?>" class="button"><?php echo esc_html($button_text); ?></a>
		</div>
	</div>
<?php }