<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
function dfd_widgets_init() {
    
  // Register Sidebars

    register_sidebar(array(
        'name' => esc_html__('Left Sidebar', 'dfd-native'),
        'id' => 'sidebar-left',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Right Sidebar', 'dfd-native'),
        'id' => 'sidebar-right',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer column 1', 'dfd-native'),
        'id' => 'sidebar-footer-col1',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer column 2', 'dfd-native'),
        'id' => 'sidebar-footer-col2',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer column 3', 'dfd-native'),
        'id' => 'sidebar-footer-col3',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer column 4', 'dfd-native'),
        'id' => 'sidebar-footer-col4',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Sidebar for shop. Product page left sidebar', 'dfd-native'),
        'id' => 'shop-sidebar-left',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Sidebar for shop. Product page right sidebar', 'dfd-native'),
        'id' => 'shop-sidebar',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Sidebar for shop left. Product list', 'dfd-native'),
        'id' => 'shop-sidebar-product-list-left',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Sidebar for shop right. Product list', 'dfd-native'),
        'id' => 'shop-sidebar-product-list',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Side Area', 'dfd-native'),
        'id' => 'sidebar-sidearea',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
        'name' => esc_html__('404 page column 1', 'dfd-native'),
        'id' => 'sidebar-nothing-col1',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('404 page column 2', 'dfd-native'),
        'id' => 'sidebar-nothing-col2',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('404 page column 3', 'dfd-native'),
        'id' => 'sidebar-nothing-col3',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('404 page column 4', 'dfd-native'),
        'id' => 'sidebar-nothing-col4',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

/*
 * Include widgets
 */
require( get_template_directory() . '/inc/widgets/author.php' );
require( get_template_directory() . '/inc/widgets/count-mail.php' );
require( get_template_directory() . '/inc/widgets/flickr.php' );
require( get_template_directory() . '/inc/widgets/image.php' );
require( get_template_directory() . '/inc/widgets/latest-post.php' );
require( get_template_directory() . '/inc/widgets/login.php' );
require( get_template_directory() . '/inc/widgets/recent-comment-avatar.php' );
require( get_template_directory() . '/inc/widgets/recent-comment-noavatar.php' );
require( get_template_directory() . '/inc/widgets/recent-posts-nothumb.php' );
require( get_template_directory() . '/inc/widgets/recent-posts-thumb.php' );
require( get_template_directory() . '/inc/widgets/social-accounts.php' );
require( get_template_directory() . '/inc/widgets/subscribe.php' );
require( get_template_directory() . '/inc/widgets/tags.php' );
if(class_exists('DFDTwitter')) {
	require( get_template_directory() . '/inc/widgets/tweets.php' );
}
require( get_template_directory() . '/inc/widgets/vcard_simple.php' );
require( get_template_directory() . '/inc/widgets/woo-products.php' );

/*
 * Register widgets
 */
register_widget( 'dfd_author' );
register_widget( 'dfd_counter_mail' );
register_widget( 'dfd_flickr' );
register_widget( 'dfd_image' );
register_widget( 'dfd_latest_post' );
register_widget( 'dfd_login_widget' );
register_widget( 'dfd_rec_com_with_avatar_noexept' );
register_widget( 'dfd_rec_com_with_exept_noavatar' );
register_widget( 'dfd_rec_posts_nothumb' );
register_widget( 'dfd_rec_posts_thumb' );
register_widget( 'dfd_soc_icon' );
register_widget( 'dfd_subscribe' );
register_widget( 'dfd_tags' );
if(class_exists( 'DFDTwitter' )) {
	register_widget( 'dfd_latest_tweets' );
}
register_widget( 'dfd_vcard_simple' );
register_widget( 'dfd_woo_products' );

add_action('widgets_init', 'dfd_widgets_init');

/*
 * Custom sidebar function including
 */

function add_user_sidebar( $id, $meta ){
    $sidebar = get_post_meta($id, $meta, $single = true);
    if ( ( $sidebar ) &&  function_exists('dynamic_sidebar') )
        return  dynamic_sidebar( $sidebar );
}