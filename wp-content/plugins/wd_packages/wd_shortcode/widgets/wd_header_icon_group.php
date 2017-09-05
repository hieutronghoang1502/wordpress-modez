<?php
// we can only use this Widget if the plugin is active
$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );

if( !class_exists( 'tvlgiao_wpdance_widget_header_icon_group' ) ) {
	class tvlgiao_wpdance_widget_header_icon_group extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_header_icon_group', 'description' => esc_html__('Header Icon Group Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('header_icon_group', esc_html__('WD - Header Icon Group','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	        $class      		= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );
	        ?>
				
	            <p>
	                <label for="<?php echo $this->get_field_id( 'class' ); ?>"><?php esc_html_e( 'Extra class name:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'class' ); ?>" name="<?php echo $this->get_field_name( 'class' ); ?>" type="text" value="<?php echo $class; ?>" />
	                </label>
	            </p>
	        <?php
	    }
	    function widget( $args, $instance )
	    {
	        extract($args);
	        $show_title       = $instance['show_title'];
	        $class      	  = $instance['class'];
	        echo $before_widget; ?>
		        <style type="text/css">
				.group-links {
					display: inline-block;
					list-style: none;
					height: 44px;
					line-height: 44px;
					background-color: #c7aa80;
					border-radius: 2px;
					margin: 0 5px 0 0;
					text-align: center;
					vertical-align: -1px;
					padding-left: 5px;
					padding-right: 5px;
				}
				.group-links>li {
					display: inline-block;
					margin: 0;
					padding-left: 7px;
					padding-right: 7px;

				}
				header#top .nav-header .nav-header-wrapper .nav-header-inner .right-area .group-links>li.customer-links {
					padding-right: 10px;
				}
				.group-links>li.search-field {
					float: none !important;
				}
				.group-links>li.customer-links #loginBox {

				}
				.group-links>li.customer-links:hover #loginBox {


				}
			</style>
			<ul class="group-links">
				<?php if ( in_array( "woocommerce-currency-switcher/index.php", $_actived ) ) { ?>
					<!-- Currency -->
					<li class="currency_group hidden-xs">
						<div class="currencies-switcher">
							<div class="currency btn-group uppercase">
								<a class="currency_wrapper dropdown-toggle" data-toggle="dropdown">
									<i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
									<i class="sub-dropdown visible-sm visible-md visible-lg"></i>

									<span class="currency_code heading hidden-xs">USD</span>
									<span class="currency_code visible-xs">USD</span>
									<i class="fa fa-caret-down"></i>
								</a>
								<div class="currencies dropdown-menu text-left">
									<?php if(do_shortcode('[woocs]')) {echo do_shortcode('[woocs]');} ?>
								</div>
							</div>
						</div>
					</li>
				<?php } ?>
				
				<?php if ( in_array( "woocommerce/woocommerce.php", $_actived ) ) { ?>
					<!-- Login/register -->
					<li class="customer-links unstyled">                
						<div class="toolbar-customer login-account">                    
							<span id="loginButton" class="dropdown-toggle" data-toggle="dropdown">
								<i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
								<i class="sub-dropdown visible-sm visible-md visible-lg"></i>
								<i class="fa fa-user"></i>                                        
							</span>                    
							<div id="loginBox" class="dropdown-menu text-left">

								<div class="form_wrapper">				
									<div class="form_wrapper_body">
										<h3><?php esc_html_e( 'My Account', 'wpdancelaparis' ); ?></h3>
										<form method="post" class="login" id="loginform-custom" >

											<?php do_action( 'woocommerce_login_form_start' ); ?>

											<p class="login-username">
												<label for="username"><?php esc_html_e( 'User or Email', 'wpdancelaparis' ); ?><span class="required">*</span></label>
												<input type="text" size="20" class="input" id="username" name="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>">
											</p>
											<p class="login-password">
												<label for="password"><?php esc_html_e( 'Password', 'wpdancelaparis' ); ?> <span class="required">*</span></label>
												<input type="password" size="20" value="" class="input" id="password" name="password">
											</p>

											<div class="clear"></div>

											<?php do_action( 'woocommerce_login_form' ); ?>											

											<p class="login-submit">
												<?php wp_nonce_field( 'woocommerce-login' ); ?>
												<input type="submit" class="secondary_button" name="login" value="<?php esc_html_e( 'Login', 'wpdancelaparis' ); ?>" />
											</p>

											<?php do_action( 'woocommerce_login_form_end' ); ?>

										</form>
									</div>
									<div class="form_wrapper_footer">
										<span><?php esc_html_e('or New to Goodly? ','wpdancelaparis');?></span><span><a class="link_color_hover" href="<?php echo esc_url($myaccount_page_url); ?>"><?php esc_html_e('Register','wpdancelaparis'); ?></a></span>
									</div>
								</div>	

							</div>
						</div>                                  
					</li>

					<!-- Search -->
					<li class="search-field fl">
						<a href="/search" class="search dropdown-toggle dropdown-link" data-toggle="dropdown" title="Search Toolbar">
							<i class="fa fa-search"></i>
							<i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
							<i class="sub-dropdown visible-sm visible-md visible-lg"></i> 
						</a>
						<div id="search-info" class="dropdown-menu wd-search-post style-3">
							<div class="<?php echo esc_attr($class) ?>">
								<form role="search" method="get" class="search-forms" action="<?php echo esc_url( home_url('/') ); ?>">
									<select class="wd_search_product" name="product_cat">
										<option value="">All Categories</option>
										<?php 
										$taxonomy     = 'product_cat';
										$order_by      = 'name';  
									  	$show_count   = 0;      // 1 for yes, 0 for no
									  	$pad_counts   = 0;      // 1 for yes, 0 for no
									  	$hierarchical = 1;      // 1 for yes, 0 for no  
									  	$title        = '';  
									  	$empty        = 0;
										$args = array(
										  	'taxonomy'     => $taxonomy,
										  	'orderby'      => $order_by,
										  	'show_count'   => $show_count,
										  	'pad_counts'   => $pad_counts,
										  	'hierarchical' => $hierarchical,
										  	'title_li'     => $title,
										  	'hide_empty'   => $empty
										);
									  	$all_categories = get_categories( $args );
									  	foreach ($all_categories as $cat) { ?>
									  		<option value="<?php echo $cat->name ; ?>"><?php echo $cat->name ; ?></option>
									  	<?php } ?>
									</select>
									<div class="wd_search_form">
									  	<input type="text" class="search-field" value="" name="s" id="s" placeholder="Search for products ">
									  	<input type="submit" title="Search" id="searchsubmit" class="search-submit" value="Search">
									  	<input type="hidden" name="post_type" value="product">
									</div>
								</form>
							</div>
						</div>                
					</li>
					<script>
						jQuery(".search-field")
						.mouseover(function() {
							jQuery( "#search-info").addClass("search-dropped-down");
						})
						.mouseout(function() {
							jQuery( "#search-info").removeClass("search-dropped-down");
						});
					</script>
				<?php } ?>
			</ul>
			<?php
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['class']            	 = strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}	
}

function wd_widget_register_widget_header_icon_group() {
	register_widget( 'tvlgiao_wpdance_widget_header_icon_group' );
}
add_action( 'widgets_init', 'wd_widget_register_widget_header_icon_group' );
?>