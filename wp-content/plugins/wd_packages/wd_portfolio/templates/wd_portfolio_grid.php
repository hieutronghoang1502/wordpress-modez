<?php
/**
 * Shortcode: tvlgiao_wpdance_special_gird_list_blog
 */

if ( ! function_exists( 'tvlgiao_wpdance_portfolio_gird' ) ) {
	function tvlgiao_wpdance_portfolio_gird( $atts ) {
		$attr = shortcode_atts( array(
			'class'               => '',
			'columns'             => '1',
			'excerpt_words'       => '20',
			'gap'                 => '0px',
			'id_category'         => '-1',
			'number_blogs'        => '12',
			'number_loadmore'     => '8',
			'order_by'            => 'DESC',
			'pagination_loadmore' => '1',
			'sort'                => 'term_id',
			'style'               => 'portfolio-style-1',
		), $atts );

		// New blog
		$args = array(
			'post_type'      => 'portfolio',
			'posts_per_page' => $attr['number_blogs'],
			'orderby'        => $attr['sort'],
			'order'          => $attr['order_by'],
			'paged'          => get_query_var( 'paged' ),
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
		$special_portfolio = new WP_Query( $args );

		$span_class        = "col-sm-" . ( 24 / $attr['columns'] );
		$style             = $attr['style'];

		$tab_rand        = mt_rand();
		ob_start(); ?>
		<?php if ( $special_portfolio->have_posts() ) : ?>
			<div class="wd-wrapper-special-grid">
				<div
					class='wd-shortcode-special-grid-portfolio <?php esc_html_e( $attr['class'] ); ?> <?php esc_html_e( $attr['style'] ); ?>'>
					<div class="grid wd-portfolio-content <?php echo 'grid-item-' . esc_attr( $attr['gap'] ); ?>">
						<?php while ( $special_portfolio->have_posts() ) : $special_portfolio->the_post();
							include( WDP_BASE . '/templates/partials/portfolio_grid.php' );
						endwhile; ?>
					</div><!-- .grid -->
				</div><!-- .wd-shortcode-special-grid-portfolio -->
				<div class="clear clearfix"></div>
				<?php if ( $attr['pagination_loadmore'] == "1" ) : ?>
					<div class="wd-pagination">
						<?php tvlgiao_wpdance_pagination( 3, $special_portfolio ) ?>
					</div><!-- .wd-pagination -->
				<?php endif; ?>
				<?php if ( $attr['pagination_loadmore'] == "0" ) : ?>
					<div class="wd-loadmore">
						<div style="display: none;" class="show_image_loading">
							<img src="<?php echo WDP_IMAGE . '/ajax-loader_image.gif'; ?>" alt="HTML5 Icon"
							     style="height:15px;">
						</div><!-- .show_image_loading -->

						<div id="loadmore">
							<a href="#"
							   class="button btn_loadmore_grid_portfolio"
							   data-number="<?php esc_html_e( $attr['number_loadmore'] ); ?>"
							   data-id-category="<?php esc_html_e( $attr['id_category'] ); ?>"
							   data-columns="<?php esc_html_e( $attr['columns'] ); ?>"
							   data-tab-rand="<?php echo $tab_rand ?>"
							   data-style="<?php esc_html_e( $attr['style'] ); ?>">
								<?php _e( 'LOAD MORE', 'wpdance' ) ?></a>
						</div><!-- #loadmore -->
					</div><!-- .wd-loadmore -->
				<?php endif; ?>
			</div><!-- .wd-wrapper-special-grid -->
			<?php wp_reset_postdata(); ?>
		<?php endif;
		$content = ob_get_clean();

		return $content;
	}
}
add_shortcode( 'tvlgiao_wpdance_portfolio_gird', 'tvlgiao_wpdance_portfolio_gird' );
?>