<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<aside class="three columns" id="left-sidebar">

    <?php
	global $dfd_left_sidebar;
	
	$selected_sidebar = $dfd_left_sidebar;

    if ($selected_sidebar && (function_exists('smk_sidebar'))) {

		smk_sidebar($selected_sidebar);

    } elseif (function_exists('is_woocommerce') && is_woocommerce()) {
		
		if(is_single()) {
			dynamic_sidebar('shop-sidebar-left');
		} else {
			dynamic_sidebar('shop-sidebar-product-list-left');
		}
		
    } elseif (is_active_sidebar('sidebar-left')) {
		dynamic_sidebar('sidebar-left');
    } else {
		the_widget( 'dfd_author', 'title=Author&author_title=Author Name&author_subtitle=Author subtitle&author_info=Author Description</br>nteger sed sem sed eros sodales pellentesque sed quis mauris.&author_facebook_url=#url_facebook&author_twitter_url=#url_twitter&author_google_url=#url_google+', 'before_widget=<div id="%1$s" class="widget %s">&before_title=<h3 class="widget-title">&after_title=</h3>');
		the_widget( 'dfd_login_widget', 'title=Login on site', 'before_widget=<div id="%1$s" class="widget %s">&before_title=<h3 class="widget-title">&after_title=</h3>');
		the_widget( 'dfd_subscribe', 'title=Subscribe', 'before_widget=<div id="%1$s" class="widget %s">&before_title=<h3 class="widget-title">&after_title=</h3>');
    }
    ?>

</aside>