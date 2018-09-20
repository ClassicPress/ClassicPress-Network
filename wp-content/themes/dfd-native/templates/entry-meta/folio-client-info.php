<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	$client_name = get_post_meta(get_the_ID(), 'folio_client_name', true);

	if (!empty($client_name)) { ?>
	<div class="folio-info-field">
		<div class="folio-client">
			<div class="entry-title"><?php esc_html_e('Client:', 'dfd-native'); ?> <span><?php echo esc_html($client_name); ?></span></div>
		</div>
	</div>
	<?php }