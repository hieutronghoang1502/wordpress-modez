<?php 
# -------------------------------------------------------------------------
# Setup
# -------------------------------------------------------------------------

add_action('admin_init', 'tvlgiao_wpdance_install_theme_admin_init');
function tvlgiao_wpdance_install_theme_admin_init() {
	wp_enqueue_style('wpdance-adminpage-style', tvlgiao_wpdance_get_theme_guide_uri().'/css/adminpage.css');
	wp_enqueue_script('wpdance-adminpage-script', tvlgiao_wpdance_get_theme_guide_uri().'/js/adminpage.js');
}

function tvlgiao_wpdance_theme_name(){
	return TVLGIAO_WPDANCE_THEME_NAME;
}

function tvlgiao_wpdance_plugin_slider_name(){
	return 'revslider'; //or smartslider3
}

//list plugin deactive
function tvlgiao_wpdance_list_plugin_to_check(){
	$list_plugin = array(
		'js_composer',
		'revslider',
		'ubermenu',
		'woocommerce',
		'gtranslate',
		'woocommerce-currency-switcher',
		'contact-form-7',
		'yith-woocommerce-wishlist',
		'yith-woocommerce-compare',
		'testimonials-by-woothemes',
		'wordpress-importer',
		'widget-importer-exporter',
		'regenerate-thumbnails',
		'wd_packages',
	);
	return $list_plugin;
}

//list slider name to import
function tvlgiao_wpdance_list_slider_to_check(){
	$list_slider_name = array(
		'slider-home-1',
	);
	return $list_slider_name;
}

//list widget to check registered
function tvlgiao_wpdance_list_sample_data_to_import(){
	$list_sample_data = array(
		'sample-data.xml'         => 'import demo content file',
		'sample-data.wie'         => 'import demo widget file',
	);
	return $list_sample_data;
}


//list widget to check registered
function tvlgiao_wpdance_list_widget_to_check(){
	$list_widget_name = array(
	);
	return $list_widget_name;
}


//list plugin actived
function tvlgiao_wpdance_list_plugin_actived(){
	$plugin_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
    $new_array = array();
    foreach($plugin_actived as $key => $value) {
        $plugin = explode('/',$value); 
        $new_array[] = $plugin[0];
    }
    return $new_array;
}

//list widget registered
function tvlgiao_wpdance_list_widget_registered(){
	if ( empty ( $GLOBALS['wp_widget_factory'] ) )
        return;
    $list_widget_name = array();
    $widgets = $GLOBALS['wp_widget_factory']->widgets;
    foreach ($widgets as $key => $value) {
    	$list_widget_name[] = $key;
    }
    return $list_widget_name;
}

function tvlgiao_wpdance_get_theme_guide_uri(){
	return TVLGIAO_WPDANCE_THEME_SUPPORT_URI. '/theme_guide';
}

function tvlgiao_wpdance_get_current_guide_step( $field = 'wpdance_setup_theme_guide_step' ){
	return get_theme_mod( $field , false );
}

function tvlgiao_wpdance_this_url($params = '') {
	return add_query_arg($params, '', network_admin_url().'admin.php?page=install_theme_guide');
}

function tvlgiao_wpdance_install_plugins_url($params = '') {
	return add_query_arg($params, '', network_admin_url().'themes.php?page=tgmpa-install-plugins');	
}

function tvlgiao_wpdance_themes_url($params = '') {
	return add_query_arg($params, '', network_admin_url().'themes.php');	
}

function tvlgiao_wpdance_revslider_url($params = '') {
	$plugin = tvlgiao_wpdance_plugin_slider_name();
	if ($plugin == 'smartslider3') {
		return add_query_arg($params, '', network_admin_url().'admin.php?page=smart-slider-3');
	} elseif ($plugin == 'revslider') {
		return add_query_arg($params, '', network_admin_url().'admin.php?page=revslider');	
	}
}

function tvlgiao_wpdance_import_url($type = 'xml', $params = '') {
	if($type == 'xml'){
		return add_query_arg($params, '', network_admin_url().'import.php');
	}elseif($type == 'wie'){
		return add_query_arg($params, '', network_admin_url().'tools.php?page=widget-importer-exporter');
	}
}

function tvlgiao_wpdance_reading_option_url($params = '') {
	return add_query_arg($params, '', network_admin_url().'options-reading.php');	
}

