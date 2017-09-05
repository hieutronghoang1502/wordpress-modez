<?php
	/* Load font list from xml file */
	function custom_style_inline_script(){
		global $wd_font_name, $tvlgiao_wpdance_font_web;
		$xml_file 			= 'font_config';
		$objXML_font 		= simplexml_load_file(TVLGIAO_WPDANCE_THEME_WPDANCE."/config_xml/".$xml_file.".xml");
		ob_start();
		foreach ($objXML_font->children() as $child) {	 				
			foreach ($child->items->children() as $childofchild) { 		
				$name 	 			=  (string)$childofchild->name;		
				$slug 	 			=  (string)$childofchild->slug;
				$std 	 			=  (string)$childofchild->std;
				$frontend 			=  $childofchild->frontend; 		
				$font_name 	=  	tvlgiao_wpdance_get_custom_data_by_keyname($slug, $slug, $std, 'font');
				if(!array_key_exists('{$font_name}', $tvlgiao_wpdance_font_web)){
					$font_name  	= str_replace( " ", "+", trim($font_name) );
					wd_load_gg_fonts($font_name);	
				}
			}
		}			
	}

	/* enqueue google font */
	add_action('wp_enqueue_scripts', 'custom_style_inline_script');
	function wd_load_gg_fonts($wd_font_name) {
		$font_size_str = ": 400,400italic,600,600italic,700,700italic,800,800italic";
		if( isset($wd_font_name) && strlen( $wd_font_name ) > 0 ){
			$font_name_id = strtolower($wd_font_name);
			$protocol = is_ssl() ? 'https' : 'http';
			$url = "{$protocol}://fonts.googleapis.com/css?family={$wd_font_name}{$font_size_str}";
			wp_enqueue_style( "goodly-{$font_name_id}", str_replace(' ', '%20', $url) );
		}
	}	
?>