<?php
/*--------------------------------------------------------------*/
/*						 CONTROL THEME	 						*/
/*--------------------------------------------------------------*/

/**
 * Return HTML Headers array used for WP_Customize_Control select
 * $value_default : Url image defaul header.
 * Value return: Url Image or Name Header
 * @return array 
 */   

/* Get header/footer HTML Block */
if(!function_exists ('tvlgiao_wpdance_get_html_block_layout_choices')){
	function tvlgiao_wpdance_get_html_block_layout_choices($post_type, $value_default = '', $value_return = 'title') {
		//post_type: wpdance_header / wpdance_footer
		global $post;
		$pre_post 	= $post;
		$choices 	= ($value_default != '') ? array('' => $value_default) : array();
		$args = array(
			'post_type' 	=> $post_type,
			'posts_per_page'=> -1,
			'orderby' 		=> 'post_title',
			'order' 		=> 'ASC',
		);
		$html_block = new WP_Query( $args );

		while ($html_block->have_posts()) {
			$html_block->the_post();
			if($value_return == 'url_image'){
				$choices[get_the_ID()] = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
			}else{
				$choices[get_the_ID()] = get_the_title();
			}
		}
		
		wp_reset_postdata();
		$post 		= $pre_post;
		return $choices;
	}
}

/* Use for older version */
if(!function_exists ('tvlgiao_wpdance_get_html_choices')){
	function tvlgiao_wpdance_get_html_choices($slug_terms, $value_default, $value_return) {
		global $post;
		$pre_post 	= $post;
		$choices 	= array('' => $value_default);
		$args = array(
			'post_type' 	=> 'wpdance_html',
			'posts_per_page'=> -1,
			'orderby' 		=> 'post_title',
			'order' 		=> 'ASC',
			'tax_query' 	=> array(
				array(
					'taxonomy' => 'wpdance_category_html',
					'field'    => 'slug',
					'terms'    => array( $slug_terms ),
				)
			),
		);
		$html_block = new WP_Query( $args );

		while ($html_block->have_posts()) {
			$html_block->the_post();
			if($value_return == 'url_image'){
				$choices[get_the_ID()] = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
			}else{
				$choices[get_the_ID()] = get_the_title();
			}
		}
		
		wp_reset_postdata();
		$post 		= $pre_post;
		return $choices;
	}
}

/* SIDEBAR */
if(!function_exists ('tvlgiao_wpdance_display_left_sidebar')){
	function tvlgiao_wpdance_display_left_sidebar($sidebar_left = 'sidebar'){ 
		ob_start();
		?>
		<div class="col-sm-6 left-sidebar">							
			<?php if (is_active_sidebar($sidebar_left) ) : ?>
				<?php dynamic_sidebar( $sidebar_left ); ?>
			<?php endif; ?>
		</div>
		<?php 
		echo ob_get_clean();
	}
}

if(!function_exists ('tvlgiao_wpdance_display_right_sidebar')){
	function tvlgiao_wpdance_display_right_sidebar($sidebar_right = 'right_sidebar'){ 
		ob_start();
		?>
		<div class="col-sm-6 right-sidebar">
			<?php if (is_active_sidebar($sidebar_right) ) : ?>
					<?php dynamic_sidebar( $sidebar_right ); ?>
			<?php endif; ?>
		</div>
		<?php 
		echo ob_get_clean();
	}
}
	

/* GET HEADER LAYOUT */
if (!function_exists('tvlgiao_wpdance_get_header_post')) {
	/**
	 * Return HTML Block post assigned to the header
	 * @return string
	 */
	function tvlgiao_wpdance_get_header_post() { 
		$meta_key_header 	= '_tvlgiao_wpdance_custom_header';
		if (is_search() || !get_the_ID() || !($id = @get_post_meta(get_the_ID(), $meta_key_header , true)))
			if (!($id = @tvlgiao_wpdance_get_custom_data_by_keyname( 'tvlgiao_wpdance_header_layout', 'tvlgiao_wpdance_header_layout', '' )))
				return;
		if(@get_post_meta(get_the_ID(), $meta_key_header , true) == '' || @get_post_meta(get_the_ID(), $meta_key_header , true) == '-1'){
			$id 	= @tvlgiao_wpdance_get_custom_data_by_keyname( 'tvlgiao_wpdance_header_layout', 'tvlgiao_wpdance_header_layout', '' );
		}
		if ($id != '' && $id != '-1' && get_post($id)) {
			return get_post($id);
		}else{
			return;
		}
	}
}


