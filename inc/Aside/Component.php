<?php
/**
 * WP_Rig\WP_Rig\Aside\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Aside;

use WP_Rig\WP_Rig\Component_Interface;
use WP_Rig\WP_Rig\Templating_Component_Interface;
use function WP_Rig\WP_Rig\wp_rig;
use WP_Post;
use function add_action;
use function add_filter;
use function register_nav_menus;
use function esc_html__;
use function has_nav_menu;
use function wp_nav_menu;
use function wp_enqueue_script;
use function get_theme_file_uri;
use function get_theme_file_path;
use function wp_script_add_data;
use function wp_localize_script;

/**
 * Class for managing aside menus.
 *
 * Exposes template tags:
 * * `wp_rig()->is_aside_nav_menu_active()`
 * * `wp_rig()->display_aside_nav_menu( array $args = [] )`
 */
class Component implements Component_Interface, Templating_Component_Interface {

	const ASIDE_NAV_MENU_SLUG = 'aside';

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'nav_menus_aside';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', [ $this, 'action_register_nav_menus' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'action_enqueue_aside_script' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'action_enqueue_headroom_script' ] );
	}
	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `wp_rig()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags() : array {
		return [
			'is_aside_nav_menu_active' => [ $this, 'is_aside_nav_menu_active' ],
			'display_aside_nav_menu'   => [ $this, 'display_aside_nav_menu' ],
		];
	}

	/**
	 * Registers the aside menus.
	 */
	public function action_register_nav_menus() {
		register_nav_menus(
			[
				static::ASIDE_NAV_MENU_SLUG => esc_html__( 'Aside', 'wp-rig' ),
			]
		);
	}

	/**
	 * Checks whether the aside aside menu is active.
	 *
	 * @return bool True if the aside aside menu is active, false otherwise.
	 */
	public function is_aside_nav_menu_active() : bool {
		return (bool) has_nav_menu( static::ASIDE_NAV_MENU_SLUG );
	}



	/**
	 * Enqueues a script for the aside menu.
	 */
	public function action_enqueue_headroom_script() {

		// If the AMP plugin is active, return early.
		if ( wp_rig()->is_amp() ) {
			return;
		}

		// Enqueue the headroom script for handling scrooling--> https://wicky.nillia.ms/headroom.js/
		wp_enqueue_script(
			'wp-rig-headroom',
			get_theme_file_uri( '/assets/js/headroom.min.js' ),
			[],
			wp_rig()->get_asset_version( get_theme_file_path( '/assets/js/headroom.min.js' ) ),
			false
		);
		wp_script_add_data( 'wp-rig-headroom', 'async', true );
		wp_script_add_data( 'wp-rig-headroom', 'precache', true );
		wp_localize_script(
			'wp-rig-headroom',
			'wpRigScreenReaderText',
			[
				'expand'   => __( 'Expand child menu', 'wp-rig' ),
				'collapse' => __( 'Collapse child menu', 'wp-rig' ),
			]
		);
	}
	public function action_enqueue_aside_script() {

		// If the AMP plugin is active, return early.
		if ( wp_rig()->is_amp() ) {
			return;
		}

		// Enqueue the aside script.
		wp_enqueue_script(
			'wp-rig-aside',
			get_theme_file_uri( '/assets/js/aside.min.js' ),
			[],
			wp_rig()->get_asset_version( get_theme_file_path( '/assets/js/aside.min.js' ) ),
			false
		);
		wp_script_add_data( 'wp-rig-aside', 'async', true );
		wp_script_add_data( 'wp-rig-aside', 'precache', true );
		wp_localize_script(
			'wp-rig-aside',
			'wpRigScreenReaderText',
			[
				'expand'   => __( 'Expand child menu', 'wp-rig' ),
				'collapse' => __( 'Collapse child menu', 'wp-rig' ),
			]
		);
	}

	/**
	 * Displays the aside aside menu.
	 *
	 * @param array $args Optional. Array of arguments. See `wp_nav_menu()` documentation for a list of supported
	 *                    arguments.
	 */
	public function display_aside_nav_menu( array $args = [] ) {
		if ( ! isset( $args['container'] ) ) {
			$args['container'] = 'ul';
		}

		$args['theme_location'] = static::ASIDE_NAV_MENU_SLUG;

		wp_nav_menu( $args );
	}
}
