<?php
/**
 * Reading Challenge Widget
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

class Reading_Challenge_Widget extends \WP_Widget {

    public function __construct() {
        parent::__construct(
            'reading_challenge_widget',
            __('Reading Challenge Widget', 'rswpt-core'),
            array('description' => __('Displays reading challenge progress bar', 'rswpt-core'))
        );
    }

    // Frontend Output
    public function widget($args, $instance) {

        $title        = $instance['title'] ?? '2026 Reading Challenge';
        $current      = $instance['current'] ?? 42;
        $goal         = $instance['goal'] ?? 100;
        $message      = $instance['message'] ?? "I'm 2 books ahead of schedule!";

        $percentage = 0;
        if ($goal > 0) {
            $percentage = min(100, ($current / $goal) * 100);
        }
        ?>
        <div class="bg-white p-5 md:p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-base md:text-lg font-bold font-serif text-dark mb-4">
                <?php echo esc_html($title); ?>
            </h3>

            <div class="text-center mb-3">
                <span class="text-2xl md:text-3xl font-bold text-brand-600">
                    <?php echo esc_html($current); ?>
                </span>
                <span class="text-sm md:text-base text-gray-500 font-medium">
                    / <?php echo esc_html($goal); ?> Books
                </span>
            </div>

            <div class="w-full bg-gray-100 rounded-full h-2 md:h-3 mb-2 shadow-inner">
                <div class="bg-gradient-to-r from-brand-400 to-brand-600 h-2 md:h-3 rounded-full"
                    style="width: <?php echo esc_attr($percentage); ?>%">
                </div>
            </div>

            <?php if ($message) : ?>
                <p class="text-[10px] md:text-xs text-center text-gray-500">
                    <?php echo esc_html($message); ?>
                </p>
            <?php endif; ?>
        </div>
        <?php
    }

    // Backend Form
    public function form($instance) {

        $title   = $instance['title'] ?? '2026 Reading Challenge';
        $current = $instance['current'] ?? 42;
        $goal    = $instance['goal'] ?? 100;
        $message = $instance['message'] ?? '';
        ?>

        <p>
            <label>Title:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text"
                value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label>Current Books:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('current'); ?>" type="number"
                value="<?php echo esc_attr($current); ?>">
        </p>

        <p>
            <label>Goal (Total Books):</label>
            <input class="widefat" name="<?php echo $this->get_field_name('goal'); ?>" type="number"
                value="<?php echo esc_attr($goal); ?>">
        </p>

        <p>
            <label>Message:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('message'); ?>" type="text"
                value="<?php echo esc_attr($message); ?>">
        </p>

        <?php
    }

    // Save Data
    public function update($new_instance, $old_instance) {

        $instance = [];

        $instance['title']   = sanitize_text_field($new_instance['title']);
        $instance['current'] = intval($new_instance['current']);
        $instance['goal']    = intval($new_instance['goal']);
        $instance['message'] = sanitize_text_field($new_instance['message']);

        return $instance;
    }
}

// Register Widget
function register_reading_challenge_widget() {
    register_widget(__NAMESPACE__ . '\Reading_Challenge_Widget');
}
add_action('widgets_init', __NAMESPACE__ . '\register_reading_challenge_widget');