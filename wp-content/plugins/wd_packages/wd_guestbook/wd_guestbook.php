<?php
/*
  Plugin Name: WD Guest Book
  Plugin URI: http://www.wpdance.com
  Description: Guest Book From WPDance Team
  Version: 1.0
  Author: WD Team
  Author URI: http://www.wpdance.com
 */
class WD_Guestbook {
	protected $arrShortcodes = array();
	protected $arrVisualcomposer = array();
	public function __construct(){
		$this->constant();
		
		/****************************/
		// Register Guest Book post type
		//add_action('init', array($this,'wd_slide_register') );
		$this->wd_guestbook_register();
		add_theme_support('post-thumbnails', array('wd_guestbook'));
		
		register_activation_hook(__FILE__, array($this,'wd_guestbook_activate') );
		register_deactivation_hook(__FILE__, array($this,'wd_guestbook_deactivate') );

		$this->initArrShortcodes();
		$this->initArrRegisterVC();
		$this->initShortcodes();
		//Load VC
		if($this->wd_guestbook_checkPluginVC()){
			if ( ! defined( 'ABSPATH' ) ) { exit; }
			add_action("vc_before_init",array($this,'wd_guestbook_load_visual'));
		}

		add_action('admin_enqueue_scripts',array($this,'init_admin_script'));
		
		//add_action('admin_menu', array( $this,'wd_guestbook_create_section' ) );	
		
		add_filter('attribute_escape', array($this,'rename_second_menu_name') , 10, 2);
		
		//add_action('save_post', array($this,'wd_guestbook_save_data') , 1, 2);
		
		add_action( 'template_redirect', array($this,'wd_guestbook_template_redirect') );
		
		
		$this->wd_guestbook_function();
		$this->init_trigger();
		$this->init_handle();
	}
	
	/******************************** Guest Book POST TYPE INIT START ***********************************/

	public function wd_guestbook_save_data($post_id, $post) {
		
	}	
		
	
	public function wd_guestbook_register() {
		 require_once WDGB_TYPES."/wd-guestbook.php";
	}	
	public function wd_guestbook_function(){
		require_once plugin_dir_path( __FILE__ ).'wd_functions.php';
	}
	
	/*********************************** Guest Book SHORTCODE *****************************************/

	protected function initArrShortcodes(){
		$this->arrShortcodes 		= array('wd_guestbook_masonry');
	}

	protected function initArrRegisterVC(){
		$this->arrVisualcomposer 	= array('wd_vc_guestbook_masonry');
	}
	protected function initShortcodes(){
		foreach($this->arrShortcodes as $shortcode){
			if( file_exists(WDGB_SHORTCODE."/{$shortcode}.php") ){
				require_once WDGB_SHORTCODE."/{$shortcode}.php";
			}	
		}
	}
	public function wd_guestbook_load_visual(){
		foreach ($this->arrVisualcomposer as $visual) {
			if( file_exists(WDGB_VISUAL."/{$visual}.php") ){
				require_once WDGB_VISUAL."/{$visual}.php";
			}
		}
    }
	protected function wd_guestbook_checkPluginVC(){
		$_active_vc = apply_filters('active_plugins',get_option('active_plugins'));
		if(in_array('js_composer/js_composer.php',$_active_vc)){
			return true;
		}else{
			return false;
		}
	}
	/******************************** Team POST TYPE INIT END *************************************/
	
	public function wd_guestbook_template_redirect(){
		global $wp_query,$post,$page_datas,$data;
		if( $wp_query->is_page() || $wp_query->is_single() ){
			if ( has_shortcode( $post->post_content, 'team_member' ) ) { 
				add_action('wp_enqueue_scripts',array($this,'init_script'));
			}
		}
		
	}
	
	public function wd_guestbook_create_section() {
		if(post_type_exists('wd_guestbook')) {
			add_meta_box("wp_cp_custom_carousels", "Guest Book Config", array($this,"wd_guestbook_show_meta"), "wd_guestbook", "normal", "high");
		}
	}

	public function wd_guestbook_show_meta(){
		require_once WDGB_INCLUDES.'/wd_meta_guestbook.php';
	}
	
	public function wd_guestbook_deactivate() {
		flush_rewrite_rules();
	}

	public function wd_guestbook_activate() {
		$this->wd_guestbook_register();
		flush_rewrite_rules();
	}		
	
	public function rename_second_menu_name($safe_text, $text) {
		if (__('Guest Book Items', 'wd_guestbook_context') !== $text) {
			return $safe_text;
		}

		// We are on the main menu item now. The filter is not needed anymore.
		remove_filter('attribute_escape', array($this,'rename_second_menu_name') );

		return __('WD Guest Book', 'wd_guestbook_context');
	}
		
	protected function init_trigger(){
	
	}
	protected function init_handle(){
		//add_shortcode('wd-team', array( $this,'wd_Slide') );
		add_image_size('wd_guestbook_thumb',400,400,true);  
	}	
	
	public function init_admin_script() {
		if (function_exists('wp_enqueue_media')) {

		} else {
			wp_enqueue_style('thickbox');
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');

		}	
	}	
	
	
	public function init_script(){
		wp_enqueue_script('jquery');	
		wp_enqueue_script( 'carouFredSel-core', WDGB_JS.'/jquery.carouFredSel-6.2.1.min.js',false,false,true);
	}
	
	protected function constant(){
		//define('DS',DIRECTORY_SEPARATOR);	
		define('WDGB_BASE'		,  	plugins_url( '', __FILE__ )		);
		define('WDGB_SHORTCODE'	, 	plugin_dir_path( __FILE__ ) . 'shortcode' );
		define('WDGB_VISUAL'	, 	plugin_dir_path( __FILE__ ) . 'visualcomposer' );
		define('WDGB_JS'		, 	WDGB_BASE . 'assets/js'		);
		define('WDGB_CSS'		, 	WDGB_BASE . 'assets/css'		);
		define('WDGB_IMAGE'		, 	WDGB_BASE . 'assets/images'	);
		define('WDGB_TEMPLATE' 	, 	dirname(__FILE__) . '/templates'	);
		define('WDGB_TYPES'		, 	plugin_dir_path( __FILE__ ) . 'post_type'		);
		define('WDGB_INCLUDES'	, 	plugin_dir_path( __FILE__ ) . 'includes'		);
	}

}
 
$_wd_guestbook = new WD_Guestbook; // Start an instance of the plugin class 