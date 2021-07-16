<?php
class BA_Video_Popup extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/video-popup',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {

		$this->slug       = 'ba_video_popup';
		$this->vb_support = 'on';
		$this->name       = esc_html__( 'Brain Video Popup', 'brain-divi-addons' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'video-popup.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content'  => esc_html__( 'Content', 'brain-divi-addons' ),
					'settings' => esc_html__( 'Settings', 'brain-divi-addons' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'image' => esc_html__( 'Image', 'brain-divi-addons' ),
					'icon'  => esc_html__( 'Icon', 'brain-divi-addons' ),
					'popup' => esc_html__( 'Popup', 'brain-divi-addons' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'image'        => array(
				'label'    => esc_html__( 'Image', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-video-popup-figure img',
			),
			'icon_wrapper' => array(
				'label'    => esc_html__( 'Icon Wrapper', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-video-popup-icon span',
			),
			'icon'         => array(
				'label'    => esc_html__( 'Icon', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-video-popup-icon svg',
			),
			'wave'         => array(
				'label'    => esc_html__( 'Animated Wave', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-video-popup-icon span:after',
			),
		);
	}

	public function get_fields() {

		$fields = array(
			'image'            => array(
				'label'              => esc_html__( 'Image', 'brain-divi-addons' ),
				'description'        => esc_html__( 'Here you can define placeholder image for the video.', 'brain-divi-addons' ),
				'type'               => 'upload',
				'data_type'          => 'image',
				'default'            => BRAIN_ADDONS_PLUGIN_ASSETS . 'imgs/placeholder.svg',
				'upload_button_text' => esc_attr__( 'Upload an image', 'brain-divi-addons' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'brain-divi-addons' ),
				'update_text'        => esc_attr__( 'Set As Image', 'brain-divi-addons' ),
				'toggle_slug'        => 'content',
			),
			'icon'             => array(
				'label'       => esc_html__( 'Select Play Icon', 'brain-divi-addons' ),
				'description' => esc_html__( 'Here you can select different type of play icon from the video.', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'content',
				'default'     => '1',
				'options'     => array(
					'1' => esc_html__( 'Icon 1', 'brain-divi-addons' ),
					'2' => esc_html__( 'Icon 2', 'brain-divi-addons' ),
					'3' => esc_html__( 'Icon 3', 'brain-divi-addons' ),
					'4' => esc_html__( 'Icon 4', 'brain-divi-addons' ),
					'5' => esc_html__( 'Icon 5', 'brain-divi-addons' ),
					'6' => esc_html__( 'Icon 6', 'brain-divi-addons' ),
				),
			),
			'type'             => array(
				'label'       => esc_html__( 'Video Type', 'brain-divi-addons' ),
				'description' => esc_html__( 'Define video type for the popup.', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'content',
				'default'     => 'yt',
				'options'     => array(
					'yt'    => esc_html__( 'Youtube', 'brain-divi-addons' ),
					'vm'    => esc_html__( 'Vimeo', 'brain-divi-addons' ),
					'video' => esc_html__( 'Custom Upload', 'brain-divi-addons' ),
				),
			),
			'video_link'       => array(
				'label'       => esc_html__( 'Video URL', 'brain-divi-addons' ),
				'description' => esc_html__( 'Type youtube or vimeo video url which you would like to display in the popup.', 'brain-divi-addons' ),
				'type'        => 'text',
				'toggle_slug' => 'content',
				'show_if_not' => array(
					'type' => 'video',
				),
			),
			'video'            => array(
				'label'              => esc_html__( 'Video MP4 File', 'brain-divi-addons' ),
				'type'               => 'upload',
				'data_type'          => 'video',
				'upload_button_text' => esc_attr__( 'Upload a video', 'brain-divi-addons' ),
				'choose_text'        => esc_attr__( 'Choose a Video MP4 File', 'brain-divi-addons' ),
				'update_text'        => esc_attr__( 'Set As Video', 'brain-divi-addons' ),
				'description'        => esc_html__( 'Upload your desired video in .MP4 format, or type in the URL to the video you would like to display', 'brain-divi-addons' ),
				'toggle_slug'        => 'content',
				'show_if'            => array(
					'type' => 'video',
				),
			),
			'use_animation'    => array(
				'label'           => esc_html__( 'Use Animated Icon', 'brain-divi-addons' ),
				'description'     => esc_html__( 'Use animated wave for your icon. For better experience please set icon background color from icon design toggle.', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'settings',
			),
			'img_height'       => array(
				'label'          => esc_html__( 'Image Height', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can define static height for your image.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '300px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 500,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'image',
			),
			'icon_color'       => array(
				'label'        => esc_html__( 'Color', 'brain-divi-addons' ),
				'description'  => esc_html__( 'Here you can define custom color for your icon . ', 'brain - divi - addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'default'      => $this->default_color,
				'toggle_slug'  => 'icon',
				'hover'        => 'tabs',
			),
			'icon_size'        => array(
				'label'          => esc_html__( 'Size', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can define custom size for your icon.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '60px',
				'default_unit'   => 'px',
				'hover'          => 'tabs',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				),
				'toggle_slug'    => 'icon',
				'tab_slug'       => 'advanced',
			),
			'icon_opacity'     => array(
				'label'          => esc_html__( 'Opacity', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Define the opacity for the icon. Set the value from 0 - 1. The lower value, the more transparent.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '1',
				'unitless'       => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 1,
					'step' => .02,
				),
				'toggle_slug'    => 'icon',
				'tab_slug'       => 'advanced',
				'hover'          => 'tabs',
			),
			'icon_height'      => array(
				'label'          => esc_html__( 'Height', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can define static height for your icon.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => 'initial',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 300,
					'step' => 1,
				),
				'toggle_slug'    => 'icon',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
			),
			'icon_width'       => array(
				'label'          => esc_html__( 'Width', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can define static width for your icon.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => 'initial',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 300,
					'step' => 1,
				),
				'toggle_slug'    => 'icon',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
			),
			'icon_bg'          => array(
				'label'        => esc_html__( 'Background', 'brain-divi-addons' ),
				'description'  => esc_html__( 'Here you can define custom background for your icon.', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'toggle_slug'  => 'icon',
				'tab_slug'     => 'advanced',
				'hover'        => 'tabs',
			),
			'icon_radius'      => array(
				'label'          => esc_html__( 'Border Radius', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can define the radius value for your icon border.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '0px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 400,
					'step' => 1,
				),
				'toggle_slug'    => 'icon',
				'tab_slug'       => 'advanced',
			),
			'wave_bg'          => array(
				'label'        => esc_html__( 'Animated Wave Color', 'brain-divi-addons' ),
				'description'  => esc_html__( 'Here you can define custom color for the animated wave of your icon.', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'default'      => '#ffffff',
				'custom_color' => true,
				'toggle_slug'  => 'icon',
				'tab_slug'     => 'advanced',
				'show_if'      => array(
					'use_animation' => 'on',
				),
			),
			// Popup.
			'popup_bg'         => array(
				'label'        => esc_html__( 'Popup Background', 'brain-divi-addons' ),
				'description'  => esc_html__( 'Here you can define custom background color for your popup.', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'default'      => 'rgba(0,0,0,.8)',
				'toggle_slug'  => 'popup',
			),
			'close_icon_color' => array(
				'label'        => esc_html__( 'Close Icon Color', 'brain-divi-addons' ),
				'description'  => esc_html__( 'Here you can define custom color for your popup close icon.', 'brain-divi-addons' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'default'      => '#ffffff',
				'toggle_slug'  => 'popup',
			),
		);

		$img_overlay = $this->custom_background_fields(
			'image',
			__( 'Image Overlay', 'brain-divi-addons' ),
			'advanced',
			'image',
			array( 'color', 'gradient', 'hover' ),
			array(),
			''
		);

		return array_merge( $fields, $img_overlay );
	}

	public function get_advanced_fields_config() {

		$advanced_fields                 = array();
		$advanced_fields['text']         = false;
		$advanced_fields['fonts']        = false;
		$advanced_fields['text_shadow']  = false;
		$advanced_fields['link_options'] = false;

		return $advanced_fields;
	}

	protected function render_play_icon( $icon ) {
		$icons = array(
			'1' => '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 511.999 511.999"><g><path d="M443.86,196.919L141.46,10.514C119.582-2.955,93.131-3.515,70.702,9.016c-22.429,12.529-35.819,35.35-35.819,61.041  v371.112c0,38.846,31.3,70.619,69.77,70.829c0.105,0,0.21,0.001,0.313,0.001c12.022-0.001,24.55-3.769,36.251-10.909 c9.413-5.743,12.388-18.029,6.645-27.441c-5.743-9.414-18.031-12.388-27.441-6.645c-5.473,3.338-10.818,5.065-15.553,5.064 c-14.515-0.079-30.056-12.513-30.056-30.898V70.058c0-11.021,5.744-20.808,15.364-26.183c9.621-5.375,20.966-5.135,30.339,0.636 l302.401,186.405c9.089,5.596,14.29,14.927,14.268,25.601c-0.022,10.673-5.261,19.983-14.4,25.56L204.147,415.945 c-9.404,5.758-12.36,18.049-6.602,27.452c5.757,9.404,18.048,12.36,27.452,6.602l218.611-133.852  c20.931-12.769,33.457-35.029,33.507-59.55C477.165,232.079,464.729,209.767,443.86,196.919z"/></g></svg>',

			'2' => '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 494.148 494.148"><g><g><path d="M405.284,201.188L130.804,13.28C118.128,4.596,105.356,0,94.74,0C74.216,0,61.52,16.472,61.52,44.044v406.124 c0,27.54,12.68,43.98,33.156,43.98c10.632,0,23.2-4.6,35.904-13.308l274.608-187.904c17.66-12.104,27.44-28.392,27.44-45.884 C432.632,229.572,422.964,213.288,405.284,201.188z"/> </g></g></svg>',

			'3' => '<svg viewBox="0 0 494.942 494.942" xmlns="http://www.w3.org/2000/svg"><path d="m35.353 0 424.236 247.471-424.236 247.471z"/></svg>',

			'4' => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60 60"><path d="M30,0C13.458,0,0,13.458,0,30s13.458,30,30,30s30-13.458,30-30S46.542,0,30,0z M45.563,30.826l-22,15 C23.394,45.941,23.197,46,23,46c-0.16,0-0.321-0.038-0.467-0.116C22.205,45.711,22,45.371,22,45V15c0-0.371,0.205-0.711,0.533-0.884 c0.328-0.174,0.724-0.15,1.031,0.058l22,15C45.836,29.36,46,29.669,46,30S45.836,30.64,45.563,30.826z"/> <g></g></svg>',

			'5' => '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 485 485"><g><path d="M413.974,71.026C368.171,25.225,307.274,0,242.5,0S116.829,25.225,71.026,71.026C25.225,116.829,0,177.726,0,242.5 s25.225,125.671,71.026,171.474C116.829,459.775,177.726,485,242.5,485s125.671-25.225,171.474-71.026 C459.775,368.171,485,307.274,485,242.5S459.775,116.829,413.974,71.026z M242.5,455C125.327,455,30,359.673,30,242.5 S125.327,30,242.5,30S455,125.327,455,242.5S359.673,455,242.5,455z"/><polygon points="181.062,336.575 343.938,242.5 181.062,148.425"/></g></svg>',

			'6' => '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 310 310"><g><path d="M297.917,64.645c-11.19-13.302-31.85-18.728-71.306-18.728H83.386c-40.359,0-61.369,5.776-72.517,19.938 C0,79.663,0,100.008,0,128.166v53.669c0,54.551,12.896,82.248,83.386,82.248h143.226c34.216,0,53.176-4.788,65.442-16.527 C304.633,235.518,310,215.863,310,181.835v-53.669C310,98.471,309.159,78.006,297.917,64.645z M199.021,162.41l-65.038,33.991 c-1.454,0.76-3.044,1.137-4.632,1.137c-1.798,0-3.592-0.484-5.181-1.446c-2.992-1.813-4.819-5.056-4.819-8.554v-67.764 c0-3.492,1.822-6.732,4.808-8.546c2.987-1.814,6.702-1.938,9.801-0.328l65.038,33.772c3.309,1.718,5.387,5.134,5.392,8.861 C204.394,157.263,202.325,160.684,199.021,162.41z"/></g></svg>',
		);

		return $icons[ $icon ];
	}

	public function render( $attrs, $content = null, $render_slug ) {

		$inline_modal     = '';
		$image            = $this->props['image'];
		$close_icon_color = $this->props['close_icon_color'];
		$popup_bg         = $this->props['popup_bg'];
		$image            = $this->props['image'];
		$icon             = $this->props['icon'];
		$video_link       = $this->props['video_link'];
		$type             = $this->props['type'];
		$video            = $this->props['video'];
		$video_id         = '';
		$order_class      = self::get_module_order_class( $render_slug );
		$order_number     = str_replace( '_', '', str_replace( $this->slug, '', $order_class ) );
		$data_modal       = 'video' === $type ? sprintf( 'data-mfp-src="#ba-video-popup-%1$s"', $order_number ) : '';

		// popup style.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => ".ba-video-popup-{$order_number} .mfp-bg",
				'declaration' => sprintf( 'opacity:1!important;background: %1$s!important;', $popup_bg ),
			)
		);
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => ".ba-video-popup-{$order_number} .mfp-iframe-holder .mfp-close",
				'declaration' => sprintf( 'color: %1$s!important;', $close_icon_color ),
			)
		);

		$this->render_css( $render_slug );

		if ( 'video' === $type ) {
			$inline_modal = sprintf(
				'<div class="mfp-hide ba-modal" id="ba-video-popup-%1$s" data-order="%1$s">
                    <div class="ba-video-wrap">
                        <video controls autoplay><source type="video/mp4" src="%2$s"></video>
                    </div>
                </div>',
				$order_number,
				$video
			);
		}

		if ( 'yt' === $type ) {
			if ( strpos( $video_link, '.be' ) !== false ) {
				$ex_link  = explode( 'be/', $video_link );
				$video_id = $ex_link[1];
			} elseif ( strpos( $video_link, 'watch?v=' ) !== false ) {
				$ex_link  = explode( 'watch?v=', $video_link );
				$ex_link  = explode( '&', $ex_link[1] );
				$video_id = $ex_link[0];
			}
		} elseif ( 'vm' === $type ) {
			$ex_link  = explode( '/', $video_link );
			$video_id = $ex_link[ count( $ex_link ) - 1 ];
		}

		return sprintf(
			'<a
				href="%3$s" %7$s
				class="ba-module ba-video-popup ba-popup-%6$s"
				data-order="%4$s"
				data-id="%8$s"
				data-type="%6$s"
			>
                %5$s
                <div class="ba-video-popup-icon">
					<span>%1$s</span>
                </div>
                <div class="ba-video-popup-figure">
                    <img src="%2$s" alt=""/>
                </div>
            </a>',
			$this->render_play_icon( $icon ),
			$image,
			$video_link,
			$order_number,
			$inline_modal,
			$type,
			$data_modal,
			$video_id
		);
	}

	protected function render_css( $render_slug ) {

		$icon_color         = $this->props['icon_color'];
		$use_animation      = $this->props['use_animation'];
		$wave_bg            = $this->props['wave_bg'];
		$use_animation      = $this->props['use_animation'];
		$icon_bg            = $this->props['icon_bg'];
		$icon_bg_hover      = $this->get_hover_value( 'icon_bg' );
		$icon_radius        = $this->props['icon_radius'];
		$icon_color_hover   = $this->get_hover_value( 'icon_color' );
		$icon_size_hover    = $this->get_hover_value( 'icon_size' );
		$icon_opacity       = $this->props['icon_opacity'];
		$icon_opacity_hover = $this->get_hover_value( 'icon_opacity' );

		if ( 'on' === $use_animation ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-video-popup-icon span:after',
					'declaration' => sprintf(
						'content: "";
						-webkit-box-shadow: 0 0 0 15px %1$s, 0 0 0 30px %1$s, 0 0 0 45px %1$s;
						box-shadow: 0 0 0 15px %1$s, 0 0 0 30px %1$s, 0 0 0 45px %1$s;',
						$wave_bg
					),
				)
			);
		}

		$this->get_responsive_styles(
			'img_height',
			'%%order_class%% .ba-video-popup-figure',
			array( 'primary' => 'height' ),
			array( 'default' => '300px' ),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-video-popup-icon span',
				'declaration' => sprintf( 'fill: %1$s;', $icon_color ),
			)
		);

		if ( ! empty( $icon_color_hover ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%:hover .ba-video-popup-icon svg',
					'declaration' => sprintf( 'fill: %1$s;', $icon_color_hover ),
				)
			);
		}

		if ( ! empty( $icon_bg ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-video-popup-icon span',
					'declaration' => sprintf( 'background: %1$s;', $icon_bg ),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-video-popup-icon span, %%order_class%% .ba-video-popup-icon span:after',
				'declaration' => sprintf( 'border-radius:%1$s;', $icon_radius ),
			)
		);

		if ( ! empty( $icon_bg_hover ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%:hover .ba-video-popup-icon span',
					'declaration' => sprintf( 'background: %1$s;', $icon_bg_hover ),
				)
			);
		}

		$this->get_responsive_styles(
			'icon_height',
			'%%order_class%% .ba-video-popup-icon span',
			array( 'primary' => 'height' ),
			array( 'default' => 'initial' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'icon_width',
			'%%order_class%% .ba-video-popup-icon span',
			array( 'primary' => 'width' ),
			array( 'default' => 'initial' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'icon_size',
			'%%order_class%% .ba-video-popup-icon svg',
			array( 'primary' => 'width' ),
			array( 'default' => '60px' ),
			$render_slug
		);

		if ( ! empty( $icon_size_hover ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%:hover .ba-video-popup-icon svg',
					'declaration' => "width:{$icon_size_hover};",
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-video-popup-icon i',
				'declaration' => "opacity:{$icon_opacity};",
			)
		);

		if ( ! empty( $icon_opacity_hover ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%:hover .ba-video-popup-icon i',
					'declaration' => "opacity:{$icon_opacity_hover};",
				)
			);
		}

		// overlay BG.
		$this->get_custom_bg_style( $render_slug, 'image', '%%order_class%% .ba-video-popup-figure:before', '%%order_class%%:hover .ba-video-popup-figure:before' );

	}
}

	new BA_Video_Popup();
