<?php
/**
 * Author Widget
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

class Book_Store_Author_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'book_store_author_widget',
            __('Author Widget', 'book-store'),
            array('description' => __('Author Widget', 'book-store'))
        );
    }

    // Frontend Output
    public function widget($args, $instance) {

        $name        = $instance['name'] ?? 'Alex Reader';
        $role        = $instance['role'] ?? 'Literary Critic';
        $bio         = $instance['bio'] ?? '';
        $image       = $instance['image'] ?? '';
        $signature   = $instance['signature'] ?? '';

        echo $args['before_widget'];
        ?>

        <div class="text-center">

            <?php if($image): ?>
            <div class="relative w-20 h-20 mx-auto mb-4">
                <img src="<?php echo esc_url($image); ?>" class="w-full h-full rounded-full object-cover border-4 border-white shadow-md">
                <span
                    class="absolute bottom-0 right-0 bg-yellow-400 text-white w-5 h-5 md:w-6 md:h-6 rounded-full flex items-center justify-center text-[10px] md:text-xs border-2 border-white">
                    <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M530.8 134.1C545.1 144.5 548.3 164.5 537.9 178.8L281.9 530.8C276.4 538.4 267.9 543.1 258.5 543.9C249.1 544.7 240 541.2 233.4 534.6L105.4 406.6C92.9 394.1 92.9 373.8 105.4 361.3C117.9 348.8 138.2 348.8 150.7 361.3L252.2 462.8L486.2 141.1C496.6 126.8 516.6 123.6 530.9 134z"/></svg>
                </span>
            </div>
            <?php endif; ?>

            <h3 class="text-lg md:text-xl font-bold font-serif text-dark mb-1"><?php echo esc_html($name); ?></h3>
            <p class="text-xs md:text-sm text-gray-500 mb-4 uppercase tracking-wider font-medium"><?php echo esc_html($role); ?></p>
            <p class="text-xs md:text-sm text-gray-600 mb-6 leading-relaxed"><?php echo esc_html($bio); ?></p>

            <?php if ($signature): ?>
                <img src="<?php echo esc_url($signature); ?>" class="h-6 md:h-8 mx-auto opacity-40" alt="Signature">
            <?php endif; ?>

        </div>

        <?php
        echo $args['after_widget'];
    }

    // Backend Form
    public function form($instance) {

        $name      = $instance['name'] ?? '';
        $role      = $instance['role'] ?? '';
        $bio       = $instance['bio'] ?? '';
        $image     = $instance['image'] ?? '';
        $signature = $instance['signature'] ?? '';
        ?>

        <p>
            <label>Name:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('name'); ?>" value="<?php echo esc_attr($name); ?>">
        </p>

        <p>
            <label>Role:</label>
            <input class="widefat" name="<?php echo $this->get_field_name('role'); ?>" value="<?php echo esc_attr($role); ?>">
        </p>

        <p>
            <label>Bio:</label>
            <textarea class="widefat" name="<?php echo $this->get_field_name('bio'); ?>"><?php echo esc_textarea($bio); ?></textarea>
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

        <!-- Signature Upload -->
        <p>
            <label>Signature:</label>
            <input class="widefat signature-url" name="<?php echo $this->get_field_name('signature'); ?>" value="<?php echo esc_attr($signature); ?>">
            <button class="button upload-signature-btn">Upload</button>

            <div class="signature-preview" style="margin-top:10px;">
                <?php if($signature): ?>
                    <img src="<?php echo esc_url($signature); ?>" style="max-width:100%;">
                <?php endif; ?>
            </div>
        </p>

        <?php
    }

    // Save Data
    public function update($new_instance, $old_instance) {
        return array(
            'name'      => sanitize_text_field($new_instance['name']),
            'role'      => sanitize_text_field($new_instance['role']),
            'bio'       => sanitize_textarea_field($new_instance['bio']),
            'image'     => esc_url_raw($new_instance['image']),
            'signature' => esc_url_raw($new_instance['signature']),
        );
    }
}

// Author Register Widget
function book_store_register_author_widget() {
    register_widget('Book_Store_Author_Widget');
}
add_action('widgets_init', 'book_store_register_author_widget');