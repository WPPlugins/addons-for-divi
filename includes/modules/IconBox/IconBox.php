<?php
class BA_Icon_Box extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/demo/icon-box/',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {

		$this->vb_support = 'on';
		$this->slug       = 'ba_icon_box';
		$this->name       = esc_html__( 'Brain Icon Box', 'brain-divi-addons' );

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__( 'Content', 'brain-divi-addons' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'icon_box' => esc_html__( 'Icon Box', 'brain-divi-addons' ),
					'icon'     => esc_html__( 'Icon', 'brain-divi-addons' ),
					'badge'    => esc_html__( 'Badge', 'brain-divi-addons' ),
					'texts'    => array(
						'title'             => esc_html__( 'Title & Description', 'brain-divi-addons' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'title'       => array(
								'name' => esc_html__( 'Title', 'brain-divi-addons' ),
							),
							'description' => array(
								'name' => esc_html__( 'Description', 'brain-divi-addons' ),
							),
						),
					),
				),
			),
		);
	}

	public function get_fields() {

		$fields_top = array();
		$fields     = array();

		$fields['icon'] = array(
			'label'       => esc_html__( 'Select Icon', 'brain-divi-addons' ),
			'type'        => 'select_icon',
			'default'     => '',
			'toggle_slug' => 'content',
			'show_if'     => array(
				'use_image' => 'off',
			),
		);

		$fields['use_image'] = array(
			'label'           => esc_html__( 'Use Image', 'brain-divi-addons' ),
			'type'            => 'yes_no_button',
			'option_category' => 'configuration',
			'options'         => array(
				'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
				'off' => esc_html__( 'No', 'brain-divi-addons' ),
			),
			'default'         => 'off',
			'toggle_slug'     => 'content',
		);

		$fields['icon_image'] = array(
			'label'              => esc_html__( 'Upload Icon Image', 'brain-divi-addons' ),
			'type'               => 'upload',
			'option_category'    => 'basic_option',
			'upload_button_text' => esc_attr__( 'Upload an Icon', 'brain-divi-addons' ),
			'choose_text'        => esc_attr__( 'Choose an Icon', 'brain-divi-addons' ),
			'update_text'        => esc_attr__( 'Set As Icon', 'brain-divi-addons' ),
			'toggle_slug'        => 'content',
			'show_if'            => array(
				'use_image' => 'on',
			),
		);

		$fields['image_alt'] = array(
			'label'       => esc_html__( 'Image Alt Text', 'brain-divi-addons' ),
			'type'        => 'text',
			'toggle_slug' => 'content',
			'show_if'     => array(
				'use_image' => 'on',
			),
		);

		$fields['badge_text'] = array(
			'label'           => esc_html__( 'Badge Text', 'brain-divi-addons' ),
			'type'            => 'text',
			'toggle_slug'     => 'content',
			'dynamic_content' => 'text',
		);

		$fields['title'] = array(
			'label'           => esc_html__( 'Title', 'brain-divi-addons' ),
			'type'            => 'text',
			'toggle_slug'     => 'content',
			'default'         => esc_html__( 'Your Title Goes Here', 'brain-divi-addons' ),
			'dynamic_content' => 'text',
		);

		$fields['description'] = array(
			'label'           => esc_html__( 'Description', 'brain-divi-addons' ),
			'type'            => 'textarea',
			'toggle_slug'     => 'content',
			'dynamic_content' => 'text',
		);

		$fields_top['icon__placement'] = array(
			'label'       => esc_html__( 'Icon Placement', 'brain-divi-addons' ),
			'type'        => 'select',
			'toggle_slug' => 'icon',
			'tab_slug'    => 'advanced',
			'default'     => 'normal',
			'options'     => array(
				'normal'   => esc_html__( 'Normal', 'brain-divi-addons' ),
				'absolute' => esc_html__( 'Absolute', 'brain-divi-addons' ),
			),
		);

		$fields['icon_color'] = array(
			'label'       => esc_html__( 'Icon Color', 'brain-divi-addons' ),
			'type'        => 'color-alpha',
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'icon',
			'default'     => '#333',
			'hover'       => 'tabs',
			'show_if'     => array(
				'use_image' => 'off',
			),
		);

		$fields['icon_width'] = array(
			'label'          => esc_html__( 'Icon Width', 'brain-divi-addons' ),
			'type'           => 'range',
			'mobile_options' => true,
			'default'        => '100px',
			'range_settings' => array(
				'min'  => 1,
				'step' => 1,
				'max'  => 1000,
			),
			'toggle_slug'    => 'icon',
			'sub_toggle'     => 'icon',
			'tab_slug'       => 'advanced',
		);

		$fields['icon_height'] = array(
			'label'          => esc_html__( 'Icon Height', 'brain-divi-addons' ),
			'type'           => 'range',
			'mobile_options' => true,
			'default'        => '100px',
			'range_settings' => array(
				'min'  => 1,
				'step' => 1,
				'max'  => 1000,
			),
			'toggle_slug'    => 'icon',
			'sub_toggle'     => 'icon',
			'tab_slug'       => 'advanced',
		);

		$fields['icon_size'] = array(
			'label'          => esc_html__( 'Icon Size', 'brain-divi-addons' ),
			'type'           => 'range',
			'mobile_options' => true,
			'default'        => '60px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 200,
			),
			'toggle_slug'    => 'icon',
			'sub_toggle'     => 'icon',
			'tab_slug'       => 'advanced',
			'show_if'        => array(
				'use_image' => 'off',
			),
		);

		$fields['icon_padding'] = array(
			'label'          => esc_html__( 'Icon Padding', 'brain-divi-addons' ),
			'type'           => 'custom_padding',
			'default'        => '0px|0px|0px|0px',
			'mobile_options' => true,
			'toggle_slug'    => 'icon',
			'tab_slug'       => 'advanced',
			'show_if'        => array(
				'use_image' => 'on',
			),
		);

		$fields['icon_spacing'] = array(
			'label'          => esc_html__( 'Icon Bottom Spacing', 'brain-divi-addons' ),
			'type'           => 'range',
			'default'        => '10px',
			'mobile_options' => true,
			'range_settings' => array(
				'min'  => 0,
				'max'  => 200,
				'step' => 1,
			),
			'toggle_slug'    => 'icon',
			'tab_slug'       => 'advanced',
			'show_if'        => array(
				'icon__placement' => 'normal',
			),
		);

		$fields['icon_bg_rotate'] = array(
			'label'          => esc_html__( 'Icon Background Rotate', 'brain-divi-addons' ),
			'type'           => 'range',
			'default'        => '0deg',
			'fixed_unit'     => 'deg',
			'range_settings' => array(
				'min'  => -360,
				'max'  => 360,
				'step' => 1,
			),
			'toggle_slug'    => 'icon',
			'tab_slug'       => 'advanced',
		);

		$fields['content_alignment'] = array(
			'label'            => esc_html__( 'Content Alignment', 'brain-divi-addons' ),
			'type'             => 'text_align',
			'option_category'  => 'layout',
			'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
			'options_icon'     => 'module_align',
			'default_on_front' => 'center',
			'toggle_slug'      => 'icon_box',
			'tab_slug'         => 'advanced',
		);

		$fields['title_spacing'] = array(
			'label'          => esc_html__( 'Title Spacing Bottom', 'brain-divi-addons' ),
			'type'           => 'range',
			'mobile_options' => true,
			'default'        => '10px',
			'range_settings' => array(
				'min'  => 0,
				'max'  => 200,
				'step' => 1,
			),
			'toggle_slug'    => 'texts',
			'sub_toggle'     => 'title',
			'tab_slug'       => 'advanced',
		);

		$icon_defaults         = array(
			'position' => 'left_top',
			'offset_x' => '50%',
			'offset_y' => '50%',
		);
		$badge_defaults        = array(
			'position' => 'right_top',
			'offset_x' => '15px',
			'offset_y' => '15px',
			'padding'  => '5px|15px|5px|15px',
			'bg'       => '#efefef',
			'color'    => '#ffffff',
		);
		$icon_additional_opts  = $this->get_absolute_element_options( 'icon', 'Icon', 'icon', $icon_defaults, array( 'icon__placement' => 'absolute' ) );
		$badge_additional_opts = $this->get_badge_options( 'badge', 'Badge', 'badge', $badge_defaults );
		$icon_bg               = $this->custom_background_fields( 'icon', 'Icon', 'advanced', 'icon', array( 'color', 'gradient', 'hover' ), array(), '' );

		return array_merge( $fields_top, $icon_additional_opts, $badge_additional_opts, $fields, $icon_bg );
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['borders']['icon'] = array(
			'label_prefix' => esc_html__( 'Icon', 'brain-divi-addons' ),
			'toggle_slug'  => 'icon',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-iconbox__icon',
					'border_styles' => '%%order_class%% .ba-iconbox__icon',
				),
				'important' => 'all',
			),
			'defaults'     => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['borders']['badge'] = array(
			'label_prefix' => esc_html__( 'Badge', 'brain-divi-addons' ),
			'toggle_slug'  => 'badge',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-iconbox__badge',
					'border_styles' => '%%order_class%% .ba-iconbox__badge',
				),
				'important' => 'all',
			),
			'defaults'     => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['height'] = array(
			'css' => array(
				'main'      => '%%order_class%% .ba-iconbox-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['width'] = array(
			'css' => array(
				'main'      => '%%order_class%% .ba-iconbox-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '%%order_class%% .ba-iconbox-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['background'] = array(
			'css' => array(
				'main'      => '%%order_class%% .ba-iconbox-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['box'] = array(
			'label_prefix' => esc_html__( 'Box', 'brain-divi-addons' ),
			'toggle_slug'  => 'icon_box',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-iconbox-inner',
					'border_styles' => '%%order_class%% .ba-iconbox-inner',
				),
				'important' => 'all',
			),
			'defaults'     => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['box_shadow']['item'] = array(
			'label'       => esc_html__( 'Wrapper Box Shadow', 'brain-divi-addons' ),
			'css'         => array(
				'main'      => '%%order_class%% .ba-iconbox-inner',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'icon_box',
		);

		$advanced_fields['box_shadow']['icon'] = array(
			'label'       => esc_html__( 'Icon Box Shadow', 'brain-divi-addons' ),
			'css'         => array(
				'main'      => '%%order_class%% .ba-iconbox__icon',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'icon',
		);

		$advanced_fields['fonts']['title'] = array(
			'label'           => esc_html__( 'Title', 'brain-divi-addons' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-iconbox__title',
				'important' => 'all',
			),
			'header_level'    => array(
				'default' => 'h2',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'title',
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '26px',
			),
		);

		$advanced_fields['fonts']['description'] = array(
			'label'           => esc_html__( 'Description', 'brain-divi-addons' ),
			'css'             => array(
				'main' => '%%order_class%% .ba-iconbox__desc',
			),
			'important'       => 'all',
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'description',
			'show_if'         => array(
				'is_description_hide' => 'off',
			),
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '14px',
			),
		);

		$advanced_fields['fonts']['badge'] = array(
			'label'           => esc_html__( 'Badge', 'brain-divi-addons' ),
			'css'             => array(
				'main' => '%%order_class%% .ba-iconbox__badge',
			),
			'important'       => 'all',
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'badge',
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '14px',
			),
		);

		return $advanced_fields;
	}

	public function render_icon() {

		$use_image  = $this->props['use_image'];
		$icon       = $this->props['icon'];
		$icon_image = $this->props['icon_image'];
		$image_alt  = $this->props['image_alt'];
		$html       = '';

		if ( 'off' === $use_image ) {

			$icon = esc_attr( et_pb_process_font_icon( $icon ) );
			$html = '<i class="ba-icon ba-et-icon" data-icon="' . $icon . '"></i>';
		} else {
			$html = '<img class="ba-icon-image" src="' . $icon_image . '" alt="' . $image_alt . '" />';
		}

		if ( ! empty( $icon ) || ! empty( $icon_image ) ) {
			return sprintf(
				'
                <div class="ba-iconbox__icon-wrap">
                    <div class="ba-iconbox__icon">
                        %1$s
                    </div>
                </div>',
				$html
			);

		}
	}

	public function render_title() {

		$title                 = $this->props['title'];
		$title_level           = $this->props['title_level'];
		$processed_title_level = et_pb_process_header_level( $title_level, 'h2' );
		$processed_title_level = esc_html( $processed_title_level );

		if ( ! empty( $title ) ) {
			return sprintf(
				'<%1$s class="ba-iconbox__title">%2$s</%1$s>',
				$processed_title_level,
				$title
			);
		}
	}

	public function render_description() {
		$description = $this->props['description'];
		if ( ! empty( $description ) ) {
			return sprintf( '<p class="ba-iconbox__desc">%1$s</p>', $description );
		}
	}

	public function render_badge() {
		$badge_text = $this->props['badge_text'];
		if ( ! empty( $badge_text ) ) {
			return sprintf(
				'
                <div class="ba-iconbox__badge">
                    %1$s
                </div>',
				$badge_text
			);
		}
	}

	public function render( $attrs, $content = null, $render_slug ) {

		$icon__placement = $this->props['icon__placement'];
		$this->render_css( $render_slug );

		return sprintf(
			'<div class="ba-module ba-module-parent ba-iconbox">
                %1$s %5$s
                <div class="ba-iconbox-inner ba-bg-support">
                     %2$s %3$s %4$s
                </div>
            </div>',
			$this->render_badge(),
			'absolute' !== $icon__placement ? $this->render_icon() : '',
			$this->render_title(),
			$this->render_description(),
			'absolute' === $icon__placement ? $this->render_icon() : ''
		);
	}

	protected function render_css( $render_slug ) {

		$icon__placement  = $this->props['icon__placement'];
		$use_image        = $this->props['use_image'];
		$icon_color       = $this->props['icon_color'];
		$icon_color_hover = $this->get_hover_value( 'icon_color' );
		$icon_bg_rotate   = $this->props['icon_bg_rotate'];
		$is_negative      = substr( $icon_bg_rotate, 0, 1 ) === '-';
		$alignment        = $this->props['content_alignment'];

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-iconbox',
				'declaration' => sprintf( 'text-align: %1$s;', $alignment ),
			)
		);

		if ( 'right' === $alignment ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-iconbox__icon-wrap',
					'declaration' => 'justify-content: flex-end;',
				)
			);
		} elseif ( 'center' === $alignment ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-iconbox__icon-wrap',
					'declaration' => 'justify-content: center;',
				)
			);
		}

		if ( $icon__placement === 'normal' ) {
			$this->get_responsive_styles(
				'icon_spacing',
				'%%order_class%% .ba-iconbox__icon-wrap',
				array( 'primary' => 'margin-bottom' ),
				array( 'default' => '10px' ),
				$render_slug
			);
		}

		$this->get_responsive_styles(
			'icon_width',
			'%%order_class%% .ba-iconbox__icon',
			array( 'primary' => 'width' ),
			array( 'default' => '100px' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'icon_height',
			'%%order_class%% .ba-iconbox__icon',
			array( 'primary' => 'height' ),
			array( 'default' => '100px' ),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-iconbox__icon',
				'declaration' => sprintf(
					'
                transform: rotate(%1$s);',
					$icon_bg_rotate
				),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-iconbox__icon i, %%order_class%% .ba-iconbox__icon img',
				'declaration' => sprintf(
					'transform: rotate(%1$s%2$sdeg);',
					! $is_negative ? '-' : '',
					absint( $icon_bg_rotate )
				),
			)
		);

		if ( $use_image === 'off' ) {
			$this->get_responsive_styles(
				'icon_size',
				'%%order_class%% .ba-iconbox__icon i',
				array( 'primary' => 'font-size' ),
				array( 'default' => '60px' ),
				$render_slug
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-iconbox__icon i',
					'declaration' => sprintf( 'color: %1$s;', $icon_color ),
				)
			);

			if ( ! empty( $icon_color_hover ) ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%%:hover .ba-iconbox__icon i',
						'declaration' => sprintf( ' color: %1$s;', $icon_color_hover ),
					)
				);
			}
		} else {
			$this->get_responsive_styles(
				'icon_padding',
				'%%order_class%% .ba-iconbox__icon',
				array( 'primary' => 'padding' ),
				array( 'default' => '0px|0px|0px|0px' ),
				$render_slug
			);
		}

		if ( $icon__placement === 'absolute' ) {
			$this->get_absolute_element_styles( $render_slug, 'icon', '%%order_class%% .ba-iconbox__icon' );
		}

		$this->get_responsive_styles(
			'title_spacing',
			'%%order_class%% .ba-iconbox__title',
			array( 'primary' => 'padding-bottom' ),
			array( 'default' => '10px' ),
			$render_slug
		);

		$this->get_badge_styles( $render_slug, 'badge', '%%order_class%% .ba-iconbox__badge', '%%order_class%%:hover .ba-iconbox__badge' );

		$this->get_custom_bg_style( $render_slug, 'icon', '%%order_class%% .ba-iconbox__icon', '%%order_class%%:hover .ba-iconbox__icon' );

	}
}

new BA_Icon_Box();
