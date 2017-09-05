<?php
if( post_type_exists('feature') || class_exists('Woothemes_Features') ){
	if( !class_exists( 'tvlgiao_wpdance_widget_feature' ) ) {
		class tvlgiao_wpdance_widget_feature extends WP_Widget{
		    function __construct() {
				$widget_ops 		= array('classname' => 'widget_feature', 'description' => esc_html__('Display single feature...','wpdancelaparis'));
				$control_ops 		= array('width' => 400, 'height' => 350);
				parent::__construct('widget_feature', esc_html__('WD - Feature (Single)','wpdancelaparis'), $widget_ops);
			}
		    function form( $instance )
		    {
		       	
		        $id  					= esc_attr( isset( $instance['id'] ) ? $instance['id'] : '0' );
		        $show_icon_font_thumbnail  	= esc_attr( isset( $instance['show_icon_font_thumbnail'] ) ? $instance['show_icon_font_thumbnail'] : '1' );
		        $icon_fontawesome  		= esc_attr( isset( $instance['icon_fontawesome'] ) ? $instance['icon_fontawesome'] : 'fa-adjust' );
		        $style_font  			= esc_attr( isset( $instance['style_font'] ) ? $instance['style_font'] : 'style-font-1' );
		        $style_thumbnail  		= esc_attr( isset( $instance['style_thumbnail'] ) ? $instance['style_thumbnail'] : 'style-thumbnail-1' );
		        $title  				= esc_attr( isset( $instance['title'] ) ? $instance['title'] : 'yes' );
		        $excerpt  				= esc_attr( isset( $instance['excerpt'] ) ? $instance['excerpt'] : 'yes' );
		        $readmore  				= esc_attr( isset( $instance['readmore'] ) ? $instance['readmore'] : 'yes' );
		        $active  				= esc_attr( isset( $instance['active'] ) ? $instance['active'] : 'no' );
		        
		        $class      			= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );


	        	$feature_options = array();
				$args = array(
					'post_type'			=> 'feature',
					'post_status'		=> 'publish',
					'posts_per_page' 	=> -1
					);
				$feature_options = tvlgiao_wpdance_get_data($args);

				$show_icon_font_thumbnail_arr = array(
					'1'			=> 'Show icon font',
					'0'			=> 'Show thumbnail'
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
						<label for="<?php echo esc_attr( $this->get_field_id('id')); ?>"><?php esc_html_e('Feature ID:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('id')); ?>" id="<?php echo esc_attr($this->get_field_id('id')); ?>">
							<?php foreach( $feature_options as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($id==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
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
		                <label for="<?php echo $this->get_field_id( 'icon_fontawesome' ); ?>"><?php esc_html_e( 'Class Icon:', 'wpdancelaparis' ); ?>
		                <input class="widefat" id="<?php echo $this->get_field_id( 'icon_fontawesome' ); ?>" name="<?php echo $this->get_field_name( 'icon_fontawesome' ); ?>" type="text" value="<?php echo $icon_fontawesome; ?>" placeholder="<?php esc_html_e('Exam: fa-adjust','wpdancelaparis'); ?>; ?>" />
		                <kbd><a href="http://fontawesome.io/icons/"><?php esc_html_e( 'Get here', 'wpdancelaparis' ); ?></a></kbd>
		                </label>
		            </p>
					
					<p>
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
		        $id   	  	  				= $instance['id'];
		        $show_icon_font_thumbnail   = $instance['show_icon_font_thumbnail'];
		        $icon_fontawesome   	  	= $instance['icon_fontawesome'];
		        $style_font   	  			= $instance['style_font'];
		        $style_thumbnail   	  	   	= $instance['style_thumbnail'];
		        $title   	  	   	  		= $instance['title'];
		        $excerpt   	  	   		  	= $instance['excerpt'];
		        $readmore   	  	   		= $instance['readmore'];
		        $active   	  	   			= $instance['active'];
		       
		        $class   	  	  		  	= $instance['class'];

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
				
				if( absint($id) > 0 ){
					$_feature = woothemes_get_features( array('id' => $id,'size' => 'feature-thumbnail' ));
				}elseif( strlen(trim($slug)) > 0 ){
					$_feature = get_page_by_path($slug, OBJECT, 'feature');
					if( !is_null($_feature) ){
						$_feature = woothemes_get_features( array('id' => $_feature->ID,'size' => 'feature-thumbnail' ));
					}else{
						return;
					}
				}else{
					return;
					//invalid input params.
				}
				
				//nothing found
				if( !is_array($_feature) || count($_feature) <= 0 ){
					return;
				}else{
					global $post;
					$_feature = $_feature[0];
					$post = $_feature;
					setup_postdata( $post ); 
				}
				$style = 'style-font-1';
				if($show_icon_font_thumbnail == 1){
					$style = $style_font;
				}else{
					$style = $style_thumbnail;
				}
				$classes[] = 'shortcode-features';
				$classes[] = $class;
				
		        
		        echo $before_widget;
		        ?>
					<div <?php post_class($classes); ?> >	
						<div class="feature_content_wrapper <?php echo esc_attr($style); ?> <?php echo esc_attr($active_class); ?>">	
							<div class="feature_thumbnail_image">
								<?php if( (strcmp(trim($show_icon_font_thumbnail),"1") == 0) ) { ?>
									<div class="feature_icon fa fa-4x fa <?php echo esc_attr($icon_fontawesome); ?>"></div>
								<?php }else{ ?>
								<div class="thumbnail_image">
									<?php
										if( has_post_thumbnail() ) : 
											the_post_thumbnail( 'woo_feature', array( 'alt' => esc_attr(get_the_title()), 'title' => esc_attr(get_the_title()) ) );
										endif;
									?>
								</div>
								<?php } ?>
							</div>
							<div class="feature_information">
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
									<a class='wd-feature-readmore' href="<?php echo esc_url($_feature->url);?>"><?php esc_html_e('Read more','wpdancelaparis'); ?></a>
								<?php endif;?>
							</div>		
						</div>
					</div>

		        <?php
		        echo $after_widget;
		    }
		    function update( $new_instance, $old_instance )
		    {
		        $instance = $old_instance;
		        $instance['id']      	  	= strip_tags( $new_instance['id'] );
		        $instance['show_icon_font_thumbnail'] = strip_tags( $new_instance['show_icon_font_thumbnail'] );
		        $instance['icon_fontawesome'] 	= strip_tags( $new_instance['icon_fontawesome'] );
		        $instance['style_font']   	= strip_tags( $new_instance['style_font'] );
		        $instance['style_thumbnail']= strip_tags( $new_instance['style_thumbnail'] );
		        $instance['title']        	= strip_tags( $new_instance['title'] );
		        $instance['excerpt']      	= strip_tags( $new_instance['excerpt'] );
		        $instance['readmore']     	= strip_tags( $new_instance['readmore'] );
		        $instance['active']       	= strip_tags( $new_instance['active'] );
		       
		        $instance['class']        	= strip_tags( $new_instance['class'] );
		        return $instance;
		    }
		}
		function wp_widget_register_widget_feature() {
			register_widget( 'tvlgiao_wpdance_widget_feature' );
		}
		add_action( 'widgets_init', 'wp_widget_register_widget_feature' );
	}
}
?>