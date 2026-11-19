<?php
/**
 * @author  RSWPTheme
 * @since   1.0
 * @version 1.0
 */

namespace rswptheme\RSWPTheme_Core;


class Helper
{
	public static function user_textfield($label, $field, $value)
    {
        ?>
        <tr>
            <th>
                <label><?php echo esc_html($label); ?></label>
            </th>
            <td>
                <input class="regular-text" type="text" value="<?php echo esc_attr($value);?>" name="<?php echo esc_attr($field);?>">
            </td>
        </tr>
        <?php
    }

	public static function user_socials(){
		$socials = array(
			'globe' => array(
				'label' => esc_html__( 'Globe Link', 'rswpt-core' ),
				'type'  => 'text',
				'icon'  => 'fas fa-globe',
			),
			'facebook' => array(
				'label' => esc_html__( 'Facebook Link', 'rswpt-core' ),
				'type'  => 'text',
				'icon'  => 'fa-facebook',
			),
			'twitter' => array(
				'label' => esc_html__( 'Twitter Link', 'rswpt-core' ),
				'type'  => 'text',
				'icon'  => 'fa-twitter',
			),
			'linkedin' => array(
				'label' => esc_html__( 'Linkedin Link', 'rswpt-core' ),
				'type'  => 'text',
				'icon'  => 'fa-linkedin',
			),
			'gplus' => array(
				'label' => esc_html__( 'Google Plus Link', 'rswpt-core' ),
				'type'  => 'text',
				'icon'  => 'fa-google-plus',
			),
			'github' => array(
				'label' => esc_html__( 'Github Link', 'rswpt-core' ),
				'type'  => 'text',
				'icon'  => 'fa-github',
			),
			'youtube' => array(
				'label' => esc_html__( 'Youtube Link', 'rswpt-core' ),
				'type'  => 'text',
				'icon'  => 'fa-youtube-play',
			),
			'pinterest' => array(
				'label' => esc_html__( 'Pinterest Link', 'rswpt-core' ),
				'type'  => 'text',
				'icon'  => 'fa-pinterest-p',
			),
			'instagram' => array(
				'label' => esc_html__( 'Instagram Link', 'rswpt-core' ),
				'type'  => 'text',
				'icon'  => 'fa-instagram',
			),
			'goodreads' => array(
				'label' => esc_html__( 'Goodreads Link', 'rswpt-core' ),
				'type'  => 'text',
				'icon'  => 'fab fa-goodreads-g',
			),
		);
		return $socials;
	}
}

