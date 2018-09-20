<?php
/* @var $this WPBakeryShortCode_Dfd_User_Form */
// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}
$hover_style_input =$vert_margin_btw_inputs = $horiz_margin_btw_inputs =  $custom_fonts_label =$custom_fonts_button = $custom_fonts_input = $hover_style_input2  = '';
$hide_border_bottom = $hide_border_right = $btn_text_transform = $font_size = $letter_spacing =  $button_border_width = $btn_align = $button_border_color = '';
$button_border_color_on_hover = $button_border_radius = $button_border_style = '';

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$atts = array_merge($atts, array ("content" => $content));

$check_layout = $check_layout ? $check_layout : "";
$str = "";
$use_builder = false;
if ($fake_check_layout == "") {
	$use_builder = true;
}else{
	$check_layout_template_layout = "check_layout_" . $fake_check_layout;
}

$outer_border_color = !empty($outer_border_color) ? "border:2px solid " . esc_attr($outer_border_color) : "";
$button_color_text = isset($button_color_text) ? esc_attr($button_color_text) : "";
$border_color = isset($border_color) ? esc_attr($border_color) : "";
$text_color = isset($text_color) ? esc_attr($text_color) : "";
$borderwidth = isset($borderwidth) ? esc_attr($borderwidth) : "";
$border_style = isset($border_style) ? esc_attr($border_style) : "";
$border_radius = isset($border_radius) ? esc_attr($border_radius) : "";
$btn_align = $btn_align ? esc_attr($btn_align) : "";
switch ($btn_align) {
	case "left":
		$btn_align = "float:left;";
		break;
	case "center":
		$btn_align = "margin:0 auto;";
		break;
	case "right":
		$btn_align = "float:right;";
		break;
}

$btn_style = "";
$btn_style_hover = "";

if ($btn_text_transform) {
	$btn_style.='text-transform:' . esc_attr($btn_text_transform) . ' !important;';
}
if ($font_size) {
	$btn_style.='font-size:' . esc_attr($font_size) . 'px !important;';
}

if(isset($letter_spacing) && $letter_spacing != '') {
	$btn_style.='letter-spacing:' . esc_attr($letter_spacing) . 'px !important;';
}
if(isset($button_border_width) && $button_border_width != '') {
	$btn_style.='border-width:' . esc_attr($button_border_width) . 'px !important;';
}
if ($button_border_color) {
	$btn_style.='border-color:' . esc_attr($button_border_color) . ' !important;';
}
if ($button_border_color_on_hover) {
	$btn_style_hover.='border-color:' . esc_attr($button_border_color_on_hover) . ' !important;';
}
if ($button_border_style) {
	$btn_style.='border-style:' . esc_attr($button_border_style) . ' !important;';
}
if (isset($button_border_radius) && $button_border_radius != '') {
	$btn_style.='border-radius:' . esc_attr($button_border_radius) . 'px;';
}
?>
<?php
$fontHelper = Dfd_Helper_GoogleFont::instance();

$label_font = $fontHelper->getGoogleFontArray($custom_fonts_label, true);
$button_font = $fontHelper->getGoogleFontArray($custom_fonts_button, true);
$input_font = $fontHelper->getGoogleFontArray($custom_fonts_input, true);


