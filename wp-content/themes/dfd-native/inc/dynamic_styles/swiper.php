<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output .= '.dfd-portfolio-module.layout-fullscreen .swiper-navigation-wrap .dfd-swiper-nav,'
		. '.dfd-gallery-module.layout-fullscreen .swiper-navigation-wrap .dfd-swiper-nav {border-color: '.$vars['main_site_color'].';}';

$output .= '.dfd-portfolio-module.layout-fullscreen .swiper-navigation-wrap .dfd-swiper-nav:hover,'
		. '.dfd-gallery-module.layout-fullscreen .swiper-navigation-wrap .dfd-swiper-nav:hover {background: '.$vars['main_site_color'].';}';