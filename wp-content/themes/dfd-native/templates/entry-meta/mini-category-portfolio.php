<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$id = get_the_ID();
$product_terms = wp_get_object_terms($id, 'portfolio_category');
?>

<?php if (isset($product_terms[0]) && !empty($product_terms[0]) && !is_wp_error($product_terms)):
	$current_cat_id = $product_terms[0]->term_id;
	$cat_meta = get_option("taxonomy_$current_cat_id");
	?>
	<span class="byline category">
		<a href="<?php echo esc_url(get_term_link($product_terms[0]->slug, 'portfolio_category')); ?>" class="fn" <?php echo (isset($cat_meta['custom_term_meta_color']) && !empty($cat_meta['custom_term_meta_color'])) ? 'style="background: '.esc_attr($cat_meta['custom_term_meta_color']).'"' : ''; ?>>
			<span class="cat-name"><?php echo esc_html($product_terms[0]->name); ?></span>
		</a>
	</span>
<?php endif;
