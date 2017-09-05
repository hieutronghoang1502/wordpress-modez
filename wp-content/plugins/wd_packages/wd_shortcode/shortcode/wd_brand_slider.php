<?php
/**
 * Shortcode: tvlgiao_wpdance_brand_slider
 */

if (!function_exists('tvlgiao_wpdance_brand_slider_function')) {
	function tvlgiao_wpdance_brand_slider_function($atts) {
		extract(shortcode_atts(array(
			'image_url'		=> '',
			'is_slider'		=> '1',
			'columns'		=> '1',
			'show_nav'		=> '1',
			'auto_play'		=> '1',
			'class' 		=> ''
		), $atts));
		$array_image 	= explode(',',$image_url); 
		if (count($array_image) <= $columns) {
			$is_slider = '0';
		}
		$columns_brand 	= ($is_slider == '0') ? 'wd-columns-'.$columns : '';

		$slider_class  = ($is_slider == 1) ? 'wd-shortcode-brand-style-slider' : '';
		$i = 0;
		$imglink_array = array();
		foreach($array_image as $_image)
	    {	
	        $img_url = wp_get_attachment_image_src($_image, "full");
	        $imglink_array[$i] = $img_url[0];
	        $i++;
	    }
	    $random_id = 'wd-brand-slider-'.mt_rand();
		ob_start(); ?>
			<div id="<?php echo esc_attr( $random_id ); ?>" class="wd-shortcode-brand  <?php echo esc_attr($slider_class); ?> <?php echo esc_attr($class); ?> <?php echo esc_attr($columns_brand); ?>">
				<ul class="wd-brand-item-list">

					<?php foreach($array_image as $_image){ ?>
						<?php $img_url = wp_get_attachment_image_src($_image, "full"); ?>
						<li class="wd-brand-item"><img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_html(get_bloginfo('name')); ?>"></li>
					<?php } ?>

				</ul>
			</div>
			<?php if ($is_slider == 1): ?>
				<script type="text/javascript">
					jQuery(document).ready(function() {
						"use strict";	
						var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
						var owl = $_this.find('.wd-brand-item-list').owlCarousel({
							item : 3,
							responsive		:{
								0:{
									items: 1
								},
								480:{
									items: 3
								},
								768:{
									items: 4
								},
								992:{
									items: 5
								},
								1200:{
									items: 5
								}
							},
							nav : true,
							<?php if($show_nav) : ?>
								navText		: [ '<', '>' ],
							<?php endif; ?>
							<?php if($auto_play) : ?>
								autoplay: true,
								autoplayTimeout: 3000,
							<?php endif; ?>
							<?php if(!$show_nav) : ?>
								nav : false,
							<?php endif; ?>
							dots			: false,
							loop			: true,
							lazyload		: true,
							onInitialized: function(){
								$_this.addClass('loaded').removeClass('loading');
							}
						});
					});	
				</script>
			<?php endif ?>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_brand_slider', 'tvlgiao_wpdance_brand_slider_function');
?>