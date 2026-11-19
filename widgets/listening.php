<?php
/**
 * Listening Widget
 *
 * Functions to handle dynamic menu rendering with custom Widgets.
 *
 * @package Book Reviewer
 */

/**
 * Build a tree from flat menu items.
 *
 * @param string $location Theme location.
 * @return array Multi-dimensional array of menu items.
 */
namespace rswptheme\RSWPTheme_Core;

class Book_Store_Currently_Listening_Widget extends \WP_Widget {

    public function __construct() {
        parent::__construct(
            'book_store_currently_listening',
            __('Currently Listening Widget', 'book-store'),
            array('description' => __('Shows current audiobook/book progress', 'book-store'))
        );
    }

    // Frontend Output
    public function widget($args, $instance) {

        $title    = $instance['title'] ?? 'Currently Listening';
        $book     = $instance['book'] ?? 'Dune';
        $author   = $instance['author'] ?? 'Frank Herbert';
        $image    = $instance['image'] ?? '';
        $progress = $instance['progress'] ?? 65;

        echo $args['before_widget'];
        ?>

        <div class="cl-widget bg-dark text-white p-5 md:p-6 rounded-2xl shadow-sm relative overflow-hidden">
            <div class="cl-bookicon absolute top-0 right-0 opacity-10 text-8xl md:text-9xl -mt-6 md:-mt-10 -mr-6 md:-mr-10">
                <i class="fas fa-book-open"></i>
            </div>

            <h3 class="text-[10px] br-listening-title has-text-color md:text-xs font-bold uppercase tracking-widest text-brand-400 mb-4 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M160 288C160 199.6 231.6 128 320 128C408.4 128 480 199.6 480 288L480 325.5C470 322 459.2 320 448 320L432 320C405.5 320 384 341.5 384 368L384 496C384 522.5 405.5 544 432 544L448 544C501 544 544 501 544 448L544 288C544 164.3 443.7 64 320 64C196.3 64 96 164.3 96 288L96 448C96 501 139 544 192 544L208 544C234.5 544 256 522.5 256 496L256 368C256 341.5 234.5 320 208 320L192 320C180.8 320 170 321.9 160 325.5L160 288z"/></svg> 
                <?php echo esc_html($title); ?>
            </h3>

            <div class="flex items-center space-x-4 relative z-10">
                
                <img src="<?php echo esc_url($image); ?>"
                    class="cl-thumb w-14 h-20 md:w-16 md:h-24 object-cover rounded shadow-lg border border-gray-700"
                    alt="<?php echo esc_attr($book); ?>">

                <div class="flex-grow">
                    <h4 class="font-serif txt-white has-text-color font-bold text-base md:text-lg leading-tight mb-1">
                        <?php echo esc_html($book); ?>
                    </h4>

                    <p class="text-[10px] txt-dark-light has-text-color md:text-xs text-gray-400 mb-2 md:mb-3">
                        <?php echo esc_html($author); ?>
                    </p>

                    <div class="w-full bg-gray-700 rounded-full h-1 md:h-1.5 mb-1">
                        <div class="cl-pbar bg-brand-500 h-1 md:h-1.5 rounded-full"
                             style="width: <?php echo intval($progress); ?>%">
                        </div>
                    </div>

                    <p class="text-[9px] txt-dark-light has-text-color md:text-[10px] text-right text-gray-400">
                        <?php echo intval($progress); ?>% Completed
                    </p>
                </div>
            </div>
        </div>

        <?php
        echo $args['after_widget'];
    }

    // Backend Form
    public function form($instance) {

        $title    = $instance['title'] ?? '';
        $book     = $instance['book'] ?? '';
        $author   = $instance['author'] ?? '';
        $image    = $instance['image'] ?? '';
        $progress = $instance['progress'] ?? '';
        ?>

        <p>
            <label>Title:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label>Book Name:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('book'); ?>" value="<?php echo esc_attr($book); ?>">
        </p>

        <p>
            <label>Author:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('author'); ?>" value="<?php echo esc_attr($author); ?>">
        </p>

        <p>
            <label>Image URL:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo esc_attr($image); ?>">
        </p>

        <p>
            <label>Progress (%):</label>
            <input type="number" min="0" max="100" class="widefat" name="<?php echo $this->get_field_name('progress'); ?>" value="<?php echo esc_attr($progress); ?>">
        </p>

        <?php
    }

    // Save Data
    public function update($new_instance, $old_instance) {
        return array(
            'title'    => sanitize_text_field($new_instance['title']),
            'book'     => sanitize_text_field($new_instance['book']),
            'author'   => sanitize_text_field($new_instance['author']),
            'image'    => esc_url_raw($new_instance['image']),
            'progress' => intval($new_instance['progress']),
        );
    }
}

// register
function bstore_register_listening_widget() {
    register_widget(__NAMESPACE__ . '\Book_Store_Currently_Listening_Widget');
}
add_action('widgets_init', __NAMESPACE__ . '\bstore_register_listening_widget');