function tvlgiao_wpdance_customizer_url($params = '') {
	return add_query_arg($params, '', network_admin_url().'customize.php?return='.esc_url(tvlgiao_wpdance_this_url()));	
}

function tvlgiao_wpdance_refresh_page($url = '', $timestamp = 0){
	$url = ($url == '') ? tvlgiao_wpdance_this_url() : $url;
	ob_start();
	?>
	<meta http-equiv="refresh" content="<?php echo $timestamp; ?>; url=<?php echo esc_url($url); ?>" />
	<?php
	echo ob_get_clean();
}

# -------------------------------------------------------------------------
# Check status setup theme
# -------------------------------------------------------------------------

//check plugin active
function tvlgiao_wpdance_check_status_active_plugin(){
	$plugin_to_check = tvlgiao_wpdance_list_plugin_to_check();
	$list_plugin_actived = tvlgiao_wpdance_list_plugin_actived();
	$missing_plugin = array();
	foreach ($plugin_to_check as $key) {
		if ( !in_array( $key, $list_plugin_actived ) ) {
			$missing_plugin[] = $key;
		}
	}
	return $missing_plugin; //List of plugins missing
}

//check plugin active
function tvlgiao_wpdance_is_plugin_active(){
	$plugin = tvlgiao_wpdance_plugin_slider_name();
	if ($plugin == 'revslider') {
		return class_exists('RevSliderGlobals');
	}elseif ($plugin == 'smartslider3') {
		return class_exists('SmartSlider3');
	}
	
}

//check import slider demo data
function tvlgiao_wpdance_check_status_import_data_slider(){
	global $wpdb;
	$revslider_check = tvlgiao_wpdance_list_slider_to_check();
	$plugin = tvlgiao_wpdance_plugin_slider_name();
	$sliders = array();
	$missing = array();
	if (tvlgiao_wpdance_is_plugin_active($plugin)) {
		$where = '';
		if ($plugin == "revslider") {
			$tableSliders = $wpdb->prefix . \RevSliderGlobals::TABLE_SLIDERS_NAME;
			$query = $wpdb->prepare("SELECT alias FROM $tableSliders where alias != %s", $where);
		} elseif ($plugin == 'smartslider3') {
			$tableSliders = $wpdb->prefix . 'nextend2_smartslider3_sliders';
			$query = $wpdb->prepare("SELECT title FROM $tableSliders where title != %s", $where);
		}
		$sliders = $wpdb->get_col($query);
	}
	
	foreach ($revslider_check as $check) {
		if (!in_array($check, $sliders))
			$missing[] = $check;
	}
	return $missing;
}

//check widget registered
function tvlgiao_wpdance_check_status_widget_registered(){
	$widget_to_check = tvlgiao_wpdance_list_widget_to_check();
	$list_widget_registered = tvlgiao_wpdance_list_widget_registered();
	$missing_widget = array();
	foreach ($widget_to_check as $key) {
		if ( !in_array( $key, $list_widget_registered ) ) {
			$missing_widget[] = $key;
		}
	}
	return $missing_widget; //List of widgets missing
}

function tvlgiao_wpdance_check_set_front_page(){
	if (get_option('show_on_front') == 'page') {
		return true;
	} else {
		return false;
	}	
}

# -------------------------------------------------------------------------
# Content to display
# -------------------------------------------------------------------------

//started
function tvlgiao_wpdance_content_get_started(){
	ob_start(); ?>
	<div class="guide_card get-started">
		<span class="dashicons dashicons-welcome-learn-more main-icon"></span>
		<p><strong><?php esc_html_e("This short guide will help you get started and quickly familiar with the theme. Teach you step by step how to build site like your demo site in few minutes without technical knowledge. Help you elimite too much time to read the complete user guide.", 'wpdancelaparis'); ?></strong></p>

		<p><a href="<?php echo esc_url(tvlgiao_wpdance_this_url('confirm=get_started')); ?>" class="button button-primary"><?php esc_html_e("Let's get started now", 'wpdancelaparis'); ?></a></p>
	</div>
	<?php 
	return ob_get_clean();
}

