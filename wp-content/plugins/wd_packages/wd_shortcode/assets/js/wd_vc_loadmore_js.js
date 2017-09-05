function tvlgiao_wpdance_load_isotope(){
	jQuery('.grid').isotope({
		itemSelector: '.grid-item',
		layoutMode: 'masonry'			
	});
		
	jQuery('img').load(function(){
		jQuery('.grid').isotope({
			itemSelector: '.grid-item',
			layoutMode: 'masonry'			
		});
	});
}	

jQuery.noConflict();
jQuery( document ).ready( function($) {
	//hide loading button
	$(".show_image_loading").hide(); 
	//Ajax loadmore product. 
	//Template: wd_product_best_selling.php / wd_product_grid_list.php / wd_product_special_slider.php 
	$(document).on ( 'click', '.btn_loadmore_product', function( event ) {
		event.preventDefault();
		var post_type 				= 'product'; // this is optional and can be set from anywhere, stored in mockup etc...
		var _this 					= $(this);
		var select_item_parent  	= _this.parents('.wd-wrapper-parents-value');
		var select_content_item 	= select_item_parent.find('.wd-products-wrapper').find('.products');
		var offset 					= select_content_item.children().length;

		var random_id 				= $(this).data("random_id");
		var posts_per_page 			= $(this).data("posts_per_page");
		var id_category 			= $(this).data("id_category");
		var data_show 				= $(this).data("data_show");
		var sort 					= $(this).data("sort");
		var order_by 				= $(this).data("order_by");
		$.ajax({
			url: ajax_object.ajax_url,
			type: 'post',
			data: {
				action			: 'load_more_product',
				query_vars		: ajax_object.query_vars,
				offset			: offset, 
				post_type		: post_type,
				posts_per_page	: posts_per_page,
				category_id		: id_category,
				data_show		: data_show,
				sort			: sort,
				order_by		: order_by,
			},

			beforeSend: function(data) {
				$("#show_image_loading_"+random_id).show();
			},
			success: function( response ) {
				$("#show_image_loading_"+random_id).hide();
				select_content_item.append(response);
				if (document.getElementById('tvlgiao_have_post') !=null) {
					var wd_status = select_item_parent.find('#tvlgiao_have_post').val();
					if(wd_status == 1){
						_this.removeClass('btn_loadmore_product').addClass('btn_end_load_more').html('END OF POSTS');
					}
				}
				$('.products .product').find('.wp_description_product.wd_hidden_desc_product').addClass('hidden');
   				$('.products .product').find('.wp_description_product.wd_show_desc_product').removeClass('hidden');

			}
		});
	});

	//Ajax loadmore blog. Template: wd_blog_grid_list.php
	$(document).on ( 'click', '.btn_loadmore_blog', function( event ) {
		event.preventDefault();
		var post_type 						= 'post'; // this is optional and can be set from anywhere, stored in mockup etc...
		var offset 							= $('.wd-shortcode-special-blog .wd-load-more-content-blog').length;

		var random_id 						= $(this).data("random_id");
		var posts_per_page 					= $(this).data("posts_per_page");
		var id_category 					= $(this).data("id_category");
		var data_show 						= $(this).data("data_show");
		var columns 						= $(this).data("columns");
		var show_data_image_slider 			= $(this).data("show_data_image_slider");
		var grid_list_layout 				= $(this).data("grid_list_layout");
		var sort 							= $(this).data("sort");
		var order_by 						= $(this).data("order_by");
		$.ajax({
			url: blog_ajax_object.ajax_url_blog,
			type: 'post',
			data: {
				action						:'load_more_blog',
				query_vars					: ajax_object.query_vars,
				offset						: offset, 
				post_type					: post_type,
				posts_per_page				: posts_per_page,
				category_id					: id_category,
				data_show					: data_show,
				columns 					: columns,
				show_show_data_image_slider	: show_data_image_slider, 
				grid_list_layout			: grid_list_layout,
				sort						: sort,
				order_by					: order_by,
			},

			beforeSend: function(data) {
				$("#show_image_loading_"+random_id).show();
			},
			success: function( response ) {
				$("#show_image_loading_"+random_id).hide();
				$( '.wd-shortcode-special-blog' ).append(response);
				if (document.getElementById('tvlgiao_have_post') !=null) {
					var wd_status = document.getElementById('tvlgiao_have_post').value;
					if(wd_status == 1){
						$("#loadmore a").removeClass('btn_loadmore_product').addClass('btn_end_load_more').html('END OF POSTS');
					}
				}

			}
		});
	});

	//Ajax loadmore blog masonry. Template: wd_blog_mansory.php
	$(document).on ( 'click', '.btn_loadmore_masonry', function( event ) {
		var page 	= 1; // What page we are on.
		var offset 	= $('.grid .grid-item').length;

		var random_id 		= $(this).data("random_id");
		var posts_per_page 	= $(this).data("posts_per_page");
		var columns			= $(this).data("columns");	 

		$('#show_image_loading_'+random_id).css( "display", "block" );
		$( '.grid' ).find( '#wd_status' ).remove();
		jQuery.post(blog_ajax_object.ajax_url_blog, {
			action			: "load_more_post_masonry",
			offset			: offset,
			posts_per_page	: posts_per_page,
			columns			: columns
		}).success(function(posts){
			$("#show_image_loading_"+random_id).css( "display", "none" );
			var $newItems = jQuery(posts);
			jQuery('.grid').append( $newItems ).isotope( 'addItems', $newItems );

			tvlgiao_wpdance_load_isotope();
		
			var $item = $('<div class="grid-item" id="remove-grid-item"></div>');
			jQuery('.grid').append( $item ).isotope( 'addItems', $item );
			tvlgiao_wpdance_load_isotope();
			$( '.grid' ).find( '#remove-grid-item' ).remove();

			var wd_status = document.getElementById('wp_outline_have_post').value;				
			if(wd_status == 0){
				$(".load_more_masonry a").removeClass('btn_loadmore_masonry').addClass('btn_end_load_more_masonry').html('END OF POSTS');
			}
			setTimeout(
			function(){
			    tvlgiao_wpdance_load_isotope();
			}, 1000);						
		});
	});

	//Ajax load product tab. Template: wd_product_by_category_tabs.php
	$( '.products-by-category-tabs a[data-toggle="tab"]' ).on( 'show.bs.tab', function ( e ) {
		const type    				= $( this ).data( 'type' );
		const slug    				= $( this ).data( 'slug' );
		const id      				= $( this ).data( 'id' );
		const sort   				= $( this ).data( 'sort' );
		const orderby 				= $( this ).data( 'orderby' );
		const columns 				= $( this ).data( 'columns' );
		const posts_per_page 		= $( this ).data( 'posts_per_page' );
		const is_slider 			= $( this ).data( 'is_slider' );
		const show_category_thumb 	= $( this ).data( 'show_category_thumb' );
		const show_nav 				= $( this ).data( 'show_nav' );
		const auto_play 			= $( this ).data( 'auto_play' );
		const per_slide 			= $( this ).data( 'per_slide' );

		if ( $( $( this ).attr( 'href' ) ).data( 'load' ) === 'loading' ) {
			const that = $( this );
			$.ajax( {
				url: ajax_object.ajax_url,
				type: 'post',
				data: {
					action				: 'product_by_category_tabs',
					type				: type,
					slug				: slug,
					id					: id,
					sort				: sort,
					orderby				: orderby,
					columns				: columns,
					posts_per_page		: posts_per_page,
					is_slider			: is_slider,
					show_category_thumb	: show_category_thumb,
					show_nav			: show_nav,
					auto_play			: auto_play,
					per_slide			: per_slide,
				},
				error: function ( response ) {
					console.log( response );
				},
				success: function ( response ) {
					$( that.attr( 'href' ) ).html( response );
					$( that.attr( 'href' ) ).data( 'load', 'loaded' ).attr( 'data-load', 'loaded' );
					$('.products .product').find('.wp_description_product.wd_hidden_desc_product').addClass('hidden');
   					$('.products .product').find('.wp_description_product.wd_show_desc_product').removeClass('hidden');
				}
			} );
		}
	} );

});