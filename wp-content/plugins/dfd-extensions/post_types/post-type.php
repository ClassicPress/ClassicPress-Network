<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

function dfd_custom_post_portfolio() {
	global $dfd_native;
	
    $labels = array(
        'name'               => esc_html__( 'Portfolios' , 'dfd-native' ),
        'singular_name'      => esc_html__( 'Portfolio' , 'dfd-native' ),
        'add_new'            => esc_html__( 'Add New' , 'dfd-native' ),
        'add_new_item'       => esc_html__( 'Add New Portfolio item' , 'dfd-native' ),
        'edit_item'          => esc_html__( 'Edit Portfolio item' , 'dfd-native' ),
        'new_item'           => esc_html__( 'New Portfolio item' , 'dfd-native' ),
        'all_items'          => esc_html__( 'All Portfolio items' , 'dfd-native' ),
        'view_item'          => esc_html__( 'View Portfolio item' , 'dfd-native' ),
        'search_items'       => esc_html__( 'Search Portfolios item' , 'dfd-native' ),
        'not_found'          => esc_html__( 'No products found' , 'dfd-native' ),
        'not_found_in_trash' => esc_html__( 'No products found in the Trash' , 'dfd-native' ),
        'parent_item_colon'  => '',
        'menu_name'          => esc_html__('Portfolios','dfd-native')
    );
    $args = array(
        'labels'        => $labels,
        'description'   => esc_html('Holds our portfolios and portfolio specific data','dfd-native'),
        'public'        => true,
        'supports'      => array( 'title', 'editor', 'author', 'thumbnail', 'sticky', 'comments', 'excerpt' ),
        'has_archive'   => true,
        'menu_icon'		=> '',
    );
	
	if(isset($dfd_native['portfolio_url_slug']) && !empty($dfd_native['portfolio_url_slug'])) {
		$args['rewrite'] = array('slug' => $dfd_native['portfolio_url_slug']);
	}
		
    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'dfd_custom_post_portfolio' );

