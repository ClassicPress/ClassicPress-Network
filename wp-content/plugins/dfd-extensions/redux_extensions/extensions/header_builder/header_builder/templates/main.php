<?php
if (!defined('ABSPATH'))
	exit;
?>
<?php
global $dfd_native;

?>
<script type="text/template" id="dfd_header_t_el">
	<?php echo '<div class="pressent_name"><%=name %> </div> '; ?> 
	<?php echo '<div class="template"><%=temp %></div>'; ?>
	<div class="hover-controls element">
	<div class="controls-out-tl">
	<div class="parent-vc_row_inner">
	<a class="control-btn" title="Drag to move Row" target="_blank">
	<?php echo '<% if(type!="menu" && type!="delimiter" && type!="spacer" && type!="additional_menu" && type!="second_menu" && type!="third_menu") {%>';?>
	<?php echo '<span class="btn-content fullwidth <%= isfullwidth == false ? \'active\' : \'\' %> full">';?>
	<i class="dashicons dashicons-align-center"></i>
	Set full width
	</span>
	<?php echo '<span class="btn-content fullwidth  <%= isfullwidth == true ? \'active\' : \'\' %>  inline">' ?>
	<i class="dashicons dashicons-align-center"></i>
	Set inline width
	</span>
	<?php echo '<%}%>'?>
	<span class="btn-content delete">
	<i class="dashicons dashicons-trash"></i>
	<?php echo "Delete <%=name %>";?>
	</span>
	</a>
	</div>
	</div>
	</div>
</script>



<script type="text/template" id="dfd_header_t_el_menu">
	<nav class="mega-menu   text-right" id="main_mega_menu" role="navigation">
	<ul id="menu-main" class="nav-menu menu-primary-navigation menu-clonable-for-mobiles">
	<li id="nav-menu-item-17-587346597e5ed" class="mega-menu-item nav-item menu-item-depth-0  current-menu-item">
	<a href="" class="menu-link main-menu-link item-title" id="accessible-megamenu-1483949660137-1" onclick="return false;">
	<span class="">Primary</span>
	</a>
	</li>
	<li id="nav-menu-item-18-587346597e5ed" class="mega-menu-item nav-item menu-item-depth-0">
	<a href="" class="menu-link main-menu-link item-title" id="accessible-megamenu-1483949660138-2" onclick="return false;">
	<span class="">Navigation</span>
	</a>
	</li>
	</li>
	<li id="nav-menu-item-18-587346597e5ed" class="mega-menu-item nav-item menu-item-depth-0">
	<a href="" class="menu-link main-menu-link item-title" id="accessible-megamenu-1483949660138-2" onclick="return false;">
	<span class="">Menu</span>
	</a>
	</li>
	</ul>
	</nav>
</script>
<script type="text/template" id="dfd_header_t_el_second_menu">
	<nav class="mega-menu   text-right" id="main_mega_menu" role="navigation">
	<ul id="menu-main" class="nav-menu menu-primary-navigation menu-clonable-for-mobiles">
	<li id="nav-menu-item-17-587346597e5ed" class="mega-menu-item nav-item menu-item-depth-0  current-menu-item">
	<a href="#ddd" class="menu-link main-menu-link item-title" onclick="return false;">
	<span class="">Second</span>
	</a>
	</li>
	<li id="nav-menu-item-18-587346597e5ed" class="mega-menu-item nav-item menu-item-depth-0">
	<a href="#ddd" class="menu-link main-menu-link item-title" onclick="return false;">
	<span class="">Menu</span>
	</a>
	</li>
	</ul>
	</nav>
</script>
<script type="text/template" id="dfd_header_t_el_third_menu">
	<nav class="mega-menu   text-right" id="main_mega_menu" role="navigation">
	<ul id="menu-main" class="nav-menu menu-primary-navigation menu-clonable-for-mobiles">
	<li id="nav-menu-item-17-587346597e5ed" class="mega-menu-item nav-item menu-item-depth-0  current-menu-item">
	<a href="#ddd" class="menu-link main-menu-link item-title" onclick="return false;">
	<span class="">Third</span>
	</a>
	</li>
	<li id="nav-menu-item-18-587346597e5ed" class="mega-menu-item nav-item menu-item-depth-0">
	<a href="#ddd" class="menu-link main-menu-link item-title"  onclick="return false;">
	<span class="">Menu</span>
	</a>
	
	</ul>
	</nav>
