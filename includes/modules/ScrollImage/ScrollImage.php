<?php
class BA_Scroll_Image extends BA_Builder_Module {

	public $slug       = 'ba_scroll_image';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/demo/scroll-image/',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {
		$this->name = esc_html__( 'Brain Scroll Image', 'brain-divi-addons' );
		$this->icon_path = plugin_dir_path( __FILE__ ) . 'scroll-image.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content'  => esc_html__( 'Content', 'brain-divi-addons' ),
					'settings' => esc_html__( 'Settings', 'brain-divi-addons' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'image'   => esc_html__( 'Image', 'brain-divi-addons' ),
					'overlay' => esc_html__( 'Overlay', 'brain-divi-addons' ),
					'icon'    => esc_html__( 'Icon', 'brain-divi-addons' ),
					'border'  => esc_html__( 'Border', 'brain-divi-addons' ),
				),
			),
		);
	}

	public function get_fields() {

		$fields = array(

			// content.
			'image'             => array(
				'label'              => esc_html__( 'Upload Image', 'brain-divi-addons' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'toggle_slug'        => 'content',
				'upload_button_text' => esc_attr__( 'Upload an image', 'brain-divi-addons' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'brain-divi-addons' ),
				'update_text'        => esc_attr__( 'Set As Image', 'brain-divi-addons' ),
			),

			'image_alt'         => array(
				'label'       => esc_html__( 'Image Alt Text', 'brain-divi-addons' ),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),

			'show_icon'         => array(
				'label'       => esc_html__( 'Show Direction Icon', 'brain-divi-addons' ),
				'type'        => 'yes_no_button',
				'default'     => 'off',
				'toggle_slug' => 'content',
				'options'     => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
			),

			'icon'              => array(
				'label'           => esc_html__( 'Select Icon', 'brain-divi-addons' ),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'content',
				'show_if'         => array(
					'show_icon' => 'on',
					'use_image' => 'off',
				),
			),

			'use_image'         => array(
				'label'           => esc_html__( 'Use Icon Image', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'content',
				'show_if'         => array(
					'show_icon' => 'on',
				),
			),

			'icon_image'        => array(
				'label'              => esc_html__( 'Upload Icon Image', 'brain-divi-addons' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an Icon', 'brain-divi-addons' ),
				'choose_text'        => esc_attr__( 'Choose an Icon', 'brain-divi-addons' ),
				'update_text'        => esc_attr__( 'Set As Icon', 'brain-divi-addons' ),
				'toggle_slug'        => 'content',
				'show_if'            => array(
					'use_image' => 'on',
					'show_icon' => 'on',
				),
			),

			// settings
			'use_icon_anim'     => array(
				'label'       => esc_html__( 'Use Icon Animation', 'brain-divi-addons' ),
				'type'        => 'yes_no_button',
				'default'     => 'off',
				'toggle_slug' => 'content',
				'options'     => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'show_icon' => 'on',
				),
			),

			'scroll_type'       => array(
				'label'       => esc_html__( 'Scroll Type', 'brain-divi-addons' ),
				'type'        => 'select',
				'default'     => 'on_hover',
				'options'     => array(
					'on_hover'  => esc_html__( 'On Mouse Hover', 'brain-divi-addons' ),
					'on_scroll' => esc_html__( 'On Mouse Scroll', 'brain-divi-addons' ),
				),
				'toggle_slug' => 'settings',
			),

			'scroll_dir_scroll' => array(
				'label'       => esc_html__( 'Scroll Direction', 'brain-divi-addons' ),
				'type'        => 'select',
				'default'     => 'vertical',
				'options'     => array(
					'vertical'   => esc_html__( 'Vertical', 'brain-divi-addons' ),
					'horizontal' => esc_html__( 'Horizontal', 'brain-divi-addons' ),
				),
				'toggle_slug' => 'settings',
				'show_if'     => array(
					'scroll_type' => 'on_scroll',
				),
			),

			'scroll_dir_hover'  => array(
				'label'       => esc_html__( 'Scroll Direction', 'brain-divi-addons' ),
				'type'        => 'select',
				'default'     => 'Y_btt',
				'options'     => array(
					'Y_btt' => esc_html__( 'Bottom to Top', 'brain-divi-addons' ),
					'Y_ttb' => esc_html__( 'Top to Bottom', 'brain-divi-addons' ),
					'X_ltr' => esc_html__( 'Left to Right', 'brain-divi-addons' ),
					'X_rtl' => esc_html__( 'Right to Left', 'brain-divi-addons' ),
				),
				'toggle_slug' => 'settings',
				'show_if'     => array(
					'scroll_type' => 'on_hover',
				),
			),

			'scroll_speed'      => array(
				'label'          => esc_html__( 'Scroll Speed', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '700ms',
				'fixed_unit'     => 'ms',
				'default_unit'   => 'ms',
				'range_settings' => array(
					'min'  => '50',
					'max'  => '10000',
					'step' => '50',
				),
				'toggle_slug'    => 'settings',
				'show_if'        => array(
					'scroll_type' => 'on_hover',
				),
			),

			// image
			'img_height'        => array(
				'label'          => esc_html__( 'Image Height', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '350px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => '1',
					'max'  => '1500',
					'step' => '1',
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'image',
				'mobile_options' => true,
			),

			// overlay
			'use_overlay'       => array(
				'label'           => esc_html__( 'Use Image Overlay', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'off',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'overlay',
			),

			// icon
			'icon_color'        => array(
				'label'       => esc_html__( 'Icon Color', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#2EA3F2',
				'toggle_slug' => 'icon',
				'show_if'     => array(
					'use_image' => 'off',
					'show_icon' => 'on',
				),
			),

			'icon_size'         => array(
				'label'          => esc_html__( 'Icon Size', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '48px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				),
				'toggle_slug'    => 'icon',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'show_icon' => 'on',
				),
			),
		);

		$overlay_bg = $this->custom_background_fields( 'overlay', 'Overlay', 'advanced', 'overlay', array( 'color', 'gradient' ), array( 'use_overlay' => 'on' ), 'rgba(255,255,255,0.39)' );

		return array_merge( $fields, $overlay_bg );
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
					'border_radii'  => '%%order_class%% .ba-scroll-image-icon-el',
					'border_styles' => '%%order_class%% .ba-scroll-image-icon-el',
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

		$advanced_fields['borders']['main'] = array(
			'toggle_slug' => 'border',
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
					'color' => '#333',
					'style' => 'solid',
				),
			),
		);

		return $advanced_fields;
	}

	public function render_icon() {
		$show_icon  = $this->props['show_icon'];
		$use_image  = $this->props['use_image'];
		$icon_image = $this->props['icon_image'];
		$icon       = $this->props['icon'];

		if ( $show_icon === 'on' ) {
			if ( $use_image === 'on' ) {
				return sprintf(
					'
                    <div class="ba-scroll-image-icon">
                        <div class="ba-scroll-image-icon-el">
                            <img src="%1$s" alt=""/>
                        </div>
                    </div>',
					$icon_image
				);
			} else {
				$icon = esc_attr( et_pb_process_font_icon( $icon ) );

				return sprintf(
					'
                    <div class="ba-scroll-image-icon ba-et-font-icon">
                        <div class="ba-scroll-image-icon-el">
                            %1$s
                        </div>
                    </div>',
					$icon
				);
			}
		}
	}

	public function render_overlay() {
		$use_overlay = $this->props['use_overlay'];
		if ( $use_overlay === 'on' ) {
			return '<div class="ba-scroll-image-overlay"></div>';
		}
	}



	public function render( $attrs, $content = null, $render_slug ) {

		$image             = $this->props['image'];
		$image_alt         = $this->props['image_alt'];
		$scroll_type       = $this->props['scroll_type'];
		$scroll_dir_hover  = $this->props['scroll_dir_hover'];
		$scroll_dir_scroll = $this->props['scroll_dir_scroll'];

		// Render CSS.
		$this->render_css( $render_slug );

		if ( ! empty( $image ) ) {
			return sprintf(
				'
                <div class="ba-module ba-scroll-image" data-dir-hover="%5$s" data-dir-scroll="%6$s">
                    %1$s
                    <div class="scroll-figure-wrap">
                        %2$s
                        <img class="ba-scroll-image-el" src="%3$s" alt="%4$s" />
                    </div>
                </div>',
				$this->render_icon(),
				$this->render_overlay(),
				$image,
				$image_alt,
				$scroll_type === 'on_hover' ? $scroll_dir_hover : 'none',
				$scroll_type === 'on_scroll' ? $scroll_dir_scroll : 'none'
			);
		} else {
			return '<div class="ba-module ba-scroll-image"></div>';
		}
	}

	protected function render_css( $render_slug ) {

		$icon_color                   = $this->props['icon_color'];
		$use_image                    = $this->props['use_image'];
		$show_icon                    = $this->props['show_icon'];
		$use_icon_anim                = $this->props['use_icon_anim'];
		$icon_size                    = $this->props['icon_size'];
		$scroll_speed                 = $this->props['scroll_speed'];
		$scroll_type                  = $this->props['scroll_type'];
		$scroll_dir_scroll            = $this->props['scroll_dir_scroll'];
		$scroll_dir_hover             = $this->props['scroll_dir_hover'];
		$img_height                   = $this->props['img_height'];
		$img_height_tablet            = $this->props['img_height_tablet'];
		$img_height_phone             = $this->props['img_height_phone'];
		$img_height_last_edited       = $this->props['img_height_last_edited'];
		$img_height_responsive_status = et_pb_get_responsive_status( $img_height_last_edited );

		if ( $use_icon_anim === 'on' ) {
			$anim_dir = '';
			if ( $scroll_type === 'on_scroll' ) {
				if ( $scroll_dir_scroll === 'vertical' ) {
					$anim_dir = 'Y';
				} else {
					$anim_dir = 'X';
				}
			} else {
				$anim_dir = $scroll_dir_hover[0];
			}

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-scroll-image-icon-el',
					'declaration' => sprintf(
						'
                    animation-name: ba-scroll-%1$s;
                    animation-duration: .5s;
                    animation-iteration-count: infinite;
                    animation-direction: alternate;
                    animation-timing-function: ease-in-out;',
						$anim_dir
					),
				)
			);
		}

		// Icon
		if ( $show_icon === 'on' ) {
			if ( $use_image === 'off' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-scroll-image-icon-el',
						'declaration' => sprintf( 'color: %1$s; font-size: %2$s;', $icon_color, $icon_size ),
					)
				);
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-scroll-image-icon img',
						'declaration' => sprintf( 'width: %1$s; ', $icon_size ),
					)
				);
			}
		}

		// Scroll
		if ( $scroll_type === 'on_scroll' ) {
			if ( $scroll_dir_scroll === 'vertical' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-scroll-image',
						'declaration' => 'overflow-y: auto;overflow-x:hidden;',
					)
				);
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-scroll-image .ba-scroll-image-el',
						'declaration' => 'max-width: 100%;width: 100%;',
					)
				);
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-scroll-image',
						'declaration' => 'overflow-y:hidden;overflow-x: auto;',
					)
				);

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-scroll-image .ba-scroll-image-el',
						'declaration' => 'height: 100%; max-width: none;width: auto;',
					)
				);
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .scroll-figure-wrap',
						'declaration' => 'height: 100%;width: 100%;',
					)
				);
			}
		} elseif ( $scroll_type === 'on_hover' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .scroll-figure-wrap',
					'declaration' => 'height:100%;width:100%;',
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-scroll-image',
					'declaration' => 'overflow: hidden;',
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-scroll-image .ba-scroll-image-el',
					'declaration' => sprintf( 'position:absolute;transition: %1$s;', $scroll_speed ),
				)
			);

			if ( $scroll_dir_hover === 'X_ltr' || $scroll_dir_hover === 'X_rtl' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-scroll-image .ba-scroll-image-el',
						'declaration' => 'height: 100%; max-width: none;width: auto;top:0;',
					)
				);

				if ( $scroll_dir_hover === 'X_ltr' ) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .ba-scroll-image .ba-scroll-image-el',
							'declaration' => 'right:0;',
						)
					);
				} elseif ( $scroll_dir_hover === 'X_rtl' ) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .ba-scroll-image .ba-scroll-image-el',
							'declaration' => 'left:0;',
						)
					);
				}
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-scroll-image .ba-scroll-image-el',
						'declaration' => 'max-width: 100%;width: 100%; left:0;',
					)
				);

				if ( $scroll_dir_hover === 'Y_ttb' ) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .ba-scroll-image .ba-scroll-image-el',
							'declaration' => 'bottom:0;',
						)
					);
				} elseif ( $scroll_dir_hover === 'Y_btt' ) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .ba-scroll-image .ba-scroll-image-el',
							'declaration' => 'top:0;',
						)
					);
				}
			}
		}

		// image height
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-scroll-image',
				'declaration' => sprintf( 'height: %1$s;', $img_height ),
			)
		);

		if ( $img_height_tablet && $img_height_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-scroll-image',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'height: %1$s;', $img_height_tablet ),
				)
			);
		}

		if ( $img_height_phone && $img_height_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-scroll-image',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'height: %1$s;', $img_height_phone ),
				)
			);
		}

		// overlay
		$this->get_custom_bg_style( $render_slug, 'overlay', '%%order_class%% .ba-scroll-image-overlay', '' );

	}
}

new BA_Scroll_Image();
