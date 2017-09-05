<?php
//Ajax loadmore product. 
//Template: wd_product_best_selling.php / wd_product_grid_list.php / wd_product_special_slider.php 
add_action( 'wp_ajax_load_more_product', 'load_more_function_post' );
add_action( 'wp_ajax_nopriv_load_more_product', 'load_more_function_post' );
if(!function_exists ('load_more_function_post')){
	function load_more_function_post() {
		$query_vars 		= json_decode( stripslashes( $_POST['query_vars'] ), true );
		$offset 			= isset($_REQUEST['offset'])?intval($_REQUEST['offset']):0;
		$posts_per_page 	= isset($_REQUEST['posts_per_page'])?intval($_REQUEST['posts_per_page']):8;
		$post_type 			= isset($_REQUEST['post_type'])?$_REQUEST['post_type']:'product';
		$id_category 		= isset($_REQUEST['category_id'])?$_REQUEST['category_id']:'-1';
		$data_show 			= isset($_REQUEST['data_show'])?$_REQUEST['data_show']:'total_sales';
		$sort   			= $_POST['sort'];
		$order_by 			= $_POST['order_by'];

		// New Product
		$args = array( 
			'post_type' 		=> 'product', 
			'offset' 			=> $offset, 
			'order' 			=> $sort,
			'posts_per_page' 	=> $posts_per_page,
		);

		//Category
		if( $id_category != -1 ){
			$args['tax_query']= array(
		    	array(
			    	'taxonomy' 		=> 'product_cat',
					'terms' 		=> $id_category,
					'field' 		=> 'term_id',
					'operator' 		=> 'IN'
				)
   			);
		}

		switch ( $order_by ) {
			case 'price':
				$args['meta_key'] = '_price';
				$args['orderby']  = 'meta_value_num';
				break;
			case 'sales':
				$args['meta_key'] = 'total_sales';
				$args['orderby']  = 'meta_value_num';
				break;
			default:
				$args['orderby'] 	= $order_by;
				break;
		}
		
		//Most View Products
		if($data_show == 'mostview_product'){
			$args['meta_key'] 	= '_wd_product_views_count';
			$args['orderby'] 	= 'meta_value_num';
			$args['order'] 		= 'DESC';
		}

		//On Sale Product
		if($data_show == 'onsale_product'){
			$args['meta_query'] = array(
	            'relation' => 'OR',
	            array( // Simple products type
	                'key'           => '_sale_price',
	                'value'         => 0,
	                'compare'       => '>',
	                'type'          => 'numeric'
	            ),
	            array( // Variable products type
	                'key'           => '_min_variation_sale_price',
	                'value'         => 0,
	                'compare'       => '>',
	                'type'          => 'numeric'
	            )
			);
		}
		//Featured Product
		if($data_show == 'featured_product'){
			$args['meta_key'] 	= '_featured';
			$args['meta_value'] = 'yes';
		}

		$products = new WP_Query( $args );
		if ( $products->have_posts() ){
			while ( $products->have_posts() ) : $products->the_post(); 
				wc_get_template_part( 'content', 'product' ); 
			endwhile;	 
		}else{ ?>
		    <div id="wd_status" class="hidden">
		    	<input type="text" value="1" id="tvlgiao_have_post">
			</div> <?php
		} // Have Product
		die();
	}
}


