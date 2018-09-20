<?php
	/**
	 * The template for the main content of the panel.
	 *
	 * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
	 *
	 * @author 		Redux Framework
	 * @package 	ReduxFramework/Templates
	 * @version     3.4.3
	 */
?>
<!-- Header Block -->
<?php $this->get_template( 'header.tpl.php' ); ?>


<div class="redux-sections-wrap">

	<?php $this->get_template( 'menu_container.tpl.php' ); ?>

	<div class="redux-main">
		<!-- Stickybar -->

		<?php $this->get_template( 'header_stickybar.tpl.php' ); ?>
		<!-- Intro Text -->
		<?php if ( isset( $this->parent->args['intro_text'] ) ) : ?>
			<div id="redux-intro-text"><?php echo $this->parent->args['intro_text']; ?></div>
		<?php endif; ?>
		
		<div id="redux_ajax_overlay">&nbsp;</div>
		<?php
			foreach ( $this->parent->sections as $k => $section ) {
				if ( isset( $section['customizer_only'] ) && $section['customizer_only'] == true ) {
					continue;
				}

				//$active = ( ( is_numeric($this->parent->current_tab) && $this->parent->current_tab == $k ) || ( !is_numeric($this->parent->current_tab) && $this->parent->current_tab === $k )  ) ? ' style="display: block;"' : '';
				$section['class'] = isset( $section['class'] ) ? ' ' . $section['class'] : '';
				echo '<div id="' . $k . '_section_group' . '" class="redux-group-tab' . $section['class'] . '" data-rel="' . $k . '">';
				//echo '<div id="' . $k . '_nav-bar' . '"';
				/*
			if ( !empty( $section['tab'] ) ) {

				echo '<div id="' . $k . '_section_tabs' . '" class="redux-section-tabs">';

				echo '<ul>';

				foreach ($section['tab'] as $subkey => $subsection) {
					//echo '-=' . $subkey . '=-';
					echo '<li style="display:inline;"><a href="#' . $k . '_section-tab-' . $subkey . '">' . $subsection['title'] . '</a></li>';
				}

				echo '</ul>';
				foreach ($section['tab'] as $subkey => $subsection) {
					echo '<div id="' . $k .'sub-'.$subkey. '_section_group' . '" class="redux-group-tab" style="display:block;">';
					echo '<div id="' . $k . '_section-tab-' . $subkey . '">';
					echo "hello ".$subkey;
					do_settings_sections( $this->parent->args['opt_name'] . $k . '_tab_' . $subkey . '_section_group' );
					echo "</div>";
					echo "</div>";
				}
				echo "</div>";
			} else {
				*/

				// Don't display in the
				$display = true;
				if ( isset( $_GET['page'] ) && $_GET['page'] == $this->parent->args['page_slug'] ) {
					if ( isset( $section['panel'] ) && $section['panel'] == "false" ) {
						$display = false;
					}
				}

				if ( $display ) {
					$this->output_section( $k );
				}
				//}
				echo "</div>";
				//echo '</div>';
			}
			$input_value = isset($this->parent->transients['options_values']) ? $this->parent->transients['options_values'] : '';
			//$input_value = isset($this->parent->options['values_collector']) ? $this->parent->options['values_collector'] : '';
			echo '<input type="hidden" name="'. $this->parent->args['opt_name'] .'[options_values]" id="option-values-collector" value="'.esc_attr($input_value).'">';

		//
		//	// Debug object output
		//	if ( $this->parent->args['dev_mode'] == true ) {
		//		$this->parent->debug->render();
		//	}
			
		if ( isset($this->parent->args['system_info']) && $this->parent->args['system_info'] === true ) :
			require_once ReduxFramework::$_dir . 'inc/sysinfo.php';
			$system_info = new Simple_System_Info();
		?>
			<div id="system_info_default_section_group" class="redux-group-tab">
				<h2><?php esc_html_e( 'System Info', 'dfd-native' );?></h2>
			<!---->
				<div id="redux-system-info">
			<!--			--><?php echo $system_info->get( true );?>
				</div>
			<!---->
			</div>
		<?php endif; ?>
		<?php
		$extra_services = array(
			array(
				'url'		=> 'http://nativewptheme.net/support/native-documentation/',
				'icon'		=> '<img src="'. DFD_EXTENSIONS_PLUGIN_URL .'redux_framework/ReduxCore/assets/img/docs.png" class="customization-icons" width="33" height="46" alt="'.esc_attr('Documentation','dfd-native').'" />',
				'title'		=> 'Read documentation',
				'content'	=> 'Using structured information on theme customization, you can find the answers to any question easily. ',
			),
			array(
				'url'		=> 'https://www.youtube.com/playlist?list=PLb4J5GIHmy1njwl7iudP2UkYMhel49fVc',
				'icon'		=> '<img src="'.DFD_EXTENSIONS_PLUGIN_URL.'redux_framework/ReduxCore/assets/img/video.png" class="customization-icons" width="45" height="46" alt="'.esc_attr('Video tutorials','dfd-native').'" />',
				'title'		=> 'Watch video tutorials',
				'content'	=> 'Manage the theme with structured video tutorials for the users with any experience. ',
			),
			array(
				'url'		=> 'http://nativewptheme.net/support/knowledge-base/',
				'icon'		=> '<img src="'.DFD_EXTENSIONS_PLUGIN_URL.'redux_framework/ReduxCore/assets/img/knowledge.png" class="customization-icons" width="35" height="46" alt="'.esc_attr('Knowledge base','dfd-native').'" />',
				'title'		=> 'Knowledge base',
				'content'	=> 'Take a look at our extended knowledge base to find the answer to any question. ',
			),
			array(
				'url'		=> 'https://themeforest.net/item/native-powerful-startup-development-tool/19200310/comments',
				'icon'		=> '<img src="'.DFD_EXTENSIONS_PLUGIN_URL.'redux_framework/ReduxCore/assets/img/question.png" class="customization-icons" width="52" height="46" alt="'.esc_attr('Ask a question','dfd-native').'" />',
				'title'		=> 'Ask a question',
				'content'	=> 'Have any questions? Post your questions on the forum of the theme and get an instant reply. ',
			),
			array(
				'url'		=> 'http://nativewptheme.net/support/',
				'icon'		=> '<img src="'.DFD_EXTENSIONS_PLUGIN_URL.'redux_framework/ReduxCore/assets/img/forum.png" class="customization-icons" width="57" height="46" alt="'.esc_attr('Support forum','dfd-native').'" />',
				'title'		=> 'Support forum',
				'content'	=> 'Still haven’t found the answers? Submit a ticket at our support forum. We will help you as soon as possible. ',
			),
			array(
				'url'		=> 'http://dfd.name/services/',
				'icon'		=> '<img src="'.DFD_EXTENSIONS_PLUGIN_URL.'redux_framework/ReduxCore/assets/img/customization.png" class="customization-icons" width="45" height="46" alt="'.esc_attr('Customization services','dfd-native').'" />',
				'title'		=> 'Customization services',
				'content'	=> 'Make your web project exclusive with DFD at a reasonable price! Follow the Customization page right now. ',
			),
		);
		$i = 0;
		if(!empty($extra_services)) :
		?>
		<div id="dfd_customization_services_section_group" class="redux-group-tab">
				<h2><?php esc_html_e( 'Customization services', 'dfd-native' );?></h2>
			<!---->
				<div id="dfd-customization-services-tab">
					<div class="items-wrapper">
					<?php foreach($extra_services as $service) :
						$i++;
						?>
						<div class="dfd-service-item">
							<div class="cover">
								<a href="<?php echo esc_url($service['url']) ?>" title="<?php echo $service['title'] ?>" target="_blank">
									<?php if(!empty($service['icon'])) : ?>
										<div class="icon-wrapper"><?php echo $service['icon'] ?></div>
									<?php endif; ?>
									<?php if(!empty($service['title'])) : ?>
										<h4><?php echo $service['title'] ?></h4>
									<?php endif; ?>
									<?php if(!empty($service['content'])) : ?>
										<div class="content"><?php echo $service['content'] ?></div>
									<?php endif; ?>
								</a>
							</div>
						</div>
					<?php if($i === 3) { ?>
						</div><div class="items-wrapper">
					<?php }
					endforeach; ?>
					</div>
					<div class="spacer"></div>
					<h2 class="extra-heading"><?php esc_html_e('Missing style sheet error when installing the theme','dfd-native') ?></h2>
					<div class="extra-content"><?php echo esc_html('A common issue that can occur with users new to installing WordPress themes is a "Broken theme and/or stylesheets missing” error message being displayed ','dfd-native').'<br>'.esc_html('when trying to upload or activate the theme. This error message does not mean that the theme you have purchased is broken, it simply means it has been ','dfd-native').'<br>'. esc_html('uploaded incorrectly.','dfd-native') ?> <a href="https://help.market.envato.com/hc/en-us/articles/202821510" title="<?php esc_attr_e('','dfd-native') ?>"><?php esc_html_e('Luckily, there is a very easy fix.','dfd-native') ?></a></div>
				</div>
			<!---->
			</div>
		<?php
		endif;
			/**
			 * action 'redux/page-after-sections-{opt_name}'
			 *
			 * @deprecated
			 *
			 * @param object $this ReduxFramework
			 */
			do_action( "redux/page-after-sections-{$this->parent->args['opt_name']}", $this ); // REMOVE LATER

			/**
			 * action 'redux/page/{opt_name}/sections/after'
			 *
			 * @param object $this ReduxFramework
			 */
			do_action( "redux/page/{$this->parent->args['opt_name']}/sections/after", $this );
		?>
		<div class="clear"></div>
		<!-- Footer Block -->
		<?php $this->get_template( 'footer.tpl.php' ); ?>
		<div id="redux-sticky-padder" style="display: none;">&nbsp;</div>
	</div>
	
</div>
	
<div class="clear"></div>