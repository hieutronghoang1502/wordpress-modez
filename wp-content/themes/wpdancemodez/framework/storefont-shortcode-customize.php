<?php
	/**
	Shortcode của Híu
**/
function shortcode_newproduct(){
	$arg = array(
			'post_type' => 'product',
			'posts_per_page' => 4,
			'orderby' =>'date',
			'order' => 'DESC'
		); 
		ob_start();
		?>
	<section id="new-product-section">
		<div id="newproduct-header">
			<h2>New Product</h2>
		</div>
		<ul>
<?php
$loop =  new WP_Query($arg);
		if($loop->have_posts()): while($loop->have_posts()): $loop->the_post();

		?>
		  <li class="new-product">    

                <a href="<?php the_permalink(); ?>"  id="id-<?php the_id(); ?>">
					<?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="My Image Placeholder" width="65px" height="115px" />'; ?>
					<h3><?php the_title(); ?></h3>
					<span class="price"><?php echo $loop->get_price_html(); ?></span>
                    
                </a>
				<?php woocommerce_template_loop_add_to_cart( $loop->post ); ?>
                
             </li>
		<?php 
			endwhile;
			endif;
		?>
		</ul>
	</section>
<?php
		$new_product_content = ob_get_clean();
		return $new_product_content;
}

add_shortcode( 'new_product_intro', 'shortcode_newproduct' );

function shortcode_rand_product_byslug(){
	$args = array(
		'post_type'	 		=> 'product',
		'post_status'		=> 'publish',
		'posts_per_page'	=> '1',
		'orderby'			=> 'rand',
		'tax_query'			=> array(
			array(
				'taxonomy'	=> 'product_cat',
				'field'		=> 'slug',
				'terms'		=> array('hoodie'),
				'operator'	=> 'IN'
				)
			)
		);
		ob_start(); ?>
		<div class="row">
			
			<?php $products = new WP_Query($args); ?>
			<?php if($products->have_posts()): while($products->have_posts()): $products->the_post(); ?>
			<div class="col-sm-6">
				<div class="random-left">
				<a href="<?php echo get_permalink($products->post->ID ); ?>" title="<?php esc_attr($products->post->post_title ? $products->post->post_title : $products->post->ID); ?>">
					<?php if(has_post_thumbnail($products->post->ID )) echo get_the_post_thumbnail($products->post->ID, 'shop_catalog' ); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="65px" height="115px" />'; ?>
					<p><?php the_title(); ?></p>
				</a>
				<span class="price"><?php echo get_post_meta( get_the_ID(), '_regular_price', true); ?></span>
				</div>
			</div>
			<?php endwhile; 
				  endif;  ?>

			<?php $product = new WP_Query($args); ?>
			<?php if($product->have_posts()): while($product->have_posts()): $product->the_post(); ?>
			<div class="col-sm-6">
				<div class="random-right">
				<a href="<?php echo get_permalink($product->post->ID ); ?>" title="<?php esc_attr($product->post->post_title ? $product->post->post_title : $product->post->ID); ?>">
					<?php if(has_post_thumbnail($product->post->ID )) echo get_the_post_thumbnail($product->post->ID, 'shop_catalog' ); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="65px" height="115px" />'; ?>
					<p><?php the_title(); ?></p>
				</a>
				<span class="price"><?php echo get_post_meta( get_the_ID(), '_regular_price', true); ?></span>
				</div>
			</div>
			<?php endwhile; 
				  endif;  ?>
			
		</div>
		<?php
		$new_product_content = ob_get_clean();
		return $new_product_content;
		 
}
	add_shortcode( 'random_product', 'shortcode_rand_product_byslug' );