//Ajax loadmore blog. Template: wd_blog_grid_list.php
add_action( 'wp_ajax_load_more_blog', 'load_more_blog_function_special_post' );
add_action( 'wp_ajax_nopriv_load_more_blog', 'load_more_blog_function_special_post' );
if(!function_exists ('load_more_blog_function_special_post')){
	function load_more_blog_function_special_post() {
		$query_vars 				= json_decode( stripslashes( $_POST['query_vars'] ), true );
		$offset 					= isset($_REQUEST['offset'])?intval($_REQUEST['offset']):0;
		$posts_per_page 			= isset($_REQUEST['posts_per_page'])?intval($_REQUEST['posts_per_page']):8;
		$post_type 					= isset($_REQUEST['post_type'])?$_REQUEST['post_type']:'post';
		$id_category 				= isset($_REQUEST['category_id'])?$_REQUEST['category_id']:'-1';
		$data_show 					= isset($_REQUEST['data_show'])?$_REQUEST['data_show']:'recent_blog';
		$columns					= isset($_REQUEST['columns'])?$_REQUEST['columns']:'1';
		$show_data_image_slider		= isset($_REQUEST['show_data_image_slider'])?$_REQUEST['show_data_image_slider']:'1';
		$grid_list_layout			= isset($_REQUEST['grid_list_layout'])?$_REQUEST['grid_list_layout']:'grid';
		$sort   					= $_POST['sort'];
		$order_by 					= $_POST['order_by'];

		$span_class 				= "col-sm-".(24/$columns);
		wp_reset_query();
		// New blog
		$args = array(  
			'post_type' 		=> 'post',  
			'posts_per_page' 	=> $posts_per_page,
			'offset' 			=> $offset,
			'order'				=> $sort,
			'orderby' 			=> $order_by,
		);
		//Category
		if( $id_category != -1 ){
			$args['tax_query']= array(
	    	array(
			    	'taxonomy' 		=> 'category',
					'terms' 		=> $id_category,
					'field' 		=> 'term_id',
					'operator' 		=> 'IN'
				)
			);
		}
		//Most View Products
		if($data_show == 'mostview_blog'){
			$args['meta_key'] 	= '_wd_post_views_count';
			$args['orderby'] 	= 'meta_value_num';
			$args['order'] 		= 'DESC';
		}
		//Most Comment
		if($data_show == 'comment_blog'){
			$args['orderby']		= 'comment_count';
		}	
		$special_blogs 		= new WP_Query( $args );
		if ( $special_blogs->have_posts() ){
			$class_masonry_item = ($grid_list_layout == 'grid-masonry') ? 'gallery_item' : '';
			$image_size 		= ($columns == 1 || $grid_list_layout == 'grid-masonry') ? 'full' : 'post-thumbnail';
			while ( $special_blogs->have_posts() ) : $special_blogs->the_post();  ?>
				<div class="wd-load-more-content-blog <?php echo esc_attr($span_class);?> <?php echo esc_attr($class_masonry_item);?>">
					<?php if ($show_data_image_slider == "1"): ?>
							<?php echo tvlgiao_wpdance_get_content_blog($image_size); ?>
						<?php else: ?>
							<?php echo tvlgiao_wpdance_get_content_blog($image_size, get_post_format()); ?>
						<?php endif ?>
				</div>
			<?php endwhile;	
		}else{ ?>
		    <div id="wd_status" class="hidden">
		    	<input type="text" value="1" id="tvlgiao_have_post">
			</div> <?php
		} // Have Product
	    die();	
	}
}

//Ajax loadmore blog masonry. Template: wd_blog_mansory.php
add_action('wp_ajax_nopriv_load_more_post_masonry', 'tvlgiao_wpdance_more_post_masonry_ajax'); 
add_action('wp_ajax_load_more_post_masonry', 'tvlgiao_wpdance_more_post_masonry_ajax');
if(!function_exists ('tvlgiao_wpdance_more_post_ajax')){
	function tvlgiao_wpdance_more_post_ajax(){ 
		$offset 		= $_POST["offset"];
		$posts_per_page = $_POST["posts_per_page"];
		$columns 		= $_POST["columns"];
		header("Content-Type: text/html");

		wp_reset_postdata();
		$args = array(		
			'post_type' 				=> 'post'
			,'posts_per_page' 			=> $posts_per_page
			,'offset' 					=> $offset
			,'ignore_sticky_posts' 		=> 1
		);
		$posts = new WP_Query($args);
		$span_class = "col-sm-".(24/$columns);
		if( $posts->have_posts() ) { ?>
			<?php $wd_have_post = 1; ?>
			<?php while ( $posts->have_posts() ) : $posts->the_post(); global $post; ?>
				<div class="wd-wrap-content-blog grid-item <?php echo esc_attr($span_class); ?>">
		        	<?php echo tvlgiao_wpdance_get_content_blog('full'); ?>
		        </div>
			<?php endwhile;   ?>
		<?php }else{ ?>
		<?php $wd_have_post = 0;?>
		<?php }; ?>
		<div id="wd_status" class="hidden">
			<input type="text" value="<?php echo esc_html( $wd_have_post); ?>" id="wp_outline_have_post">
		</div>
		<?php exit; ?>
	<?php }
}

