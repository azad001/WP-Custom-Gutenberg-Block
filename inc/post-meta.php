<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace rswptheme\RSWPTheme_Core;
// use radiustheme\rswpt-core\inc\RDTheme;
// use radiustheme\rswpt-core\inc\Helper;

if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'RT_Postmeta' ) ) {
	return;
}

$Postmeta = \RT_Postmeta::getInstance();

$prefix = RSWPTheme_CORE_THEME_PREFIX;

/*-------------------------------------
#. Meta 
---------------------------------------*/
$Postmeta->add_meta_box( '{$prefix}_post_meta', esc_html__( 'Post Meta', 'rswpt-core' ), array( 'post' ), '', '', 'high', array(
	'fields' => array(
		"{$prefix}_postauth_designation" => array(
			'label' => esc_html__( 'Author Designation', 'rswpt-core' ),
			'type'  => 'text',
		),
		"{$prefix}_post_rating" => array(
			'label'   => esc_html__( 'Rating', 'rswpt-core' ),
			'type'    => 'select',
			'options' => array(
				'1'  => esc_html__( '1', 'rswpt-core' ),
				'2'  => esc_html__( '2', 'rswpt-core' ),
				'3'  => esc_html__( '3', 'rswpt-core' ),
				'4'  => esc_html__( '4', 'rswpt-core' ),
				'5'  => esc_html__( '5', 'rswpt-core' ),
				),
			'default'  => '5',
		),
		"{$prefix}_bookinfo" => array(
			'label'   => esc_html__( 'Book Info', 'rswpt-core' ),
			'type'    => 'select',
			'options' => array(
				'default' => esc_html__( 'Default', 'rswpt-core' ),
				'on'      => esc_html__( 'Enable', 'rswpt-core' ),
				'off'     => esc_html__( 'Disable', 'rswpt-core' ),
				),
			'default'  => 'default',
		),
		"{$prefix}_bookimg" => array(
			'label' => esc_html__( 'Book Image', 'rswpt-core' ),
			'type'  => 'image',
		),
		"{$prefix}_bookauthor" => array(
			'label' => esc_html__( 'Book Author', 'rswpt-core' ),
			'type'  => 'text',
			'default'  => 'James Clear',
		),
		"{$prefix}_bookpublisher" => array(
			'label' => esc_html__( 'Book Publisher', 'rswpt-core' ),
			'type'  => 'text',
			'default'  => 'Avery',
		),
		"{$prefix}_bookpages" => array(
			'label' => esc_html__( 'Book Pages', 'rswpt-core' ),
			'type'  => 'text',
			'default'  => '320',
		),
		"{$prefix}_amazonbtntxt" => array(
			'label' => esc_html__( 'Amazon Button Text', 'rswpt-core' ),
			'type'  => 'text',
			'default'  => 'Buy on Amazon',
		),
		"{$prefix}_amazonbtnlink" => array(
			'label' => esc_html__( 'Amazon Button Link', 'rswpt-core' ),
			'type'  => 'text',
			'default'  => '#',
		),
		"{$prefix}_goodreadsbtntxt" => array(
			'label' => esc_html__( 'Goodreads Button Text', 'rswpt-core' ),
			'type'  => 'text',
			'default'  => 'Add to Goodreads',
		),
		"{$prefix}_goodreadsbtnlink" => array(
			'label' => esc_html__( 'Goodreads Button Link', 'rswpt-core' ),
			'type'  => 'text',
			'default'  => '#',
		),	
	),
	) 
);


