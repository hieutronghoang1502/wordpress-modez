<?php
/**
 * @package Wordpress
 * @since wpdance
 **/

require_once get_template_directory()."/framework/abstract.php";
require_once get_template_directory().'/framework/storefont-shortcode-customize.php';
require_once get_template_directory().'/framework/storefont-shortcode-templatepart.php';
extract(tvlgiao_wpdance_get_custom_data_special_template( 'header-default' )); 

add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
) );
//shortcode menu icon header
	function shortcode_header_icon(){
		ob_start(); ?>
		<ul>
			<li><div id="sitename"><h1><?php echo esc_attr(get_bloginfo( 'name', 'display' ) ); ?></h1></div></li>
			<li>
				<div class="wd-header-search-cart">
				<?php if(tvlgiao_wpdance_is_woocommerce()): ?>
					<?php echo tvlgiao_wpdance_tini_cart('')?>
				<?php endif; ?>
				<?php if( class_exists('WD_Shortcode') ) : ?>
					<?php echo do_shortcode( '[tvlgiao_wpdance_search_blog style="style-1"]' ); ?>
				<?php else: ?>
					<a href="#">Login</a>/<a href="#">Register</a>
					<?php get_search_form( $echo = true );?>				
				<?php endif; ?>
				</div>
			</li>
		</ul>
		<?php
		$content = ob_get_clean();
		return $content;
	}
	add_shortcode( 'header_icon', 'shortcode_header_icon' );


add_action('rating_product', 'add_star_rating' );
function add_star_rating()
{
global $woocommerce, $product;
$average = $product->get_average_rating();

echo '<div class="star-rating"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>';
}

add_action('tab-desc','woocommerce_template_single_excerpt', 5);

function wpse_comment_form_defaults( $defaults )
{
    add_filter( 'comments_open', 'wpse_comments_open' );
    remove_filter( current_filter(), __FUNCTION__ );
    return $defaults;
}

function wpse_comments_open( $open )
{
    remove_filter( current_filter(), __FUNCTION__ );
    return false;
}

?>