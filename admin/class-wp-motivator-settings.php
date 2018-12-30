<?php

/**
 * Fields for the settings page.
 *
 * @since      1.0.0
 * @package    WP_Motivator
 * @subpackage WP_Motivator/admin
 * @author     Greg Sweet <greg@ccdzine.com>
 */

class WP_Motivator_Settings {

    /**
	 * Initialize the class and set its properties.
	 *
	 * @since      1.0.0
	 * @param      string    $wp_motivator
	 * @param      string    $version
	 */
	public function __construct() {

        // Register settings.
		add_action( 'admin_init', [ $this, 'settings' ] );

    }

    /**
	 * Plugin settings.
	 *
	 * @since    1.0.0
	 */
	public function settings() {

		/**
		 * Greeting section.
         *
         * @since    1.0.0
		 */
		add_settings_section(
			'motivator-greeting-settings',
			__( 'Motivator Greeting', 'wp-motivator' ),
			[
				$this,
				'motivator_greeting_section_callback'
			],
			'motivator-greeting-settings'
		);

		// Greeting mode.
		add_settings_field(
			'motivator_greeting_mode',
			__( 'Greeting Mode', 'wp-motivator' ),
			[
				$this,
				'motivator_greeting_mode_callback'
			],
			'motivator-greeting-settings',
			'motivator-greeting-settings',
			[
				'label_for' => 'motivator_greeting_mode'
			]
		);

		// Greeting mode.
		register_setting(
			'motivator-greeting-settings',
			'motivator_greeting_mode'
		);

		// Custom greetings.
		add_settings_field(
			'motivator_greeting_custom',
			__( 'Custom Motivation List', 'wp-motivator' ),
			[
				$this,
				'motivator_greeting_custom_callback'
			],
			'motivator-greeting-settings',
			'motivator-greeting-settings',
			[
				esc_html__( 'Requires Customizer mode. Enter each greeting on a new line.', 'wp-motivator' )
			]
		);

		// Custom greetings.
		register_setting(
			'motivator-greeting-settings',
			'motivator_greeting_custom'
		);

		// Custom mode options.
		add_settings_field(
			'motivator_greeting_custom_options',
			__( 'Custom Mode Options', 'wp-motivator' ),
			[
				$this,
				'motivator_greeting_custom_options_callback'
			],
			'motivator-greeting-settings', 'motivator-greeting-settings',
			[
				esc_html__( '', 'wp-motivator' )
			]
		);

		// Custom mode options.
		register_setting(
			'motivator-greeting-settings',
			'motivator_greeting_custom_options'
		);

		// Other language greeting.
		add_settings_field(
			'motivator_greeting_custom_language',
			__( 'Other Language Greeting', 'wp-motivator' ),
			[
				$this,
				'motivator_greeting_custom_language_callback'
			],
			'motivator-greeting-settings', 'motivator-greeting-settings',
			[
				esc_html__( 'Enter the greeting to be replaced (see help tab for more info).', 'wp-motivator' )
			]
		);

		// Other language greeting.
		register_setting(
			'motivator-greeting-settings',
			'motivator_greeting_custom_language'
		);

		/**
		 * Message section.
         *
         * @since    1.0.0
		 */
		add_settings_section(
			'motivator-message-settings',
			__( 'Motivator Message', 'wp-motivator' ),
			[
				$this,
				'motivator_message_section_callback'
			],
			'motivator-message-settings'
		);

		// Message mode.
		add_settings_field(
			'motivator_message_mode',
			__( 'Message Mode', 'wp-motivator' ),
			[
				$this,
				'motivator_message_mode_callback'
			],
			'motivator-message-settings',
			'motivator-message-settings',
			[
				esc_html__( 'Choose the type of motivation that you need.', 'wp-motivator' )
			]
		);

		// Message mode.
		register_setting(
			'motivator-message-settings',
			'motivator_message_mode'
		);

		// Custom messages.
		add_settings_field(
			'motivator_message_custom',
			__( 'Custom Motivation List', 'wp-motivator' ),
			[
				$this,
				'motivator_message_custom_callback'
			],
			'motivator-message-settings',
			'motivator-message-settings',
			[
				esc_html__( 'Requires Customizer mode. Enter each message on a new line.', 'wp-motivator' )
			]
		);

		// Custom messages.
		register_setting(
			'motivator-message-settings',
			'motivator_message_custom'
		);

		// Custom mode options.
		add_settings_field(
			'motivator_message_custom_options',
			__( 'Custom Mode Options', 'wp-motivator' ),
			[
				$this,
				'motivator_message_custom_options_callback'
			],
			'motivator-message-settings',
			'motivator-message-settings',
			[
				esc_html__( '', 'wp-motivator' )
			]
		);

		// Custom mode options.
		register_setting(
			'motivator-message-settings',
			'motivator_message_custom_options'
		);

		/**
		 * Dashboard section.
         *
         * @since    1.0.0
		 */
		add_settings_section(
			'motivator-dashboard-settings',
			__( 'Motivator Dashboard', 'wp-motivator' ),
			[
				$this,
				'motivator_dashboard_section_callback'
			],
			'motivator-dashboard-settings'
		);

		// Use the welcome panel.
		add_settings_field(
			'motivator_use_welcome',
			__( 'Motivate Welcome Panel', 'wp-motivator' ),
			[
				$this,
				'motivator_use_welcome_callback'
			],
			'motivator-dashboard-settings',
			'motivator-dashboard-settings',
			[
				esc_html__( 'Use the Motivator welcome panel.', 'wp-motivator' )
			]
		);

		// Use the welcome panel.
		register_setting(
			'motivator-dashboard-settings',
			'motivator_use_welcome'
		);

		// Disable the welcome customizer link.
		add_settings_field(
			'motivator_disable_welcome_link',
			__( 'Customizer Link', 'wp-motivator' ),
			[
				$this,
				'motivator_disable_welcome_link_callback'
			],
			'motivator-dashboard-settings',
			'motivator-dashboard-settings',
			[
				esc_html__( 'Disable the welcome panel Customizer link.', 'wp-motivator' )
			]
		);

		// Disable the welcome customizer link.
		register_setting(
			'motivator-dashboard-settings',
			'motivator_disable_welcome_link'
		);

		// Use the dashboard widget.
		add_settings_field(
			'motivator_use_dashboard',
			__( 'Motivate Dashboard Widget', 'wp-motivator' ),
			[
				$this,
				'motivator_use_dashboard_callback'
			],
			'motivator-dashboard-settings',
			'motivator-dashboard-settings',
			[
				esc_html__( 'Use the Motivator dashboard widget.', 'wp-motivator' )
			]
		);

		// Use the dashboard widget.
		register_setting(
			'motivator-dashboard-settings',
			'motivator_use_dashboard'
		);

		/**
		 * Admin footer section.
         *
         * @since    1.0.0
		 */
		add_settings_section(
			'motivator-footer-settings',
			__( 'Motivator Footer', 'wp-motivator' ),
			[
				$this,
				'motivator_footer_section_callback'
			],
			'motivator-footer-settings'
		);

		// Footer mode.
		add_settings_field(
			'motivator_footer_mode',
			__( 'Footer Mode', 'wp-motivator' ),
			[
				$this,
				'motivator_footer_mode_callback'
			],
			'motivator-footer-settings',
			'motivator-footer-settings',
			[
				esc_html__( 'Choose the type of motivation that you need.', 'wp-motivator' )
			]
		);

		// Footer mode.
		register_setting(
			'motivator-footer-settings',
			'motivator_footer_mode'
		);

		// Custom footer.
		add_settings_field(
			'motivator_footer_custom',
			__( 'Custom Motivation List', 'wp-motivator' ),
			[
				$this,
				'motivator_footer_custom_callback'
			],
			'motivator-footer-settings',
			'motivator-footer-settings',
			[
				esc_html__( 'Requires Customizer mode. Enter each message on a new line.', 'wp-motivator' )
			]
		);

		// Custom footer.
		register_setting(
			'motivator-footer-settings',
			'motivator_footer_custom'
		);

		// Custom mode options.
		add_settings_field(
			'motivator_footer_custom_options',
			__( 'Custom Mode Options', 'wp-motivator' ),
			[
				$this,
				'motivator_footer_custom_options_callback'
			],
			'motivator-footer-settings',
			'motivator-footer-settings',
			[
				esc_html__( '', 'wp-motivator' )
			]
		);

		// Custom mode options.
		register_setting(
			'motivator-footer-settings',
			'motivator_footer_custom_options'
		);

		/**
		 * Options section.
         *
         * @since    1.0.0
		 */
		add_settings_section(
			'motivator-other-settings',
			__( 'Other Plugin Options', 'wp-motivator' ),
			[
				$this,
				'motivator_option_section_callback'
			],
			'motivator-other-settings'
		);

		// User capability.
		add_settings_field(
			'motivator_capability',
			__( 'Minimum User Role', 'wp-motivator' ),
			[
				$this,
				'motivator_capability_callback'
			],
			'motivator-other-settings',
			'motivator-other-settings',
			[
				esc_html__( 'Delete all plugin settings on deactivation.', 'wp-motivator' )
			]
		);

		// User capability.
		register_setting(
			'motivator-other-settings',
			'motivator_capability'
		);

		// Custom CSS.
		add_settings_field(
			'motivator_css',
			__( 'Custom CSS', 'wp-motivator' ),
			[
				$this,
				'motivator_css_callback'
			],
			'motivator-other-settings',
			'motivator-other-settings',
			[
				esc_html__( 'Add your own styles to the plugin HTML.', 'wp-motivator' )
			]
		);

		// Custom CSS.
		register_setting(
			'motivator-other-settings',
			'motivator_css'
		);

    }

