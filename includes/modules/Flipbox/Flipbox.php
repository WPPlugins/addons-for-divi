<?php
class BA_Flipbox extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/flipbox',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {

		$this->name       = esc_html__( 'Brain Flipbox', 'addons-for-divi' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'flipbox.svg';
		$this->slug       = 'ba_flipbox';
		$this->vb_support = 'on';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'front'    => esc_html__( 'Front Side', 'addons-for-divi' ),
					'back'     => esc_html__( 'Back Side', 'addons-for-divi' ),
					'settings' => esc_html__( 'Settings', 'addons-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'front'       => esc_html__( 'Front Side', 'addons-for-divi' ),
					'back'        => esc_html__( 'Back Side', 'addons-for-divi' ),
					'front_media' => esc_html__( 'Front Media', 'addons-for-divi' ),
					'back_media'  => esc_html__( 'Back Media', 'addons-for-divi' ),
					'front_text'  => array(
						'title'             => esc_html__( 'Front Text', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'title'    => array(
								'name' => esc_html__( 'Title', 'addons-for-divi' ),
							),
							'subtitle' => array(
								'name' => esc_html__( 'Sub Title', 'addons-for-divi' ),
							),
						),
					),
					'back_text'   => array(
						'title'             => esc_html__( 'Back Text', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'title'    => array(
								'name' => esc_html__( 'Title', 'addons-for-divi' ),
							),
							'subtitle' => array(
								'name' => esc_html__( 'Sub Title', 'addons-for-divi' ),
							),
						),
					),
					'border'      => esc_html__( 'Border', 'addons-for-divi' ),
					'box_shadow'  => esc_html__( 'Box Shadow', 'addons-for-divi' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'front_icon'      => array(
				'label'    => esc_html__( 'Front Icon', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-flipbox-icon-front i',
			),
			'front_img'       => array(
				'label'    => esc_html__( 'Front Image', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-flipbox-figure-front img',
			),
			'front_title'     => array(
				'label'    => esc_html__( 'Front Title', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-flipbox-title-front',
			),
			'front_sub_title' => array(
				'label'    => esc_html__( 'Front Image', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-flipbox-subtitle-front',
			),
			'back_icon'       => array(
				'label'    => esc_html__( 'Back Icon', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-flipbox-icon-back i',
			),
			'back_img'        => array(
				'label'    => esc_html__( 'Back Image', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-flipbox-figure-back img',
			),
			'back_title'      => array(
				'label'    => esc_html__( 'Back Title', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-flipbox-title-back',
			),
			'back_sub_title'  => array(
				'label'    => esc_html__( 'Back Sub Title', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-flipbox-subtitle-back',
			),
		);
	}

	public function get_fields() {

		$front_content = array(
			'front_media_type' => array(
				'label'       => esc_html__( 'Media Type', 'addons-for-divi' ),
				'description' => esc_html__( 'Select front side media type.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'front',
				'default'     => 'icon',
				'options'     => array(
					'none'  => esc_html__( 'None', 'addons-for-divi' ),
					'icon'  => esc_html__( 'Icon', 'addons-for-divi' ),
					'image' => esc_html__( 'Image', 'addons-for-divi' ),
				),
			),
			'front_icon'       => array(
				'label'       => esc_html__( 'Select Icon', 'addons-for-divi' ),
				'description' => esc_html__( 'Select front side icon.', 'addons-for-divi' ),
				'type'        => 'select_icon',
				'default'     => '',
				'toggle_slug' => 'front',
				'tab_slug'    => 'general',
				'show_if'     => array(
					'front_media_type' => 'icon',
				),
			),
			'front_img'        => array(
				'label'              => esc_html__( 'Upload Image', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload an image or type in the URL of the image you would like to display for the front side.', 'addons-for-divi' ),
				'type'               => 'upload',
				'default'            => BRAIN_ADDONS_PLUGIN_ASSETS . 'imgs/placeholder.svg',
				'upload_button_text' => esc_attr__( 'Upload an image', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Image', 'addons-for-divi' ),
				'toggle_slug'        => 'front',
				'show_if'            => array(
					'front_media_type' => 'image',
				),
			),
			'front_img_alt'    => array(
				'label'       => esc_html__( 'Image Alt Text', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the front side image alt text for your flip box.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'front',
				'show_if'     => array(
					'front_media_type' => 'image',
				),
			),
			'front_title'      => array(
				'label'           => esc_html__( 'Front Title', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the front side title for your flip box.', 'addons-for-divi' ),
				'type'            => 'text',
				'toggle_slug'     => 'front',
				'dynamic_content' => 'text',
			),
			'front_subtitle'   => array(
				'label'           => esc_html__( 'Front Sub Title', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the front side sub-title for your flip box.', 'addons-for-divi' ),
				'type'            => 'text',
				'toggle_slug'     => 'front',
				'dynamic_content' => 'text',
			),
		);

		$back_content = array(
			'back_media_type' => array(
				'label'       => esc_html__( 'Media Type', 'addons-for-divi' ),
				'description' => esc_html__( 'Select back side media type.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'back',
				'default'     => 'icon',
				'options'     => array(
					'none'  => esc_html__( 'None', 'addons-for-divi' ),
					'icon'  => esc_html__( 'Icon', 'addons-for-divi' ),
					'image' => esc_html__( 'Image', 'addons-for-divi' ),
				),
			),
			'back_icon'       => array(
				'label'       => esc_html__( 'Select Icon', 'addons-for-divi' ),
				'description' => esc_html__( 'Select back side icon.', 'addons-for-divi' ),
				'type'        => 'select_icon',
				'toggle_slug' => 'back',
				'default'     => '+',
				'tab_slug'    => 'general',
				'show_if'     => array(
					'back_media_type' => 'icon',
				),
			),
			'back_img'        => array(
				'label'              => esc_html__( 'Upload Image', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload an image or type in the URL of the image you would like to display for the back side.', 'addons-for-divi' ),
				'type'               => 'upload',
				'default'            => BRAIN_ADDONS_PLUGIN_ASSETS . 'imgs/placeholder.svg',
				'upload_button_text' => esc_attr__( 'Upload an image', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Image', 'addons-for-divi' ),
				'toggle_slug'        => 'back',
				'show_if'            => array(
					'back_media_type' => 'image',
				),
			),
			'back_img_alt'    => array(
				'label'       => esc_html__( 'Image Alt Text', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the back side image alt text for your flip box.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'back',
				'show_if'     => array(
					'back_media_type' => 'image',
				),
			),
			'back_title'      => array(
				'label'           => esc_html__( 'Back Title', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the back side title for your flip box.', 'addons-for-divi' ),
				'type'            => 'text',
				'toggle_slug'     => 'back',
				'dynamic_content' => 'text',
			),
			'back_subtitle'   => array(
				'label'           => esc_html__( 'Back Sub Title', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the back side sub-title for your flip box.', 'addons-for-divi' ),
				'type'            => 'text',
				'toggle_slug'     => 'back',
				'dynamic_content' => 'text',
			),
		);

		$settings = array(
			'animation_type' => array(
				'label'       => esc_html__( 'Animation Type', 'addons-for-divi' ),
				'description' => esc_html__( 'Select the animation type.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'flip',
				'options'     => array(
					'flip' => esc_html__( 'Flip', 'addons-for-divi' ),
				),
			),
			'direction'      => array(
				'label'       => esc_html__( 'Animation Direction', 'addons-for-divi' ),
				'description' => esc_html__( 'Select the animation direction.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'right',
				'options'     => array(
					'up'    => esc_html__( 'UP', 'addons-for-divi' ),
					'right' => esc_html__( 'Right', 'addons-for-divi' ),
					'down'  => esc_html__( 'Down', 'addons-for-divi' ),
					'left'  => esc_html__( 'Left', 'addons-for-divi' ),
				),
			),
			'duration'       => array(
				'label'          => esc_html__( 'Animation Duration', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define the length of time that the animation takes.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '600ms',
				'fixed_unit'     => 'ms',
				'range_settings' => array(
					'min'  => 0,
					'step' => 50,
					'max'  => 3000,
				),
				'toggle_slug'    => 'settings',
			),
			'main_height'    => array(
				'label'          => esc_html__( 'Height', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define height for your flip box.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '300px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'settings',
			),
		);

		$front_media = array(
			'front_img_position' => array(
				'label'       => esc_html__( 'Position', 'addons-for-divi' ),
				'description' => esc_html__( 'Select image position for the front side.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'front_media',
				'tab_slug'    => 'advanced',
				'default'     => 'center',
				'options'     => array(
					'left'   => esc_html__( 'Left', 'addons-for-divi' ),
					'center' => esc_html__( 'Center', 'addons-for-divi' ),
					'right'  => esc_html__( 'Right', 'addons-for-divi' ),
				),
			),
			'front_img_padding'  => array(
				'label'          => esc_html__( 'Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom padding for your front side icon/image.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'front_media',
				'tab_slug'       => 'advanced',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
				'show_if'        => array(
					'front_media_type' => 'image',
				),
			),
			'front_icon_color'   => array(
				'label'        => esc_html__( 'Icon Color', 'addons-for-divi' ),
				'description'  => esc_html__( 'Here you can define a custom color for your front side icon.', 'addons-for-divi' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'front_media',
				'show_if'      => array(
					'front_media_type' => 'icon',
				),
			),
			'front_icon_size'    => array(
				'label'          => esc_html__( 'Icon Size', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom size for your front side icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '60px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'front_media',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'front_media_type' => 'icon',
				),
			),
			'front_img_height'   => array(
				'label'          => esc_html__( 'Height', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom height for your front side image/icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'front_media',
				'tab_slug'       => 'advanced',
			),
			'front_img_width'    => array(
				'label'          => esc_html__( 'Width', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom width for your front side image/icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'front_media',
				'tab_slug'       => 'advanced',
			),
			'front_img_bg_color' => array(
				'label'        => esc_html__( 'Background', 'addons-for-divi' ),
				'description'  => esc_html__( 'Here you can define a custom background color for your front side icon/image.', 'addons-for-divi' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'front_media',
			),
		);

		$back_media = array(
			'back_img_position' => array(
				'label'       => esc_html__( 'Position', 'addons-for-divi' ),
				'description' => esc_html__( 'Select image position for the back side.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'back_media',
				'tab_slug'    => 'advanced',
				'default'     => 'center',
				'options'     => array(
					'flex-start' => esc_html__( 'Left', 'addons-for-divi' ),
					'center'     => esc_html__( 'Center', 'addons-for-divi' ),
					'flex-end'   => esc_html__( 'Right', 'addons-for-divi' ),
				),
			),
			'back_img_padding'  => array(
				'label'          => esc_html__( 'Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom padding for your back side icon/image.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'back_media',
				'tab_slug'       => 'advanced',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
				'show_if'        => array(
					'back_media_type' => 'image',
				),
			),
			'back_icon_color'   => array(
				'label'        => esc_html__( 'Icon Color', 'addons-for-divi' ),
				'description'  => esc_html__( 'Here you can define a custom color for your back side icon.', 'addons-for-divi' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'back_media',
				'show_if'      => array(
					'back_media_type' => 'icon',
				),
			),
			'back_icon_size'    => array(
				'label'          => esc_html__( 'Icon Size', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom size for your back side icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '60px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'back_media',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'back_media_type' => 'icon',
				),
			),
			'back_img_height'   => array(
				'label'          => esc_html__( 'Height', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom height for your back side image/icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'back_media',
				'tab_slug'       => 'advanced',
			),
			'back_img_width'    => array(
				'label'          => esc_html__( 'Width', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom width for your back side image/icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'back_media',
				'tab_slug'       => 'advanced',
			),
			'back_img_bg_color' => array(
				'label'        => esc_html__( 'Background', 'addons-for-divi' ),
				'description'  => esc_html__( 'Here you can define a custom background color for your back side icon/image.', 'addons-for-divi' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'back_media',
			),
		);

		$front_design = array(
			'front_alignment'  => array(
				'label'            => esc_html__( 'Content Alignment', 'addons-for-divi' ),
				'description'      => esc_html__( 'Align content to the left, right or center.', 'addons-for-divi' ),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'     => 'text_align',
				'default_on_front' => 'center',
				'toggle_slug'      => 'front',
				'tab_slug'         => 'advanced',
				'mobile_options'   => true,
			),
			'front_padding'    => array(
				'label'          => esc_html__( 'Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'front',
				'tab_slug'       => 'advanced',
				'default'        => '30px|30px|30px|30px',
				'mobile_options' => true,
			),
			'front_ct_padding' => array(
				'label'          => esc_html__( 'Content Padding', 'addons-for-divi-pro' ),
				'description'    => esc_html__( 'Set front side card content padding.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'front',
				'tab_slug'       => 'advanced',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
			),
			'front_bg_color'   => array(
				'label'        => esc_html__( 'Background', 'addons-for-divi' ),
				'description'  => esc_html__( 'Here you can define a custom background color for your front side.', 'addons-for-divi' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'default'      => '#efefef',
				'toggle_slug'  => 'front',
			),
		);

		$back_design = array(
			'back_alignment'  => array(
				'label'            => esc_html__( 'Content Alignment', 'addons-for-divi' ),
				'description'      => esc_html__( 'Align content to the left, right or center.', 'addons-for-divi' ),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'     => 'text_align',
				'default_on_front' => 'center',
				'toggle_slug'      => 'back',
				'tab_slug'         => 'advanced',
				'mobile_options'   => true,
			),
			'back_padding'    => array(
				'label'          => esc_html__( 'Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'back',
				'tab_slug'       => 'advanced',
				'default'        => '30px|30px|30px|30px',
				'mobile_options' => true,
			),
			'back_ct_padding' => array(
				'label'          => esc_html__( 'Content Padding', 'addons-for-divi-pro' ),
				'description'    => esc_html__( 'Set back side card content padding.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'back',
				'tab_slug'       => 'advanced',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
			),
			'back_bg_color'   => array(
				'label'        => esc_html__( 'Background', 'addons-for-divi' ),
				'description'  => esc_html__( 'Here you can define a custom background color for your back side.', 'addons-for-divi' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'back',
				'default'      => '#efefef',
			),
		);

		$texts_spacing = array(
			'front_subtitle_spacing' => array(
				'label'          => esc_html__( 'Spacing Top', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the top of the front card subtitle.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 150,
				),
				'toggle_slug'    => 'front_text',
				'sub_toggle'     => 'subtitle',
				'tab_slug'       => 'advanced',
			),
			'back_subtitle_spacing'  => array(
				'label'          => esc_html__( 'Spacing Top', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the top of the back card subtitle.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 150,
				),
				'toggle_slug'    => 'back_text',
				'sub_toggle'     => 'subtitle',
				'tab_slug'       => 'advanced',
			),
		);

		return array_merge(
			$front_content,
			$back_content,
			$settings,
			$front_design,
			$back_design,
			$front_media,
			$back_media,
			$texts_spacing
		);
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['box_shadow']['card'] = array(
			'label'       => esc_html__( 'Box Shadow', 'addons-for-divi' ),
			'toggle_slug' => 'box_shadow',
			'css'         => array(
				'main'      => '%%order_class%% .ba-flipbox-card',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['card'] = array(
			'toggle_slug' => 'border',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-flipbox-card',
					'border_styles' => '%%order_class%% .ba-flipbox-card',
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

		$advanced_fields['borders']['front_media'] = array(
			'toggle_slug' => 'front_media',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-flipbox-figure-front',
					'border_styles' => '%%order_class%% .ba-flipbox-figure-front',
				),
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['back_media'] = array(
			'toggle_slug' => 'back_media',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-flipbox-figure-back',
					'border_styles' => '%%order_class%% .ba-flipbox-figure-back',
				),
				'important' => 'all',
			),
		);

		$advanced_fields['fonts']['front_title'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .ba-flipbox-title-front',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'front_text',
			'sub_toggle'      => 'title',
			'hide_text_align' => true,
			'line_height'       => array(
				'default' => '1.5em',
			),
			'font_size'       => array(
				'default' => '26px',
			),
		);

		$advanced_fields['fonts']['back_title'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .ba-flipbox-title-back',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'back_text',
			'sub_toggle'      => 'title',
			'hide_text_align' => true,
			'line_height'       => array(
				'default' => '1.5em',
			),
			'font_size'       => array(
				'default' => '26px',
			),
		);

		$advanced_fields['fonts']['front_subtitle'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .ba-flipbox-subtitle-front',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'front_text',
			'sub_toggle'      => 'subtitle',
			'hide_text_align' => true,
			'line_height'       => array(
				'default' => '1.5em',
			),
			'font_size'       => array(
				'default' => '18px',
			),
		);

		$advanced_fields['fonts']['back_subtitle'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .ba-flipbox-subtitle-back',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'back_text',
			'sub_toggle'      => 'subtitle',
			'hide_text_align' => true,
			'line_height'       => array(
				'default' => '1.5em',
			),
			'font_size'       => array(
				'default' => '18px',
			),
		);

		return $advanced_fields;
	}

	public function render_icon_front() {

		$selected_icon = esc_attr( et_pb_process_font_icon( $this->props['front_icon'] ) );
		$icon_name     = $selected_icon ? $selected_icon : '';

		return sprintf(
			'<div class="ba-flipbox-icon ba-flipbox-icon-front">
                <i class="ba-et-icon" data-icon="%1$s"></i>
            </div>',
			$icon_name
		);
	}

	public function render_icon_back() {

		$selected_icon = esc_attr( et_pb_process_font_icon( $this->props['back_icon'] ) );
		$icon_name     = $selected_icon ? $selected_icon : '';

		return sprintf(
			'<div class="ba-flipbox-icon ba-flipbox-icon-back">
                <i class="ba-et-icon" data-icon="%1$s"></i>
            </div>',
			$icon_name
		);
	}

	public function render_img_front() {
		return sprintf(
			'<div class="ba-flipbox-img-front">
                <img src="%1$s" alt="%2$s"/>
            </div>',
			$this->props['front_img'],
			$this->props['front_img_alt']
		);
	}

	public function render_img_back() {
		return sprintf(
			'<div class="ba-flipbox-img-back">
                <img src="%1$s" alt="%2$s"/>
            </div>',
			$this->props['back_img'],
			$this->props['back_img_alt']
		);
	}

	public function render_media_front() {
		$front_icon       = $this->props['front_icon'];
		$front_media_type = $this->props['front_media_type'];
		$front_img        = $this->props['front_img'];

		if ( 'none' === $front_media_type ) {
			return;
		}

		if ( ! empty( $front_icon ) || ! empty( $front_img ) ) {
			if ( 'icon' === $front_media_type ) {
				$media = $this->render_icon_front();
			} elseif ( 'image' === $front_media_type ) {
				$media = $this->render_img_front();
			}

			return sprintf(
				'<div class="ba-flipbox-figure-front">
					%1$s
				</div>',
				$media
			);
		}
	}

	public function render_media_back() {
		$back_icon       = $this->props['back_icon'];
		$back_media_type = $this->props['back_media_type'];
		$back_img        = $this->props['back_img'];

		if ( 'none' === $back_media_type ) {
			return;
		}

		if ( ! empty( $back_icon ) || ! empty( $back_img ) ) {
			if ( 'icon' === $back_media_type ) {
				$media = $this->render_icon_back();
			} elseif ( 'image' === $back_media_type ) {
				$media = $this->render_img_back();
			}

			return sprintf(
				'<div class="ba-flipbox-figure-back">
					%1$s
				</div>',
				$media
			);
		}
	}

	public function render_title_front() {
		$front_title = $this->props['front_title'];
		if ( ! empty( $front_title ) ) {
			return sprintf(
				'<h2 class="ba-flipbox-title-front">%1$s</h2>',
				$front_title
			);
		}
	}

	public function render_title_back() {
		$back_title = $this->props['back_title'];
		if ( ! empty( $back_title ) ) {
			return sprintf(
				'<h2 class="ba-flipbox-title-back">%1$s</h2>',
				$back_title
			);
		}
	}

	public function render_subtitle_front() {
		$front_subtitle = $this->props['front_subtitle'];
		if ( ! empty( $front_subtitle ) ) {
			return sprintf(
				'<h4 class="ba-flipbox-subtitle-front">%1$s</h4>',
				$front_subtitle
			);
		}
	}

	public function render_subtitle_back() {
		$back_subtitle = $this->props['back_subtitle'];
		if ( ! empty( $back_subtitle ) ) {
			return sprintf(
				'<h4 class="ba-flipbox-subtitle-back">%1$s</h4>',
				$back_subtitle
			);
		}
	}

	public function render( $attrs, $content = null, $render_slug ) {

		$this->render_css( $render_slug );

		$animation_type = $this->props['animation_type'];
		$direction      = $this->props['direction'];
		$classes        = array();

		array_push( $classes, 'ba-flipbox--' . $animation_type );
		array_push( $classes, "ba-$animation_type-$direction" );

		return sprintf(
			'<div class="ba-module ba-flipbox %1$s">
                <div class="ba-flipbox-inner">
					<div class="ba-flipbox-card-container">
						<div class="ba-flipbox-front-card ba-flipbox-card">
							<div class="ba-flipbox-card-inner">
								<div class="ba-flipbox-front-content">
									%2$s
									<div class="ba-flipbox-content-wrap">
										%3$s
										%6$s
									</div>
								</div>
							</div>
						</div>
						<div class="ba-flipbox-back-card ba-flipbox-card">
							<div class="ba-flipbox-card-inner">
								<div class="ba-flipbox-back-content">
									%4$s
									<div class="ba-flipbox-content-wrap">
										%5$s
										%7$s
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>',
			join( ' ', $classes ),
			$this->render_media_front(),
			$this->render_title_front(),
			$this->render_media_back(),
			$this->render_title_back(),
			$this->render_subtitle_front(),
			$this->render_subtitle_back()
		);
	}

	public function render_css( $render_slug ) {

		$front_img_position = $this->props['front_img_position'];
		$front_icon_size    = $this->props['front_icon_size'];
		$back_icon_color    = $this->props['back_icon_color'];
		$front_icon_color   = $this->props['front_icon_color'];
		$front_img_width    = $this->props['front_img_width'];
		$front_img_height   = $this->props['front_img_height'];
		$back_bg_color      = $this->props['back_bg_color'];
		$front_bg_color     = $this->props['front_bg_color'];
		$back_img_bg_color  = $this->props['back_img_bg_color'];
		$front_img_bg_color = $this->props['front_img_bg_color'];
		$back_img_width     = $this->props['back_img_width'];
		$back_icon_size     = $this->props['back_icon_size'];
		$back_img_height    = $this->props['back_img_height'];
		$back_img_position  = $this->props['back_img_position'];
		$duration           = $this->props['duration'];

		$this->get_responsive_styles(
			'main_height',
			'%%order_class%% .ba-flipbox-inner',
			array( 'primary' => 'height' ),
			array( 'default' => '300px' ),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-flipbox-front-card, %%order_class%% .ba-flipbox-card-container',
				'declaration' => "transition: all $duration ease;",
			)
		);

		// Front Side.
		$this->get_responsive_styles(
			'front_alignment',
			'%%order_class%% .ba-flipbox-front-card',
			array( 'primary' => 'text-align' ),
			array( 'default' => 'auto' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'front_padding',
			'%%order_class%% .ba-flipbox-front-card',
			array( 'primary' => 'padding' ),
			array( 'default' => '30px|30px|30px|30px' ),
			$render_slug
		);

		if ( 'center' !== $front_img_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-flipbox-front-content',
					'declaration' => 'display: flex;',
				)
			);
		}

		if ( 'right' === $front_img_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-flipbox-front-content',
					'declaration' => 'flex-direction: row-reverse;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-flipbox-icon-front',
				'declaration' => sprintf(
					'font-size: %1$s;',
					$front_icon_size
				),
			)
		);

		if ( ! empty( $front_icon_color ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-flipbox-icon-front',
					'declaration' => sprintf(
						'color: %1$s;',
						$front_icon_color
					),
				)
			);
		}

		if ( ! empty( $front_img_width ) ) {
			$this->get_responsive_styles(
				'front_img_width',
				'%%order_class%% .ba-flipbox-figure-front',
				array( 'primary' => 'width' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
			$this->get_responsive_styles(
				'front_img_width',
				'%%order_class%% .ba-flipbox-figure-front',
				array( 'primary' => 'max-width' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
			$this->get_responsive_styles(
				'front_img_width',
				'%%order_class%% .ba-flipbox-figure-front',
				array( 'primary' => 'flex' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
		}

		if ( ! empty( $front_img_height ) ) {
			$this->get_responsive_styles(
				'front_img_height',
				'%%order_class%% .ba-flipbox-figure-front',
				array( 'primary' => 'height' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
			$this->get_responsive_styles(
				'front_img_height',
				'%%order_class%% .ba-flipbox-figure-front img',
				array( 'primary' => 'height' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
		}

		$this->get_responsive_styles(
			'front_img_padding',
			'%%order_class%% .ba-flipbox-figure-front img',
			array( 'primary' => 'padding' ),
			array( 'default' => '0|0|0|0' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'front_ct_padding',
			'%%order_class%% .ba-flipbox-front-card .ba-flipbox-content-wrap',
			array( 'primary' => 'padding' ),
			array( 'default' => '0|0|0|0' ),
			$render_slug
		);

		if ( ! empty( $front_img_bg_color ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-flipbox-figure-front',
					'declaration' => sprintf(
						'background: %1$s;',
						$front_img_bg_color
					),
				)
			);
		}

		if ( ! empty( $front_bg_color ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-flipbox-front-card',
					'declaration' => sprintf(
						'background: %1$s;',
						$front_bg_color
					),
				)
			);
		}
		// Back Side.
		$this->get_responsive_styles(
			'back_alignment',
			'%%order_class%% .ba-flipbox-back-card',
			array( 'primary' => 'text-align' ),
			array( 'default' => 'auto' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'back_padding',
			'%%order_class%% .ba-flipbox-back-card',
			array( 'primary' => 'padding' ),
			array( 'default' => '30px|30px|30px|30px' ),
			$render_slug
		);

		if ( 'center' !== $back_img_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-flipbox-back-content',
					'declaration' => 'display: flex;',
				)
			);
		}

		if ( 'right' === $back_img_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-flipbox-back-content',
					'declaration' => 'flex-direction: row-reverse;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-flipbox-icon-back',
				'declaration' => sprintf(
					'font-size: %1$s;',
					$back_icon_size
				),
			)
		);

		if ( ! empty( $back_icon_color ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-flipbox-icon-back',
					'declaration' => sprintf(
						'color: %1$s;',
						$back_icon_color
					),
				)
			);
		}

		if ( ! empty( $back_img_width ) ) {
			$this->get_responsive_styles(
				'back_img_width',
				'%%order_class%% .ba-flipbox-figure-back',
				array( 'primary' => 'width' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
			$this->get_responsive_styles(
				'back_img_width',
				'%%order_class%% .ba-flipbox-figure-back',
				array( 'primary' => 'max-width' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
			$this->get_responsive_styles(
				'back_img_width',
				'%%order_class%% .ba-flipbox-figure-back',
				array( 'primary' => 'flex' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
		}

		if ( ! empty( $back_img_height ) ) {
			$this->get_responsive_styles(
				'back_img_height',
				'%%order_class%% .ba-flipbox-figure-back',
				array( 'primary' => 'height' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
			$this->get_responsive_styles(
				'back_img_height',
				'%%order_class%% .ba-flipbox-figure-back img',
				array( 'primary' => 'height' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
		}

		$this->get_responsive_styles(
			'back_img_padding',
			'%%order_class%% .ba-flipbox-figure-back img',
			array( 'primary' => 'padding' ),
			array( 'default' => '0|0|0|0' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'back_ct_padding',
			'%%order_class%% .ba-flipbox-back-card .ba-flipbox-content-wrap',
			array( 'primary' => 'padding' ),
			array( 'default' => '0|0|0|0' ),
			$render_slug
		);

		if ( ! empty( $back_img_bg_color ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-flipbox-figure-back',
					'declaration' => sprintf(
						'background: %1$s;',
						$back_img_bg_color
					),
				)
			);
		}

		if ( ! empty( $back_bg_color ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-flipbox-back-card',
					'declaration' => sprintf(
						'background: %1$s;',
						$back_bg_color
					),
				)
			);
		}

		// Texts Spacing.
		$this->get_responsive_styles(
			'front_subtitle_spacing',
			'%%order_class%% .ba-flipbox-subtitle-front',
			array( 'primary' => 'margin-top' ),
			array( 'default' => '0px' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'back_subtitle_spacing',
			'%%order_class%% .ba-flipbox-subtitle-back',
			array( 'primary' => 'margin-top' ),
			array( 'default' => '0px' ),
			$render_slug
		);

	}
}

new BA_Flipbox();
