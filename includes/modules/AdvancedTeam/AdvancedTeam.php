<?php
class BA_Advanced_Team extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/demo/team',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {

		$this->slug       = 'ba_advanced_team';
		$this->vb_support = 'on';
		$this->name       = esc_html__( 'Brain Team', 'brain-divi-addons' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'team.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content'  => esc_html__( 'Content', 'brain-divi-addons' ),
					'links'    => esc_html__( 'Social Links', 'brain-divi-addons' ),
					'settings' => esc_html__( 'Settings', 'brain-divi-addons' ),
				),
			),

			'advanced' => array(
				'toggles' => array(
					'content'    => esc_html__( 'Content', 'brain-divi-addons' ),
					'photo'      => esc_html__( 'Photo', 'brain-divi-addons' ),
					'overlay'    => esc_html__( 'Overlay', 'brain-divi-addons' ),
					'text'       => array(
						'title'             => esc_html__( 'Texts', 'brain-divi-addons' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'name'      => array(
								'name' => esc_html__( 'Name', 'brain-divi-addons' ),
							),
							'job_title' => array(
								'name' => esc_html__( 'Job Title', 'brain-divi-addons' ),
							),
							'short_bio' => array(
								'name' => esc_html__( 'Bio', 'brain-divi-addons' ),
							),
						),
					),
					'links'      => esc_html__( 'Social Links', 'brain-divi-addons' ),
					'border'     => esc_html__( 'Border', 'brain-divi-addons' ),
					'box_shadow' => esc_html__( 'Box Shadow', 'brain-divi-addons' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'photo'     => array(
				'label'    => esc_html__( 'Photo', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-team figure img',
			),
			'name'      => array(
				'label'    => esc_html__( 'Member Name', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-team-content h3',
			),
			'job_title' => array(
				'label'    => esc_html__( 'Job Title', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-team-content .ba-team-content-job-title',
			),
			'short_bio' => array(
				'label'    => esc_html__( 'Member Bio', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-team-content p',
			),
			'social'    => array(
				'label'    => esc_html__( 'Social Network', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-team-social .ba-icon',
			),
		);
	}

	public function get_fields() {

		$content = array(
			'photo'        => array(
				'label'              => esc_html__( 'Photo', 'brain-divi-addons' ),
				'description'        => esc_html__( 'Upload an image of the team member, or type in the URL to the image you would like to display for the team member.', 'brain-divi-addons' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload a Photo', 'brain-divi-addons' ),
				'choose_text'        => esc_attr__( 'Choose a Photo', 'brain-divi-addons' ),
				'update_text'        => esc_attr__( 'Set As Photo', 'brain-divi-addons' ),
				'toggle_slug'        => 'content',
				'mobile_options'     => true,
				'hover'              => 'tabs',
			),

			'use_lightbox' => array(
				'type'        => 'multiple_checkboxes',
				'default'     => 'off',
				'toggle_slug' => 'content',
				'options'     => array(
					'tooltip' => esc_html__( 'Open Photo in Lightbox', 'brain-divi-addons' ),
				),
			),

			'photo_alt'    => array(
				'label'       => esc_html__( 'Photo Alt Text', 'brain-divi-addons' ),
				'description' => esc_html__( 'Define the HTML ALT text for your image here.', 'brain-divi-addons' ),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),

			'member_name'  => array(
				'label'           => esc_html__( 'Member Name', 'brain-divi-addons' ),
				'description'     => esc_html__( 'The team member name.', 'brain-divi-addons' ),
				'type'            => 'text',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
			),

			'job_title'    => array(
				'label'           => esc_html__( 'Job Title', 'brain-divi-addons' ),
				'description'     => esc_html__( 'The job title or position of the team member.', 'brain-divi-addons' ),
				'type'            => 'text',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
			),

			'short_bio'    => array(
				'label'           => esc_html__( 'Member Bio', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Short biography of the team member.', 'brain-divi-addons' ),
				'type'            => 'textarea',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
			),
		);

		$social_links = array(
			'website'   => array(
				'label'       => esc_html__( 'Website URL', 'brain-divi-addons' ),
				'description' => esc_html__( 'Website URL of the team member.', 'brain-divi-addons' ),
				'type'        => 'text',
				'toggle_slug' => 'links',
			),

			'email'     => array(
				'label'       => esc_html__( 'Email Address', 'brain-divi-addons' ),
				'description' => esc_html__( 'Email address of the team member.', 'brain-divi-addons' ),
				'type'        => 'text',
				'toggle_slug' => 'links',
			),

			'facebook'  => array(
				'label'       => esc_html__( 'Facebook URL', 'brain-divi-addons' ),
				'description' => esc_html__( 'Facebook profile or page URL of the team member.', 'brain-divi-addons' ),
				'type'        => 'text',
				'toggle_slug' => 'links',
			),

			'twitter'   => array(
				'label'       => esc_html__( 'Twitter URL', 'brain-divi-addons' ),
				'description' => esc_html__( 'Twitter account URL of the team member.', 'brain-divi-addons' ),
				'type'        => 'text',
				'toggle_slug' => 'links',
			),

			'instagram' => array(
				'label'       => esc_html__( 'Instagram URL', 'brain-divi-addons' ),
				'description' => esc_html__( 'Instagram account URL of the team member.', 'brain-divi-addons' ),
				'type'        => 'text',
				'toggle_slug' => 'links',
			),

			'linkedin'  => array(
				'label'       => esc_html__( 'Linkedin URL', 'brain-divi-addons' ),
				'description' => esc_html__( 'Linkedin profile URL of the team member.', 'brain-divi-addons' ),
				'type'        => 'text',
				'toggle_slug' => 'links',
			),

			'github'    => array(
				'label'       => esc_html__( 'Github URL', 'brain-divi-addons' ),
				'description' => esc_html__( 'Github profile URL of the team member.', 'brain-divi-addons' ),
				'type'        => 'text',
				'toggle_slug' => 'links',
			),

			'behance'   => array(
				'label'       => esc_html__( 'Behance URL', 'brain-divi-addons' ),
				'description' => esc_html__( 'Behance profile URL of the team member.', 'brain-divi-addons' ),
				'type'        => 'text',
				'toggle_slug' => 'links',
			),

			'dribbble'  => array(
				'label'       => esc_html__( 'Dribbble URL', 'brain-divi-addons' ),
				'description' => esc_html__( 'Dribbble account URL of the team member.', 'brain-divi-addons' ),
				'type'        => 'text',
				'toggle_slug' => 'links',
			),
		);

		$settings = array(
			'content_on_hover' => array(
				'label'           => esc_html__( 'Show Content on Hover', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Enable to visualize the content during hover.', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'settings',
			),

			'hover_style'      => array(
				'label'       => esc_html__( 'Content Hover Animation', 'brain-divi-addons' ),
				'description' => esc_html__( 'Choose animation type during the hover.', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'hover_1',
				'options'     => array(
					'hover_1' => esc_html__( 'Slide Bottom', 'brain-divi-addons' ),
					'hover_2' => esc_html__( 'Fade In', 'brain-divi-addons' ),
					'hover_3' => esc_html__( 'Slide Up', 'brain-divi-addons' ),
					'hover_4' => esc_html__( 'Zoom In', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'content_on_hover' => 'on',
				),
			),

			'hover_speed'      => array(
				'label'          => esc_html__( 'Hover Animation Speed', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Set the time for the hover animation speed.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '400ms',
				'default_unit'   => 'ms',
				'fixed_unit'     => 'ms',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'settings',
				'show_if'        => array(
					'content_on_hover' => 'on',
				),
			),

			'links_position'   => array(
				'label'       => esc_html__( 'Social Links Hover Position', 'brain-divi-addons' ),
				'description' => esc_html__( 'Select where you want to put social links icons during the hover.', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'content',
				'options'     => array(
					'content' => esc_html__( 'Relative to the Content', 'brain-divi-addons' ),
					'photo'   => esc_html__( 'Relative to the Photo', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'content_on_hover' => 'off',
				),
			),
		);

		$fields = array(
			// Photo.
			'use_photo_abs'         => array(
				'label'           => esc_html__( 'Use Absolute Photo Position', 'brain-divi-addons' ),
				'description'     => esc_html__( 'If enabled the photo will be in absolute position according to its parent.', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'photo',
				'tab_slug'        => 'advanced',
				'show_if'         => array(
					'content_on_hover' => 'off',
				),
			),

			'photo_placement'       => array(
				'label'       => esc_html__( 'Photo Position', 'brain-divi-addons' ),
				'description' => esc_html__( 'Select the placement of the photo.', 'brain-divi-addons' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'photo',
				'default'     => 'left_top',
				'options'     => array(
					'left_top'     => esc_html__( 'Left Top', 'brain-divi-addons' ),
					'left_bottom'  => esc_html__( 'Left Bottom', 'brain-divi-addons' ),
					'right_top'    => esc_html__( 'Right Top', 'brain-divi-addons' ),
					'right_bottom' => esc_html__( 'Right Bottom', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'use_photo_abs'    => 'on',
					'content_on_hover' => 'off',
				),
			),

			'photo_offset_x'        => array(
				'label'           => esc_html__( 'Photo Offset X', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Set horizontal absolute position value of the photo.', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '50%',
				'range_settings'  => array(
					'min'  => -500,
					'max'  => 500,
					'step' => 1,
				),
				'show_if'         => array(
					'use_photo_abs'    => 'on',
					'content_on_hover' => 'off',
				),
				'toggle_slug'     => 'photo',
				'tab_slug'        => 'advanced',
			),

			'photo_offset_y'        => array(
				'label'           => esc_html__( 'Photo Offset Y', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Set vertical absolute position value of the photo.', 'brain-divi-addons' ),
				'type'            => 'range',
				'default'         => '0px',
				'range_settings'  => array(
					'min'  => -500,
					'max'  => 500,
					'step' => 1,
				),
				'show_if'         => array(
					'use_photo_abs'    => 'on',
					'content_on_hover' => 'off',
				),
				'toggle_slug'     => 'photo',
				'tab_slug'        => 'advanced',
			),

			'photo_width'           => array(
				'label'          => esc_html__( 'Photo Width', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Increase or decrease the width of member photo.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => 'auto',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 800,
				),
				'toggle_slug'    => 'photo',
				'tab_slug'       => 'advanced',
			),

			'photo_height'          => array(
				'label'          => esc_html__( 'Photo Height', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Increase or decrease the height of member photo.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => 'auto',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'    => 'photo',
				'tab_slug'       => 'advanced',
			),

			'photo_alignment'       => array(
				'label'            => esc_html__( 'Photo Alignment', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Align photo to the left, right or center.', 'brain-divi-addons' ),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'     => 'module_align',
				'default_on_front' => 'left',
				'toggle_slug'      => 'photo',
				'tab_slug'         => 'advanced',
				'show_if'          => array(
					'use_photo_abs' => 'off',
				),
			),

			'photo_hover_animation' => array(
				'label'       => esc_html__( 'Photo Hover Animation', 'brain-divi-addons' ),
				'description' => esc_html__( 'Select photo mouse hover animation.', 'brain-divi-addons' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'photo',
				'default'     => 'none',
				'options'     => $this->get_image_hover_animations(),
			),

			// Content.
			'content_alignment'     => array(
				'label'            => esc_html__( 'Content Alignment', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Align content to the left, right or center.', 'brain-divi-addons' ),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'     => 'module_align',
				'default_on_front' => 'left',
				'toggle_slug'      => 'content',
				'tab_slug'         => 'advanced',
			),

			'content_padding'       => array(
				'label'          => esc_html__( 'Content Padding', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'brain-divi-addons' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'content',
				'default'        => '20px|20px|20px|20px',
				'mobile_options' => true,
			),

			// Social links.
			'social_icon_color'     => array(
				'label'       => esc_html__( 'Icon Color', 'brain-divi-addons' ),
				'description' => esc_html__( 'Here you can define a custom color for your icon.', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'links',
				'default'     => '#333',
				'hover'       => 'tabs',
			),

			'links_bg'              => array(
				'label'       => esc_html__( 'Background', 'brain-divi-addons' ),
				'description' => esc_html__( 'Here you can define a custom Background color for your icon.', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'links',
				'default'     => '#e5e5e5',
				'hover'       => 'tabs',
			),

			'links_margin_between'  => array(
				'label'           => esc_html__( 'Spacing Between', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Set how much space between social icons.', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '5px',
				'range_settings'  => array(
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				),
				'toggle_slug'     => 'links',
				'tab_slug'        => 'advanced',
			),

			'links_margin_top'      => array(
				'label'           => esc_html__( 'Top Spacing', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Set how much space the icons will take from the top.', 'brain-divi-addons' ),
				'type'            => 'range',
				'default'         => '15px',
				'range_settings'  => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'toggle_slug'     => 'links',
				'tab_slug'        => 'advanced',
				'show_if'         => array(
					'content_on_hover' => 'on',
					'links_position'   => 'content',
				),
			),

			'links_height'          => array(
				'label'           => esc_html__( 'Height', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Increase or decrease social icons box height.', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '36px',
				'range_settings'  => array(
					'min'  => 10,
					'max'  => 100,
					'step' => 1,
				),
				'toggle_slug'     => 'links',
				'tab_slug'        => 'advanced',
			),

			'links_width'           => array(
				'label'           => esc_html__( 'Width', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Increase or decrease social icons box width.', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '36px',
				'range_settings'  => array(
					'min'  => 10,
					'max'  => 100,
					'step' => 1,
				),
				'toggle_slug'     => 'links',
				'tab_slug'        => 'advanced',
			),

			'links_icon_size'       => array(
				'label'           => esc_html__( 'Icon Size', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Control the size of the icon by increasing or decreasing the font size.', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '16px',
				'range_settings'  => array(
					'min'  => 10,
					'max'  => 100,
					'step' => 1,
				),
				'toggle_slug'     => 'links',
				'tab_slug'        => 'advanced',
			),

			'links_radius'          => array(
				'label'           => esc_html__( 'Border Radius', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Here you can control the corner radius of social icons.', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '4px',
				'default_unit'    => 'px',
				'validate_unit'   => true,
				'range_settings'  => array(
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				),
				'toggle_slug'     => 'links',
				'tab_slug'        => 'advanced',
			),

			// Texts.
			'name_bottom_spacing'   => array(
				'label'          => esc_html__( 'Spacing Bottom', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Set how much space the element will take at the bottom.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '10px',
				'mobile_options' => true,
				'allowed_units'  => array( 'px' ),
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'text',
				'tab_slug'       => 'advanced',
				'sub_toggle'     => 'name',
			),

			'job_bottom_spacing'    => array(
				'label'          => esc_html__( 'Spacing Bottom', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Set how much space the element will take at the bottom.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '10px',
				'mobile_options' => true,
				'allowed_units'  => array( 'px' ),
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'text',
				'tab_slug'       => 'advanced',
				'sub_toggle'     => 'job_title',
			),
		);

		$overlay    = $this->get_overlay_option_fields( 'overlay', 'on', array() );
		$content_bg = $this->custom_background_fields(
			'content',
			esc_html__( 'Content', 'brain-divi-addons' ),
			'advanced',
			'content',
			array( 'color', 'gradient', 'image', 'hover' ),
			array(),
			'#ffffff'
		);

		return array_merge( $content, $social_links, $settings, $fields, $content_bg, $overlay );

	}

	public function get_advanced_fields_config() {

		$advanced_fields = array();

		$advanced_fields['text']        = false;
		$advanced_fields['borders']     = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['fonts']['name'] = array(
			'label'           => esc_html__( 'Name', 'brain-divi-addons' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-team-content .ba-team-content-name',
				'important' => 'all',
			),
			'important'       => 'all',
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'text',
			'sub_toggle'      => 'name',
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '.1',
				),
			),
			'font_size'       => array(
				'default' => '22px',
			),
		);

		$advanced_fields['fonts']['job_title'] = array(
			'label'           => esc_html__( 'Job Title', 'brain-divi-addons' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-team-content .ba-team-content-job-title',
				'important' => 'all',
			),
			'important'       => 'all',
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'text',
			'sub_toggle'      => 'job_title',
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '.1',
				),
			),
			'font_size'       => array(
				'default' => '14px',
			),
		);

		$advanced_fields['fonts']['short_bio'] = array(
			'label'           => esc_html__( 'Bio', 'brain-divi-addons' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-team-content .ba-team-content-bio',
				'important' => 'all',
			),
			'important'       => 'all',
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'text',
			'sub_toggle'      => 'short_bio',
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '.1',
				),
			),
			'font_size'       => array(
				'default' => '14px',
			),
		);

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '%%order_class%% .ba-team',
				'important' => 'all',
			),
		);

		$advanced_fields['background'] = array(
			'css' => array(
				'main'      => '%%order_class%% .ba-team',
				'important' => 'all',
			),
		);

		$advanced_fields['box_shadow']['content'] = array(
			'label'       => esc_html__( 'Content Box Shadow', 'brain-divi-addons' ),
			'toggle_slug' => 'content',
			'css'         => array(
				'main'      => '%%order_class%% .ba-team-content',
				'important' => 'all',
			),
		);

		$advanced_fields['box_shadow']['main'] = array(
			'label'       => esc_html__( 'Box Shadow', 'brain-divi-addons' ),
			'toggle_slug' => 'box_shadow',
			'css'         => array(
				'main'      => '%%order_class%% .ba-team',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['content'] = array(
			'label_prefix' => esc_html__( 'Content', 'brain-divi-addons' ),
			'toggle_slug'  => 'content',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-team-content',
					'border_styles' => '%%order_class%% .ba-team-content',
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
			'toggle_slug' => 'border',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-team',
					'border_styles' => '%%order_class%% .ba-team',
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

		$advanced_fields['borders']['photo'] = array(
			'label_prefix' => esc_html__( 'Photo', 'brain-divi-addons' ),
			'toggle_slug'  => 'photo',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-team figure img',
					'border_styles' => '%%order_class%% .ba-team figure img',
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

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '%%order_class%% .ba-team',
				'important' => 'all',
			),
		);

		$advanced_fields['width'] = array(
			'css' => array(
				'main'      => '%%order_class%% .ba-team',
				'important' => 'all',
			),
		);

		$advanced_fields['height'] = array(
			'css' => array(
				'main'      => '%%order_class%% .ba-team',
				'important' => 'all',
			),
		);

		return $advanced_fields;
	}

	public function render_figure() {

		$photo        = ! empty( $this->props['photo'] ) ? $this->props['photo'] : '';
		$data_schema  = $this->get_swapped_img_schema( 'photo' );
		$use_lightbox = $this->props['use_lightbox'];
		$photo_alt    = $this->props['photo_alt'];

		return sprintf(
			'<img class="ba-swapped-img %3$s" data-mfp-src="%1$s" src="%1$s" %2$s alt="%4$s"/>',
			$photo,
			$data_schema,
			'on' === $use_lightbox ? 'ba-lightbox' : '',
			$photo_alt
		);
	}

	public function render_name() {

		if ( ! empty( $this->props['member_name'] ) ) {
			return sprintf( '<h3 class="ba-team-content-name">%1$s</h3>', $this->props['member_name'] );
		}

	}

	public function render_job_title() {

		if ( ! empty( $this->props['job_title'] ) ) {
			return sprintf( '<div class="ba-team-content-job-title">%1$s</div>', $this->props['job_title'] );
		}
	}

	public function render_bio() {
		if ( ! empty( $this->props['short_bio'] ) ) {
			return sprintf( '<div class="ba-team-content-bio">%1$s</div>', wp_strip_all_tags( $this->props['short_bio'] ) );
		}
	}

	public function render_links() {
		include 'network_icons.php';
		$links = array(
			array(
				'type' => 'website',
				'name' => 'Website',
				'icon' => 'website',
			),
			array(
				'type' => 'email',
				'name' => 'Email',
				'icon' => 'email',
			),
			array(
				'type' => 'facebook',
				'name' => 'Facebook',
				'icon' => 'facebook',
			),
			array(
				'type' => 'twitter',
				'name' => 'Twitter',
				'icon' => 'twitter',
			),
			array(
				'type' => 'linkedin',
				'name' => 'Linkedin',
				'icon' => 'linkedin',
			),
			array(
				'type' => 'instagram',
				'name' => 'Instagram',
				'icon' => 'instagram',
			),
			array(
				'type' => 'github',
				'name' => 'Github',
				'icon' => 'github',
			),
			array(
				'type' => 'behance',
				'name' => 'Behance',
				'icon' => 'behance',
			),
			array(
				'type' => 'dribbble',
				'name' => 'Dribbble',
				'icon' => 'dribbble',
			),
		);

		$html     = '';
		$is_empty = true;

		foreach ( $links as $item ) {

			if ( ! empty( $this->props[ $item['type'] ] ) ) {
				$href_prefix = '';
				$is_empty    = false;
				$icon        = $ba_team_network_icons[ $item['icon'] ];

				if ( 'email' === $item['type'] ) {
					$href_prefix = 'mailto:';
				}

				$html = $html . sprintf(
					'<li><a class="ba-icon" href="%3$s%2$s"><span>%1$s</span></a></li>',
					$icon,
					$this->props[ $item['type'] ],
					$href_prefix
				);

			}
		}

		if ( $is_empty ) {
			return;
		}

		return sprintf( '<ul class="ba-team-social item-%1$s">%2$s</ul>', $this->props['content_alignment'], $html );

	}

	public function render( $attrs, $content = null, $render_slug ) {

		$this->render_css( $render_slug );

		$content_on_hover       = $this->props['content_on_hover'];
		$hover_style            = $this->props['hover_style'];
		$classes                = array();
		$links_position         = $this->props['links_position'];
		$processed_overlay_icon = esc_attr( et_pb_process_font_icon( $this->props['overlay_icon'] ) );
		$overlay_icon           = ! empty( $processed_overlay_icon ) ? $processed_overlay_icon : '';

		array_push( $classes, 'ba-module ba-team ba-bg-support ba-swapped-img-selector' );
		if ( 'on' === $content_on_hover ) {
			array_push( $classes, $hover_style );
		}

		return sprintf(
			'<div class="%10$s ba-hover--%7$s">
                %8$s
				<figure class="ba-figure ba-team-figure">
					<div class="ba-overlay" data-icon="%9$s"></div>
					%1$s
                </figure>
				<div class="ba-team-content content-%2$s">
                    <div class="flex-top">
                        %3$s %4$s %5$s
                    </div>
                    %6$s
				</div>
			</div>',
			$this->render_figure(),
			$this->props['content_alignment'],
			$this->render_name(),
			$this->render_job_title(),
			$this->render_bio(),
			( 'on' === $content_on_hover || 'content' === $links_position ) ? $this->render_links() : '',
			$this->props['photo_hover_animation'],
			( 'off' === $content_on_hover && 'photo' === $links_position ) ? $this->render_links() : '',
			$overlay_icon,
			join( ' ', $classes )
		);
	}

	public function render_css( $render_slug ) {

		$hover_speed                   = $this->props['hover_speed'];
		$links_position                = $this->props['links_position'];
		$photo_height                  = $this->props['photo_height'];
		$content_on_hover              = $this->props['content_on_hover'];
		$photo_alignment               = $this->props['photo_alignment'];
		$photo_width                   = $this->props['photo_width'];
		$photo_width_tablet            = $this->props['photo_width_tablet'];
		$photo_width_phone             = $this->props['photo_width_phone'];
		$photo_width_last_edited       = $this->props['photo_width_last_edited'];
		$photo_width_responsive_status = et_pb_get_responsive_status( $photo_width_last_edited );
		$links_margin_top              = $this->props['links_margin_top'];
		$link_color_hover              = $this->get_hover_value( 'social_icon_color' );
		$link_bg_hover                 = $this->get_hover_value( 'links_bg' );
		$content_alignment             = $this->props['content_alignment'];
		$use_photo_abs                 = $this->props['use_photo_abs'];
		$photo_offset_x                = $this->props['photo_offset_x'];
		$photo_offset_y                = $this->props['photo_offset_y'];
		$photo_placement               = $this->props['photo_placement'];
		$photo__placement              = explode( '_', $photo_placement );

		if ( ! empty( $this->props['custom_margin'] ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%.et_pb_module',
					'declaration' => 'margin-bottom: 0!important;',
				)
			);
		}

		if ( 'off' === $content_on_hover && 'on' === $use_photo_abs ) {
			$photo_width = 'auto' !== $photo_width ? $photo_width : '50%';
		}

		if ( 'off' === $content_on_hover && 'photo' === $links_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-team-social',
					'declaration' => '
                    position: absolute;
                    top: 25px;
                    left : 0px;
                    width: 100%;
                    z-index: 9999;
                    justify-content: center;',
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-team .ba-team-social li',
					'declaration' => '
                    transform: translateY(-20px);
                    transition: .3s;
                    opacity: 0;',
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-team:hover .ba-team-social li',
					'declaration' => '
                    transform: translateX(0) translateY(0);
                    transition: .3s;
                    opacity: 1;',
				)
			);

			for ( $i = 0; $i < 10; $i++ ) {
				$_i = $i + 1;
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => "%%order_class%% .ba-team .ba-team-social li:nth-child({$_i})",
						'declaration' => sprintf( 'transition-delay: .%1$ss;', $i ),
					)
				);
			}
		}

		if ( 'on' === $content_on_hover ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-team-content, %%order_class%% .ba-team-content *',
					'declaration' => sprintf( 'transition: %1$s all ease-in-out;', $hover_speed ),
				)
			);
		}

		// Text Spacing.
		$this->get_responsive_styles(
			'name_bottom_spacing',
			'%%order_class%% .ba-team-content h3',
			array(
				'primary'   => 'padding-bottom',
				'important' => false,
			),
			array( 'default' => '0' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'job_bottom_spacing',
			'%%order_class%% .ba-team-content-job-title',
			array(
				'primary'   => 'padding-bottom',
				'important' => false,
			),
			array( 'default' => '10px' ),
			$render_slug
		);

		// Content Padding.
		$this->get_responsive_styles(
			'content_padding',
			'%%order_class%% .ba-team-content',
			array( 'primary' => 'padding' ),
			array( 'default' => '20px|20px|20px|20px' ),
			$render_slug
		);

		// Photo absolute.
		if ( 'off' === $content_on_hover && 'on' === $use_photo_abs ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-team figure',
					'declaration' => 'position: absolute; z-index: 99;',
				)
			);

			// photo offset X.
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-team figure',
					'declaration' => sprintf( '%1$s: %2$s;', $photo__placement[0], $photo_offset_x ),
				)
			);

			// photo offset Y.
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-team figure',
					'declaration' => sprintf( '%1$s: %2$s;', $photo__placement[1], $photo_offset_y ),
				)
			);

			if ( 'right_top' === $photo_placement ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-team figure',
						'declaration' => 'transform : translateX(50%) translateY(-50%);',
					)
				);
			} elseif ( 'right_bottom' === $photo_placement ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-team figure',
						'declaration' => 'transform : translateX(50%) translateY(50%);',
					)
				);
			} elseif ( 'left_bottom' === $photo_placement ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-team figure',
						'declaration' => 'transform : translateX(-50%) translateY(50%);',
					)
				);
			} elseif ( 'left_top' === $photo_placement ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-team figure',
						'declaration' => 'transform : translateX(-50%) translateY(-50%);',
					)
				);
			}
		}

		// photo width & height.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-team figure',
				'declaration' => sprintf( 'width: %1$s;', $photo_width ),
			)
		);

		if ( $photo_width_tablet && $photo_width_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-team figure',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'width: %1$s;', $photo_width_tablet ),
				)
			);
		}

		if ( $photo_width_phone && $photo_width_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-team figure',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'width: %1$s;', $photo_width_phone ),
				)
			);
		}

		if ( 'auto' !== $photo_height ) {
			$this->get_responsive_styles(
				'photo_height',
				'%%order_class%% .ba-team figure',
				array( 'primary' => 'height' ),
				array( 'default' => 'auto' ),
				$render_slug
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-team figure img',
					'declaration' => 'height: 100%; object-fit: cover;width:100%;',
				)
			);
		}

		// photo alignment.
		if ( 'off' === $use_photo_abs ) {
			if ( 'center' === $photo_alignment ) {

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-team figure',
						'declaration' => 'margin-left: auto; margin-right: auto;',
					)
				);
			} elseif ( 'right' === $photo_alignment ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-team figure',
						'declaration' => 'margin-left: auto;',
					)
				);
			}
		}

		// Social Icons.
		if ( 'on' === $content_on_hover || 'content' === $links_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-team-social',
					'declaration' => sprintf( 'padding-top: %1$s!important;', $links_margin_top ),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-icon',
				'declaration' => sprintf(
					'background-color: %1$s;
					border-radius: %2$s;
					height: %3$s;
					width: %4$s;',
					$this->props['links_bg'],
					$this->props['links_radius'],
					$this->props['links_height'],
					$this->props['links_width']
				),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-icon svg',
				'declaration' => sprintf(
					'fill: %1$s!important;
					width: %2$s!important;',
					$this->props['social_icon_color'],
					$this->props['links_icon_size']
				),
			)
		);

		if ( 'left' === $content_alignment ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-team-social .ba-icon',
					'declaration' => sprintf( 'margin-right: %1$s;', $this->props['links_margin_between'] ),
				)
			);
		} elseif ( 'right' === $content_alignment ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-team-social .ba-icon',
					'declaration' => sprintf( 'margin-left: %1$s;', $this->props['links_margin_between'] ),
				)
			);
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-team-social .ba-icon',
					'declaration' => sprintf( 'margin-left: %1$s; margin-right: %1$s;', $this->props['links_margin_between'] ),
				)
			);
		}

		// Social Icons hover.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-team-social .ba-icon:hover',
				'declaration' => sprintf( 'background-color: %1$s; color: %2$s!important;', $link_bg_hover, $link_color_hover ),
			)
		);

		$this->get_custom_bg_style( $render_slug, 'content', '%%order_class%% .ba-team-content', '%%order_class%%:hover .ba-team-content' );

		// Overlay Styles.
		$this->get_overlay_style( $render_slug, 'photo' );

	}
}

new BA_Advanced_Team();
