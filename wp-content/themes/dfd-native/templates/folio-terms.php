<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$id = get_the_ID();
$product_terms = wp_get_object_terms($id, 'portfolio_category');
$count = count($product_terms);
?>

<?php if (!empty($product_terms) && !is_wp_error($product_terms)): ?>
	<div class="entry-tags">
		<ul>
		<?php foreach ($product_terms as $term): ?>
			<li>
				<a href="<?php echo get_term_link($term->slug, 'portfolio_category'); ?>"><?php echo esc_html($term->name); ?></a>
			</li>
		<?php endforeach; ?>
		</ul>
		
	</div>
<?php endif; ?>
