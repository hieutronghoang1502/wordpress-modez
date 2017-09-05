<?php
if( post_type_exists('feature') || class_exists('Woothemes_Features') ){
	if( !class_exists( 'tvlgiao_wpdance_widget_feature_category' ) ) {
		class tvlgiao_wpdance_widget_feature_category extends WP_Widget{
		    function __construct() {
				$widget_ops 		= array('classname' => 'widget_feature_category', 'description' => esc_html__('Display feature from category...','wpdancelaparis'));
				$control_ops 		= array('width' => 400, 'height' => 350);
				parent::__construct('widget_feature_category', esc_html__('WD - Feature (Category)','wpdancelaparis'), $widget_ops);
			}
		    function form( $instance )
		    {
		       	
		        $id_category  			= esc_attr( isset( $instance['id_category'] ) ? $instance['id_category'] : '-1' );
		        $show_icon_font_thumbnail  	= esc_attr( isset( $instance['show_icon_font_thumbnail'] ) ? $instance['show_icon_font_thumbnail'] : '1' );
		        $icon_fontawesome  		= esc_attr( isset( $instance['icon_fontawesome'] ) ? $instance['icon_fontawesome'] : '' );
		       /* $style_font  			= esc_attr( isset( $instance['style_font'] ) ? $instance['style_font'] : 'style-font-1' );
		        $style_thumbnail  		= esc_attr( isset( $instance['style_thumbnail'] ) ? $instance['style_thumbnail'] : 'style-thumbnail-1' );*/
		        $position  				= esc_attr( isset( $instance['position'] ) ? $instance['position'] : 'text-center' );
		        $show_grid_list			= esc_attr( isset( $instance['show_grid_list'] ) ? $instance['show_grid_list'] : 'grid' );
		        $sort      				= esc_attr( isset( $instance['sort'] ) ? $instance['sort'] : '' );
		        $order_by      			= esc_attr( isset( $instance['order_by'] ) ? $instance['order_by'] : '' );
		        $number  				= esc_attr( isset( $instance['number'] ) ? $instance['number'] : '6' );
		        $columns      			= esc_attr( isset( $instance['columns'] ) ? $instance['columns'] : '3' );
		        $title  				= esc_attr( isset( $instance['title'] ) ? $instance['title'] : 'yes' );
		        $excerpt  				= esc_attr( isset( $instance['excerpt'] ) ? $instance['excerpt'] : 'yes' );
		        $readmore  				= esc_attr( isset( $instance['readmore'] ) ? $instance['readmore'] : 'yes' );
		        $active  				= esc_attr( isset( $instance['active'] ) ? $instance['active'] : 'no' );
		        
		        $class      			= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );


	        	$feature_options = array();
				$feature_options[-1] = esc_html__('All Category','wpdancelaparis');
				$categories = 	get_terms( 'feature-category', 
											array('hide_empty' 	=> 0)
										 );
				foreach ($categories as $category ) {
					$feature_options[$category->term_id] = $category->slug;
				}
				wp_reset_postdata();

				$show_icon_font_thumbnail_arr = array(
					'1'			=> 'Show icon font',
					'2'			=> 'Show thumbnail',
					'0'			=> 'Hide icon/thumbnail'
				);

				$position_arr = array(
				'text-center'	=> 'Center aligned text',
				'text-left'		=> 'Left aligned text',
				'text-right'	=> 'Right aligned text',
				'text-justify'	=> 'Justified text',
				'text-nowrap'	=> 'No wrap text',
			);

				$style_font_arr = array(
					'style-font-1'	=> 'Style Icon 1',
					'style-font-2'	=> 'Style Icon 2',
					'style-font-3'	=> 'Style Icon 3',
					'style-font-4'	=> 'Style Icon 4',
					'style-font-5'	=> 'Style Icon 5',
					'style-font-6'	=> 'Style Icon 6',
					'style-font-7'	=> 'Style Icon 7',
					'style-font-8'	=> 'Style Icon 8',
					'style-font-9'	=> 'Style Icon 9',
					'style-font-10'	=> 'Style Icon 10',
				);

				$style_thumbnail_arr = array(
					'style-thumbnail-1'	=> 'Style Thumbnail 1',
					'style-thumbnail-2'	=> 'Style Thumbnail 2',
					'style-thumbnail-3'	=> 'Style Thumbnail 3',
					'style-thumbnail-4'	=> 'Style Thumbnail 4',
					'style-thumbnail-5'	=> 'Style Thumbnail 5',
					'style-thumbnail-6'	=> 'Style Thumbnail 6',
					'style-thumbnail-7'	=> 'Style Thumbnail 7',
					'style-thumbnail-8'	=> 'Style Thumbnail 8',
				);

				$show_grid_list_arr = array(
					'grid'				=> 'Grid',
					'list'				=> 'List',
				);

				$sort_by_arr = array(
					'date'		=> 'Date',
					'name'		=> 'Name',
					'slug'		=> 'Slug'
				);
				$order_by_arr = array(
					'DESC'		=> 'DESC',
					'ASC'		=> 'ASC'
				);

				$columns_arr = array(
					'1'	=> '1 Columns',
					'2'	=> '2 Columns',
					'3'	=> '3 Columns',
					'4'	=> '4 Columns'
				);

				$yes_no = array(
					"yes" 			=> "Yes",
					"no" 			=> "No",
				); 

				$no_yes = array(
					"no" 			=> "No",
					"yes" 			=> "Yes"	
				); 


		        ?>
		            <p>
						<label for="<?php echo esc_attr( $this->get_field_id('id_category')); ?>"><?php esc_html_e('Feature Category ID:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('id_category')); ?>" id="<?php echo esc_attr($this->get_field_id('id_category')); ?>">
							<?php foreach( $feature_options as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($id_category==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>

					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('show_icon_font_thumbnail')); ?>"><?php esc_html_e('Show thumbnail or icon font:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_icon_font_thumbnail')); ?>" id="<?php echo esc_attr($this->get_field_id('show_icon_font_thumbnail')); ?>">
							<?php foreach( $show_icon_font_thumbnail_arr as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_icon_font_thumbnail==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>

					<p>
		                <label for="<?php echo $this->get_field_id( 'icon_fontawesome' ); ?>"><?php esc_html_e( 'List Class Icon (Separated by commas):', 'wpdancelaparis' ); ?>
		                <input class="widefat" id="<?php echo $this->get_field_id( 'icon_fontawesome' ); ?>" name="<?php echo $this->get_field_name( 'icon_fontawesome' ); ?>" type="text" value="<?php echo $icon_fontawesome; ?>" placeholder="<?php esc_html_e('Exam: fa-pencil-square-o, fa-flag, fa-television, fa-picture-o, fa-cart-plus, fa-diamond','wpdancelaparis'); ?>" />
		                <kbd><a href="http://fontawesome.io/icons/"><?php esc_html_e( 'Get here', 'wpdancelaparis' ); ?></a></kbd>
		                </label>
		            </p>
					
					<!-- <p>
						<label for="<?php echo esc_attr( $this->get_field_id('style_font')); ?>"><?php esc_html_e('Style Font Icon:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('style_font')); ?>" id="<?php echo esc_attr($this->get_field_id('style_font')); ?>">
							<?php foreach( $style_font_arr as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($style_font==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>
					
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('style_thumbnail')); ?>"><?php esc_html_e('Style Thumbnail:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('style_thumbnail')); ?>" id="<?php echo esc_attr($this->get_field_id('style_thumbnail')); ?>">
							<?php foreach( $style_thumbnail_arr as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($style_thumbnail==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p> -->

					<p>
					<label for="<?php echo esc_attr( $this->get_field_id('position')); ?>"><?php esc_html_e('Text Align:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('position')); ?>" id="<?php echo esc_attr($this->get_field_id('position')); ?>">
						<?php foreach( $position_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($position==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('show_grid_list')); ?>"><?php esc_html_e('Show Grid/List:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_grid_list')); ?>" id="<?php echo esc_attr($this->get_field_id('show_grid_list')); ?>">
							<?php foreach( $show_grid_list_arr as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_grid_list==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
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
		                <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number Feature:', 'wpdancelaparis' ); ?>
		                <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" />
		                </label>
		            </p>

		            <p>
						<label for="<?php echo esc_attr( $this->get_field_id('columns')); ?>"><?php esc_html_e('Columns:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('columns')); ?>" id="<?php echo esc_attr($this->get_field_id('columns')); ?>">
							<?php foreach( $columns_arr as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($columns==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>

					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('title')); ?>"><?php esc_html_e('Show Feature Title:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>">
							<?php foreach( $yes_no as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($title==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>

					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('excerpt')); ?>"><?php esc_html_e('Show Excerpt:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('excerpt')); ?>" id="<?php echo esc_attr($this->get_field_id('excerpt')); ?>">
							<?php foreach( $yes_no as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($excerpt==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>

					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('readmore')); ?>"><?php esc_html_e('Show Readmore:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('readmore')); ?>" id="<?php echo esc_attr($this->get_field_id('readmore')); ?>">
							<?php foreach( $no_yes as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($readmore==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>

					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('active')); ?>"><?php esc_html_e('Active:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('active')); ?>" id="<?php echo esc_attr($this->get_field_id('active')); ?>">
							<?php foreach( $no_yes as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($active==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
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
		        $id_category   	  	  		= $instance['id_category'];
		        $show_icon_font_thumbnail   = $instance['show_icon_font_thumbnail'];
		        $icon_fontawesome   	  	= $instance['icon_fontawesome'];
		        /*$style_font   	  			= $instance['style_font'];
		        $style_thumbnail   	  	   	= $instance['style_thumbnail'];*/
		        $position   	  	  	  	= isset($instance['position']) ? $instance['position'] : 'text-center';;
		        $show_grid_list				= isset($instance['show_grid_list']) ? $instance['show_grid_list'] : 'grid';
		        $sort    					= isset($instance['sort']) ? $instance['sort'] : 'term_id';
		        $order_by    				= isset($instance['order_by']) ? $instance['order_by'] : 'DESC';
		        $number   	  	   			= $instance['number'];
		        $columns    				= isset($instance['columns']) ? $instance['columns'] : '3';
		        $title   	  	   	  		= $instance['title'];
		        $excerpt   	  	   		  	= $instance['excerpt'];
		        $readmore   	  	   		= $instance['readmore'];
		        $active   	  	   			= $instance['active'];
		        $class   	  	  		  	= $instance['class'];

		        $list_icon_font = explode(',', $icon_fontawesome);
		        $title 		= strcmp('yes',$title) 		== 0 ? 1 : 0; 
				$excerpt 	= strcmp('yes',$excerpt) 	== 0 ? 1 : 0;
				$readmore 	= strcmp('yes',$readmore) 	== 0 ? 1 : 0;
				
				$active_class = "";
				if($active == "yes"){
					$active_class = "feature_active";
				}

				$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
				if ( !in_array( "features-by-woothemes/woothemes-features.php", $_actived ) ) {
					return;
				}
				

				$args = array(  
					'post_type' 		=> 'feature',  
					'posts_per_page' 	=> $number,
					'orderby' 			=> $sort,
					'order'				=> $order_by,
				);
				//Category
				if( $id_category != -1 ){
					$args['tax_query']= array(
				    	array(
					    	'taxonomy' 		=> 'feature-category',
							'terms' 		=> $id_category,
							'field' 		=> 'term_id',
							'operator' 		=> 'IN'
						)
		   			);
				}

				$features_list 		= new WP_Query( $args );
				$grid_list_class 	= "wd-grid-style";
				if($show_grid_list == 'list'){
					$grid_list_class = "wd-list-style";
				}
				$span_class 		= "col-md-".(24/$columns);

				$classes[] = 'shortcode-features';
				$classes[] = $span_class;
				$classes[] = $class;
				
		        
		        echo $before_widget;
		        ?>
		        <?php if( $features_list->have_posts() ) :?>
	        		<?php $i = 0; ?>
		        	<div class='row wd-feature-category wd-feature-category-wrapper <?php echo esc_html($class); ?> <?php echo esc_html($grid_list_class); ?>'>
						<?php while( $features_list->have_posts() ) : $features_list->the_post(); global $post; ?>
							<div <?php post_class($classes); ?> >	
								<div class="feature_content_wrapper  <?php echo esc_attr($active_class); ?>">	
									<?php if( (strcmp(trim($show_icon_font_thumbnail),"1") == 0) ) { ?>
										<?php if ($list_icon_font[$i]): ?>
											<div class="feature_thumbnail_image">
												<div class="feature_icon fa fa-4x fa <?php echo esc_attr($list_icon_font[$i]); ?>"></div>
											</div>
										<?php endif ?>
									<?php }elseif( (strcmp(trim($show_icon_font_thumbnail),"2") == 0) ){ ?>
										<div class="feature_thumbnail_image">
											<div class="thumbnail_image">
												<?php
													if( has_post_thumbnail() ) : 
														the_post_thumbnail( 'woo_feature', array( 'alt' => esc_attr(get_the_title()), 'title' => esc_attr(get_the_title()) ) );
													endif;
												?>
											</div>
										</div>
									<?php } ?>
									
									<div class="feature_info <?php echo esc_html($position); ?>">
										<?php if( $title ) :?>
											<h3 class="feature_title heading_title">
												<?php the_title(); ?>
											</h3>
										<?php endif;?>
											
										<?php if( $excerpt ) :?>
											<div class="feature_excerpt">
												<?php the_content(); ?>
											</div>
										<?php endif;?>
										<?php if( $readmore ) :?>
											<a class='wd-feature-readmore' href="<?php echo esc_url(the_permalink());?>"><?php esc_html_e('Read more','wpdancelaparis'); ?></a>
										<?php endif;?>
									</div>		
								</div>
							</div>
							<?php $i++; ?>
						<?php endwhile; ?>			
					</div>
				<?php endif; ?>
		        <?php
		        echo $after_widget;
		    }
		    function update( $new_instance, $old_instance )
		    {
		        $instance = $old_instance;
		        $instance['id_category']    = strip_tags( $new_instance['id_category'] );
		        $instance['show_icon_font_thumbnail'] = strip_tags( $new_instance['show_icon_font_thumbnail'] );
		        $instance['icon_fontawesome'] 	= strip_tags( $new_instance['icon_fontawesome'] );
		       /* $instance['style_font']   	= strip_tags( $new_instance['style_font'] );
		        $instance['style_thumbnail']= strip_tags( $new_instance['style_thumbnail'] );*/
		        $instance['position']      	= strip_tags( $new_instance['position'] );
		        $instance['show_grid_list'] = strip_tags( $new_instance['show_grid_list'] );
		        $instance['sort']        	= strip_tags( $new_instance['sort'] );
		        $instance['order_by']       = strip_tags( $new_instance['order_by'] );
		        $instance['number']			= strip_tags( $new_instance['number'] );
		        $instance['columns']        = strip_tags( $new_instance['columns'] );
		        $instance['title']        	= strip_tags( $new_instance['title'] );
		        $instance['excerpt']      	= strip_tags( $new_instance['excerpt'] );
		        $instance['readmore']     	= strip_tags( $new_instance['readmore'] );
		        $instance['active']       	= strip_tags( $new_instance['active'] );
		       
		        $instance['class']        	= strip_tags( $new_instance['class'] );
		        return $instance;
		    }
		}
		function wp_widget_register_widget_feature_category() {
			register_widget( 'tvlgiao_wpdance_widget_feature_category' );
		}
		add_action( 'widgets_init', 'wp_widget_register_widget_feature_category' );
	}
}
?>