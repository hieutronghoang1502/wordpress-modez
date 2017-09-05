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
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400,400i,700&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat:400,700&amp;subset=latin-ext" rel="stylesheet">
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
	<div class="hidden-xs hidden-sm">
		<?php do_action('tvlgiao_wpdance_header_init_action'); ?>
	</div>
	<div class="header-mobile visible-xs visible-sm">
		<?php do_action('tvlgiao_wpdance_menu_mobile') ?>
	</div>
	<?php do_action('tvlgiao_wpdance_init_breadcrumbs') ?>
</header> <!-- END HEADER  -->
