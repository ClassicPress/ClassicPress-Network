<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<div class="blog-top-block">
	<div class="title"><?php echo esc_html__('Filter by:','dfd-native') ?></div>
	<?php
	
	$categories = get_terms('product_cat');
	if(!empty($categories) && is_array($categories)) : ?>
		<div class="click-dropdown">
			<a href="#"><?php esc_html_e('Categories','dfd-native') ?><span></span></a>
			<div>
				<ul class="category-filer dfd-woo-page-filter">
						<?php
						foreach($categories as $category) :
							$cat_url = get_term_link($category->slug, 'product_cat');
							if(!is_wp_error($cat_url)) {
							?>
								<li>
									<a href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($category->name); ?></a>
								</li>
							<?php
							}
						endforeach; ?>
				</ul>
			</div>
		</div>
	<?php endif; ?>
	<?php
	$tags = get_terms('product_tag');
	if(!empty($tags) && is_array($tags)) : ?>
		<div class="click-dropdown">
			<a href="#"><?php esc_html_e('Tags','dfd-native') ?><span></span></a>
			<div>
				<ul class="filter-tags">
					<?php
					foreach($tags as $tag) :
						$tag_url = get_term_link($tag->slug, 'product_tag');
						if(!is_wp_error($tag_url)) {
							?>
							<li>
								<a href="<?php echo esc_url($tag_url); ?>"><?php echo esc_html($tag->name); ?></a>
							</li>
							<?php
						}
					endforeach; ?>
				</ul>
			</div>
		</div>
	<?php endif; ?>
	<?php 
	/*
	<div class="click-dropdown">
		<a href="#"><?php esc_html_e('Authors','dfd-native') ?><span></span></a>
		<div>
			<ul class="filter-authors">
				<?php wp_list_authors(); ?>
			</ul>
		</div>
	</div>
	*/
	?>
	<?php get_template_part('templates/entry-meta/woo-top-link'); ?>
</div>