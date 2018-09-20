<?php

// Get init code
foreach($slides['properties']['attrs'] as $key => $val) {

	if(is_bool($val)) {
		$val = $val ? 'true' : 'false';
		$init[] = $key.': '.$val;
	} elseif(is_numeric($val)) { $init[] = $key.': '.$val;
	} else { $init[] = "$key: '$val'"; }
}

// Full-size sliders
if( ( !empty($slides['properties']['attrs']['type']) && $slides['properties']['attrs']['type'] === 'fullsize' ) && ( empty($slides['properties']['attrs']['fullSizeMode']) || $slides['properties']['attrs']['fullSizeMode'] !== 'fitheight' ) ) {
	$init[] = 'height: '.$slides['properties']['props']['height'].'';
}

// Popup
if( !empty($slides['properties']['attrs']['type']) && $slides['properties']['attrs']['type'] === 'popup' ) {
	$lsPlugins[] = 'popup';
}

if( ! empty( $lsPlugins ) ) {
	$init[] = 'plugins: ' . json_encode( array_unique( $lsPlugins ) );
}

$separator = apply_filters( 'layerslider_init_props_separator', ', ');
$init = implode( $separator, $init );


$lsInit[] = 'var lsjQuery = jQuery;';
$lsInit[] = 'lsjQuery(document).ready(function() {' . NL;
	$lsInit[] = 'if(typeof lsjQuery.fn.layerSlider == "undefined") {' . NL;
		$lsInit[] = 'if( window._layerSlider && window._layerSlider.showNotice) { ' . NL;
			$lsInit[] = 'window._layerSlider.showNotice(\''.$sliderID.'\',\'jquery\');' . NL;
		$lsInit[] = '}' . NL;
	$lsInit[] = '} else {' . NL;
		$lsInit[] = 'lsjQuery("#'.$sliderID.'")';
		if( !empty($slides['callbacks']) && is_array($slides['callbacks']) ) {
			foreach($slides['callbacks'] as $event => $function) {
				$lsInit[] = '.on(\''.$event.'\', '.stripslashes($function).')';
			}
		}
		$lsInit[] = '.layerSlider({'.$init.'});' . NL;
	$lsInit[] = '}' . NL;
$lsInit[] = '});' . NL;
