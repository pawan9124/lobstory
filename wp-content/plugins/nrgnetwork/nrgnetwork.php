<?php
/*
Plugin Name: Plugin for NRGnetwork Themes
Plugin URI: http://themeforest.net/user/nrgthemes/
Description: Portfolio Post Type for NRGnetwork themes
Author: NRGThemes
Version: 1.3
Author URI: http://themeforest.net/user/nrgthemes/
Text Domain: nrgnetwork
*/

define('NRGNETWORK_PLUGIN_DIR' ,plugin_dir_path( __FILE__ ));
define('NRGNETWORK_PLUGIN_URL' ,plugin_dir_url( __FILE__ ));
if(!class_exists('NRGnetwork_Std')) {
    require_once NRGNETWORK_PLUGIN_DIR . 'framework/classes/class.nrgthemes.std.php';
}
if(!class_exists('NRGnetwork_ImportData')) {
    require_once NRGNETWORK_PLUGIN_DIR . 'framework/classes/class.import.data.php';
}

class TT_Portfolio_PT{

    function __construct(){
        add_action('init', array($this, 'register_portfolio'));
        add_action('admin_init', array($this, 'settings_flush_rewrite'));

        add_filter('manage_edit-portfolio_columns', array($this, 'portfolio_edit_columns'));

        if( $this->admin_post_type()=="portfolio" ){
            add_action("manage_posts_custom_column", array($this, 'portfolio_custom_columns'));
        }


        // Shortcodes frontend
        add_shortcode('tt_image', array($this, 'shortcode_fe_tt_image'));
        add_shortcode('tt_text', array($this, 'shortcode_fe_tt_text'));
        add_shortcode('tt_embed', array($this, 'shortcode_fe_tt_embed'));
    }

    // register portfolio post type
    public function register_portfolio(){
        $label = get_theme_mod('portfolio_label');
        $label = !empty($label) ? $label : __('Portfolio', 'nrgnetwork');
        $labels = array(
            'name'          => $label,
            'singular_name' => $label,
            'edit_item'     => sprintf(__('Edit %s', 'nrgnetwork'), $label),
            'new_item'      => sprintf(__('New %s', 'nrgnetwork'), $label),
            'all_items'     => sprintf(__('All %s', 'nrgnetwork'), $label),
            'view_item'     => sprintf(__('View %s', 'nrgnetwork'), $label),
            'menu_name'     => sprintf(__('%s', 'nrgnetwork'), $label)
        );
        $slug = get_theme_mod('portfolio_slug');
        $slug = !empty($slug) ? $slug : __('portfolio-item', 'nrgnetwork');
        $args = array(
            'labels'            => $labels,
            'public'            => true,
            '_builtin'          => false,
            'capability_type'   => 'post',
            'hierarchical'      => false,
            'rewrite'           => array('slug' => $slug),
            'taxonomies'        => array('portfolio_tag'),
            'supports'          => array('title', 'editor', 'thumbnail', 'comments', 'excerpt', 'author', 'custom-fields', 'portfolio_tag')
        );

        register_post_type('portfolio', $args);


        // register portfolio category
        $tax = array(
            "hierarchical"  => true,
            "label"         => __("Categories", 'nrgnetwork'),
            "singular_label"=> sprintf(__('%s Category', 'nrgnetwork'), $label),
            "rewrite"       => true
        );

        register_taxonomy('portfolio_entries', 'portfolio', $tax);


        // register portfolio tag
        register_taxonomy('portfolio_tag', 'portfolio', array(
                'hierarchical' => false,
                'label' => __('Tags', 'nrgnetwork'),
                'singular_name' => __('tag', 'nrgnetwork'),
                'rewrite' => true,
                'query_var' => true
            )
        );
    }

    // re-flush rewrite
    public function settings_flush_rewrite(){
        flush_rewrite_rules();
    }


    // portfolio edit columns
    public function portfolio_edit_columns($columns) {
        $columns = array(
            "cb"        => "<input type=\"checkbox\" />",
            "thumbnail column-comments" => "Image",
            "title"     => __("Portfolio Title", 'nrgnetwork'),
            "category"  => __("Categories", 'nrgnetwork'),
            "date"      => __("Date", 'nrgnetwork'),
        );
        return $columns;
    }

