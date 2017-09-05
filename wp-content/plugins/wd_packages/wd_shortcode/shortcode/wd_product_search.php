<?php
/**
 * Shortcode: tvlgiao_wpdance_product_by_category
 */

if (!function_exists('tvlgiao_wpdance_product_by_category_function')) {
	function tvlgiao_wpdance_product_by_category_function($atts) {
		extract(shortcode_atts(array(
			'class'				=> ''
		), $atts));
		wp_reset_query();
		$args = array(
			'number'     => '',
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => true,
			'include'    => array()
		);

		$product_categories = get_terms( 'product_cat', $args ); 
		$categories_show = '<option value="">'.esc_html__( 'All Categories', 'wpdancelaparis' ).'</option>';
		$check = '';
		if(is_search()){
			if(isset($_GET['term']) && $_GET['term']!=''){
				$check = $_GET['term'];	
			}
		}
		$checked = '';
		foreach($product_categories as $category){
			if(isset($category->slug)){
				if(trim($category->slug) == trim($check)){
					$checked = 'selected="selected"';
				}
				$categories_show  .= '<option '.$checked.' value="'.$category->slug.'">'.$category->name.'</option>';
				$checked = '';
			}
		}
		ob_start(); ?>
		<div class="wd-search-pro-by-cat <?php echo esc_attr($class); ?>">
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/'  ) ) ?>">
			 	<select class="wd_search_product" name="term"><?php echo balanceTags($categories_show); ?></select>
			 	<div class="wd_search_form">
				 	<input type="text" class="search-field" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php esc_html_e( 'Search for products', 'wpdancelaparis' ); ?> " />
				 	<input type="submit" title="Search" id="searchsubmit" class="search-submit" value="<?php echo esc_attr__( 'Search', 'wpdancelaparis' ); ?>" />
				 	<input type="hidden" name="post_type" value="product" />
				 	<input type="hidden" name="taxonomy" value="product_cat" />
			 	</div>
			</form>
		</div>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $content;
	}
}
add_shortcode('tvlgiao_wpdance_product_by_category', 'tvlgiao_wpdance_product_by_category_function');
?>