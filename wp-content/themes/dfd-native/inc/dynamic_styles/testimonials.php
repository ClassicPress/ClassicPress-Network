<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$output .= '.dfd-testimonial-content {'
				. 'font-family: '.$vars['default_text-font-family'].';'
				. 'font-size: '.$vars['default_text-font-size'].';'
				. 'font-style: '.$vars['default_text-font-style'].';'
				. 'font-weight: '.$vars['default_text-font-weight'].';'
				. 'letter-spacing: '.$vars['default_text-letter-spacing'].';'
				. 'color: '.$vars['default_text-color'].';'
			. '}';

/*Testimonials Slider*/
$output .= '.dfd-testimonial-slider .slick-dots li.slick-active button {'
				. 'background: '.$vars['main_site_color'].';'
			. '}';
