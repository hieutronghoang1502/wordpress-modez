jQuery(document).ready(function($) {
	"use strict";
	// Light box
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({
		theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook / pp_default */
		social_tools: '', /* html or false to disable */
		slideshow: 5000,
        autoplay_slideshow: false,
	});
});