function dfd_portfolio_updated_messages( $messages ) {
    global $post, $post_ID;
    $messages['portfolio'] = array(
        0 => '',
        1 => sprintf( esc_html__('Portfolio updated.','dfd-native').' <a href="%s">'.esc_html__('View product', 'dfd-native').'</a>', esc_url( get_permalink($post_ID) ) ),
        2 => esc_html__('Custom field updated.', 'dfd-native'),
        3 => esc_html__('Custom field deleted.', 'dfd-native'),
        4 => esc_html__('Portfolio updated.', 'dfd-native'),
        5 => isset($_GET['revision']) ? sprintf( esc_html__('Portfolio restored to revision from %s', 'dfd-native'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( esc_html__('Portfolio published.','dfd-native').' <a href="%s">'.esc_html__('View product', 'dfd-native').'</a>', esc_url( get_permalink($post_ID) ) ),
        7 => esc_html__('Portfolio saved.', 'dfd-native'),
        8 => sprintf( esc_html__('Portfolio submitted.','dfd-native').' <a target="_blank" href="%s">',esc_html__('Preview product','dfd-native').'</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( esc_html__('Portfolio scheduled for:','dfd-native').'<strong>'.esc_html__('%1$s.','dfd-native').'</strong> <a target="_blank" href="%2$s">'.esc_html__('Preview product', 'dfd-native').'</a>', date_i18n( esc_html__( 'M j, Y @ G:i', 'dfd-native' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( esc_html__('Portfolio draft updated.','dfd-native').'<a target="_blank" href="%s">'.esc_html__('Preview product', 'dfd-native').'</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );
    return $messages;
}
add_filter( 'post_updated_messages', 'dfd_portfolio_updated_messages' );

function dfd_portfolio_contextual_help( $contextual_help, $screen_id, $screen ) {
    if ( 'portfolio' == $screen->id ) {

        $contextual_help = '<h2>'.esc_html__('Portfolios','dfd-native').'</h2>
		<p>'.esc_html__('Portfolios show the details of the items that we sell on the website. You can see a list of them on this page in reverse chronological order - the latest one we added is first','dfd-native').'</p>
		<p>'.esc_html__('You can view/edit the details of each product by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items','dfd-native').'</p>';

    } elseif ( 'edit-product' == $screen->id ) {

        $contextual_help = '<h2>'.esc_html__('Editing products','dfd-native').'</h2>
		<p>'.esc_html__('This page allows you to view/modify product details. Please make sure to fill out the available boxes with the appropriate details (product image, price, brand) and <strong>not</strong> add these details to the product description','dfd-native').'</p>';

    }
    return $contextual_help;
}
add_action( 'contextual_help', 'dfd_portfolio_contextual_help', 10, 3 );

function dfd_taxonomies_portfolio() {
	global $dfd_native;
	
    $labels = array(
        'name'              => esc_html__( 'Portfolio Categories', 'dfd-native' ),
        'singular_name'     => esc_html__( 'Portfolio Category', 'dfd-native' ),
        'search_items'      => esc_html__( 'Search Portfolio Categories', 'dfd-native' ),
        'all_items'         => esc_html__( 'All Portfolio Categories', 'dfd-native' ),
        'parent_item'       => esc_html__( 'Parent Portfolio Category', 'dfd-native' ),
        'parent_item_colon' => esc_html__( 'Parent Portfolio Category:', 'dfd-native' ),
        'edit_item'         => esc_html__( 'Edit Portfolio Category', 'dfd-native' ),
        'update_item'       => esc_html__( 'Update Portfolio Category', 'dfd-native' ),
        'add_new_item'      => esc_html__( 'Add New Portfolio Category', 'dfd-native' ),
        'new_item_name'     => esc_html__( 'New Portfolio Category', 'dfd-native' ),
        'menu_name'         => esc_html__( 'Portfolio Categories', 'dfd-native' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,

    );
	if(isset($dfd_native['portfolio_url_slug']) && !empty($dfd_native['portfolio_url_slug'])) {
		$args['rewrite'] = array('slug' => $dfd_native['portfolio_url_slug'].'-category');
	}
	
     register_taxonomy( 'portfolio_category', 'portfolio', $args );
}
add_action( 'init', 'dfd_taxonomies_portfolio', 0 );

function dfd_portfolio_tags() {
    $labels = array(
        'name'              => esc_html__( 'Portfolio Tags', 'dfd-native' ),
        'singular_name'     => esc_html__( 'Portfolio Tag', 'dfd-native' ),
        'search_items'      => esc_html__( 'Search Portfolio Tags', 'dfd-native' ),
        'all_items'         => esc_html__( 'All Portfolio Tags', 'dfd-native' ),
        'edit_item'         => esc_html__( 'Edit Portfolio Tag', 'dfd-native' ),
        'update_item'       => esc_html__( 'Update Portfolio Tag', 'dfd-native' ),
        'add_new_item'      => esc_html__( 'Add New Portfolio Tag', 'dfd-native' ),
        'new_item_name'     => esc_html__( 'New Portfolio Tag', 'dfd-native' ),
        'menu_name'         => esc_html__( 'Portfolio Tags', 'dfd-native' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,

    );
	register_taxonomy( 'portfolio_tags', 'portfolio', $args );
}
add_action( 'init', 'dfd_portfolio_tags', 0 );

function gallery_post_type() {
    $labels = array(
        'name'               => esc_html__( 'Galleries' , 'dfd-native' ),
        'singular_name'      => esc_html__( 'Gallery' , 'dfd-native' ),
        'add_new'            => esc_html__( 'Add New' , 'dfd-native' ),
        'add_new_item'       => esc_html__( 'Add New Gallery item' , 'dfd-native' ),
        'edit_item'          => esc_html__( 'Edit Gallery item' , 'dfd-native' ),
        'new_item'           => esc_html__( 'New Gallery item' , 'dfd-native' ),
        'all_items'          => esc_html__( 'All Gallery items' , 'dfd-native' ),
        'view_item'          => esc_html__( 'View Gallery item' , 'dfd-native' ),
        'search_items'       => esc_html__( 'Search Galleries item' , 'dfd-native' ),
        'not_found'          => esc_html__( 'No Galleries found' , 'dfd-native' ),
        'not_found_in_trash' => esc_html__( 'No Galleries found in the Trash' , 'dfd-native' ),
        'parent_item_colon'  => '',
        'menu_name'          => esc_html__('Galleries', 'dfd-native')
    );
    $args = array(
        'labels'        => $labels,
        'description'   => esc_html__('Holds your gallery images','dfd-native'),
        'public'        => true,
        'supports'      => array( 'title', 'author', 'thumbnail', 'sticky', 'comments' ),
        'has_archive'   => true,
        'menu_icon'		=> '',
    );
    register_post_type( 'gallery', $args );
}
add_action( 'init', 'gallery_post_type' );

function gallery_updated_messages( $messages ) {
    global $post, $post_ID;
    $messages['gallery'] = array(
        0 => '',
        1 => sprintf( esc_html__('Gallery updated.','dfd-native').' <a href="%s">'.esc_html__('View gallery','dfd-native').'</a>', esc_url( get_permalink($post_ID) ) ),
        2 => esc_html__('Custom field updated.', 'dfd-native'),
        3 => esc_html__('Custom field deleted.', 'dfd-native'),
        4 => esc_html__('Gallery updated.', 'dfd-native'),
        5 => isset($_GET['revision']) ? sprintf( esc_html__('Gallery restored to revision from %s', 'dfd-native'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( esc_html__('Gallery published.','dfd-native').' <a href="%s">'.esc_html__('View gallery','dfd-native').'</a>', esc_url( get_permalink($post_ID) ) ),
        7 => esc_html__('Gallery saved.', 'dfd-native'),
        8 => sprintf( esc_html__('Gallery submitted. <a target="_blank" href="%s">Preview gallery</a>', 'dfd-native'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( esc_html__('Gallery scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview gallery</a>', 'dfd-native'), date_i18n( esc_html__( 'M j, Y @ G:i', 'dfd-native' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( esc_html__('Gallery draft updated.','dfd-native').' <a target="_blank" href="%s">'.esc_html__('Preview gallery','dfd-native').'</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );
    return $messages;
}
add_filter( 'post_updated_messages', 'gallery_updated_messages' );

function gallery_contextual_help( $contextual_help, $screen_id, $screen ) {
    if ( 'gallery' == $screen->id ) {

        $contextual_help = '<h2>'.esc_html__('Galleries','dfd-native').'</h2>
		<p>'.esc_html__('Galleries show the details of the items that we sell on the website. You can see a list of them on this page in reverse chronological order - the latest one we added is first.','dfd-native').'</p>
		<p>'.esc_html__('You can view/edit the details of each gallery by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items.','dfd-native').'</p>';

    } elseif ( 'edit-gallery' == $screen->id ) {

        $contextual_help = '<h2>'.esc_html__('Editing galleries','dfd-native').'</h2>
		<p>'.esc_html__('This page allows you to view/modify product details. Please make sure to fill out the available boxes with the appropriate details (product image, price, brand) and <strong>not</strong> add these details to the product description.','dfd-native').'</p>';

    }
    return $contextual_help;
}
add_action( 'contextual_help', 'gallery_contextual_help', 10, 3 );

function gallery_taxonomies() {
    $labels = array(
        'name'              => esc_html__( 'Gallery Categories', 'dfd-native' ),
        'singular_name'     => esc_html__( 'Gallery Category', 'dfd-native' ),
        'search_items'      => esc_html__( 'Search Gallery Categories', 'dfd-native' ),
        'all_items'         => esc_html__( 'All Gallery Categories', 'dfd-native' ),
        'parent_item'       => esc_html__( 'Parent Gallery Category', 'dfd-native' ),
        'parent_item_colon' => esc_html__( 'Parent Gallery Category:', 'dfd-native' ),
        'edit_item'         => esc_html__( 'Edit Gallery Category', 'dfd-native' ),
        'update_item'       => esc_html__( 'Update Gallery Category', 'dfd-native' ),
        'add_new_item'      => esc_html__( 'Add New Gallery Category', 'dfd-native' ),
        'new_item_name'     => esc_html__( 'New Gallery Category', 'dfd-native' ),
        'menu_name'         => esc_html__( 'Gallery Categories', 'dfd-native' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,

    );
    register_taxonomy( 'gallery_category', 'gallery', $args );
}
add_action( 'init', 'gallery_taxonomies', 0 );

function dfd_gallery_tags() {
    $labels = array(
        'name'              => esc_html__( 'Gallery Tags', 'dfd-native' ),
        'singular_name'     => esc_html__( 'Gallery Tag', 'dfd-native' ),
        'search_items'      => esc_html__( 'Search Gallery Tags', 'dfd-native' ),
        'all_items'         => esc_html__( 'All Gallery Tags', 'dfd-native' ),
        'edit_item'         => esc_html__( 'Edit Gallery Tag', 'dfd-native' ),
        'update_item'       => esc_html__( 'Update Gallery Tag', 'dfd-native' ),
        'add_new_item'      => esc_html__( 'Add New Gallery Tag', 'dfd-native' ),
        'new_item_name'     => esc_html__( 'New Gallery Tag', 'dfd-native' ),
        'menu_name'         => esc_html__( 'Gallery Tags', 'dfd-native' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
    );
    register_taxonomy( 'gallery_tags', 'gallery', $args );
}
add_action( 'init', 'dfd_gallery_tags', 0 );

if(!class_exists('Dfd_Taxonomies_Custom_Fields')) {
	/**
	 * Taxonomy custom elements
	 *
	 *
	 * @class 		Dfd_Taxonomies_Custom_Fields
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 */
	class Dfd_Taxonomies_Custom_Fields {
		
		/** @var array Post types list. */
		var $taxonomies = array('','portfolio_','gallery_');
		
		/**
		 * Constructor.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		function __construct() {
			add_action('admin_enqueue_scripts',array($this,'dfd_post_cat_reqister_scripts'));
			foreach($this->taxonomies as $tax) {
				add_action($tax.'category_add_form_fields',array($this,'dfd_taxonomy_add_new_meta_field'));
				add_action($tax.'category_edit_form_fields',array($this,'dfd_taxonomy_edit_meta_field'));
				add_action('edited_'.$tax.'category',array($this,'save_taxonomy_custom_meta'));
				add_action('create_'.$tax.'category',array($this,'save_taxonomy_custom_meta'));
			}
		}
		
		/**
		 * Fields html for add taxonomy section
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		function dfd_taxonomy_add_new_meta_field() {
			?>
			<div class="form-field">
				<label for="term_meta[custom_term_meta]"><?php esc_html_e( 'Category&#0146;s icon', 'dfd-native' ); ?></label>
				<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" class="iconname" value="" style="width:50%;" />
				<a href="#" class="updateButton crum-icon-add"><?php esc_html_e('Add Icon', 'dfd-native'); ?></a>
			</div>
			<div class="form-field">
				<label for="term_meta[custom_term_meta_color]"><?php esc_html_e( 'Category&#0146;s color', 'dfd-native' ); ?></label>
				<input type="text" id="dfd-category-colorpicker" name="term_meta[custom_term_meta_color]" value="" />
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						$("#dfd-category-colorpicker").wpColorPicker();
					});
				</script>
			</div>
		<?php
		}
		
		/**
		 * Fields html for edit taxonomy section
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		function dfd_taxonomy_edit_meta_field($term) {
			$t_id = $term->term_id;

			$term_meta = get_option( "taxonomy_$t_id" ); ?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php esc_html_e( 'Category&#0146;s icon', 'dfd-native' ); ?></label></th>
				<td>
					<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" class="iconname" value="<?php echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : ''; ?>" style="width:50%;" />
					<a href="#" class="updateButton crum-icon-add"><?php esc_html_e('Add Icon', 'dfd-native'); ?></a>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="term_meta[custom_term_meta_color]"><?php esc_html_e( 'Category&#0146;s color', 'dfd-native' ); ?></label></th>
				<td>
					<input type="text" id="dfd-category-colorpicker" name="term_meta[custom_term_meta_color]" value="<?php echo esc_attr( $term_meta['custom_term_meta_color'] ) ? esc_attr( $term_meta['custom_term_meta_color'] ) : ''; ?>" />
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							$("#dfd-category-colorpicker").wpColorPicker();
						});
					</script>
				</td>
			</tr>
		<?php
		}
		
		/**
		 * Save taxonomy actions
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		function save_taxonomy_custom_meta( $term_id ) {
			if ( isset( $_POST['term_meta'] ) ) {
				$t_id = $term_id;
				$term_meta = get_option( "taxonomy_$t_id" );
				$cat_keys = array_keys( $_POST['term_meta'] );
				foreach ( $cat_keys as $key ) {
					if ( isset ( $_POST['term_meta'][$key] ) ) {
						$term_meta[$key] = $_POST['term_meta'][$key];
					}
				}
				update_option( "taxonomy_$t_id", $term_meta );
			}
		}
		
		/**
		 * Enqueue scripts
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		function dfd_post_cat_reqister_scripts() {
			wp_enqueue_script('wp-color-picker');
			wp_enqueue_style('wp-color-picker');
		}
	}
	
	$Dfd_Taxonomies_Custom_Fields = new Dfd_Taxonomies_Custom_Fields();
}