//Ajax load product tab. Template: wd_product_by_category_tabs.php
add_action( 'wp_ajax_nopriv_product_by_category_tabs', 'product_by_category_tabs' );
add_action( 'wp_ajax_product_by_category_tabs', 'product_by_category_tabs' );
if ( ! function_exists( 'product_by_category_tabs' ) ) {
	function product_by_category_tabs() {
		$type    				= $_POST['type'];
		$slug    				= $_POST['slug'];
		$id      				= $_POST['id'];
		$sort   				= $_POST['sort'];
		$order_by 				= $_POST['order_by'];
		$columns 				= $_POST['columns'];
		$posts_per_page 		= $_POST['posts_per_page'];
		$is_slider 				= $_POST['is_slider'];
		$show_category_thumb 	= $_POST['show_category_thumb'];
		$show_nav 				= $_POST['show_nav'];
		$auto_play 				= $_POST['auto_play'];
		$per_slide 				= $_POST['per_slide'];

		$columns_product 		= ($is_slider == '0') ? 'wd-columns-'.$columns : '';
		$query_args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $posts_per_page,
			'order'               => $sort,
			'meta_query'          => WC()->query->get_meta_query(),
			'tax_query'           => WC()->query->get_tax_query(),
		);

		switch ( $order_by ) {
			case 'price':
				$args['meta_key'] 	= '_price';
				$args['orderby']  	= 'meta_value_num';
				break;
			case 'sales':
				$args['meta_key'] 	= 'total_sales';
				$args['orderby']  	= 'meta_value_num';
				break;
			default:
				$args['orderby'] 	= $order_by;
				break;
		}

		if ( $type == 'event' ) {
			switch ( $slug ) {
				case 'featured':
					$query_args['tax_query'][] = array(
						'taxonomy' => 'product_visibility',
						'field'    => 'id',
						'terms'    => 'featured',
						'operator' => 'IN',
					);
					break;
				case 'top_reviewed':
					$query_args['meta_key'] = '_wc_average_rating';
					$query_args['orderby']  = 'meta_value_num';
					break;
			}
		}

		$query_args['tax_query'][] = array(
			'terms'    => $id,
			'taxonomy' => 'product_cat',
		);

		$products = new WP_Query( $query_args );

		ob_start();

		if ( $products->have_posts() ): ?>
			<?php 
			$num_post =  $products->post_count;
			if( $num_post < 2 || $num_post <= ($per_slide * $columns) ){
				$is_slider = 0;
			}
			if( $num_post <= $posts_per_page ){
				$posts_per_page = $num_post;
			} ?>
			<?php $random_id = 'wd-product-by-category-tab-'.mt_rand(); ?>
			<div id="<?php echo esc_attr( $random_id ); ?>" >
				<div id="<?php echo esc_attr( $random_id ); ?>" class="wd-products-wrapper <?php echo esc_html($columns_product); ?> products-by-category-tabs-products">

					<?php woocommerce_product_loop_start(); ?>

						<?php if ($is_slider == 0 && $show_category_thumb): ?>
							<?php echo '<li class="category-image">' . wp_get_attachment_image( get_term_meta( $id, 'thumbnail_id', true ), 'full' ) . '</li>'; //category thumbnail ?> 
						<?php endif ?>

						<?php $count = 0; ?>

						<?php while ( $products->have_posts() ) : $products->the_post(); ?> 
							<?php if (($count == 0 || $count % $per_slide == 0) && $is_slider == '1') : ?>
								<div class="widget_per_slide">
							<?php endif; // Endif ?>

								<?php wc_get_template( 'content-product.php' ); ?>

							<?php $count++; ?>

							<?php if( ($count % $per_slide == 0 || $count == $num_post) && $is_slider == '1' ): ?>
								</div>
							<?php endif; // Endif ?> 
						<?php endwhile; ?> 

					<?php woocommerce_product_loop_end(); ?>

				</div><!-- .products-by-category-tabs-products -->
				
				<?php if( $show_nav && $is_slider ){ ?>
					<div class="slider_control">
						<a href="#" class="prev">&lt;</a>
						<a href="#" class="next">&gt;</a>
					</div>
				<?php } ?>
				
				<?php if ( $is_slider == '1') : ?>
					<script type="text/javascript">
						jQuery(document).ready(function(){
							"use strict";						
							var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
							var _auto_play = <?php echo esc_attr( $auto_play ); ?>;
							var owl = $_this.find('.wd-products-wrapper .products').owlCarousel({
								loop : true
								,items : 1
								,nav : false
								,dots : false
								,navSpeed : 1000
								,slideBy: 1
								,rtl:jQuery('body').hasClass('rtl')
								,navRewind: false
								,autoplay: _auto_play
								,autoplayTimeout: 5000
								,autoplayHoverPause: true
								,autoplaySpeed: false
								,mouseDrag: true
								,touchDrag: true
								,responsiveBaseElement: $_this
								,responsiveRefreshRate: 1000
								,responsive:{
									0:{
										items : 1
									},
									300:{
										items : 1
									},
									579:{
										items : <?php if($columns > 5){echo 3;}elseif($columns == 4){echo $columns;}elseif($columns==3){echo $columns - 1;}else{echo $columns;}  ?>
									},
									767:{
										items : <?php if($columns > 5){echo 4;}elseif($columns == 4){echo $columns;}elseif($columns==3){echo $columns;}else{echo $columns;}  ?>
									},
									1100:{
										items : <?php echo $columns; ?>
									}
								}
								
								,onInitialized: function(){
								}
							});
							$_this.on('click', '.next', function(e){
								e.preventDefault();
								owl.trigger('next.owl.carousel');
							});

							$_this.on('click', '.prev', function(e){
								e.preventDefault();
								owl.trigger('prev.owl.carousel');
							});
						});
					</script>
				<?php endif; // Endif Slider?>
			</div>
			<?php
			wp_reset_postdata();
		endif;

		echo ob_get_clean();

		wp_die();
	}
}

