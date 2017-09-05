//****************************************************************//
/*							Main JS								  */
//****************************************************************//


jQuery(document).ready(function(jQuery) {
	"use strict";
	jQuery(window).on("click", function(){		
		if (jQuery('.widget_woo_currency_switcher .widget-woocommerce-currency-switcher').has(event.target).length == 0	&&	!jQuery('.widget_woo_currency_switcher .widget-woocommerce-currency-switcher').is(event.target)	){
			jQuery('.widget_woo_currency_switcher .widget-woocommerce-currency-switcher').removeClass('active');
		} else {
			jQuery('.widget_woo_currency_switcher .widget-woocommerce-currency-switcher').addClass('active');
		}
	});

	/* carousel functions */
	jQuery('.wd-carousel-thumb').carousel();

	jQuery(document).on('click', '.wd-carousel-thumb', function() {
    	var id = jQuery("#" + jQuery(this).attr("id"));
    	jQuery(id).on('slid.bs.carousel', function () { 
	    	wd_get_bs_thumbs(id);
    	});
    });
    
    jQuery(document).on('mouseenter', '.wd-carousel-thumb', function() {
    	var id = jQuery("#" + jQuery(this).attr("id"));
        wd_get_bs_thumbs(id);
    });
	
	function wd_get_bs_thumbs( id ){
			
		var nextThumb = jQuery(id).find(".item.active").find(".next-image-preview").data("image");
        var prevThumb = jQuery(id).find(".item.active").find(".prev-image-preview").data("image");
        jQuery(id).find(".right.carousel-control").find(".thumbnail-container").css({"background-image" : "url("+ nextThumb +")"});
        jQuery(id).find(".left.carousel-control").find(".thumbnail-container").css({"background-image" : "url("+ prevThumb +")"});
		
	}
	/* end carousel functions */
	

	//slide-menu-left
	jQuery('.slide-menu-left .menu-shop-by-category-container,#mega-menu-wrap-primary_right').hide();

	jQuery('.slide-menu-left').hoverIntent(
		function(){
			jQuery('.slide-menu-left .menu-shop-by-category-container,#mega-menu-wrap-primary_right').slideDown(300);
		},
		function() {
			jQuery('.slide-menu-left .menu-shop-by-category-container,#mega-menu-wrap-primary_right').slideUp(300);
		}
	);

	//Menu Mobile
	jQuery(".menu-bars").click(function(){
		jQuery(".menu-bars, .pushmenu-left, .body-wrapper, body").toggleClass('pushmenu');      
	});
	jQuery(".pushmenu-left .nav ul li.page_item_has_children, .pushmenu-left .mobile-main-menu ul li.menu-item-has-children").prepend("<i class='fa fa-caret-down'></i>");
	
	jQuery(".pushmenu-left .nav ul li.page_item_has_children i, .pushmenu-left .mobile-main-menu ul li.menu-item-has-children i").click(function(){
		jQuery(this).toggleClass('openmenu');      
	});

	//add toggleclass active for tab-pane
	var EltabPanelHeading = jQuery('.tab-pane .panel-group .panel .panel-heading');
	EltabPanelHeading.on('click', function() {
		EltabPanelHeading.removeClass('active');
		jQuery(this).addClass('active');
	});

	//Form login and cart
	jQuery('.cart_dropdown,.form_drop_down').hide();
	jQuery('.wd_tini_cart_wrapper,.wd_tini_account_wrapper').hoverIntent(
		function(){
			jQuery(this).children('.drop_down_container').slideDown(300);
		}
		,function(){
			jQuery(this).children('.drop_down_container').slideUp(300);
		}
	
	);
	jQuery('body').on('mini_cart_change',function(){
		jQuery('.wd_tini_cart_wrapper,.wd_tini_account_wrapper').hoverIntent(
			function(){
				jQuery(this).children('.drop_down_container').slideDown(300);
			}
			,function(){
				jQuery(this).children('.drop_down_container').slideUp(300);
			}
		
		);
	});
	
	//Hide Popup
	jQuery(".popup").hide();

	jQuery(".wd-click-popup-search").click(function () {
		if(jQuery(".wd-popup-search" ).hasClass( "hidden" )){
			jQuery(".wd-popup-search").removeClass('hidden').addClass('show')	
		}else{
			jQuery(".wd-popup-search").removeClass('show').addClass('hidden')
		}
	});
	jQuery(".wd-search-close").click(function () {
		jQuery(".wd-popup-search").removeClass('show').addClass('hidden')
	});

	//Scroll Button
	if( jQuery('html').offset().top < 100 ){
		jQuery("#tvlgiao-back-to-top").hide();
	}
	jQuery(window).scroll(function () {
		var winTop = jQuery(window).scrollTop();
		if (jQuery(this).scrollTop() > 100) {
			jQuery("#tvlgiao-back-to-top").fadeIn();
		} else {
			jQuery("#tvlgiao-back-to-top").fadeOut();
		}
	});
	jQuery("#tvlgiao-back-to-top").click(function(){
		jQuery('body,html').animate({
		scrollTop: '0px'
		}, 1000);
		return false;
	});

	jQuery('body').addClass('loaded');


	//post masonry
	if(jQuery('.post_mansory').length > 0 ){
		jQuery('.post_mansory').each(function(index,value){
			var wrapper_width = jQuery(this).width();				
			var object_selector = '#'+jQuery(this).attr('id');
			var min_width = jQuery(value).attr('data-min');		
			var item_width = Math.floor(wrapper_width * min_width / 100);
			fix_gallery_item(object_selector,wrapper_width,min_width,item_width);
			
			jQuery(value).imagesLoaded( function() {
				jQuery(value).isotope({
					layoutMode: 'masonry'
					,itemSelector: '.gallery_item'
					,masonry: {
						columnWidth: item_width
					}
				});
			});
		});	
	}

	function fix_gallery_item(object_selector,wrapper_width,min_width,item_width){
		jQuery( object_selector + " div.gallery_item" ).each(function() {
			var item_data_width = 	jQuery(this).attr('data-width');
			var item_width__ = Math.round(item_data_width / min_width) * item_width;
			//var item_width = Math.floor(wrapper_width * item_data_width / 100);
			jQuery( this).css({'width' : item_width__+'px'});
		});
	}
 
	//comment form script
	jQuery('#commentform').find('input').focus(function() {
		if(jQuery(this).val() == jQuery(this).attr('data-default'))
			jQuery(this).val('');
	}).blur(function() {
		if(jQuery(this).val() == '')
			jQuery(this).val(jQuery(this).attr('data-default'));
	});
	jQuery('#commentform').submit(function() {
		jQuery(this).find('input').each(function(input){
			if(jQuery(this).val() == jQuery(this).attr('data-default'))
				jQuery(this).val('');
		});	
		return true;
	});


	// Wishlist
	jQuery( "html .woocommerce table.wishlist_table tbody tr td.product-name" ).attr({
	  "data-title": "Product"
	});
	jQuery( "html .woocommerce table.wishlist_table tbody tr td.product-price" ).attr({
	  "data-title": "Price"
	});
	jQuery( "html .woocommerce table.wishlist_table tbody tr td.product-stock-status" ).attr({
	  "data-title": "Stock"
	});


	//tooltip bootstrap
	jQuery('[data-toggle="tooltip"]').tooltip();
});

/* THONG PHAM - 20170804 */
jQuery(document).ready(function() {
	// INIT

	//FUNCTION
	 teammateSlider();
	// sliderTeammate();
	bxslider();
	productTabInfo;
});
/* _THONG PHAM - 20170804 */

/* Carousel JS */
jQuery('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})


function teammateSlider(){
jQuery('.teammate-slider-about .bxslider').bxSlider({
 	slideWidth: 300,
    minSlides: 2,
    maxSlides: 4,
    slideMargin: 30,
    nextText: 'trái',
    prevText: 'phải'
});
}

// function sliderTeammate(){
// jQuery(document).ready(function(){
//   jQuery(".teammate-slider-about .owl-carousel").owlCarousel();
// });
// }

function bxslider(){
jQuery('.bxslider').bxSlider({
  minSlides: 4,
  maxSlides: 5,
  slideWidth: 170,
  slideMargin: 10,
  mode: 'vertical',
  pager: false
});
}

function productTabInfo(){
	jQuery('#myTabs a').click(function (e) {
  e.preventDefault()
  jQ(this).tab('show')
})
}