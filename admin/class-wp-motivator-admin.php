<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @since      1.0.0
 * @package    WP_Motivator
 * @subpackage WP_Motivator/admin
 * @author     Greg Sweet <greg@ccdzine.com>
 */

 class WP_Motivator_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $wp_motivator    The ID of this plugin.
	 */
	private $wp_motivator;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version
	 */
	private $version;

	/**
	 * Contextual help tab.
	 *
	 * @since    1.0.0
	 * @access   protected
	 */
	protected $motivator_help;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since      1.0.0
	 * @param      string    $wp_motivator
	 * @param      string    $version
	 */
	public function __construct( $wp_motivator, $version ) {

		$this->wp_motivator = $wp_motivator;
		$this->version = $version;

		// Get admin dependencies.
		$this->motivator_dependencies();

		/**
		 * Settings page
		 * 
		 * Priority 999 for bottom of the settings menu.
		 */
		add_action( 'admin_menu', [ $this, 'motivator_settings_page' ], 999 );

		/**
		 * Greeting
		 */
		
		// Get the greeting mode options.
		$greeting_mode = get_option( 'motivator_greeting_mode' );

		// Replace the greeting if not in disabled mode.
		if ( 'disabled' != $greeting_mode ) {
			add_filter( 'admin_bar_menu', [ $this, 'motivator_greeting' ] );
		}

		/**
		 * Messages
		 * 
		 * Disabled mode happens in partials/wp-motivator-message.
		 */
		add_action( 'admin_notices', [ $this, 'motivator_message' ] );

		/**
		 * Welcome panel
		 */

		// Get the use welcome option.
		$welcome_mode = get_option( 'motivator_use_welcome' );

		// Use the welcome panel if the option is selected.
		if ( $welcome_mode ) {
			// Register the welcome widget area.
			add_action( 'widgets_init', [ $this, 'motivator_welcome_sidebar' ], 20 );
			// Remove the default welcome panel to create a custom panel.
			remove_action( 'welcome_panel', 'wp_welcome_panel' );
			// Add custom welcome panel.
			add_action( 'welcome_panel', [ $this, 'motivator_welcome_panel' ] );
			// Remove the welcome panel dismiss button.
			add_action( 'admin_head', [ $this, 'motivator_welcome_dismiss' ] );
		}

		/**
		 * Dashboard
		 */
		
		// Get the use dashboard option.
		$dashboard_mode = get_option( 'motivator_use_dashboard' );

		// Use the dashboard widget if the option is selected.
		if ( $dashboard_mode ) {
			// Register the dashboard widget area.
			add_action( 'widgets_init', [ $this, 'motivator_dashboard_sidebar' ], 21 );
			// Set up the dashboard widget.
			add_action( 'wp_dashboard_setup', [ $this, 'motivator_dashboard_widget' ] );
		}

		/**
		 * Footer
		 */
		
		// Get the footer mode options.
		$footer_mode = get_option( 'motivator_footer_mode' );

		// Add footer messages if not in Disabled mode.
		if ( 'disabled' != $footer_mode ) {
			add_filter( 'admin_footer_text', [ $this, 'motivator_footer' ], 1 );
		}

		/**
		 * Custom CSS
		 */
		add_action( 'admin_head', [ $this, 'motivator_css_head' ] );

	}

	/**
	 * Get admin file dependencies.
	 *
	 * @since      1.0.0
	 */
	public function motivator_dependencies() {

		// Get the settings page fields.
		require_once plugin_dir_path( __FILE__ ) . 'class-wp-motivator-settings.php';

		// Get the greeting output.
		require_once plugin_dir_path( __FILE__ ) . 'class-wp-motivator-greeting.php';

		// Get the message output.
		require_once plugin_dir_path( __FILE__ ) . 'class-wp-motivator-message.php';

		// Get the footer output.
		require_once plugin_dir_path( __FILE__ ) . 'class-wp-motivator-footer.php';

	}

	/**
	 * Add plugin settings page.
	 *
	 * @since    1.0.0
	 * @param    help    $motivator_help
	 */
    public function motivator_settings_page() {

		$this->motivator_help = add_options_page(
			__( 'WP Motivator Settings', 'wp-motivator' ),
			__( 'WP Motivator', 'wp-motivator' ),
			apply_filters( 'wp_motivator_admin_level', 'manage_options' ),
			'wp-motivator',
			[ $this, 'motivator_settings_page_output' ]
		);

		// Add content to the Help tab.
		add_action( 'load-' . $this->motivator_help, [ $this, 'motivator_help' ] );

	}

	/**
	 * Settings page output.
	 *
	 * @since    1.0.0
	 */
    public function motivator_settings_page_output() {
		
		require_once plugin_dir_path( __FILE__ ) . 'partials/wp-motivator-settings-page.php';

	}

	/**
     * Output for the contextual help tab.
	 * 
	 * @since      1.0.0
     */
    public function motivator_help() {

		// Add to the plugin settings pages.
        $screen = get_current_screen();
		if ( $screen->id != $this->motivator_help ) {
			return;
		}

		// Motivator modes.
		$screen->add_help_tab( [
			'id'       => 'motivator_modes',
			'title'    => __( 'Motivator Modes', 'wp-motivator' ),
			'content'  => null,
			'callback' => [ $this, 'motivator_modes_help' ]
            ] );
		
		// Motivator greeting.
		$screen->add_help_tab( [
			'id'       => 'motivator_greeting',
			'title'    => __( 'Motivator Greeting', 'wp-motivator' ),
			'content'  => null,
			'callback' => [ $this, 'motivator_greeting_help' ]
		] );
		
		// Motivator message.
		$screen->add_help_tab( [
			'id'       => 'motivator_message',
			'title'    => __( 'Motivator Message', 'wp-motivator' ),
			'content'  => null,
			'callback' => [ $this, 'motivator_message_help' ]
		] );
		
		// Motivator dashboard.
		$screen->add_help_tab( [
			'id'       => 'motivator_dashboard',
			'title'    => __( 'Motivator Dashboard', 'wp-motivator' ),
			'content'  => null,
			'callback' => [ $this, 'motivator_dashboard_help' ]
        ] );
		
		// Motivator footer.
		$screen->add_help_tab( [
			'id'       => 'motivator_footer',
			'title'    => __( 'Motivator Footer', 'wp-motivator' ),
			'content'  => null,
			'callback' => [ $this, 'motivator_footer_help' ]
		] );
		
		// Motivator options.
		$screen->add_help_tab( [
			'id'       => 'motivator_options',
			'title'    => __( 'Motivator Options', 'wp-motivator' ),
			'content'  => null,
			'callback' => [ $this, 'motivator_options_help' ]
		] );

		// Motivator hooks.
		$screen->add_help_tab( [
			'id'       => 'motivator_hooks',
			'title'    => __( 'Motivator Hooks', 'wp-motivator' ),
			'content'  => null,
			'callback' => [ $this, 'motivator_hooks_help' ]
		] );

		// Motivator filters.
		$screen->add_help_tab( [
			'id'       => 'motivator_filters',
			'title'    => __( 'Motivator Filters', 'wp-motivator' ),
			'content'  => null,
			'callback' => [ $this, 'motivator_filters_help' ]
		] );
		
	}

	/**
     * Get Motivator Modes help content.
	 * 
	 * @since      1.0.0
     */
	public function motivator_modes_help() { 
		
		include_once plugin_dir_path( __FILE__ ) . 'partials/help/wp-motivator-help-modes.php';
	
	}

	/**
     * Get Motivator Greeting help content.
	 * 
	 * @since      1.0.0
     */
	public function motivator_greeting_help() { 
		
		include_once plugin_dir_path( __FILE__ ) . 'partials/help/wp-motivator-help-greeting.php';
	
	}

	/**
     * Get Motivator Message help content.
	 * 
	 * @since      1.0.0
     */
	public function motivator_message_help() { 
		
		include_once plugin_dir_path( __FILE__ ) . 'partials/help/wp-motivator-help-message.php';
	
	}

	/**
     * Get Motivator Dashboard help content.
	 * 
	 * @since      1.0.0
     */
	public function motivator_dashboard_help() { 
		
		include_once plugin_dir_path( __FILE__ ) . 'partials/help/wp-motivator-help-dashboard.php';
	
	}

	/**
     * Get Motivator Footer help content.
	 * 
	 * @since      1.0.0
     */
	public function motivator_footer_help() { 
		
		include_once plugin_dir_path( __FILE__ ) . 'partials/help/wp-motivator-help-footer.php';
	
	}

	/**
     * Get Motivator Options help content.
	 * 
	 * @since      1.0.0
     */
	public function motivator_options_help() { 
		
		include_once plugin_dir_path( __FILE__ ) . 'partials/help/wp-motivator-help-options.php';
	
	}

	/**
     * Get Motivator Hooks help content.
	 * 
	 * @since      1.0.0
     */
	public function motivator_hooks_help() { 
		
		include_once plugin_dir_path( __FILE__ ) . 'partials/help/wp-motivator-help-hooks.php';
	
	}

	/**
     * Get Motivator Filters help content.
	 * 
	 * @since      1.0.0
     */
	public function motivator_filters_help() { 
		
		include_once plugin_dir_path( __FILE__ ) . 'partials/help/wp-motivator-help-filters.php';
	
	}

	/**
	 * Replace the greeting in the admin toolbar.
	 * 
	 * Does not work for non-english languages.
	 * 
	 * @since    1.0.0
	 * @param    wp_admin_bar $wp_admin_bar
	 */
	public function motivator_greeting( $wp_admin_bar ) {

		/**
		 * Get the site language setting so that
		 * we know what text to replace.
		 */
		$locale = get_locale();
		$custom = get_option( 'motivator_greeting_custom_language' );

		if ( $locale == 'en_US' || $locale == 'en_CA' ) {
			$greeting = 'Howdy';
		} elseif ( $locale == 'en_GB' ) {
			$greeting = 'Hi';
		} elseif ( $locale == 'en_AU' ) {
			$greeting = 'G\'day';
		} elseif ( $locale == 'en_NZ' ) {
			$greeting = 'Kia ora';
		} elseif ( $locale == 'en_ZA' ) {
			$greeting = 'Howzit';
		} elseif ( $locale && ! empty( $custom ) ) {
			$greeting = $custom;
		} else {
			$greeting = '';
		}

		/**
		 * Apply user role option to greeting.
		 * 
		 * Administrator by default.
		 */
		$capability = get_option( 'motivator_capability' );

		if ( ( current_user_can( 'manage_options' ) && empty( $capability ) )  || current_user_can( $capability ) ) {

			$replace = WP_Motivator_Greeting::motivator_greeting_output();

			// Replace the text in the admin toolbar account menu.
			$account = $wp_admin_bar->get_node( 'my-account' );
			if ( $account && '' != $greeting ) {
				$title   = str_replace( $greeting, $replace, $account->title );
			} else {
				$title = null;
			}

			$wp_admin_bar->add_node( [
				'id'    => 'my-account',
				'title' => $title,
			] );

		}

	}

	/**
	 * Hook messages into admin notices.
	 * 
	 * @since    1.0.0
	 */
	public function motivator_message() {

		/**
		 * Apply user role option to message.
		 * 
		 * Administrator by default.
		 */
		$capability = get_option( 'motivator_capability' );

		if ( current_user_can( 'manage_options' ) || current_user_can( $capability ) ) {
			$message = include 'partials/wp-motivator-admin-message.php';
		} else {
			$message = null;
		}

		return $message;

	}

	/**
	 * Register the welcome widget area.
	 * 
	 * @since    1.0.0
	 */
	public function motivator_welcome_sidebar() {

		// Apply filters for customizing text.
		$name = apply_filters( 'motivator_welcome_widget_name', __( 'Motivator Welcome Panel', 'wp-motivator' ) );
		$desc = apply_filters( 'motivator_welcome_widget_description', __( 'Add motivation to your welcome panel.', 'wp-motivator' ) );

		register_sidebar( [
			'name'          => $name,
			'id'            => 'motivator-welcome-widget',
			'description'   => $desc,
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		] );

	}

	/**
     * Get custom welcome panel output.
     */
    public function motivator_welcome_panel() {

        $html = include_once plugin_dir_path( __FILE__ ) . 'partials/wp-motivator-welcome.php';
        return $html;

    }

    /**
	 * Remove the welcome panel dismiss button.
	 */
	public function motivator_welcome_dismiss() {

		$dismiss = '
			<style>
				/*
				* Welcome panel user dismiss option is disabled.
				*/
				a.welcome-panel-close, #wp_welcome_panel-hide, .metabox-prefs label[for="wp_welcome_panel-hide"] {
					display: none !important;
				}
				.welcome-panel {
					display: block !important;
				}
			</style>
			';
			
		echo $dismiss;

	}

	/**
	 * Register the dashboard widget area.
	 * 
	 * @since    1.0.0
	 */
	public function motivator_dashboard_sidebar() {

		// Apply filters for customizing text.
		$name = apply_filters( 'motivator_dashboard_widget_name', __( 'Motivator Dashboard Widget', 'wp-motivator' ) );
		$desc = apply_filters( 'motivator_dashboard_widget_description', __( 'Add motivation to your dashboard.', 'wp-motivator' ) );

		register_sidebar( [
			'name'          => $name,
			'id'            => 'motivator-dashboard-widget',
			'description'   => $desc,
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		] );

	}

	/**
	 * Create the dashdoard widget.
	 * 
	 * @since    1.0.0
	 */
	public function motivator_dashboard_widget() {

		$title = apply_filters( 'motivator_dashboard_widget_title', __( 'WP Motivator', 'wp-motivator' ) );

		wp_add_dashboard_widget( 'motivator_dashboard_widget', $title, [ $this, 'motivator_dashboard_widget_output' ] );

	}

	/**
	 * Dashboard widget output.
	 * 
	 * @since    1.0.0
	 */
	public function motivator_dashboard_widget_output() {

		if ( function_exists( 'dynamic_sidebar' ) && is_active_sidebar( 'motivator-dashboard-widget' ) ) {
			dynamic_sidebar( 'motivator-dashboard-widget' );
		} else {
			$placeholder = apply_filters( 'motivator_dashboard_placeholder', include 'partials/wp-motivator-dashboard-placeholder.php' );
			return $placeholder;
		}

	}

	/**
	 * Hook messages into the admin footer.
	 *
	 * @since      1.0.0
	 */
	public function motivator_footer() {

		/**
		 * Apply user role option to message.
		 * 
		 * Administrator by default.
		 */
		$capability = get_option( 'motivator_capability' );

		if ( current_user_can( 'manage_options' ) || current_user_can( $capability ) ) {
			$message = WP_Motivator_Footer::motivator_footer_output();
		} else {
			$message = null;
		}

		echo $message;

	}

	
	/**
	 * Custom CSS output.
	 * 
	 * @since    1.0.0
	 */
	public function motivator_css_head() {

		// Get CSS field.
		$css = get_option( 'motivator_css' );

		echo "\r";
		echo '<style>' . "\r";
		echo $css . "\r";
		echo '</style>' . "\r";
		
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function motivator_enqueue_styles() {

		wp_enqueue_style( $this->wp_motivator, plugin_dir_url( __FILE__ ) . 'assets/css/wp-motivator-admin.min.css', [], $this->version, 'screen' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function motivator_enqueue_scripts() {

		/**
		 * Script file not used.
		 * 
		 * This line and the file are preserved for future development.
		 */
		
		// wp_enqueue_script( $this->wp_motivator, plugin_dir_url( __FILE__ ) . 'assets/js/wp-motivator-admin.js', [ 'jquery' ], $this->version, true );

	}

}