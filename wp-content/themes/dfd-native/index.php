<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part('inc/loop/components/layout');

if(class_exists('Dfd_Layout_Builder')) {
	new Dfd_Layout_Builder(array(
		'loop' => 'loop',
		'page' => 'post_archive',
		'class' => 'dfd-blog-loop'
	));	
}

get_footer();