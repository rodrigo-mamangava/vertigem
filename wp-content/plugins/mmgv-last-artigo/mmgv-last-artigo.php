<?php

/**
 * Plugin Name: Último artigo
 * Description: Mostra o último artigo em destaque
 * Author: Mamangava
 * Author URI: http://mamangava.com/
 * Version: 1.0.0
 * License: GPLv2 or later
 */
class MmgvUltimoArtigo extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'ultimoArtigo', // Base ID
                __('Último artigo', 'text_domain'), // Name
                array('description' => __('Mostra o último artigo em destaque', 'text_domain'),) // Args
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
//        echo $args['before_widget'];
//        if (!empty($instance['title'])) {
//            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
//        }
//        echo __('Hello, World!', 'text_domain');
//        echo $args['after_widget'];

        $args = array(
            'post_type' => 'artigo',
            'posts_per_page' => 1,
            'order' => 'DESC',
            'orderby' => 'date',
        );

// The Query
        $the_query = new WP_Query($args);
        ?>
        <div class="utlimo-artigo">
            <?php if ($the_query->have_posts()) : ?>
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <?php $terms = wp_get_post_terms(get_the_ID(), 'nome-coluna'); ?>           
                    <a href="<?php echo get_permalink() ?>">
                        <?php echo get_avatar(get_the_author_meta('ID'), $size = '300'); ?>

                        <p class="nome-autor"><?php echo get_the_author(); ?></p>

                        <p class="nome-coluna">
                            <span class="extra2" >:</span>
                                <?php echo $terms[0]->name; ?>
                            <span class="extra2">:</span>
                        </p>

                        <?php the_title('<h2 class="titulo-artigo">', '</h2>'); ?>

                        <div class="conteudo-artigo">
                            <?php the_special_excerpt(get_the_ID(), 150, ' <span class="extra">{...}</span>'); ?>
                        </div>
                    </a>

                <?php endwhile ?>

            <?php else : ?>

                <p>Nenhum artigo foi encontrado!</p>

            <?php endif; ?>

        </div>

        <?php
        wp_reset_postdata();
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('New title', 'text_domain');
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

// class Foo_Widget
// register Foo_Widget widget
function registerMmgvUltimoArtigo() {
    register_widget('MmgvUltimoArtigo');
}

add_action('widgets_init', 'registerMmgvUltimoArtigo');
