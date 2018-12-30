<?php

/**
 * Output of the motivational message.
 *
 * @since      1.0.0
 * @package    WP_Motivator
 * @subpackage WP_Motivator/admin
 * @author     Greg Sweet <greg@ccdzine.com>
 */

class WP_Motivator_Message {

    /**
	 * Initialize the class and set its properties.
	 *
	 * @since      1.0.0
	 * @param      string    $wp_motivator
	 * @param      string    $version
	 */
	public function __construct() {

        $this->motivator_message_output();

    }

    /**
     * Output of the motivational message.
     *
     * @since      1.0.0
     */
    public static function motivator_message_output() {

        /**
         * Get the message mode options.
         *
         * @since      1.0.0
         */
        $mode = get_option( 'motivator_message_mode' );

        /**
         * Arrays of built-in messages per mode.
         * The Innoblazer mode will merge the two arrays.
         *
         * These will be randomized and only one array key (message)
         * will be display per page load.
         *
         * @since      1.0.0
         */

        // Innovator array of messages.
        $innovator_messages = [
            __( 'Good design is obvious. Great design is transparent.', 'wp-motivator' ),
            __( 'If it\'s meant to be, it\'s up to me.', 'wp-motivator' ),
            __( 'Don\'t take life too seriously, you might miss the joke.', 'wp-motivator' ),
            __( 'Don\'t stop, but if needed, take some moments to just contemplate and to meditate.', 'wp-motivator' ),
            __( 'The purpose of life is a life of purpose.', 'wp-motivator' ),
            __( 'Go confidently in the direction of your dreams.', 'wp-motivator' ),
            __( 'If you try hard, you can overcome any adversity. Especially if it\'s someone else\'s.', 'wp-motivator' ),
            __( 'Decision making is easy, if there are no contradictions in your value system.', 'wp-motivator' ),
            __( 'Don\'t wait, life is DIY.', 'wp-motivator' ),
            __( 'FAIL stands for first attempt in learning.', 'wp-motivator' ),
            __( 'Now is all we have. Make the best of it.', 'wp-motivator' ),
            __( 'Don\'t stop til you get enough.', 'wp-motivator' ),
            __( 'Done is better than perfect.', 'wp-motivator' ),
            __( 'Failure should never be final, but rather just another step in the right direction.', 'wp-motivator' ),
            __( 'Perfection is neither profitable nor possible.', 'wp-motivator' ),
        ];

        // Trailblazer array of messages.
        $trailblazer_messages = [
            __( 'Be grateful that you have clients. Enjoy them.', 'wp-motivator' ),
            __( 'Good design is obvious. Great design is transparent.', 'wp-motivator' ),
            __( 'Connection before correction.', 'wp-motivator' ),
            __( 'There is no vision without vulnerability.', 'wp-motivator' ),
            __( 'Life is a flow. Just follow it.', 'wp-motivator' ),
            __( 'Success is not the destination but the quality of the journey.', 'wp-motivator' ),
            __( 'Live the life you have imagined.', 'wp-motivator' ),
            __( 'Be relevant, enthusiastic, available & loving.', 'wp-motivator' ),
            __( 'If you try hard, you can overcome any adversity. Especially if it\'s someone else\'s.', 'wp-motivator' ),
            __( 'Decisions determine destinies.', 'wp-motivator' ),
            __( 'If all you do is run the rat race, when you finish you’ll still be a rat.', 'wp-motivator' ),
            __( 'Failing is growth as long as you\'re failing forward.', 'wp-motivator' ),
            __( 'Harvest the good energy and block out the bad.', 'wp-motivator' ),
            __( 'If you go out without a plan, you will return home without any achievement.', 'wp-motivator' ),
        ];

        /**
         * Get custom message mode options.
         *
         * @since      1.0.0
         */
        $custom_input    = get_option( 'motivator_message_custom' );
        $custom_options  = get_option( 'motivator_message_custom_options' );

        // Convert custom textarea lines to an array.
        $custom_messages = explode( "\n", str_replace( "\r", '', $custom_input ) );

        /**
         * Return a random message by mode option.
         *
         * We need to count the number of keys in the array(s)
         * because we are using shuffle() to randomize them.
         * If there are less than two keys we get an error from
         * shuffle() so we have to return the 0 index
         * for single-key arrays.
         *
         * @since      1.0.0
         */

        // If we are in Innoblazer mode or no option set.
        if ( ! $mode || 'innoblazer' == $mode ) {
            // Merge the Innovator and Trailblazer arrays of messages.
            $messages = array_merge( $innovator_messages, $trailblazer_messages );
            // Shuffle the order of the merged array.
            $random   = shuffle( $messages );
            // Count the number of keys in the array.
            $count    = count( $messages );

            // If there is only one key, return that key.
            if ( ! empty( $random ) && 1 == $count ) {
                $message = $messages[0];
            // If there are more than one key, return a random key.
            } elseif ( is_array( $messages ) && ! empty( $messages ) && ! empty( $random ) ) {
                $message = $messages[$random];
            // Otherwise return our fallback message.
            } else {
                $message = __( 'Good design is obvious. Great design is transparent.', 'wp-motivator' );
            }

        // If we are in Innovator mode.
        } elseif ( 'innovator' == $mode ) {
            // Get the Innovator array of messages.
            $messages = $innovator_messages;
            // Shuffle the order of the array.
            $random   = shuffle( $messages );
            // Count the number of keys in the array.
            $count    = count( $messages );

            // If there is only one key, return that key.
            if ( ! empty( $random ) && 1 == $count ) {
                $message = $messages[0];
            // If there are more than one key, return a random key.
            } elseif ( is_array( $messages ) && ! empty( $messages ) && ! empty( $random ) ) {
                $message = $messages[$random];
            // Otherwise return our fallback message.
            } else {
                $message = __( 'Good design is obvious. Great design is transparent.', 'wp-motivator' );
            }

        // If we are in Trailblazer mode.
        } elseif ( 'trailblazer' == $mode ) {
            // Get the Trailblazer array of messages.
            $messages = $trailblazer_messages;
            // Shuffle the order of the array.
            $random = shuffle( $messages );
            // Count the number of keys in the array.
            $count  = count( $messages );

            // If there is only one key, return that key.
            if ( ! empty( $random ) && 1 == $count ) {
                $message = $messages[0];
            // If there are more than one key, return a random key.
            } elseif ( is_array( $messages ) && ! empty( $messages ) && ! empty( $random ) ) {
                $message = $messages[$random];
            // Otherwise return our fallback message.
            } else {
                $message = __( 'Be grateful that you have clients. Enjoy them.', 'wp-motivator' );
            }

        /*
        * If we are in Customizer mode and the option is selected
        * to use custom messages only.
        */
        } elseif ( 'customizer' == $mode && 'custom_only' == $custom_options ) {
            // If there is at least one line in the custom textarea input, return that array.
            if ( 0 != strlen( $custom_input ) ) {
                $messages = $custom_messages;
            /*
            * Otherwise return our fallback message.
            * This must also return an array, hence the [] brackets.
            */
            } else {
                $messages = [ __( 'WP Motivator messages are in Customizer mode. Add your own motivation.', 'wp-motivator' ) ];
            }
            // Shuffle the order of the array.
            $random = shuffle( $messages );
            // Count the number of keys in the array.
            $count  = count( $messages );

            // If there is only one key, return that key.
            if ( ! empty( $random ) && 1 == $count  ) {
                $message = $messages[0];
            // If there are more than one key, return a random key.
            } elseif ( is_array( $messages ) && ! empty( $messages ) && ! empty( $random ) ) {
                $message = $messages[$random];
            // Otherwise return our fallback message.
            } else {
                $message = __( 'WP Motivator messages are in Customizer mode. Add your own motivation.', 'wp-motivator' );
            }

        /*
        * If we are in Customizer mode and the option is selected
        * to combine built-in messages with custom messages.
        */
        } elseif ( 'customizer' == $mode && 'custom_plus' == $custom_options ) {
            /*
            * If there is at least one line in the custom textarea input,
            * merge that array with the innovator and trailblazer arrays.
            */
            if ( 0 != strlen( $custom_input ) ) {
                $messages = array_merge( $custom_messages, $innovator_messages, $trailblazer_messages );
            /*
            * Otherwise return our fallback message.
            * This must also return an array, hence the [] brackets.
            */
            } else {
                $messages = [ __( 'WP Motivator messages are in Customizer mode. Add your own motivation.', 'wp-motivator' ) ];
            }
            // Shuffle the order of the array.
            $random   = shuffle( $messages );
            // Count the number of keys in the array.
            $count    = count( $messages );

            // If there is only one key, return that key.
            if ( ! empty( $random ) && 1 == $count ) {
                $message = $messages[0];
            // If there are more than one key, return a random key.
            } elseif ( is_array( $messages ) && ! empty( $messages ) && ! empty( $random ) ) {
                $message = $messages[$random];
            // Otherwise return our fallback message.
            } else {
                $message = __( 'WP Motivator messages are in Customizer mode. Add your own motivation.', 'wp-motivator' );
            }

        // If we are in Disabled mode.
        } elseif ( 'disabled' == $mode ) {
            $message = null;
        // Or any unforseen condition.
        } else {
            $message = null;
        }

        /**
         * Output the message text.
         *
         * @since      1.0.0
         */
        $message = apply_filters( 'motivator_message_output', $message );
        return $message;

    }

}