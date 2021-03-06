<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Wordpress
 * @since wpdance
 */
?>
<?php extract(tvlgiao_wpdance_get_custom_data_special_template( '404' )); ?>
<?php if ($show_header_footer): ?>
	<?php get_header(); ?>
<?php else: ?>
	<?php get_header('none'); ?>
<?php endif ?>

<?php
	$class_style_select = 'wd-bg-color-error';
	if($select_style == 'bg_image'){
		$class_style_select = 'wd-bg-image-error';
	}
?>
<div id="main-content" class="main-content wd-404-error <?php echo esc_attr($class_style_select); ?>">
	<section class="wd-error-404">
		<div class="wd-page-header">
			<h1 class="wd-page-title"><?php esc_html_e( '404', 'wpdancelaparis' ); ?></h1>
			<span class="wd-text-title"><?php esc_html_e( 'Sorry, Page Not Found!', 'wpdancelaparis' ); ?></span>
		</div><!-- .page-header -->
		<div class="wd-page-content">
			<?php if ($show_search_form): ?>
				<?php get_search_form(); ?>
			<?php endif ?>
			<?php if ($show_back_to_home_btn): ?>
			<a class="wd-back-to-home-button <?php echo esc_attr($back_to_home_btn_class); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php echo esc_html($back_to_home_btn_text); ?></a>
		<?php endif ?>
		</div><!-- .page-content -->
	</section><!-- .error-404 -->
</div><!-- END CONTAINER  -->
<?php if ($show_header_footer): ?>
	<?php get_footer(); ?>
<?php else: ?>
	<?php get_footer('none'); ?>
<?php endif ?>