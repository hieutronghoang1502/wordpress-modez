<?php
/*
  Plugin Name: WD Event
  Plugin URI: http://www.wpdance.com
  Description: Event From WPDance Event
  Version: 1.0
  Author: WD Event
  Author URI: http://www.wpdance.com
 */
class WD_event {

	public function __construct(){
		$this->constant();
		
		/****************************/
		// Register Event post type
		//add_action('init', array($this,'wd_slide_register') );
		$this->wd_event_register();
		add_theme_support('post-thumbnails', array('event'));
		
		register_activation_hook(__FILE__, array($this,'wd_event_activate') );
		register_deactivation_hook(__FILE__, array($this,'wd_event_deactivate') );

		
		add_action('admin_enqueue_scripts',array($this,'init_admin_script'));
		
		add_action('admin_menu', array( $this,'wd_event_create_section' ) );	
		
		add_filter('attribute_escape', array($this,'rename_second_menu_name') , 10, 2);
		
		add_action('save_post', array($this,'wd_event_save_data') , 1, 2);
		
		add_action( 'template_redirect', array($this,'wd_event_template_redirect') );
		
		
		
		$this->init_trigger();
		$this->init_handle();
	}
	
	/******************************** event POST TYPE INIT START ***********************************/

	public function wd_event_save_data($post_id, $post) {

		if ( ! isset( $_POST['wd_event_box_nonce'] ) )
				return $post_id;
		// verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times
		if (!wp_verify_nonce($_POST['wd_event_box_nonce'],'wd_event_box'))
			return $post->ID;

		if ($post->post_type == 'revision')
			return; //don't store custom data twice

		if (!current_user_can('edit_post', $post->ID))
			return $post->ID;

		// OK, we're authenticated: we need to find and save the data
		// Sanitize the user input.
		if('event' == $_POST['post_type']){
			if(isset($_POST['event_startdate']))
				update_post_meta($post_id,'wd_event_startdate',$_POST['event_startdate']);
			if(isset($_POST['event_starttime']))
				update_post_meta($post_id,'wd_event_starttime',$_POST['event_starttime']);
			if(isset($_POST['event_enddate']))
				update_post_meta($post_id,'wd_event_enddate',$_POST['event_enddate']);
			if(isset($_POST['event_endtime']))
				update_post_meta($post_id,'wd_event_endtime',$_POST['event_endtime']);
			if(isset($_POST['event_location']))
				update_post_meta($post_id,'wd_event_location',$_POST['event_location']);
			if(isset($_POST['event_phone']))
				update_post_meta($post_id,'wd_event_phone',$_POST['event_phone']);
			if(isset($_POST['event_email']))
				update_post_meta($post_id,'wd_event_email',$_POST['event_email']);
			if(isset($_POST['event_link']))
				update_post_meta($post_id,'wd_event_link',$_POST['event_link']);
		}
		
	}	
		
	
	public function wd_event_register() {
		 require_once WDE_TYPES."/event.php";
	}	
	
	
	/******************************** event POST TYPE INIT END *************************************/
	
	public function wd_event_template_redirect(){
		global $wp_query,$post,$page_datas,$data;
		if( $wp_query->is_page() || $wp_query->is_single() ){
			if ( has_shortcode( $post->post_content, 'event' ) ) { 
				add_action('wp_enqueue_scripts',array($this,'init_script'));
			}
		}
		
	}
	
	public function wd_event_create_section() {
		if(post_type_exists('event')) {
			add_meta_box("wp_cp_custom_carousels", "Event Information", array($this,"show_event"), "event", "normal", "high");
		}
	}

	public function show_event(){
		require_once WDE_INCLUDES.'/event.php';
	}
	
	public function wd_event_deactivate() {
		flush_rewrite_rules();
	}

	public function wd_event_activate() {
		$this->wd_event_register();
		flush_rewrite_rules();
	}		
	
	public function rename_second_menu_name($safe_text, $text) {
		if (__('event Items', 'WD_event_context') !== $text) {
			return $safe_text;
		}

		// We are on the main menu item now. The filter is not needed anymore.
		remove_filter('attribute_escape', array($this,'rename_second_menu_name') );

		return __('WD Event', 'wd_event_context');
	}
		
	protected function init_trigger(){
	
	}
	protected function init_handle(){
		//add_shortcode('wd-event', array( $this,'wd_Slide') );
		add_image_size('wd_event_thumb',400,400,true);  
		require_once WDE_TEMPLATE . "/wd_event_vc_generator.php";
		require_once WDE_TEMPLATE . "/wd_event_shortcode.php";
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
		wp_enqueue_script( 'carouFredSel-core', WDE_JS.'/jquery.carouFredSel-6.2.1.min.js',false,false,true);
		
		//wp_register_script( 'wd.event.js', WDP_JS.'/event.js',false,false,true);			
	}
	
	protected function constant(){
		//define('DS',DIRECTORY_SEPARATOR);	
		define('WDE_BASE'		,  	plugins_url( '', __FILE__ )		);
		define('WDE_JS'			, 	WDE_BASE . '/js'		);
		define('WDE_CSS'		, 	WDE_BASE . '/css'		);
		define('WDE_IMAGE'		, 	WDE_BASE . '/images'	);
		define('WDE_TEMPLATE' 	, 	dirname(__FILE__) . '/templates'	);
		define('WDE_TYPES'	, 	plugin_dir_path( __FILE__ ) . 'post_type'		);
		define('WDE_INCLUDES'	, 	plugin_dir_path( __FILE__ ) . 'includes'		);
	}

}
 
$_wd_event = new WD_event; // Start an instance of the plugin class 