if (!function_exists('tvlgiao_wpdance_get_content_header')) {
	/**
	 * Return the content of HTML Block assigned to the Header
	 * @return string
	 */
	function tvlgiao_wpdance_get_content_header() {
		global $post;
		$pre_post = $post;
		if (!($cur_post = tvlgiao_wpdance_get_header_post()))
			return;
		$post 		= $cur_post;
		$content 	= apply_filters('the_content', $cur_post->post_content);
		$post 		= $pre_post;
		return $content;
	}
}
// Header
add_action( 'tvlgiao_wpdance_header_init_action', 'tvlgiao_wpdance_header_init', 5 );
if(!function_exists ('tvlgiao_wpdance_header_init')){
	function tvlgiao_wpdance_header_init($wp_customize){
		$content_header = tvlgiao_wpdance_get_content_header();
		if(!(empty($content_header))){ ?>
			<div class="container">
				<div class="wd-content-header row">
					<?php echo ($content_header); ?>
				</div>
			</div>
		<?php }else{
			if(file_exists(TVLGIAO_WPDANCE_THEME_WPDANCE. "/headers/wd_header_default.php")){
				require_once TVLGIAO_WPDANCE_THEME_WPDANCE. "/headers/wd_header_default.php";
			}	
		}
	}
}
add_action( 'tvlgiao_wpdance_menu_mobile', 'tvlgiao_wpdance_header_menu_mobile', 5 );
if(!function_exists ('tvlgiao_wpdance_header_menu_mobile')){
	function tvlgiao_wpdance_header_menu_mobile(){
		if(file_exists(TVLGIAO_WPDANCE_THEME_WPDANCE. "/headers/wd_header_menu_mobile.php")){
			require_once TVLGIAO_WPDANCE_THEME_WPDANCE. "/headers/wd_header_menu_mobile.php";
		}
	}
}	

/*GET FOOTER LAYOUT*/
if (!function_exists('tvlgiao_wpdance_get_footer_post')) {
	/**
	 * Return HTML Block post assigned to the footer
	 * @return string
	 */
	function tvlgiao_wpdance_get_footer_post() {
		$meta_key_footer 	= '_tvlgiao_wpdance_custom_footer';
		if (is_search() || !get_the_ID() || !($id = @get_post_meta(get_the_ID(), $meta_key_footer , true)))
			if (!($id = @tvlgiao_wpdance_get_custom_data_by_keyname( 'tvlgiao_wpdance_footer_layout', 'tvlgiao_wpdance_footer_layout', '' )))
				return;
		if(@get_post_meta(get_the_ID(), $meta_key_footer , true) == '' || @get_post_meta(get_the_ID(), $meta_key_footer , true) == '-1'){
			$id 	= @tvlgiao_wpdance_get_custom_data_by_keyname( 'tvlgiao_wpdance_footer_layout', 'tvlgiao_wpdance_footer_layout', '' );
		}
		if ($id != '' && $id != '-1' && get_post($id)) {
			return get_post($id);
		}else{
			return;
		}
	}
}


if (!function_exists('tvlgiao_wpdance_get_content_footer')) {
	/**
	 * Return the content of HTML Block assigned to the Footer
	 * @return string
	 */
	function tvlgiao_wpdance_get_content_footer() {
		global $post;
		$pre_post = $post;
		$cur_post = tvlgiao_wpdance_get_footer_post();
		if (!($cur_post))
			return;
		$post 		= $cur_post;
		$content 	= apply_filters('the_content', $cur_post->post_content);
		$post 		= $pre_post;
		return $content;
	}
}

