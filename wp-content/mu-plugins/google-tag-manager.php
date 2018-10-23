<?php

/**
 * Add Google Tag Manager, including on Elementor Canvas pages
 */
add_action( 'wp_head', 'cpnet_add_google_tag_manager_head', 0 );
add_action(
	'elementor/page_templates/canvas/before_content',
	'cpnet_add_google_tag_manager_body'
);

function cpnet_add_google_tag_manager_head () {
    ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-T88732G');</script>
    <?php
}

function cpnet_add_google_tag_manager_body () {
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T88732G"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
}
