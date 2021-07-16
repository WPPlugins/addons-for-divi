<?php
class BA_Advanced_Divider extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/advanced-divider/',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {

		$this->vb_support = 'on';
		$this->slug       = 'ba_advanced_divider';
		$this->name       = esc_html__( 'Brain Divider', 'brain-divi-addons' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'advanced-divider.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Content', 'brain-divi-addons' ),
					'text_mask'    => esc_html__( 'Mask', 'brain-divi-addons' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'divider'   => esc_html__( 'Divider', 'brain-divi-addons' ),
					'text'      => array(
						'title'             => esc_html__( 'Divider Text', 'brain-divi-addons' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'general' => array(
								'name' => esc_html__( 'General', 'brain-divi-addons' ),
							),
							'typo'    => array(
								'name' => esc_html__( 'Typography', 'brain-divi-addons' ),
							),
						),
					),
					'icon'      => esc_html__( 'Icon/Image', 'brain-divi-addons' ),
					'border'    => esc_html__( 'Border', 'brain-divi-addons' ),
					'text_mask' => esc_html__( 'Mask', 'brain-divi-addons' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'title'  => array(
				'label'    => esc_html__( 'Divider Text', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-divider__text span',
			),
			'icon'   => array(
				'label'    => esc_html__( 'Divider Icon', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-divider__icon i',
			),
			'image'  => array(
				'label'    => esc_html__( 'Divider Image', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-divider__image img',
			),
			'border' => array(
				'label'    => esc_html__( 'Divider Border', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-divider__border',
			),
		);
	}

	public function get_fields() {

		$content = array(
			'active_element' => array(
				'label'       => esc_html__( 'Divider Element', 'brain-divi-addons' ),
				'description' => esc_html__( 'You can insert an element like text, icon, or image on the divider', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'main_content',
				'default'     => 'icon',
				'options'     => array(
					'text'  => esc_html__( 'Text', 'brain-divi-addons' ),
					'icon'  => esc_html__( 'Icon', 'brain-divi-addons' ),
					'image' => esc_html__( 'Image', 'brain-divi-addons' ),
				),
			),
			'img_url'        => array(
				'label'              => esc_html__( 'Image', 'brain-divi-addons' ),
				'description'        => esc_html__( 'Upload an image for divider, or type in the URL to the image you would like to display', 'brain-divi-addons' ),
				'type'               => 'upload',
				'data_type'          => 'image',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'brain-divi-addons' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'brain-divi-addons' ),
				'update_text'        => esc_attr__( 'Set As Image', 'brain-divi-addons' ),
				'toggle_slug'        => 'main_content',
				'show_if'            => array(
					'active_element' => 'image',
				),
			),
			'title'          => array(
				'label'           => esc_html__( 'Divider Text', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Text will appear on the divider', 'brain-divi-addons' ),
				'type'            => 'text',
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'text',
				'show_if'         => array(
					'active_element' => 'text',
				),
			),
			'icon'           => array(
				'label'           => esc_html__( 'Select Icon', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Choose an icon to display with your divider', 'brain-divi-addons' ),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'main_content',
				'default'         => '',
				'show_if'         => array(
					'active_element' => 'icon',
				),
			),
			'use_mask'       => array(
				'label'           => esc_html__( 'Use Mask', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Select whether you want to use the mask or not', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'text_mask',
				'show_if_not'     => array(
					'active_element' => 'image',
				),
			),
			'mask_url'       => array(
				'label'              => esc_html__( 'Upload Mask Image', 'brain-divi-addons' ),
				'description'        => esc_html__( 'Upload an image for the masking, or type in the URL to the image you would like to show into the masking', 'brain-divi-addons' ),
				'type'               => 'upload',
				'data_type'          => 'image',
				'upload_button_text' => esc_attr__( 'Upload an image', 'brain-divi-addons' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'brain-divi-addons' ),
				'update_text'        => esc_attr__( 'Set As Image', 'brain-divi-addons' ),
				'toggle_slug'        => 'text_mask',
				'show_if'            => array(
					'active_element' => array( 'icon', 'text' ),
					'use_mask'       => 'on',
				),
			),
		);

		$divider = array(
			'content_alignment' => array(
				'label'           => esc_html__( 'Content Alignment', 'brain-divi-addons' ),
				'description'     => esc_html__( 'This controls how your content is aligned within the divider', 'brain-divi-addons' ),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'    => 'module_align',
				'default'         => 'center',
				'toggle_slug'     => 'divider',
				'tab_slug'        => 'advanced',
			),
			'use_shape'         => array(
				'label'           => esc_html__( 'Use Bottom Shape', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Insert a shape on the divider bottom', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'off',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'divider',
			),
			'shape'             => array(
				'label'       => esc_html__( 'Select Shape', 'brain-divi-addons' ),
				'description' => esc_html__( 'Choice your desire shape for the divider bottom', 'brain-divi-addons' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'divider',
				'default'     => 'shape_1',
				'options'     => array(
					'shape_1'  => esc_html__( 'Shape 1', 'brain-divi-addons' ),
					'shape_2'  => esc_html__( 'Shape 2', 'brain-divi-addons' ),
					'shape_3'  => esc_html__( 'Shape 3', 'brain-divi-addons' ),
					'shape_4'  => esc_html__( 'Shape 4', 'brain-divi-addons' ),
					'shape_5'  => esc_html__( 'Shape 5', 'brain-divi-addons' ),
					'shape_6'  => esc_html__( 'Shape 6', 'brain-divi-addons' ),
					'shape_7'  => esc_html__( 'Shape 7', 'brain-divi-addons' ),
					'shape_8'  => esc_html__( 'Shape 8', 'brain-divi-addons' ),
					'shape_9'  => esc_html__( 'Shape 9', 'brain-divi-addons' ),
					'shape_10' => esc_html__( 'Shape 10', 'brain-divi-addons' ),
					'shape_11' => esc_html__( 'Shape 11', 'brain-divi-addons' ),
					'shape_12' => esc_html__( 'Shape 12', 'brain-divi-addons' ),
					'shape_13' => esc_html__( 'Shape 13', 'brain-divi-addons' ),
					'shape_14' => esc_html__( 'Shape 14', 'brain-divi-addons' ),
					'shape_15' => esc_html__( 'Shape 15', 'brain-divi-addons' ),
					'shape_16' => esc_html__( 'Shape 16', 'brain-divi-addons' ),
					'shape_17' => esc_html__( 'Shape 17', 'brain-divi-addons' ),
					'shape_18' => esc_html__( 'Shape 18', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'use_shape' => 'on',
				),
			),
			'shape_width'       => array(
				'label'          => esc_html__( 'Shape Width', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Increase or decrease default divider bottom shape width', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '280px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 800,
				),
				'mobile_options' => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'divider',
				'show_if'        => array(
					'use_shape' => 'on',
				),
			),
			'shape_weight'      => array(
				'label'          => esc_html__( 'Shape Weight', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Increase or decrease default divider bottom shape weight', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '1',
				'unitless'       => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 8,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'divider',
				'show_if'        => array(
					'use_shape' => 'on',
				),
			),
			'shape_color'       => array(
				'label'       => esc_html__( 'Shape Color', 'brain-divi-addons' ),
				'description' => esc_html__( 'Choose your desired color for the divider bottom shape', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'divider',
				'default'     => '#333333',
				'show_if'     => array(
					'use_shape' => 'on',
				),
			),
			'shape_margin'      => array(
				'label'          => esc_html__( 'Shape Margin', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Shape Margin adds extra space to the outside of the elements, increasing the distance between the element and other items on the page These controls help you to put divider bottom shape on your desire position', 'brain-divi-addons' ),
				'type'           => 'custom_margin',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'divider',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
				'show_if'        => array(
					'use_shape' => 'on',
				),
			),
		);

		$icon_img = array(
			'icon_color'   => array(
				'label'       => esc_html__( 'Icon Color', 'brain-divi-addons' ),
				'description' => esc_html__( 'Choose your desired color for the divider icon', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'default'     => $this->default_color,
				'show_if'     => array(
					'active_element' => 'icon',
					'use_mask'       => 'off',
				),
			),
			'icon_bg'      => array(
				'label'       => esc_html__( 'Icon Background', 'brain-divi-addons' ),
				'description' => esc_html__( 'Set the background color of divider icon', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'show_if'     => array(
					'active_element' => 'icon',
					'use_mask'       => 'off',
				),
			),
			'icon_size'    => array(
				'label'          => esc_html__( 'Icon Size', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Increase or decrease the size of divider icon', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '40px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'icon',
				'show_if'        => array(
					'active_element' => 'icon',
				),
			),
			'icon_padding' => array(
				'label'          => esc_html__( 'Icon Padding', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Icon padding adds extra space to the inside of the icon, increasing the distance between the edge of the icon', 'brain-divi-addons' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'toggle_slug'    => 'icon',
				'show_if'        => array(
					'active_element' => 'icon',
				),
			),
			'img_width'    => array(
				'label'          => esc_html__( 'Image Width', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Increase or decrease divider image width. This control helps you to reduce or extend the image size', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '100px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 500,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'icon',
				'show_if'        => array(
					'active_element' => 'image',
				),
			),
		);

		$border = array(
			'border_type'          => array(
				'label'       => esc_html__( 'Border Type', 'brain-divi-addons' ),
				'description' => esc_html__( 'Select different types of border for the divider', 'brain-divi-addons' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'border',
				'default'     => 'classic',
				'options'     => array(
					'none'    => esc_html__( 'None', 'brain-divi-addons' ),
					'classic' => esc_html__( 'Classic', 'brain-divi-addons' ),
					'pattern' => esc_html__( 'Pattern', 'brain-divi-addons' ),
				),
				'show_if_not' => array(
					'use_shape' => 'on',
				),
			),
			'border_style_classic' => array(
				'label'       => esc_html__( 'Border Style', 'brain-divi-addons' ),
				'description' => esc_html__( 'Select different types of border style for the divider', 'brain-divi-addons' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'border',
				'default'     => 'double',
				'options'     => array(
					'solid'  => esc_html__( 'Solid', 'brain-divi-addons' ),
					'double' => esc_html__( 'Double', 'brain-divi-addons' ),
					'dotted' => esc_html__( 'Dotted', 'brain-divi-addons' ),
					'dashed' => esc_html__( 'Dashed', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'border_type' => 'classic',
				),
				'show_if_not' => array(
					'use_shape' => 'on',
				),
			),
			'border_style_pattern' => array(
				'label'       => esc_html__( 'Border Style', 'brain-divi-addons' ),
				'description' => esc_html__( 'Select different types of border style for the divider', 'brain-divi-addons' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'border',
				'default'     => 'curved',
				'options'     => array(
					'curved' => esc_html__( 'Curved', 'brain-divi-addons' ),
					'zigzag' => esc_html__( 'Zigzag', 'brain-divi-addons' ),
					'square' => esc_html__( 'Square', 'brain-divi-addons' ),
					'curly'  => esc_html__( 'Curly', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'border_type' => 'pattern',
				),
				'show_if_not' => array(
					'use_shape' => 'on',
				),
			),
			'border_gap'           => array(
				'label'          => esc_html__( 'Border Spacing', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Increase or decrease default divider spacing relative to the divider content', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '20px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'border',
				'show_if_not'    => array(
					'type'      => 'none',
					'use_shape' => 'on',
				),
			),
			'border_color'         => array(
				'label'       => esc_html__( 'Border Color', 'brain-divi-addons' ),
				'description' => esc_html__( 'Choose your desired color for the divider border', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'border',
				'default'     => $this->default_color,
				'show_if_not' => array(
					'type'      => 'none',
					'use_shape' => 'on',
				),
			),
			'border_weight'        => array(
				'label'          => esc_html__( 'Border Weight', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Increase or decrease divider border weight', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '6px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 15,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'border',
				'show_if_not'    => array(
					'type'      => 'none',
					'use_shape' => 'on',
				),
			),
			'border_height'        => array(
				'label'          => esc_html__( 'Border Height', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Increase or decrease divider border height', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '10px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'border',
				'show_if_not'    => array(
					'type'      => 'none',
					'use_shape' => 'on',
				),
				'show_if'        => array(
					'border_type' => 'pattern',
				),
			),
			'border_offset'        => array(
				'label'          => esc_html__( 'Border offset Top', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Increase or decrease offset value relative to the divider content', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '0px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => -50,
					'step' => 1,
					'max'  => 50,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'border',
				'show_if_not'    => array(
					'type'      => 'none',
					'use_shape' => 'on',
				),
			),
		);

		$mask_style = array(
			'mask_repeat' => array(
				'label'       => esc_html__( 'Image Repeat', 'brain-divi-addons' ),
				'description' => esc_html__( ' Select whether you want to repeat mask image or not', 'brain-divi-addons' ),
				'type'        => 'select',
				'options'     => array(
					'repeat'    => esc_html__( 'Repeat', 'brain-divi-addons' ),
					'no-repeat' => esc_html__( 'No Repeat', 'brain-divi-addons' ),
				),
				'default'     => 'repeat',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'text_mask',
				'show_if'     => array(
					'use_mask'       => 'on',
					'active_element' => array( 'icon', 'text' ),
				),
			),
			'mask_size'   => array(
				'label'       => esc_html__( 'Image Size', 'brain-divi-addons' ),
				'description' => esc_html__( 'Select mask image size', 'brain-divi-addons' ),
				'type'        => 'select',
				'options'     => array(
					'contain' => esc_html__( 'Actual Size', 'brain-divi-addons' ),
					'cover'   => esc_html__( 'Fit', 'brain-divi-addons' ),
				),
				'default'     => 'cover',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'text_mask',
				'show_if'     => array(
					'use_mask'       => 'on',
					'active_element' => array( 'icon', 'text' ),
				),
			),
			'mask_pos'    => array(
				'label'       => esc_html__( 'Image Position', 'brain-divi-addons' ),
				'description' => esc_html__( 'Select the mask image position', 'brain-divi-addons' ),
				'type'        => 'select',
				'options'     => array(
					'left top'      => esc_html__( 'Left Top', 'brain-divi-addons' ),
					'left center'   => esc_html__( 'Left Center', 'brain-divi-addons' ),
					'left bottom'   => esc_html__( 'Left Bottom', 'brain-divi-addons' ),
					'right top'     => esc_html__( 'Right Top', 'brain-divi-addons' ),
					'right center'  => esc_html__( 'Right Center', 'brain-divi-addons' ),
					'right bottom'  => esc_html__( 'Right Bottom', 'brain-divi-addons' ),
					'center top'    => esc_html__( 'Center Top', 'brain-divi-addons' ),
					'center center' => esc_html__( 'Center Center', 'brain-divi-addons' ),
					'center bottom' => esc_html__( ' Center Bottom', 'brain-divi-addons' ),
					'custom'        => esc_html__( 'Custom Position', 'brain-divi-addons' ),
				),
				'default'     => 'center center',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'text_mask',
				'show_if'     => array(
					'use_mask'       => 'on',
					'active_element' => array( 'icon', 'text' ),
				),
			),
			'mask_hz_pos' => array(
				'label'       => esc_html__( 'Horizontal  Value', 'brain-divi-addons' ),
				'description' => esc_html__( 'Set horizontal masking image position value', 'brain-divi-addons' ),
				'type'        => 'text',
				'default'     => '0%',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'text_mask',
				'show_if'     => array(
					'mask_pos'       => 'custom',
					'use_mask'       => 'on',
					'active_element' => array( 'icon', 'text' ),
				),
			),
			'mask_vr_pos' => array(
				'label'       => esc_html__( 'Vertical  Value', 'brain-divi-addons' ),
				'description' => esc_html__( 'Set vertical masking image position value', 'brain-divi-addons' ),
				'type'        => 'text',
				'default'     => '0%',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'text_mask',
				'show_if'     => array(
					'mask_pos'       => 'custom',
					'use_mask'       => 'on',
					'active_element' => array( 'icon', 'text' ),
				),
			),
		);

		$text_style = array(
			'text_padding'    => array(
				'label'          => esc_html__( 'Padding', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Text padding adds extra space to the inside of the text, increasing the distance between the edge of the text', 'brain-divi-addons' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'toggle_slug'    => 'text',
				'sub_toggle'     => 'general',
			),
			'text_background' => array(
				'label'          => esc_html__( 'Background', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Set the background color of divider text', 'brain-divi-addons' ),
				'type'           => 'color-alpha',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'sub_toggle'     => 'general',
				'toggle_slug'    => 'text',
			),
			'text_radius'     => array(
				'label'          => esc_html__( 'Border Radius', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can control the corner radius of the text. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'brain-divi-addons' ),
				'type'           => 'border-radius',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'toggle_slug'    => 'text',
				'sub_toggle'     => 'general',
				'default'        => 'off|0|0|0|0',
			),
		);

		return array_merge( $content, $border, $text_style, $icon_img, $divider, $mask_style );
	}

	public function get_advanced_fields_config() {
		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['borders']     = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['fonts']['title'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .ba-divider__text',
				'important' => 'all',
			),
			'header_level'    => array(
				'default' => 'h1',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'text',
			'sub_toggle'      => 'typo',
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '30px',
			),
		);

		$advanced_fields['borders']['icon'] = array(
			'toggle_slug' => 'icon',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-divider__element i,%%order_class%% .ba-divider__element img',
					'border_styles' => '%%order_class%% .ba-divider__element i,%%order_class%% .ba-divider__element img',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333',
					'style' => 'solid',
				),
			),
		);

		return $advanced_fields;
	}

	public function render_title() {
		$title                 = $this->props['title'];
		$title_level           = $this->props['title_level'];
		$processed_title_level = et_pb_process_header_level( $title_level, 'h2' );
		$processed_title_level = esc_html( $processed_title_level );

		if ( ! empty( $title ) ) {
			return sprintf(
				'<%1$s class="ba-divider__element ba-divider__text"><span>%2$s</span></%1$s>',
				$processed_title_level,
				$title
			);
		}
	}

	public function render_icon() {
		$icon = $this->props['icon'];
		$icon = esc_attr( et_pb_process_font_icon( $icon ) );

		if ( ! empty( $icon ) ) {
			return sprintf(
				'
                <div class="ba-divider__icon ba-divider__element">
                    <i class="ba-icon ba-et-icon" data-icon="%1$s"></i>
                </div>',
				$icon
			);
		}
	}

	public function render_uploaded_image() {
		$img_url = $this->props['img_url'];

		if ( ! empty( $img_url ) ) {
			return sprintf(
				'
                <div class="ba-divider__image ba-divider__element">
                    <img src="%1$s" alt="" />
                </div>',
				$img_url
			);
		}
	}

	public function render_element() {
		$active_element = $this->props['active_element'];
		if ( 'text' === $active_element ) {
			return $this->render_title();
		} elseif ( 'icon' === $active_element ) {
			return $this->render_icon();
		} elseif ( 'image' === $active_element ) {
			return $this->render_uploaded_image();
		}
	}

	public function render_left_border() {

		$use_shape         = $this->props['use_shape'];
		$content_alignment = $this->props['content_alignment'];

		if ( 'off' === $use_shape && 'left' !== $content_alignment ) {
			return '<div class="ba-divider__border"></div>';
		}
	}

	public function render_right_border() {
		$use_shape         = $this->props['use_shape'];
		$content_alignment = $this->props['content_alignment'];

		if ( 'off' === $use_shape && 'right' !== $content_alignment ) {
			return '<div class="ba-divider__border"></div>';
		}
	}

	public function render_shape() {
		include 'shapes.php';

		$use_shape = $this->props['use_shape'];
		$shape     = $this->props['shape'];

		if ( 'on' === $use_shape ) {
			return '<div class="ba-divider__shape">' . $shapes[ $shape ] . '</div>';
		}
	}

	public function render( $attrs, $content = null, $render_slug ) {

		$this->render_css( $render_slug );

		return sprintf(
			'<div class="ba-module ba-divider">
                %1$s
                %2$s
                %3$s
                %4$s
            </div>',
			$this->render_left_border(),
			$this->render_element(),
			$this->render_right_border(),
			$this->render_shape()
		);
	}

	protected function render_css( $render_slug ) {

		$use_mask             = $this->props['use_mask'];
		$mask_url             = $this->props['mask_url'];
		$active_element       = $this->props['active_element'];
		$content_alignment    = $this->props['content_alignment'];
		$border_gap           = $this->props['border_gap'];
		$mask_size            = $this->props['mask_size'];
		$mask_pos             = $this->props['mask_pos'];
		$mask_hz_pos          = $this->props['mask_hz_pos'];
		$mask_vr_pos          = $this->props['mask_vr_pos'];
		$icon_color           = $this->props['icon_color'];
		$icon_size            = $this->props['icon_size'];
		$icon_bg              = $this->props['icon_bg'];
		$img_width            = $this->props['img_width'];
		$border_type          = $this->props['border_type'];
		$border_style_classic = $this->props['border_style_classic'];
		$border_style_pattern = $this->props['border_style_pattern'];
		$border_height        = $this->props['border_height'];
		$border_color         = $this->props['border_color'];
		$border_weight        = $this->props['border_weight'];
		$mask_repeat          = $this->props['mask_repeat'];
		$use_shape            = $this->props['use_shape'];
		$shape_weight         = $this->props['shape_weight'];
		$shape_color          = $this->props['shape_color'];

		if ( 'image' !== $active_element
			&& 'on' === $use_mask
			&& ! empty( $mask_url )
		) {

			$selector = '%%order_class%% .ba-divider__icon i';
			if ( 'text' === $active_element ) {
				$selector = '%%order_class%% .ba-divider__text';
			}

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $selector,
					'declaration' => sprintf(
						'
                    color: transparent!important;
                    background-image: url("%1$s");
                    background-size: %2$s;
                    background-repeat: %3$s;
                    -webkit-background-clip: text;
                    -moz-background-clip: text;
                    -o-background-clip: text;
                    background-clip: text;',
						$mask_url,
						$mask_size,
						$mask_repeat
					),
				)
			);

			if ( 'custom' !== $mask_pos ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => $selector,
						'declaration' => sprintf( 'background-position: %1$s;', $mask_pos ),
					)
				);
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => $selector,
						'declaration' => sprintf( 'background-position: %1$s %2$s;', $mask_vr_pos, $mask_hz_pos ),
					)
				);
			}
		}

		if ( 'off' === $use_shape ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-divider',
					'declaration' => 'align-items: center;',
				)
			);

			if ( 'left' === $content_alignment ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-divider__element',
						'declaration' => sprintf( 'padding-right: %1$s;', $border_gap ),
					)
				);
			} elseif ( 'right' === $content_alignment ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-divider__element',
						'declaration' => sprintf( 'padding-left: %1$s;', $border_gap ),
					)
				);
			} elseif ( 'center' === $content_alignment ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-divider__element',
						'declaration' => sprintf( 'padding-left: %1$s; padding-right: %1$s;', $border_gap ),
					)
				);
			}

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-divider__border',
					'declaration' => sprintf(
						'margin-top: %1$s;',
						$this->props['border_offset']
					),
				)
			);

			// Border type.
			if ( 'none' !== $border_type ) {
				if ( '#' === $border_color[0] ) {
					$border_color = $this->hex_to_rgb( $border_color );
				}

				if ( 'classic' === $border_type ) {

					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .ba-divider__border',
							'declaration' => sprintf(
								'border-top: %1$s %2$s %3$s;',
								$border_weight,
								$border_style_classic,
								$border_color
							),
						)
					);
				} elseif ( 'pattern' === $border_type ) {

					$pattern_bg = $this->get_pattern( $border_style_pattern, $border_color, $border_weight );

					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .ba-divider__border',
							'declaration' => sprintf(
								'background-image: url("%1$s");
                            	height: %2$s;
                            	background-size: %2$s 100%%;',
								$pattern_bg,
								$border_height
							),
						)
					);
				}
			}
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-divider',
					'declaration' => 'flex-direction: column;',
				)
			);

			if ( 'center' === $content_alignment ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-divider',
						'declaration' => 'align-items: center;',
					)
				);
			} elseif ( 'right' === $content_alignment ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-divider',
						'declaration' => 'align-items: flex-end;',
					)
				);
			} elseif ( 'center' === $content_alignment ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-divider',
						'declaration' => 'align-items: flex-start;',
					)
				);
			}

			// shape margin.
			$this->get_responsive_styles(
				'shape_margin',
				'%%order_class%% .ba-divider__shape',
				array( 'primary' => 'margin' ),
				array( 'default' => '0px|0px|0px|0px' ),
				$render_slug
			);

			// shape width.
			$this->get_responsive_styles(
				'shape_width',
				'%%order_class%% .ba-divider__shape svg',
				array(
					'primary'   => 'width',
					'important' => true,
				),
				array( 'default' => '280px' ),
				$render_slug
			);

			// shape weight & color.
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-divider__shape svg *',
					'declaration' => "stroke-width: {$shape_weight}!important;stroke: {$shape_color}!important;",
				)
			);

		}

		// Icon.
		if ( 'icon' === $active_element ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-divider__icon i',
					'declaration' => sprintf(
						'
                    font-size: %1$s;',
						$icon_size
					),
				)
			);

			$this->get_responsive_styles(
				'icon_padding',
				'%%order_class%% .ba-divider__icon i',
				array( 'primary' => 'padding' ),
				array( 'default' => '0px|0px|0px|0px' ),
				$render_slug
			);

			if ( 'off' === $use_mask ) {

				if ( ! empty( $icon_bg ) ) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .ba-divider__icon i',
							'declaration' => sprintf(
								'background: %1$s;',
								$icon_bg
							),
						)
					);
				}

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-divider__icon i',
						'declaration' => sprintf(
							'color: %1$s;',
							$icon_color
						),
					)
				);
			}
		}

		// image.
		if ( 'image' === $active_element ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-divider__element img',
					'declaration' => sprintf(
						'width: %1$s;',
						$img_width
					),
				)
			);
		}

		// Text Style.
		$this->get_responsive_styles(
			'text_padding',
			'%%order_class%% .ba-divider__text span',
			array( 'primary' => 'padding' ),
			array( 'default' => '0px|0px|0px|0px' ),
			$render_slug
		);

		if ( ! empty( $this->props['text_background'] ) ) {
			$this->get_responsive_styles(
				'text_background',
				'%%order_class%% .ba-divider__text span',
				array( 'primary' => 'background' ),
				array( 'default' => 'transparent' ),
				$render_slug
			);
		}

		$text_radius = explode( '|', $this->props['text_radius'] );
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-divider__text span',
				'declaration' => sprintf(
					'border-radius: %1$s %2$s %3$s %4$s;',
					$text_radius[1],
					$text_radius[2],
					$text_radius[3],
					$text_radius[4]
				),
			)
		);

	}
}


new BA_Advanced_Divider();
