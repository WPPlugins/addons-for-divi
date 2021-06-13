<?php
class BA_Business_Hour extends BA_Builder_Module {

	public $slug       = 'ba_business_hour';
	public $vb_support = 'on';
	public $child_slug = 'ba_business_hour_child';

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/demo/business-hour/',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {

		$this->name      = esc_html__( 'Brain Business Hour', 'brain-divi-addons' );
		$this->icon_path = plugin_dir_path( __FILE__ ) . 'business-hour.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content'  => esc_html__( 'Content', 'brain-divi-addons' ),
					'settings' => esc_html__( 'Settings', 'brain-divi-addons' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'general'    => esc_html__( 'General', 'brain-divi-addons' ),
					'bh_title'   => esc_html__( 'Title', 'brain-divi-addons' ),
					'title_text' => esc_html__( 'Title Text', 'brain-divi-addons' ),
					'texts'      => array(
						'title'             => esc_html__( 'Day & Time', 'brain-divi-addons' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'day'  => array(
								'name' => esc_html__( 'Day', 'brain-divi-addons' ),
							),
							'time' => array(
								'name' => esc_html__( 'Time', 'brain-divi-addons' ),
							),
						),
					),
					'separator'  => esc_html__( 'Separator', 'brain-divi-addons' ),
				),
			),
		);
	}

	public function get_fields() {

		$content = array(
			'title' => array(
				'label'       => esc_html__( 'Title', 'brain-divi-addons' ),
				'type'        => 'text',
				'default'     => esc_html__( 'Business Hour', 'brain-divi-addons' ),
				'toggle_slug' => 'content',
			),
		);

		$settings = array(
			'show_title'     => array(
				'label'           => esc_html__( 'Show Title', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'on',
				'toggle_slug'     => 'settings',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
			),
			'item_spacing'   => array(
				'label'          => esc_html__( 'Item Spacing Bottom', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '25px',
				'fixed_unit'     => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'settings',
			),
			'show_separator' => array(
				'label'           => esc_html__( 'Show Text Separator', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'settings',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
			),
			'show_divider'   => array(
				'label'           => esc_html__( 'Show Item Divider', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'settings',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
			),
			'divider_type'   => array(
				'label'       => esc_html__( 'Divider Type', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'solid_border',
				'options'     => array(
					'solid_border'   => esc_html__( 'Solid', 'brain-divi-addons' ),
					'double_border'  => esc_html__( 'Double', 'brain-divi-addons' ),
					'dotted_border'  => esc_html__( 'Dotted', 'brain-divi-addons' ),
					'dashed_border'  => esc_html__( 'Dashed', 'brain-divi-addons' ),
					'curved_pattern' => esc_html__( 'Curved', 'brain-divi-addons' ),
					'zigzag_pattern' => esc_html__( 'Zigzag', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'show_divider' => 'on',
				),
			),
			'divider_color'  => array(
				'label'       => esc_html__( 'Divider Color', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'toggle_slug' => 'settings',
				'default'     => '#dddddd',
				'show_if'     => array(
					'show_divider' => 'on',
				),
			),
			'divider_weight' => array(
				'label'          => esc_html__( 'Divider Weight', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '1px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 15,
				),
				'toggle_slug'    => 'settings',
				'show_if'        => array(
					'show_divider' => 'on',
				),
			),
			'divider_height' => array(
				'label'          => esc_html__( 'Divider Height', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '10px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'settings',
				'show_if'        => array(
					'show_divider' => 'on',
					'divider_type' => array( 'curved_pattern', 'zigzag_pattern' ),
				),
			),
		);

		$general = array(
			'day_text_width'  => array(
				'label'          => esc_html__( 'Day Text Width', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => 'auto',
				'default_unit'   => '%',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'general',
			),
			'time_text_width' => array(
				'label'          => esc_html__( 'Time Text Width', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => 'auto',
				'default_unit'   => '%',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'general',
			),
			'item_padding'    => array(
				'label'          => esc_html__( 'Padding', 'brain-divi-addons' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'general',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
			),
		);

		$separator = array(
			'separator_type'   => array(
				'label'       => esc_html__( 'Separator Type', 'brain-divi-addons' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'separator',
				'default'     => 'solid_border',
				'options'     => array(
					'solid_border'   => esc_html__( 'Solid', 'brain-divi-addons' ),
					'double_border'  => esc_html__( 'Double', 'brain-divi-addons' ),
					'dotted_border'  => esc_html__( 'Dotted', 'brain-divi-addons' ),
					'dashed_border'  => esc_html__( 'Dashed', 'brain-divi-addons' ),
					'curved_pattern' => esc_html__( 'Curved', 'brain-divi-addons' ),
					'zigzag_pattern' => esc_html__( 'Zigzag', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'show_separator' => 'on',
				),
			),
			'separator_gap'    => array(
				'label'          => esc_html__( 'Separator Spacing', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '15px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'separator',
				'show_if'        => array(
					'show_separator' => 'on',
				),
			),
			'separator_color'  => array(
				'label'       => esc_html__( 'Separator Color', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'separator',
				'default'     => '#dddddd',
				'show_if'     => array(
					'show_separator' => 'on',
				),
			),
			'separator_weight' => array(
				'label'          => esc_html__( 'Separator Weight', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '1px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 15,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'separator',
				'show_if'        => array(
					'show_separator' => 'on',
				),
			),
			'separator_height' => array(
				'label'          => esc_html__( 'Separator Height', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '10px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'separator',
				'show_if'        => array(
					'show_separator' => 'on',
					'separator_type' => array( 'curved_pattern', 'zigzag_pattern' ),
				),
			),
		);

		$title = array(
			'title_padding' => array(
				'label'          => esc_html__( 'Padding', 'brain-divi-addons' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'bh_title',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
			),
			'title_spacing' => array(
				'label'          => esc_html__( 'Spacing Bottom', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '25px',
				'fixed_unit'     => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'bh_title',
			),
		);

		$title_bg = $this->custom_background_fields( 'title', '', 'advanced', 'bh_title', array( 'color', 'gradient', 'hover', 'image' ), array(), '' );

		$item_bg = $this->custom_background_fields( 'item', 'Item', 'advanced', 'general', array( 'color', 'gradient', 'hover', 'image' ), array(), '' );

		return array_merge( $settings, $separator, $content, $general, $title, $title_bg, $item_bg );
	}


	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['borders']['item'] = array(
			'toggle_slug' => 'general',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-business-hour-child',
					'border_styles' => '%%order_class%% .ba-business-hour-child',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333333',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['box_shadow']['item'] = array(
			'label'       => esc_html__( 'Item Box Shadow', 'brain-divi-addons' ),
			'css'         => array(
				'main'      => '%%order_class%% .ba-business-hour-child',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'general',
		);

		$advanced_fields['borders']['title'] = array(
			'toggle_slug' => 'bh_title',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-business-hour-title',
					'border_styles' => '%%order_class%% .ba-business-hour-title',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333333',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['fonts']['title'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .ba-business-hour-title h2',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'title_text',
			'hide_text_align' => false,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '.1',
				),
			),
		);

		$advanced_fields['fonts']['day'] = array(
			'label'           => esc_html__( 'Day', 'brain-divi-addons' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-business-hour-day',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'day',
			'hide_text_align' => false,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '.1',
				),
			),
		);

		$advanced_fields['fonts']['time'] = array(
			'label'           => esc_html__( 'Time', 'brain-divi-addons' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-business-hour-time',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'time',
			'hide_text_align' => false,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '.1',
				),
			),
		);

		return $advanced_fields;
	}

	protected function render_title() {
		if ( 'on' === $this->props['show_title'] ) {
			return sprintf(
				'<div class="ba-business-hour-title">
					<h2>%1$s</h2>
			 	</div>',
				$this->props['title']
			);
		}
	}

	public function render( $attrs, $content = null, $render_slug ) {

		$this->render_css( $render_slug );

		return sprintf(
			'<div class="ba-module ba-business-hour">
				%2$s
				<div class="ba-business-hour-content">
					%1$s
           	 	</div>
            </div>',
			$this->props['content'],
			$this->render_title()
		);
	}

	protected function render_css( $render_slug ) {

		if ( 'off' === $this->props['show_separator'] ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-business-hour-separator',
					'declaration' => 'display: none!important;',
				)
			);
		}

		if ( 'auto' !== $this->props['time_text_width'] ) {
			$this->get_responsive_styles(
				'time_text_width',
				'%%order_class%% .ba-business-hour-time',
				array(
					'primary'   => 'flex',
					'important' => false,
				),
				array( 'default' => 'auto' ),
				$render_slug
			);
		}

		if ( 'auto' !== $this->props['day_text_width'] ) {
			$this->get_responsive_styles(
				'day_text_width',
				'%%order_class%% .ba-business-hour-day',
				array(
					'primary'   => 'flex',
					'important' => false,
				),
				array( 'default' => 'auto' ),
				$render_slug
			);
		}

		$this->get_responsive_styles(
			'title_spacing',
			'%%order_class%% .ba-business-hour-title',
			array(
				'primary'   => 'margin-bottom',
				'important' => true,
			),
			array( 'default' => '25px' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'item_padding',
			'%%order_class%% .ba_business_hour_child .ba-business-hour-child',
			array(
				'primary'   => 'padding',
				'important' => true,
			),
			array( 'default' => '0|0|0|0' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'title_padding',
			'%%order_class%% .ba-business-hour-title',
			array(
				'primary'   => 'padding',
				'important' => true,
			),
			array( 'default' => '0px|0px|0px|0px' ),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba_business_hour_child',
				'declaration' => sprintf(
					'margin-bottom: %1$s!important;',
					$this->props['item_spacing']
				),
			)
		);

		if ( 'on' === $this->props['show_divider'] ) {

			$divider_color  = $this->props['divider_color'];
			$divider_weight = $this->props['divider_weight'];
			$divider_height = $this->props['divider_height'];

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba_business_hour_child',
					'declaration' => sprintf(
						'padding-bottom: %1$s!important;',
						$this->props['item_spacing']
					),
				)
			);
			if ( '#' === $divider_color[0] ) {
				$divider_color = $this->hex_to_rgb( $divider_color );
			}

			$divider_type = explode( '_', $this->props['divider_type'] );

			if ( 'border' === $divider_type[1] ) {

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba_business_hour_child',
						'declaration' => sprintf(
							'border-bottom: %1$s %2$s %3$s;',
							$divider_weight,
							$divider_type[0],
							$divider_color
						),
					)
				);
			} else {

				if ( 'curved' === $divider_type[0] || 'zigzag' === $divider_type[0] ) {
					$pattern_bg = $this->get_pattern( $divider_type[0], $divider_color, $divider_weight );
				}

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba_business_hour_child:after',
						'declaration' => sprintf(
							'content: "";
							position: absolute;
							background-image: url("%1$s");
							height: %2$s;
							background-size: %2$s 100%%;
							bottom: calc(-%2$s / 2);',
							$pattern_bg,
							$divider_height
						),
					)
				);
			}
		}

		// Separator.
		if ( ! empty( $this->props['separator_gap'] ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-business-hour-separator',
					'declaration' => sprintf(
						'margin-right: %1$s;
						margin-left: %1$s;',
						$this->props['separator_gap']
					),
				)
			);
		}

		$separator_color  = $this->props['separator_color'];
		$separator_weight = $this->props['separator_weight'];
		$separator_height = $this->props['separator_height'];
		$type             = $this->props['separator_type'];

		if ( 'none_all' !== $type ) {
			if ( '#' === $separator_color[0] ) {
				$separator_color = $this->hex_to_rgb( $separator_color );
			}

			$_type = explode( '_', $type );

			if ( 'border' === $_type[1] ) {

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-business-hour-separator',
						'declaration' => sprintf(
							'border-top: %1$s %2$s %3$s;
							height: %4$s;',
							$separator_weight,
							$_type[0],
							$separator_color,
							$separator_weight
						),
					)
				);
			} else {

				if ( 'curved' === $_type[0] || 'zigzag' === $_type[0] ) {
					$pattern_bg = $this->get_pattern( $_type[0], $separator_color, $separator_weight );
				}

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-business-hour-separator',
						'declaration' => sprintf(
							'background-image: url("%1$s");
							height: %2$s;
							background-size: %2$s 100%%;',
							$pattern_bg,
							$separator_height
						),
					)
				);
			}
		}

		$this->get_custom_bg_style( $render_slug, 'title', '%%order_class%% .ba-business-hour-title', '%%order_class%% .ba-business-hour-title:hover' );

		$this->get_custom_bg_style( $render_slug, 'item', '%%order_class%% .ba-business-hour-child', '%%order_class%% .ba-business-hour-child:hover' );

	}
}

new BA_Business_Hour();
