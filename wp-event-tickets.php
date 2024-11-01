<?php
/*
Plugin Name: Event Registration and Tickets
Description: Event Registration and Tickets is easy to use Woocommerce based ticketing for Events and Conferences.
Author: WPEventPartners
Author URI: https://wpeventpartners.com
Text Domain: wp-event-tickets
Domain Path: /languages/
Requires PHP: 5.6
Requires at least: 5.0.0
Tested up to: 5.7.1
Version: 1.0.1
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
define( 'WP_EVENT_TICKETS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-event-tickets-activator.php
 */
function activate_wp_event_tickets() {
	
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-event-tickets-activator.php';
	Wp_Event_Tickets_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-event-tickets-deactivator.php
 */
function deactivate_wp_event_tickets() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-event-tickets-deactivator.php';
	Wp_Event_Tickets_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_event_tickets' );
register_deactivation_hook( __FILE__, 'deactivate_wp_event_tickets' );


function wp_event_tickets_plugin_check_activated() {
	$check_plugin_activate = get_option( 'active_plugins' );
	if(in_array( 'wp-event-partners/wpeventpartners.php' , $check_plugin_activate ) && in_array( 'woocommerce/woocommerce.php' , $check_plugin_activate )){
		return 'true';
	}   
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-event-tickets.php';
require plugin_dir_path( __FILE__ ) . 'admin/metabox/add-metabox.php';
require plugin_dir_path( __FILE__ ) . 'admin/metabox/save-metabox.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_event_tickets() {

	$plugin = new Wp_Event_Tickets();
	$plugin->run();

}
run_wp_event_tickets();