function tvlgiao_wpdance_content_plugin_active(){
	ob_start(); ?>
		<!-- Display status plugin actived -->
	    <?php if (count(tvlgiao_wpdance_check_status_active_plugin()) == 0): ?>
	    	<div class="updated notice">
	    		<p class="install-theme-guide-page-site-name"><?php echo esc_html(tvlgiao_wpdance_theme_name()); ?></p>
			    <span class="dashicons dashicons-yes main-icon"></span> <h3><?php esc_html_e("All recommended plugins are already activated", 'wpdancelaparis'); ?></h3>
			</div>
		<?php else: ?>
		    <div class="update-nag notice">
				<h3><?php esc_html_e("Install and activate all recommended plugins", 'wpdancelaparis'); ?></h3>
				<div class="inside">
					<p><?php printf(__("Some plugins are still not activated: <strong>%s</strong>", 'wpdancelaparis'), implode(', ', tvlgiao_wpdance_check_status_active_plugin())); ?></p>

					<p class="main-instruction"><?php printf(__("Please go to <strong><a href=\"%s\">Install Plugins</a></strong> page to start install and activate the missing plugins.", 'wpdancelaparis'), esc_url(tvlgiao_wpdance_install_plugins_url())); ?></p>

					<p><span class="dashicons dashicons-lightbulb"></span> <?php printf(__("If plugin is <strong>commercial</strong> and <strong>not included</strong> in the theme you can ignore it.", 'wpdancelaparis')); ?></p>
					<p>
						<a class="button button-primary" href="<?php echo esc_url(tvlgiao_wpdance_install_plugins_url()); ?>"><?php esc_html_e("Go to Install Plugins", 'wpdancelaparis'); ?></a>
						&nbsp;
						<a href="<?php echo esc_url(tvlgiao_wpdance_this_url('skip=install_plugins')); ?>" class="button button-secondary"><?php esc_html_e("Skip this step", 'wpdancelaparis'); ?></a>
					</p>
				</div>
			</div>
		<?php endif ?>
	<?php 
	return ob_get_clean();
}

function tvlgiao_wpdance_content_import_slider(){
	ob_start(); ?>
		<!-- Display status import data slider -->
		<?php $plugin = tvlgiao_wpdance_plugin_slider_name(); ?>
		<?php if ($plugin = 'revslider'): ?>
			<?php if (count(tvlgiao_wpdance_check_status_import_data_slider()) == 0): ?>
		    	<div class="updated notice">
		    		<p class="install-theme-guide-page-site-name"><?php echo esc_html(tvlgiao_wpdance_theme_name()); ?></p>
				    <span class="dashicons dashicons-yes main-icon"></span> <h3><?php esc_html_e("All sample Slider Revolution are already imported", 'wpdancelaparis'); ?></h3>
				</div>
			<?php else: ?>
			    <div class="update-nag notice">
					<h3><?php esc_html_e("Import sample Slider Revolution come with the theme", 'wpdancelaparis'); ?></h3>
					<div class="inside">
						<p><?php printf(__("Some sample sliders are missing: <code>%s</code>.", 'wpdancelaparis'), implode(', ', tvlgiao_wpdance_check_status_import_data_slider())); ?></p>
						<p class="main-instruction"><?php printf(__("Please go to <strong><a href=\"%s\">Slider Revolution</a></strong>, choose <strong>Import Slider</strong> to start importing sample sliders come with the theme.", 'wpdancelaparis'), esc_attr(revslider_url())); ?></p>
						<p><?php printf(__("Each sample slider is a zip file in the directory <code>sample-data/revslider/</code> inside the zip file <strong>\"All files and documentation\"</strong>, you should have downloaded it when you purchased the theme.", 'wpdancelaparis')); ?></p>
						<p>
							<a href="<?php echo esc_url(revslider_url()); ?>" class="button button-primary"><?php esc_html_e("Go to Slider Revolution", 'wpdancelaparis'); ?></a>
						</p>
					</div>
				</div>
			<?php endif ?>
		<?php else: ?>
			<?php if (count(tvlgiao_wpdance_check_status_import_data_slider()) == 0): ?>
		    	<div class="updated notice">
		    		<p class="install-theme-guide-page-site-name"><?php echo esc_html(tvlgiao_wpdance_theme_name()); ?></p>
				    <span class="dashicons dashicons-yes main-icon"></span> <h3><?php esc_html_e("All sample Smart Sliders 3 are already imported", 'wpdancelaparis'); ?></h3>
				</div>
			<?php else: ?>
			    <div class="update-nag notice">
					<h3><?php esc_html_e("Import sample Smart Sliders 3 come with the theme", 'wpdancelaparis'); ?></h3>
					<div class="inside">
						<p><?php printf(__("Some sample sliders are missing: <code>%s</code>.", 'wpdancelaparis'), implode(', ', tvlgiao_wpdance_check_status_import_data_slider())); ?></p>
						<p class="main-instruction"><?php printf(__("Please go to <strong><a href=\"%s\">Smart Slider 3</a></strong>, choose <strong>Import Slider</strong> to start importing sample sliders come with the theme.", 'wpdancelaparis'), esc_attr(revslider_url())); ?></p>
						<p><?php printf(__("Each sample slider is a zip file in the directory <code>sample-data/demo-smart-slider/</code> inside the zip file <strong>\"All files and documentation\"</strong>, you should have downloaded it when you purchased the theme.", 'wpdancelaparis')); ?></p>
						<p>
							<a href="<?php echo esc_url(revslider_url()); ?>" class="button button-primary"><?php esc_html_e("Go to Smart Slider 3", 'wpdancelaparis'); ?></a>
						</p>
					</div>
				</div>
			<?php endif ?>
		<?php endif ?>
	<?php 
	return ob_get_clean();
}

