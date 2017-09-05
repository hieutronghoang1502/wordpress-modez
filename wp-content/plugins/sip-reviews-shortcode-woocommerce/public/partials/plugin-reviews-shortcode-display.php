<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://shopitpress.com
 * @since      1.0.0
 *
 * @package    Sip_Reviews_Shortcode_Woocommerce
 * @subpackage Sip_Reviews_Shortcode_Woocommerce/public/partials
 */

add_shortcode ('woocommerce_reviews', 'sip_review_shortcode_wc' );

	function sip_get_average_rating_for_product( $product_id, $count ) {
		global $wpdb;

		if ( $count ) {
			$ratings = $wpdb->get_var( 

			$wpdb->prepare("
				SELECT SUM(meta_value) from (
					SELECT meta_value 
					FROM $wpdb->commentmeta
					JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
					WHERE meta_key = 'rating'
					AND comment_post_ID = %d
					AND comment_approved = '1'
					AND meta_value > 0
					GROUP BY $wpdb->commentmeta.comment_id
				) t1", $product_id ) 
			);

			$average = number_format( $ratings / $count, 2, '.', '' );
		} else {
			$average = 0;
		}

		return $average;
	}

	/**
	 * TO get aggregate rating
	 *
	 * @since    	1.0.0
	 * @return 		int
	 */
	function sip_wc_product_reviews_pro_get_product_rating_count( $product_id, $rating = null ) {
		global $wpdb;
		$count = $wpdb->get_var(
			$wpdb->prepare("
				SELECT COUNT(meta_value) from (
				SELECT meta_value FROM $wpdb->commentmeta
				LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
				WHERE meta_key = 'rating'
				AND comment_post_ID = %d
				AND comment_approved = '1'
				AND comment_parent = 0
				AND meta_value = %d
				GROUP BY $wpdb->commentmeta.comment_id
				) t1", $product_id, $rating 
			)
		);

		return $count;
	}

	/**
	 * Sortcode function Template
	 *
	 * @since    	1.0.0
	 */
	function sip_review_shortcode_wc( $atts ) {
  	
	  	global $post, $wpdb, $product;
	  	extract( shortcode_atts(
			array(
				'id' 			=> '',
				'no_of_reviews' => '',
				'product_title' => '',
				'sku'			=> '',
			), $atts )
		);

	  	// if number of review not mention in shor coode then defaul value will be assign
		if( $no_of_reviews == "" ){
			$no_of_reviews = 5;
		}

		if ( $id == "" || $id == 0 ) {
			if ( isset( $product->id ) ) {
				
				$id = $product->id;
			}
		}

		if ( $sku != "" ) {
			$id = wc_get_product_id_by_sku( $sku );
		}

  		// if product title is not mention by user in shortcode then get default value
		if( $product_title == "" ) {
			$query 			= "SELECT post_title FROM {$wpdb->prefix}posts p WHERE p.ID = {$id} AND p.post_type = 'product' AND p.post_status = 'publish'";
			$product_title 	= $wpdb->get_var( $query );
		}

		$options 	= get_option( 'color_options' );
	  	$star_color = ( isset( $options['star_color'] ) ) ? sanitize_text_field( $options['star_color'] ) : '';
	  	$bar_color 	= ( isset( $options['bar_color'] ) ) ? sanitize_text_field( $options['bar_color'] ) : '#AD74A2';

	  ?>
	  	<style type="text/css">.star-rating:before, .woocommerce-page .star-rating:before, .star-rating span:before {color: <?php echo $star_color; ?>;}</style>
	  <?php

	  if( $star_color != "" )
	  	$star_color = "style='color:". $star_color .";'";

	  if( $bar_color != "" )
	  	$bar_color = "background-color:".$bar_color .";";

		// To check that post id is product or not
		if( get_post_type( $id ) == 'product' ) {
			ob_start();
			// to get the detail of the comments etc aproved and panding status
			$comments_count = wp_count_comments( $id );
			?>

			<!--Wrapper: Start -->
			<section class="sip-rswc-wrapper"> 
		  		<!--Main Container: Start -->
		  		<section class="main-container">
		    		<aside class="page-wrap" itemscope itemtype="http://schema.org/Product">
		      			<div class="share-wrap">
				      		<?php //It calculate the rating for each star ?>
							<?php $ratings 	= array( 5, 4, 3, 2, 1 ); ?>
							<?php $result	=	0; ?>
							<?php 
								global $wpdb;
								$comments_approved 	= $wpdb->get_var( $wpdb->prepare("
																SELECT COUNT(comment_ID) FROM $wpdb->comments AS c
																WHERE c.comment_approved = 1
																AND c.comment_parent = 0
																AND c.comment_post_ID = %d
																", $id ) );

								if ( $comments_approved == 0 ) {
									$comments_approved = 1;
								}
							?>
							<?php foreach ( $ratings as $rating ) : ?>
								<?php
								if( $comments_count->approved > 0 ) {
									$count 		= sip_wc_product_reviews_pro_get_product_rating_count( $id, $rating );
									$percentage = $count * $rating / $comments_approved ;
									$result 	= $result + $percentage;
								}
								?>
							<?php endforeach; ?>
							<?php $image = ""; ?>
							<?php if (has_post_thumbnail( $id ) ): ?>
							<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'single-post-thumbnail' ); ?>
							<?php endif; ?>
							<!-- it is not for display it is only to generate schema for goolge search result -->
							<div style="display:none;">
								<a href="<?php echo $image[0]; ?>" itemprop="image"><?php echo $product_title; ?></a>
								<span itemprop="name"><?php echo $product_title; ?></span>
								<meta itemprop="url" content="<?php get_permalink( $id ); ?>">
								<div class="star_container" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
									<span itemprop="ratingValue"><?php echo sip_get_average_rating_for_product($id,$comments_approved);; ?></span>
									<span itemprop="bestRating">5</span>
									<span itemprop="ratingCount"><?php echo $comments_approved ?></span>
									<span itemprop="reviewcount" style="display:none;"><?php echo $comments_approved ?></span>
								</div>
								<div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
									<span itemprop="priceCurrency" content="<?php $currency = get_woocommerce_currency(); echo $currency; ?>"><?php echo get_woocommerce_currency_symbol($currency) ?></span>
									<span itemprop="price" content="<?php $get_price = get_post_meta( $id , '_price' ); echo $get_price[0]; ?>"><?php echo get_woocommerce_currency_symbol(); echo $get_price[0]; ?></span>
									<link itemprop="availability" href="http://schema.org/InStock">
								</div>
							</div>

					        <div class="share-left">
					          	<div class="big-text"><?php echo sip_get_average_rating_for_product($id,$comments_approved); ?> out of 5 stars</div>
					          	<div class="sm-text"><?php echo $comments_approved ?> 
						          	<span class="review-icon-image">reviews		
										<?php if(get_option('sip-rswc-affiliate-check-box') == "true") { ?>
											<?php $options = get_option('sip-rswc-affiliate-radio'); ?>
											<?php if( 'value1' == $options['option_three'] ) { $url = "https://shopitpress.com/?utm_source=referral&utm_medium=credit&utm_campaign=sip-reviews-shortcode-woocommerce" ; } ?>
											<?php if( 'value2' == $options['option_three'] ) { $url = "https://shopitpress.com/?offer=". esc_attr( get_option('sip-rswc-affiliate-affiliate-username')) ; } ?>
											<a class="sip-rswc-credit" href="<?php echo $url ; ?>" target="_blank" data-tooltip="These reviews were created with SIP Reviews Shortcode Plugin"></a>
										<?php } ?>
									</span>
								</div>
		        			</div>
					        <div class="share-right">
					          	<div class="product-rating-details">
					          		<table>
						            	<tbody>
											<?php $count 	  = 0 ; ?>
											<?php $percentage = 0 ; ?>
											<?php foreach ( $ratings as $rating ) : ?>
												<?php
												if( $comments_count->approved > 0 ) {
													$count 		= sip_wc_product_reviews_pro_get_product_rating_count( $id, $rating );
													$percentage = $count / $comments_count->approved * 100;
												}
												?>
												<?php $url = get_permalink(); ?>
												<tr>
													<td class="rating-number sip-stars-rating" data-number="<?php echo $rating; ?>">
														<a href="javascript:void(0);" <?php echo $star_color; ?>><?php echo $rating; ?> <span class="fa fa-star"></span></a>
													</td>

													<td class="rating-graph sip-stars-rating" data-number="<?php echo $rating; ?>">
														<a style="float:left; <?php echo $bar_color; ?> width: <?php echo $percentage; ?>%" class="bar" href="javascript:void(0);" title="<?php printf( '%s%%', $percentage ); ?>"></a>
													</td>

													<td class="rating-count sip-stars-rating" data-number="<?php echo $rating; ?>">
														<a href="javascript:void(0);" <?php echo $star_color; ?>><?php echo $count; ?></a>
													</td>

													<td class="rating-count">
														<a href="<?php echo $url; ?>#comments" <?php echo $star_color; ?>></a>
													</td>
												</tr>
											<?php endforeach; ?>            
		            					</tbody>
	          						</table>
	          					</div>
	        				</div>
      					</div>
						<!--Tabs: Start -->
						<aside class="tabs-wrap">
							<div class="page-wrap">
								<div class="tabs-content">
								
								<?php woocommerce_print_reviews( $id , $product_title , $no_of_reviews); ?> 
									
								</div>
							</div>
						</aside>
						<!--Tabs: Start -->				
	    			</aside>
	  			</section>
	  		<!--Main Container: End --> 
		</section>
		<!--Wrapper: End --> 			
		<div style="clear:both"></div>
		<?php
			return ob_get_clean();
		}// end of post id is product or not
	}

	/**
	 * To get limited text comments to dispaly
	 *
	 * @since    	1.0.0
	 * @return 		string 	it is return the 35 chracters of comments 
	 */
	function get_comment_excerpt_trim( $p_id = 0, $comment_ID = 0 ) {
	    $comment 		= get_comment( $comment_ID );
	    $comment_text 	= strip_tags($comment->comment_content);
	   	$blah 			= strlen( $comment_text );

	    if ( get_option('sip-rswc-setting-limit-review-characters') > 0 ) {
	        if ( $blah < get_option('sip-rswc-setting-limit-review-characters') ) {
		        $use_dotdotdot = 0;
		        $excerpt = $comment_text;
	        } else {
	        	$limit = get_option('sip-rswc-setting-limit-review-characters');
	        	$use_dotdotdot = 1;
	        	$excerpt = mb_strimwidth( $comment_text , 0, $limit, "" );

	        }

	    } else {
	        $use_dotdotdot = 0;
	        $excerpt = $comment_text;
	    }
	  
		
	    $excerpt .= ($use_dotdotdot) ? ' <a style="cursor:pointer" class="comment-'.$p_id."-".$comment_ID.'">...Read More</a>' : '';
	 
	    return apply_filters( 'get_comment_excerpt', $excerpt, $comment_ID, $comment );
	}

	/**
	 * To give complete list of comments in ul tag, it ie printing the all data of li
	 *
	 * @since    	1.0.0
	 * @return 		string , mixed html string in $out_reviews
	 */
	function woocommerce_print_reviews( $id = "" , $title = "" , $no_of_reviews = 5 ) {
		$path = ABSPATH . 'wp-config.php';
		$path = str_replace ("\\", "/", $path);
		?>

	    <script>

	      jQuery(document).ready(function($){

	        	$('#sip-rswc-more-<?php echo $id ?>').click(function(){
	            
				var get_last_post_display=$("[id*='li-comment-<?php echo $id ?>-']").last().attr('id'); //get ip last <li>
				var limit	= $('ul.commentlist').attr('id'); //get ip last <li>
				var id 		= <?php echo $id ?>;
				var path 	= "<?php echo $path; ?>";
				var title 	= "<?php echo $title; ?>";
				var data 	= { 'last_id_post': get_last_post_display , 'limit': limit, 'id' : id, 'path' : path, 'title' : title };
				
				$('#sip-rswc-more-<?php echo $id ?>').html('<p align="center"><img src="<?php echo SIP_RSWC_URL; ?>public/img/ajax-loader.gif" ></p>');
	          		$.ajax({
	              		type: "POST",
	              		url: "<?php echo SIP_RSWC_URL; ?>public/more-post.php",
	              		data: data, //send id ip last <li> to more_post.php
	              		cache: false,
	              		success: function( html ) {
	                  		$('ul.commentlist-<?php echo $id ?>').append( html );
	                  		$('#sip-rswc-more-<?php echo $id ?>').text('Load More'); //add text "Load More Post" to button again
	                  		if( html == "" ) {
	                  			$('#sip-rswc-more-<?php echo $id ?>').text('No more comments'); // when last record add text "No more posts to load" to button.
	                  		}
	                  		if ( !html.trim() ) {
							    // is empty or whitespace
							    $('#sip-rswc-more-<?php echo $id ?>').text('No more comments');
							    // $('#sip-rswc-more').remove();
							}
	              		}
	          		});
	        	});

	        	$('.sip-stars-rating').click(function(){
            
					var number 	= $(this).data("number");
					var id		= "<?php echo $id; ?>";
					var title 	= "<?php echo $title; ?>";
					var path 	= "<?php echo $path; ?>";
					
					var data 	= { 'title' : title, 'number': number, 'path' : path, 'id' : id };
		          	$('#sip-rswc-more-<?php echo $id ?>').html('<p align="center"><img src="<?php echo SIP_RSWC_URL; ?>public/img/ajax-loader.gif" ></p>');
		          	$.ajax({                
		              	type: "POST",
		              	url:  "<?php echo SIP_RSWC_URL; ?>public/more-post-rating.php",
		              	data: data,
		              	cache: false,
		              	success: function(html){
		                  	$('.show-everthing').hide();
		                  	$('.sip-rswc-more').hide();
		                  	$('ul.commentlist-<?php echo $id ?>').append(html);
		  					$(".sip-star-rating").each(function () {
								var value = $(this).text();
							 	$(".rating-readonly-"+value).barrating({theme: "fontawesome-stars", readonly:true, initialRating: value });
						  	});
		              	}
		          	});
		        });
	      	});
	    </script>
				
		<?php

			$options 			= get_option( 'color_options' );
		  	$star_color 		= ( isset( $options['star_color'] ) ) ? sanitize_text_field( $options['star_color'] ) : '';
		  	$load_more_button 	= ( isset( $options['load_more_button'] ) ) ? sanitize_text_field( $options['load_more_button'] ) : '';
			$load_more_text 	= ( isset( $options['load_more_text'] ) ) ? sanitize_text_field( $options['load_more_text'] ) : '';

			$review_body_text_color  = ( isset( $options['review_body_text_color'] ) ) ? sanitize_text_field( $options['review_body_text_color'] ) : '';
			$review_background_color = ( isset( $options['review_background_color'] ) ) ? sanitize_text_field( $options['review_background_color'] ) : '';
			$review_title_color 	 = ( isset( $options['review_title_color'] ) ) ? sanitize_text_field( $options['review_title_color'] ) : '';

			if( $star_color != "" )
  				echo '<style type="text/css">.br-theme-fontawesome-stars .br-widget a.br-selected:after {color: '.$star_color.';}</style>';
	  		
	  		$button = 'style="';
	  		if( $load_more_button != "" )
	  			$button .= 'background-color:'. $load_more_button .';';
	  		if( $load_more_text != "" )
	  			$button .= 'color:'. $load_more_text .';';
				$button .= '"';

			  if( $review_title_color != "" )
	  			$review_title_color = "style='color:". $review_title_color .";'";

				$review_background = 'style="';
	  		if( $review_background_color != "" )
	  			$review_background .= 'background-color:'. $review_background_color .';';
	  		if( $review_body_text_color != "" )
	  			$review_background .= 'color:'. $review_body_text_color .';';
				$review_background .= '"';
			
				global $wpdb, $post;
				$query 				= "SELECT c.* FROM {$wpdb->prefix}posts p, {$wpdb->prefix}comments c WHERE p.ID = {$id} AND p.ID = c.comment_post_ID AND c.comment_approved > 0 AND p.post_type = 'product' AND p.post_status = 'publish' AND p.comment_count > 0 AND c.comment_parent = 0 ORDER BY c.comment_date DESC limit {$no_of_reviews}";
				$comments_products 	= $wpdb->get_results($query, OBJECT);
				
				$out_reviews = "";
				if ( $comments_products ) {
					foreach ( $comments_products as $comment_product ) {
						$id_ 			= $comment_product->comment_post_ID;
						$name_author 	= $comment_product->comment_author;
						$comment_id  	= $comment_product->comment_ID;
						$comment_parent = $comment_product->comment_parent;
						$comment_date_ 	= get_comment_date( 'c', $comment_id );
						$comment_date  	= get_comment_date( wc_date_format(), $comment_id );
						$_product 		= wc_get_product( $id_ );
						$rating 		= intval( get_comment_meta( $comment_id, 'rating', true ) );
						// $rating_html 	= $_product->get_rating_html( $rating );
						$user_id	 	= $comment_product->user_id;
						$votes 			= "";
						$avatar 		= "";
						$comment_chield	= "";

					$args = array(
					    'status' 	=> 'approve', 
					    'number' 	=> '5',
					    'post_id' 	=> $id_,
					    'parent' 	=> $comment_id

					);
					$comments 		 = get_comments($args);
					$comments_length = count($comments);
					$iteration    	 = -1;

					$comment_parent_id = $comment_id;

					do {

					if( $comment_parent  > 0 ) {
						$comment_chield = " show-everthing-sub";
					}
					
					$out_reviews .= '<li itemprop="review" itemscope="" itemtype="http://schema.org/Review" id="li-comment-'.$id.'-'.$comment_parent_id.'" class="show-everthing ShowEve '.$comment_chield.'"> 
										<div class="comment-borderbox" '.$review_background.'>';

											if( $comment_parent == 0 ) {
												$out_reviews .=	'<div class="br-wrapper br-theme-fontawesome-stars"><p class="sip-star-rating" style="display:none;">'.$rating.'</p><select class="rating-readonly-'.$rating.'"><option value=""></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div>';

												$out_reviews .=	'<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" style="display:none;">
																					<span itemprop="ratingValue">'.$rating.'</span>
																				</div>';
											}
											
							$out_reviews .=	'<p class="author" '.$review_title_color.'>
												<strong itemprop="author">'.$name_author.'</strong> – <time itemprop="datePublished" datetime="'.$comment_date_.'">'.$comment_date.'</time>
											</p>';

						if ( !get_option('sip-rswc-setting-limit-review-characters') ) {
							
							$out_reviews .= '<div itemprop="description">
												<p style="color:'.$review_body_text_color.'">'.nl2br( get_comment_text( $comment_id ) ).'</p>
											</div>';
						} else {

							$out_reviews .=	'<div itemprop="description">
												<div class="hide-'.$id_."-".$comment_id.'">
													<p style="color:'.$review_body_text_color.'">'.nl2br( get_comment_excerpt_trim( $id_ , $comment_id ) ).'</p>
												</div>
												<p class="comment-'.$id_."-".$comment_id.'-full" style="display:none;color:'.$review_body_text_color.'">'.nl2br( get_comment_text( $comment_id ) ).'</p>
											</div>';
						}

						$out_reviews 	.=	'</div>
									</li>';

					$out_reviews .= '<script>
										jQuery(".comment-'.$id_."-".$comment_id.'").click(function(){
											jQuery(".comment-'.$id_."-".$comment_id.'-full").show();
											jQuery(".hide-'.$id_."-".$comment_id.'").hide();
										});
									</script>';

					++$iteration;
					++$comment_parent;
					if( $comments_length > 0 ) {
						if( !empty($comments[$iteration]->comment_author) ) {
							$name_author = $comments[$iteration]->comment_author;
						}
						if( !empty( $comments[$iteration]->comment_ID ) ) {
							$comment_date = get_comment_date( 'M d, Y', $comments[$iteration]->comment_ID );	
						}
						if( !empty($comments[$iteration]->comment_ID )) {
							$comment_id = $comments[$iteration]->comment_ID;	
						}	
					}
				} while ( $comments_length > $iteration );
			}//end of lop
		} //end of if condition
		if ( $out_reviews != '' ) {
			$out_reviews  = '<ul id="'.$no_of_reviews.'" class="commentbox commentlist commentlist-'. $id .' commentlist_'. $id .'">' . $out_reviews . '</ul><button '. $button .' class="sip-rswc-more" id="sip-rswc-more-'. $id .'" type="button">Load More</button>';
		} else {
			$out_reviews = '<ul class="commentlist"><li><p class="commentbox content-comment">'. __('No products reviews.') . '</p></li></ul>';
		}
		echo $out_reviews;
	}
?>