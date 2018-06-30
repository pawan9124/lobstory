<?php 
// Default content width
if ( ! isset( $content_width ) ) $content_width = 940;

// Theme Sidebars
$nrgnetwork_sidebars = array();
$nrgnetwork_sidebars = array_merge(array(
    'sidebar'=> esc_html__('Post Sidebar Area', 'nrgnetwork'),
    'sidebar-page'=> esc_html__('Page Sidebar Area', 'nrgnetwork'),
    'sidebar-portfolio'=> esc_html__('Portfolio Sidebar Area', 'nrgnetwork'),
    'sidebar-activity'=> esc_html__('Activity Page Sidebar', 'nrgnetwork')
), $nrgnetwork_sidebars);

// Theme Settings
class NRGNetwork{
    function __construct(){
        add_action( 'after_setup_theme', array($this, 'nrgnetwork_theme_setup') );
        add_action( 'widgets_init', array($this, 'nrgnetwork_theme_widgets_init') );
        add_action( 'wp_enqueue_scripts', array($this, 'nrgnetwork_theme_enqueue_scripts') );
        add_filter( 'body_class',       array($this, 'nrgnetwork_body_class_filter') );
        add_filter( 'excerpt_length',   array($this, 'nrgnetwork_custom_excerpt_length'), 999 );
        add_filter( 'excerpt_more',     array($this, 'nrgnetwork_custom_excerpt_more') );
        add_action( 'login_head', array($this, 'nrgnetwork_custom_login_logo') );
        add_action( 'admin_init', array($this, 'nrgnetwork_author_redirect_admin') );
    }

