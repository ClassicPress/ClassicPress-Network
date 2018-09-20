<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(isset($post) && !empty($post) && is_object($post)) {
	$categories = wp_get_post_categories($post->ID);
	if(!empty($categories)) {
	?>
	<div class="dfd-single-categories">
		<ul>
		<?php foreach($categories as $cat) {
			$cat_hover_bg = '';
			$single_cat = get_category($cat);
			$cat_meta = get_option("taxonomy_$single_cat->term_id");
			
			?>
			<li class="byline category">
				<a href="<?php echo get_category_link($single_cat); ?>" class="fn dfd-background-second" <?php
					if(isset($cat_meta['custom_term_meta_color']) && !empty($cat_meta['custom_term_meta_color'])) { ?>
						data-init-hover="1"
						data-prop="background"
						data-hover-val="<?php echo esc_attr($cat_meta['custom_term_meta_color']) ?>"
				<?php }
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