    // portfolio custom columns
    public function portfolio_custom_columns($column) {
        global $post;
        switch ($column) {
            case "thumbnail column-comments":
                if (has_post_thumbnail($post->ID)) {
                    echo get_the_post_thumbnail($post->ID, array(45,45));
                }
                break;
            case "category":
                echo get_the_term_list($post->ID, 'portfolio_entries', '', ', ', '');
                break;
            case "team":
                echo get_the_term_list($post->ID, 'position', '', ', ', '');
                break;
            case "testimonial":
                echo get_the_term_list($post->ID, 'testimonials', '', ', ', '');
                break;
        }
    }






    public function shortcode_fe_editmode(){
        global $wp_query;
        return (isset($wp_query->query_vars['network_page'], $wp_query->query_vars['portfolio']) && $wp_query->query_vars['network_page']=='netfolio-edit' && abs($wp_query->query_vars['portfolio'])>0);
    }

    public function shortcode_fe_tt_image( $atts, $content = null){
        extract( shortcode_atts( array(
            "id" => '0'
        ), $atts ) );

        $result = '';
        $img = wp_get_attachment_url( $id, 'full' );

        if( $this->shortcode_fe_editmode() ){
            $result = '<div class="tt-el-embed tt-el-embed-image has-image">
                            <div class="entry-image" data-img="'.$id.'">
                                <a href="'.$img.'"><img src="'.$img.'"></a>
                            </div>
                            <div class="entry-tools">
                                <a href="javascript:;" class="el-move ui-sortable-handle"><i class="fa fa-arrows"></i></a>
                                <a href="javascript:;" class="el-close"><i class="fa fa-close"></i></a>
                            </div>
                            <a href="javascript:;" class="browse-media"></a>
                        </div>';
        }
        else{
            $result = '<div class="tt-el-embed tt-el-embed-image has-image">
                            <div class="entry-image">
                                <a href="'.$img.'"><img src="'.$img.'"></a>
                            </div>
                        </div>';
        }

        return $result;
    }

    public function shortcode_fe_tt_text( $atts, $content = null){
        extract( shortcode_atts( array(), $atts ) );

        $result = '';

        if( $this->shortcode_fe_editmode() ){
            $result = '<div class="tt-el-embed tt-el-embed-text">
                            <div class="entry-text" contenteditable="true">'.$content.'</div>
                            <div class="entry-tools">
                                <a href="javascript:;" class="el-move"><i class="fa fa-arrows"></i></a>
                                <a href="javascript:;" class="el-close"><i class="fa fa-close"></i></a>
                            </div>
                        </div>';
        }
        else{
            $result = '<div class="tt-el-embed tt-el-embed-text">
                            <div class="entry-text">'.$content.'</div>
                        </div>';
        }

        return $result;
    }

    public function shortcode_fe_tt_embed( $atts, $content = null){
        extract( shortcode_atts( array(), $atts ) );

        $result = '';

        if( $this->shortcode_fe_editmode() ){
            $result = '<div class="tt-el-embed tt-el-embed-media">
                            <div class="entry-embed">'.$content.'</div>
                            <div class="entry-tools">
                                <a href="javascript:;" class="el-move"><i class="fa fa-arrows"></i></a>
                                <a href="javascript:;" class="el-close"><i class="fa fa-close"></i></a>
                            </div>
                        </div>';
        }
        else{
            $result = '<div class="tt-el-embed tt-el-embed-media">
                            <div class="entry-embed">'.$content.'</div>
                        </div>';
        }

        return $result;
    }





    // Get admin post type for current page
    public static function admin_post_type(){
        global $post, $typenow, $current_screen;

        // Check to see if a post object exists
        if ($post && $post->post_type)
            return $post->post_type;

        // Check if the current type is set
        elseif ($typenow)
            return $typenow;

        // Check to see if the current screen is set
        elseif ($current_screen && $current_screen->post_type)
            return $current_screen->post_type;

        // Finally make a last ditch effort to check the URL query for type
        elseif (isset($_REQUEST['post_type']))
            return sanitize_key($_REQUEST['post_type']);

        return '-1';
    }

}

new TT_Portfolio_PT();

function  nrgnetwork_change_permalinks() {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
    $wp_rewrite->flush_rules();
}
register_activation_hook( __FILE__, 'nrgnetwork_change_permalinks' );

function nrgnetwork_mime_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml';
    return $mime_types;
}
add_filter( 'upload_mimes','nrgnetwork_mime_types' , 1, 1);
