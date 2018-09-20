<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$header_css = $mobile_header_css = '';

$header_css .= '.login-header #loginModal p.login-submit button.button,'
			. 'input[type="checkbox"] {background: '.$vars['third_site_color'].';}';

$header_css .= '.mega-menu > ul > li.current-menu-item:before, .mega-menu > ul > li.current-menu-ancestor:before {background: '.$vars['main_site_color'].' !important;}';

$header_css .= '#header-container.header-style-1 #header .header-wrap,'
		. '#header-container.header-style-2 #header .header-wrap,'
		. '#header-container.dfd-header-builder .header .header-wrap,'
		. '#header-container.header-style-3 #header .header-wrap,'
		. '#header-container.header-style-4 #header .header-wrap,'
		. '#header-container.header-style-5 #header .header-wrap,'
		. '#header-container.header-style-6 #header .header-wrap,'
		. '#header-container.header-style-7 #header .header-wrap,'
		. '#header-container.header-style-10 #header .header-wrap,'
		. '#header-container.header-style-11 #header .header-wrap,'
		. '#header-container.header-style-8 #header .dfd-top-row,'
		. '#header-container.header-style-9 #header .dfd-top-row {height: '.$vars['top_menu_height'].'px; line-height: '.$vars['top_menu_height'].'px;}';

$header_css .= '#header-container.header-style-1:not(.small) #header .header-wrap .dfd-logo-wrap img,'
			. '#header-container.header-style-2:not(.small) #header .header-wrap .dfd-logo-wrap img,'
			. '#header-container.header-style-3:not(.small) #header .header-wrap .dfd-logo-wrap img,'
			. '#header-container.header-style-4:not(.small) #header .header-wrap .dfd-logo-wrap img,'
			. '#header-container.header-style-5:not(.small) #header .header-wrap .dfd-logo-wrap img,'
			. '#header-container.header-style-6:not(.small) #header .header-wrap .dfd-logo-wrap img,'
			. '#header-container.header-style-7:not(.small) #header .header-wrap .dfd-logo-wrap img,'
			. '#header-container.header-style-8:not(.small) #header .dfd-top-row .dfd-logo-wrap img,'
			. '#header-container.header-style-9:not(.small) #header .dfd-top-row .dfd-logo-wrap img,'
			. '#header-container.header-style-10:not(.small) #header .header-wrap .dfd-logo-wrap img,'
			. '#header-container.header-style-11:not(.small) #header .header-wrap .dfd-logo-wrap img {max-height: '. $vars['top_menu_height'] .'px;}';

$header_css .= '#header-container.header-style-7 #header .onclick-menu-wrap {max-width: '.$vars['top_menu_height'].'px;}';

$header_css .= '.onclick-menu > ul > li:hover > a > span,'
			. '.onclick-menu > ul > li div.sub-nav ul li > a:hover,'
			. '.onclick-menu > ul > li.menu-item-language ul li:hover a,'
			. '.onclick-menu > ul > li.menu-item-language:hover > a,'
			. '.mega-menu > ul > li div.sub-nav ul li:hover > a,'
			. '.mega-menu > ul > li.menu-item-language ul li:hover a,'
			. '#header-container.header-style-12 .mega-menu > ul > li div.sub-nav > ul.sub-menu-wide > li:hover > a,'
			. '#header-container.header-style-13 .mega-menu > ul > li div.sub-nav > ul.sub-menu-wide > li:hover > a,'
			. '#header-container.header-style-14 .mega-menu > ul > li div.sub-nav > ul.sub-menu-wide > li:hover > a {color: '.$vars['menu_dropdown_hover_color'].'}';

$header_css .= '.onclick-menu > ul, .onclick-menu > ul > li div.sub-nav ul,'
			. '.mega-menu > ul > li div.sub-nav ul,'
			. '.mega-menu > ul > li.menu-item-language ul,'
			. '.onclick-menu > ul > li.menu-item-language ul,'
			. '#header-container.header-style-14 #header .header-wrap > .row > .columns .dfd-header-buttons-cover .dfd-header-buttons-wrap .soc-icons-wrap .widget.soc-icons {background: '.$vars['menu_dropdown_background'].'}';

$header_css .= '.onclick-menu-cover:after {border-bottom: 7px solid '.$vars['menu_dropdown_background'].'}';

