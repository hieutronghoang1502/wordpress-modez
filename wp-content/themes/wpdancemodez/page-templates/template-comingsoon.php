<?php
/*
Template Name: Comingsoon Template
*/
get_header('none'); ?>
<div id="main-content" class="main-content">
	<div class="container">
		<div class="row">
			<!-- Content Index -->
			<div class="col-sm-24">
				<div class="wd-content-page row">
					<div id="primary" class="content-area">
						<main id="main" class="site-main">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>	
							<?php endwhile; ?>
						</main><!-- #main -->
					</div><!-- #primary -->
				</div>
			</div>	
		</div>
	</div>
</div>
<?php get_footer('none'); ?>