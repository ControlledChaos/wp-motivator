<?php

/**
 * Output of the motivational greeting.
 *
 * @since      1.0.0
 * @package    WP_Motivator
 * @subpackage WP_Motivator/admin
 * @author     Greg Sweet <greg@ccdzine.com>
 */

class WP_Motivator_Greeting {

    /**
	 * Initialize the class and set its properties.
	 *
	 * @since      1.0.0
	 * @param      string    $wp_motivator
	 * @param      string    $version
	 */
	public function __construct() {

        $this->motivator_greeting_output();

    }

    /**
     * Output of the motivational greeting.
     *
     * @since      1.0.0
     */
    public static function motivator_greeting_output() {

        /**
         * Get the greeting mode options.
         *
         * @since      1.0.0
         */
        $mode = get_option( 'motivator_greeting_mode' );

        /**
         * Arrays of built-in greetings per mode.
         * The Innoblazer mode will merge the two arrays.
         *
         * These will be randomized and only one array key (greeting)
         * will be display per page load.
         *
         * @since      1.0.0
         */

        // Innovator array of greetings.
        $innovator_greetings = [
            __( 'Stay motivated', 'wp-motivator' ),
            __( 'Take pride', 'wp-motivator' ),
            __( 'Code is poetry', 'wp-motivator' ),
            __( 'Great innovation', 'wp-motivator' ),
            __( 'Give\'r', 'wp-motivator' ),
            __( 'Onwards & upwards', 'wp-motivator' ),
            __( 'You\'ve got this', 'wp-motivator' ),
            __( 'Keep swimming', 'wp-motivator' ),
        ];

        // Trailblazer array of greetings.
        $trailblazer_greetings = [
            __( 'Stay motivated', 'wp-motivator' ),
            __( 'Focus', 'wp-motivator' ),
            __( 'Blaze trails', 'wp-motivator' ),
            __( 'Love your agency', 'wp-motivator' ),
            __( 'Honor your value', 'wp-motivator' ),
            __( 'Straight ahead', 'wp-motivator' ),
            __( 'Just be real', 'wp-motivator' ),
            __( 'Eat the frog', 'wp-motivator' ),
        ];

        /**
         * Get custom greeting mode options.
         *
         * @since      1.0.0
         */
        $custom_input    = get_option( 'motivator_greeting_custom' );
        $custom_options  = get_option( 'motivator_greeting_custom_options' );

        // Convert custom textarea lines to an array.
        $custom_greetings = explode( "\n", str_replace( "\r", '', $custom_input ) );

        /**
         * Return a random greeting by mode option.
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
            // Merge the Innovator and Trailblazer arrays of greetings.
            $greetings = array_merge( $innovator_greetings, $trailblazer_greetings );
            // Shuffle the order of the merged array.
            $random    = shuffle( $greetings );
            // Count the number of keys in the array.
            $count     = count( $greetings );

            // If there is only one key, return that key.
            if ( ! empty( $random ) && 1 == $count ) {
                $greeting = $greetings[0];
            // If there are more than one key, return a random key.
            } elseif ( is_array( $greetings ) && ! empty( $greetings ) && ! empty( $random ) ) {
                // Return the first value of the shuffled array.
                $greeting = $greetings[$random];
            // Otherwise return our fallback greeting.
            } else {
                $greeting = __( 'Stay motivated', 'wp-motivator' );
            }

        // If we are in Innovator mode.
        } elseif ( 'innovator' == $mode ) {
            // Get the Innovator array of greetings.
            $greetings = $innovator_greetings;
            // Shuffle the order of the array.
            $random    = shuffle( $greetings );
            // Count the number of keys in the array.
            $count     = count( $greetings );

            // If there is only one key, return that key.
            if ( ! empty( $random ) && 1 == $count ) {
                $greeting = $greetings[0];
            // If there are more than one key, return a random key.
            } elseif ( is_array( $greetings ) && ! empty( $greetings ) && ! empty( $random ) ) {
                $greeting = $greetings[$random];
            // Otherwise return our fallback greeting.
            } else {
                $greeting = __( 'Stay motivated', 'wp-motivator' );
            }

        // If we are in Trailblazer mode.
        } elseif ( 'trailblazer' == $mode ) {

            // Get the Trailblazer array of greetings.
            $greetings = $trailblazer_greetings;
            // Shuffle the order of the array.
            $random    = shuffle( $greetings );
            // Count the number of keys in the array.
            $count     = count( $greetings );

            // If there is only one key, return that key.
            if ( ! empty( $random ) && 1 == $count ) {
                $greeting = $greetings[0];
            // If there are more than one key, return a random key.
            } elseif ( is_array( $greetings ) && ! empty( $greetings ) && ! empty( $random ) ) {
                $greeting = $greetings[$random];
            // Otherwise return our fallback greeting.
            } else {
                $greeting = __( 'Stay motivated', 'wp-motivator' );
            }

        /*
        * If we are in Customizer mode and the option is selected
        * to use custom greetings only.
        */
        } elseif ( 'customizer' == $mode && 'custom_only' == $custom_options ) {
            // If there is at least one line in the custom textarea input, return that array.
            if ( 0 != strlen( $custom_input ) ) {
                $greetings = $custom_greetings;
            /*
            * Otherwise return our fallback greeting.
            * This must also return an array, hence the [] brackets.
            */
            } else {
                $greetings = [ __( 'Add your greetings', 'wp-motivator' ) ];
            }
            // Shuffle the order of the array.
            $random = shuffle( $greetings );
            // Count the number of keys in the array.
            $count  = count( $greetings );

            // If there is only one key, return that key.
            if ( ! empty( $random ) && 1 == $count  ) {
                $greeting = $greetings[0];
            // If there are more than one key, return a random key.
            } elseif ( is_array( $greetings ) && ! empty( $greetings ) && ! empty( $random ) ) {
                $greeting = $greetings[$random];
            // Otherwise return our fallback greeting.
            } else {
                $greeting = __( 'Add your greetings', 'wp-motivator' );
            }

        /*
        * If we are in Customizer mode and the option is selected
        * to combine built-in greetings with custom greetings.
        */
        } elseif ( 'customizer' == $mode && 'custom_plus' == $custom_options ) {
            /*
            * If there is at least one line in the custom textarea input,
            * merge that array with the innovator and trailblazer arrays.
            */
            if ( 0 != strlen( $custom_input ) ) {
                $greetings = array_merge( $custom_greetings, $innovator_greetings, $trailblazer_greetings );
            /*
            * Otherwise return our fallback greeting.
            * This must also return an array, hence the [] brackets.
            */
            } else {
                $greetings = [ __( 'Add your greetings', 'wp-motivator' ) ];
            }
            // Shuffle the order of the array.
            $random = shuffle( $greetings );
            // Count the number of keys in the array.
            $count  = count( $greetings );

            // If there is only one key, return that key.
            if ( ! empty( $random ) && 1 == $count ) {
                $greeting = $greetings[0];
            // If there are more than one key, return a random key.
            } elseif ( is_array( $greetings ) && ! empty( $greetings ) && ! empty( $random ) ) {
                $greeting = $greetings[$random];
            // Otherwise return our fallback greeting.
            } else {
                $greeting = __( 'Add your greetings', 'wp-motivator' );
            }

        // If we are in Disabled mode.
        } elseif ( 'disabled' == $mode ) {
            $greeting = null;
        // Or any unforseen condition.
        } else {
            $greeting = null;
        }

        /**
         * Output the greeting text.
         *
         * @since      1.0.0
         */
        $greeting = apply_filters( 'motivator_greeting_output', $greeting );
        return $greeting;

    }

}