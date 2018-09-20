<?php
/*
Template Name: Porfolio page template
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part('inc/loop/components/layout');

if(class_exists('Dfd_Layout_Builder')) {
	new Dfd_Layout_Builder(array(
		'loop' => 'custom',
		'page' => 'portfolio',
		'class' => 'dfd-portfolio-loop'
	));
}

get_footer();