<?php
/**
 * About Widget
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

class Footer_About_Widget extends \WP_Widget {

    public function __construct() {
        parent::__construct(
            'footer_about_widget',
            __('Footer About Widget', 'rswpt-core'),
            array('description' => __('Footer about section with social links', 'rswpt-core'))
        );
    }

    // Frontend Output
    public function widget($args, $instance) {

        $title        = $instance['title'] ?? 'LitCritique';
        $highlight    = $instance['highlight'] ?? 'Critique';
        $desc         = $instance['desc'] ?? '';
        $twitter      = $instance['twitter'] ?? '';
        $instagram    = $instance['instagram'] ?? '';
        $goodreads    = $instance['goodreads'] ?? '';

        ?>

            <div class="text-2xl font-bold font-serif text-white tracking-tight">
                <?php echo esc_html($title); ?>
                <span class="text-brand-500"><?php echo esc_html($highlight); ?></span>
            </div>

            <?php if ($desc) : ?>
                <p class="text-xs md:text-sm text-gray-400 leading-relaxed sm:pr-4 mx-auto sm:mx-0 max-w-xs sm:max-w-none">
                    <?php echo esc_html($desc); ?>
                </p>
            <?php endif; ?>

            <div class="flex space-x-4 pt-2 sm:justify-start">

                <?php if ($twitter) : ?>
                    <a href="<?php echo esc_url($twitter); ?>"
                        class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-brand-600 hover:text-white transition">
                        <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M523.4 215.7C523.7 220.2 523.7 224.8 523.7 229.3C523.7 368 418.1 527.9 225.1 527.9C165.6 527.9 110.4 510.7 64 480.8C72.4 481.8 80.6 482.1 89.3 482.1C138.4 482.1 183.5 465.5 219.6 437.3C173.5 436.3 134.8 406.1 121.5 364.5C128 365.5 134.5 366.1 141.3 366.1C150.7 366.1 160.1 364.8 168.9 362.5C120.8 352.8 84.8 310.5 84.8 259.5L84.8 258.2C98.8 266 115 270.9 132.2 271.5C103.9 252.7 85.4 220.5 85.4 184.1C85.4 164.6 90.6 146.7 99.7 131.1C151.4 194.8 229 236.4 316.1 240.9C314.5 233.1 313.5 225 313.5 216.9C313.5 159.1 360.3 112 418.4 112C448.6 112 475.9 124.7 495.1 145.1C518.8 140.6 541.6 131.8 561.7 119.8C553.9 144.2 537.3 164.6 515.6 177.6C536.7 175.3 557.2 169.5 576 161.4C561.7 182.2 543.8 200.7 523.4 215.7z"/></svg>
                    </a>
                <?php endif; ?>

                <?php if ($instagram) : ?>
                    <a href="<?php echo esc_url($instagram); ?>"
                        class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-brand-600 hover:text-white transition">
                         <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M320.3 205C256.8 204.8 205.2 256.2 205 319.7C204.8 383.2 256.2 434.8 319.7 435C383.2 435.2 434.8 383.8 435 320.3C435.2 256.8 383.8 205.2 320.3 205zM319.7 245.4C360.9 245.2 394.4 278.5 394.6 319.7C394.8 360.9 361.5 394.4 320.3 394.6C279.1 394.8 245.6 361.5 245.4 320.3C245.2 279.1 278.5 245.6 319.7 245.4zM413.1 200.3C413.1 185.5 425.1 173.5 439.9 173.5C454.7 173.5 466.7 185.5 466.7 200.3C466.7 215.1 454.7 227.1 439.9 227.1C425.1 227.1 413.1 215.1 413.1 200.3zM542.8 227.5C541.1 191.6 532.9 159.8 506.6 133.6C480.4 107.4 448.6 99.2 412.7 97.4C375.7 95.3 264.8 95.3 227.8 97.4C192 99.1 160.2 107.3 133.9 133.5C107.6 159.7 99.5 191.5 97.7 227.4C95.6 264.4 95.6 375.3 97.7 412.3C99.4 448.2 107.6 480 133.9 506.2C160.2 532.4 191.9 540.6 227.8 542.4C264.8 544.5 375.7 544.5 412.7 542.4C448.6 540.7 480.4 532.5 506.6 506.2C532.8 480 541 448.2 542.8 412.3C544.9 375.3 544.9 264.5 542.8 227.5zM495 452C487.2 471.6 472.1 486.7 452.4 494.6C422.9 506.3 352.9 503.6 320.3 503.6C287.7 503.6 217.6 506.2 188.2 494.6C168.6 486.8 153.5 471.7 145.6 452C133.9 422.5 136.6 352.5 136.6 319.9C136.6 287.3 134 217.2 145.6 187.8C153.4 168.2 168.5 153.1 188.2 145.2C217.7 133.5 287.7 136.2 320.3 136.2C352.9 136.2 423 133.6 452.4 145.2C472 153 487.1 168.1 495 187.8C506.7 217.3 504 287.3 504 319.9C504 352.5 506.7 422.6 495 452z"/></svg>
                    </a>
                <?php endif; ?>

                <?php if ($goodreads) : ?>
                    <a href="<?php echo esc_url($goodreads); ?>"
                        class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-brand-600 hover:text-white transition">
                        <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M170.8 467.3L173.6 467.3C186.3 467.3 199.1 467.3 211.8 467.4C213.4 467.4 214.9 467 215.4 469.5C222.5 504.4 245.4 524.1 278.3 533.4C305.2 541 332.4 541.2 359.6 535.2C393.4 527.8 415.6 506.9 427.6 474.8C435.6 453.3 438.3 431 438.6 408.3C438.7 402.5 438.9 361.3 438.4 355.5L437.5 355.2C436.7 356.7 435.8 358.1 435 359.6C412.9 402.7 373.7 427 329.6 428.7C226.6 432.7 160.2 371.7 157.6 252.5C157.1 228.8 159.4 205.6 165.9 182.8C186.5 111.7 240.5 64.6 319.8 64C381.1 63.6 421.3 102.7 436 134.3C436.5 135.4 437.3 136.6 438.4 136.2L438.4 74.6L482.7 74.6C482.7 354.9 482.8 406.8 482.8 406.8C482.7 485.3 456.1 550.5 379.8 569C310.3 585.9 220.8 573.8 183.8 511.8C175.8 498.3 172 483.5 170.8 467.3zM317.1 100.5C264.6 100 208.6 141.2 202.1 234.3C198 293.3 216.9 356.5 273.6 382.9C301.2 395.8 347.9 397.9 381.9 374.2C429.5 341 444.6 277.2 436.7 220.2C427 149.1 388.9 100.2 317.1 100.5z"/></svg>
                    </a>
                <?php endif; ?>

            </div>
        <?php
    }

    // Backend Form
    public function form($instance) {

        $title     = $instance['title'] ?? 'Lit';
        $highlight = $instance['highlight'] ?? 'Critique';
        $desc      = $instance['desc'] ?? '';
        $twitter   = $instance['twitter'] ?? '';
        $instagram = $instance['instagram'] ?? '';
        $goodreads = $instance['goodreads'] ?? '';
        ?>

        <p>
            <label>Main Title:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label>Highlight Text:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('highlight'); ?>" type="text" value="<?php echo esc_attr($highlight); ?>">
        </p>

        <p>
            <label>Description:</label>
            <textarea class="widefat" name="<?php echo $this->get_field_name('desc'); ?>"><?php echo esc_textarea($desc); ?></textarea>
        </p>

        <p>
            <label>Twitter URL:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>">
        </p>

        <p>
            <label>Instagram URL:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php echo esc_attr($instagram); ?>">
        </p>

        <p>
            <label>Goodreads URL:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('goodreads'); ?>" type="text" value="<?php echo esc_attr($goodreads); ?>">
        </p>

        <?php
    }

    // Save Data
    public function update($new_instance, $old_instance) {

        $instance = [];

        $instance['title']     = sanitize_text_field($new_instance['title']);
        $instance['highlight'] = sanitize_text_field($new_instance['highlight']);
        $instance['desc']      = sanitize_textarea_field($new_instance['desc']);
        $instance['twitter']   = esc_url_raw($new_instance['twitter']);
        $instance['instagram'] = esc_url_raw($new_instance['instagram']);
        $instance['goodreads'] = esc_url_raw($new_instance['goodreads']);

        return $instance;
    }
}

// Register Widget
function register_footer_about_widget() {
    register_widget(__NAMESPACE__ . '\Footer_About_Widget');
}
add_action('widgets_init', __NAMESPACE__ . '\register_footer_about_widget');