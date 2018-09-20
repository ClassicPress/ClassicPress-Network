<?php
	if ( ! defined( 'ABSPATH' ) ) { exit; }
	
	global $dfd_native;
	
	$prev_post = get_previous_post();
	$next_post = get_next_post();
	
	$prev_post_link = $prev_post_title = $prev_post_date = $prev_post_thumb = $next_post_link = $next_post_title = $next_post_date = $next_post_thumb = false;
	
	$prev_arrow_text = '<i class="dfd-socicon-arrow-left-01"></i><span>'. esc_html__('Prev','dfd-native') .'</span>';
	$next_arrow_text = '<i class="dfd-socicon-arrow-right-01"></i><span>'. esc_html__('Next','dfd-native') .'</span>';
	
	if(!empty($prev_post) && is_object($prev_post)) {
		$prev_post_link = get_permalink($prev_post->ID);
		$prev_post_title = get_the_title($prev_post->ID);
		if($prev_post->post_type == 'post') {
			$prev_post_date = '<i class="dfd-socicon-clock"></i><span>'.esc_html(mysql2date('d F Y', $prev_post->post_date, true)).'</span>';
		} else {
			$subtitle = get_post_meta($prev_post->ID, 'stunnig_headers_subtitle', true);
			if($subtitle && !empty($subtitle)) {
				$prev_post_date = $subtitle;
			}
		}
		$prev_post_thumb = get_the_post_thumbnail($prev_post->ID, array(95,95));
		
		if(empty($prev_post_thumb)) {
			$prev_post_thumb = '<i class="dfd-socicon-arrow-left-01"></i>';
		}
	}
	
	if(!empty($next_post) && is_object($next_post)) {
		$next_post_link = get_permalink($next_post->ID);
		$next_post_title = get_the_title($next_post->ID);
		if($next_post->post_type == 'post') {
			$next_post_date = '<i class="dfd-socicon-clock"></i><span>'.esc_html(mysql2date('d F Y', $next_post->post_date, true)).'</span>';
		} else {
			$subtitle = get_post_meta($next_post->ID, 'stunnig_headers_subtitle', true);
			if($subtitle && !empty($subtitle)) {
				$next_post_date = $subtitle;
			}
		}
		$next_post_thumb = get_the_post_thumbnail($next_post->ID, array(95,95));
		
		if(empty($next_post_thumb)) {
			$next_post_thumb = '<i class="dfd-socicon-arrow-right-01"></i>';
		}
	}
	$extra_prev_class = $prev_post_link != '' ? '' : 'empty';
	$extra_next_class = $next_post_link != '' ? '' : 'empty';

if(!empty($prev_post_link)) :
	echo '<a href="'. esc_url($prev_post_link) .'" class="page-inner-nav nav-prev '. esc_attr($extra_prev_class) .'">';
		echo '<span class="dfd-controler prev"><i class="dfd-socicon-arrow-left-01"></i><span>'. esc_html__('Prev','dfd-native') .'</span></span>';
		echo '<span class="pagination-title">';
			echo '<span class="thumb prev">'. $prev_post_thumb .'</span>';
			echo '<span class="dfd-vertical-aligned">';
				echo '<span class="dfd-content-title-big">'. esc_html($prev_post_title) .'</span>';
				echo '<span class="entry-meta">'. $prev_post_date .'</span>';
			echo '</span>';
		echo '</span>';
	echo '</a>';
endif;
if(!empty($next_post_link)) :
	echo '<a href="'. esc_url($next_post_link) .'" class="page-inner-nav nav-next '. esc_attr($extra_next_class) .'">';
		echo '<span class="dfd-controler next"><i class="dfd-socicon-arrow-right-01"></i><span>'. esc_html__('Next','dfd-native') .'</span></span>';
		echo '<span class="pagination-title">';
			echo '<span class="thumb next">'. $next_post_thumb .'</span>';
			echo '<span class="dfd-vertical-aligned">';
				echo '<span class="dfd-content-title-big">'. esc_html($next_post_title) .'</span>';
				echo '<span class="entry-meta">'. $next_post_date .'</span>';
			echo '</span>';
		echo '</span>';
	echo '</a>';
endif;