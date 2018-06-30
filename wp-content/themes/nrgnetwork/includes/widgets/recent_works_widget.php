<?php
class NRGnetwork_RecentWorksWidget extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'recent_works', 'description' => __( 'Recent Works.', 'nrgnetwork') );
        parent::__construct(false, ': Recent Works', $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        extract(array_merge(array(
            'title' => '',
            'number_posts' => 5,
            'exclude_posts' => '',
            'exclude_cats' => '',
            'post_id' => '',
            'post_type' => 'post'
        ), $instance));
        $q = array();
        $q['post_type'] = $post_type;
        if( $post_id != '' ) {
            $q['post__in'] = explode(',', $post_id);
        }
        if( $exclude_posts != '' ) {
            $q['post__not_in'] = explode(',', $exclude_posts);
        }
        $q['posts_per_page'] = $number_posts;
        $q['ignore_sticky_posts'] = 1;
        if( $exclude_cats != '') {
            $q['category__not_in'] = explode(',', $exclude_cats);
        }
        print($before_widget);
        if ($title != '') {
            printf('%s%s%s', $args['before_title'], $title, $args['after_title']);
        }
        query_posts($q);
        print "<div class='galerry'>";
        while (have_posts()) : the_post();
            if(has_post_thumbnail()) {
                print '<a href="'. esc_url( get_permalink() ) .'">'. get_the_post_thumbnail(get_the_ID(), 'nrgnetwork-folio-small-thumb').'</a>';
            }
        endwhile;
        print "</div>";
        print($after_widget);
        wp_reset_postdata();
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['number_posts'] = sanitize_text_field($new_instance['number_posts']);
        $instance['exclude_cats'] = sanitize_text_field($new_instance['exclude_cats']);
        $instance['exclude_posts'] = sanitize_text_field($new_instance['exclude_posts']);
        $instance['post_id'] = sanitize_text_field($new_instance['post_id']);
        $instance['post_type'] = $new_instance['post_type'];
        return $instance;
    }

    function form($instance) {
        //Output admin widget options form
        extract(shortcode_atts(array(
            'title' => '',
            'number_posts' => 5,
            'exclude_posts' => '',
            'exclude_cats' => '',
            'post_id' => '',
            'post_type' => ''
        ), $instance));
        ?>
        <p>
            <label for="<?php print esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e("Title:", 'nrgnetwork'); ?></label>
            <input type="text" class="widefat" id="<?php print esc_attr($this->get_field_id('title')); ?>" name="<?php print esc_attr($this->get_field_name('title')); ?>" value="<?php print esc_attr($title); ?>"  />
        </p>
        <p>
            <input type="text" id="<?php print esc_attr($this->get_field_id('number_posts')); ?>" name="<?php print esc_attr($this->get_field_name('number_posts')); ?>" value="<?php print esc_attr($number_posts); ?>" size="3" />
            <label for="<?php print esc_attr($this->get_field_id('number_posts')); ?>"><?php _e( 'Number of posts to show', 'nrgnetwork'); ?></label>
        </p>
        <p>
            <input type="text" id="<?php print esc_attr($this->get_field_id('exclude_cats')); ?>" name="<?php print esc_attr($this->get_field_name('exclude_cats')); ?>" value="<?php print esc_attr($exclude_cats); ?>" size="3" />
            <label for="<?php print esc_attr($this->get_field_id('exclude_cats')); ?>"><?php _e( 'Exclude category ID (optional)', 'nrgnetwork'); ?></label>
            <br><small><?php _e( 'You can include multiple categories with comma separation.', 'nrgnetwork'); ?></small>
        </p>
        <p>
            <input type="text" id="<?php print esc_attr($this->get_field_id('exclude_posts')); ?>" name="<?php print esc_attr($this->get_field_name('exclude_posts')); ?>" value="<?php print esc_attr($exclude_posts); ?>" size="3" />
            <label for="<?php print esc_attr($this->get_field_id('exclude_posts')); ?>"><?php _e( 'Exclude post ID (optional)', 'nrgnetwork'); ?></label>
            <br><small><?php _e( 'You can include multiple posts with comma separation.', 'nrgnetwork'); ?></small>
        </p>
        <p>
            <input type="text" id="<?php print esc_attr($this->get_field_id('post_id')); ?>" name="<?php print esc_attr($this->get_field_name('post_id')); ?>" value="<?php print esc_attr($post_id); ?>" />
            <label for="<?php print esc_attr($this->get_field_id('post_id')); ?>"><?php _e( 'Post ID (optional)', 'nrgnetwork'); ?></label>
        </p>
        <p>
            <label for="<?php print esc_attr($this->get_field_id('post_type')); ?>"><?php esc_html_e('Select Type:', 'nrgnetwork') ?></label>
            <select id="<?php print esc_attr($this->get_field_id('post_type')); ?>" name="<?php print esc_attr($this->get_field_name('post_type')); ?>">
                <option value="post" <?php if($post_type == 'post') print 'selected="selected"'; ?>><?php _e( 'Post', 'nrgnetwork'); ?></option>
                <option value="portfolio" <?php if($post_type == 'portfolio') print 'selected="selected"'; ?>><?php _e( 'Portfolio', 'nrgnetwork'); ?></option>
            </select>
        </p>
        <?php
    }
}
add_action('widgets_init', create_function('', 'return register_widget("NRGnetwork_RecentWorksWidget");'));