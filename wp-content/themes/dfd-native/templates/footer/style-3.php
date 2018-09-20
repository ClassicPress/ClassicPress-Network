<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_native;
$footer_page_select = isset($dfd_native['footer_page_select']) ? $dfd_native['footer_page_select'] : '';
if (!empty($footer_page_select)) {
	$footer_page_select_id = intval($footer_page_select);
	$page_data = get_page($footer_page_select_id);
	
	if (!empty($page_data) && isset($page_data->post_status) && strcmp($page_data->post_status,'publish')===0) {
		global $wp_the_query;

		$wp_the_query_backup = $wp_the_query;
		
		$wp_the_query = new WP_Query(array(
			'page_id' => $footer_page_select_id,
		));

		if ($wp_the_query->have_posts()) {
			$wp_the_query->the_post();
			?>

			<?php the_content(); ?>
			<?php if (function_exists('mvb_the_content')) { mvb_the_content(); } ?>

			<?php 	
			$wp_the_query = $wp_the_query_backup;
			wp_reset_postdata();
		}
	}
}