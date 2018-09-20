<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action('after_setup_theme', 'dfd_head_cleanup_after_setup_theme');

function dfd_head_cleanup_after_setup_theme() {
	if (dfd_enable_root_relative_urls()) {
		$root_rel_filters = array(
			'bloginfo_url',
			'theme_root_uri',
			'stylesheet_directory_uri',
			'template_directory_uri',
			'plugins_url',
			'the_permalink',
			'wp_list_pages',
			'wp_list_categories',
			'wp_nav_menu',
			'the_content_more_link',
			'the_tags',
			'get_pagenum_link',
			'get_comment_link',
			'month_link',
			'day_link',
			'year_link',
			'tag_link',
			'the_author_posts_link'
		);

		dfd_add_filters($root_rel_filters, 'roots_root_relative_url');

		add_filter('script_loader_src', 'dfd_fix_duplicate_subfolder_urls');
		add_filter('style_loader_src', 'dfd_fix_duplicate_subfolder_urls');
	}
	
	add_filter('style_loader_tag', 'dfd_clean_style_tag');
	add_filter('body_class', 'dfd_body_class');
	add_filter('admin_body_class', 'dfd_admin_body_class');
	add_filter('wp_get_attachment_link', 'dfd_attachment_link_class', 10, 1);
	add_filter('img_caption_shortcode', 'dfd_caption', 10, 3);
	add_filter('excerpt_more', 'dfd_excerpt_more');
	add_filter('get_search_query', 'dfd_search_query');
	add_filter('request', 'dfd_request_filter');
	
	add_action('admin_init', 'roots_remove_dashboard_widgets');
	
}

function dfd_add_filters($tags, $function) {
	foreach ($tags as $tag) {
		add_filter($tag, $function);
	}
}

/**
 * Clean up output of stylesheet <link> tags
 */
