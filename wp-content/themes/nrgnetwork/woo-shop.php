<?php
    $network_post_type = 'product';
    $network_post_term = 'product_cat';
    $network_post_tag = 'product_tag';
    $portfolio_exceprt = false;
    if ( NRGnetwork_Std::get_mod('portfolio_exceprt') == '1' ) {
        $portfolio_exceprt = true;
    }
    $portfolio_exceprt_length = 0;
    if ( NRGnetwork_Std::get_mod('portfolio_exceprt_length') != '0' && NRGnetwork_Std::get_mod('portfolio_exceprt_length') != '') {
        $portfolio_exceprt_length = abs(NRGnetwork_Std::get_mod('portfolio_exceprt_length'));
    }
?>
<!-- MAIN CONTENT -->
<div id="content-block">
    <?php
        while ( have_posts() ) : the_post();
            $title_show = NRGnetwork_Std::getmeta('title_show');
            $title_bg = NRGnetwork_Std::get_meta_bg_value('title_bg');
            if( $title_show=='1' ):
    ?>
                <div class="head-bg">
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
                            }
                        ?>
                        </div>
                    </div>  
                </div>
            <?php endif;
            $content = get_the_content();
        endwhile; 
    ?>
    <div class="container-fluid custom-container be-detail-container">
        <div class="row">
            <div class="col-md-2 left-feild">
                <form class="input-search" id="search-form-folio">
                    <input type="text" placeholder="<?php esc_html_e('Enter keyword', 'nrgnetwork'); ?>" id="folio_filter_search">
                    <i class="fa fa-search"></i>
                    <input type="submit" value="">
                </form>
            </div>
            <div class="col-md-10 ">
                <div class="for-be-dropdowns">
                    <div class="be-drop-down filter-projects">
                        <i class="fa fa-th"></i>
                        <span class="be-dropdown-content"><?php esc_html_e('Projects', 'nrgnetwork'); ?></span>
                        <input type="hidden" class="form-input" value="projects" id="folio_filter_type">
                        <input type="hidden" class="form-input" value="<?php print esc_attr($network_post_type); ?>" id="folio_post_type">
                        <ul class="drop-down-list">
                            <li><a href="javascript:;" data-id="projects"><i class="fa fa-th"></i>&nbsp;&nbsp;<?php esc_html_e('Projects', 'nrgnetwork'); ?></a></li>
                            <li><a href="javascript:;" data-id="people"><i class="fa fa-users"></i>&nbsp;&nbsp;<?php esc_html_e('People', 'nrgnetwork'); ?></a></li>
                        </ul>
                    </div>
                    <div class="be-drop-down filter-categories">
                        <i class="fa fa-folder-open-o"></i>
                        <span class="be-dropdown-content"><?php esc_html_e('All Creative Categories', 'nrgnetwork'); ?></span>
                        <input type="hidden" class="form-input" value="0" id="folio_filter_category">
                        <ul class="drop-down-list">
                            <li><a href="javascript:;" data-id="0"><?php esc_html_e('All Categories', 'nrgnetwork'); ?></a></li>
                            <?php
                                $terms = get_terms($network_post_term);
                                foreach ($terms as $term) {
                                    print "<li><a href='javascript:;' data-id='$term->term_id'>$term->name</a></li>";
                                }
                            ?>
                        </ul>
                    </div>
                    <div class="be-drop-down filter-features">
                        <i class="fa fa-star-half-o"></i>
                        <span class="be-dropdown-content"><?php esc_html_e('Most Recent', 'nrgnetwork'); ?></span>
                        <input type="hidden" class="form-input" value="recent" id="folio_filter_features">
                        <ul class="drop-down-list">
                            <li><a href="javascript:;" data-id="recent"><i class="fa fa-refresh"></i>&nbsp;&nbsp;<?php esc_html_e('Most Recent', 'nrgnetwork'); ?></a></li>
                            <li><a href="javascript:;" data-id="features"><i class="fa fa-star-o"></i>&nbsp;&nbsp;<?php esc_html_e('Featured', 'nrgnetwork'); ?></a></li>
                            <li><a href="javascript:;" data-id="likes"><i class="fa fa-thumbs-o-up"></i>&nbsp;&nbsp;<?php esc_html_e('Most Appreciated', 'nrgnetwork'); ?></a></li>
                            <li><a href="javascript:;" data-id="views"><i class="fa fa-eye"></i>&nbsp;&nbsp;<?php esc_html_e('Most Viewed', 'nrgnetwork'); ?></a></li>
                            <li><a href="javascript:;" data-id="comments"><i class="fa fa-comments-o"></i>&nbsp;&nbsp;<?php esc_html_e('Most Discussed', 'nrgnetwork'); ?></a></li>
                        </ul>
                    </div>
                    <div class="be-drop-down filter-worldwide">
                        <i class="fa fa-globe"></i>
                        <span class="be-dropdown-content"><?php esc_html_e('Worldwide', 'nrgnetwork'); ?></span>
                        <input type="hidden" class="form-input" value="0" id="folio_filter_worldwide">
                        <ul class="drop-down-list">
                            <li><a href="javascript:;" data-id="0"><?php esc_html_e('Worldwide', 'nrgnetwork'); ?></a></li>
                            <?php
                                $users_country = get_users(array(
                                            'meta_key'     => 'cs_country',
                                            'meta_value'   => '_country',
                                            'meta_compare' => '!=',
                                            'orderby'      => 'meta_value',
                                            'order'        => 'ASC'
                                        ));

                                $countries = array();
                                foreach ($users_country as $val) {
                                    $countries[] = $val->get('cs_country');
                                }

                                $countries = array_unique($countries);
                                foreach ($countries as $val) {
                                    print "<li><a href='javascript:;' data-id='".esc_attr($val)."'>$val</a></li>";
                                }
                            ?>
                        </ul>
                    </div>
                </div>              
            </div>
        </div>
    </div>
    <div id="main-content-panel" class="container-fluid custom-container">
        <div class="row">
            <?php 
                $column = 'col-sm-10';
                $sidebar = 'left';
                if ($sidebar == 'full' || $sidebar == '') {
                    $column = 'col-sm-12';
                } elseif($sidebar == 'left') { $column = 'col-sm-10 pull-right'; }
            ?>
            <div class="<?php print($column); ?>">
                <div class="row _post-container_">
                    <?php
                        $args = array(
                            'post_type' => $network_post_type,
                            'posts_per_page' => 16,
                            'ignore_sticky_posts' => true
                        );

                        $posts_query = new WP_Query($args);
                        while ( $posts_query->have_posts() ):
                            $posts_query->the_post();
                    ?>
                            <div class="custom-column-5">
                                <div class="be-post item-media">
                                    <?php
                                        if( has_post_thumbnail() ){
                                            $img_size = 'full';
                                            $img = wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'nrgnetwork-folio-grid' );
                                            print '<a href="'.esc_url( get_permalink() ).'" class="be-img-block">'.NRGnetwork_C::image_filter($img).'</a>';
                                        } else {
                                            print '<a href="'.esc_url( get_permalink() ).'" class="be-img-block no-image-post"><img src="'.get_template_directory_uri().'/img/placeholder-no-image.png" alt="No image"/></a>';
                                        }

                                        $featured = NRGnetwork_Std::getmeta('featured_item');
                                        $featured = $featured=='1' ? '<span class="item-featured"><i class="fa fa-star-o"></i></span>' : '';
                                        print "$featured";
                                    ?>
                                    <a href="<?php the_permalink(); ?>" class="be-post-title"><?php the_title(); ?></a>
                                    <span>
                                        <?php
                                            $cat_html = array();
                                            $cats = NRGnetwork_TPL::get_post_cats($network_post_type, get_the_id());
                                            foreach ($cats as $cat) {
                                                $cat_html[] = '<a href="'.$cat['link'].'" class="be-post-tag">'.$cat['title'].'</a>';
                                            }
                                            print implode(', ', $cat_html);
                                        ?>
                                    </span>
                                    <?php 
                                        if($portfolio_exceprt)
                                            if($portfolio_exceprt_length == 0){ ?>
                                                <span><?php the_excerpt(); ?></span>
                                            <?php } else {
                                                print '<span>' . nrgnetwork_showBrief( strip_shortcodes(get_the_excerpt()), $portfolio_exceprt_length) . '</span>';
                                            }
                                        }
                                    ?>
                                    <div class="author-post">
                                        <?php print get_avatar( $post->post_author, 20 ); ?>
                                        <span>by <a href="<?php print NRGnetwork_C::get_author_uri($post->post_author); ?>"><?php the_author(); ?></a></span>
                                    </div>
                                    <div class="info-block">
                                        <?php print NRGnetwork_C::get_like_link('<i class="fa fa-thumbs-o-up"></i> '.NRGnetwork_C::get_likes()); ?>
                                        <a href="<?php the_permalink(); ?>"><i class="fa fa-eye"></i> <?php print NRGnetwork_C::get_views(); ?></a>
                                        <a href="<?php the_permalink(); ?>#be-comment-block"><i class="fa fa-comment-o"></i> <?php comments_number('0', '1', '%'); ?></a>
                                    </div>
                                </div>
                            </div>
                    <?php endwhile; ?>
                </div>
                <?php if( abs($posts_query->post_count)>15 ): ?>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <br>
                            <a href="javascript:;" class="btn color-3 size-1 hover-1" id="netsearch_btn_pager"><?php esc_html_e('Load more ...', 'nrgnetwork'); ?></a>
                            <div class="hidden" id="netsearch_args"><?php print NRGnetwork_C::encode($args); ?></div>
                            <input type="hidden" id="netsearch_paged" value="1">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php 
                if($column != 'col-sm-12') { 
                    print '<div class="col-xs-12 col-sm-2">';
            ?>
                        <div class="be-vidget">
                            <h3 class="letf-menu-article"><?php esc_html_e('Popular Categories', 'nrgnetwork'); ?></h3>
                            <div class="creative_filds_block">
                                <div class="ul">
                                    <?php
                                        $args_tag = array(
                                            'orderby' => 'count',
                                            'order' => 'DESC',
                                            'number' => 5
                                        );

                                        $terms = get_terms($network_post_term, $args_tag);
                                        foreach ($terms as $term) {
                                            print '<a href="'.get_term_link($term).'">'.$term->name.'</a>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="be-vidget">
                            <h3 class="letf-menu-article"><?php esc_html_e('Popular Tags', 'nrgnetwork'); ?></h3>
                            <div class="tags_block clearfix">
                                <ul>
                                    <?php
                                        $args_tag = array(
                                            'orderby' => 'count',
                                            'order' => 'DESC',
                                            'number' => 10
                                        );
                                        $terms = get_terms($network_post_tag, $args_tag);
                                        if(!is_wp_error($terms)) {
                                            foreach ($terms as $term) {
                                                print '<li><a href="'.get_term_link($term).'">'.$term->name.'</a></li>';
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php 
                            get_template_part('tpl', 'filter');
                            get_template_part('sidebar', 'activity');
                    print '</div>';
                } 
            ?>
        </div>
    </div>
</div>