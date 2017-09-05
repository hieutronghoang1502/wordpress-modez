<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$post_id        = tvlgiao_wpdance_get_post_by_global();
$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="wd-variations-form variations_form cart product_detail" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'wpdancelaparis' ); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php 
				if(class_exists('WD_Shopbycolor')) {
                    $_color = 'color';
                    $attribute_color = ( isset( $_color ) )? wc_sanitize_taxonomy_name( stripslashes( (string) $_color ) ) : '';
                } else {
                    $attribute_color = '';
                }
				?>
				<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
                    <tr>
                        <td class="label"><label class="bold-upper" for="<?php echo sanitize_title($name); ?>"><?php echo wc_attribute_label( $name ); ?> <abbr class="required" title="required">*</abbr></label></td>
                        <td class="value">
                            <?php 
                            $hide_select = "";
                            if($attribute_color !== ''){
                                if($name == wc_attribute_taxonomy_name( $attribute_color )){
                                    if ( is_array( $options ) ) {
                                        if ( taxonomy_exists( $name ) ) {
                                            echo tvlgiao_wpdance_color_image_option_html($name, $options);
                                        }
                                    }
                                    $hide_select = "style=\"display:none;\"";
                                }
                            }
                            
                            ?>
                            
                            <select <?php echo wp_kses_post($hide_select);?> id="<?php echo esc_attr( sanitize_title($name) ); ?>" name="attribute_<?php echo sanitize_title($name); ?>" data-attribute_name="attribute_<?php echo sanitize_title( $name ); ?>">
                            <option value=""><?php echo esc_html__( 'Choose an option', 'wpdancelaparis' ) ?>&hellip;</option>
                            <?php
                                if ( is_array( $options ) ) {

                                    if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $name ) ] ) ) {
                                        $selected_value = $_REQUEST[ 'attribute_' . sanitize_title( $name ) ];
                                    } elseif ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) {
                                        $selected_value = $selected_attributes[ sanitize_title( $name ) ];
                                    } else {
                                        $selected_value = '';
                                    }

                                    // Get terms if this is a taxonomy - ordered
                                    if ( taxonomy_exists( $name ) ) {
                                        
                                        $terms = wc_get_product_terms( $post_id , $name, array( 'fields' => 'all' ) );

                                        foreach ( $terms as $term ) {
                                            if ( ! in_array( $term->slug, $options ) ) {
                                                continue;
                                            }
                                            echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $term->slug ), false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
                                        }
                                        
                                    } else {

                                        foreach ( $options as $option ) {
                                            echo '<option value="' . esc_attr( sanitize_title( $option ) ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
                                        }

                                    }
                                }
                            ?>
                        </select> <?php 

                            if ( sizeof( $attributes ) === $loop ) {
                                echo '<p class="wd_reset_variations"><a class="reset_variations" href="#reset">' . esc_html__( 'Clear selection', 'wpdancelaparis' ) . '</a></p>';
                            }
                        ?></td>
                    </tr>
                <?php endforeach;?>
                <?php do_action( 'woocommerce_before_single_variation' ); ?>    
                    <tr class="single_variation_wrap" style="display:none;">
                        <td class="label"><label><?php esc_html_e('Price', 'wpdancelaparis');?></label></td>
                        <td class="value">
                            <div class="single_variation"></div>                        
                        </td>
                    </tr>
                <?php //do_action( 'woocommerce_after_single_variation' ); ?>   
			</tbody>
		</table>
        <?php do_action('woocommerce_before_add_to_cart_button'); ?>
		<div class="button_single_product_wpdance">
            <div class="variations_button"> 
                <input type="hidden" name="variation_id" class="variation_id" value="" />
                <?php woocommerce_quantity_input(); ?>
            </div>
            <div class="single_variation_wrap add_to_card_button">
                <button type="submit" class="single_add_to_cart_button button alt big"><?php echo apply_filters('single_add_to_cart_text', esc_html__( 'Add to cart', 'wpdancelaparis' ), $product->get_type()); ?></button>
            </div>
            
            <div class="value_submit_wd">   
                <input type="hidden" name="add-to-cart" value="<?php echo wp_kses_post( $post_id ); ?>" />
                <input type="hidden" name="product_id" value="<?php echo esc_attr( $post_id ); ?>" />
                <input type="hidden" name="variation_id" class="variation_id" value="" />
            </div>
        </div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