    public function nrgnetwork_theme_setup(){
        // load translate file
        load_theme_textdomain( 'nrgnetwork', get_template_directory() . '/languages' );
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-formats', array(
            'video', 'quote', 'link', 'gallery', 'status', 'audio'
        ));
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 640, 380, true );

        // Set Image sizes
        add_image_size( 'nrgnetwork-widget-thumb', 50, 50, true );
        add_image_size( 'nrgnetwork-post-thumb', 650, 390, true );
        add_image_size( 'nrgnetwork-blog-grid-thumb', 358, 220, true );
        add_image_size( 'nrgnetwork-related-thumb', 270, 120, true );
        add_image_size( 'nrgnetwork-folio-item', 640, 0, true );
        add_image_size( 'nrgnetwork-folio-grid', 270, 202, true );
        add_image_size( 'nrgnetwork-folio-grid2x', 540, 404, true );
        add_image_size( 'nrgnetwork-folio-thumb', 145, 108, true );
        add_image_size( 'nrgnetwork-folio-small-thumb', 50, 50, true );
        add_image_size( 'nrgnetwork-slider-widget-thumb', 260, 195, true );       
        add_image_size( 'nrgnetwork-woo-thumb', 400, 0, true );
        add_image_size( 'nrgnetwork-gallery-image', 870, 390, true );

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus( array(
            'primary' => esc_html__('Primary Menu', 'nrgnetwork'),
            'sub_footer' => esc_html__('Sub Footer Menu', 'nrgnetwork')
        ) );

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ) );
    }

    // theme enqueue scripts
    public function nrgnetwork_theme_enqueue_scripts(){
        //js
        wp_enqueue_script( 'wp-mediaelement' );
        wp_enqueue_script( 'jquery-ui-dialog');
        wp_enqueue_script( 'jquery-ui-slider');
        wp_enqueue_script( 'bootstrap',              get_template_directory_uri().'/script/bootstrap.min.js', array('jquery'), false, true );
        wp_enqueue_script( 'idangerous.swiper',      get_template_directory_uri().'/script/idangerous.swiper.min.js', array('jquery'), false, true );
        wp_enqueue_script( 'isotope.pkgd',           get_template_directory_uri().'/script/isotope.pkgd.min.js', array('jquery'), false, true );
        wp_enqueue_script( 'jquery.countTo',         get_template_directory_uri().'/script/jquery.countTo.js', array('jquery'), false, true );
        wp_enqueue_script( 'jquery.viewportchecker', get_template_directory_uri().'/script/jquery.viewportchecker.min.js', array('jquery'), false, true );
        wp_enqueue_script( 'colors',                 get_template_directory_uri().'/script/colors.js', array('jquery'), false, true );
        wp_enqueue_script( 'jqColorPicker',          get_template_directory_uri().'/script/jqColorPicker.js', array('jquery'), false, true );
        wp_enqueue_script( 'jquery.canvasjs',        get_template_directory_uri().'/script/jquery.canvasjs.min.js', false, false, true );
        wp_enqueue_script( 'imagesloaded.pkgd',      get_template_directory_uri().'/script/imagesloaded.pkgd.min.js', false, false, true );
        wp_enqueue_script( 'nrgnetwork-script',      get_template_directory_uri().'/script/global.js', array('jquery'), false, true );
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
        if( is_user_logged_in() ){
            //js
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_script( 'net-messages', get_template_directory_uri().'/script/net-messages.js', array('jquery'), false, true );
            wp_enqueue_script( 'select2',      get_template_directory_uri().'/script/select2/select2.min.js', array('jquery'), false, true );
            //css
            wp_enqueue_media();
            wp_enqueue_style( 'select2-bootstrap', get_template_directory_uri().'/script/select2/select2-bootstrap.css' );
            wp_enqueue_style( 'select2',           get_template_directory_uri().'/script/select2/select2.css' );
        }
        $js=nrgnetwork_options_js();
        if(!empty($js)) {
            wp_add_inline_script('nrgnetwork-script', $js,'before');
        }
        //css
        wp_enqueue_style("wp-jquery-ui-dialog");
        wp_enqueue_style( 'bootstrap',               get_template_directory_uri().'/style/bootstrap.min.css' );
        wp_enqueue_style( 'font-awesome',            get_template_directory_uri().'/style/font-awesome.min.css' );
        wp_enqueue_style( 'idangerous.swiper',       get_template_directory_uri().'/style/idangerous.swiper.css' );
        wp_enqueue_style( 'nrgnetwork-custom-fonts', get_template_directory_uri().'/style/fonts.css' );
        wp_enqueue_style( 'nrgnetwork-stylesheets',   get_template_directory_uri().'/style/stylesheet.css' );
        wp_enqueue_style( 'nrgnetwork-style',        get_stylesheet_uri() );
        $css=nrgnetwork_print_theme_styles();
        if(!empty($css)) {
            wp_add_inline_style('nrgnetwork-style',$css);
        }
        
        //--[if lt IE 9]--//
        wp_enqueue_style( 'ie-9', get_template_directory_uri()."/style/ie-9.css" );
        wp_style_add_data( 'ie-9', 'conditional', 'lt IE 9' );
        wp_enqueue_script( 'html5shiv',get_template_directory_uri().'/script/html5shiv.min.js', array(), '3.7.2', false);
        wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
        wp_enqueue_script( 'respond', get_template_directory_uri().'/js/respond.min.js', array(), '1.4.2', false);
        wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
    }

    // theme register widgets
    public function nrgnetwork_theme_widgets_init(){
        global $nrgnetwork_sidebars;

        $tt_sidebars = $nrgnetwork_sidebars;
        if(isset($tt_sidebars)) {
            foreach ($tt_sidebars as $id => $sidebar) {
                if( !empty($id) ){
                    if( $id=='sidebar-portfolio' && !class_exists('TT_Portfolio_PT') )
                        continue;
                    
                    register_sidebar(array(
                        'name' => $sidebar,
                        'id' => $id,
                        'description' => esc_html__('Add widgets here to appear in your sidebar.', 'nrgnetwork'),
                        'before_widget' => '<div id="%1$s" class="widget be-vidget %2$s">',
                        'after_widget'  => '</div>',
                        'before_title'  => '<h3 class="widget-title">',
                        'after_title'   => '</h3>'
                    ));                
                }
            }
        }

        // Footer widget areas
        $footer_widget_num = NRGnetwork_Std::get_mod('footer_widget_num');
        $footer_widget_num = ($footer_widget_num?$footer_widget_num:4);
        for($i=1; $i<=$footer_widget_num ; $i++ ){
            register_sidebar(
                array(
                    'name'          => esc_html__('Footer Column', 'nrgnetwork') . ' ' .$i,
                    'id'            => 'footer'.$i,
                    'description'   => esc_html__('Add widgets here to appear in your footer column', 'nrgnetwork') . ' ' .$i,
                    'before_widget' => '<div id="%1$s" class="widget footer-block %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3 class="footer-title">',
                    'after_title'   => '</h3>',
                )
            );
        }
    }

    public function nrgnetwork_body_class_filter( $classes ) {
        global $post;
        $classes[]='';
        $po = $post;
        $page_for_posts = get_option('page_for_posts');
        $is_blog_page = is_home() && get_post_type($post) && !empty($page_for_posts) ? true : false;
        if( (is_page() || $is_blog_page) && $is_blog_page ){
            $po = get_post($page_for_posts);
        }
        if( is_user_logged_in() ){
            $classes[].= 'page-login';
        }
        $classes[].= 'network-colors';
        return $classes;
    }

    public function nrgnetwork_custom_excerpt_length( $length ) {
        return 20;
    }

    public function nrgnetwork_custom_excerpt_more( $excerpt ) {
        return ' ...';
    }
    

    // Prints Custom Logo Image for Login Page
    public function nrgnetwork_custom_login_logo() {
        $logo = NRGnetwork_Std::get_mod('logo_admin');
        if (!empty($logo)) {
            $logo = str_replace('[site_url]', site_url(), $logo);
            print '<style type="text/css">.login h1 a { background: url(' . $logo . ') center center no-repeat !important;width: auto !important;}</style>';
        }
    }

    public function nrgnetwork_author_redirect_admin(){
        $current_user = wp_get_current_user();
        if( in_array("subscriber", $current_user->roles) && !defined('DOING_AJAX') ){
            wp_die( esc_html__('You are not allowed to access this part of the site', 'nrgnetwork') );
        }
    }

    public function nrgnetwork_req_functions(){
        add_editor_style( 'style/editor-style.css' );
        add_theme_support( "custom-header");
        add_theme_support( "custom-background");
    }
}
new NRGNetwork();