function tvlgiao_wpdance_content_sample_data_import(){
	ob_start(); ?>
		<!-- CHECK SAMPLE DATA IMPORTED -->
		<?php $import_sample = get_theme_mod( 'wpdance_setup_theme_import_samples', 0 ); ?>
		<?php if ($import_sample == 1): ?>
	    	<div class="updated notice">
			    <p class="install-theme-guide-page-site-name"><?php echo esc_html(tvlgiao_wpdance_theme_name()); ?></p>
		    	<span class="dashicons dashicons-yes main-icon"></span> <h3><?php esc_html_e("You have completed learning about importing sample data", 'wpdancelaparis'); ?> </h3>
			</div>
		<?php elseif ($import_sample == 2): ?>
			<div class="updated notice accordion" data-id-panel="panel_import_sample_data">
			    <p class="install-theme-guide-page-site-name"><?php echo esc_html(tvlgiao_wpdance_theme_name()); ?></p>
		    	<span class="dashicons dashicons-warning main-icon"></span> <h3><?php esc_html_e("You have skip learning about importing sample data", 'wpdancelaparis'); ?> <span class="icon_plus"></span></h3>

		    	<div class="accordion_panel" id="panel_import_sample_data">
				  	<div class="inside">
						<p><?php printf(__("Sample data are provided inside the directory <code>sample-data/</code> of the zip file \"All files and documentation\" which you should have downloaded when purchased the theme. Sample data include:", 'wpdancelaparis')); ?></p>
						<ul>
							<?php $list_data_file = tvlgiao_wpdance_list_sample_data_to_import(); ?>
							<?php foreach ($list_data_file as $key => $value): ?>
								<li><?php printf(__("<code>%1s</code> for %2s", 'wpdancelaparis'), $key, $value); ?></li>
							<?php endforeach ?>
							

						</ul>
						<p class="main-instruction"><?php printf(__("1/ Import XML data: go to <strong>Tools</strong> &gt; <strong>Import</strong> &gt; and choose <strong>WordPress</strong> &gt; select the XML file which you want to import.", 'wpdancelaparis')); ?></p>
						<p class="main-instruction"><?php printf(__("2/ Import WIE data: go to <strong>Tools</strong> &gt; <strong>Widget Importer & Exporter</strong> &gt; and select the WIE file which you want to import.", 'wpdancelaparis')); ?></p>
						<p>
							<a href="<?php echo esc_url(tvlgiao_wpdance_import_url('xml')); ?>" class="button button-primary"><?php esc_html_e("Import XML Tool", 'wpdancelaparis'); ?></a>
							&nbsp;
							<a href="<?php echo esc_url(tvlgiao_wpdance_import_url('wie')); ?>" class="button button-primary"><?php esc_html_e("Import WIE Tool", 'wpdancelaparis'); ?></a>
							&nbsp;
							<a href="<?php echo esc_url(tvlgiao_wpdance_this_url('confirm=import_samples')); ?>" class="button button-primary"><?php esc_html_e("Confirm you got it", 'wpdancelaparis'); ?></a>
						</p>
					</div>
				</div>
			</div>
		<?php else: ?>
		    <div class="update-nag notice">
				<h3><?php esc_html_e("Instruction for importing sample data", 'wpdancelaparis'); ?></h3>
				<div class="inside">
					<p><?php printf(__("Sample data are provided inside the directory <code>sample-data/</code> of the zip file \"All files and documentation\" which you should have downloaded when purchased the theme. Sample data include:", 'wpdancelaparis')); ?></p>
					<ul>
						<?php $list_data_file = tvlgiao_wpdance_list_sample_data_to_import(); ?>
						<?php foreach ($list_data_file as $key => $value): ?>
							<li><?php printf(__("<code>%1s</code> for %2s", 'wpdancelaparis'), $key, $value); ?></li>
						<?php endforeach ?>
						

					</ul>
					<p class="main-instruction"><?php printf(__("1/ Import XML data: go to <strong>Tools</strong> &gt; <strong>Import</strong> &gt; and choose <strong>WordPress</strong> &gt; select the XML file which you want to import.", 'wpdancelaparis')); ?></p>
					<p class="main-instruction"><?php printf(__("2/ Import WIE data: go to <strong>Tools</strong> &gt; <strong>Widget Importer & Exporter</strong> &gt; and select the WIE file which you want to import.", 'wpdancelaparis')); ?></p>
					<p>
						<a href="<?php echo esc_url(tvlgiao_wpdance_import_url('xml')); ?>" class="button button-primary"><?php esc_html_e("Import XML Tool", 'wpdancelaparis'); ?></a>
						&nbsp;
						<a href="<?php echo esc_url(tvlgiao_wpdance_import_url('wie')); ?>" class="button button-primary"><?php esc_html_e("Import WIE Tool", 'wpdancelaparis'); ?></a>
						&nbsp;
						<a href="<?php echo esc_url(tvlgiao_wpdance_this_url('confirm=import_samples')); ?>" class="button button-primary"><?php esc_html_e("Confirm you got it", 'wpdancelaparis'); ?></a>
						&nbsp;
						<a href="<?php echo esc_url(tvlgiao_wpdance_this_url('skip=import_samples')); ?>" class="button button-secondary"><?php esc_html_e("Skip this step", 'wpdancelaparis'); ?></a>
					</p>
				</div>
			</div>
		<?php endif ?>
	<?php 
	return ob_get_clean();
}

