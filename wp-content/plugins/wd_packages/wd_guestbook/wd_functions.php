<?php
	function wd_guestbook_time_elapsed_string($datetime, $full = false) {
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago' : 'just now';
	}



add_action( 'wp_enqueue_scripts', 'tvlgiao_wpdance_ajax_pagination_scripts_guestbook' );
function tvlgiao_wpdance_ajax_pagination_scripts_guestbook() {
 	wp_enqueue_script( 'wd-ajax-pagination-script-gestbook', plugins_url( '/assets/js/wd_loadmore_js.js', __FILE__ ), array( 'jquery' ) );
 	global $wp_query;

}
// AJAX
add_action('wp_ajax_nopriv_more_post_ajax_guestbook', 'tvlgiao_wpdance_more_post_ajax_guestbook'); 
add_action('wp_ajax_more_post_ajax_guestbook', 'tvlgiao_wpdance_more_post_ajax_guestbook');
function tvlgiao_wpdance_more_post_ajax_guestbook(){ 
	global $wp_outline_wd_data;

	$offset 		= $_POST["offset"];
	$posts_per_page = $_POST["posts_per_page"];
	$columns 		= $_POST["columns"];
	header("Content-Type: text/html");

	wp_reset_postdata();
	$args = array(		
		'post_type' 				=> 'wd_guestbook'
		,'posts_per_page' 			=> $posts_per_page
		,'offset' 					=> $offset
		,'ignore_sticky_posts' 		=> 1
	);
	$posts = new WP_Query($args);
	$span_class = "col-sm-".(24/$columns);
	if( $posts->have_posts() ) { ?>
		<?php $wd_have_post = 1; ?>
		<?php while ( $posts->have_posts() ) : $posts->the_post(); global $post; ?>
			<div class="wd-content-guestbook grid-item <?php echo esc_attr($span_class); ?>">	
				<div class="wd-content-sub">
					<h2 class="wd-heading-title">
						<a><?php the_title(); ?></a>
					</h2>							
					<div class="wd-content-detail-post">
						<?php $excerpt 	= get_the_excerpt(); echo esc_attr($excerpt); ?>
					</div>
					<p><?php echo get_the_date('M d,Y'); ?></p>
				</div>
			</div>
		<?php endwhile;   ?>
	<?php }else{ ?>
	<?php $wd_have_post = 0;?>
	<?php }; ?>
	<div id="wd_status" class="hidden">
		<input type="text" value="<?php echo esc_html( $wd_have_post); ?>" id="wp_outline_have_post">
	</div>
	<?php exit; ?>
<?php }

?>