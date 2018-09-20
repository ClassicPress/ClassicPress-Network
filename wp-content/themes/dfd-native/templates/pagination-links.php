<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	$prev_post = get_previous_post();
	$next_post = get_next_post();
	$prev_post_link = !empty($prev_post) ? get_permalink($prev_post->ID) : false;
	$next_post_link = !empty($next_post) ? get_permalink($next_post->ID) : false;
	$prev_post_title = !empty($prev_post) ? get_the_title($prev_post->ID) : false;
	$next_post_title = !empty($next_post) ? get_the_title($next_post->ID) : false;
	$prev_post_thumb = !empty($prev_post) ? get_the_post_thumbnail($prev_post->ID, 'thumbnail', array(42,42)) : false;
	$next_post_thumb = !empty($next_post) ? get_the_post_thumbnail($next_post->ID, 'thumbnail', array(42,42)) : false;
	if(!empty($prev_post) && is_object($prev_post) && empty($prev_post_thumb)) $prev_post_thumb = Dfd_Theme_Helpers::prev_next_post_format_icon($prev_post->ID);
	if(!empty($next_post) && is_object($next_post) && empty($next_post_thumb)) $next_post_thumb = Dfd_Theme_Helpers::prev_next_post_format_icon($next_post->ID);
	
echo'<div class="dfd-controls-top mobile-hide">';
	if(!empty($prev_post_link)) :
		echo '<a href="'. esc_url($prev_post_link) .'" class="page-inner-nav nav-prev">';
			echo '<div class="dfd-controler prev">';
				echo '<div class="thumb prev">'. $prev_post_thumb .'</div>';
			echo '</div>';
			echo '<div class="pagination-title">';
				echo '<div class="dfd-vertical-aligned">';
					echo '<div class="box-name">'. esc_html($prev_post_title) .'</div>';
				echo '</div>';
			echo '</div>';
		echo '</a>';
	endif;
	if(!empty($next_post_link)) :
		echo '<a href="'. esc_url($next_post_link) .'" class="page-inner-nav nav-next">';
			echo '<div class="dfd-controler next">';
				echo '<div class="thumb next">'. $next_post_thumb .'</div>';
			echo '</div>';
			echo '<div class="pagination-title">';
				echo '<div class="dfd-vertical-aligned">';
					echo '<div class="box-name">'. esc_html($next_post_title) .'</div>';
				echo '</div>';
			echo '</div>';
		echo '</a>';
	endif;
echo '</div>';