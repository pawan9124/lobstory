<?php
// change default settings for default gallery
function nrgnetwork_attachment_display_settings() {
    update_option( 'image_default_link_type', 'file' );
}
add_action( 'after_setup_theme', 'nrgnetwork_attachment_display_settings' );

// Print global js variables
function nrgnetwork_options_js(){
    return 'var theme_options = { ajax_url: "'.admin_url( 'admin-ajax.php' ).'" };';
}

// Print custom styles
function nrgnetwork_print_theme_styles(){
    global $post;
    $logo_style = $custom_css = $folio_color = "";
    $custom_css = NRGnetwork_Std::get_mod('custom_css');
    $custom_css .= NRGnetwork_Std::get_mod('custom_css_tablet') != '' ?    '@media (min-width: 768px) and (max-width: 985px) { ' . NRGnetwork_Std::get_mod('custom_css_tablet') . ' }' : '';
    $custom_css .= NRGnetwork_Std::get_mod('custom_css_widephone') != '' ? '@media (min-width: 481px) and (max-width: 767px) { ' . NRGnetwork_Std::get_mod('custom_css_widephone') . ' }' : '';
    $custom_css .= NRGnetwork_Std::get_mod('custom_css_phone') != '' ?     '@media (max-width: 480px) { '                        . NRGnetwork_Std::get_mod('custom_css_phone') . ' }' : '';
    $logo = NRGnetwork_Std::get_mod('logo');
    if( !empty($logo) ){
        $logo_style = "header .brand-be a{ background-image:url(".esc_url($logo)."); }";
    } else{
        $logo_style = "header .brand-be a{ background-image:url(".get_template_directory_uri()."/img/logo.png); }";
    }
    if( is_singular('portfolio') ){
        $custom_color = NRGnetwork_Std::getmeta('folio_color');
        $folio_color.= '.work-title h1 {color: '.$custom_color.';}.item:hover a {color: '.$custom_color.';}.item .n-title svg path.fill-circle {stroke: '.$custom_color.';}.item .n-title.act svg path.fill-circle {stroke:'.$custom_color.';}.n-title.act svg path.fill-circle {stroke: '.$custom_color.';}.descr-block {background: '.$custom_color.';}';
    }
    return $logo_style.$custom_css.$folio_color; 
}

// Less Compiler
require_once NRGnetwork_Std::file_require(get_template_directory() . '/framework/classes/class.less.php');

// Meta fields for Posts
require_once NRGnetwork_Std::file_require(get_template_directory() . '/framework/classes/class.render.meta.php');

// WP Customizer
require_once NRGnetwork_Std::file_require(get_template_directory() . '/framework/classes/class.wp.customize.controls.php');
require_once NRGnetwork_Std::file_require(get_template_directory() . '/framework/classes/class.wp.customize.php');

// Import functions
require_once NRGnetwork_Std::file_require(get_template_directory() . '/framework/functions/functions.for.theme.php');
require_once NRGnetwork_Std::file_require(get_template_directory() . '/framework/functions/functions.breadcrumb.php');

// Import Widgets
require_once NRGnetwork_Std::file_require(get_template_directory() . '/includes/widgets/init_widget.php');

// Customizer
require_once NRGnetwork_Std::file_require(get_stylesheet_directory() . '/includes/customizer.php');
// TGM Plugin Activation
require_once NRGnetwork_Std::file_require(get_stylesheet_directory() . '/includes/plugins.php');

// Quick Load Element for VC
require_once NRGnetwork_Std::file_require(get_stylesheet_directory() . '/includes/meta.page.php');
require_once NRGnetwork_Std::file_require(get_stylesheet_directory() . '/includes/ExtendVCRow.php');

// Import Template tags
require_once NRGnetwork_Std::file_require(get_template_directory() . '/includes/template-tags.php');

// Woocommerce
//require_once NRGnetwork_Std::file_require(get_template_directory() . '/includes/woo.php');

// Statistics
require_once NRGnetwork_Std::file_require(get_template_directory() . '/includes/statistics.php');

// Community
require_once NRGnetwork_Std::file_require(get_template_directory() . '/includes/community.php');
require_once NRGnetwork_Std::file_require(get_template_directory() . '/includes/community_extra.php');

// Import VC Custom Elements
if( function_exists('vc_map') ){
    $file_dir = NRGnetwork_Std::file_require( get_stylesheet_directory().'/includes/vc-elements/' );
    foreach( glob( $file_dir . '*.php' ) as $filename ) {
        require_once $filename;
    }
}