<?php get_header(); ?>
<!-- MAIN CONTENT -->
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
                    <div class="desc">
                    <?php
                    if (is_user_logged_in()) {
                        if(NRGnetwork_Std::getmeta('title_desc_loggedin')!='') { 
                            print NRGnetwork_Std::getmeta('title_desc_loggedin');
                        } else {
                            print NRGnetwork_Std::getmeta('title_desc');
                        }
                    } else {
                        print NRGnetwork_Std::getmeta('title_desc');
                    } ?>
                    </div>
                </div>  
            </div>
        <?php endif; ?>
    <div class="container be-detail-container">
        <?php if( $title_show!='1' ): ?>
            <h2 class="content-title"><?php the_title(); ?></h2>
        <?php endif; ?>
        <div class="row">
            <?php 
                $column = 'col-sm-9';
                $sidebar = NRGnetwork_Std::getmeta('page_layout');
                if ($sidebar == 'full' || $sidebar == '') {
                    $column = 'col-sm-12';
                } elseif($sidebar == 'left') { $column = 'col-sm-9 pull-right'; }
                while ( have_posts() ) : the_post();
            ?>
                    <div class="<?php print wp_kses_post( $column ); ?>">
                        <div class="blog-content">
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
                                if ( comments_open() || get_comments_number() ) :
                                    print "<div class='clearfix'></div>";
                                    comments_template();
                                endif;
                            ?>
                        </div><!-- .blog-content -->
                    </div>
                <?php endwhile;
                if($column != 'col-sm-12') { get_template_part('sidebar','page'); }
            ?>
        </div>
    </div>
</div>
<?php get_footer();