    /**
     * Greeting section content.
     *
     * @since    1.0.0
	 * @param    settings $args
     */
    public function motivator_greeting_section_callback( $args ) {

		// Section description.
		echo sprintf( '<p class="description">%1s</p>', esc_html( 'The user greeting that replaces the greeting in the admin toolbar. Also used in the WP Motivator welcome panel if the option is selected.', 'wp-motivator' ) );

	}

    /**
     * Message section content.
     *
     * @since    1.0.0
	 * @param    settings $args
     */
	public function motivator_message_section_callback( $args ) {

		// Section description.
		echo sprintf( '<p class="description">%1s</p>', esc_html( 'The message that displays at upper right of admin pages. Also used in the WP Motivator welcome panel if the option is selected.', 'wp-motivator' ) );

	}

    /**
     * Dashboard section content.
     *
     * @since    1.0.0
	 * @param    settings $args
     */
	public function motivator_dashboard_section_callback( $args ) {

		// Section description.
		echo sprintf( '<p class="description">%1s</p>', esc_html( 'Adds motivation to the WordPress dashboard.', 'wp-motivator' ) );

	}

	/**
     * Admin footer section content.
     *
     * @since    1.0.0
	 * @param    settings $args
     */
	public function motivator_footer_section_callback( $args ) {

		// Section description.
		echo sprintf( '<p class="description">%1s</p>', esc_html( 'Adds motivation to the footer at the bottom of all admin pages.', 'wp-motivator' ) );

	}

