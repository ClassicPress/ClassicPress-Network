<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
function tooltip_shortcode( $atts, $content = null ) {

	wp_enqueue_script( 'tooltip-js', DFD_EXTENSIONS_PLUGIN_URL . 'assets/js/tooltip.bootstrap.min.js', array( 'jquery' ), false, true );

    $image ='';

    $shortcode_atts = shortcode_atts( array(
        'align'  => '',
        'image'  => '',
        'text' => '',
		'contentwidth'=>''
    ), $atts );


    if ( ! empty( $shortcode_atts['image'] ) ) {
        $image = '<img src="' . esc_url($shortcode_atts['image']) . '" alt="" ><br>';
    }
	$contentwidth = isset($shortcode_atts['contentwidth']) ? $shortcode_atts['contentwidth'] : "" ;
	$id = "id".uniqid().rand(0, 10000);
	$output = '<span class="has-popover  has-tooltip '.esc_attr($id).'" data-html="true" data-trigger="focus" data-placement="' . esc_attr($shortcode_atts['align']) . '" rel="popover">
	' . $content . '
	<span class="popover-content hidden">'.$image . html_entity_decode( $shortcode_atts['text'] ) . '</span>
	</span>';
	$css ="";
	if((int)$contentwidth>0 &&  $contentwidth!=""){
		$contentwidth = (int)$contentwidth."px";
	}else{
		$contentwidth = "auto";
	}
		$css = ". $id ~ div.popover{ width: ".esc_js($contentwidth)."}";
	?>

	<script>
		(function($){
			$('head').append('<style type="text/css"><?php echo  $css; ?></style>');
		})(jQuery);
	</script>
		<?php
    return $output;

}

add_shortcode('tooltip', 'tooltip_shortcode' );

function dfd_popover_shortcode($atts, $content = null){

	wp_enqueue_script( 'tooltip-js', DFD_EXTENSIONS_PLUGIN_URL . 'assets/js/tooltip.bootstrap.min.js', array( 'jquery' ), false, true );

    $image ='';

    $shortcode_atts = shortcode_atts( array(
        'position'  => '',
        'image'  => '',
        'content' => '',
		'contentwidth'=>''
    ), $atts );


    if ( ! empty( $shortcode_atts['image'] ) ) {
        $image = '<img src="' . $shortcode_atts['image'] . '" alt="" ><br>';
    }
	$contentwidth = isset($shortcode_atts['contentwidth']) ? $shortcode_atts['contentwidth'] : "" ;
	$id = "id".uniqid();
	$output = '<span class="has-popover popover-bg '.$id.'" data-html="true" data-trigger="hover" data-placement="' . $shortcode_atts['position'] . '" rel="popover">
	' . $content . '
	<span class="popover-content hidden">'.$image . html_entity_decode( $shortcode_atts['content'] ) . '</span>
	</span>';
	$css ="";
	if((int)$contentwidth>0 &&  $contentwidth!=""){
		$contentwidth = (int)$contentwidth."px";
	}else{
		$contentwidth = "auto";
	}
		$css = ".$id ~ div.popover{ width: ".$contentwidth."}";
	?>

	<script>
		(function($){
			$('head').append('<style type="text/css"><?php echo  $css; ?></style>');
		})(jQuery);
	</script>
		<?php
    return $output;
	

}

add_shortcode('popover','dfd_popover_shortcode');