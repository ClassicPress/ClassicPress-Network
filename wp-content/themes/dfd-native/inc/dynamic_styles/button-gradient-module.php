<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/*Button Gradient module*/
/*Typography*/
$output .= '.dfd-button-gradient-module-wrap .dfd-button-link {'
				. 'font-family: '.$vars['default_button-font-family'].';'
				. 'font-size: '.$vars['default_button-font-size'].';'
				. 'font-style: '.$vars['default_button-font-style'].';'
				. 'font-weight: '.$vars['default_button-font-weight'].';'
				. 'text-transform: '.$vars['default_button-text-transform'].';'
				. 'line-height: '.$vars['default_button-line-height'].';'
				. 'letter-spacing: '.$vars['default_button-letter-spacing'].';'
				. 'color: '.$vars['default_button-color'].';'
			. '}';
$output .= '.dfd-button-gradient-module-wrap .dfd-button-link.dfd-3d-rotate .dfd-button-inner-cover.front .dfd-button-text-main,'
		. '.dfd-button-gradient-module-wrap .featured-icon {'
				. 'color: '.$vars['default_button-color'].';'
			. '}';
/*Paddings*/
$output .= '.dfd-button-gradient-module-wrap .dfd-button-link .dfd-button-inner-cover {'
				. 'padding-left: '.$vars['default_button_padding_left'].'px;'
				. 'padding-right: '.$vars['default_button_padding_right'].'px;'
			. '}';
$output .= '.dfd-button-gradient-module-wrap .dfd-button-link:hover,'
		. '.dfd-button-gradient-module-wrap .dfd-button-link:hover .dfd-button-inner-cover,'
		. '.dfd-button-gradient-module-wrap .dfd-button-link:not(:hover),'
		. '.dfd-button-gradient-module-wrap .dfd-button-link:not(:hover) .dfd-button-inner-cover {'
				. 'border-radius: '.$vars['default_button_border_radius'].'px;'
			. '}';
/*Background*/
$output .= '.dfd-button-gradient-module-wrap .dfd-button-link .dfd-button-inner-cover:before,'
		. '.dfd-button-gradient-module-wrap .dfd-button-link.dfd-fade:not(:hover) .dfd-button-inner-cover {'
				. 'background: '.$vars['default_button_background'].';'
			. '}';
/*Text on hover*/
$output .= '.dfd-button-gradient-module-wrap .dfd-button-link:hover,'
		. '.dfd-button-gradient-module-wrap .dfd-button-link.dfd-3d-rotate .dfd-button-inner-cover.back .dfd-button-text-main,'
		. '.dfd-button-gradient-module-wrap .dfd-button-link:hover .featured-icon {'
				. 'color: '.$vars['default_button_hover_color'].';'
			. '}';
/*Background on hover*/
$output .= '.dfd-button-gradient-module-wrap .dfd-button-link .dfd-button-inner-cover:after,'
		. '.dfd-button-gradient-module-wrap .dfd-button-link.dfd-fade:hover .dfd-button-inner-cover {'
				. 'background: '.$vars['default_button_hover_bg'].';'
			. '}';