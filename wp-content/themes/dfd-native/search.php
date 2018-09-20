<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part('inc/loop/components/layout');

if(class_exists('Dfd_Layout_Builder')) {
	new Dfd_Layout_Builder(array(
		'loop' => 'search',
		'page' => 'post',
		'class' => 'no-title dfd-search-result'
	));	
}

get_footer();