if(is_rtl()) {
	$header_css .= '#header-container:not(.header-style-7) #header .header-wrap .mega-menu > ul > li div.sub-nav:after,'
				. '#header-container:not(.header-style-7) #header .header-wrap .mega-menu > ul > li ul.submenu-languages:after,'
				. '#header-container:not(.header-style-7) #header .header-wrap .mega-menu > ul > li div.sub-nav > ul ul:after,'
				. '#header-container.dfd-header-builder .header .mega-menu > ul > li div.sub-nav > ul ul:after,'
				. '#header-container.header-style-14 #header .header-wrap > .row > .columns .dfd-header-buttons-cover .dfd-header-buttons-wrap .soc-icons-wrap .widget.soc-icons:after {border-left: 7px solid '.$vars['menu_dropdown_background'].'}';
}else {
	$header_css .= '#header-container:not(.header-style-7) #header .header-wrap .mega-menu > ul > li div.sub-nav:after,'
				. '#header-container:not(.header-style-7) #header .header-wrap .mega-menu > ul > li ul.submenu-languages:after,'
				. '#header-container:not(.header-style-7) #header .header-wrap .mega-menu > ul > li div.sub-nav > ul ul:after,'
				. '#header-container.dfd-header-builder .header .mega-menu > ul > li div.sub-nav > ul ul:after,'
				. '#header-container.header-style-14 #header .header-wrap > .row > .columns .dfd-header-buttons-cover .dfd-header-buttons-wrap .soc-icons-wrap .widget.soc-icons:after {border-right: 7px solid '.$vars['menu_dropdown_background'].'}';
}

$header_css .= '#header-container:not(.header-style-7) #header .header-wrap .mega-menu > ul > li div.sub-nav > ul ul.sub-nav-left:after {border-left: 7px solid '.$vars['menu_dropdown_background'].';border-right-color: transparent;}';
$header_css .= '#header-container.dfd-header-builder .header .mega-menu > ul > li div.sub-nav > ul ul.sub-nav-left:after {border-left: 7px solid '.$vars['menu_dropdown_background'].';border-right-color: transparent;}';

$header_css .= '.onclick-menu-cover .onclick-menu .onclick-nav-menu > li > div.sub-nav ul:after,'
			. '.onclick-menu-cover .onclick-menu .onclick-nav-menu > li.menu-item-language > ul:after,'
			. '#header-container.header-style-12.right #header .header-wrap .mega-menu > ul > li div.sub-nav:after,'
			. '#header-container.header-style-13.right #header .header-wrap .mega-menu > ul > li div.sub-nav:after,'
			. '#header-container.header-style-12.right #header .header-wrap .mega-menu > ul > li div.sub-nav > ul ul:after,'
			. '#header-container.header-style-12.right #header .header-wrap .mega-menu > ul > li ul.submenu-languages:after,'
			. '#header-container.header-style-13.right #header .header-wrap .mega-menu > ul > li div.sub-nav > ul ul:after, '
			. '#header-container.header-style-13.right #header .header-wrap .mega-menu > ul > li ul.submenu-languages:after, '
			. '#header-container.header-style-14.right #header .header-wrap .mega-menu > ul > li div.sub-nav:after,'
			. '#header-container.header-style-14.right #header .header-wrap .mega-menu > ul > li ul.submenu-languages:after,'
			. '#header-container.header-style-14.right #header .header-wrap .mega-menu > ul > li div.sub-nav > ul ul:after,'
			. '#header-container.header-style-14.right #header .header-wrap > .row > .columns .dfd-header-buttons-cover .dfd-header-buttons-wrap .soc-icons-wrap .widget.soc-icons:after {border-left: 7px solid '.$vars['menu_dropdown_background'].'}';

