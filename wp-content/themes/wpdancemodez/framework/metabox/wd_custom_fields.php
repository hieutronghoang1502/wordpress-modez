<?php 
if (!class_exists('Tvlgiao_Wpdance_Admin_General_CustomFields')) {
	class Tvlgiao_Wpdance_Admin_General_CustomFields extends Tvlgiao_Wpdance_Admin_GeneralTheme {
		/**
		 * Refers to a single instance of this class.
		 */
		private static $instance = null;

		public static function get_instance() {
			if ( null == self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function __construct(){
			add_action("add_meta_boxes", array($this,"tvlgiao_wpdance_generate_customfields"));
			add_action('pre_post_update', array($this,'tvlgiao_wpdance_save_customfield'), 10, 2);
		}
		public function tvlgiao_wpdance_generate_customfields(){
			$list_meta_box = array(
				//Post Blog
				array(
					'id' 		=> 'wp_cp_custom_post_layout',
					'title'		=> esc_html__("POST CONFIGURATION", 'wpdancelaparis'),
					'callback' 	=> array($this,"tvlgiao_wpdance_post_layout"),
					'page'		=> 'post',
					'context'	=> 'side',
					'priority'	=> 'high',
				),
				//Page
				array(
					'id' 		=> 'wp_cp_custom_page_atts',
					'title'		=> esc_html__("PAGE CONFIGURATION", 'wpdancelaparis'),
					'callback' 	=> array($this, 'tvlgiao_wpdance_page_configuration'),
					'page'		=> 'page',
					'context'	=> 'side',
					'priority'	=> 'high',
				),
				//Product
				array(
					'id' 		=> 'wp_cp_custom_product_layout',
					'title'		=> esc_html__("PRODUCT CONFIGURATION", 'wpdancelaparis'),
					'callback' 	=> array($this,"tvlgiao_wpdance_product_configuration"),
					'page'		=> 'product',
					'context'	=> 'side',
					'priority'	=> 'high',
				),
				
			);
			foreach ($list_meta_box as $meta_box) {
				add_meta_box($meta_box['id'], $meta_box['title'], $meta_box['callback'], $meta_box['page'], $meta_box['context'], $meta_box['priority']);
				add_filter( "postbox_classes_{$meta_box['page']}_{$meta_box['id']}", array($this,"tvlgiao_wpdance_meta_box_custom_class") );
			}
		}
		// Render
		public function tvlgiao_wpdance_post_layout(){
			require_once TVLGIAO_WPDANCE_THEME_METABOX.'/metaboxes/wd_custom_post_layout.php';
		}
		public function tvlgiao_wpdance_page_configuration(){
			require_once TVLGIAO_WPDANCE_THEME_METABOX.'/metaboxes/wd_custom_page_layout.php';
		}
		public function tvlgiao_wpdance_product_configuration(){
			require_once TVLGIAO_WPDANCE_THEME_METABOX.'/metaboxes/wd_custom_product_layout.php';
		}

		// Save Custom
		public function tvlgiao_wpdance_save_customfield($post_id){
			// Bail if we're doing an auto save
		    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		     
		    // if our nonce isn't there, or we can't verify it, bail
		    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
		     
		    // if our current user can't edit this post, bail
		    if( !current_user_can( 'edit_post' ) ) return;
			/*--------------------------------------------------------------------------*/
			/*						 SAVE CUSTOM POST LAYOUT 							*/
			/*--------------------------------------------------------------------------*/		
			// Save post custom layout & sidebar and Media
			if( isset($_POST['custom_post_layout']) && $_POST['custom_post_layout'] == "custom_single_post_layout" ){
				// Header
				if (isset($_POST['wpdance_custom_header'])){
					update_post_meta($post_id, '_tvlgiao_wpdance_custom_header', intval($_POST['wpdance_custom_header']));
				}
				// Footer
				if (isset($_POST['wpdance_custom_footer'])){
					update_post_meta($post_id, '_tvlgiao_wpdance_custom_footer', intval($_POST['wpdance_custom_footer']));
				}
				$_post_config = array(
					'layout' 				=> $_POST['single_layout'],
					'style_breadcrumb'		=> $_POST['style_breadcrumb_name'],
					'wd_breadcrumb_url_img'	=> $_POST['wd_breadcrumb_url_img'],
				);
				$ret_str = serialize($_post_config);
				update_post_meta($post_id,'_tvlgiao_wpdance_custom_post_config',$ret_str);	
			}
			/*--------------------------------------------------------------------------*/
			/*						 SAVE CUSTOM PAGE LAYOUT 							*/
			/*--------------------------------------------------------------------------*/
			// Custom footer and header page layout
			if( isset($_POST['custom_page_header_footer']) && $_POST['custom_page_header_footer'] == "page_header_footer" ){
				// Header
				if (isset($_POST['wpdance_custom_header'])){
					update_post_meta($post_id, '_tvlgiao_wpdance_custom_header', intval($_POST['wpdance_custom_header']));
				}
				// Footer
				if (isset($_POST['wpdance_custom_footer'])){
					update_post_meta($post_id, '_tvlgiao_wpdance_custom_footer', intval($_POST['wpdance_custom_footer']));
				}
				$_default_page_config = array(
					'layout' 				=> $_POST['single_layout'],
					'style_breadcrumb'		=> $_POST['style_breadcrumb_name'],
					'wd_breadcrumb_url_img'	=> $_POST['wd_breadcrumb_url_img'],
				);
				$ret_str = serialize($_default_page_config);
				update_post_meta($post_id,'_tvlgiao_wpdance_custom_page_config',$ret_str);				
			}

			/*--------------------------------------------------------------------------*/
			/*						 SAVE CUSTOM PRODUCT LAYOUT 						*/
			/*--------------------------------------------------------------------------*/
			if( isset($_POST['custom_product_layout']) && $_POST['custom_product_layout'] == "custom_single_product_layout" ){
				// Header
				if (isset($_POST['wpdance_custom_header'])){
					update_post_meta($post_id, '_tvlgiao_wpdance_custom_header', intval($_POST['wpdance_custom_header']));
				}
				// Footer
				if (isset($_POST['wpdance_custom_footer'])){
					update_post_meta($post_id, '_tvlgiao_wpdance_custom_footer', intval($_POST['wpdance_custom_footer']));
				}
				$_default_product_config = array(
					'layout' 				=> $_POST['single_layout'],
					'style_breadcrumb'		=> $_POST['style_breadcrumb_name'],
					'wd_breadcrumb_url_img'	=> $_POST['wd_breadcrumb_url_img'],
				);
				//Gallery
				$ret_str = serialize($_default_product_config);
				update_post_meta($post_id,'_tvlgiao_wpdance_custom_product_config',$ret_str);	
			}	
		}

		//Add class closed to metabox
		public function tvlgiao_wpdance_meta_box_custom_class( $classes ) {
			array_push( $classes, 'closed' );
			return $classes;
		}
	}
	Tvlgiao_Wpdance_Admin_General_CustomFields::get_instance();
}
?>