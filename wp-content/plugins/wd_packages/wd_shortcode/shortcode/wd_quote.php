<?php
/**
 * Shortcode: tvlgiao_wpdance_quote
 */

if (!function_exists('tvlgiao_wpdance_quote_function')) {
    function tvlgiao_wpdance_quote_function($atts, $content) {
        extract(shortcode_atts(array(
            'style'     => 'style-1',
            'class'     => ''
        ),$atts));      
        $result="<blockquote class='{$style}'>".do_shortcode($content)."</blockquote>";
        return $result;
    }
}
add_shortcode('tvlgiao_wpdance_quote', 'tvlgiao_wpdance_quote_function');
?>