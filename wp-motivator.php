<?php

/**
 * WP Motivator
 *
 * @since             1.0.0
 * @package           WP_Motivator
 *
 * @wordpress-plugin
 * Plugin Name:       WP Motivator
 * Plugin URI:        http://example.com/wp-motivator-uri/
 * Description:       Add random bits of motivation to your admin pages.
 * Version:           1.0.0
 * Author:            Controlled Chaos Design
 * Author URI:        http://ccdzine.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-motivator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 */
function activate_wp_motivator() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-motivator-activator.php';
	WP_Motivator_Activator::activate();

	register_uninstall_hook( __FILE__, 'wp_motivator_uninstall' );

}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_wp_motivator() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-motivator-deactivator.php';
	WP_Motivator_Deactivator::deactivate();

}

register_activation_hook( __FILE__, 'activate_wp_motivator' );
register_deactivation_hook( __FILE__, 'deactivate_wp_motivator' );

/**
 * The code that runs during plugin uninstall.
 */
function wp_motivator_uninstall() {

	require_once plugin_dir_path( __FILE__ ) . 'uninstall.php';

}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-motivator.php';

/**
 * Add settings links to the admin page.
 */
function wp_motivator_settings_link( $links ) {

	$settings_link = [
		sprintf( '<a href="%1s" class="wp-motivator-settings-link">Settings</a>', admin_url( 'options-general.php?page=wp-motivator' ) ),
	];

	return array_merge( $links, $settings_link );

}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'wp_motivator_settings_link' );

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_wp_motivator() {

	$plugin = new WP_Motivator();
	$plugin->run();

}
run_wp_motivator();