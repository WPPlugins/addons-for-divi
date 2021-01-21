<?php

class BA_Cf7_Styler extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/demo/cf7-styler/',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {

		$this->vb_support       = 'on';
		$this->slug             = 'ba_cf7_styler';
		$this->name             = esc_html__( 'Brain CF7 Styler', 'brain-divi-addons' );
		$this->icon_path        = plugin_dir_path( __FILE__ ) . 'cf7.svg';
		$this->main_css_element = '%%order_class%%.ba_cf7_styler';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'general' => esc_html__( 'General', 'brain-divi-addons' ),
				),
			),

			'advanced' => array(
				'toggles' => array(
					'common'         => esc_html__( 'Common', 'brain-divi-addons' ),
					'form_header'    => array(
						'title'             => esc_html__( 'Form Header', 'brain-divi-addons' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'common_tab' => array(
								'name' => esc_html__( 'Common', 'brain-divi-addons' ),
							),
							'title_tab'  => array(
								'name' => esc_html__( 'Title', 'brain-divi-addons' ),
							),
							'text_tab'   => array(
								'name' => esc_html__( 'Text', 'brain-divi-addons' ),
							),
						),
					),
					'form_text'      => array(
						'title'             => esc_html__( 'Form Text', 'brain-divi-addons' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'field_tab'       => array(
								'name' => esc_html__( 'Field', 'brain-divi-addons' ),
							),
							'label_tab'       => array(
								'name' => esc_html__( 'Label', 'brain-divi-addons' ),
							),

							'placeholder_tab' => array(
								'name' => esc_html__( 'Placeholder', 'brain-divi-addons' ),
							),
						),
					),
					'form_field'     => esc_html__( 'Fields', 'brain-divi-addons' ),
					'radio_checkbox' => esc_html__( 'Radio & Checkbox', 'brain-divi-addons' ),
					'submit_button'  => esc_html__( 'Button', 'brain-divi-addons' ),
					'suc_err_msg'    => esc_html__( 'Message', 'brain-divi-addons' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'form_id'    => array(
				'label'    => esc_html__( 'Form Fields', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-cf7-styler input',
			),
			'cf7_labels' => array(
				'label'    => esc_html__( 'Form Label', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-cf7-styler label',
			),
		);

	}

	public function get_fields() {

		return array(

			'use_form_header'              => array(
				'label'       => esc_html__( 'Show Form Header', 'brain-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'     => 'off',
				'toggle_slug' => 'general',
				'affects'     => array(
					'title_font',
					'title_text_color',
					'title_line_height',
					'title_font_size',
					'title_all_caps',
					'title_letter_spacing',
					'title_text_shadow',
					'text_font',
					'text_text_color',
					'text_line_height',
					'text_font_size',
					'text_all_caps',
					'text_letter_spacing',
					'text_text_shadow',
				),
			),

			'form_header_title'            => array(
				'label'       => esc_html__( 'Header Title', 'brain-divi-addons' ),
				'type'        => 'text',
				'show_if'     => array(
					'use_form_header' => 'on',
				),
				'toggle_slug' => 'general',
			),

			'form_header_text'             => array(
				'label'       => esc_html__( 'Header Text', 'brain-divi-addons' ),
				'type'        => 'text',
				'show_if'     => array(
					'use_form_header' => 'on',
				),
				'toggle_slug' => 'general',
			),

			'use_icon'                     => array(
				'label'       => esc_html__( 'Use Icon', 'brain-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'use_form_header' => 'on',
				),
				'default'     => 'off',
				'toggle_slug' => 'general',
			),

			'header_img'                   => array(
				'label'              => esc_html__( 'Header Image', 'brain-divi-addons' ),
				'type'               => 'upload',
				'upload_button_text' => esc_attr__( 'Upload an image', 'brain-divi-addons' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'brain-divi-addons' ),
				'update_text'        => esc_attr__( 'Set As Image', 'brain-divi-addons' ),
				'show_if'            => array(
					'use_icon'        => 'off',
					'use_form_header' => 'on',
				),
				'toggle_slug'        => 'general',
			),

			'header_icon'                  => array(
				'label'       => esc_html__( 'Header Icon', 'brain-divi-addons' ),
				'type'        => 'select_icon',
				'show_if'     => array(
					'use_form_header' => 'on',
					'use_icon'        => 'on',
				),
				'default'     => '',
				'toggle_slug' => 'general',
			),

			'form_header_bg'               => array(
				'label'        => esc_html__( 'Form Header Background', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'form_header',
				'sub_toggle'   => 'common_tab',
			),

			'form_header_padding'          => array(
				'label'          => esc_html__( 'Header Padding', 'brain-divi-addons' ),
				'type'           => 'custom_padding',
				'default'        => '0px|0px|0px|0px',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'form_header',
				'sub_toggle'     => 'common_tab',
				'mobile_options' => true,
			),

			'form_header_bottom'           => array(
				'label'          => esc_html__( 'Bottom Spacing', 'brain-divi-addons' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => '0',
					'max'  => '100',
					'step' => '1',
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'form_header',
				'sub_toggle'     => 'common_tab',
			),

			'form_header_img_bg'           => array(
				'label'        => esc_html__( 'Header Image/Icon Background', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'default'      => '#efefef',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'form_header',
				'sub_toggle'   => 'common_tab',
			),

			'form_header_icon_size'        => array(
				'label'          => esc_html__( 'Header Icon Size', 'brain-divi-addons' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '32px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => '0',
					'max'  => '100',
					'step' => '1',
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'form_header',
				'sub_toggle'     => 'common_tab',
				'show_if'        => array(
					'use_form_header' => 'on',
					'use_icon'        => 'on',
				),
			),

			'form_header_icon_color'       => array(
				'label'        => esc_html__( 'Header Icon Color', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'show_if'      => array(
					'use_form_header' => 'on',
					'use_icon'        => 'on',
				),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'form_header',
				'sub_toggle'   => 'common_tab',
			),

			'form_header_icon_padding'     => array(
				'label'       => esc_html__( 'Header Icon Padding', 'brain-divi-addons' ),
				'type'        => 'custom_padding',
				'default'     => '15px|15px|15px|15px',
				'show_if'     => array(
					'use_form_header' => 'on',
					'use_icon'        => 'on',
				),
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'form_header',
				'sub_toggle'  => 'common_tab',
			),

			'form_bg'                      => array(
				'label'        => esc_html__( 'Form Background', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'common',
			),

			'form_padding'                 => array(
				'label'          => esc_html__( 'Form Padding', 'brain-divi-addons' ),
				'type'           => 'custom_padding',
				'default'        => '0px|0px|0px|0px',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'common',
				'mobile_options' => true,
			),

			'use_form_button_fullwidth'    => array(
				'label'       => esc_html__( 'Fullwidth Button', 'brain-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'     => 'off',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'common',
			),

			'button_alignment'             => array(
				'label'       => esc_html__( 'Button Alignment', 'brain-divi-addons' ),
				'type'        => 'select',
				'options'     => array(
					'left'   => esc_html__( 'Left', 'brain-divi-addons' ),
					'center' => esc_html__( 'Center', 'brain-divi-addons' ),
					'right'  => esc_html__( 'Right', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'use_form_button_fullwidth' => 'off',
				),
				'default'     => 'left',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'common',
			),

			'form_id'                      => array(
				'label'            => esc_html__( 'Select Your Form', 'brain-divi-addons' ),
				'type'             => 'select',
				'option_category'  => 'layout',
				'options'          => array( '0' => __( 'Select a Form', 'brain-divi-addons' ) ) + \ba_get_cf7_forms(),
				'computed_affects' => array(
					'__cf7form',
				),
				'toggle_slug'      => 'general',
			),

			'form_background_color'        => array(
				'label'        => esc_html__( 'Form Field Background Color', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'default'      => '#f5f5f5',
				'toggle_slug'  => 'form_field',
				'tab_slug'     => 'advanced',
			),

			'form_field_active_color'      => array(
				'label'        => esc_html__( 'Form Field Active Border Color', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'form_field',
			),

			'form_field_spacing'           => array(
				'label'          => esc_html__( 'Form Field Spacing Bottom', 'brain-divi-addons' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '20px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => '0',
					'max'  => '200',
					'step' => '1',
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'form_field',
			),

			'form_label_spacing'           => array(
				'label'          => esc_html__( 'Form Label Spacing Bottom', 'brain-divi-addons' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '7px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => '0',
					'max'  => '200',
					'step' => '1',
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'form_text',
				'sub_toggle'     => 'label_tab',
			),

			'cr_custom_styles'             => array(
				'label'            => esc_html__( 'Enable Custom Styles', 'brain-divi-addons' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'          => 'off',
				'computed_affects' => array(
					'__cf7form',
				),
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'radio_checkbox',
			),

			'cr_size'                      => array(
				'label'           => esc_html__( 'Size', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'layout',
				'default_unit'    => 'px',
				'default'         => '20px',
				'range_settings'  => array(
					'min'  => '0',
					'max'  => '50',
					'step' => '1',
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'radio_checkbox',
				'show_if'         => array(
					'cr_custom_styles' => 'on',
				),
			),

			'cr_background_color'          => array(
				'label'        => esc_html__( 'Background Color', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'radio_checkbox',
				'show_if'      => array(
					'cr_custom_styles' => 'on',
				),
			),

			'cr_selected_color'            => array(
				'label'        => esc_html__( 'Selected Color', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'default'      => '#222222',
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'radio_checkbox',
				'show_if'      => array(
					'cr_custom_styles' => 'on',
				),
			),

			'cr_border_color'              => array(
				'label'        => esc_html__( 'Border Color', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'default'      => '#222222',
				'toggle_slug'  => 'radio_checkbox',
				'tab_slug'     => 'advanced',
				'show_if'      => array(
					'cr_custom_styles' => 'on',
				),
			),

			'cr_border_size'               => array(
				'label'           => esc_html__( 'Border Size', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'radio_checkbox',
				'default_unit'    => 'px',
				'default'         => '1px',
				'range_settings'  => array(
					'min'  => '0',
					'max'  => '5',
					'step' => '1',
				),
				'show_if'         => array(
					'cr_custom_styles' => 'on',
				),
			),

			'cr_label_color'               => array(
				'label'        => esc_html__( 'Label Color', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'radio_checkbox',
				'show_if'      => array(
					'cr_custom_styles' => 'on',
				),
			),

			// Success / Error Message.
			'cf7_message_color'            => array(
				'label'        => esc_html__( 'Message Text Color', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'suc_err_msg',
			),

			'cf7_message_bg_color'         => array(
				'label'        => esc_html__( 'Message Background Color', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'suc_err_msg',
			),

			'cf7_border_highlight_color'   => array(
				'label'        => esc_html__( 'Border Highlight Color', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'suc_err_msg',
			),

			// Success.
			'cf7_success_message_color'    => array(
				'label'        => esc_html__( 'Success Message Text Color', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'suc_err_msg',
			),

			'cf7_success_message_bg_color' => array(
				'label'        => esc_html__( 'Success Message Background Color', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'suc_err_msg',
			),

			'cf7_success_border_color'     => array(
				'label'        => esc_html__( 'Success Border Color', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'suc_err_msg',
			),

			// Error.
			'cf7_error_message_color'      => array(
				'label'        => esc_html__( 'Error Message Text Color', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'suc_err_msg',
			),

			'cf7_error_message_bg_color'   => array(
				'label'        => esc_html__( 'Error Message Background Color', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'suc_err_msg',
			),

			'cf7_error_border_color'       => array(
				'label'        => esc_html__( 'Error Border Color', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'suc_err_msg',
			),

			'cf7_message_padding'          => array(
				'label'          => esc_html__( 'Message Padding', 'brain-divi-addons' ),
				'type'           => 'range',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'suc_err_msg',
				'default_unit'   => 'px',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => '0',
					'max'  => '50',
					'step' => '1',
				),
			),

			'cf7_message_margin_top'       => array(
				'label'          => esc_html__( 'Message Margin Top', 'brain-divi-addons' ),
				'type'           => 'range',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'suc_err_msg',
				'default_unit'   => 'px',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => '0',
					'max'  => '50',
					'step' => '1',
				),
			),

			// Header Text.
			'header_title_spacing'         => array(
				'label'          => esc_html__( 'Title Spacing Bottom', 'brain-divi-addons' ),
				'type'           => 'range',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'form_header',
				'sub_toggle'     => 'title_tab',
				'default_unit'   => 'px',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => '0',
					'max'  => '100',
					'step' => '1',
				),
			),

			'__cf7form'                    => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'BA_CF7_Styler', 'get_cf7_shortcode' ),
				'computed_depends_on' => array(
					'form_id',
				),
			),
		);
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['fonts']       = false;
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;

		$advanced_fields['fonts']['form_field_font'] = array(
			'label'       => esc_html__( 'Field', 'brain-divi-addons' ),
			'css'         => array(
				'main'      => implode(
					', ',
					array(
						"{$this->main_css_element} .ba-cf7 .wpcf7 input:not([type=submit])",
						"{$this->main_css_element} .ba-cf7 .wpcf7 input::placeholder",
						"{$this->main_css_element} .ba-cf7 .wpcf7 select",
						"{$this->main_css_element} .ba-cf7 .wpcf7 textarea",
						"{$this->main_css_element} .ba-cf7 .wpcf7 textarea::placeholder",
					)
				),
				'important' => array(
					'font',
					'size',
					'letter-spacing',
					'line-height',
					'text-align',
					'all_caps',
				),
			),
			'toggle_slug' => 'form_text',
			'sub_toggle'  => 'field_tab',
		);

		$advanced_fields['fonts']['labels'] = array(
			'label'       => esc_html__( 'Label', 'brain-divi-addons' ),
			'css'         => array(
				'main'      => "{$this->main_css_element} .ba-cf7 .wpcf7 label",
				'important' => 'all',
			),
			'toggle_slug' => 'form_text',
			'sub_toggle'  => 'label_tab',
		);

		$advanced_fields['fonts']['placeholder'] = array(
			'label'       => esc_html__( 'Placeholder', 'brain-divi-addons' ),
			'css'         => array(
				'main'      => implode(
					', ',
					array(
						"{$this->main_css_element} .ba-cf7 .wpcf7 input::placeholder",
						"{$this->main_css_element} .ba-cf7 .wpcf7 textarea::placeholder",
					)
				),
				'important' => 'all',
			),
			'toggle_slug' => 'form_text',
			'sub_toggle'  => 'placeholder_tab',
		);

		$advanced_fields['fonts']['title'] = array(
			'label'            => esc_html__( 'Title', 'brain-divi-addons' ),
			'css'              => array(
				'main'      => '%%order_class%% .ba-form-header-title',
				'important' => 'all',
			),
			'depends_show_if'  => 'on',
			'hide_text_align'  => true,
			'hide_text_shadow' => true,
			'toggle_slug'      => 'form_header',
			'sub_toggle'       => 'title_tab',
		);

		$advanced_fields['fonts']['text'] = array(
			'label'            => esc_html__( 'Text', 'brain-divi-addons' ),
			'css'              => array(
				'main'      => '%%order_class%% .ba-form-header-text',
				'important' => 'all',
			),
			'depends_show_if'  => 'on',
			'hide_text_align'  => true,
			'hide_text_shadow' => true,
			'toggle_slug'      => 'form_header',
			'sub_toggle'       => 'text_tab',
		);

		$advanced_fields['button']['submit_button'] = array(
			'label'          => esc_html__( 'Button', 'brain-divi-addons' ),
			'css'            => array(
				'main'      => '%%order_class%% .wpcf7-form input[type=submit]',
				'important' => 'all',
			),
			'box_shadow'     => array(
				'css' => array(
					'main' => '%%order_class%% .wpcf7-form input[type=submit]',
				),
			),
			'margin_padding' => array(
				'css' => array(
					'main'      => '%%order_class%% .wpcf7-form input[type=submit]',
					'important' => 'all',
				),
			),
			'toggle_slug'    => 'submit_button',
			'hide_icon'      => true,
			'use_alignment'  => false,
		);

		$advanced_fields['borders']['default'] = array();

		$advanced_fields['borders']['field'] = array(
			'label_prefix' => esc_html__( 'Field', 'brain-divi-addons' ),
			'toggle_slug'  => 'form_field',
			'css'          => array(
				'main'      => array(
					'border_radii'  => sprintf(
						'
						%1$s .ba-cf7-styler .wpcf7 input:not([type=submit]),
						%1$s .ba-cf7-styler .wpcf7 input[type=email],
						%1$s .ba-cf7-styler .wpcf7 input[type=text],
						%1$s .ba-cf7-styler .wpcf7 input[type=url],
						%1$s .ba-cf7-styler .wpcf7 input[type=tel],
						%1$s .ba-cf7-styler .wpcf7 input[type=date],
						%1$s .ba-cf7-styler .wpcf7 select,
						%1$s .ba-cf7-styler .wpcf7 textarea',
						$this->main_css_element
					),

					'border_styles' => sprintf(
						'
						%1$s .ba-cf7-styler .wpcf7 input:not([type=submit]),
						%1$s .ba-cf7-styler .wpcf7 input[type=email],
						%1$s .ba-cf7-styler .wpcf7 input[type=text],
						%1$s .ba-cf7-styler .wpcf7 input[type=url],
						%1$s .ba-cf7-styler .wpcf7 input[type=tel],
						%1$s .ba-cf7-styler .wpcf7 input[type=date],
						%1$s .ba-cf7-styler .wpcf7 select,
						%1$s .ba-cf7-styler .wpcf7 textarea
						',
						$this->main_css_element
					),
				),

				'important' => 'all',
			),
		);

		return $advanced_fields;
	}

	public static function get_cf7_shortcode( $args = array() ) {

		$form_id = $args['form_id'];

		$cf7_shortcode = '';

		if ( 0 === $form_id ) {
			$cf7_shortcode = 'Please select a Contact Form 7.';
		} else {
			$cf7_shortcode = do_shortcode( sprintf( '[contact-form-7 id="%1$s"]', $form_id ) );
		}

		return $cf7_shortcode;
	}

	public function render( $attrs, $content = null, $render_slug ) {

		$this->apply_css( $render_slug );

		$form_id = $this->props['form_id'];

		$cr_custom_styles          = $this->props['cr_custom_styles'];
		$use_form_header           = $this->props['use_form_header'];
		$form_header_title         = $this->props['form_header_title'];
		$form_header_text          = $this->props['form_header_text'];
		$use_form_button_fullwidth = $this->props['use_form_button_fullwidth'];
		$button_alignment          = $this->props['button_alignment'];

		$form_header = '';

		if ( 'on' === $use_form_header ) {

			$header_img  = '' !== $this->props['header_img'] ? $this->props['header_img'] : false;
			$image       = $header_img ? sprintf( '<div class="ba-form-header-image"><img src="%1$s" alt=""/></div>', $header_img ) : '';
			$header_icon = esc_attr( et_pb_process_font_icon( $this->props['header_icon'] ) );

			$icon = sprintf(
				'<div class="ba-form-header-icon">
					<span class="et-pb-icon">
						%1$s
					</span>
				</div> ',
				$header_icon
			);

			$icon_image = 'on' === $this->props['use_icon'] ? $icon : $image;

			$title = isset( $form_header_title ) ? sprintf(
				'<h2 class="ba-form-header-title">%1$s</h2>',
				$form_header_title
			) : '';

			$text = isset( $form_header_text ) ? sprintf(
				'<div class="ba-form-header-text">%1$s</div>',
				$form_header_text
			) : '';

			$header_info = $title || $text ? sprintf( '<div class="ba-form-header-info">%1$s%2$s</div>', $title, $text ) : '';

			if ( ! empty( $form_header_title ) || ! empty( $form_header_text ) ) {
				$form_header = sprintf(
					'
                    <div class="ba-form-header-container">
                        <div class="ba-form-header">
                            %1$s%2$s
                        </div>
                    </div>',
					$icon_image,
					$header_info
				);
			}
		}

		$cr_custom_class = 'on' === $cr_custom_styles ? 'ba-cf7-cr' : '';

		return sprintf(
			'
			<div class="ba-module ba-cf7 ba-cf7-container ba-cf7-styler-button-%4$s">
				%3$s
				<div class="ba-cf7-styler %2$s">
					%1$s
				</div>
			</div>
			',
			$this->get_cf7_shortcode( array( 'form_id' => $form_id ) ),
			$cr_custom_class,
			$form_header,
			'on' !== $use_form_button_fullwidth ? $button_alignment : 'fullwidth'
		);
	}

	public function apply_css( $render_slug ) {

		$this->render_header_css( $render_slug );
		$this->render_form_header_padding( $render_slug );
		$this->render_form_padding( $render_slug );

		$form_background_color        = $this->props['form_background_color'];
		$form_background_color_hover  = $this->get_hover_value( 'form_background_color' );
		$form_field_active_color      = $this->props['form_field_active_color'];
		$cr_custom_styles             = $this->props['cr_custom_styles'];
		$cr_size                      = $this->props['cr_size'];
		$cr_border_size               = $this->props['cr_border_size'];
		$cr_background_color          = $this->props['cr_background_color'];
		$cr_selected_color            = $this->props['cr_selected_color'];
		$cr_border_color              = $this->props['cr_border_color'];
		$cr_label_color               = $this->props['cr_label_color'];
		$cf7_message_color            = $this->props['cf7_message_color'];
		$cf7_message_bg_color         = $this->props['cf7_message_bg_color'];
		$cf7_border_highlight_color   = $this->props['cf7_border_highlight_color'];
		$cf7_success_message_color    = $this->props['cf7_success_message_color'];
		$cf7_success_message_bg_color = $this->props['cf7_success_message_bg_color'];
		$cf7_success_border_color     = $this->props['cf7_success_border_color'];
		$cf7_error_message_color      = $this->props['cf7_error_message_color'];
		$cf7_error_message_bg_color   = $this->props['cf7_error_message_bg_color'];
		$cf7_error_border_color       = $this->props['cf7_error_border_color'];
		$cf7_message_padding          = $this->props['cf7_message_padding'];
		$cf7_message_margin_top       = $this->props['cf7_message_margin_top'];
		$use_form_button_fullwidth    = $this->props['use_form_button_fullwidth'];

		$form_field_spacing                   = $this->props['form_field_spacing'];
		$form_field_spacing_tablet            = $this->props['form_field_spacing_tablet'];
		$form_field_spacing_phone             = $this->props['form_field_spacing_phone'];
		$form_field_spacing_last_edited       = $this->props['form_field_spacing_last_edited'];
		$form_field_spacing_responsive_status = et_pb_get_responsive_status( $form_field_spacing_last_edited );

		$form_label_spacing                   = $this->props['form_label_spacing'];
		$form_label_spacing_tablet            = $this->props['form_label_spacing_tablet'];
		$form_label_spacing_phone             = $this->props['form_label_spacing_phone'];
		$form_label_spacing_last_edited       = $this->props['form_label_spacing_last_edited'];
		$form_label_spacing_responsive_status = et_pb_get_responsive_status( $form_label_spacing_last_edited );

		if ( 'on' === $use_form_button_fullwidth ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-cf7 .wpcf7 input[type=submit], %%order_class%% .wpcf7-form button.wpcf7-submit',
					'declaration' => 'width: 100% !important;',
				)
			);
		}

		if ( '' !== $form_background_color ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-cf7-styler input:not([type=submit]), %%order_class%% .ba-cf7-styler select, %%order_class%% .ba-cf7-styler textarea, %%order_class%% .ba-cf7 .wpcf7-checkbox input[type="checkbox"] + span:before, %%order_class%% .ba-cf7 .wpcf7-acceptance input[type="checkbox"] + span:before, %%order_class%% .ba-cf7 .wpcf7-radio input[type="radio"]:not(:checked) + span:before',
					'declaration' => sprintf(
						'background-color: %1$s!important;',
						$form_background_color
					),
				)
			);
		}

		if ( '' !== $form_field_active_color ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-cf7 .wpcf7 input:not([type=submit]):focus, %%order_class%% .ba-cf7 .wpcf7 select:focus, %%order_class%% .ba-cf7 .wpcf7 textarea:focus',
					'declaration' => sprintf( 'border-color: %1$s!important;', $form_field_active_color ),
				)
			);
		}

		if ( 'on' === $cr_custom_styles ) {

			if ( '' !== $cr_size || '' !== $cr_border_size ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-cf7 .wpcf7-checkbox input[type="checkbox"] + span:before, %%order_class%% .ba-cf7 .wpcf7-acceptance input[type="checkbox"] + span:before, %%order_class%% .ba-cf7 .wpcf7-radio input[type="radio"] + span:before',
						'declaration' => sprintf(
							'width: %1$s!important; height: %1$s!important; border-width:%2$s!important;',
							esc_html( $cr_size ),
							esc_html( $cr_border_size )
						),
					)
				);
			}

			if ( '' !== $cr_size && is_numeric( $cr_size ) ) {
				$font_size = $cr_size / 1.2;
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-cf7 .wpcf7-acceptance input[type=checkbox]:checked + span:before, %%order_class%% .ba-cf7 .wpcf7-checkbox input[type=checkbox]:checked + span:before',
						'declaration' => sprintf(
							'font-size: %1$s!important;',
							esc_html( $font_size )
						),
					)
				);
			}

			if ( '' !== $cr_background_color ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-cf7 .wpcf7-checkbox input[type="checkbox"] + span:before, %%order_class%% .ba-cf7 .wpcf7-acceptance input[type="checkbox"] + span:before, %%order_class%% .ba-cf7 .wpcf7-radio input[type="radio"]:not(:checked) + span:before',
						'declaration' => sprintf(
							'background-color: %1$s!important;',
							esc_html( $cr_background_color )
						),
					)
				);
			}

			if ( '' !== $cr_background_color ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-cf7 .wpcf7-radio input[type="radio"]:checked + span:before',
						'declaration' => sprintf(
							'box-shadow:inset 0px 0px 0px 4px %1$s!important;',
							esc_html( $cr_background_color )
						),
					)
				);
			}

			if ( '' !== $cr_selected_color ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-cf7 .wpcf7-checkbox input[type="checkbox"]:checked + span:before, %%order_class%% .ba-cf7 .wpcf7-acceptance input[type="checkbox"]:checked + span:before',
						'declaration' => sprintf(
							'color: %1$s!important;',
							esc_html( $cr_selected_color )
						),
					)
				);
			}

			if ( '' !== $cr_selected_color ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-cf7 .wpcf7-radio input[type="radio"]:checked + span:before',
						'declaration' => sprintf(
							'background-color: %1$s!important;',
							esc_html( $cr_selected_color )
						),
					)
				);
			}

			if ( '' !== $cr_border_color ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-cf7 .wpcf7-checkbox input[type=radio] + span:before, %%order_class%% .ba-cf7 .wpcf7-radio input[type=checkbox] + span:before, %%order_class%% .ba-cf7 .wpcf7-acceptance input[type="checkbox"] + span:before',
						'declaration' => sprintf(
							'border-color: %1$s!important;',
							esc_html( $cr_border_color )
						),
					)
				);
			}

			if ( '' !== $cr_label_color ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-cf7 .wpcf7-checkbox label, %%order_class%% .wpcf7-radio label',
						'declaration' => sprintf(
							'color: %1$s!important;',
							esc_html( $cr_label_color )
						),
					)
				);
			}
		}

		if ( '' !== $cf7_message_color ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-cf7-styler span.wpcf7-not-valid-tip',
					'declaration' => sprintf(
						'color: %1$s!important;',
						esc_html( $cf7_message_color )
					),
				)
			);
		}

		if ( '' !== $cf7_message_bg_color ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-cf7-styler span.wpcf7-not-valid-tip',
					'declaration' => sprintf(
						'background-color: %1$s!important;',
						esc_html( $cf7_message_bg_color )
					),
				)
			);
		}

		if ( '' !== $cf7_border_highlight_color ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-cf7-styler span.wpcf7-not-valid-tip',
					'declaration' => sprintf(
						'border-color: %1$s!important;',
						esc_html( $cf7_border_highlight_color )
					),
				)
			);
		}

		// Success.
		if ( '' !== $cf7_success_message_color ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-cf7-styler .wpcf7-mail-sent-ok',
					'declaration' => sprintf(
						'color: %1$s!important;',
						esc_html( $cf7_success_message_color )
					),
				)
			);
		}

		if ( '' !== $cf7_success_message_bg_color ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-cf7-styler .wpcf7-mail-sent-ok',
					'declaration' => sprintf(
						'background-color: %1$s!important;',
						esc_html( $cf7_success_message_bg_color )
					),
				)
			);
		}

		if ( '' !== $cf7_success_border_color ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-cf7-styler .wpcf7-mail-sent-ok',
					'declaration' => sprintf(
						'border-color: %1$s!important;',
						esc_html( $cf7_success_border_color )
					),
				)
			);
		}

		// Error.
		if ( '' !== $cf7_error_message_color ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .wpcf7-validation-errors',
					'declaration' => sprintf(
						'color: %1$s!important;',
						esc_html( $cf7_error_message_color )
					),
				)
			);
		}

		if ( '' !== $cf7_error_message_bg_color ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .wpcf7-validation-errors',
					'declaration' => sprintf(
						'background-color: %1$s!important;',
						esc_html( $cf7_error_message_bg_color )
					),
				)
			);
		}

		if ( '' !== $cf7_error_border_color ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .wpcf7-validation-errors',
					'declaration' => sprintf(
						'border-color: %1$s!important;',
						esc_html( $cf7_error_border_color )
					),
				)
			);
		}

		if ( '' !== $cf7_message_padding ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% span.wpcf7-not-valid-tip',
					'declaration' => sprintf(
						'padding: %1$s!important;',
						esc_html( $cf7_message_padding )
					),
				)
			);
		}

		if ( '' !== $cf7_message_margin_top ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% span.wpcf7-not-valid-tip',
					'declaration' => sprintf(
						'margin-top: %1$s!important;',
						esc_html( $cf7_message_margin_top )
					),
				)
			);
		}

		// Form Label Spacing.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-cf7 .wpcf7-form-control:not(.wpcf7-submit)',
				'declaration' => sprintf( 'margin-top: %1$s;', $form_label_spacing ),
			)
		);

		if ( ! empty( $form_label_spacing_tablet ) && $form_label_spacing_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-cf7 .wpcf7-form-control:not(.wpcf7-submit)',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'margin-top: %1$s;', $form_label_spacing_tablet ),
				)
			);
		}

		if ( ! empty( $form_label_spacing_phone ) && $form_label_spacing_responsive_status ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-cf7 .wpcf7-form-control:not(.wpcf7-submit)',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'margin-top: %1$s;', $form_label_spacing_phone ),
				)
			);
		}

		// Form Field Spacing.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-cf7 .wpcf7-form-control:not(.wpcf7-submit)',
				'declaration' => sprintf( 'margin-bottom: %1$s;', $form_field_spacing ),
			)
		);

		if ( ! empty( $form_field_spacing_tablet ) && $form_field_spacing_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-cf7 .wpcf7-form-control:not(.wpcf7-submit)',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'margin-bottom: %1$s;', $form_field_spacing_tablet ),
				)
			);
		}

		if ( ! empty( $form_field_spacing_phone ) && $form_field_spacing_responsive_status ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-cf7 .wpcf7-form-control:not(.wpcf7-submit)',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'margin-bottom: %1$s;', $form_field_spacing_phone ),
				)
			);
		}

	}

	public function render_header_css( $render_slug ) {

		$form_header_bg           = $this->props['form_header_bg'];
		$form_header_bottom       = $this->props['form_header_bottom'];
		$form_header_img_bg       = $this->props['form_header_img_bg'];
		$form_header_icon_padding = $this->props['form_header_icon_padding'];
		$form_header_icon_color   = $this->props['form_header_icon_color'];
		$form_bg                  = $this->props['form_bg'];
		$header_title_spacing     = $this->props['header_title_spacing'];

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-form-header .ba-form-header-title',
				'declaration' => "padding-bottom: {$header_title_spacing}!important;",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-form-header-container',
				'declaration' => "background-color: {$form_header_bg}!important;",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-form-header-container',
				'declaration' => "margin-bottom: {$form_header_bottom}!important;",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-form-header-icon, %%order_class%% .ba-form-header-image',
				'declaration' => "background-color: {$form_header_img_bg}!important;",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-form-header-icon, %%order_class%% .ba-form-header-image',
				'declaration' => $this->process_margin_padding( $form_header_icon_padding, 'padding', true ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-form-header-icon span',
				'declaration' => "color: {$form_header_icon_color}!important;",
			)
		);

		$this->get_responsive_styles(
			'form_header_icon_size',
			'%%order_class%% .ba-form-header-icon span',
			array(
				'primary'   => 'font-size',
				'important' => false,
			),
			array( 'default' => '32px' ),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-cf7-styler',
				'declaration' => "background-color: {$form_bg}!important;",
			)
		);
	}

	public function render_form_header_padding( $render_slug ) {

		$form_header_padding                   = $this->props['form_header_padding'];
		$form_header_padding_tablet            = $this->props['form_header_padding_tablet'];
		$form_header_padding_phone             = $this->props['form_header_padding_phone'];
		$form_header_padding_last_edited       = $this->props['form_header_padding_last_edited'];
		$form_header_padding_responsive_status = et_pb_get_responsive_status( $form_header_padding_last_edited );

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-form-header-container',
				'declaration' => $this->process_margin_padding( $form_header_padding, 'padding', true ),
			)
		);

		if ( $form_header_padding_tablet && $form_header_padding_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-form-header-container',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => $this->process_margin_padding( $form_header_padding_tablet, 'padding', true ),
				)
			);
		}

		if ( $form_header_padding_phone && $form_header_padding_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-form-header-container',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => $this->process_margin_padding( $form_header_padding_phone, 'padding', true ),
				)
			);
		}
	}

	public function render_form_padding( $render_slug ) {

		$form_padding                   = $this->props['form_padding'];
		$form_padding_tablet            = $this->props['form_padding_tablet'];
		$form_padding_phone             = $this->props['form_padding_phone'];
		$form_padding_last_edited       = $this->props['form_padding_last_edited'];
		$form_padding_responsive_status = et_pb_get_responsive_status( $form_padding_last_edited );

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-cf7-styler',
				'declaration' => BA_Builder_Module::process_margin_padding( $form_padding, 'padding', false ),
			)
		);

		if ( $form_padding_tablet && $form_padding_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-cf7-styler',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => BA_Builder_Module::process_margin_padding( $form_padding_tablet, 'padding', false ),
				)
			);
		}

		if ( $form_padding_phone && $form_padding_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-cf7-styler',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => BA_Builder_Module::process_margin_padding( $form_padding_phone, 'padding', false ),
				)
			);
		}

	}

}

new BA_Cf7_Styler();
