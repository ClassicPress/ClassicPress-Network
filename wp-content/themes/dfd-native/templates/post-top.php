<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php
echo '<div class="blog-top-block mobile-hide clearfix">';
	$categories = get_categories();
	if(!empty($categories) && is_array($categories)) :
		echo '<div class="click-dropdown">';
			echo '<a href="#">'. esc_html__('Categories','dfd-native') .'<span></span></a>';
			echo '<div>';
				echo '<ul class="category-filer">';
						echo '<li><a href="#" data-filter=".post">'.esc_html__('All', 'dfd-native').'</a></li>';
						foreach($categories as $category) {
							$cat_url = get_term_link($category->slug, 'category');
							if(!is_wp_error($cat_url)) {
								$cat_url = esc_url($cat_url);
							} else {
								$cat_url = '#';
							}
							$t_id = $category->term_id;
							$icon = get_option("taxonomy_$t_id");
							echo '<li>';
							$icon_class = 'none';
							if(!empty($icon['custom_term_meta'])) {
								$icon_class = $icon['custom_term_meta'];
							}
							echo '<div class="icon-wrap"><i class="'.esc_attr($icon_class).'"></i></div>';
								echo '<a href="'.$cat_url.'" data-filter=".post[data-category~=\'' . strtolower(preg_replace('/\s+/', '-', $category->slug)) . '\']">'. esc_html($category->name) .'</a>';
							echo '</li>';
						}
				echo '</ul>';
			echo '</div>';
		echo '</div>';
	endif;
	$tags = get_terms('post_tag');
	if(!empty($tags) && is_array($tags)) :
		echo '<div class="click-dropdown">';
			echo'<a href="#">'. esc_html__('Tags','dfd-native') .'<span></span></a>';
			echo '<div>';
				echo '<ul class="filter-tags">';
					echo '<li><a href="#" data-filter=".post">'.esc_html__('All', 'dfd-native').'</a></li>';
					foreach($tags as $tag) :
						$t_id = $tag->term_id;
						$tag_url = get_tag_link($tag->term_id);
						if(!is_wp_error($tag_url)) {
							$tag_url = esc_url($tag_url);
						} else {
							$tag_url = '#';
						}
						echo '<li>';
							echo '<a href="'.$tag_url.'" data-filter=".post[data-tag~=\'' . strtolower(preg_replace('/\s+/', '-', $tag->slug)) . '\']">'. esc_html($tag->name) .'</a>';
						echo '</li>';
					endforeach;
				echo '</ul>';
			echo '</div>';
		echo '</div>';
	endif;
	$users = get_users(array('who' => 'authors'));
	if(!empty($users) && is_array($users)) {
		echo '<div class="click-dropdown">';
			echo '<a href="#">'. esc_html__('Authors','dfd-native') .'<span></span></a>';
			echo '<div>';
				echo '<ul class="filter-authors">';
					echo '<li><a href="#" data-filter=".post">'.esc_html__('All', 'dfd-native').'</a></li>';
					foreach($users as $user) {
						if(count_user_posts($user->ID, 'post', true)) {
							echo '<li>'
									.'<a href="'.esc_url(get_author_posts_url($user->ID)).'" data-filter=".post[data-author~=\'' . strtolower(preg_replace('/\s+/', '-', $user->user_nicename)) . '\']">'.esc_html($user->display_name).'</a>'
								.'</li>';
						}
					}
				echo '</ul>';
			echo '</div>';
		echo '</div>';
	}
	get_template_part('templates/entry-meta/blog-top-link');
echo '</div>';