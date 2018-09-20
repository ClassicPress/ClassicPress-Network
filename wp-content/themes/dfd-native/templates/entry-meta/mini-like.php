<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

if(method_exists('Dfd_Theme_Helpers','getPostLikeLink')) {
	echo Dfd_Theme_Helpers::getPostLikeLink();
}