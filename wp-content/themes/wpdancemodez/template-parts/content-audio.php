<?php

/*
	
@package sunsettheme
-- Audio Post Format

*/

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'wd-wrap-content-blog' ); ?>>
	<?php echo tvlgiao_wpdance_get_content_blog( false, 'audio' ); ?>
</article>