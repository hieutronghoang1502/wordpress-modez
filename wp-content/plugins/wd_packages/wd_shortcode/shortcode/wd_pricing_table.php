<?php

// **********************************************************************// 
// ! Register New Element: Pricing Table
// **********************************************************************//
if (!function_exists('tvlgiao_wpdance_pricing_table_function')) {
	function tvlgiao_wpdance_pricing_table_function($atts, $content = null) {
        $args = array(
            'style'                 => "style-1",
            'show_icon_font_image'  => "1",
            'class_icon_font'       => "fa-rocket",
            'image_pricing_url'     => "",
            'title'                 => "Basic Plan",
            'description'           => "",
            'price'                 => "0",
            'currency'              => "$",
            'price_period'          => "month",
            'link'                  => "http://wpdance.com/",
            'target'                => "",
            'button_text'           => "Buy Now",
            'active'                => ""
        );  
	        
		extract(shortcode_atts($args, $atts));

        if($image_pricing_url != ""){
            $image                   = wp_get_attachment_image_src($image_pricing_url,'full');
            $image_pricing_url       = $image[0];
        }	        
	    $html = ""; 
	        
        if($target == ""){
                $target = "_self";
        }
        ob_start();
        ?>
        
        <div class='wd_price_table price_<?php echo esc_attr($style); ?>'>
            <div class="price_table_inner <?php if($active == "yes") echo 'acitve_price'; ?>">
            <?php if($style == "style-3") : ?>
                <div class="wd-feature-icon "><a class="feature_icon fa fa-4x <?php echo esc_attr($class_icon_font) ?>"></a></div> 
            <?php endif; ?>             
                <ul>
                    <?php if($style == "style-1" || $style == "style-2" || $style == "style-4" || $style == "style-6") : ?>
                        <li class='prices'>
                            <span class='price_in_table'>
                                <span class='value'><?php echo esc_attr($currency); ?></span>
                                <span class='pricing'><?php echo esc_attr($price); ?></span>
                                <span class='mark'><?php echo esc_attr($price_period); ?></span>
                            </span>
                        </li> <!-- close price li wrapper -->
                        <?php if($style == "style-4" && $description != "") : ?>
                            <li class='description'><?php echo esc_attr($description); ?></li> 
                        <?php endif; ?>
                        <li class='cell table_title'><h1><?php echo esc_attr($title); ?></h1></li> 
                	<?php endif; ?>

                    <?php if($style == "style-3" || $style == "style-5" || $style == "style-7" || $style == "style-8") : ?>
                        <li class='cell table_title'><h1><?php echo esc_attr($title); ?></h1></li>
                        <?php if($style == "style-7" && $description != "") : ?>
                            <li class='description'><?php echo esc_attr($description); ?></li> 
                        <?php endif; ?> 
                        <li class='prices'>
                            <?php if($style == "style-8") : ?>
                                <img src='<?php echo esc_url($image_pricing_url); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name') ); ?>' title="<?php echo esc_attr(bloginfo('name')) ?>">
                            <?php endif; ?>
                            <span class='price_in_table'>
                                <span class='value'><?php echo esc_attr($currency); ?></span>
                                <span class='pricing'><?php echo esc_attr($price); ?></span>
                                <span class='mark'><?php echo esc_attr($price_period); ?></span>
                            </span>
                        </li> <!-- close price li wrapper --> 
                    <?php endif; ?>        	    
                	<li><?php echo ($content); ?></li> <!-- append pricing table content -->

                	<li class='price_button'>
                	   <a class='button normal' href='<?php echo esc_url($link); ?>' target='<?php echo esc_attr($target); ?>'><?php echo esc_attr($button_text); ?></a>
                	</li> <!-- close button li wrapper -->
            	    
            	</ul>
            </div>
        </div>
        
	    <?php
        $output = ob_get_contents();
        ob_end_clean();
        wp_reset_postdata();
        return $output; 
	}
}
add_shortcode('tvlgiao_wpdance_pricing_table', 'tvlgiao_wpdance_pricing_table_function');

?>