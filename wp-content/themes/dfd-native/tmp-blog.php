<?php
/*
Template Name: Blog page template
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part('inc/loop/components/layout');

if(class_exists('Dfd_Layout_Builder')) {
	new Dfd_Layout_Builder(array(
		'loop' => 'custom',
		'page' => 'post',
		'class' => 'dfd-blog-loop'
	));
}

get_footer();