function tvlgiao_wpdance_content_widget_registered(){
	ob_start(); ?>
		<!-- Display status widget registered -->
	    <?php if (count(tvlgiao_wpdance_check_status_widget_registered()) == 0): ?>
	    	<div class="updated notice">
	    		<p class="install-theme-guide-page-site-name"><?php echo esc_html(tvlgiao_wpdance_theme_name()); ?></p>
			    <span class="dashicons dashicons-yes main-icon"></span> <h3><?php esc_html_e("All recommended widgets are already registered", 'wpdancelaparis'); ?></h3>
			</div>
		<?php else: ?>
			<?php if (tvlgiao_wpdance_get_current_guide_step() > 4): ?>
				<div class="updated notice accordion" data-id-panel="panel_register_widgets">
				    <p class="install-theme-guide-page-site-name"><?php echo esc_html(tvlgiao_wpdance_theme_name()); ?></p>
			    	<span class="dashicons dashicons-warning main-icon"></span> <h3><?php esc_html_e("You have skip learning about register any recommended widgets", 'wpdancelaparis'); ?> <span class="icon_plus"></span></h3>

			    	<div class="accordion_panel" id="panel_register_widgets">
					  	<div class="inside">
							<p><?php printf(__("Some widgets are still not registered: <strong>%s</strong>", 'wpdancelaparis'), implode(', ', tvlgiao_wpdance_check_status_widget_registered())); ?></p>

							<p><span class="dashicons dashicons-lightbulb"></span> <?php printf(__("If widget is <strong>commercial</strong> and <strong>not included</strong> in the theme you can ignore it.", 'wpdancelaparis')); ?></p>
							<p>
						</div>
					</div>
				</div>
			<?php else: ?>
		    <div class="update-nag notice">
				<h3><?php esc_html_e("Register all recommended widgets", 'wpdancelaparis'); ?></h3>
				<div class="inside">
					<p><?php echo sprintf(__("Some widgets are still not registered: <strong>%s</strong>", 'wpdancelaparis'), implode(', ', tvlgiao_wpdance_check_status_widget_registered())); ?></p>

					<p><span class="dashicons dashicons-lightbulb"></span> <?php printf(__("If widget is <strong>commercial</strong> and <strong>not included</strong> in the theme you can ignore it.", 'wpdancelaparis')); ?></p>
					<p>
						&nbsp;
						<a href="<?php echo esc_url(tvlgiao_wpdance_this_url('skip=widget_registered')); ?>" class="button button-secondary"><?php esc_html_e("Skip this step", 'wpdancelaparis'); ?></a>
					</p>
				</div>
			</div>
			<?php endif ?>
		<?php endif ?>
	<?php 
	return ob_get_clean();
}

