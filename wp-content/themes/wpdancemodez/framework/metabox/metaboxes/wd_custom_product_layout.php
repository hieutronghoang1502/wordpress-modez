<?php
	$product_id 		= tvlgiao_wpdance_get_post_by_global();
	$html_header 		= tvlgiao_wpdance_get_html_block_layout_choices('wpdance_header',__('Select Header', 'wpdancelaparis'),'name');
	$html_footer 		= tvlgiao_wpdance_get_html_block_layout_choices('wpdance_footer',__('Select Footer', 'wpdancelaparis'),'name');
	$values 			= get_post_custom($product_id);

	// Slug meta key
	$meta_key_header 	= '_tvlgiao_wpdance_custom_header';
	$meta_key_footer	= '_tvlgiao_wpdance_custom_footer';

	$_product_config 	= get_post_meta($product_id,'_tvlgiao_wpdance_custom_product_config',true);
	$_default_product_config = array(
			'layout' 					=> '0',
			'style_breadcrumb'			=> '0',
			'wd_breadcrumb_url_img'		=> '',	
	);
	if( strlen($_product_config) > 0 ){
		$_product_config = unserialize($_product_config);
		if( is_array($_product_config) && count($_product_config) > 0 ){
			$_product_config['layout'] 			= ( isset($_product_config['layout']) 	&& strlen($_product_config['layout']) > 0 ) ? $_product_config['layout'] : $_default_product_config['layout'];
			$_product_config['style_breadcrumb'] 		= ( isset($_product_config['style_breadcrumb']) 	&& strlen($_product_config['style_breadcrumb']) > 0 ) ? $_product_config['style_breadcrumb'] : $_default_product_config['style_breadcrumb'];
			$_product_config['wd_breadcrumb_url_img'] 	= ( isset($_product_config['wd_breadcrumb_url_img']) 	&& strlen($_product_config['wd_breadcrumb_url_img']) > 0 ) ? $_product_config['wd_breadcrumb_url_img'] : $_default_product_config['wd_breadcrumb_url_img'];			
		}
	}else{
		$_product_config = $_default_product_config;
	}
	// We'll use this nonce field later on when saving.
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
?>
<div class="select-layout area-config area-config1">
	<div class="area-inner">
		<!-- Custom Header Layout -->
		<p><strong><?php esc_html_e('Custom Header: ', 'wpdancelaparis') ?></strong></p>
		<label class="screen-reader-text" for="wpdance_custom_header"><?php esc_html_e('Custom Header', 'wpdancelaparis') ?></label>
		<select name="wpdance_custom_header" id="wpdance_custom_header">
			<?php foreach ($html_header as $id => $title): ?>
				<?php $selected = selected($values["{$meta_key_header}"][0], $id, false); ?>
				<option value="<?php echo esc_html($id) ?>" <?php echo esc_attr($selected) ?>><?php echo esc_html($title) ?></option>
			<?php endforeach; ?>
		</select>
		
		<!-- Custom Footer Layout -->
		<p><strong><?php esc_html_e('Custom Footer: ', 'wpdancelaparis') ?></strong></p>
		<label class="screen-reader-text" for="wpdance_custom_footer"><?php esc_html_e('Custom Footer', 'wpdancelaparis') ?></label>
		<select name="wpdance_custom_footer" id="wpdance_custom_footer">
			<?php foreach ($html_footer as $id => $title): ?>
				<?php $selected = selected($values["{$meta_key_footer}"][0], $id, false); ?>
				<option value="<?php echo esc_html($id) ?>" <?php echo esc_attr($selected) ?>><?php echo esc_html($title) ?></option>
			<?php endforeach; ?>
		</select>
		<div class="area-inner-0">
			<div class="area-content">
				<div class="wd-single-post-layout">
					<p>
						<strong><?php esc_html_e('Product Layout:','wpdancelaparis'); ?></strong>
					</p>
					<div class="bg-input select-box ">
						<div class="bg-input-inner config-product">
							<select name="single_layout" id="_single_product_layout">
								<option value="0" 		<?php if( strcmp($_product_config["layout"],'0') == 0 ) echo "selected='selected'";?>>		<?php esc_html_e('Default','wpdancelaparis'); ?>			</option>
								<option value="0-0-0" 	<?php if( strcmp($_product_config["layout"],'0-0-0') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Fullwidth','wpdancelaparis'); ?>		</option>
								<option value="0-0-1" 	<?php if( strcmp($_product_config["layout"],'0-0-1') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Right Sidebar','wpdancelaparis'); ?>	</option>
								<option value="1-0-0" 	<?php if( strcmp($_product_config["layout"],'1-0-0') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Left Sidebar','wpdancelaparis'); ?>	</option>
								<option value="1-0-1" 	<?php if( strcmp($_product_config["layout"],'1-0-1') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Left & Right Sidebar','wpdancelaparis'); ?></option>
							</select>
						</div>
					</div>
				</div>
			</div><!-- .area-content -->
		</div>	
		<div class="clear"></div>
	</div>
	<div class="area-inner-1">
		<div class="area-content">
			<div class="wd-single-post-layout">
				<p><strong><?php esc_html_e('Breadcrumb Style:','wpdancelaparis'); ?></strong></p>
				<div class="bg-input select-box ">
					<div class="bg-input-inner config-product">
						<select name="style_breadcrumb_name" id="_style_breadcrumb_name">
							<option value="breadcrumb_default" 	<?php if( strcmp($_product_config["style_breadcrumb"],'breadcrumb_default') == 0 ) echo "selected='selected'";?>>		<?php esc_html_e('Default (Customize)','wpdancelaparis'); ?>		</option>
							<option value="breadcrumb_banner" 	<?php if( strcmp($_product_config["style_breadcrumb"],'breadcrumb_banner') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Background Image','wpdancelaparis'); ?>	</option>
							<option value="no_breadcrumb" 	<?php if( strcmp($_product_config["style_breadcrumb"],'no_breadcrumb') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('No Breadcrumb','wpdancelaparis'); ?>	</option>
						</select>
					</div>
				</div>
			</div>
			<div class="wd-single-post-layout">
				<p>
					<strong><?php esc_html_e('Image Breadcrumb:','wpdancelaparis'); ?></strong>
				</p>
				<p><?php echo $_product_config['wd_breadcrumb_url_img']; ?>
					<img id="wd_bread_img_con_id" src="<?php echo strlen($_product_config['wd_breadcrumb_url_img']) ? esc_url(wp_get_attachment_url($_product_config['wd_breadcrumb_url_img'])) : TVLGIAO_WPDANCE_THEME_IMAGES.'/banner_breadcrumb.jpg'; ?>"  width="100%" />
					<input class="hidden" type="text" name="wd_breadcrumb_url_img" id="wd_breadcrumb_url_img_id"  value="<?php echo strlen($_product_config['wd_breadcrumb_url_img']) ? esc_attr($_product_config['wd_breadcrumb_url_img']) : ''; ?>"/>
					<a id="wd_breadcrumb_media_lib" href="javascript:void(0);" class="button" rel="wd_breadcrumb_url_img"><?php esc_html_e('Upload Background','wpdancelaparis'); ?></a>
				</p>
			</div>	
		</div><!-- .area-content --> 
	</div>	
	<input type="hidden" name="custom_product_layout" class="change-layout" value="custom_single_product_layout"/>	
</div><!-- .select-layout -->