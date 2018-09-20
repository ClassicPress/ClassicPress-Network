<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_native;

$row_class = $columns_html = '';

if(isset($dfd_native['subfooter_columns']) && $dfd_native['subfooter_columns'] != '') {
	$count = $dfd_native['subfooter_columns'];
	
	$columns_class = Dfd_Theme_Helpers::dfd_num_to_string($count);
	
	for($i = 1; $i < (int)$dfd_native['subfooter_columns'] + 1; $i++) {
		$columns_html .= Dfd_Theme_Helpers::build_subfooter_column($i, $columns_class);
	}
	
	if(isset($dfd_native['subfooter_layout_width']) && $dfd_native['subfooter_layout_width'] != '') {
		$row_class .= $dfd_native['subfooter_layout_width'];
	}

	if($columns_html != '') {
		echo '<div class="dfd-equal-height-wrapper mobile-destroy-equal-heights row '. esc_attr($row_class) .'">'. $columns_html .'</div>';
	}
} else {
	echo '<div class="text-center dfd-background-dark">';
		echo esc_html__('© DynamicFrameworks- Elite ThemeForest Author.','dfd-native');
	echo '</div>';
}