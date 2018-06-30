<?php
/*
Template Name: Network Activity People
*/
get_header();

$network_post_type = NRGnetwork_Std::get_mod('network_post_type');
$network_post_type = !empty($network_post_type) ? $network_post_type : 'portfolio';
$network_post_term = 'portfolio_entries';
$network_post_tag = 'portfolio_tag';
if( $network_post_type=='post' ){
    $network_post_term = 'category';
    $network_post_tag = 'post_tag';
} else if( $network_post_type=='product' ){
    $network_post_term = 'product_cat';
    $network_post_tag = 'product_tag';
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
            if( strlen($content)>10 ):
            ?>
                <div class="container be-detail-container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="blog-content"><?php the_content(); ?></div>
                        </div>
                    </div>
                </div>
            <?php endif;
        endwhile; ?>
    <div class="container-fluid custom-container be-detail-container">
        <div class="row">
            <div class="col-md-2 left-feild">
                <form class="input-search" id="search-form-folio">
                    <input type="text" placeholder="<?php esc_attr_e('Enter keyword', 'nrgnetwork'); ?>" id="folio_filter_search">
                    <i class="fa fa-search"></i>
                    <input type="submit" value="">
                </form>
            </div>
            <div class="col-md-10 ">
                <div class="for-be-dropdowns">
                    <div class="be-drop-down filter-projects">
                        <i class="fa fa-th"></i>
                        <span class="be-dropdown-content"><?php esc_html_e('People', 'nrgnetwork'); ?></span>
                        <input type="hidden" class="form-input" value="people" id="folio_filter_type">
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
            <div class="col-md-2 left-feild">
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
                                if(!is_wp_error($terms)){
                                    foreach ($terms as $term) {
                                        print '<a href="'.get_term_link($term).'">'.$term->name.'</a>';
                                    }
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
                <?php get_template_part('tpl', 'filter'); ?>
            </div>
            <div class="col-md-10">
                <div class="row _post-container_">
                    <?php
                        $arg_user = array(
                            'orderby' => 'post_count',
                            'order' => 'DESC',
                            'number' => 16,
                            'offset' => 0
                        );
                        $user_ids = array();
                        $users = get_users($arg_user);
                        foreach ($users as $val) {
                            $user_ids[] = $val->ID;
                        }
                        $cs_class = new NRGnetwork_Community_Setings();
                        $result = $cs_class->get_authors_list($user_ids);
                        printf('%s', $result);
                    ?>
                </div>
                <?php if( count($user_ids)>15 ): ?>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <br>
                            <a href="javascript:;" class="btn color-3 size-1 hover-1" id="netsearch_btn_pager"><?php esc_html_e('Load more ...', 'nrgnetwork'); ?></a>
                            <div class="hidden" id="netsearch_args"><?php print NRGnetwork_C::encode($arg_user); ?></div>
                            <input type="hidden" id="netsearch_paged" value="1">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer();