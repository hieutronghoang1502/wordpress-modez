<?php
if(!function_exists ('tvlgiao_wpdance_grid_list_toggle_button')){
	function tvlgiao_wpdance_grid_list_toggle_button(){ ?>
		<nav id="options" class="gridlist-toggle hidden-xs">
			<ul class="option-set" data-option-key="layoutMode">
				<li data-option-value="vertical" id="list" class="goAction wd-tooltip" data-toggle="tooltip" title="<?php _e('List view', 'wpdancelaparis'); ?>">
					<i class="fa fa-th-list"></i>
				</li>
				<li data-option-value="fitRows" id="grid" class="goAction wd-tooltip" data-toggle="tooltip" title="<?php _e('Grid view', 'wpdancelaparis'); ?>">
					<i class="fa fa-th-large"></i>
				</li>
			</ul>
		</nav>		
	<?php 
	}
}

if(!function_exists ('tvlgiao_wpdance_product_facebook_comment_form')){
	function tvlgiao_wpdance_product_facebook_comment_form(){ ?>
		<?php 
		global $tvlgiao_wpdance_theme_options;
		$display 	= $tvlgiao_wpdance_theme_options['tvlgiao_wpdance_comment_facebook_display_on_single_product']; 
		?>
		<?php if ($display): ?>
			<div class="wd-comment-form">
				<?php echo tvlgiao_wpdance_get_comment_form_facebook();; ?>
			</div>
		<?php endif ?>
	<?php 
	}
}

//Get availability product
if(!function_exists ('tvlgiao_wpdance_get_product_availability')){
	function tvlgiao_wpdance_get_product_availability($product) {
		$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
		if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
			return;
		}	
		$availability = $class = "";

		if ( $product->managing_stock() ) {
			if ( $product->is_in_stock() ) {

				if ( $product->get_stock_quantity() > 0 ) {

					$format_option = get_option( 'woocommerce_stock_format' );

					switch ( $format_option ) {
						case 'no_amount' :
							$format = esc_html__( 'In stock', 'wpdancelaparis' );
						break;
						case 'low_amount' :
							$low_amount = get_option( 'woocommerce_notify_low_stock_amount' );

							$format = ( $product->get_stock_quantity() <= $low_amount ) ? esc_html__( 'Only %s left in stock', 'wpdancelaparis' ) : esc_html__( 'In stock', 'wpdancelaparis' );
						break;
						default :
							$format = esc_html__( '%s in stock', 'wpdancelaparis' );
						break;
					}

					$availability = sprintf( $format, $product->get_stock_quantity() );
					$class = 'in-stock';

					if ( $product->backorders_allowed() && $product->backorders_require_notification() )
						$availability .= ' ' . esc_html__( '(backorders allowed)', 'wpdancelaparis' );

				} else {

					if ( $product->backorders_allowed() ) {
						if ( $product->backorders_require_notification() ) {
							$availability = esc_html__( 'Available on backorder', 'wpdancelaparis' );
							$class        = 'available-on-backorder';
						} else {
							$availability = esc_html__( 'In stock', 'wpdancelaparis' );
						}
					} else {
						$availability = esc_html__( 'Out of stock', 'wpdancelaparis' );
						$class        = 'out-of-stock';
					}

				}

			} elseif ( $product->backorders_allowed() ) {
				$availability = esc_html__( 'Available on backorder', 'wpdancelaparis' );
				$class        = 'available-on-backorder';
			} else {
				$availability = esc_html__( 'Out of stock', 'wpdancelaparis' );
				$class        = 'out-of-stock';
			}
		} elseif ( ! $product->is_in_stock() ) {
			$availability = esc_html__( 'Out of stock', 'wpdancelaparis' );
			$class        = 'out-of-stock';
		} elseif ( $product->is_in_stock() ){
			$availability = esc_html__( 'In stock', 'wpdancelaparis' );
			$class        = 'in-stock';		
		}

		return apply_filters( 'woocommerce_get_availability', array( 'availability' => $availability, 'class' => $class ), $product );
	}
}

