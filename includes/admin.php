<?php

namespace Brain_Addons_Divi\Includes;

defined( 'ABSPATH' ) || die();

class Admin {

	const MODULES_NONCE = 'ba_save_admin';

	public function __construct() {
		add_action( 'admin_menu', array( __CLASS__, 'add_menu' ), 21 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ), 21 );
		add_action( 'wp_ajax_' . self::MODULES_NONCE, array( __CLASS__, 'save_data' ) );
		add_action( 'ba_save_admin_data', array( __CLASS__, 'save_modules_data' ) );
	}

	public static function add_menu() {
		add_menu_page(
			__( 'BrianAddons', 'brain-divi-addons' ),
			__( 'BrainAddons', 'brain-divi-addons' ),
			'manage_options',
			'addons-for-divi',
			array( __CLASS__, 'render_main' ),
			ba_get_b64_icon(),
			110
		);
	}

	public static function enqueue_scripts() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		wp_enqueue_style(
			'ba-admin',
			BRAIN_ADDONS_PLUGIN_ASSETS . 'admin/css/admin.css'
		);

		wp_enqueue_style(
			'google-nunito-font',
			BRAIN_ADDONS_PLUGIN_ASSETS . 'fonts/nunito/stylesheet.css'
		);

		wp_enqueue_script(
			'ba-admin-js',
			BRAIN_ADDONS_PLUGIN_ASSETS . 'admin/js/admin.js',
			array( 'jquery' ),
			BRAIN_ADDONS_PLUGIN_VERSION,
			true
		);

		wp_localize_script(
			'ba-admin-js',
			'BA_PLUGIN',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( self::MODULES_NONCE ),
				'action'  => self::MODULES_NONCE,
			)
		);
	}

	public static function save_data() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( ! check_ajax_referer( self::MODULES_NONCE, 'nonce' ) ) {
			wp_send_json_error();
		}

		$posted_data = ! empty( $_POST['data'] ) ? $_POST['data'] : '';

		$data = array();

		parse_str( $posted_data, $data );

		do_action( 'ba_save_admin_data', $data );

		wp_send_json_success();

	}

	public static function save_modules_data( $data ) {

		$modules = ! empty( $data['modules'] ) ? $data['modules'] : array();

		$inactive_modules = array_values( array_diff( array_keys( self::get_modules() ), $modules ) );

		self::save_inactive_modules( $inactive_modules );
	}

	public static function get_inactive_modules() {
		return get_option( 'ba_inactive_modules', array() );
	}

	public static function save_inactive_modules( $modules = array() ) {
		update_option( 'ba_inactive_modules', $modules );
	}

	private static function get_free_modules() {

		$modules_map = array(

			'advanced-divider'      => array(
				'title' => __( 'Advanced Divider', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/advanced-divider/',
				'icon'  => '',
			),

			'card'                  => array(
				'title' => __( 'Card', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/card/',
				'icon'  => '',
			),

			'cf7-module'            => array(
				'title' => __( 'CF7 Styler', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/cf7-styler/',
				'icon'  => '',
			),

			'twitter-feed'          => array(
				'title' => __( 'Twitter Feed', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/twitter-feed',
				'icon'  => '',
			),

			'icon-box'              => array(
				'title' => __( 'Icon Box', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/icon-box',
				'icon'  => '',
			),

			'logo-grid'             => array(
				'title' => __( 'Logo Grid', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/logo-grid',
				'icon'  => '',
			),

			'image-compare'         => array(
				'title' => __( 'Image Compare', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/image-compare',
				'icon'  => '',
			),

			'advanced-team'         => array(
				'title'  => __( 'Advanced Team', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/team',
				'icon'   => '',
				'is_pro' => false,
			),

			'skill-bars'            => array(
				'title' => __( 'Skill Bars', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/skill-bars',
				'icon'  => '',
			),

			'dual-button'           => array(
				'title' => __( 'Dual Button', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/dual-button',
				'icon'  => '',
			),

			'video-popup'           => array(
				'title' => __( 'Video Popup', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/video-popup',
				'icon'  => '',
			),

			'testimonial'           => array(
				'title' => __( 'Testimonial', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/testimonial',
				'icon'  => '',
			),

			'info-box'              => array(
				'title' => __( 'Info Box', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/info-box',
				'icon'  => '',
			),

			'number'                => array(
				'title' => __( 'Number', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/number',
				'icon'  => '',
			),

			'scroll-image'          => array(
				'title' => __( 'Scroll Image', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/scroll-image',
				'icon'  => '',
			),

			'news-ticker'           => array(
				'title' => __( 'News Ticker', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/news-ticker',
				'icon'  => '',
			),

			'post-list'             => array(
				'title' => __( 'Post List', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/post-list',
				'icon'  => '',
			),

			'twitter-feed-carousel' => array(
				'title' => __( 'Twitter Feed Carousel', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/twitter-feed-carousel',
				'icon'  => '',
			),

			'image-carousel'        => array(
				'title' => __( 'Image Carousel', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/image-carousel',
				'icon'  => '',
			),

			'logo-carousel'         => array(
				'title' => __( 'Logo Carousel', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/logo-carousel',
				'icon'  => '',
			),

			'review'                => array(
				'title' => __( 'Review', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/demo/review',
				'icon'  => '',
			),

		);

		return $modules_map;
	}

	private static function get_pro_modules() {

		$modules_map = array(
			'advanced-heading'     => array(
				'title'  => __( 'Advanced Heading', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/advanced-heading/advanced-heading',
				'icon'   => '',
				'is_pro' => true,
			),
			'testimonial-carousel' => array(
				'title'  => __( 'Testimonial Carousel', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/testimonial-carousel',
				'icon'   => '',
				'is_pro' => true,
			),
			'team-carousel'        => array(
				'title'  => __( 'Team Carousel', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/team-carousel',
				'icon'   => '',
				'is_pro' => true,
			),
			'hover-box'            => array(
				'title'  => __( 'Hover Box', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/hover-box',
				'icon'   => '',
				'is_pro' => true,
			),
			'image-masking'        => array(
				'title'  => __( 'Image Masking', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/image-masking',
				'icon'   => '',
				'is_pro' => true,
			),
			'list-group'           => array(
				'title'  => __( 'List Group', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/list-group',
				'icon'   => '',
				'is_pro' => true,
			),
			'price-menu'           => array(
				'title'  => __( 'Price Menu', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/price-menu',
				'icon'   => '',
				'is_pro' => true,
			),
			'post-grid'            => array(
				'title'  => __( 'Post Grid', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/post-grid/',
				'icon'   => '',
				'is_pro' => true,
			),
			'post-tiles'           => array(
				'title'  => __( 'Post Tiles', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/post-tiles/',
				'icon'   => '',
				'is_pro' => true,
			),
			'post-carousel'        => array(
				'title'  => __( 'Post Carousel', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/post-carousel/',
				'icon'   => '',
				'is_pro' => true,
			),
			'post-masonry'         => array(
				'title'  => __( 'Post Masonry', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/post-masonry/',
				'icon'   => '',
				'is_pro' => true,
			),
			'vertical-timeline'    => array(
				'title'  => __( 'Vertical Timeline', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/vertical-timeline/',
				'icon'   => '',
				'is_pro' => true,
			),
			'news-ticker-pro'      => array(
				'title'  => __( 'News Ticker Pro', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/new-ticker-pro/',
				'icon'   => '',
				'is_pro' => true,
			),
			'author-list'          => array(
				'title'  => __( 'Author List', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/author-list/',
				'icon'   => '',
				'is_pro' => true,
			),
			'horizontal-timeline'  => array(
				'title'  => __( 'Horizontal Timeline', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/horizontal-timeline/',
				'icon'   => '',
				'is_pro' => true,
			),
			'vertical-timeline'    => array(
				'title'  => __( 'Vertical Timeline', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/vertical-timeline/',
				'icon'   => '',
				'is_pro' => true,
			),
			'smart-post-list'      => array(
				'title'  => __( 'Smart Post List', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/demo/smart-post',
				'icon'   => '',
				'is_pro' => true,
			),
		);

		return $modules_map;
	}

	public static function get_modules() {

		$modules_map = self::get_free_modules();
		$modules_map = array_merge( $modules_map, self::get_pro_modules() );
		uksort( $modules_map, array( __CLASS__, 'sort_widgets' ) );

		return $modules_map;
	}


	public static function sort_widgets( $k1, $k2 ) {
		return strcasecmp( $k1, $k2 );
	}

	public static function save_extensions_data( $data ) {

		$extensions = ! empty( $data['extensions'] ) ? $data['extensions'] : array();

		$inactive_extensions = array_values( array_diff( array_keys( self::get_all_extensions() ), $extensions ) );

		self::save_inactive_extensions( $inactive_extensions );
	}

	public static function get_inactive_extensions() {

		return get_option( 'ba_inactive_extensions', array() );
	}

	public static function save_inactive_extensions( $extensions = array() ) {

		update_option( 'ba_inactive_extensions', $extensions );
	}

	private static function get_all_extensions() {

		$extensions_map = array(

			// 'mega-menu'               => array(
			// 'title'   => __( 'Mega Menu', 'brain-divi-addons' ),
			// 'desc'    => __( '', 'brain-divi-addons' ),
			// 'demo'    => '',
			// 'icon'    => '',
			// 'is_pro'  => false,
			// 'is_free' => false,
			// ),

			// 'popup-builder'           => array(
			// 'title'   => __( 'Popup Builder', 'brain-divi-addons' ),
			// 'desc'    => __( '', 'brain-divi-addons' ),
			// 'demo'    => '',
			// 'icon'    => '',
			// 'is_pro'  => false,
			// 'is_free' => false,
			// ),

			// 'display-condition'       => array(
			// 'title'   => __( 'Display Condition', 'brain-divi-addons' ),
			// 'desc'    => __( '', 'brain-divi-addons' ),
			// 'demo'    => '',
			// 'icon'    => '',
			// 'is_pro'  => false,
			// 'is_free' => false,
			// ),

			// 'white-label'             => array(
			// 'title'   => __( 'White Label', 'brain-divi-addons' ),
			// 'desc'    => __( '', 'brain-divi-addons' ),
			// 'demo'    => '',
			// 'icon'    => '',
			// 'is_pro'  => false,
			// 'is_free' => false,
			// ),

			'login-designer'          => array(
				'title'   => __( 'Login Designer', 'brain-divi-addons' ),
				'desc'    => __( '', 'brain-divi-addons' ),
				'demo'    => '',
				'icon'    => '',
				'is_pro'  => false,
				'is_free' => false,
			),

			'unfiltered_file_uploads' => array(
				'title'   => __( 'Unfiltered File Uploads', 'brain-divi-addons' ),
				'desc'    => __( '' ),
				'demo'    => '',
				'icon'    => '',
				'is_pro'  => false,
				'is_free' => false,
			),

			'image-resizer'           => array(
				'title'   => __( 'Custom Image Size', 'brain-divi-addons' ),
				'desc'    => __( '', 'brain-divi-addons' ),
				'demo'    => '',
				'is_pro'  => false,
				'is_free' => false,
			),

			'font-awesome'            => array(
				'title'   => __( 'Font Awesome Support', 'brain-divi-addons' ),
				'desc'    => __( '', 'brain-divi-addons' ),
				'demo'    => '',
				'is_pro'  => false,
				'is_free' => false,
			),

		);

		return $extensions_map;
	}

	public static function get_extensions() {

		$extensions_map = self::get_all_extensions();
		return $extensions_map;
	}

	public static function get_tabs() {

		$icon_url = BRAIN_ADDONS_PLUGIN_ASSETS . 'imgs/admin/';

		$tabs = array(

			'home'       => array(
				'title'    => esc_html__( 'Home', 'brain-divi-addons' ),
				'icon'     => '',
				'renderer' => array( __CLASS__, 'render_home' ),
			),

			'modules'    => array(
				'title'    => esc_html__( 'Modules', 'brain-divi-addons' ),
				'icon'     => '',
				'renderer' => array( __CLASS__, 'render_modules' ),
			),

			'extensions' => array(
				'title'    => esc_html__( 'Extension', 'brain-divi-addons' ),
				'icon'     => '',
				'renderer' => array( __CLASS__, 'render_extensions' ),
			),

			'pro'        => array(
				'title'    => esc_html__( 'Pro', 'brain-divi-addons' ),
				'icon'     => '',
				'renderer' => array( __CLASS__, 'render_pro' ),
			),

		);

		return $tabs;
	}

	private static function load_template( $template ) {
		$file = BRAIN_ADDONS_PLUGIN_DIR . 'includes/admin/view/admin-' . $template . '.php';
		if ( is_readable( $file ) ) {
			include $file;
		}
	}

	public static function render_main() {
		self::load_template( 'main' );
	}

	public static function render_home() {
		self::load_template( 'home' );
	}

	public static function render_modules() {
		self::load_template( 'modules' );
	}

	public static function render_extensions() {
		self::load_template( 'extensions' );
	}

	public static function render_pro() {
		self::load_template( 'pro' );
	}

}
