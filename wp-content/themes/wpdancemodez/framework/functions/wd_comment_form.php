<?php
if(!function_exists ('tvlgiao_wpdance_display_comment_form')){
	function tvlgiao_wpdance_display_comment_form(){
		if ( TVLGIAO_WPDANCE_USE_CONTROL == 'theme_option' ) {
			$comment_setting 	= wd_get_data_theme_option('tvlgiao_wpdance_comment_sorter');
			if (count($comment_setting)) {
				$comment_setting = array(
					'wordpress' => 1,
                    'facebook'  => 0,
				);
			}
			if ($comment_setting) {
				foreach ($comment_setting as $key => $value) {
					if ($value) {
						tvlgiao_wpdance_display_comment_form_by_mode($key);
					}
				}
			}
		}else{
			tvlgiao_wpdance_display_comment_form_by_mode('wordpress');
		}
	}
}

//Display comment form
if(!function_exists ('tvlgiao_wpdance_display_comment_form_by_mode')){
	function tvlgiao_wpdance_display_comment_form_by_mode($comment_mode = 'wordpress'){
		if ($comment_mode == 'wordpress') {
			if (!is_singular('product' )) {
		 		comments_template('');
			}
		} elseif ($comment_mode == 'facebook') {
			echo tvlgiao_wpdance_get_comment_form_facebook();
		} 
	}
}

//Get HTML of comment form facebook
if(!function_exists ('tvlgiao_wpdance_get_comment_form_facebook')){
	function tvlgiao_wpdance_get_comment_form_facebook(){ 
		$content = '';
		if ( TVLGIAO_WPDANCE_USE_CONTROL == 'theme_option' ) {
			ob_start(); 
			$comment_mode = wd_get_data_theme_option( 'tvlgiao_wpdance_comment_facebook_mode', '1' );
			$num_comment = wd_get_data_theme_option( 'tvlgiao_wpdance_comment_facebook_number_comment_display', '10' ); 
			?>
			<div class="wd-facebook-comment-form">
				<?php if ($comment_mode): ?>
					<div class="fb-comments" xid="<?php the_ID(); ?>" data-numposts="<?php echo esc_attr($num_comment); ?>" data-colorscheme="light" data-width="100%" data-version="v2.3"></div>
				<?php else: ?>
					<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="<?php echo esc_attr($num_comment); ?>" width="100%" data-colorscheme="light" data-width="100%" data-version="v2.3"></div>
				<?php endif ?>
			</div>
			<?php
			$content = ob_get_clean();
		}
		return $content;
	}
}

//Get facebook comment count of post
if(!function_exists ('tvlgiao_wpdance_get_comment_facebook_count')){
	function tvlgiao_wpdance_get_comment_facebook_count(){
		if ( TVLGIAO_WPDANCE_USE_CONTROL == 'theme_option' ) {
			$comment_mode = wd_get_data_theme_option( 'tvlgiao_wpdance_comment_facebook_mode', '1' );
			if ($comment_mode == 'wordpress') { ?>
			 	<span class="fb-comments-count" data-href="<?php the_permalink(); ?>"></span>
		 	<?php
			} elseif ($comment_mode == 'facebook') { ?>
				<span class="fb-comments-count" xid="<?php the_ID(); ?>></span>
			<?php 
			} 
		}
	}
} 

