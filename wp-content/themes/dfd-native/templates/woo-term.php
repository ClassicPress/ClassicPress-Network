<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$id = get_the_ID();
$product_terms = wp_get_object_terms($id, 'product_cat');
?>

<?php if (isset($product_terms[0]) && !empty($product_terms[0]) && !is_wp_error($product_terms)): ?>
	<span class="byline category">
		<a href="<?php echo esc_url(get_term_link($product_terms[0]->slug, 'product_cat')); ?>" class="fn">
			<span class="cat-name"><?php echo esc_html($product_terms[0]->name); ?></span>
		</a>
	</span>
<?php endif;