function col_trends(){
		$tops = array(
		'post_type'	 		=> 'product',
		'post_status'		=> 'publish',
		'posts_per_page'	=> '3',
		'orderby'			=> 'rand',
		'tax_query'			=> array(
			array(
				'taxonomy'	=> 'product_cat',
				'field'		=> 'slug',
				'terms'		=> array('top'),
				'operator'	=> 'IN'
				)
			)
			);// end tops

		$middles = array(
		'post_type'	 		=> 'product',
		'post_status'		=> 'publish',
		'posts_per_page'	=> '3',
		'orderby'			=> 'rand',
		'tax_query'			=> array(
			array(
				'taxonomy'	=> 'product_cat',
				'field'		=> 'slug',
				'terms'		=> array('middle'),
				'operator'	=> 'IN'
				)
			)
			);// end middle

		$bottoms = array(
		'post_type'	 		=> 'product',
		'post_status'		=> 'publish',
		'posts_per_page'	=> '3',
		'orderby'			=> 'rand',
		'tax_query'			=> array(
			array(
				'taxonomy'	=> 'product_cat',
				'field'		=> 'slug',
				'terms'		=> array('hoodie'),
				'operator'	=> 'IN'
				)
			)
			);// end bottom

		$recents = array(
		'post_type'	 		=> 'product',
		'post_status'		=> 'publish',
		'posts_per_page'	=> '3',
		'orderby'			=> 'rand',
		'tax_query'			=> array(
			array(
				'taxonomy'	=> 'product_cat',
				'field'		=> 'slug',
				'terms'		=> array('recent'),
				'operator'	=> 'IN'
				)
			)
			);// end recent
			$top = new WP_Query($tops);
			$middle = new WP_Query($middles);
			$bottom = new WP_Query($bottoms);
			$recent = new WP_Query($recents);


			ob_start();?>
			<div class="row row-trends">
				<div class="col-sm-3 col-product">
					<ul>
														<h4>TOPS</h4>
						<?php if($top->have_posts()): while($top->have_posts()):$top->the_post(); ?>
						<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($top->post->ID)); ?>
						<li>
							<div class="row">
								<div class="col-sm-6 image">
									<a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image[0] ?>" ></a>
								</div>
								<div class="col-sm-6 detail">
									<a href="<?php the_permalink(); ?>"><h6><?php the_title( ); ?></h6></a></br>
									<?php echo get_post_meta( get_the_ID(), '_regular_price', true ); ?> vnđ
								</div>
							</div>
						</li>
					<?php endwhile; endif; ?>
					</ul>
				</div>
				<div class="col-sm-3 col-product">
					<ul>
														<h4>MIDDLES</h4>
						<?php if($middle->have_posts()): while($middle->have_posts()):$middle->the_post(); ?>
						<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($middle->post->ID)); ?>
						<li>
							<div class="row">
								<div class="col-sm-6 image">
									<a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image[0] ?>" ></a>
								</div>
								<div class="col-sm-6 detail">
									<a href="<?php the_permalink(); ?>"><h6><?php the_title( ); ?></h6></a></br>
									<?php echo get_post_meta( get_the_ID(), '_regular_price', true ); ?> vnđ
								</div>
							</div>
						</li>
					<?php endwhile; endif; ?>
					</ul>
				</div>
				<div class="col-sm-3 col-product">
					<ul>
														<h4>BOTTOMS</h4>
						<?php if($bottom->have_posts()): while($bottom->have_posts()):$bottom->the_post(); ?>
						<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($bottom->post->ID)); ?>
						<li>
							<div class="row">
								<div class="col-sm-6 image">
									<a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image[0] ?>" ></a>
								</div>
								<div class="col-sm-6 detail">
									<a href="<?php the_permalink(); ?>"><h6><?php the_title( ); ?></h6></a></br>
									<?php echo get_post_meta( get_the_ID(), '_regular_price', true ); ?> vnđ
								</div>
							</div>
						</li>
					<?php endwhile; endif; ?>
					</ul>
				</div>
				<div class="col-sm-3 col-product">
					<ul>
														<h4>RECENTS</h4>
						<?php if($recent->have_posts()): while($recent->have_posts()):$recent->the_post(); ?>
						<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($recent->post->ID)); ?>
						<li>
							<div class="row">
								<div class="col-sm-6 image">
									<a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image[0] ?>" ></a>
								</div>
								<div class="col-sm-6 detail">
									<a href="<?php the_permalink(); ?>"><h6><?php the_title( ); ?></h6></a></br>
									<?php echo get_post_meta( get_the_ID(), '_regular_price', true ); ?> vnđ
								</div>
							</div>
						</li>
					<?php endwhile; endif; ?>
					</ul>
				</div>
			</div>
			<?php
			$content = ob_get_clean();
			return $content;
}			
	add_shortcode( 'col_trends', 'col_trends' );