// Footer
add_action( 'tvlgiao_wpdance_footer_init_action', 'tvlgiao_wpdance_footer_init', 5 );
if(!function_exists ('tvlgiao_wpdance_footer_init')){
	function tvlgiao_wpdance_footer_init($wp_customize){
		$content_footer = tvlgiao_wpdance_get_content_footer();
		if(!(empty($content_footer))){ ?>
			<div class="container">
				<div class="wd-content-footer row">
					<?php echo $content_footer; ?>
				</div>
			</div>
		<?php }else{
			if(file_exists(TVLGIAO_WPDANCE_THEME_WPDANCE. "/footers/wd_footer_default.php")){
				require_once TVLGIAO_WPDANCE_THEME_WPDANCE. "/footers/wd_footer_default.php";
			}	
		}
	}
}
/*---------------------------------------------------------------------------*/
/*								FUNCTION 									 */
/*---------------------------------------------------------------------------*/
// Get global data
if(!function_exists ('tvlgiao_wpdance_get_post_by_global')){
	function tvlgiao_wpdance_get_post_by_global(){
		global $post;
		if ($post) {
			return $post->ID;
		}
	}
}

// Filter Search Form
add_filter( 'get_search_form', 'tvlgiao_wpdance_search_form' );
function tvlgiao_wpdance_search_form( $form ) {
	$query_search = esc_html__( 'Search item here....' , 'wpdancelaparis');
	if(get_search_query() != ""){
		$query_search = get_search_query();
	}
	$id   = 'searchform-'.mt_rand();
    $form = '
	    <form role="search" method="get" id="'.$id.'" class="searchform" action="' . home_url( '/' ) . '" >
	    	<input type="text" placeholder="' . $query_search . '" name="s" />
	    	<button type="submit" title="Search"><i class="fa fa-search"></i></button>
	    </form>'; 
    return $form;
}


if (!function_exists('tvlgiao_wpdance_htmlblock_css')) {
	/**
	 * Function add custom CSS of HTML Block in the head element
	 *
	 * @param integer $post_id Post ID
	 * @return string CSS to add to the head tag
	 */
	function tvlgiao_wpdance_htmlblock_css($post_id) {
		$custom_css = '';
		/** code copied from Vc_Base::addPageCustomCss() */
		$post_custom_css = get_post_meta( $post_id, '_wpb_post_custom_css', true );
		if ( ! empty( $post_custom_css ) )
			$custom_css .= $post_custom_css;
		
		/** code copied from Vc_Base::addShortcodesCustomCss() */
		$shortcodes_custom_css = get_post_meta( $post_id, '_wpb_shortcodes_custom_css', true );
		if ( ! empty( $shortcodes_custom_css ) ) {
			$custom_css .= $shortcodes_custom_css;
		}
		
		return $custom_css;
	}
}


// Check Woo
if( !function_exists('tvlgiao_wpdance_is_woocommerce') ){
	function tvlgiao_wpdance_is_woocommerce(){
		$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
		if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
			return false;
		}
		return true;
	} 
}

if( !function_exists('tvlgiao_wpdance_get_form_user_mobile') ){
	function tvlgiao_wpdance_get_form_user_mobile(){
		if ( !tvlgiao_wpdance_is_woocommerce() ) {
			return;
		} ?>
		<div class="wd_loginuser">
			<div class="wd_tini_account_control">
				<?php
					global $woocommerce;
					$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
					if ( $myaccount_page_id ) {
					  	$myaccount_page_url = get_permalink( $myaccount_page_id );
					}else{
						$myaccount_page_url = "";
					}	
				?>
				<a href="<?php echo esc_url($myaccount_page_url);?>" title="<?php esc_html_e('My Account','wpdancelaparis');?>">
					<?php if(is_user_logged_in()): ?>	
						<span><?php esc_html_e('My Account','wpdancelaparis');?></span>
					<?php else:?>
						<span><?php esc_html_e('Login','wpdancelaparis');?></span>
					<?php endif;?>		
				</a>	
			</div>
		</div>
		<?php
	}
}
?>