<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<aside class="three columns" id="right-sidebar">

    <?php
	/*
	if(is_single()){
        global $post;
        $page_id = $post->ID;
    } else {
        $page_id     = get_queried_object_id();
    }

    $selected_sidebar = get_post_meta($page_id, 'crum_sidebars_sidebar_2', true);
	*/
	
	global $dfd_right_sidebar;

    $selected_sidebar = $dfd_right_sidebar;

    if ($selected_sidebar && (function_exists('smk_sidebar'))) {

        smk_sidebar($selected_sidebar);

    } elseif (function_exists('is_woocommerce') && is_woocommerce() ) {

		if(is_single()) {
			dynamic_sidebar('shop-sidebar');
		} else {
			dynamic_sidebar('shop-sidebar-product-list');
		}
		
    } elseif (is_active_sidebar('sidebar-right')) {

        dynamic_sidebar('sidebar-right');

    } else {
//        the_widget( 'dfd_counter_mail', 'title=Counter&twitter=true', 'before_widget=<div id="%1$s" class="widget %s">&before_title=<h3 class="widget-title">&after_title=</h3>');
        the_widget( 'WP_Widget_Categories', 'title=Categories', 'before_widget=<div id="%1$s" class="widget %s">&before_title=<h3 class="widget-title">&after_title=</h3>');
        the_widget( 'dfd_rec_posts_thumb', 'title=Recent Posts&date=true&comments=true&like=true', 'before_widget=<div id="%1$s" class="widget %s">&before_title=<h3 class="widget-title">&after_title=</h3>');
        the_widget( 'WP_Widget_Tag_Cloud', 'title=Tags', 'before_widget=<div id="%1$s" class="widget %s">&before_title=<h3 class="widget-title">&after_title=</h3>');
    }

    ?>


  </aside>