function tvlgiao_wpdance_content_set_front_page(){
	ob_start(); ?>
		<!-- CHECK IF FRONT PAGE IS A STATIC PAGE -->
		<?php if (tvlgiao_wpdance_check_set_front_page()): ?>
	    	<div class="updated notice">
	    		<p class="install-theme-guide-page-site-name"><?php echo esc_html(tvlgiao_wpdance_theme_name()); ?></p>
			    <span class="dashicons dashicons-yes main-icon"></span> <h3><?php esc_html_e("The homepage is a static page already", 'wpdancelaparis'); ?> </h3>
			</div>
		<?php else: ?>
			<?php if (tvlgiao_wpdance_get_current_guide_step() > 5): ?>
				<div class="updated notice accordion" data-id-panel="panel_set_front_page">
				    <p class="install-theme-guide-page-site-name"><?php echo esc_html(tvlgiao_wpdance_theme_name()); ?></p>
			    	<span class="dashicons dashicons-warning main-icon"></span> <h3><?php esc_html_e("You have skip learning about set a static page as homepage", 'wpdancelaparis'); ?> <span class="icon_plus"></span></h3>

			    	<div class="accordion_panel" id="panel_set_front_page">
					  	<div class="inside">
							<p><?php esc_html_e("Below instruction will teach you configure a static page as homepage:", 'wpdancelaparis'); ?></p>

							<p class="main-instruction"><?php printf(__("Go to <strong>Settings</strong> &gt; <strong>Reading</strong> &gt; choose <strong>Front page displays</strong> option is <strong>A static page</strong>. Then select a page in the dropdown option <strong>Front page</strong>. Click <strong>Save Changes</strong> button to save.", 'wpdancelaparis')); ?></p>

							<p><img src="<?php echo tvlgiao_wpdance_get_theme_guide_uri().'/images/set_front_page.jpg'; ?>" alt="<?php echo esc_attr("Set a static page as homepage", 'wpdancelaparis'); ?>" /></p>

							<p>
								<a href="<?php echo esc_url(tvlgiao_wpdance_reading_option_url()); ?>" class="button button-primary"><?php esc_html_e("Go to Setting Reading Page", 'wpdancelaparis'); ?></a>
							</p>
						</div>
					</div>
				</div>
			<?php else: ?>
			    <div class="update-nag notice">
					<h3><?php esc_html_e("Set a static page as homepage", 'wpdancelaparis'); ?></h3>
					<div class="inside">
						<p><?php esc_html_e("Below instruction will teach you configure a static page as homepage:", 'wpdancelaparis'); ?></p>

						<p class="main-instruction"><?php printf(__("Go to <strong>Settings</strong> &gt; <strong>Reading</strong> &gt; choose <strong>Front page displays</strong> option is <strong>A static page</strong>. Then select a page in the dropdown option <strong>Front page</strong>. Click <strong>Save Changes</strong> button to save.", 'wpdancelaparis')); ?></p>

						<p><img src="<?php echo tvlgiao_wpdance_get_theme_guide_uri().'/images/set_front_page.jpg'; ?>" alt="<?php echo esc_attr("Set a static page as homepage", 'wpdancelaparis'); ?>" /></p>

						<p>
							<a href="<?php echo esc_url(tvlgiao_wpdance_reading_option_url()); ?>" class="button button-primary"><?php esc_html_e("Go to Setting Reading Page", 'wpdancelaparis'); ?></a>
							&nbsp;
							<a href="<?php echo esc_url(tvlgiao_wpdance_this_url('skip=config_home')); ?>" class="button button-secondary"><?php esc_html_e("Skip this step", 'wpdancelaparis'); ?></a>
						</p>
					</div>
				</div>
			<?php endif ?>
		<?php endif ?>
	<?php 
	return ob_get_clean();
}

function tvlgiao_wpdance_content_button_finish_guide(){
	ob_start(); ?>
	    <p><a href="<?php echo esc_url(tvlgiao_wpdance_this_url('confirm=finish_guide')); ?>" class="button button-primary"><?php esc_html_e("Finish guide", 'wpdancelaparis'); ?></a></p>
	<?php 
	return ob_get_clean();
}

