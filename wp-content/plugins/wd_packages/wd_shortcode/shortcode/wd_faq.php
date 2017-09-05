<?php
if ( ! function_exists( 'tvlgiao_wpdance_faq_function' ) ) {
	function tvlgiao_wpdance_faq_function( $atts ) {
		extract(shortcode_atts( array(
			'ids'					=> -1,
			'posts_per_page'		=> -1,
			'sort'      			=> 'DESC',
			'orderby'    			=> 'date',
			'class'      			=> '',
		), $atts ));

		$args = array(
		    'hide_empty' => true,
		);

		if ($ids != -1) {
			$args['include']   = explode(',', $ids);
		}

		$faq_categories = get_terms( 'wpdance_faq_categories', $args );
		$count = count($faq_categories);
		ob_start();
		if ( $count > 0 ){ ?>
	        <div id="wd-section-faq-template" class="wd-section">
	        	<div class="faqs-content">
	        		<div class="faqs-inner">
	        			<?php if ($count > 1): ?>
	        				<div class="col-md-6">
		        				<ul class="nav nav-tabs">
		        					<?php $i = 1; ?>
		        					<?php foreach ( $faq_categories as $faq_category ) { ?>
		        						<?php $class_active = ($i == 1) ? 'active' : ''; ?>
								        <li class="<?php echo esc_html($class_active); ?>">
				                          <a href="#faq_tab<?php echo $i; ?>" data-toggle="tab"><?php echo esc_html($faq_category->name); ?></a>
				                        </li>
				                        <?php $i++; ?>
								    <?php } ?>
		        				</ul>
		        			</div>
	        			<?php endif ?>
	        			<div class="col-md-<?php echo ($count > 1) ? '18 wd-faq-with-tab' : '24'; ?>">
	        				<div class="tab-content">
	        					<?php $i = 1; ?>
	        					<?php foreach ( $faq_categories as $faq_category ) { ?>
	        						<?php // New blog
									$args = array(  
										'post_type' 		=> 'wpdance_faq',  
										'posts_per_page' 	=> $posts_per_page,
										'order'				=> $sort,
										'orderby'			=> $order_by,
										'tax_query'			=> array(
									    	array(
										    	'taxonomy' 		=> 'wpdance_faq_categories',
												'terms' 		=> $faq_category->term_id,
												'field' 		=> 'term_id',
												'operator' 		=> 'IN'
											)
							   			),
									);
									$special_blogs 		= new WP_Query( $args );
									?>
									<?php $class_active = ($i == 1) ? 'active' : ''; ?>
									<?php if( $special_blogs->have_posts() ) :?>
		        						<!-- Loop tab -->
			        					<div class="tab-pane <?php echo esc_html($class_active); ?>" id="faq_tab<?php echo $i; ?>">
			        						<div class="panel-group" id="accordion<?php echo $i; ?>" role="tablist" aria-multiselectable="true">
			        							
		        								<?php $y = 1; ?>
												<?php while( $special_blogs->have_posts() ) : $special_blogs->the_post(); global $post; ?>
													<?php $class_active_post = ($y == 1) ? 'active' : ''; ?>
			        								<!-- Loop post -->
			        								<div class="panel panel-default">
				        								<div class="panel-heading <?php echo esc_html($class_active_post); ?>" role="tab" id="tab<?php echo $i; ?>_heading<?php echo $y; ?>">
				        									<h4 class="panel-title">
				        										<a class="<?php echo ($y != 1) ? 'collapsed' : ''; ?>" data-toggle="collapse" data-parent="#accordion<?php echo $i; ?>" href="#tab<?php echo $i; ?>_collapse<?php echo $y; ?>" aria-expanded="<?php echo ($y == 1) ? 'true' : 'false'; ?>" aria-controls="tab<?php echo $i; ?>_collapse<?php echo $y; ?>"><i class="more-less fa-icon fa fa-arrow-circle-o-up"></i> 
				        											<?php the_title(); ?>
				        										</a>
				        									</h4>
				        								</div>
				        								<div id="tab<?php echo $i; ?>_collapse<?php echo $y; ?>" class="panel-collapse collapse <?php echo ($y == 1) ? 'in' : ''; ?>" role="tabpanel" aria-labelledby="tab<?php echo $i; ?>_heading<?php echo $y; ?>">
				        									<div class="panel-body">
				        										<?php the_content(); ?>
				        									</div>
				        								</div>
			        								</div>
			        								<!-- end loop post -->
			        								<?php $y++; ?>
		        								<?php endwhile; ?>
		        								<?php wp_reset_query(); ?>
			        						</div>
			        					</div>
		        						<!-- end Loop tab -->
	        						<?php endif; ?>	
	        						<?php $i++; ?>
        						<?php } ?>
	        				</div>
	        			</div>              
	        		</div>
	        	</div>
	        </div>
		<?php
		}
		wp_reset_postdata();
		return ob_get_clean();
	}
}
add_shortcode( 'tvlgiao_wpdance_faq', 'tvlgiao_wpdance_faq_function' );