<?php
if (!class_exists('WD_Quickshop')) {
	class WD_Quickshop {
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

		protected $parkage_name = '/wd_quickshop';

		public function __construct(){
			$this->constant();
			add_action('wp_enqueue_scripts',array($this,'init_script'));
			//$this->init_script();
			$this->init_trigger();
			$this->init_handle();
		}

		protected function constant(){
			define('QS_BASE'		,   plugin_dir_path( __FILE__ ) );
			define('QS_BASE_URI'	,   plugins_url( '', __FILE__ ) );
			define('QS_JS'		, 	QS_BASE_URI . '/js'			);
			define('QS_CSS'		, 	QS_BASE_URI . '/css'		);
			define('QS_IMAGE'	, 	QS_BASE_URI . '/images'		);
		}
		
		public function add_quickshop_button(){
		
			global $post, $product, $woocommerce;;
			$btn_label = esc_html__("QUICK SHOP",'wpdancelaparis');	
			$prod_url = get_admin_url()	. "admin-ajax.php?ajax=true&action=load_product_content&product_id=".$product->get_id();	
			?>
			<a class="wd_quickshop_handler" title="<?php esc_html_e('Quick View','wpdancelaparis');?>" href="<?php echo esc_url($prod_url); ?>">
				<span class="qs_inner1">
					<span class="qs_inner2"> 
						<?php 
							echo $btn_label;
						?>
					</span>
				</span>
			</a>
		<?php	
		}	
		
		public function add_quickshop_js(){
		?>
			<script type="text/javascript">
				var _qs_ajax_uri = '<?php echo admin_url('admin-ajax.php'); ?>';
			</script>
		<?php	
		}
		public function quickshop_init_product_id(){
			global $post, $product, $woocommerce;
			echo "<input type='hidden' value='{$product->get_id()}' class='hidden_product_id product_hidden_{$product->get_id()}'>";
		}
		
		public function update_qs_add_to_cart_url(  $cart_url ){
			$ref_url = wp_get_referer();
			$ref_url = remove_query_arg( array('added-to-cart','add-to-cart') , $ref_url );
			$ref_url = add_query_arg( array( 'add-to-cart' => $this->id ),$ref_url );
			return esc_url($ref_url);
		}
		
		protected function init_trigger(){
			add_action('woocommerce_after_shop_loop_item', array( $this, 'quickshop_init_product_id'), 100000000000 );
			
			
			add_action('wp_footer', array($this,'add_quickshop_js'), 100000000000000 );		
			
			add_action('tvlgiao_wpdance_button_shop_loop', array( $this, 'add_quickshop_button'), 5 );
			//add_action('woocommerce_after_shop_loop_item', array( $this, 'add_quickshop_button'), 1 );
			
			/** Build wd_quickshop_single_product_summary **/
			/*add_action( 'wd_quickshop_single_product_summary', 'woocommerce_template_single_title', 5 );
			//add_action( 'wd_quickshop_single_product_summary', 'woocommerce_template_single_meta', 6 );
			remove_action( 'wd_quickshop_single_product_summary', array($this,'wd_template_single_sku'), 6 );
			add_action( 'wd_quickshop_single_product_summary', array($this,'wd_template_single_sku'), 4 );
			
			//remove_action( 'wd_quickshop_single_product_summary', 'woocommerce_template_loop_rating', 7 );
			add_action( 'wd_quickshop_single_product_summary', 'woocommerce_template_loop_rating', 3 );
			//add_action( 'wd_quickshop_single_product_summary', array($this,'wd_quickshop_product_availability'), 8 );
			add_action( 'wd_qs_before_product_image', 'woocommerce_show_product_sale_flash', 10 );
			
			remove_action( 'wd_quickshop_single_product_summary', 'woocommerce_template_single_price', 10 );
			add_action( 'wd_quickshop_single_product_summary', 'woocommerce_template_single_price', 2 );
			
			add_action( 'wd_quickshop_single_product_summary', 'woocommerce_template_single_add_to_cart', 11 );  		
			//add_action( 'wd_quickshop_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
			add_action( 'wd_quickshop_single_product_summary',  array($this,'wd_template_single_excerpt'), 20 );*/
			
			add_action( 'wd_quickshop_single_product_summary', 'woocommerce_template_single_title', 1 );
			add_action( 'wd_quickshop_single_product_summary', 'woocommerce_template_single_price', 12 );
			add_action( 'wd_quickshop_single_product_summary', 'woocommerce_template_single_rating', 3 );
			add_action( 'wd_quickshop_single_product_summary', array($this,'wd_template_single_sku'), 5 );
			//add_action( 'wd_quickshop_single_product_summary', 'wd_template_single_availability', 4 );
			add_action( 'wd_qs_before_product_image', 'woocommerce_show_product_sale_flash', 10 );
			add_action( 'wd_quickshop_single_product_summary',  'woocommerce_template_single_excerpt', 11 );
			//add_action( 'wd_quickshop_single_product_summary', 'woocommerce_template_single_add_to_cart', 20 ); 
			add_action( 'wd_quickshop_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
			
		}
		public function add_product_title(){
			global $post, $product;
			$_uri = esc_url(get_permalink($post->ID));
			echo "<h1 class=\"product_title entry-title\">";
			echo "<a href='{$_uri}'>". esc_attr(get_the_title()) ."</a>";
			echo "</h1>";
		}
		
		public function wd_template_single_excerpt(){
			global $product, $post;
			if ( ! $product->post->post_excerpt ) return;
			?>
			<div class="short-description">
				<h6 class="short-description-title"><?php esc_html_e('Quick Overview','wpdancelaparis') ?></h6>
				<div class="std">
				<?php echo substr(strip_tags ($product->post->post_excerpt),0,300).'[...]'; ?>
				</div>	
			</div>';
			<?php
		}
		
		public function wd_template_single_sku(){
			global $product, $post;
			if ($product->get_sku()) {
				$sku_label = __("Sku:",'wpdancelaparis');
				echo "<p class='wd_product_sku product_meta'>" . $sku_label . " <span class=\"product_sku sku\">" . esc_attr($product->get_sku()) . "</span></p>";
			}
		}

		public function wd_quickshop_product_availability(){
			global $product;
			$_product_stock = get_product_availability($product);
			?>	
				<p class="availability stock <?php echo esc_attr($_product_stock['class']);?>"><?php esc_html_e('Availability','wpdancelaparis');?>: <span><?php echo esc_attr($_product_stock['availability']);?></span></p>	
			<?php
		}	
		
		
		public function load_product_content_callback(){
			$prod_id = absint($_GET['product_id']);
			$this->id = $prod_id;
			global $post, $product, $woocommerce;
			$post = get_post( $prod_id );
			$product = get_product( $prod_id );
			if( $prod_id <= 0 ){
				die('Invalid Products');
			}
			if( !isset($post->post_type) || strcmp($post->post_type,'product') != 0 ){
				die('Invalid Products');
			}
			
			add_filter('woocommerce_add_to_cart_url', array($this, 'update_qs_add_to_cart_url'),10);
			
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 1000 );
			remove_action( 'woocommerce_product_thumbnails', 'woocommerce_template_single_sharing', 50 );
			ob_start();	
			
			?>		
				
			<div class="woocommerce woocommerce-page">
				<div itemscope itemtype="http://schema.org/Product" id="product-<?php echo get_the_ID();?>" class="wd_quickshop product">
					<div class="images">
						<?php do_action( 'wd_qs_before_product_image' ); ?>		
						<?php		
						if ( has_post_thumbnail() ) {
						
							$image_title 		= esc_attr( $product->get_title() );
							$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ),array( 'alt' => $image_title, 'title' => $image_title ) );
							$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
							$attachment_count   = count( $product->get_gallery_attachment_ids() );					
							echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image cloud-zoom zoom wd_qs_main_image" title="%s"  id=\'qs-zoom\' rel="position:\'right\',showTitle:1,titleOpacity:0.5,lensOpacity:0.5,fixWidth:362,fixThumbWidth:72,fixThumbHeight:72,adjustX: 0, adjustY:0">%s</a>', $image_link, $image_title, $image ), $post->ID );
		
						} else {
							echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" class="attachment-shop_single wp-post-image wd_qs_main_image" />';
						}
						$attachment_ids = $product->get_gallery_attachment_ids();
						
						if ( $attachment_ids ) {
							?>
							
							<div class="thumbnails list_carousel">
						
								<ul class="qs-thumbnails">
								
									<?php
									
										if(has_post_thumbnail()) {
											array_unshift($attachment_ids, get_post_thumbnail_id($post->ID));
										}
								
										$loop = 0;
										$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
								
										foreach ( $attachment_ids as $attachment_id ) {
											
											$wrapClasses = array('quickshop-thumb-'.$columns.'col', 'wd_quickshop_thumb','pop_cloud_zoom cloud-zoom-gallery');
								
											$classes = array('attachment-shop_thumbnail');
								
											if ( $loop == 0 || $loop % $columns == 0 )
												$wrapClasses[] = 'first';
												
											if( $loop == 0 ) {
												$wrapClasses[] = 'firstThumb';
											}
								
											if ( ( $loop + 1 ) % $columns == 0 )
												$wrapClasses[] = 'last';
											
											$image_class = esc_attr( implode( ' ', $classes ) );
											
											$lrgImg = wp_get_attachment_image_src($attachment_id, 'shop_single');
											$lrgImg_full = wp_get_attachment_image_src($attachment_id, 'full');
																				
											echo '<li><a href="'.$lrgImg_full[0].'"rel="useZoom: \'qs-zoom\', smallImage: \''. $lrgImg[0] .'\'"  class="'.esc_attr( implode( ' ', $wrapClasses ) ).'">'.wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ), false, array('class' => $image_class) ).'</a></li>'; 
								
											$loop++;
										}
								
									?>
									</ul>
									<div class="slider_control">
										<a id="qs_thumbnails_prev" class="prev" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
										<a id="qs_thumbnails_next" class="next" href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i>
