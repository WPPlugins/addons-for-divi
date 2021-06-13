<?php
namespace BrainAddons;
/**
 * Customizer class
 */
class Customizer {

    public function __construct() {
        add_action( 'customize_register', array( $this, 'controls_helpers' ) );
        add_action( 'customize_register', array( $this, 'customize_register' ) );
        add_action( 'customize_preview_init', array( $this, 'customize_preview_init' ) );
        add_filter( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_enqueue_scripts' ) );
    }

    /**
     * Helper controls.
     *
     * @return void
     */
    public function controls_helpers() {
        require_once BRAIN_ADDONS_PLUGIN_DIR . 'includes/customizer/customizer-sanitizes.php'; // phpcs:ignore
    }

    /**
     * Customizer Register
     *
     * @param  array  $wp_customize
     * @return void
     */
    public function customize_register( $wp_customize ) {

        // Extend panel and section.
        require BRAIN_ADDONS_PLUGIN_DIR . 'includes/customizer/extend-customizer/customizer-panel.php';
        require BRAIN_ADDONS_PLUGIN_DIR . 'includes/customizer/extend-customizer/customizer-section.php';

        // Register the panel and section.
        if ( class_exists( 'BrainAddons_WP_Customize_Panel' ) ) {
            $wp_customize->register_panel_type( 'BrainAddons_WP_Customize_Panel' );
        }

        if ( class_exists( 'BrainAddons_WP_Customize_Section' ) ) {
            $wp_customize->register_section_type( 'BrainAddons_WP_Customize_Section' );
        }

        // Add custom controls.
        require_once BRAIN_ADDONS_PLUGIN_DIR . 'includes/customizer/controls/radio-image.php'; // phpcs:ignore
        require_once BRAIN_ADDONS_PLUGIN_DIR . 'includes/customizer/controls/title.php'; // phpcs:ignore
        require_once BRAIN_ADDONS_PLUGIN_DIR . 'includes/customizer/controls/toggle.php'; // phpcs:ignore
        require_once BRAIN_ADDONS_PLUGIN_DIR . 'includes/customizer/controls/range.php'; // phpcs:ignore

        // Register the control types that we're using as JavaScript controls.
        if ( class_exists( 'BrainAddons_Title_Control' ) ) {
            $wp_customize->register_control_type( 'BrainAddons_Title_Control' );
        }

        if ( class_exists( 'BrainAddons_Radio_Image' ) ) {
            $wp_customize->register_control_type( 'BrainAddons_Radio_Image' );
        }

        if ( class_exists( 'BrainAddons_Toggle_Control' ) ) {
            $wp_customize->register_control_type( 'BrainAddons_Toggle_Control' );
        }

        if ( class_exists( 'BrainAddons_Range' ) ) {
            $wp_customize->register_control_type( 'BrainAddons_Range' );
        }

        $inactive_extensions = get_option( 'ba_inactive_extensions', array() );
        $customizer_imgs     = BRAIN_ADDONS_PLUGIN_URL . '/includes/customizer/imgs/';

        if ( !in_array( 'login-designer', $inactive_extensions, true ) ) {
            $ld_defaults = Login_Designer::defaults();
            require_once BRAIN_ADDONS_PLUGIN_DIR . 'includes/customizer/options/login-designer.php'; // phpcs:ignore
        }

        if ( !in_array( 'blog-designer', $inactive_extensions, true ) && ba_has_pro() ) {
            $bd_defaults = Blog_Designer::defaults();
            require_once BRAIN_ADDONS_PLUGIN_DIR . 'includes/customizer/options/blog-designer.php'; // phpcs:ignore
        }

        $wp_customize->add_panel(
            'brainaddons_section_separator',
            array(
                'type'     => 'brainaddons-section',
                'priority' => -20,
            )
        );

    }

    public function sanitize_checkbox( $checked ) {
        return (  ( isset( $checked ) && true === $checked ) ? true : false );
    }

    public function customize_controls_enqueue_scripts() {

        $path = BRAIN_ADDONS_PLUGIN_URL . 'includes/customizer/';

        $file_prefix = ( defined( 'BA_DEBUG' ) && true === constant( 'BA_DEBUG' ) ) ? '' : '.min';

        wp_enqueue_style(
            'brainaddons-customizer',
            $path . 'css/customizer' . $file_prefix . '.css',
            false,
            BRAIN_ADDONS_PLUGIN_VERSION
        );

        wp_enqueue_style(
            'brainaddons-customizer-preview',
            $path . 'css/customizer-preview' . $file_prefix . '.css',
            false,
            BRAIN_ADDONS_PLUGIN_VERSION
        );

        wp_enqueue_script(
            'brainaddons-customizer', $path . 'js/customizer' . $file_prefix . '.js',
            array( 'jquery' ),
            null,
            true
        );

        // Localization.
        $localize = array(
            'admin_url'  => admin_url(),
            'ajax_url'   => admin_url( 'admin-ajax.php' ),
            'login_page' => get_permalink( brainaddons_login_page() ),
        );

        wp_localize_script( 'brainaddons-customizer', 'brainaddons_controls', $localize );

    }

    public function customize_preview_init() {

        if ( !is_customize_preview() ) {
            return;
        }

        $path = BRAIN_ADDONS_PLUGIN_URL . 'includes/customizer/js/';

        $file_prefix = ( defined( 'BA_DEBUG' ) && true === constant( 'BA_DEBUG' ) ) ? '' : '.min';

        wp_enqueue_script(
            'brainaddons-customizer-preview',
            $path . 'customizer-preview' . $file_prefix . '.js',
            array( 'jquery', 'customize-preview' ),
            rand( 0, 9999 ),
            true
        );

        // Localization.
        $localize = array(
            'admin_url'  => admin_url(),
            'ajax_url'   => admin_url( 'admin-ajax.php' ),
            'login_page' => get_permalink( brainaddons_login_page() ),
        );

        wp_localize_script( 'brainaddons-customizer-preview', 'brainaddons_script', $localize );

    }

    public function get_background_choices() {

        $choices = array(
            'repeat'   => array(
                'no-repeat' => esc_html__( 'No Repeat', 'brain-divi-addons' ),
                'repeat'    => esc_html__( 'Tile', 'brain-divi-addons' ),
                'repeat-x'  => esc_html__( 'Tile Horizontally', 'brain-divi-addons' ),
                'repeat-y'  => esc_html__( 'Tile Vertically', 'brain-divi-addons' ),
            ),
            'size'     => array(
                'auto'    => esc_html__( 'Auto', 'brain-divi-addons' ),
                'cover'   => esc_html__( 'Cover', 'brain-divi-addons' ),
                'contain' => esc_html__( 'Contain', 'brain-divi-addons' ),
            ),
            'position' => array(
                'left top'      => esc_html__( 'Left Top', 'brain-divi-addons' ),
                'left center'   => esc_html__( 'Left Center', 'brain-divi-addons' ),
                'left bottom'   => esc_html__( 'Left Bottom', 'brain-divi-addons' ),
                'right top'     => esc_html__( 'Right Top', 'brain-divi-addons' ),
                'right center'  => esc_html__( 'Right Center', 'brain-divi-addons' ),
                'right bottom'  => esc_html__( 'Right Bottom', 'brain-divi-addons' ),
                'center top'    => esc_html__( 'Center Top', 'brain-divi-addons' ),
                'center center' => esc_html__( 'Center Center', 'brain-divi-addons' ),
                'center bottom' => esc_html__( 'Center Bottom', 'brain-divi-addons' ),
            ),
            'attach'   => array(
                'fixed'  => esc_html__( 'Fixed', 'brain-divi-addons' ),
                'scroll' => esc_html__( 'Scroll', 'brain-divi-addons' ),
            ),
        );

        return apply_filters( 'brainaddons_background_choices', $choices );
    }

    public static function fetch_svg_icon( $path = '', $base = true ) {

        $output = '<span class="brainaddons-inline-flex' . ( $base ? ' svg-baseline' : '' ) . '">';
        ob_start();
        $path = file_get_contents( $path ); //phpcs:ignore
        $output .= $path;
        $output .= json_decode( ob_get_clean(), true );
        $output .= '</span>';

        return $output;
    }

}

new Customizer();
