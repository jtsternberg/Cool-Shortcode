<?php
/**
 * Cool Shortcode Run
 * @version 0.1.0
 * @package Cool Shortcode
 */

class CS_Run extends WDS_Shortcodes {

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
		'cool_text'        => 'Your cool text',
		'background_color' => '#bada55',
		'text_color'       => '#555555',
		'extra_class'      => 'large',
		'linkslist'        => '',
	);

	/**
	 * Whether css has been output yet.
	 * @var bool
	 */
	protected static $css_done = false;

	/**
	 * Shortcode Output
	 */
	public function shortcode() {

		$style = '';

		if ( $this->att( 'background_color' ) || $this->att( 'text_color' ) ) {
			$style = ' style="';
			// Get/check our background_color attribute
			if ( $this->att( 'background_color' ) ) {
				$bg_color = sanitize_text_field( $this->att( 'background_color' ) );
				$style .= 'background-color: ' . $bg_color .';';
			}

			// Get/check our text_color attribute
			if ( $this->att( 'text_color' ) ) {
				$text_color = sanitize_text_field( $this->att( 'text_color' ) );
				$style .= 'color: ' . $text_color .';';
			}
			$style .= '"';
		}

		// Get our extra_class attribute
		$extra_class = $this->get_extra_classes();

		$output = '';
		$output .= $this->css();
		$output .= '<blockquote class="becool-shortcode dashicons-before dashicons-thumbs-up' . $extra_class . '"' . $style . '>';
		$output .= wp_kses_post( $this->att( 'cool_text' ) );

		if ( $this->att( 'linkslist' ) ) {
			$output .= '<ul>';
			foreach ( (array) $this->att( 'linkslist' ) as $link ) {
				$output .= sprintf(
					'<li><a href="%s">%s</a></li>',
					$link['url'],
					$link['text']
				);
			}
			$output .= '</ul>';
		}

		// if include_close was true in CS_Admin::js_button_data, we could use $this->content()
		// to get contents between shortcode open/close
		// $this->content();
		$output .= '</blockquote>';

		return $output;
	}

	public function get_extra_classes() {
		return ' ' . implode( ' ', array_map( 'sanitize_html_class', explode( ' ', $this->att( 'extra_class' ) ) ) );
	}

	public function css() {
		// Only output once, not once per shortcode.
		if ( self::$css_done ) {
			return '';
		}

		ob_start();
		?>
		<style type="text/css" media="screen">
		.becool-shortcode {
			padding: 1em;
			clear: both;
		}
		.becool-shortcode:before {
			margin-right: .78em;
			font-size: 2em;
			margin-top: -.05em;
			margin-left: -.05em;
		}
		</style>
		<?php

		self::$css_done = true;

		return ob_get_clean();
	}

}
