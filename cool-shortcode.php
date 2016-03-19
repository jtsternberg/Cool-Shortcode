<?php
/**
 * Plugin Name: Cool Shortcode
 * Plugin URI:  http://webdevstudios.com
 * Description: Built with WDS-Shortcodes (and Shortcode_Button), this plugin demonstrates the capabilites of those libraries.
 * Version:     0.0.0
 * Author:      WebDevStudios
 * Author URI:  http://webdevstudios.com
 * Donate link: http://webdevstudios.com
 * License:     GPLv2
 * Text Domain: cool-shortcode
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2016 WebDevStudios (email : contact@webdevstudios.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Built using generator-plugin-wp
 */


// User composer autoload.
require 'vendor/autoload_52.php';


/**
 * Main initiation class
 *
 * @since  NEXT
 * @var  string $version  Plugin version
 * @var  string $basename Plugin basename
 * @var  string $url      Plugin URL
 * @var  string $path     Plugin Path
 */
class Cool_Shortcode {

	/**
	 * Current version
	 *
	 * @var  string
	 * @since  NEXT
	 */
	const VERSION = '0.0.0';

	/**
	 * URL of plugin directory
	 *
	 * @var string
	 * @since  NEXT
	 */
	protected $url = '';

	/**
	 * Path of plugin directory
	 *
	 * @var string
	 * @since  NEXT
	 */
	protected $path = '';

	/**
	 * Plugin basename
	 *
	 * @var string
	 * @since  NEXT
	 */
	protected $basename = '';

	/**
	 * Singleton instance of plugin
	 *
	 * @var Cool_Shortcode
	 * @since  NEXT
	 */
	protected static $single_instance = null;

	/**
	 * Instance of CS_Run
	 *
	 * @since NEXT
	 * @var CS_Run
	 */
	protected $run;

	/**
	 * Instance of CS_Admin
	 *
	 * @since NEXT
	 * @var CS_Admin
	 */
	protected $admin;

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @since  NEXT
	 * @return Cool_Shortcode A single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$single_instance ) {
			self::$single_instance = new self();
		}

		return self::$single_instance;
	}

	/**
	 * Sets up our plugin
	 *
	 * @since  NEXT
	 */
	protected function __construct() {
		$this->basename = plugin_basename( __FILE__ );
		$this->url      = plugin_dir_url( __FILE__ );
		$this->path     = plugin_dir_path( __FILE__ );

		$this->plugin_classes();
	}

	/**
	 * Attach other plugin classes to the base plugin class.
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function plugin_classes() {
		// Attach other plugin classes to the base plugin class.
		$this->run = new CS_Run();
		$this->admin = new CS_Admin(
			$this->run,
			self::VERSION,
			$this->run->atts_defaults
		);
	} // END OF PLUGIN CLASSES FUNCTION

	/**
	 * Add hooks and filters
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function hooks() {

		add_action( 'init', array( $this, 'init' ) );

		if ( ! defined( 'WDS_SHORTCODES_LOADED' ) ) {
			add_action( 'tgmpa_register', array( $this, 'register_required_plugin' ) );
		}
	}

	/**
	 * Requires WDS Shortcodes to be installed
	 */
	public function register_required_plugin() {

		$plugins = array(
			array(
				'name'         => 'WDS Shortcodes',
				'slug'         => 'wds-shortcodes',
				'source'       => 'https://github.com/WebDevStudios/WDS-Shortcodes/blob/master/wds-shortcodes.zip?raw=true',
				'required'     => true,
				'external_url' => 'https://github.com/WebDevStudios/WDS-Shortcodes',
			),
		);

		$config = array(
			'domain'       => 'cool-shortcode',
			'default_path' => '',
			'parent_slug'  => 'plugins.php',
			'capability'   => 'install_plugins',
			'menu'         => 'install-required-plugins',
			'has_notices'  => true,
			'is_automatic' => true,
			'message'      => '',
			'strings'      => array(
				'page_title'                      => __( 'Install Required Plugins', 'cool-shortcode' ),
				'menu_title'                      => __( 'Install Plugins', 'cool-shortcode' ),
				'installing'                      => __( 'Installing Plugin: %s', 'cool-shortcode' ),
				// %1$s = plugin name
				'oops'                            => __( 'Something went wrong with the plugin API.', 'cool-shortcode' ),
				'notice_can_install_required'     => _n_noop( 'The "WDS Shortcodes" plugin requires the following plugin: %1$s.', 'This plugin requires the following plugins: %1$s.' ),
				// %1$s = plugin name(s)
				'notice_can_install_recommended'  => _n_noop( 'This plugin recommends the following plugin: %1$s.', 'This plugin recommends the following plugins: %1$s.' ),
				// %1$s = plugin name(s)
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
				// %1$s = plugin name(s)
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
				// %1$s = plugin name(s)
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
				// %1$s = plugin name(s)
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
				// %1$s = plugin name(s)
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this plugin: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this plugin: %1$s.' ),
				// %1$s = plugin name(s)
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
				// %1$s = plugin name(s)
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                          => __( 'Return to Required Plugins Installer', 'cool-shortcode' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'cool-shortcode' ),
				'complete'                        => __( 'All plugins installed and activated successfully. %s', 'cool-shortcode' ),
				// %1$s = dashboard link
			),
		);

		tgmpa( $plugins, $config );
	}

	/**
	 * Activate the plugin
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function _activate() {
		// Make sure any rewrite functionality has been loaded.
		flush_rewrite_rules();
	}

	/**
	 * Deactivate the plugin
	 * Uninstall routines should be in uninstall.php
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function _deactivate() {}

	/**
	 * Init hooks
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function init() {
		load_plugin_textdomain( 'cool-shortcode', false, dirname( $this->basename ) . '/languages/' );
	}

	/**
	 * Magic getter for our object.
	 *
	 * @since  NEXT
	 * @param string $field Field to get.
	 * @throws Exception Throws an exception if the field is invalid.
	 * @return mixed
	 */
	public function __get( $field ) {
		switch ( $field ) {
			case 'version':
				return self::VERSION;
			case 'basename':
			case 'url':
			case 'path':
			case 'run':
			case 'admin':
				return $this->$field;
			default:
				throw new Exception( 'Invalid '. __CLASS__ .' property: ' . $field );
		}
	}
}

/**
 * Grab the Cool_Shortcode object and return it.
 * Wrapper for Cool_Shortcode::get_instance()
 *
 * @since  NEXT
 * @return Cool_Shortcode  Singleton instance of plugin class.
 */
function cool_shortcode() {
	return Cool_Shortcode::get_instance();
}

// Kick it off.
add_action( 'plugins_loaded', array( cool_shortcode(), 'hooks' ) );

register_activation_hook( __FILE__, array( cool_shortcode(), '_activate' ) );
register_deactivation_hook( __FILE__, array( cool_shortcode(), '_deactivate' ) );
