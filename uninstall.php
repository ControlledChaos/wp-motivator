<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    WP_Motivator
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/**
 * Delete all saved data.
 */
delete_option( 'motivator_greeting_mode' );
delete_option( 'motivator_greeting_custom' );
delete_option( 'motivator_greeting_custom_options' );
delete_option( 'motivator_message_mode' );
delete_option( 'motivator_message_custom' );
delete_option( 'motivator_message_custom_options' );
delete_option( 'motivator_footer_mode' );
delete_option( 'motivator_footer_custom' );
delete_option( 'motivator_footer_custom_options' );
delete_option( 'motivator_use_welcome' );
delete_option( 'motivator_use_dashboard' );
delete_option( 'motivator_capability' );