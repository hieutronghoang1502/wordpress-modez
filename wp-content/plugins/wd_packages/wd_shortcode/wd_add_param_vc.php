<?php
	vc_add_shortcode_param('wd_date_custom', 'tvlgiao_wpdance_param_vc_custom_date', SC_JS.'/wd_param_date.js');
	function tvlgiao_wpdance_param_vc_custom_date( $settings, $value ) {
		#content of param
		$out 	 = '<div class="wd-wraper-data-date">';
		$out 	.='<input type="text" class="value_date_custom wpb_vc_param_value wpb-textinput ' .esc_attr( $settings['param_name'] ) . ' ' .esc_attr( $settings['type'] ).'_field" name="' . esc_attr( $settings['param_name'] ) . '" value="' . esc_attr( $value ) . '" >';
	    $out 	.= '</div>';//end div container
		return $out; // This is html markup that will be outputted in content elements edit form
	}
?>