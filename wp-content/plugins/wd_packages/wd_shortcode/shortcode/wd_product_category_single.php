<?php
/**
 * Shortcode: tvlgiao_wpdance_category_by_name
 */

if (!function_exists('tvlgiao_wpdance_category_by_name_function')) {
	function tvlgiao_wpdance_category_by_name_function($atts) {
		extract(shortcode_atts(array(
			'id_category'		=> '-1',
			'image_url'			=> '',
			'image_size'		=> 'full',
			'title'				=> '1',
			'readmore'			=> '1',
			'meta'				=> '1',
			'class'				=> ''

		), $atts));
		$img = wp_get_attachment_image_src($image_url, $image_size);
		$imgSrc = $img[0];
		wp_reset_query();	

		$product_categorie = get_term( $id_category, 'product_cat' );	
		ob_start(); ?>
			<?php if($id_category == '-1') : ?>
				<?php esc_html_e('Please select category.','wpdancelaparis'); ?>
			<?php else: ?>
				<div class="wd-cate-pro-by-name">
					<a href="<?php echo get_category_link($id_category); ?>">
						<div class="wd-image-cate">
							<img alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url($imgSrc)?>"/>
						</div>
					</a>
					<div class="wd-cate-info">
						<?php if($title ) : ?>
							<a href="<?php echo get_category_link($id_category); ?>">
								<h2><?php echo $product_categorie->name; ?></h2>
							</a>
						<?php endif; ?>
						<?php if($meta ) : ?>
							<span>(<?php echo $product_categorie->count; _e(' products','wpdancelaparis'); ?>)</span>
						<?php endif; ?>
						<?php if($readmore ) : ?>
							<a class='wd-cate-readmore' href="<?php echo get_category_link($id_category); ?>"><?php esc_html_e('Read more','wpdancelaparis'); ?></a>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $content;
	}
}
add_shortcode('tvlgiao_wpdance_category_by_name', 'tvlgiao_wpdance_category_by_name_function');
?>