<?php
class BA_Dual_Button extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/demo/dual-button/',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {

		$this->name       = esc_html__( 'Brain Dual Button', 'brain-divi-addons' );
		$this->slug       = 'ba_dual_button';
		$this->vb_support = 'on';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'btns' => array(
						'title'             => esc_html__( 'Button Content', 'brain-divi-addons' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'btn_a'     => array(
								'name' => esc_html__( 'Primary', 'brain-divi-addons' ),
							),
							'connector' => array(
								'name' => esc_html__( 'Connector', 'brain-divi-addons' ),
							),
							'btn_b'     => array(
								'name' => esc_html__( 'Secondary', 'brain-divi-addons' ),
							),
						),
					),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'common'         => esc_html__( 'Common', 'brain-divi-addons' ),
					'btn_a'          => esc_html__( 'Primary Button', 'brain-divi-addons' ),
					'btn_b'          => esc_html__( 'Secondary Button', 'brain-divi-addons' ),
					'connector'      => esc_html__( 'Connector', 'brain-divi-addons' ),
					'btn_a_advanced' => array(
						'title' => esc_html__( 'Primary Button Advanced ', 'brain-divi-addons' ),
					),
					'btn_b_advanced' => array(
						'title' => esc_html__( 'Secondary Button Advanced ', 'brain-divi-addons' ),
					),
				),
			),
		);
	}

	public function get_fields() {

		$fields = array(

			'btn_alignment'          => array(
				'label'            => esc_html__( 'Button Alignment', 'brain-divi-addons' ),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'     => 'module_align',
				'default_on_front' => 'left',
				'toggle_slug'      => 'common',
				'tab_slug'         => 'advanced',
			),

			'btn_a_text'             => array(
				'label'           => esc_html__( 'Button Text', 'brain-divi-addons' ),
				'type'            => 'text',
				'default'         => 'Button 1',
				'dynamic_content' => 'text',
				'toggle_slug'     => 'btns',
				'tab_slug'        => 'general',
				'sub_toggle'      => 'btn_a',
			),

			'btn_a_link'             => array(
				'label'           => esc_html__( 'Button Link', 'brain-divi-addons' ),
				'type'            => 'text',
				'toggle_slug'     => 'btns',
				'tab_slug'        => 'general',
				'dynamic_content' => 'url',
				'sub_toggle'      => 'btn_a',
			),

			'btn_a_link_target'      => array(
				'label'       => esc_html__( 'Button Link Target', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'btns',
				'tab_slug'    => 'general',
				'sub_toggle'  => 'btn_a',
				'default'     => '_self',
				'options'     => array(
					'_self'  => esc_html__( 'Same Tab', 'brain-divi-addons' ),
					'_blank' => esc_html__( 'New Tab', 'brain-divi-addons' ),
				),
			),

			'btn_b_text'             => array(
				'label'           => esc_html__( 'Button Text', 'brain-divi-addons' ),
				'type'            => 'text',
				'default'         => 'Button 2',
				'dynamic_content' => 'text',
				'toggle_slug'     => 'btns',
				'tab_slug'        => 'general',
				'sub_toggle'      => 'btn_b',
			),

			'btn_b_link'             => array(
				'label'           => esc_html__( 'Button Link', 'brain-divi-addons' ),
				'type'            => 'text',
				'toggle_slug'     => 'btns',
				'dynamic_content' => 'url',
				'tab_slug'        => 'general',
				'sub_toggle'      => 'btn_b',
			),

			'btn_b_link_target'      => array(
				'label'       => esc_html__( 'Button Link Target', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'btns',
				'tab_slug'    => 'general',
				'sub_toggle'  => 'btn_b',
				'default'     => '_self',
				'options'     => array(
					'_self'  => esc_html__( 'Same Tab', 'brain-divi-addons' ),
					'_blank' => esc_html__( 'New Tab', 'brain-divi-addons' ),
				),
			),

			'connector_type'         => array(
				'label'       => esc_html__( 'Connector Type', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'btns',
				'tab_slug'    => 'general',
				'sub_toggle'  => 'connector',
				'default'     => 'empty',
				'options'     => array(
					'empty' => esc_html__( 'No Connector', 'brain-divi-addons' ),
					'text'  => esc_html__( 'Text', 'brain-divi-addons' ),
					'icon'  => esc_html__( 'Icon', 'brain-divi-addons' ),
				),
			),

			'connector_text'         => array(
				'label'       => esc_html__( 'Connector Text', 'brain-divi-addons' ),
				'type'        => 'text',
				'default'     => 'OR',
				'toggle_slug' => 'btns',
				'tab_slug'    => 'general',
				'sub_toggle'  => 'connector',
				'show_if'     => array(
					'connector_type' => 'text',
				),
			),

			'connector_icon'         => array(
				'label'           => esc_html__( 'Connector Icon', 'brain-divi-addons' ),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'class'           => array( 'ba-btn__connector' ),
				'toggle_slug'     => 'btns',
				'tab_slug'        => 'general',
				'sub_toggle'      => 'connector',
				'default'         => '5',
				'show_if'         => array(
					'connector_type' => 'icon',
				),
			),

			'connector_text_size'    => array(
				'label'       => esc_html__( 'Connector Text Size', 'brain-divi-addons' ),
				'type'        => 'range',
				'default'     => '14px',
				'toggle_slug' => 'connector',
				'tab_slug'    => 'advanced',
				'show_if_not' => array(
					'connector_type' => 'empty',
				),
			),

			'connector_text_color'   => array(
				'label'       => esc_html__( 'Text Color', 'brain-divi-addons' ),
				'type'        => 'color',
				'default'     => '#333',
				'toggle_slug' => 'connector',
				'tab_slug'    => 'advanced',
				'show_if_not' => array(
					'connector_type' => 'empty',
				),
			),

			'connector_bg'           => array(
				'label'       => esc_html__( 'Background', 'brain-divi-addons' ),
				'type'        => 'color',
				'default'     => 'transparent',
				'toggle_slug' => 'connector',
				'tab_slug'    => 'advanced',
				'show_if_not' => array(
					'connector_type' => 'empty',
				),
			),

			'connector_size'         => array(
				'label'       => esc_html__( 'Connector Size', 'brain-divi-addons' ),
				'type'        => 'range',
				'default'     => '30px',
				'toggle_slug' => 'connector',
				'tab_slug'    => 'advanced',
				'show_if_not' => array(
					'connector_type' => 'empty',
				),
			),

			'connector_radius'       => array(
				'label'       => esc_html__( 'Connector Radius', 'brain-divi-addons' ),
				'type'        => 'range',
				'default'     => '0px',
				'toggle_slug' => 'connector',
				'tab_slug'    => 'advanced',
				'show_if_not' => array(
					'connector_type' => 'empty',
				),
			),

			'connector_border_width' => array(
				'label'       => esc_html__( 'Connector Border Width', 'brain-divi-addons' ),
				'type'        => 'range',
				'default'     => '0px',
				'toggle_slug' => 'connector',
				'tab_slug'    => 'advanced',
				'show_if_not' => array(
					'connector_type' => 'empty',
				),
			),

			'connector_border_color' => array(
				'label'       => esc_html__( 'Connector Border Color', 'brain-divi-addons' ),
				'type'        => 'color',
				'default'     => 'transparent',
				'toggle_slug' => 'connector',
				'tab_slug'    => 'advanced',
				'show_if_not' => array(
					'connector_type' => 'empty',
				),
			),

			'button_gap'             => array(
				'label'          => esc_html__( 'Button Gap', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '40px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 250,
					'step' => 1,
				),
				'toggle_slug'    => 'common',
				'tab_slug'       => 'advanced',
			),

			'btn_a_radius'           => array(
				'label'       => esc_html__( 'Advanced Border Radius', 'brain-divi-addons' ),
				'type'        => 'border-radius',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'btn_a_advanced',
			),

			'btn_b_radius'           => array(
				'label'       => esc_html__( 'Advanced Border Radius', 'brain-divi-addons' ),
				'type'        => 'border-radius',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'btn_b_advanced',
			),

		);

		return $fields;
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['button']['btn_a'] = array(
			'label'         => esc_html__( 'Primary Button', 'brain-divi-addons' ),
			'css'           => array(
				'main'      => '%%order_class%% .btn-el--primary',
				'important' => 'all',
			),
			'use_alignment' => false,
			'box_shadow'    => false,
		);

		$advanced_fields['button']['btn_b'] = array(
			'label'         => esc_html__( 'Secondary Button', 'brain-divi-addons' ),
			'css'           => array(
				'main'      => '%%order_class%% .btn-el--secondary',
				'important' => 'all',
			),
			'use_alignment' => false,
			'box_shadow'    => false,
		);

		$advanced_fields['box_shadow']['btn_a'] = array(
			'label'       => esc_html__( 'Box Shadow', 'brain-divi-addons' ),
			'css'         => array(
				'main'      => '%%order_class%% .btn-el--primary',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'btn_a_advanced',
		);

		$advanced_fields['box_shadow']['btn_b'] = array(
			'label'       => esc_html__( 'Box Shadow', 'brain-divi-addons' ),
			'css'         => array(
				'main'      => '%%order_class%% .btn-el--secondary',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'btn_b_advanced',
		);

		return $advanced_fields;
	}

	public function render_button_a() {

		$button_custom = $this->props['custom_btn_a'];
		$button_text   = isset( $this->props['btn_a_text'] ) ? $this->props['btn_a_text'] : 'Button 1';
		$button_link   = isset( $this->props['btn_a_link'] ) ? $this->props['btn_a_link'] : '#';
		$button_url    = trim( $button_link );
		$new_tab       = '_blank' === $this->props['btn_a_link_target'] ? 'on' : 'off';
		$button_rel    = $this->props['btn_a_rel'];
		$button_icon   = ! empty( $this->props['btn_a_icon'] ) ? $this->props['btn_a_icon'] : '5';

		$button_output = $this->render_button(
			array(
				'button_classname' => array( 'btn-el', 'btn-el--primary' ),
				'button_custom'    => $button_custom,
				'button_rel'       => $button_rel,
				'button_text'      => $button_text,
				'button_url'       => $button_url,
				'custom_icon'      => $button_icon,
				'has_wrapper'      => false,
				'url_new_window'   => $new_tab,
			)
		);

		return sprintf( '%1$s', $button_output );

	}

	public function render_button_b() {

		$button_custom = $this->props['custom_btn_b'];
		$button_text   = isset( $this->props['btn_b_text'] ) ? $this->props['btn_b_text'] : 'Button 2';
		$button_link   = isset( $this->props['btn_b_link'] ) ? $this->props['btn_b_link'] : '#';
		$button_url    = trim( $button_link );
		$new_tab       = '_blank' === $this->props['btn_b_link_target'] ? 'on' : 'off';
		$button_rel    = $this->props['btn_b_rel'];
		$button_icon   = ! empty( $this->props['btn_b_icon'] ) ? $this->props['btn_b_icon'] : '5';

		$button_output = $this->render_button(
			array(
				'button_classname' => array( 'btn-el', 'btn-el--secondary' ),
				'button_custom'    => $button_custom,
				'button_rel'       => $button_rel,
				'button_text'      => $button_text,
				'button_url'       => $button_url,
				'custom_icon'      => $button_icon,
				'has_wrapper'      => false,
				'url_new_window'   => $new_tab,
			)
		);

		return sprintf( '%1$s', $button_output );

	}

	public function renderConnector() {

		$connector_text = null;
		$connector_type = $this->props['connector_type'];
		$connector_text = $this->props['connector_text'];
		$connector_icon = $this->props['connector_icon'];
		$icon           = esc_attr( et_pb_process_font_icon( $connector_icon ) );

		if ( 'text' === $connector_type ) {

			$connector_text = $connector_text;
		} elseif ( 'icon' === $this->props['connector_type'] ) {

			$connector_text = sprintf( '<i class="ba-et-icon" data-icon="%1$s"></i>', $icon );
		}

		if ( 'empty' !== $connector_type ) {
			return sprintf(
				'<div class="ba-btn__connector ba-btn__connector--%1$s">
					%2$s
				</div>',
				$connector_type,
				$connector_text
			);
		}
	}

	public function render( $attrs, $content = null, $render_slug ) {

		$this->render_css( $render_slug );

		return sprintf(
			'
			<div class="ba-module ba-dual-btn content-%1$s">
				<div class="ba-btn-wrap">
					%2$s %3$s
				</div>
				<div class="ba-btn-wrap">
					%4$s
				</div>
			</div>',
			$this->props['btn_alignment'],
			$this->render_button_a(),
			$this->renderConnector(),
			$this->render_button_b()
		);
	}

	public function render_css( $render_slug ) {

		$this->get_buttons_styles( 'btn_a', $render_slug, '%%order_class%% .ba-dual-btn .btn-el--primary' );
		$this->get_buttons_styles( 'btn_b', $render_slug, '%%order_class%% .ba-dual-btn .btn-el--secondary' );

		// advanced border radius.
		$btn_a_radius = $this->props['btn_a_radius'];
		$btn_b_radius = $this->props['btn_b_radius'];

		if ( ! empty( $btn_a_radius ) ) {
			$btn_a_radius = explode( '|', $btn_a_radius );

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => 'body #page-container %%order_class%% .ba-dual-btn .ba-btn-wrap .btn-el--primary, .et-db #et-boc %%order_class%% .ba-dual-btn .ba-btn-wrap .btn-el--primary',
					'declaration' => sprintf(
						'
					border-top-left-radius: %1$s!important;
					border-top-right-radius: %2$s!important;
					border-bottom-right-radius: %3$s!important;
					border-bottom-left-radius: %4$s!important;',
						$btn_a_radius[1],
						$btn_a_radius[2],
						$btn_a_radius[3],
						$btn_a_radius[4]
					),
				)
			);
		}

		if ( ! empty( $btn_b_radius ) ) {
			$btn_b_radius = explode( '|', $btn_b_radius );

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => 'body #page-container %%order_class%% .ba-dual-btn .ba-btn-wrap .btn-el--secondary, .et-db #et-boc %%order_class%% .ba-dual-btn .ba-btn-wrap .btn-el--secondary',
					'declaration' => sprintf(
						'
					border-top-left-radius: %1$s!important;
					border-top-right-radius: %2$s!important;
					border-bottom-right-radius: %3$s!important;
					border-bottom-left-radius: %4$s!important;',
						$btn_b_radius[1],
						$btn_b_radius[2],
						$btn_b_radius[3],
						$btn_b_radius[4]
					),
				)
			);
		}

		if ( 'empty' !== $this->props['connector_type'] ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-btn__connector',
					'declaration' => sprintf(
						'
					width: %1$s;
					height: %2$s;
					background: %3$s;
					color: %4$s;
					font-size: %5$s;
					border-radius: %6$s;
					box-shadow: 0 0 0 %7$s %8$s',
						$this->props['connector_size'],
						$this->props['connector_size'],
						$this->props['connector_bg'],
						$this->props['connector_text_color'],
						$this->props['connector_text_size'],
						$this->props['connector_radius'],
						$this->props['connector_border_width'],
						$this->props['connector_border_color']
					),
				)
			);
		}

		$button_gap                   = $this->props['button_gap'];
		$button_gap_tablet            = $this->props['button_gap_tablet'];
		$button_gap_phone             = $this->props['button_gap_phone'];
		$button_gap_last_edited       = $this->props['button_gap_last_edited'];
		$button_gap_responsive_status = et_pb_get_responsive_status( $button_gap_last_edited );

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .btn-el--primary',
				'declaration' => sprintf( 'margin-right: calc(%1$s / 2)', $button_gap ),
			)
		);

		if ( $button_gap_tablet && $button_gap_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .btn-el--primary',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'margin-right: calc(%1$s / 2)', $button_gap_tablet ),
				)
			);
		}

		if ( $button_gap_phone && $button_gap_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .btn-el--primary',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'margin-right: calc(%1$s / 2)', $button_gap_phone ),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .btn-el--secondary',
				'declaration' => sprintf( 'margin-left: calc(%1$s / 2)', $button_gap ),
			)
		);

		if ( $button_gap_tablet && $button_gap_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .btn-el--secondary',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'margin-left: calc(%1$s / 2)', $button_gap_tablet ),
				)
			);
		}

		if ( $button_gap_phone && $button_gap_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .btn-el--secondary',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'margin-left: calc(%1$s / 2)', $button_gap_phone ),
				)
			);
		}
	}
}

new BA_Dual_Button();
