<?php
if (!class_exists('WD_Packages_Admin_Page')) {
	class WD_Packages_Admin_Page {
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

		protected $parkage_name = 'admin_page';
		protected $list_field 	= array(
			'wd_theme_guide' 				=> 'Theme Guide',
			'wd_package_shortcode' 			=> 'Shortcodes',
			'wd_package_widget' 			=> 'Widgets',
			'wd_package_portfolio' 			=> 'Portfolio',
			'wd_package_team' 				=> 'Team Member',
			'wd_package_quickshop' 			=> 'Quickshop (Woocommerce)',
			'wd_package_shop_by_color' 		=> 'Shop By Color (Woocommerce)',
			'wd_package_faq_post_type' 		=> 'FAQs (Post Type)',
			'wd_package_feature_post_type' 	=> 'Feature (Post Type)',
		);

		public function __construct(){
			$this->constant();
			add_action('admin_enqueue_scripts', array( $this, 'admin_init_script' ));
			add_action('admin_menu', array($this, 'tvlgiao_wpdance_package_admin_page_register'));
		}
		
		protected function constant(){
			define('WDADMIN_BASE'		,   plugin_dir_path( __FILE__ ));
			define('WDADMIN_BASE_URI'	,   plugins_url( '', __FILE__ ));
			
			define('WDADMIN_JS'			, 	WDADMIN_BASE_URI . '/js'		);
			define('WDADMIN_CSS'		, 	WDADMIN_BASE_URI . '/css'		);
			define('WDADMIN_IMAGE'		, 	WDADMIN_BASE_URI . '/images'	);
		}
		/******************************** Team POST TYPE INIT START ***********************************/

		public function tvlgiao_wpdance_package_admin_page_register(){
		    add_menu_page( //or add_theme_page
		        'WD Packages',     // page title
		        'WD Packages',     // menu title
		        'manage_options',   // capability
		        'wd-package-setting',     // menu slug
		        array($this, 'tvlgiao_wpdance_package_admin_page_callback'), // callback function
		        WDADMIN_IMAGE.'/icon.png', //icon (dashicons-universal-access-alt)
		        59 //position
		    );
		    //call register settings function
		    add_action( 'admin_init', array($this, 'tvlgiao_wpdance_package_admin_page_field_setting_register') );
		}

		public function tvlgiao_wpdance_package_admin_page_field_setting_register() {
		    //register our settings
		    register_setting( 'wd-package-admin-page-setting', 'wd_packages' );
		}

		public function tvlgiao_wpdance_package_admin_page_callback(){ ?>
		    <div class="wrap wd_parkage_admin_page" id="wd_parkage_admin_page_setting">
				<h2><?php esc_html_e("WD Packages Setting", 'wpdancelaparis'); ?></h2>
				<p><?php esc_html_e("Select the packages you want to use on the theme.", 'wpdancelaparis'); ?></p>
				<?php settings_errors(); ?>
				<br class="clear" />
				<!-- GET STARTED -->
				<?php 
				$checked 	= 'checked="checked"';
				$selected 	= 'selected="selected"';
				?>
				<div class="tab-content">
					<div id="setting" class="tab-pane fade in active">
						<form method="post" action="options.php">
						    <?php 
						    settings_fields('wd-package-admin-page-setting');
						    do_settings_sections('wd-package-admin-page-setting');
						    $options = get_option('wd_packages');
						    ?>
						    <table class="form-table">
						    	<tr valign="top">
						    		<th scope="row"><?php echo esc_html_e("Theme Manager Mode", 'wpdancelaparis'); ?></th>
						    		<td>
						    			<select name="wd_packages[wd_theme_manager_mode]">
											  <option <?php echo ( !empty($options['wd_theme_manager_mode']) && $options['wd_theme_manager_mode'] == 'theme_option') ? 'selected="selected"' : ''; ?> value="theme_option"><?php echo esc_html_e("Theme Option", 'wpdancelaparis'); ?></option>
											  <option <?php echo ( !empty($options['wd_theme_manager_mode']) && $options['wd_theme_manager_mode'] == 'customize') ? 'selected="selected"' : ''; ?> value="customize"><?php echo esc_html_e("Customize", 'wpdancelaparis'); ?></option>
										</select>
									</td>
						    	</tr>
						    	<?php foreach ($this->list_field as $key => $value): ?>
						    		<?php $checked = (empty($options['verify_submit']) || !empty($options[$key])) ? 'checked="checked"' : ''; ?>
					    			<tr valign="top">
							    		<th scope="row"><?php echo $value; ?></th>
							    		<td><input type="checkbox" name="wd_packages[<?php echo $key; ?>]" value="1" <?php echo $checked; ?> >
							    		</td>
							    	</tr>
						    	<?php endforeach ?>
						    	<input type="hidden" name="wd_packages[verify_submit]" value="1" >
						    </table>
						    <?php submit_button(); ?>
						</form>
					</div>
				</div>
			</div>
		<?php
		} //end content admin page

		public function admin_init_script($hook){
			if ($hook == 'toplevel_page_wd-package-setting') {
				wp_enqueue_style('wd-package-admin-page-css', 			WDADMIN_CSS.'/style.css');
			}
		}
	}
	WD_Packages_Admin_Page::get_instance();  // Start an instance of the plugin class 
}

