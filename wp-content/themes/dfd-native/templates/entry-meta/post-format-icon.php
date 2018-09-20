<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Post type Icon
 */
if (has_post_format('video')) {
	# Video
	echo '<i class="dfd-socicon-icon-play"></i>';
} elseif (has_post_format('audio')) {
	# Audio
	echo '<i class="dfd-socicon-Microphone"></i>';
} elseif (has_post_format('gallery')) {
	# Gallery
	echo '<i class="dfd-socicon-editor-images-pictures-photos-collection-glyph"></i>';	
} elseif (has_post_format('quote')) {
	# Quote
	echo '<i class="dfd-socicon-75"></i>';	
} elseif (has_post_format('link')) {
	# Link
	echo '<i class="dfd-socicon-link5"></i>';	
} else {
	# Default
	echo '<i class="dfd-socicon-icon-social-buffer"></i>';
}
