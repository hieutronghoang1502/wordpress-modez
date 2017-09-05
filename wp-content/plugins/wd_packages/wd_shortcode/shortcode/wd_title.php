<?php
/**
 * Shortcode: tvlgiao_wpdance_title
 */

if (!function_exists('tvlgiao_wpdance_title_function')) {
	function tvlgiao_wpdance_title_function($atts) {
		extract(shortcode_atts(array(
			'title'				=> '',
			'description'		=> '',
			'heading_type'		=> 'wd-title-section-style-1',
			'heading_element'	=> 'h1',
			'text_align'		=> 'wd-text-align-default',
			'display_button'	=> '0',
			'button_text'		=> 'View All',
			'button_url'		=> '#',
			'class' 			=> ''
		), $atts));
		ob_start(); ?>
			<?php if($title != "" || $description != "" || $display_button) : ?>
				<div class="wd-title <?php echo esc_attr($heading_type); ?> <?php echo esc_attr($class); ?>">
					<?php if ($title != ''): ?>
						<<?php echo esc_html($heading_element); ?> class="wd-title-heading <?php echo esc_html($text_align); ?>"><?php echo esc_html($title); ?></<?php echo esc_html($heading_element); ?>>		
					<?php endif ?>		
					<?php if($description != "" || $display_button) : ?>
						<div class="wd-title-description <?php echo esc_html($text_align); ?>">
							<?php if ($description != ''): ?>
								<?php echo esc_html($description); ?>
							<?php endif ?>
							<?php if($description != "" && $display_button) : ?>
								<?php _e(' | ','wpdancelaparis') ?>
							<?php endif; ?>
							<?php if($display_button) : ?>
								<a target="_blank" href="<?php echo esc_url($button_url);?>"><?php echo esc_html($button_text); ?></a>
							<?php endif; ?>
						</div>	
					<?php endif ?>	
				</div> 
			<?php endif ?>	
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_title', 'tvlgiao_wpdance_title_function');
?>