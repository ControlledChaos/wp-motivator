<?php

/**
 * Output of the motivational footer.
 *
 * @since      1.0.0
 * @package    WP_Motivator
 * @subpackage WP_Motivator/admin
 * @author     Greg Sweet <greg@ccdzine.com>
 */

class WP_Motivator_Footer {

    /**
	 * Initialize the class and set its properties.
	 *
	 * @since      1.0.0
	 * @param      string    $wp_motivator
	 * @param      string    $version
	 */
	public function __construct() {

        $this->motivator_footer_output();

    }

    /**
     * Output of the motivational footer.
     *
     * @since      1.0.0
     */
    public static function motivator_footer_output() {

        /**
         * Get the footer mode options.
         *
         * @since      1.0.0
         */
        $mode = get_option( 'motivator_footer_mode' );

        /**
         * Arrays of built-in footers per mode.
         * The Innoblazer mode will merge the two arrays.
         *
         * These will be randomized and only one array key (footer)
         * will be display per page load.
         *
         * @since      1.0.0
         */

        // Innovator array of footers.
        $innovator_footers = [
            __( 'Making WordPress better.', 'wp-motivator' ),
            __( 'Innovated by the best!', 'wp-motivator' ),
            __( 'This site was developed with expertise.', 'wp-motivator' ),
            __( 'Not just another WordPress site!', 'wp-motivator' ),
            __( 'Making WordPress better.', 'wp-motivator' ),
        ];

        // Trailblazer array of footers.
        $trailblazer_footers = [
            __( 'Created by one amazing agency.', 'wp-motivator' ),
            __( 'Another trail blazed!', 'wp-motivator' ),
            __( 'This trail was blazed by the best.', 'wp-motivator' ),
            __( 'Not just another WordPress site!', 'wp-motivator' ),
        ];

        /**
         * Get custom footer mode options.
         *
         * @since      1.0.0
         */
        $custom_input    = get_option( 'motivator_footer_custom' );
        $custom_options  = get_option( 'motivator_footer_custom_options' );

        // Convert custom textarea lines to an array.
        $custom_footers  = explode( "\n", str_replace( "\r", '', $custom_input ) );

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
            $footers = array_merge( $innovator_footers, $trailblazer_footers );
            // Shuffle the order of the merged array.
            $random  = shuffle( $footers );
            // Count the number of keys in the array.
            $count   = count( $footers );

            // If there is only one key, return that key.
            if ( is_array( $footers ) && ! empty( $random ) && 1 == $count ) {
                $footer = $footers[0];
            // If there are more than one key, return a random key.
            } elseif ( is_array( $footers ) && ! empty( $footers ) && ! empty( $random ) ) {
                $footer = $footers[$random];
            // Otherwise return our fallback message.
            } else {
                $footer = __( 'Not just another WordPress site!', 'wp-motivator' );
            }

        // If we are in Innovator mode.
        } elseif ( 'innovator' == $mode ) {
            // Get the Innovator array of messages.
            $footers = $innovator_footers;
            // Shuffle the order of the array.
            $random  = shuffle( $footers );
            // Count the number of keys in the array.
            $count   = count( $footers );

            // If there is only one key, return that key.
            if ( ! empty( $random ) && 1 == $count ) {
                $footer = $footers[0];
            // If there are more than one key, return a random key.
            } elseif ( is_array( $footers ) && ! empty( $footers ) && ! empty( $random ) ) {
                $footer = $footers[$random];
            // Otherwise return our fallback message.
            } else {
                $footer = __( 'Making WordPress better.', 'wp-motivator' );
            }

        // If we are in Trailblazer mode.
        } elseif ( 'trailblazer' == $mode ) {
            // Get the Trailblazer array of messages.
            $footers = $trailblazer_footers;
            // Shuffle the order of the array.
            $random  = shuffle( $footers );
            // Count the number of keys in the array.
            $count   = count( $footers );

            // If there is only one key, return that key.
            if ( ! empty( $random ) && 1 == $count ) {
                $footer = $footers[0];
            // If there are more than one key, return a random key.
            } elseif ( is_array( $footers ) && ! empty( $footers ) && ! empty( $random ) ) {
                $footer = $footers[$random];
            // Otherwise return our fallback message.
            } else {
                $footer = __( 'Another trail blazed!', 'wp-motivator' );
            }

        /*
        * If we are in Customizer mode and the option is selected
        * to use custom messages only.
        */
        } elseif ( 'customizer' == $mode && 'custom_only' == $custom_options ) {
            // If there is at least one line in the custom textarea input, return that array.
            if ( 0 != strlen( $custom_input ) ) {
                $footers = $custom_footers;
            /*
            * Otherwise return our fallback message.
            * This must also return an array, hence the [] brackets.
            */
            } else {
                $footers = [ __( 'WP Motivator messages are in Customizer mode. Add your own motivation.', 'wp-motivator' ) ];
            }
            // Shuffle the order of the array.
            $random = shuffle( $footers );
            // Count the number of keys in the array.
            $count  = count( $footers );

            // If there is only one key, return that key.
            if ( ! empty( $random ) && 1 == $count  ) {
                $footer = $footers[0];
            // If there are more than one key, return a random key.
            } elseif ( is_array( $footers ) && ! empty( $footers ) && ! empty( $random ) ) {
                $footer = $footers[$random];
            // Otherwise return our fallback message.
            } else {
                $footer = __( 'WP Motivator messages are in Customizer mode. Add your own motivation.', 'wp-motivator' );
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
                $footers = array_merge( $custom_footers, $innovator_footers, $trailblazer_footers );
            /*
            * Otherwise return our fallback message.
            * This must also return an array, hence the [] brackets.
            */
            } else {
                $footers = [ __( 'WP Motivator footer is in Customizer mode. Add your own motivation.', 'wp-motivator' ) ];
            }
            // Shuffle the order of the array.
            $random = shuffle( $footers );
            // Count the number of keys in the array.
            $count  = count( $footers );

            // If there is only one key, return that key.
            if ( ! empty( $random ) && 1 == $count ) {
                $footer = $footers[0];
            // If there are more than one key, return a random key.
            } elseif ( is_array( $footers ) && ! empty( $footers ) && ! empty( $random ) ) {
                $footer = $footers[$random];
            // Otherwise return our fallback message.
            } else {
                $footer = __( 'WP Motivator footer is in Customizer mode. Add your own motivation.', 'wp-motivator' );
            }

        // If we are in Disabled mode.
        } elseif ( 'disabled' == $mode ) {
            $footer = null;
        // Or any unforseen condition.
        } else {
            $footer = null;
        }

        /**
         * Output the footer text.
         *
         * This text has the priority of 1 in attempt to put it ahead
         * of any other admin_footer_text filters. Thus we have added
         * a blank space following the $footer output.
         *
         * @since      1.0.0
         */
        $footer = apply_filters( 'motivator_footer_output', $footer );
        return $footer . ' ';

    }

}