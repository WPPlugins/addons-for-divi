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
		add_action( 'ba_save_admin_data', array( __CLASS__, 'save_extensions_data' ) );
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

		$prefix = defined( 'BA_DEBUG' ) && true === constant( 'BA_DEBUG' ) ? '' : '.min';

		wp_enqueue_style(
			'ba-admin',
			BRAIN_ADDONS_PLUGIN_ASSETS . 'admin/css/admin' . $prefix . '.css',
			array(),
			BRAIN_ADDONS_PLUGIN_VERSION,
			'all'
		);

		wp_enqueue_style(
			'google-nunito-font',
			BRAIN_ADDONS_PLUGIN_ASSETS . 'fonts/nunito/stylesheet.min.css'
		);

		wp_enqueue_script(
			'ba-admin-js',
			BRAIN_ADDONS_PLUGIN_ASSETS . 'admin/js/admin' . $prefix . '.js',
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
		$data        = array();

		parse_str( $posted_data, $data );
		do_action( 'ba_save_admin_data', $data );
		wp_send_json_success();

	}

	public static function save_modules_data( $data ) {
		$modules          = ! empty( $data['modules'] ) ? $data['modules'] : array();
		$inactive_modules = array_values( array_diff( array_keys( self::get_modules() ), $modules ) );
		self::save_inactive_modules( $inactive_modules );
	}

	public static function get_inactive_modules() {
		return get_option( 'ba_inactive_modules', array() );
	}

	public static function save_inactive_modules( $modules = array() ) {
		update_option( 'ba_inactive_modules', $modules );
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
		$extensions          = ! empty( $data['extensions'] ) ? $data['extensions'] : array();
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
			'blog-designer'           => array(
				'title'       => __( 'Blog Designer', 'brain-divi-addons' ),
				'desc'        => __( 'Blog Designer is a good handy and premium solution for everyone who is looking for a responsive blog page with the divi website.', 'brain-divi-addons' ),
				'link_enable' => true,
				'is_pro'      => true,
				'section'     => 'blog_designer_archive__section',
			),

			'popup-maker'             => array(
				'title'       => __( 'Popup Maker', 'brain-divi-addons' ),
				'desc'        => __( 'It is incredibly versatile & flexible. Bend it to create any type of popup, modal, or content overlay for your website.', 'brain-divi-addons' ),
				'link_enable' => false,
				'is_pro'      => false,
				'section'     => '',
			),

			'login-designer'          => array(
				'title'   => __( 'Login Designer', 'brain-divi-addons' ),
				'desc'    => __( 'Design and build an on-brand custom WordPress login page.', 'brain-divi-addons' ),
				'demo'    => '',
				'icon'    => '',
				'is_pro'  => false,
				'is_free' => true,
			),

			'unfiltered-file-uploads' => array(
				'title'   => __( 'Unfiltered File Uploads', 'brain-divi-addons' ),
				'desc'    => __( 'Please note! Allowing uploads SVG & JSON files is a potential security risk. We recommend you only enable this feature if you understand the security risks involved.' ),
				'demo'    => '',
				'icon'    => '',
				'is_pro'  => false,
				'is_free' => true,
			),

			'library-shortcodes'      => array(
				'title'   => __( 'Divi Library Shortcodes', 'brain-divi-addons' ),
				'desc'    => __( 'This extension allows you to display any Divi library template as a shortcode. Embed any Divi library template inside any divi module or inside a .php files by using a shortcode.' ),
				'demo'    => '',
				'icon'    => '',
				'is_pro'  => false,
				'is_free' => true,
			),

		);

		return $extensions_map;
	}

	private static function get_free_modules() {

		$modules_map = array(

			'advanced-divider'      => array(
				'title' => __( 'Advanced Divider', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/advanced-divider/',
				'icon'  => 'advanced_divider',
			),

			'card'                  => array(
				'title' => __( 'Card', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/card/',
				'icon'  => 'card',
			),

			'cf7-module'            => array(
				'title' => __( 'CF7 Styler', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/cf7-styler/',
				'icon'  => 'cf7_styler',
			),

			'twitter-feed'          => array(
				'title' => __( 'Twitter Feed', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/twitter-feed',
				'icon'  => 'twitter_feed',
			),

			'icon-box'              => array(
				'title' => __( 'Icon Box', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/icon-box',
				'icon'  => 'icon_box',
			),

			'logo-grid'             => array(
				'title' => __( 'Logo Grid', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/logo-grid',
				'icon'  => 'logo_grid',
			),

			'image-compare'         => array(
				'title' => __( 'Image Compare', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/image-compare',
				'icon'  => 'image_compare',
			),

			'advanced-team'         => array(
				'title'  => __( 'Advanced Team', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/team',
				'icon'   => 'team',
				'is_pro' => false,
			),

			'skill-bars'            => array(
				'title' => __( 'Skill Bars', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/skill-bars',
				'icon'  => 'skill_bars',
			),

			'dual-button'           => array(
				'title' => __( 'Dual Button', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/dual-button',
				'icon'  => 'dual_button',
			),

			'video-popup'           => array(
				'title' => __( 'Video Popup', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/video-popup',
				'icon'  => 'video_popup',
			),

			'testimonial'           => array(
				'title' => __( 'Testimonial', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/testimonial',
				'icon'  => 'testimonial',
			),

			'info-box'              => array(
				'title' => __( 'Info Box', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/info-box',
				'icon'  => 'info_box',
			),

			'number'                => array(
				'title' => __( 'Number', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/number',
				'icon'  => 'number',
			),

			'scroll-image'          => array(
				'title' => __( 'Scroll Image', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/scroll-image',
				'icon'  => 'scroll_image',
			),

			'review'                => array(
				'title' => __( 'Review', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/review',
				'icon'  => 'review',
			),

			'flipbox'               => array(
				'title'  => __( 'Flipbox', 'brain-divi-addons' ),
				'demo'   => ba_has_pro() ? 'https://divi.brainaddons.com/flip-box-pro/' : 'https://divi.brainaddons.com/flip-box/',
				'icon'   => 'flipbox',
				'is_pro' => ba_has_pro() ? true : false,
			),

			'news-ticker'           => array(
				'title' => __( 'News Ticker', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/news-ticker',
				'icon'  => 'news_ticker',
			),

			'post-list'             => array(
				'title' => __( 'Post List', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/post-list',
				'icon'  => 'post_list',
			),

			'twitter-feed-carousel' => array(
				'title' => __( 'Twitter Feed Carousel', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/twitter-feed-carousel',
				'icon'  => 'twitter_feed_carousel',
			),

			'image-carousel'        => array(
				'title' => __( 'Image Carousel', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/image-carousel',
				'icon'  => 'image_carousel',
			),

			'logo-carousel'         => array(
				'title' => __( 'Logo Carousel', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/logo-carousel',
				'icon'  => 'logo_carousel',
			),

			'review'                => array(
				'title' => __( 'Review', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/review',
				'icon'  => 'review',
			),

			'flipbox'               => array(
				'title'  => __( 'Flipbox', 'brain-divi-addons' ),
				'demo'   => ba_has_pro() ? 'https://divi.brainaddons.com/flipbox-pro' : 'https://divi.brainaddons.com/flipbox',
				'icon'   => 'flipbox',
				'is_pro' => ba_has_pro() ? true : false,
			),

			'animated-text'         => array(
				'title' => __( 'Animated Text', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/animated-text',
				'icon'  => 'animated_text',
			),

			'business-hour'         => array(
				'title' => __( 'Business Hour', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/business-hour',
				'icon'  => 'business_hour',
			),

			'gradient-heading'      => array(
				'title' => __( 'Gradient Heading', 'brain-divi-addons' ),
				'demo'  => 'https://divi.brainaddons.com/gradient-heading',
				'icon'  => 'advanced_heading',
			),

		);

		return $modules_map;
	}

	private static function get_pro_modules() {

		$modules_map = array(
			'advanced-heading'     => array(
				'title'  => __( 'Advanced Heading', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/advanced-heading/advanced-heading',
				'icon'   => 'advanced_heading',
				'is_pro' => true,
			),
			'hover-box'            => array(
				'title'  => __( 'Hover Box', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/hover-box',
				'icon'   => 'hover_box',
				'is_pro' => true,
			),
			'image-masking'        => array(
				'title'  => __( 'Image Masking', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/image-masking',
				'icon'   => 'image_masking',
				'is_pro' => true,
			),
			'list-group'           => array(
				'title'  => __( 'List Group', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/list-group',
				'icon'   => 'list_group',
				'is_pro' => true,
			),
			'price-menu'           => array(
				'title'  => __( 'Price Menu', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/price-menu',
				'icon'   => 'price_menu',
				'is_pro' => true,
			),
			'vertical-timeline'    => array(
				'title'  => __( 'Vertical Timeline', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/vertical-timeline/',
				'icon'   => 'vertical_timeline',
				'is_pro' => true,
			),
			'horizontal-timeline'  => array(
				'title'  => __( 'Horizontal Timeline', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/horizontal-timeline/',
				'icon'   => 'horizontal_timeline',
				'is_pro' => true,
			),
			'image-accordion'      => array(
				'title'  => __( 'Image Accordion', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/image-accordion',
				'icon'   => 'image_accordion',
				'is_pro' => true,
			),
			'image-magnifier'      => array(
				'title'  => __( 'Image Magnifier', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/image-magnifier',
				'icon'   => 'image_magnifier',
				'is_pro' => true,
			),
			'hotspots'             => array(
				'title'  => __( 'Hotspots', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/hotspots',
				'icon'   => 'hotspots',
				'is_pro' => true,
			),
			'floating-image'       => array(
				'title'  => __( 'Floating Image', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/floating-image',
				'icon'   => 'floating_image',
				'is_pro' => true,
			),
			'instagram-feed'       => array(
				'title'  => __( 'Instagram Feed', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/instagram-feed',
				'icon'   => 'instagram_feed',
				'is_pro' => true,
			),
			'inline-svg'           => array(
				'title'  => __( 'Inline SVG', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/inline-svg',
				'icon'   => 'inline_svg',
				'is_pro' => true,
			),
			'lottie-animation'     => array(
				'title'  => __( 'Lottie Animation', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/lottie-animation',
				'icon'   => 'lottie',
				'is_pro' => true,
			),
			'content-toggle'       => array(
				'title'  => __( 'Content Toggle', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/content-toggle',
				'icon'   => 'content_toggle',
				'is_pro' => true,
			),
			'testimonial-carousel' => array(
				'title'  => __( 'Testimonial Carousel', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/testimonial-carousel',
				'icon'   => 'testimonial_carousel',
				'is_pro' => true,
			),
			'team-carousel'        => array(
				'title'  => __( 'Team Carousel', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/team-carousel',
				'icon'   => 'team_carousel',
				'is_pro' => true,
			),
			'post-grid'            => array(
				'title'  => __( 'Post Grid', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/post-grid/',
				'icon'   => 'post_grid',
				'is_pro' => true,
			),
			'post-tiles'           => array(
				'title'  => __( 'Post Tiles', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/post-tiles/',
				'icon'   => 'post_tiles',
				'is_pro' => true,
			),
			'post-carousel'        => array(
				'title'  => __( 'Post Carousel', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/post-carousel/',
				'icon'   => 'post_carousel',
				'is_pro' => true,
			),
			'post-masonry'         => array(
				'title'  => __( 'Post Masonry', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/post-masonry/',
				'icon'   => 'post_masonry',
				'is_pro' => true,
			),
			'smart-post-list'      => array(
				'title'  => __( 'Smart Post List', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/smart-post',
				'icon'   => 'smart_post_list',
				'is_pro' => true,
			),
			'news-ticker-pro'      => array(
				'title'  => __( 'News Ticker Pro', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/new-ticker-pro/',
				'icon'   => 'news_ticker',
				'is_pro' => true,
			),
			'author-list'          => array(
				'title'  => __( 'Author List', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/author-list/',
				'icon'   => 'author_list',
				'is_pro' => true,
			),
			'instagram-carousel'   => array(
				'title'  => __( 'Instagram Carousel', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/instagram-carousel',
				'icon'   => 'instagram_carousel',
				'is_pro' => true,
			),
			'social-share'         => array(
				'title'  => __( 'Social Share', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/social-share',
				'icon'   => 'social_share',
				'is_pro' => true,
			),
			'image-hover'          => array(
				'title'  => __( 'Image Hover', 'brain-divi-addons' ),
				'demo'   => 'https://divi.brainaddons.com/image-hover',
				'icon'   => 'hover_box',
				'is_pro' => true,
			),
		);

		return $modules_map;
	}

	public static function get_extensions() {

		$extensions_map = self::get_all_extensions();
		return $extensions_map;
	}

	public static function get_tabs() {

		$icon_url = BRAIN_ADDONS_PLUGIN_ASSETS . 'imgs/admin/';

		$tabs = array(
			'home'       => array(
				'title'    => esc_html__( 'General', 'brain-divi-addons' ),
				'icon'     => $icon_url . 'general.svg',
				'renderer' => array( __CLASS__, 'render_home' ),
			),

			'modules'    => array(
				'title'    => esc_html__( 'Modules', 'brain-divi-addons' ),
				'icon'     => $icon_url . 'modules.svg',
				'renderer' => array( __CLASS__, 'render_modules' ),
			),

			'extensions' => array(
				'title'    => esc_html__( 'Extension', 'brain-divi-addons' ),
				'icon'     => $icon_url . 'extensions.svg',
				'renderer' => array( __CLASS__, 'render_extensions' ),
			),

			'pro'        => array(
				'title'    => esc_html__( 'Get Pro', 'brain-divi-addons' ),
				'icon'     => $icon_url . 'get-pro.svg',
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
