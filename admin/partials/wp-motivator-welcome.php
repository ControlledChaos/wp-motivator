<?php

/**
 * Output of the welcome panel.
 *
 * @since      1.0.0
 * @package    WP_Motivator
 * @subpackage WP_Motivator/admin
 * @author     Greg Sweet <greg@ccdzine.com>
 */

// Get the WP Motivator greeting.
$greeting     = WP_Motivator_Greeting::motivator_greeting_output();
// Get the WP Motivator message.
$message      = WP_Motivator_Message::motivator_message_output();
// Get the current user info.
$current_user = wp_get_current_user();
// Return the display name of the current user.
$user_name    = $current_user->display_name;
// Get the customizer link option.
$customizer   = get_option( 'motivator_disable_welcome_link' );

?>
<div class="welcome-panel-content wp-motivator-welcome-content">
    <?php do_action( 'motivator_before_welcome_content' ); ?>
    <header>
        <?php do_action( 'motivator_before_welcome_greeting' ); ?>
        <?php echo sprintf( '<h2>%1s, %2s</h2>', $greeting, $user_name ); ?>
        <?php do_action( 'motivator_after_welcome_greeting' ); ?>
    </header>
    <div class="welcome-panel-column-container wp-motivator-welcome-container">
        <div class="welcome-panel-column">
            <?php do_action( 'motivator_before_welcome_message' ); ?>
            <?php echo sprintf( '<blockquote>%1s</blockquote>', $message ); ?>
            <?php do_action( 'motivator_after_welcome_message' ); ?>
        </div>
        <?php if ( function_exists( 'dynamic_sidebar' ) && is_active_sidebar( 'motivator-welcome-widget' ) ) : ?>
        <div class="welcome-panel-column">
            <?php do_action( 'motivator_before_welcome_widgets' ); ?>
            <?php dynamic_sidebar( 'motivator-welcome-widget' ); ?>
            <?php do_action( 'motivator_after_welcome_widgets' ); ?>
        </div>
        <?php endif; ?>
        <?php if ( ! $customizer ) : ?>
        <div class="welcome-panel-column welcome-panel-last">
            <?php do_action( 'motivator_before_welcome_button' ); ?>
            <a class="button button-primary button-hero load-customize hide-if-no-customize" href="<?php echo admin_url( 'customize.php' ) . '?return=' . admin_url(); ?>"><?php _e( 'Customize Your Site', 'wp-motivator' ); ?></a>
            <?php do_action( 'motivator_after_welcome_button' ); ?>
        </div>
        <?php endif; ?>
    </div>
    <?php do_action( 'motivator_after_welcome_content' ); ?>
</div>