// Get Data Instagram
if(!function_exists ('tvlgiao_wpdance_scrape_instagram')){
	function tvlgiao_wpdance_scrape_instagram( $username ) {

		$username = strtolower( $username );
		$username = str_replace( '@', '', $username );
		if ( false === ( $instagram = get_transient( 'instagram-a5-'.sanitize_title_with_dashes( $username ) ) ) ) {

			$remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );
			if ( is_wp_error( $remote ) )
				return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'wpdancelaparis' ) );

			if ( 200 != wp_remote_retrieve_response_code( $remote ) )
				return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'wpdancelaparis' ) );

			$shards = explode( 'window._sharedData = ', $remote['body'] );
			$insta_json = explode( ';</script>', $shards[1] );
			$insta_array = json_decode( $insta_json[0], TRUE );

			if ( ! $insta_array )
				return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'wpdancelaparis' ) );

			if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
				$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
			} else {
				return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'wpdancelaparis' ) );
			}

			if ( ! is_array( $images ) )
				return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'wpdancelaparis' ) );

			$instagram = array();
			foreach ( $images as $image ) {

				$image['thumbnail_src'] = preg_replace( '/^https?\:/i', '', $image['thumbnail_src'] );
				$image['display_src'] = preg_replace( '/^https?\:/i', '', $image['display_src'] );

				// handle both types of CDN url
				if ( ( strpos( $image['thumbnail_src'], 's640x640' ) !== false ) ) {
					$image['thumbnail'] = str_replace( 's640x640', 's160x160', $image['thumbnail_src'] );
					$image['small'] = str_replace( 's640x640', 's320x320', $image['thumbnail_src'] );
				} else {
					$urlparts = wp_parse_url( $image['thumbnail_src'] );
					$pathparts = explode( '/', $urlparts['path'] );
					array_splice( $pathparts, 3, 0, array( 's160x160' ) );
					$image['thumbnail'] = '//' . $urlparts['host'] . implode( '/', $pathparts );
					$pathparts[3] = 's320x320';
					$image['small'] = '//' . $urlparts['host'] . implode( '/', $pathparts );
				}

				$image['large'] = $image['thumbnail_src'];

				if ( $image['is_video'] == true ) {
					$type = 'video';
				} else {
					$type = 'image';
				}

				$caption = __( 'Instagram Image', 'wpdancelaparis' );
				if ( ! empty( $image['caption'] ) ) {
					$caption = $image['caption'];
				}

				$instagram[] = array(
					'description'   => $caption,
					'link'		  	=> trailingslashit( '//instagram.com/p/' . $image['code'] ),
					'time'		  	=> $image['date'],
					'comments'	  	=> $image['comments']['count'],
					'likes'		 	=> $image['likes']['count'],
					'thumbnail'	 	=> $image['thumbnail'],
					'small'			=> $image['small'],
					'large'			=> $image['large'],
					'original'		=> $image['display_src'],
					'type'		  	=> $type
				);
			}

			// do not set an empty transient - should help catch private or empty accounts
			if ( ! empty( $instagram ) ) {
				$instagram = json_encode( serialize( $instagram ) );
				set_transient( 'instagram-a5-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
			}
		}

		if ( ! empty( $instagram ) ) {

			return unserialize( json_decode( $instagram ) );

		} else {

			return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'wpdancelaparis' ) );

		}
	}
}