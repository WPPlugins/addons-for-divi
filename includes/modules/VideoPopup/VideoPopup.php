<?php
class BA_Video_Popup extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/demo/video-popup/',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {

		$this->slug       = 'ba_video_popup';
		$this->vb_support = 'on';
		$this->name       = esc_html__( 'Brain Video Popup', 'brain-divi-addons' );

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__( 'Content', 'brain-divi-addons' ),
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
	}

	public function get_fields() {

		$fields = array(
			'image'            => array(
				'label'              => esc_html__( 'Image', 'brain-divi-addons' ),
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
				'type'        => 'select',
				'toggle_slug' => 'content',
				'default'     => '1',
				'options'     => array(
					'1' => esc_html__( 'Icon 1', 'brain-divi-addons' ),
					'2' => esc_html__( 'Icon 2', 'brain-divi-addons' ),
					'3' => esc_html__( 'Icon 3', 'brain-divi-addons' ),
					'4' => esc_html__( 'Icon 4', 'brain-divi-addons' ),
					'5' => esc_html__( 'Icon 5', 'brain-divi-addons' ),
				),
			),
			'type'             => array(
				'label'       => esc_html__( 'Video Type', 'brain-divi-addons' ),
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
				'label'       => esc_html__( 'URL', 'brain-divi-addons' ),
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
			'img_height'       => array(
				'label'          => esc_html__( 'Image Height', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '300px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 1000,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'image',
			),
			'icon_color'       => array(
				'label'       => esc_html__( 'Icon Color', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#2EA3F2',
				'toggle_slug' => 'icon',
				'hover'       => 'tabs',
			),
			'icon_size'        => array(
				'label'          => esc_html__( 'Icon Size', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '60px',
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
				'label'          => esc_html__( 'Icon Opacity', 'brain-divi-addons' ),
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
			// Popup.
			'popup_bg'         => array(
				'label'       => esc_html__( 'Popup Background', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => 'rgba(0,0,0,.8)',
				'toggle_slug' => 'popup',
			),
			'close_icon_color' => array(
				'label'       => esc_html__( 'Close Icon Color', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#ffffff',
				'toggle_slug' => 'popup',
			),
		);

		$img_overlay = $this->custom_background_fields( 'image', 'Image Overlay', 'advanced', 'image', array( 'color', 'gradient', 'hover' ), array(), '' );

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
				'
                <div class="mfp-hide ba-modal" id="ba-video-popup-%1$s" data-order="%1$s">
                    <div class="ba-video-wrap">
                        <video controls><source type="video/mp4" src="%2$s"></video>
                    </div>
                </div>',
				$order_number,
				$video
			);
		}

		return sprintf(
			'
            <a href="%3$s" %7$s class="ba-module ba-video-popup ba-popup-%6$s" data-order="%4$s">
                %5$s
                <div class="ba-video-popup-icon">
                    <i class="ba-ico-play-%1$s"></i>
                </div>
                <div class="ba-video-popup-figure">
                    <img src="%2$s" alt=""/>
                </div>
            </a>',
			$icon,
			$image,
			$video_link,
			$order_number,
			$inline_modal,
			$type,
			$data_modal
		);
	}

	protected function render_css( $render_slug ) {

		$icon_color         = $this->props['icon_color'];
		$icon_color_hover   = $this->get_hover_value( 'icon_color' );
		$icon_size_hover    = $this->get_hover_value( 'icon_size' );
		$icon_opacity       = $this->props['icon_opacity'];
		$icon_opacity_hover = $this->get_hover_value( 'icon_opacity' );

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
				'selector'    => '%%order_class%% .ba-video-popup-icon i',
				'declaration' => sprintf( 'color: %1$s;', $icon_color ),
			)
		);

		if ( ! empty( $icon_color_hover ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%:hover .ba-video-popup-icon i',
					'declaration' => sprintf( 'color: %1$s;', $icon_color_hover ),
				)
			);
		}

		$this->get_responsive_styles(
			'icon_size',
			'%%order_class%% .ba-video-popup-icon i',
			array( 'primary' => 'font-size' ),
			array( 'default' => '60px' ),
			$render_slug
		);

		if ( ! empty( $icon_size_hover ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%:hover .ba-video-popup-icon i',
					'declaration' => "font-size:{$icon_size_hover};",
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
