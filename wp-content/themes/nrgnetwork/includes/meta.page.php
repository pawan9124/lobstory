<?php
class NRGnetwork_CurrentThemePageMetas extends NRGnetwork_RenderMeta{

    function __construct(){
        $this->items = $this->items();
        add_action('admin_enqueue_scripts', array($this, 'print_admin_scripts'));
        add_action('add_meta_boxes', array($this, 'add_custom_meta'), 1);
        add_action('edit_post', array($this, 'save_post'), 99);
    }

    public function items(){
        global $post;
        define('ADMIN_IMAGES', get_template_directory_uri().'/framework/admin-assets/images/');
        $tmp_arr = array(
            'page' => array(
                'label' => __( 'Page Options', 'nrgnetwork'),
                'post_type' => 'page',
                'items' => array(
                    array(
                        'type' => 'checkbox',
                        'name' => 'title_show',
                        'label' => __( 'Title Section Show', 'nrgnetwork'),
                        'default' => '1'
                    ),
                    array(
                        'type' => 'textarea',
                        'name' => 'title_desc',
                        'label' => __( 'Title Description', 'nrgnetwork'),
                        'default' => '',
                        'dependency' => array("element"=>"title_show", "value"=>"1")
                    ),
                    array(
                        'type' => 'textarea',
                        'name' => 'title_desc_loggedin',
                        'label' => __( '(Optional) Title Description after loggedin', 'nrgnetwork'),
                        'default' => '',
                        'dependency' => array("element"=>"title_show", "value"=>"1")
                    ),
                    array(
                        'type' => 'background',
                        'name' => 'title_bg',
                        'label' => __( 'Title Background Image', 'nrgnetwork'),
                        'default' => '',
                        'desc' => __( 'If you want to show your background area beautiful, this option exactly you need.', 'nrgnetwork'),
                        'dependency' => array("element"=>"title_show", "value"=>"1")
                    ),
                    array(
                        'name' => 'page_layout',
                        'type' => 'thumbs',
                        'label' => __( 'Page Layout', 'nrgnetwork'),
                        'default' => 'full',
                        'option' => array(
                            'full' => ADMIN_IMAGES . '1col.png',
                            'right' => ADMIN_IMAGES . '2cr.png',
                            'left' => ADMIN_IMAGES . '2cl.png'
                        ),
                        'desc' => __( 'Select Page Layout (Fullwidth | Right Sidebar | Left Sidebar)', 'nrgnetwork')
                    )
                )
            ),
            'portfolio' => array(
                'label' => __( 'Portfolio Options', 'nrgnetwork'),
                'post_type' => 'portfolio',
                'items' => array(
                    array(
                        'type' => 'textarea',
                        'name' => 'folio_about',
                        'label' => __( 'About Project', 'nrgnetwork'),
                        'default' => ''
                    )
                )
            )
        );
        $network_post_type = NRGnetwork_Std::get_mod('network_post_type');
        $network_post_type = !empty($network_post_type) ? $network_post_type : 'portfolio';
        $tmp_arr['item_featured'] = array(
            'label' => __( 'Featured Options', 'nrgnetwork'),
            'post_type' => $network_post_type,
            'items' => array(
                array(
                    'type' => 'checkbox',
                    'name' => 'featured_item',
                    'label' => __( 'Featured Item', 'nrgnetwork'),
                    'default' => '0'
                )
            )
        );
        return $tmp_arr;
    }
}
new NRGnetwork_CurrentThemePageMetas();