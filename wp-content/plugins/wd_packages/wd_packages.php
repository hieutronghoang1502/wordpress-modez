<?php 
/*
  Plugin Name: WD Packages
  Plugin URI: http://www.wpdance.com
  Description: Register Post type, taxonomy, style and script library used for WD Team packages ...
  Version: 1.0.0
  Author: WD Team
  Author URI: http://www.wpdance.com
 */
if (!class_exists('WD_Packages')) {
	class WD_Packages {
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

		protected $arr_packages = array(
				'wd_shortcode' 		=> '1',
				'wd_portfolio' 		=> '1',
				'wd_team' 			=> '1',
				'wd_quickshop' 		=> '1',
				'wd_shop_by_color' 	=> '1',
			);

		public function __construct(){
			$this->constant();
			$this->tvlgiao_wpdance_package_get_packages_setting();
			add_action('init', array($this, 'package_setup'));
			$this->package_include();
			add_action('wp_enqueue_scripts', array($this, 'smooth_scroll'));
		}

		protected function constant(){
			define('WD_PACKAGE'			,   plugin_dir_path( __FILE__ ) );
			define('WD_PACKAGE_URI'		,   plugins_url( '', __FILE__ ) );
			define('WD_PACKAGE_ASSETS'	,   WD_PACKAGE_URI.'/assets' );
			define('WD_PACKAGE_CSS'		,  	WD_PACKAGE_ASSETS.'/css' );
			define('WD_PACKAGE_JS'		,  	WD_PACKAGE_ASSETS.'/js' );
		}

		protected function tvlgiao_wpdance_package_get_packages_setting(){
			if (get_option('wd_packages')) {
				$parkages = get_option('wd_packages');
				if (!empty($parkages['verify_submit'])) {
					$this->arr_packages = array(
						'wd_shortcode' 		=> (!empty($parkages['wd_package_shortcode'])) ? $parkages['wd_package_shortcode'] : '',
						'wd_portfolio' 		=> (!empty($parkages['wd_package_portfolio'])) ? $parkages['wd_package_portfolio'] : '',
						'wd_team' 			=> (!empty($parkages['wd_package_team'])) ? $parkages['wd_package_team'] : '',
						'wd_quickshop' 		=> (!empty($parkages['wd_package_quickshop'])) ? $parkages['wd_package_quickshop'] : '',
						'wd_shop_by_color' 	=> (!empty($parkages['wd_package_shop_by_color'])) ? $parkages['wd_package_shop_by_color'] : '',
					);
				}
			}
		}

		public function smooth_scroll(){
			if(!wp_is_mobile()) { 
				if($this->tvlgiao_wpdance_is_windows() && $this->tvlgiao_wpdance_is_chrome()) {
					wp_enqueue_script( 'tvlgiao-wpdance-smooth-scroll', WD_PACKAGE_JS.'/smoothScroll.js',false,false,true);
				}
			}
		}

		public function package_setup(){ 
			$this->register_html_block_post_type();
			$this->admin_page_include();
		} 

		public function admin_page_include(){
			if(file_exists(WD_PACKAGE."/admin_page/admin_page.php")){
				require_once WD_PACKAGE."/admin_page/admin_page.php";
			}
		}

		public function package_include(){
			foreach ($this->arr_packages as $package => $display) {
				if(file_exists(WD_PACKAGE."/{$package}/{$package}.php") && $display == '1'){
					require_once WD_PACKAGE."/{$package}/{$package}.php";
				}
			}
		}

		/******************************** HTML BLOCK POST TYPE ***********************************/
		public function register_html_block_post_type(){
			register_post_type('wpdance_header', array(
				'exclude_from_search' => true,
				'labels' => array(
					'name' 					=> esc_html__("Headers HTML", 'wpdancelaparis'),
					'singular_name' 		=> esc_html__("Header HTML", 'wpdancelaparis'),
		        	'add_new' 				=> esc_html__( 'Add New', 'wpdancelaparis' ),
					'add_new_item' 			=> sprintf( __( 'Add New %s', 'wpdancelaparis' ), __( 'Header HTML', 'wpdancelaparis' ) ),
					'edit_item' 			=> sprintf( __( 'Edit %s', 'wpdancelaparis' ), __( 'Header HTML', 'wpdancelaparis' ) ),
					'new_item' 				=> sprintf( __( 'New %s', 'wpdancelaparis' ), __( 'Header HTML', 'wpdancelaparis' ) ),
					'all_items' 			=> sprintf( __( 'All %s', 'wpdancelaparis' ), __( 'Headers HTML', 'wpdancelaparis' ) ),
					'view_item' 			=> sprintf( __( 'View %s', 'wpdancelaparis' ), __( 'Header HTML', 'wpdancelaparis' ) ),
					'search_items' 			=> sprintf( __( 'Search %a', 'wpdancelaparis' ), __( 'Headers HTML', 'wpdancelaparis' ) ),
					'not_found' 			=>  sprintf( __( 'No %s Found', 'wpdancelaparis' ), __( 'Headers HTML', 'wpdancelaparis' ) ),
					'not_found_in_trash' 	=> sprintf( __( 'No %s Found In Trash', 'wpdancelaparis' ), __( 'Headers HTML', 'wpdancelaparis' ) ),
				),
				'public' 				=> true,
				'has_archive' 			=> false,
				'menu_icon'				=> 'dashicons-editor-table',
				'menu_position'			=> 21,
			));
			register_post_type('wpdance_footer', array(
				'exclude_from_search' => true,
				'labels' => array(
					'name' 					=> esc_html__("Footers HTML", 'wpdancelaparis'),
					'singular_name' 		=> esc_html__("Footer HTML", 'wpdancelaparis'),
		        	'add_new' 				=> esc_html__( 'Add New', 'wpdancelaparis' ),
					'add_new_item' 			=> sprintf( __( 'Add New %s', 'wpdancelaparis' ), __( 'Footer HTML', 'wpdancelaparis' ) ),
					'edit_item' 			=> sprintf( __( 'Edit %s', 'wpdancelaparis' ), __( 'Footer HTML', 'wpdancelaparis' ) ),
					'new_item' 				=> sprintf( __( 'New %s', 'wpdancelaparis' ), __( 'Footer HTML', 'wpdancelaparis' ) ),
					'all_items' 			=> sprintf( __( 'All %s', 'wpdancelaparis' ), __( 'Footers HTML', 'wpdancelaparis' ) ),
					'view_item' 			=> sprintf( __( 'View %s', 'wpdancelaparis' ), __( 'Footer HTML', 'wpdancelaparis' ) ),
					'search_items' 			=> sprintf( __( 'Search %a', 'wpdancelaparis' ), __( 'Footers HTML', 'wpdancelaparis' ) ),
					'not_found' 			=>  sprintf( __( 'No %s Found', 'wpdancelaparis' ), __( 'Footers HTML', 'wpdancelaparis' ) ),
					'not_found_in_trash' 	=> sprintf( __( 'No %s Found In Trash', 'wpdancelaparis' ), __( 'Footers Template', 'wpdancelaparis' ) ),
				),
				'public' 				=> true,
				'has_archive' 			=> false,
				'menu_icon'				=> 'dashicons-editor-table',
				'menu_position'			=> 21,
			));
			add_post_type_support( 'wpdance_header', 'thumbnail' );
			add_post_type_support( 'wpdance_footer', 'thumbnail' );

			/*if (!post_type_exists('wpdance_html')) {
				register_post_type('wpdance_html', array(
					'exclude_from_search' => true,
					'labels' => array(
						'name' 					=> esc_html__("HTML Blocks", 'wpdancelaparis'),
						'singular_name' 		=> esc_html__("HTML Block", 'wpdancelaparis'),
			        	'add_new' 				=> esc_html__( 'Add New', 'wpdancelaparis' ),
						'add_new_item' 			=> sprintf( __( 'Add New %s', 'wpdancelaparis' ), __( 'HTML Block', 'wpdancelaparis' ) ),
						'edit_item' 			=> sprintf( __( 'Edit %s', 'wpdancelaparis' ), __( 'HTML Block', 'wpdancelaparis' ) ),
						'new_item' 				=> sprintf( __( 'New %s', 'wpdancelaparis' ), __( 'HTML Block', 'wpdancelaparis' ) ),
						'all_items' 			=> sprintf( __( 'All %s', 'wpdancelaparis' ), __( 'HTML Blocks', 'wpdancelaparis' ) ),
						'view_item' 			=> sprintf( __( 'View %s', 'wpdancelaparis' ), __( 'HTML Block', 'wpdancelaparis' ) ),
						'search_items' 			=> sprintf( __( 'Search %a', 'wpdancelaparis' ), __( 'HTML Blocks', 'wpdancelaparis' ) ),
						'not_found' 			=>  sprintf( __( 'No %s Found', 'wpdancelaparis' ), __( 'HTML Blocks', 'wpdancelaparis' ) ),
						'not_found_in_trash' 	=> sprintf( __( 'No %s Found In Trash', 'wpdancelaparis' ), __( 'HTML Blocks', 'wpdancelaparis' ) ),
					),
					'taxonomies' 			=> array('wpdance_category_html'),
					'public' 				=> true,
					'has_archive' 			=> false,
					'menu_icon'				=> 'dashicons-editor-table',
					'menu_position'			=> 21,
				));



				register_taxonomy( 'wpdance_category_html', 'wpdance_html', array(
					'hierarchical'      => true,
					'labels'            => array(
						'name' 				=> esc_html__('Categories HTML', 'wpdancelaparis'),
						'singular_name' 	=> esc_html__('Categories HTML', 'wpdancelaparis'),
			        	'new_item'          => esc_html__('Add New', 'wpdancelaparis' ),
			        	'edit_item'         => esc_html__('Edit Post', 'wpdancelaparis' ),
			        	'view_item'   		=> esc_html__('View Post', 'wpdancelaparis' ),
			        	'add_new_item'      => esc_html__('Add New Category HTML', 'wpdancelaparis' ),
			        	'menu_name'         => esc_html__( 'Categories HTML' , 'wpdancelaparis' ),
					),
					'show_ui'           	=> true,
					'show_admin_column' 	=> true,
					'query_var'         	=> true,
					'rewrite'           	=> array( 'slug' => 'wpdance_category_html' ),				
					'public'				=> true,
				));

				
				add_theme_support('post-thumbnails');
				add_post_type_support( 'wpdance_html', 'thumbnail' );
				
				$term_header = term_exists( 'wpdance_header_layout', 'wpdance_category_html' );
				if ( $term_header == 0 && $term_header == null ) {
				    wp_insert_term( esc_html__('Header', 'wpdancelaparis') , 'wpdance_category_html', array(
				    	'description'		=> esc_html__('Layout Header','wpdancelaparis'),
				    	'slug' 				=> 'wpdance_header_layout'
						));
				}
				

				$term_footer = term_exists( 'wpdance_footer_layout', 'wpdance_category_html' );
				if ( $term_header == 0 && $term_header == null ) {
					wp_insert_term( esc_html__('Footer', 'wpdancelaparis') , 'wpdance_category_html', array(
				    'description'		=> esc_html__('Layout Footer','wpdancelaparis'),
				    'slug' 				=> 'wpdance_footer_layout'
					));
				}
			}*/
		}

		public function tvlgiao_wpdance_is_windows(){
			$u = $_SERVER['HTTP_USER_AGENT'];
			$window  = (bool)preg_match('/Windows/i', $u );
			return $window;
		}
		public function tvlgiao_wpdance_is_chrome(){
			$u = $_SERVER['HTTP_USER_AGENT'];
			$chrome  = (bool)preg_match('/Chrome/i', $u );
			return $chrome;
		}
	}
	WD_Packages::get_instance();
}
?>