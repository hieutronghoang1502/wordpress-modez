<?php
/**
 * Shortcode: tvlgiao_wpdance_process_bar
 */

if (!function_exists('tvlgiao_wpdance_process_bar_function')) {
    function tvlgiao_wpdance_process_bar_function($atts, $content) {
        extract(shortcode_atts(array(
            'process'     	=> '',
            'class'     	=> ''
        ),$atts));
		$process = vc_param_group_parse_atts( $atts['process'] );
        ob_start(); ?>
			<div class="wd-process-bar <?php echo esc_attr($class); ?>">
				<?php foreach($process as $item){ ?>
					<div class="wd-single-bar">
						<p class="wd-label-bar"><?php echo $item['label']; ?> <span><?php echo $item['value']; ?>%</span></p>
						<div class="wd-blank-bar">
							<span class="wd-bar" style="width:<?php echo $item['value']; ?>%"></span>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php  //endif 
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_query();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_process_bar', 'tvlgiao_wpdance_process_bar_function');
?>