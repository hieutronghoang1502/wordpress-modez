<?php
/**
 * Shortcode: tvlgiao_wpdance_banner_image
 */

if (!function_exists('tvlgiao_wpdance_banner_image_function')) {
	function tvlgiao_wpdance_banner_image_function($atts) {
		extract(shortcode_atts(array(
			'bg_image'		=> '1',
			'button_text'	=> '',
			'link_url'		=> "#",
			'button_class'	=> '',
			'top'			=> '',
			'right'			=> '',
			'bottom'		=> '',
			'left'			=> '',
			'class' 		=> ''
		), $atts));
		$image_url 	= wp_get_attachment_image_src($bg_image, "full");
		$title		= get_bloginfo('name');
		$imgSrc 	= $image_url[0];
		ob_start(); ?>
			<div class="wd-shortcode-banner <?php echo esc_attr($class); ?>" onclick="location.href='<?php echo esc_url($link_url);?>'">				
				<div class="wd-image-banner">
					<img alt="<?php echo esc_attr($title);?>" title="<?php echo esc_attr($title);?>" class="img" src="<?php echo esc_url($imgSrc)?>" />
				</div>
				<?php if($button_text !== '' ):?>
					<div class="wd-button-banner" style="top: <?php echo esc_attr($top);?>;left: <?php echo esc_attr($left);?>; right: <?php echo esc_attr($right);?>; bottom: <?php echo esc_attr($bottom);?>;">
						<a class="wd-button-bn <?php echo esc_attr($button_class)?>" href="<?php echo esc_url($link_url)?>" title="<?php echo esc_attr($title);?>" style="font-size: <?php echo esc_attr($button_text_size);?>;"><?php echo esc_attr($button_text);?></a>
					</div>
				<?php endif;?>
			</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_banner_image', 'tvlgiao_wpdance_banner_image_function');
?>