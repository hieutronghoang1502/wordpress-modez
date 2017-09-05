jQuery( document ).ready( function ( $ ) {
	"use strict";

	/**
	 *  Isotope Layout
	 */
	var $grid = $( '.grid-isotope' ).isotope( {
		itemSelector: '.grid-item',
		percentPosition: true,
		layoutMode: $( '.grid-isotope' ).data( 'layout' ),
	} );

	/**
	 *  Portfolio Grid
	 */
	$( document ).on( 'click', '.btn_loadmore_grid_portfolio', function ( event ) {
		event.preventDefault();
		var that                = $( this );
		var select_content_item = $( this ).parents( '.wd-wrapper-special-grid' ).find( '.wd-portfolio-content' );
		var offset              = select_content_item.children().length;

		var posts_per_page = $( this ).data( 'number' );
		var id_category    = $( this ).data( 'id-category' );
		var columns        = $( this ).data( 'columns' );
		var style          = $( this ).data( 'style' );
		var tab_rand       = $( this ).data( 'tab-rand' );

		$.ajax( {
			url: portfolio_gird_ajax_object.ajax_url_portfolio_gird,
			type: 'post',
			data: {
				action: 'load_more_portfolio_gird',
				post_type: 'portfolio',
				query_vars: ajax_object.query_vars,
				offset: offset,
				posts_per_page: posts_per_page,
				category_id: id_category,
				columns: columns,
				style: style,
				tab_rand: tab_rand,
			},

			beforeSend: function () {
				$( ".show_image_loading" ).css( 'display', 'block' );
			},
			error: function ( response ) {
				console.log( response );
			},
			success: function ( response ) {
				$( ".show_image_loading" ).css( 'display', 'none' );

				if ( response === '0' ) {
					that.parent().html( '<span>END OF POSTS</span>' );
				} else {
					select_content_item.append( response );
				}
			}
		} );
	} );

	/**
	 *  Portfolio Masonry
	 */
	$( document ).on( 'click', '.btn_loadmore_masonry_portfolio', function ( event ) {
		event.preventDefault();
		var select_content_item_parent = $( this ).parents( '.wd-shortcode-masonry-portfolio' );
		var grid_isotope               = select_content_item_parent.find( '.grid-isotope' );
		var offset                     = grid_isotope.children().length;
		var posts_per_page             = $( this ).data( 'number' );
		var id_category                = $( this ).data( 'id-category' );
		var columns                    = $( this ).data( 'columns' );
		var sort                   	   = $( this ).data( 'sort' );
		var order_by                   = $( this ).data( 'order_by' );
		var image_size                 = $( this ).data( 'image_size' );
		var tab_rand                   = $( this ).data( 'tab-rand' );
		var style                      = $( this ).data( 'style' );
		var width_rand                 = $( this ).data( 'width-rand' );
		var layout_mode                = $( this ).data( 'layout-mode' );

		$.ajax( {
			url: portfolio_gird_ajax_object.ajax_url_portfolio_gird,
			type: 'post',
			data: {
				action: 'more_portfolio_masonry_ajax', 
				offset: offset,
				posts_per_page: posts_per_page,
				columns: columns,
				sort: sort,
				order_by: order_by,
				image_size: image_size,
				style: style,
				tab_rand: tab_rand,
				layout_mode: layout_mode,
				random_width: width_rand,
			},
			beforeSend: function () {
				$( ".show_image_loading" ).css( 'display', 'block' );
			},
			error: function ( response ) {
				console.log( response );
			},
			success: function ( response ) {
				$( ".show_image_loading" ).css( 'display', 'none' );

				if ( response === '0' ) {
					$( ".load_more_masonry" ).html( '<span>END OF POSTS</span>' );
				} else {

					var $response = $( response );
					grid_isotope.append( $response );
					$grid.isotope( 'appended', $response );

					setTimeout(
						function(){
							$grid.isotope( 'layout' );
						}, 1200
					);
				}
			}
		} );
	} );

	/**
	 *  Fancybox Gallery
	 */
	$( '.wd-fancybox-thumbs' ).fancybox( {
		openEffect: 'elastic',
		closeEffect: 'elastic',
		closeBtn: false,

		helpers: {
			thumbs: {
				width: 50,
				height: 50
			},
			media: {},
			buttons: {},

			overlay: {
				css: {
					'background': 'rgba(153, 174, 195, 0.85)'
				}
			}
		},

		beforeShow: function () {
			this.title = $( this.element ).data( "caption" );
		}
	} );
} );