<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(isset($post) && !empty($post) && is_object($post)) {
	$current_category_info = get_the_category($post->ID);
	$current_cat_id = !empty($current_category_info) && is_array($current_category_info) ? $current_category_info[0]->term_id : '';
	$current_cat_name = !empty($current_category_info) && is_array($current_category_info) ? $current_category_info[0]->cat_name : '';
	$cat_meta = get_option("taxonomy_$current_cat_id");
	if($current_cat_name != '') {
		?>
		<span class="byline category" <?php echo (isset($cat_meta['custom_term_meta_color']) && !empty($cat_meta['custom_term_meta_color'])) ? 'style="background: '.esc_attr($cat_meta['custom_term_meta_color']).'"' : ''; ?>>
			<a href="<?php echo get_category_link($current_cat_id); ?>" class="fn">
				<span class="cat-name"><?php echo esc_html($current_cat_name); ?></span>
			</a>
		</span>
		<?php
	}
}