/*header 1 - 6 colours*/
for($i = 1; $i < 7; $i++) {
	$header_css .= '#header-container:not(.small).header-style-'.$i.' #header .top-inner-page > span > span {background: '.$vars['header_text_color_'.$i].';}';
	$header_css .= '#header-container:not(.small).header-style-'.$i.' #header .dfd-click-menu-activation-button a .icon-wrap {background: '.$vars['header_text_color_'.$i].';}';
	$header_css .= '#header-container.header-style-'.$i.' #header .header-top-panel {background: '.$vars['header_top_panel_background_color_'.$i].';color: '.$vars['header_top_panel_color_'.$i].';}';
	$header_css .= '#header-container.header-style-'.$i.' #header .dfd-header-banner-wrap,'
				. '#header-container:not(.small).header-style-'.$i.' #header .logo-wrap.header-top-logo-panel,'
				. '#header-container.header-style-'.$i.':not(.small) #header .header-wrap {background: '.$vars['header_background_color_'.$i].';}';
	$header_css .= '#header-container:not(.small).header-style-'.$i.' #header .logo-wrap.header-top-logo-panel,'
				. '#header-container.header-style-'.$i.':not(.small) #header .header-wrap > .row > .columns {color: '.$vars['header_text_color_'.$i].';}';
	$header_css .= '#header-container.header-style-'.$i.' #header .header-top-panel,'
				. '#header-container.header-style-'.$i.' #header .dfd-header-banner-wrap,'
				. '#header-container.header-style-'.$i.' #header .login-header .dfd-header-links, '
				. '#header-container:not(.small).header-style-'.$i.' #header .logo-wrap.header-top-logo-panel,'
				. '#header-container:not(.small).header-style-'.$i.' #header .header-wrap .dfd-header-buttons-wrap > *,'
				. '#header-container:not(.small).header-style-'.$i.' #header {border-color: '.$vars['header_border_color_'.$i].';}';
}

/*header 7 colours*/
$header_css .= '#header-container.header-style-7 #header .dfd-header-banner-wrap, #header-container.header-style-7 #header .header-wrap {background: '.$vars['header_background_color_7'].';}';

$header_css .= '#header-container.header-style-7 #header .header-wrap .dfd-click-menu-activation-button a:before {color: '.$vars['header_text_color_7'].';}';

$header_css .= '#header-container.header-style-7 #header .header-wrap .dfd-click-menu-activation-button a .icon-wrap {background: '.$vars['header_text_color_7'].';}';

$header_css .= '#header-container.header-style-7 #header .dfd-header-banner-wrap, #header-container.header-style-7 #header {border-bottom-color: '.  $vars['header_border_color_7'].';}';

$header_css .= '#header-container.header-style-7 #header .onclick-menu-wrap {border-left-color: '.  $vars['header_border_color_7'].';}';

/*header 8 colours*/
$header_css .= '#header-container.header-style-8 #header .dfd-top-row {background: '.$vars['header_background_color_8'].';}';

$header_css .= '#header-container.header-style-8 #header .dfd-click-menu-activation-button a .icon-wrap {background: '.$vars['header_text_color_8'].';}';

$header_css .= '#header-container.header-style-8 #header.active .dfd-click-menu-activation-button a .icon-wrap {background: '.$vars['header_active_text_color_8'].';}';

$header_css .= '#header-container.header-style-8:not(.small) #header {border-bottom-color: '.  $vars['header_border_color_8'].';}';

$header_css .= '#header-container.header-style-8 #header .dfd-top-row .dfd-click-menu-button-wrap {border-left-color: '.  $vars['header_border_color_8'].';}';

$header_css .= '#header-container.header-style-8.small #header #dfd-header-loader svg path,'
			. '#header-container.header-style-8:not(.small) #header #dfd-header-loader svg path {fill: '.$vars['header_active_background_color_8'].';}';

$header_css .= '#header-container.header-style-8.small #header.active .dfd-top-row .dfd-click-menu-button-wrap .dfd-click-menu-activation-button .dfd-menu-button:before,'
			. '#header-container.header-style-8:not(.small) #header.active .dfd-top-row .dfd-click-menu-button-wrap .dfd-click-menu-activation-button .dfd-menu-button:before,'
			. '#header-container.header-style-8.small #header .header-wrap > .row > .columns,'
			. '#header-container.header-style-8:not(.small) #header .header-wrap > .row > .columns,'
			. '#header-container.header-style-8 .dfd-click-menu-button-wrap .dfd-click-menu-activation-button .dfd-menu-button:before {color: '.$vars['header_active_text_color_8'].';}';

$header_css .= '#header-container.header-style-8 #header .header-wrap .dfd-copyright:before {background: '.$vars['header_active_text_color_8'].';}';

/*header 9 colours*/
$header_css .= '#header-container.header-style-9 #header .dfd-top-row {background: '.$vars['header_background_color_9'].';}';

$header_css .= '#header-container.header-style-9 #header .dfd-click-menu-activation-button a .icon-wrap {background: '.$vars['header_text_color_9'].';}';

$header_css .= '#header-container.header-style-9 #header.active .dfd-click-menu-activation-button a .icon-wrap {background: '.$vars['header_active_text_color_9'].';}';

