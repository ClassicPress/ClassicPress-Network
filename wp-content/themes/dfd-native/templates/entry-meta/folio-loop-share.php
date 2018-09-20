<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	$data_title = get_the_title();
	$data_link = get_permalink();
?>
<div class="entry-share-clickable-close">
	<a href="#"></a>
</div>
<ul class="entry-share-popup-folio" data-directory="<?php echo get_template_directory_uri(); ?>" style="display: none;">
	<li class="facebook-share">
		<a class="entry-share-link-facebook" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>" href="#">
			<i class="soc_icon-facebook main"></i>
			<i class="soc_icon-facebook appearable"></i>
		</a>
	</li>
	<li class="twitter-share">
		<a class="entry-share-link-twitter" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>" href="#">
			<i class="soc_icon-twitter-3 main"></i>
			<i class="soc_icon-twitter-3 appearable"></i>
		</a>
	</li>
	<li class="google-plus-share">
		<a class="entry-share-link-googleplus" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>" href="#">
			<i class="soc_icon-google__x2B_ main"></i>
			<i class="soc_icon-google__x2B_ appearable"></i>
		</a>
	</li>
	<li class="linkedin-share">
		<a class="entry-share-link-linkedin" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>" href="#">
			<i class="soc_icon-linkedin main"></i>
			<i class="soc_icon-linkedin appearable"></i>
		</a>
	</li>
</ul>