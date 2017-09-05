<?php 
if(!function_exists ('tvlgiao_wpdance_get_custom_data_special_template')){
	function tvlgiao_wpdance_get_custom_data_special_template( $template ) {
		$data = array();
		if (TVLGIAO_WPDANCE_USE_CONTROL == 'customize') { 
			switch ($template) { 
				case 'header-default':
					$data['show_logo_title']	  	= get_theme_mod('tvlgiao_wpdance_header_show_logo_title', '0'); 
					$data['logo_default']	  		= TVLGIAO_WPDANCE_THEME_IMAGES.'/wpdance_logo.png'; 
					$data['logo_url']	  		  	= get_theme_mod('tvlgiao_wpdance_header_logo_url', TVLGIAO_WPDANCE_THEME_IMAGES.'/wpdance_logo.png'); 
					$data['menu_location']	  		= get_theme_mod('tvlgiao_wpdance_header_menu_location', 'primary'); 
					break;

				case 'footer-default':
					$data['logo_default']	  		= TVLGIAO_WPDANCE_THEME_IMAGES.'/wpdance_logo.png'; 
					$data['logo_url']	  			= get_theme_mod('tvlgiao_wpdance_footer_logo_url', TVLGIAO_WPDANCE_THEME_IMAGES.'/wpdance_logo.png');
					$data['copyright'] 				= get_theme_mod('tvlgiao_wpdance_footer_copyright_text',esc_html__('Copyright CodeSpot. All rights reserved.','wpdancelaparis'));
					break;

				case 'breadcrumb-default':
					$data['layout_breadcrumbs']		= get_theme_mod('tvlgiao_wpdance_breadcrumb','breadcrumb_default');
					$data['image_breadcrumbs']		= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb', TVLGIAO_WPDANCE_THEME_IMAGES.'/banner_breadcrumb.jpg');
					$data['height']					= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_height', '100');
					$data['color_breadcrumbs']		= get_theme_mod('tvlgiao_wpdance_color_breadcrumb', '#f2f2f2');
					$data['text_color']				= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_text_color', '#212121');
					$data['text_style']				= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_text_style', 'inline');
					$data['text_align']				= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_text_align', 'text-center');
					break;

				case 'breadcrumb-custom-setting':
					$data['blog_archive']			= false;
					$data['product_archive']		= false;
					$data['woo_special_page']		= false;
					$data['search_page']			= false;
					break;

				case 'breadcrumb-blog-archive':
					$data['layout_breadcrumbs']		= get_theme_mod('tvlgiao_wpdance_breadcrumb','breadcrumb_default');
					$data['image_breadcrumbs']		= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb', TVLGIAO_WPDANCE_THEME_IMAGES.'/banner_breadcrumb.jpg');
					$data['height']					= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_height', '100');
					$data['color_breadcrumbs']		= get_theme_mod('tvlgiao_wpdance_color_breadcrumb', '#f2f2f2');
					$data['text_color']				= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_text_color', '#212121');
					$data['text_style']				= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_text_style', 'inline');
					$data['text_align']				= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_text_align', 'text-center');
					break;

				case 'breadcrumb-product-archive':
					$data['layout_breadcrumbs']		= get_theme_mod('tvlgiao_wpdance_breadcrumb','breadcrumb_default');
					$data['image_breadcrumbs']		= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb', TVLGIAO_WPDANCE_THEME_IMAGES.'/banner_breadcrumb.jpg');
					$data['height']					= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_height', '100');
					$data['color_breadcrumbs']		= get_theme_mod('tvlgiao_wpdance_color_breadcrumb', '#f2f2f2');
					$data['text_color']				= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_text_color', '#212121');
					$data['text_style']				= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_text_style', 'inline');
					$data['text_align']				= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_text_align', 'text-center');
					break;

				case 'breadcrumb-woo-special-page':
					$data['layout_breadcrumbs']		= get_theme_mod('tvlgiao_wpdance_breadcrumb','breadcrumb_default');
					$data['image_breadcrumbs']		= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb', TVLGIAO_WPDANCE_THEME_IMAGES.'/banner_breadcrumb.jpg');
					$data['height']					= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_height', '100');
					$data['color_breadcrumbs']		= get_theme_mod('tvlgiao_wpdance_color_breadcrumb', '#f2f2f2');
					$data['text_color']				= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_text_color', '#212121');
					$data['text_style']				= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_text_style', 'inline');
					$data['text_align']				= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_text_align', 'text-center');
					break;

				case 'breadcrumb-search-page':
					$data['layout_breadcrumbs']		= get_theme_mod('tvlgiao_wpdance_breadcrumb','breadcrumb_default');
					$data['image_breadcrumbs']		= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb', TVLGIAO_WPDANCE_THEME_IMAGES.'/banner_breadcrumb.jpg');
					$data['height']					= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_height', '100');
					$data['color_breadcrumbs']		= get_theme_mod('tvlgiao_wpdance_color_breadcrumb', '#f2f2f2');
					$data['text_color']				= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_text_color', '#212121');
					$data['text_style']				= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_text_style', 'inline');
					$data['text_align']				= get_theme_mod('tvlgiao_wpdance_banner_breadcrumb_text_align', 'text-center');
					break;

				case 'default-page':
					$data['layout'] 				= get_theme_mod('tvlgiao_wpdance_default_page_layout','0-0-0');
					$data['sidebar_left'] 			= get_theme_mod('tvlgiao_wpdance_default_page_sidebar_left','sidebar');
					$data['sidebar_right'] 			= get_theme_mod('tvlgiao_wpdance_default_page_sidebar_right','sidebar');
					break;

				case 'archive-blog':
					$data['layout'] 				= get_theme_mod('tvlgiao_wpdance_archive_blog_layout','0-0-0');
					$data['sidebar_left'] 			= get_theme_mod('tvlgiao_wpdance_archive_blog_sidebar_left' ,'sidebar');
					$data['sidebar_right'] 			= get_theme_mod('tvlgiao_wpdance_archive_blog_sidebar_right','sidebar');
					$data['show_by_post_format'] 	= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_by_post_format', '1');
					break;

				case 'content-blog':
					$data['grid_list_layout'] 		= get_theme_mod('tvlgiao_wpdance_single_blog_recent_post_style','list');
					$data['is_slider'] 				= get_theme_mod('tvlgiao_wpdance_single_blog_recent_post_is_slider','1');
					$data['columns'] 				= get_theme_mod('tvlgiao_wpdance_single_blog_recent_post_columns','2');
					$data['show_title']  			= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_title','1');
				 	$data['show_thumbnail']  		= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_thumbnail','1');
				 	$data['placeholder_image']  	= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_placeholder_image','0');
				 	$data['show_date']  			= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_date','1');
				 	$data['show_author']  			= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_author','1');
				 	$data['show_number_comments']  	= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_number_comment','1');
				 	$data['show_category']  		= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_category','1');
				 	$data['show_readmore']  		= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_read_more','1');
				 	$data['show_excerpt']  			= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_excerpt','1');
				 	$data['number_excerpt']  		= get_theme_mod('tvlgiao_wpdance_genneral_blog_number_excerpt','20');
					break;

				case 'single-blog':
					$data['layout'] 				= get_theme_mod('tvlgiao_wpdance_single_blog_layout','0-0-0');
					$data['sidebar_left'] 			= get_theme_mod('tvlgiao_wpdance_single_blog_sidebar_left','sidebar');
					$data['sidebar_right'] 			= get_theme_mod('tvlgiao_wpdance_single_blog_sidebar_right','sidebar');
					$data['show_author_information'] = get_theme_mod('tvlgiao_wpdance_single_blog_author_information', '1');
					$data['show_previous_next_btn'] = get_theme_mod('tvlgiao_wpdance_single_blog_previous_next_button', '1');
					$data['show_recent_blog'] 		= get_theme_mod('tvlgiao_wpdance_single_blog_recent_post', '1');
					$data['show_title']  			= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_title','1');
				 	$data['show_thumbnail']  		= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_thumbnail','1');
				 	$data['show_date']  			= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_date','1');
				 	$data['show_author']  			= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_author','1');
				 	$data['show_number_comments']  	= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_number_comment','1');
				 	$data['show_category']  		= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_category','1');
				 	$data['show_readmore']  		= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_read_more','1');
				 	$data['show_excerpt']  			= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_excerpt','1');
				 	$data['number_excerpt']  		= get_theme_mod('tvlgiao_wpdance_genneral_blog_number_excerpt','20');
					break;

				case 'archive-product':
					$data['layout'] 				= get_theme_mod('tvlgiao_wpdance_archive_product_layout','0-0-0');
					$data['sidebar_left'] 			= get_theme_mod('tvlgiao_wpdance_archive_product_sidebar_left' ,'sidebar');
				   	$data['sidebar_right'] 			= get_theme_mod('tvlgiao_wpdance_archive_product_sidebar_right','sidebar');
				   	$data['columns_product'] 		= get_theme_mod('tvlgiao_wpdance_archive_columns_product','3');
					break;

				case 'product-archive-posts-per-page':
					$data['posts_per_page'] 		= get_theme_mod('tvlgiao_wpdance_cart_shortcode','15');
					break;

				case 'woocommerce-page':
					$data['layout']  				= get_theme_mod('tvlgiao_wpdance_page_woocommerce_layout','0-0-0');
					$data['sidebar_left']  			= get_theme_mod('tvlgiao_wpdance_page_woocommerce_sidebar_left','sidebar');
					$data['sidebar_right']  		= get_theme_mod('tvlgiao_wpdance_page_woocommerce_sidebar_right','sidebar');
					break;

				case 'product-config':
					$data['catalog_mod']    		= get_theme_mod('tvlgiao_wpdance_genneral_catalog_mode', '1');
				    $data['show_title']    			= get_theme_mod('tvlgiao_wpdance_genneral_show_title', '1');
				    $data['show_description']  		= get_theme_mod('tvlgiao_wpdance_genneral_show_description', '0');
				    $data['show_rating']  			= get_theme_mod('tvlgiao_wpdance_genneral_show_rating', '1');
				    $data['show_price']  			= get_theme_mod('tvlgiao_wpdance_genneral_show_price', '1');
				    $data['show_meta']  			= get_theme_mod('tvlgiao_wpdance_genneral_show_meta', '1');
					break;

				case 'product-sale-flash':
					$data['text']    				= 'Sale!';
					$data['show_percent']    		= false;
					break;

				case 'woo_hook':
					$data['catalog_mod']    		= get_theme_mod('tvlgiao_wpdance_genneral_catalog_mode', '1');
					$data['wishlist_default']    	= get_theme_mod('tvlgiao_wpdance_genneral_wishlist_default', '0');
					$data['compare_default']    	= get_theme_mod('tvlgiao_wpdance_genneral_compare_default', '0');
					$data['show_recently_product']  = get_theme_mod('tvlgiao_wpdance_single_recently_product', '1');
					$data['show_upsell_product']    = get_theme_mod('tvlgiao_wpdance_single_upsell_product', '0');
				    $data['show_title']    			= get_theme_mod('tvlgiao_wpdance_genneral_show_title', '1');
				    $data['show_description']  		= get_theme_mod('tvlgiao_wpdance_genneral_show_description', '0');
				    $data['show_rating']  			= get_theme_mod('tvlgiao_wpdance_genneral_show_rating', '1');
				    $data['show_price']  			= get_theme_mod('tvlgiao_wpdance_genneral_show_price', '1');
				    $data['show_meta']  			= get_theme_mod('tvlgiao_wpdance_genneral_show_meta', '1');
					break;

				case 'content-product':
					$data['catalog_mod']    		= get_theme_mod('tvlgiao_wpdance_genneral_catalog_mode', '1');
					$data['style_hover_product'] 	= get_theme_mod('tvlgiao_wpdance_genneral_product_hover_button', 'wd-hover-style-1');
					$data['button_group_position'] 	= get_theme_mod('tvlgiao_wpdance_genneral_button_group_position', 'after-content');
					break;

				case 'product-description':
					$data['show_description']  		= get_theme_mod('tvlgiao_wpdance_genneral_show_description', '0');
					$data['number_word']  			= get_theme_mod('tvlgiao_wpdance_genneral_number_description_word', '40');
					break;

				case 'single-product':
					$data['layout'] 				= get_theme_mod('tvlgiao_wpdance_single_product_layout','0-0-0');
					$data['full_width_detail'] 		= get_theme_mod('tvlgiao_wpdance_single_product_full_width','0');
					$data['content_after_summary'] 	= '';
					break; 

				case 'content-single-product':
					$data['layout'] 				= get_theme_mod('tvlgiao_wpdance_single_product_layout','0-0-0');
					$data['sidebar_left'] 			= get_theme_mod('tvlgiao_wpdance_single_product_sidebar_left','sidebar');
					$data['sidebar_right'] 			= get_theme_mod('tvlgiao_wpdance_single_product_sidebar_right','sidebar');
					$data['full_width_detail'] 		= get_theme_mod('tvlgiao_wpdance_single_product_full_width','0');
					$data['position_additional'] 	= get_theme_mod('tvlgiao_wpdance_single_product_additional_image', 'left');
					break;

				case 'single-product-thumbnail':
					$data['thumbnail_number'] 		= get_theme_mod('tvlgiao_wpdance_single_product_thumbnail_number', '3');
					$data['position_additional'] 	= get_theme_mod('tvlgiao_wpdance_single_product_additional_image', 'left');
					break;

				case 'cart':
					$data['content_shortcode'] 		= get_theme_mod('tvlgiao_wpdance_cart_shortcode','');
					break;

				case 'mini-cart':
					$data['layout'] 				= '';
					$data['cart_icon'] 				= 'fa-shopping-cart';
					break;

				case '404':
					$data['select_style'] 			= get_theme_mod('tvlgiao_wpdance_page_404_select_style' ,'bg_color');
					$data['bg_404_url']  			= get_theme_mod('tvlgiao_wpdance_page_404_bg_image', TVLGIAO_WPDANCE_THEME_IMAGES.'/bg_404.jpg');
					$data['bg_404_color']  			= get_theme_mod('tvlgiao_wpdance_page_404_bg_color', '#fff');
					$data['show_search_form'] 		= get_theme_mod('tvlgiao_wpdance_page_404_show_search_form', '1');
					$data['show_back_to_home_btn'] 	= get_theme_mod('tvlgiao_wpdance_page_404_show_back_to_home_button', '1');
					$data['back_to_home_btn_text'] 	= get_theme_mod('tvlgiao_wpdance_page_404_back_to_home_button_text', 'Back To Homepage');
					$data['back_to_home_btn_class'] = get_theme_mod('tvlgiao_wpdance_page_404_back_to_home_button_class', '');
					$data['show_header_footer'] 	= get_theme_mod('tvlgiao_wpdance_page_404_show_header_footer', '1');
					break;

				case 'search':
					$data['select_style'] 			= get_theme_mod('tvlgiao_wpdance_page_search_select_style' ,'bg_color');
					$data['bg_search_url']  		= get_theme_mod('tvlgiao_wpdance_page_search_bg_image', TVLGIAO_WPDANCE_THEME_IMAGES.'/bg_404.jpg');
					$data['bg_search_color']  		= get_theme_mod('tvlgiao_wpdance_page_search_bg_color', '#fff');
					break;

				case 'backtotop':
					$data['scroll_button']    		= get_theme_mod('tvlgiao_wpdance_back_to_top_button', '0');
					$data['button_style']    		= get_theme_mod('tvlgiao_wpdance_back_to_top_button_style', '1');
					$data['border_color']    		= get_theme_mod('tvlgiao_wpdance_back_to_top_button_border_color', '#ccc');
					$data['background_color']    	= get_theme_mod('tvlgiao_wpdance_back_to_top_button_background_color', '#fff');
					$data['background_shape']    	= get_theme_mod('tvlgiao_wpdance_back_to_top_button_background_shape', '1');
					$data['class_icon']    			= get_theme_mod('tvlgiao_wpdance_back_to_top_button_icon', 'el el-chevron-up');
					$data['color_icon']    			= get_theme_mod('tvlgiao_wpdance_back_to_top_button_icon_color', '#000');
					break;
					
				case 'social_share':
					$data['display_social']    		= get_theme_mod('tvlgiao_wpdance_social_share', '1');
					$data['pubid']    				= get_theme_mod('tvlgiao_wpdance_social_share_pubid', 'ra-547e8f2f2a326738');
					break;

				default:
					break;
			}
		}elseif (TVLGIAO_WPDANCE_USE_CONTROL == 'theme_option'){
			switch ($template) {
				case 'header-default':
					$data['show_logo_title']	  	= wd_get_data_theme_option('tvlgiao_wpdance_header_show_site_title', '0');
					$data['logo_default']	  		= wd_get_data_theme_option('tvlgiao_wpdance_logo', TVLGIAO_WPDANCE_THEME_IMAGES.'/wpdance_logo.png', 'image');
					$data['logo_url']	  			= wd_get_data_theme_option('tvlgiao_wpdance_header_logo', TVLGIAO_WPDANCE_THEME_IMAGES.'/wpdance_logo.png', 'image');
					$data['menu_location']	  		= wd_get_data_theme_option('tvlgiao_wpdance_header_menu_location', 'primary'); 
					break;

				case 'footer-default':
					$data['logo_default']	  		= wd_get_data_theme_option('tvlgiao_wpdance_logo', TVLGIAO_WPDANCE_THEME_IMAGES.'/wpdance_logo.png', 'image');
					$data['logo_url']	  			= wd_get_data_theme_option('tvlgiao_wpdance_footer_logo', TVLGIAO_WPDANCE_THEME_IMAGES.'/wpdance_logo.png', 'image');
					$data['copyright'] 				= wd_get_data_theme_option('tvlgiao_wpdance_footer_copyright_text', esc_html__('Copyright CodeSpot. All rights reserved.','wpdancelaparis'));
					break;

				case 'breadcrumb-default':
					$data['layout_breadcrumbs']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_type', 'breadcrumb_default');
					$data['image_breadcrumbs']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_background', TVLGIAO_WPDANCE_THEME_IMAGES.'/banner_breadcrumb.jpg', 'image');
					$data['height']					= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_height', '100', 'height');
					$data['color_breadcrumbs']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_background_color', '#f2f2f2');
					$data['text_color']				= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_text_color', '#212121');
					$data['text_style']				= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_text_style', 'inline');
					$data['text_align']				= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_text_align', 'text-center');
					break;
					
				case 'breadcrumb-custom-setting':
					$data['blog_archive']			= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_archive_blog_customize', '0');
					$data['product_archive']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_archive_product_customize', '0');
					$data['woo_special_page']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_woo_special_page_customize', '0');
					$data['search_page']			= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_search_page_customize', '0');
					break;

				case 'breadcrumb-blog-archive':
					$data['layout_breadcrumbs']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_archive_blog_type', 'breadcrumb_default');
					$data['image_breadcrumbs']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_archive_blog_background', TVLGIAO_WPDANCE_THEME_IMAGES.'/banner_breadcrumb.jpg', 'image');
					$data['height']					= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_archive_blog_height', '100', 'height');
					$data['color_breadcrumbs']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_archive_blog_background_color', '#f2f2f2');
					$data['text_color']				= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_archive_blog_text_color', '#212121');
					$data['text_style']				= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_archive_blog_text_style', 'inline');
					$data['text_align']				= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_archive_blog_text_align', 'text-center');
					break;

				case 'breadcrumb-product-archive':
					$data['layout_breadcrumbs']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_archive_product_type', 'breadcrumb_default');
					$data['image_breadcrumbs']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_archive_product_background', TVLGIAO_WPDANCE_THEME_IMAGES.'/banner_breadcrumb.jpg', 'image');
					$data['height']					= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_archive_product_height', '100', 'height');
					$data['color_breadcrumbs']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_archive_product_background_color', '#f2f2f2');
					$data['text_color']				= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_archive_product_text_color', '#212121');
					$data['text_style']				= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_archive_product_text_style', 'inline');
					$data['text_align']				= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_archive_product_text_align', 'text-center');
					break;

				case 'breadcrumb-woo-special-page':
					$data['layout_breadcrumbs']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_woo_special_page_type', 'breadcrumb_default');
					$data['image_breadcrumbs']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_woo_special_page_background', TVLGIAO_WPDANCE_THEME_IMAGES.'/banner_breadcrumb.jpg', 'image');
					$data['height']					= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_woo_special_page_height', '100', 'height');
					$data['color_breadcrumbs']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_woo_special_page_background_color', '#f2f2f2');
					$data['text_color']				= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_woo_special_page_text_color', '#212121');
					$data['text_style']				= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_woo_special_page_text_style', 'inline');
					$data['text_align']				= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_woo_special_page_text_align', 'text-center');
					break;

				case 'breadcrumb-search-page':
					$data['layout_breadcrumbs']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_search_page_type', 'breadcrumb_default');
					$data['image_breadcrumbs']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_search_page_background', TVLGIAO_WPDANCE_THEME_IMAGES.'/banner_breadcrumb.jpg', 'image');
					$data['height']					= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_search_page_height', '100', 'height');
					$data['color_breadcrumbs']		= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_search_page_background_color', '#f2f2f2');
					$data['text_color']				= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_search_page_text_color', '#212121');
					$data['text_style']				= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_search_page_text_style', 'inline');
					$data['text_align']				= wd_get_data_theme_option('tvlgiao_wpdance_breadcrumb_search_page_text_align', 'text-center');
					break;

				case 'default-page':
					$data['layout'] 				= wd_get_data_theme_option('tvlgiao_wpdance_layout_page_default_layout', '0-0-0');
					$data['sidebar_left'] 			= wd_get_data_theme_option('tvlgiao_wpdance_layout_page_default_left_sidebar', 'sidebar');
					$data['sidebar_right'] 			= wd_get_data_theme_option('tvlgiao_wpdance_layout_page_default_right_sidebar', 'right_sidebar');
					break;

				case 'archive-blog':
					$data['layout'] 				= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_archive_layout', '0-0-0');
					$data['sidebar_left'] 			= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_archive_left_sidebar', 'sidebar');
					$data['sidebar_right'] 			= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_archive_right_sidebar', 'right_sidebar');
					$data['show_by_post_format'] 	= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_show_by_post_format', '1');
					break;

				case 'content-blog':
					$data['grid_list_layout'] 		= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_single_recent_post_style','list');
					$data['is_slider'] 				= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_single_recent_post_is_slider','1');
					$data['columns'] 				= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_single_recent_post_columns','2');
					$data['show_title']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_title_display', '1');
				 	$data['show_thumbnail']  		= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_thumbnail_display', '1');
				 	$data['placeholder_image']  	= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_thumbnail_placeholder','0');
				 	$data['show_date']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_date_display', '1');
				 	$data['show_author']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_author_display', '1');
				 	$data['show_number_comments']  	= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_number_comment_display', '1');
				 	$data['show_category']  		= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_category_display', '1');
				 	$data['show_readmore']  		= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_excerpt_display', '1');
				 	$data['show_excerpt']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_readmore_display', '1');
				 	$data['number_excerpt']  		= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_number_excerpt_word', '20');
					break;

				case 'single-blog':
					$data['layout'] 				= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_single_layout', '0-0-0');
					$data['sidebar_left'] 			= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_single_left_sidebar', 'sidebar');
					$data['sidebar_right'] 			= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_single_right_sidebar', 'right_sidebar');
					$data['show_author_information'] = wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_single_author_information', '1');
					$data['show_previous_next_btn'] = wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_single_previous_next_button', '1');
					$data['show_recent_blog'] 		= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_single_recent_post', '1');
					$data['show_title']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_title_display', '1');
				 	$data['show_thumbnail']  		= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_thumbnail_display', '1');
				 	$data['show_date']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_date_display', '1');
				 	$data['show_author']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_author_display', '1');
				 	$data['show_number_comments']  	= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_number_comment_display', '1');
				 	$data['show_category']  		= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_category_display', '1');
				 	$data['show_readmore']  		= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_excerpt_display', '1');
				 	$data['show_excerpt']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_readmore_display', '1');
				 	$data['number_excerpt']  		= wd_get_data_theme_option('tvlgiao_wpdance_layout_blog_config_number_excerpt_word', '20');
					break;

				case 'woocommerce-page':
					$data['layout']  				= wd_get_data_theme_option('tvlgiao_wpdance_layout_woo_template_layout', '0-0-0');
					$data['sidebar_left']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_woo_template_left_sidebar', 'left_sidebar_shop');
					$data['sidebar_right']  		= wd_get_data_theme_option('tvlgiao_wpdance_layout_woo_template_right_sidebar', 'right_sidebar_shop');
					break;

				case 'archive-product':
					$data['layout']  				= wd_get_data_theme_option('tvlgiao_wpdance_layout_archive_product_layout', '0-0-0');
					$data['sidebar_left']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_archive_product_left_sidebar', 'left_sidebar_shop');
					$data['sidebar_right']  		= wd_get_data_theme_option('tvlgiao_wpdance_layout_archive_product_right_sidebar', 'right_sidebar_shop');
				   	$data['columns_product'] 		= wd_get_data_theme_option('tvlgiao_wpdance_layout_archive_product_columns', '3');
					break;

				case 'product-archive-posts-per-page':
					$data['posts_per_page'] 		= wd_get_data_theme_option('tvlgiao_wpdance_layout_archive_product_posts_per_page','15');
					break;

				case 'product-config':
					$data['catalog_mod']    		= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_catalog_mode', '1');
				    $data['show_title']    			= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_title_display', '1');
				    $data['show_description']  		= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_description_display', '0');
				    $data['show_rating']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_rating_display', '1');
				    $data['show_price']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_price_display', '1');
				    $data['show_meta']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_meta_display', '1');
					break;

				case 'product-sale-flash':
					$data['text']    				= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_sale_flash_text', 'Sale!');
					$data['show_percent']    		= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_sale_flash_percent', false);
					break;

				case 'woo_hook':
					$data['catalog_mod']    		= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_catalog_mode', '1');
					$data['wishlist_default']    	= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_wishlist_default', '0');
					$data['compare_default']    	= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_compare_default', '0');
					$data['show_recently_product']  = wd_get_data_theme_option('tvlgiao_wpdance_layout_single_product_recent_product', '1');
					$data['show_upsell_product']    = wd_get_data_theme_option('tvlgiao_wpdance_layout_single_product_upsell_product', '0');
				    $data['show_title']    			= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_title_display', '1');
				    $data['show_description']  		= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_description_display', '0');
				    $data['show_rating']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_rating_display', '1');
				    $data['show_price']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_price_display', '1');
				    $data['show_meta']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_meta_display', '1');
					break;

				case 'content-product':
					$data['catalog_mod']    		= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_catalog_mode', '1');
					$data['style_hover_product'] 	= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_hover_style', 'wd-hover-style-1');
					$data['button_group_position'] 	= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_button_group_position', 'after-content');
					break;

				case 'product-description':
					$data['show_description']  		= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_description_display', '0');
					$data['number_word']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_product_config_number_desc_word', '40');
					break;

				case 'single-product':
					$data['layout'] 				= wd_get_data_theme_option('tvlgiao_wpdance_layout_single_product_layout', '0-0-0');
					$data['full_width_detail'] 		= wd_get_data_theme_option('tvlgiao_wpdance_layout_single_product_fullwidth_layout', '0');
					$data['content_after_summary'] 	= wd_get_data_theme_option('tvlgiao_wpdance_layout_single_product_summary_custom_shortcode', '');
					break;

				case 'content-single-product':
					$data['layout'] 				= wd_get_data_theme_option('tvlgiao_wpdance_layout_single_product_layout', '0-0-0');
					$data['sidebar_left'] 			= wd_get_data_theme_option('tvlgiao_wpdance_layout_single_product_left_sidebar', 'left_sidebar_product');
					$data['sidebar_right'] 			= wd_get_data_theme_option('tvlgiao_wpdance_layout_single_product_right_sidebar', 'right_sidebar_product');
					$data['full_width_detail'] 		= wd_get_data_theme_option('tvlgiao_wpdance_layout_single_product_fullwidth_layout', '0');
					$data['position_additional'] 	= wd_get_data_theme_option('tvlgiao_wpdance_layout_single_product_position_thumbnail', 'left');
					break;

				case 'single-product-thumbnail':
					$data['thumbnail_number'] 		= wd_get_data_theme_option('tvlgiao_wpdance_layout_single_product_thumbnail_number', '3');
					$data['position_additional'] 	= wd_get_data_theme_option('tvlgiao_wpdance_layout_single_product_position_thumbnail', 'left');
					break;

				case 'cart':
					$data['content_shortcode'] 		= wd_get_data_theme_option('tvlgiao_wpdance_layout_cart_page_custom_shortcode', '');
					break;

				case 'mini-cart':
					$data['layout'] 				= wd_get_data_theme_option('tvlgiao_wpdance_mini_cart_sorter', '');
					$data['cart_icon'] 				= wd_get_data_theme_option('tvlgiao_wpdance_mini_cart_icon', 'fa-shopping-cart');
					break;

				case '404':
					$data['select_style'] 			= wd_get_data_theme_option('tvlgiao_wpdance_layout_page_404_background_style', 'bg_color');
					$data['bg_404_url'] 			= wd_get_data_theme_option('tvlgiao_wpdance_layout_page_404_background_image', TVLGIAO_WPDANCE_THEME_IMAGES.'/bg_404.jpg', 'image');
					$data['bg_404_color']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_page_404_background_color', '#fff');
					$data['show_search_form'] 		= wd_get_data_theme_option('tvlgiao_wpdance_layout_page_404_show_search_form', '1');
					$data['show_back_to_home_btn'] 	= wd_get_data_theme_option('tvlgiao_wpdance_layout_page_404_show_back_to_home_button', '1');
					$data['back_to_home_btn_text'] 	= wd_get_data_theme_option('tvlgiao_wpdance_layout_page_404_show_back_to_home_button_text', 'Back To Homepage');
					$data['back_to_home_btn_class'] = wd_get_data_theme_option('tvlgiao_wpdance_layout_page_404_show_back_to_home_button_class', '');
					$data['show_header_footer'] 	= wd_get_data_theme_option('tvlgiao_wpdance_layout_page_404_show_header_footer', '1');
					break;

				case 'search':
					$data['select_style'] 			= wd_get_data_theme_option('tvlgiao_wpdance_layout_page_search_background_style', 'bg_color');
					$data['bg_search_url'] 			= wd_get_data_theme_option('tvlgiao_wpdance_layout_page_search_background_image', TVLGIAO_WPDANCE_THEME_IMAGES.'/bg_404.jpg', 'image');
					$data['bg_search_color']  			= wd_get_data_theme_option('tvlgiao_wpdance_layout_page_search_background_color', '#fff');
					break;

				case 'backtotop':
					$data['scroll_button']    		= wd_get_data_theme_option('tvlgiao_wpdance_back_to_top_display', '0');
					$data['button_style']    		= wd_get_data_theme_option('tvlgiao_wpdance_back_to_top_style', '1');
					$data['border_color']    		= wd_get_data_theme_option('tvlgiao_wpdance_back_to_top_border_color', '#ccc');
					$data['background_color']    	= wd_get_data_theme_option('tvlgiao_wpdance_back_to_top_background_color', '#fff');
					$data['background_shape']    	= wd_get_data_theme_option('tvlgiao_wpdance_back_to_top_background_shape', '1');
					$data['class_icon']    			= wd_get_data_theme_option('tvlgiao_wpdance_back_to_top_select_icon', 'el el-chevron-up');
					$data['color_icon']    			= wd_get_data_theme_option('tvlgiao_wpdance_back_to_top_icon_color', '#000');
					break;

				case 'social_share':
					$data['display_social']    		= wd_get_data_theme_option('tvlgiao_wpdance_share_button_display', '1');
					$data['pubid']    				= wd_get_data_theme_option('tvlgiao_wpdance_share_button_custom_pubid', 'ra-547e8f2f2a326738');
					break;

				default:
					break;
			}
		}
		return $data;
	}
}

