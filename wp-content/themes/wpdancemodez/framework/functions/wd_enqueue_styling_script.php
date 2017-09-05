<?php 
	/******************ENQUEUE STYLE*******************/
	/* Enqueue Custom Style */
	add_action( 'wp_enqueue_scripts', 'tvlgiao_wpdance_customize_set_custom_css' , 10000);
	
	if(!function_exists ('tvlgiao_wpdance_customize_set_custom_css')){
		function tvlgiao_wpdance_customize_set_custom_css(){
			/* Breadcrumb */
			$custom_style_breadcrumb = tvlgiao_wpdance_breadcrumb_style();
			/* 404 page */
			$custom_style_404_page = tvlgiao_wpdance_404_page_style();
			/* Search page */
			$custom_style_search_page = tvlgiao_wpdance_search_page_style();
			/* Font Custom from XML File */
			$custom_font_from_xml_file = tvlgiao_wpdance_get_custom_style_from_xml_font_file();
			/* Back To Top Button */
			$back_to_top_button_css = tvlgiao_wpdance_back_to_top_button_style();
			/* Color Custom from XML File */
			$custom_css_from_xml_file 	= tvlgiao_wpdance_get_custom_style_from_xml_color_file();
			/* Style from HTML Block */
			$html_block_css = tvlgiao_wpdance_htmlblock_vc_styles();
			/* Custom Css from Theme Option */
			$custom_css_from_theme_option = tvlgiao_wpdance_get_custom_style_from_theme_option();
			
			/******************ENQUEUE STYLE*******************/
			wp_add_inline_style( 'tvlgiao-wpdance-custom-style-inline-css', $custom_style_breadcrumb );
			wp_add_inline_style( 'tvlgiao-wpdance-custom-style-inline-css', $custom_style_404_page );
			wp_add_inline_style( 'tvlgiao-wpdance-custom-style-inline-css', $custom_style_search_page );
			wp_add_inline_style( 'tvlgiao-wpdance-custom-style-inline-css', $custom_font_from_xml_file );
			wp_add_inline_style( 'tvlgiao-wpdance-custom-style-inline-css', $back_to_top_button_css );
			wp_add_inline_style( 'tvlgiao-wpdance-custom-style-inline-css', $html_block_css );
			if (!isset($_GET['color'])) {
				wp_add_inline_style( 'tvlgiao-wpdance-custom-style-inline-css', $custom_css_from_xml_file );
			} else {
				wp_add_inline_style( 'tvlgiao-wpdance-custom-style-inline-css', tvlgiao_wpdance_color_custom_from_request() );
			}
			wp_add_inline_style( 'tvlgiao-wpdance-custom-style-inline-css', $custom_css_from_theme_option );
			
			/* Custom Script */
			$custom_script = tvlgiao_wpdance_get_custom_script();
			/* Script from Theme Option */
			$custom_script_from_theme_option = tvlgiao_wpdance_get_custom_script_from_theme_option();
			
			/******************ENQUEUE SCRIPT*******************/
			wp_add_inline_script( 'tvlgiao-wpdance-custom-script-inline-js', $custom_script );
			wp_add_inline_script( 'tvlgiao-wpdance-custom-script-inline-js', $custom_script_from_theme_option );
		}
	}

	/* Get custom css breadcrumb */
	if(!function_exists ('tvlgiao_wpdance_breadcrumb_style')){
		function tvlgiao_wpdance_breadcrumb_style(){
			/* Breadcrumb Settings */
			extract(tvlgiao_wpdance_get_custom_data_special_template( 'breadcrumb-custom-setting' ));
			if (is_post_type_archive( 'post' ) && $blog_archive) { 
				//breadcrumb for blog archive
				extract(tvlgiao_wpdance_get_custom_data_special_template( 'breadcrumb-blog-archive' ));
			}elseif ((is_shop() || is_product_taxonomy() || is_product_category()) && $product_archive) { 
				//breadcrumb for shop archive
				extract(tvlgiao_wpdance_get_custom_data_special_template( 'breadcrumb-product-archive' ));
			}elseif ((is_checkout() || is_cart()) && $woo_special_page) {
				//breadcrumb for woocommerce special page (cart, checkout)
				extract(tvlgiao_wpdance_get_custom_data_special_template( 'breadcrumb-woo-special-page' ));
			}elseif (is_search() && $search_page) {
				//breadcrumb search page
				extract(tvlgiao_wpdance_get_custom_data_special_template( 'breadcrumb-search-page' ));
			}else{
				//breadcrumb general
				extract(tvlgiao_wpdance_get_custom_data_special_template( 'breadcrumb-default' ));
			}
			
			$post_ID		= tvlgiao_wpdance_get_post_by_global();
			/*PAGE CONFIG*/
			$_page_config 	= get_post_meta($post_ID, '_tvlgiao_wpdance_custom_page_config', true);
			$_page_config 	= unserialize($_page_config);

			$default_image_breadcrumb = TVLGIAO_WPDANCE_THEME_IMAGES.'/banner_breadcrumb.jpg';
			if ($image_breadcrumbs != $default_image_breadcrumb && strpos($image_breadcrumbs, home_url()) === false) {
			   	$image_breadcrumbs = $default_image_breadcrumb;
			}
			
			$custom_page_breadcrumb_setting = (!empty($_page_config['style_breadcrumb'])) ? $_page_config['style_breadcrumb'] : 'breadcrumb_default' ;

			/* Custom Breadcrumb */
			if ($custom_page_breadcrumb_setting != 'breadcrumb_default') {
				$layout_breadcrumbs = $custom_page_breadcrumb_setting;
				$image_breadcrumbs = !empty($_page_config['wd_breadcrumb_url_img']) ? esc_url(wp_get_attachment_url($_page_config['wd_breadcrumb_url_img'])) : esc_url($default_image_breadcrumb);
			} 

			$custom_style_breadcrumb = "";
			if ($layout_breadcrumbs == 'no_breadcrumb') {
				$custom_style_breadcrumb .= '.wd-init-breadcrumb{display:none !important;}'; //hide breadcrumb
			}else{
				$custom_style_breadcrumb .= '.wd-init-breadcrumb, .wd-init-breadcrumb h3, .wd-init-breadcrumb a, .wd-init-breadcrumb .woocommerce-breadcrumb{color:'.esc_attr($text_color).' !important;}'; //text color

				$custom_style_breadcrumb .= '.wd-init-breadcrumb, .wd-init-breadcrumb .container{height:'.esc_attr($height).'px !important;}'; //height

				if ($text_style == 'block') { //content center for breadcrumb block
					$custom_style_breadcrumb .= '.wd-init-breadcrumb, .wd-init-breadcrumb .wd-breadcrumb-content{height:'.esc_attr($height).'px !important;}'; //height
					$custom_style_breadcrumb .= '.wd-init-breadcrumb .wd-breadcrumb-content{display: flex; flex-direction: column; justify-content: center;}'; //content align middle
				}else{ //content center for breadcrumb inline
					$custom_style_breadcrumb .= '.wd-init-breadcrumb, .wd-init-breadcrumb .container{height:'.esc_attr($height).'px !important;}'; //height
					$custom_style_breadcrumb .= '.wd-init-breadcrumb .wd-breadcrumb-text-style-inline, .wd-init-breadcrumb .wd-breadcrumb-text-style-inline .wd-breadcrumb-title, .wd-init-breadcrumb .wd-breadcrumb-text-style-inline .wd-breadcrumb-slug{line-height:'.esc_attr($height).'px !important;}'; //content align middle
				}

				if ($layout_breadcrumbs == 'breadcrumb_banner' && $image_breadcrumbs != '') {
					$custom_style_breadcrumb .= '.wd-init-breadcrumb.breadcrumb_banner { background-image: url("'.esc_url($image_breadcrumbs).'"); }'; //background image
				}elseif ($layout_breadcrumbs == 'breadcrumb_default') {
					$custom_style_breadcrumb .= '.wd-init-breadcrumb.breadcrumb_default { background-color: '.esc_attr($color_breadcrumbs).'; }'; //background color
				}
			}
			return $custom_style_breadcrumb;
		}
	}

	/* Get custom css 404 Page */
	if(!function_exists ('tvlgiao_wpdance_404_page_style')){
		function tvlgiao_wpdance_404_page_style(){
			/* get data from theme option/customize */
			extract(tvlgiao_wpdance_get_custom_data_special_template( '404' ));
			$custom_style_404_page = '';
			if($select_style == 'bg_image'){
				$default_url_404 		= TVLGIAO_WPDANCE_THEME_IMAGES.'/bg_404.jpg';
				if ($bg_404_url != $default_url_404 && strpos($bg_404_url, home_url()) === false) {
				   	$bg_404_url 	= $default_url_404;
				}
				$custom_style_404_page 	.= '.wd-404-error { background-image: url("'.esc_url($bg_404_url).'"); }';
			}else{
				$custom_style_404_page 	.= '.wd-404-error { background-color: '.esc_url($bg_404_color).'; }';
			}
			return $custom_style_404_page;
		}
	}

	/* Get custom css search Page */
	if(!function_exists ('tvlgiao_wpdance_search_page_style')){
		function tvlgiao_wpdance_search_page_style(){
			/* get data from theme option/customize */
			extract(tvlgiao_wpdance_get_custom_data_special_template( 'search' ));
			$custom_style_search_page = '';
			if($select_style == 'bg_image'){
				$default_url_search 		= TVLGIAO_WPDANCE_THEME_IMAGES.'/bg_404.jpg';
				if ($bg_search_url != $default_url_search && strpos($bg_search_url, home_url()) === false) {
				   	$bg_search_url 	= $default_url_search;
				}
				$custom_style_search_page 	.= '.wd-search-result-page { background-image: url("'.esc_url($bg_search_url).'"); background-attachment: fixed; }';
			}else{
				$custom_style_search_page 	.= '.wd-search-result-page { background-color: '.esc_url($bg_search_color).'; }';
			}
			return $custom_style_search_page;
		}
	}

	
	/** Get custom css from html block */
	if (function_exists('visual_composer')) {
		if (!function_exists('tvlgiao_wpdance_htmlblock_vc_styles')) {
			/**
			 * Add Visual Composer custom css styles of HTML Blocks
			 *
			 * Visual Composer only includes css style of the main post, so we have
			 * to add custom css styles of HTML blocks by ourself.
			 */
			function tvlgiao_wpdance_htmlblock_vc_styles() {
				$custom_css = '';
				if ($post = tvlgiao_wpdance_get_header_post()){
					$custom_css .= tvlgiao_wpdance_htmlblock_css($post->ID);
				}
					
				if ($post = tvlgiao_wpdance_get_footer_post()){
					$custom_css .= tvlgiao_wpdance_htmlblock_css($post->ID);
				}
				return $custom_css;
			}
		}
	}

	if (!function_exists('tvlgiao_wpdance_get_custom_style_from_theme_option')) {
		function tvlgiao_wpdance_get_custom_style_from_theme_option() {
			$custom_css = '';
			if ( TVLGIAO_WPDANCE_USE_CONTROL == 'theme_option' ) {
				global $tvlgiao_wpdance_theme_options;
				if( $tvlgiao_wpdance_theme_options['tvlgiao_wpdance_custom_css'] ) {
					$custom_css .= $tvlgiao_wpdance_theme_options['tvlgiao_wpdance_custom_css'];
				}
			}
			return $custom_css;
		}
	}

	if (!function_exists('tvlgiao_wpdance_get_custom_script_from_theme_option')) {
		function tvlgiao_wpdance_get_custom_script_from_theme_option() {
			$custom_script = '';
			if ( TVLGIAO_WPDANCE_USE_CONTROL == 'theme_option' ) {
				global $tvlgiao_wpdance_theme_options;
				if( $tvlgiao_wpdance_theme_options['tvlgiao_wpdance_custom_script'] ) {
					$custom_script .= $tvlgiao_wpdance_theme_options['tvlgiao_wpdance_custom_script'];
				}
			}
			return $custom_script;
		}
	}

	/* Get custom css font config from xml file */
	if(!function_exists ('tvlgiao_wpdance_get_custom_style_from_xml_font_file')){
		function tvlgiao_wpdance_get_custom_style_from_xml_font_file(){
			$xml_file 			= 'font_config';
			$objXML_font 		= simplexml_load_file(TVLGIAO_WPDANCE_THEME_WPDANCE."/config_xml/".$xml_file.".xml");
			ob_start();
			foreach ($objXML_font->children() as $child) {	 				//items_setting => general
				foreach ($child->items->children() as $childofchild) { 		//items => item
					$name 	 		=  (string)$childofchild->name;			//name
					$slug 	 		=  (string)$childofchild->slug; 		//slug
					$std 	 		=  (string)$childofchild->std;
					$frontend 		=  $childofchild->frontend; 			//std
					$data_style 	=  	tvlgiao_wpdance_get_custom_data_by_keyname( $slug, $slug ,$std, 'font');
					foreach ($frontend as $childoffrontend) {				//frondend => f*
						$attr 		= 'font-family';
						$selector 				= (string)$childoffrontend->selector_normal;
						$selector_important 	= (string)$childoffrontend->selector_important;
						echo ($selector).'{';
							echo esc_attr($attr).': '.esc_attr($data_style).';';
						echo '}'."\n";
						if($selector_important!=''){
							echo ($selector_important).'{';
								echo esc_attr($attr).': '.esc_attr($data_style).' !important ;';
							echo '}'."\n";							
						}	
					}
				}
			}
			$custom_css = ob_get_clean();
			return $custom_css;
		}
	}


	/* Get custom css from xml color file */
	if(!function_exists ('tvlgiao_wpdance_get_custom_style_from_xml_color_file')){
		function tvlgiao_wpdance_get_custom_style_from_xml_color_file(){
			$xml_file		= tvlgiao_wpdance_get_custom_data_by_keyname( 'tvlgiao_wpdance_styling_primary_color', 'tvlgiao_wpdance_color_setting_primary_color_select', 'color_default');

			if (isset($_GET['color'])) {
				$xml_file = "color_".$_GET['color'];
			}
			
			$objXML_color 		= simplexml_load_file(TVLGIAO_WPDANCE_THEME_WPDANCE."/config_xml/".$xml_file.".xml");
			ob_start();
			foreach ($objXML_color->children() as $child) {	 				
				foreach ($child->items->children() as $childofchild) { 			
					$name 		=  (string)$childofchild->name;					
					$slug 		=  (string)$childofchild->slug; 					
					$std 		=  (string)$childofchild->std;
					$important 	=  (isset($childofchild->important) &&  (int)$childofchild->important == 1) ? '!important' : ''; 
					$frontend 	=  $childofchild->frontend;
					// Data
					$data_style 		=  	tvlgiao_wpdance_get_custom_data_by_keyname( $slug, $slug, $std); 
					foreach ($frontend->children() as $childoffrontend) {	// frondend => f*
						$attr 		= $childoffrontend->attribute;
						$selector 	= $childoffrontend->selector;
							echo ($selector).'{';
							if( $data_style != $std){
								echo esc_attr($attr).': '.esc_attr($data_style).esc_attr($important).';';
							}else{
								echo esc_attr($attr).': '.esc_attr($std).esc_attr($important).';';
							}
							echo '}'."\n";	
					}	
				}
			}
			$custom_css = ob_get_clean();
			return $custom_css;
		}
	}

	/* Get custom css back to top button */
	if(!function_exists ('tvlgiao_wpdance_back_to_top_button_style')){
		function tvlgiao_wpdance_back_to_top_button_style(){
			extract(tvlgiao_wpdance_get_custom_data_special_template( 'backtotop' ));
			$custom_css = '';
			$custom_css .= '#tvlgiao-back-to-top a i{color:'.esc_attr($color_icon).';}';
			if ($button_style == '0') {
				if ($background_color != 'transparent') {
					$custom_css .= '#tvlgiao-back-to-top a{background-color:'.esc_attr($background_color).';}';
				}

				if ($border_color != 'transparent') {
					$custom_css .= '#tvlgiao-back-to-top a{border: 1px solid '.esc_attr($border_color).';}';
				}
				
				if ($background_shape) {
					$custom_css .= "#tvlgiao-back-to-top a{-webkit-border-radius: 100%;-moz-border-radius: 100%;-ms-border-radius: 100%;border-radius: 100%;}";
				}
				$custom_css .= '#tvlgiao-back-to-top a{background-color:'.esc_attr($background_color).';}';
			}
			return $custom_css;
		}
	}

	/* Home color get from request $_GET['color'] for demo */
	if(!function_exists ('tvlgiao_wpdance_color_custom_from_request')){
		function tvlgiao_wpdance_color_custom_from_request() {
		 	$style = '';
			if (isset($_GET['color'])) {
				$xml_file_customize = "color_".$_GET['color'];
				$objXML_color = @simplexml_load_file(TVLGIAO_WPDANCE_THEME_WPDANCE."/config_xml/".$xml_file_customize.".xml"); 
				if($objXML_color) {
					foreach ($objXML_color->children() as $child) {      
						foreach ($child->items->children() as $childofchild) {   
							$std =  (string)$childofchild->std;      
							foreach ($childofchild->frontend->children() as $childofchilds) {   
								$attribute  =  (string)$childofchilds->attribute;     
								$selector  =  (string)$childofchilds->selector; 
								$style .= $selector."{".$attribute.":".$std."}";
							}
						}
					}
				}
			}
			return $style;
		}
	}

	/* Custom Script for site */
	if(!function_exists ('tvlgiao_wpdance_get_custom_script')){ 
		function tvlgiao_wpdance_get_custom_script(){
	   		$custom_script = '';
			?>	
				<?php if( defined('ICL_LANGUAGE_CODE') ): ?>
					<?php $custom_script .= 'var _ajax_uri = "'.admin_url('admin-ajax.php?lang='.ICL_LANGUAGE_CODE, 'relative').'";';
					?>
				<?php else: ?>
					<?php $custom_script .= 'var _ajax_uri = "'.admin_url('admin-ajax.php', 'relative').'";';
					?>
				<?php endif; ?>
			<?php
			$custom_script .= "jQuery('.menu li').each(function(){if(jQuery(this).children('.sub-menu').length > 0) jQuery(this).addClass('parent');});";
			return $custom_script;
		}
	}

?>