<?php

/**
 * Content for the Motivator Filters help tab.
 *
 * @since      1.0.0
 * @package    WP_Motivator
 * @subpackage WP_Motivator/admin
 * @author     Greg Sweet <greg@ccdzine.com>
 */

?>
<div class="wp-motivator-help">
    <h3><?php _e( 'WP Motivator Filters', 'wp-motivator' ); ?></h3>
    <p><?php _e( 'Following is a list of filters applied for customization. They are named to describe where they take effect.', 'wp-motivator' ); ?></p>
    <h4><?php _e( 'Features Output', 'wp-motivator' ); ?></h4>
    <ul class="motivator-hooks-list">
        <li><code>motivator_before_message_section</code></li>
        <li><code>motivator_message_output</code></li>
        <li><code>motivator_greeting_output</code></li>
        <li><code>motivator_footer_output</code></li>
    </ul>
    <h4><?php _e( 'WP Motivator Dashoard', 'wp-motivator' ); ?></h4>
    <ul class="motivator-hooks-list">
        <li><code>motivator_welcome_widget_name</code></li>
        <li><code>motivator_welcome_widget_description</code></li>
        <li><code>motivator_dashboard_widget_name</code></li>
        <li><code>motivator_dashboard_widget_description</code></li>
        <li><code>motivator_dashboard_widget_title</code></li>
        <li><code>motivator_dashboard_placeholder</code></li>
    </ul>
    <h4><?php _e( 'Options', 'wp-motivator' ); ?></h4>
    <ul class="motivator-hooks-list">
        <li><code>motivator_capability</code></li>
    </ul>
</div>