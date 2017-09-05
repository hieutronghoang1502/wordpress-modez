<?php
if (!class_exists('Tvlgiao_Wpdance_GeneralTheme')) {
	class Tvlgiao_Wpdance_GeneralTheme{
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

		//Variable
		protected $theme_name		= 'WPDance LaParis';
		protected $theme_slug		= 'wpdancelaparis';

		protected $arr_functions 	= array();
		protected $arr_libs 		= array();
		protected $arr_customize 	= array();
		protected $include_data 	= array(
						'theme_manager_mode' 	=> 'theme_option',
						'theme_guide' 			=> 1,
					);

		//Constructor
		public function __construct(){
			$this->tvlgiao_wpdance_package_get_packages_setting();
			$this->constant();
			$this->init_arr_functions();
			$this->init_arr_libs();
			$this->init_arr_customize();
			$this->init_setup_theme();
		}
		// Function Setup Theme
		public function init_setup_theme(){
			//After setup theme
			add_action( 'after_setup_theme', array($this,'setup_theme'));
			$this->init_libs();
			$this->init_functions();

			//Theme guide
			if ($this->include_data['theme_guide']) {
				$this->init_theme_guide();
			}

			$this->init_metabox();
			//Include Customize or Theme Option
			if (TVLGIAO_WPDANCE_USE_CONTROL == 'customize') {
				$this->init_customize();
			} elseif (TVLGIAO_WPDANCE_USE_CONTROL == 'theme_option') {
				$this->init_theme_options();
			}
		}
		// Constant
		protected function constant(){			
			// Default
			define('TVLGIAO_WPDANCE_DS'						, DIRECTORY_SEPARATOR);	
			define('TVLGIAO_WPDANCE_THEME_NAME'				, $this->theme_name );
			define('TVLGIAO_WPDANCE_THEME_SLUG'				, $this->theme_slug.'_');
			define('TVLGIAO_WPDANCE_THEME_DIR'				, get_template_directory());
			define('TVLGIAO_WPDANCE_THEME_URI'				, get_template_directory_uri());
			define('TVLGIAO_WPDANCE_THEME_ASSET_URI'		, TVLGIAO_WPDANCE_THEME_URI 			. '/assets');
			// Style-Script-Image
			define('TVLGIAO_WPDANCE_THEME_IMAGES'			, TVLGIAO_WPDANCE_THEME_ASSET_URI 		. '/images');
			define('TVLGIAO_WPDANCE_THEME_CSS'				, TVLGIAO_WPDANCE_THEME_ASSET_URI 		. '/css');
			define('TVLGIAO_WPDANCE_THEME_JS'				, TVLGIAO_WPDANCE_THEME_ASSET_URI 		. '/js');
			define('TVLGIAO_WPDANCE_THEME_FONT'				, TVLGIAO_WPDANCE_THEME_ASSET_URI 		. '/fonts');
			//Framework Theme
			define('TVLGIAO_WPDANCE_THEME_FRAMEWORK'		, TVLGIAO_WPDANCE_THEME_DIR 			. '/framework');
			define('TVLGIAO_WPDANCE_THEME_FRAMEWORK_URI'	, TVLGIAO_WPDANCE_THEME_URI 			. '/framework');
			//Folder in Framework
			define('TVLGIAO_WPDANCE_THEME_FUNCTIONS'		, TVLGIAO_WPDANCE_THEME_FRAMEWORK 		. '/functions');	
			define('TVLGIAO_WPDANCE_THEME_LIB'				, TVLGIAO_WPDANCE_THEME_FRAMEWORK 		. '/lib');
			define('TVLGIAO_WPDANCE_THEME_PLUGIN'			, TVLGIAO_WPDANCE_THEME_FRAMEWORK 		. '/plugins');
			define('TVLGIAO_WPDANCE_THEME_SHORTCODES'		, TVLGIAO_WPDANCE_THEME_FRAMEWORK 		. '/shortcodes');
			define('TVLGIAO_WPDANCE_THEME_METABOX'			, TVLGIAO_WPDANCE_THEME_FRAMEWORK 		. '/metabox');
			define('TVLGIAO_WPDANCE_THEME_METABOX_URI'		, TVLGIAO_WPDANCE_THEME_FRAMEWORK_URI 	. '/metabox');
			//Folder WPDANCE
			define('TVLGIAO_WPDANCE_THEME_WPDANCE'			, TVLGIAO_WPDANCE_THEME_FRAMEWORK 		. '/wpdance');
			define('TVLGIAO_WPDANCE_THEME_WPDANCE_URI'		, TVLGIAO_WPDANCE_THEME_FRAMEWORK_URI 	. '/wpdance');
			define('TVLGIAO_WPDANCE_THEME_SUPPORT'			, TVLGIAO_WPDANCE_THEME_WPDANCE 		. '/supports');
			define('TVLGIAO_WPDANCE_THEME_SUPPORT_URI'		, TVLGIAO_WPDANCE_THEME_WPDANCE_URI 	. '/supports');
			define('TVLGIAO_WPDANCE_THEME_CUSTOMIZE'		, TVLGIAO_WPDANCE_THEME_SUPPORT 		. '/theme_customize');
			define('TVLGIAO_WPDANCE_THEME_INSTALL'			, TVLGIAO_WPDANCE_THEME_SUPPORT 		. '/theme_guide');
			define('TVLGIAO_WPDANCE_THEME_OPTIONS'			, TVLGIAO_WPDANCE_THEME_SUPPORT 		. '/theme_option');

			//Customize (customize) or Theme Option (theme_option)
			if ($this->include_data['theme_manager_mode'] != '') {
				define('TVLGIAO_WPDANCE_USE_CONTROL'		,  $this->include_data['theme_manager_mode']);
			}
		}

		protected function tvlgiao_wpdance_package_get_packages_setting(){
			if (get_option('wd_packages')) {
				$parkages 	= get_option('wd_packages');
				if (!empty($parkages['verify_submit'])) {
					$theme_manager_mode 	= (!empty($parkages['wd_theme_manager_mode'])) ? $parkages['wd_theme_manager_mode'] : 'theme_option';
					$theme_guide 			= (!empty($parkages['wd_theme_guide'])) ? $parkages['wd_theme_guide'] : '';
					$this->include_data 	= array(
						'theme_manager_mode' 	=> $theme_manager_mode,
						'theme_guide' 			=> $theme_guide,
					);
				}
			}
		}

		//Setup Theme
		public function setup_theme(){
		    global $content_width;
		    if ( !isset($content_width) ) {
		        $content_width = 1170;
		    }
			//Make theme available for translation
			//Translations can be filed in the /languages/ directory
   			load_theme_textdomain('wpdancelaparis', get_template_directory() . '/languages');
   			//Import Register Menu
   			$this->register_location_menu();
   			//Import Theme Support
   			$this->theme_support();
   			//Import Google Font
   			add_action('wp_enqueue_scripts',array($this,'set_default_fonts'));
   			//Import Script / Style
   			add_action('wp_enqueue_scripts',array($this,'enqueue_scripts'));
		}

		//Register Menu
		public function register_location_menu(){
			register_nav_menus(array(
				'primary' 			=> esc_html__('Primary Menu', 'wpdancelaparis'),
		        'primary_right' 	=> esc_html__('Secondary Menu', 'wpdancelaparis'),
		        'primary_mobile' 	=> esc_html__('Mobile Menu', 'wpdancelaparis'),
		    ));
		}

		//Theme Support
		public function theme_support(){
			// Enable support for Post Formats.
			$defaults = array(
	'default-image'          => '',
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => true,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );
    		add_theme_support('post-formats', array('gallery', 'image', 'video', 'audio', 'quote'));
			add_theme_support('title-tag');
			add_theme_support('automatic-feed-links');
			add_theme_support('woocommerce');
			add_theme_support('post-thumbnails');
			
			//Add Image Size
			set_post_thumbnail_size( 640, 440, true );
			add_image_size('tvlgiao_wpdance_image_size_thumbnail'		, 150, 90,	true);
			add_image_size('tvlgiao_wpdance_image_size_medium'			, 420, 250,	true);
			add_image_size('tvlgiao_wpdance_image_size_large'			, 780, 465,	true);
			add_image_size('tvlgiao_wpdance_image_size_cart_dropdown' 	, 150, 150, true);
		}
		//Google Font
		public function set_default_fonts() {
			/* Exam tvlgiao_wpdance_google_font_default : Roboto Condensed:400,400italic,700,700italic|Open Sans:400,600,700,300|Playfair Display:400,700|Lora:400,400italic,700,700italic|Raleway:400,400italic,700,700italic */
			$tvlgiao_wpdance_google_font_default = 'Kaushan+Script|Poppins|Playfair+Display';
			if ($tvlgiao_wpdance_google_font_default != '') {
				$tvlgiao_wpdance_query_args = array(
			        'family' => urlencode($tvlgiao_wpdance_google_font_default)
			    );
			    wp_enqueue_style( 'google-fonts', add_query_arg( $tvlgiao_wpdance_query_args, "//fonts.googleapis.com/css" ), array(), null );
			}
		}

		//Include Function
		protected function init_arr_functions(){
			$this->arr_functions = array(
				'wd_get_data_theme_option',
				'wd_accessibility',
				'wd_breadcrumbs',
				'wd_comment_form',
				'wd_counter_views',
				'wd_enqueue_font',
				'wd_enqueue_styling_script',
				'wd_excerpt',
				'wd_font_list',
				'wd_main',
				'wd_pagination',
				'wd_register_sidebar',
				'wd_register_tgmpa_plugin',
				'wd_template_tag',
				'blog/wd_blog_content',
				'blog/wd_blog_function',
				'woocommerce/wd_woo_account',
				'woocommerce/wd_woo_cart',
				'woocommerce/wd_woo_function',
				'woocommerce/wd_woo_hook',
				'woocommerce/wd_woo_content',
			);
			if (TVLGIAO_WPDANCE_USE_CONTROL == 'customize') {
				$this->arr_functions[] = 'wd_customize_live_preview_color';
			} 
		}
		//Include Lib
		protected function init_arr_libs(){
			$this->arr_libs = array(
				'class-tgm-plugin-activation',
				'add-control-custom-radio-image',
				'wd-add-control-custom-font');
		}
		//Include Customize
		protected function init_arr_customize(){
			$this->arr_customize = array(
				'wd_customize_sanitize_callback',
				'wd_customize_header',
				'wd_customize_footer',
				'wd_customize_layout',
				'wd_customize_styling_option',
				'wd_customize_theme_option',
				'wd_customize_product',
				'wd_customize_font'
			);
		}
		// Load File
		protected function init_functions(){
			foreach($this->arr_functions as $function){
				if(file_exists(TVLGIAO_WPDANCE_THEME_FUNCTIONS."/{$function}.php")){
					require_once TVLGIAO_WPDANCE_THEME_FUNCTIONS."/{$function}.php";
				}	
			}
		}
		protected function init_libs(){
			foreach($this->arr_libs as $lib){
				if(file_exists(TVLGIAO_WPDANCE_THEME_LIB. "/{$lib}.php")){
					require_once TVLGIAO_WPDANCE_THEME_LIB. "/{$lib}.php";
				}
			}
		}
		protected function init_customize(){
			foreach($this->arr_customize as $custom){
				if(file_exists(TVLGIAO_WPDANCE_THEME_CUSTOMIZE. "/{$custom}.php")){
					require_once TVLGIAO_WPDANCE_THEME_CUSTOMIZE. "/{$custom}.php";
				}
			}
		}
		protected function init_theme_options(){
			if ( ! class_exists( 'ReduxFramework' ) ) {
		         return;
		    }
			if(file_exists(TVLGIAO_WPDANCE_THEME_OPTIONS. "/wd_theme_options.php")){
				require_once TVLGIAO_WPDANCE_THEME_OPTIONS. "/wd_theme_options.php";
			}
		}
		protected function init_theme_guide(){
			if(file_exists(TVLGIAO_WPDANCE_THEME_INSTALL. "/install_theme_guide.php")){
				require_once TVLGIAO_WPDANCE_THEME_INSTALL. "/install_theme_guide.php";
			}
		}
		protected function init_metabox(){
			if(file_exists(TVLGIAO_WPDANCE_THEME_METABOX.'/wd_metaboxes.php')){
				require_once TVLGIAO_WPDANCE_THEME_METABOX.'/wd_metaboxes.php';
			}
		}
		
		
		//Enqueue Style And Script
		public function enqueue_scripts(){
			/*----------------- Style ---------------------*/
			$arr_style_file = array(
				// LIB
				array(
					'handle' 	=> 'bxslider-css', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_CSS.'/jquery.bxslider.css', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'media' 	=> 'all',
				),
				array(
					'handle' 	=> 'owl-carousel-css', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_CSS.'/owl.theme.default.min.css', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'media' 	=> 'all',
				),
				array(
					'handle' 	=> 'bootstrap-core', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_CSS.'/bootstrap.css', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'media' 	=> 'all',
				),
				array(
					'handle' 	=> 'font-awesome', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_CSS.'/font-awesome.min.css', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'media' 	=> 'all',
				),
				array(
					'handle' 	=> 'elusive-icons', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_CSS.'/elusive-icons.min.css', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'media' 	=> 'all',
				),
				array(
					'handle' 	=> 'owl-carousel-core', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_CSS.'/owl.carousel.min.css', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'media' 	=> 'all',
				),
				array(
					'handle' 	=> 'cloud-zoom-core', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_CSS.'/cloud-zoom.css', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'media' 	=> 'all',
				),

				// CSS OF THEME
				array(
					'handle' 	=> 'tvlgiao-wpdance-style-css', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_URI.'/style.css', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'media' 	=> 'all',
				),
				
				array(
					'handle' 	=> 'tvlgiao-wpdance-custom-style-inline-css', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_CSS.'/wd_print_inline_style.css', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'media' 	=> 'all',
				),
			);

			/*----------------- Script ---------------------*/
			$arr_script_file = array(
				// LIB
				array(
					'handle' 	=> 'bxslider-js-js', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_JS.'/jquery.bxslider.js', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'in_footer' => true,
				),
				array(
					'handle' 	=> 'bxslider-js', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_JS.'/jquery.bxslider.min.js', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'in_footer' => true,
				),
				array(
					'handle' 	=> 'bootstrap-core', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_JS.'/bootstrap.min.js', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'in_footer' => true,
				),
				array(
					'handle' 	=> 'imagesloaded-min-js', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_JS.'/jquery.imagesloaded.min.js', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'in_footer' => true,
				),
				array(
					'handle' 	=> 'isotope-pkgd-min-js', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_JS.'/isotope.pkgd.min.js', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'in_footer' => true,
				),
				array(
					'handle' 	=> 'hover-intent-js', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_JS.'/jquery.hoverIntent.js', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'in_footer' => true,
				),
				array(
					'handle' 	=> 'owl-carousel-core', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_JS.'/owl.carousel.min.js', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'in_footer' => true,
				),
				
				array(
					'handle' 	=> 'cloud-zoom-core', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_JS.'/cloud-zoom.1.0.2.js', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'in_footer' => true,
				),

				// JS OF THEME
				array(
					'handle' 	=> 'tvlgiao-wpdance-main-js', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_JS.'/wd_main.js', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'in_footer' => true,
				),
				array(
					'handle' 	=> 'tvlgiao-woo-product-js', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_JS.'/wd_woo.js', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'in_footer' => true,
				),
				array(
					'handle' 	=> 'tvlgiao-wpdance-custom-script-inline-js', 
					'src' 	 	=> TVLGIAO_WPDANCE_THEME_JS.'/wd_print_inline_script.js', 
					'deps'   	=> array(),
					'ver' 		=> false,
					'in_footer' => true,
				),
			);


			foreach ($arr_style_file as $style_file) {
				wp_enqueue_style($style_file['handle'], $style_file['src'], $style_file['deps'], $style_file['ver'], $style_file['media']);
			}
			foreach ($arr_script_file as $script_file) {
				wp_enqueue_script($script_file['handle'], $script_file['src'], $script_file['deps'], $script_file['ver'], $script_file['in_footer']);
			}

		    if (is_singular() && comments_open()) { wp_enqueue_script('comment-reply'); }
			
		}
	}
	Tvlgiao_Wpdance_GeneralTheme::get_instance();
}
?>