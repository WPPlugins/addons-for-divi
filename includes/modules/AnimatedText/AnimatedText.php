<?php
class BA_Animated_Text extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/demo/animated-text/',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {

		$this->slug       = 'ba_animated_text';
		$this->vb_support = 'on';
		$this->name       = esc_html__( 'Brain Animated Text', 'brain-divi-addons' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'animated-text.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content'  => esc_html__( 'Content', 'brain-divi-addons' ),
					'settings' => esc_html__( 'Settings', 'brain-divi-addons' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'general' => esc_html__( 'General', 'brain-divi-addons' ),
					'texts'   => esc_html__( 'Text', 'brain-divi-addons' ),
				),
			),

		);
	}

	public function get_fields() {

		$content = array(
			'animated_text' => array(
				'label'       => esc_html__( 'Animated Text', 'brain-divi-addons' ),
				'type'        => 'textarea',
				'default'     => esc_html__( 'Text 1 | Text 2', 'brain-divi-addons' ),
				'toggle_slug' => 'main_content',
			),
		);

		$settings = array(
			'animation_type'  => array(
				'label'       => esc_html__( 'Select Animation', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'typed',
				'options'     => array(
					'typed' => esc_html__( 'Typing Text', 'brain-divi-addons' ),
				),
			),
			'animation_speed' => array(
				'label'          => esc_html__( 'Animation Speed', 'brain-divi-addons' ),
				'type'           => 'range',
				'fixed_unit'     => 'ms',
				'default'        => '0ms',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'    => 'settings',
			),
			'start_delay'     => array(
				'label'          => esc_html__( 'Start Delay', 'brain-divi-addons' ),
				'type'           => 'range',
				'fixed_unit'     => 'ms',
				'default'        => '300ms',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'    => 'settings',
			),
			'back_speed'      => array(
				'label'          => esc_html__( 'Type Back Speed', 'brain-divi-addons' ),
				'type'           => 'range',
				'fixed_unit'     => 'ms',
				'default'        => '0ms',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'    => 'settings',
			),
			'back_delay'      => array(
				'label'          => esc_html__( 'Type Back Delay', 'brain-divi-addons' ),
				'type'           => 'range',
				'fixed_unit'     => 'ms',
				'default'        => '500ms',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'    => 'settings',
			),
			'use_loop'        => array(
				'label'           => esc_html__( 'Animation Loop', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'on',
				'toggle_slug'     => 'settings',
			),
			'show_cursor'     => array(
				'label'           => esc_html__( 'Show Cursor', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'on',
				'toggle_slug'     => 'settings',
			),
			'cursor_text'     => array(
				'label'       => esc_html__( 'Cursor Symbol', 'brain-divi-addons' ),
				'type'        => 'textarea',
				'default'     => esc_html__( '|', 'brain-divi-addons' ),
				'toggle_slug' => 'settings',
				'show_if'     => array(
					'show_cursor' => 'on',
				),
			),
		);

		$general = array(
			'text_alignment' => array(
				'label'           => esc_html__( 'Text Alignment', 'brain-divi-addons' ),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'    => 'text_align',
				'default'         => 'left',
				'mobile_options'  => true,
				'toggle_slug'     => 'general',
				'tab_slug'        => 'advanced',
			),
		);

		return array_merge( $content, $settings, $general );
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['fonts']['animated'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .ba-animated-text-head',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'texts',
			'header_level'    => array(
				'default' => 'h3',
			),
			'font_size'       => array(
				'default' => '22px',
			),
		);

		return $advanced_fields;
	}

	public function render( $attrs, $content = null, $render_slug ) {

		wp_enqueue_script( 'baj-typed' );
		$this->apply_css( $render_slug );

		$animated_level = et_pb_process_header_level( $this->props['animated_level'], 'h3' );
		$animated_level = esc_html( $animated_level );
		$order_class    = self::get_module_order_class( $render_slug );
		$order_number   = str_replace( '_', '', str_replace( $this->slug, '', $order_class ) );

		$settings['strings']    = explode( '|', $this->props['animated_text'] );
		$settings['cursorChar'] = $this->props['cursor_text'];
		$settings['showCursor'] = 'on' === $this->props['show_cursor'] ? true : false;
		$settings['loop']       = 'on' === $this->props['use_loop'] ? true : false;
		$settings['typeSpeed']  = intval( $this->props['animation_speed'] );
		$settings['startDelay'] = intval( $this->props['start_delay'] );
		$settings['backSpeed']  = intval( $this->props['back_speed'] );
		$settings['backDelay']  = intval( $this->props['back_delay'] );

		$data_settings = sprintf( 'data-settings="%1$s"', htmlspecialchars( wp_json_encode( $settings ), ENT_QUOTES, 'UTF-8' ) );

		return sprintf(
			'<div id="ba-animated-text-%3$s" class="ba-module ba-animated-text ba-front" %2$s>
				<%1$s class="ba-animated-text-head"><span class="ba-typed-text"></span></%1$s>
			</div>',
			$animated_level,
			$data_settings,
			$order_number
		);
	}

	public function apply_css( $render_slug ) {
		$this->get_responsive_styles(
			'text_alignment',
			'%%order_class%%',
			array( 'primary' => 'text-align' ),
			array( 'default' => 'left' ),
			$render_slug
		);
	}
}

new BA_Animated_Text();