$header_css .= '#header-container.header-style-9:not(.small) #header {border-bottom-color: '.  $vars['header_border_color_9'].';}';

$header_css .= '#header-container:not(.small).header-style-9 #header .dfd-click-menu-button-wrap {border-color: '.  $vars['header_border_color_9'].';}';

$header_css .= '#header-container.header-style-9.small #header #dfd-header-loader svg path,'
			. '#header-container.header-style-9:not(.small) #header #dfd-header-loader svg path {fill: '.$vars['header_active_background_color_9'].';}';

$header_css .= '#header-container.header-style-9.small #header.active .dfd-top-row .dfd-click-menu-button-wrap .dfd-click-menu-activation-button .dfd-menu-button:before,'
			. '#header-container.header-style-9:not(.small) #header.active .dfd-top-row .dfd-click-menu-button-wrap .dfd-click-menu-activation-button .dfd-menu-button:before,'
			. '#header-container.header-style-9.small #header .header-wrap, #header-container.header-style-9:not(.small) #header .header-wrap > .row > .columns,'
			. '#header-container.header-style-9.small #header .header-wrap > .row > .columns, #header-container.header-style-9:not(.small) #header .header-wrap,'
			. '#header-container.header-style-9 .dfd-click-menu-button-wrap .dfd-click-menu-activation-button .dfd-menu-button:before {color: '.$vars['header_active_text_color_9'].';}';

$header_css .= '#header-container.header-style-9 #header .header-wrap .dfd-copyright:before {background: '.$vars['header_active_text_color_9'].';}';

/*header 10 colours*/
$header_css .= '#header-container.header-style-10 #header .dfd-header-banner-wrap,'
			. '#header-container.header-style-10 #header .header-wrap {background: '.$vars['header_background_color_10'].';}';

$header_css .= '#header-container.header-style-10 #header .header-wrap > .row > .columns,'
			. '#header-container.header-style-10 #header .header-wrap .dfd-click-menu-activation-button a:before {color: '.$vars['header_text_color_10'].';}';

$header_css .= '#header-container.header-style-10:not(.small) #header .header-wrap .dfd-click-menu-activation-button a .icon-wrap {background: '.$vars['header_text_color_10'].';}';

$header_css .= '#header-container.header-style-10 #header .dfd-header-banner-wrap, #header-container.header-style-10:not(.small) #header {border-bottom-color: '.  $vars['header_border_color_10'].';}';

$header_css .= '#header-container.header-style-10 #header .dfd-click-menu-button-wrap {border-left-color: '.  $vars['header_border_color_10'].';}';

/*header 11 colours*/
$header_css .= '#header-container.header-style-11 #header .dfd-header-banner-wrap,'
			. '#header-container.header-style-11 #header .header-wrap {background: '.$vars['header_background_color_11'].';}';

$header_css .= '#header-container.header-style-11 #header .header-wrap > .row > .columns,'
			. '#header-container.header-style-11 #header .header-wrap .dfd-click-menu-activation-button a:before {color: '.$vars['header_text_color_11'].';}';

$header_css .= '#header-container.header-style-11:not(.small) #header .header-wrap .dfd-click-menu-activation-button a .icon-wrap {background: '.$vars['header_text_color_11'].';}';

$header_css .= '#header-container.header-style-11 #header .dfd-header-banner-wrap, #header-container.header-style-11:not(.small) #header {border-bottom-color: '.  $vars['header_border_color_11'].';}';

$header_css .= '#header-container.header-style-11 #header .dfd-click-menu-button-wrap {border-left-color: '.  $vars['header_border_color_11'].';}';

/*header 12 colours*/
$header_css .= '#header-container.header-style-12 #header .header-wrap {background-color: '.$vars['header_background_color_12'].';}';

$header_css .= '#header-container.header-style-12 #header .header-wrap > .row > .columns {color: '.$vars['header_text_color_12'].';}';

$header_css .= '#header-container.header-style-12 #header .header-wrap .dfd-copyright:before {background: '.$vars['header_text_color_12'].';}';

if(isset($vars['bg_image_header_12']['url']) && !empty($vars['bg_image_header_12']['url'])) {
	$header_css .= '#header-container.header-style-12 #header .header-wrap {background-image: url('.esc_url($vars['bg_image_header_12']['url']).');}';
}

/*header 13 colours*/
$header_css .= '#header-container.header-style-13 #header .header-wrap {background-color: '.$vars['header_background_color_13'].';}';

