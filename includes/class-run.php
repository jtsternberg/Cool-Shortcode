<?php
/**
 * Cool Shortcode Run
 * @version 0.0.0
 * @package Cool Shortcode
 */

class CS_Run extends WDS_Shortcodes {

	/**
	 * Parent plugin class
	 *
	 * @var   class
	 * @since NEXT
	 */
	protected $plugin = null;

	/**
	 * The Shortcode Tag
	 * @var string
	 */
	public $shortcode = 'becool';

	/**
	 * Default attributes applied to the shortcode.
	 * @var array
	 */
	public $atts_defaults = array(
		'extra_class'      => 'large',
		'background_color' => '#bada55',
	);

	/**
	 * Shortcode Output
	 */
	public function shortcode() {

		// Get our extra_class attribute
		$extra_class = sanitize_html_class( $this->att( 'extra_class' ) );
		$style = '';

		// Get/check our background_color attribute
		if ( $this->att( 'background_color' ) ) {
			$bg_color = sanitize_text_field( $this->att( 'background_color' ) );
			$style = ' style="background-color: ' . $bg_color . '"';
		}

		$output = '<div class="becool-shortcode ' . $extra_class . '"' . $style . '>';
		$output .= $this->content();
		$output .= '</div>';

		return $output;
	}

}
