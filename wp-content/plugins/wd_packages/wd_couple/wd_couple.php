<?php
/*
  Plugin Name: WD Couple
  Plugin URI: http://www.wpdance.com
  Description: couple From WPDance Team
  Version: 1.0.0
  Author: WD Team
  Author URI: http://www.wpdance.com
 */
class WD_Couple {
	/******************************** Couple POST TYPE INIT END *************************************/

	/******************************/
	// Register Couple post type //
	/******************************/
	protected $arrShortcodes = array();
	protected $arrVisualcomposer = array();
	public function __construct(){
		$this->constant();

		add_action('init', array($this,'wd_couple_register') );
		add_theme_support('post-thumbnails', array('couple'));

		register_activation_hook(__FILE__, array($this,'wd_couple_activate') );
		register_deactivation_hook(__FILE__, array($this,'wd_couple_deactivate') );

		$this->initArrShortcodes();
		$this->initArrRegisterVC();
		$this->initShortcodes();
		$this->add_customizer();
		
		//Load VC
		if($this->wd_couple_checkPluginVC()){
			if ( ! defined( 'ABSPATH' ) ) { exit; }
			add_action("vc_before_init",array($this,'wd_couple_load_visual'));
		}
		add_action('template_redirect', array($this,'wd_couple_template_redirect') );
		add_action('admin_enqueue_scripts',array($this,'init_admin_script'));
		add_action('admin_menu', array( $this,'wd_couple_create_section' ) );
		add_action('save_post', array($this,'wd_couple_save_data') , 1, 2);
		//add_filter( 'archive_template', array($this,'wd_couple_archive_template') ) ;
		$this->init_trigger();
		$this->wd_couple_function();
	}
	public function wd_couple_template_redirect(){
		add_action('wp_enqueue_scripts',array($this,'init_script'));
	}
	/* Register Post Type Couple */
	public function wd_couple_register() {
		$this->wd_couple_register_taxonomies();

		$labels = array(
			'menu_name' 			=> esc_html__('WD Couple', 'wpdance'),
			'all_items'         	=> esc_html__( 'All Couple', 'wpdance' ),
			'add_new'				=> esc_html__('Add New Couple', 'wpdance'),
			'name' 					=> esc_html__('Couple Item', 'wpdance'),
			'singular_name' 		=> esc_html__('Couple Item', 'wpdance'),
			'add_new' 				=> esc_html__('Add Couple Item', 'wpdance'),
			'add_new_item' 			=> esc_html__('Add New Couple', 'wpdance'),
			'edit_item' 			=> esc_html__('Edit Couple Item', 'wpdance'),
			'new_item' 				=> esc_html__('New Couple Item', 'wpdance'),
			'view_item' 			=> esc_html__('View Couple Item', 'wpdance'),
			'search_items' 			=> esc_html__('Search Couple Item', 'wpdance'),
			'not_found' 			=> esc_html__('No Couple Items found', 'wpdance'),
			'not_found_in_trash' 	=> esc_html__('No Couple Items found in Trash', 'wpdance'),
			'parent_item_colon' 	=> '',
		);
		$args = array(
			'labels' 				=> $labels,
			'public' 				=> true,
			'show_ui' 				=> true,
			'capability_type' 		=> 'post',
			'hierarchical' 			=> true,
			'rewrite' 				=> array('slug' => 'wd_couple'),
			'supports' 				=> array('title', 'thumbnail', 'editor',),
			'taxonomies' 			=> array('couple_category'),
			'menu_position'			=> 23,
		);

		register_post_type('wd_couple', $args);
	}
	public function wd_couple_register_taxonomies() {
		register_taxonomy( 'wd_couple_category', array( 'wd_couple' ), array(
			'hierarchical'      	=> true,
			'labels'           		=> array(
				'menu_name'         => esc_html__('Categories Couple' , 'wpdance' ),
				'name' 				=> esc_html__('Categories Couple', 'wpdance'),
				'singular_name' 	=> esc_html__('Categories Couple', 'wpdance'),
 				'search_items'      => esc_html__('Search Couple', 'wpdance' ),
        		'all_items'         => esc_html__('All Couple', 'wpdance' ),            	
            	'new_item'          => esc_html__('Add New', 'wpdance' ),
            	'edit_item'         => esc_html__('Edit Post', 'wpdance' ),
            	'view_item'   		=> esc_html__('View Post', 'wpdance' ),
            	'add_new_item'      => esc_html__('Add New Category couple', 'wpdance' ),
				'new_item_name'     => esc_html__('New couple Name', 'wpdance' ),
			),
			'show_ui'           	=> true,
			'show_admin_column' 	=> true,
			'query_var'         	=> true,
			'rewrite'           	=> array( 'slug' => 'wd_couple_category' ),				
			'public'				=> true,
		));
	}
	/* Create Sortcode */
	protected function initArrShortcodes(){
		$this->arrShortcodes 		= array('wd_couple_info','wd_couple_gallery','wd_timeline_couple','wd_couple_event','wd_couple_impression','wd_couple_all');
	}

