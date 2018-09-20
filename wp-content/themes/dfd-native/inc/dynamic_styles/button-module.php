<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/*Button module*/
/*Typography*/
$output .= '.dfd-button-module-wrap .dfd-button-link {'
				. 'font-family: '.$vars['default_button-font-family'].';'
				. 'font-size: '.$vars['default_button-font-size'].';'
				. 'font-style: '.$vars['default_button-font-style'].';'
				. 'font-weight: '.$vars['default_button-font-weight'].';'
				. 'text-transform: '.$vars['default_button-text-transform'].';'
				. 'line-height: '.$vars['default_button-line-height'].';'
				. 'letter-spacing: '.$vars['default_button-letter-spacing'].';'
				. 'color: '.$vars['default_button-color'].';'
			. '}';
$output .= '.dfd-button-module-wrap .dfd-button-link.dfd-3d-rotate .dfd-button-inner-cover.front .dfd-button-text-main,'
		. '.dfd-button-module-wrap .featured-icon {'
				. 'color: '.$vars['default_button-color'].';'
			. '}';
/*Paddings*/
$output .= '.dfd-button-module-wrap .dfd-button-link .dfd-button-inner-cover {'
				. 'padding-left: '.$vars['default_button_padding_left'].'px;'
				. 'padding-right: '.$vars['default_button_padding_right'].'px;'
			. '}';
$output .= '.dfd-button-module-wrap .dfd-button-link:hover,'
		. '.dfd-button-module-wrap .dfd-button-link:hover .dfd-button-inner-cover,'
		. '.dfd-button-module-wrap .dfd-button-link:not(:hover),'
		. '.dfd-button-module-wrap .dfd-button-link:not(:hover) .dfd-button-inner-cover {'
				. 'border-radius: '.$vars['default_button_border_radius'].'px;'
			. '}';
/*Background*/
$output .= '.dfd-button-module-wrap .dfd-button-link .dfd-button-inner-cover:before,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-fade:not(:hover) .dfd-button-inner-cover,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-out-horizontal .dfd-button-inner-cover .dfd-button-hover-out:before,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-out-horizontal .dfd-button-inner-cover .dfd-button-hover-out:after,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-out-vertical .dfd-button-inner-cover .dfd-button-hover-out:before,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-out-vertical .dfd-button-inner-cover .dfd-button-hover-out:after,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-out-diagonal .dfd-button-inner-cover .dfd-button-hover-out:before,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-out-diagonal .dfd-button-inner-cover .dfd-button-hover-out:after,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-in-horizontal .dfd-button-inner-cover .dfd-button-hover-out:before,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-in-horizontal .dfd-button-inner-cover .dfd-button-hover-out:after,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-in-vertical .dfd-button-inner-cover .dfd-button-hover-out:before,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-in-vertical .dfd-button-inner-cover .dfd-button-hover-out:after,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-in-diagonal .dfd-button-inner-cover .dfd-button-hover-out:before,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-in-diagonal .dfd-button-inner-cover .dfd-button-hover-out:after {'
				. 'background: '.$vars['default_button_background'].';'
			. '}';
/*Border*/
$output .= '.dfd-button-module-wrap .dfd-button-link:hover .dfd-button-inner-cover .dfd-button-border,'
		. '.dfd-button-module-wrap .dfd-button-link:not(:hover) .dfd-button-inner-cover .dfd-button-border {'
				. 'border-width: '.$vars['default_button_border_width'].'px;'
				. 'border-style: '.$vars['default_button_border_style'].';'
				. 'border-radius: '.$vars['default_button_border_radius'].'px;'
			. '}';
$output .= '.dfd-button-module-wrap .dfd-button-link:not(:hover) .dfd-button-inner-cover .dfd-button-border {'
				. 'border-color: '.$vars['default_button_border'].';'
			. '}';
/*Text on hover*/
$output .= '.dfd-button-module-wrap .dfd-button-link:hover,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-3d-rotate .dfd-button-inner-cover.back .dfd-button-text-main,'
		. '.dfd-button-module-wrap .dfd-button-link:hover .featured-icon {'
				. 'color: '.$vars['default_button_hover_color'].';'
			. '}';
/*Background on hover*/
$output .= '.dfd-button-module-wrap .dfd-button-link .dfd-button-inner-cover:after,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-fade:hover .dfd-button-inner-cover,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-out-horizontal .dfd-button-inner-cover .dfd-button-hover-in:before,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-out-horizontal .dfd-button-inner-cover .dfd-button-hover-in:after,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-out-vertical .dfd-button-inner-cover .dfd-button-hover-in:before,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-out-vertical .dfd-button-inner-cover .dfd-button-hover-in:after,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-out-diagonal .dfd-button-inner-cover .dfd-button-hover-in:before,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-out-diagonal .dfd-button-inner-cover .dfd-button-hover-in:after,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-in-horizontal .dfd-button-inner-cover .dfd-button-hover-in:before,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-in-horizontal .dfd-button-inner-cover .dfd-button-hover-in:after,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-in-vertical .dfd-button-inner-cover .dfd-button-hover-in:before,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-in-vertical .dfd-button-inner-cover .dfd-button-hover-in:after,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-in-diagonal .dfd-button-inner-cover .dfd-button-hover-in:before,'
		. '.dfd-button-module-wrap .dfd-button-link.dfd-scale-in-diagonal .dfd-button-inner-cover .dfd-button-hover-in:after {'
				. 'background: '.$vars['default_button_hover_bg'].';'
			. '}';
/*Border on hover*/
$output .= '.dfd-button-module-wrap .dfd-button-link:hover .dfd-button-border {'
				. 'border-color: '.$vars['default_button_hover_border'].';'
			. '}';