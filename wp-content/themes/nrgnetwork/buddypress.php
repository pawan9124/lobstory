<?php get_header();
// MAIN CONTENT
while ( have_posts() ) : the_post(); ?>
    <div id="content-block">
        <?php
            $title_show = NRGnetwork_Std::getmeta('title_show');
            $title_bg = NRGnetwork_Std::get_meta_bg_value('title_bg');
            if( $title_show=='1' ):
        ?>
                <div class="head-bg style-2">
                    <div class="head-bg-img" style="<?php print esc_attr($title_bg); ?>"></div>
                    <div class="head-bg-content">
                        <h1><?php the_title(); ?></h1>
                        <p>
                            <?php 
                                if (is_user_logged_in()) {
                                    if(NRGnetwork_Std::getmeta('title_desc_loggedin')!='') { 
                                        print NRGnetwork_Std::getmeta('title_desc_loggedin');
                                    } else {
                                        print NRGnetwork_Std::getmeta('title_desc');
                                    }
                                } else {
                                    print NRGnetwork_Std::getmeta('title_desc');
                                }
                            ?>
                        </p>
                    </div>  
                </div>
        <?php endif; ?>
        <div class="container be-detail-container">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                        the_content();
                        if(NRGnetwork_Std::get_mod('page_nextprev')=='1') {
                            wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'nrgnetwork') . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                                'pagelink'    => '<span class="screen-reader-text">' . esc_html__('Page', 'nrgnetwork') . ' </span>%',
                                'separator'   => '<span class="screen-reader-text">, </span>',
                            ) );
                        }
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( NRGnetwork_Std::get_mod('page_comment')=='1' && (comments_open() || get_comments_number()) ) :
                            print "<div class='clearfix'></div>";
                            comments_template();
                        endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php endwhile;
get_footer();