	protected function initArrRegisterVC(){
		$this->arrVisualcomposer 	= array('wd_vc_couple_info','wd_vc_couple_gallery','wd_vc_timeline_couple','wd_vc_couple_event','wd_vc_couple_impression','wd_vc_couple_all');
	}
	protected function initShortcodes(){
		foreach($this->arrShortcodes as $shortcode){
			if( file_exists(WDC_SHORTCODE."/{$shortcode}.php") ){
				require_once WDC_SHORTCODE."/{$shortcode}.php";
			}	
		}
	}
	public function wd_couple_load_visual(){
		foreach ($this->arrVisualcomposer as $visual) {
			if( file_exists(WDC_VISUAL."/{$visual}.php") ){
				require_once WDC_VISUAL."/{$visual}.php";
			}
		}
    }
	protected function wd_couple_checkPluginVC(){
		$_active_vc = apply_filters('active_plugins',get_option('active_plugins'));
		if(in_array('js_composer/js_composer.php',$_active_vc)){
			return true;
		}else{
			return false;
		}
	}
    /*Custom Mete Post*/
	public function wd_couple_create_section() {
		if(post_type_exists('wd_couple')) {
			add_meta_box("wp_cp_custom_couple", esc_html__("Config couple", 'wpdance'), array($this,"wd_couple_show"), "wd_couple", "normal", "high");

			add_meta_box("wp_cp_couple_gallary_image", esc_html__("Gallery Image", 'wpdance'), array($this,"wd_couple_gallery_image"), "wd_couple", "normal", "high");
		}
	}
	public function wd_couple_show(){
		require_once WDC_INCLUDES.'/wd_couple_meta.php';
	}

	public function wd_couple_gallery_image(){
		require_once WDC_INCLUDES.'/wd_couple_gallery_image.php';
	}

