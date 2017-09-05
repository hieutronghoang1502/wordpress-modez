<?php

	//THUMBNAIL
	function shortcode_thumbnail($size){
		ob_start();
		if(!is_single( ) && has_post_thumbnail( ) ){?>
			<figure class="post-thumbnail"><?php the_post_thumbnail($size ); ?></figure><?php
		}
		$content = ob_get_clean();
		return $content;
	}
	add_shortcode( 'thumbnail', 'shortcode_thumbnail' );


//ENTRY HEADER
	function shortcode_entry_header(){
		
		if(is_single()): 
			ob_start();?>

			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute( ); ?>">
					<?php the_title( ); ?>
				</a>
			</h1>

			<?php $content = ob_get_clean(); 
				return $content; ?>
		<?php else:
			ob_start();?>

			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute( ); ?>">
					<?php the_title( ); ?>
				</a>
			</h2>

			<?php $content = ob_get_clean();
				return $content; 

		endif;
		
	}
	add_shortcode( 'entry_header', 'shortcode_entry_header' );

//Readmore
	function shortcode_readmore(){
		return '...<a class="readmore" href="'.get_permalink(get_the_id() ).'">'.__('Read More >','modez').'</a>';
	}
	add_filter( 'excerpt_more', 'shortcode_readmore' );

//Entry Content
	function shortcode_entry_content(){
		if(!is_single( )):
			return the_excerpt();
		else:
			return the_content();
		endif;
	}
	add_shortcode( 'entry_content', 'shortcode_entry_content' );

//Entry tag
	function shortcode_entry_tag(){
		if(has_tag( )):
			ob_start();
		echo '<div class="entry-tag">';
      printf( __('Tagged in %1$s', 'thachpham'), get_the_tag_list( '', ', ' ) );
      echo '</div>';
      $content = ob_get_clean();
      endif;
      return $content;
	}
	add_shortcode( 'entry_tag', 'shortcode_entry_tag' );

//Entry Meta
	function shortcode_entry_meta(){
		if(!is_page()):
			ob_start();
		echo '<div class="entry-meta">';

		printf(__('<span class="date-published">at %1$s</span>','modez'), get_the_date( ));

		echo '</div>';
		endif;
		$content = ob_get_clean();
		return $content; 
	}
	add_shortcode( 'entry_meta', 'shortcode_entry_meta' );


	function shortcode_footer_col(){
		ob_start(); ?>
		<div class="footer-col">
		<ul>
			<li>
				<ul>
					<li><strong>ABOUT US</strong></li>
					<li>Description</li>
				</ul>
			</li>

			<li>
				<ul>
					<li><strong>CONTACT INFO</strong></li>
					<li>Address</li>
					<li>Phone number</li>
					<li>Email</li>
				</ul>
			</li>

			<li>
				<ul>
					<li><strong>MORE LINKS</strong></li>
				</ul>	
			</li>

			<li>
				<ul>
					<li><strong>LOCATION</strong></li>
					<li><iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d15675.181406879097!2d106.70577335!3d10.826967549999999!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1499738484839" width="250" height="100" frameborder="0" style="border:0" allowfullscreen></iframe></li>
				</ul>
			</li>

		</ul>
		

	</div>
	<?php $content = ob_get_clean();
		return $content;
	}
	add_shortcode( 'footer_col', 'shortcode_footer_col' );

	/**
	Shortcode_footer
**/
	function shortcode_footer(){
		ob_start();
		?>
		<footer><div id="copyright">Copyright @  <?php echo date('Y') ?> <?php echo get_bloginfo('sitename' ); ?></div></footer>
		<?php 
		$footer = ob_get_contents();
		ob_end_clean();

		return $footer;
	}

	add_shortcode( 'footer', 'shortcode_footer' );


	/*header*/
	function shortcode_header_div(){
		ob_start(); ?>
		<header>
			<div id="header-desc">FREE SHIPPING ON ORDERS ON OVER $50</div>
			<div id="status-icon">
				

			</div>
			<div id="header-menu">
				
				<?php 
					$menu = array(
				'theme_location' => 'primary-menu',
				'container'		 => 'nav',
				'container_class'=> 'primary-menu',
				'items_wrap'     => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>',
				);
			wp_nav_menu($menu);
				?>
			</div>
		</header>
		<?php $content = ob_get_clean();
		return $content;
	}
	add_shortcode( 'header_div', 'shortcode_header_div' );

	
?>