function shortcode_loadmore_image(){
		$args = array(
			'post_type'		=> 'product',
			'status'		=> 'publish',
			'posts_per_page'=> '12',
			'orderby'		=>'rand',
			'tax_query'		=> array(
				array(
				'taxonomy'	=> 'product_cat',
				'field'		=> 'slug',
				'terms'		=> array('hoodie'),
				'operator'	=> 'IN'
				)
			
				) );
		ob_start();?>
		<div class="gallery-product">
			<h2>What's Hot</h2>
			<ul>
			<?php
		$images = new WP_Query($args);
		if($images->have_posts()): while($images->have_posts()):$images->the_post();
		$image = wp_get_attachment_image_src(get_post_thumbnail_id($images->post->ID ) );?>
				<li><a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0] ?>"></a></br>
				<a href="<?php the_permalink(); ?>"><?php the_title() ?></a></br>
				<?php echo get_post_meta( get_the_ID(), '_regular_price', true); ?> vnđ</li>

		<?php endwhile; endif; ?>
			</ul>
			<div class="more">Load more</div>
			<div class="less">Show Less</div>
		</div>
		
		<?php 
		$content = ob_get_clean();
		return $content;
	}
	add_shortcode( 'loadmore', 'shortcode_loadmore_image' );


//Modez Instagram
	function shortcode_modez_instagram(){
		$args = array(
			'post_type'	=> 'product',
			'posts_per_page'	=> '7',
			'status' 	=> 'publish',
			'orderby'	=> 'rand',
			'tax_query'	=> array(
				array(
					'taxonomy'	=> 'product_cat',
					'field'		=> 'slug',
					'terms'		=> array('hoodie'),
					'operator'	=> 'IN'
					)
				)
			);

		$products = new WP_Query($args);
		ob_start(); ?>
		<div class="insta-img">
			<h2>#MODEZ Instagram</h2>
			
				<?php if($products->have_posts()): while($products->have_posts()): $products->the_post(); ?>
				
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($products->post->ID)); ?>
					<span><img src="<?php echo $image[0] ?>"></span>
				
			<?php endwhile; endif; ?>
			
		</div>
		<?php 
		$content = ob_get_clean();
		return $content;
	}
	add_shortcode( 'insta_img', 'shortcode_modez_instagram' );


	function shortcode_collection(){
		$args = array(
			'post-type'	=> 'product',
			'posts_per_page'=>'2',
			'status'	=>'publish',
			'orderby'	=> 'rand',
			'tax_query'	=> array(
				array(
					'taxonomy'	=> 'product_cat',
					'field'		=> 'slug',
					'terms'		=> array('collection'),
					'operator'	=> 'IN'
					)
				)
		);

		$arg = array(
			'post-type'	=> 'product',
			'posts_per_page'=>'1',
			'status'	=>'publish',
			'orderby'	=> 'rand',
			'tax_query'	=> array(
				array(
					'taxonomy'	=> 'product_cat',
					'field'		=> 'slug',
					'terms'		=> array('collection'),
					'operator'	=> 'IN'
					)
				)
		);



		$product1 = new WP_Query($args);
		$product2 = new WP_Query($arg);
		$img1 = wp_get_attachment_image_src(get_post_thumbnail_id($product1->post->ID ) );
		$img2 = wp_get_attachment_image_src(get_post_thumbnail_id($product2->post->ID ) );

		ob_start(); ?>
		<div class="collection">
			<div id="collection-left">
				<ul>
					<li><img src="<?php echo $img1[0] ?>"><li>
					<li><a href="<?php the_permalink($product1->post->ID); ?>"><?php echo get_the_title($product1->post->ID ); ?></a></li>
					<li><a href="<?php the_permalink($product1->post->ID); ?>"><span class="shop-button">SHOP THE LOOK</span></a></li>
				</ul>
			</div>
			<div id="collection-right">
				<ul>
					<li><img src="<?php echo $img2[0] ?>"><li>
					<li><a href="<?php the_permalink($product2->post->ID); ?>"><?php echo get_the_title($product2->post->ID );  ?></a></li>
					<li><a href="<?php the_permalink($product2->post->ID); ?>"><span class="shop-button">SHOP NOW</span></a></li>
				</ul>
			</div>
		</div>
		
		<?php
		$content = ob_get_clean();
		return $content;
	}
	add_shortcode( 'img_collection', 'shortcode_collection' );

