<?php
/**
 * Cool Shortcode Admin
 * @version 0.0.0
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
			'include_close'  => true,
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
			'name'    => __( 'Background Color', 'cool-shortcode' ),
			'desc'    => __( 'background color for "be cool" box.', 'cool-shortcode' ),
			'type'    => 'color',
			'id'      => 'background_color',
			'default' => $this->atts_defaults['background_color'],
		);

		$fields[] = array(
			'name' => __( 'Extra CSS Classes', 'cool-shortcode' ),
			'desc'    => __( 'Enter classes separated by spaces (e.g. "class1 class2")', 'cool-shortcode' ),
			'type' => 'text',
			'id'   => 'extra_class',
		);

		return $fields;
	}
}
