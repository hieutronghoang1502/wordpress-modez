<?php

/*
	
@package sunsettheme
-- Aside Post Format

*/

// $class = get_query_var('post-class');

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'wd-wrap-content-blog' ); ?>>
	<?php echo tvlgiao_wpdance_get_content_blog( false, 'aside' ); ?>
</article>