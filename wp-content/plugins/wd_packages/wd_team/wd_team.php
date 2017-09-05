<?php
if (!class_exists('WD_Team')) {
	class WD_Team {
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

		protected $parkage_name = '/wd_team';

		public function __construct(){
			$this->constant();
			
			/****************************/
			// Register Team post type
			add_action('init', array($this, 'tvlgiao_wpdance_register_team_post_type'));

			add_theme_support('post-thumbnails', array('team'));
			
			add_action('admin_enqueue_scripts',array($this,'init_admin_script'));
			
			add_action('admin_menu', array( $this,'wd_team_create_section' ) );	
			
			add_filter('attribute_escape', array($this,'rename_second_menu_name') , 10, 2);
			
			add_action('save_post', array($this,'wd_team_save_data') , 1, 2);
			
			add_action('template_redirect', array($this,'wd_team_template_redirect') );
			
			$this->init_trigger();
			$this->init_handle();
		}
		
		protected function constant(){
			define('WDT_BASE'		,   plugin_dir_path( __FILE__ ));
			define('WDT_BASE_URI'	,   plugins_url( '', __FILE__ ));
			define('WDT_JS'			, 	WDT_BASE_URI . '/js'		);
			define('WDT_CSS'		, 	WDT_BASE_URI . '/css'		);
			define('WDT_IMAGE'		, 	WDT_BASE_URI . '/images'	);
			define('WDT_TEMPLATE' 	, 	WDT_BASE . '/templates'	);
			define('WDT_INCLUDES'	, 	WDT_BASE . '/includes'	);
		}

		/******************************** TEAM POST TYPE ***********************************/
		public function tvlgiao_wpdance_register_team_post_type(){
			if (!post_type_exists('team')) {
				register_post_type('team', array(
					'exclude_from_search' 	=> true,
					'labels' 				=> array(
		                'name' 				=> _x('WD Team', 'post type general name','wpdancelaparis'),
		                'singular_name' 	=> _x('WD Team', 'post type singular name','wpdancelaparis'),
		                'add_new' 			=> _x('Add Member', 'Team','wpdancelaparis'),
		                'add_new_item' 			=> sprintf( __( 'Add New %s', 'wpdancelaparis' ), __( 'Member', 'wpdancelaparis' ) ),
						'edit_item' 			=> sprintf( __( 'Edit %s', 'wpdancelaparis' ), __( 'Member', 'wpdancelaparis' ) ),
						'new_item' 				=> sprintf( __( 'New %s', 'wpdancelaparis' ), __( 'Member', 'wpdancelaparis' ) ),
						'all_items' 			=> sprintf( __( 'All %s', 'wpdancelaparis' ), __( 'Members', 'wpdancelaparis' ) ),
						'view_item' 			=> sprintf( __( 'View %s', 'wpdancelaparis' ), __( 'Member', 'wpdancelaparis' ) ),
						'search_items' 			=> sprintf( __( 'Search %a', 'wpdancelaparis' ), __( 'Members', 'wpdancelaparis' ) ),
						'not_found' 			=>  sprintf( __( 'No %s Found', 'wpdancelaparis' ), __( 'Members', 'wpdancelaparis' ) ),
						'not_found_in_trash' 	=> sprintf( __( 'No %s Found In Trash', 'wpdancelaparis' ), __( 'Features', 'wpdancelaparis' ) ),
		                'parent_item_colon' => '',
		                'menu_name' 		=> __('WD Team','wpdancelaparis'),
					),
					'singular_label' 		=> __('WD Team','wpdancelaparis'),
					'public' 				=> false,
					'publicly_queryable' 	=> true,
					'exclude_from_search' 	=> true,
					'show_ui' 				=> true,
					'show_in_menu' 			=> true,
					'capability_type' 		=> 'page',
					'hierarchical' 			=> false,
					'supports' 			 	=>  array('title','custom-fields','editor','thumbnail'),
					'has_archive' 			=> false,
					'rewrite' 				=>  array('slug'  =>  'team', 'with_front' =>  true),
					'query_var'		 		=> false,
					'can_export' 			=> true,
					'show_in_nav_menus' 	=> false,
					'menu_icon'				=> 'dashicons-groups',
					'menu_position'			=> 58,
				));	
			}
		}

		/******************************** Team POST TYPE INIT START ***********************************/

		public function wd_team_save_data($post_id, $post) {

			if ( ! isset( $_POST['wd_team_box_nonce'] ) )
					return $post_id;
			// verify this came from the our screen and with proper authorization,
			// because save_post can be triggered at other times
			if (!wp_verify_nonce($_POST['wd_team_box_nonce'],'wd_team_box'))
				return $post->ID;

			if ($post->post_type == 'revision')
				return; //don't store custom data twice

			if (!current_user_can('edit_post', $post->ID))
				return $post->ID;

			// OK, we're authenticated: we need to find and save the data
			// Sanitize the user input.
			if('team' == $_POST['post_type']){
				if(isset($_POST['member_role']))
					update_post_meta($post_id,'wd_member_role',$_POST['member_role']);
				if(isset($_POST['member_email']))
					update_post_meta($post_id,'wd_member_email',$_POST['member_email']);
				if(isset($_POST['member_phone']))
					update_post_meta($post_id,'wd_member_phone',$_POST['member_phone']);
				if(isset($_POST['member_link']))
					update_post_meta($post_id,'wd_member_link',$_POST['member_link']);
				if(isset($_POST['member_facebook_link']))
					update_post_meta($post_id,'wd_member_facebook_link',$_POST['member_facebook_link']);
				if(isset($_POST['member_twitter_link']))
					update_post_meta($post_id,'wd_member_twitter_link',$_POST['member_twitter_link']);
				if(isset($_POST['member_rss_link']))
					update_post_meta($post_id,'wd_member_rss_link',$_POST['member_rss_link']);
				if(isset($_POST['member_google_link']))
					update_post_meta($post_id,'wd_member_google_link',$_POST['member_google_link']);
				if(isset($_POST['member_linkedlin_link']))
					update_post_meta($post_id,'wd_member_linkedlin_link',$_POST['member_linkedlin_link']);
				if(isset($_POST['member_dribble_link']))
					update_post_meta($post_id,'wd_member_dribble_link',$_POST['member_dribble_link']);		
			}
			
		}	
		
		
		/******************************** Team POST TYPE INIT END *************************************/
		
		public function wd_team_template_redirect(){
			global $wp_query,$post,$page_datas,$data;
			if( $wp_query->is_page() || $wp_query->is_single() ){
				if ( has_shortcode( $post->post_content, 'team_member' ) ) { 
					add_action('wp_enqueue_scripts',array($this,'init_script'));
				}
			}
		}
		
		public function wd_team_create_section() {
			if(post_type_exists('team')) {
				add_meta_box("wp_cp_custom_carousels", "Member Information", array($this,"show_team"), "team", "normal", "high");
			}
		}

		public function show_team(){
			global $post;
			wp_nonce_field( 'wd_team_box', 'wd_team_box_nonce' );
			?>
			<table class="form-table wd-team-custom-meta-box wd-custom-meta-box-width">
				<tbody>
					<tr>
						<th scope="row"><label>Role:</label></th>
						<td><input type="text" name="member_role" value="<?php echo get_post_meta($post->ID,'wd_member_role',true);?>"/></td> 
					</tr>
					<tr>
						<th scope="row"><label>Email:</label></th>
						<td><input type="email" name="member_email" value="<?php echo get_post_meta($post->ID,'wd_member_email',true);?>"/></td> 
					</tr>

					<tr>
						<th scope="row"><label>Phone:</label></th>
						<td><input type="text" name="member_phone" value="<?php echo get_post_meta($post->ID,'wd_member_phone',true);?>"/></td> 
					</tr>

					<tr>
						<th scope="row"><label>Profile Link:</label></th>
						<td><input type="text" name="member_link" value="<?php echo get_post_meta($post->ID,'wd_member_link',true);?>"/></td> 
					</tr>

					<tr>
						<th scope="row"><label>Facebook Link:</label></th>
						<td><input type="text" name="member_facebook_link" value="<?php echo get_post_meta($post->ID,'wd_member_facebook_link',true);?>"/></td> 
					</tr>
					<tr>
						<th scope="row"><label>Twitter Link:</label></th>
						<td><input type="text" name="member_twitter_link" value="<?php echo get_post_meta($post->ID,'wd_member_twitter_link',true);?>"/></td> 
					</tr>
					<tr>
						<th scope="row"><label>RSS Link:</label></th>
						<td><input type="text" name="member_rss_link" value="<?php echo get_post_meta($post->ID,'wd_member_rss_link',true);?>"/></td> 
					</tr>
					<tr>
						<th scope="row"><label>Google+ Link:</label></th>
						<td><input type="text" name="member_google_link" value="<?php echo get_post_meta($post->ID,'wd_member_google_link',true);?>"/></td> 
					</tr>
					<tr>
						<th scope="row"><label>Linkedln Link:</label></th>
						<td><input type="text" name="member_linkedlin_link" value="<?php echo get_post_meta($post->ID,'wd_member_linkedlin_link',true);?>"/></td> 
					</tr>
					<tr>
						<th scope="row"><label>Dribble Link:</label></th>
						<td><input type="text" name="member_dribble_link" value="<?php echo get_post_meta($post->ID,'wd_member_dribble_link',true);?>"/></td> 
					</tr>
				</tbody>
			</table>
			<?php
		}
			
		
		public function rename_second_menu_name($safe_text, $text) {
			if (__('Team Items', 'wpdancelaparis') !== $text) {
				return $safe_text;
			}

			// We are on the main menu item now. The filter is not needed anymore.
			remove_filter('attribute_escape', array($this,'rename_second_menu_name') );

			return __('WD Team', 'wpdancelaparis');
		}
			
		protected function init_trigger(){
		
		}
		protected function init_handle(){
			add_image_size('wd_team_thumb',400,400,true);  
			require_once WDT_TEMPLATE . "/wd_team_vc_generator.php";
			require_once WDT_TEMPLATE . "/wd_team_member_shortcode.php";
		}	
		
		public function init_admin_script() {
			if (!function_exists('wp_enqueue_media')) {
				wp_enqueue_style('thickbox');
				wp_enqueue_script('media-upload');
				wp_enqueue_script('thickbox');
			}
		}	
		
		
		public function init_script(){
			wp_enqueue_script('jquery');	
			wp_enqueue_script( 'carouFredSel-core', WDT_JS.'/jquery.carouFredSel-6.2.1.min.js',false,false,true);
		}

	}
	WD_Team::get_instance();  // Start an instance of the plugin class 
}