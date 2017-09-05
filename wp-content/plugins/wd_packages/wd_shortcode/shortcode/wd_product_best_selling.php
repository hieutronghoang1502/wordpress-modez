<?php
/**
 * Shortcode: tvlgiao_wpdance_best_selling_product
 */
if (!function_exists('tvlgiao_wpdance_best_selling_product')) {
	function tvlgiao_wpdance_best_selling_product($atts) {
		extract(shortcode_atts(array(
			'id_category'			=> '-1',
			'data_show'				=> 'total_sales',
			'title'					=> 'Best Sellers',
			'style'  				=> 'style1',
			'number_products'		=> '6',
			'sort'					=> 'DESC',
			'order_by'				=> 'date',
			'columns'				=> '3',
			'filter_product'		=> '1',
			'pagination_loadmore'	=> '1',
			'number_loadmore'		=> '6',
			'meta_query' 			=> array(
				array(
					'key' 		=> '_visibility',
					'value' 	=> array( 'catalog', 'visible' ),
					'compare' 	=> 'IN'
				)
			),
			'class'					=> ''

		), $atts));

		$columns_product 	= 'wd-columns-'.$columns;
		wp_reset_query();	

		// New Product
		$args = array(  
			'post_type' 		=> 'product',  
			'posts_per_page' 	=> $number_products,
			'order' 			=> $sort,
			'paged' 			=> get_query_var('paged')
		);
		
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
		if($data_show == 'total_sales'){
			$args['meta_key'] 	= '_visibility';
			$args['orderby'] 	= 'meta_value_num';
			$args['order'] 		= 'DESC';
		}


		$products 			= new WP_Query( $args );
		$count_products 	= $products->found_posts;
		$random_id = 'wd-bestselling-product-'.rand(0,1000).time();
		ob_start(); ?>
		<?php if($style == 'style1') { ?>
		<div id="<?php echo esc_html($random_id); ?>" class='wd-shortcode-bestselling-product <?php echo esc_html($class); ?> wd-wrapper-parents-value'>
		<?php if ( $products->have_posts() ) : ?>
			<div class="wd-bestselling-title"><h3><?php echo $title; ?></h3></div>
			<div class="wd-products-wrapper <?php echo esc_html($columns_product); ?>">
				<?php $i = 0;?>
				<ul class="products grid">
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
						
						<?php if(($i%$columns==0)){ echo '<li class="items_row">'; } ?>
						<?php wc_get_template_part( 'content', 'bestsellingproduct' ); ?>
						<?php $i++; ?>
						<?php if(($i%$columns==0)|| ($i == $columns) || ($i == $count_products)){ echo '</li>'; } ?>
					
					<?php endwhile;	?>
				</ul>
			</div>
			<?php if($pagination_loadmore == '1') : ?> 
				<div class="wd-pagination">
					<?php tvlgiao_wpdance_pagination(3, $products); ?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
			<?php if($pagination_loadmore == '0') : ?> 
				<div class="wd-loadmore">
					<div class="show_image_loading" id="show_image_loading_<?php echo esc_html($random_id); ?>">
						<img src="<?php echo SC_IMAGE.'/ajax-loader_image.gif';?>" alt="HTML5 Icon" style="height:15px;">
					</div>
					<div id="loadmore">
						<a 	data-random_id="<?php echo esc_html($random_id); ?>" 
							data-posts_per_page="<?php echo esc_html($number_loadmore); ?>" 
							data-id_category="<?php echo esc_html($id_category); ?>" 
							data-data_show="<?php echo esc_html($data_show); ?>" 
							data-sort="<?php echo esc_html($sort); ?>" 
							data-order_by="<?php echo esc_html($order_by); ?>" 
							href="#" class="button btn_loadmore_product"><?php _e('LOAD MORE','wpdancelaparis') ?></a>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; // Have Product?>	
		<?php wp_reset_query(); ?>
		</div>
	<?php } elseif($style == 'style2') { ?>
		<?php 
		global $post;
		$args01 = array(  
			'post_type' 		=> 'product',  
			'posts_per_page' 	=> 1,
			
			
		);
		if( $id_category != -1 ){
			$args01['tax_query']= array(
		    	array(
			    	'taxonomy' 		=> 'product_cat',
					'terms' 		=> $id_category,
					'field' 		=> 'term_id',
					'operator' 		=> 'IN'
				)
   			);
		}
		
		
		if($data_show == 'total_sales'){
			$args01['meta_key'] 	= '_visibility';
			$args01['orderby'] 	= 'meta_value_num';
			$args01['order'] 		= 'DESC';
		};

		$products01			= new WP_Query( $args01 );
		
		$productid  = array();
		?>
		<div class='wd-shortcode-bestselling-product'>
			<div class="wd-bestselling-title"><h3><?php echo $title; ?></h3></div>
				<div class="wd-products-wrapperss">
					<div class="singleprss" style="width: 50% ; float: left;">
						<ul class="products grid">
							<?php while ( $products01->have_posts() ) : $products01->the_post(); 
								$productid['id'] = $post->ID;
							?>
								<?php wc_get_template_part( 'content', 'bestsellingproduct' ); 
								?>
							<?php endwhile;	?>
						</ul>
						<?php wp_reset_query(); ?>
					</div>
					
						<?php
						
						$args02 = array(  
							'post_type' 		=> 'product',  
							'posts_per_page' 	=> $number_products,
							'orderby' 			=> $sort,
							'order'				=> $order_by,
							'post__not_in' 		=> array($productid['id'])
							
						);
						if( $id_category != -1 ){
							$args02['tax_query']= array(
						    	array(
								    	'taxonomy' 		=> 'product_cat',
										'terms' 		=> $id_category,
										'field' 		=> 'term_id',
										'operator' 		=> 'IN'
									)
				   			);
						}
						
						
						if($data_show == 'total_sales'){
							$args02['meta_key'] 	= '_visibility';
							$args02['orderby'] 	= 'meta_value_num';
							$args02['order'] 		= 'DESC';
						};

						$products02			= new WP_Query( $args02 ); 
						?>
					<div class="products-rowss" style="width: 50% ; float: right;" >
						<ul class="products grid">
							<?php $i = 0;?>
							<?php while ( $products02->have_posts() ) : $products02->the_post(); ?>
								
								<?php if(($i%$columns==0)){ echo '<li class="items_rowss">'; } ?>
								<?php wc_get_template_part( 'content', 'bestsellingproduct' ); ?>
								<?php $i++; ?>
								<?php if(($i%$columns==0)|| ($i == $columns) || ($i == $count_products)){ echo '</li>'; } ?>
							
							<?php endwhile;	?>
						</ul>
						
					</div>
					
				</div>
		</div>
	<?php	} elseif($style == 'style3') { ?>
	<?php 
		
		$args01 = array(  
			'post_type' 		=> 'product',  
			'posts_per_page' 	=> $number_products,
		);
		if( $id_category != -1 ){
			$args01['tax_query']= array(
		    	array(
				    	'taxonomy' 		=> 'product_cat',
						'terms' 		=> $id_category,
						'field' 		=> 'term_id',
						'operator' 		=> 'IN'
					)
   			);
		}
		
		
		if($data_show == 'total_sales'){
			$args01['meta_key'] 	= '_visibility';
			$args01['orderby'] 	= 'meta_value_num';
			$args01['order'] 		= 'DESC';
		};

		$products01			= new WP_Query( $args01 );
		?>

		<div class='wd-shortcode-bestselling-product'>
			<div class="wd-bestselling-title"><h3><?php echo $title; ?></h3></div>
				<div class="wd-products-wrapperss">
					<div class="singlebss">
						<ul class="products grid">
							<?php $i = 0;?>
							<?php while ( $products01->have_posts() ) : $products01->the_post(); ?>
								
								<?php if(($i%$columns==0)){ echo '<li class="items_rowss">'; } ?>
								<?php wc_get_template_part( 'content', 'bestsellingproduct' ); ?>
								<?php $i++; ?>
								<?php if(($i%$columns==0)|| ($i == $columns) || ($i == $count_products)){ echo '</li>'; } ?>
							
							<?php endwhile;	?>
						</ul>
						<?php wp_reset_query(); ?>
					</div>
				</div>
			</div>
		</div>
				
			<?php } else { ?>
			<?php 
		
		$args01 = array(  
			'post_type' 		=> 'product',  
			'posts_per_page' 	=> '1',
			
			
		);
		if( $id_category != -1 ){
			$args01['tax_query']= array(
		    	array(
				    	'taxonomy' 		=> 'product_cat',
						'terms' 		=> $id_category,
						'field' 		=> 'term_id',
						'operator' 		=> 'IN'
					)
   			);
		}
		
		
		if($data_show == 'total_sales'){
			$args01['meta_key'] 	= '_visibility';
			$args01['orderby'] 	= 'meta_value_num';
			$args01['order'] 		= 'DESC';
		};

		$products01			= new WP_Query( $args01 );

		$args02 = array(  
			'post_type' 		=> 'product',  
			'posts_per_page' 	=> '3',
		);
		if( $id_category != -1 ){
			$args02['tax_query']= array(
		    	array(
				    	'taxonomy' 		=> 'product_cat',
						'terms' 		=> $id_category,
						'field' 		=> 'term_id',
						'operator' 		=> 'IN'
					)
   			);
		}
		
		
		if($data_show == 'total_sales'){
			$args02['meta_key'] 	= '_visibility';
			$args02['orderby'] 	= 'meta_value_num';
			$args02['order'] 		= 'DESC';
		};

		$products02			= new WP_Query( $args02 );
		?>

		<div class='wd-shortcode-bestselling-product'>
				<div class="wd-bestselling-title">
					<h3><?php echo $title; ?></h3>
				</div>
				<div class="wd-products-wrapperss">
					<div class="singlebss">
						<ul class="products grid">
							<?php $i = 0;?>
							<?php while ( $products01->have_posts() ) : $products01->the_post(); ?>
								
								<?php if(($i%$columns==0)){ echo '<li class="items_rowss">'; } ?>
								<?php wc_get_template_part( 'content', 'bestsellingproduct' ); ?>
								<?php $i++; ?>
								<?php if(($i%$columns==0)|| ($i == $columns) || ($i == $count_products)){ echo '</li>'; } ?>
							
							<?php endwhile;	?>
						</ul>
						<?php wp_reset_query(); ?>
					</div>
					<?php while ( $products02->have_posts() ) : $products02->the_post();  ?>
					<img class="imgprrl" style="width: 110px; height: 110px;" src="<?php the_post_thumbnail_url(200,200); ?>">
					<?php endwhile;	?>
				</div>
		</div>
			
			<?php } ?>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_query();
		return $content;
	}
}
add_shortcode('tvlgiao_wpdance_best_selling_product', 'tvlgiao_wpdance_best_selling_product');
?>