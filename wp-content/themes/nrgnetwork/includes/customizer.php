<?php
if (!function_exists('nrgnetwork_customizer_options')):
    function nrgnetwork_customizer_options() {
        $template_uri = get_template_directory_uri();
        $pages = array();
        $all_pages = get_pages();
        foreach ($all_pages as $page) {
            $pages[$page->ID] = $page->post_title;
        }
        $option = array(
            // Colors
            array(
                'type' => 'section',
                'id' => 'colors',
                'label' => __( 'Colors', 'nrgnetwork'),
                'desc' => '',
                'controls' => array(
                    array(
                        'type' => 'color',
                        'id' => 'brand-color',
                        'label' => __( 'Brand Color', 'nrgnetwork'),
                        'default' => nrgnetwork_getLessValue('brand-color')
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'bg-header',
                        'label' => __( 'Header Background Color', 'nrgnetwork'),
                        'default' => nrgnetwork_getLessValue('bg-header')
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'menu-color',
                        'label' => __( 'Menu Color', 'nrgnetwork'),
                        'default' => nrgnetwork_getLessValue('menu-color')
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'bg-footer',
                        'label' => __( 'Footer Background Color', 'nrgnetwork'),
                        'default' => nrgnetwork_getLessValue('bg-footer')
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'be-loader',
                        'label' => __( 'Loader Background Color', 'nrgnetwork'),
                        'default' => nrgnetwork_getLessValue('be-loader')
                    )
                )
            ),// end Colors

            // Font & Typography options
            array(
                'type' => 'section',
                'id' => 'font',
                'label' => __( 'Font & Typography', 'nrgnetwork'),
                'desc' => '',
                'controls' => array(
                    array(
                        'type' => 'font',
                        'id' => 'font-text',
                        'label' => __( 'Text Font', 'nrgnetwork'),
                        'default' => nrgnetwork_getLessValue('font-text'),
                        'desc' => __( 'Default value delegates "Hevletica Neue".', 'nrgnetwork'),
                    ),
                    array(
                        'type' => 'font',
                        'id' => 'font-title',
                        'label' => __( 'Title & Heading', 'nrgnetwork'),
                        'default' => nrgnetwork_getLessValue('font-title'),
                        'desc' => __( 'Default value delegates "Conv_helveticaneuecyr-bold".', 'nrgnetwork'),
                    ),
                    array(
                        'type' => 'font',
                        'id' => 'font-menu',
                        'label' => __( 'Menu Font', 'nrgnetwork'),
                        'default' => nrgnetwork_getLessValue('font-menu'),
                        'desc' => __( 'Default value delegates "Hevletica Neue".', 'nrgnetwork'),
                    ),
                )
            ),// end Fonts

            // Branding & Logo
            array(
                'type' => 'section',
                'id' => 'section_header_style',
                'label' => __( 'Brand Logo', 'nrgnetwork'),
                'desc' => '',
                'controls' => array(
                    array(
                        'type' => 'image',
                        'id' => 'logo',
                        'label' => __( 'Logo Image', 'nrgnetwork'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'logo-with',
                        'label' => __( 'Logo Width', 'nrgnetwork'),
                        'default' => nrgnetwork_getLessValue('logo-with'),
                        'type' => 'pixel'
                    ),
                    array(
                        'type' => 'image',
                        'id' => 'logo_admin',
                        'label' => __( 'Login Page Logo', 'nrgnetwork'),
                        'desc' => __( 'Up to 274x95px', 'nrgnetwork'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'loader_off',
                        'label' => __( 'Disable loader image?', 'nrgnetwork'),
                        'default' => 0,
                        'type' => 'switch'
                    ),
                    array(
                        'type' => 'image',
                        'id' => 'loader_logo',
                        'label' => __( 'Loader Logo', 'nrgnetwork'),
                        'default' => get_template_directory_uri() . '/img/logo-loader.png'
                    ),
                    array(
                        'id' => 'loader_logo_with',
                        'label' => __( 'Loader Logo Width', 'nrgnetwork'),
                        'default' => '107',
                        'type' => 'pixel'
                    )
                )
            ),// end Branding
            
            // Page Title
            array(
                'type' => 'section',
                'id' => 'page_title',
                'label' => __( 'Page Title', 'nrgnetwork'),
                'controls' => array(
                    array(
                        'id' => 'page_title_image',
                        'label' => __( 'Background Image', 'nrgnetwork'),
                        'default' => get_template_directory_uri() . '/img/bg.jpg|cover|center top|scroll',
                        'type' => 'bg_image'
                    )
                ),
            ), //end Page Title

            // Page Title
            array(
                'type' => 'section',
                'id' => 'page_custom_slug',
                'label' => __( 'Rewrite URL Customize', 'nrgnetwork'),
                'controls' => array(
                    array(
                        'id' => 'netauth_username',
                        'label' => __( 'Use username on user profile url', 'nrgnetwork'),
                        'default' => 0,
                        'type' => 'switch'
                    ),
                    array(
                        'id' => 'netauth',
                        'label' => __( 'Author Profile:', 'nrgnetwork'),
                        'default' => 'netauth',
                        'type' => 'input',
                        'desc' => __( 'netauth/&lt;username_or_id&gt;', 'nrgnetwork')
                    ),
                    array(
                        'id' => 'netauth-edit',
                        'label' => __( 'Profile Edit:', 'nrgnetwork'),
                        'default' => 'netauth-edit',
                        'type' => 'input',
                        'desc' => __( 'netauth-edit/&lt;username_or_id&gt;', 'nrgnetwork')
                    ),
                    array(
                        'id' => 'netcollect',
                        'label' => __( 'Author Collection:', 'nrgnetwork'),
                        'default' => 'netcollect',
                        'type' => 'input',
                        'desc' => __( 'netcollect/&lt;collection_id&gt;', 'nrgnetwork')
                    ),
                    array(
                        'id' => 'netfolio-edit',
                        'label' => __( 'Portfolio Edit:', 'nrgnetwork'),
                        'default' => 'netfolio-edit',
                        'type' => 'input',
                        'desc' => __( 'netfolio-edit/&lt;portfolio_id&gt;', 'nrgnetwork')
                    ),
                    array(
                        'id' => 'netauth-stats',
                        'label' => __( 'Author Statistics:', 'nrgnetwork'),
                        'default' => 'netauth-stats',
                        'type' => 'input',
                        'desc' => __( 'netauth-stats/', 'nrgnetwork')
                    ),
                    array(
                        'id' => 'netauth-msgs',
                        'label' => __( 'Private Message:', 'nrgnetwork'),
                        'default' => 'netauth-msgs',
                        'type' => 'input',
                        'desc' => __( 'netauth-msgs/', 'nrgnetwork')
                    )
                ),
            ), //end Page Title

            // Footer
            array(
                'type' => 'section',
                'id' => 'section_footer',
                'label' => __( 'Footer', 'nrgnetwork'),
                'controls' => array(
                    array(
                        'id' => 'footer',
                        'label' => __( 'Enable Footer', 'nrgnetwork'),
                        'default' => '1',
                        'type' => 'switch'
                    ),
                    array(
                        'id' => 'footer_widget_num',
                        'label' => __( 'Footer Style', 'nrgnetwork'),
                        'default' => '4',
                        'type' => 'select',
                        'choices' => array('1' => 'Full', '2' => '2 Columns', '3' => '3 Columns', '4' => '4 Columns', '5' => '1/2 + 1/4 + 1/4', '6' => '1/4 + 1/4 + 1/2')
                    ),
                    array(
                        'id' => 'footer-text',
                        'label' => __( 'Footer Text Color', 'nrgnetwork'),
                        'default' => nrgnetwork_getLessValue('footer-text'),
                        'type' => 'color'
                    ),
                    array(
                        'id' => 'sub-footer',
                        'label' => __( 'Enable Sub Footer', 'nrgnetwork'),
                        'default' => '1',
                        'type' => 'switch'
                    ),
                    array(
                        'id' => 'copyright_content',
                        'label' => __( 'CopyRight Content', 'nrgnetwork'),
                        'default' => __( '<span class="copy">&copy; 2016. All rights reserved. <span class="white"><a href="http://themeforest.net/user/nrgthemes/" target="_blank"> NRGNETWORK</a></span></span><span class="created">Made with love by <span class="white"><a href="http://themeforest.net/user/nrgthemes/" target="_blank">NRGThemes</a></span></span>', 'nrgnetwork'),
                        'desc' => '',
                        'type' => 'textarea'
                    ),
                ),
            ), // end Footer

            // Post Types
            array(
                'id' => 'panel_options',
                'label' => __( 'Post Types', 'nrgnetwork'),
                'desc' => __( 'You can customize here mostly post type options including singular pages options.', 'nrgnetwork'),
                'sections' => array(
                    // Community
                    array(
                        'id' => 'section_community',
                        'label' => __( 'Community', 'nrgnetwork'),
                        'controls' => array(
                            array(
                                'id' => 'network_post_type',
                                'label' => __( 'Community Post Type', 'nrgnetwork'),
                                'default' => 'portfolio',
                                'type' => 'select',
                                'choices' => array(
                                    'post' => __( 'Post', 'nrgnetwork'),
                                    'portfolio' => __( 'Portfolio', 'nrgnetwork'),
                                    'product' => __( 'Product of Woocommerce', 'nrgnetwork')
                                )
                            ),
                            array(
                                'id' => 'network_post_status',
                                'label' => __( 'Frontend Publish Status', 'nrgnetwork'),
                                'default' => 'publish',
                                'type' => 'select',
                                'choices' => array(
                                    'publish' => __( 'Publish', 'nrgnetwork'),
                                    'pending' => __( 'Pending', 'nrgnetwork'),
                                    'draft' => __( 'Draft', 'nrgnetwork')
                                )
                            ),
                            array(
                                'id' => 'network_user_activation',
                                'label' => __( 'User registration (activation)', 'nrgnetwork'),
                                'default' => 'no_activation',
                                'type' => 'select',
                                'choices' => array(
                                    'no_activation' => __( 'No activation', 'nrgnetwork'),
                                    'email_activation' => __( 'Email activation', 'nrgnetwork')
                                )
                            ),
                            array(
                                'id' => 'sub_title_addnew_button',
                                'type' => 'sub_title',
                                'label' => __( 'Add Work Button', 'nrgnetwork'),
                                'default' => ''
                            ),
                            array(
                                'id' => 'addnew_text',
                                'label' => __( 'Button Text:', 'nrgnetwork'),
                                'default' => 'Add Work',
                                'type' => 'input'
                            ),
                            array(
                                'id' => 'addnew_status',
                                'label' => __( 'Hide when not logged in', 'nrgnetwork'),
                                'default' => '0',
                                'type' => 'switch'
                            ),
                            array(
                                'id' => 'sub_title_metafields',
                                'type' => 'sub_title',
                                'label' => __( 'Meta Fields Title', 'nrgnetwork'),
                                'default' => ''
                            ),
                            array(
                                'id' => 'meta_field1',
                                'label' => __( 'Meta field-1 label:', 'nrgnetwork'),
                                'default' => __( 'Brand/Company', 'nrgnetwork'),
                                'type' => 'input'
                            ),
                            array(
                                'id' => 'meta_field2',
                                'label' => __( 'Meta field-2 label:', 'nrgnetwork'),
                                'default' => __( 'Tools Used', 'nrgnetwork'),
                                'type' => 'input'
                            ),
                            array(
                                'id' => 'meta_field3',
                                'label' => __( 'Meta field-3 label:', 'nrgnetwork'),
                                'default' => __( 'Color', 'nrgnetwork'),
                                'type' => 'input'
                            ),
                            array(
                                'id' => 'meta_field4',
                                'label' => __( 'Meta field-4 label:', 'nrgnetwork'),
                                'default' => __( 'Copyright', 'nrgnetwork'),
                                'type' => 'input'
                            ),
                            array(
                                'id' => 'sub_title_fields_icon',
                                'type' => 'sub_title',
                                'label' => __( 'Meta Fields Icons', 'nrgnetwork'),
                                'default' => '',
                                'desc' => __( 'Our theme is compatible with FontAwesome font icon library. You should choose proper icon for your custom field ifon <a href="https://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">from here</a>.', 'nrgnetwork' )
                            ),
                            array(
                                'id' => 'meta_field1_icon',
                                'label' => __( 'Meta field-1 icon:', 'nrgnetwork'),
                                'default' => 'fa fa-graduation-cap',
                                'type' => 'input'
                            ),
                            array(
                                'id' => 'meta_field2_icon',
                                'label' => __( 'Meta field-2 icon:', 'nrgnetwork'),
                                'default' => 'fa fa-wrench',
                                'type' => 'input'
                            ),
                            array(
                                'id' => 'meta_field3_icon',
                                'label' => __( 'Meta field-3 icon:', 'nrgnetwork'),
                                'default' => 'fa fa-paint-brush',
                                'type' => 'input'
                            ),
                            array(
                                'id' => 'meta_field4_icon',
                                'label' => __( 'Meta field-4 icon:', 'nrgnetwork'),
                                'default' => 'fa fa-camera-retro',
                                'type' => 'input'
                            )
                        ),
                    ),// end Community
                    
                    // Post
                    array(
                        'id' => 'section_post',
                        'label' => __( 'Post', 'nrgnetwork'),
                        'controls' => array(
                            array(
                                'id' => 'post_comment',
                                'label' => __( 'Post Comment', 'nrgnetwork'),
                                'default' => 1,
                                'type' => 'switch'
                            ),
                            array(
                                'id' => 'post_related',
                                'label' => __( 'Related posts', 'nrgnetwork'),
                                'default' => 1,
                                'type' => 'switch'
                            ),
                            array(
                                'id' => 'post_sidebar',
                                'label' => __( 'Post sidebar', 'nrgnetwork'),
                                'default' => 1,
                                'type' => 'switch',
                                'desc' => __( 'Your post will show without sidebar when you turn this option Off.', 'nrgnetwork')
                            ),
                        ),
                    ),// end Post
                    
                    // Page
                    array(
                        'id' => 'section_page',
                        'label' => __( 'Page', 'nrgnetwork'),
                        'controls' => array(
                            array(
                                'id' => 'page_comment',
                                'label' => __( 'Page Comment', 'nrgnetwork'),
                                'default' => 1,
                                'type' => 'switch'
                            ),
                            array(
                                'id' => 'page_nextprev',
                                'label' => __( 'Next/Prev links', 'nrgnetwork'),
                                'default' => 1,
                                'type' => 'switch'
                            ),
                        ),
                    ),// end Page

                    // Portfolio
                    array(
                        'id' => 'section_portfolio',
                        'label' => __('Portfolio', 'nrgnetwork'),
                        'controls' => array(
                            array(
                                'id' => 'portfolio_label',
                                'label' => __('Portfolio Label', 'nrgnetwork'),
                                'default' => __('Portfolio', 'nrgnetwork'),
                                'type' => 'input'
                            ),
                            array(
                                'id' => 'portfolio_slug',
                                'label' => __('Portfolio Slug', 'nrgnetwork'),
                                'default' => 'portfolio-item',
                                'type' => 'input'
                            ),
                            array(
                                'id' => 'portfolio_sbar',
                                'label' => __('Layout', 'nrgnetwork'),
                                'default' => 'full',
                                'type' => 'select',
                                'choices' => array(
                                    'full' => __( 'No sidebar', 'nrgnetwork'),
                                    'left' => __( 'Left sidebar', 'nrgnetwork'),
                                    'right' => __( 'Right sidebar', 'nrgnetwork')
                                )
                            ),
                            array(
                                'id' => 'portfolio_exceprt',
                                'label' => __( 'Excerpt show', 'nrgnetwork'),
                                'default' => 0,
                                'type' => 'switch'
                            ),
                            array(
                                'id' => 'portfolio_exceprt_length',
                                'label' => __( 'Excerpt custom length', 'nrgnetwork'),
                                'default' => '0',
                                'type' => 'input',
                                'desc' => __( 'Type number value that for exceprt words. 0 delegates default excerpt of posts.', 'nrgnetwork')
                            ),
                            array(
                                'id' => 'sub_portfolio_single',
                                'type' => 'sub_title',
                                'label' => __( 'Single Post Options', 'nrgnetwork'),
                                'default' => ''
                            ),
                            array(
                                'id' => 'portfolio_related',
                                'label' => __( 'Related Posts', 'nrgnetwork'),
                                'default' => 1,
                                'type' => 'switch'
                            ),
                            array(
                                'id' => 'portfolio_comment',
                                'label' => __( 'Comment', 'nrgnetwork'),
                                'default' => 0,
                                'type' => 'switch'
                            ),
                            array(
                                'id' => 'portfolio_nextprev',
                                'label' => __( 'Next/Prev links', 'nrgnetwork'),
                                'default' => 1,
                                'type' => 'switch'
                            ),
                            array(
                                'id' => 'portfolio_page',
                                'label' => __( 'Portfolio Main Page', 'nrgnetwork'),
                                'default' => 'pages',
                                'type' => 'select',
                                'choices' => array('0' => __( 'Choose your page:', 'nrgnetwork' ) ) + $pages
                            ),
                        ),
                    )// end Portfolio
                )
            ),// end Post Types
            
            // Extras
            array(
                'id' => 'panel_extra',
                'label' => __( 'Extras', 'nrgnetwork'),
                'desc' => __( 'Export Import and Custom CSS.', 'nrgnetwork'),
                'sections' => array(
                    // Backup
                    array(
                        'type' => 'section',
                        'id' => 'section_backup',
                        'label' => __( 'Export/Import', 'nrgnetwork'),
                        'desc' => '',
                        'controls' => array(
                            array(
                                'id' => 'backup_settings',
                                'label' => __( 'Export Data', 'nrgnetwork'),
                                'desc' => __( 'Copy to Customizer Data', 'nrgnetwork'),
                                'default' => '',
                                'type' => 'backup'
                            ),
                            array(
                                'id' => 'import_settings',
                                'label' => __( 'Import Data', 'nrgnetwork'),
                                'desc' => __( 'Import Customizer Exported Data', 'nrgnetwork'),
                                'default' => '',
                                'type' => 'import'
                            )
                        )
                    ), // end backup
                    
                    // Custom
                    array(
                        'type' => 'section',
                        'id' => 'section_custom_css',
                        'label' => __( 'Custom CSS', 'nrgnetwork'),
                        'desc' => '',
                        'controls' => array(
                            array(
                                'id' => 'custom_css',
                                'label' => __( 'Custom CSS (general)', 'nrgnetwork'),
                                'default' => '',
                                'type' => 'textarea'
                            ),
                            array(
                                'id' => 'custom_css_tablet',
                                'label' => __( 'Tablet CSS', 'nrgnetwork'),
                                'default' => '',
                                'type' => 'textarea',
                                'desc' => __( 'Screen width between 768px and 991px.', 'nrgnetwork')
                            ),
                            array(
                                'id' => 'custom_css_widephone',
                                'label' => __( 'Wide Phone CSS', 'nrgnetwork'),
                                'default' => '',
                                'type' => 'textarea',
                                'desc' => __( 'Screen width between 481px and 767px. Ex: iPhone landscape.', 'nrgnetwork')
                            ),
                            array(
                                'id' => 'custom_css_phone',
                                'label' => __( 'Phone CSS', 'nrgnetwork'),
                                'default' => '',
                                'type' => 'textarea',
                                'desc' => __( 'Screen width up to 480px. Ex: iPhone portrait.', 'nrgnetwork')
                            ),
                        )
                    ), // end Custom
                    
                    // Terms of use
                    array(
                        'type' => 'section',
                        'id' => 'section_terms_of_use',
                        'label' => __( 'Sign Up page details', 'nrgnetwork'),
                        'desc' => __( 'Terms of use and Privicy options text. You should add your custom links to the anchor tags.', 'nrgnetwork'),
                        'controls' => array(
                            array(
                                'id' => 'terms_of_use',
                                'label' => __( 'Terms of use meta text', 'nrgnetwork'),
                                'default' => __( 'I have read and agree to the <a class="be-popup-terms" href="#!">Terms of Use</a> and <a class="be-popup-terms" href="#!">Privacy Policy</a>.', 'nrgnetwork'),
                                'type' => 'textarea'
                            ),
                        )
                    ) // end Terms of use
                )
            ) // end Extras
        );
        return $option;
    }
endif;

function nrgnetwork_theme_customize_setup(){
    // create instance of TT Theme Customizer
    new NRGnetwork_Theme_Customizer();
}
add_action( 'after_setup_theme', 'nrgnetwork_theme_customize_setup' );