</script>
<script type="text/template" id="dfd_header_t_el_mobile_menu">
	<div class="dl-menuwrapper">
	<a href="#sidr" class="dl-trigger icon-mobile-menu" id="mobile-menu">
	<span class="icon-wrap dfd-middle-line"></span><span class="icon-wrap dfd-top-line"></span>
	<span class="icon-wrap dfd-bottom-line"></span>
	</a>
	</div>
</script>
<script type="text/template" id="dfd_header_t_el_side_area">
	<div class="dl-menuwrapper">
	<a href="#sidr" class="dl-trigger icon-mobile-menu" id="mobile-menu">
	<span class="icon-wrap dfd-middle-line"></span><span class="icon-wrap dfd-top-line"></span>
	<span class="icon-wrap dfd-bottom-line"></span>
	</a>
	</div>
</script>
<script type="text/template" id="dfd_header_t_el_cart">
	<div class="total_cart_header">
	<a class="woo-cart-contents" href="#dd" title=""  onclick="return false;">
	<span class="woo-cart-items">
	<i class="dfd-socicon-icon-ios7-cart"></i>
	</span>
	<span class="woo-cart-details"><span>0</span></span>
	</a>

	</div>
</script>
<script type="text/template" id="dfd_header_t_el_text">
	<?php echo '<div class="copyright-text"><%=value %></div> ';?>
</script>
<script type="text/template" id="dfd_header_t_el_telephone">
	<?php echo '<div class="telephone-field-builder"><%=value %></div>';?>
</script>
<script type="text/template" id="dfd_header_t_el_spacer">
	<div class="spacer"></div>
</script>
<script type="text/template" id="dfd_header_t_el_buttonel">
	<?php echo '<div class="button_builder"><div class="text_b"><%=value %></div></div>';?>
</script>
<script type="text/template" id="dfd_header_t_el_search">
	<div class="form-search-wrap">
	<a href="#dd" class="header-search-switcher dfd-socicon-Search"  onclick="return false;"></a>
	</div>
</script>
<script type="text/template" id="dfd_header_t_el_wishlist">
	<a class="header-wishlist-button dfd-tablet-hide" href="#ddd" title="View your wishlist"  onclick="return false;">
	<i class="dfd-socicon-icon-ios7-heart"></i><span class="wishlist-details">0</span>
	</a>
</script>
<script type="text/template" id="dfd_header_t_el_logo">

	<div class="dfd-header-logos">
	<div class="dfd-logo-wrap">
	<a href="#ddd" title="Site logo"  onclick="return false;">
	<?php echo '<img src="<%=image %>" class="main-logo" alt="Site logo">';?>
	</a>
	</div>
	</div>
</script>
<script type="text/template" id="dfd_header_t_el_socicon">
	<div class="widget soc-icons">
	<a href="#dd" class="fb dfd-socicon-facebook" title="Facebook" target="_blank"  onclick="return false;"></a>
	<a href="#dd" class="pi dfd-socicon-picasa" title="Picasa" target="_blank"  onclick="return false;"></a>
	<a href="#dd" class="tw dfd-socicon-twitter" title="Twitter" target="_blank"  onclick="return false;"></a>
	<a href="#dd" class="xn dfd-socicon-b_Xing-icon_bl" title="Xing" target="_blank"  onclick="return false;"></a>
	</div>
</script>
<script type="text/template" id="dfd_header_t_el_login">
	<div class="login-header">
	<div class="links">
	<a href="#ddd" class="drop-login dfd-header-links" data-reveal-id="loginModal"  onclick="return false;">
	<i class="dfd-socicon-login"></i>
	<span><?php echo esc_html__('Login on site', 'dfd-native'); ?></span>
	</a>
	</div>
	</div>
</script>
<script type="text/template" id="dfd_header_t_el_inner_page">
	<a class="top-inner-page dfd-mobile-header-hide" href="#ddd"  onclick="return false;"><span><span></span><span></span><span></span></span></a>