    /**
     * Options section content.
     *
     * @since    1.0.0
	 * @param    settings $args
     */
	public function motivator_option_section_callback( $args ) {

		// Section description.
		echo sprintf( '<p class="description">%1s</p>', esc_html( '', 'wp-motivator' ) );

	}

    /**
     * Greeting mode dropdown select.
     *
     * @since    1.0.0
	 * @param    settings $args
     */
	public function motivator_greeting_mode_callback( $args ) {

		// Field options.
		$mode    = get_option( 'motivator_greeting_mode' );
		$options = [
			'innoblazer'  => __( 'Innoblazer', 'wp-motivator' ),
			'innovator'   => __( 'Innovator', 'wp-motivator' ),
			'trailblazer' => __( 'Trailblazer', 'wp-motivator' ),
			'customizer'  => __( 'Customizer', 'wp-motivator' ),
			'disabled'    => __( 'Disabled', 'wp-motivator' )
		];

		// Field output.
		$html = '<p><select id="motivator_greeting_mode" name="motivator_greeting_mode">';
		foreach ( $options as $option => $label ) {
			$selected = ( $mode == $option ) ? 'selected="selected"' : '';
			$html .= sprintf( '<option value="%1s" %2s>%3s</option>', $option, $selected, $label );
		}
		$html .= '</select></p>';

		echo $html;

	}

	/**
	 * Custom greetings textarea field.
	 *
	 * @since    1.0.0
	 * @param    settings $args
	 */
	public function motivator_greeting_custom_callback( $args ) {

		// Field options.
		$list = get_option( 'motivator_greeting_custom' );

		// Field output.
		$html = sprintf( '<p><label for="motivator_greeting_custom">%1s</label></p>', $args[0] );
		$html .= '<p><textarea id="motivator_greeting_custom" name="motivator_greeting_custom" value="' . esc_html( $list ) . '" rows="12" cols="100" type="textarea">' . $list . '</textarea></p>';

		echo $html;

	}

	/**
     * Greeting list options dropdown select.
     *
     * @since    1.0.0
	 * @param    settings $args
     */
	public function motivator_greeting_custom_options_callback( $args ) {

		// Field options.
		$mode    = get_option( 'motivator_greeting_custom_options' );
		$options = [
			'custom_only' => __( 'Custom List Only', 'wp-motivator' ),
			'custom_plus' => __( 'Custom List + Plugin List', 'wp-motivator' ),
		];

		// Field output.
		$html = '<p><select id="motivator_greeting_custom_options" name="motivator_greeting_custom_options">';
		foreach ( $options as $option => $label ) {
			$selected = ( $mode == $option ) ? 'selected="selected"' : '';
			$html .= sprintf( '<option value="%1s" %2s>%3s</option>', $option, $selected, $label );
		}
		$html .= '</select></p>';

		echo $html;

	}