// Add js and css Bootstrap
	function tronghiu_styles(){
	

	//Chèn file CSS bootstrap
	wp_register_style( 'bootstrap-css', get_template_directory_uri().'/assets/bootstrap.min.css', 'all' );
	wp_enqueue_style('bootstrap-css' );

	//Chèn file JS custom.js
	wp_register_script( 'bootstrap-js', get_template_directory_uri().'/assets/js/bootstrap.min.js','all' );
	wp_enqueue_script('bootstrap-js' );
}
add_action( 'wp_enqueue_scripts', 'tronghiu_styles' );

//Recent Post
	function shortcode_tag_post(){
		$args = array(
			'posts_per_page'	=> '3',
			'orderby'			=> 'title'
			);
		$i = 0;
		$posts = new WP_Query($args);
		ob_start();?>
		<div class="tag_post">
			<h2>From Our Blogs 123s</h2>
			<ul>
			<?php if($posts->have_posts()): while($posts->have_posts()):$posts->the_post(); ?>
				<?php $i = $i+1; ?>
			<li class="tag_post_<?php echo $i ?>">
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($products->post->ID),'thumbnail' ); ?>

				<img src="<?php echo $image[0] ?>">
				<h3><?php the_title() ?></h3>
				<?php the_excerpt(); ?>
				<div><i><?php echo get_the_date(get_option('date_format' ) ); ?></i></div>
			</li>
				<?php endwhile; endif; ?>
			</ul>
		</div>

		<?php $content = ob_get_clean(); 

			return $content;
		
	}
	add_shortcode( 'posts_tag', 'shortcode_tag_post' );

	/* list product page*/
	function shortcode_page_product($slug){
		$args = array(
			'post_type'	=> 'product',
			'showposts'	=> '8',
			'status'			=> 'publish',
			'orderby'			=> 'rand',
			'tax_query'			=> array(
				array(
					'taxonomy'	=> 'product_cat',
					'field'		=> 'slug',
					'terms'		=> $slug,
					'operator'	=> 'IN'
					)
				)
			);
		$products = new WP_Query($args);
		ob_start(); ?>
		<div class="page-product-show">
			<ul>
				<?php if($products->have_posts()):while($products->have_posts()): $products->the_post(); ?>
				<li>
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($products->post->ID));  ?>
					<img src="<?php echo $image[0] ?>">
					<div><?php the_title( ); ?></div>
					<div><?php echo get_post_meta( get_the_ID(), '_regular_price', true); ?></div>
				</li>
			<?php endwhile; endif; ?>
			</ul>

			<?php 
			echo  posts_nav_link(); 
				wp_reset_query(); 

			 ?>
		</div>
		<?php 
		$content = ob_get_clean();
		return $content;
	}
	add_shortcode( 'page_product_show', 'shortcode_page_product' );

	//Recent post brief
	function shortcode_recent_post_brief(){
		$args=array('posts_per_page'	=> '4'
			);
		$post = new WP_Query($args);
		ob_start();
		?>
		<div class="recent_post_brief">
			<?php if($post->have_posts()): while($post->have_posts()): $post->the_post(); ?>
				<?php if(has_post_thumbnail( )): ?>
			<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->post->ID )); ?>
			<div class="row recent-post">
				<div class="col-sm-9 recent-post-left"><?php echo get_the_post_thumbnail( $post->the_id(), 'thumbnail' ); ?></div>
				<div class="col-sm-9 recent-post-right">
				<div><a href="<?php the_permalink(); ?>"><i><h6><?php the_title() ?></i></a></h6></div>
					<div><i><?php echo get_the_date(get_option('date_format' ) ); ?></i></div>
				</div>

			</div>
			
			
				<?php endif;?>
			<hr>
		<?php endwhile; endif; ?>
		</div>
