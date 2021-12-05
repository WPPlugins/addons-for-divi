<?php
class DTQ_Review extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divitorque.com/review-module/',
		'author'     => 'DiviTorque',
		'author_uri' => 'https://divitorque.com/',
	);

	public function init() {

		$this->slug       = 'ba_review';
		$this->vb_support = 'on';
		$this->name       = esc_html__( 'Torque Review', 'addons-for-divi' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'review.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Content', 'addons-for-divi' ),
					'button'       => esc_html__( 'Button', 'addons-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'common'  => esc_html__( 'General', 'addons-for-divi' ),
					'rating'  => esc_html__( 'Rating', 'addons-for-divi' ),
					'image'   => esc_html__( 'Image', 'addons-for-divi' ),
					'overlay' => esc_html__( 'Overlay', 'addons-for-divi' ),
					'badge'   => esc_html__( 'Badge', 'addons-for-divi' ),
					'texts'   => array(
						'title'             => esc_html__( 'Title & Description', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'title'       => array(
								'name' => esc_html__( 'Title', 'addons-for-divi' ),
							),
							'description' => array(
								'name' => esc_html__( 'Description', 'addons-for-divi' ),
							),
						),
					),
					'button'  => esc_html__( 'Button', 'addons-for-divi' ),
					'borders' => esc_html__( 'Border', 'addons-for-divi' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'rating'        => array(
				'label'    => esc_html__( 'Ratings', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-ratings',
			),
			'rating_number' => array(
				'label'    => esc_html__( 'Rating Number', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-ratings-number',
			),
			'image'         => array(
				'label'    => esc_html__( 'Image', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-rating-figure img',
			),
			'title'         => array(
				'label'    => esc_html__( 'Title', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-rating-star-title',
			),
			'desc'          => array(
				'label'    => esc_html__( 'Description', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-rating-star-desc',
			),
			'button_wrap'   => array(
				'label'    => esc_html__( 'Button Wrapper', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-rating-btn-wrap',
			),
			'button'        => array(
				'label'    => esc_html__( 'Button', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-rating-btn',
			),
		);
	}

	public function get_fields() {

		$fields = array(
			'scale'                 => array(
				'label'             => esc_html__( 'Rating Scale', 'addons-for-divi' ),
				'description'       => esc_html__( 'Define your rating scale. Your input must be a number.', 'addons-for-divi' ),
				'type'              => 'text',
				'toggle_slug'       => 'main_content',
				'default'           => '5',
				'number_validation' => true,
				'value_type'        => 'float',
				'value_min'         => 0,
				'value_type'        => 100,
			),

			'rating'                => array(
				'label'             => esc_html__( 'Rating', 'addons-for-divi' ),
				'description'       => esc_html__( 'Define your rating number. Your input must be a number.', 'addons-for-divi' ),
				'type'              => 'text',
				'toggle_slug'       => 'main_content',
				'default'           => '5',
				'value_type'        => 'float',
				'number_validation' => true,
				'value_min'         => 0,
				'value_type'        => 100,
			),

			'show_number'           => array(
				'label'           => esc_html__( 'Show Rating Number', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether number should be displayed.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'main_content',
			),

			'image'                 => array(
				'label'              => esc_html__( 'Upload Image', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload an image or type in the URL of the image you would like to display.', 'addons-for-divi' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Image', 'addons-for-divi' ),
				'toggle_slug'        => 'main_content',
				'mobile_options'     => true,
				'hover'              => 'tabs',
			),

			'use_lightbox'          => array(
				'type'        => 'multiple_checkboxes',
				'default'     => 'off',
				'toggle_slug' => 'main_content',
				'options'     => array(
					'tooltip' => esc_html__( 'Open Photo in Lightbox', 'addons-for-divi' ),
				),
			),

			'image_alt'             => array(
				'label'       => esc_html__( 'Image Alt Text', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define the HTML ALT text for your image.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'main_content',
			),

			'use_badge'             => array(
				'label'           => esc_html__( 'Use Badge', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether badge should be used.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'main_content',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
			),
			'badge_text'            => array(
				'label'           => esc_html__( 'Badge Text', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the badge text for your card.', 'addons-for-divi' ),
				'type'            => 'text',
				'default'         => esc_html__( 'Badge', 'addons-for-divi' ),
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'text',
				'show_if'         => array(
					'use_badge' => 'on',
				),
			),

			'title'                 => array(
				'label'           => esc_html__( 'Title Text', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the title text your for card.', 'addons-for-divi' ),
				'type'            => 'text',
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'text',
			),

			'description'           => array(
				'label'           => esc_html__( 'Description', 'addons-for-divi' ),
				'description'     => esc_html__( 'Input the description text content.', 'addons-for-divi' ),
				'type'            => 'textarea',
				'dynamic_content' => 'text',
				'toggle_slug'     => 'main_content',
			),

			// Button.
			'use_button'            => array(
				'label'           => esc_html__( 'Use Button', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether button should be used.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'toggle_slug'     => 'button',
			),

			'button_text'           => array(
				'label'           => esc_html__( 'Button Text', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the button text for your button.', 'addons-for-divi' ),
				'type'            => 'text',
				'default'         => 'Click Here',
				'dynamic_content' => 'text',
				'toggle_slug'     => 'button',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),

			'button_link'           => array(
				'label'           => esc_html__( 'Button Link', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the button link url for your button.', 'addons-for-divi' ),
				'type'            => 'text',
				'default'         => '',
				'toggle_slug'     => 'button',
				'dynamic_content' => 'url',
				'dynamic_content' => 'url',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),

			'is_new_window'         => array(
				'label'           => esc_html__( 'Open Button link in new window', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether button URL should be opened in new window.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'on',
				'toggle_slug'     => 'button',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),

			// Star.
			'rating_bottom_spacing' => array(
				'label'          => esc_html__( 'Rating Spacing Bottom', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define spacing at the bottom of the rating area.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '10px',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'rating',
				'tab_slug'       => 'advanced',
			),

			'star_size'             => array(
				'label'          => esc_html__( 'Star Size', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom size for your rating stars.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '23px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'rating',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
			),

			'star_spacing'          => array(
				'label'          => esc_html__( 'Star Spacing', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define spacing between stars.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'rating',
				'tab_slug'       => 'advanced',
			),

			'star_color'            => array(
				'label'       => esc_html__( 'Star Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom color for your rating stars.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#2EA3F2',
				'toggle_slug' => 'rating',
			),

			'star_active_color'     => array(
				'label'       => esc_html__( 'Star Active Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a active color for your rating stars.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#2EA3F2',
				'toggle_slug' => 'rating',
			),

			'rating_text_size'      => array(
				'label'          => esc_html__( 'Rating Text Size', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom size for your rating text.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '16px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'rating',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
			),

			'rating_text_color'     => array(
				'label'       => esc_html__( 'Rating Text Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom color for your rating text.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#2EA3F2',
				'toggle_slug' => 'rating',
			),

			'rating_text_spacing'   => array(
				'label'          => esc_html__( 'Rating Text Spacing', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define spacing between stars and rating text.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '8px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'rating',
				'tab_slug'       => 'advanced',
			),

			// Image.
			'img_pos'               => array(
				'label'       => esc_html__( 'Image/Icon Position', 'addons-for-divi' ),
				'description' => esc_html__( 'Define image/icon position.', 'addons-for-divi' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'image',
				'default'     => 'top',
				'options'     => array(
					'top'    => esc_html__( 'Top', 'addons-for-divi' ),
					'bottom' => esc_html__( 'Bottom', 'addons-for-divi' ),
					'left'   => esc_html__( 'Left', 'addons-for-divi' ),
					'right'  => esc_html__( 'Right', 'addons-for-divi' ),
				),
			),

			'img_anim'              => array(
				'label'       => esc_html__( 'Image Hover Animation', 'addons-for-divi' ),
				'description' => esc_html__( 'Select image hover animation.', 'addons-for-divi' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'image',
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
			),

			'img_height'            => array(
				'label'          => esc_html__( 'Image Height', 'addons-for-divi' ),
				'description'    => esc_html__( 'This sets a static height  for your image.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
			),

			'img_width'             => array(
				'label'          => esc_html__( 'Image Width', 'addons-for-divi' ),
				'description'    => esc_html__( 'This sets a static width  for your image.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '50%',
				'mobile_options' => true,
				'default_unit'   => '%',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'img_pos' => array( 'left', 'right' ),
				),
			),

			'img_padding'           => array(
				'label'          => esc_html__( 'Image Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define custom padding for the image.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'image',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
			),

			// button.
			'btn_spacing_top'       => array(
				'label'          => esc_html__( 'Spacing Top', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the top of the button.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '15px',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'    => 'button',
				'tab_slug'       => 'advanced',
			),

			// Texts.
			'title_bottom_spacing'  => array(
				'label'          => esc_html__( 'Title Spacing Bottom', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the bottom of the title.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '0px',
				'mobile_options' => true,
				'allowed_units'  => array( 'px' ),
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'texts',
				'tab_slug'       => 'advanced',
				'sub_toggle'     => 'title',
			),

			// Common.
			'content_alignment'     => array(
				'label'            => esc_html__( 'Alignment', 'addons-for-divi' ),
				'description'      => esc_html__( 'Align content to the left, right or center.', 'addons-for-divi' ),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'     => 'module_align',
				'default'          => 'left',
				'default_on_front' => 'left',
				'toggle_slug'      => 'common',
				'tab_slug'         => 'advanced',
			),

			'content_padding'       => array(
				'label'          => esc_html__( 'Content Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define custom padding for the content.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'common',
				'tab_slug'       => 'advanced',
				'default'        => '15px|0px|0px|0px',
				'mobile_options' => true,
			),
		);

		$badge_defaults = array(
			'position' => 'right_top',
			'offset_x' => '15px',
			'offset_y' => '15px',
			'padding'  => '5px|15px|5px|15px',
			'bg'       => '#ffffff',
			'color'    => '#333',
		);
		$badge_options  = $this->get_badge_options(
			'badge',
			esc_html__( 'Badge', 'addons-for-divi' ),
			'badge',
			$badge_defaults
		);

		$overlay = $this->get_overlay_option_fields( 'overlay', 'on', array() );

		// Default values.
		if ( dt_if_not_migrated() ) {
			$fields['use_button']['default'] = 'off';
		} else {
			$fields['use_button']['default'] = 'on';
		}

		return array_merge( $fields, $overlay, $badge_options );
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['borders']['badge'] = array(
			'toggle_slug'  => 'badge',
			'label_prefix' => esc_html__( 'Badge', 'addons-for-divi' ),
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-review-badge',
					'border_styles' => '%%order_class%% .ba-review-badge',
				),
				'important' => 'all',
			),
			'defaults'     => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0',
					'color' => '#333',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['fonts']['badge'] = array(
			'label'           => esc_html__( 'Badge', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-review-badge',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'badge',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '13px',
			),
		);

		$advanced_fields['fonts']['title'] = array(
			'label'           => esc_html__( 'Title', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-rating-star-title',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'title',
			'header_level'    => array(
				'default' => 'h3',
			),
			'font_size'       => array(
				'default' => '22px',
			),
		);

		$advanced_fields['fonts']['desc'] = array(
			'label'           => esc_html__( 'Description', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-rating-star-desc',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'description',
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

		$advanced_fields['borders']['main'] = array(
			'toggle_slug' => 'borders',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%%',
					'border_styles' => '%%order_class%%',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#efefef',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['borders']['image'] = array(
			'label_prefix' => esc_html__( 'Image', 'addons-for-divi' ),
			'toggle_slug'  => 'image',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-rating-figure img',
					'border_styles' => '%%order_class%% .ba-rating-figure img',
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

		$advanced_fields['button']['button'] = array(
			'label'          => esc_html__( 'Button', 'addons-for-divi' ),
			'css'            => array(
				'main'      => '%%order_class%% .ba-rating-btn',
				'important' => 'all',
			),
			'use_alignment'  => false,
			'box_shadow'     => array(
				'css' => array(
					'main' => '%%order_class%% .ba-btn-card',
				),
			),
			'borders'        => array(
				'css' => array(
					'important' => 'all',
				),
			),
			'margin_padding' => array(
				'css' => array(
					'important' => 'all',
				),
			),
		);

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '%%order_class%%',
				'important' => true,
			),
		);

		return $advanced_fields;
	}

	public function render_badge() {
		if ( 'off' !== $this->props['use_badge'] ) {
			return sprintf(
				'<div class="ba-review-badge">%1$s</div>',
				$this->props['badge_text']
			);
		}
	}

	public function _render_image() {
		$image                  = $this->props['image'];
		$image_alt              = $this->props['image_alt'];
		$use_lightbox           = $this->props['use_lightbox'];
		$processed_overlay_icon = esc_attr( et_pb_process_font_icon( $this->props['overlay_icon'] ) );
		$overlay_icon           = ! empty( $processed_overlay_icon ) ? $processed_overlay_icon : '';
		$data_schema            = $this->get_swapped_img_schema( 'image' );

		if ( ! empty( $image ) ) {
			return sprintf(
				'<div class="ba-rating-figure">
                    %6$s
                    <div class="ba-overlay" data-icon="%3$s"></div>
                    <img class="ba-img-cover ba-swapped-img %5$s" data-mfp-src="%1$s" src="%1$s" %2$s alt="%4$s"/>
                </div>',
				$image,
				$data_schema,
				$overlay_icon,
				$image_alt,
				$use_lightbox === 'on' ? 'ba-lightbox' : '',
				$this->render_badge()
			);
		}
	}

	public function render_title() {

		$title_text            = $this->props['title'];
		$title_level           = $this->props['title_level'];
		$processed_title_level = et_pb_process_header_level( $title_level, 'h3' );
		$processed_title_level = esc_html( $processed_title_level );

		if ( ! empty( $title_text ) ) {
			return sprintf( '<%2$s class="ba-rating-star-title">%1$s</%2$s>', $title_text, $processed_title_level );
		}
	}

	public function render_description() {
		$description = $this->props['description'];
		if ( ! empty( $description ) ) {
			return sprintf( '<div class="ba-rating-star-desc">%1$s</div>', $description );
		}
	}

	public function render_rarings_number() {
		$scale       = $this->props['scale'];
		$rating      = $this->props['rating'];
		$show_number = $this->props['show_number'];

		if ( $show_number === 'on' ) {
			return '<div class="ba-ratings-number">(' . $rating . '/' . $scale . ')</div>';
		}
	}

	public function render_stars( $icon ) {
		$stars = '';
		$scale = $this->props['scale'];
		for ( $i = 1; $i <= intval( $scale ); $i++ ) {
			$stars .= '<span class="ba-star">' . $icon . '</span>';
		}
		return $stars;
	}

	public function _render_button() {

		if ( $this->props['use_button'] === 'on' ) {

			$button_custom = $this->props['custom_button'];
			$button_text   = isset( $this->props['button_text'] ) ? $this->props['button_text'] : 'Click Here';
			$button_link   = isset( $this->props['button_link'] ) ? $this->props['button_link'] : '#';
			$button_url    = trim( $button_link );
			$new_tab       = $this->props['is_new_window'];
			$button_rel    = $this->props['button_rel'];
			$button_icon   = ! empty( $this->props['button_icon'] ) ? $this->props['button_icon'] : '5';

			$button_output = $this->render_button(
				array(
					'button_classname' => array( 'ba-btn-default', 'ba-rating-btn' ),
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
				'
                <div class="ba-rating-btn-wrap">
                    %1$s
                </div>',
				$button_output
			);
		}
	}

	public function render( $attrs, $content = null, $render_slug ) {

		$this->render_css( $render_slug );

		$img_anim = $this->props['img_anim'];
		$rating   = $this->props['rating'];
		$scale    = $this->props['scale'];
		$tag      = ! empty( $this->props['link_option_url'] ) ? 'a' : 'div';
		$classes  = sprintf( 'ba-hover--%1$s', $img_anim );
		$width    = ( 100 * floatval( $rating ) ) / floatval( $scale );

		// Output
		return sprintf(
			'<%1$s %2$s class="ba-module ba-module ba-review ba-swapped-img-selector %3$s">
                %4$s
                <div class="ba-review-content">
                    %5$s
                    <div class="ba-ratings ba-flex">
                        <div class="ba-stars-wrap" style="--active-width:%6$s%%">
                            <div class="ba-stars-inact">%7$s</div>
                            <div class="ba-stars-act">%8$s</div>
                        </div>
                        %9$s
                    </div>
                    %10$s
                    %11$s
                </div>
            </%1$s>',
			$tag,
			$this->render_ref_attr(),
			$classes,
			$this->_render_image(),
			$this->render_title(),
			$width,
			$this->render_stars( '☆' ),
			$this->render_stars( '★' ),
			$this->render_rarings_number(),
			$this->render_description(),
			$this->_render_button()
		);
	}

	public function render_css( $render_slug ) {

		$content_alignment                 = $this->props['content_alignment'];
		$img_pos                           = $this->props['img_pos'];
		$star_spacing                      = $this->props['star_spacing'];
		$star_color                        = $this->props['star_color'];
		$star_active_color                 = $this->props['star_active_color'];
		$rating_text_color                 = $this->props['rating_text_color'];
		$rating_text_spacing               = $this->props['rating_text_spacing'];
		$btn_spacing_top                   = $this->props['btn_spacing_top'];
		$btn_spacing_top_tablet            = $this->props['btn_spacing_top_tablet'];
		$btn_spacing_top_phone             = $this->props['btn_spacing_top_phone'];
		$btn_spacing_top_last_edited       = $this->props['btn_spacing_top_last_edited'];
		$btn_spacing_top_responsive_status = et_pb_get_responsive_status( $btn_spacing_top_last_edited );
		$img_width                         = $this->props['img_width'];
		$img_width_tablet                  = $this->props['img_width_tablet'];
		$img_width_phone                   = $this->props['img_width_phone'];
		$img_width_last_edited             = $this->props['img_width_last_edited'];
		$img_width_responsive_status       = et_pb_get_responsive_status( $img_width_last_edited );

		// Image position.
		if ( 'top' === $img_pos ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-review',
					'declaration' => 'flex-direction: column;',
				)
			);
		} elseif ( 'bottom' === $img_pos ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-review',
					'declaration' => 'flex-direction: column-reverse;',
				)
			);
		} elseif ( 'left' === $img_pos ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-review',
					'declaration' => 'flex-direction: row;',
				)
			);
		} elseif ( 'right' === $img_pos ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-review',
					'declaration' => 'flex-direction: row-reverse;',
				)
			);
		}

		// Image Height.
		if ( ! empty( $this->props['img_height'] ) ) {
			$this->get_responsive_styles(
				'img_height',
				'%%order_class%% .ba-rating-figure',
				array( 'primary' => 'height' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
		}

		// image width.
		if ( 'left' === $img_pos || 'right' === $img_pos ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-rating-figure',
					'declaration' => sprintf( 'flex: 0 0 %1$s; max-width: %1$s;', $img_width ),
				)
			);

			if ( $img_width_tablet && $img_width_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-rating-figure',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
						'declaration' => sprintf( 'flex:0 0 %1$s;max-width: %1$s;', $img_width_tablet ),
					)
				);
			}

			if ( $img_width_phone && $img_width_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-rating-figure',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
						'declaration' => sprintf( 'flex:0 0 %1$s;max-width: %1$s;', $img_width_phone ),
					)
				);
			}
		}

		// Image Padding.
		$this->get_responsive_styles(
			'img_padding',
			'%%order_class%% .ba-rating-figure img',
			array( 'primary' => 'padding' ),
			array( 'default' => '0px|0px|0px|0px' ),
			$render_slug
		);

		// texts.
		$this->get_responsive_styles(
			'title_bottom_spacing',
			'%%order_class%% .ba-rating-star-title',
			array( 'primary' => 'padding-bottom' ),
			array( 'default' => '0px' ),
			$render_slug
		);

		// Content alignment
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-review-content',
				'declaration' => sprintf( 'text-align: %1$s!important;', $content_alignment ),
			)
		);
		if ( $content_alignment === 'right' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-ratings',
					'declaration' => 'justify-content: flex-end;',
				)
			);
		} elseif ( $content_alignment === 'center' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-ratings',
					'declaration' => 'justify-content: center;',
				)
			);
		}

		// Content Padding.
		$this->get_responsive_styles(
			'content_padding',
			'%%order_class%% .ba-review-content',
			array( 'primary' => 'padding' ),
			array( 'default' => '15px|0px|0px|0px' ),
			$render_slug
		);

		// rating bottom spacing.
		$this->get_responsive_styles(
			'rating_bottom_spacing',
			'%%order_class%% .ba-ratings',
			array( 'primary' => 'padding-bottom' ),
			array( 'default' => '10px' ),
			$render_slug
		);

		// Star Size.
		$this->get_responsive_styles(
			'star_size',
			'%%order_class%% .ba-stars-wrap .ba-star',
			array( 'primary' => 'font-size' ),
			array( 'default' => '23px' ),
			$render_slug
		);

		// Star spacing.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-stars-wrap .ba-star',
				'declaration' => sprintf(
					'
                margin-left: %1$s;
                margin-right: %1$s;',
					$star_spacing
				),
			)
		);
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-stars-wrap',
				'declaration' => sprintf(
					'
                margin-left: -%1$s;
                margin-right: -%1$s;',
					$star_spacing
				),
			)
		);

		// star color
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-star',
				'declaration' => sprintf( 'color: %1$s;', $star_color ),
			)
		);
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-stars-act .ba-star',
				'declaration' => sprintf( 'color: %1$s;', $star_active_color ),
			)
		);
		// Rating text.
		$this->get_responsive_styles(
			'rating_text_size',
			'%%order_class%% .ba-ratings-number',
			array( 'primary' => 'font-size' ),
			array( 'default' => '16px' ),
			$render_slug
		);
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-ratings-number',
				'declaration' => sprintf(
					'
                padding-left: %2$s;
                color: %1$s;',
					$rating_text_color,
					$rating_text_spacing
				),
			)
		);

		// Button.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-rating-btn-wrap',
				'declaration' => sprintf( 'padding-top: %1$s!important;', $btn_spacing_top ),
			)
		);

		if ( $btn_spacing_top_tablet && $btn_spacing_top_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-rating-btn-wrap',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'padding-top: %1$s!important;', $btn_spacing_top_tablet ),
				)
			);
		}

		if ( $btn_spacing_top_phone && $btn_spacing_top_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-rating-btn-wrap',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'padding-top: %1$s!important;', $btn_spacing_top_phone ),
				)
			);
		}

		$this->get_buttons_styles( 'button', $render_slug, '%%order_class%% .ba-review .ba-rating-btn' );
		$this->get_overlay_style( $render_slug, 'image', '%%order_class%%' );
		$this->get_badge_styles( $render_slug, 'badge', '%%order_class%% .ba-review-badge', '%%order_class%%:hover .ba-review-badge' );
	}
}

new DTQ_Review();
