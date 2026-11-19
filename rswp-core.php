<?php
/*
Plugin Name: RSWPTheme Core
Plugin URI: https://rswpthemes.com/
Description: RSWPTheme Core Plugin
Version: 1.0.0
Author: RSWPTheme
Text Domain: rswpt-core
Domain Path: /languages
Author URI: https://rswpthemes.com/
*/

namespace rswptheme\RSWPTheme_Core;

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( 'RSWPTheme_CORE' ) ) {
	$plugin_data = get_file_data( __FILE__, array( 'version' => 'Version' ) );
	define( 'RSWPTheme_CORE',              $plugin_data['version'] );
	define( 'RSWPTheme_CORE_SCRIPT_VER',   ( WP_DEBUG ) ? time() : RSWPTheme_CORE );
	define( 'RSWPTheme_CORE_THEME_PREFIX', 'rswptheme' );
	define( 'RSWPTheme_CORE_CPT', 		    'rswptheme' );	
	define( 'RSWPTheme_CORE_BASE_URL', 	plugin_dir_url( __FILE__ ) );
	define( 'RSWPTheme_CORE_BASE_DIR',     plugin_dir_path( __FILE__ ) );
}

class Rswptheme_Core {

	public $plugin  = 'rswpt-core';
	public $action  = 'rswptheme_theme_init';
	protected static $instance;

	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ), 20 );
		add_action( 'plugins_loaded', array( $this, 'rswpt_wigets' ) );
		add_action( 'init',           array( $this, 'after_theme_loaded' ) );
		add_action( 'init', [ $this, 'rswpt_register_blocks' ] );
		/* User extra fields */
		add_action( 'show_user_profile', array( $this, 'user_fields_form' ) );
		add_action( 'edit_user_profile', array( $this, 'user_fields_form' ) );
		add_action( 'personal_options_update',  array( $this, 'user_fields_update' ) );
		add_action( 'edit_user_profile_update', array( $this, 'user_fields_update' ) );
		//add_action( 'rdtheme_social_share',  array( $this, 'social_share' ) );
		//add_action( 'wp_enqueue_scripts',    array( $this, 'rswptheme_core_enqueue_scripts' ), 20 );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Load all blocks automatically
	 */
	public function rswpt_register_blocks(){

		$blocks = ['quote', 'info-list', 'pros-cons'];
	    foreach ($blocks as $block) {
	        $block_dir = RSWPTheme_CORE_BASE_DIR . "blocks/{$block}/";

	        // 1. Register Editor Script (with dependencies)
	        if (file_exists($block_dir . 'index.js')) {
	            wp_register_script(
	                "rswpt-{$block}-editor",
	                RSWPTheme_CORE_BASE_URL . "blocks/{$block}/index.js",
	                ['wp-blocks', 'wp-element', 'wp-block-editor'],
	                filemtime($block_dir . 'index.js')
	            );
	        }

	        // 2. Register Block
	        if (file_exists($block_dir . 'block.json')) {
	            register_block_type($block_dir, [
	                'render_callback' => function ($attributes, $content, $block_instance) use ($block_dir) {
	                    $render_file = $block_dir . 'render.php';

	                    // Safe include (NO redeclare issue)
	                    if (file_exists($render_file)) {
	                        return include $render_file;
	                    }
	                    return $content; // fallback (if static)
	                }
	            ]);
	        }
	    }
	}

	// public function register_blocks() {

	// public function rswptheme_core_enqueue_scripts() {
	// 	wp_enqueue_style( 'rswptheme-core', RSWPTheme_CORE_BASE_URL . 'assets/css/rswptheme-core.css' );
	// 	wp_enqueue_script('rswptheme-core', RSWPTheme_CORE_BASE_URL . 'assets/js/rswptheme-core.js', array( 'jquery' ), '', true );
	// }

	public function after_theme_loaded(){
		require_once RSWPTheme_CORE_BASE_DIR . 'inc/rswpt-postmeta.php';
		require_once RSWPTheme_CORE_BASE_DIR . 'inc/post-meta.php';
		require_once RSWPTheme_CORE_BASE_DIR . 'inc/helper.php';	
	}
	
	public function rswpt_wigets( ){
		require_once RSWPTheme_CORE_BASE_DIR . 'widgets/author.php';
		require_once RSWPTheme_CORE_BASE_DIR . 'widgets/listening.php';
		require_once RSWPTheme_CORE_BASE_DIR . 'widgets/book-month.php';
		require_once RSWPTheme_CORE_BASE_DIR . 'widgets/about.php';
		require_once RSWPTheme_CORE_BASE_DIR . 'widgets/reading-challenge.php';
		require_once RSWPTheme_CORE_BASE_DIR . 'widgets/Productivity.php';
	}

	public function user_fields_form( $user ) {
		$user_meta   = get_the_author_meta( 'bookreviewer_user_info', $user->ID );
		$designation = isset( $user_meta['designation'] ) ? $user_meta['designation'] : '';
		$reviewcount = isset( $user_meta['reviewcount'] ) ? $user_meta['reviewcount'] : '';
		$reviewtext = isset( $user_meta['reviewtext'] ) ? $user_meta['reviewtext'] : '';
		$socials = Helper::user_socials();
		?>
		<h2><?php esc_html_e( 'Additional Information', 'rswpt-core' ); ?></h2>
		<table class="form-table">
			<tbody>
				<?php
				Helper::user_textfield( esc_html__( 'Designation', 'rswpt-core' ), 'bookreviewer_user_info[designation]', $designation );
				Helper::user_textfield( esc_html__( 'Review Count', 'rswpt-core' ), 'bookreviewer_user_info[reviewcount]', $reviewcount );
				Helper::user_textfield( esc_html__( 'Review Text', 'rswpt-core' ), 'bookreviewer_user_info[reviewtext]', $reviewtext );
				foreach ( $socials as $key => $value ) {
					$social = isset( $user_meta['socials'][$key] ) ? $user_meta['socials'][$key] : '';
					Helper::user_textfield( $value['label'], "bookreviewer_user_info[socials][$key]", $social );
				}
				?>
			</tbody>
		</table>
		<?php
	}

	public function user_fields_update( $user_id=false ) {
		if ( !$user_id ) {
			$user_id = get_current_user_id();
			if ( !$user_id ) return;
		}

		if ( !current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}

		if ( !isset( $_POST['bookreviewer_user_info'] ) ) return;

		// Sanitize fields
		$meta = $_POST['bookreviewer_user_info'];
		if ( isset( $meta['designation'] ) ) {
			sanitize_text_field( $meta['designation'] );
		}
		if ( isset( $meta['reviewcount'] ) ) {
			sanitize_text_field( $meta['reviewcount'] );
		}
		if ( isset( $meta['reviewtext'] ) ) {
			sanitize_text_field( $meta['reviewtext'] );
		}
		if ( isset( $meta['socials'] ) ) {
			foreach ( $meta['socials'] as $key => $value ) {
				$meta['socials'][$key] = sanitize_text_field( $value );
			}
		}
		
		update_user_meta( $user_id, 'bookreviewer_user_info', $meta );
	}

	public function load_textdomain() {
	    load_plugin_textdomain( $this->plugin, FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
	}

}
Rswptheme_Core::instance();


add_action('admin_footer-widgets.php', function() {
?>
<script>
jQuery(document).ready(function($){

    function mediaUploader(buttonClass, inputClass, previewClass) {

        $(document).on('click', buttonClass, function(e){
            e.preventDefault();

            var button = $(this);
            var input = button.prev(inputClass);
            var preview = button.next(previewClass);

            var frame = wp.media({
                title: 'Select Image',
                button: { text: 'Use this image' },
                multiple: false
            });

            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();
                input.val(attachment.url);
                preview.html('<img src="'+attachment.url+'" style="max-width:100%;">');
            });

            frame.open();
        });
    }

    mediaUploader('.upload-image-btn', '.image-url', '.image-preview');
    mediaUploader('.upload-signature-btn', '.signature-url', '.signature-preview');

});
</script>
<?php
});

add_action('admin_enqueue_scripts', function($hook){
    if($hook === 'widgets.php'){
        wp_enqueue_media();
    }
});
