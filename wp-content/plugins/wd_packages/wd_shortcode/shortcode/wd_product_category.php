<?php
/**
 * Shortcode: tvlgiao_wpdance_category_product
 */
if (!function_exists('tvlgiao_wpdance_category_product_function')) {
	function tvlgiao_wpdance_category_product_function($atts) {
		extract(shortcode_atts(array(
			'number_posts'		=> 6,
			'style'				=> 'style-1',
			'sort'				=> 'DESC',
			'order_by'			=> 'term_id',
			'columns'			=> 3,
			'title'				=> '1',
			'thumbnail'			=> '1',
			'readmore'			=> '1',
			'meta'				=> '1',
			'class'				=> ''

		), $atts));
		wp_reset_query();	

		$args = array(
		    'number'     	=> $number_posts,
		    'order'    		=> $sort,
		    'orderby'      	=> $order_by,
		    'hide_empty' 	=> false,
		);

		$product_categories = get_terms( 'product_cat', $args );
		$num_count 	= count($product_categories);
		$i = 0;
		$id_widget = 'recent-blogs-sticky-shortcode-'.rand(0, 1000);	
		ob_start(); ?>

		<?php if( $num_count > 0 ) : ?>
			<ul id="<?php echo esc_html($id_widget); ?>" class="wd-shortcode-category columns-<?php echo esc_html($columns); ?> <?php echo esc_html($style); ?>" >
			<?php foreach( $product_categories as $cat ) { ?>
				<li class="item <?php if( $i == 0 || $i % $columns == 0 ) echo ' first';?><?php if( $i == $num_count-1 || $i % $columns == $columns-1 ) echo ' last';?>" >
					<?php
						$title_category 		= $cat->name;
						$id_category 			= $cat->term_id;
						$thumbnail_category 	= get_woocommerce_term_meta( $id_category , 'thumbnail_id', true ); 
						$image_url_category 	= wp_get_attachment_url( $thumbnail_category );   
					?>
					<?php if($thumbnail) : ?> 
						<div class="category_thumbnail">
							<a href="<?php echo get_category_link($id_category); ?>">
								<img src="<?php echo $image_url_category; ?>" alt="<?php echo $title_category; ?>">
							</a>
						</div>
					<?php endif; ?>
					<div class="category_info">
						<?php if($title ) : ?>
							<a href="<?php echo get_category_link($id_category); ?>">
								<h2><?php echo $title_category; ?></h2>
							</a>
						<?php endif; ?>
						<?php if($meta ) : ?>
							<span>(<?php echo $cat->count; _e(' products','wpdancelaparis'); ?>)</span>
						<?php endif; ?>
						<?php if($readmore ) : ?>
							<a class='wd-cate-readmore' href="<?php echo get_category_link($id_category); ?>"><?php echo esc_html('Read more','wpdancelaparis'); ?></a>
						<?php endif; ?>

					</div>
				</li>			
			<?php $i++; } // End While ?>
			</ul>
		<?php endif; ?>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $content;
	}
}
add_shortcode('tvlgiao_wpdance_category_product', 'tvlgiao_wpdance_category_product_function');
?>