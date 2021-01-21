<?php

class BA_Skill_Bar_Child extends BA_Builder_Module {

	public $slug                     = 'ba_skill_bar_child';
	public $vb_support               = 'on';
	public $type                     = 'child';
	public $child_title_var          = 'name';
	public $child_title_fallback_var = 'level';

	public function init() {

		$this->name = esc_html__( 'Bar', 'brain-divi-addons' );

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => array(
						'title' => esc_html( 'Content', 'brain-divi-addons' ),
					),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'bar'   => array(
						'title' => esc_html( 'Bar', 'brain-divi-addons' ),
					),
					'texts' => array(
						'title'             => esc_html( 'Texts', 'brain-divi-addons' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'name'  => array(
								'name' => esc_html( 'Name', 'brain-divi-addons' ),
							),
							'level' => array(
								'name' => esc_html( 'Level', 'brain-divi-addons' ),
							),
						),
					),
				),
			),
		);
	}

	public function get_fields() {
		$fields = array(

			'use_name'       => array(
				'label'           => esc_html__( 'Use Name', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'on',
				'toggle_slug'     => 'content',
			),

			'name'           => array(
				'label'       => esc_html__( 'Name', 'brain-divi-addons' ),
				'type'        => 'text',
				'toggle_slug' => 'content',
				'default'     => 'Web Design',
				'show_if'     => array(
					'use_name' => 'on',
				),
			),

			'level'          => array(
				'label'          => esc_html__( 'Level', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '30%',
				'fixed_unit'     => '%',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'toggle_slug'    => 'content',
			),

			'is_hide_level'  => array(
				'label'           => esc_html__( 'Hide Level Text', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'content',
			),

			'text_placement' => array(
				'label'       => esc_html__( 'Text Placement', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'content',
				'default'     => 'in',
				'options'     => array(
					'in'  => esc_html__( 'Inside', 'brain-divi-addons' ),
					'out' => esc_html__( 'Outside', 'brain-divi-addons' ),
				),
			),

			// styling
			'bar_height'     => array(
				'label'           => esc_html__( 'Bar Height', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '30px',
				'range_settings'  => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'bar',
				'mobile_options'  => true,
			),

			'bar_radius'     => array(
				'label'          => esc_html__( 'Bar Border Radius', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '40px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'bar',
			),

			'text_spacing'   => array(
				'label'          => esc_html__( 'Outer Text Spacing', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '12px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'bar',
				'show_if'        => array(
					'text_placement' => 'out',
				),
			),

			'name_spacing'   => array(
				'label'          => esc_html__( 'Name Spacing', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '15px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'texts',
				'sub_toggle'     => 'name',
			),

			'level_spacing'  => array(
				'label'          => esc_html__( 'Level Spacing', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '15px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'texts',
				'sub_toggle'     => 'level',
			),

		);

		$level_bg = $this->custom_background_fields( 'level', 'Level', 'advanced', 'bar', array( 'color', 'gradient', 'hover' ), array(), '#add8e6' );
		$bar_bg   = $this->custom_background_fields( 'bar', 'Bar', 'advanced', 'bar', array( 'color', 'gradient', 'hover' ), array(), '#dddddd' );
		return array_merge( $level_bg, $bar_bg, $fields );
	}


	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['borders']     = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;
		$advanced_fields['background']  = false;

		$advanced_fields['fonts']['name'] = array(
			'label'           => esc_html__( 'Name', 'brain-divi-addons' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-skillbar__name',
				'important' => 'all',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'name',
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '14px',
			),
		);

		$advanced_fields['fonts']['level'] = array(
			'label'           => esc_html__( 'Level', 'brain-divi-addons' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-skillbar__level',
				'important' => 'all',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'level',
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '14px',
			),
		);

		$advanced_fields['box_shadow']['bar'] = array(
			'toggle_slug' => 'bar',
			'label'       => esc_html__( 'Bar Box Shadow', 'brain-divi-addons' ),
			'css'         => array(
				'main'      => '%%order_class%% .ba-skillbar__wrapper',
				'important' => 'all',
			),
		);

		return $advanced_fields;
	}

	public function _renderName() {
		$use_name = $this->props['use_name'];
		$name     = $this->props['name'];

		if ( $use_name === 'on' ) {
			return '<span class="ba-skillbar__name">' . $name . '</span>';
		}
	}

	public function _renderLevel() {
		$level         = $this->props['level'];
		$is_hide_level = $this->props['is_hide_level'];

		if ( $is_hide_level !== 'on' ) {
			return '<span class="ba-skillbar__level">' . $level . '</span>';
		}
	}

	public function _renderInnerText() {
		$use_name      = $this->props['use_name'];
		$is_hide_level = $this->props['is_hide_level'];

		if ( $use_name === 'on' || $is_hide_level === 'off' ) {
			return sprintf(
				'<div class="ba-skillbar__inner__text">%1$s %2$s</div>',
				$this->_renderName(),
				$this->_renderLevel()
			);

		}
	}


	public function render( $attrs, $content = null, $render_slug ) {

		// Module classnames
		$this->remove_classname( 'et_pb_module' );
		$this->add_classname( 'ba_et_pb_module' );

		// Render CSS
		$this->render_css( $render_slug );

		return sprintf(
			'
			<div class="ba-module ba-child ba-skillbar">
				<div class="ba-skillbar__wrapper">
				    <div class="ba-skillbar__inner">%1$s</div>
				</div>
			</div>',
			$this->_renderInnerText()
		);
	}

	protected function render_css( $render_slug ) {

		$text_spacing                 = $this->props['text_spacing'];
		$level                        = $this->props['level'];
		$bar_height                   = $this->props['bar_height'];
		$bar_height_tablet            = $this->props['bar_height_tablet'];
		$bar_height_phone             = $this->props['bar_height_phone'];
		$bar_height_last_edited       = $this->props['bar_height_last_edited'];
		$bar_height_responsive_status = et_pb_get_responsive_status( $bar_height_last_edited );
		$text_placement               = $this->props['text_placement'];
		$bar_radius                   = $this->props['bar_radius'];
		$name_spacing                 = $this->props['name_spacing'];
		$level_spacing                = $this->props['level_spacing'];
		$use_name                     = $this->props['use_name'];

		if ( $use_name === 'off' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-skillbar__inner__text',
					'declaration' => 'justify-content: flex-end;',
				)
			);
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-skillbar__inner__text',
					'declaration' => 'justify-content: space-between;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-skillbar__inner',
				'declaration' => sprintf(
					'
                width:%1$s;
                height:%2$s;',
					$level,
					$bar_height
				),
			)
		);

		if ( $bar_height_tablet && $bar_height_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-skillbar__inner',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'height: %1$s;', $bar_height_tablet ),
				)
			);
		}

		if ( $bar_height_phone && $bar_height_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-skillbar__inner',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'height: %1$s;', $bar_height_phone ),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-skillbar__wrapper',
				'declaration' => sprintf(
					'border-radius:%1$s;',
					$bar_radius
				),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-skillbar__name',
				'declaration' => sprintf( 'margin-left:%1$s;', $name_spacing ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-skillbar__level',
				'declaration' => sprintf( 'margin-right:%1$s;', $level_spacing ),
			)
		);

		if ( $text_placement === 'out' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-skillbar__inner__text',
					'declaration' => sprintf(
						'
                        position:absolute;
                        top:-%1$s;
                        width:%2$s;
                        height:auto;
                        transform:translateY(-100%%);',
						$text_spacing,
						$level
					),
				)
			);
		} elseif ( $text_placement === 'in' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-skillbar__inner__text',
					'declaration' => 'width: 100%;height: 100%;',
				)
			);
		}

		$this->get_custom_bg_style( $render_slug, 'level', '%%order_class%% .ba-skillbar__inner', '%%order_class%%:hover .ba-skillbar__inner' );

		$this->get_custom_bg_style( $render_slug, 'bar', '%%order_class%% .ba-skillbar__wrapper', '%%order_class%%:hover .ba-skillbar__wrapper' );

	}
}

new BA_Skill_Bar_Child();