function tvlgiao_wpdance_content_restart_guide(){
	ob_start(); ?>
	    <div class="guide_card get-started">
			<span class="dashicons dashicons-welcome-learn-more main-icon"></span>
			<p><strong><?php esc_html_e("The tutorial has been completed! If you want to learn again, please press the button below. Thank you for your trust and support WDTEAM. :)", 'wpdancelaparis'); ?></strong></p>
			<p><a href="<?php echo esc_url(tvlgiao_wpdance_this_url('confirm=restart_guide')); ?>" class="button button-primary"><?php esc_html_e("Start guide again now", 'wpdancelaparis'); ?></a></p>
		</div>
	<?php 
	return ob_get_clean();
}
# -------------------------------------------------------------------------
# Request process
# -------------------------------------------------------------------------

if (@$_REQUEST['dismiss_guide_confirm'] == '1'){
	set_theme_mod( 'wpdance_setup_theme_guide_dismiss_notice', 1 );
	/*tvlgiao_wpdance_refresh_page();*/
}

if (@$_REQUEST['confirm'] == 'restart_guide'){
	set_theme_mod( 'wpdance_setup_theme_guide_step', 1 );
	set_theme_mod( 'wpdance_setup_theme_import_samples', 0 ); //not import
	set_theme_mod( 'wpdance_setup_theme_guide_dismiss_notice', 0 );
	/*tvlgiao_wpdance_refresh_page();*/
}

if (@$_REQUEST['confirm'] == 'get_started'){
	set_theme_mod( 'wpdance_setup_theme_guide_step', 1 );
	/*tvlgiao_wpdance_refresh_page();*/
}

if (count(tvlgiao_wpdance_check_status_active_plugin()) == 0 && tvlgiao_wpdance_get_current_guide_step() == 1){
	set_theme_mod( 'wpdance_setup_theme_guide_step', 2 );
}

if (count(tvlgiao_wpdance_check_status_import_data_slider()) == 0  && tvlgiao_wpdance_get_current_guide_step() == 2){
	set_theme_mod( 'wpdance_setup_theme_guide_step', 3 );
}

if (@$_REQUEST['confirm'] == 'import_samples'){
	set_theme_mod( 'wpdance_setup_theme_import_samples', 1 ); //imported
	set_theme_mod( 'wpdance_setup_theme_guide_step', 4 );
	/*tvlgiao_wpdance_refresh_page();*/
}

if (@$_REQUEST['skip'] == 'import_samples'){
	set_theme_mod( 'wpdance_setup_theme_import_samples', 2 ); //skip
	set_theme_mod( 'wpdance_setup_theme_guide_step', 4 );
	/*tvlgiao_wpdance_refresh_page();*/
}

if (@$_REQUEST['skip'] == 'widget_registered' || (count(tvlgiao_wpdance_check_status_widget_registered()) == 0  && tvlgiao_wpdance_get_current_guide_step() == 4)){
	set_theme_mod( 'wpdance_setup_theme_guide_step', 5 );
	/*tvlgiao_wpdance_refresh_page();*/
}


if (@$_REQUEST['skip'] == 'config_home'){
	set_theme_mod( 'wpdance_setup_theme_guide_step', 6 );
	/*tvlgiao_wpdance_refresh_page();*/
}

if (@$_REQUEST['confirm'] == 'finish_guide'){
	set_theme_mod( 'wpdance_setup_theme_guide_step', 7 );
	/*tvlgiao_wpdance_refresh_page();*/
}

# -------------------------------------------------------------------------
# Link to install theme guide page
# -------------------------------------------------------------------------

if(empty($_GET['page']) || $_GET['page'] != 'install_theme_guide'){
	$step = tvlgiao_wpdance_get_current_guide_step();
	if ($step && $step < 6 && get_theme_mod( 'wpdance_setup_theme_guide_dismiss_notice' , false ) != 1) {
		add_action( 'admin_notices', 'tvlgiao_wpdance_install_theme_guide_admin_notice' );
	}
}

