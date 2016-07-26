<?php
/*
Plugin Name: Julian Bakery Nutritionals
Plugin URI: http://fishinglounge.com/
Description: This plugin adds the ability to post product nutritional information.
Version: 1.0
Author: Michael Church
Author URI: http://fishinglounge.com/
License: GPLv2
*/

// Metabox

add_filter( 'rwmb_meta_boxes', 'nutritionals_register_meta_boxes' );
function nutritionals_register_meta_boxes( $meta_boxes )
{
	$prefix = 'nutrition_';

	$meta_boxes[] = array(
		'title'  => __( 'Nutritionals', 'nutrition' ),
		'post_types' => 'product',
		'context'    => 'normal',
		'priority'   => 'low',
		'fields' => array(
			// HEADING
			array(
			'type' => 'heading',
			'name' => __( 'Basic Facts', 'nutrition_' ),
			'id'   => 'fake_id', // Not used but needed for plugin
			),
			// NUMBER
			array(
				'name' => esc_html__( 'Serving Size', 'nutrition_' ),
				'id'   => "{$prefix}serving_size",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
			),
			// NUMBER
			array(
				'name' => esc_html__( 'Calories', 'nutrition_' ),
				'id'   => "{$prefix}calories",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
			),
			// NUMBER
			array(
				'name' => esc_html__( 'Net Carbs', 'nutrition_' ),
				'id'   => "{$prefix}net_carbs",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
			),
			// HEADING
			array(
			'type' => 'heading',
			'name' => __( 'Additional Facts', 'nutrition_' ),
			'id'   => 'fake_id', // Not used but needed for plugin
			),
			// GROUP
			array(
			'id'     => "{$prefix}additional_facts",
			'type'   => 'group',
			'clone'  => true,
			'sort_clone' => true,
			// Sub-fields
			'fields' => array(				
				// TEXT
				array(
					'name'  => __( 'Item', 'nutrition_' ),
					'id'    => "{$prefix}item",
					'desc' => __( 'Eample: Total Fat', 'nutrition_' ),
					'type'  => 'text',
				),
				// NUMBER
				array(
					'name' => esc_html__( 'Grams', 'nutrition_' ),
					'id'   => "{$prefix}grams",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
				),
			),
		),
		// HEADING
		array(
		'type' => 'heading',
		'name' => __( 'Ingredients', 'nutrition_' ),
		'id'   => 'fake_id', // Not used but needed for plugin
		),
		// TEXTAREA
		array(
			'id'   => "{$prefix}ingredients",
			'type' => 'textarea',
			'cols' => 20,
			'rows' => 6,
		),
	),
);
return $meta_boxes;
}