<?php $content = ob_get_clean();
return $content;

	} 
	add_shortcode( 'recent_post_brief', 'shortcode_recent_post_brief' );


	//contact info block
	function shortcode_contact_info(){
		ob_start(); ?>
		<div class="contact_block">
			<span><span class="glyphicon glyphicon-map-marker"></span> <span>gốc cây số 3 phố Trần Duy Hưng</span></span></br>
			<span><span class="glyphicon glyphicon-earphone"></span> <span></span>0125339868</span></br>
			<span><span class="	glyphicon glyphicon-time"></span> <span>8.00 AM - 5.30 PM</span></span></br>
			<span><span class="	glyphicon glyphicon-envelope"></span> <span>hieutronghoang1502@gmail.com</span></span>

		</div><?php
		$content = ob_get_clean();
		return $content;
	}
	add_shortcode( 'contact_info_block', 'shortcode_contact_info' );

	function shortcode_category_menu(){
		ob_start();
		$args = array(
			'orderby'		=> 'name',
			'show_count'	=> 0,
			'taxonomy'		=> 'product_cat',
			'hierachical'	=> 1,
			'title_li'		=> '',
			'hide_empty'	=> 0,
			);
		$all_categories = get_categories( $args );
		?><ul class="cat-list"><?php
		foreach($all_categories as $category){
			if($category->parent == 0){
				$children = get_term_children( $category->term_id, 'product_cat' );
				$nd = (!empty($children))? $category->name.'<a  tabindex="0" class="click-li"> <i style="float:right" class="glyphicon glyphicon-plus"></i></a>' : $category->name
		?>	<li><a href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $nd ?></a>
		<?php
		$args2 = array(
			'orderby'		=> 'name',
			'show_count'	=> 0,
			'taxonomy'		=> 'product_cat',
			'hierachical'	=> 1,
			'title_li'		=> '',
			'hide_empty'	=> 0,
			'child_of'		=> 0,
			'parent'		=> $category->term_id
			);
			$sub_cats = get_categories( $args2 );
			if($sub_cats){
				foreach($sub_cats as $sub_cat){
					if($sub_cat->sub_category == 0){
					?>
					<ul class="sub-cat">
						<li><?php echo $sub_cat->name ?></li>
					</ul>
					<?php
				}
				}
			}
			?></li><?php
	}
			}?></ul><?php
			$content = ob_get_clean();
			return $content;
	}
	add_shortcode( 'category_menu', 'shortcode_category_menu' );

	function shortcode_footer_contact(){
		ob_start(); ?>
		<div class="row footer-contact">
			<div class="col-sm-6 about-us">
				<h3>ABOUT US</h3>
				<span>Shoe street style leather tote oversized sweatshirt A.P.C. Prada Saffiano crop slipper denim shorts spearmint</span>
			</div>

			<div class="col-sm-6 contact-info">
				<h3>CONTACT INFO</h3>
				<ul>
					<li><span class="glyphicon glyphicon-map-marker"></span> <span>12345 Sample Str, Sample State. Sample city, Sample Country</span></li>
					<li><span class="glyphicon glyphicon-phone"></span> <span>(+01) 123456789xxx</span></li>
					<li><span class="glyphicon glyphicon-envelope"></span> <span>support@designshopify.com</span></li>
				</ul>
			</div>

			<div class="col-sm-6 more-links">
				<h3>MORE LINKS</h3>
				<div class="row">
					<div class="col-sm-24">
						<a href="#">Shipping & Returns</a></br>
						<a href="#">Contact us</a></br>
						<a href="#">Blog</a></br>
						<a href="#">RSS</a></br>
						<a href="#">Sitemap</a></br>

					</div>
				</div>
			</div>

			<div class="col-sm-6 map">
				<h3>LOCATION</h3>
<!--   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.7559640579925!2d106.70044151435093!3d10.829978292285206!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175288aeb026b6b%3A0x3f4277d164ccc0b2!2zxJDGsOG7nW5nIFRy4bulYywgcGjGsOG7nW5nIDEzLCBCw6xuaCBUaOG6oW5oLCBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1500365199300" width="600" height="84px" frameborder="0" style="border:0" allowfullscreen></iframe>
			 -->			</div>
		</div>
		<?php $content = ob_get_clean();
		return $content;
	}
	add_shortcode( 'footer_contact_info', 'shortcode_footer_contact' );

	function shortcode_contact_icon(){
		ob_start(); ?>
		<div class="row contact-icon">
			<div class="col-sm-8 newsletter">
				<span>SUBSCRIBE OUR NEWSLETTER</span> <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
			</div>
			<div class="col-sm-8 form-newsletter">
				<form method="post" action="https://codespot.us5.list-manage.com/subscribe/post?u=ed73bc2d2f8ae97778246702e&id=c63b4d644d">
					<input type="email" name="email" id="newsletter_email" />
					<button type="submit" class="btn newsletter__submit" name="subscribe" id="subscribe">
                        <span class="newsletter__submit-text--large">Subscribe</span>
                      </button>
			</div>
			<div class="col-sm-8 icon">
				<?php if ( function_exists('cn_social_icon') ) echo cn_social_icon(); ?>
			</div>
		</div>
		<?php
		$content = ob_get_clean();
		return $content;
	}