$fieldmanager = new Dfd_Contact_Form_FieldManager();
if (isset(${$check_layout_template_layout})) {
	$content = $fieldmanager->populate(${$check_layout_template_layout}, $fake_check_layout, $atts);
}else{
	if($use_builder){
		$content = $fieldmanager->populateForBuilder($atts);
	}
}
$form_id = Dfd_contact_form_settings::instance()->getFormid();
$input_background = $input_background ? $input_background : "";
$button_backgrond = $button_backgrond ? esc_attr($button_backgrond) : "";
$hover_button_backgrond = $hover_button_backgrond ? esc_attr($hover_button_backgrond) : "";
$boxshadow_border = "";
$table = "";
$compact_border_style = "";
$compact_border_width = "";
$height_input_span = "";
$height_input = "";
if ($preset == "preset2" || ($horiz_margin_btw_inputs == "" && $vert_margin_btw_inputs == "") || ( $horiz_margin_btw_inputs <= 0 && $vert_margin_btw_inputs <= 0)) {
	$table = "display: table;";
	$show_border = "border:transparent;";
	$compact_border_width = $borderwidth;
	$vert_margin_btw_inputs = 0;
	$horiz_margin_btw_inputs = 0;
} else if ($preset == "preset3") {
	$hide_border_right = "border-right: none !important;";
	$hide_border_bottom = "border-bottom: inherit;";
	$show_border = "border-color:transparent;";
	$outer_border_color = "";
} else {//preset1
	$hide_border_right = "border-right: none !important;";
	$hide_border_bottom = "border-bottom: none !important;";
	$show_border = " border-style:" . $border_style . " !important;";
	$outer_border_color = "";
}
$all_height_input = "47";
$height_input_span = $all_height_input ? "min-height:" . $all_height_input . "px;" : "";
?>
<?php ob_start(); ?>
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-1 textarea{
        border:transparent;
        padding-left: 0px;
    }
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-compact p.last{
        margin-bottom: 0px;
		border-bottom-color: transparent;
		border-bottom-width: 0;
    }
   
    #cf_<?php echo $form_id; ?> .dfd-half-size{
        width:50%;
    }
	<?php if($horiz_margin_btw_inputs && is_rtl() ) : ?>
		#cf_<?php echo $form_id; ?> .padding-left{
			padding-left: <?php echo $horiz_margin_btw_inputs; ?>px;
		}
		#cf_<?php echo $form_id; ?> .padding-right{
			padding-right: <?php echo $horiz_margin_btw_inputs; ?>px;    
		}
		#cf_<?php echo $form_id; ?> .padding-center{
			padding:0 <?php echo $horiz_margin_btw_inputs; ?>px;
		}
	<?php elseif($horiz_margin_btw_inputs) : ?>
		#cf_<?php echo $form_id; ?> .padding-left{
			padding-right: <?php echo $horiz_margin_btw_inputs; ?>px;
		}
		#cf_<?php echo $form_id; ?> .padding-right{
			padding-left: <?php echo $horiz_margin_btw_inputs; ?>px;    
		}
		#cf_<?php echo $form_id; ?> .padding-center{
			padding:0 <?php echo $horiz_margin_btw_inputs; ?>px;
		}	
	<?php endif;?>
	
	   
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-1 .right-border{
		<?php if($border_style) {?>
			border-style: <?php echo $border_style;?>;
		<?php }?>
		<?php if($border_color) {?>
			border-color: <?php echo $border_color; ?> !important;
		<?php } ?>
        z-index: 34;
    }
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-1 .top-border{
		<?php if($border_style) {?>
			border-style: <?php echo $border_style;?>;
		<?php }?>
		<?php if($border_color) {?>
			border-color: <?php echo $border_color; ?> !important;
		<?php } ?>
        z-index: 34;
    }
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-1 .left-border{
		<?php if($border_style) {?>
			border-style: <?php echo $border_style;?>;
		<?php }?>
		<?php if($border_color) {?>
			border-color: <?php echo $border_color; ?> !important;
		<?php } ?>
        z-index: 34;
    }
    #cf_<?php echo $form_id; ?> span.wpcf7-form-control-wrap span:not(".req_text"){
		<?php if($text_color){?>
			color:<?php echo $text_color; ?> !important;
		<?php } ?>
		<?php echo $height_input_span ? $height_input_span: ""; ?>
		<?php if($all_height_input){?>
			height:<?php echo $all_height_input; ?>px;
		<?php } ?>
        display: table;
        vertical-align: middle;
        width: 100%;
    }
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-compact .margin-left-1 .checkboxgroup{
		<?php if($compact_border_width) {?>
			left: -<?php echo $compact_border_width; ?>px;
			bottom: -<?php echo $compact_border_width; ?>px;
				<?php if($border_color){?>
					border-left: <?php echo $compact_border_width; ?>px solid <?php echo $border_color; ?>;
				<?php }?>
		<?php }?>
        
    }
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-1 .border-bottom{
        border: none;
    }
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-1 .wpcf7-form-control-wrap{
		<?php if($border_color){?>
			border-bottom-color: <?php echo $border_color; ?>;
		<?php } ?>
		<?php if($border_style){?>
			border-style : <?php echo $border_style; ?>;
		<?php }?>
    }
	#cf_<?php echo $form_id; ?>.preset3 .dfd-contact-form-style-1 .wpcf7-form-control-wrap{
		border-bottom-width : <?php echo $borderwidth;?>px;
	}
	#cf_<?php echo $form_id; ?>.preset3 .dfd-contact-form-style-1 .right-border{
		border-right-width : <?php echo $borderwidth;?>px;
	}
	#cf_<?php echo $form_id; ?>.preset3 .dfd-contact-form-style-1 .top-border{
		border-top-width : <?php echo $borderwidth;?>px;
	}
	#cf_<?php echo $form_id; ?>.preset3 .dfd-contact-form-style-1 .left-border{
		border-left-width : <?php echo $borderwidth;?>px;
	}
    #cf_<?php echo $form_id; ?> .box{        
		<?php echo $outer_border_color; ?>;
		<?php echo $table; ?>
	}
	<?php if($borderwidth){?>
		#cf_<?php echo $form_id; ?>.dfd_contact_form.preset3.hover_style_input2_underline_hover span.wpcf7-form-control-wrap:before{
			border-bottom-width : <?php echo $borderwidth;?>px;
		}
		#cf_<?php echo $form_id; ?>.dfd_contact_form.preset3.hover_style_input2_underline_hover span.wpcf7-form-control-wrap:before{
			bottom : -<?php echo $borderwidth;?>px;
		}
	<?php } ?>
	#cf_<?php echo $form_id; ?> p:not(.form_button) input, #cf_<?php echo $form_id; ?> p:not(.form_button) textarea{
		<?php echo $input_font; ?>
	}
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-compact .checkboxgroup{
        padding-left: 15px;        
    }
    #cf_<?php echo $form_id; ?> .checkboxgroup{
        display: table-cell;
        <!--vertical-align: middle;-->
        height: <?php echo $all_height_input-5; ?>px;
        position: relative;

    }
    #cf_<?php echo $form_id; ?> .checkbox input[type='checkbox']{
        min-height: <?php echo $all_height_input-5; ?>px;
		width: inherit;
    }
    #cf_<?php echo $form_id; ?> .checkbox input[type='checkbox']:before{
    }
    #cf_<?php echo $form_id; ?> .checkbox input[type='radio']{
        margin-right: 15px;
        min-height: <?php echo $all_height_input - 10; ?>px;
		width:inherit;
    }
    #cf_<?php echo $form_id; ?> .checkbox input{
		border-color:transparent;
        background: none !important;
    }
    #cf_<?php echo $form_id; ?> .checkbox{
        display: inline-table;
        vertical-align: middle;
        padding-right: 12px;
    }   
    .checkbox input{
        top:0px;
    }
    #cf_<?php echo $form_id; ?> .checkbox .c_value{
        display: table-cell;
        height:<?php echo $all_height_input-5; ?>px;
        vertical-align: middle;
    }
    #cf_<?php echo $form_id; ?> .checkbox .c_value label{
        height:<?php echo $all_height_input-5; ?>px;
        display: table-cell;
        vertical-align: middle;
		font-weight: inherit;
    }
	
    #cf_<?php echo $form_id; ?> .border-bottom{
		<?php echo $hide_border_bottom; ?>
		<?php if($border_style){?>
			border-bottom-style: <?php echo $border_style;?>;
		<?php }?>
		<?php if($compact_border_width){?>
			border-bottom-width: <?php echo $compact_border_width; ?>px;
		<?php }?>
		<?php if($border_color){?>
			border-bottom-color: <?php echo $border_color; ?> !important;
		<?php }?>
    }
    #cf_<?php echo $form_id; ?> .border-right{
		<?php echo $hide_border_right; ?>        
		<?php if($border_style){?>
			border-right-style: <?php echo $border_style;?>;
		<?php }?>
		<?php if($compact_border_width){?>
			border-right-width: <?php echo $compact_border_width; ?>px;
		<?php }?>
		<?php if($border_color){?>
			border-right-color: <?php echo $border_color; ?> !important;
		<?php }?>
    }
    #cf_<?php echo $form_id; ?> .border-left{
		<?php echo $compact_border_style; ?>       
		<?php if($border_style){?>
			border-left-style: <?php echo $border_style;?>;
		<?php }?>
		<?php if($compact_border_width){?>
			border-left-width: <?php echo $compact_border_width; ?>px;
		<?php }?>
		<?php if($border_color){?>
			border-left-color: <?php echo $border_color; ?> !important;
		<?php }?>
    }
    #cf_<?php echo $form_id; ?> .border-top{
		<?php echo $compact_border_style; ?>
		<?php if($border_style){?>
			border-top-style: <?php echo $border_style;?>;
		<?php }?>
		<?php if($compact_border_width){?>
			border-top-width: <?php echo $compact_border_width; ?>px;
		<?php }?>
		<?php if($border_color){?>
			border-top-color: <?php echo $border_color; ?> !important;
		<?php }?>
    }

    #cf_<?php echo $form_id; ?> p:not(.form_button) input, #cf_<?php echo $form_id; ?> p:not(.form_button) textarea{
		<?php echo $show_border; ?>
		<?php echo $height_input; ?>
		<?php if($borderwidth){?>
			border-width: <?php echo $borderwidth; ?>px;
		<?php }?>
		<?php if($input_background){?>
			background-color: <?php echo esc_attr($input_background); ?> !important;
		<?php }?>
		<?php if(isset($border_radius) && $border_radius != ''){?>
			border-radius: <?php echo $border_radius; ?>px;
		<?php }?>
        
		<?php if($text_color){?>
			color:<?php echo $text_color; ?> !important;
		<?php }?>
		<?php if($border_color){?>
			border-color: <?php echo $border_color; ?>;
		<?php }?>
		margin-bottom: 0px;
        z-index:0;
		position :relative;
    }

	#cf_<?php echo $form_id; ?> .checkbox span
	{
		    font-weight: 400;
			<?php echo $input_font; ?>
	}
	<?php if($label_font):?>
		#cf_<?php echo $form_id; ?>.preset1 .label_text label:first-child{
			<?php echo $label_font; ?>
		}
	<?php endif;?>
	#cf_<?php echo $form_id; ?> ::-webkit-input-placeholder {
		<?php if($text_color){?>
			color: <?php  echo $text_color; ?>;
		<?php }?>
		<?php if($label_font){?>
			<?php echo $label_font; ?>
		<?php }?>
	}
	#cf_<?php echo $form_id; ?> :-moz-placeholder {
		<?php if($text_color){?>
			color: <?php  echo $text_color; ?>;
		<?php }?>
		<?php if($label_font){?>
			<?php echo $label_font; ?>
		<?php }?>
	}
    #cf_<?php echo $form_id; ?> input[type="checkbox"]{
        float: none;
        top: inherit;
    }
    #cf_<?php echo $form_id; ?> .radio_el{
        text-align: center;
        width: 100%;
        display: block;
    }
    #cf_<?php echo $form_id; ?> .radio_el label{
        margin-right: 8px;
    }
    /*reCaptcha*/
    #cf_<?php echo $form_id; ?>  iframe{
        margin: 0 auto;
        display: block;
    }
    #cf_<?php echo $form_id; ?>  .captcha div{
        width: 100% !important;
    }
    #cf_<?php echo $form_id; ?> p span.reloadCap:hover{
        color: rgb(39, 40, 42);
        cursor: pointer;
    }
    /**submit*/
    #cf_<?php echo $form_id; ?> .form_button{
        margin-bottom: 0px;
    }
    .checkbox input{
        float: left;
    }
    #cf_<?php echo $form_id; ?> .wpcf7-submit{
		<?php echo $btn_align; ?>
		<?php echo $btn_style; ?>
		<?php if($text_align){?>
			text-align: <?php echo esc_attr($text_align) ?>;
		<?php }?>
		<?php if($button_backgrond){?>
			background-color: <?php echo $button_backgrond ?> !important;
		<?php }?>
		<?php if($button_color_text){?>
			color: <?php echo $button_color_text ?> !important;
		<?php }?>
		<?php echo $button_font; ?>
    }
	<?php if($button_backgrond){?>
		#cf_<?php echo $form_id; ?> .cssload-spin-box2:after{
			 background: <?php echo $button_backgrond ?> !important;
		}
	<?php }?>
	<?php if($hover_button_backgrond){?>
		#cf_<?php echo $form_id; ?> .wpcf7-submit:hover+.cssload-spin-box2:after{
			 background: <?php echo $hover_button_backgrond ?> !important;
		}
	<?php }?>
	
    #cf_<?php echo $form_id; ?> input:hover.wpcf7-submit{
		<?php if($hover_button_backgrond){?>
			background-color: <?php echo $hover_button_backgrond ?> !important;
		<?php }?>
		<?php if($button_hover_color_text){?>
			color: <?php echo $button_hover_color_text ?> !important;
		<?php }?>
		<?php echo $btn_style_hover; ?>
    }

    /*select*/
    #cf_<?php echo $form_id; ?> .dk-selected{
		<?php echo $show_border; ?>
		<?php if($text_color){?>
			color : <?php echo esc_attr($text_color);?>;
		<?php }?>
		<?php if($borderwidth){?>
			border-width: <?php echo $borderwidth; ?>px;
		<?php }?>
		<?php if($border_color){?>
			border-color: <?php echo $border_color; ?>;
		<?php }?>
        position: relative;
		<?php if($input_background){?>
			background-color: <?php echo esc_attr($input_background); ?> !important;
		<?php }?>
		<?php if(isset($border_radius) && $border_radius != ''){?>
			border-radius: <?php echo $border_radius; ?>px;
		<?php }?>
    }
    #cf_<?php echo $form_id; ?> .dk_container{
		<?php echo $show_border; ?>
        position: relative;
        z-index: 1;
		<?php if($input_background){?>
			background-color: <?php echo esc_attr($input_background); ?> !important;
		<?php }?>
        margin-bottom: 0px;
        vertical-align: middle;
        display: table-cell !important;
		<?php if(isset($border_radius) && $border_radius != ''){?>
			border-radius: <?php echo $border_radius; ?>px;
		<?php }?>
        margin-top: 0px;
		width: 100%;
    }
	#cf_<?php echo $form_id; ?> .dk_container a,
	#cf_<?php echo $form_id; ?> .dk-select a{
		<?php echo $input_font;?>
	}
    #cf_<?php echo $form_id; ?> .dk_container .dk_toggle{
        height: 47px;
        line-height: 21px;
		<?php if($text_color){?>
			color:<?php echo $text_color; ?> !important;
		<?php }?>
		
    }
    #cf_<?php echo $form_id; ?> .dk_open .dk_options,
    #cf_<?php echo $form_id; ?> .dk-select-open-down .dk-select-options,
    #cf_<?php echo $form_id; ?> .dk-select-open-up .dk-select-options{
        /*top: 40px !important;*/
    }

    /*ajax loader*/
    #cf_<?php echo $form_id; ?> img.ajax-loader{
        float: right;
        top: 19px;
        right: 5px;
        position: absolute;
        z-index: 59;
        border: none !important;
    }   
  
    #cf_<?php echo $form_id; ?> .wpcf7-response-output{
        margin: 0;
    }
    #cf_<?php echo $form_id; ?> .recaptcha{
        /*float: left;*/
		margin-top: 6px;
    }

<?php $css = ob_get_clean(); ?>
<?php
$css = dfd_normalize_css($css);
?>
<script type="text/javascript">
	(function($){
		try {
			global_dfd.init($)
			dfdreCaptcha.el = [
			];
			dfdreCaptcha.widgets = [
			];
			dfdreCaptcha.show();

			$('form.wpcf7-form select').dropkick();
		} catch(e) {
		}
		$('head').append('<style type="text/css"><?php echo esc_js($css); ?></style>');
	})(jQuery);
</script>

<?php
$form = new Dfd_Simple_FormDecorator(
		  new Dfd_ButtonDecorator(
		  new Main_Form_Decorator()
		  )
);
echo $form->generate($content);
?>

