<?php
global $nrgnetwork_social_icons;
$nrgnetwork_social_icons = array(
    "facebook" => "facebook",
    "twitter" => "twitter",
    "pinterest" => "pinterest",
    "instagram" => "instagram",
    "googleplus" => "google-plus",
    "dribbble" => "dribbble",
    "skype" => "skype",
    "wordpress" => "wordpress",
    "vimeo" => "vimeo-square",
    "flickr" => "flickr",
    "linkedin" => "linkedin",
    "youtube" => "youtube",
    "tumblr" => "tumblr",
    "link" => "link",
    "stumbleupon" => "stumbleupon",
    "delicious" => "delicious",
);

function nrgnetwork_admin_common_render_scripts() {
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_style('nrgnetwork-admin-common-style', NRGnetwork_Std::file_require(get_template_directory_uri().'/framework/admin-assets/common.css', true) );
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_script('nrgnetwork-admin-common-js', NRGnetwork_Std::file_require(get_template_directory_uri().'/framework/admin-assets/common.js', true), array('jquery'), false, true);
}
add_action('admin_enqueue_scripts', 'nrgnetwork_admin_common_render_scripts');

function nrgnetwork_add_video_radio($embed) {
    if (strstr($embed, 'http://www.youtube.com/embed/')) {
        return str_replace('?fs=1', '?fs=1&rel=0', $embed);
    } else {
        return $embed;
    }
}
add_filter('oembed_result', 'nrgnetwork_add_video_radio', 1, true);

if (!function_exists('nrgnetwork_custom_upload_mimes')) {
    function nrgnetwork_custom_upload_mimes($existing_mimes = array()) {
        $existing_mimes['ico'] = "image/x-icon";
        return $existing_mimes;
    }
    add_filter('upload_mimes', 'nrgnetwork_custom_upload_mimes');
}

if (!function_exists('nrgnetwork_format_class')) {
    // Returns post format class by string
    function nrgnetwork_format_class($post_id) {
        $format = get_post_format($post_id);
        if ($format === false)
            $format = 'standard';
        return 'format_' . $format;
    }
}

//This code filters the Categories archive widget to include the post count inside the link
function nrgnetwork_cat_count_span($links) {
    $links = str_replace('</a> (', ' <span>', $links);
    $links = str_replace('<span class="count">(', '<span>', $links);
    $links = str_replace(')', '</span></a>', $links);
    if(strpos($links, '<span>') !== false ) { 
        $links = str_replace('<a ', '<a class="has-count" ', $links);
    }
    return $links;
}
add_filter('wp_list_categories', 'nrgnetwork_cat_count_span');

//This code filters the Archive widget to include the post count inside the link
function nrgnetwork_archive_count_span($links) {
    $links = str_replace('</a>&nbsp;(', ' <span>', $links);
    $links = str_replace(')</li>', '</span></a></li>', $links);
    if(strpos($links, '<span>') !== false ) { 
        $links = str_replace('<a ', '<a class="has-count" ', $links);
    }
    return $links;
}
add_filter('get_archives_link', 'nrgnetwork_archive_count_span');

//Random order. Preventing duplication of post on paged
function nrgnetwork_register_session(){
    if( !session_id() ){
        session_start();
    }
}

if(!is_admin() && true) {
    function nrgnetwork_edit_posts_orderby($orderby_statement) {
        add_action('init', 'nrgnetwork_register_session');
        if (isset($_SESSION['expiretime'])) {
            if ($_SESSION['expiretime'] < time()) {
                session_unset();
            }
        } else {
            $_SESSION['expiretime'] = time() + 300;
        }
        $seed = rand();
        if (isset($_SESSION['seed'])) {
            $seed = $_SESSION['seed'];
        } else {
            $_SESSION['seed'] = $seed;
        }
        $orderby_statement = 'RAND(' . $seed . ')';
        return $orderby_statement;
    }
}

//Post Like Event
add_action('wp_ajax_blox_post_like', 'nrgnetwork_blox_post_like_hook');
add_action('wp_ajax_nopriv_blox_post_like', 'nrgnetwork_blox_post_like_hook');
function nrgnetwork_blox_post_like_hook() {
    try {
        $post_id = (int)$_POST['post_id'];
        $count = (int)NRGnetwork_Std::getmeta('post_like', $post_id);
        if( $post_id>0 ){
            NRGnetwork_Std::setmeta($post_id, 'post_like', $count+1);
        }
        print "1";
    } catch (Exception $e) {
        print "-1";
    }
    exit;
}

function nrgnetwork_blox_post_liked($post_id){
    $cookie_id = '';
    if( isset($_COOKIE['liked']) ){
        $cookie_id = $_COOKIE['liked'];
        $ids = explode(',', $cookie_id);
        foreach ($ids as $value) {
            if( $value+'' == $post_id+'' ){
                return 'liked';
            }
        }
    }
    return '';
}

function nrgnetwork_get_post_like($post_id){
    return '<a href="javascript:;" data-pid="'. $post_id .'" class="'. nrgnetwork_blox_post_liked($post_id) .'"><i class="fa fa-heart"></i> <span>'. (int)NRGnetwork_Std::getmeta('post_like', $post_id) .'</span></a>';
}