</script>
<script type="text/template" id="dfd_header_t_el_additional_menu">
	<ul id="menu-primary-navigation" class="dfd-additional-header-menu dfd-header-links">
	<li>
	<a href="#dd" onclick="return false;">Small</a></li>
	<li class="current_page_item">
	<a href="#dd" onclick="return false;">Menu</a></li>
	<li>
	<a href="#dd" onclick="return false;">Here</a></li>
	</ul>
</script>
<script type="text/template" id="dfd_header_t_el_info">
	<div class="dfd-header-top-info"><?php echo $dfd_native["top_adress_field"] ?></div>
</script>
<script type="text/template" id="dfd_header_t_el_delimiter">
	<div class="dfd-header-delimiter"></div>
</script>
<script type="text/template" id="dfd_header_t_el_preset">
	<div class='preset-window'>
	<i class="close dfd-socicon-icon-close-round"></i>
	<div class="head">Presets list:</div>
	<div class="list"><div>
	</div>
</script>
<script type="text/template" id="dfd_header_t_add_preset">
	<?php echo '<% if(hide){ cls = "hide"}else{ cls="" }%>';?>
	<?php echo '<div class="redux-main <%=cls%>">';?>
	<label for="add_preset" onclick="return false;">Enter Preset Name:</label><input type="text" class="add_name" name="add_preset" >
	<div class="btn_add">
		<span class="dashicons dashicons-plus"></span>
		<input  type="submit" value="Add preset">
	</div>			
	</div>
	<div class="error"></div>
	<?php echo '<% if(!hide){ %>';?>
	<div class="delim_line"></div>
	<div class="heder_style_title">Select Header Style:</div>
	<?php echo '<% } %>';?>
	
</script>
<script type="text/template" id="dfd_header_t_el_language">
	<div class="dfd-header-buttons-wrap">
	<?php echo $dfd_native["lang_shortcode"] ?>
	</div>
</script>
<script type="text/template" id="dfd_header_t_preset_elem">

	<?php echo '<div class="name thickbox"><%=name%></div>'; ?>
	<div class="separator_preset"></div>
	<div class="edit-preset ">
	<?php echo '<span class="copy <%=isDefault %> >"><span class="dashicons dashicons-admin-page"></span>Copy</span>';?>
	<?php echo '<% if (isDefault == false){ %>';?>
	<span class="rename"><span class="dashicons dashicons-edit"></span>Rename</span>
	<span class="delete"><span class="dashicons dashicons-trash"></span>Delete</span>
	<span class="rename_preset">
	<?php echo '<input type="text" value="<%=name%>" name="edit_name"/>';?>
	<input type="submit" value="Save" class="change-name"/>
	</span>
	<?php echo '<% } %>';?>
	<div>

</script>
<script type="text/template" id="dfd_header_t_presetname">
	<?php echo '<% if(preset_name) { %>';?>
	<?php echo '<span class="ps_header">You edit the following preset:</span><h2> <%=preset_name%></h2>';?>
	<?php echo '<% } else {%>';?>
	<h2> <?php echo esc_html__("It's new preset, please drag'n drop element to window below or select exist preset", "dfd") ?></h2>
	<?php echo '<%}%>';?>
</script>
<style id="header_builder_style">

</style>
<style id="header_builder_colors">

</style>