</a>
									</div>	
							</div>
							<?php
						}
					?>
					
						<div class="details_view">
							<a href="<?php echo the_permalink();?>" title="<?php esc_html_e('View Details','wpdancelaparis');?>" ><?php esc_html_e('View Details','wpdancelaparis');?></a>
						</div>
						
					</div>
			
					<div class="summary entry-summary">
					
						<?php do_action( 'wd_quickshop_single_product_summary' ) ?>
						
					</div><!-- .summary -->
					
				</div><!-- #product-<?php echo get_the_ID();?> -->	
			</div>
			<?php if ($product->get_type() == 'variable'): ?>
				<script type='text/javascript' src='<?php echo QS_JS.'/add-to-cart-variation.min.js'; ?>'></script>
			<?php endif ?>
			<?php
			remove_filter( 'woocommerce_add_to_cart_url', array($this, 'update_qs_add_to_cart_url') );
			$_ret_html = ob_get_contents();
			ob_end_clean();
			wp_reset_query();
			die($_ret_html);
		}
		 
		protected function init_handle(){
			add_action('wp_ajax_load_product_content', array( $this, 'load_product_content_callback') );
			add_action('wp_ajax_nopriv_load_product_content', array( $this, 'load_product_content_callback') );		
		}	 
		
		public function init_script(){
			
			
			//wp_enqueue_script( 'wc-add-to-cart-variation' );	
			
			wp_enqueue_style( 'prettyPhoto-core'	, QS_CSS.'/prettyPhoto.css');
			wp_enqueue_style( 'cloud-zoom-core'		, QS_CSS.'/cloud-zoom.css');
			wp_enqueue_style( 'wd-quickshop-css'	, QS_CSS.'/quickshop.css');

			wp_enqueue_script('jquery');
			wp_enqueue_script( 'TweenMax'			, QS_JS.'/TweenMax.min.js');
			wp_enqueue_script( 'prettyPhoto-core'	, QS_JS.'/jquery.prettyPhoto.min.js',array('jquery','TweenMax'));
			wp_enqueue_script( 'cloud-zoom-core'	, QS_JS.'/cloud-zoom.1.0.2.js',false,false,true );
			wp_enqueue_script( 'jquery.money'		, QS_JS.'/money.min.js',false,false,true );
			wp_enqueue_script( 'carouFredSel-core'	, QS_JS.'/jquery.carouFredSel-6.2.1.min.js',false,false,true );
			wp_enqueue_script( 'wd-quickshop-js'	, QS_JS.'/quickshop.js',false,false,true);
		}	
	}	
	add_action('woocommerce_init', 'wd_package_quick_shop_load' );
	function wd_package_quick_shop_load(){
		WD_Quickshop::get_instance();
	}
}
?>