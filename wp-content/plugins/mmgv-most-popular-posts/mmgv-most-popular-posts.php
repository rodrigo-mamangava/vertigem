<?php
/**
 * Plugin Name: Post mais populares Mamamngava
 * Description: Lista dos 5 post com mais views no blog
 * Author: Mamangava
 * Author URI: http://mamangava.com/
 * Version: 1.0.0
 * License: GPLv2 or later
 */

/**
 * 
 * @param type $postID
 */
function myPopularPostView($postID) {

    $totalKey = 'views';

    $total = get_post_meta($postID, $totalKey, TRUE);

    if ($total == '') {
        delete_post_meta($postID, $totalKey);
        add_post_meta($postID, $totalKey, '0');
    } else {
        $total++;
        update_post_meta($postID, $totalKey, $total);
    }
}

/**
 * 
 * @global type $post
 * @param type $postId
 * @return type
 */
function myCountPopularPost($postId) {

    if (!is_single())
        return;

    if (!is_user_logged_in()) {
        if (empty($postId)) {
            global $post;
            $postId = $post->ID;
        }
        myPopularPostView($postId);
    }
}

add_action('wp_head', 'myCountPopularPost');

/**
 * 
 */
function myAddViewColumn($defaults) {

    $defaults['post_views'] = 'View Count';
    return $defaults;
}

add_filter('manage_posts_columns', 'myAddViewColumn');

function myDisplyViews($columnName) {
    if ($columnName === 'post_views') {
        echo (int) get_post_meta(get_the_ID(), 'views', true);
    }
}

add_action('manage_posts_custom_column', 'myDisplyViews', 5, 2);



///

/**
 * Adds Foo_Widget widget.
 */
class PopularPostMmgv extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'popular_post_mmgv', // Base ID
                __('Post polulares', 'text_domain'), // Name
                array('description' => __('Mostra os 05 posts mais polulares', 'text_domain'),) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {



        //args
        $query_args = array(
            'post_type' => 'post',
            'posts_per_page' => 5,
            'meta_key' => 'views',
            'order' => 'DESC',
            'orderby' => 'meta_value_num',
            'ignore_sticky_posts' => true,
        );

        // The Query
        $the_query = new WP_Query($query_args);

        $count = 1;

        // The Loop
        if ($the_query->have_posts()) {
            echo '<div class = "mmgv-popular-list">';

            echo $args['before_widget'];
            if (!empty($instance['title'])) {
                echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
            }

            while ($the_query->have_posts()) {
                $the_query->the_post();

                echo '<a href="' . esc_url(get_permalink()) . '">';
                echo '<div class="item">';
                //debug(has_post_thumbnail());

                echo '<p class="contador">' . $count . '</p>';
                echo '<p class="titulo">';
                echo get_the_title();
                echo '</p>';

                echo '<div class="clearfix"></div>';
                echo '</div>';
                echo '</a>';

                $count++;
            }
            echo '</div>';
        } else {
            // no posts found
        }
        /* Restore original Post Data */
        wp_reset_postdata();



        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Posts populares', 'text_domain');
        ?>
        <p>
            
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';

        return $instance;
    }

}

// class PopularPostMmgv
// register Foo_Widget widget
function register_popular_post_mmgv_widget() {
    register_widget('PopularPostMmgv');
}

add_action('widgets_init', 'register_popular_post_mmgv_widget');
