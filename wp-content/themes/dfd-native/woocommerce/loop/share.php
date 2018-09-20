<?php 
if (defined('YITH_WCWL')) {
	echo '<div class="wishlist-button-wrap">';
		wc_get_template_part('add-to-wishlist-button');
	echo '</div>';
}