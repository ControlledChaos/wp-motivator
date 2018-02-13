<?php

/**
 * Content for the Motivator Hooks help tab.
 *
 * @since      1.0.0
 * @package    WP_Motivator
 * @subpackage WP_Motivator/admin
 * @author     Greg Sweet <greg@ccdzine.com>
 */

?>
<div class="wp-motivator-help">
    <h3><?php _e( 'WP Motivator Hooks', 'wp-motivator' ); ?></h3>
    <p><?php _e( 'Following is a list of open hooks available for additional content. They are named to describe where they take effect.', 'wp-motivator' ); ?></p>
    <h4><?php _e( 'Admin Message', 'wp-motivator' ); ?></h4>
    <ul class="motivator-hooks-list">
        <li><code>motivator_before_message_section</code></li>
        <li><code>motivator_before_message</code></li>
        <li><code>motivator_after_message</code></li>
        <li><code>motivator_after_message_section</code></li>
    </ul>
    <h4><?php _e( 'Welcome Panel', 'wp-motivator' ); ?></h4>
    <ul class="motivator-hooks-list">
        <li><code>motivator_before_welcome_content</code></li>
        <li><code>motivator_before_welcome_greeting</code></li>
        <li><code>motivator_after_welcome_greeting</code></li>
        <li><code>motivator_before_welcome_message</code></li>
        <li><code>motivator_after_welcome_message</code></li>
        <li><code>motivator_before_welcome_widgets</code></li>
        <li><code>motivator_after_welcome_widgets</code></li>
        <li><code>motivator_before_welcome_button</code></li>
        <li><code>motivator_after_welcome_button</code></li>
        <li><code>motivator_after_welcome_content</code></li>
    </ul>
</div>