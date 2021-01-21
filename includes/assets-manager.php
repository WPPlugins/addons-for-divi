<?php

namespace Brain_Addons_Divi\Includes;

defined( 'ABSPATH' ) || die();

class AssetsManager {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	public function enqueue_scripts() {

		wp_enqueue_style(
			'ba-module-core',
			BRAIN_ADDONS_PLUGIN_ASSETS . 'css/core.css',
			null,
			BRAIN_ADDONS_PLUGIN_VERSION
		);

		wp_enqueue_style(
			'ba-module-plugins',
			BRAIN_ADDONS_PLUGIN_ASSETS . 'vendor/tippy.css',
			null,
			BRAIN_ADDONS_PLUGIN_VERSION
		);

		wp_enqueue_style(
			'ba-slick',
			BRAIN_ADDONS_PLUGIN_ASSETS . 'vendor/slick/slick.css',
			null,
			BRAIN_ADDONS_PLUGIN_VERSION
		);

		wp_enqueue_style(
			'ba-slick-theme',
			BRAIN_ADDONS_PLUGIN_ASSETS . 'vendor/slick/slick-theme.css',
			null,
			BRAIN_ADDONS_PLUGIN_VERSION
		);

		wp_enqueue_script(
			'ba-popper',
			BRAIN_ADDONS_PLUGIN_ASSETS . 'vendor/popper.js',
			array( 'jquery' ),
			BRAIN_ADDONS_PLUGIN_VERSION,
			true
		);

		wp_enqueue_script(
			'ba-tippy',
			BRAIN_ADDONS_PLUGIN_ASSETS . 'vendor/tippy.js',
			array( 'jquery' ),
			BRAIN_ADDONS_PLUGIN_VERSION,
			true
		);

		wp_enqueue_script(
			'ba-slick',
			BRAIN_ADDONS_PLUGIN_ASSETS . 'vendor/slick/slick.min.js',
			array( 'jquery' ),
			BRAIN_ADDONS_PLUGIN_VERSION,
			true
		);

		wp_enqueue_script(
			'ba-event-move',
			BRAIN_ADDONS_PLUGIN_ASSETS . 'vendor/event_move.js',
			array( 'jquery' ),
			BRAIN_ADDONS_PLUGIN_VERSION,
			true
		);

		wp_enqueue_script(
			'ba-twentytwenty',
			BRAIN_ADDONS_PLUGIN_ASSETS . 'vendor/twentytwenty.js',
			array( 'jquery' ),
			BRAIN_ADDONS_PLUGIN_VERSION,
			true
		);

		wp_enqueue_script(
			'ba-main-js',
			BRAIN_ADDONS_PLUGIN_ASSETS . 'js/main.js',
			array( 'jquery' ),
			BRAIN_ADDONS_PLUGIN_VERSION,
			true
		);

		wp_localize_script(
			'ba-main-js',
			'ba_plugin',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			)
		);

	}
}
