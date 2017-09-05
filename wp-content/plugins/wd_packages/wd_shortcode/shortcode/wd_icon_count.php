<?php
/**
 * Shortcode: tvlgiao_wpdance_count_icon
 */

if (!function_exists('tvlgiao_wpdance_count_icon_function')) {
	function tvlgiao_wpdance_count_icon_function($atts) {
		extract(shortcode_atts(array(
			'show_icon'			=> '1',
			'icon_fontawesome' 	=>	'fa fa-adjust',
			'color_icon'		=> '#cccccc',
			'start'				=> "0",
			'finish'			=> '1000',
			'color_number'		=> '#cccccc',
			'text_infomation'	=> '',
			'color_text'		=> '#cccccc',
			'class' 			=> ''
		), $atts));

		ob_start(); ?>
			<div class="wd-count_icon <?php echo esc_attr($class); ?>">				
				<?php if($show_icon): ?>
					<div class="feature_icon fa fa-3x <?php echo esc_attr($icon_fontawesome); ?>" style="color: <?php echo esc_attr($color_icon); ?>"></div>
				<?php endif; ?>
				<div class="counter" data-count="<?php echo esc_attr($finish); ?>" style="color: <?php echo esc_attr($color_number); ?>"><?php echo esc_attr($start); ?></div>
				<div class="wd-information-text" style="color: <?php echo esc_attr($color_text); ?>"><?php echo esc_attr($text_infomation); ?></div>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					"use strict";
					$('.wd-count_icon .counter').each(function() {
		 				var $this = $(this),
			  			countTo = $this.attr('data-count');
						$({ countNum: $this.text()}).animate({
							countNum: countTo
						},{
							duration: 15000,
							easing:'linear',
							step: function() {
							  $this.text(Math.floor(this.countNum));
							},
							complete: function() {
							  $this.text(this.countNum);
							  //alert('finished');
							}
				  		});  
					});
				});		  
			</script>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_count_icon', 'tvlgiao_wpdance_count_icon_function');
?>