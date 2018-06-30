<!-- MAIN CONTENT -->
<div id="content-block">
    <div class="container be-detail-container">
        <h2 class="content-title"><?php NRGnetwork_TPL::get_page_titles(); ?></h2>
        <div class="blog-wrapper blog-list blog-fullwith">
            <div class="row">
                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="blog-post be-large-post type-2">
                            <div class="info-block clearfix">
                                <div class="be-large-post-align">
                                    <?php print NRGnetwork_C::get_like_link('<i class="fa fa-thumbs-o-up"></i> '.NRGnetwork_C::get_likes()); ?>
                                    <a href="<?php the_permalink(); ?>"><i class="fa fa-eye"></i> <?php print NRGnetwork_C::get_views(); ?></a>
                                    <a href="<?php the_permalink(); ?>#be-comment-block"><i class="fa fa-comment-o"></i> <?php comments_number('0', '1', '%'); ?></a>
                                    <div class="be-text-tags"><?php print get_the_category_list(', '); ?></div>                                     
                                </div>
                            </div>
                            <div class="be-large-post-align blog-content">
                                <div class="be-text-tags clearfix custom-a-b">
                                    <div class="post-date"><i class="fa fa-clock-o"></i> <?php print get_the_date(); ?></div>
                                    <div class="author-post">
                                        <?php print get_avatar( $post->post_author, 20 ); ?>
                                        <span>by <a href="<?php the_permalink(); ?>"><?php the_author(); ?></a></span>
                                    </div>
                                </div>
                                <h3 class="be-post-title"><?php the_title(); ?></h3>
                                <div class="post-text">
                                    <?php the_content();
                                        wp_link_pages( array(
                                            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'nrgnetwork') . '</span>',
                                            'after'       => '</div>',
                                            'link_before' => '<span>',
                                            'link_after'  => '</span>',
                                            'pagelink'    => '<span class="screen-reader-text">' . esc_html__('Page', 'nrgnetwork') . ' </span>%',
                                            'separator'   => '<span class="screen-reader-text">, </span>',
                                        ) );
                                    ?>
                                </div>
                            </div>
                            <div class="be-large-post-align">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="be-bottom">
                                            <div class="tags_block clearfix">
                                                <?php
                                                    $tag_list = get_the_tag_list();
                                                    if( !empty($tag_list) ):
                                                ?>
                                                        <h4 class="be-bottom-title"><?php esc_html_e('Tags', 'nrgnetwork'); ?></h4>
                                                        <div class="tags-button"><?php print get_the_tag_list('<ul><li>', '</li><li>', '</li></ul>'); ?></div>
                                                <?php endif; ?>
                                            </div>                                  
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="be-bottom right">
                                            <h4 class="be-bottom-title"><?php esc_html_e('Share', 'nrgnetwork'); ?></h4>
                                            <ul class="soc_buttons light">
                                                <?php
                                                    $links = NRGnetwork_TPL::get_share_links();
                                                    foreach ($links as $key => $value) {
                                                        switch( $key ){
                                                            case 'facebook':
                                                                print ' <li class="facebook"><a href="'.$value.'"><i class="fa fa-facebook"></i></a></li>';
                                                                break;
                                                            case 'twitter':
                                                                print ' <li class="twitter"><a href="'.$value.'"><i class="fa fa-twitter"></i></a></li>';
                                                                break;
                                                            case 'googleplus':
                                                                print ' <li class="google-plus"><a href="'.$value.'"><i class="fa fa-google-plus"></i></a></li>';
                                                                break;
                                                            case 'pinterest':
                                                                print ' <li class="pinterest"><a href="'.$value.'"><i class="fa fa-pinterest"></i></a></li>';
                                                                break;
                                                            case 'instagram':
                                                                print ' <li class="instagram"><a href="'.$value.'"><i class="fa fa-instagram"></i></a></li>';
                                                                break;
                                                            case 'linkedin':
                                                                print ' <li class="linkedin"><a href="'.$value.'"><i class="fa fa-linkedin"></i></a></li>';
                                                                break;
                                                        }
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>                          
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <h3 class="widget-title"><?php esc_html_e('Related Posts', 'nrgnetwork'); ?></h3>
                    <div class="row">
                        <?php
                            print NRGnetwork_TPL::get_prev_post();
                            print NRGnetwork_TPL::get_next_post();
                        ?>
                    </div>
                    <?php
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>