//use on template woocommerce/single-product/add-to-cart/variable.php
if(!function_exists ('tvlgiao_wpdance_color_image_option_html')){
	function tvlgiao_wpdance_color_image_option_html($name, $options){ 
		$orderby = wc_attribute_orderby( $name );
		switch ( $orderby ) {
			case 'name' :
				$args = array( 'orderby' => 'name', 'hide_empty' => false, 'menu_order' => false );
				break;
			case 'id' :
				$args = array( 'orderby' => 'id', 'order' => 'ASC', 'menu_order' => false, 'hide_empty' => false );
				break;
			case 'menu_order' :
				$args = array( 'menu_order' => 'ASC', 'hide_empty' => false );
				break;
		}
		$terms = get_terms( $name, $args );
		$select_opt = '';
		$select_opt .= "<div class=\"wd_color_image_swap\">";
		foreach ( $terms as $term ) {
			
			if ( ! in_array( $term->slug, $options ) )
				continue;
			$datas = get_term_meta($term->term_id, "wd_pc_color_config", true );
			if( strlen($datas) > 0 ){
				$datas = unserialize($datas);	
			}else{
				$datas = array(
					'wd_pc_color_color' 				=> "#aaaaaa"
					,'wd_pc_color_image' 				=> 0
				);
			}
			$select_opt .= "<div style=\"width: 30px; height:30px; background-color: ".$datas['wd_pc_color_color']."\" class=\"wd-select-option\" data-value=\"".esc_attr($term->slug)."\">";
			if( absint($datas['wd_pc_color_image']) > 0 ){
				$_img = wp_get_attachment_image_src( absint($datas['wd_pc_color_image']), 'wd_pc_thumb', true ); 
				$_img = $_img[0];
				$select_opt .= "<img alt=\"".$datas['wd_pc_color_color']."\" src=\"".esc_url( $_img )."\" class=\"wd_pc_preview_image\" />";
				
			} else {
				$select_opt .= "<a style=\"width: 30px; height:30px; background-color: ".$datas['wd_pc_color_color']."\"></a>";
			}
			$select_opt .= "</div>";
			
		}
		$select_opt .= "</div>";
		
		return $select_opt;
	}
}


if(!function_exists ('tvlgiao_wpdance_shop_loop_product_attribute_color')){
	function tvlgiao_wpdance_shop_loop_product_attribute_color(){
		if(!class_exists('WD_Shopbycolor')) {
			return;
		}
		global $product;
		if ( $product->is_type( 'variable' ) ) {
			$attr_name = 'pa_color';
			$attributes = $product->get_variation_attributes();
			if ($attributes && !is_wp_error( $attributes )) {
				foreach ($attributes as $attr => $options) {
					if ($attr == $attr_name) {
						if ( taxonomy_exists( $attr_name ) ) {
				            echo tvlgiao_wpdance_color_image_option_html($attr_name, $options);
				        }
					}
				}
			}
		}
	}
}

if(!function_exists ('tvlgiao_wpdance_template_single_review')){
	function tvlgiao_wpdance_template_single_review(){
		global $product;

		if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
			return;	
		$rating_html = '';
		if( function_exists('wd_get_rating_html') ){
			$rating_html = wd_get_rating_html();
		}
		if ( $rating_html ) {
			echo "<div class=\"review_wrapper\">";
			echo '<span class="add_new_review"><a href="#reviews" class="inline show_review_form woocommerce-review-link" title="Review for '. esc_attr($product->get_title()) .' "><i class="fa fa-pencil-square-o"></i>' . esc_html__( 'Add your review', 'wpdancelaparis' ) . '</a></span>';
			echo "</div>";
		}else{
			echo '<p><span class="add_new_review"><a href="#reviews" class="inline show_review_form woocommerce-review-link" title="Review for '. esc_attr($product->get_title()) .' "><i class="fa fa-pencil-square-o"></i>' . esc_html__( 'Be the first to review', 'wpdancelaparis' ) . '</a></span></p>';
		}		
	}
}

if(!function_exists ('tvlgiao_wpdance_template_single_availability')){
	function tvlgiao_wpdance_template_single_availability(){
		global $product;
		$_product_stock = tvlgiao_wpdance_get_product_availability($product); ?>
		<p class="availability stock <?php echo esc_attr($_product_stock['class']);?>"><?php esc_html_e('Availability','wpdancelaparis');?>: <span><?php echo esc_attr($_product_stock['availability']);?></span></p><?php		
	}
}

if(!function_exists ('tvlgiao_wpdance_template_single_sku')){
	function tvlgiao_wpdance_template_single_sku(){
		global $product, $post;
		if (trim($product->get_sku())) {
			$sku_label = esc_html__("Sku:",'wpdancelaparis');
			echo "<p class='wd_product_sku product_meta'>" . $sku_label . " <span class=\"product_sku sku\">" . esc_attr($product->get_sku()) . "</span></p>";
		}
	}
}

/* woocommerce category image */
if(!function_exists ('tvlgiao_wpdance_woocommerce_category_image')){
	function tvlgiao_wpdance_woocommerce_category_image() {
	    if ( is_product_category() ){
            global $wp_query;
            $cat = $wp_query->get_queried_object();
            $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
            $image = wp_get_attachment_url( $thumbnail_id );
            if ( $image ) {
            		echo "<div class='wd-cat-thumb-archive-product'>";
                    echo '<img src="' . $image . '" alt="'.get_bloginfo('name').'" />';
                    echo "</div>";
                }
        }
	}
}

if(!function_exists ('tvlgiao_wpdance_get_product_share')){
	function tvlgiao_wpdance_get_product_share(){
		echo '<div class="wd_product_share">';
			tvlgiao_wpdance_accessibility_template_single_social_sharing();
		echo '</div>';
	}
}