$header_css .= '#header-container.header-style-13 #header .header-wrap > .row > .columns {color: '.$vars['header_text_color_13'].';}';

$header_css .= '#header-container.header-style-13 .dfd-side-slide-header-button-wrap {background: '.$vars['header_navbutton_background_color_13'].';}';

$header_css .= '#header-container.header-style-13 .dfd-side-slide-header-button-wrap .dfd-side-slide-header-button .icon-wrap {background: '.$vars['header_navbutton_text_color_13'].';}';

$header_css .= '#header-container.header-style-13 #header .header-wrap .dfd-copyright:before {background: '.$vars['header_text_color_13'].';}';

if(isset($vars['bg_image_header_13']['url']) && !empty($vars['bg_image_header_13']['url'])) {
	$header_css .= '#header-container.header-style-13 #header .header-wrap {background-image: url('.esc_url($vars['bg_image_header_13']['url']).');}';
}

/*header 14 colours*/
$header_css .= '#header-container.header-style-14 #header {background: '.$vars['header_background_color_14'].';}';

$header_css .= '#header-container.header-style-14 #header .header-wrap > .row > .columns {color: '.$vars['header_text_color_14'].';}';

$header_css .= '#header-container.header-style-14 #header .header-wrap > .row > .columns .dfd-copyright:before {background: '.$vars['header_text_color_14'].';}';

$header_css .= '#header-container.header-style-14 #header .header-wrap > .row > .columns .dfd-logo-wrap,'
			. '#header-container.header-style-14 #header .header-wrap > .row > .columns .dfd-header-buttons-cover .dfd-header-buttons-wrap > *:first-child {border-color: '. Dfd_Theme_Helpers::dfd_hex2rgb($vars['header_text_color_14'], .1) .';}';

$output .= '@media only screen and (min-width: 1101px) {'.$header_css.';}';

unset($header_css);

/*Sticky header*/
$output .= '#header-container.small #header .dfd-top-row, #header-container.small .header .dfd-top-row,'
		. '#header-container.small #header .header-wrap,#header-container.small .header .header-wrap {'
			. 'background: '.$vars['fixed_header_background_color'].';'
		. '}';

$output .= '#header-container.small #header .dfd-top-row > .row > .columns, #header-container.small .header .dfd-top-row > .row > .columns,'
		. '#header-container.small #header .header-wrap > .row > .columns,#header-container.small .header .header-wrap > .row > .columns,'
		. '#header-container.small.header-style-10 #header.active .dfd-click-menu-button-wrap .dfd-menu-button:before,'
		. '#header-container.small.header-style-11 #header.active .dfd-click-menu-button-wrap .dfd-menu-button:before,'
		. '#header-container.small.header-style-7 #header .onclick-menu-wrap .dfd-click-menu-button-wrap .dfd-menu-button:before {'
			. 'color: '.$vars['fixed_header_text_color'].';'
		. '}';

$output .= '#header-container.small #header .header-wrap .dfd-click-menu-activation-button a .icon-wrap, #header-container.small .header .header-wrap .dfd-click-menu-activation-button a .icon-wrap,'
		. '#header-container.small #header .header-wrap .dl-menuwrapper a .icon-wrap,#header-container.small .header .header-wrap .dl-menuwrapper a .icon-wrap,'
		. '#header-container.header-style-8.small #header .dfd-top-row .dfd-click-menu-button-wrap .dfd-click-menu-activation-button .dfd-menu-button .icon-wrap,'
		. '#header-container.header-style-9.small #header .dfd-top-row .dfd-click-menu-button-wrap .dfd-click-menu-activation-button .dfd-menu-button .icon-wrap,'
		. '#header-container.header-style-12.small #header .dfd-top-row .dfd-click-menu-button-wrap .dfd-click-menu-activation-button .dfd-menu-button .icon-wrap,'
		. '#header-container.header-style-13.small #header .dfd-top-row .dfd-click-menu-button-wrap .dfd-click-menu-activation-button .dfd-menu-button .icon-wrap {'
			. 'background: '.$vars['fixed_header_text_color'].';'
		. '}';

$output .= '#header-container.small .top-inner-page > span > span {background: '.$vars['fixed_header_text_color'].';}';

