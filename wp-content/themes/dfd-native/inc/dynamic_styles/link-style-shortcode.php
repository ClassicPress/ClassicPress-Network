<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output .=	'.dfd-link-style-wrap.style-2 .dfd-link-element .front,'
			. '.dfd-link-style-wrap.style-2 .dfd-link-element:hover .back,'
			. '.dfd-link-style-wrap.style-7 .dfd-link-element span {background: '.$vars['main_site_color'].';}';

$output .=	'.dfd-link-style-wrap.style-2 .dfd-link-element .back,'
			. '.dfd-link-style-wrap.style-7 .dfd-link-element .back {background: '.$vars['main_color_darken_5'].';}';

$output .=	'.dfd-link-style-wrap.style-8 .dfd-link-element .back {border-bottom-color: '.$vars['main_site_color'].';}';

$output .=	'.dfd-link-style-wrap.style-1 .dfd-link-element:hover .front,'
			. '.dfd-link-style-wrap.style-3 .dfd-link-element:hover .front,'
			. '.dfd-link-style-wrap.style-4 .dfd-link-element .back,'
			. '.dfd-link-style-wrap.style-5 .dfd-link-element:hover .front,'
			. '.dfd-link-style-wrap.style-6 .dfd-link-element:hover .front,'
			. '.dfd-link-style-wrap.style-8 .dfd-link-element .back,'
			. '.dfd-link-style-wrap.style-9 .dfd-link-element:hover .front,'
			. '.dfd-link-style-wrap.style-10 .dfd-link-element:hover .front,'
			. '.dfd-link-style-wrap.style-11 .dfd-link-element:hover .front {color: '.$vars['main_site_color'].';}';

$output .= '.dfd-link-style-wrap > div {'
				. 'font-family: '.$vars['default_button-font-family'].';'
				. 'font-size: '.$vars['default_button-font-size'].';'
				. 'font-style: '.$vars['default_button-font-style'].';'
				. 'font-weight: '.$vars['default_button-font-weight'].';'
				. 'letter-spacing: '.$vars['default_button-letter-spacing'].';'
				. 'text-transform: '.$vars['default_button-text-transform'].';'
			. '}';