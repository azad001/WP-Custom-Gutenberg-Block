<?php
/**
 * Book of the Month Widget
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

class Book_Of_The_Month_Widget extends \WP_Widget {

    public function __construct() {
        parent::__construct(
            'book_of_the_month_widget',
            __('Book of the Month Widget', 'book-store'),
            array('description' => __('Custom widget with media upload', 'book-store'))
        );
    }

    // Frontend Output
    public function widget($args, $instance) {

        $badge       = !empty($instance['badge']) ? $instance['badge'] : 'Book of the Month';
        $title       = !empty($instance['title']) ? $instance['title'] : '';
        $desc        = !empty($instance['desc']) ? $instance['desc'] : '';
        $image       = !empty($instance['image']) ? $instance['image'] : '';
        $button_text = !empty($instance['button_text']) ? $instance['button_text'] : '';
        $button_link = !empty($instance['button_link']) ? $instance['button_link'] : '';

        ?>

        <div class="bg-brand-50 p-5 md:p-6 rounded-2xl shadow-sm border border-brand-100">

            <?php if ($badge) : ?>
                <div class="bg-brand-600 text-white text-[9px] md:text-[10px] font-bold uppercase tracking-wider py-1 px-3 inline-block rounded-full mb-4">
                    <?php echo esc_html($badge); ?>
                </div>
            <?php endif; ?>

            <div class="text-center">

                <?php if ($image) : ?>
                    <img src="<?php echo esc_url($image); ?>" 
                        class="bookoftm-thumb w-24 md:w-32 mx-auto rounded shadow-md mb-3 md:mb-4" 
                        alt="<?php echo esc_attr($title); ?>">
                <?php endif; ?>

                <?php if ($title) : ?>
                    <h4 class="font-serif font-bold text-base md:text-lg text-dark mb-1">
                        <?php echo esc_html($title); ?>
                    </h4>
                <?php endif; ?>

                <?php if ($desc) : ?>
                    <p class="text-xs md:text-sm text-gray-600 mb-4">
                        <?php echo esc_html($desc); ?>
                    </p>
                <?php endif; ?>

                <?php if ($button_text && $button_link) : ?>
                    <a href="<?php echo esc_url($button_link); ?>"
                        class="block w-full bg-dark text-white font-semibold py-2.5 rounded-lg hover:bg-gray-800 transition shadow-sm text-xs md:text-sm">
                        <?php echo esc_html($button_text); ?>
                    </a>
                <?php endif; ?>

            </div>
        </div>

        <?php
    }

    // Backend Form
    public function form($instance) {

        $badge       = $instance['badge'] ?? 'Book of the Month';
        $title       = $instance['title'] ?? '';
        $desc        = $instance['desc'] ?? '';
        $image       = $instance['image'] ?? '';
        $button_text = $instance['button_text'] ?? '';
        $button_link = $instance['button_link'] ?? '';
        ?>

        <p>
            <label>Badge Text:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('badge'); ?>" type="text" value="<?php echo esc_attr($badge); ?>">
        </p>

        <p>
            <label>Title:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label>Description:</label>
            <textarea class="widefat" name="<?php echo $this->get_field_name('desc'); ?>"><?php echo esc_textarea($desc); ?></textarea>
        </p>

        <!-- Image Upload -->
        <p>
            <label>Image:</label>
            <input class="widefat image-url" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo esc_attr($image); ?>">
            <button class="button upload-image-btn">Upload</button>

            <div class="image-preview" style="margin-top:10px;">
                <?php if($image): ?>
                    <img src="<?php echo esc_url($image); ?>" style="max-width:100%;">
                <?php endif; ?>
            </div>
        </p>

        <p>
            <label>Button Text:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo esc_attr($button_text); ?>">
        </p>

        <p>
            <label>Button Link:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('button_link'); ?>" type="text" value="<?php echo esc_attr($button_link); ?>">
        </p>

        <?php
    }

    // Save Data
    public function update($new_instance, $old_instance) {

        $instance = [];

        $instance['badge']      = sanitize_text_field($new_instance['badge']);
        $instance['title']      = sanitize_text_field($new_instance['title']);
        $instance['desc']       = sanitize_text_field($new_instance['desc']);
        $instance['image']      = esc_url_raw($new_instance['image']);
        $instance['button_text']= sanitize_text_field($new_instance['button_text']);
        $instance['button_link']= esc_url_raw($new_instance['button_link']);

        return $instance;
    }
}

function register_book_widget() {
    register_widget(__NAMESPACE__ . '\Book_Of_The_Month_Widget');
}
add_action('widgets_init', __NAMESPACE__ . '\register_book_widget');