<div class="header_builder_app desktop">

	<pre class="debug left">
	
	</pre>
	<pre class="debug right">
	
	</pre>
	

	<div class="header-app-notify">
		<div class="wrap">
			<?php echo esc_html__("You made changes. Please click 'Save Changes' button to apply them.", "dfd"); ?>
			<i class="close-notify dfd-socicon-cross-24"></i>
		</div>
	</div>
	<div class="buttom_head_builder_wrraper">
		<div class="open-preset-window buttom_head_builder">
			<span class="dashicons dashicons-menu"></span>
			<input type="submit"  id="open-preset-window" class=" "  value="Select preset" onclick="return false;">				
		</div>
		<div class="add-preset-btn buttom_head_builder">
			<span class="dashicons dashicons-plus"></span>
			<input type="submit"  id="add_preset" class=""  value="Add new preset"  onclick="return false;">				
		</div>	
	</div>
	<input type="hidden" id="header_changed_options" name="heeaer_options_changed" value=""/>
	<input type="hidden" id="header_builder_options" name="<?php echo $this->field["name"]; ?>" value='<?php echo $this->value; ?>' />

	<div class="curent-preset-name-app"></div>

	
	<div class="row">
		<div class="header_builder_wrapper col col-12">
			<div class="scroll_header_builder">
				<div id="dfd_header_t_preview" class="dfd_header_t_preview">
					<div class="row" style="position: relative;">

						<div class="button-view-switcher">
							<span class="decoration_btn_wrap">
								<span></span>
								<span></span>
								<span></span>
							</span>
							<div class="options-header-buttons-section">
								<div class="dfd-options-button-cover options-button-green">
									<span class="dashicons dashicons-desktop"></span>
									<input type="submit"   class="" data-val="desktop" value="Desktop" onclick="return false;">				
								</div>
								<div class="dfd-options-button-cover options-button-green-border">
									<span class="dashicons dashicons-tablet"></span>
									<input type="submit"   class="" data-val="tablet" value="Tablet" onclick="return false;">					
								</div>
								<div class="dfd-options-button-cover options-button-green-border">
									<span class="dashicons dashicons-smartphone"></span>
									<input type="submit"   class="" data-val="mobile" value="Mobile" onclick="return false;">					
								</div>
							</div>
							<div class="options-header-buttons-section reset">
								<div class="dfd-options-button-cover reset">
									<span class="dashicons dashicons-image-rotate "></span>
									<input type="submit"   class="" data-val="" value="Reset to defaults" onclick="return false;">
								</div>
							</div>
						</div>

					</div>
				<div class="load_screan">
					<div class="load-text">Loading Template.....</div>
					<div class="load-text load-text-second">Please Wait</div>
				</div>
				<div class="dfd_header_t_preview_wrapper">
					<div class="container row top">
						<div class="t_wrap el">
							<div class="t_l1_left el left">
								<div class="wrapper">
								</div>
							</div>
							<div class="t_l1_right el">
								<div class="t_l2_left el center">
									<div class="wrapper">
									</div>
								</div>
								<div class="t_l2_right el">
									<div class="t_l3_left el right">
										<div class="wrapper">
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div id="container_middle_builder" class="container row middle">
						<div class="t_wrap el">
							<div class="t_l1_left el left">
								<div class="wrapper">
								</div>
							</div>
							<div class="t_l1_right el">
								<div class="t_l2_left el center">
									<div class="wrapper">
									</div>
								</div>
								<div class="t_l2_right el">
									<div class="t_l3_left el right">
										<div class="wrapper">
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="container row bottom">

						<div class="t_wrap el">
							<div class="t_l1_left el left">
								<div class="wrapper">
								</div>
							</div>
							<div class="t_l1_right el">
								<div class="t_l2_left el center">
									<div class="wrapper">
									</div>
								</div>
								<div class="t_l2_right el">
									<div class="t_l3_left el right">
										<div class="wrapper">
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
			</div>
			<div class="clear"></div>
			<div class="notice_for_drag_el">
				<span>Elements</span><span>Just drag and drop the element you need to the header area</span>
			</div>
			<div id="dfd_header_t_controls">
			</div>

		</div>

	</div>

	<div class="calulate_wishlist_width" style="display: inline-block; visibility: hidden">
		<a class="header-wishlist-button dfd-tablet-hide" href="http://nativewptheme.net/shop-first/wishlist/view/" title="View your wishlist">
			<i class="dfd-socicon-icon-ios7-heart"></i><span class="wishlist-details">0</span>
		</a>
	</div>
	<div class="calulate_login_width" style="display: inline-block; visibility: hidden">
		<div class="login-header">
			<div class="links">
				<a href="http://nativewptheme.net/shop-first/wp-login.php?redirect_to=http%3A%2F%2Fnativewptheme.net%2Fshop-first%2F" class="drop-login dfd-header-links" data-reveal-id="loginModal">
					<i class="dfd-socicon-login"></i>
					<span><?php echo esc_html__('Login on site', 'dfd-native'); ?></span>
				</a>
			</div>
		</div>
	</div>
</div>
<div class="calculate_width" style="display: inline-block;visibility: hidden"></div>
<div class="calculate_top_info_width" style="display: inline-block; visibility: hidden"><?php echo $dfd_native["top_adress_field"] ?></div>

<div id="examplePopup1" style="display:none">
	<div class="add-preset-app"></div>
</div>