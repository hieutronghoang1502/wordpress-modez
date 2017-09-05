<?php
/**
 * Shortcode: tvlgiao_wpdance_banner_slider
 */

if (!function_exists('tvlgiao_wpdance_banner_slider_function')) {
	function tvlgiao_wpdance_banner_slider_function($atts) {
		extract(shortcode_atts(array(
			'slider'		=> '',
			'image_size'	=> 'full',
			'target'		=> '_blank',
			'columns'		=> '1',
			'center_mode'	=> '0',
			'show_nav'		=> '1',
			'show_dot'		=> '1',
			'auto_play'		=> '1',
			'class'			=> '1',
			'class' 		=> ''
		), $atts));
		$slider 		= vc_param_group_parse_atts( $slider );
		$show_nav 		= ($show_nav == '1') 	? 'true' : 'false';
		$show_dot 		= ($show_dot == '1') 	? 'true' : 'false';
		$center_mode 	= ($center_mode == '1') ? 'true' : 'false';
		$auto_play 		= ($auto_play == '1') 	? 'true' : 'false';

		$title_image	= get_bloginfo('name');
	    $random_id 		= 'wd-banner-slider-'.mt_rand();
		ob_start(); ?>
			<?php if (count($slider)) { ?>
				<div id="<?php echo esc_attr( $random_id ); ?>" class="wd-shortcode-banner-slider <?php echo esc_attr($class); ?>">
					<?php foreach($slider as $image){ ?>
						<a href="<?php echo esc_url($image['link']); ?>"  target='<?php echo esc_attr($target); ?>' title="<?php echo esc_attr($title_image); ?>">
							<?php $img_url = wp_get_attachment_image_src($image['image'], $image_size); ?>
							<img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_html(get_bloginfo('name')); ?>">
						</a>
					<?php } ?>
				</div>
				<script type="text/javascript">
					jQuery(document).ready(function() {
						"use strict";	
						var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
						$_this.slick({
						  	arrows			: <?php echo esc_html($show_nav); ?>,
						  	dots 			: <?php echo esc_html($show_dot); ?>,
						  	centerMode 		: <?php echo esc_html($center_mode); ?>,
						  	infinite 		: false,
						  	autoplay 		: <?php echo esc_html($auto_play); ?>,
						  	autoplaySpeed	: 2000,
						  	speed			: 300,
						  	slidesToShow	: <?php echo esc_attr($columns); ?>,
						  	slidesToScroll	: <?php echo esc_attr($columns); ?>,
						  	responsive		: [
							    {
							      	breakpoint			: 1024,
							      	settings 			: {
								        slidesToShow	: <?php echo esc_attr($columns); ?>,
								        slidesToScroll	: <?php echo esc_attr($columns); ?>,
								        infinite		: true,
								        dots 			: <?php echo esc_attr($show_dot); ?>,
							      	}
							    },
							    {
							      	breakpoint			: 600,
							      	settings 			: {
								        slidesToShow	: (<?php echo esc_attr($columns); ?> > 1) ? <?php echo esc_attr($columns); ?> - 1 : 1,
								        slidesToScroll	: (<?php echo esc_attr($columns); ?> > 1) ? <?php echo esc_attr($columns); ?> - 1 : 1
							      	}
							    },
							    {
								    breakpoint			: 480,
								    settings 			: {
								        slidesToShow	: 1,
								        slidesToScroll	: 1
								    }
							    }
						  	]
						});
					});	
				</script>
			<?php } ?>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_banner_slider', 'tvlgiao_wpdance_banner_slider_function');
?>