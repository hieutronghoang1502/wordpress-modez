<?php
if (!class_exists('WD_Shortcode')) {
	class WD_Shortcode{
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

		protected $parkage_name 		= '/wd_shortcode';
		protected $arrShortcodes 		= array();
		protected $arrVisualcomposer 	= array();
		protected $arrWidgets 			= array();
		protected $include_data 	= array(
						'faq_post_type' 		=> 1,
						'feature_post_type' 	=> 1,
						'widget'				=> 1,	
					);

		public function __construct(){
			$this->constant();
			$this->tvlgiao_wpdance_package_get_packages_setting();
			
			// Register Faq post type & taxonomy
			if ($this->include_data['faq_post_type']) {
				add_action('init', array($this, 'tvlgiao_wpdance_register_faq_post_type'));
				add_action('vc_before_init', array( $this, 'tvlgiao_wpdance_register_faq_taxonomy' ) );
			}
			// Register Feature post type & taxonomy
			if ($this->include_data['feature_post_type']) {
				add_action('init', array($this, 'tvlgiao_wpdance_register_feature_post_type'));
				add_action('vc_before_init', array( $this, 'tvlgiao_wpdance_register_feature_taxonomy' ) );
			}
			
			add_action('admin_menu', array( $this,'wd_feature_add_meta_box' ) );	
			add_action('save_post', array($this,'wd_feature_save_data') , 1, 2);
			// Register Script
			add_action('wp_enqueue_scripts', array( $this, 'init_script' ));
			add_action('wp_enqueue_scripts', array( $this, 'set_ajax_url' ));
			add_action('admin_enqueue_scripts', array( $this, 'admin_init_script' ));

			$this->initLibrary();
			$this->initArrShortcodes();
			$this->initArrRegisterVC(); 
			$this->initArrWidgets(); 

			//Widgets
			if ($this->include_data['widget']) {
				$this->initWidgets(); 
			}

			//Visual Composer
			$this->initShortcodes();
			if($this->tvlgiao_wpdance_checkPluginVC()){
				if ( ! defined( 'ABSPATH' ) ) { exit; }
				add_action("vc_after_init",array($this,'initVisualComposer'));
			}
			$this->init_trigger();
		}

		protected function constant(){
			define('SC_BASE'		,   plugin_dir_path( __FILE__ ) );
			define('SC_BASE_URI'	,   plugins_url( '', __FILE__ ) );
			define('SC_SHORTCODE'	, 	SC_BASE . '/shortcode' );
			define('SC_WIDGET'		, 	SC_BASE . '/widgets' );
			define('SC_VISUAL'		, 	SC_BASE . '/visualcomposer' );
			define('SC_ASSET'		, 	SC_BASE_URI  . '/assets'	);
			define('SC_JS'			, 	SC_ASSET . '/js'		);
			define('SC_CSS'			, 	SC_ASSET . '/css'		);
			define('SC_IMAGE'		, 	SC_ASSET . '/images'	);
		}

		protected function tvlgiao_wpdance_package_get_packages_setting(){
			if (get_option('wd_packages')) {
				$parkages 	= get_option('wd_packages');
				if (!empty($parkages['verify_submit'])) {
					$faq 		= (!empty($parkages['wd_package_faq_post_type'])) ? $parkages['wd_package_faq_post_type'] : '';
					$feature 	= (!empty($parkages['wd_package_feature_post_type'])) ? $parkages['wd_package_feature_post_type'] : '';
					$widget 	= (!empty($parkages['wd_package_widget'])) ? $parkages['wd_package_widget'] : '';
					$this->include_data 	= array(
						'faq_post_type' 		=> $faq,
						'feature_post_type' 	=> $feature,
						'widget' 				=> $widget,
					);
				}
			}
		}

		/******************************** FAQS POST TYPE ***********************************/
		public function tvlgiao_wpdance_register_faq_post_type(){
			if (!post_type_exists('wpdance_faq')) {
				register_post_type('wpdance_faq', array(
					'exclude_from_search' 	=> true,
					'labels' 				=> array(
						'name' 					=> esc_html__("WD FAQs", 'wpdancelaparis'),
						'singular_name' 		=> esc_html__("WD FAQ", 'wpdancelaparis'),
		            	'add_new' 				=> esc_html__( 'Add New', 'wpdancelaparis' ),
						'add_new_item' 			=> sprintf( __( 'Add New %s', 'wpdancelaparis' ), __( 'FAQ', 'wpdancelaparis' ) ),
						'edit_item' 			=> sprintf( __( 'Edit %s', 'wpdancelaparis' ), __( 'FAQ', 'wpdancelaparis' ) ),
						'new_item' 				=> sprintf( __( 'New %s', 'wpdancelaparis' ), __( 'FAQ', 'wpdancelaparis' ) ),
						'all_items' 			=> sprintf( __( 'All %s', 'wpdancelaparis' ), __( 'FAQs', 'wpdancelaparis' ) ),
						'view_item' 			=> sprintf( __( 'View %s', 'wpdancelaparis' ), __( 'FAQ', 'wpdancelaparis' ) ),
						'search_items' 			=> sprintf( __( 'Search %a', 'wpdancelaparis' ), __( 'FAQs', 'wpdancelaparis' ) ),
						'not_found' 			=>  sprintf( __( 'No %s Found', 'wpdancelaparis' ), __( 'FAQs', 'wpdancelaparis' ) ),
						'not_found_in_trash' 	=> sprintf( __( 'No %s Found In Trash', 'wpdancelaparis' ), __( 'FAQs', 'wpdancelaparis' ) ),
					),
					'taxonomies' 			=> array('wpdance_faq'),
					'public' 				=> true,
					'has_archive' 			=> false,
					'menu_icon'				=> 'dashicons-flag',
					'menu_position'			=> 56,
				));		
			}
		}
		public function tvlgiao_wpdance_register_faq_taxonomy(){
			register_taxonomy( 'wpdance_faq_categories', 'wpdance_faq', array(
				'hierarchical'     		=> true,
				'labels'            	=> array(
					'name' 				=> esc_html__('Categories FAQ', 'wpdancelaparis'),
					'singular_name' 	=> esc_html__('Categories FAQ', 'wpdancelaparis'),
	            	'new_item'          => esc_html__('Add New', 'wpdancelaparis' ),
	            	'edit_item'         => esc_html__('Edit Post', 'wpdancelaparis' ),
	            	'view_item'   		=> esc_html__('View Post', 'wpdancelaparis' ),
	            	'add_new_item'      => esc_html__('Add New Category FAQ', 'wpdancelaparis' ),
	            	'menu_name'         => esc_html__( 'Categories FAQ' , 'wpdancelaparis' ),
				),
				'show_ui'           	=> true,
				'show_admin_column' 	=> true,
				'query_var'         	=> true,
				'rewrite'           	=> array( 'slug' => 'wpdance_faq_categories' ),				
				'public'				=> true,
			));	
		}

		/******************************** FEATURE POST TYPE ***********************************/
		public function tvlgiao_wpdance_register_feature_post_type(){
			if (!post_type_exists('wpdance_feature')) {
				$labels = array(
					'name' 					=> esc_html__( 'WD Features', 'wpdancelaparis' ),
					'singular_name' 		=> esc_html__( 'WD Feature', 'wpdancelaparis' ),
					'add_new' 				=> esc_html__( 'Add New', 'wpdancelaparis' ),
					'add_new_item' 			=> sprintf( __( 'Add New %s', 'wpdancelaparis' ), __( 'Feature', 'wpdancelaparis' ) ),
					'edit_item' 			=> sprintf( __( 'Edit %s', 'wpdancelaparis' ), __( 'Feature', 'wpdancelaparis' ) ),
					'new_item' 				=> sprintf( __( 'New %s', 'wpdancelaparis' ), __( 'Feature', 'wpdancelaparis' ) ),
					'all_items' 			=> sprintf( __( 'All %s', 'wpdancelaparis' ), __( 'Features', 'wpdancelaparis' ) ),
					'view_item' 			=> sprintf( __( 'View %s', 'wpdancelaparis' ), __( 'Feature', 'wpdancelaparis' ) ),
					'search_items' 			=> sprintf( __( 'Search %a', 'wpdancelaparis' ), __( 'Features', 'wpdancelaparis' ) ),
					'not_found' 			=>  sprintf( __( 'No %s Found', 'wpdancelaparis' ), __( 'Features', 'wpdancelaparis' ) ),
					'not_found_in_trash' 	=> sprintf( __( 'No %s Found In Trash', 'wpdancelaparis' ), __( 'Features', 'wpdancelaparis' ) ),
					'parent_item_colon' 	=> '',
					'menu_name' 			=> __( 'WD Features', 'wpdancelaparis' )

				);
				$args = array(
					'exclude_from_search' 	=> true,
					'labels' 				=> $labels,
					'public'			 	=> true,
					'publicly_queryable' 	=> true,
					'show_ui' 				=> true,
					'query_var' 			=> true,
					'capability_type' 		=> 'post',
					'has_archive' 			=> false,
					'hierarchical' 			=> false,
					'supports' 				=> array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
					'menu_position' 		=> 23,
					'menu_icon' 			=> 'dashicons-star-filled'
				);
				register_post_type('wpdance_feature', $args);
			}
		}

		public function tvlgiao_wpdance_register_feature_taxonomy(){
			register_taxonomy( 'wpdance_feature_categories', 'wpdance_feature', array(
				'hierarchical'     		=> true,
				'labels'            	=> array(
					'name' 				=> esc_html__('Categories Feature', 'wpdancelaparis'),
					'singular_name' 	=> esc_html__('Categories Feature', 'wpdancelaparis'),
	            	'new_item'          => esc_html__('Add New', 'wpdancelaparis' ),
	            	'edit_item'         => esc_html__('Edit Post', 'wpdancelaparis' ),
	            	'view_item'   		=> esc_html__('View Post', 'wpdancelaparis' ),
	            	'add_new_item'      => esc_html__('Add New Category Feature', 'wpdancelaparis' ),
	            	'menu_name'         => esc_html__( 'Categories Feature' , 'wpdancelaparis' ),
				),
				'show_ui'           	=> true,
				'show_admin_column' 	=> true,
				'query_var'         	=> true,
				'rewrite'           	=> array( 'slug' => 'wpdance_feature_categories' ),				
				'public'				=> true,
			));
		}

		public function wd_feature_save_data($post_id, $post) {

			if ( ! isset( $_POST['wd_feature_box_nonce'] ) )
					return $post_id;
			// verify this came from the our screen and with proper authorization,
			// because save_post can be triggered at other times
			if (!wp_verify_nonce($_POST['wd_feature_box_nonce'],'wd_feature_box'))
				return $post->ID;

			if (!current_user_can('edit_post', $post->ID))
				return $post->ID;

			// OK, we're authenticated: we need to find and save the data
			// Sanitize the user input.
			if('wpdance_feature' == $_POST['post_type']){
				if(isset($_POST['feature_url']))
					update_post_meta($post_id,'wd_feature_url',$_POST['feature_url']);		
				if(isset($_POST['feature_icon']))
					update_post_meta($post_id,'wd_feature_icon',$_POST['feature_icon']);
				if(isset($_POST['readmore_text']))
					update_post_meta($post_id,'wd_readmore_text',$_POST['readmore_text']);	
			}
			
		}

		public function wd_feature_add_meta_box() {
			if(post_type_exists('wpdance_feature')) {
				add_meta_box("wp_cp_custom_feature_meta_box", "Feature Setting", array($this,"wd_feature_meta_box"), "wpdance_feature", "normal", "high");
			}
		}

		public function wd_feature_meta_box(){
			global $post;
			wp_nonce_field( 'wd_feature_box', 'wd_feature_box_nonce' );
			?>
			<table class="form-table wd-feature-custom-meta-box wd-custom-meta-box-width">
				<tbody>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Class Icon Font:' , 'wpdancelaparis' ) ?></label></th>
						<td><input type="text" name="feature_icon" value="<?php echo get_post_meta($post->ID,'wd_feature_icon',true);?>"/>
							<p class="description"><?php echo sprintf(esc_html( 'Enter the awesome font class. Exam: fa-heartbeat. view all at %s' , 'wpdancelaparis' ), '<a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>') ?></p>
						</td> 
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Feature URL:' , 'wpdancelaparis' ) ?></label></th>
						<td><input type="text" name="feature_url" value="<?php echo (get_post_meta($post->ID,'wd_feature_url',true)) ? get_post_meta($post->ID,'wd_feature_url',true) : '#';?>"/>
							<p class="description"><?php esc_html_e( 'Enter a URL that applies to this feature' , 'wpdancelaparis' ) ?></p>
						</td> 
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Readmore Button Text:' , 'wpdancelaparis' ) ?></label></th>
						<td><input type="text" name="readmore_text" value="<?php echo (get_post_meta($post->ID,'wd_readmore_text',true)) ? get_post_meta($post->ID,'wd_readmore_text',true) : 'Read More'; ?>"/>
						</td> 
					</tr>
				</tbody>
			</table>
			<?php
		}


		/******************************** INIT ***********************************/
		protected function initLibrary(){
			require_once SC_BASE.'/wd_functions.php';
			require_once SC_BASE.'/wd_ajax_loadmore.php';
			require_once SC_BASE.'/wd_add_param_vc.php';
		}

		protected function initArrShortcodes(){
			$this->arrShortcodes 		= array(
				'wd_title',
				'wd_site_header',
				'wd_uber_menu',
				'wd_do_shortcode',
				'wd_user_links',
				'wd_social_profiles',
				'wd_social_fanpage_likebox',

				'wd_banner_image',
				'wd_banner_image_2',
				'wd_banner_slider',
				'wd_brand_slider',

				'wd_blog_search',
				'wd_blog_grid_list',
				'wd_blog_special',
				'wd_blog_masonry',
				'wd_blog_recent_slider',

				'wd_dropdowncart',
				'wd_currency_switcher',
				'wd_product_search',
				'wd_product_grid_list',
				'wd_product_special_slider',
				'wd_product_simple_slider',
				'wd_product_single_detail',
				'wd_product_category_single',
				'wd_product_category',
				'wd_product_best_selling',
				'wd_product_by_category_tabs',
				'wd_product_categories_list',
		 		
				'wd_feature',
		 		'wd_feature_category',

				'wd_gtranslate',
				'wd_instagram',
				'wd_icon_count',
				'wd_icon_payment',
				'wd_count_down',
				'wd_feedburner_subscription',
				'wd_faq',
				'wd_process_bar',
				'wd_quote',
				'wd_information',
		 		'wd_recent_comment',
		 		'wd_testimonials',
		 		'wd_pricing_table',
	 		);
		}

		protected function initArrRegisterVC(){
			$this->arrVisualcomposer 	= array(
				'wd_vc_title',
				'wd_vc_site_header',
				'wd_vc_uber_menu',
				'wd_vc_do_shortcode',
				'wd_vc_user_links',
				'wd_vc_social_profiles',
				'wd_vc_social_fanpage_likebox',

				'wd_vc_banner_image',
				'wd_vc_banner_image_2',
				'wd_vc_banner_slider',
				'wd_vc_brand_slider',
				
				'wd_vc_blog_search',
				'wd_vc_blog_grid_list',
				'wd_vc_blog_special',
				'wd_vc_blog_masonry',
				'wd_vc_blog_recent_slider',

				'wd_vc_dropdowncart',
				'wd_vc_currency_switcher',
				'wd_vc_product_search',
				'wd_vc_product_grid_list',
				'wd_vc_product_special_slider',
				'wd_vc_product_simple_slider',
				'wd_vc_product_single_detail',
				'wd_vc_product_category_single',
				'wd_vc_product_category',
				'wd_vc_product_best_selling',
				'wd_vc_product_by_category_tabs',
				'wd_vc_product_categories_list',
				
				'wd_vc_feature',
			 	'wd_vc_feature_category',
				
				'wd_vc_gtranslate',
				'wd_vc_instagram',
				'wd_vc_icon_count',
				'wd_vc_icon_payment',
				'wd_vc_count_down',
				'wd_vc_feedburner_subscription',
				'wd_vc_faq',
				'wd_vc_process_bar',
				'wd_vc_quote',
			 	'wd_vc_information',
			 	'wd_vc_recent_comment',
			 	'wd_vc_testimonials',
			 	'wd_vc_pricing_table',
			);
		}

		protected function initArrWidgets(){
			$this->arrWidgets 		= array(
				'wd_banner_image',
				/*'wd_banner_ads',
				'wd_countdown',
				'wd_title_heading',
				'wd_faq',
				'wd_testimonials',
				'wd_testimonials_plus',
				'wd_header_dropdown_cart',
				'wd_header_user_login',
				'wd_header_site_logo',
				'wd_header_icon_group',
				'wd_header_wishlist_button',
				'wd_product_slider',
				'wd_product_grid_list',
				'wd_product_special',
				'wd_product_countdown',*/
				'wd_blog_special',
				/*'wd_blog_grid_list',
				'wd_special_post',
				'wd_woo_currency_switcher',
				'wd_woo_brand_slider',*/
				'wd_instagram',
				/*'wd_team_members',
				'wd_pricing_table',
				'wd_feature',
				'wd_feature_category',
				'wd_feedburner_subscription',
				'wd_category_list_child',*/
				'wd_search_product',
				'wd_search_blog',
				'wd_icon_social',
				'wd_icon_payment',
				'wd_fanpage_likebox',
			);
		}


		protected function initShortcodes(){
			foreach($this->arrShortcodes as $shortcode){
				if( file_exists(SC_SHORTCODE."/{$shortcode}.php") ){
					require_once SC_SHORTCODE."/{$shortcode}.php";
				}	
			}
		}

		public function initVisualComposer(){ 
			foreach ($this->arrVisualcomposer as $visual) {
				if( file_exists(SC_VISUAL."/{$visual}.php") ){
					require_once SC_VISUAL."/{$visual}.php";
				}
			}
	    }

		protected function initWidgets(){
			foreach($this->arrWidgets as $widget){
				if( file_exists(SC_WIDGET."/{$widget}.php") ){
					require_once SC_WIDGET."/{$widget}.php";
				}	
			}
		}
		
		protected function init_trigger(){
			add_image_size('wd_shortcode_thumb_product_single_slider'	, 570, 405, true); 
			add_image_size('wd_shortcode_thumb_category_product'		, 270, 405, true); 
			add_image_size('wd_widget_thumb_widget'						, 570, 405, true); 
		}
		
		public function init_script(){
			wp_enqueue_style('tooltip-skin-css', 				SC_CSS.'/tooltip_skin.css');
			wp_enqueue_style('jquery-ui-core');
			wp_enqueue_style('timecircles-core', 				SC_CSS.'/timecircles.css');
			wp_enqueue_style('owl-carousel-core', 				SC_CSS.'/owl.carousel.min.css');
			wp_enqueue_style('slick-core',						SC_CSS.'/slick.css');
			wp_enqueue_style('slick-theme-css',					SC_CSS.'/slick-theme.css');
			wp_enqueue_style('wd-shortcode-custom-css',			SC_CSS.'/wd_custom_style.css');

			wp_enqueue_script('bootstrap-core', 				SC_JS.'/bootstrap.min.js',false,false,true);
			wp_enqueue_script('jquery-countdown-core', 			SC_JS.'/jquery.countdown.min.js',array('jquery'),false,true);
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('timecircles-core', 				SC_JS.'/timecircles.js',false,false,true);
			wp_enqueue_script('owl-carousel-core', 				SC_JS.'/owl.carousel.min.js',false,false,true);
			wp_enqueue_script('slick-core', 					SC_JS.'/slick.min.js',false,false,true);
			wp_enqueue_script('wd-shortcode-custom-script',		SC_JS.'/wd_custom_script.js',false,false,true);
			wp_enqueue_script('wd-ajax-pagination-script', 		SC_JS.'/wd_vc_loadmore_js.js',false,false,true);
		}
		public function admin_init_script($hook){
			if ($hook != 'toplevel_page_WPDanceLaParis') {
				wp_enqueue_style('jquery-ui-core');
				wp_enqueue_script('jquery-ui-core');
			}
		}		

		/******************************** AJAX ***********************************/

		public function set_ajax_url() {
		 	global $wp_query;
		 	wp_localize_script( 'wd-ajax-pagination-script', 'ajax_object', array(
				'ajax_url' 			=> admin_url( 'admin-ajax.php' ),
				'query_vars'		=> json_encode( $wp_query->query )
			));
		 	wp_localize_script( 'wd-ajax-pagination-script', 'blog_ajax_object', array(
				'ajax_url_blog' 	=> admin_url( 'admin-ajax.php' ),
				'query_vars'		=> json_encode( $wp_query->query )
			));
		 	wp_localize_script( 'wd-ajax-pagination-script', 'masonry_ajax_object', array(
				'ajax_url_masonry' 	=> admin_url( 'admin-ajax.php' ),
				'query_vars'		=> json_encode( $wp_query->query )
			));
		}
		
		/******************************** Check Visual Composer active ***********************************/
		protected function tvlgiao_wpdance_checkPluginVC(){
			$_active_vc = apply_filters('active_plugins',get_option('active_plugins'));
			if(in_array('js_composer/js_composer.php',$_active_vc)){
				return true;
			}else{
				return false;
			}
		}
	}	
	WD_Shortcode::get_instance();
}
?>