<?php
/**
 * Shortcode: tvlgiao_wpdance_payment_icon
 */

if (!function_exists('tvlgiao_wpdance_payment_icon_function')) {
	function tvlgiao_wpdance_payment_icon_function($atts) {
		extract(shortcode_atts(array(
			'list_icon_payment'	=> '',
			'size'				=> 'fa-2x',
			'class' 			=> ''
		), $atts));
		ob_start(); ?>
			<?php if ($list_icon_payment): ?>
	    		<?php $icons_class = explode(',', $list_icon_payment); ?>
	    		<?php if (count($icons_class) > 0): ?>
	    			<ul class="payment wd-icon-widget-payment <?php echo esc_attr($class); ?>">
	        			<?php foreach ($icons_class as $icon): ?>
	        				<?php if ($icon != ''): ?>
	        					<li><i class="fa <?php echo esc_html($size); ?> <?php echo esc_html(trim($icon)); ?>" aria-hidden="true"></i></li>
	        				<?php endif ?>
	        			<?php endforeach ?>
	    			</ul>
	    		<?php endif ?>
	    	<?php endif ?>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_payment_icon', 'tvlgiao_wpdance_payment_icon_function');
?>