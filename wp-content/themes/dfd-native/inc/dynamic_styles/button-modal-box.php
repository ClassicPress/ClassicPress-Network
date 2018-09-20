<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/*Modal Box module (button)*/
/*Typography*/
$output .= '.dfd-btn-open-modal-box .dfd-btn-wrap {'
				. 'font-family: '.$vars['default_button-font-family'].';'
				. 'font-size: '.$vars['default_button-font-size'].';'
				. 'font-style: '.$vars['default_button-font-style'].';'
				. 'font-weight: '.$vars['default_button-font-weight'].';'
				. 'text-transform: '.$vars['default_button-text-transform'].';'
				. 'line-height: '.$vars['default_button-line-height'].';'
				. 'letter-spacing: '.$vars['default_button-letter-spacing'].';'
				. 'color: '.$vars['default_button-color'].';'
			. '}';
/*Paddings*/
$output .= '.dfd-btn-open-modal-box .dfd-btn-wrap {'
				. 'padding-left: '.$vars['default_button_padding_left'].'px;'
				. 'padding-right: '.$vars['default_button_padding_right'].'px;'
			. '}';
/*Background*/
$output .= '.dfd-btn-open-modal-box .dfd-btn-wrap {'
				. 'background: '.$vars['default_button_background'].';'
			. '}';
/*Border*/
$output .= '.dfd-btn-open-modal-box .dfd-btn-wrap .dfd-btn-border {'
				. 'border-width: '.$vars['default_button_border_width'].'px;'
				. 'border-style: '.$vars['default_button_border_style'].';'
				. 'border-radius: '.$vars['default_button_border_radius'].'px;'
				. 'border-color: '.$vars['default_button_border'].';'
			. '}';
/*Text on hover*/
$output .= '.dfd-btn-open-modal-box .dfd-btn-wrap:hover {'
				. 'color: '.$vars['default_button_hover_color'].';'
			. '}';
/*Background on hover*/
$output .= '.dfd-btn-open-modal-box .dfd-btn-wrap:hover {'
				. 'background: '.$vars['default_button_hover_bg'].';'
			. '}';
/*Border on hover*/
$output .= '.dfd-btn-open-modal-box .dfd-btn-wrap:hover .dfd-btn-border {'
				. 'border-color: '.$vars['default_button_hover_border'].';'
			. '}';