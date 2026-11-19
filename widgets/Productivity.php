<?php
/**
 * Productivity Posts Widget
 *
 * @package RSWPTheme
 */

namespace rswptheme\RSWPTheme_Core;

class Productivity_Posts_Widget extends \WP_Widget {

    public function __construct() {

        parent::__construct(
            'productivity_posts_widget',
            __('RSWPT Productivity Posts', 'rswptheme'),
            array(
                'description' => __('Show productivity posts list widget.', 'rswptheme'),
            )
        );
    }

    /**
     * Frontend Output
     */
    public function widget($args, $instance) {

        echo $args['before_widget'];

        $title          = !empty($instance['title']) ? $instance['title'] : 'More in Productivity';
        $posts_per_page = !empty($instance['posts_per_page']) ? absint($instance['posts_per_page']) : 2;

        $query = new \WP_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => $posts_per_page,
            'post_status'    => 'publish',
        ));

        ?>

        <div class="bg-white p-5 md:p-6 rounded-2xl shadow-sm border border-gray-100">

            <h3 class="text-base md:text-lg font-bold font-serif text-dark mb-4 border-b border-gray-100 pb-2">
                <?php echo esc_html($title); ?>
            </h3>

            <ul class="space-y-4">

                <?php if ($query->have_posts()) : ?>

                    <?php while ($query->have_posts()) : $query->the_post(); ?>

                        <li class="flex items-center space-x-3 group">

                            <a href="<?php the_permalink(); ?>" class="shrink-0">

                                <?php if (has_post_thumbnail()) : ?>

                                    <?php the_post_thumbnail(
                                        'thumbnail',
                                        array(
                                            'class' => 'w-12 h-16 object-cover rounded shadow-sm group-hover:opacity-80 transition'
                                        )
                                    ); ?>

                                <?php else : ?>

                                    <img 
                                        src="https://placehold.co/150x200"
                                        class="w-12 h-16 object-cover rounded shadow-sm group-hover:opacity-80 transition"
                                        alt="<?php the_title_attribute(); ?>"
                                    >

                                <?php endif; ?>

                            </a>

                            <div>

                                <a 
                                    href="<?php the_permalink(); ?>"
                                    class="text-sm font-bold text-gray-800 hover:text-brand-600 leading-tight block"
                                >
                                    <?php the_title(); ?>
                                </a>

                                <div class="text-yellow-400 text-[10px] mt-1">
                                    <?php rswpt_post_rating(); ?>
                                </div>

                            </div>

                        </li>

                    <?php endwhile; ?>

                    <?php wp_reset_postdata(); ?>

                <?php else : ?>

                    <li>
                        <?php esc_html_e('No posts found.', 'rswptheme'); ?>
                    </li>

                <?php endif; ?>

            </ul>

        </div>

        <?php

        echo $args['after_widget'];
    }

    /**
     * Admin Form
     */
    public function form($instance) {

        $title = !empty($instance['title']) ? $instance['title'] : 'More in Productivity';

        $posts_per_page = !empty($instance['posts_per_page']) ? absint($instance['posts_per_page']) : 2;

        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_html_e('Title:', 'rswptheme'); ?>
            </label>

            <input 
                class="widefat"
                id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                type="text"
                value="<?php echo esc_attr($title); ?>"
            >
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>">
                <?php esc_html_e('Posts Per Page:', 'rswptheme'); ?>
            </label>

            <input 
                class="tiny-text"
                id="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>"
                name="<?php echo esc_attr($this->get_field_name('posts_per_page')); ?>"
                type="number"
                step="1"
                min="1"
                value="<?php echo esc_attr($posts_per_page); ?>"
            >
        </p>

        <?php
    }

    /**
     * Save Widget Data
     */
    public function update($new_instance, $old_instance) {

        $instance = array();

        $instance['title'] = sanitize_text_field($new_instance['title']);

        $instance['posts_per_page'] = absint($new_instance['posts_per_page']);

        return $instance;
    }
}

// Register Widget
function register_Productivity_widget() {
    register_widget(__NAMESPACE__ . '\Productivity_Posts_Widget');
}
add_action('widgets_init', __NAMESPACE__ . '\register_Productivity_widget');