	/**
     * Other language greeting.
     *
     * @since    1.0.0
	 * @param    settings $args
     */
	public function motivator_greeting_custom_language_callback( $args ) {

		// Field input.
		$input = get_option( 'motivator_greeting_custom_language' );

		// Field output.
		$html = sprintf( '<p><label for="motivator_greeting_custom_language">%1s</label></p>', $args[0] );
		$html .= '<input id="motivator_greeting_custom_language" name="motivator_greeting_custom_language" size="40" type="text" value="' . $input . '" />';

		echo $html;

	}

    /**
     * Message mode dropdown select.
     *
     * @since    1.0.0
	 * @param    settings $args
     */
	public function motivator_message_mode_callback( $args ) {

		// Field options.
		$mode    = get_option( 'motivator_message_mode' );
		$options = [
			'innoblazer'  => __( 'Innoblazer', 'wp-motivator' ),
			'innovator'   => __( 'Innovator', 'wp-motivator' ),
			'trailblazer' => __( 'Trailblazer', 'wp-motivator' ),
			'customizer'  => __( 'Customizer', 'wp-motivator' ),
			'disabled'    => __( 'Disabled', 'wp-motivator' )
		];

		// Field output.
		$html = '<p><select id="motivator_message_mode" name="motivator_message_mode">';
		foreach ( $options as $option => $label ) {
			$selected = ( $mode == $option ) ? 'selected="selected"' : '';
			$html .= sprintf( '<option value="%1s" %2s>%3s</option>', $option, $selected, $label );
		}
		$html .= '</select></p>';

		echo $html;

	}

	/**
	 * Custom messages textarea field.
	 *
	 * @since    1.0.0
	 * @param    settings $args
	 */
	public function motivator_message_custom_callback( $args ) {

		// Field options.
		$list = get_option( 'motivator_message_custom' );

		// Field output.
		$html = sprintf( '<p><label for="motivator_message_custom">%1s</label></p>', $args[0] );
		$html .= '<p><textarea id="motivator_message_custom" name="motivator_message_custom" value="' . esc_html( $list ) . '" rows="12" cols="100" type="textarea">' . $list . '</textarea></p>';

		echo $html;

	}

	/**
     * Message list options dropdown select.
     *
     * @since    1.0.0
	 * @param    settings $args
     */
	public function motivator_message_custom_options_callback( $args ) {

		// Field options.
		$mode    = get_option( 'motivator_message_custom_options' );
		$options = [
			'custom_only' => __( 'Custom List Only', 'wp-motivator' ),
			'custom_plus' => __( 'Custom List + Plugin List', 'wp-motivator' ),
		];

		// Field output.
		$html = '<p><select id="motivator_message_custom_options" name="motivator_message_custom_options">';
		foreach ( $options as $option => $label ) {
			$selected = ( $mode == $option ) ? 'selected="selected"' : '';
			$html .= sprintf( '<option value="%1s" %2s>%3s</option>', $option, $selected, $label );
		}
		$html .= '</select></p>';

		echo $html;

	}

	/**
     * Footer mode dropdown select.
     *
     * @since    1.0.0
	 * @param    settings $args
     */
	public function motivator_footer_mode_callback( $args ) {

		// Field options.
		$mode    = get_option( 'motivator_footer_mode' );
		$options = [
			'innoblazer'  => __( 'Innoblazer', 'wp-motivator' ),
			'innovator'   => __( 'Innovator', 'wp-motivator' ),
			'trailblazer' => __( 'Trailblazer', 'wp-motivator' ),
			'customizer'  => __( 'Customizer', 'wp-motivator' ),
			'disabled'    => __( 'Disabled', 'wp-motivator' )
		];

		// Field output.
		$html = '<p><select id="motivator_footer_mode" name="motivator_footer_mode">';
		foreach ( $options as $option => $label ) {
			$selected = ( $mode == $option ) ? 'selected="selected"' : '';
			$html .= sprintf( '<option value="%1s" %2s>%3s</option>', $option, $selected, $label );
		}
		$html .= '</select></p>';

		echo $html;

	}

