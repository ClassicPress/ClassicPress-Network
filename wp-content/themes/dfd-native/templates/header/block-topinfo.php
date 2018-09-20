<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_native;
if (isset($dfd_native['top_adress_field']) && $dfd_native['top_adress_field']): ?>
	<div class="dfd-header-top-info"><?php echo wp_kses($dfd_native['top_adress_field'], array(
		'span' => array(
			'class' => array(),
		),
		'i' => array(
			'class' => array(),
		),
		'strong' => array(),
		'br' => array(),
		'a' => array(
			'class' => array(),
			'href' => array(),
			'mailto' => array(),
			'callto'  => array()
		)
	)); ?></div>
<?php endif;
