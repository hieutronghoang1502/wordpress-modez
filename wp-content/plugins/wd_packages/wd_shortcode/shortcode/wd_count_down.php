<?php
/**
 * Shortcode: tvlgiao_wpdance_count_down
 */

if (!function_exists('tvlgiao_wpdance_count_down_function')) {
	function tvlgiao_wpdance_count_down_function($atts) {
		extract(shortcode_atts(array(
			'title'					=> '',
			'icon_image'			=> '',
			'date_count_down'		=> '',
			'class' 				=> ''
		), $atts));
		$image_url 	= wp_get_attachment_image_src($icon_image, "full");
		$imgSrc 	= $image_url[0];
		$title_img	= get_bloginfo('name');
		
		$random_id = 'wd_count_down'.mt_rand();
		ob_start(); ?>
			<div id="<?php echo esc_attr($random_id); ?>" class="wd-count-down <?php echo esc_attr($class); ?>">
				<?php if($imgSrc != "") : ?>
					<div class="wd-image-banner">
						<img alt="<?php echo esc_attr($title_img);?>" title="<?php echo esc_attr($title_img);?>" class="img" src="<?php echo esc_url($imgSrc)?>" />
					</div>
				<?php endif; ?>	
				<?php if($title != "") : ?>
					<div class="wd-count-title"><?php echo esc_attr($title); ?></div>	
				<?php endif; ?>
				<div class="wd-content-count"></div>
				<div class="wd-data-curent"><span><?php $date=date_create($date_count_down); echo date_format($date,"F d,Y"); ?></span></div>
			</div>
			<script type="text/javascript">
			  	jQuery( document ).ready( function($) {
			  		var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
			  		$_this.find('.wd-content-count').countdown("<?php echo esc_attr($date_count_down); ?>", function(event) {
						var $this = $(this).html(event.strftime(''
							+ '<div class="time weeks"><span class="count">%-w</span><span class="label">Week%!w</span></div>'
							+ '<div class="time days"><span class="count">%-d</span><span class="label">Day%!d</span></div>'
							+ '<div class="time hours"><span class="count">%H</span><span class="label">Hr</span></div>'
							+ '<div class="time minutes"><span class="count">%M</span><span class="label">Min</span></div>'
							+ '<div class="time seconds"><span class="count">%S</span><span class="label">Sec</span></div>'
						));
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
add_shortcode('tvlgiao_wpdance_count_down', 'tvlgiao_wpdance_count_down_function');
?>