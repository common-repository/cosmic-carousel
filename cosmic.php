<?php

/**
 * The plugin bootstrap file
 *
 * @link              www.90lines.com  
 * @since             1.0.0
 * @package           Cosmic
 *
 * @wordpress-plugin
 * Plugin Name:       Cosmic Carousel
 * Plugin URI:        https://www.cosmic-carousel.90lines.com
 * Description:       Easily create dynamic carousels. List, sort, drag and drop. Generate illimitates carousels based on posts, pages and custom post-types. 
 * Version:           1.0.0
 * Author:            90Lines
 * Author URI:        www.90lines.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cosmic-carousel
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'COSMIC_CAROUSEL', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cosmic-activator.php
 */
function activate_cosmic() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cosmic-activator.php';
	Cosmic_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cosmic-deactivator.php
 */
function deactivate_cosmic() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cosmic-deactivator.php';
	Cosmic_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cosmic' );
register_deactivation_hook( __FILE__, 'deactivate_cosmic' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cosmic.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cosmic() {

	$plugin = new Cosmic();
	$plugin->run();

}
run_cosmic();
