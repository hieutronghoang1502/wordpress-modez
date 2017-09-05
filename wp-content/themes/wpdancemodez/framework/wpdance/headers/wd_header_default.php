<?php
	extract(tvlgiao_wpdance_get_custom_data_special_template( 'header-default' )); 
	$class_left   = "col-sm-4";
	$class_right  = "col-sm-20";
	$class_center = "";
?>
<div class="wd-header-default wd-header-content wd-header-bottom">
	<div id="brief_desc"><span>FREE SHIPPING ON ORDERS OVER $50</span></div>
	<div class="<?php echo ($show_logo_title == '1') ? 'wd-header-title' : 'wd-header-logo'; ?> <?php echo esc_attr($class_center); ?>">
				<div class="col-sm-9 title">
					<?php
						$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
if ( has_custom_logo() ) {
        echo '<a href="'. home_url( ) .'"><img src="'. esc_url( $logo[0] ) .'"></a>';
} else {
        echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
}
					?>
				</div>
				<div class="col-sm-9 woo-icon">
					<ul>
						<li><a class="header_log" href="<?php echo get_page_link(15 ); ?>">Login/Register</a></li>
						<li><a class="header_wishlist" href="<?php echo get_page_link(361 ); ?>">My Wishlist</a></li>
						<li><?php echo do_shortcode('[tvlgiao_wpdance_dropdowncart]' ); ?></li>
						<li><?php echo do_shortcode( '[tvlgiao_wpdance_search_blog style="style-1"]' ); ?></li>
						
					</ul>
				</div>
	</div>
	
	<div class="menu_header">
			<div class="container"> 
				<div class="wd-header-menu-right-search-cart">
					<div class="wd-header-menu-right">
						<?php 
						$args = array(
							'theme_location' => $menu_location, 
							'container' => false, 
							'menu_class' => 'nav navbar-nav responsive-nav main-nav-list',
						);
						wp_nav_menu( $args ); ?>
					</div>
				</div>
			</div>
		
	</div>
</div>