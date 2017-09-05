<?php
// Get Data Choose normal for widget
if(!function_exists ('tvlgiao_wpdance_get_data')){
	function tvlgiao_wpdance_get_data($array_data){
		global $post;
		$data_array = array();
		$data = new WP_Query($array_data);
		if( $data->have_posts() ){
			while( $data->have_posts() ){
				$data->the_post();
				$data_array[$post->ID] = $post->post_title;
			}
		}
		wp_reset_postdata();
		return $data_array;
	}
}

// Get Data Choose for visual composer
if(!function_exists ('tvlgiao_wpdance_vc_get_data')){
	function tvlgiao_wpdance_vc_get_data_by_post_type($post_type = 'post', $posts_per_page = -1){
		$args = array(
			'post_type'			=> $post_type,
			'post_status'		=> 'publish',
			'posts_per_page' 	=> $posts_per_page,
		);
		$data_array = array();
		global $post;
		$data = new WP_Query($args);
		if( $data->have_posts() ){
			while( $data->have_posts() ){
				$data->the_post();
				$data_array[] = array(
					'label' => html_entity_decode( $post->post_title, ENT_QUOTES, 'UTF-8' ).' ('.$post->ID.')',
					'value' => $post->ID,	
				);
			}
		}
		wp_reset_postdata();
		return $data_array;
	}
} 

// Get List TVLGIAO Columns
if(!function_exists ('tvlgiao_wpdance_vc_get_list_tvgiao_columns')){
	function tvlgiao_wpdance_vc_get_list_tvgiao_columns(){
		return array(
			'1 Columns'		=> '1',
			'2 Columns'		=> '2',
			'3 Columns'		=> '3',
			'4 Columns'		=> '4',
			'5 Columns'		=> '5',
			'6 Columns'		=> '6',
			'8 Columns'		=> '8',
			'12 Columns'	=> '12',
		);
	}
}


// Get List TVLGIAO Text Align Bootstrap
if(!function_exists ('tvlgiao_wpdance_vc_get_list_text_align_bootstrap')){
	function tvlgiao_wpdance_vc_get_list_text_align_bootstrap(){
		return array(
			'Default' 				=> 'wd-text-align-default',
			'Center aligned text' 	=> 'text-center',
			'Left aligned text' 	=> 'text-left'	,
			'Right aligned text' 	=> 'text-right',
			'Justified text' 		=> 'text-justify',
			'No wrap text' 			=> 'text-nowrap',
		);
	}
}


if ( ! function_exists( 'tvlgiao_wpdance_get_order_by_values' ) ) {
	function tvlgiao_wpdance_get_order_by_values($type = '') {
		if ($type == 'product') {
			$order_by = array(
		        'Date' 		=> 'date',
		        'Title' 	=> 'title',
		        'Rand' 		=> 'rand',
		        'Price' 	=> 'price',
		        'Sales' 	=> 'sales',
			);
		}elseif ($type == 'term') {
			$order_by = array(
		        'Name' 			=> 'name',
				'Count' 		=> 'count',
				'Slug' 			=> 'slug',
				'Term Group' 	=> 'term_group',
				'Term Order' 	=> 'term_order',
				'Term ID' 		=> 'term_id',
			);
		}else{
			$order_by = array(
		        'Date' 	=> 'date',
		        'Title' => 'title',
		        'Rand' 	=> 'rand',
			);
		}
		return $order_by;
	}
}

if ( ! function_exists( 'tvlgiao_wpdance_get_sort_by_values' ) ) {
	function tvlgiao_wpdance_get_sort_by_values() {
		return array(
            'DESC' 	=> 'DESC',
			'ASC' 	=> 'ASC',
		);
	}
}

// Get List woocomemrce image size
if(!function_exists ('tvlgiao_wpdance_vc_get_list_woocommerce_image_size')){
	function tvlgiao_wpdance_vc_get_list_woocommerce_image_size($fullsize = true){
		if ($fullsize == true) {
			$list_woocommerce_image_size = array(
				'Fullsize'					=> 'full',
				'Shop Catalog'				=> 'shop_catalog',
				'Shop Single (Big)' 		=> 'shop_single',
				'Shop Thumbnail (Small)'	=> 'shop_thumbnail',
			);
		} else {
			$list_woocommerce_image_size = array(
				'Shop Catalog'				=> 'shop_catalog',
				'Shop Single (Big)' 		=> 'shop_single',
				'Shop Thumbnail (Small)'	=> 'shop_thumbnail',
			);
		}
		return $list_woocommerce_image_size;
	}
}

// Get link target
if(!function_exists ('tvlgiao_wpdance_vc_get_list_link_target')){
	function tvlgiao_wpdance_vc_get_list_link_target(){
		return array(
			'New window' 		=> '_blank',
 			'Current window' 	=> '_self',	
 			'Parent' 			=> '_parent',
		);
	}
}

// Get List Slider Type (Slick or Owl)
if(!function_exists ('tvlgiao_wpdance_vc_get_list_slider_type')){
	function tvlgiao_wpdance_vc_get_list_slider_type(){
		return array(
			'Owl Carousel' 	=> 'owl',
			'Slick' 		=> 'slick'
		);
	}
}

// Get List Image Size
if(!function_exists ('tvlgiao_wpdance_vc_get_list_image_size')){
	function tvlgiao_wpdance_vc_get_list_image_size($fullsize = true){
		global $_wp_additional_image_sizes;
		$image_size = array();
		if ($fullsize) {
			$image_size['Full'] = 'full';
		}
		foreach ($_wp_additional_image_sizes as $key => $value) {
			$image_size[$key.' - '.$value['width'].'x'.$value['height']] = $key;
		} 
		return $image_size;
	}
}

