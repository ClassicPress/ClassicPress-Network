<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(isset($post) && !empty($post) && is_object($post)) {
	$categories = wp_get_object_terms($post->ID, 'gallery_category');
	if(!empty($categories)) {
	?>
	<div class="dfd-single-categories">
		<ul>
		<?php foreach($categories as $cat) {
			$cat_hover_bg = '';
			$single_cat = get_category($cat);
			$cat_meta = get_option("taxonomy_$single_cat->term_id");
			
			if(isset($cat_meta['custom_term_meta_color']) && !empty($cat_meta['custom_term_meta_color'])) {
				$cat_hover_bg .= 'data-init-hover="1"';
				$cat_hover_bg .= 'data-prop="background"';
				$cat_hover_bg .= 'data-hover-val="'.esc_attr($cat_meta['custom_term_meta_color']).'"';
			}
			?>
			<li class="byline category">
				<a href="<?php echo get_category_link($single_cat); ?>" class="fn dfd-background-second" <?php
					echo (isset($cat_meta['custom_term_meta_color']) && !empty($cat_meta['custom_term_meta_color'])) ?
						'data-init-hover="1" data-prop="background" data-hover-val="'.esc_attr($cat_meta['custom_term_meta_color']).'"'
						: ''
					?>>
					<span class="cat-name"><?php echo esc_html($single_cat->name); ?></span>
				</a>
			</li>
		<?php } ?>	
		</ul>
	</div>
	<?php
	}
}