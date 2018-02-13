<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @since      1.0.0
 * @package    WP_Motivator
 * @subpackage WP_Motivator/admin
 * @author     Greg Sweet <greg@ccdzine.com>
 */

/**
 * Tab switcher.
 */
$active_tab = 'greeting-settings';

if ( isset( $_GET[ 'tab' ] ) ) {
    $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'greeting-settings';
} 

/**
 * Page output.
 */
?>
<div class="wrap wp-motivator">
	<h2><span class="dashicons dashicons-carrot"></span><?php _e( 'WP Motivator Settings', 'wp-motivator' ); ?></h2>
	<p class="description"><?php _e( 'WP Motivator documentation is in the contextual help tab at the upper right corner of this page.', 'wp-motivator' ); ?></p>
	<h2 class="nav-tab-wrapper">
        <a href="?page=wp-motivator&tab=greeting-settings" class="nav-tab <?php echo $active_tab == 'greeting-settings' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Greeting', 'page=wp-motivator' ); ?></a>
        <a href="?page=wp-motivator&tab=message-settings" class="nav-tab <?php echo $active_tab == 'message-settings' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Message', 'page=wp-motivator' ); ?></a>
		<a href="?page=wp-motivator&tab=dashboard-settings" class="nav-tab <?php echo $active_tab == 'dashboard-settings' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Dashboard', 'page=wp-motivator' ); ?></a>
		<a href="?page=wp-motivator&tab=footer-settings" class="nav-tab <?php echo $active_tab == 'footer-settings' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Footer', 'page=wp-motivator' ); ?></a>
		<a href="?page=wp-motivator&tab=other-settings" class="nav-tab <?php echo $active_tab == 'other-settings' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Options', 'page=wp-motivator' ); ?></a>
    </h2>
	<form action="options.php" method="post">
		<?php if ( $active_tab == 'greeting-settings' ) {
			settings_fields( 'motivator-greeting-settings' );
			do_settings_sections( 'motivator-greeting-settings' );
		} elseif ( $active_tab == 'message-settings' ) {
			settings_fields( 'motivator-message-settings' );
			do_settings_sections( 'motivator-message-settings' );
		} elseif ( $active_tab == 'dashboard-settings' ) {
			settings_fields( 'motivator-dashboard-settings' );
			do_settings_sections( 'motivator-dashboard-settings' );
		} elseif ( $active_tab == 'footer-settings' ) {
			settings_fields( 'motivator-footer-settings' );
			do_settings_sections( 'motivator-footer-settings' );
		} elseif ( $active_tab == 'other-settings' ) {
			settings_fields( 'motivator-other-settings' );
			do_settings_sections( 'motivator-other-settings' );
		} ?>
		<p class="submit"><?php submit_button( __( 'Save Settings', 'wp-motivator' ), 'primary', '', false, [] ); echo ' '; ?><?php // submit_button( __( 'Reset', 'wp-motivator' ), 'secondary', '', false, [] ); ?></p>
	</form>
	<h3><?php _e( 'Contributors:', 'wp-motivator' ); ?></h3>
	<p><?php _e( 'A special thanks to the following innovators and trailblazers who have contributed motivation to the WP Motivator project.', 'wp-motivator' ); ?></p>
	<ul class="wp-motivator-contributors-list">
		<li>Phillis Benson</li>
		<li>Travis A. Clark</li>
		<li>Mor Cohen</li>
		<li>Warren Dodd</li>
		<li>Kim Doyal</li>
		<li>Ed Ellingham</li>
		<li>Pete Everitt</li>		
		<li>Patrick Feild</li>
		<li>Andre Gagnon</li>
		<li>Neil Gilmour</li>
		<li>Mario Gonçalves</li>
		<li>Colleen Gratzer Nusser</li>
		<li>Ed Holtzman</li>
		<li>Lee Jackson</li>
		<li>Matt Lambert</li>
		<li>Róbey Lawrence</li>
		<li>David Martin</li>
		<li>Andy McIlwain</li>
		<li>Justin Meadows</li>	
		<li>Marianne Mermaid</li>
		<li>Mike Oliver</li>
		<li>Yael Reinhardt-Matsliah</li>
		<li>Awolumate Adelakun Samuel</li>
		<li>Walt Spence</li>
		<li>Steve Stapelberg</li>
		<li>Greg Sweet</li>
		<li>Sophie Wood</li>
	</ul>
</div>