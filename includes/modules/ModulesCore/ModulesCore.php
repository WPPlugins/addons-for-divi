<?php
class BA_Builder_Module extends ET_Builder_Module {

	protected function custom_background_fields(
		$option_name,
		$option_label,
		$tab_slug,
		$toggle_slug,
		array $background_tab = array(),
		$show_if = array(),
		$default
	) {

		$color           = array();
		$image           = array();
		$gradient        = array();
		$advanced_fields = array();

		if ( in_array( 'color', $background_tab, true ) ) {
			$color = $this->generate_background_options(
				"{$option_name}_bg",
				'color',
				$tab_slug,
				$toggle_slug,
				"{$option_name}_bg_color"
			);
		}

		if ( in_array( 'gradient', $background_tab, true ) ) {
			$gradient = $this->generate_background_options(
				"{$option_name}_bg",
				'gradient',
				$tab_slug,
				$toggle_slug,
				"{$option_name}_bg_color"
			);
		}

		if ( in_array( 'image', $background_tab, true ) ) {
			$image = $this->generate_background_options(
				"{$option_name}_bg",
				'image',
				$tab_slug,
				$toggle_slug,
				"{$option_name}_bg_color"
			);
		}

		$advanced_fields[ "{$option_name}_bg_color" ] = array(
			'label'             => sprintf( esc_html__( '%1$s Background', 'brain-divi-addons' ), $option_label ),
			'type'              => 'background-field',
			'base_name'         => "{$option_name}_bg",
			'context'           => "{$option_name}_bg_color",
			'option_category'   => 'layout',
			'custom_color'      => true,
			'default'           => $default,
			'tab_slug'          => $tab_slug,
			'toggle_slug'       => $toggle_slug,
			'show_if'           => $show_if,
			'background_fields' => array_merge( $color, $gradient, $image ),
		);

		if ( in_array( 'hover', $background_tab, true ) ) {
			$advanced_fields[ "{$option_name}_bg_color" ]['hover'] = 'tabs';
		}

		$skip = $this->generate_background_options(
			"{$option_name}_bg",
			'skip',
			$tab_slug,
			$toggle_slug,
			"{$option_name}_bg_color"
		);

		$advanced_fields = array_merge( $advanced_fields, $skip );

		return $advanced_fields;
	}

