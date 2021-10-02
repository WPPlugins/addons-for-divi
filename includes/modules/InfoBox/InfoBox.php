<?php
class BA_Info_Box extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/info-box/',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {

		$this->vb_support = 'on';
		$this->slug       = 'ba_info_box';
		$this->name       = esc_html__( 'Brain Info Box', 'addons-for-divi' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'info-box.svg';

		$this->settings_modal_toggles = array(

			'general'  => array(
				'toggles' => array(
					'content' => esc_html__( 'Content', 'addons-for-divi' ),
				),
			),

			'advanced' => array(
				'toggles' => array(
					'general'      => esc_html__( 'General', 'addons-for-divi' ),
					'main_element' => esc_html__( 'Figure', 'addons-for-divi' ),
					'overlay'      => esc_html__( 'Overlay', 'addons-for-divi' ),
					'title'        => esc_html__( 'Title', 'addons-for-divi' ),
					'header'       => array(
						'title'             => esc_html__( 'Heading Text', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'h1' => array(
								'name' => 'H1',
								'icon' => 'text-h1',
							),
							'h2' => array(
								'name' => 'H2',
								'icon' => 'text-h2',
							),
							'h3' => array(
								'name' => 'H3',
								'icon' => 'text-h3',
							),
							'h4' => array(
								'name' => 'H4',
								'icon' => 'text-h4',
							),
							'h5' => array(
								'name' => 'H5',
								'icon' => 'text-h5',
							),
							'h6' => array(
								'name' => 'H6',
								'icon' => 'text-h6',
							),
						),
					),
					'button'       => esc_html__( 'Button', 'addons-for-divi' ),
				),
			),

		);

		$this->custom_css_fields = array(
			'image'  => array(
				'label'    => esc_html__( 'Image', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-info-box .figure img',
			),
			'icon'  => array(
				'label'    => esc_html__( 'Icon', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-info-box-icon i',
			),
			'video'  => array(
				'label'    => esc_html__( 'Video', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-info-box-video video',
			),
			'title'  => array(
				'label'    => esc_html__( 'Title', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-info-box-title',
			),
			'button'  => array(
				'label'    => esc_html__( 'Button', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-btn-info-box',
			),
		);
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['borders']['box'] = array(
			'label_prefix' => esc_html__( 'Box', 'addons-for-divi' ),
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%%',
					'border_styles' => '%%order_class%%',
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
			'toggle_slug'  => 'general',
		);

		$advanced_fields['borders']['photo'] = array(
			'toggle_slug' => 'main_element',
			'tab_slug'    => 'advanced',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .figure, %%order_class%% .ba-info-box-icon, %%order_class%% .ba-content-video',
					'border_styles' => '%%order_class%% .figure, %%order_class%% .ba-info-box-icon, %%order_class%% .ba-content-video',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#e5e5e5',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '%%order_class%%',
				'important' => 'all',
			),
		);

		$advanced_fields['button']['button'] = array(
			'label'         => esc_html__( 'Button', 'addons-for-divi' ),
			'css'           => array(
				'main'      => '%%order_class%% .ba-btn-info-box',
				'important' => 'all',
			),
			'use_alignment' => false,
		);


		$advanced_fields['fonts'] = array(
			'title'    => array(
				'label'           => esc_html__( 'Title', 'addons-for-divi' ),
				'css'             => array(
					'main'      => '%%order_class%% .ba-info-box-title',
					'important' => 'all',
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'title',
				'hide_text_align' => false,
				'header_level'    => array(
					'default' => 'h2',
				),
				'line_height'     => array(
					'default'        => '1em',
					'range_settings' => array(
						'min'  => '1',
						'max'  => '3',
						'step' => '.1',
					),
				),
				'font_size'       => array(
					'default' => '26px',
				),
			),
			'body'     => array(
				'label'          => esc_html__( 'Body', 'addons-for-divi' ),
				'css'             => array(
					'main'        => '%%order_class%% .ba-mce-content',
					'line_height' => '%%order_class%% .ba-mce-content p',
					'text_align'  => '%%order_class%% .ba-mce-content',
					'text_shadow' => '%%order_class%% .ba-mce-content',
					'important'   => 'all',
				),
				'block_elements' => array(
					'tabbed_subtoggles' => true,
					'css'               => array(
						'main'      => '%%order_class%% .ba-mce-content',
						'important' => 'all',
					),
				),
			),
			'header'   => array(
				'label'       => esc_html__( 'Heading', 'addons-for-divi' ),
				'css'         => array(
					'main'      => '%%order_class%% .ba-mce-content h1',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => absint( et_get_option( 'body_header_size', '30' ) ) . 'px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h1',
			),
			'header_2' => array(
				'label'       => esc_html__( 'Heading 2', 'addons-for-divi' ),
				'css'         => array(
					'main'      => '%%order_class%% .ba-mce-content h2',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => '26px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h2',
			),
			'header_3' => array(
				'label'       => esc_html__( 'Heading 3', 'addons-for-divi' ),
				'css'         => array(
					'main'      => '%%order_class%% .ba-mce-content h3',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => '22px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h3',
			),
			'header_4' => array(
				'label'       => esc_html__( 'Heading 4', 'addons-for-divi' ),
				'css'         => array(
					'main'      => '%%order_class%% .ba-mce-content h4',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => '18px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h4',
			),
			'header_5' => array(
				'label'       => esc_html__( 'Heading 5', 'addons-for-divi' ),
				'css'         => array(
					'main'      => '%%order_class%% .ba-mce-content h5',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => '16px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h5',
			),
			'header_6' => array(
				'label'       => esc_html__( 'Heading 6', 'addons-for-divi' ),
				'css'         => array(
					'main'      => '%%order_class%% .ba-mce-content h6',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => '14px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h6',
			),
		);

		return $advanced_fields;
	}

	public function get_fields() {

		$fields = array(

			'main_figure'          => array(
				'label'       => esc_html__( 'Choose an Figure Element', 'addons-for-divi' ),
				'description' => esc_html__( 'Choose icon/image/video for the info box figure.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'content',
				'default'     => 'image',
				'options'     => array(
					'image' => esc_html__( 'Image', 'addons-for-divi' ),
					'video' => esc_html__( 'Video', 'addons-for-divi' ),
					'icon'  => esc_html__( 'Icon', 'addons-for-divi' ),
				),
			),

			'photo'                => array(
				'label'              => esc_html__( 'Upload Image', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload an image or type in the URL of the image you would like to display for the info box.', 'addons-for-divi' ),
				'type'               => 'upload',
				'data_type'          => 'image',
				'option_category'    => 'basic_option',
				'default'            => BRAIN_ADDONS_PLUGIN_ASSETS . 'imgs/placeholder.svg',
				'upload_button_text' => esc_attr__( 'Upload an image', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Image', 'addons-for-divi' ),
				'toggle_slug'        => 'content',
				'mobile_options'     => true,
				'hover'              => 'tabs',
				'show_if'            => array(
					'main_figure' => 'image',
				),
			),

			'video'                => array(
				'label'              => esc_html__( 'Video MP4 File Or Youtube URL', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload MP4 video file or type youtube URL which would like to display.', 'addons-for-divi' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'data_type'          => 'video',
				'upload_button_text' => esc_attr__( 'Upload a video', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose a Video MP4 File', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Video', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload your desired video in .MP4 format, or type in the URL to the video you would like to display', 'addons-for-divi' ),
				'toggle_slug'        => 'content',
				'computed_affects'   => array( '__video' ),
				'show_if'            => array(
					'main_figure' => 'video',
				),
			),

			'icon'                 => array(
				'label'       => esc_html__( 'Select Icon', 'addons-for-divi' ),
				'description' => esc_html__( 'Select icon for the info box.', 'addons-for-divi' ),
				'type'        => 'select_icon',
				'toggle_slug' => 'content',
				'tab_slug'    => 'general',
				'default'     => '+',
				'show_if'     => array(
					'main_figure' => 'icon',
				),
			),

			'title'                => array(
				'label'           => esc_html__( 'Title Text', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the title for your info box.', 'addons-for-divi' ),
				'type'            => 'text',
				'dynamic_content' => 'text',
				'toggle_slug'     => 'content',
			),

			'body_content'         => array(
				'label'           => esc_html__( 'Content', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the body content for your info box.', 'addons-for-divi' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
			),

			'use_button'           => array(
				'label'       => esc_html__( 'Use Button', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can choose whether button should be used.', 'addons-for-divi' ),
				'type'        => 'yes_no_button',
				'options'     => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'     => 'off',
				'toggle_slug' => 'content',
			),

			'button_text'          => array(
				'label'           => esc_html__( 'Button Text', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the button text for your info box.', 'addons-for-divi' ),
				'type'            => 'text',
				'default'         => 'Click Here',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),

			'button_link'          => array(
				'label'           => esc_html__( 'Button Link', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the button link url for your info box.', 'addons-for-divi' ),
				'type'            => 'text',
				'default'         => '',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'url',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),

			'is_new_wndow'         => array(
				'label'           => esc_html__( 'Open Button link in new window', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether button URL should be opened in new window.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'content',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),

			// video overlay.
			'use_overlay'          => array(
				'label'           => esc_html__( 'Use Overlay Image', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether video overlay should be used.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'overlay',
				'show_if'         => array(
					'main_figure' => 'video',
				),
			),

			'vo_src'               => array(
				'label'              => esc_html__( 'Overlay Image', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload an overlay image or type in the URL of the image you would like to display.', 'addons-for-divi' ),
				'type'               => 'upload',
				'data_type'          => 'image',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Image', 'addons-for-divi' ),
				'toggle_slug'        => 'overlay',
				'show_if'            => array(
					'main_figure' => 'video',
					'use_overlay' => 'on',
				),
			),

			'vo_icon_color'        => array(
				'label'       => esc_html__( 'Overlay Icon Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom color for your overlay icon.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'overlay',
				'show_if'     => array(
					'main_figure' => 'video',
					'use_overlay' => 'on',
				),
			),

			'vo_icon_size'         => array(
				'label'           => esc_html__( 'Overlay Icon Size', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can define a custom size for your overlay icon.', 'addons-for-divi' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'default '        => '6rem',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'toggle_slug'     => 'overlay',
				'tab_slug'        => 'advanced',
				'show_if'         => array(
					'main_figure' => 'video',
					'use_overlay' => 'on',
				),
			),

			'vo_bg'                => array(
				'label'       => esc_html__( 'Overlay background', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom background color for your overlay.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'overlay',
				'show_if'     => array(
					'main_figure' => 'video',
					'use_overlay' => 'on',
				),
			),

			// info box.
			'content_alignment'    => array(
				'label'            => esc_html__( 'Content Alignment', 'addons-for-divi' ),
				'description'      => esc_html__( 'Align content to the left, right or center.', 'addons-for-divi' ),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'     => 'module_align',
				'default_on_front' => 'left',
				'toggle_slug'      => 'general',
				'tab_slug'         => 'advanced',
			),

			'content_padding'      => array(
				'label'          => esc_html__( 'Content Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define custom content padding for the info box content. Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'general',
				'tab_slug'       => 'advanced',
				'default'        => '15px|0px|0px|0px',
				'mobile_options' => true,
			),

			// figure.
			'icon_color'           => array(
				'label'       => esc_html__( 'Icon Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom color for your icon.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'main_element',
				'default'     => '#333',
				'hover'       => 'tabs',
				'show_if'     => array(
					'main_figure' => 'icon',
				),
			),

			'icon_bg'              => array(
				'label'       => esc_html__( 'Icon Background', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom background color for your icon.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'main_element',
				'default'     => 'transparent',
				'hover'       => 'tabs',
				'show_if'     => array(
					'main_figure' => 'icon',
				),
			),

			'icon_size'            => array(
				'label'           => esc_html__( 'Icon Size', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can define a custom size for your icon.', 'addons-for-divi' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'default'         => '45px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 400,
				),
				'toggle_slug'     => 'main_element',
				'tab_slug'        => 'advanced',
				'mobile_options'  => true,
				'show_if'         => array(
					'main_figure' => 'icon',
				),
			),

			'image_width'          => array(
				'label'          => esc_html__( 'Image Width', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom width for your image.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '100%',
				'default_unit'   => '%',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'show_if'        => array(
					'main_figure' => 'image',
				),
				'toggle_slug'    => 'main_element',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'main_figure' => 'image',
				),
			),

			'image_height'         => array(
				'label'           => esc_html__( 'Image Height', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can define a custom height for your image.', 'addons-for-divi' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'default'         => 'auto',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'     => 'main_element',
				'tab_slug'        => 'advanced',
				'show_if'         => array(
					'main_figure' => 'image',
				),
			),

			'img_anim'             => array(
				'label'       => esc_html__( 'Hover Animation', 'addons-for-divi' ),
				'description' => esc_html__( 'Select image hover animation.', 'addons-for-divi' ),
				'type'        => 'select',
				'default'     => 'none',
				'options'     => array(
					'none'         => esc_html__( 'None', 'addons-for-divi' ),
					'zoom-in'      => esc_html__( 'Zoom In', 'addons-for-divi' ),
					'zoom-out'     => esc_html__( 'Zoom Out', 'addons-for-divi' ),
					'pulse'        => esc_html__( 'Pulse', 'addons-for-divi' ),
					'bounce'       => esc_html__( 'Bounce', 'addons-for-divi' ),
					'flash'        => esc_html__( 'Flash', 'addons-for-divi' ),
					'rubberBand'   => esc_html__( 'Rubber Band', 'addons-for-divi' ),
					'shake'        => esc_html__( 'Shake', 'addons-for-divi' ),
					'swing'        => esc_html__( 'Swing', 'addons-for-divi' ),
					'tada'         => esc_html__( 'Tada', 'addons-for-divi' ),
					'wobble'       => esc_html__( 'Wobble', 'addons-for-divi' ),
					'jello'        => esc_html__( 'Jello', 'addons-for-divi' ),
					'heartBeat'    => esc_html__( 'Heart Beat', 'addons-for-divi' ),
					'bounceIn'     => esc_html__( 'Bounce In', 'addons-for-divi' ),
					'fadeIn'       => esc_html__( 'Fade In', 'addons-for-divi' ),
					'flip'         => esc_html__( 'Flip', 'addons-for-divi' ),
					'lightSpeedIn' => esc_html__( 'Light Speed In', 'addons-for-divi' ),
					'rotateIn'     => esc_html__( 'Rotate In', 'addons-for-divi' ),
					'slideInUp'    => esc_html__( 'Slide In Up', 'addons-for-divi' ),
					'slideInDown'  => esc_html__( 'Slide In Down', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'main_figure' => 'image',
				),
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'main_element',
			),

			'icon_padding'         => array(
				'label'          => esc_html__( 'Icon Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define custom icon padding for the info box icon. Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'main_element',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
				'show_if'        => array(
					'main_figure' => 'icon',
				),
			),

			// Button.
			'btn_spacing_top'      => array(
				'label'           => esc_html__( 'Button Spacing Top', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can define a custom spacing at the top of the button.', 'addons-for-divi' ),
				'type'            => 'range',
				'default'         => '15px',
				'option_category' => 'basic_option',
				'allowed_units'   => array( 'px' ),
				'default_unit'    => 'px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'     => 'button',
				'tab_slug'        => 'advanced',
			),

			'title_bottom_spacing' => array(
				'label'          => esc_html__( 'Title Spacing Bottom', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the bottom of the title.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '10px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'title',
				'tab_slug'       => 'advanced',
			),

			// computed fields.
			'__video'              => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'BA_Info_Box', 'get_new_video' ),
				'computed_depends_on' => array(
					'video',
				),
				'computed_minimum'    => array(
					'video',
				),
			),

		);

		$overlay = $this->get_overlay_option_fields( 'overlay', 'on', array( 'main_figure' => 'image' ) );

		return array_merge( $fields, $overlay );
	}

	public function get_new_video( $args = array(), $conditional_tags = array(), $current_page = array() ) {
		return false;
	}

	public function render_figure() {

		if ( 'image' === $this->props['main_figure'] ) {

			$processed_overlay_icon = esc_attr( et_pb_process_font_icon( $this->props['overlay_icon'] ) );
			$overlay_icon           = ! empty( $processed_overlay_icon ) ? $processed_overlay_icon : '';
			$photo                  = $this->props['photo'];
			$data_schema            = $this->get_swapped_img_schema( 'photo' );

			return sprintf(
				'<div class="figure ba-lightbox-ctrl">
                    <div class="ba-overlay" data-icon="%3$s"></div>
					<img class="ba-info-box-img ba-swapped-img" src="%1$s" %2$s alt=""/>
				</div>',
				$photo,
				$data_schema,
				$overlay_icon
			);
		} elseif ( $this->props['main_figure'] === 'icon' ) {

			$selected_icon = esc_attr( et_pb_process_font_icon( $this->props['icon'] ) );
			$icon_name     = $selected_icon ? $selected_icon : '';

			return sprintf(
				'<span class="ba-info-box-icon">
					<i class="ba-et-icon" data-icon="%1$s"></i>
				</span>',
				$icon_name
			);

		} else {

			$video_src    = '';
			$overlay_html = '';
			$overlay_src  = $this->props['vo_src'];

			if ( false !== et_pb_check_oembed_provider( esc_url( $this->props['video'] ) ) ) {

					$video_src = wp_oembed_get( esc_url( $this->props['video'] ) );
			} else {

				$video     = $this->props['video'];
				$video_src = sprintf( '<video controls><source type="video/mp4" src="%1$s"></video>', $video );
			}

			if ( ! empty( $overlay_src ) ) {
				$overlay_html = sprintf(
					'<div style="background-image: url(%1$s)" class="et_pb_video_overlay">
						<div class="et_pb_video_overlay_hover">
							<a href="#" class="et_pb_video_play"></a>
						</div>
					</div>',
					$overlay_src
				);
			}

			return sprintf(
				'<div class="ba-content-video et_pb_video">
					<div class="et_pb_video_box ba-content-video-wrap">
						%1$s
					</div>
					%2$s
				</div>',
				$video_src,
				$overlay_html
			);

		}
	}

	public function render_title() {

		$title_text            = $this->props['title'];
		$title_level           = $this->props['title_level'];
		$processed_title_level = et_pb_process_header_level( $title_level, 'h2' );
		$processed_title_level = esc_html( $processed_title_level );

		if ( ! empty( $title_text ) ) {
			return sprintf( '<%2$s class="ba-info-box-title">%1$s</%2$s>', $title_text, $processed_title_level );
		}
	}


	public function _render_button() {

		if ( $this->props['use_button'] === 'on' ) {
			$button_custom = $this->props['custom_button'];
			$button_text   = isset( $this->props['button_text'] ) ? $this->props['button_text'] : 'Button';
			$button_link   = isset( $this->props['button_link'] ) ? $this->props['button_link'] : '#';
			$button_url    = trim( $button_link );
			$button_rel    = isset( $this->props['button_rel'] ) ? $this->props['button_rel'] : '';
			$new_tab       = $this->props['is_new_wndow'];
			$button_icon   = $this->props['button_icon'];

			$button_output = $this->render_button(
				array(
					'button_classname' => array( 'ba-btn-default', 'ba-btn-info-box' ),
					'button_custom'    => $button_custom,
					'button_rel'       => $button_rel,
					'button_text'      => $button_text,
					'button_url'       => $button_url,
					'custom_icon'      => $button_icon,
					'has_wrapper'      => false,
					'url_new_window'   => $new_tab,
				)
			);

			return sprintf(
				'<div class="ba-info-box-btn">
                    %1$s
                </div>',
				$button_output
			);
		}
	}

	public function render_MCE() {

		$body_content = $this->props['body_content'];
		$content      = force_balance_tags( $body_content );
		$content      = preg_replace( '~\s?<p></p>\s?~', '', $content );

		if ( ! empty( $content ) ) {
			return sprintf( '<div class="ba-mce-content">%1$s</div>', $content );
		}
	}

	public function render_main_element() {
		$photo = $this->props['photo'];
		$icon  = $this->props['icon'];
		$video = $this->props['video'];

		if ( ! empty( $photo ) || ! empty( $icon ) || ! empty( $video ) ) {
			return sprintf( '<div class="ba-info-box-figure"> %1$s</div>', $this->render_figure() );
		}
	}

	public function render( $attrs, $content = null, $render_slug ) {

		$this->render_css( $render_slug );
		$this->remove_classname( 'et_pb_module' );
		$this->add_classname( 'ba_et_pb_module' );

		return sprintf(
			'<div class="ba-info-box ba-swapped-img-selector ba-hover--%1$s">
			    %2$s
                <div class="ba-info-box-content">
                    %3$s %4$s %5$s
                </div>
		    </div>',
			$this->props['img_anim'],
			$this->render_main_element(),
			$this->render_title(),
			$this->render_MCE(),
			$this->_render_button()
		);
	}

	public function render_css( $render_slug ) {

		$icon_padding                           = $this->props['icon_padding'];
		$icon_padding_tablet                    = $this->props['icon_padding_tablet'];
		$icon_padding_phone                     = $this->props['icon_padding_phone'];
		$icon_padding_last_edited               = $this->props['icon_padding_last_edited'];
		$icon_padding_responsive_status         = et_pb_get_responsive_status( $icon_padding_last_edited );
		$image_width                            = $this->props['image_width'];
		$image_height                           = $this->props['image_height'];
		$content_padding                        = $this->props['content_padding'];
		$content_padding_tablet                 = $this->props['content_padding_tablet'];
		$content_padding_phone                  = $this->props['content_padding_phone'];
		$content_padding_last_edited            = $this->props['content_padding_last_edited'];
		$content_padding_responsive_status      = et_pb_get_responsive_status( $content_padding_last_edited );
		$icon_bg_hover                          = $this->get_hover_value( 'icon_bg' );
		$icon_color_hover                       = $this->get_hover_value( 'icon_color' );
		$btn_spacing_top                        = $this->props['btn_spacing_top'];
		$title_bottom_spacing                   = $this->props['title_bottom_spacing'];
		$title_bottom_spacing_tablet            = $this->props['title_bottom_spacing_tablet'];
		$title_bottom_spacing_phone             = $this->props['title_bottom_spacing_phone'];
		$title_bottom_spacing_last_edited       = $this->props['title_bottom_spacing_last_edited'];
		$title_bottom_spacing_responsive_status = et_pb_get_responsive_status( $title_bottom_spacing_last_edited );
		$button_custom_padding                  = $this->props['button_custom_padding'];
		$vo_icon_color                          = $this->props['vo_icon_color'];
		$vo_icon_size                           = $this->props['vo_icon_size'];
		$vo_bg                                  = $this->props['vo_bg'];
		$content_alignment                      = $this->props['content_alignment'];

		// Figure Image.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-info-box .figure',
				'declaration' => sprintf( 'width: %1$s !important;', $image_width ),
			)
		);

		if ( $image_height !== 'auto' ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-info-box .figure',
					'declaration' => sprintf( 'height: %1$s !important;', $image_height ),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-info-box .figure img',
					'declaration' => 'height: 100%; object-fit: cover;width:100%;',
				)
			);
		}

		// Button.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-info-box-btn',
				'declaration' => sprintf( 'padding-top: %1$s;', $btn_spacing_top ),
			)
		);

		if ( ! empty( $button_custom_padding ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => 'body #page-container %%order_class%% .ba-btn-content, .et-db #et-boc %%order_class%% .ba-btn-content',
					'declaration' => $this->process_margin_padding( $button_custom_padding, 'padding', true ),
				)
			);
		}

		// Texts.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-info-box-title',
				'declaration' => sprintf( 'padding-bottom: %1$s!important;', $title_bottom_spacing ),
			)
		);

		if ( $title_bottom_spacing_tablet && $title_bottom_spacing_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-info-box-title',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'padding-bottom: %1$s!important;', $title_bottom_spacing_tablet ),
				)
			);
		}

		if ( $title_bottom_spacing_phone && $title_bottom_spacing_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-info-box-title',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'padding-bottom: %1$s!important;', $title_bottom_spacing_phone ),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%%',
				'declaration' => sprintf( 'text-align: %1$s;', $content_alignment ),
			)
		);

		// Content Padding.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-info-box-content',
				'declaration' => $this->process_margin_padding( $content_padding, 'padding', false ),
			)
		);

		// Content Padding Tablet.
		if ( $content_padding_tablet && $content_padding_responsive_status ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-info-box-content',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => $this->process_margin_padding( $content_padding_tablet, 'padding', false ),
				)
			);
		}

		// Content Padding Phone
		if ( $content_padding_phone && $content_padding_responsive_status ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-info-box-content',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => $this->process_margin_padding( $content_padding_phone, 'padding', false ),
				)
			);
		}

		// Icon
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-info-box-icon',
				'declaration' => sprintf( 'background: %1$s;', $this->props['icon_bg'] ),
			)
		);

		if ( ! empty( $icon_bg_hover ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-info-box-icon:hover',
					'declaration' => sprintf( 'background: %1$s', $icon_bg_hover ),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-info-box-icon i',
				'declaration' => sprintf( 'color: %1$s; font-size: %2$s;', $this->props['icon_color'], $this->props['icon_size'] ),
			)
		);

		if ( ! empty( $icon_color_hover ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-info-box-icon:hover i',
					'declaration' => sprintf( 'color: %1$s;', $icon_color_hover ),
				)
			);
		}

		// Icon Padding
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-info-box-icon',
				'declaration' => $this->process_margin_padding( $icon_padding, 'padding', false ),
			)
		);

		// Icon Padding tablet
		if ( $icon_padding_tablet && $icon_padding_responsive_status ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-info-box-icon',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => $this->process_margin_padding( $icon_padding_tablet, 'padding', false ),
				)
			);
		}

		// Icon Padding phone
		if ( $icon_padding_phone && $icon_padding_responsive_status ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-info-box-icon',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => $this->process_margin_padding( $icon_padding_phone, 'padding', false ),
				)
			);
		}

		// Overlay Styles
		$this->get_overlay_style( $render_slug, 'photo', '%%order_class%%' );

		// video overlay

		if ( ! empty( $vo_icon_color ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .et_pb_video_overlay .et_pb_video_play',
					'declaration' => sprintf( 'color: %1$s;', $vo_icon_color ),
				)
			);
		}
		if ( ! empty( $vo_icon_size ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .et_pb_video_overlay .et_pb_video_play',
					'declaration' => sprintf( 'font-size: %1$s;', $vo_icon_size ),
				)
			);
		}

		if ( ! empty( $vo_bg ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .et_pb_video_overlay_hover:hover',
					'declaration' => sprintf( 'background: %1$s;', $vo_bg ),
				)
			);
		}
	}
}

new BA_Info_Box();
