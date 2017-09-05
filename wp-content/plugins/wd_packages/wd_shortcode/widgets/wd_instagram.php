<?php
if( !class_exists( 'tvlgiao_wpdance_widget_instagram' ) ) {
	class tvlgiao_wpdance_widget_instagram extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_instagram', 'description' => esc_html__('Displays your latest Instagram photos','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('widget_instagram', esc_html__('WD - Instagram','wpdancelaparis'), $widget_ops);
		}
		
	    function widget( $args, $instance ) {

			$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
			$username = empty( $instance['username'] ) ? '' : $instance['username'];
			$limit = empty( $instance['number'] ) ? 9 : $instance['number'];
			$size = empty( $instance['size'] ) ? 'large' : $instance['size'];
			$target = empty( $instance['target'] ) ? '_self' : $instance['target'];
			$link = empty( $instance['link'] ) ? '' : $instance['link'];

			echo $args['before_widget'];

			if ( ! empty( $title ) ) { echo $args['before_title'] . wp_kses_post( $title ) . $args['after_title']; };

			do_action( 'wpiw_before_widget', $instance );

			if ( $username != '' ) {

				$media_array = $this->scrape_instagram( $username );

				if ( is_wp_error( $media_array ) ) {

					echo wp_kses_post( $media_array->get_error_message() );

				} else {

					// filter for images only?
					if ( $images_only = apply_filters( 'wpiw_images_only', FALSE ) ) {
						$media_array = array_filter( $media_array, array( $this, 'images_only' ) );
					}

					// slice list down to required limit
					$media_array = array_slice( $media_array, 0, $limit );

					// filters for custom classes
					$ulclass = apply_filters( 'wpiw_list_class', 'instagram-pics instagram-size-' . $size );
					$liclass = apply_filters( 'wpiw_item_class', '' );
					$aclass = apply_filters( 'wpiw_a_class', '' );
					$imgclass = apply_filters( 'wpiw_img_class', '' );
					$template_part = apply_filters( 'wpiw_template_part', 'parts/wp-instagram-widget.php' );

					?><ul class="<?php echo esc_attr( $ulclass ); ?>"><?php
					foreach ( $media_array as $item ) {
						// copy the else line into a new file (parts/wp-instagram-widget.php) within your theme and customise accordingly
						if ( locate_template( $template_part ) != '' ) {
							include locate_template( $template_part );
						} else {
							echo '<li class="'. esc_attr( $liclass ) .'"><a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'"  class="'. esc_attr( $aclass ) .'"><img src="'. esc_url( $item[$size] ) .'"  alt="'. esc_attr( $item['description'] ) .'" title="'. esc_attr( $item['description'] ).'"  class="'. esc_attr( $imgclass ) .'"/></a></li>';
						}
					}
					?></ul><?php
				}
			}

			$linkclass = apply_filters( 'wpiw_link_class', 'clear' );

			if ( $link != '' ) {
				?><p class="<?php echo esc_attr( $linkclass ); ?>"><a href="<?php echo trailingslashit( '//instagram.com/' . esc_attr( trim( $username ) ) ); ?>" rel="me" target="<?php echo esc_attr( $target ); ?>"><?php echo wp_kses_post( $link ); ?></a></p><?php
			}

			do_action( 'wpiw_after_widget', $instance );

			echo $args['after_widget'];
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => __( 'Instagram', 'wpdancelaparis' ), 'username' => '', 'size' => 'large', 'link' => __( 'Follow Me!', 'wpdancelaparis' ), 'number' => 9, 'target' => '_self' ) );
			$title = $instance['title'];
			$username = $instance['username'];
			$number = absint( $instance['number'] );
			$size = $instance['size'];
			$target = $instance['target'];
			$link = $instance['link'];
			?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'wpdancelaparis' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username', 'wpdancelaparis' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" /></label></p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of photos', 'wpdancelaparis' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" /></label></p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e( 'Photo size', 'wpdancelaparis' ); ?>:</label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" class="widefat">
					<option value="thumbnail" <?php selected( 'thumbnail', $size ) ?>><?php esc_html_e( 'Thumbnail', 'wpdancelaparis' ); ?></option>
					<option value="small" <?php selected( 'small', $size ) ?>><?php esc_html_e( 'Small', 'wpdancelaparis' ); ?></option>
					<option value="large" <?php selected( 'large', $size ) ?>><?php esc_html_e( 'Large', 'wpdancelaparis' ); ?></option>
					<option value="original" <?php selected( 'original', $size ) ?>><?php esc_html_e( 'Original', 'wpdancelaparis' ); ?></option>
				</select>
			</p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open links in', 'wpdancelaparis' ); ?>:</label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" class="widefat">
					<option value="_self" <?php selected( '_self', $target ) ?>><?php esc_html_e( 'Current window (_self)', 'wpdancelaparis' ); ?></option>
					<option value="_blank" <?php selected( '_blank', $target ) ?>><?php esc_html_e( 'New window (_blank)', 'wpdancelaparis' ); ?></option>
				</select>
			</p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link text', 'wpdancelaparis' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" /></label></p>
			<?php

		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['username'] = trim( strip_tags( $new_instance['username'] ) );
			$instance['number'] = ! absint( $new_instance['number'] ) ? 9 : $new_instance['number'];
			$instance['size'] = ( ( $new_instance['size'] == 'thumbnail' || $new_instance['size'] == 'large' || $new_instance['size'] == 'small' || $new_instance['size'] == 'original' ) ? $new_instance['size'] : 'large' );
			$instance['target'] = ( ( $new_instance['target'] == '_self' || $new_instance['target'] == '_blank' ) ? $new_instance['target'] : '_self' );
			$instance['link'] = strip_tags( $new_instance['link'] );
			return $instance;
		}

		// based on https://gist.github.com/cosmocatalano/4544576
		function scrape_instagram( $username ) {

			$username = strtolower( $username );
			$username = str_replace( '@', '', $username );

			if ( false === ( $instagram = get_transient( 'instagram-a5-'.sanitize_title_with_dashes( $username ) ) ) ) {

				$remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );

				if ( is_wp_error( $remote ) )
					return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'wpdancelaparis' ) );

				if ( 200 != wp_remote_retrieve_response_code( $remote ) )
					return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'wpdancelaparis' ) );

				$shards = explode( 'window._sharedData = ', $remote['body'] );
				$insta_json = explode( ';</script>', $shards[1] );
				$insta_array = json_decode( $insta_json[0], TRUE );

				if ( ! $insta_array )
					return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'wpdancelaparis' ) );

				if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
					$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
				} else {
					return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'wpdancelaparis' ) );
				}

				if ( ! is_array( $images ) )
					return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'wpdancelaparis' ) );

				$instagram = array();

				foreach ( $images as $image ) {

					$image['thumbnail_src'] = preg_replace( '/^https?\:/i', '', $image['thumbnail_src'] );
					$image['display_src'] = preg_replace( '/^https?\:/i', '', $image['display_src'] );

					// handle both types of CDN url
					if ( ( strpos( $image['thumbnail_src'], 's640x640' ) !== false ) ) {
						$image['thumbnail'] = str_replace( 's640x640', 's160x160', $image['thumbnail_src'] );
						$image['small'] = str_replace( 's640x640', 's320x320', $image['thumbnail_src'] );
					} else {
						$urlparts = wp_parse_url( $image['thumbnail_src'] );
						$pathparts = explode( '/', $urlparts['path'] );
						array_splice( $pathparts, 3, 0, array( 's160x160' ) );
						$image['thumbnail'] = '//' . $urlparts['host'] . implode( '/', $pathparts );
						$pathparts[3] = 's320x320';
						$image['small'] = '//' . $urlparts['host'] . implode( '/', $pathparts );
					}

					$image['large'] = $image['thumbnail_src'];

					if ( $image['is_video'] == true ) {
						$type = 'video';
					} else {
						$type = 'image';
					}

					$caption = __( 'Instagram Image', 'wpdancelaparis' );
					if ( ! empty( $image['caption'] ) ) {
						$caption = $image['caption'];
					}

					$instagram[] = array(
						'description'   => $caption,
						'link'		  	=> trailingslashit( '//instagram.com/p/' . $image['code'] ),
						'time'		  	=> $image['date'],
						'comments'	  	=> $image['comments']['count'],
						'likes'		 	=> $image['likes']['count'],
						'thumbnail'	 	=> $image['thumbnail'],
						'small'			=> $image['small'],
						'large'			=> $image['large'],
						'original'		=> $image['display_src'],
						'type'		  	=> $type
					);
				}

				// do not set an empty transient - should help catch private or empty accounts
				if ( ! empty( $instagram ) ) {
					$instagram = json_encode( serialize( $instagram ) );
					set_transient( 'instagram-a5-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
				}
			}

			if ( ! empty( $instagram ) ) {

				return unserialize( json_decode( $instagram ) );

			} else {

				return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'wpdancelaparis' ) );

			}
		}

		function images_only( $media_item ) {

			if ( $media_item['type'] == 'image' )
				return true;

			return false;
		}
	}
	function wp_widget_register_widget_instagram() {
		register_widget( 'tvlgiao_wpdance_widget_instagram' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_instagram' );
}
?>