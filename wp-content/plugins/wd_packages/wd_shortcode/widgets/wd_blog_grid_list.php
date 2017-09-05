<?php
if( !class_exists( 'tvlgiao_wpdance_widget_blog_grid_list' ) ) {
	class tvlgiao_wpdance_widget_blog_grid_list extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_blog_grid_list', 'description' => esc_html__('Blog Grid/List Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('blog_grid_list', esc_html__('WD - Blog Grid/List','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	        $id_category   				= esc_attr( isset( $instance['id_category'] ) ? $instance['id_category'] : '-1' );
	        $data_show      			= esc_attr( isset( $instance['data_show'] ) ? $instance['data_show'] : 'recent_blog' );
	        $number_blogs				= esc_attr( isset( $instance['number_blogs'] ) ? $instance['number_blogs'] : '12' );
	        $show_data_image_slider		= esc_attr( isset( $instance['show_data_image_slider'] ) ? $instance['show_data_image_slider'] : '1' );
	        $grid_list_layout			= esc_attr( isset( $instance['show_grid_list'] ) ? $instance['show_grid_list'] : 'grid' );
	        $sort      					= esc_attr( isset( $instance['sort'] ) ? $instance['sort'] : '' );
	        $order_by      				= esc_attr( isset( $instance['order_by'] ) ? $instance['order_by'] : '' );
	        $columns      				= esc_attr( isset( $instance['columns'] ) ? $instance['columns'] : '1' );
	        $pagination_loadmore       	= esc_attr( isset( $instance['pagination_loadmore'] ) ? $instance['pagination_loadmore'] : '1' );
	        $number_loadmore      		= esc_attr( isset( $instance['number_loadmore'] ) ? $instance['number_loadmore'] : '8' );
	        $class      				= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );


			$blog_category = array();
			$blog_category[-1] = esc_html__('All Category','wpdancelaparis');
			$categories = 	get_terms( 'category', 
				array('hide_empty' 	=> 0)
			 );
			foreach ($categories as $category ) {
				$blog_category[$category->term_id] = $category->slug;
			}
			wp_reset_postdata();

			$data_show_arr = array(
				'recent_blog'		=> 'Recent Blog',
				'mostview_blog'		=> 'Most View Blog',
				'comment_blog'		=> 'Most Comment',
			);

			$show_data_image_slider_arr = array(
				'1'		=> 'Show Thumbnail Style For All Post',
				'0'		=> 'Show Post Format Style (Video, Audio...)',
			);

			$grid_list_layout_arr = array(
				'grid'				=> 'Grid',
				'grid-mansory'		=> 'Grid 2 (Masonry Style)',
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

			$pagination_loadmore_arr = array(
				'1'	=> 'Pagination',
				'0'	=> 'Load More',
				'2'	=> 'No Show',
			);

	        ?>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('id_category')); ?>"><?php esc_html_e('Select Category:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('id_category')); ?>" id="<?php echo esc_attr($this->get_field_id('id_category')); ?>">
						<?php foreach( $blog_category as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($id_category==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>
			
	            <p>
					<label for="<?php echo esc_attr( $this->get_field_id('data_show')); ?>"><?php esc_html_e('Data Show:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('data_show')); ?>" id="<?php echo esc_attr($this->get_field_id('data_show')); ?>">
						<?php foreach( $data_show_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($data_show==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
	                <label for="<?php echo $this->get_field_id( 'number_blogs' ); ?>"><?php esc_html_e( 'Number of blogs:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'number_blogs' ); ?>" name="<?php echo $this->get_field_name( 'number_blogs' ); ?>" type="text" value="<?php echo $number_blogs; ?>" />
	                </label>
	            </p>

	            <p>
					<label for="<?php echo esc_attr( $this->get_field_id('show_data_image_slider')); ?>"><?php esc_html_e('Thumbnail Style','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_data_image_slider')); ?>" id="<?php echo esc_attr($this->get_field_id('show_data_image_slider')); ?>">
						<?php foreach( $show_data_image_slider_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_data_image_slider==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('show_grid_list')); ?>"><?php esc_html_e('Show Grid/List:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_grid_list')); ?>" id="<?php echo esc_attr($this->get_field_id('show_grid_list')); ?>">
						<?php foreach( $grid_list_layout_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($grid_list_layout==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
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
					<label for="<?php echo esc_attr( $this->get_field_id('columns')); ?>"><?php esc_html_e('Columns:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('columns')); ?>" id="<?php echo esc_attr($this->get_field_id('columns')); ?>">
						<?php foreach( $columns_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($columns==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('pagination_loadmore')); ?>"><?php esc_html_e('Show Pagination Or Load More:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('pagination_loadmore')); ?>" id="<?php echo esc_attr($this->get_field_id('pagination_loadmore')); ?>">
						<?php foreach( $pagination_loadmore_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($pagination_loadmore==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
	                <label for="<?php echo $this->get_field_id( 'number_loadmore' ); ?>"><?php esc_html_e( 'Number blogs Load More:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'number_loadmore' ); ?>" name="<?php echo $this->get_field_name( 'number_loadmore' ); ?>" type="text" value="<?php echo $number_loadmore; ?>" />
	                </label>
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
	        $id_category  	= ($instance['id_category']) ? $instance['id_category'] : '-1';
	        $data_show    	= ($instance['data_show']) ? $instance['data_show'] : 'recent_blog';
	        $number_blogs	= ($instance['number_blogs']) ? $instance['number_blogs'] : '12';
	        $show_data_image_slider	= ($instance['show_data_image_slider']) ? $instance['show_data_image_slider'] : '1';
	        $grid_list_layout	= ($instance['show_grid_list']) ? $instance['show_grid_list'] : 'grid';
	        $sort    		= ($instance['sort']) ? $instance['sort'] : 'term_id';
	        $order_by    	= ($instance['order_by']) ? $instance['order_by'] : 'DESC';
	        $columns    	= ($instance['columns']) ? $instance['columns'] : '1';
	        $pagination_loadmore    = ($instance['pagination_loadmore']) ? $instance['pagination_loadmore'] : '0';
	        $number_loadmore    	= ($instance['number_loadmore']) ? $instance['number_loadmore'] : '8';
	        $class   	  	= $instance['class'];


	        // New blog
			$args = array(  
				'post_type' 		=> 'post',  
				'posts_per_page' 	=> $number_blogs,
				'orderby' 			=> $sort,
				'order'				=> $order_by,
				'paged' 			=> get_query_var('paged')
			);
			//Category
			if( $id_category != -1 ){
				$args['tax_query']= array(
			    	array(
				    	'taxonomy' 		=> 'category',
						'terms' 		=> $id_category,
						'field' 		=> 'term_id',
						'operator' 		=> 'IN'
					)
	   			);
			}
			//Most View Products
			if($data_show == 'mostview_blog'){
				$args['meta_key'] 	= '_wd_post_views_count';
				$args['orderby'] 	= 'meta_value_num';
				$args['order'] 		= 'DESC';
			}
			//Most Comment
			if($data_show == 'comment_blog'){
				$args['orderby']		= 'comment_count';
			}	
			$special_blogs 		= new WP_Query( $args );
			$grid_list_class 	= "wd-gird-style";
			if($grid_list_layout == 'list'){
				$grid_list_class = "wd-list-style";
			}
			$span_class 		= "col-sm-".(24/$columns);

			$random_id = 'wd-special-blog-widget-'.rand(0,1000).time();	

	        echo $before_widget;
	        ?>
            <?php if( $special_blogs->have_posts() ) :?>
            	<?php 
					$class_masonry 		= ($grid_list_layout == 'grid-masonry') ? 'post_mansory' : '';
					$class_masonry_item = ($grid_list_layout == 'grid-masonry') ? 'gallery_item' : '';
					$image_size 		= ($columns == 1 || $grid_list_layout == 'grid-masonry') ? 'full' : 'post-thumbnail';
				?>
				<div id="<?php echo esc_html($random_id); ?>" class='wd-shortcode-special-blog wd-related-wrapper content_blog <?php echo esc_html($class); ?> <?php echo esc_html($grid_list_class); ?> <?php echo esc_attr($class_masonry);?>'>
					<?php while( $special_blogs->have_posts() ) : $special_blogs->the_post(); global $post; ?>
						<div class="wd-load-more-content-blog <?php echo esc_attr($span_class);?> <?php echo esc_attr($class_masonry_item);?> ">
							<?php if ($show_data_image_slider == "1"): ?>
								<?php echo tvlgiao_wpdance_get_content_blog($image_size); ?>
							<?php else: ?>
								<?php echo tvlgiao_wpdance_get_content_blog($image_size, get_post_format()); ?>
							<?php endif ?>
						</div>					
					<?php endwhile; ?>			
				</div>
				<div class="clear"></div>
				<?php if($pagination_loadmore == "1") : ?>
					<div class="wd-pagination col-sm-24">
						<?php tvlgiao_wpdance_pagination(3, $special_blogs) ?>
					</div>
				<?php endif; ?>
				<?php if($pagination_loadmore == "0") : ?>
					<div class="wd-loadmore">
						<div class="show_image_loading" id="show_image_loading_<?php echo esc_html($random_id); ?>">
							<img src="<?php echo SC_IMAGE.'/ajax-loader_image.gif';?>" alt="HTML5 Icon" style="height:15px;">
						</div>
						<div id="loadmore">
							<a 	data-random_id="<?php echo esc_html($random_id); ?>" 
								data-posts_per_page="<?php echo esc_html($number_loadmore); ?>" 
								data-id_category="<?php echo esc_html($id_category); ?>" 
								data-data_show="<?php echo esc_html($data_show); ?>" 
								data-columns="<?php echo esc_html($columns); ?>" 
								data-show_data_image_slider="<?php echo esc_html($show_data_image_slider); ?>" 
								data-grid_list_layout="<?php echo esc_html($grid_list_layout); ?>" 
								data-sort="<?php echo esc_html($order_by); ?>" 
								data-order_by="<?php echo esc_html($sort); ?>" 
								href="#" class="button btn_loadmore_blog"><?php _e('LOAD MORE','wpdancelaparis') ?></a>
						</div>
					</div>	
				<?php endif; ?>
			<?php endif;// End have post ?>
	        <?php
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['id_category']          	= strip_tags( $new_instance['id_category'] );
	        $instance['data_show']        	 	= strip_tags( $new_instance['data_show'] );
	        $instance['number_blogs']        	= strip_tags( $new_instance['number_blogs'] );
	        $instance['show_data_image_slider'] = strip_tags( $new_instance['show_data_image_slider'] );
	        $instance['show_grid_list']        	= strip_tags( $new_instance['show_grid_list'] );
	        $instance['sort']        			= strip_tags( $new_instance['sort'] );
	        $instance['order_by']            	= strip_tags( $new_instance['order_by'] );
	        $instance['columns']            	= strip_tags( $new_instance['columns'] );
	        $instance['pagination_loadmore']    = strip_tags( $new_instance['pagination_loadmore'] );
	        $instance['number_loadmore']        = strip_tags( $new_instance['number_loadmore'] );
	        $instance['class']            		= strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_blog_grid_list() {
		register_widget( 'tvlgiao_wpdance_widget_blog_grid_list' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_blog_grid_list' );
}
?>