	protected function get_custom_gradient( $args = array() ) {

		$defaults = apply_filters(
			'et_pb_default_gradient',
			array(
				'type'             => ET_Global_Settings::get_value( 'all_background_gradient_type' ),
				'direction'        => ET_Global_Settings::get_value( 'all_background_gradient_direction' ),
				'radial_direction' => ET_Global_Settings::get_value( 'all_background_gradient_direction_radial' ),
				'color_start'      => ET_Global_Settings::get_value( 'all_background_gradient_start' ),
				'color_end'        => ET_Global_Settings::get_value( 'all_background_gradient_end' ),
				'start_position'   => ET_Global_Settings::get_value( 'all_background_gradient_start_position' ),
				'end_position'     => ET_Global_Settings::get_value( 'all_background_gradient_end_position' ),
			)
		);

		$args           = wp_parse_args( array_filter( $args ), $defaults );
		$direction      = 'linear' === $args['type'] ? $args['direction'] : "circle at {$args['radial_direction']}";
		$start_position = et_sanitize_input_unit( $args['start_position'], false, '%' );
		$end_position   = et_sanitize_input_unit( $args['end_position'], false, '%' );

		return esc_html(
			"{$args['type']}-gradient(
            {$direction},
            {$args['color_start']} ${start_position},
            {$args['color_end']} ${end_position}
        )"
		);
	}

	protected function process_custom_background_fields( $option_name, $hover_suffix ) {

		// Background Options Styling.
		$background_base_name                     = "{$option_name}_bg";
		$background_prefix                        = "{$background_base_name}_";
		$background_style                         = '';
		$background_image_style                   = '';
		$background_images                        = array();
		$has_background_color_gradient            = false;
		$background_color_gradient_overlays_image = 'off';

		// A. Background Gradient.
		$use_background_color_gradient = isset( $this->props[ "{$background_prefix}use_color_gradient{$hover_suffix}" ] ) ? $this->props[ "{$background_prefix}use_color_gradient{$hover_suffix}" ] : '';

		if ( 'on' === $use_background_color_gradient ) {

			$background_color_gradient_overlays_image = isset( $this->props[ "{$background_prefix}color_gradient_overlays_image{$hover_suffix}" ] ) ? $this->props[ "{$background_prefix}color_gradient_overlays_image{$hover_suffix}" ] : 'off';

			$type = isset( $this->props[ "{$background_prefix}color_gradient_type{$hover_suffix}" ] ) ? $this->props[ "{$background_prefix}color_gradient_type{$hover_suffix}" ] : '';

			$direction = isset( $this->props[ "{$background_prefix}color_gradient_direction{$hover_suffix}" ] ) ? $this->props[ "{$background_prefix}color_gradient_direction{$hover_suffix}" ] : '';

			$radial_direction = isset( $this->props[ "{$background_prefix}color_gradient_direction_radial{$hover_suffix}" ] ) ? $this->props[ "{$background_prefix}color_gradient_direction_radial{$hover_suffix}" ] : '';

			$color_start = isset( $this->props[ "{$background_prefix}color_gradient_start{$hover_suffix}" ] ) ? $this->props[ "{$background_prefix}color_gradient_start{$hover_suffix}" ] : '';

			$color_end = isset( $this->props[ "{$background_prefix}color_gradient_end{$hover_suffix}" ] ) ? $this->props[ "{$background_prefix}color_gradient_end{$hover_suffix}" ] : '';

			$start_position = isset( $this->props[ "{$background_prefix}color_gradient_start_position{$hover_suffix}" ] ) ? $this->props[ "{$background_prefix}color_gradient_start_position{$hover_suffix}" ] : '';

			$end_position = isset( $this->props[ "{$background_prefix}color_gradient_end_position{$hover_suffix}" ] ) ? $this->props[ "{$background_prefix}color_gradient_end_position{$hover_suffix}" ] : '';

			$gradient_properties = array(
				'type'             => $type,
				'direction'        => $direction,
				'radial_direction' => $radial_direction,
				'color_start'      => $color_start,
				'color_end'        => $color_end,
				'start_position'   => $start_position,
				'end_position'     => $end_position,
			);

			// Save background gradient into background images list.
			$background_gradient = $this->get_custom_gradient( $gradient_properties );
			$background_images[] = $background_gradient;

			// Flag to inform BG Color if current module has Gradient.
			$has_background_color_gradient = true;

		}

		// Background Image.
		$bg_image           = isset( $this->props[ "{$option_name}_bg_image{$hover_suffix}" ] ) ? $this->props[ "{$option_name}_bg_image{$hover_suffix}" ] : '';
		$parallax           = isset( $this->props[ "{$option_name}_bg_parallax{$hover_suffix}" ] ) ? $this->props[ "{$option_name}_bg_parallax{$hover_suffix}" ] : '';
		$is_bg_image_active = '' !== $bg_image && 'on' !== $parallax;

		if ( $is_bg_image_active ) {

			$has_bg_image = true;

			$bg_size = isset( $this->props[ "{$option_name}_bg_size{$hover_suffix}" ] ) ? $this->props[ "{$option_name}_bg_size{$hover_suffix}" ] : '';
			if ( '' !== $bg_size ) {
				$background_style .= sprintf(
					'background-size: %1$s !important; ',
					esc_html( $bg_size )
				);
			}

			$bg_position = isset( $this->props[ "{$option_name}_bg_position{$hover_suffix}" ] ) ? $this->props[ "{$option_name}_bg_position{$hover_suffix}" ] : '';
			if ( '' !== $bg_position ) {
				$background_style .= sprintf(
					'background-position: %1$s !important; ',
					esc_html( str_replace( '_', ' ', $bg_position ) )
				);
			}

			$bg_repeat = isset( $this->props[ "{$option_name}_bg_repeat{$hover_suffix}" ] ) ? $this->props[ "{$option_name}_bg_repeat{$hover_suffix}" ] : '';
			if ( '' !== $bg_repeat ) {
				$background_style .= sprintf(
					'background-repeat: %1$s !important; ',
					esc_html( $bg_repeat )
				);
			}

			$bg_blend = isset( $this->props[ "{$option_name}_bg_blend{$hover_suffix}" ] ) ? $this->props[ "{$option_name}_bg_blend{$hover_suffix}" ] : '';
			if ( '' !== $bg_blend ) {
				$background_style .= sprintf(
					'background-blend-mode: %1$s !important;',
					esc_html( $bg_blend )
				);
			}

			$background_images[] = sprintf( 'url(%1$s)', esc_html( $bg_image ) );
		} else {
			$has_bg_image = false;
		}

		if ( ! empty( $background_images ) ) {

			// The browsers stack the images in the opposite order to what you'd expect.
			if ( 'on' !== $background_color_gradient_overlays_image ) {
				$background_images = array_reverse( $background_images );
			}

			// Set background image styles only it's different compared to the larger device.
			$background_image_style = join( ', ', $background_images );

			$background_style .= sprintf(
				'background-image: %1$s !important;',
				esc_html( $background_image_style )
			);

		}

		// B. Background Color.
		if ( ! $has_background_color_gradient || ! $has_bg_image ) {
			$background_color = isset( $this->props[ "{$background_prefix}color{$hover_suffix}" ] ) ? $this->props[ "{$background_prefix}color{$hover_suffix}" ] : '';
			if ( '' !== $background_color ) {
				$background_style .= sprintf(
					'background-color: %1$s%2$s; ',
					esc_html( $background_color ),
					esc_html( ' !important' )
				);
			}
		}

		return $background_style;
	}

	public static function process_flex_style( $val, $type, $important ) {
		$flex_val = 'center';
		if ( 'left' === $val ) {
			$flex_val = 'flex-start';
		} elseif ( 'right' === $val ) {
			$flex_val = 'flex-end';
		}
		return sprintf(
			'%1$s:%2$s%3$s;',
			$type,
			$flex_val,
			$important ? '!important;' : ''
		);
	}

	public static function process_margin_padding(
		$val = '0|0|0|0',
		$type = 'padding',
		$imp = false
	) {

		$_top     = '';
		$_right   = '';
		$_bottom  = '';
		$_left    = '';
		$imp_text = '';
		$_val     = explode( '|', $val );

		if ( $imp ) {
			$imp_text = '!important';
		}

		if ( '' !== $_val[0] ) {
			$_top = "{$type}-top:" . $_val[0] . $imp_text . ';';
		}

		if ( '' !== $_val[1] ) {
			$_right = "{$type}-right:" . $_val[1] . $imp_text . ';';
		}

		if ( '' !== $_val[2] ) {
			$_bottom = "{$type}-bottom:" . $_val[2] . $imp_text . ';';
		}

		if ( '' !== $_val[3] ) {
			$_left = "{$type}-left:" . $_val[3] . $imp_text . ';';
		}

		return esc_html( "{$_top} {$_right} {$_bottom} {$_left}" );
	}

	function get_conditional_responsive_styles( $styles = array(), $data, $style ) {
		$important = isset( $styles['important'] ) ? $styles['important'] : false;

		if ( 'padding' === $style || 'margin' === $style ) {
			return $this->process_margin_padding( $data, $style, $important );
		} elseif ( 'align-self' === $style || 'align-items' === $style || 'justify-content' === $style ) {
			return $this->process_flex_style( $data, $style, $important );
		} elseif ( 'flex' === $style ) {
			return 'flex: 0 0 ' . $data . ';';
		} else {
			return sprintf(
				'
                %1$s:%2$s%3$s;',
				$style,
				$data,
				$important ? '!important;' : ''
			);
		}
	}

	protected function get_responsive_styles(
		$opt_name,
		$selector,
		$styles = array(),
		$pre_values = array(),
		$render_slug
	) {

		$is_enabled = false;
		$style      = $styles['primary'];
		$_data      = $this->props[ "{$opt_name}" ];

		if ( isset( $this->props[ "{$opt_name}_last_edited" ] ) ) {
			$is_enabled = et_pb_get_responsive_status( $this->props[ "{$opt_name}_last_edited" ] );
		}

		if ( empty( $_data ) && ! empty( $pre_values ) ) {
			if ( ! empty( $pre_values['conditional'] ) ) {
				$is_default = true;
				foreach ( $pre_values['conditional']['values'] as $value ) {
					$property_val = $this->props[ "{$pre_values['conditional']['name']}" ];
					if ( $property_val === $value['a'] ) {
						$_data      = $value['b'];
						$is_default = false;
					}
				}

				if ( $is_default ) {
					$_data = $pre_values['default'];
				}
			}
		}

		if ( ! empty( $_data ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $selector,
					'declaration' => $this->get_conditional_responsive_styles( $styles, $_data, $style ),
				)
			);

			if ( ! empty( $styles['secondary'] ) ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => $selector,
						'declaration' => $styles['secondary'],
					)
				);
			}
		}

		if ( $is_enabled ) {

			$_data_tablet = $this->props[ "{$opt_name}_tablet" ];
			$_data_phone  = $this->props[ "{$opt_name}_phone" ];

			if ( ! empty( $_data_tablet ) ) {

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => $selector,
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
						'declaration' => $this->get_conditional_responsive_styles( $styles, $_data_tablet, $style ),
					)
				);

				if ( ! empty( $styles['secondary'] ) ) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => $selector,
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
							'declaration' => $styles['secondary'],
						)
					);
				}
			}

			if ( ! empty( $_data_phone ) ) {

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => $selector,
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
						'declaration' => $this->get_conditional_responsive_styles( $styles, $_data_phone, $style ),
					)
				);

				if ( ! empty( $styles['secondary'] ) ) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => $selector,
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
							'declaration' => $styles['secondary'],
						)
					);
				}
			}
		}
	}

	protected function get_absolute_element_options( $prefix, $label, $slug, $defaults, $show_if ) {

		$fields = array(
			"{$prefix}_position"    => array(
				'label'       => esc_html__( "{$label} Position", 'brain-divi-addons' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => $slug,
				'default'     => $defaults['position'],
				'options'     => array(
					'left_top'     => esc_html__( 'Left Top', 'brain-divi-addons' ),
					'left_bottom'  => esc_html__( 'Left Bottom', 'brain-divi-addons' ),
					'right_top'    => esc_html__( 'Right Top', 'brain-divi-addons' ),
					'right_bottom' => esc_html__( 'Right Bottom', 'brain-divi-addons' ),
				),
				'show_if'     => $show_if,
			),

			"{$prefix}_is_center_x" => array(
				'label'           => esc_html__( 'Use Horizontal Position Center', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => $slug,
				'tab_slug'        => 'advanced',
				'show_if'         => $show_if,
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
			),

			"{$prefix}_offset_x"    => array(
				'label'          => esc_html__( "{$label} Offset X", 'brain-divi-addons' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default'        => $defaults['offset_x'],
				'range_settings' => array(
					'min'  => -600,
					'max'  => 600,
					'step' => 1,
				),
				'toggle_slug'    => $slug,
				'tab_slug'       => 'advanced',
				'show_if'        => array_merge( array( "{$prefix}_is_center_x" => 'off' ), $show_if ),
			),

			"{$prefix}_is_center_y" => array(
				'label'           => esc_html__( 'Use Vertical Position Center', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'toggle_slug'     => $slug,
				'tab_slug'        => 'advanced',
				'show_if'         => $show_if,
			),

			"{$prefix}_offset_y"    => array(
				'label'          => esc_html__( "{$label} Offset Y", 'brain-divi-addons' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default'        => $defaults['offset_y'],
				'range_settings' => array(
					'min'  => -600,
					'max'  => 600,
					'step' => 1,
				),
				'toggle_slug'    => $slug,
				'tab_slug'       => 'advanced',
				'show_if'        => array_merge( array( "{$prefix}_is_center_y" => 'off' ), $show_if ),
			),
		);

		return $fields;
	}

	protected function get_badge_options( $prefix, $label, $slug, $defaults ) {

		$fields = array(
			"{$prefix}_padding" => array(
				'label'          => esc_html__( "{$label} Padding", 'brain-divi-addons' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'toggle_slug'    => $slug,
				'default'        => $defaults['padding'],
			),
		);

		$badge_opts = $this->get_absolute_element_options( 'badge', 'Badge', 'badge', $defaults, array() );
		$badge_bg   = $this->custom_background_fields( 'badge', 'Badge', 'advanced', 'badge', array( 'color', 'gradient', 'hover' ), array(), $defaults['bg'] );
		return array_merge( $badge_opts, $fields, $badge_bg );
	}

	protected function get_absolute_element_styles( $render_slug, $prefix, $selector ) {

		$position    = $this->props[ "{$prefix}_position" ];
		$_position   = explode( '_', $position );
		$offset_x    = "{$prefix}_offset_x";
		$offset_y    = "{$prefix}_offset_y";
		$is_center_y = $this->props[ "{$prefix}_is_center_y" ];
		$is_center_x = $this->props[ "{$prefix}_is_center_x" ];
		$val_x       = 0;
		$val_y       = 0;

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => $selector,
				'declaration' => 'position: absolute; z-index: 999;',
			)
		);

		if ( 'on' === $is_center_x ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $selector,
					'declaration' => "{$_position[0]}: 50%;",
				)
			);
		} else {
			$this->get_responsive_styles(
				$offset_x,
				$selector,
				array( 'primary' => $_position[0] ),
				array(),
				$render_slug
			);
		}

		if ( 'on' === $is_center_y ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $selector,
					'declaration' => "{$_position[1]}: 50%;",
				)
			);
		} else {
			$this->get_responsive_styles(
				$offset_y,
				$selector,
				array( 'primary' => $_position[1] ),
				array(),
				$render_slug
			);
		}

		if ( 'right_top' === $position ) {
			if ( 'on' === $is_center_y ) {
				$val_y = '-50%';
			}
			if ( 'on' === $is_center_x ) {
				$val_x = '50%';
			}
		} elseif ( 'right_bottom' === $position ) {
			if ( 'on' === $is_center_y ) {
				$val_y = '50%';
			}
			if ( 'on' === $is_center_x ) {
				$val_x = '50%';
			}
		} elseif ( 'left_bottom' === $position ) {
			if ( 'on' === $is_center_y ) {
				$val_y = '50%';
			}
			if ( 'on' === $is_center_x ) {
				$val_x = '-50%';
			}
		} elseif ( 'left_top' === $position ) {
			if ( 'on' === $is_center_y ) {
				$val_y = '-50%';
			}
			if ( 'on' === $is_center_x ) {
				$val_x = '-50%';
			}
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => $selector,
				'declaration' => "
                transform : translateX({$val_x}) translateY({$val_y});
            ",
			)
		);
	}

	protected function get_badge_styles( $render_slug, $prefix, $selector, $hover_selector ) {

		$this->get_absolute_element_styles( $render_slug, $prefix, $selector );
		$this->get_custom_bg_style( $render_slug, 'badge', $selector, $hover_selector );

		$this->get_responsive_styles(
			$prefix . '_padding',
			$selector,
			array( 'primary' => 'padding' ),
			array(),
			$render_slug
		);
	}

	protected function get_custom_bg_style( $render_slug, $opt_slug, $selector, $hover_selector ) {

		$_bg = $this->process_custom_background_fields( $opt_slug, '' );

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => $selector,
				'declaration' => $_bg,
			)
		);

		$_bg_hover = $this->process_custom_background_fields( $opt_slug, '__hover' );

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => $hover_selector,
				'declaration' => $_bg_hover,
			)
		);

	}

	protected function get_swapped_img_schema( $opt_name ) {

		$photo_last_edited    = isset( $this->props[ "{$opt_name}_last_edited" ] ) ? $this->props[ "{$opt_name}_last_edited" ] : 'off|desktop';
		$photo__hover_enabled = isset( $this->props[ "{$opt_name}__hover_enabled" ] ) ? $this->props[ "{$opt_name}__hover_enabled" ] : 'off|desktop';

		$photo_device_status = explode( '|', $photo_last_edited )[0];
		$photo_hover_status  = explode( '|', $photo__hover_enabled )[0];
		$photo_schema_status = $photo_device_status === 'on' || $photo_hover_status === 'on' ? 'on' : 'off';

		$photo        = $this->props[ "{$opt_name}" ];
		$photo_hover  = $this->get_hover_value( "{$opt_name}" );
		$photo_tablet = $this->props[ "{$opt_name}_tablet" ];
		$photo_phone  = $this->props[ "{$opt_name}_phone" ];

		$schema = array();
		$i      = 0;

		if ( $photo_device_status === 'on' || $photo_hover_status === 'on' ) {
			$schema[ $i ] = '"desktop":"' . $photo . '"';
			$i++;
		}

		if ( $photo_hover_status === 'on' && ! empty( $photo_hover ) ) {
			$schema[ $i ] = '"hover":"' . $photo_hover . '"';
			$i++;
		}

		if ( $photo_device_status === 'on' && ! empty( $photo_tablet ) ) {
			$schema[ $i ] = '"tablet":"' . $photo_tablet . '"';
			$i++;
		}

		if ( 'on' === $photo_device_status && ! empty( $photo_phone ) ) {
			$schema[ $i ] = '"phone":"' . $photo_phone . '"';
		}

		if ( 'on' === $photo_schema_status ) {
			return sprintf( 'data-schema=\'{%1$s}\'', join( ',', $schema ) );
		}
	}

	protected function get_overlay_option_fields( $opt_slug, $hover_status, $show_if = array() ) {

		$fields = array(
			'overlay_on_hover'     => array(
				'label'           => esc_html__( 'Show Overlay on Hover', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'tab_slug'        => 'advanced',
				'default'         => $hover_status,
				'toggle_slug'     => $opt_slug,
				'show_if'         => $show_if,
			),
			'overlay_hover_speed'  => array(
				'label'          => esc_html__( 'Overlay Hover Speed', 'brain-divi-addons' ),
				'type'           => 'range',
				'fixed_unit'     => 'ms',
				'default'        => '300ms',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 5000,
					'step' => 50,
				),
				'toggle_slug'    => $opt_slug,
				'tab_slug'       => 'advanced',
				'show_if'        => array_merge( array( 'overlay_on_hover' => 'on' ), $show_if ),
			),
			'overlay_icon'         => array(
				'label'           => esc_html__( 'Overlay Icon', 'brain-divi-addons' ),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => $opt_slug,
				'tab_slug'        => 'advanced',
				'show_if'         => $show_if,
			),
			'overlay_icon_color'   => array(
				'label'       => esc_html__( 'Overlay Icon Color', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#2EA3F2',
				'toggle_slug' => $opt_slug,
				'show_if'     => $show_if,
				'hover'       => 'tabs',
			),
			'overlay_icon_size'    => array(
				'label'          => esc_html__( 'Overlay Icon Size', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '32px',
				'hover'          => 'tabs',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				),
				'toggle_slug'    => $opt_slug,
				'tab_slug'       => 'advanced',
				'show_if'        => $show_if,
			),
			'overlay_icon_opacity' => array(
				'label'          => esc_html__( 'Overlay Icon Opacity', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '1',
				'unitless'       => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 1,
					'step' => .02,
				),
				'toggle_slug'    => $opt_slug,
				'tab_slug'       => 'advanced',
				'show_if'        => $show_if,
				'hover'          => 'tabs',
			),

		);

		$overlay = $this->custom_background_fields( 'overlay', 'Overlay', 'advanced', $opt_slug, array( 'color', 'gradient' ), $show_if, '' );

		return array_merge( $overlay, $fields );

	}

	protected function get_overlay_style(
		$render_slug,
		$photo_opt_name = '',
		$hover_element = '%%order_class%%'
	) {

		$overlay_icon_color         = $this->props['overlay_icon_color'];
		$overlay_on_hover           = $this->props['overlay_on_hover'];
		$overlay_hover_speed        = $this->props['overlay_hover_speed'];
		$overlay_icon_color_hover   = $this->get_hover_value( 'overlay_icon_color' );
		$overlay_icon_size          = $this->props['overlay_icon_size'];
		$overlay_icon_size_hover    = $this->get_hover_value( 'overlay_icon_size' );
		$overlay_icon_opacity       = $this->props['overlay_icon_opacity'];
		$overlay_icon_opacity_hover = $this->get_hover_value( 'overlay_icon_opacity' );

		if ( ! empty( $photo_opt_name ) ) {
			$raddi = isset( $this->props[ "border_radii_{$photo_opt_name}" ] ) ? $this->props[ "border_radii_{$photo_opt_name}" ] : '';
			if ( ! empty( $raddi ) ) {
				$raddi   = explode( '|', $raddi );
				$raddi_1 = $raddi[1] !== '' ? $raddi[1] : '0';
				$raddi_2 = $raddi[2] !== '' ? $raddi[2] : '0';
				$raddi_3 = $raddi[3] !== '' ? $raddi[3] : '0';
				$raddi_4 = $raddi[4] !== '' ? $raddi[4] : '0';

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-overlay',
						'declaration' => sprintf(
							'
                        border-radius: %1$s %2$s %3$s %4$s;',
							$raddi_1,
							$raddi_2,
							$raddi_3,
							$raddi_4
						),
					)
				);
			}
		}

		if ( 'on' === $overlay_on_hover ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-overlay',
					'declaration' => 'opacity:0;',
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $hover_element . ':hover .ba-overlay',
					'declaration' => 'opacity:1;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-overlay',
				'declaration' => sprintf(
					'color: %1$s;
					transition: all %2$s;',
					$overlay_icon_color,
					$overlay_hover_speed
				),
			)
		);

		if ( ! empty( $overlay_icon_color_hover ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $hover_element . ':hover .ba-overlay',
					'declaration' => sprintf( 'color: %1$s;', $overlay_icon_color_hover ),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-overlay:after',
				'declaration' => "font-size:{$overlay_icon_size};",
			)
		);

		if ( ! empty( $overlay_icon_size_hover ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $hover_element . ':hover .ba-overlay:after',
					'declaration' => "font-size:{$overlay_icon_size_hover};",
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-overlay:after',
				'declaration' => "opacity:{$overlay_icon_opacity};",
			)
		);

		if ( ! empty( $overlay_icon_opacity_hover ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $hover_element . ':hover .ba-overlay:after',
					'declaration' => "opacity:{$overlay_icon_opacity_hover};",
				)
			);
		}
		// Overlay background.
		$this->get_custom_bg_style( $render_slug, 'overlay', '%%order_class%% .ba-overlay', '' );
	}


	protected function get_carousel_option_fields( $supports = array(), $default = array(), $show_if = array() ) {
		$aditional   = array();
		$slide_count = isset( $default['slide_count'] ) ? $default['slide_count'] : '3';

		$fields = array(

			// Carousel Settings
			'animation_speed'         => array(
				'label'           => esc_html__( 'Animation Speed', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '700ms',
				'fixed_unit'      => 'ms',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'general',
				'range_settings'  => array(
					'step' => 100,
					'min'  => 0,
					'max'  => 10000,
				),
				'show_if'         => $show_if,
			),

			'is_autoplay'             => array(
				'label'       => esc_html__( 'Autoplay', 'brain-divi-addons' ),
				'type'        => 'yes_no_button',
				'default'     => 'on',
				'toggle_slug' => 'carousel_settings',
				'sub_toggle'  => 'general',
				'options'     => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'     => $show_if,
			),

			'autoplay_speed'          => array(
				'label'          => esc_html__( 'Autoplay Speed', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '2000ms',
				'fixed_unit'     => 'ms',
				'toggle_slug'    => 'carousel_settings',
				'sub_toggle'     => 'general',
				'range_settings' => array(
					'step' => 100,
					'min'  => 0,
					'max'  => 10000,
				),
				'show_if'        => array_merge( $show_if, array( 'is_autoplay' => 'on' ) ),
			),

			'use_nav'                 => array(
				'label'           => esc_html__( 'Use Navigation', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'on',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'general',
				'mobile_options'  => true,
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'         => $show_if,
			),

			'use_pagi'                => array(
				'label'           => esc_html__( 'Use Pagination', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'general',
				'mobile_options'  => true,
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'         => $show_if,
			),

			'is_variable_width'       => array(
				'label'           => esc_html__( 'Use Fixed Width Slide', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'general',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'         => $show_if,
			),

			'slide_width'             => array(
				'label'          => esc_html__( 'Slide Width', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '360px',
				'fixed_unit'     => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'carousel_settings',
				'sub_toggle'     => 'general',
				'show_if'        => array_merge( $show_if, array( 'is_variable_width' => 'on' ) ),
			),

			'slide_count'             => array(
				'label'          => esc_html__( 'Slides To Show', 'brain-divi-addons' ),
				'type'           => 'select',
				'default'        => $slide_count,
				'toggle_slug'    => 'carousel_settings',
				'sub_toggle'     => 'general',
				'mobile_options' => true,
				'options'        => array(
					'1' => esc_html__( '1', 'brain-divi-addons' ),
					'2' => esc_html__( '2', 'brain-divi-addons' ),
					'3' => esc_html__( '3', 'brain-divi-addons' ),
					'4' => esc_html__( '4', 'brain-divi-addons' ),
					'5' => esc_html__( '5', 'brain-divi-addons' ),
					'6' => esc_html__( '6', 'brain-divi-addons' ),
					'7' => esc_html__( '7', 'brain-divi-addons' ),
					'8' => esc_html__( '8', 'brain-divi-addons' ),
				),
				'show_if'        => array_merge( $show_if, array( 'is_variable_width' => 'off' ) ),
			),

			'slide_spacing'           => array(
				'label'          => esc_html__( 'Slide Spacing', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '10px',
				'fixed_unit'     => 'px',
				'toggle_slug'    => 'carousel_settings',
				'sub_toggle'     => 'general',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'show_if'        => $show_if,
			),

			'use_both_side_spacing'   => array(
				'label'           => esc_html__( 'Apply Spacing on First & Last Item', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'on',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'general',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'         => array_merge( $show_if, array( 'is_vertical' => 'off' ) ),

			),

			'is_infinite'             => array(
				'label'           => esc_html__( 'Infinite looping', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'on',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'general',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'         => $show_if,
			),

			'css_transition'          => array(
				'label'       => esc_html__( 'Sliding CSS Transition', 'brain-divi-addons' ),
				'type'        => 'select',
				'default'     => 'ease-in-out',
				'toggle_slug' => 'carousel_settings',
				'sub_toggle'  => 'advanced',
				'options'     => array(
					'linear'      => esc_html__( 'linear', 'brain-divi-addons' ),
					'ease-in'     => esc_html__( 'ease-in', 'brain-divi-addons' ),
					'ease-in-out' => esc_html__( 'ease-in-out', 'brain-divi-addons' ),
				),
				'show_if'     => $show_if,
			),

			'is_swipe'                => array(
				'label'           => esc_html__( 'Swipe', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'on',
				'mobile_options'  => true,
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'advanced',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'         => $show_if,
			),

			'slide_to_scroll'         => array(
				'label'           => esc_html__( 'Items to Scroll', 'brain-divi-addons' ),
				'type'            => 'range',
				'default'         => '1',
				'option_category' => 'basic_option',
				'unitless'        => true,
				'mobile_options'  => true,
				'range_settings'  => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 20,
				),
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'advanced',
				'show_if'         => $show_if,
			),

			'is_vertical'             => array(
				'label'           => esc_html__( 'Vertical Mode', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'advanced',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'         => $show_if,
			),

			'is_center'               => array(
				'label'           => esc_html__( 'Center Mode', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'advanced',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'         => $show_if,
			),

			'center_mode_type'        => array(
				'label'       => esc_html__( 'Center Mode Type', 'brain-divi-addons' ),
				'type'        => 'select',
				'default'     => 'classic',
				'toggle_slug' => 'carousel_settings',
				'sub_toggle'  => 'advanced',
				'options'     => array(
					'classic'     => esc_html__( 'Classic', 'brain-divi-addons' ),
					'highlighted' => esc_html__( 'Highlighted', 'brain-divi-addons' ),
				),

				'show_if'     => array_merge( $show_if, array( 'is_center' => 'on' ) ),
			),

			'center_padding'          => array(
				'label'          => esc_html__( 'Center Padding', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '70px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 400,
				),
				'mobile_options' => true,
				'toggle_slug'    => 'carousel_settings',
				'sub_toggle'     => 'advanced',
				'show_if'        => array_merge(
					$show_if,
					array(
						'is_center'         => 'on',
						'center_mode_type'  => 'classic',
						'is_variable_width' => 'off',
					)
				),
			),

			'wait_for_animate'        => array(
				'label'           => esc_html__( 'Wait For Animate', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'on',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'advanced',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'         => $show_if,
			),

			'custom_cursor'           => array(
				'label'           => esc_html__( 'Use Custom Cursor', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'advanced',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'         => $show_if,
			),

			'cursor_name'             => array(
				'label'       => esc_html__( 'Cursor Name', 'brain-divi-addons' ),
				'type'        => 'select',
				'default'     => 'css_default',
				'toggle_slug' => 'carousel_settings',
				'sub_toggle'  => 'advanced',
				'options'     => array(
					'css_default'   => esc_html__( 'Default', 'brain-divi-addons' ),
					'css_none'      => esc_html__( 'None', 'brain-divi-addons' ),
					'css_grab'      => esc_html__( 'Grab', 'brain-divi-addons' ),
					'css_pointer'   => esc_html__( 'Pointer', 'brain-divi-addons' ),
					'css_move'      => esc_html__( 'Move', 'brain-divi-addons' ),
					'custom_pizza'  => esc_html__( 'Pizza', 'brain-divi-addons' ),
					'custom_burger' => esc_html__( 'Burger', 'brain-divi-addons' ),
				),
				'show_if'     => array_merge( $show_if, array( 'custom_cursor' => 'on' ) ),
			),

			// Carousel style.
			'carousel_spacing_top'    => array(
				'label'          => esc_html__( 'Wrapper Spacing Top', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '50px',
				'fixed_unit'     => 'px',
				'toggle_slug'    => 'carousel_settings',
				'sub_toggle'     => 'advanced',
				'mobile_options' => true,
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 200,
				),
				'show_if'        => $show_if,
			),

			'carousel_spacing_bottom' => array(
				'label'          => esc_html__( 'Wrapper Spacing Bottom', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '50px',
				'fixed_unit'     => 'px',
				'toggle_slug'    => 'carousel_settings',
				'sub_toggle'     => 'advanced',
				'mobile_options' => true,
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 200,
				),
				'show_if'        => $show_if,
			),

			// Navigation
			'nav_type'                => array(
				'label'       => esc_html__( 'Type', 'brain-divi-addons' ),
				'type'        => 'select',
				'default'     => 'default',
				'toggle_slug' => 'nav',
				'tab_slug'    => 'advanced',
				'sub_toggle'  => 'nav_common',
				'options'     => array(
					'default'   => esc_html__( 'Type A', 'brain-divi-addons' ),
					'alongside' => esc_html__( 'Type B', 'brain-divi-addons' ),
				),
				'show_if'     => $show_if,
			),

			'nav_pos'                 => array(
				'label'       => esc_html__( 'Vertical Placement', 'brain-divi-addons' ),
				'type'        => 'select',
				'default'     => 'top',
				'toggle_slug' => 'nav',
				'tab_slug'    => 'advanced',
				'sub_toggle'  => 'nav_common',
				'options'     => array(
					'top'    => esc_html__( 'Top', 'brain-divi-addons' ),
					'bottom' => esc_html__( 'Bottom', 'brain-divi-addons' ),
				),
				'show_if'     => array_merge( $show_if, array( 'nav_type' => 'alongside' ) ),
			),

			'nav_pos_hz'              => array(
				'label'       => esc_html__( 'Horizontal Placement', 'brain-divi-addons' ),
				'type'        => 'select',
				'default'     => 'left',
				'toggle_slug' => 'nav',
				'tab_slug'    => 'advanced',
				'sub_toggle'  => 'nav_common',
				'options'     => array(
					'left'  => esc_html__( 'Left', 'brain-divi-addons' ),
					'right' => esc_html__( 'Right', 'brain-divi-addons' ),
				),
				'show_if'     => array_merge( $show_if, array( 'nav_type' => 'alongside' ) ),
			),

			'nav_height'              => array(
				'label'           => esc_html__( 'Height', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '40px',
				'fixed_unit'      => 'px',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_common',
				'mobile_options'  => true,
				'range_settings'  => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 200,
				),
				'show_if'         => $show_if,
			),

			'nav_width'               => array(
				'label'           => esc_html__( 'Width', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '40px',
				'fixed_unit'      => 'px',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_common',
				'mobile_options'  => true,
				'range_settings'  => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 200,
				),
				'show_if'         => $show_if,
			),

			'nav_icon_size'           => array(
				'label'           => esc_html__( 'Icon Size', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '30px',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_common',
				'mobile_options'  => true,
				'range_settings'  => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 200,
				),
				'show_if'         => $show_if,
			),

			'nav_color'               => array(
				'label'       => esc_html__( 'Icon Color', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'nav',
				'default'     => '#333',
				'sub_toggle'  => 'nav_common',
				'hover'       => 'tabs',
				'show_if'     => $show_if,
			),

			'nav_bg'                  => array(
				'label'       => esc_html__( 'Background', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'nav',
				'default'     => '#ddd',
				'sub_toggle'  => 'nav_common',
				'hover'       => 'tabs',
				'show_if'     => $show_if,
			),

			'nav_skew'                => array(
				'label'           => esc_html__( 'Skew', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '0deg',
				'fixed_unit'      => 'deg',
				'default_unit'    => 'deg',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_common',
				'range_settings'  => array(
					'min'  => -90,
					'max'  => 90,
					'step' => 1,
				),
				'show_if'         => $show_if,
			),

			'nav_gap'                 => array(
				'label'           => esc_html__( 'Spacing Between', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '10px',
				'default_unit'    => 'px',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_common',
				'mobile_options'  => true,
				'show_if'         => array_merge( $show_if, array( 'nav_type' => 'alongside' ) ),
				'range_settings'  => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
			),

			'nav_pos_y'               => array(
				'label'           => esc_html__( 'Vertical Position', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '50%',
				'mobile_options'  => true,
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_common',
				'range_settings'  => array(
					'min'  => -150,
					'max'  => 500,
					'step' => 1,
				),
				'show_if'         => $show_if,
			),

			'nav_x_center'            => array(
				'label'       => esc_html__( 'Use Horizontal Position Center', 'brain-divi-addons' ),
				'type'        => 'yes_no_button',
				'default'     => 'off',
				'toggle_slug' => 'nav',
				'tab_slug'    => 'advanced',
				'sub_toggle'  => 'nav_common',
				'options'     => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'     => array_merge( $show_if, array( 'nav_type' => 'alongside' ) ),
			),

			'nav_pos_x'               => array(
				'label'           => esc_html__( 'Horizontal Position', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'mobile_options'  => true,
				'default'         => '-15px',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_common',
				'range_settings'  => array(
					'min'  => -300,
					'max'  => 300,
					'step' => 1,
				),
				'show_if'         => $show_if,
				'show_if_not'     => array(
					'nav_x_center' => 'on',
				),
			),

			'nav_border_width'        => array(
				'label'           => esc_html__( 'Border Width', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '0px',
				'default_unit'    => 'px',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_common',
				'range_settings'  => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'show_if'         => $show_if,
			),

			'nav_border_color'        => array(
				'label'       => esc_html__( 'Border Color', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'default'     => '#333',
				'toggle_slug' => 'nav',
				'tab_slug'    => 'advanced',
				'sub_toggle'  => 'nav_common',
				'hover'       => 'tabs',
				'show_if'     => $show_if,
			),

			'nav_border_style'        => array(
				'label'       => esc_html__( 'Border Type', 'brain-divi-addons' ),
				'type'        => 'select',
				'default'     => 'solid',
				'toggle_slug' => 'nav',
				'tab_slug'    => 'advanced',
				'sub_toggle'  => 'nav_common',
				'options'     => array(
					'solid'  => esc_html__( 'Solid', 'brain-divi-addons' ),
					'dashed' => esc_html__( 'Dashed', 'brain-divi-addons' ),
					'dotted' => esc_html__( 'Dotted', 'brain-divi-addons' ),
					'double' => esc_html__( 'Double', 'brain-divi-addons' ),
					'groove' => esc_html__( 'Groove', 'brain-divi-addons' ),
					'ridge'  => esc_html__( 'Ridge', 'brain-divi-addons' ),
					'inset'  => esc_html__( 'Inset', 'brain-divi-addons' ),
					'outset' => esc_html__( 'Outset', 'brain-divi-addons' ),
					'none'   => esc_html__( 'None', 'brain-divi-addons' ),
				),
				'show_if'     => $show_if,
			),

			// Left Arrow
			'icon_left'               => array(
				'label'           => esc_html__( 'Left Icon', 'brain-divi-addons' ),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_left',
				'show_if'         => $show_if,
			),

			'left_border_radius'      => array(
				'label'       => esc_html__( 'Border Radius', 'brain-divi-addons' ),
				'type'        => 'border-radius',
				'default'     => 'on|40px|40px|40px|40px',
				'toggle_slug' => 'nav',
				'tab_slug'    => 'advanced',
				'sub_toggle'  => 'nav_left',
				'show_if'     => $show_if,
			),

			// Right Arrow
			'icon_right'              => array(
				'label'           => esc_html__( 'Right Icon', 'brain-divi-addons' ),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_right',
				'show_if'         => $show_if,
			),

			'right_border_radius'     => array(
				'label'       => esc_html__( 'Border Radius', 'brain-divi-addons' ),
				'type'        => 'border-radius',
				'default'     => 'on|40px|40px|40px|40px',
				'toggle_slug' => 'nav',
				'tab_slug'    => 'advanced',
				'sub_toggle'  => 'nav_right',
				'show_if'     => $show_if,
			),

			// pagination
			'pagi_type'               => array(
				'label'       => esc_html__( 'Type', 'brain-divi-addons' ),
				'type'        => 'select',
				'default'     => 'dot',
				'toggle_slug' => 'pagi',
				'sub_toggle'  => 'pagi_common',
				'tab_slug'    => 'advanced',
				'options'     => array(
					'dot'    => esc_html__( 'Dot', 'brain-divi-addons' ),
					'number' => esc_html__( 'Number', 'brain-divi-addons' ),
				),
				'show_if'     => $show_if,
			),

			'pagi_alignment'          => array(
				'label'            => esc_html__( 'Alignment', 'brain-divi-addons' ),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'     => 'module_align',
				'default_on_front' => 'center',
				'default'          => 'center',
				'toggle_slug'      => 'pagi',
				'sub_toggle'       => 'pagi_common',
				'tab_slug'         => 'advanced',
				'show_if'          => $show_if,
			),

			'pagi_color'              => array(
				'label'       => esc_html__( 'Text Color', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'pagi',
				'sub_toggle'  => 'pagi_common',
				'default'     => '#333333',
				'hover'       => 'tabs',
				'show_if'     => array_merge( $show_if, array( 'pagi_type' => 'number' ) ),
			),

			'pagi_text'               => array(
				'label'           => esc_html__( 'Text Size', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '18px',
				'toggle_slug'     => 'pagi',
				'sub_toggle'      => 'pagi_common',
				'tab_slug'        => 'advanced',
				'show_if'         => array_merge( $show_if, array( 'pagi_type' => 'number' ) ),
				'range_settings'  => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 50,
				),
			),

			'pagi_bg'                 => array(
				'label'       => esc_html__( 'Background', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'pagi',
				'sub_toggle'  => 'pagi_common',
				'default'     => '#dddddd',
				'hover'       => 'tabs',
				'show_if'     => $show_if,
			),

			'pagi_height'             => array(
				'label'           => esc_html__( 'Height', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '10px',
				'toggle_slug'     => 'pagi',
				'sub_toggle'      => 'pagi_common',
				'tab_slug'        => 'advanced',
				'range_settings'  => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 50,
				),
				'show_if'         => $show_if,
			),

			'pagi_width'              => array(
				'label'           => esc_html__( 'Width', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '10px',
				'toggle_slug'     => 'pagi',
				'sub_toggle'      => 'pagi_common',
				'tab_slug'        => 'advanced',
				'range_settings'  => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 50,
				),
				'show_if'         => $show_if,
			),

			'pagi_radius'             => array(
				'label'       => esc_html__( 'Border Radius', 'brain-divi-addons' ),
				'type'        => 'border-radius',
				'default'     => 'on|10px|10px|10px|10px',
				'toggle_slug' => 'pagi',
				'sub_toggle'  => 'pagi_common',
				'tab_slug'    => 'advanced',
				'show_if'     => $show_if,
			),

			'pagi_pos_y'              => array(
				'label'          => esc_html__( 'Vertical Position', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '10px',
				'toggle_slug'    => 'pagi',
				'sub_toggle'     => 'pagi_common',
				'tab_slug'       => 'advanced',
				'range_settings' => array(
					'min'  => -400,
					'max'  => 400,
					'step' => 1,
				),
				'show_if'        => $show_if,
			),

			'pagi_spacing'            => array(
				'label'          => esc_html__( 'Spacing', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '10px',
				'fixed_unit'     => 'px',
				'toggle_slug'    => 'pagi',
				'sub_toggle'     => 'pagi_common',
				'tab_slug'       => 'advanced',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'show_if'        => $show_if,
			),

			'pagi_bg_active'          => array(
				'label'       => esc_html__( 'Background', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'pagi',
				'sub_toggle'  => 'pagi_active',
				'show_if'     => $show_if,
			),

			'pagi_text_active'        => array(
				'label'       => esc_html__( 'Text Color', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'pagi',
				'sub_toggle'  => 'pagi_active',
				'show_if'     => $show_if,
			),

			'pagi_width_active'       => array(
				'label'          => esc_html__( 'Width', 'brain-divi-addons' ),
				'type'           => 'range',
				'fixed_unit'     => 'px',
				'toggle_slug'    => 'pagi',
				'sub_toggle'     => 'pagi_active',
				'tab_slug'       => 'advanced',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'show_if'        => $show_if,
			),

		);

		if ( in_array( 'lightbox', $supports, true ) ) {

			$aditional['use_lightbox'] = array(
				'label'           => esc_html__( 'Open Image in Lightbox', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'advanced',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'show_if'         => $show_if,
			);
		}

		if ( in_array( 'equal_height', $supports, true ) ) {

			$aditional['is_equal_height'] = array(
				'label'           => esc_html__( 'Equalize Item Height', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'Enable this to Equalize all Carousel items with same height.', 'brain-divi-addons' ),
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'on',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'general',
				'show_if'         => $show_if,
			);
		}

		return array_merge( $fields, $aditional );

	}

	protected function render_default_nav_css( $render_slug ) {

		$nav_pos_y                   = $this->props['nav_pos_y'];
		$nav_pos_y_tablet            = $this->props['nav_pos_y_tablet'];
		$nav_pos_y_phone             = $this->props['nav_pos_y_phone'];
		$nav_pos_y_last_edited       = $this->props['nav_pos_y_last_edited'];
		$nav_pos_y_responsive_status = et_pb_get_responsive_status( $nav_pos_y_last_edited );

		$nav_pos_x                   = $this->props['nav_pos_x'];
		$nav_pos_x_tablet            = $this->props['nav_pos_x_tablet'];
		$nav_pos_x_phone             = $this->props['nav_pos_x_phone'];
		$nav_pos_x_last_edited       = $this->props['nav_pos_x_last_edited'];
		$nav_pos_x_responsive_status = et_pb_get_responsive_status( $nav_pos_x_last_edited );

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .slick-arrow',
				'declaration' => sprintf( ' top: %1$s; ', $nav_pos_y ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .slick-next',
				'declaration' => sprintf( 'right: %1$s;', $nav_pos_x ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .slick-prev',
				'declaration' => sprintf( 'left: %1$s; ', $nav_pos_x ),
			)
		);

		if ( ! empty( $nav_pos_x_tablet ) && $nav_pos_x_responsive_status ) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-next',
					'declaration' => sprintf( 'right: %1$s;', $nav_pos_x_tablet ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-prev',
					'declaration' => sprintf( 'left: %1$s; ', $nav_pos_x_tablet ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
				)
			);
		endif;

		if ( ! empty( $nav_pos_x_phone ) && $nav_pos_x_responsive_status ) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-next',
					'declaration' => sprintf( 'right: %1$s;', $nav_pos_x_phone ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-prev',
					'declaration' => sprintf( 'left: %1$s; ', $nav_pos_x_phone ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
				)
			);
		endif;

		if ( ! empty( $nav_pos_y_tablet ) && $nav_pos_y_responsive_status ) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-arrow',
					'declaration' => sprintf( 'top: %1$s; ', $nav_pos_y_tablet ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
				)
			);
		endif;

		if ( ! empty( $nav_pos_y_phone ) && $nav_pos_y_responsive_status ) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-arrow',
					'declaration' => sprintf( 'top: %1$s; ', $nav_pos_y_phone ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
				)
			);
		endif;
	}

	protected function render_alongside_nav_css( $render_slug ) {

		$nav_pos                     = $this->props['nav_pos'];
		$nav_pos_hz                  = $this->props['nav_pos_hz'];
		$nav_pos_y                   = $this->props['nav_pos_y'];
		$nav_pos_y_tablet            = $this->props['nav_pos_y_tablet'];
		$nav_pos_y_phone             = $this->props['nav_pos_y_phone'];
		$nav_pos_y_last_edited       = $this->props['nav_pos_y_last_edited'];
		$nav_pos_y_responsive_status = et_pb_get_responsive_status( $nav_pos_y_last_edited );

		$nav_x_center                = $this->props['nav_x_center'];
		$nav_pos_x                   = $this->props['nav_pos_x'];
		$nav_pos_x_tablet            = $this->props['nav_pos_x_tablet'];
		$nav_pos_x_phone             = $this->props['nav_pos_x_phone'];
		$nav_pos_x_last_edited       = $this->props['nav_pos_x_last_edited'];
		$nav_pos_x_responsive_status = et_pb_get_responsive_status( $nav_pos_x_last_edited );

		$nav_width        = $this->props['nav_width'];
		$nav_width_tablet = $this->props['nav_width_tablet'] ? $this->props['nav_width_tablet'] : $nav_width;
		$nav_width_phone  = $this->props['nav_width_phone'] ? $this->props['nav_width_phone'] : $nav_width_tablet;

		$nav_gap        = $this->props['nav_gap'];
		$nav_gap_tablet = $this->props['nav_gap_tablet'] ? $this->props['nav_gap_tablet'] : $nav_gap;
		$nav_gap_phone  = $this->props['nav_gap_phone'] ? $this->props['nav_gap_phone'] : $nav_gap_tablet;

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .slick-arrow',
				'declaration' => sprintf( ' top: auto; %1$s: %2$s;', $nav_pos, $nav_pos_y ),
			)
		);

		if ( $nav_x_center === 'on' ) {

			// desktop
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-next',
					'declaration' => sprintf( 'right: calc(50%% - %1$spx);', intval( $nav_width ) + ( intval( $nav_gap ) / 2 ) ),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-prev',
					'declaration' => sprintf( 'left: calc(50%% - %1$spx);', intval( $nav_width ) + ( intval( $nav_gap ) / 2 ) ),
				)
			);

			// tablet
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-next',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'right: calc(50%% - %1$spx);', intval( $nav_width_tablet ) + ( intval( $nav_gap_tablet ) / 2 ) ),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-prev',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'left: calc(50%% - %1$spx);', intval( $nav_width_tablet ) + ( intval( $nav_gap_tablet ) / 2 ) ),
				)
			);

			// phone
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-next',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'right: calc(50%% - %1$spx);', intval( $nav_width_phone ) + ( intval( $nav_gap_phone ) / 2 ) ),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-prev',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'left: calc(50%% - %1$spx);', intval( $nav_width_phone ) + ( intval( $nav_gap_phone ) / 2 ) ),
				)
			);

		} else {

			// position X
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-next',
					'declaration' => sprintf( ' %2$s: %1$s; ', $nav_pos_x, $nav_pos_hz ),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-prev',
					'declaration' => sprintf( ' left: auto; %2$s: %1$s; ', $nav_pos_x, $nav_pos_hz ),
				)
			);

			// position X tablet
			if ( ! empty( $nav_pos_x_tablet ) && $nav_pos_x_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .slick-next',
						'declaration' => sprintf( ' %2$s: %1$s; ', $nav_pos_x_tablet, $nav_pos_hz ),
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					)
				);

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .slick-prev',
						'declaration' => sprintf( 'left: auto; %2$s: %1$s;', $nav_pos_x_tablet, $nav_pos_hz ),
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					)
				);
			}

			// position X phone
			if ( ! empty( $nav_pos_x_phone ) && $nav_pos_x_responsive_status ) {

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .slick-next',
						'declaration' => sprintf( ' %2$s: %1$s; ', $nav_pos_x_phone, $nav_pos_hz ),
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					)
				);

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .slick-prev',
						'declaration' => sprintf( 'left: auto; %2$s: %1$s;', $nav_pos_x_phone, $nav_pos_hz ),
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					)
				);
			}

			// arrow gap
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-prev',
					'declaration' => sprintf( 'margin-%3$s: calc(%1$s + %2$s);', $nav_width, $nav_gap, $nav_pos_hz ),
				)
			);

			// arrow gap tablet
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-prev',
					'declaration' => sprintf( 'margin-%3$s: calc(%1$s + %2$s);', $nav_width_tablet, $nav_gap_tablet, $nav_pos_hz ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
				)
			);

			// arrow gap phone
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-prev',
					'declaration' => sprintf( ' margin-%3$s: calc(%1$s + %2$s); ', $nav_width_phone, $nav_gap_phone, $nav_pos_hz ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
				)
			);

		}

		// position Y tablet
		if ( ! empty( $nav_pos_y_tablet ) && $nav_pos_y_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-arrow',
					'declaration' => sprintf( 'top: auto; %1$s: %2$s; ', $nav_pos, $nav_pos_y_tablet ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
				)
			);
		}

		// position Y phone
		if ( ! empty( $nav_pos_y_phone ) && $nav_pos_y_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-arrow',
					'declaration' => sprintf( 'top: auto; %1$s: %2$s;', $nav_pos, $nav_pos_y_phone ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
				)
			);
		}

	}

	protected function render_pagination_css( $render_slug ) {

		$pagi_type         = $this->props['pagi_type'];
		$pagi_text         = $this->props['pagi_text'];
		$pagi_color        = $this->props['pagi_color'];
		$pagi_color_hover  = $this->get_hover_value( 'pagi_color' );
		$pagi_bg           = $this->props['pagi_bg'];
		$pagi_bg_hover     = $this->get_hover_value( 'pagi_bg' );
		$pagi_bg_active    = $this->props['pagi_bg_active'];
		$pagi_alignment    = $this->props['pagi_alignment'];
		$pagi_pos_y        = $this->props['pagi_pos_y'];
		$pagi_spacing      = $this->props['pagi_spacing'];
		$pagi_height       = $this->props['pagi_height'];
		$pagi_width        = $this->props['pagi_width'];
		$pagi_width_active = $this->props['pagi_width_active'];
		$pagi_text_active  = $this->props['pagi_text_active'];
		$pagi_radius       = explode( '|', $this->props['pagi_radius'] );

		if ( $pagi_type === 'dot' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-dots li button',
					'declaration' => 'font-size: 0!important;',
				)
			);
		} elseif ( $pagi_type === 'number' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-dots li button',
					'declaration' => "font-size: {$pagi_text}!important; color: {$pagi_color}!important;",
				)
			);

			if ( ! empty( $pagi_color_hover ) ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-carousel .slick-dots li:hover button',
						'declaration' => "color: {$pagi_color_hover}!important;",
					)
				);
			}
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-carousel .slick-dots',
				'declaration' => sprintf( ' text-align: %1$s; transform: translateY(%2$s); ', $pagi_alignment, $pagi_pos_y ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-carousel .slick-dots li',
				'declaration' => sprintf( ' margin: 0 %1$s;', $pagi_spacing ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-carousel .slick-dots li button',
				'declaration' => sprintf(
					' background: %1$s; height: %2$s; width: %3$s; border-radius: %4$s %5$s %6$s %7$s;',
					$pagi_bg,
					$pagi_height,
					$pagi_width,
					$pagi_radius[1],
					$pagi_radius[2],
					$pagi_radius[3],
					$pagi_radius[4]
				),
			)
		);

		if ( ! empty( $pagi_bg_hover ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-dots li:hover button',
					'declaration' => sprintf( ' background: %1$s;', $pagi_bg_hover ),
				)
			);
		}

		if ( ! empty( $pagi_bg_active ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-dots li.slick-active button',
					'declaration' => sprintf( 'background: %1$s;', $pagi_bg_active ),
				)
			);
		}

		if ( ! empty( $pagi_width_active ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-dots li.slick-active button',
					'declaration' => sprintf( 'width: %1$s;', $pagi_width_active ),
				)
			);
		}

		if ( ! empty( $pagi_text_active ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-dots li.slick-active button',
					'declaration' => sprintf( 'color: %1$s;', $pagi_text_active ),
				)
			);
		}

	}

	protected function render_carousel_css( $render_slug ) {

		$nav_height                                = $this->props['nav_height'];
		$nav_height_tablet                         = $this->props['nav_height_tablet'];
		$nav_height_phone                          = $this->props['nav_height_phone'];
		$nav_height_last_edited                    = $this->props['nav_height_last_edited'];
		$nav_height_responsive_status              = et_pb_get_responsive_status( $nav_height_last_edited );
		$nav_width                                 = $this->props['nav_width'];
		$nav_width_tablet                          = $this->props['nav_width_tablet'] ? $this->props['nav_width_tablet'] : $nav_width;
		$nav_width_phone                           = $this->props['nav_width_phone'] ? $this->props['nav_width_phone'] : $nav_width_tablet;
		$nav_width_last_edited                     = $this->props['nav_width_last_edited'];
		$nav_width_responsive_status               = et_pb_get_responsive_status( $nav_width_last_edited );
		$nav_border_width                          = $this->props['nav_border_width'];
		$nav_border_style                          = $this->props['nav_border_style'];
		$nav_border_color                          = $this->props['nav_border_color'];
		$nav_border_color_hover                    = $this->get_hover_value( 'nav_border_color' );
		$nav_color                                 = $this->props['nav_color'];
		$nav_bg                                    = $this->props['nav_bg'];
		$nav_skew                                  = $this->props['nav_skew'];
		$nav_color_hover                           = $this->get_hover_value( 'nav_color' );
		$nav_bg_hover                              = $this->get_hover_value( 'nav_bg' );
		$nav_icon_size_tablet                      = $this->props['nav_icon_size_tablet'];
		$nav_icon_size_phone                       = $this->props['nav_icon_size_phone'];
		$nav_icon_size_last_edited                 = $this->props['nav_icon_size_last_edited'];
		$nav_icon_size_responsive_status           = et_pb_get_responsive_status( $nav_icon_size_last_edited );
		$nav_icon_size                             = $this->props['nav_icon_size'];
		$right_border_radius                       = explode( '|', $this->props['right_border_radius'] );
		$left_border_radius                        = explode( '|', $this->props['left_border_radius'] );
		$slide_spacing                             = $this->props['slide_spacing'];
		$use_both_side_spacing                     = $this->props['use_both_side_spacing'];
		$custom_cursor                             = $this->props['custom_cursor'];
		$cursor_name                               = $this->props['cursor_name'];
		$is_variable_width                         = $this->props['is_variable_width'];
		$slide_width                               = $this->props['slide_width'];
		$slide_width_tablet                        = $this->props['slide_width_tablet'];
		$slide_width_phone                         = $this->props['slide_width_phone'];
		$slide_width_last_edited                   = $this->props['slide_width_last_edited'];
		$slide_width_responsive_status             = et_pb_get_responsive_status( $slide_width_last_edited );
		$is_vertical                               = $this->props['is_vertical'];
		$nav_type                                  = $this->props['nav_type'];
		$int_skew                                  = intval( $this->props['nav_skew'] );
		$nav_skew_inner                            = $int_skew < 0 ? abs( $int_skew ) : '-' . abs( $int_skew );
		$carousel_spacing_top                      = $this->props['carousel_spacing_top'];
		$carousel_spacing_top_tablet               = $this->props['carousel_spacing_top_tablet'];
		$carousel_spacing_top_phone                = $this->props['carousel_spacing_top_phone'];
		$carousel_spacing_top_last_edited          = $this->props['carousel_spacing_top_last_edited'];
		$carousel_spacing_top_responsive_status    = et_pb_get_responsive_status( $carousel_spacing_top_last_edited );
		$animation_speed                           = $this->props['animation_speed'];
		$carousel_spacing_bottom                   = $this->props['carousel_spacing_bottom'];
		$carousel_spacing_bottom_tablet            = $this->props['carousel_spacing_bottom_tablet'];
		$carousel_spacing_bottom_phone             = $this->props['carousel_spacing_bottom_phone'];
		$carousel_spacing_bottom_last_edited       = $this->props['carousel_spacing_bottom_last_edited'];
		$carousel_spacing_bottom_responsive_status = et_pb_get_responsive_status( $carousel_spacing_bottom_last_edited );

		$data_cursor = array(
			'pizza'  => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgBAMAAACBVGfHAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAIVBMVEUAAAAAAAD/////zGb/mTOZAAAAzAD/zDP/AAD/Zmb/mZm5WRymAAAAAXRSTlMAQObYZgAAAAFiS0dEAmYLfGQAAAAJcEhZcwAAAMgAAADIAGP6560AAAAHdElNRQfkBRkTCRh4PlpnAAAA8ElEQVQoz12QsbnDIAyExQaWQ0ySztngfW8BMgIFA3gEVardEXfu3KbzmJEgTrCvEfo5wQEgABjMakDVNgZP/1l/GbX9p81ISHuvgJL23tfgIUAs5VCxWgWyjKoQ8GRlpO2lwXOM3TkG9IACAkoTg7pKKsc6hWKzGg1ZhVKohHVMGUkhr8Bw57Kjc5RfA0626Jmk2A9g7m7LNDL6AsRNlynNNJQezOL4ktK4TQDcRr5OMtJswMxMaXXkv2BkJ3kJvkIamAb7A441mv8Bo+9AqIR8fdoadJjWpgaGltnvwfqCnXB/hH6kPwCCg+wRbJe+ATasSMvHEwtpAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIwLTA1LTI1VDE5OjA5OjIzKzAwOjAwCTF7LQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMC0wNS0yNVQxOTowOTowNiswMDowMGhx60sAAAAASUVORK5CYII=',
			'burger' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAfBAMAAADtgAsKAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAALVBMVEUAAAAAAAD////MZgBmMwCZMwD/zDP/mQD/zAB4eHhGRkbc3NygoKDIyMhmAAAKaD9VAAAAAXRSTlMAQObYZgAAAAFiS0dEAmYLfGQAAAAJcEhZcwAAAMgAAADIAGP6560AAAAHdElNRQfkBRkTGhFgDaNRAAAAEGNhTnYAAAAgAAAAIAAAAAAAAAAAYrnu+gAAATdJREFUKM9lkbFOwzAQhl2lM4qrLLW68AYgG2VtlIu6sVTxCzCwA5XzACCydmyUpWNNl670CVLyBkxImXkG7i6oSOFXlv+7/85nR4RiIDkEk2FkcvkPUCSA9DyDvMlyDVc9CKmca9Q5FMAS7c2dNr/ELNmiDHcFmdaWPms1R0zOVa1j98gRwCp1xKt7R4A60FlnnXugnnGK3pFs8doDi92OAiVPHWd4JvmyLDWBEa0Vk33Bydd4l4j3cCs63ExDIbfAq7OSdwQ7GQHkdD0jpwqBqrYSSImsP99CMVLN2kvS7ORnByEupG/aTdWu1/VOHSMEX1Ltvd+3zWnzcQAEt1IqX3tfHb2MDIKuS3iEwtkLTIhvMMAkguJpLiiSaj52UZTAb9oBb+ncM8z7Vx4DvwnA3+/jlr78AzvMazraOl3vAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIwLTA1LTI1VDE5OjI2OjE2KzAwOjAwfOGxJQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMC0wNS0yNVQxOToyNjoxNiswMDowMA28CZkAAAAASUVORK5CYII=',
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-centered--highlighted .slick-slide',
				'declaration' => sprintf( 'transition: transform %1$s;', $animation_speed ),
			)
		);

		// Custom Cursor
		if ( $custom_cursor === 'on' ) {
			$cursor_type = explode( '_', $cursor_name )[0];
			$cursor_icon = explode( '_', $cursor_name )[1];

			if ( $cursor_type === 'css' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%%',
						'declaration' => sprintf( 'cursor: %1$s!important;', $cursor_icon ),
					)
				);
			} elseif ( $cursor_type === 'custom' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%%',
						'declaration' => "cursor: url('{$data_cursor[$cursor_icon]}'), auto!important;",
					)
				);
			}
		}

		// Carousel Spacing Top - Bottom.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-carousel .slick-track',
				'declaration' => sprintf( 'padding-top: %1$s; padding-bottom: %2$s;', $carousel_spacing_top, $carousel_spacing_bottom ),
			)
		);

		// Carousel Spacing Top Tablet.
		if ( $carousel_spacing_top_tablet && $carousel_spacing_top_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-track',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'padding-top: %1$s;', $carousel_spacing_top_tablet ),
				)
			);
		}

		// Carousel Spacing Top Phone.
		if ( $carousel_spacing_top_phone && $carousel_spacing_top_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-track',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'padding-top: %1$s;', $carousel_spacing_top_phone ),
				)
			);
		}

		// Carousel Spacing Bottom Tablet.
		if ( $carousel_spacing_bottom_tablet && $carousel_spacing_bottom_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-track',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'padding-bottom: %1$s;', $carousel_spacing_bottom_tablet ),
				)
			);
		}

		// Carousel Spacing Bottom Phone.
		if ( $carousel_spacing_bottom_phone && $carousel_spacing_bottom_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-track',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'padding-bottom: %1$s;', $carousel_spacing_bottom_phone ),
				)
			);
		}

		// Slide  Width.
		if ( 'on' === $is_variable_width ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-slide',
					'declaration' => sprintf( 'width: %1$s;', $slide_width ),
				)
			);

			// Slide  Width Tablet.
			if ( ! empty( $slide_width_tablet ) && $slide_width_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-carousel .slick-slide',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
						'declaration' => sprintf( 'width: %1$s;', $slide_width_tablet ),
					)
				);
			}

			// Slide  Width Phone.
			if ( ! empty( $slide_width_phone ) && $slide_width_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-carousel .slick-slide',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
						'declaration' => sprintf( 'width: %1$s;', $slide_width_phone ),
					)
				);
			}
		}

		// Slide Spacing.
		if ( 'off' === $is_vertical ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-slide, .et-db #et-boc %%order_class%% .ba-carousel .slick-slide',
					'declaration' => sprintf( ' padding-left: %1$s!important; padding-right: %1$s!important;', $slide_spacing ),
				)
			);

			if ( 'off' === $use_both_side_spacing ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-carousel .slick-list, .et-db #et-boc %%order_class%% .ba-carousel .slick-list',
						'declaration' => sprintf( ' margin-left: -%1$s!important; margin-right: -%1$s!important;', $slide_spacing ),
					)
				);
			}
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-slide, .et-db #et-boc %%order_class%% .ba-carousel .slick-slide',
					'declaration' => sprintf( ' padding-top: %1$s!important; padding-bottom: %1$s!important;', $slide_spacing ),
				)
			);
		}

		// Arrow.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-carousel .slick-arrow',
				'declaration' => sprintf(
					'height: %1$s; width: %2$s; color: %3$s; background: %4$s; border: %5$s %6$s %7$s; transform: skew(%8$s);margin-top:-%9$spx;',
					$nav_height,
					$nav_width,
					$nav_color,
					$nav_bg,
					$nav_border_width,
					$nav_border_style,
					$nav_border_color,
					$nav_skew,
					(int) $nav_height / 2
				),
			)
		);

		// Arrow hover.
		if ( $nav_color_hover ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-arrow:hover',
					'declaration' => sprintf( 'color: %1$s;', $nav_color_hover ),
				)
			);
		}

		if ( $nav_bg_hover ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-arrow:hover',
					'declaration' => sprintf( 'background: %1$s;', $nav_bg_hover ),
				)
			);
		}

		if ( $nav_border_color_hover ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-arrow:hover',
					'declaration' => sprintf( 'border-color: %1$s;', $nav_border_color_hover ),
				)
			);
		}

		// Arrow Responsive Height.
		if ( ! empty( $nav_height_tablet ) && $nav_height_responsive_status ) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-arrow',
					'declaration' => sprintf( 'height: %1$s; ', $nav_height_tablet ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
				)
			);
		endif;

		if ( ! empty( $nav_height_phone ) && $nav_height_responsive_status ) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-arrow',
					'declaration' => sprintf( 'height: %1$s; ', $nav_height_phone ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
				)
			);
		endif;

		// Arrow Responsive Width.
		if ( ! empty( $nav_width_tablet ) && $nav_width_responsive_status ) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-arrow',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( ' width: %1$s; ', $nav_width_tablet ),
				)
			);
		endif;

		if ( ! empty( $nav_width_phone ) && $nav_width_responsive_status ) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-arrow',
					'declaration' => sprintf( 'width: %1$s; ', $nav_width_phone ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
				)
			);
		endif;

		// Arrow Icon
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-carousel .slick-arrow:before',
				'declaration' => sprintf(
					'font-size: %1$s; transform: skew(%2$sdeg); display: inline-block;',
					$nav_icon_size,
					$nav_skew_inner
				),
			)
		);

		// Arrow Icon Responsive
		if ( ! empty( $nav_icon_size_tablet ) && $nav_icon_size_responsive_status ) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-arrow:before',
					'declaration' => sprintf( ' font-size: %1$s; ', $nav_icon_size_tablet ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
				)
			);
		endif;

		if ( ! empty( $nav_icon_size_phone ) && $nav_icon_size_responsive_status ) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-carousel .slick-arrow:before',
					'declaration' => sprintf( ' font-size: %1$s; ', $nav_icon_size_phone ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
				)
			);
		endif;

		// Arrow Border Radius
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-carousel .slick-next',
				'declaration' => sprintf(
					'border-radius: %1$s %2$s %3$s %4$s;',
					$right_border_radius[1],
					$right_border_radius[2],
					$right_border_radius[3],
					$right_border_radius[4]
				),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-carousel .slick-prev',
				'declaration' => sprintf(
					'border-radius: %1$s %2$s %3$s %4$s;',
					$left_border_radius[1],
					$left_border_radius[2],
					$left_border_radius[3],
					$left_border_radius[4]
				),
			)
		);

		// Array Type
		if ( $nav_type === 'default' ) {

			$this->render_default_nav_css( $render_slug );

		} elseif ( $nav_type === 'alongside' ) {

			$this->render_alongside_nav_css( $render_slug );

		}

		// Carousel Pagination : Dots
		$this->render_pagination_css( $render_slug );
	}

	protected function get_carousel_options_data() {

		$is_autoplay            = $this->props['is_autoplay'];
		$css_transition         = $this->props['css_transition'];
		$autoplay_speed         = $this->props['autoplay_speed'];
		$animation_speed        = $this->props['animation_speed'];
		$is_center              = $this->props['is_center'];
		$center_mode_type       = $this->props['center_mode_type'];
		$is_vertical            = $this->props['is_vertical'];
		$is_infinite            = $this->props['is_infinite'];
		$icon_left              = esc_html( et_pb_process_font_icon( $this->props['icon_left'] ) );
		$icon_left              = ! empty( $icon_left ) ? $icon_left : '4';
		$icon_right             = esc_html( et_pb_process_font_icon( $this->props['icon_right'] ) );
		$icon_right             = ! empty( $icon_right ) ? $icon_right : '5';
		$is_variable_width      = $this->props['is_variable_width'];
		$wait_for_animate       = $this->props['wait_for_animate'];
		$center_padding         = $this->props['center_padding'];
		$center_padding_tablet  = $this->props['center_padding_tablet'];
		$center_padding_phone   = $this->props['center_padding_phone'];
		$slide_count            = $this->props['slide_count'];
		$slide_count_tablet     = $this->props['slide_count_tablet'];
		$slide_count_phone      = $this->props['slide_count_phone'];
		$is_nav                 = $this->props['use_nav'];
		$is_nav_tablet          = $this->props['use_nav_tablet'];
		$is_nav_phone           = $this->props['use_nav_phone'];
		$is_pagi                = $this->props['use_pagi'];
		$is_pagi_tablet         = $this->props['use_pagi_tablet'];
		$is_pagi_phone          = $this->props['use_pagi_phone'];
		$is_swipe               = $this->props['is_swipe'];
		$is_swipe_tablet        = $this->props['is_swipe_tablet'];
		$is_swipe_phone         = $this->props['is_swipe_phone'];
		$slide_to_scroll        = $this->props['slide_to_scroll'];
		$slide_to_scroll_tablet = $this->props['slide_to_scroll_tablet'];
		$slide_to_scroll_phone  = $this->props['slide_to_scroll_phone'];

		if ( $is_variable_width === 'on' ) {
			$slide_count = 1;
		}

		$settings                   = array();
		$settings['responsive']     = array();
		$tablet                     = array();
		$phone                      = array();
		$settings['cssEase']        = $css_transition;
		$settings['swipe']          = $is_swipe === 'on' ? true : false;
		$settings['variableWidth']  = $is_variable_width === 'on' ? true : false;
		$settings['dots']           = $is_pagi === 'on' ? true : false;
		$settings['arrows']         = $is_nav === 'on' ? true : false;
		$settings['infinite']       = $is_infinite === 'on' ? true : false;
		$settings['autoplay']       = $is_autoplay === 'on' ? true : false;
		$settings['autoplaySpeed']  = intval( $autoplay_speed );
		$settings['speed']          = intval( $animation_speed );
		$settings['slidesToShow']   = intval( $slide_count );
		$settings['slidesToScroll'] = intval( $slide_to_scroll );
		$settings['centerPadding']  = ( $is_variable_width === 'off' && $center_mode_type === 'classic' ) ? $center_padding : 0;
		$settings['centerMode']     = $is_center === 'on' ? true : false;
		$settings['vertical']       = $is_vertical === 'on' ? true : false;
		$settings['prevArrow']      = '<button type="button" data-icon="' . $icon_left . '" class="slick-arrow slick-prev">Prev</button>';
		$settings['nextArrow']      = '<button type="button" data-icon="' . $icon_right . '" class="slick-arrow slick-next">Prev</button>';

		if ( $wait_for_animate === 'off' ) {
			$settings['waitForAnimate'] = false;
		}

		// Responsive break point 980
		$tablet['breakpoint'] = 980;

		if ( 'off' === $is_variable_width && ! empty( $slide_count_tablet ) ) {
			$tablet['settings']['slidesToShow'] = intval( $slide_count_tablet );
		}

		if ( ! empty( $slide_to_scroll_tablet ) ) {
			$tablet['settings']['slidesToScroll'] = intval( $slide_to_scroll_tablet );
		}

		if ( ! empty( $is_pagi_tablet ) ) {
			$tablet['settings']['dots'] = 'on' === $is_pagi_tablet ? true : false;
		}

		if ( ! empty( $is_nav_tablet ) ) {
			$tablet['settings']['arrows'] = 'on' === $is_nav_tablet ? true : false;
		}

		if ( ! empty( $is_swipe_tablet ) ) {
			$tablet['settings']['swipe'] = 'on' === $is_swipe_tablet ? true : false;
		}

		if ( 'off' === $is_variable_width && 'classic' === $center_mode_type && ! empty( $center_padding_tablet ) ) {
			$tablet['settings']['centerPadding'] = $center_padding_tablet;
		}

		array_push( $settings['responsive'], $tablet );

		// Responsive break point 767.
		$phone['breakpoint'] = 767;

		if ( 'off' === $is_variable_width && ! empty( $slide_count_phone ) ) {
			$phone['settings']['slidesToShow'] = intval( $slide_count_phone );
		}

		if ( ! empty( $slide_to_scroll_phone ) ) {
			$phone['settings']['slidesToScroll'] = intval( $slide_to_scroll_phone );
		}

		if ( ! empty( $is_pagi_phone ) ) {
			$phone['settings']['dots'] = 'on' === $is_pagi_phone ? true : false;
		}

		if ( ! empty( $is_nav_phone ) ) {
			$phone['settings']['arrows'] = 'on' === $is_nav_phone ? true : false;
		}

		if ( ! empty( $is_swipe_phone ) ) {
			$phone['settings']['swipe'] = 'on' === $is_swipe_phone ? true : false;
		}

		if ( 'off' === $is_variable_width && 'classic' === $center_mode_type && ! empty( $center_padding_phone ) ) {
			$phone['settings']['centerPadding'] = $center_padding_phone;
		}
		array_push( $settings['responsive'], $phone );

		$carousel_options = sprintf( 'data-settings="%1$s"', htmlspecialchars( wp_json_encode( $settings ), ENT_QUOTES, 'UTF-8' ) );

		return $carousel_options;
	}


	protected function get_buttons_styles( $prefix, $render_slug, $selector ) {

		$custom_padding                   = $this->props[ "{$prefix}_custom_padding" ];
		$custom_padding_tablet            = $this->props[ "{$prefix}_custom_padding_tablet" ];
		$custom_padding_phone             = $this->props[ "{$prefix}_custom_padding_phone" ];
		$custom_padding_hover             = $this->get_hover_value( "{$prefix}_custom_padding" );
		$custom_padding_last_edited       = $this->props[ "{$prefix}_custom_padding_last_edited" ];
		$custom_padding_responsive_status = et_pb_get_responsive_status( $custom_padding_last_edited );
		$icon_placement                   = isset( $this->props[ "{$prefix}_icon_placement" ] ) ? $this->props[ "{$prefix}_icon_placement" ] : '';
		$use_icon                         = isset( $this->props[ "{$prefix}_use_icon" ] ) ? $this->props[ "{$prefix}_use_icon" ] : '';
		$is_custom                        = $this->props[ "custom_{$prefix}" ];

		if ( 'on' === $is_custom ) {
			if ( ! empty( $custom_padding ) ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => "body #page-container {$selector}, .et-db #et-boc {$selector}",
						'declaration' => $this->process_margin_padding( $custom_padding, 'padding', true ),
					)
				);
			}

			if ( ! empty( $custom_padding_hover ) ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => "body #page-container {$selector}:hover, .et-db #et-boc {$selector}:hover",
						'declaration' => $this->process_margin_padding( $custom_padding_hover, 'padding', true ),
					)
				);
			} else {
				if ( ! empty( $custom_padding ) ) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => "body #page-container {$selector}:hover, .et-db #et-boc {$selector}:hover",
							'declaration' => $this->process_margin_padding( $custom_padding, 'padding', true ),
						)
					);
				}
			}

			if ( ! empty( $custom_padding_tablet ) && $custom_padding_responsive_status ) :
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => "body #page-container {$selector}, .et-db #et-boc {$selector}",
						'declaration' => $this->process_margin_padding( $custom_padding_tablet, 'padding', true ),
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					)
				);
			endif;

			if ( ! empty( $custom_padding_phone ) && $custom_padding_responsive_status ) :
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => "body #page-container {$selector}, .et-db #et-boc {$selector}",
						'declaration' => $this->process_margin_padding( $custom_padding_phone, 'padding', true ),
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					)
				);
			endif;

			if ( 'on' === $use_icon && 'right' === $icon_placement ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => "body #page-container {$selector}:after, .et-db #et-boc {$selector}:after",
						'declaration' => '
                        display: inline-block;
                        content: attr(data-icon)!important;
                        font-family: "ETmodules"!important;',
					)
				);
			}
		}
	}

	protected function get_image_hover_animations() {
		return array(
			'none'        => esc_html__( 'None', 'brain-divi-addons' ),
			'zoom-in'     => esc_html__( 'Zoom In', 'brain-divi-addons' ),
			'zoom-out'    => esc_html__( 'Zoom Out', 'brain-divi-addons' ),
			'pulse'       => esc_html__( 'Pulse', 'brain-divi-addons' ),
			'bounce'      => esc_html__( 'Bounce', 'brain-divi-addons' ),
			'flash'       => esc_html__( 'Flash', 'brain-divi-addons' ),
			'rubberBand'  => esc_html__( 'Rubber Band', 'brain-divi-addons' ),
			'shake'       => esc_html__( 'Shake', 'brain-divi-addons' ),
			'swing'       => esc_html__( 'Swing', 'brain-divi-addons' ),
			'tada'        => esc_html__( 'Tada', 'brain-divi-addons' ),
			'wobble'      => esc_html__( 'Wobble', 'brain-divi-addons' ),
			'jello'       => esc_html__( 'Jello', 'brain-divi-addons' ),
			'heartBeat'   => esc_html__( 'Heart Beat', 'brain-divi-addons' ),
			'bounceIn'    => esc_html__( 'Bounce In', 'brain-divi-addons' ),
			'fadeIn'      => esc_html__( 'Fade In', 'brain-divi-addons' ),
			'flip'        => esc_html__( 'Flip', 'brain-divi-addons' ),
			'rotateIn'    => esc_html__( 'Rotate In', 'brain-divi-addons' ),
			'slideInUp'   => esc_html__( 'Slide In Up', 'brain-divi-addons' ),
			'slideInDown' => esc_html__( 'Slide In Down', 'brain-divi-addons' ),
		);
	}
}