add_shortcode( 'contact_icon', 'shortcode_contact_icon' );

	function shortcode_top_rated_brief(){
		$atts = array(
			'per_page' => '12',
			'columns'  => '4',
			'orderby'  => 'title',
			'order'    => 'asc',
			'category' => '',  // Slugs
			'operator' => 'IN', // Possible values are 'IN', 'NOT IN', 'AND'.
		);

		$query_args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'orderby'             => $atts['orderby'],
			'order'               => $atts['order'],
			'posts_per_page'      => $atts['per_page'],
			'meta_query'          => WC()->query->get_meta_query(),
			'tax_query'           => WC()->query->get_tax_query(),
		);
		$products = WP_Query($query_args);
		ob_start();
		if($products->have_posts()):while($products->have_posts()):$products->the_post(); ?>
			<div><?php the_title( ); ?></div>
		<?php endwhile; endif;
		$content = ob_get_clean();
		return $content;
	}
	add_shortcode( 'toprate_product', 'shortcode_top_rated_brief' );

	function shortcode_recent_articles(){
		wp_reset_query();
		$args = array(
			'posts_per_page'	=> "4",
			);
		$post = new WP_Query($args);
		ob_start();
		if($post->have_posts()): while($post->have_posts()): $post->the_post();
		?>
		<div class="recent_article">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_html__( 'Permalink to %s', 'wpdancemodez' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
<h3><?php the_title( ); ?></h3></a>
			
			by <?php the_author( ); ?>

			<div class="excerpt_article"><?php echo substr(get_the_excerpt(), 0,150);?></div>
			<hr>
		</div>
		<?php
		endwhile;wp_reset_postdata(); endif;
		wp_reset_query();
		$content = ob_get_clean();
		wp_reset_query();
		return $content;
	}
	add_shortcode( 'recent_article', 'shortcode_recent_articles' );

	function shortcode_owl_featured_slider(){
		
     $featured_query = new WP_Query( array(
         'tax_query' => array(
                 array(
                     'taxonomy' => 'product_visibility',
                     'field'    => 'name',
                     'terms'    => 'featured',
                     'operator' => 'IN'
                 ),
          ),
     ) );
     	ob_start(); ?>
	<div class="owl-carousel owl-theme owl-loaded owl-drag">
		<div class="owl-stage">
			123
			<?php if($featured_query->have_posts()): while($featured_query->have_posts()): $featured_query->the_post(); ?>
			<div class="item" style="width:25%">
				<?php wc_get_template_part('content','product') ?>123
			</div>
		<?php endwhile; endif; ?>
		</div>
<div class="owl-nav"><div class="owl-prev"><span class="ion-ios-arrow-left"></span></div><div class="owl-next"><span class="ion-ios-arrow-right"></span></div></div>	
</div>
	<?php $content = ob_get_clean();
			return $content;
	}
	add_shortcode( 'owl_featured_slider', 'shortcode_owl_featured_slider' );


	function shortcode_get_post_by_id($post_id){
		$args = array(
			'posts_per_page'	=> '1',
			 'post__in' => 	$post_id
			);

		$post_by_id = new WP_Query($args);
		if($post_by_id->have_posts()):while($post_by_id->have_posts()):$post_by_id->the_post();
		$tag = get_the_tags( get_the_id() );
		ob_start();
		?>
		<div class="post-by-id" id="post-id-<?php the_id(); ?>">
			
			<div class="post_id_thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post_by_id_thumbnail' ); ?></a>
			<div class="post-tag"><a href="<?php echo get_tag_link( $tag[0]->id ); ?>"><?php echo str_replace('#', '', $tag[0]->name) ?></a></div>
			</div>
			
			<div class="post-content-brief">
			<a href="<?php the_permalink(); ?>"><div class="post_id_title"><?php the_title( ); ?></div></a>
			<div class="post_id_excerpt"><?php echo substr(get_the_excerpt(), 0,200); ?></div>
			<div class="row readmore-date">
				<div class="col-sm-12 readmore_btn"><a href="<?php the_permalink(); ?>">READ MORE <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
				<div class="col-sm-6 post-date"><?php get_the_date( ); ?></div>
			</div>
			</div>
		</div>
		<?php endwhile; endif;
		$content = ob_get_clean();
		return $content;
	}
add_shortcode( 'post_by_id', 'shortcode_get_post_by_id' );




	function shortcode_teammate_slider(){
		ob_start(); ?>
		<ul class="bxslider">
			<li><?php echo do_shortcode('[wd_team_member id_team="284" style="style-3"]' ); ?></li>
			<li><?php echo do_shortcode('[wd_team_member id_team="283" style="style-3"]' ); ?></li>
			<li><?php echo do_shortcode('[wd_team_member id_team="281" style="style-3"]' ); ?></li>
			<lis><?php echo do_shortcode('[wd_team_member id_team="280" style="style-3"]' ); ?></li>
		</ul>
		
<?php
		$content = ob_get_clean();
		return $content;
	}
	add_shortcode( 'teammate_slider', 'shortcode_teammate_slider' );

	function shortcode_get_tags(){
		ob_start();
		$tags = get_tags(); ?>
		<div class="post_tags"><?php
		foreach ( $tags as $tag ) {
			$tag_link = get_tag_link( $tag->term_id );
					?>
			<a href='<?php echo $tag_link ?>' title='<?php echo $tag->name ?> Tag' class='<?php echo $tag->slug ?>'><?php echo $tag->name ?></a> 
			<?php
		} ?>
		</div><?php
		$content = ob_get_clean();
return $content;
	}
	add_shortcode( 'get_tags', 'shortcode_get_tags' );


	/**
 * Display the comment form via shortcode on singular pages.
 * Remove the default comment form.
 * Hide the unwanted "Comments are closed" message through filters.
 *
 * @see http://wordpress.stackexchange.com/a/177289/26350
 */

add_shortcode( 'wpse_comment_form', function( $atts = array(), $content = '' )
{
    if( is_singular() && post_type_supports( get_post_type(), 'comments' ) )
    {
        ob_start();
        comment_form();
        add_filter( 'comment_form_defaults', 'wpse_comment_form_defaults' );
        return ob_get_clean();
    }           
    return '';
}, 10, 2 );


