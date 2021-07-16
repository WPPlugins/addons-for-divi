<?php
class BA_Testimonial extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/demo/testimonial',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {

		$this->vb_support = 'on';
		$this->slug       = 'ba_testimonial';
		$this->name       = esc_html__( 'Brain Testimonial', 'brain-divi-addons' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'testimonial.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content'  => esc_html__( 'Content', 'brain-divi-addons' ),
					'elements' => esc_html__( 'Elements', 'brain-divi-addons' ),
				),
			),

			'advanced' => array(
				'toggles' => array(
					'common'     => esc_html__( 'General', 'brain-divi-addons' ),
					'quote_icon' => esc_html__( 'Quote Icon', 'brain-divi-addons' ),
					'image'      => esc_html__( 'Reviewer Image', 'brain-divi-addons' ),
					'rating'     => esc_html__( 'Rating', 'brain-divi-addons' ),
					'texts'      => array(
						'title'             => esc_html__( 'Texts', 'brain-divi-addons' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'name'   => array(
								'name' => esc_html__( 'Name', 'brain-divi-addons' ),
							),
							'title'  => array(
								'name' => esc_html__( 'Title', 'brain-divi-addons' ),
							),
							'review' => array(
								'name' => esc_html__( 'Review', 'brain-divi-addons' ),
							),
						),
					),
					'bubble'     => esc_html__( 'Bubble', 'brain-divi-addons' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'image'        => array(
				'label'    => esc_html__( 'Reviewer Image', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-testimonial-img img',
			),
			'name'         => array(
				'label'    => esc_html__( 'Reviewer Name', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-testimonial-reviewer-text h3',
			),
			'title'        => array(
				'label'    => esc_html__( 'Reviewer Title', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-testimonial-reviewer-text .ba-testimonial-title',
			),
			'rating'       => array(
				'label'    => esc_html__( 'Rating', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-testimonial-rating',
			),
			'star'         => array(
				'label'    => esc_html__( 'Rating Star', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-testimonial-rating span',
			),
			'review'       => array(
				'label'    => esc_html__( 'Review', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-testimonial-review',
			),
			'icon_wrapper' => array(
				'label'    => esc_html__( 'Quote Icon Wrapper', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-testimonial-icon-wrap',
			),
			'icon'         => array(
				'label'    => esc_html__( 'Quote Icon', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-testimonial-icon-wrap svg',
			),
		);
	}

	public function get_fields() {

		$primary_fields = array(
			'icon_placement' => array(
				'label'       => esc_html__( 'Icon Placement', 'brain-divi-addons' ),
				'description' => esc_html__( 'Define Placement for the quote icon.', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'quote_icon',
				'tab_slug'    => 'advanced',
				'default'     => 'background',
				'options'     => array(
					'_default'   => esc_html__( 'Default', 'brain-divi-addons' ),
					'absolute'   => esc_html__( 'Absolute', 'brain-divi-addons' ),
					'background' => esc_html__( 'Background', 'brain-divi-addons' ),
				),
			),
		);

		$fields = array(

			'image'                  => array(
				'label'              => esc_html__( 'Reviewer Image', 'brain-divi-addons' ),
				'description'        => esc_html__( 'Upload reviewer image or type in the URL of the image you would like to display.', 'brain-divi-addons' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'brain-divi-addons' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'brain-divi-addons' ),
				'update_text'        => esc_attr__( 'Set As Image', 'brain-divi-addons' ),
				'toggle_slug'        => 'content',
			),

			'image_alt'              => array(
				'label'       => esc_html__( 'Image Alt Text', 'brain-divi-addons' ),
				'description' => esc_html__( 'Here you can define the HTML ALT text for your image.', 'brain-divi-addons' ),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),

			'name'                   => array(
				'label'           => esc_html__( 'Reviewer Name', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Define the name of the reviewer.', 'brain-divi-addons' ),
				'type'            => 'text',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
			),

			'title'                  => array(
				'label'           => esc_html__( 'Reviewer Title', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Define the title/position of the reviewer.', 'brain-divi-addons' ),
				'type'            => 'text',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
				'description'     => esc_html__( '.', 'brain-divi-addons' ),
			),

			'use_rating'             => array(
				'label'           => esc_html__( 'Use Rating', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Here you can choose whether rating should be used.', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'content',
			),

			'rating'                 => array(
				'label'       => esc_html__( 'Rating', 'brain-divi-addons' ),
				'description' => esc_html__( 'Define your rating number from the list.', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'content',
				'default'     => '5',
				'options'     => array(
					'1' => esc_html__( '1', 'brain-divi-addons' ),
					'2' => esc_html__( '2', 'brain-divi-addons' ),
					'3' => esc_html__( '3', 'brain-divi-addons' ),
					'4' => esc_html__( '4', 'brain-divi-addons' ),
					'5' => esc_html__( '5', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'use_rating' => 'on',
				),
			),

			'testimonial'            => array(
				'label'           => esc_html__( 'Review', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Define the testimonial.', 'brain-divi-addons' ),
				'type'            => 'textarea',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
			),

			'use_custom_icon'        => array(
				'label'           => esc_html__( 'Upload Custom Quote Icon', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Here you can choose whether custom icon should be used.', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'content',
			),

			'selected_icon'          => array(
				'label'       => esc_html__( 'Select Quote Icon', 'brain-divi-addons' ),
				'description' => esc_html__( 'Here you can define quote icon from the list.', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'content',
				'default'     => '5',
				'options'     => array(
					'5' => esc_html__( 'Icon 5', 'brain-divi-addons' ),
					'4' => esc_html__( 'Icon 4', 'brain-divi-addons' ),
					'3' => esc_html__( 'Icon 3', 'brain-divi-addons' ),
					'2' => esc_html__( 'Icon 2', 'brain-divi-addons' ),
					'1' => esc_html__( 'Icon 1', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'use_custom_icon' => 'off',
				),
			),

			'icon_img'               => array(
				'label'              => esc_html__( 'Upload Quote Icon Image', 'brain-divi-addons' ),
				'description'        => esc_html__( 'Upload your custom quote icon or type in the URL of the icon image you would like to display.', 'brain-divi-addons' ),
				'type'               => 'upload',
				'data_type'          => 'image',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an Image', 'brain-divi-addons' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'brain-divi-addons' ),
				'update_text'        => esc_attr__( 'Set As Image', 'brain-divi-addons' ),
				'toggle_slug'        => 'content',
				'show_if'            => array(
					'use_custom_icon' => 'on',
				),
			),

			// elements.
			'hide_quote'             => array(
				'label'           => esc_html__( 'Hide Quote Icon', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Here you can choose whether quote should be hidden.', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'elements',
			),

			'reviewer_position'      => array(
				'label'       => esc_html__( 'Reviewer Position', 'brain-divi-addons' ),
				'description' => esc_html__( 'Here you can define reviewer position.', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'elements',
				'default'     => 'bottom',
				'options'     => array(
					'top'    => esc_html__( 'Top', 'brain-divi-addons' ),
					'bottom' => esc_html__( 'Bottom', 'brain-divi-addons' ),
				),
			),

			'img_position'           => array(
				'label'       => esc_html__( 'Reviewer Image Position', 'brain-divi-addons' ),
				'description' => esc_html__( 'Here you can define reviewer image position.', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'elements',
				'default'     => 'relative',
				'options'     => array(
					'top'      => esc_html__( 'Top', 'brain-divi-addons' ),
					'left'     => esc_html__( 'Left', 'brain-divi-addons' ),
					'right'    => esc_html__( 'Right', 'brain-divi-addons' ),
					'absolute' => esc_html__( 'Absolute', 'brain-divi-addons' ),
					'relative' => esc_html__( 'Relative to Reviewer', 'brain-divi-addons' ),
				),
			),

			'ratings_position'       => array(
				'label'       => esc_html__( 'Rating Position', 'brain-divi-addons' ),
				'description' => esc_html__( 'Here you can define rating position.', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'elements',
				'default'     => '_default',
				'options'     => array(
					'_default' => esc_html__( 'Default', 'brain-divi-addons' ),
					'bottom'   => esc_html__( 'Bottom', 'brain-divi-addons' ),
					'reviewer' => esc_html__( 'Relative to Reviewer', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'use_rating' => 'on',
				),
			),

			'review_design'          => array(
				'label'       => esc_html__( 'Review Design', 'brain-divi-addons' ),
				'description' => esc_html__( 'Here you can define review design layout.', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'elements',
				'default'     => 'normal',
				'options'     => array(
					'normal' => esc_html__( 'Normal', 'brain-divi-addons' ),
					'bubble' => esc_html__( 'Bubble', 'brain-divi-addons' ),
				),
			),

			// links.
			'website_url'            => array(
				'label'           => esc_html__( 'Personal Website URL', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Here you can define personal website URL of the reviewer.', 'brain-divi-addons' ),
				'type'            => 'text',
				'toggle_slug'     => 'link_options',
				'tab_slug'        => 'general',
				'dynamic_content' => 'url',

			),
			'company_url'            => array(
				'label'           => esc_html__( 'Company URL', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Here you can define company Website URL of the reviewer.', 'brain-divi-addons' ),
				'type'            => 'text',
				'toggle_slug'     => 'link_options',
				'tab_slug'        => 'general',
				'dynamic_content' => 'url',

			),

			// General.
			'alignment'              => array(
				'label'        => esc_html__( 'Content Alignment', 'brain-divi-addons' ),
				'description'  => esc_html__( 'Align content to the left, right or center.', 'brain-divi-addons' ),
				'type'         => 'text_align',
				'options'      => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon' => 'module_align',
				'default'      => 'center',
				'toggle_slug'  => 'common',
				'tab_slug'     => 'advanced',
			),
			'content_padding'        => array(
				'label'          => esc_html__( 'Content Padding', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Define custom padding for the content.', 'brain-divi-addons' ),
				'type'           => 'custom_padding',
				'default'        => '30px|30px|30px|30px',
				'mobile_options' => true,
				'toggle_slug'    => 'common',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'img_position' => array( 'left', 'right' ),
				),
			),

			// Quote Icon.
			'icon_alignment'         => array(
				'label'           => esc_html__( 'Icon Alignment', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Align icon to the left, right or center.', 'brain-divi-addons' ),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'    => 'module_align',
				'default'         => 'center',
				'toggle_slug'     => 'quote_icon',
				'tab_slug'        => 'advanced',
				'show_if_not'     => array(
					'icon_placement' => 'absolute',
				),
			),
			'icon_color'             => array(
				'label'       => esc_html__( 'Icon Color', 'brain-divi-addons' ),
				'description' => esc_html__( 'Here you can define a custom color for your icon.', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'quote_icon',
				'default'     => '#333',
				'show_if'     => array(
					'use_custom_icon' => 'off',
				),
			),
			'icon_bg'                => array(
				'label'       => esc_html__( 'Icon Background', 'brain-divi-addons' ),
				'description' => esc_html__( 'Here you can define a custom background color for your icon.', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'quote_icon',
				'default'     => 'transparent',
				'show_if'     => array(
					'use_custom_icon' => 'on',
				),
			),
			'icon_size'              => array(
				'label'           => esc_html__( 'Icon Size', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Here you can define a custom size for your icon.', 'brain-divi-addons' ),
				'type'            => 'range',
				'default'         => '70px',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'mobile_options'  => true,
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'     => 'quote_icon',
				'tab_slug'        => 'advanced',
			),
			'icon_opacity'           => array(
				'label'           => esc_html__( 'Icon Opacity', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Define the opacity for the icon. Set the value from 0 - 1. The lower value, the more transparent.', 'brain-divi-addons' ),
				'type'            => 'range',
				'default'         => '.2',
				'option_category' => 'basic_option',
				'unitless'        => true,
				'range_settings'  => array(
					'min'  => 0,
					'step' => .01,
					'max'  => 1,
				),
				'toggle_slug'     => 'quote_icon',
				'tab_slug'        => 'advanced',
			),
			'icon_padding'           => array(
				'label'       => esc_html__( 'Icon Padding', 'brain-divi-addons' ),
				'description' => esc_html__( 'Here you can define custom padding for the icon.', 'brain-divi-addons' ),
				'type'        => 'custom_padding',
				'default'     => '0px|0px|0px|0px',
				'toggle_slug' => 'quote_icon',
				'tab_slug'    => 'advanced',
				'show_if'     => array(
					'use_custom_icon' => 'off',
				),
			),
			'icon_top_spacing'       => array(
				'label'           => esc_html__( 'Icon Spacing Top', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Here you can define a custom spacing at the top of the icon.', 'brain-divi-addons' ),
				'type'            => 'range',
				'default'         => '40px',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'     => 'quote_icon',
				'tab_slug'        => 'advanced',
				'show_if_not'     => array(
					'icon_placement' => 'absolute',
				),
			),
			'icon_bottom_spacing'    => array(
				'label'           => esc_html__( 'Icon Spacing Bottom', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Here you can define a custom spacing at the bottom of the icon.', 'brain-divi-addons' ),
				'type'            => 'range',
				'default'         => '5px',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'     => 'quote_icon',
				'tab_slug'        => 'advanced',
				'show_if_not'     => array(
					'icon_placement' => 'absolute',
				),
			),

			// image.
			'image_placement'        => array(
				'label'       => esc_html__( 'Image Placement', 'brain-divi-addons' ),
				'description' => esc_html__( 'Define reviewer image placement.', 'brain-divi-addons' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'image',
				'default'     => 'left_top',
				'options'     => array(
					'left_top'     => esc_html__( 'Left Top', 'brain-divi-addons' ),
					'left_bottom'  => esc_html__( 'Left Bottom', 'brain-divi-addons' ),
					'right_top'    => esc_html__( 'Right Top', 'brain-divi-addons' ),
					'right_bottom' => esc_html__( 'Right Bottom', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'img_position' => 'absolute',
				),
			),

			'img_is_center_x'        => array(
				'label'           => esc_html__( 'Use Horizontal Position Center', 'brain-divi-addons' ),
				'description'     => esc_html__( 'If enabled reviewer image will be placed horizontally center.', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'image',
				'tab_slug'        => 'advanced',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'         => array(
					'img_position' => 'absolute',
				),
			),

			'img_offset_x'           => array(
				'label'          => esc_html__( 'Image Offset X', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Define horizontal offset value.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '50%',
				'range_settings' => array(
					'min'  => -600,
					'max'  => 600,
					'step' => 1,
				),
				'show_if'        => array(
					'img_position'    => 'absolute',
					'img_is_center_x' => 'off',
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
			),

			'img_is_center_y'        => array(
				'label'           => esc_html__( 'Use Vertical Position Center', 'brain-divi-addons' ),
				'description'     => esc_html__( 'If enabled reviewer image will be placed vertically center.', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'image',
				'tab_slug'        => 'advanced',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'         => array(
					'img_position' => 'absolute',
				),
			),

			'img_offset_y'           => array(
				'label'          => esc_html__( 'Image Offset Y', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Define vertical offset value.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => -600,
					'max'  => 600,
					'step' => 1,
				),
				'show_if'        => array(
					'img_position'    => 'absolute',
					'img_is_center_y' => 'off',
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',

			),

			'image_placement_alt'    => array(
				'label'       => esc_html__( 'Image Placement', 'brain-divi-addons' ),
				'description' => esc_html__( 'Define reviewer image placement.', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'image',
				'tab_slug'    => 'advanced',
				'default'     => 'top',
				'options'     => array(
					'top'   => esc_html__( 'Top', 'brain-divi-addons' ),
					'left'  => esc_html__( 'Left', 'brain-divi-addons' ),
					'right' => esc_html__( 'Right', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'img_position' => 'relative',
				),
			),

			'image_spacing'          => array(
				'label'          => esc_html__( 'Image Spacing Left/Right', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Define custom spacing for the image left/right.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '15px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'img_position'        => 'relative',
					'image_placement_alt' => array( 'left', 'right' ),
				),
			),

			'image_width'            => array(
				'label'          => esc_html__( 'Image Width', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Define static width for the image.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 800,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
			),

			'image_height'           => array(
				'label'          => esc_html__( 'Image Height', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Define static height for the image.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 800,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
			),

			'image_spacing_top'      => array(
				'label'          => esc_html__( 'Image Spacing Top', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the top of the image.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '15px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 300,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'img_position'        => 'relative',
					'image_placement_alt' => 'top',
				),
			),

			'image_spacing_bottom'   => array(
				'label'          => esc_html__( 'Image Spacing Bottom', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the bottom of the image.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '20px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 300,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'image_placement_alt' => 'top',
					'img_position'        => 'relative',
				),
			),

			// rating.
			'ratings_spacing_top'    => array(
				'label'          => esc_html__( 'Rating Spacing Top', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the top of the rating.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '0px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'rating',
				'show_if'        => array(
					'use_rating' => 'on',
				),
			),

			'ratings_spacing_bottom' => array(
				'label'          => esc_html__( 'Rating Spacing Bottom', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the bottom of the rating.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '0px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'rating',
				'show_if'        => array(
					'use_rating' => 'on',
				),
			),

			'stars_size'             => array(
				'label'          => esc_html__( 'Stars Size', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Control the size of the stars by increasing or decreasing the range.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '20px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'rating',
				'show_if'        => array(
					'use_rating' => 'on',
				),
			),

			'stars_color'            => array(
				'label'       => esc_html__( 'Stars Color', 'brain-divi-addons' ),
				'description' => esc_html__( 'Here you can define a custom color for stars.', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'rating',
				'default'     => '#F3B325',
				'show_if'     => array(
					'use_rating' => 'on',
				),
			),

			'stars_spacing_between'  => array(
				'label'          => __( 'Stars Spacing Between', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can define the spacing between stars.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '5px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 20,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'rating',
				'show_if'        => array(
					'use_rating' => 'on',
				),
			),

			// texts.
			'name_bottom_spacing'    => array(
				'label'           => esc_html__( 'Name Spacing Bottom', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Here you can define a custom spacing at the bottom of the reviewer name.', 'brain-divi-addons' ),
				'type'            => 'range',
				'default'         => '5px',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'     => 'texts',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'name',
			),

			'title_bottom_spacing'   => array(
				'label'           => esc_html__( 'Title Spacing Bottom', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Here you can define a custom spacing at the bottom of the reviewer title.', 'brain-divi-addons' ),
				'type'            => 'range',
				'default'         => '5px',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'     => 'texts',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'title',
			),

			// Review.
			'review_top_spacing'     => array(
				'label'          => esc_html__( 'Review Spacing Top', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the top of the review.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '0px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'texts',
				'tab_slug'       => 'advanced',
				'sub_toggle'     => 'review',
			),

			'review_bottom_spacing'  => array(
				'label'          => esc_html__( 'Review Spacing Bottom', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the bottom of the review.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '20px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'texts',
				'tab_slug'       => 'advanced',
				'sub_toggle'     => 'review',
			),

			// Bubble.
			'bubble_padding'         => array(
				'label'       => esc_html__( 'Bubble Padding', 'brain-divi-addons' ),
				'description' => esc_html__( 'Define custom padding for the bubble area.', 'brain-divi-addons' ),
				'type'        => 'custom_padding',
				'toggle_slug' => 'bubble',
				'tab_slug'    => 'advanced',
				'default'     => '15px|15px|15px|15px',
				'show_if'     => array(
					'review_design' => 'bubble',
				),
			),

			'bubble_radius'          => array(
				'label'       => esc_html__( 'Bubble Border Radius', 'brain-divi-addons' ),
				'description' => esc_html__( 'Here you can control the corner radius of this bubble area. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'brain-divi-addons' ),
				'type'        => 'border-radius',
				'toggle_slug' => 'bubble',
				'tab_slug'    => 'advanced',
				'default'     => 'off|6px|6px|6px|6px',
				'show_if'     => array(
					'review_design' => 'bubble',
				),
			),

			'arrow_color'            => array(
				'label'       => esc_html__( 'Arrow Color', 'brain-divi-addons' ),
				'description' => esc_html__( 'Define custom color for the bubble arrow.', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'bubble',
				'default'     => '#efefef',
				'show_if'     => array(
					'review_design' => 'bubble',
				),
			),

			'arrow_placement'        => array(
				'label'            => esc_html__( 'Arrow Placement', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Place the bubble arrow at the left, right or center.', 'brain-divi-addons' ),
				'type'             => 'select',
				'options'          => array(
					'left'   => esc_html__( 'Left', 'brain-divi-addons' ),
					'right'  => esc_html__( 'Right', 'brain-divi-addons' ),
					'center' => esc_html__( 'Center', 'brain-divi-addons' ),
				),
				'default_on_front' => 'center',
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'bubble',
				'show_if'          => array(
					'review_design' => 'bubble',
				),
			),

			'arrow_position_x'       => array(
				'label'          => esc_html__( 'Arrow Custom Position', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Define arrow offset left/right value.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '15px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'bubble',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'review_design'   => 'bubble',
					'arrow_placement' => array( 'left', 'right' ),
				),
			),

		);

		$defaults = array(
			'position' => 'right_top',
			'offset_x' => '15px',
			'offset_y' => '15px',
		);

		$abs_quote = $this->get_absolute_element_options(
			'icon',
			esc_html__( 'Icon', 'brain-divi-addons' ),
			'quote_icon',
			$defaults,
			array( 'icon_placement' => 'absolute' )
		);

		$quote_icon_bg = $this->custom_background_fields(
			'icon',
			esc_html__( 'Icon', 'brain-divi-addons' ),
			'advanced',
			'quote_icon',
			array( 'color', 'gradient', 'hover' ),
			array( 'use_custom_icon' => 'off' ),
			''
		);

		$bubble_bg = $this->custom_background_fields(
			'bubble',
			esc_html__( 'Bubble', 'brain-divi-addons' ),
			'advanced',
			'bubble',
			array( 'color', 'gradient', 'hover' ),
			array( 'review_design' => 'bubble' ),
			'#efefef'
		);

		return array_merge( $primary_fields, $bubble_bg, $abs_quote, $fields, $quote_icon_bg );
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['max_width']   = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['box_shadow']['item'] = array(
			'label'       => esc_html__( 'Item Box Shadow', 'brain-divi-addons' ),
			'toggle_slug' => 'common',
			'css'         => array(
				'main'      => '%%order_class%% .ba-testimonial-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['image'] = array(
			'label_prefix' => esc_html__( 'Image', 'brain-divi-addons' ),
			'toggle_slug'  => 'image',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-testimonial-img',
					'border_styles' => '%%order_class%% .ba-testimonial-img',
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

		$advanced_fields['borders']['icon'] = array(
			'label_prefix' => esc_html__( 'Icon', 'brain-divi-addons' ),
			'toggle_slug'  => 'quote_icon',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-testimonial-icon span',
					'border_styles' => '%%order_class%% .ba-testimonial-icon span',
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

		$advanced_fields['borders']['item'] = array(
			'label_prefix' => esc_html__( 'Item', 'brain-divi-addons' ),
			'toggle_slug'  => 'common',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-testimonial-inner',
					'border_styles' => '%%order_class%% .ba-testimonial-inner',
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

		$advanced_fields['background'] = array(
			'css' => array(
				'main'      => '%%order_class%% .ba-testimonial-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '%%order_class%% .ba-testimonial-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['fonts']['name'] = array(
			'label'           => esc_html__( 'Name', 'brain-divi-addons' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-testimonial-reviewer-text h3, .et-db #et-boc %%order_class%% .ba-testimonial-reviewer-text h3',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'name',
			'hide_text_align' => true,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
			'font_size'       => array(
				'default' => '22px',
			),
		);

		$advanced_fields['fonts']['title'] = array(
			'label'           => esc_html__( 'Title', 'brain-divi-addons' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-testimonial-title',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'title',
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
			'font_size'       => array(
				'default' => '14px',
			),
		);

		$advanced_fields['fonts']['review'] = array(
			'label'           => esc_html__( 'Review', 'brain-divi-addons' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-testimonial-review',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'review',
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
			'font_size'       => array(
				'default' => '14px',
			),
		);

		return $advanced_fields;
	}

	public function render_rating( $pos ) {

		$html             = '';
		$ratings_position = $this->props['ratings_position'];
		$use_rating       = $this->props['use_rating'];
		$rating           = $this->props['rating'];

		for ( $i = 0; $i < intval( $rating ); $i++ ) {
			$html = $html . '<span>★</span>';
		}

		if ( $use_rating === 'on' && $ratings_position === $pos ) {
			return sprintf(
				'
                <div class="ba-testimonial-rating">
                    %1$s
                </div>',
				$html
			);
		}

	}

	public function render_quote_icon( $class, $placement ) {

		$icons = array(
			'1' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.591 24.006"><g><path d="M232.2,72.969l-1.078,4.955c-7.76-.356-13.138-3.584-13.138-13.078V53.918h13.553V67.653H226.4C226.406,70.7,228.317,72.491,232.2,72.969Z" transform="translate(-198.609 -53.918)"/><path d="M14.216,72.969l-1.078,4.955C5.378,77.569,0,74.341,0,64.846V53.918H13.556V67.654H8.42C8.42,70.7,10.331,72.491,14.216,72.969Z" transform="translate(0 -53.918)"/></g> </svg>',

			'2' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 24"><g transform="translate(0 -4)"><g><g><path d="M0,4V28L12,16V4Z"/><path d="M20,4V28L32,16V4Z"/></g></g></g></svg>',

			'3' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36.003 24.007"><path d="M17.66,18.228v1.582a7.789,7.789,0,0,1-.643,4.1A14.32,14.32,0,0,1,14.2,27.624a31.335,31.335,0,0,1-4.9,3.907,18.986,18.986,0,0,1-5.588,2.324.391.391,0,0,1-.593-.2.7.7,0,0,1,.1-.593,35.575,35.575,0,0,0,2.967-3.313,14.785,14.785,0,0,0,1.879-3.115h-.1a10.7,10.7,0,0,1-3.115-.692,5.451,5.451,0,0,1-1.929-1.385Q1.44,22.679,1.44,18.327v-.1q0-4.352,1.484-6.132a7.047,7.047,0,0,1,5.044-2.077,1.533,1.533,0,0,1,.643-.1H10.49a1.533,1.533,0,0,1,.643.1A7.047,7.047,0,0,1,16.177,12.1Q17.66,13.877,17.66,18.228Zm19.781,0v.1a8.193,8.193,0,0,1-.1,1.484,8.137,8.137,0,0,1-.593,4.1,12.666,12.666,0,0,1-2.868,3.709,28.055,28.055,0,0,1-4.8,3.907A18.986,18.986,0,0,1,23.5,33.855h-.1q-.3.2-.495-.2a.43.43,0,0,1,.1-.593,35.575,35.575,0,0,0,2.967-3.313,14.785,14.785,0,0,0,1.879-3.115h-.1a7.184,7.184,0,0,1-5.143-2.077q-1.385-1.78-1.385-6.231v-.1q0-4.451,1.385-6.132a7.184,7.184,0,0,1,5.143-2.077,1.533,1.533,0,0,1,.643-.1H30.27a1.533,1.533,0,0,1,.643.1A7.047,7.047,0,0,1,35.957,12.1q1.484,1.78,1.484,6.132Z" transform="translate(37.443 33.925) rotate(180)"/></svg>',

			'4' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.453 24.005"><path id="Path_12" data-name="Path 12" d="M.98,24h12.6a.98.98,0,0,0,.981-.98v-12.6a.98.98,0,0,0-.981-.981H8.258V.98A.98.98,0,0,0,7.279,0H4.129A.98.98,0,0,0,3.2.67L.051,10.116A.973.973,0,0,0,0,10.428v12.6A.98.98,0,0,0,.98,24Zm0,0" transform="translate(18.895)"/><path id="Path_13" data-name="Path 13" d="M290.18,24h12.6a.98.98,0,0,0,.98-.98v-12.6a.98.98,0,0,0-.98-.981h-5.319V.98a.98.98,0,0,0-.98-.98h-3.149a.98.98,0,0,0-.93.67l-3.15,9.446a.982.982,0,0,0-.051.31v12.6a.979.979,0,0,0,.98.98Zm0,0" transform="translate(-289.199 0)"/></svg>',

			'5' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.579 23.997"><g transform="translate(0 -53.918)"><g transform="translate(0 53.918)"><g><path id="Path_14" data-name="Path 14" d="M232.2,58.871l-1.077-4.953c-7.757.356-13.138,3.582-13.138,13.073V77.915h13.551V64.19H226.4C226.4,61.141,228.314,59.349,232.2,58.871Z" transform="translate(-198.616 -53.918)"/><path id="Path_15" data-name="Path 15" d="M14.211,58.871l-1.073-4.953C5.377,54.274,0,57.5,0,66.991V77.915H13.552V64.19H8.416C8.416,61.141,10.326,59.349,14.211,58.871Z" transform="translate(0 -53.918)"/></g></g></g></svg>',
		);

		$selected_icon   = $this->props['selected_icon'];
		$icon_placement  = $this->props['icon_placement'];
		$hide_quote      = $this->props['hide_quote'];
		$use_custom_icon = $this->props['use_custom_icon'];
		$icon            = '';

		if ( 'off' === $use_custom_icon ) {
			$icon = $icons[ $selected_icon ];
		}

		if ( $hide_quote === 'off' && $icon_placement === $placement ) {
			return sprintf(
				'<div class="ba-testimonial-icon %1$s">
                	<span>%2$s</span>
            	</div> ',
				$class,
				$icon
			);
		}

	}

	public function render_review() {

		$testimonial      = $this->props['testimonial'];
		$testimonial_html = sprintf( '<p>%1$s</p>', $testimonial );

		return sprintf(
			'<div class="ba-testimonial-review">%2$s %1$s</div>',
			! empty( $testimonial ) ? $testimonial_html : '',
			$this->render_quote_icon( 'ba-icon-default', '_default' )
		);

	}

	public function _render_image( $pos ) {
		$image        = $this->props['image'];
		$img_position = $this->props['img_position'];
		$image_alt    = $this->props['image_alt'];

		if ( ! empty( $image ) ) {
			if ( in_array( $img_position, $pos ) ) {
				return sprintf(
					'
                        <figure class="ba-testimonial-img">
                            <img class="ba-img-cover" src="%1$s" alt="%2$s" />
                        </figure>',
					$image,
					$image_alt
				);
			}
		}
	}

	public function render_reviewer( $pos ) {

		$reviewer_position = $this->props['reviewer_position'];
		$name              = $this->props['name'];
		$title             = $this->props['title'];
		$link_target       = $this->props['link_option_url_new_window'];
		$company_url       = $this->props['company_url'];
		$website_url       = $this->props['website_url'];
		$name_html         = '';
		$title_html        = '';

		if ( ! empty( $name ) ) {
			if ( ! empty( $website_url ) ) {
				$name_html = sprintf( '<a href="%2$s" target="%3$s"><h3>%1$s</h3></a>', $name, $website_url, $link_target );
			} else {
				$name_html = sprintf( '<h3>%1$s</h3>', $name );
			}
		}

		if ( ! empty( $title ) ) {
			if ( ! empty( $company_url ) ) {
				$title_html = sprintf( '<a class="ba-testimonial-title" href="%2$s" target="%3$s"><p>%1$s</p></a>', $title, $company_url, $link_target );
			} else {
				$title_html = sprintf( '<div class="ba-testimonial-title">%1$s</div>', $title );
			}
		}

		if ( $reviewer_position === $pos ) {
			return sprintf(
				'<div class="ba-testimonial-reviewer">
                    %1$s
                    <div class="ba-testimonial-reviewer-text">
                        %2$s %3$s %4$s
                    </div>
                </div>',
				$this->_render_image( array( 'relative' ) ),
				$name_html,
				$title_html,
				$this->render_rating( 'reviewer' )
			);
		}

	}

	public function render( $attrs, $content = null, $render_slug ) {

		$this->render_css( $render_slug );

		$alignment    = $this->props['alignment'];
		$img_position = $this->props['img_position'];

		return sprintf(
			'<div class="ba-module ba-testimonial ba-align-%1$s">
                %3$s %5$s
                <div class="ba-testimonial-inner ba-bg-support img-pos-%2$s">
                     %4$s %11$s
                    <div class="ba-testimonial-content">
                        %6$s %7$s %8$s
                        %9$s %10$s
                    </div>
                    %12$s
                </div>
			</div>',
			$alignment,
			$img_position,
			$this->render_quote_icon( 'ba-icon-absolute', 'absolute' ),
			$this->render_quote_icon( 'ba-icon-bg', 'background' ),
			$this->_render_image( array( 'absolute' ) ),
			$this->render_reviewer( 'top' ),
			$this->render_rating( '_default' ),
			$this->render_review(),
			$this->render_reviewer( 'bottom' ),
			$this->render_rating( 'bottom' ),
			$this->_render_image( array( 'top', 'left' ) ),
			$this->_render_image( array( 'right' ) )
		);
	}


	public function render_css( $render_slug ) {

		$alignment              = $this->props['alignment'];
		$image_spacing          = $this->props['image_spacing'];
		$image_spacing_top      = $this->props['image_spacing_top'];
		$image_spacing_bottom   = $this->props['image_spacing_bottom'];
		$ratings_spacing_top    = $this->props['ratings_spacing_top'];
		$ratings_spacing_bottom = $this->props['ratings_spacing_bottom'];
		$title_bottom_spacing   = $this->props['title_bottom_spacing'];
		$stars_size             = $this->props['stars_size'];
		$stars_color            = $this->props['stars_color'];
		$stars_spacing_between  = $this->props['stars_spacing_between'];
		$name_bottom_spacing    = $this->props['name_bottom_spacing'];
		$review_bottom_spacing  = $this->props['review_bottom_spacing'];
		$review_top_spacing     = $this->props['review_top_spacing'];
		$icon_alignment         = $this->props['icon_alignment'];
		$use_custom_icon        = $this->props['use_custom_icon'];
		$icon_img               = $this->props['icon_img'];
		$icon_color             = $this->props['icon_color'];
		$icon_bg                = $this->props['icon_bg'];
		$icon_top_spacing       = $this->props['icon_top_spacing'];
		$icon_bottom_spacing    = $this->props['icon_bottom_spacing'];
		$icon_padding           = $this->props['icon_padding'];
		$icon_opacity           = $this->props['icon_opacity'];
		$icon_placement         = $this->props['icon_placement'];
		$img_position           = $this->props['img_position'];
		$image_placement_alt    = $this->props['image_placement_alt'];
		$img_offset_x           = $this->props['img_offset_x'];
		$img_offset_y           = $this->props['img_offset_y'];
		$image_placement        = $this->props['image_placement'];
		$img_is_center_y        = $this->props['img_is_center_y'];
		$img_is_center_x        = $this->props['img_is_center_x'];
		$image__placement       = explode( '_', $image_placement );
		$val_x                  = 0;
		$val_y                  = 0;

		// content.
		if ( $img_position === 'left' || $img_position === 'right' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-testimonial-content',
					'declaration' => 'flex: 1 1;',
				)
			);

			$this->get_responsive_styles(
				'content_padding',
				'%%order_class%% .ba-testimonial-content',
				array(
					'primary' => 'padding',
				),
				array( 'default' => '30px|30px|30px|30px' ),
				$render_slug
			);

		}

		// Quote Icon.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-testimonial-inner .ba-testimonial-icon',
				'declaration' => sprintf( 'text-align: %1$s!important;', $icon_alignment ),
			)
		);

		if ( 'right' === $icon_alignment ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-testimonial-inner .ba-testimonial-icon',
					'declaration' => sprintf( 'justify-content: flex-end!important;' ),
				)
			);
		} elseif ( 'center' === $icon_alignment ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-testimonial-inner .ba-testimonial-icon',
					'declaration' => sprintf( 'justify-content: center!important;' ),
				)
			);
		}

		if ( 'off' === $use_custom_icon ) {

			$this->get_custom_bg_style( $render_slug, 'icon', '%%order_class%% .ba-testimonial-icon span', '%%order_class%%:hover .ba-testimonial-icon span' );

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-testimonial-icon span',
					'declaration' => sprintf(
						'%1$s
                    	opacity: %2$s;',
						$this->process_margin_padding( $icon_padding, 'padding', false ),
						$icon_opacity
					),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-testimonial-icon svg',
					'declaration' => sprintf(
						'fill: %1$s;',
						$icon_color
					),
				)
			);
			// Icon Size.
			$this->get_responsive_styles(
				'icon_size',
				'%%order_class%% .ba-testimonial-icon svg',
				array( 'primary' => 'width' ),
				array( 'default' => '70px' ),
				$render_slug
			);
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-testimonial-icon span',
					'declaration' => sprintf(
						'background: %1$s;
						opacity: %2$s;
						background-image: url(%3$s);
						background-position: center;
						background-repeat: no-repeat;
						background-size: contain;',
						$icon_bg,
						$icon_opacity,
						$icon_img
					),
				)
			);

			// Icon Size.
			$this->get_responsive_styles(
				'icon_size',
				'%%order_class%% .ba-testimonial-icon span',
				array( 'primary' => 'width' ),
				array( 'default' => '70px' ),
				$render_slug
			);
			$this->get_responsive_styles(
				'icon_size',
				'%%order_class%% .ba-testimonial-icon span',
				array( 'primary' => 'height' ),
				array( 'default' => '70px' ),
				$render_slug
			);
		}

		if ( 'absolute' !== $icon_placement ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-testimonial-icon span',
					'declaration' => sprintf(
						'margin-top: %1$s;margin-bottom: %2$s;',
						$icon_top_spacing,
						$icon_bottom_spacing
					),
				)
			);
		} else {
			$this->get_absolute_element_styles( $render_slug, 'icon', '%%order_class%% .ba-icon-absolute' );
		}

		// Image.
		if ( 'absolute' === $img_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-testimonial-img',
					'declaration' => 'position: absolute; z-index: 99;',
				)
			);

			// image offset X.
			if ( 'on' === $img_is_center_x ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-testimonial-img',
						'declaration' => sprintf( '%1$s: 50%%;', $image__placement[0] ),
					)
				);
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-testimonial-img',
						'declaration' => sprintf( '%1$s: %2$s;', $image__placement[0], $img_offset_x ),
					)
				);
			}

			// image offset Y.
			if ( 'on' === $img_is_center_y ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-testimonial-img',
						'declaration' => sprintf( '%1$s:50%%;', $image__placement[1] ),
					)
				);
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-testimonial-img',
						'declaration' => sprintf( '%1$s: %2$s;', $image__placement[1], $img_offset_y ),
					)
				);
			}

			if ( 'right_top' === $image_placement ) {
				if ( 'on' === $img_is_center_y ) {
					$val_y = '-50%';
				}
				if ( 'on' === $img_is_center_x ) {
					$val_x = '50%';
				}
			} elseif ( 'right_bottom' === $image_placement ) {
				if ( $img_is_center_y === 'on' ) {
					$val_y = '50%';
				}
				if ( $img_is_center_x === 'on' ) {
					$val_x = '50%';
				}
			} elseif ( $image_placement === 'left_bottom' ) {
				if ( $img_is_center_y === 'on' ) {
					$val_y = '50%';
				}
				if ( $img_is_center_x === 'on' ) {
					$val_x = '-50%';
				}
			} elseif ( $image_placement === 'left_top' ) {
				if ( $img_is_center_y === 'on' ) {
					$val_y = '-50%';
				}
				if ( $img_is_center_x === 'on' ) {
					$val_x = '-50%';
				}
			}

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-testimonial-img',
					'declaration' => "transform : translateX({$val_x}) translateY({$val_y});",
				)
			);
		}

		// image placement left/right.
		if ( $img_position === 'relative' ) {
			if ( $image_placement_alt !== 'top' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-testimonial-reviewer',
						'declaration' => 'display: flex; align-items: center;',
					)
				);
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-testimonial-inner .ba-testimonial-reviewer *',
						'declaration' => 'text-align:' . $image_placement_alt . ';',
					)
				);
			}

			if ( $image_placement_alt === 'right' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-testimonial-reviewer',
						'declaration' => 'flex-direction: row-reverse;',
					)
				);
			}
		}

		// Image Height.
		$this->get_responsive_styles(
			'image_height',
			'%%order_class%% .ba-testimonial-img',
			array(
				'primary' => 'height',
			),
			array(
				'default'     => '65px',
				'conditional' => array(
					'name'   => 'img_position',
					'values' => array(
						array(
							'a' => 'left',
							'b' => 'initial',
						),
						array(
							'a' => 'right',
							'b' => 'initial',
						),
					),
				),
			),
			$render_slug
		);

		// Image width.
		$this->get_responsive_styles(
			'image_width',
			'%%order_class%% .ba-testimonial-img',
			array(
				'primary' => 'width',
			),
			array(
				'default'     => '65px',
				'conditional' => array(
					'name'   => 'img_position',
					'values' => array(
						array(
							'a' => 'left',
							'b' => '50%',
						),
						array(
							'a' => 'right',
							'b' => '50%',
						),
					),
				),
			),
			$render_slug
		);

		// Image spacing.
		if ( $img_position === 'relative' ) {
			if ( $image_placement_alt === 'top' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-testimonial-img',
						'declaration' => sprintf( 'margin-bottom: %1$s; margin-top: %2$s;', $image_spacing_bottom, $image_spacing_top ),
					)
				);
			} elseif ( $image_placement_alt === 'left' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-testimonial-img',
						'declaration' => sprintf( 'margin-right: %1$s;', $image_spacing ),
					)
				);
			} elseif ( $image_placement_alt === 'right' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-testimonial-img',
						'declaration' => sprintf( 'margin-left: %1$s;', $image_spacing ),
					)
				);
			}
		} elseif ( $img_position === 'top' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-testimonial-img',
					'declaration' => sprintf( 'margin-bottom: %1$s; margin-top: %2$s;', $image_spacing_bottom, $image_spacing_top ),
				)
			);
		}

		// ratings
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-testimonial-rating',
				'declaration' => sprintf( 'padding-bottom: %1$s; padding-top: %2$s;', $ratings_spacing_bottom, $ratings_spacing_top ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-testimonial-rating span',
				'declaration' => sprintf( 'color: %1$s; font-size: %2$s;', $stars_color, $stars_size ),
			)
		);

		if ( $alignment === 'center' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-testimonial-rating span',
					'declaration' => sprintf( 'margin: 0 calc(%1$s / 2);', $stars_spacing_between ),
				)
			);
		} elseif ( $alignment === 'right' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-testimonial-rating span',
					'declaration' => sprintf( 'margin-left: %1$s;', $stars_spacing_between ),
				)
			);
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-testimonial-rating span',
					'declaration' => sprintf( 'margin-right: %1$s;', $stars_spacing_between ),
				)
			);
		}

		// Text
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-testimonial-reviewer-text h3',
				'declaration' => sprintf( 'padding-bottom: %1$s;', $name_bottom_spacing ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-testimonial-title',
				'declaration' => sprintf( 'padding-bottom: %1$s;', $title_bottom_spacing ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-testimonial-review',
				'declaration' => sprintf( 'margin-bottom: %1$s; margin-top: %2$s;', $review_bottom_spacing, $review_top_spacing ),
			)
		);

		// Bubble.
		$review_design     = $this->props['review_design'];
		$bubble_padding    = $this->props['bubble_padding'];
		$arrow_color       = $this->props['arrow_color'];
		$arrow_placement   = $this->props['arrow_placement'];
		$arrow_position_x  = $this->props['arrow_position_x'];
		$reviewer_position = $this->props['reviewer_position'];
		$bubble_radius     = explode( '|', $this->props['bubble_radius'] );

		if ( $review_design === 'bubble' ) {
			$this->get_custom_bg_style( $render_slug, 'bubble', '%%order_class%% .ba-testimonial-review', '%%order_class%%:hover .ba-testimonial-review' );

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-testimonial-review',
					'declaration' => sprintf(
						'
                    position: relative;
                    border-radius: %1$s %2$s %3$s %4$s;
                    %5$s',
						$bubble_radius[1],
						$bubble_radius[2],
						$bubble_radius[3],
						$bubble_radius[4],
						$this->process_margin_padding( $bubble_padding, 'padding', false )
					),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-testimonial-review:after',
					'declaration' => 'content: ""; width: 0;height: 0;position: absolute;border-style: solid;',
				)
			);

			if ( $reviewer_position === 'bottom' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-testimonial-review:after',
						'declaration' => sprintf(
							'
                        border-width: 13px 13px 0 13px;
                        border-color: %1$s transparent transparent transparent;
                        top: 100%%;',
							$arrow_color
						),
					)
				);
			} elseif ( $reviewer_position === 'top' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-testimonial-review:after',
						'declaration' => sprintf(
							'
                        border-width: 0 13px 13px 13px;
                        border-color: transparent transparent %1$s transparent;
                        bottom: 100%%;',
							$arrow_color
						),
					)
				);
			}

			if ( $arrow_placement === 'left' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-testimonial-review:after',
						'declaration' => 'left:' . $arrow_position_x . ';',
					)
				);
			} elseif ( $arrow_placement === 'right' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-testimonial-review:after',
						'declaration' => 'right:' . $arrow_position_x . ';',
					)
				);
			} elseif ( $arrow_placement === 'center' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-testimonial-review:after',
						'declaration' => 'left: 50%; transform: translateX(-13px);',
					)
				);
			}
		}

	}
}

new BA_Testimonial();