// Print Favicon
if( !function_exists('wp_site_icon') ){
    function nrgnetwork_print_favicon(){
        if(NRGnetwork_Std::get_mod('favicon') != ''){
            print '<link rel="shortcut icon" type="image/x-icon" href="'.NRGnetwork_Std::get_mod('logo').'"/>';
        }
    }
    add_action('wp_head', 'nrgnetwork_print_favicon');
}

function nrgnetwork_primary_callback(){
    print '<ul id="one" class="header-menu">';
    wp_list_pages( array(
        'sort_column'  => 'menu_order, post_title',
        'title_li' => '') );
    print '</ul>';
}

function nrgnetwork_sub_footer_callback(){
    print '<ul class="sub_footer_menu">';
        print '<li class="menu-item"><a href="'.esc_url(home_url('/')).'">'.esc_html__('Home', 'nrgnetwork').'</a></li>';
    print '</ul>';
}


// Show Brief
//=======================================================
if ( ! function_exists( 'nrgnetwork_showBrief' ) ) :
    function nrgnetwork_showBrief($str, $length) {
        $str = strip_tags($str);
        $str = explode(" ", $str);
        return implode(" ", array_slice($str, 0, $length));
    }
endif;

// NRGnetwork Standard Package
if(!class_exists('NRGnetwork_Std')) {
    require_once get_template_directory() . '/framework/classes/class.nrgthemes.std.php';
}

// Include current theme customize
require_once NRGnetwork_Std::file_require(get_template_directory() . '/includes/functions.php');
