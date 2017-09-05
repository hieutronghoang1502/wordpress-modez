<?php
if(!function_exists('tvlgiao_wpdance_recent_comment_function')){
	function tvlgiao_wpdance_recent_comment_function($atts,$content){
		extract(shortcode_atts(array(
			'title'					=> '',
			'number_limit'			=> 20,
			'number'				=> 4,
			'show_avatar'			=> '1',
			'show_author'			=> '1' ,
			'is_slider'				=> '1',
			'show_nav'				=> '1',
			'auto_play'				=> '1',
			'per_slide'				=> 2
		),$atts));
		$args = array( 	
			'number' 		=> $number, 
			'status' 		=> 'approve', 
			'post_status' 	=> 'publish', 
			'comment_type' 	=> ''
		);
		$comments = get_comments( $args );
		ob_start();
		$random_id = 'wd_widget_recent_comments_wrapper_'.mt_rand();
		if ( $comments ) {
			$num_comment = count($comments);
			if( $num_comment < 2 || $num_comment <= $per_slide ){
				$is_slider = 0;
			}
			?>
			<div class="wd_recent_comments_wrapper recent-comments <?php echo ($show_nav)?'has_navi':''; ?>" id="<?php echo esc_attr( $random_id ); ?>">
				<?php if($title != "") : ?>
					<div class="wd-title">
						<h2><?php echo esc_attr( $title ); ?></h2>
					</div>
				<?php endif; ?>
				<div class="widget_list_comment_inner">
			<?php
			$count = 0;	
			foreach ( (array) $comments as $comment) {
				$GLOBALS['comment'] = $comment;
				if ($count == 0 || $count % $per_slide == 0 ){
				?>
					<div class="widget_per_slide">
						<ul>
					<?php } ?>
						<li>
							<div class="detail">
								<?php if( $show_avatar ){ ?>
									<div class="avatar">
										<a href="<?php comment_link() ; ?>"><?php echo get_avatar( $comment->comment_author_email, get_option('woo_shortcode_size_w')  ); ?></a>
									</div>
								<?php } ?>
								<div class="wd-content-comment">
									<p class="comment-body"><?php echo tvlgiao_wpdance_string_limit_words(get_comment_text(),$number_limit); ?></p>
									<?php if( $show_author ){ ?>
										<span class="author"><a href="<?php echo (get_comment_author_url()=='')?'javascript: void(0)':get_comment_author_url(); ?>" class="url" rel="external nofollow"><?php echo esc_attr( $comment->comment_author ); ?></a></span>
									<?php } ?>
								</div>
							</div>
						</li>
					<?php $count++; if( $count % $per_slide == 0 || $count == $num_comment){ ?>
						</ul>
					</div>
				<?php
				}
			}
			?>
				</div>
			<?php if( $show_nav && $is_slider ){ ?>
				<div class="slider_control">
					<a href="#" class="prev">&lt;</a>
					<a href="#" class="next">&gt;</a>
				</div>
				<?php } ?>
			</div>
			<?php
		}
		
		if( $is_slider ){ ?>
			<script type="text/javascript">
			jQuery(document).ready(function(){
					"use strict";
					
					var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
					var _auto_play = <?php echo esc_attr( $auto_play ); ?>;
					var owl = $_this.find('.widget_list_comment_inner').owlCarousel({
						loop : true,
						items : 1,
						nav : false,
						dots : false,
						navSpeed : 1000,
						slideBy: 1,
						rtl:jQuery('body').hasClass('rtl'),
						navRewind: false,
						autoplay: _auto_play,
						autoplayTimeout: 5000,
						autoplayHoverPause: true,
						autoplaySpeed: false,
						mouseDrag: true,
						touchDrag: true,
						responsiveBaseElement: $_this,
						responsiveRefreshRate: 1000,
						onInitialized: function(){
						}
					});
					$_this.on('click', '.next', function(e){
						e.preventDefault();
						owl.trigger('next.owl.carousel');
					});

					$_this.on('click', '.prev', function(e){
						e.preventDefault();
						owl.trigger('prev.owl.carousel');
					});
				});
			</script>
		<?php }
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;		
	}
}
add_shortcode('tvlgiao_wpdance_recent_comment','tvlgiao_wpdance_recent_comment_function');
?>