	public function wd_couple_save_data($post_id, $post) {
		if(defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
		// Custom Couple
		if( isset($_POST['custom_post_wd_couple']) && $_POST['custom_post_wd_couple'] == "custom_post_wd_couple" ){
			$_array_value_att	  = array('wd_bridal_name',
				'wd_bridal_file_url',
				'wd_bridal_date',
				'wd_bridal_gender',
				'wd_bridal_employment',
				'wd_bridal_address',
				'wd_bridal_description',
				'wd_bridal_father_name',
				'wd_bridal_mother_name',
				'wd_bridal_facebook',
				'wd_bridal_twitter',
				'wd_bridal_pinterest',
				'wd_bridal_instagram',
				'wd_groom_name',
				'wd_groom_file_url',
				'wd_groom_date',
				'wd_groom_gender',
				'wd_groom_employment',
				'wd_groom_address',
				'wd_groom_description',
				'wd_groom_father_name',
				'wd_groom_mother_name',
				'wd_groom_facebook',
				'wd_groom_twitter',
				'wd_groom_pinterest',
				'wd_groom_instagram',
		  		'wd_groom_wedding_day',
				'wd_groom_wedding_location',
				'wd_groom_wedding_des'
										  );
			$_default_post_config = array();
			foreach($_array_value_att as $key=>$value){
				$_default_post_config["{$value}"] = isset($_POST["{$value}"])?$_POST["{$value}"]: '';
			}
			$ret_str = serialize($_default_post_config);
			update_post_meta($post_id,'_tvlgiao_wpdance_custom_couple',base64_encode($ret_str));	
		}
		// Image Gallery Image
		if( isset($_POST['wd_couple_image_galley_data']) && $_POST['wd_couple_image_galley_data'] == "wd_couple_image_galley_data" ){
	        $attachment_ids = sanitize_text_field( $_POST['image_gallery'] );
	        // turn comma separated values into array
	        $attachment_ids = explode( ',', $attachment_ids );
	        // clean the array
	        $attachment_ids = array_filter( $attachment_ids  );
	        // return back to comma separated list with no trailing comma. This is common when deleting the images
	        $attachment_ids =  implode( ',', $attachment_ids );

	        update_post_meta( $post_id, '_wd_couple_image_gallery', $attachment_ids );	
		}		

	}

	public function wd_couple_function(){
		require_once plugin_dir_path( __FILE__ ).'wd_function.php';
	}		
	public function wd_couple_activate() {
		$this->wd_couple_register();
		flush_rewrite_rules();
	}
	public function wd_couple_deactivate() {
		flush_rewrite_rules();
	}
		
	protected function init_trigger(){
		add_image_size('couple_image_size',200,260,true); 
		add_image_size('couple_image_size_thumnail',300,300,true); 
	}
	public function init_admin_script() {
		if (function_exists('wp_enqueue_media')) {
			wp_enqueue_script('admin_media_lib_35', WDC_JS . '/admin-media-lib-35.js', 'jquery', false,false);
		} else {
			wp_enqueue_style('thickbox');
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_enqueue_script('admin_media_lib', 	WDC_JS . '/admin-media-lib.js', 'jquery', false,false);
		}
		// CSS
		wp_enqueue_style('jquery-ui-core');
		wp_enqueue_style('wd-admin-couple-css', 	WDC_CSS.'/wd-admin-couple.css');
       	
		// Javascript
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('wd-admin-couple-js', 	WDC_JS.'/wd-admin-couple.js');
		
	}	
	public function init_script(){
		wp_enqueue_style('prettyPhoto-core', 		WDC_CSS.'/prettyPhoto.css');
		wp_enqueue_script('jquery');
		wp_enqueue_script('prettyPhoto-core', 		WDC_JS.'/jquery.prettyPhoto.min.js');
		wp_enqueue_script('Couple.Main.js', 	    WDC_JS.'/main.js');
	}
	protected function constant(){
		//define('DS',DIRECTORY_SEPARATOR);	
		if( !defined('WDC_BASE') ){
			define('WDC_BASE'		,  	plugins_url( '', __FILE__ )	);
			define('WDC_SHORTCODE'	, 	plugin_dir_path( __FILE__ ) . 'shortcode' );
			define('WDC_VISUAL'		, 	plugin_dir_path( __FILE__ ) . 'visualcomposer' );
			define('WDC_ASSETS'		,  	plugins_url( '', __FILE__ ).'/assets' );
			define('WDC_INCLUDES'	, 	plugin_dir_path( __FILE__ ).'includes');
			define('WDC_JS'			, 	WDC_ASSETS . '/js'		);
			define('WDC_CSS'		, 	WDC_ASSETS . '/css'		);
			define('WDC_IMAGE'		, 	WDC_ASSETS . '/images'	);
			define('WDC_TEMPLATE' 	, 	dirname(__FILE__) . '/templates'	);
			
		}
	}

	function add_customizer() {
        if(!function_exists ('tvlgiao_wpdance_customize_setting_couple')){
			function tvlgiao_wpdance_customize_setting_couple($wp_customize){
				/*--------------------------------------------------------------*/
				/*						 CUSTOM couple       					*/
				/*--------------------------------------------------------------*/
				$wp_customize->add_panel( 'tvlgiao_wpdance_custom_couple', array(
			        'title' 			=> esc_html__( 'WPDANCE - Couple Setting', 'wpdance' ),
			        'description' 		=> esc_html__( '', 'wpdance'),
			        'priority' 			=> 520,
			    ));
	 			$wp_customize->add_section( 'tvlgiao_wpdance_custom_couple_general_setting' , array(
	 				'title'       		=> esc_html__( 'Single Couple Image', 'wpdance' ),
	 				'description' 		=> esc_html__('', 'wpdance') ,
	 				'panel'	 			=> 'tvlgiao_wpdance_custom_couple',
	 				'priority'    		=> 5,
	 			));
	 			
	 			//---------------------------------------------------------------//
	 			$wp_customize->add_setting('tvlgiao_wpdance_custom_couple_image1', array(
	 				'default'        	=> WDC_IMAGE.'/icon_flower_couple.png',
					'sanitize_callback' => 'tvlgiao_wpdance_sanitize_html',
					'capability' 		=> 'edit_theme_options'
				));

	 			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tvlgiao_wpdance_custom_couple_image1', array(
			        'label'    			=> esc_html__( 'Icon 1', 'wpdance' ),
			        'description'    	=> esc_html__( 'Recommend Size: 250px x 75px', 'wpdance' ),
			        'settings' 			=> 'tvlgiao_wpdance_custom_couple_image1',
			        'section'  			=> 'tvlgiao_wpdance_custom_couple_general_setting',
			    )));

			    $wp_customize->add_setting('tvlgiao_wpdance_custom_couple_image2', array(
	 				'default'        	=> WDC_IMAGE.'/Store_h3_1.png',
					'sanitize_callback' => 'tvlgiao_wpdance_sanitize_html',
					'capability' 		=> 'edit_theme_options'
				));

	 			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tvlgiao_wpdance_custom_couple_image2', array(
			        'label'    			=> esc_html__( 'Icon 2', 'wpdance' ),
			        'description'    	=> esc_html__( 'Recommend Size: 170px x 85px', 'wpdance' ),
			        'settings' 			=> 'tvlgiao_wpdance_custom_couple_image2',
			        'section'  			=> 'tvlgiao_wpdance_custom_couple_general_setting',
			    )));
			    
			}
		}
		
		add_action('customize_register','tvlgiao_wpdance_customize_setting_couple' );
    }
}
$_wd_couple = new WD_Couple; // Start an instance of the plugin class 
?>