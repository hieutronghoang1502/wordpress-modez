<?php
if ( ! function_exists( 'tvlgiao_wpdance_product_categories_list_function' ) ) {
	function tvlgiao_wpdance_product_categories_list_function( $atts ) {
		extract(shortcode_atts( array(
			'title'      			=> 'Categories',
			'ids_category'      	=> '',
			'text_align'      		=> 'text-center',
			'view_all'      		=> '1',
			'class'      			=> 'heading-1',
		), $atts ));

		$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
		if (!$shop_page_url) {
			$shop_page_url = '#';
		}
		ob_start();
			?>
			<div class="wd-products-categories-list <?php echo esc_html($class); ?>">
				<ul class="wd-products-categories-list-content <?php echo esc_html($text_align); ?>">
					<?php if ($title): ?>
						<li class="heading">
							<h2 class="wd-heading">
								<?php echo $title; ?>
							</h2><!-- .wd-heading -->
						</li><!-- .heading -->
					<?php endif ?>
					
					<?php if ($ids_category) {
						foreach ( tvlgiao_wpdance_get_category_name_by_ids( explode( ',', $ids_category ) ) as $category ) {
							$name 	= $category['name'];
							$link 	= get_term_link( $category['id'], 'product_cat' );
							echo '<li class="wd-products-categories-list-item">';
							echo '<a href="'.esc_url($link).'">'.$name.'</a>';
							echo '</li>';
						}
					}else{
						$args = array(
							'number'     => '',
							'orderby'    => 'name',
							'order'      => 'ASC',
							'hide_empty' => true,
						);
						$product_categories = get_terms( 'product_cat', $args );
						foreach ($product_categories as $category) {
							$name 	= $category->name;
							$link 	= get_term_link( $category->term_id, 'product_cat' );
							echo '<li class="wd-products-categories-list-item">';
							echo '<a href="'.esc_url($link).'">'.$name.'</a>';
							echo '</li>';
						}
					}
					?>

					<?php if ($view_all): ?>
						<li>
							<a href="<?php echo esc_url($shop_page_url); ?>" role="tab"><?php esc_html_e( 'View All', 'wpdancelaparis' ) ?></a>
						</li><!-- .heading -->
					<?php endif ?>
				</ul>
			</div><!-- .products-by-category-tabs -->
			<?php
		wp_reset_postdata();
		return ob_get_clean();
	}
}
add_shortcode( 'tvlgiao_wpdance_product_categories_list', 'tvlgiao_wpdance_product_categories_list_function' );