$output .= '#header-container.small #header .header-wrap .dfd-header-buttons-wrap > *, #header-container.small .header .header-wrap .dfd-header-buttons-wrap > *'
		. '#header-container.small.logo-position-right #header .header-wrap .dfd-header-buttons-wrap > *:first-child, #header-container.small.logo-position-right .header .header-wrap .dfd-header-buttons-wrap > *:first-child'
		. '#header-container.small #header .header-wrap .dfd-click-menu-button-wrap,#header-container.small .header .header-wrap .dfd-click-menu-button-wrap {'
			. 'border-color: '.$vars['fixed_header_border_color'].';'
		. '}';

/*Mobile header*/
$output .= '.sidr {'
			. 'background: '.$vars['mobile_menu_bg'].';'
			. 'color: '.$vars['mobile_menu_title-color'].';'
		. '}';

$output .= '.sidr .sidr-inner > .dfd-sidr-close {'
			. 'color: '.$vars['mobile_menu_title-color'].';'
		. '}';

$output .= '.sidr .sidr-inner > ul > li > a:before,'
		. '.sidr .sidr-inner > ul > li ul a:before {'
			. 'border-color: '.$vars['mobile_menu_delim'].';'
		. '}';

$output .= '.sidr .sidr-inner > ul > li > ul > li ul {background: '.$vars['mobile_submenu_bg'].';}';

$mobile_header_css .= '#header-container .header-top-panel,'
					. '#header-container:not(.small) .header-wrap {'
						. 'background: '.$vars['mobile_header_bg'].';'
						. 'color: '.$vars['mobile_header_color'].';'
					. '}';

$mobile_header_css .= '#header-container:not(.small) .dl-menuwrapper a .icon-wrap,'
					. '#header-container:not(.small) .dfd-click-menu-activation-button a .icon-wrap {'
						. 'background: '.$vars['mobile_header_color'].';'
					. '}';

$mobile_header_css .= '#header-container:not(.small),'
					. '#header-container .header-top-panel,'
					. '#header-container .header-top-panel .dfd-header-top-info,'
					. '.login-header .dfd-header-links,'
					. '#header-container:not(.small) .header-wrap > .row > .columns .dfd-header-buttons-wrap > * {'
						. 'border-color: '.$vars['mobile_header_border_color'].';'
					. '}';

$output .= '@media only screen and (max-width: 1100px) {'.$mobile_header_css.';}';

unset($mobile_header_css);

/*Header top panel*/
$output .= '.dfd-header-links {'
				. 'font-family: '.$vars['header_links-font-family'].';'
				. 'font-size: '.esc_attr($vars['header_links-font-size']).';'
				. 'font-style: '.esc_attr($vars['header_links-font-style']).';'
				. 'font-weight: '.esc_attr($vars['header_links-font-weight']).';'
				. 'text-transform: '.esc_attr($vars['header_links-text-transform']).';'
				. 'line-height: '.esc_attr($vars['header_links-line-height']).';'
				. 'letter-spacing: '.esc_attr($vars['header_links-letter-spacing']).';'
				. 'color: '.esc_attr($vars['header_links-color']).';'
			. '}';

$output .= '.dfd-header-top-info {'
				. 'font-family: '.$vars['top_info-font-family'].';'
				. 'font-size: '.$vars['top_info-font-size'].';'
				. 'font-style: '.$vars['top_info-font-style'].';'
				. 'font-weight: '.$vars['top_info-font-weight'].';'
				. 'text-transform: '.$vars['top_info-text-transform'].';'
				. 'line-height: '.$vars['top_info-line-height'].';'
				. 'letter-spacing: '.$vars['top_info-letter-spacing'].';'
				. 'color: '.$vars['top_info-color'].';'
			. '}';

/*menu*/
$output .= '#header-container.header-style-8.small #header .header-wrap > .row > .columns .mega-menu > ul > li > .main-menu-link.item-title,'
		. '#header-container.header-style-8.small #header .header-wrap > .row > .columns .mega-menu > ul > li.menu-item-language > a,'
		. '#header-container.header-style-8:not(.small) #header .header-wrap > .row > .columns .mega-menu > ul > li > .main-menu-link.item-title,'
		. '#header-container.header-style-8:not(.small) #header .header-wrap > .row > .columns .mega-menu > ul > li.menu-item-language > a,'
		. '#header-container.header-style-9.small #header .header-wrap > .row > .columns .mega-menu > ul > li > .main-menu-link.item-title,'
		. '#header-container.header-style-9.small #header .header-wrap > .row > .columns .mega-menu > ul > li.menu-item-language > a,'
		. '#header-container.header-style-9:not(.small) #header .header-wrap > .row > .columns .mega-menu > ul > li > .main-menu-link.item-title,'
		. '#header-container.header-style-9:not(.small) #header .header-wrap > .row > .columns .mega-menu > ul > li.menu-item-language > a {'
				. 'font-family: '.$vars['menu_title_big-font-family'].';'
				. 'font-size: '.$vars['menu_title_big-font-size'].';'
				. 'font-style: '.$vars['menu_title_big-font-style'].';'
				. 'font-weight: '.$vars['menu_title_big-font-weight'].';'
				. 'text-transform: '.$vars['menu_title_big-text-transform'].';'
				. 'line-height: '.$vars['menu_title_big-line-height'].';'
				. 'letter-spacing: '.$vars['menu_title_big-letter-spacing'].';'
			. '}';

