<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Post title typo */
$output .= 'h3.entry-title {'
				. 'font-family: '.$vars['blog_title-font-family'].';'
				. 'font-size: '.$vars['blog_title-font-size'].';'
				. 'font-style: '.$vars['blog_title-font-style'].';'
				. 'font-weight: '.$vars['blog_title-font-weight'].';'
				. 'text-transform: '.$vars['blog_title-text-transform'].';'
				. 'line-height: '.$vars['blog_title-line-height'].';'
				. 'letter-spacing: '.$vars['blog_title-letter-spacing'].';'
				. 'color: '.$vars['blog_title-color'].';'
			. '}';

/* Featured quote typo */
$output .= 'q, .dfd-textmodule-featured-quote {'
				. 'font-family: '.$vars['blog_featured_quote-font-family'].';'
				. 'font-size: '.$vars['blog_featured_quote-font-size'].';'
				. 'font-style: '.$vars['blog_featured_quote-font-style'].';'
				. 'font-weight: '.$vars['blog_featured_quote-font-weight'].';'
				. 'text-transform: '.$vars['blog_featured_quote-text-transform'].';'
				. 'line-height: '.$vars['blog_featured_quote-line-height'].';'
				. 'letter-spacing: '.$vars['blog_featured_quote-letter-spacing'].';'
				. 'color: '.$vars['blog_featured_quote-color'].';'
			. '}';

/* Featured quote responsive typo */
if((int) $vars['blog_featured_quote-font-size'] > 26) {
	$output .= '@media only screen and (max-width: 400px) {'
					. 'q, .dfd-textmodule-featured-quote {'
						. 'font-size: '. (int) $vars['blog_featured_quote-font-size'] / 1.55 .'px;'
						. 'line-height: 1.5;'
						. 'letter-spacing: 0;'
					. '}'
				. '}';
}

/* Post quote typo */
$output .= '.quote-content {'
				. 'font-family: '.$vars['blog_quote-font-family'].';'
				. 'font-size: '.$vars['blog_quote-font-size'].';'
				. 'font-style: '.$vars['blog_quote-font-style'].';'
				. 'font-weight: '.$vars['blog_quote-font-weight'].';'
				. 'text-transform: '.$vars['blog_quote-text-transform'].';'
				. 'line-height: '.$vars['blog_quote-line-height'].';'
				. 'letter-spacing: '.$vars['blog_quote-letter-spacing'].';'
				. 'color: '.$vars['blog_quote-color'].';'
			. '}';

/* Post author typo */
$output .= '.dfd-content-wrap > article.post .author-section .author a,'
		. ' .dfd-posts-module article.post .author-section .author a {'
				. 'font-family: '.$vars['blog_author-font-family'].';'
				. 'font-size: '.$vars['blog_author-font-size'].';'
				. 'font-style: '.$vars['blog_author-font-style'].';'
				. 'font-weight: '.$vars['blog_author-font-weight'].';'
				. 'text-transform: '.$vars['blog_author-text-transform'].';'
				. 'line-height: '.$vars['blog_author-line-height'].';'
				. 'letter-spacing: '.$vars['blog_author-letter-spacing'].';'
				. 'color: '.$vars['blog_author-color'].';'
			. '}';

/* Post quote author typo */
$output .= '.quote-author {'
				. 'font-family: '.$vars['blog_quote_author-font-family'].';'
				. 'font-size: '.$vars['blog_quote_author-font-size'].';'
				. 'font-style: '.$vars['blog_quote_author-font-style'].';'
				. 'font-weight: '.$vars['blog_quote_author-font-weight'].';'
				. 'text-transform: '.$vars['blog_quote_author-text-transform'].';'
				. 'line-height: '.$vars['blog_quote_author-line-height'].';'
				. 'letter-spacing: '.$vars['blog_quote_author-letter-spacing'].';'
				. 'color: '.$vars['blog_quote_author-color'].';'
			. '}';

/* Gallery post carousel nav */
$output .= '.slider-controls .prev > span.count, .slider-controls .next > span.count {'
				. 'font-family: '.$vars['blog_quote_author-font-family'].';'
				. 'font-size: '.$vars['blog_quote_author-font-size'].';'
				. 'font-style: '.$vars['blog_quote_author-font-style'].';'
				. 'font-weight: '.$vars['blog_quote_author-font-weight'].';'
				. 'text-transform: '.$vars['blog_quote_author-text-transform'].';'
			. '}';


/* Link post typo */
$output .= '.dfd-post-link-url {'
				. 'font-family: '.$vars['blog_link_post_url-font-family'].';'
				. 'font-size: '.$vars['blog_link_post_url-font-size'].';'
				. 'font-style: '.$vars['blog_link_post_url-font-style'].';'
				. 'font-weight: '.$vars['blog_link_post_url-font-weight'].';'
				. 'text-transform: '.$vars['blog_link_post_url-text-transform'].';'
				. 'line-height: '.$vars['blog_link_post_url-line-height'].';'
				. 'letter-spacing: '.$vars['blog_link_post_url-letter-spacing'].';'
				. 'color: '.$vars['blog_link_post_url-color'].';'
			. '}';

/* Main colour */
$output .= '#layout.single-post article.post .entry-content > a:not(.quote-content):not(.dfd-post-link-url):not(.fn):not(.dfd-post-link-title),'
		. '#layout.single-post article.post .entry-content > p > a:not(.quote-content):not(.dfd-post-link-url):not(.fn):not(.dfd-post-link-title),'
		. '#layout.single-post article.post .entry-content > div > a:not(.quote-content):not(.dfd-post-link-url):not(.fn):not(.dfd-post-link-title),'
		. '#layout.single-post .dfd-content-wrap.dfd-post_single > article.post .entry-content > a:not(.quote-content):not(.dfd-post-link-url):not(.fn):not(.dfd-post-link-title),'
		. '#layout.single-post .dfd-content-wrap.dfd-post_single > article.post .entry-content > p > a:not(.quote-content):not(.dfd-post-link-url):not(.fn):not(.dfd-post-link-title),'
		. '#layout.single-post .dfd-content-wrap.dfd-post_single > article.post .entry-content > div > a:not(.quote-content):not(.dfd-post-link-url):not(.fn):not(.dfd-post-link-title) {color: '.$vars['main_site_color'].';}';

/* Main colour background */
$output .= '.dfd-mini-categories .byline.category,'
		. '.audioplayer .audioplayer-bar .audioplayer-bar-loaded,'
		. '.audioplayer .audioplayer-bar .audioplayer-bar-played,'
		. '.dfd-content-wrap article.post .entry-thumb .byline.category,'
		. '.dfd-content-wrap article.post .entry-content > ul li:before,'
		. '.dfd-content-wrap.layout-masonry article.post.format-quote > .cover .entry-content .byline.category,'
		. '.dfd-content-wrap.layout-masonry article.post.format-link > .cover .entry-content .byline.category,'
		. '.dfd-content-wrap.layout-masonry article.post.format-audio > .cover .entry-content .byline.category,'
		. '.dfd-content-wrap.layout-metro article.post.format-quote > .cover .entry-content .byline.category,'
		. '.dfd-content-wrap.layout-metro article.post.format-link > .cover .entry-content .byline.category,'
		. '.dfd-content-wrap.layout-metro article.post.format-audio > .cover .entry-content .byline.category,'
		. '#layout.single-post .dfd-content-wrap.dfd-post_single > article.post .entry-content > p > ul > li:before,'
		. '#layout.single-post .dfd-content-wrap.dfd-post_single > article.post .entry-content > ul > li:before {background: '.$vars['main_site_color'].';}';