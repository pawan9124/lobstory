<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php if (NRGnetwork_Std::get_mod('loader_off') != '1'): ?>
        <!-- THE LOADER -->
        <div class="be-loader">
            <div class="spinner">
                <?php
                    $loader_logo = NRGnetwork_Std::get_mod('loader_logo');
                    $loader_width = NRGnetwork_Std::get_mod('loader_logo_with');
                    if( !empty($loader_logo) ){
                        print '<img src="'.esc_url($loader_logo).'" style="width:'.esc_attr(abs($loader_width)).'px;"  alt="'.get_bloginfo('name').'">';
                    } else{
                        print '<img src="'.get_template_directory_uri().'/img/logo-loader.png"  alt="'.get_bloginfo('name').'">';
                    }
                ?>
                <p class="circle">
                    <span class="ouro">
                        <span class="left"><span class="anim"></span></span>
                        <span class="right"><span class="anim"></span></span>
                    </span>
                </p>
            </div>
        </div>
    <?php endif; ?>
    <!-- THE HEADER -->
    <header>
        <div class="container-fluid custom-container">
            <div class="row no_row row-header">
                <div class="brand-be"><a href="<?php print esc_url(home_url('/')); ?>"><?php bloginfo( 'name' ); ?></a></div>
                <div class="header-menu-block">
                    <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span></span></button>
                    <?php
                        $nav_menu=wp_nav_menu( array(
                            'menu_id'           => 'one',
                            'menu_class'        => 'header-menu',
                            'theme_location'    => 'primary',
                            'container'         => '',
                            'fallback_cb'       => 'nrgnetwork_primary_callback',
                            'echo'              =>false

                        ) );
                    $home_link=home_url();
                    $nav_menu=str_replace('href="/','href="'.$home_link.'/',$nav_menu);
                    echo $nav_menu;
                    ?>
                </div>
                <?php if(function_exists('bp_message_threads') and class_exists('TT_Portfolio_PT')) { ?>
                <div class="login-header-block">
                    <div class="login_block">
                        <?php if( !is_user_logged_in() ): ?>
                            <a class="btn-login btn color-1 size-2 hover-2" href="javascript:;">
                                <i class="fa fa-user"></i>
                                <?php esc_html_e('Login', 'nrgnetwork'); ?>
                            </a>
                        <?php
                            else:
                                get_template_part('tpl', 'author-header');
                            endif;
                        ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </header>

