<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Wordpress
 * @since wpdance
 */
?><!DOCTYPE html>
<html itemscope <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php do_action('tvlgiao_wpdance_header_meta_data'); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action('tvlgiao_wpdance_after_opening_body_tag'); ?>
<div class="body-wrapper">
<header id="header" class="header">
	<div class="header-mobile visible-xs visible-sm"><?php do_action('tvlgiao_wpdance_menu_mobile') ?></div>
</header> <!-- END HEADER  -->