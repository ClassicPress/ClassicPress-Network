<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_native;

if (isset($dfd_native['top_panel_inner_appear_effect']) && !empty($dfd_native['top_panel_inner_appear_effect'])) {

	//$class = 'transform3d';
	
	echo '<div id="top-panel-inner" class="'.$dfd_native['top_panel_inner_appear_effect'].'">';
	
		switch ($dfd_native['top_panel_inner_appear_effect']) {
			case 'stretch':
					echo	'<div class="dfd-top-panel-animate-wrap">
								<div id="dfd-top-panel-loader" class="pageload-overlay" data-speed="100" data-opening="M20,15 50,30 50,30 30,30 Z;M0,0 80,0 50,30 20,45 Z;M0,0 80,0 60,45 0,60 Z;M0,0 80,0 80,60 0,60 Z" data-closing="M0,0 80,0 60,45 0,60 Z;M0,0 80,0 50,30 20,45 Z;M20,15 50,30 50,30 30,30 Z;M30,30 50,30 50,30 30,30 Z">
									<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
										<path d="M30,30 50,30 50,30 30,30 Z"/>
									</svg>
								</div>
							</div>';
					echo '<div class="top-panel-inner-wrapper '.esc_attr($dfd_native['top_panel_inner_appear_effect']).'">';
						the_content();
					echo '</div>';
				break;

			case 'spill':
					echo	'<div class="dfd-top-panel-animate-wrap">
								<div id="dfd-top-panel-loader" class="pageload-overlay" data-speed="400" data-opening="M 0,0 c 0,0 63.5,-16.5 80,0 16.5,16.5 0,60 0,60 L 0,60 Z">
									<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
										<path d="M 0,0 c 0,0 -16.5,43.5 0,60 16.5,16.5 80,0 80,0 L 0,60 Z"/>
									</svg>
								</div>
							</div>';
					echo '<div class="top-panel-inner-wrapper '.esc_attr($dfd_native['top_panel_inner_appear_effect']).'">';
						the_content();
					echo '</div>';
				break;

			case 'windscreen':
					echo	'<div class="dfd-top-panel-animate-wrap">
								<div id="dfd-top-panel-loader" class="pageload-overlay" data-speed="400" data-opening="M 40,100 150,0 -65,0 z">
									<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
										<path d="M 40,100 150,0 l 0,0 z"/>
									</svg>
								</div>
							</div>';
					echo '<div class="top-panel-inner-wrapper '.esc_attr($dfd_native['top_panel_inner_appear_effect']).'">';
						the_content();
					echo '</div>';
				break;

			case 'lateral_swipe':
					echo	'<div class="dfd-top-panel-animate-wrap">
								<div id="dfd-top-panel-loader" class="pageload-overlay" data-speed="500" data-opening="M 40,-65 145,80 -65,80 40,-65" data-closing="m 40,-65 0,0 L -65,80 40,-65">
									<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
										<path d="M 40,-65 145,80 40,-65"/>
									</svg>
								</div>
							</div>';
					echo '<div class="top-panel-inner-wrapper '.esc_attr($dfd_native['top_panel_inner_appear_effect']).'">';
						the_content();
					echo '</div>';
				break;

			default:
					echo '<div class="top-panel-inner-wrapper '.esc_attr($dfd_native['top_panel_inner_appear_effect']).'">';
						the_content();
					echo '</div>';
				break;
		}
	
	echo '</div>';
} else {
	echo '<div id="top-panel-inner">';
		echo '<div class="top-panel-inner-wrapper">';
			the_content();
		echo '</div>';
	echo '</div>';
}
