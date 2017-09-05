<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "tvlgiao_wpdance_theme_options";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    /****************************************************************/
    /* DATA SETTING */ 
    include_once(TVLGIAO_WPDANCE_THEME_OPTIONS.'/default_data.php');
    $wd_default_data = tvlgiao_wpdance_theme_option_get_default_data();

    //Include demo data
    $include_data_theme_option_demo = false;

    
    /****************************************************************/

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();
    
    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }
    

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'wpdancelaparis' ),
        'page_title'           => __( 'Theme Options', 'wpdancelaparis' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => 'AIzaSyC_w3AXMF4r-htduoR5MbAonS9d_kAocac',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => 59,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );


    Redux::setArgs( $opt_name, $args );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'wpdancelaparis' );
    Redux::setHelpSidebar( $opt_name, $content );
    // -> START Basic Fields

    Redux::setSection( $opt_name, array(
        'title'            => __( 'General', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_general_setting',
        'desc'             => __( '', 'wpdancelaparis' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-cogs',
        'fields'     => array(
            array(
                'id'       => 'tvlgiao_wpdance_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Logo', 'wpdancelaparis' ),
                'compiler' => 'true',
                'desc'     => __( '', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => $wd_default_data['general']['default']['logo'],
              
            ),

            array(
                'id'       => 'tvlgiao_wpdance_favicon',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Favicon', 'wpdancelaparis' ),
                'compiler' => 'true',
                'desc'     => __( '', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => $wd_default_data['general']['default']['favicon'],
              
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Accessibility', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_accessibility',
        'desc'             => __( '', 'wpdancelaparis' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-wrench-alt',
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Breadcrumb', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_breadcrumb',
        'desc'             => __( '', 'wpdancelaparis' ),
        'subsection'       => true,
        'customizer_width' => '400px',
        'fields'     => array(
            /******************************** BREADCRUMB GENERAL *******************************/
            array(
               'id'       => 'tvlgiao_wpdance_breadcrumb_general_section_start',
                'type'     => 'section',
                'title'    => __( 'General', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'indent'   => true,
            ),

            /****************************/
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_type',
                    'type'     => 'radio',
                    'title'    => __( 'Select The Layout', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => $wd_default_data['breadcrumb']['choose']['type'],
                    'default'  => $wd_default_data['breadcrumb']['default']['type'],
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_background_color',
                    'type'     => 'color',
                    'transparent'=> false,
                    'title'    => __( 'Background Color', 'wpdancelaparis' ),
                    'subtitle' => sprintf(__( '(Default: %s).', 'wpdancelaparis' ), $wd_default_data['breadcrumb']['default']['bg_color']),
                    'default'  => $wd_default_data['breadcrumb']['default']['bg_color'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_type', '=', 'breadcrumb_default'),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_background',
                    'type'     => 'media',
                    'url'      => true,
                    'title'    => __( 'Background', 'wpdancelaparis' ),
                    'compiler' => 'true',
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'default'  => $wd_default_data['breadcrumb']['default']['background'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_type', '=', 'breadcrumb_banner'),
                ),
                array(
                    'id'             => 'tvlgiao_wpdance_breadcrumb_height',
                    'type'           => 'dimensions',
                    'units'          => false,    // You can specify a unit value. Possible: px, em, %
                    'width'          => false,   
                    'units_extended' => 'true',  // Allow users to select any type of unit
                    'title'          => __( 'Height', 'wpdancelaparis' ),
                    'subtitle'       => __( '', 'wpdancelaparis' ),
                    'desc'           => __( 'Unit: pixels', 'wpdancelaparis' ),
                    'default'        => $wd_default_data['breadcrumb']['default']['height'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_type', '!=', 'no_breadcrumb'),
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_text_color',
                    'type'     => 'color',
                    'transparent'=> false,
                    'title'    => __( 'Title & Slug Color', 'wpdancelaparis' ),
                    'subtitle' => sprintf(__( '(Default: %s).', 'wpdancelaparis' ), $wd_default_data['breadcrumb']['default']['text_color']),
                    'default'  => $wd_default_data['breadcrumb']['default']['text_color'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_type', '!=', 'no_breadcrumb'),
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_text_style',
                    'type'     => 'radio',
                    'title'    => __( 'Title & Slug Style', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => $wd_default_data['breadcrumb']['choose']['text_style'],
                    'default'  => $wd_default_data['breadcrumb']['default']['text_style'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_type', '!=', 'no_breadcrumb'),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_text_align',
                    'type'     => 'select',
                    'title'    => __( 'Text Align', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => $wd_default_data['breadcrumb']['choose']['text_align'],
                    'default'  => $wd_default_data['breadcrumb']['default']['text_align'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_text_style', '=', 'block'),
                ),
            /****************************/
            array(
                'id'     => 'tvlgiao_wpdance_breadcrumb_general_section_end',
                'type'   => 'section',
                'indent' => false,
            ),
            /******************************** BREADCRUMB ARCHIVE BLOG *******************************/
            array(
               'id'       => 'tvlgiao_wpdance_breadcrumb_archive_blog_section_start',
                'type'     => 'section',
                'title'    => __( 'Blog Archive', 'wpdancelaparis' ),
                'subtitle' => __( 'Disable this if you want to use the settings in the General section', 'wpdancelaparis' ),
                'indent'   => true,
            ),

            /****************************/
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_archive_blog_customize',
                    'type'     => 'switch',
                    'title'    => __( 'Customize', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'default'  => false,
                    'on'       => 'Enable',
                    'off'      => 'Disable',
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_archive_blog_type',
                    'type'     => 'radio',
                    'title'    => __( 'Select The Layout', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => $wd_default_data['breadcrumb']['choose']['type'],
                    'default'  => $wd_default_data['breadcrumb']['default']['type'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_archive_blog_customize', '=', '1'),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_archive_blog_background_color',
                    'type'     => 'color',
                    'transparent'=> false,
                    'title'    => __( 'Background Color', 'wpdancelaparis' ),
                    'subtitle' => sprintf(__( '(Default: %s).', 'wpdancelaparis' ), $wd_default_data['breadcrumb']['default']['bg_color']),
                    'default'  => $wd_default_data['breadcrumb']['default']['bg_color'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_archive_blog_type', '=', 'breadcrumb_default'),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_archive_blog_background',
                    'type'     => 'media',
                    'url'      => true,
                    'title'    => __( 'Background', 'wpdancelaparis' ),
                    'compiler' => 'true',
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'default'  => $wd_default_data['breadcrumb']['default']['background'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_archive_blog_type', '=', 'breadcrumb_banner'),
                ),
                array(
                    'id'             => 'tvlgiao_wpdance_breadcrumb_archive_blog_height',
                    'type'           => 'dimensions',
                    'units'          => false,    // You can specify a unit value. Possible: px, em, %
                    'width'          => false,   
                    'units_extended' => 'true',  // Allow users to select any type of unit
                    'title'          => __( 'Height', 'wpdancelaparis' ),
                    'subtitle'       => __( '', 'wpdancelaparis' ),
                    'desc'           => __( 'Unit: pixels', 'wpdancelaparis' ),
                    'default'        => $wd_default_data['breadcrumb']['default']['height'],
                    'required'       => array('tvlgiao_wpdance_breadcrumb_archive_blog_type', '!=', 'no_breadcrumb'),
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_archive_blog_text_color',
                    'type'     => 'color',
                    'transparent'=> false,
                    'title'    => __( 'Title & Slug Color', 'wpdancelaparis' ),
                    'subtitle' => sprintf(__( '(Default: %s).', 'wpdancelaparis' ), $wd_default_data['breadcrumb']['default']['text_color']),
                    'default'  => $wd_default_data['breadcrumb']['default']['text_color'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_archive_blog_type', '!=', 'no_breadcrumb'),
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_archive_blog_text_style',
                    'type'     => 'radio',
                    'title'    => __( 'Title & Slug Style', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => $wd_default_data['breadcrumb']['choose']['text_style'],
                    'default'  => $wd_default_data['breadcrumb']['default']['text_style'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_archive_blog_type', '!=', 'no_breadcrumb'),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_archive_blog_text_align',
                    'type'     => 'select',
                    'title'    => __( 'Text Align', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => $wd_default_data['breadcrumb']['choose']['text_align'],
                    'default'  => $wd_default_data['breadcrumb']['default']['text_align'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_archive_blog_text_style', '=', 'block'),
                ),
            /****************************/
            array(
                'id'     => 'tvlgiao_wpdance_breadcrumb_archive_blog_section_end',
                'type'   => 'section',
                'indent' => false,
            ),
            /******************************** BREADCRUMB ARCHIVE PRODUCT *******************************/
            array(
               'id'       => 'tvlgiao_wpdance_breadcrumb_archive_product_section_start',
                'type'     => 'section',
                'title'    => __( 'Product Archive', 'wpdancelaparis' ),
                'subtitle' => __( 'Use for Product Taxonomy Archive/Product Category. Disable this if you want to use the settings in the General section', 'wpdancelaparis' ),
                'indent'   => true,
            ),

            /****************************/
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_archive_product_customize',
                    'type'     => 'switch',
                    'title'    => __( 'Customize', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'default'  => false,
                    'on'       => 'Enable',
                    'off'      => 'Disable',
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_archive_product_type',
                    'type'     => 'radio',
                    'title'    => __( 'Select The Layout', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => $wd_default_data['breadcrumb']['choose']['type'],
                    'default'  => $wd_default_data['breadcrumb']['default']['type'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_archive_product_customize', '=', '1'),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_archive_product_background_color',
                    'type'     => 'color',
                    'transparent'=> false,
                    'title'    => __( 'Background Color', 'wpdancelaparis' ),
                    'subtitle' => sprintf(__( '(Default: %s).', 'wpdancelaparis' ), $wd_default_data['breadcrumb']['default']['bg_color']),
                    'default'  => $wd_default_data['breadcrumb']['default']['bg_color'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_archive_product_type', '=', 'breadcrumb_default'),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_archive_product_background',
                    'type'     => 'media',
                    'url'      => true,
                    'title'    => __( 'Background', 'wpdancelaparis' ),
                    'compiler' => 'true',
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'default'  => $wd_default_data['breadcrumb']['default']['background'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_archive_product_type', '=', 'breadcrumb_banner'),
                ),
                array(
                    'id'             => 'tvlgiao_wpdance_breadcrumb_archive_product_height',
                    'type'           => 'dimensions',
                    'units'          => false,    // You can specify a unit value. Possible: px, em, %
                    'width'          => false,   
                    'units_extended' => 'true',  // Allow users to select any type of unit
                    'title'          => __( 'Height', 'wpdancelaparis' ),
                    'subtitle'       => __( '', 'wpdancelaparis' ),
                    'desc'           => __( 'Unit: pixels', 'wpdancelaparis' ),
                    'default'        => $wd_default_data['breadcrumb']['default']['height'],
                    'required'       => array('tvlgiao_wpdance_breadcrumb_archive_product_type', '!=', 'no_breadcrumb'),
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_archive_product_text_color',
                    'type'     => 'color',
                    'transparent'=> false,
                    'title'    => __( 'Title & Slug Color', 'wpdancelaparis' ),
                    'subtitle' => sprintf(__( '(Default: %s).', 'wpdancelaparis' ), $wd_default_data['breadcrumb']['default']['text_color']),
                    'default'  => $wd_default_data['breadcrumb']['default']['text_color'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_archive_product_type', '!=', 'no_breadcrumb'),
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_archive_product_text_style',
                    'type'     => 'radio',
                    'title'    => __( 'Title & Slug Style', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => $wd_default_data['breadcrumb']['choose']['text_style'],
                    'default'  => $wd_default_data['breadcrumb']['default']['text_style'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_archive_product_type', '!=', 'no_breadcrumb'),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_archive_product_text_align',
                    'type'     => 'select',
                    'title'    => __( 'Text Align', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => $wd_default_data['breadcrumb']['choose']['text_align'],
                    'default'  => $wd_default_data['breadcrumb']['default']['text_align'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_archive_product_text_style', '=', 'block'),
                ),
            /****************************/
            array(
                'id'     => 'tvlgiao_wpdance_breadcrumb_archive_product_section_end',
                'type'   => 'section',
                'indent' => false,
            ),

            /******************************** WOOCOMMERCE SPECIAL PAGE PAGE *******************************/
            array(
               'id'        => 'tvlgiao_wpdance_breadcrumb_woo_special_page_section_start',
                'type'     => 'section',
                'title'    => __( 'Woocommerce Special Page', 'wpdancelaparis' ),
                'subtitle' => __( 'Use for Cart/Checkout page. Disable this if you want to use the settings in the General section', 'wpdancelaparis' ),
                'indent'   => true,
            ),

            /****************************/
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_woo_special_page_customize',
                    'type'     => 'switch',
                    'title'    => __( 'Customize', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'default'  => false,
                    'on'       => 'Enable',
                    'off'      => 'Disable',
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_woo_special_page_type',
                    'type'     => 'radio',
                    'title'    => __( 'Select The Layout', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => $wd_default_data['breadcrumb']['choose']['type'],
                    'default'  => $wd_default_data['breadcrumb']['default']['type'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_woo_special_page_customize', '=', '1'),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_woo_special_page_background_color',
                    'type'     => 'color',
                    'transparent'=> false,
                    'title'    => __( 'Background Color', 'wpdancelaparis' ),
                    'subtitle' => sprintf(__( '(Default: %s).', 'wpdancelaparis' ), $wd_default_data['breadcrumb']['default']['bg_color']),
                    'default'  => $wd_default_data['breadcrumb']['default']['bg_color'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_woo_special_page_type', '=', 'breadcrumb_default'),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_woo_special_page_background',
                    'type'     => 'media',
                    'url'      => true,
                    'title'    => __( 'Background', 'wpdancelaparis' ),
                    'compiler' => 'true',
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'default'  => $wd_default_data['breadcrumb']['default']['background'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_woo_special_page_type', '=', 'breadcrumb_banner'),
                ),
                array(
                    'id'             => 'tvlgiao_wpdance_breadcrumb_woo_special_page_height',
                    'type'           => 'dimensions',
                    'units'          => false,    // You can specify a unit value. Possible: px, em, %
                    'width'          => false,   
                    'units_extended' => 'true',  // Allow users to select any type of unit
                    'title'          => __( 'Height', 'wpdancelaparis' ),
                    'subtitle'       => __( '', 'wpdancelaparis' ),
                    'desc'           => __( 'Unit: pixels', 'wpdancelaparis' ),
                    'default'        => $wd_default_data['breadcrumb']['default']['height'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_woo_special_page_type', '!=', 'no_breadcrumb'),
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_woo_special_page_text_color',
                    'type'     => 'color',
                    'transparent'=> false,
                    'title'    => __( 'Title & Slug Color', 'wpdancelaparis' ),
                    'subtitle' => sprintf(__( '(Default: %s).', 'wpdancelaparis' ), $wd_default_data['breadcrumb']['default']['text_color']),
                    'default'  => $wd_default_data['breadcrumb']['default']['text_color'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_woo_special_page_type', '!=', 'no_breadcrumb'),
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_woo_special_page_text_style',
                    'type'     => 'radio',
                    'title'    => __( 'Title & Slug Style', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => $wd_default_data['breadcrumb']['choose']['text_style'],
                    'default'  => $wd_default_data['breadcrumb']['default']['text_style'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_woo_special_page_type', '!=', 'no_breadcrumb'),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_woo_special_page_text_align',
                    'type'     => 'select',
                    'title'    => __( 'Text Align', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => $wd_default_data['breadcrumb']['choose']['text_align'],
                    'default'  => $wd_default_data['breadcrumb']['default']['text_align'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_woo_special_page_text_style', '=', 'block'),
                ),
            /****************************/
            array(
                'id'     => 'tvlgiao_wpdance_breadcrumb_woo_special_page_section_end',
                'type'   => 'section',
                'indent' => false,
            ),

            /******************************** SEARCH PAGE *******************************/
            array(
               'id'       => 'tvlgiao_wpdance_breadcrumb_search_page_section_start',
                'type'     => 'section',
                'title'    => __( 'Search Page', 'wpdancelaparis' ),
                'subtitle' => __( 'Disable this if you want to use the settings in the General section', 'wpdancelaparis' ),
                'indent'   => true,
            ),

            /****************************/
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_search_page_customize',
                    'type'     => 'switch',
                    'title'    => __( 'Customize', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'default'  => false,
                    'on'       => 'Enable',
                    'off'      => 'Disable',
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_search_page_type',
                    'type'     => 'radio',
                    'title'    => __( 'Select The Layout', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => $wd_default_data['breadcrumb']['choose']['type'],
                    'default'  => $wd_default_data['breadcrumb']['default']['type'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_search_page_customize', '=', '1'),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_search_page_background_color',
                    'type'     => 'color',
                    'transparent'=> false,
                    'title'    => __( 'Background Color', 'wpdancelaparis' ),
                    'subtitle' => sprintf(__( '(Default: %s).', 'wpdancelaparis' ), $wd_default_data['breadcrumb']['default']['bg_color']),
                    'default'  => $wd_default_data['breadcrumb']['default']['bg_color'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_search_page_type', '=', 'breadcrumb_default'),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_search_page_background',
                    'type'     => 'media',
                    'url'      => true,
                    'title'    => __( 'Background', 'wpdancelaparis' ),
                    'compiler' => 'true',
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'default'  => $wd_default_data['breadcrumb']['default']['background'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_search_page_type', '=', 'breadcrumb_banner'),
                ),
                array(
                    'id'             => 'tvlgiao_wpdance_breadcrumb_search_page_height',
                    'type'           => 'dimensions',
                    'units'          => false,    // You can specify a unit value. Possible: px, em, %
                    'width'          => false,   
                    'units_extended' => 'true',  // Allow users to select any type of unit
                    'title'          => __( 'Height', 'wpdancelaparis' ),
                    'subtitle'       => __( '', 'wpdancelaparis' ),
                    'desc'           => __( 'Unit: pixels', 'wpdancelaparis' ),
                    'default'        => $wd_default_data['breadcrumb']['default']['height'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_search_page_type', '!=', 'no_breadcrumb'),
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_search_page_text_color',
                    'type'     => 'color',
                    'transparent'=> false,
                    'title'    => __( 'Title & Slug Color', 'wpdancelaparis' ),
                    'subtitle' => sprintf(__( '(Default: %s).', 'wpdancelaparis' ), $wd_default_data['breadcrumb']['default']['text_color']),
                    'default'  => $wd_default_data['breadcrumb']['default']['text_color'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_search_page_type', '!=', 'no_breadcrumb'),
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_search_page_text_style',
                    'type'     => 'radio',
                    'title'    => __( 'Title & Slug Style', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => $wd_default_data['breadcrumb']['choose']['text_style'],
                    'default'  => $wd_default_data['breadcrumb']['default']['text_style'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_search_page_type', '!=', 'no_breadcrumb'),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_breadcrumb_search_page_text_align',
                    'type'     => 'select',
                    'title'    => __( 'Text Align', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => $wd_default_data['breadcrumb']['choose']['text_align'],
                    'default'  => $wd_default_data['breadcrumb']['default']['text_align'],
                    'required' => array('tvlgiao_wpdance_breadcrumb_search_page_text_style', '=', 'block'),
                ),
            /****************************/
            array(
                'id'     => 'tvlgiao_wpdance_breadcrumb_search_page_section_end',
                'type'   => 'section',
                'indent' => false,
            ),
        ) 
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Back To Top', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_back_to_top',
        'desc'             => __( 'This feature will not show on mobile devices!', 'wpdancelaparis' ),
        'subsection'       => true,
        'customizer_width' => '400px',
        'fields'     => array(
            array(
                'id'       => 'tvlgiao_wpdance_back_to_top_display',
                'type'     => 'switch',
                'title'    => __( 'Display', 'wpdancelaparis' ),
                'subtitle' => __( 'Enable/Disable scroll button in website.', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_back_to_top_style',
                'type'     => 'radio',
                'title'    => __( 'Select Style', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => $wd_default_data['back_to_top']['choose']['style'],
                'default'  => $wd_default_data['back_to_top']['default']['style'],
                'required' => array('tvlgiao_wpdance_back_to_top_display','=','1'),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_back_to_top_background_color',
                'type'     => 'color',
                'transparent'=> true,
                'title'    => __( 'Background Color', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => $wd_default_data['back_to_top']['default']['bg_color'],
                'required' => array('tvlgiao_wpdance_back_to_top_style', '=', '0'),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_back_to_top_border_color',
                'type'     => 'color',
                'transparent'=> true,
                'title'    => __( 'Border Color', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => $wd_default_data['back_to_top']['default']['border_color'],
                'required' => array('tvlgiao_wpdance_back_to_top_style', '=', '0'),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_back_to_top_background_shape',
                'type'     => 'radio',
                'title'    => __( 'Background Shape', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => $wd_default_data['back_to_top']['choose']['bg_shape'],
                'default'  => $wd_default_data['back_to_top']['default']['bg_shape'],
                'required' => array('tvlgiao_wpdance_back_to_top_style', '=', '0'),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_back_to_top_select_icon',
                'type'     => 'select',
                'data'     => 'elusive-icons',
                'title'    => __( 'Select Icon', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'default'  => $wd_default_data['back_to_top']['default']['icon'],
                'required' => array('tvlgiao_wpdance_back_to_top_display','=','1'),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_back_to_top_icon_color',
                'type'     => 'color',
                'transparent'=> false,
                'title'    => __( 'Icon Color', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => $wd_default_data['back_to_top']['default']['icon_color'],
                'required' => array('tvlgiao_wpdance_back_to_top_display', '=', '1'),
            ),
        ) 
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Social Share', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_share_button',
        'desc'             => __( '', 'wpdancelaparis' ),
        'subsection'       => true,
        'customizer_width' => '400px',
        'fields'     => array(
            array(
                'id'       => 'tvlgiao_wpdance_share_button_display',
                'type'     => 'switch',
                'title'    => __( 'Display', 'wpdancelaparis' ),
                'subtitle' => __( 'Enable/Disable all social share button in website.', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_share_button_custom_pubid',
                'type'     => 'text',
                'title'    => __( 'Addthis Profile ID', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'default'  => 'ra-547e8f2f2a326738',
                'required' => array('tvlgiao_wpdance_share_button_display','=','1'),
            ),
            
        ) 
    ) );
    

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Header', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_header',
        'desc'             => __( '', 'wpdancelaparis' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-arrow-up',
        'fields'     => array(
            array(
                'id'       => 'tvlgiao_wpdance_header_layout',
                'type'     => 'select',
                'tiles'    => true,
                'title'    => __( 'Select The Layout', 'wpdancelaparis' ),
                'desc'     => __( 'Dont select to use default template', 'wpdancelaparis' ),
                'data'  => 'posts',
                'args'  => array(
                    'post_type'      => 'wpdance_header',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                ),
            ),
            array(
               'id'       => 'tvlgiao_wpdance_header_section_start',
                'type'     => 'section',
                'title'    => __( 'Header Default Settings', 'wpdancelaparis' ),
                'subtitle' => __( 'The custom sections below are only visible to the default header.', 'wpdancelaparis' ),
                'indent'   => true,
                'required' => array('tvlgiao_wpdance_header_layout','=',''),
            ),

            /****************************/
                array(
                    'id'       => 'tvlgiao_wpdance_header_show_site_title',
                    'type'     => 'button_set',
                    'title'    => __( 'Title/Logo', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => array(
                        '0'    => __( 'Show Logo', 'wpdancelaparis' ),
                        '1'    => __( 'Show Site Title', 'wpdancelaparis' ),
                    ),
                    'default'  => '1',
                    'required' => array('tvlgiao_wpdance_header_layout','=',''),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_header_logo',
                    'type'     => 'media',
                    'url'      => true,
                    'title'    => __( 'Custom Logo', 'wpdancelaparis' ),
                    'compiler' => 'true',
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'subtitle' => __( 'If no image is selected, the header will use Logo in the general settings', 'wpdancelaparis' ),
                    'default'  => $wd_default_data['general']['default']['logo'],
                    'required' => array('tvlgiao_wpdance_header_show_site_title','=','0'),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_header_menu_location',
                    'type'     => 'radio',
                    'title'    => __( 'Select Menu Locations', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'data'     => 'menu_locations',
                    'default'  => 'primary',
                    'required' => array('tvlgiao_wpdance_header_layout','=',''),
                ),
            /****************************/
            
            array(
                'id'     => 'tvlgiao_wpdance_header_section_end',
                'type'   => 'section',
                'indent' => false,
                'required' => array('tvlgiao_wpdance_header_layout','=',''),
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => __( 'Footer', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_footer',
        'desc'             => __( '', 'wpdancelaparis' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-arrow-down',
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_footer_layout',
                'type'     => 'select',
                'tiles'    => true,
                'title'    => __( 'Select The Layout', 'wpdancelaparis' ),
                'desc'     => __( 'Dont select to use default template', 'wpdancelaparis' ),
                'data'  => 'posts',
                'args'  => array(
                    'post_type'      => 'wpdance_footer',
                    'posts_per_page' => 100,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                ),
            ),

            array(
               'id'       => 'tvlgiao_wpdance_footer_section_start',
                'type'     => 'section',
                'title'    => __( 'Footer Default Settings', 'wpdancelaparis' ),
                'subtitle' => __( 'The custom sections below are only visible to the default footer.', 'wpdancelaparis' ),
                'indent'   => true,
                'required' => array('tvlgiao_wpdance_footer_layout','=',''),
            ),

            /****************************/
                array(
                    'id'       => 'tvlgiao_wpdance_footer_logo',
                    'type'     => 'media',
                    'url'      => true,
                    'title'    => __( 'Custom Logo', 'wpdancelaparis' ),
                    'compiler' => 'true',
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'subtitle' => __( 'If no image is selected, the footer will use Logo in the general settings', 'wpdancelaparis' ),
                    'default'  => $wd_default_data['general']['default']['logo'],
                    'required' => array('tvlgiao_wpdance_footer_layout','=',''),
                ),

                array(
                    'id'      => 'tvlgiao_wpdance_footer_copyright_text',
                    'type'    => 'editor',
                    'title'   => __( 'Copyright Text', 'wpdancelaparis' ),
                    'default' => sprintf(__( 'Copyright %s. All rights reserved.', 'wpdancelaparis' ), esc_html( get_bloginfo('name')) ),
                    'args'    => array(
                        'wpautop'       => false,
                        'media_buttons' => false,
                        'textarea_rows' => 5,
                        //'tabindex' => 1,
                        //'editor_css' => '',
                        'teeny'         => false,
                        //'tinymce' => array(),
                        'quicktags'     => false,
                    ),
                    'required' => array('tvlgiao_wpdance_footer_layout','=',''),
                ),
            /****************************/
            
            array(
                'id'     => 'tvlgiao_wpdance_footer_section_end',
                'type'   => 'section',
                'indent' => false,
                'required' => array('tvlgiao_wpdance_footer_layout','=',''),
            ),
            
        ) 
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Comments', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_comment_setting',
        'desc'             => __( '', 'wpdancelaparis' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-comment-alt',
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_comment_sorter',
                'type'     => 'sortable',
                'mode'     => 'checkbox', // checkbox or text
                'title'    => __( 'Comment Form', 'wpdancelaparis' ),
                'subtitle' => __( 'Define and reorder these however you want.', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => $wd_default_data['comment']['choose']['sorter'],
                'default'  => $wd_default_data['comment']['default']['sorter'],
            ),

            array(
               'id'       => 'tvlgiao_wpdance_comment_setting_section_start',
                'type'     => 'section',
                'title'    => __( 'Facebook Comment Settings', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'indent'   => true,
            ),

            /****************************/
                array(
                    'id'       => 'tvlgiao_wpdance_comment_facebook_display_on_single_product',
                    'type'     => 'switch',
                    'title'    => __( 'Single Product', 'wpdancelaparis' ),
                    'subtitle' => __( 'Show facebook comment form on product details page', 'wpdancelaparis' ),
                    'default'  => $wd_default_data['comment']['default']['single_product'],
                    'on'       => 'Show',
                    'off'      => 'Hide',
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_comment_facebook_user_id',
                    'type'     => 'text',
                    'title'    => __( 'User ID', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( 'Enter the facebook id of the administrator', 'wpdancelaparis' ),
                    'default'  => $wd_default_data['comment']['default']['user_id'],
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_comment_facebook_app_id',
                    'type'     => 'text',
                    'title'    => __( 'App ID', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'default'  => $wd_default_data['comment']['default']['app_id'],
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_comment_facebook_number_comment_display',
                    'type'     => 'text',
                    'title'    => __( 'Number Comment Display', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'default'  => $wd_default_data['comment']['default']['number_comment'],
                ),

                 array(
                    'id'       => 'tvlgiao_wpdance_comment_facebook_mode',
                    'type'     => 'button_set',
                    'title'    => __( 'Comment Mode', 'wpdancelaparis' ),
                    'subtitle' => __( 'Select "Multi Domain" if you intend to change the domain and want to keep the old comments.', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => $wd_default_data['comment']['choose']['mode'],
                    'default'  => $wd_default_data['comment']['default']['mode'],
                ),
            /****************************/
            
            array(
                'id'     => 'tvlgiao_wpdance_comment_setting_section_end',
                'type'   => 'section',
                'indent' => false,
            ),
        )
    ) );

    

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Blog Settings', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_blog_setting',
        'desc'             => __( '', 'wpdancelaparis' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-edit'
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Blog Config', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_layout_blog_config',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => __( '', 'wpdancelaparis' ),
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_config_title_display',
                'type'     => 'switch',
                'title'    => __( 'Blog Title', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_config_thumbnail_display',
                'type'     => 'switch',
                'title'    => __( 'Blog Thumbnail', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
            array(
               'id'       => 'tvlgiao_wpdance_layout_blog_config_thumbnail_section_start',
                'type'     => 'section',
                'title'    => __( 'Blog Thumbnail Settings', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'indent'   => true,
                'required' => array('tvlgiao_wpdance_layout_blog_config_thumbnail_display','=', '1' ),
            ),

            /****************************/
                array(
                    'id'       => 'tvlgiao_wpdance_layout_blog_config_show_by_post_format',
                    'type'     => 'switch',
                    'title'    => __( 'Show By Post Format', 'wpdancelaparis' ),
                    'subtitle' => __( 'Enable to display posts by post format (video, audio, quote, gallery ...)', 'wpdancelaparis' ),
                    'default'  => true,
                    'on'       => 'Show',
                    'off'      => 'Hide',
                    'required' => array('tvlgiao_wpdance_layout_blog_config_thumbnail_display','=', '1' ),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_layout_blog_config_thumbnail_placeholder',
                    'type'     => 'switch',
                    'title'    => __( 'Placeholder Image', 'wpdancelaparis' ),
                    'subtitle' => __( 'Placeholder image display when post no thumbnail', 'wpdancelaparis' ),
                    'default'  => false,
                    'on'       => 'Show',
                    'off'      => 'Hide',
                    'required' => array('tvlgiao_wpdance_layout_blog_config_thumbnail_display','=', '1' ),
                ),
            /****************************/
            
            array(
                'id'     => 'tvlgiao_wpdance_layout_blog_config_thumbnail_section_end',
                'type'   => 'section',
                'indent' => false,
                'required' => array('tvlgiao_wpdance_layout_blog_single_recent_post','=', '1' ),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_config_date_display',
                'type'     => 'switch',
                'title'    => __( 'Blog Date', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_config_author_display',
                'type'     => 'switch',
                'title'    => __( 'Blog Author', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_config_number_comment_display',
                'type'     => 'switch',
                'title'    => __( 'Number Comment', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_config_category_display',
                'type'     => 'switch',
                'title'    => __( 'Blog Category', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_config_excerpt_display',
                'type'     => 'switch',
                'title'    => __( 'Blog Excerpt', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_config_number_excerpt_word',
                'type'     => 'text',
                'title'    => __( 'Number Excerpt Word', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'default'  => '20',
                'required' => array('tvlgiao_wpdance_layout_blog_config_excerpt_display','=', '1' ),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_config_readmore_display',
                'type'     => 'switch',
                'title'    => __( 'Readmore Button', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            
        )
    ) );



    Redux::setSection( $opt_name, array(
        'title'            => __( 'Blog Archive', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_layout_blog_archive',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => __( '', 'wpdancelaparis' ),
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_archive_layout',
                'type'     => 'image_select',
                'title'    => __( 'Select The Layout', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => $wd_default_data['layout']['choose']['layout'],
                'default'  => $wd_default_data['layout']['default']['layout'],
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_archive_left_sidebar',
                'type'     => 'select',
                'title'    => __( 'Select Left Sidebar', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'data'     => 'sidebars',
                'default'  => $wd_default_data['sidebar']['default']['blog_archive_left'],
                'required' => array('tvlgiao_wpdance_layout_blog_archive_layout','=',array( '1-0-0', '1-0-1' ) ),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_archive_right_sidebar',
                'type'     => 'select',
                'title'    => __( 'Select Right Sidebar', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'data'     => 'sidebars',
                'default'  => $wd_default_data['sidebar']['default']['blog_archive_right'],
                'required' => array('tvlgiao_wpdance_layout_blog_archive_layout','=',array( '0-0-1', '1-0-1' ) ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Blog Single', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_layout_blog_single',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => __( '', 'wpdancelaparis' ),
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_single_layout',
                'type'     => 'image_select',
                'title'    => __( 'Select The Layout', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => $wd_default_data['layout']['choose']['layout'],
                'default'  => $wd_default_data['layout']['default']['layout'],
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_single_left_sidebar',
                'type'     => 'select',
                'title'    => __( 'Select Left Sidebar', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'data'     => 'sidebars',
                'default'  => $wd_default_data['sidebar']['default']['blog_single_left'],
                'required' => array('tvlgiao_wpdance_layout_blog_single_layout','=',array( '1-0-0', '1-0-1' ) ),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_single_right_sidebar',
                'type'     => 'select',
                'title'    => __( 'Select Right Sidebar', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'data'     => 'sidebars',
                'default'  => $wd_default_data['sidebar']['default']['blog_single_right'],
                'required' => array('tvlgiao_wpdance_layout_blog_single_layout','=',array( '0-0-1', '1-0-1' ) ),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_single_author_information',
                'type'     => 'switch',
                'title'    => __( 'Author Information', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_single_previous_next_button',
                'type'     => 'switch',
                'title'    => __( 'Previous/Next Button', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_single_recent_post',
                'type'     => 'switch',
                'title'    => __( 'Recent Blog', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
               'id'       => 'tvlgiao_wpdance_layout_blog_single_recent_post_section_start',
                'type'     => 'section',
                'title'    => __( 'Recent Blog Settings', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'indent'   => true,
                'required' => array('tvlgiao_wpdance_layout_blog_single_recent_post','=', '1' ),
            ),

            /****************************/
                array(
                    'id'       => 'tvlgiao_wpdance_layout_blog_single_recent_post_style',
                    'type'     => 'radio',
                    'title'    => __( 'Recent Blog Style', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'options'  => array(
                        'list' => __( 'List', 'wpdancelaparis' ),
                        'grid' => __( 'Grid', 'wpdancelaparis' ),
                    ),
                    'default'  => 'list',
                    'required' => array('tvlgiao_wpdance_layout_blog_single_recent_post','=', '1' ),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_layout_blog_single_recent_post_is_slider',
                    'type'     => 'switch',
                    'title'    => __( 'Is Slider?', 'wpdancelaparis' ),
                    'subtitle' => __( 'Recent blog will display in slider style?', 'wpdancelaparis' ),
                    'default'  => true,
                    'on'       => 'Yes',
                    'off'      => 'No',
                    'required' => array('tvlgiao_wpdance_layout_blog_single_recent_post','=', '1' ),
                ),
                array(
                    'id'       => 'tvlgiao_wpdance_layout_blog_single_recent_post_columns',
                    'type'     => 'text',
                    'title'    => __( 'Columns', 'wpdancelaparis' ),
                    'subtitle' => __( 'Number of columns displayed with slider', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'default'  => '2',
                    'required' => array('tvlgiao_wpdance_layout_blog_single_recent_post_is_slider','=', '1' ),
                ),
            /****************************/
            
            array(
                'id'     => 'tvlgiao_wpdance_layout_blog_single_recent_post_section_end',
                'type'   => 'section',
                'indent' => false,
                'required' => array('tvlgiao_wpdance_layout_blog_single_recent_post','=', '1' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Blog Default Layout', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_layout_blog_default',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => __( '', 'wpdancelaparis' ),
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_default_layout',
                'type'     => 'image_select',
                'title'    => __( 'Select The Layout', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => $wd_default_data['layout']['choose']['layout'],
                'default'  => $wd_default_data['layout']['default']['layout'],
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_default_left_sidebar',
                'type'     => 'select',
                'title'    => __( 'Select Left Sidebar', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'data'     => 'sidebars',
                'default'  => $wd_default_data['sidebar']['default']['blog_default_left'],
                'required' => array('tvlgiao_wpdance_layout_blog_default_layout','=',array( '1-0-0', '1-0-1' ) ),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_blog_default_right_sidebar',
                'type'     => 'select',
                'title'    => __( 'Select Right Sidebar', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'data'     => 'sidebars',
                'default'  => $wd_default_data['sidebar']['default']['blog_default_right'],
                'required' => array('tvlgiao_wpdance_layout_blog_default_layout','=',array( '0-0-1', '1-0-1' ) ),
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => __( 'Page Settings', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_page_setting',
        'desc'             => __( '', 'wpdancelaparis' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-file'
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Default Page', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_layout_page_default',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => __( '', 'wpdancelaparis' ),
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_layout_page_default_layout',
                'type'     => 'image_select',
                'title'    => __( 'Select The Layout', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => $wd_default_data['layout']['choose']['layout'],
                'default'  => $wd_default_data['layout']['default']['layout'],
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_page_default_left_sidebar',
                'type'     => 'select',
                'title'    => __( 'Select Left Sidebar', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'data'     => 'sidebars',
                'default'  => $wd_default_data['sidebar']['default']['page_default_left'],
                'required' => array('tvlgiao_wpdance_layout_page_default_layout','=',array( '1-0-0', '1-0-1' ) ),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_page_default_right_sidebar',
                'type'     => 'select',
                'title'    => __( 'Select Right Sidebar', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'data'     => 'sidebars',
                'default'  => $wd_default_data['sidebar']['default']['page_default_right'],
                'required' => array('tvlgiao_wpdance_layout_page_default_layout','=',array( '0-0-1', '1-0-1' ) ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( '404 Page', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_layout_page_404',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => __( '', 'wpdancelaparis' ),
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_layout_page_404_background_style',
                'type'     => 'radio',
                'title'    => __( 'Background Style', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => array(
                    'bg_image'          => esc_html__( 'Background Image', 'wpdancelaparis' ),
                    'bg_color'          => esc_html__( 'Background Color', 'wpdancelaparis' ),
                ),
                'default'  => 'bg_image',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_page_404_background_color',
                'type'     => 'color',
                'transparent'=> false,
                'title'    => __( 'Background Color', 'wpdancelaparis' ),
                'subtitle' => __( '(default: #fff).', 'wpdancelaparis' ),
                'default'  => '#fff',
                'required' => array('tvlgiao_wpdance_layout_page_404_background_style', '=', 'bg_color'),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_page_404_background_image',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Background Image', 'wpdancelaparis' ),
                'compiler' => 'true',
                'desc'     => __( '', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => array( 'url' => TVLGIAO_WPDANCE_THEME_IMAGES.'/bg_404.jpg' ),
                'required' => array('tvlgiao_wpdance_layout_page_404_background_style', '=', 'bg_image'),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_page_404_show_header_footer',
                'type'     => 'switch',
                'title'    => __( 'Header & Footer', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_page_404_show_search_form',
                'type'     => 'switch',
                'title'    => __( 'Search Form', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_page_404_show_back_to_home_button',
                'type'     => 'switch',
                'title'    => __( 'Back To Home Button', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
            array(
               'id'       => 'tvlgiao_wpdance_layout_page_404_show_back_to_home_button_section_start',
                'type'     => 'section',
                'title'    => __( 'Button Settings', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'indent'   => true,
                'required' => array('tvlgiao_wpdance_layout_page_404_show_back_to_home_button','=', '1' ),
            ),

            /****************************/
                array(
                    'id'       => 'tvlgiao_wpdance_layout_page_404_show_back_to_home_button_text',
                    'type'     => 'text',
                    'title'    => __( 'Text Button', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'default'  => 'Back To Homepage',
                    'required' => array('tvlgiao_wpdance_layout_page_404_show_back_to_home_button', '=', '1'),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_layout_page_404_show_back_to_home_button_class',
                    'type'     => 'text',
                    'title'    => __( 'Class Button', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'default'  => '',
                    'required' => array('tvlgiao_wpdance_layout_page_404_show_back_to_home_button', '=', '1'),
                ),
            /****************************/
            
            array(
                'id'        => 'tvlgiao_wpdance_layout_page_404_show_back_to_home_button_section_end',
                'type'      => 'section',
                'indent'    => false,
                'required'  => array('tvlgiao_wpdance_layout_page_404_show_back_to_home_button','=', '1' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Search Page', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_layout_page_search',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => __( '', 'wpdancelaparis' ),
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_layout_page_search_background_style',
                'type'     => 'radio',
                'title'    => __( 'Background Style', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => array(
                    'bg_image'          => esc_html__( 'Background Image', 'wpdancelaparis' ),
                    'bg_color'          => esc_html__( 'Background Color', 'wpdancelaparis' ),
                ),
                'default'  => 'bg_image',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_page_search_background_color',
                'type'     => 'color',
                'transparent'=> false,
                'title'    => __( 'Background Color', 'wpdancelaparis' ),
                'subtitle' => __( '(default: #fff).', 'wpdancelaparis' ),
                'default'  => '#fff',
                'required' => array('tvlgiao_wpdance_layout_page_search_background_style', '=', 'bg_color'),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_page_search_background_image',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Background Image', 'wpdancelaparis' ),
                'compiler' => 'true',
                'desc'     => __( '', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => array( 'url' => TVLGIAO_WPDANCE_THEME_IMAGES.'/bg_404.jpg' ),
                'required' => array('tvlgiao_wpdance_layout_page_search_background_style', '=', 'bg_image'),
            ),
        )
    ) );

 
    Redux::setSection( $opt_name, array(
        'title'            => __( 'WooCommerce', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_woocommerce_setting',
        'desc'             => __( '', 'wpdancelaparis' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-shopping-cart-sign'
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Product Config', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_layout_product_config',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => __( '', 'wpdancelaparis' ),
        'fields'           => array(

            array(
                'id'       => 'tvlgiao_wpdance_layout_product_config_catalog_mode',
                'type'     => 'switch',
                'title'    => __( 'Group Button (Catalog Mode)', 'wpdancelaparis' ),
                'subtitle' => __( 'Enable/Disable Add To Cart, Compare, Wishlist button on your site', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
            array(
               'id'       => 'tvlgiao_wpdance_layout_product_config_catalog_mode_section_start',
                'type'     => 'section',
                'title'    => __( 'Group Button Settings', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'indent'   => true,
                'required' => array('tvlgiao_wpdance_layout_product_config_catalog_mode','=', '1' ),
            ),

            /****************************/
                array(
                    'id'       => 'tvlgiao_wpdance_layout_product_config_button_group_position',
                    'type'     => 'radio',
                    'title'    => __( 'Button Position', 'wpdancelaparis' ),
                    'subtitle' => __( 'Position of the buttons: add to cart, compare, wishlist on shop loop', 'wpdancelaparis' ),
                    'desc'     => __( '', 'wpdancelaparis' ),
                    'options'  => array(
                        'after-content'    => __( 'After Content Detail', 'wpdancelaparis' ),
                        'before-content'   => __( 'Before Content Detail', 'wpdancelaparis' ),
                    ),
                    'default'  => 'after-content',
                    'required' => array('tvlgiao_wpdance_layout_product_config_catalog_mode','=', '1' ),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_layout_product_config_wishlist_default',
                    'type'     => 'switch',
                    'title'    => __( 'Wishtlist Button Default', 'wpdancelaparis' ),
                    'subtitle' => __( 'In some cases, the layout will have surplus wishlist buttons on single product page. Disable them to avoid errors.', 'wpdancelaparis' ),
                    'default'  => false,
                    'on'       => 'Enable',
                    'off'      => 'Disabled',
                    'required' => array('tvlgiao_wpdance_layout_product_config_catalog_mode','=', '1' ),
                ),

                array(
                    'id'       => 'tvlgiao_wpdance_layout_product_config_compare_default',
                    'type'     => 'switch',
                    'title'    => __( 'Compare Button Default', 'wpdancelaparis' ),
                    'subtitle' => __( 'In some cases, the layout will have surplus compare buttons on single product page. Disable them to avoid errors.', 'wpdancelaparis' ),
                    'default'  => false,
                    'on'       => 'Enable',
                    'off'      => 'Disabled',
                    'required' => array('tvlgiao_wpdance_layout_product_config_catalog_mode','=', '1' ),
                ),
            /****************************/
            
            array(
                'id'     => 'tvlgiao_wpdance_layout_product_config_catalog_mode_section_end',
                'type'   => 'section',
                'indent' => false,
                'required' => array('tvlgiao_wpdance_layout_product_config_catalog_mode','=', '1' ),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_product_config_title_display',
                'type'     => 'switch',
                'title'    => __( 'Product Title', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_product_config_description_display',
                'type'     => 'switch',
                'title'    => __( 'Product Description', 'wpdancelaparis' ),
                'subtitle' => __( 'Hide Product Description may not work with some cases: list view mode in the shop page, shortcode single product detail...', 'wpdancelaparis' ),
                'default'  => false,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
             array(
                'id'       => 'tvlgiao_wpdance_layout_product_config_number_desc_word',
                'type'     => 'text',
                'title'    => __( 'Number Description Word', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'default'  => '40',
                /*'required' => array('tvlgiao_wpdance_layout_product_config_description_display','=', '1' ),*/
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_product_config_rating_display',
                'type'     => 'switch',
                'title'    => __( 'Product Rating', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_product_config_price_display',
                'type'     => 'switch',
                'title'    => __( 'Product Price', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_product_config_meta_display',
                'type'     => 'switch',
                'title'    => __( 'Product Meta', 'wpdancelaparis' ),
                'subtitle' => __( 'Show/Hide sale/featured product', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_product_config_hover_style',
                'type'     => 'image_select',
                'title'    => __( 'Select Style Hover Product', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => array(
                    'wd-hover-style-1' => array(
                        'alt' => 'Style Hover 1',
                        'img' => TVLGIAO_WPDANCE_THEME_IMAGES . '/products/wd-hover-style-1.png'
                    ),
                ),
                'default'  => 'wd-hover-style-1'
            ),
        )
    ) );

    

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Archive Product', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_layout_archive_product',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => __( '', 'wpdancelaparis' ),
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_layout_archive_product_layout',
                'type'     => 'image_select',
                'title'    => __( 'Select The Layout', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => $wd_default_data['layout']['choose']['layout'],
                'default'  => $wd_default_data['layout']['default']['layout'],
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_archive_product_left_sidebar',
                'type'     => 'select',
                'title'    => __( 'Select Left Sidebar', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'data'     => 'sidebars',
                'default'  => $wd_default_data['sidebar']['default']['archive_product_left'],
                'required' => array('tvlgiao_wpdance_layout_archive_product_layout','=',array( '1-0-0', '1-0-1' ) ),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_archive_product_right_sidebar',
                'type'     => 'select',
                'title'    => __( 'Select Right Sidebar', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'data'     => 'sidebars',
                'default'  => $wd_default_data['sidebar']['default']['archive_product_right'],
                'required' => array('tvlgiao_wpdance_layout_archive_product_layout','=',array( '0-0-1', '1-0-1' ) ),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_archive_product_posts_per_page',
                'type'     => 'text',
                'title'    => __( 'Posts Per Page', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( 'Number products display on 1 page', 'wpdancelaparis' ),
                'default'  => '15',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_archive_product_columns',
                'type'     => 'button_set',
                'title'    => __( 'Columns', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => $wd_default_data['layout']['choose']['columns'],
                'default'  => $wd_default_data['layout']['default']['columns'],
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Single Product', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_layout_single_product',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => __( '', 'wpdancelaparis' ),
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_layout_single_product_layout',
                'type'     => 'image_select',
                'title'    => __( 'Select The Layout', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => $wd_default_data['layout']['choose']['layout'],
                'default'  => $wd_default_data['layout']['default']['layout'],
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_single_product_left_sidebar',
                'type'     => 'select',
                'title'    => __( 'Select Left Sidebar', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'data'     => 'sidebars',
                'default'  => $wd_default_data['sidebar']['default']['single_product_left'],
                'required' => array('tvlgiao_wpdance_layout_single_product_layout','=',array( '1-0-0', '1-0-1' ) ),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_single_product_right_sidebar',
                'type'     => 'select',
                'title'    => __( 'Select Right Sidebar', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'data'     => 'sidebars',
                'default'  => $wd_default_data['sidebar']['default']['single_product_right'],
                'required' => array('tvlgiao_wpdance_layout_single_product_layout','=',array( '0-0-1', '1-0-1' ) ),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_single_product_position_thumbnail',
                'type'     => 'radio',
                'title'    => __( 'Position Thumbnail', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => array(
                    'left'      => __( 'Left Of The Big Image', 'wpdancelaparis' ),
                    'bottom'    => __( 'Below The Big Image', 'wpdancelaparis' ),
                ),
                'default'  => 'left',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_single_product_thumbnail_number',
                'type'     => 'text',
                'title'    => __( 'Thumbnail Number', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'value'    => 3,
                'desc'     => __( 'The maximum number of thumbnails appears on the slider thumbnail single product.', 'wpdancelaparis' ),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_single_product_summary_layout',
                'type'     => 'sortable',
                'mode'     => 'checkbox', // checkbox or text
                'title'    => __( 'Product Summary Layout', 'wpdancelaparis' ),
                'subtitle' => __( 'Custom content layout for single product template. Define and reorder these however you want.', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => array(
                    'woocommerce_template_single_price'             => __( 'Price', 'wpdancelaparis' ),
                    'tvlgiao_wpdance_template_single_review'        => __( 'Review', 'wpdancelaparis' ),
                    'tvlgiao_wpdance_template_single_sku'           => __( 'Sku', 'wpdancelaparis' ),
                    'tvlgiao_wpdance_template_single_availability'  => __( 'Availability', 'wpdancelaparis' ),
                    'woocommerce_template_single_add_to_cart'       => __( 'Add To Cart', 'wpdancelaparis' ),
                    /*'tvlgiao_wpdance_get_product_tags'              => __( 'Tags', 'wpdancelaparis' ),*/
                    'tvlgiao_wpdance_get_product_categories'        => __( 'Categories', 'wpdancelaparis' ),
                ),
                'default'  => array(
                    'woocommerce_template_single_price'             => true,
                    'tvlgiao_wpdance_template_single_review'        => true,
                    'tvlgiao_wpdance_template_single_sku'           => true,
                    'tvlgiao_wpdance_template_single_availability'  => true,
                    'woocommerce_template_single_add_to_cart'       => true,
                    /*'tvlgiao_wpdance_get_product_tags'              => true,*/ 
                    'tvlgiao_wpdance_get_product_categories'        => true,
                ),
            ),
            array(
               'id'       => 'tvlgiao_wpdance_layout_single_product_summary_section_start',
                'type'     => 'section',
                'title'    => __( 'Product Summary Custom Content', 'wpdancelaparis' ),
                'subtitle' => __( 'Custom content will appear below the Product Summary section', 'wpdancelaparis' ),
                'indent'   => true,
            ),

            /****************************/
                array(
                    'id'       => 'tvlgiao_wpdance_layout_single_product_summary_custom_shortcode',
                    'type'     => 'textarea',
                    'title'    => __( 'Custom Shortcode', 'wpdancelaparis' ),
                    'subtitle' => __( '', 'wpdancelaparis' ),
                    'desc'     => __( 'You can create a shortcode from the new page creation interface.', 'wpdancelaparis' ),
                ),
            /****************************/
            
            array(
                'id'     => 'tvlgiao_wpdance_layout_single_product_summary_section_end',
                'type'   => 'section',
                'indent' => false,
                'required' => array('tvlgiao_wpdance_header_layout','=',''),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_single_product_fullwidth_layout',
                'type'     => 'switch',
                'title'    => __( 'Fullwidth Layout', 'wpdancelaparis' ),
                'subtitle' => __( 'Turn on it if you want fullwidth detail', 'wpdancelaparis' ),
                'default'  => false,
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_single_product_recent_product',
                'type'     => 'switch',
                'title'    => __( 'Recent Product', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => true,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_single_product_upsell_product',
                'type'     => 'switch',
                'title'    => __( 'Upsell Product', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => false,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Woo Page Template', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_layout_woo_template',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => __( 'Setting for pages use layout WooCommerce Template', 'wpdancelaparis' ),
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_layout_woo_template_layout',
                'type'     => 'image_select',
                'title'    => __( 'Select The Layout', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => $wd_default_data['layout']['choose']['layout'],
                'default'  => $wd_default_data['layout']['default']['layout'],
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_woo_template_left_sidebar',
                'type'     => 'select',
                'title'    => __( 'Select Left Sidebar', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'data'     => 'sidebars',
                'default'  => $wd_default_data['sidebar']['default']['woo_template_left'],
                'required' => array('tvlgiao_wpdance_layout_woo_template_layout','=',array( '1-0-0', '1-0-1' ) ),
            ),

            array(
                'id'       => 'tvlgiao_wpdance_layout_woo_template_right_sidebar',
                'type'     => 'select',
                'title'    => __( 'Select Right Sidebar', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'data'     => 'sidebars',
                'default'  => $wd_default_data['sidebar']['default']['woo_template_right'],
                'required' => array('tvlgiao_wpdance_layout_woo_template_layout','=',array( '0-0-1', '1-0-1' ) ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Cart Page', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_layout_cart_page',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => __( '', 'wpdancelaparis' ),
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_layout_cart_page_custom_shortcode',
                'type'     => 'textarea',
                'title'    => __( 'Custom Shortcode', 'wpdancelaparis' ),
                'subtitle' => __( 'Shortcode will display below cart content', 'wpdancelaparis' ),
                'desc'     => __( 'You can create a shortcode from the new page creation interface.', 'wpdancelaparis' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Mini Cart', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_layout_mini_cart',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => __( '', 'wpdancelaparis' ),
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_mini_cart_sorter',
                'type'     => 'sortable',
                'mode'     => 'checkbox', // checkbox or text
                'title'    => __( 'Layout', 'wpdancelaparis' ),
                'subtitle' => __( 'Define and reorder these however you want.', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => array(
                    'cart_icon'     => __( 'Cart Icon', 'wpdancelaparis' ),
                    'cart_text'     => __( 'Cart Text', 'wpdancelaparis' ),
                    'cart_item'     => __( 'Cart Item', 'wpdancelaparis' ),
                    'cart_total'    => __( 'Cart Total', 'wpdancelaparis' ),
                ),
                'default'  => array(
                    'cart_icon'     => true,
                    'cart_text'     => true,
                    'cart_item'     => true,
                    'cart_total'    => false,
                )
            ),
            array(
                'id'       => 'tvlgiao_wpdance_mini_cart_icon',
                'type'     => 'select',
                'title'    => __( 'Select Cart Icon', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'fa-shopping-cart'      => 'fa-shopping-cart',
                    'fa-shopping-bag'       => 'fa-shopping-bag',
                    'fa-cart-arrow-down'    => 'fa-cart-arrow-down',
                    'fa-cart-plus'          => 'fa-cart-plus',
                    'fa-opencart'           => 'fa-opencart',
                ),
                'default'  => 'fa-shopping-cart'
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Sale Flash', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_layout_sale_flash',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => __( '', 'wpdancelaparis' ),
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_layout_product_sale_flash_text',
                'type'     => 'text',
                'title'    => __( 'Text', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'default'  => 'Sale!',
            ),
            array(
                'id'       => 'tvlgiao_wpdance_layout_product_sale_flash_percent',
                'type'     => 'switch',
                'title'    => __( 'Percent Sale', 'wpdancelaparis' ),
                'subtitle' => __( '', 'wpdancelaparis' ),
                'default'  => false,
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Color Settings', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_color_setting',
        'desc'             => __( '', 'wpdancelaparis' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-magic'
    ) );

    /*Redux::setSection( $opt_name, array(
        'title'            => __( 'Primary Color', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_color_setting_primary_color',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => __( '', 'wpdancelaparis' ),
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_color_setting_primary_color_select',
                'type'     => 'image_select',
                'title'    => __( 'Select Primary Color', 'wpdancelaparis' ),
                'subtitle' => __( 'If change it, you need to SAVE before customizing the items below', 'wpdancelaparis' ),
                'desc'     => __( '', 'wpdancelaparis' ),
                'options'  => array(
                    'color_default' => array(
                        'alt' => 'Color Default',
                        'img' => TVLGIAO_WPDANCE_THEME_IMAGES . '/styling/color_default.png'
                    ),
                ),
                'default'  => 'color_default'
            ),
        )
    ) );*/

    //Color Settings
    $xml_file           =  tvlgiao_wpdance_get_custom_data_by_keyname( 'tvlgiao_wpdance_styling_primary_color', 'tvlgiao_wpdance_color_setting_primary_color_select', 'color_default' );
    $objXML_color       = simplexml_load_file(TVLGIAO_WPDANCE_THEME_WPDANCE."/config_xml/".$xml_file.".xml");
    
    $i = 1;
    foreach ($objXML_color->children() as $child) {                 //items_setting => general
        $title          = (string)$child->title;
        $section        = (string)$child->section;
        $description    = (string)$child->description;

        $color_field_array = array();
        foreach ($child->items->children() as $childofchild) {      //items => item
            $name   =  (string)$childofchild->name;                 //name
            $slug   =  (string)$childofchild->slug;                 //slug
            $std    =  (string)$childofchild->std;                  //std

            $color_field_array[] = array(
                'id'            => $slug,
                'type'          => 'color',
                'transparent'   => false,
                'title'         => $name,
                'subtitle'      => __( '', 'wpdancelaparis' ),
                'default'       => $std,
            );
        }

        Redux::setSection( $opt_name, array(
            'title'            => $title,
            'id'               => 'tvlgiao_wpdance_color_setting_'.$i,
            'subsection'       => true,
            'customizer_width' => '450px',
            'desc'             => $description,
            'fields'           => $color_field_array
        ) );

        $i ++;
    }

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Font Settings', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_font_setting',
        'desc'             => __( '', 'wpdancelaparis' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-font'
    ) );

    //Font Settings
    $xml_file           = 'font_config';
    $objXML_font        = simplexml_load_file(TVLGIAO_WPDANCE_THEME_WPDANCE."/config_xml/".$xml_file.".xml");

    $i = 1;
    foreach ($objXML_font->children() as $child) {                  //items_setting => general
        $title          = (string)$child->title;
        $section        = (string)$child->section;
        $description    = (string)$child->description;

        $font_field_array = array();
        foreach ($child->items->children() as $childofchild) {          //items => item
            $name           =  (string)$childofchild->name;                 //name
            $slug           =  (string)$childofchild->slug;                     //slug
            $std            =  (string)$childofchild->std;
            $description    =  (string)$childofchild->description;                  //std
            
            $font_field_array[] = array(
                'id'       => $slug,
                'type'     => 'typography',
                'title'    => $name,
                'subtitle' => $description,
                'google'   => true,
                'font-weight'   => false,
                'color'         => false,
                'text-align'    => false,
                'line-height'   => false,
                'font-style'    => false,
                'font-size'     => false,
                'subsets'       => false,
                'default'  => array(
                    'color'       => '#dd9933',
                    'font-size'   => '30px',
                    'font-family' =>  $std,
                    'font-weight' => 'Normal',
                ),
            );
        }

        Redux::setSection( $opt_name, array(
            'title'            => $title,
            'id'               => 'tvlgiao_wpdance_font_setting_'.$i,
            'subsection'       => true,
            'customizer_width' => '450px',
            'desc'             => $description,
            'fields'           => $font_field_array
        ) );

        $i ++;
    }

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Custom Css/Script', 'wpdancelaparis' ),
        'id'               => 'tvlgiao_wpdance_custom_css_script',
        'desc'             => __( '', 'wpdancelaparis' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-fire',
        'fields'           => array(
            array(
                'id'       => 'tvlgiao_wpdance_custom_css',
                'type'     => 'ace_editor',
                'title'    => __( 'CSS Code', 'wpdancelaparis' ),
                'subtitle' => __( 'Paste your CSS code here.', 'wpdancelaparis' ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                'desc'     => '',
                'default'  => ""
            ),
            array(
                'id'       => 'tvlgiao_wpdance_custom_script',
                'type'     => 'ace_editor',
                'title'    => __( 'JS Code', 'wpdancelaparis' ),
                'subtitle' => __( 'Paste your JS code here.', 'wpdancelaparis' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'desc'     => '',
                'default'  => ""
            ),
        ),
    ) );

    if ($include_data_theme_option_demo) {
        include_once(TVLGIAO_WPDANCE_THEME_OPTIONS.'/demo_data.php');
    }


    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'wpdancelaparis' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'wpdancelaparis' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'wpdancelaparis' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

