<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Wordpress
 * @since wpdance
 */
?>
<footer id="footer" class="footer">
	<?php do_action('tvlgiao_wpdance_footer_init_action'); ?>
</footer> <!-- END FOOOTER  -->
<div class="wd-footer-info">
	<?php _e('Copyright', 'wpzoom') ?>-<?php echo date("Y") ?> <a href="<?php echo home_url( ); ?>"><?php bloginfo('name' ); ?></a>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>