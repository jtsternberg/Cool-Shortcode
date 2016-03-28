<?php
/**
 * Cool Shortcode Admin
 * @version 0.1.0
 * @package Cool Shortcode
 */

class CS_Admin extends WDS_Shortcode_Admin {

	/**
	 * Sets up the button
	 *
	 * @return array
	 */
	function js_button_data() {
		return array(
			'qt_button_text' => __( 'Be Cool!', 'cool-shortcode' ),
			'button_tooltip' => __( 'Be Cool!', 'cool-shortcode' ),
			'icon'           => 'dashicons-thumbs-up',
			// 'include_close'  => true,
			'mceView'        => true, // The future
		);
	}

	/**
	 * Adds fields to the button modal using CMB2
	 *
	 * @param $fields
	 * @param $button_data
	 *
	 * @return array
	 */
	function fields( $fields, $button_data ) {
		$fields[] = array(
			'name'    => __( 'Say something cool', 'cool-shortcode' ),
			'type'    => 'text',
			'id'      => 'cool_text',
			'default' => $this->atts_defaults['cool_text'],
		);

		$fields[] = array(
			'name'    => __( 'Background Color', 'cool-shortcode' ),
			'desc'    => __( 'Background color for "be cool" box.', 'cool-shortcode' ),
			'type'    => 'colorpicker',
			'id'      => 'background_color',
			'default' => $this->atts_defaults['background_color'],
		);

		$fields[] = array(
			'name'    => __( 'Text Color', 'cool-shortcode' ),
			'desc'    => __( 'Text color for "be cool" box.', 'cool-shortcode' ),
			'type'    => 'colorpicker',
			'id'      => 'text_color',
			'default' => $this->atts_defaults['text_color'],
		);

		$fields[] = array(
			'name'    => __( 'Extra CSS Classes', 'cool-shortcode' ),
			'desc'    => __( 'Enter classes separated by spaces (e.g. "class1 class2")', 'cool-shortcode' ),
			'type'    => 'text',
			'id'      => 'extra_class',
			'default' => $this->atts_defaults['extra_class'],
		);

		$fields[] = array(
			'name'        => __( 'Add a cool blogroll', 'cool-shortcode' ),
			'id'          => 'linkslist',
			'type'        => 'group',
			'options'     => array(
				'group_title'    => __( 'Link {#}', 'cool-shortcode' ),
				'add_button'     => __( 'Add Another Link', 'cool-shortcode' ),
				'remove_button'  => __( 'Remove Link', 'cool-shortcode' ),
				'closed'      => true, // true to keep the groups closed by default
			),
			'fields' => array(
				array(
					'name' => __( 'Link text', 'cool-shortcode' ),
					'id'   => 'text',
					'type' => 'text',
				),
				array(
					'name' => __( 'Link URL', 'cool-shortcode' ),
					'id'   => 'url',
					'type' => 'text_url',
				),
			),
		);

		return $fields;
	}
}