// Comment Content
if ( !function_exists( 'tvlgiao_wpdance_theme_comment' )){
	function tvlgiao_wpdance_theme_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
				?>
				 <li <?php comment_class(); ?> id="wd-comment-container-<?php comment_ID() ?>">
					<div id="comment-<?php comment_ID(); ?>">
						<div class="comment-author vcard">
							<?php echo get_avatar($comment, 70 ); ?>
						</div><!-- .comment-author .vcard -->
						<div class="comment-text">
							<div class="comment-info-container">
								<div class="comment-author-date">
									<?php printf(  '%s <span class="says"></span>', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
								</div>

								<div class="comment-info">
									<span class="reply"><?php comment_reply_link( array_merge( array( 'reply_text' => '<i class="fa fa-reply"></i>') , array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
									<span class="edit"><?php edit_comment_link('<i class="fa fa-pencil-square-o"></i>', ' ' );?></span>
								</div><!-- .reply -->
							</div>
							<div class="comment-body"><?php comment_text(); ?></div>
							<?php if ( $comment->comment_approved == '0' ) : ?>
								<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'wpdancelaparis' ); ?></em><br/>
							<?php endif; ?>
							<div class="comment-date"><?php printf( esc_html__( '%1$s', 'wpdancelaparis' ), get_comment_date()); ?> </div>
						</div>
					</div><!-- #comment-##  -->
				<?php
				break;
			case 'pingback'  :
			case 'trackback' :
			break;
		endswitch;
	} // End Function
} // End If

//Default wordpress comment form
if(!function_exists ('tvlgiao_wpdance_comment_form')){
	function tvlgiao_wpdance_comment_form( $args = array(), $post_id = null ) {
		global $user_identity, $id;

		if ( null === $post_id )
			$post_id = $id;
		else
			$id = $post_id;

		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$defaut = array(
			'comment_author'		=>	esc_html__('Name','wpdancelaparis'),
			'comment_author_email'	=>	esc_html__('Email','wpdancelaparis'),
			'comment_author_url'	=>	esc_html__('Website','wpdancelaparis')	
		);
		extract($defaut,EXTR_OVERWRITE);
		extract(array_filter(array(
			'comment_author'		=>	esc_attr($commenter['comment_author']),
			'comment_author_email'	=>	esc_attr($commenter['comment_author_email']),
			'comment_author_url'	=>	esc_attr($commenter['comment_author_url'])
		)),EXTR_OVERWRITE);
		
		$fields =  array(
			'author' => '<div class="col"><span class="label">'.$comment_author.' <span class="required">*</span></span><p class="comment-form-author">' . '<input id="author" class="input-text" name="author" type="text" placeholder="' .esc_html__('Your name','wpdancelaparis'). '" data-default="'.$defaut['comment_author'].'" size="30"' . $aria_req . ' />' .'</p></div>',
			'email'  => '<div class="col"><span class="label">'.$comment_author_email.' <span class="required">*</span></span><p class="comment-form-email"><input id="email" class="input-text" name="email" type="text" placeholder="'. esc_html__('Your email','wpdancelaparis'). '" size="30"' . $aria_req . ' data-default="'.$defaut['comment_author_email'].'"/>'.'</p></div>',
			'url'    => '<div class="col"><span class="label">'. $comment_author_url .'</span><p class="comment-form-url"><input id="url" class="input-text" name="url" type="text" placeholder="' .esc_html__('Website','wpdancelaparis'). '" size="30" data-default="'.$defaut['comment_author_url'].'"/>' .'</p></div>',
		);
		
		if( !is_user_logged_in() ){
			$fields['author'] = '<div class="comment-author-wrapper">'.$fields['author'];
			$fields['url'] = $fields['url'].'</div>';
		}

		$required_text = sprintf( ' ' . wp_kses(__('Required fields are marked %s','wpdancelaparis'), array()), '<span class="required">*</span>' );
		$defaults = array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<span class="label">'.esc_html__('Comment', 'wpdancelaparis').' <span class="required">*</span></span><p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . esc_html__('Your Comment', 'wpdancelaparis') . '" ></textarea></p>',
			'must_log_in'          => '<p class="must-log-in">' .  sprintf(__( 'You must be <a href="%s">logged in</a> to post a comment.','wpdancelaparis' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','wpdancelaparis'), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => esc_html__( 'Leave a Comment','wpdancelaparis' ),
			'title_reply_to'       => esc_html__( 'Leave a Reply to %s','wpdancelaparis'),
			'cancel_reply_link'    => esc_html__( 'Cancel reply','wpdancelaparis' ),
			'label_submit'         => esc_html__( 'POST COMMENT','wpdancelaparis' ),
			//'label_infomation'	   => esc_html__('Please note comments must be approved before they are published','wpdancelaparis')
		);
		
		if( !is_user_logged_in() ){
			$defaults['comment_field'] = '<div class="comment-message-wrapper">'.$defaults['comment_field'].'</div>';
		}

		$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

		?>
			<?php if ( comments_open() ) : ?>
				<?php do_action( 'comment_form_before' ); ?>
				<div id="respond">
					<div class="wd_title_respond"><h3 id="reply-title" class="heading-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3></div>
					
					<!--<p class="info"><?php //echo esc_attr( $args['label_infomation'] ); ?></p>-->
					
					<?php  ?>
					<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
						<?php echo esc_attr($args['must_log_in']); ?>
						<?php do_action( 'comment_form_must_log_in_after' ); ?>
					<?php else : ?>
						<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
							<?php do_action( 'comment_form_top' ); ?>
							<?php if ( is_user_logged_in() ) : ?>
								<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
								<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
							<?php else : ?>
								<?php echo esc_attr($args['comment_notes_before']); ?>
								<?php
								do_action( 'comment_form_before_fields' );
								foreach ( (array) $args['fields'] as $name => $field ) {
									echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
								}
								
								?>
							<?php endif; ?>
							<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
							<?php echo esc_attr($args['comment_notes_after']); ?>
							<?php if ( !is_user_logged_in() ) do_action( 'comment_form_after_fields' );?>
							<p class="form-submit">
								<button class="button" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>"><span><span><?php echo esc_attr( $args['label_submit'] ); ?></span></span></button>

								<?php comment_id_fields( $post_id ); ?>
							</p>
							<?php do_action( 'comment_form', $post_id ); ?>
						</form>
					<?php endif; ?>
				</div><!-- #respond -->
				<?php do_action( 'comment_form_after' ); ?>
			<?php else : ?>
				<?php do_action( 'comment_form_comments_closed' ); ?>
			<?php endif; ?>
		<?php
	} // End Function
} // End If
?>