$output .= '.mega-menu .nav-item .main-menu-link.item-title,'
		. '.mega-menu .nav-item.menu-item-language > a {'
				. 'font-family: '.$vars['menu_title-font-family'].';'
				. 'font-size: '.$vars['menu_title-font-size'].';'
				. 'font-style: '.$vars['menu_title-font-style'].';'
				. 'font-weight: '.$vars['menu_title-font-weight'].';'
				. 'text-transform: '.$vars['menu_title-text-transform'].';'
				. 'line-height: '.$vars['menu_title-line-height'].';'
				. 'letter-spacing: '.$vars['menu_title-letter-spacing'].';'
				. 'color: '.$vars['menu_title-color'].';'
			. '}';

$output .= '.onclick-menu > ul > li > a, .onclick-menu > ul > li div.sub-nav ul li > a,'
			. '.mega-menu > ul > li div.sub-nav ul li > a,'
			. '.onclick-menu > ul > li.menu-item-language ul li a,'
			. '.mega-menu > ul > li.menu-item-language ul li a,'
			. '#header-container.header-style-12 .mega-menu > ul > li div.sub-nav > ul.sub-menu-wide > li > a,'
			. '#header-container.header-style-13 .mega-menu > ul > li div.sub-nav > ul.sub-menu-wide > li > a, '
			. '#header-container.header-style-14 .mega-menu > ul > li div.sub-nav > ul.sub-menu-wide > li > a {'
				. 'font-family: '.$vars['menu_subitem-font-family'].';'
				. 'font-size: '.$vars['menu_subitem-font-size'].';'
				. 'font-style: '.$vars['menu_subitem-font-style'].';'
				. 'font-weight: '.$vars['menu_subitem-font-weight'].';'
				. 'text-transform: '.$vars['menu_subitem-text-transform'].';'
				. 'line-height: '.$vars['menu_subitem-line-height'].';'
				. 'letter-spacing: '.$vars['menu_subitem-letter-spacing'].';'
				. 'color: '.$vars['menu_subitem-color'].';'
			. '}';

$output .= '.mega-menu > ul li.mega-menu-item-has-subtitle > a > span {'
				. 'font-family: '.$vars['menu_subitem_subtitle-font-family'].';'
				. 'font-size: '.$vars['menu_subitem_subtitle-font-size'].';'
				. 'font-style: '.$vars['menu_subitem_subtitle-font-style'].';'
				. 'font-weight: '.$vars['menu_subitem_subtitle-font-weight'].';'
				. 'text-transform: '.$vars['menu_subitem_subtitle-text-transform'].';'
				. 'line-height: '.$vars['menu_subitem_subtitle-line-height'].';'
				. 'letter-spacing: '.$vars['menu_subitem_subtitle-letter-spacing'].';'
				. 'color: '.$vars['menu_subitem_subtitle-color'].';'
			. '}';

$output .= '.onclick-menu-cover .onclick-menu .onclick-nav-menu li .mega-menu-item-has-subtitle > a > .menu-subtitle {'
				. 'font-family: '.$vars['menu_subitem_subtitle-font-family'].';'
				. 'font-size: '.$vars['menu_subitem_subtitle-font-size'].';'
				. 'font-style: '.$vars['menu_subitem_subtitle-font-style'].';'
				. 'font-weight: '.$vars['menu_subitem_subtitle-font-weight'].';'
				. 'text-transform: '.$vars['menu_subitem_subtitle-text-transform'].';'
				. 'line-height: '.$vars['menu_subitem_subtitle-line-height'].';'
				. 'letter-spacing: '.$vars['menu_subitem_subtitle-letter-spacing'].';'
				. 'color: '.$vars['menu_subitem_subtitle-color'].';'
			. '}';
