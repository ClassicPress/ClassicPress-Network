<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part('inc/loop/components/layout');

$class = 'nothing-found';

if(is_404() && isset($dfd_native['nothing_bg_dark']) && strcmp($dfd_native['nothing_bg_dark'], '1') === 0) {
	$class .= ' dfd-background-dark';
}

if(class_exists('Dfd_Layout_Builder')) {
	new Dfd_Layout_Builder(array(
		'loop' => 'loop',
		'page' => 'nothing',
		'class' => $class
	));
}

get_footer();