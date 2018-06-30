<?php get_header(); ?>
<div class="main-wrapp">
    <div class="container">
        <?php get_template_part("tpl", "page-title"); ?>
        <div class="padd-80">
            <div class="row">
                <div class="col-sm-12">
                    <div class="cnf-content page-content text-center">
                        <h2><?php esc_html_e('User Activation', 'nrgnetwork'); ?></h2>
                        <?php
                            global $wp_query;
                            $user = abs($wp_query->query_vars['user']);
                            $token = $wp_query->query_vars['token'];
                            $user_obj = get_user_by('id', $user);
                            if( $user_obj ){
                                $user_activation = get_user_meta($user, 'user_activation', true);
                                $user_activation_key = get_user_meta($user, 'user_activation_key', true);
                                if( $user_activation=='activated' ){
                                    // already activated
                                    ?>
                                    <p><?php esc_html_e('User already activated. Please try to log in.', 'nrgnetwork'); ?></p>
                                    <?php
                                } else if( $user_activation=='pending' && $user_activation_key==$token ){
                                    // activating
                                    update_user_meta( $user, 'user_activation', 'activated' );
                                    ?>
                                    <p><?php esc_html_e('Activation completed successfully. Please log in.', 'nrgnetwork'); ?></p>
                                    <?php
                                } else {
                                    // incorrect token
                                    ?>
                                    <p><?php esc_html_e('Incorrect token and user.', 'nrgnetwork'); ?></p>
                                    <?php
                                }
                            } else {
                                ?>
                                <p><?php esc_html_e('You are not human. Please try again.', 'nrgnetwork'); ?></p>
                                <?php
                            }
                        ?>
                        <a href="<?php print esc_url(home_url('/')); ?>" class="return_home borderred_link"><span><?php esc_html_e('Home', 'nrgnetwork'); ?></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();