$output .= '.mega-menu > ul > li div.sub-nav > ul.sub-menu-wide > li > a {'
				. 'font-family: '.$vars['menu_subitem_title-font-family'].';'
				. 'font-size: '.$vars['menu_subitem_title-font-size'].';'
				. 'font-style: '.$vars['menu_subitem_title-font-style'].';'
				. 'font-weight: '.$vars['menu_subitem_title-font-weight'].';'
				. 'text-transform: '.$vars['menu_subitem_title-text-transform'].';'
				. 'line-height: '.$vars['menu_subitem_title-line-height'].';'
				. 'letter-spacing: '.$vars['menu_subitem_title-letter-spacing'].';'
				. 'color: '.$vars['menu_subitem_title-color'].';'
			. '}';

/*Mobile menu*/
$output .= '.sidr .sidr-inner > ul > li > a {'
				. 'font-family: '.$vars['mobile_menu_title-font-family'].';'
				. 'font-size: '.$vars['mobile_menu_title-font-size'].';'
				. 'font-style: '.$vars['mobile_menu_title-font-style'].';'
				. 'font-weight: '.$vars['mobile_menu_title-font-weight'].';'
				. 'text-transform: '.$vars['mobile_menu_title-text-transform'].';'
				. 'line-height: '.$vars['mobile_menu_title-line-height'].';'
				. 'letter-spacing: '.$vars['mobile_menu_title-letter-spacing'].';'
				. 'color: '.$vars['mobile_menu_title-color'].';'
			. '}';

$output .= '.sidr .sidr-inner > ul > li ul a {'
				. 'font-family: '.$vars['mobile_menu_subitem-font-family'].';'
				. 'font-size: '.$vars['mobile_menu_subitem-font-size'].';'
				. 'font-style: '.$vars['mobile_menu_subitem-font-style'].';'
				. 'font-weight: '.$vars['mobile_menu_subitem-font-weight'].';'
				. 'text-transform: '.$vars['mobile_menu_subitem-text-transform'].';'
				. 'line-height: '.$vars['mobile_menu_subitem-line-height'].';'
				. 'letter-spacing: '.$vars['mobile_menu_subitem-letter-spacing'].';'
				. 'color: '.$vars['mobile_menu_subitem-color'].';'
			. '}';

$output .= '.sidr .sidr-inner > ul li a > span.menu-subtitle {'
				. 'font-family: '.$vars['mobile_menu_subitem_subtitles-font-family'].';'
				. 'font-size: '.$vars['mobile_menu_subitem_subtitles-font-size'].';'
				. 'font-style: '.$vars['mobile_menu_subitem_subtitles-font-style'].';'
				. 'font-weight: '.$vars['mobile_menu_subitem_subtitles-font-weight'].';'
				. 'text-transform: '.$vars['mobile_menu_subitem_subtitles-text-transform'].';'
				. 'line-height: '.$vars['mobile_menu_subitem_subtitles-line-height'].';'
				. 'letter-spacing: '.$vars['mobile_menu_subitem_subtitles-letter-spacing'].';'
				. 'color: '.$vars['mobile_menu_subitem_subtitles-color'].';'
			. '}';

$output .= '.sidr .sidr-inner > ul li a > i.sidr-dropdown-toggler:before {'
				. 'border-top-color: '.$vars['mobile_menu_subitem-color'].';'
			. '}';

$output .= '.sidr .sidr-inner > ul > li > a > i.sidr-dropdown-toggler:before {'
				. 'border-top-color: '.$vars['mobile_menu_title-color'].';'
			. '}';

/*Top inner page*/
$output .= '#top-panel-inner .top-panel-inner-wrapper, body.top-inner-page-initializing:before {background: '.$vars['top_panel_inner_background'].';}';

$output .= '#top-panel-inner #dfd-top-panel-loader svg path {fill: '.$vars['top_panel_inner_background'].';}';

$output .= '#top-panel-inner .top-inner-page-close {color: '.$vars['top_panel_el_color'].';}';

/*Header dropdowns buttons hover*/
$output .= '.login-header #loginModal p.login-submit button.button:hover {background: '.$vars['third_color_darken_5'].';}';

$output .= '.login-header #loginModal div.title-registration > a:hover,'
		. '.login-header #dfd-lost-password p.submit .button:hover,'
		. '.login-header #dfd-register p.submit .button:hover {background: '.$vars['main_color_darken_5'].';}';