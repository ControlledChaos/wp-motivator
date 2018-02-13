<?php

/**
 * Output the message at the top of admin pages
 *
 * @since      1.0.0
 * @package    WP_Motivator
 * @subpackage WP_Motivator/admin/partials
 */

// Get the WP Motivator message.
$message = WP_Motivator_Message::motivator_message_output();

?>
<div class="wp-motivator-message">
    <?php do_action( 'motivator_before_message_section' ); ?>
    <section class="wp-motivator-message-section">
        <?php do_action( 'motivator_before_message' ); ?>
        <p class="wp-motivator-message-output"><span></span><span><?php echo $message; ?></span><span></span></p>
        <?php do_action( 'motivator_after_message' ); ?>
    </section>
    <?php do_action( 'motivator_after_message_section' ); ?>
</div>