function tvlgiao_wpdance_install_theme_guide_admin_notice(){
    ?>
    <?php if (tvlgiao_wpdance_get_current_guide_step() >= 1 && tvlgiao_wpdance_get_current_guide_step() < 6): ?>
		<div class="notice update-nag is-dismissible notice_guide_page" >
	    	<div class="inside">
		        <h3><?php echo esc_html(tvlgiao_wpdance_theme_name()); ?><?php esc_html_e(" Theme Install - Get Started", 'wpdancelaparis'); ?></h3>
		        <p><?php esc_html_e("Theme installation is in progress...", 'wpdancelaparis'); ?></p>
		        <p>
		        	<a href="<?php echo tvlgiao_wpdance_this_url(); ?>"><button class="button button-primary "><?php esc_html_e("Return Theme installation page", 'wpdancelaparis'); ?></button></a>
		        	<form name="dismiss_guide" action="" method="post">
						<input type="hidden" name="dismiss_guide_confirm" value="1"></input>
						<a href="#" onclick="document.forms['dismiss_guide'].submit(); return false;"><?php esc_html_e("Dismiss this forever!", 'wpdancelaparis'); ?></a>
					</form>
				</p>
	    	</div>
	    </div>
	<?php else: ?>
		<div class="notice update-nag is-dismissible notice_guide_page" >
	    	<div class="inside">
		        <h3><?php echo esc_html(tvlgiao_wpdance_theme_name()); ?><?php esc_html_e(" Theme - Get Started", 'wpdancelaparis'); ?></h3>
		        <p><?php esc_html_e("Many issues need to be installed before using this theme. Come WPDance Guide page on admin panel to check it!", 'wpdancelaparis'); ?></p>
		        <p>
		        	<a href="<?php echo tvlgiao_wpdance_this_url(); ?>"><button class="button button-primary "><?php esc_html_e("Click here", 'wpdancelaparis'); ?></button></a>
		        	<form name="dismiss_guide" action="" method="post">
						<input type="hidden" name="dismiss_guide_confirm" value="1"></input>
						<a href="#" onclick="document.forms['dismiss_guide'].submit(); return false;"><?php esc_html_e("Dismiss this forever!", 'wpdancelaparis'); ?></a>
					</form>
		        </p>
	    	</div>
	    </div>
    <?php endif ?>
<?php }

# -------------------------------------------------------------------------
# Create admin page
# -------------------------------------------------------------------------
add_action( 'admin_menu', 'tvlgiao_wpdance_install_theme_guide_register' );
function tvlgiao_wpdance_install_theme_guide_register()
{
    add_theme_page( //or add_menu_page
        'WPDance Guide',     // page title
        'WPDance Guide',     // menu title
        'manage_options',   // capability
        'install_theme_guide',     // menu slug
        'tvlgiao_wpdance_install_theme_guide_callback', // callback function
        'dashicons-smiley', //icon
        58 //position
    );
}

function tvlgiao_wpdance_install_theme_guide_callback(){
    global $title; ?>
    <div class="wrap wpdancebootstrap_walkthrough_page" id="wpdancebootstrap_walkthrough_page">
		<h2><?php echo esc_html(tvlgiao_wpdance_theme_name()); ?><?php esc_html_e(" Theme - Get Started", 'wpdancelaparis'); ?> <a href="<?php echo esc_url(tvlgiao_wpdance_this_url()); ?>" class="button button-primary"><?php esc_html_e("Refresh", 'wpdancelaparis'); ?></a></h2>
		<?php settings_errors(); ?>
		<br class="clear" />
		
	    <?php 
		# ---------------------------------------------------------------------
		# GET STARTED
		# ---------------------------------------------------------------------
		$step = tvlgiao_wpdance_get_current_guide_step();
		if (!$step || $step == 0) {
			echo tvlgiao_wpdance_content_get_started();
		} elseif ($step == 7) {
			echo tvlgiao_wpdance_content_restart_guide();
		} else {
			if ($step >= 1) {
				echo tvlgiao_wpdance_content_plugin_active();
			}
			if ($step >= 2) {
				echo tvlgiao_wpdance_content_import_slider();
			}
			if ($step >= 3) {
				echo tvlgiao_wpdance_content_sample_data_import();
			}
			if ($step >= 4) {
				echo tvlgiao_wpdance_content_widget_registered();
			}
			if ($step >= 5) {
				echo tvlgiao_wpdance_content_set_front_page();
			}
			if ($step >= 6  || ($step == 5 && tvlgiao_wpdance_check_set_front_page())) {
				echo tvlgiao_wpdance_content_button_finish_guide();
			}
		}
	print '</div>';
} //end content admin page
?>