if(!function_exists ('tvlgiao_wpdance_get_custom_data_by_keyname')){
	function tvlgiao_wpdance_get_custom_data_by_keyname( $keyname_customize, $keyname_theme_option, $default_value = '', $type = '' ) {
		// $type: '' / image / font
		if (TVLGIAO_WPDANCE_USE_CONTROL == 'customize') {
			$data = get_theme_mod( $keyname_customize, $default_value);
		}elseif (TVLGIAO_WPDANCE_USE_CONTROL == 'theme_option'){
			$data = wd_get_data_theme_option( $keyname_theme_option, $default_value, $type);
		}
		return $data;
	}
}

if(!function_exists ('wd_get_data_theme_option')){
	function wd_get_data_theme_option( $keyname, $default_value = '', $type = 'normal' ) {
		global $tvlgiao_wpdance_theme_options;
		$data = '';
		if (isset($tvlgiao_wpdance_theme_options[$keyname])) {
			if ($type == 'image') {
				$data = $tvlgiao_wpdance_theme_options[$keyname]['url'];
			}elseif ($type == 'font') {
				$data = $tvlgiao_wpdance_theme_options[$keyname]['font-family'];
			}elseif ($type == 'height') {
				$data = $tvlgiao_wpdance_theme_options[$keyname]['height'];
			}elseif ($type == 'width') {
				$data = $tvlgiao_wpdance_theme_options[$keyname]['width'];
			}else{
				$data = $tvlgiao_wpdance_theme_options[$keyname];
			}
		}else{
			$data = $default_value;
		}
		return $data;
	}
}
?>