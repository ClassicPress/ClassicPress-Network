<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(get_template_directory().'/inc/widgets/widget.php');

class dfd_login_widget extends SB_WP_Widget {
	
	protected $widget_base_id = 'dfd_login_widget';
	protected $widget_name = 'Custom: Login';
	
	protected $options;
	
	function __construct() {
		$this->widget_args = array(
			'description' => esc_html__('Displays login form', 'dfd-native')
		);
		
		$this->options = array(
			array(
				'title', 'text', '',
				'label'		=> esc_html__('Title', 'dfd-native'),
				'input'		=> 'text',
				'filters'	=> 'widget_title',
				'on_update'	=> 'esc_attr'
			),
		);
		parent::__construct();
	}
	
	function widget($args, $instance) {
		extract( $args );
		$this->setInstances($instance, 'filter');
		
		$title = $this->getInstance('title');
		
		$login_form_args = array(
			'label_log_in' => esc_html__('Sign in', 'dfd-native'),
			'label_lost_password' => esc_html__('Forgot password?', 'dfd-native'),
		);
		
		echo wp_kses( $before_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );
		
        echo (!empty($title)) ? ( $before_title . $title . $after_title ) : '';
		
		if (is_user_logged_in()) {
			$this->logout_form();
		} else {
			$this->wp_login_form($login_form_args);
		}
		
		echo wp_kses( $after_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );
	}
	
	function lost_password( $args ) {
		
		return '<p class="login-lost-password"><label>&nbsp;&nbsp;'
			. '<a href="' . wp_lostpassword_url() . '">'.esc_html__('I lost my password', 'dfd-native').'</a>'
			. '</label></p>';
	}
	
	function wp_login_form( $args = array() ) {
		$defaults = array(
			'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], // Default redirect is back to the current page
			'form_id' => uniqid('loginform_'),
			'label_username' => esc_html__( 'Your email', 'dfd-native' ),
			'placeholder_username' => esc_html__( 'Login', 'dfd-native' ),
			'label_password' => esc_html__( 'Your password', 'dfd-native' ),
			'placeholder_password' => esc_html__( 'Password', 'dfd-native' ),
			'label_remember' => esc_html__( 'Remember Me', 'dfd-native' ),
			'label_lost_password' => esc_html__( 'Remind the password', 'dfd-native' ),
			'label_log_in' => esc_html__( 'Log In', 'dfd-native' ),
			'id_username' => uniqid('user_login_'),
			'id_password' => uniqid('user_pass_'),
			'id_remember' => uniqid('rememberme_'),
			'id_lost_password' => uniqid('rememberme_'),
			'id_submit' => uniqid('wp-submit_'),
			'remember' => true,
			'lost_password' => true,
			'value_username' => '',
			'value_remember' => false, // Set this to true to default the "Remember me" checkbox to checked
		);
		$args = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );

		$registration_link = '';

		if (get_option('users_can_register')) {
			$registration_link = '
				<p class="clear delim-line text-center dfd-widget-list-content">'.esc_html__('or', 'dfd-native').'</p>
				<div class="title-registration text-center">
					<span class="title-registration dfd-widget-list-content">'. esc_html__("Don't have an account?", 'dfd-native') .'</span>
					<a href="'.wp_registration_url() .'" class="button registration">'. esc_html__('Sign up for free', 'dfd-native') .'</a>
				</div>
			';
		}

		echo '
			<form name="' . $args['form_id'] . '" id="' . $args['form_id'] . '" action="' . esc_url( site_url( 'wp-login.php', 'login_post' ) ) . '" method="post">
				
				<p class="login-username">
					<label for="' . esc_attr( $args['id_username'] ) . '" class="dfd-widget-content-title">' . esc_html( $args['label_username'] ) . '</label>
					<input type="text" name="log" id="' . esc_attr( $args['id_username'] ) . '" class="input" value="' . esc_attr( $args['value_username'] ) . '" size="20" />
				</p>
				
				<p class="login-password">
					<label for="' . esc_attr( $args['id_password'] ) . '" class="dfd-widget-content-title">' . esc_html( $args['label_password'] ) . '</label>
					<input type="password" name="pwd" id="' . esc_attr( $args['id_password'] ) . '" class="input" value="" size="20" />
				</p>
				
				<p class="login-submit text-center">
					<button type="submit" name="wp-submit" id="' . esc_attr( $args['id_submit'] ) . '" class="button">' .esc_attr( $args['label_log_in'] ). '</button>
					<input type="hidden" name="redirect_to" value="' . esc_url( $args['redirect'] ) . '" />
				</p>
				
				'. ( $args['remember'] ? '<p class="login-remember"><label><input name="rememberme" type="checkbox" id="' . esc_attr( $args['id_remember'] ) . '" value="forever"' . ( $args['value_remember'] ? ' checked="checked"' : '' ) . ' /> ' . esc_html( $args['label_remember'] ) . '</label></p>' : '' )
				 . ( $args['lost_password'] ? '<p class="login-lost-password text-center"><label>'
						. '<a href="' . wp_lostpassword_url() . '" class="dfd-widget-list-content">' . $args['label_lost_password'] . '</a></label></p>' : '' )
				. $registration_link 
				.apply_filters( 'login_form_bottom', '', $args ) . '
			</form>';
	}
	
	function logout_form() {
		$current_user = wp_get_current_user();
		$user = $current_user->user_firstname;
		$logIn = $current_user->user_login;
		$name = $logIn;
		if(isset($user) && !empty($user)) {
			$name = $user;
		}
		echo '<div class="login-logout text-center"><p class="login-user dfd-widget-list-content">'.esc_html__('You are logged in as','dfd-native').' '.esc_html($name).'</p><a class="button" href="'.esc_url(wp_logout_url()).'"><i class="outlinedicon-lock-open"></i>'.esc_html__('Logout','dfd-native').'</a></div>';
	}
}
