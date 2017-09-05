<?php 
if (!class_exists('Tvlgiao_Wpdance_Admin_GeneralTheme')) {
	class Tvlgiao_Wpdance_Admin_GeneralTheme extends Tvlgiao_Wpdance_GeneralTheme{
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
			$this->constants();
			add_action('admin_enqueue_scripts',array($this,'load_script_style'));

		 	/* Load custom field */
			require_once TVLGIAO_WPDANCE_THEME_METABOX.'/wd_custom_fields.php';
		}
		public function constants(){
			define('TVLGIAO_WPDANCE_THEME_METABOX_JS'		, TVLGIAO_WPDANCE_THEME_METABOX_URI . '/js');
			define('TVLGIAO_WPDANCE_THEME_METABOX_CSS'		, TVLGIAO_WPDANCE_THEME_METABOX_URI . '/css');
			define('TVLGIAO_WPDANCE_THEME_METABOX_IMAGES'	, TVLGIAO_WPDANCE_THEME_METABOX_URI . '/images');
		}

		public function load_script_style(){
			/*----------------- Style ---------------------*/
			wp_enqueue_style('tvlgiao-wpdance-admin', 	TVLGIAO_WPDANCE_THEME_METABOX_CSS .'/wd-admin.css');
			/*----------------- Script ---------------------*/
			wp_enqueue_script('wd-custom-meta-box-js', 	TVLGIAO_WPDANCE_THEME_METABOX_JS .'/wd_custom_post_layout.js');
		}
	}
	Tvlgiao_Wpdance_Admin_GeneralTheme::get_instance();
}
?>