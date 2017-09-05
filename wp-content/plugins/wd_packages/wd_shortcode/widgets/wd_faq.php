<?php
if( !class_exists( 'tvlgiao_wpdance_widget_faq' ) ) {
	class tvlgiao_wpdance_widget_faq extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_faq', 'description' => esc_html__('FAQs Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('widget_faq', esc_html__('WD - FAQs','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	        $list_category_id	= esc_attr( isset( $instance['list_category_id'] ) ? $instance['list_category_id'] : '-1' );
	        $number_category	= esc_attr( isset( $instance['number_category'] ) ? $instance['number_category'] : '' );
	        $post_per_cat      	= esc_attr( isset( $instance['post_per_cat'] ) ? $instance['post_per_cat'] : '-1' );
	        $sort      			= esc_attr( isset( $instance['sort'] ) ? $instance['sort'] : 'date' );
	        $order_by      		= esc_attr( isset( $instance['order_by'] ) ? $instance['order_by'] : 'DESC' );
	        $class      		= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );

	        $sort_by_arr = array(
				'date'		=> 'Date',
				'name'		=> 'Name',
				'slug'		=> 'Slug'
			);

        	$order_by_arr = array(
				'DESC'		=> 'DESC',
				'ASC'		=> 'ASC'
			);
	        ?>
	            <p>
	                <label for="<?php echo $this->get_field_id( 'list_category_id' ); ?>"><?php esc_html_e( 'List categories ID:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'list_category_id' ); ?>" name="<?php echo $this->get_field_name( 'list_category_id' ); ?>" type="text" value="<?php echo $list_category_id; ?>" placeholder="<?php echo esc_attr__('List Cat ID, separated by commas (-1 for show all categories)', 'wpdancelaparis'); ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'number_category' ); ?>"><?php esc_html_e( 'Number Categories:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'number_category' ); ?>" name="<?php echo $this->get_field_name( 'number_category' ); ?>" type="text" value="<?php echo $number_category; ?>" placeholder="<?php echo esc_attr__('Limited number of categories displayed. Blank if unlimited...', 'wpdancelaparis'); ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'post_per_cat' ); ?>"><?php esc_html_e( 'Post Per Category:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'post_per_cat' ); ?>" name="<?php echo $this->get_field_name( 'post_per_cat' ); ?>" type="text" value="<?php echo $post_per_cat; ?>" placeholder="<?php echo esc_attr__('-1 for show all post', 'wpdancelaparis'); ?>" />
	                </label>
	            </p>


	            <p>
					<label for="<?php echo esc_attr( $this->get_field_id('sort')); ?>"><?php esc_html_e('Sort by:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('sort')); ?>" id="<?php echo esc_attr($this->get_field_id('sort')); ?>">
						<?php foreach( $sort_by_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($sort==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('order_by')); ?>"><?php esc_html_e('Order by:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('order_by')); ?>" id="<?php echo esc_attr($this->get_field_id('order_by')); ?>">
						<?php foreach( $order_by_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($order_by==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

	            

	            <p>
	                <label for="<?php echo $this->get_field_id( 'class' ); ?>"><?php esc_html_e( 'Extra class name:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'class' ); ?>" name="<?php echo $this->get_field_name( 'class' ); ?>" type="text" value="<?php echo $class; ?>" />
	                </label>
	            </p>
	        <?php
	    }
	    function widget( $args, $instance )
	    {
	        extract($args);
	        $list_category_id   = $instance['list_category_id'];
	        $number_category    = $instance['number_category'];
	        $post_per_cat     	= $instance['post_per_cat'];
	        $sort     			= $instance['sort'];
	        $order_by     		= $instance['order_by'];
	        $class      	  	= $instance['class'];

			$args = array(
			    'hide_empty' => true,
			);


			if ($list_category_id != -1) {
				 $args['include']   = explode(',', $list_category_id);
			}
			if ($number_category && $list_category_id == -1) {
				$args['number'] 	= $number_category;
			}


			$faq_categories = get_terms( 'wpdance_faq_categories', $args );
			$count = count($faq_categories);
			
	        echo $before_widget;
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
											'posts_per_page' 	=> $post_per_cat,
											'orderby'			=> $sort,
											'order'				=> $order_by,
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
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['list_category_id']       = strip_tags( $new_instance['list_category_id'] );
	        $instance['number_category']        = strip_tags( $new_instance['number_category'] );
	        $instance['post_per_cat']    		= strip_tags( $new_instance['post_per_cat'] );
	        $instance['sort']    				= strip_tags( $new_instance['sort'] );
	        $instance['order_by']    			= strip_tags( $new_instance['order_by'] );
	        $instance['class']    				= strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_faq() {
		register_widget( 'tvlgiao_wpdance_widget_faq' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_faq' );
}
?>