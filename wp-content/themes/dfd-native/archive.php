<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$post_type = get_post_type();
if($post_type == 'portfolio') {
	get_template_part('taxonomy-portfolio');
} elseif($post_type == 'gallery') {
	get_template_part('taxonomy-gallery');
} else {
	get_template_part('index');
}