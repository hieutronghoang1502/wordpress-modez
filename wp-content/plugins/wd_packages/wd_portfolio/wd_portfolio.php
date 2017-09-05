<?php
if (!class_exists('WD_Portfolio')) {
	class WD_Portfolio {
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

		protected $parkage_name = '/wd_portfolio';

		private function __construct() {
			$this->constant();
			add_theme_support( 'post-thumbnails', array( 'portfolio' ) );

			register_activation_hook( __FILE__, array( $this, 'wd_portfolio_activate' ) );
			register_deactivation_hook( __FILE__, array( $this, 'wd_portfolio_deactivate' ) );

			add_action( 'init', array( $this, 'wd_portfolio_register' ) );
			add_action( 'vc_before_init', array( $this, 'wd_portfolio_register_taxonomies' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'init_admin_script' ) );
			add_action( 'admin_menu', array( $this, 'wd_portfolio_create_section' ) );
			add_action( 'save_post', array( $this, 'wd_portfolio_save_data' ), 1, 2 );
			add_action( 'template_redirect', array( $this, 'wd_portfolio_template_redirect' ) );
			add_filter( 'attribute_escape', array( $this, 'rename_second_menu_name' ), 10, 2 );

			add_action( 'wp_ajax_load_more_portfolio_gird', array( $this, 'load_more_portfolio_gird' ) );
			add_action( 'wp_ajax_nopriv_load_more_portfolio_gird', array( $this, 'load_more_portfolio_gird', ) );

			add_action( 'wp_ajax_nopriv_more_portfolio_masonry_ajax', array( $this, 'more_portfolio_masonry_ajax', ) );
			add_action( 'wp_ajax_more_portfolio_masonry_ajax', array( $this, 'more_portfolio_masonry_ajax', ) );

			add_filter( 'single_template', array( $this, 'single_portfolio_template' ) );
			add_filter( 'archive_template', array( $this, 'archive_portfolio_template' ) );

			$this->init_trigger();
			$this->init_handle();

			require_once( WDP_BASE . '/templates' . "/template.php" );
			require_once( WDP_BASE . '/templates' . "/wd_vc_generator_portfolio.php" );
			require_once( WDP_BASE . '/templates' . "/wd_portfolio_grid.php" );
			require_once( WDP_BASE . '/templates' . "/wd_portfolio_masonry.php" );
		}

		protected function constant() {
			define( 'WDP_BASE'		,   plugin_dir_path( __FILE__ ) );
			define( 'WDP_BASE_URI'	,   plugins_url( '', __FILE__ ) );
			define( 'WDP_JS', 		WDP_BASE_URI . '/assets/js' );
			define( 'WDP_CSS', 		WDP_BASE_URI . '/assets/css' );
			define( 'WDP_IMAGE',	WDP_BASE_URI . '/assets/images' );
			define( 'WDP_LIBS', 	WDP_BASE_URI . '/assets/libs' );
			define( 'WDP_TEMPLATE',	WDP_BASE . '/templates' );
		}

		public function wd_portfolio_register() {
			$labels = array(
				'name'               => __( 'Portfolio Items', 'wpdancelaparis' ),
				'singular_name'      => __( 'Portfolio Item', 'wpdancelaparis' ),
				'add_new'            => __( 'Add Portfolio Item', 'wpdancelaparis' ),
				'add_new_item'       => __( 'Add New Portfolio Item', 'wpdancelaparis' ),
				'edit_item'          => __( 'Edit Portfolio Item', 'wpdancelaparis' ),
				'new_item'           => __( 'New Portfolio Item', 'wpdancelaparis' ),
				'view_item'          => __( 'View Portfolio Item', 'wpdancelaparis' ),
				'search_items'       => __( 'Search Portfolio Item', 'wpdancelaparis' ),
				'not_found'          => __( 'No Portfolio Items found', 'wpdancelaparis' ),
				'not_found_in_trash' => __( 'No Portfolio Items found in Trash', 'wpdancelaparis' ),
				'parent_item_colon'  => '',
				'menu_name'          => __( 'Portfolio Items', 'wpdancelaparis' ),
			);
			$args   = array(
				'labels'          => $labels,
				'public'          => true,
				'show_ui'         => true,
				'capability_type' => 'post',
				'hierarchical'    => true,
				'rewrite'         => array( 'slug' => 'portfolio' ),
				'supports'        => array(
					'title',
					'thumbnail',
					'editor',
					'excerpt',
					'custom-fields',
				),
				'menu_position'   => 57,
				'menu_icon'       => 'dashicons-index-card',
				'taxonomies'      => array( 'wd-portfolio' ),
			);

			register_post_type( 'portfolio', $args );
		}

		public function wd_portfolio_register_taxonomies() {
			register_taxonomy( 'wd-portfolio-category', 'portfolio', array(
				'hierarchical' => true,
				'label'        => 'Portfolio Category',
				'query_var'    => true,
				'rewrite'      => array( 'slug' => 'portfolio-category' ),
			) );

			if ( count( get_terms( 'wd-portfolio-category', 'hide_empty=0' ) ) == 0 ) {

				register_taxonomy( 'category', 'portfolio', array(
					'hierarchical' => true,
					'label'        => 'Portfolio Category',
				) );

				$_categories = get_categories( 'taxonomy=category&title_li=' );

				foreach ( $_categories as $_cat ) {
					if ( ! term_exists( $_cat->name, 'wd-portfolio-category' ) ) {
						wp_insert_term( $_cat->name, 'wd-portfolio-category' );
					}
				}

				$portfolio = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => '-1' ) );
				if ( $portfolio->have_posts() ):
					while ( $portfolio->have_posts() ) : $portfolio->the_post();
						$post_id = get_the_ID();
						$_terms  = wp_get_post_terms( $post_id, 'category' );
						$terms   = array();
						foreach ( $_terms as $_term ) {
							$terms[] = $_term->term_id;
						}
						wp_set_post_terms( $post_id, $terms, 'wd-portfolio-category' );
					endwhile;
					wp_reset_postdata();
				endif;

				register_taxonomy( 'category', array() );
			}
		}

		public function wd_portfolio_activate() {
			$this->wd_portfolio_register();
			flush_rewrite_rules();
		}

		public function wd_portfolio_deactivate() {
			flush_rewrite_rules();
		}

		public function init_admin_script() {
			if ( function_exists( 'wp_enqueue_media' ) ) {
				wp_enqueue_script( 'admin_media_lib_35', WDP_JS . '/admin-media-lib-35.js', 'jquery', false, false );
			} else {
				wp_enqueue_style( 'thickbox' );
				wp_enqueue_script( 'media-upload' );
				wp_enqueue_script( 'thickbox' );
				wp_enqueue_script( 'admin_media_lib', WDP_JS . '/admin-media-lib.js', 'jquery', false, false );
			}
		}

		public function wd_portfolio_create_section() {
			add_meta_box( 'wd-portfolio-section-options', __( 'Options', 'wpdancelaparis' ), array(
				$this,
				'wd_portfolio_section_options',
			), 'portfolio', 'normal', 'high' );
		}

		public function rename_second_menu_name( $safe_text, $text ) {
			if ( __( 'Portfolio Items', 'wpdancelaparis' ) !== $text ) {
				return $safe_text;
			}

			// We are on the main menu item now. The filter is not needed anymore.
			remove_filter( 'attribute_escape', array( $this, 'rename_second_menu_name' ) );

			return __( 'WD Portfolio', 'wpdancelaparis' );
		}

		public function load_more_portfolio_gird() {
			$query_vars     = json_decode( stripslashes( $_POST['query_vars'] ), true );
			$offset         = isset( $_REQUEST['offset'] ) ? intval( $_REQUEST['offset'] ) : 0;
			$posts_per_page = isset( $_REQUEST['posts_per_page'] ) ? intval( $_REQUEST['posts_per_page'] ) : 8;
			$post_type      = isset( $_REQUEST['post_type'] ) ? $_REQUEST['post_type'] : 'post';
			$id_category    = isset( $_REQUEST['category_id'] ) ? $_REQUEST['category_id'] : '';
			$columns        = isset( $_REQUEST['columns'] ) ? $_REQUEST['columns'] : '';
			$style          = isset( $_REQUEST['style'] ) ? $_REQUEST['style'] : '';
			$tab_rand       = isset( $_REQUEST['tab_rand'] ) ? $_REQUEST['tab_rand'] : '';

			$span_class = "col-sm-" . ( 24 / $columns );

			// New blog
			$args = array(
				'post_type'      => 'portfolio',
				'posts_per_page' => $posts_per_page,
				'offset'         => $offset,
			);

			//Category
			if ( $id_category != - 1 ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'wd-portfolio-category',
						'terms'    => $id_category,
						'field'    => 'term_id',
						'operator' => 'IN',
					),
				);
			}
			$special_portfolio = new WP_Query( $args );

			ob_start();
			if ( $special_portfolio->have_posts() ):
				while ( $special_portfolio->have_posts() ) : $special_portfolio->the_post();
					include( WDP_BASE . '/templates/partials/portfolio_grid.php' );
				endwhile;
				wp_reset_postdata();
			else:
				echo '0';
			endif;

			echo ob_get_clean();
			wp_die();
		}

		public function more_portfolio_masonry_ajax() {
			global $wp_outline_wd_data;

			$offset         = $_POST["offset"];
			$posts_per_page = $_POST["posts_per_page"];
			$columns        = $_POST["columns"];
			$sort        	= $_POST["sort"];
			$order_by       = $_POST["order_by"];
			$image_size     = $_POST["image_size"];
			$style          = $_POST["style"];
			$layout_mode    = $_POST["layout_mode"];
			$random_width   = $_POST["random_width"];
			$tab_rand       = $_POST["tab_rand"];

			$args = array(
				'post_type'           => 'portfolio',
				'posts_per_page'      => $posts_per_page,
				'offset'              => $offset,
				'orderby' 			  => $attr['sort'],
				'order'				  => $attr['order_by'],
				'ignore_sticky_posts' => 1,
			);

			$posts = new WP_Query( $args );

			ob_start();
			if ( $posts->have_posts() ):
				while ( $posts->have_posts() ) : $posts->the_post();
					include( WDP_BASE . '/templates/partials/portfolio_masonry.php' );
				endwhile;
				wp_reset_postdata();
			else:
				echo '0';
			endif;

			echo ob_get_clean();
			wp_die();
		}

		public function single_portfolio_template( $single ) {
			global $post;
			if ( $post->post_type == 'portfolio' && file_exists( WDP_BASE . '/single-portfolio.php' ) ) {
				return WDP_BASE . '/single-portfolio.php';
			}

			return $single;
		}

		public function archive_portfolio_template( $archive ) {
			global $post;
			if ( $post->post_type == 'portfolio' && file_exists( WDP_BASE . '/archive-portfolio.php' ) ) {
				return WDP_BASE . '/archive-portfolio.php';
			}

			return $archive;
		}

		public static function wdp_the_category( $separator = '', $parents = '', $post_id = false ) {
			echo self::wdp_get_the_category_list( $separator, $parents, $post_id );
		}

		public static function wdp_get_the_category_list( $separator = '', $parents = '', $post_id = false ) {
			$categories = get_the_terms( $post_id, 'wd-portfolio-category' );

			$the_list = '';
			if ( '' == $separator ) {
				$the_list .= '<ul class="post-categories">';
				foreach ( $categories as $category ) {
					$the_list .= "\n\t<li>";
					switch ( strtolower( $parents ) ) {
						case 'multiple':
							if ( $category->parent ) {
								$the_list .= get_category_parents( $category->parent, true, $separator );
							}
							$the_list .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . $category->name . '</a></li>';
							break;
						case 'single':
							$the_list .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" >';
							if ( $category->parent ) {
								$the_list .= get_category_parents( $category->parent, false, $separator );
							}
							$the_list .= $category->name . '</a></li>';
							break;
						case '':
						default:
							$the_list .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . $category->name . '</a></li>';
					}
				}
				$the_list .= '</ul>';
			} else {
				$i = 0;
				foreach ( $categories as $category ) {
					if ( 0 < $i ) {
						$the_list .= $separator;
					}
					switch ( strtolower( $parents ) ) {
						case 'multiple':
							if ( $category->parent ) {
								$the_list .= get_category_parents( $category->parent, true, $separator );
							}
							$the_list .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . $category->name . '</a>';
							break;
						case 'single':
							$the_list .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">';
							if ( $category->parent ) {
								$the_list .= get_category_parents( $category->parent, false, $separator );
							}
							$the_list .= "$category->name</a>";
							break;
						case '':
						default:
							$the_list .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . $category->name . '</a>';
					}
					++ $i;
				}
			}

			return $the_list;
		}

		public function wd_portfolio_save_data( $post_id, $post ) {
			// verify this came from the our screen and with proper authorization,
			// because save_post can be triggered at other times
			if ( ( isset( $_POST['wd_portfolio_noncename'] ) && ! wp_verify_nonce( $_POST['wd_portfolio_noncename'], plugin_basename( __FILE__ ) ) ) || ! isset( $_POST['wd_portfolio_noncename'] ) ) {
				return $post->ID;
			}

			if ( $post->post_type == 'revision' ) {
				return;
			} //don't store custom data twice

			if ( ! current_user_can( 'edit_post', $post->ID ) ) {
				return $post->ID;
			}

			// OK, we're authenticated: we need to find and save the data
			// We'll put it into an array to make it easier to loop though. 

			$my_data                            = array();
			$my_data['wd-portfolio']            = $_POST['wd_portfolio'];
			$my_data['wd-portfolio-url']        = $_POST['wd_portfolio_url'];
			$my_data['single_portfolio_layout'] = $_POST['single_portfolio_layout'];

			// Add values of $my_data as custom fields
			foreach ( $my_data as $key => $value ) { //Let's cycle through the $my_data array!
				echo $key;
				update_post_meta( $post->ID, $key, $value );
				if ( ! $value ) {
					delete_post_meta( $post->ID, $key );
				} //delete if blank
			}
		}

		public function wd_portfolio_template_redirect() {
			global $wp_query;
			if ( $wp_query->is_page() || $wp_query->is_single() ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'init_script' ) );
			}
		}

		public static function wd_portfolio_list_categories() {
			$categories = get_terms( 'wd-portfolio-category' );
			$output     = array( '-1' => __( 'All', 'wpdanceelectronics' ) );
			foreach ( $categories as $category ) {
				$output[ $category->name ] = $category->term_id;
			}

			return $output;
		}

		public function wd_portfolio_get_item_classes( $post_id = null ) {
			if ( $post_id === null ) {
				return;
			}
			$_terms = wp_get_post_terms( $post_id, 'wd-portfolio-category' );
			foreach ( $_terms as $_term ) {
				echo " " . $_term->slug;
			}
		}

		public function wd_portfolio_get_attachment_src( $attachment_id, $size_name = 'thumbnail' ) {
			global $_wp_additional_image_sizes;
			$size_name = trim( $size_name );
			$meta      = wp_get_attachment_metadata( $attachment_id );

			if ( empty( $meta['sizes'] ) || empty( $meta['sizes'][ $size_name ] ) ) {

				// let's first see if this is a registered size
				if ( isset( $_wp_additional_image_sizes[ $size_name ] ) ) {
					$height = (int) $_wp_additional_image_sizes[ $size_name ]['height'];
					$width  = (int) $_wp_additional_image_sizes[ $size_name ]['width'];
					$crop   = (bool) $_wp_additional_image_sizes[ $size_name ]['crop'];

					// if not, see if name is of form [width]x[height] and use that to crop
				} elseif ( preg_match( '#^(\d+)x(\d+)$#', $size_name, $matches ) ) {
					$height = (int) $matches[2];
					$width  = (int) $matches[1];
					$crop   = true;
				}

				if ( ! empty( $height ) && ! empty( $width ) ) {
					$resize_path   = $this->wd_portfolio_generate_attachment( $attachment_id, $width, $height, $crop );
					$full_size_url = wp_get_attachment_url( $attachment_id );

					$file_name = basename( $resize_path );
					$new_url   = str_replace( basename( $full_size_url ), $file_name, $full_size_url );

					if ( ! empty( $resize_path ) ) {
						$meta['sizes'][ $size_name ] = array(
							'file'   => $file_name,
							'width'  => $width,
							'height' => $height,
						);

						wp_update_attachment_metadata( $attachment_id, $meta );

						return array(
							$new_url,
							$width,
							$height,
						);
					}
				}
			}

			return wp_get_attachment_image_src( $attachment_id, $size_name );
		}

		public function wd_portfolio_generate_attachment( $attachment_id = 0, $width = 0, $height = 0, $crop = true ) {
			$attachment_id = (int) $attachment_id;
			$width         = (int) $width;
			$height        = (int) $height;
			$crop          = (bool) $crop;

			$original_path = get_attached_file( $attachment_id );

			$resize_path = wp_get_image_editor( $original_path, array(
				'width'  => $width,
				'height' => $height,
				'crop'   => $crop,
			) );

			if ( ! is_wp_error( $resize_path ) && ! is_array( $resize_path ) ) {
				return $resize_path;
			} else {
				$orig_info     = pathinfo( $original_path );
				$suffix        = "{$width}x{$height}";
				$dir           = $orig_info['dirname'];
				$ext           = $orig_info['extension'];
				$name          = basename( $original_path, ".{$ext}" );
				$dest_filename = "{$dir}/{$name}-{$suffix}.{$ext}";
				if ( file_exists( $dest_filename ) ) {
					return $dest_filename;
				}
			}

			return '';
		}

		public static function wd_portfolio_get_filetype( $itemSrc ) {
			$pattern = '/youtube\.com\/watch|youtu\.be|vimeo\.com|\b.mov\b|\b.swf\b|\b.avi\b|\b.mpg\b|\b.mpeg\b|\b.mp4\b/i';
			if ( preg_match( $pattern, $itemSrc ) ) {
				return 'wd-fancybox-video';
			} else {
				return 'wd-fancybox-image';
			}
		}

		public function wd_portfolio_section_options() {
			?>
			<div class="wd-portfolio-meta-section">
				<div class="form-wrap">
					<div class="form-field">
						<label for="wd_portfolio"><?php _e( 'Image/Video URL', 'wpdancelaparis' ) ?></label>
						<input type="text" id="wd_portfolio" name="wd_portfolio"
						       value="<?php echo htmlspecialchars( self::wd_portfolio_get_meta( 'wd-portfolio' ) ); ?>"
						       style="width:70%;" />
						<a id="wd_portfolio_media_lib" href="javascript:void(0);" class="button" rel="wd_portfolio">URL from
							Media Library</a>
						<p><?php _e( 'Enter URL for the full-size image or video (youtube, vimeo, swf, quicktime) you want to display in the lightbox gallery. You can also choose Image URL from your Media gallery', 'wpdancelaparis' ) ?></p>
					</div>
					<div class="form-field">
						<label for="wd_portfolio_url"><?php _e( 'Portfolio URL', 'wpdancelaparis' ) ?></label>
						<input type="text" name="wd_portfolio_url"
						       value="<?php echo htmlspecialchars( self::wd_portfolio_get_meta( 'wd-portfolio-url' ) ); ?>" />
						<p><?php _e( 'Enter URL to the live version of the project.', 'wpdancelaparis' ) ?></p>
					</div>
					<div class="wd-single-portfolio-layout">
						<label><?php esc_html_e( 'Single Layout', 'wpdancelaparis' ); ?></label>
						<div class="bg-input select-box ">
							<div class="bg-input-inner config-product">
								<select name="single_portfolio_layout" id="_single_portfolio_layout">
									<option
										value="default" <?php selected( htmlspecialchars( self::wd_portfolio_get_meta( 'single_portfolio_layout' ) ), 'default' ) ?>>
										<?php esc_html_e( 'Default', 'wpdancelaparis' ); ?>
									</option>
									<option
										value="fullwidth" <?php selected( htmlspecialchars( self::wd_portfolio_get_meta( 'single_portfolio_layout' ) ), 'fullwidth' ) ?>>
										<?php esc_html_e( 'Full Width', 'wpdancelaparis' ); ?>
									</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="wd_portfolio_noncename" id="wd_portfolio_noncename"
				       value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			</div>
			<?php
		}

		public static function wd_portfolio_get_meta( $field ) {
			global $post;
			$custom_field = get_post_meta( $post->ID, $field, true );
			switch ( $field ) {
				case 'wd-portfolio':
					if ( preg_match( '/\.pdf/', $custom_field ) ) {
						$pdf_src      = urlencode( $custom_field );
						$custom_field = "http://docs.google.com/viewer?url=$pdf_src&embedded=true&iframe=true&width=100%&height=100%";
					}
					break;
				default :
					break;
			}

			return $custom_field;
		}

		public function wd_portfolio_item( $atts = array() ) {
			ob_start();
			$this->wd_portfolio_item_show( $atts );
			$content = ob_get_clean();

			return $content;
		}

		public function wd_portfolio_item_show( $atts = array() ) {
			$attr = shortcode_atts( array(
				'id'   => '',
				'slug' => '',
			), $atts );
			$this->show_item_portfolio( $attr['id'], $attr['slug'] );
		}

		public function show_item_portfolio( $id, $slug ) {

		}

		public function wd_portfolio( $atts = array() ) {
			ob_start();
			$this->wd_portfolio_show( $atts );
			$content = ob_get_clean();

			return $content;
		}

		public function wd_portfolio_show( $atts = array() ) {
			$attr = shortcode_atts( array(
				'columns'         => 4,
				'show_filter'     => 'yes',
				'style'           => 'style-1',
				'show_title'      => 'yes',
				'show_categories' => 'yes',
				'show_desc'       => 'no',
				'count'           => '-1',
				'show_pagination' => 'yes',
				'category'        => '',
			), $atts );
			show_wd_portfolio( $attr['columns'], $attr['show_filter'], $attr['style'], $attr['show_categories'], $attr['show_title'], $attr['show_desc'], $attr['count'], $attr['show_pagination'], $attr['category'] );
		}

		protected function init_trigger() {
			add_image_size( 'portfolio_image', 600, 600, true );
		}

		protected function init_handle() {
			add_shortcode( 'wd-portfolio', array( $this, 'wd_portfolio' ) );
			add_shortcode( 'wd-portfolio-item', array( $this, 'wd_portfolio_item' ) );
		}

		public function init_script() {
			global $wp_query;

			wp_enqueue_script( 'jquery-mousewheel',			WDP_LIBS . '/fancybox/jquery.mousewheel.pack.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'jquery-fancybox-pack', 		WDP_LIBS . '/fancybox/jquery.fancybox.pack.js', array( 'jquery' ), false, true );
			wp_register_style( 'jquery-fancybox', 			WDP_LIBS . '/fancybox/jquery.fancybox.css', array(), false, 'all' );
			wp_enqueue_script( 'jquery-fancybox-buttons', 	WDP_LIBS . '/fancybox/helpers/jquery.fancybox-buttons.js', array( 'jquery' ), false, true );
			wp_register_style( 'jquery-fancybox-buttons', 	WDP_LIBS . '/fancybox/helpers/jquery.fancybox-buttons.css', array(), false, 'all' );
			wp_enqueue_script( 'jquery-fancybox-thumbs', 	WDP_LIBS . '/fancybox/helpers/jquery.fancybox-thumbs.js', array( 'jquery' ), false, true );
			wp_register_style( 'jquery-fancybox-thumbs', 	WDP_LIBS . '/fancybox/helpers/jquery.fancybox-thumbs.css', array(), false, 'all' );
			wp_enqueue_script( 'jquery-fancybox-media', 	WDP_LIBS . '/fancybox/helpers/jquery.fancybox-media.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'isotope-pkgd', 				WDP_LIBS . '/isotope-layout/isotope.pkgd.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'isotope-packery', 			WDP_LIBS . '/isotope-packery/packery-mode.pkgd.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'carouFredSel-core',			WDP_JS.'/jquery.carouFredSel-6.2.1.min.js',false,false,true);
			wp_enqueue_script( 'wd-portfolio', 				WDP_JS . '/wd_portfolio.js', array( 'jquery' ), false, true );
			wp_localize_script( 'wd-portfolio', 'portfolio_gird_ajax_object', array(
				'ajax_url_portfolio_gird' => admin_url( 'admin-ajax.php' ),
				'query_vars'              => json_encode( $wp_query->query ),
			) );
		}
	}
	WD_Portfolio::get_instance();
}