if(!function_exists ('tvlgiao_wpdance_get_product_tags')){
	function tvlgiao_wpdance_get_product_tags(){
		echo '<div class="wd_product_tags">';
			global $product, $post;
			$_terms = wp_get_post_terms( $product->get_id(), 'product_tag');
			$tags_label = esc_html__("Tags: ",'wpdancelaparis');
			echo '<div class="tagcloud">';
			
			$_include_tags = '';
			if( count($_terms) > 0 ){
				echo '<span class="tag_heading">'.$tags_label.'</span>';
				foreach( $_terms as $index => $_term ){
					$_include_tags .= ( $index == 0 ? "{$_term->term_id}" : ",{$_term->term_id}" ) ;
				}
				wp_tag_cloud( array('taxonomy' => 'product_tag', 'include' => $_include_tags, 'separator'=>'' ) );
			}
			
			echo "</div>\n";
		echo '</div>';
	}
}

if(!function_exists ('tvlgiao_wpdance_single_product_tag_tab')){
	function tvlgiao_wpdance_single_product_tag_tab( $tabs ) {
		global $product;
		if (count($product->get_tag_ids())){
			$tabs['wd_tag_tab'] = array(
				'title' 	=> __( 'Product Tags', 'wpdancelaparis' ),
				'priority' 	=> 30,
				'callback' 	=> 'tvlgiao_wpdance_get_product_tags'
			);
		}
		return $tabs;
	}
}

if(!function_exists ('tvlgiao_wpdance_get_product_categories')){
	function tvlgiao_wpdance_get_product_categories(){
		global $product;
		$categories_label = esc_html__("Categories: ",'wpdancelaparis');
		$rs = '';
		$rs .= '<div class="wd_product_categories"><span>'.$categories_label.'</span>';
		$product_categories = wp_get_post_terms(get_the_ID($product),'product_cat');
		$count = count($product_categories);
		if ( $count > 0 ){
			foreach ( $product_categories as $term ) {
			$rs.= '<a href="'.get_term_link($term->slug,$term->taxonomy).'">'.$term->name . "</a>, ";

			}
			$rs = substr($rs,0,-2);
		}
		$rs .= '</div>';
		echo wp_kses_post( $rs );
	}
}

if(!function_exists ('tvlgiao_wpdance_get_product_categories')){
	function tvlgiao_wpdance_get_product_categories(){
		echo '<div class="wd_product_categoried">';
			tvlgiao_wpdance_get_product_categories();
		echo '</div>';
	}
}


if(!function_exists ('tvlgiao_wpdance_archive_number_perpage')){
	function tvlgiao_wpdance_archive_number_perpage(){ 
		extract(tvlgiao_wpdance_get_custom_data_special_template( 'product-archive-posts-per-page' ));
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$posts_per_page.';' ), 20 );
	}
}

if(!function_exists ('tvlgiao_wpdance_short_description_product')){
	function tvlgiao_wpdance_short_description_product() { 
		extract(tvlgiao_wpdance_get_custom_data_special_template( 'product-description' )); ?>
		<div class="wp_description_product <?php echo (!$show_description) ? 'wd_hidden_desc_product' : 'wd_show_desc_product'; ?>">
	 		<?php tvlgiao_wpdance_the_excerpt_max_words($number_word); ?> [...]
	 	</div> 
		<?php 
	}
}

if(!function_exists ('tvlgiao_wpdance_wishlist_button_shop_loop')){
	function tvlgiao_wpdance_wishlist_button_shop_loop(){
		echo do_shortcode('[yith_wcwl_add_to_wishlist]');
	}
}

if(!function_exists ('tvlgiao_wpdance_flash_featured')){
	function tvlgiao_wpdance_flash_featured(){
		global $product;
		if ( $product->is_featured() ) { ?>
			<span class="featured"><?php esc_html_e('Hot','wpdancelaparis');?></span>
		<?php } 
	}
}

//Get Price Sale Percent
if(!function_exists ('tvlgiao_wpdance_get_price_sale_percent')){
	function tvlgiao_wpdance_get_price_sale_percent(){
		global $product;
		if ($product->is_on_sale()){ 
			if( $product->get_regular_price() > 0 ){
				return round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
			}
		}
	}
}
//Get Price Sale Text
if(!function_exists ('tvlgiao_wpdance_get_flash_sale_content')){
	function tvlgiao_wpdance_get_flash_sale_content(){ 
		extract(tvlgiao_wpdance_get_custom_data_special_template( 'product-sale-flash' ));
		if ($show_percent) {
			$percent = tvlgiao_wpdance_get_price_sale_percent();
			if ($percent && $percent < 100) {
				$text .= $percent.'%';
			}else{
				$text = __( 'Sale!', 'wpdancelaparis' );
			}
		}
		return $text;
	}
}
?>