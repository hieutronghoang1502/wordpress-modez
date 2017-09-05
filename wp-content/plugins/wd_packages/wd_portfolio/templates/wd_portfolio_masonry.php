<?php
/**
 * Shortcode: tvlgiao_wpdance_portfolio_masonry
 */

if ( ! function_exists( 'tvlgiao_wpdance_portfolio_masonry_function' ) ) {
	function tvlgiao_wpdance_portfolio_masonry_function( $atts ) {
		$attr = shortcode_atts( array(
			'class'               	=> '',
			'columns'             	=> '1',
			'gap'                 	=> '0px',
			'id_category'         	=> '-1',
			'layout_mode'         	=> 'masonry',
			'number'              	=> '6', 
			'image_size'			=> 'full',
			'sort'					=> 'date',
			'order_by'				=> 'DESC', 
			'pagination_loadmore' 	=> '0',
			'number_loadmore'     	=> '6',
			'random_width'        	=> '1',
			'style'               	=> 'portfolio-style-1',
		), $atts );
		// New Blog
		$args = array(
			'post_type'          	=> 'portfolio',
			'posts_per_page'      	=> $attr['number'],
			'ignore_sticky_posts' 	=> 1,
			'orderby' 				=> $attr['sort'],
			'order'					=> $attr['order_by'],
			'paged'               	=> get_query_var( 'paged' ),
		);

		// Category
		if ( $attr['id_category'] != - 1 ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'wd-portfolio-category',
					'terms'    => $attr['id_category'],
					'field'    => 'term_id',
					'operator' => 'IN',
				),
			);
		}
		// Most View Products
		$posts = new WP_Query( $args );

		$tab_rand   = mt_rand();
		$span_class = '';

		if ( $attr['layout_mode'] == 'masonry' ) {
			$span_class = "col-sm-" . ( 24 / $attr['columns'] );
		}

		$style        = $attr['style'];
		$image_size   = $attr['image_size'];
		$layout_mode  = $attr['layout_mode'];
		$random_width = $attr['random_width'];
		$columns      = $attr['columns'];

		ob_start(); ?>
		<?php if ( $posts->have_posts() ) : ?>
			<div
				class='wd-shortcode-masonry-portfolio <?php echo esc_attr( $attr['style'] ); ?> <?php echo esc_attr( $attr['class'] ); ?>'>
				<div class="grid-isotope masonry-content <?php echo 'grid-item-' . esc_attr( $attr['gap'] ); ?>"
				     data-layout="<?php echo $attr['layout_mode']; ?>">
					<?php while ( $posts->have_posts() ) : $posts->the_post();
						include( WDP_BASE . '/templates/partials/portfolio_masonry.php' );
					endwhile; ?>
				</div><!-- .grid -->
				<?php if ( $attr['pagination_loadmore'] == '1' ) : ?>
					<div class="wd-pagination">
						<?php tvlgiao_wpdance_pagination( 3, $posts ); ?>
					</div><!-- .wd-pagination -->
				<?php endif; ?>
				<?php if ( $attr['pagination_loadmore'] == '0' ) : ?>
					<div class="wd-loadmore">
						<div style="display: none;" class="show_image_loading">
							<img src="<?php echo WDP_IMAGE . '/ajax-loader_image.gif'; ?>" alt="HTML5 Icon"
							     style="height:15px;">
						</div><!-- .show_image_loading -->
						<div class="load_more_masonry">
							<a class="button btn_loadmore_masonry_portfolio"
							   data-number="<?php echo esc_attr( $attr['number_loadmore'] ); ?>"
							   data-id-category="<?php esc_html_e( $attr['id_category'] ); ?>"
							   data-columns="<?php esc_html_e( $attr['columns'] ); ?>"
							   data-sort="<?php esc_html_e( $attr['sort'] ); ?>"
							   data-order_by="<?php esc_html_e( $attr['order_by'] ); ?>"
							   data-image_size="<?php esc_html_e( $attr['image_size'] ); ?>"
							   data-tab-rand="<?php echo $tab_rand ?>"
							   data-style="<?php esc_html_e( $attr['style'] ); ?>"
							   data-width-rand="<?php echo esc_attr( $attr['random_width'] ); ?>"
							   data-layout-mode="<?php echo esc_attr( $attr['layout_mode'] ); ?>">
								<?php _e( 'LOAD MORE', 'wpdance' ) ?>
							</a>
						</div><!-- .load_more_masonry -->
					</div><!-- .loadmore -->
				<?php endif; ?>
			</div><!-- .wd-shortcode-masonry-portfolio -->
			<?php wp_reset_postdata(); ?>
		<?php endif;

		$output = ob_get_clean();
		wp_reset_postdata();

		return $output;
	}
}
add_shortcode( 'tvlgiao_wpdance_portfolio_masonry', 'tvlgiao_wpdance_portfolio_masonry_function' );
?>