	/**
	 * Custom footer textarea field.
	 *
	 * @since    1.0.0
	 * @param    settings $args
	 */
	public function motivator_footer_custom_callback( $args ) {

		// Field options.
		$list = get_option( 'motivator_footer_custom' );

		// Field output.
		$html = sprintf( '<p><label for="motivator_footer_custom">%1s</label></p>', $args[0] );
		$html .= '<p><textarea id="motivator_footer_custom" name="motivator_footer_custom" value="' . esc_html( $list ) . '" rows="12" cols="100" type="textarea">' . $list . '</textarea></p>';

		echo $html;

	}

	/**
     * Footer list options dropdown select.
     *
     * @since    1.0.0
	 * @param    settings $args
     */
	public function motivator_footer_custom_options_callback( $args ) {

		// Field options.
		$mode    = get_option( 'motivator_footer_custom_options' );
		$options = [
			'custom_only' => __( 'Custom List Only', 'wp-motivator' ),
			'custom_plus' => __( 'Custom List + Plugin List', 'wp-motivator' ),
		];

		// Field output.
		$html = '<p><select id="motivator_footer_custom_options" name="motivator_footer_custom_options">';
		foreach ( $options as $option => $label ) {
			$selected = ( $mode == $option ) ? 'selected="selected"' : '';
			$html .= sprintf( '<option value="%1s" %2s>%3s</option>', $option, $selected, $label );
		}
		$html .= '</select></p>';

		echo $html;

	}

	/**
	 * Use Welcome panel checkbox.
	 *
	 * @since    1.0.0
	 * @param    settings $args
	 */
	public function motivator_use_welcome_callback( $args ) {

		// Field options.
		$option = get_option( 'motivator_use_welcome' );

		// Field output.
		$html = '<p><input type="checkbox" id="motivator_use_welcome" name="motivator_use_welcome" value="1" ' . checked( 1, $option, false ) . '/>';
		$html .= '<label for="motivator_use_welcome"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Disable welcome panel customizer link.
	 *
	 * @since    1.0.0
	 * @param    settings $args
	 */
	public function motivator_disable_welcome_link_callback( $args ) {

		// Field options.
		$option = get_option( 'motivator_disable_welcome_link' );

		// Field output.
		$html = '<p><input type="checkbox" id="motivator_disable_welcome_link" name="motivator_disable_welcome_link" value="1" ' . checked( 1, $option, false ) . '/>';
		$html .= '<label for="motivator_disable_welcome_link"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Use Dashboard widget checkbox.
	 *
	 * @since    1.0.0
	 * @param    settings $args
	 */
	public function motivator_use_dashboard_callback( $args ) {

		// Field options.
		$option = get_option( 'motivator_use_dashboard' );

		// Field output.
		$html = '<p><input type="checkbox" id="motivator_use_dashboard" name="motivator_use_dashboard" value="1" ' . checked( 1, $option, false ) . '/>';
		$html .= '<label for="motivator_use_dashboard"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
     * User capability dropdown select.
     *
     * @since    1.0.0
	 * @param    settings $args
     */
	public function motivator_capability_callback( $args ) {

		// Field options.
		$mode = get_option( 'motivator_capability' );
		$args = [
			''               => __( 'Select', 'wp-motivator' ),
			'manage_options' => __( 'Administrator', 'wp-motivator' ),
			'edit_pages'     => __( 'Editor', 'wp-motivator' ),
			'publish_posts'  => __( 'Author', 'wp-motivator' ),
			'edit_posts'     => __( 'Contributor', 'wp-motivator' ),
			'read'           => __( 'Subscriber', 'wp-motivator' )
		];

		$options = apply_filters( 'motivator_capability', $args );

		// Field output.
		$html = sprintf( '<p>%1s</p>', esc_html( 'Administrator by default.', 'wp-motivator' ) );
		$html .= '<p><select id="motivator_capability" name="motivator_capability">';
		foreach ( $options as $option => $label ) {
			$selected = ( $mode == $option ) ? 'selected="selected"' : '';
			$html .= sprintf( '<option value="%1s" %2s>%3s</option>', $option, $selected, $label );
		}
		$html .= '</select></p>';

		echo $html;

	}

	/**
	 * Custom CSS textarea field.
	 *
	 * @since    1.0.0
	 * @param    settings $args
	 */
	public function motivator_css_callback( $args ) {

		// Get CSS field.
		$css = get_option( 'motivator_css' );

		// Field output.
		$html = sprintf( '<p><label for="motivator_css">%1s</label></p>', $args[0] );
		$html .= '<p><textarea id="motivator_css" name="motivator_css" value="' . esc_html( $css ) . '" rows="12" cols="100" type="textarea">' . $css . '</textarea></p>';

		echo $html;

	}

}

new WP_Motivator_Settings;