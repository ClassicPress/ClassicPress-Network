<?php
/*
Template Name: Gallery page template
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part('inc/loop/components/layout');

if(class_exists('Dfd_Layout_Builder')) {
	new Dfd_Layout_Builder(array(
		'loop' => 'custom',
		'page' => 'gallery',
		'class' => 'dfd-gallery-loop'
	));
}

get_footer();