// Get List of menu theme location (registed)
if(!function_exists ('tvlgiao_wpdance_get_list_menu_registed')){
	function tvlgiao_wpdance_get_list_menu_registed(){
		$menu_registed = get_registered_nav_menus();
		$list_menu = array();
		if ($menu_registed) {
			foreach ($menu_registed as $menu => $value ) {
				$list_menu[] = array(
					'label' => html_entity_decode( $value, ENT_QUOTES, 'UTF-8' ).' ('.$menu.')',
					'value' => $menu,	
				);
			}
		}
		wp_reset_postdata();
		return $list_menu;
	}
}


if ( ! function_exists( 'tvlgiao_wpdance_get_category_name_by_ids' ) ) {
	function tvlgiao_wpdance_get_category_name_by_ids( $ids = array() ) {
		$output = array();
		foreach ( $ids as $id ) {
			if ( $term = get_term_by( 'id', $id, 'product_cat' ) ) {
				$output[] = array(
					'id'   => $term->term_id,
					'name' => $term->name,
					'slug' => str_replace( '_', '-', $term->slug ) . '-' . $term->term_id . '-' . rand(),
				);
			}
		}
		return $output;
	}
}

// Get List terms of taxonomy
if(!function_exists ('tvlgiao_wpdance_vc_get_list_category')){
	function tvlgiao_wpdance_vc_get_list_category($taxonomy = 'product_cat', $all_category = true, $type = 'autocomplete'){
		/* type : 
		 * Default : autocomplete => return array with label & value 
		 * sorted_list  => return special array use for sorted_list type
		 */
		$list_categories = array();
		if ($all_category) {
			if ($type == 'sorted_list') {
				$list_categories[] = array( -1, esc_html__('All Category','wpdancelaparis') );
			}else{
				$list_categories[esc_html__('All Category','wpdancelaparis')] = -1;
			}
		}
		$args = array('hide_empty' 	=> 0);
		$condition = true;
		if($taxonomy == 'product_cat') {
			if( !class_exists('WooCommerce') ){
				$condition = false;
			}
		}
		if ($condition) {
			$categories = get_terms( $taxonomy, $args );
			if (!is_wp_error($categories) && count($categories) > 0) {
				foreach ($categories as $category ) {
					$name       = html_entity_decode( $category->name, ENT_QUOTES, 'UTF-8' ).' (' . $category->count . ' items)';
					$term_id    = $category->term_id;
					if ($type == 'sorted_list') {
						$list_categories[] = array( $term_id, $name );
					}else{
						$list_categories[] = array(
							'label' => $name,
							'value' => $term_id,	
						);	
					}
				}
			}
		}
		wp_reset_postdata();
		return $list_categories;
	}
}

if ( ! function_exists( 'tvlgiao_wpdance_get_product_categories_full' ) ) {
	function tvlgiao_wpdance_get_product_categories_full( $all_category = true, $type = "" ) {
		/* type : 
		 * Default : '' => return normal array
		 * autocomplete => return array with label & value 
		 * sorted_list  => return special array use for sorted_list type
		 */
		$args = array(
			'type'         => 'post',
			'child_of'     => 0,
			'parent'       => '',
			'orderby'      => 'id',
			'order'        => 'ASC',
			'hide_empty'   => false,
			'hierarchical' => 1,
			'exclude'      => '',
			'include'      => '',
			'number'       => '',
			'taxonomy'     => 'product_cat',
			'pad_counts'   => false,
		);

		$categories = get_categories( $args );

		$product_categories_dropdown = array();

		if ( $all_category ) {
			if ($type == 'autocomplete') {
				$product_categories_dropdown[] = array(
					'label' => __( 'All Category', 'wpdancelaparis' ),
					'value' => -1,
				);
			}elseif ($type == 'sorted_list') {
				$product_categories_dropdown[] = array( -1, __( 'All Category', 'wpdancelaparis' ) );
			}else{
				$product_categories_dropdown[ __( 'All Category', 'wpdancelaparis' ) ] = - 1;
			}
		}

		tvlgiao_wpdance_get_category_childs_full( 0, 0, $categories, 0, $product_categories_dropdown, $type );

		return $product_categories_dropdown;
	}
}

if ( ! function_exists( 'tvlgiao_wpdance_get_category_childs_full' ) ) {
	function tvlgiao_wpdance_get_category_childs_full( $parent_id, $pos, $array, $level, &$dropdown, $type = "" ) {
		for ( $i = $pos; $i < count( $array ); $i ++ ) {
			if ( $array[ $i ]->category_parent == $parent_id ) {
				$term_id    = $array[ $i ]->term_id;
				$name       = str_repeat( '- ', $level ) . $array[ $i ]->name;
				$name 		= html_entity_decode( $name, ENT_QUOTES, 'UTF-8' ).' [ ID: '.$term_id.' ]';
				if ($type == 'autocomplete') {
					$dropdown[] = array(
						'label' => $name,
						'value' => $term_id,	
					);
				}elseif ($type == 'sorted_list') {
					$dropdown[] = array( $term_id, $name );
				}else{
					$dropdown[$name] = $term_id;
				}
				tvlgiao_wpdance_get_category_childs_full( $array[ $i ]->term_id, $i, $array, $level + 1, $dropdown );
			}
		}
	}
} ?>