function dfd_clean_style_tag($input) {
    preg_match_all("!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches);
    // Only display media if it's print
    $media = $matches[3][0] === 'print' ? ' media="print"' : '';
    return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}

/**
 * Add and remove body_class() classes
 */
function dfd_body_class($classes) {
	global $dfd_native;
	// Add theme defined body classes
	if (is_single() || is_page() && !is_front_page()) {
        $classes[] = 'dfd-page-class-'.basename(get_permalink());
    }
	if(DfdMetaboxSettings::get('dfd_enable_page_spacer')) {
		$classes[] = 'dfd-custom-padding-html';
	}
	if(isset($dfd_native['enable_deep_links']) && $dfd_native['enable_deep_links'] == 'on') {
		$classes[] = 'dfd-pp-deeplinks';
	}
	if(strcmp(DfdMetaBoxSettings::compared('site_preloader_enabled', 'off'),'1')===0) {
		$classes[] = 'dfd-preloader-enabled';
	}
	if ((!isset($dfd_native['scroll_animation']) || strcmp($dfd_native['scroll_animation'],'off')!==0) && class_exists('Dfd_Theme_extensions')) {
		$classes[] =  'dfd-smooth-scroll';
	}
	if(!class_exists('Dfd_Theme_extensions')) {
		$classes[] = 'dfd-extension-disabled';
	}
    // Remove unnecessary classes
    $home_id_class = 'page-id-' . get_option('page_on_front');
    $remove_classes = array(
        'page-template-default',
        $home_id_class
    );
    $classes = array_diff($classes, $remove_classes);
	
    return $classes;
}

/**
 * Add and remove body classes for admin area
 */
function dfd_admin_body_class() {
	$class = '';
	$curr_page_template = basename(get_page_template());

	if($curr_page_template == 'tmp-side-by-side.php') {
		$class .= substr(basename(get_page_template()), 0, -4);
	}
	
	return $class;
}

/**
 * Relative URLs
 *
 * WordPress likes to use absolute URLs on everything - let's clean that up.
 * Inspired by http://www.456bereastreet.com/archive/201010/how_to_make_wordpress_urls_root_relative/
 *
 * You can enable/disable this feature in config.php:
 * current_theme_supports('root-relative-urls');
 *
 * @author Scott Walkinshaw <scott.walkinshaw@gmail.com>
 */
function dfd_root_relative_url($input) {
    $output = preg_replace_callback(
        '!(https?://[^/|"]+)([^"]+)?!',
        create_function(
            '$matches',
            // If full URL is home_url("/") and this isn't a subdir install, return a slash for relative root
            'if (isset($matches[0]) && $matches[0] === home_url("/") && str_replace("http://", "", home_url("/", "http"))==$_SERVER["HTTP_HOST"]) { return "/";' .
                // If domain is equal to home_url("/"), then make URL relative
                '} elseif (isset($matches[0]) && strpos($matches[0], home_url("/")) !== false) { return $matches[2];' .
                // If domain is not equal to home_url("/"), do not make external link relative
                '} else { return $matches[0]; };'
        ),
        $input
    );

    return $output;
}

/**
 * Terrible workaround to remove the duplicate subfolder in the src of <script> and <link> tags
 * Example: /subfolder/subfolder/css/style.css
 */
function dfd_fix_duplicate_subfolder_urls($input) {
    $output = dfd_root_relative_url($input);
    preg_match_all('!([^/]+)/([^/]+)!', $output, $matches);

    if (isset($matches[1][0]) && isset($matches[2][0])) {
        if ($matches[1][0] === $matches[2][0]) {
            $output = substr($output, strlen($matches[1][0]) + 1);
        }
    }

    return $output;
}

function dfd_enable_root_relative_urls() {
    return !(is_admin() && in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'))) && current_theme_supports('root-relative-urls');
}

/**
 * Add class="thumbnail" to attachment items
 */
function dfd_attachment_link_class($html) {
    $postid = get_the_ID();
    $html = str_replace('<a', '<a class="thumbnail"', $html);
    return $html;
}


/**
 * Add Bootstrap thumbnail styling to images with captions
 * Use <figure> and <figcaption>
 *
 * @link http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
 */
function dfd_caption($output, $attr, $content) {
    if (is_feed()) {
        return $output;
    }

    $defaults = array(
        'id' => '',
        'align' => 'alignnone',
        'width' => '',
        'caption' => ''
    );

    $attr = shortcode_atts($defaults, $attr);

    // If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags
    if ($attr['width'] < 1 || empty($attr['caption'])) {
        return $content;
    }

    // Set up the attributes for the caption <figure>
    $attributes = (!empty($attr['id']) ? ' id="' . esc_attr($attr['id']) . '"' : '');
    $attributes .= ' class="thumbnail wp-caption ' . esc_attr($attr['align']) . '"';
    $attributes .= ' style="width: ' . esc_attr($attr['width']) . 'px"';

    $output = '<figure' . $attributes . '>';
    $output .= do_shortcode($content);
    $output .= '<figcaption class="caption wp-caption-text">' . $attr['caption'] . '</figcaption>';
    $output .= '</figure>';

    return $output;
}

/**
 * Remove unnecessary dashboard widgets
 *
 * @link http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
 */
function roots_remove_dashboard_widgets() {
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('dashboard_primary', 'dashboard', 'normal');
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
}

/**
 * Clean up the_excerpt()
 */
function dfd_excerpt_more($more) {
    return '';
}

/**
 * Fix for get_search_query() returning +'s between search terms
 */
function dfd_search_query($escaped = true) {
    $query = apply_filters('dfd_search_query', get_query_var('s'));

    if ($escaped) {
        $query = esc_attr($query);
    }

    return urldecode($query);
}

/**
 * Fix for empty search queries redirecting to home page
 *
 * @link http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
 * @link http://core.trac.wordpress.org/ticket/11330
 */
function dfd_request_filter($query_vars) {
    if (isset($_GET['s']) && empty($_GET['s'])) {
        $query_vars['s'] = '';
    }

    return $query_vars;
}
