<?php
class BA_Advanced_Divider extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/demo/advanced-divider/',
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
					'text'      => esc_html__( 'Text', 'brain-divi-addons' ),
					'icon'      => esc_html__( 'Icon/Image', 'brain-divi-addons' ),
					'text_mask' => esc_html__( 'Mask', 'brain-divi-addons' ),
				),
			),
		);
	}

	public function get_fields() {

		$fields = array(
			'active_element'    => array(
				'label'       => esc_html__( 'Choose an Element', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'main_content',
				'default'     => 'text',
				'options'     => array(
					'text'  => esc_html__( 'Text', 'brain-divi-addons' ),
					'icon'  => esc_html__( 'Icon', 'brain-divi-addons' ),
					'image' => esc_html__( 'Image', 'brain-divi-addons' ),
				),
			),
			'img_url'           => array(
				'label'              => esc_html__( 'Upload Image', 'brain-divi-addons' ),
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
			'title'             => array(
				'label'           => esc_html__( 'Divider Text', 'brain-divi-addons' ),
				'type'            => 'text',
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'text',
				'show_if'         => array(
					'active_element' => 'text',
				),
			),
			'icon'              => array(
				'label'           => esc_html__( 'Select Icon', 'brain-divi-addons' ),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'main_content',
				'show_if'         => array(
					'active_element' => 'icon',
				),
			),
			'use_mask'          => array(
				'label'           => esc_html__( 'Use Text Mask', 'brain-divi-addons' ),
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
			'mask_url'          => array(
				'label'              => esc_html__( 'Upload Mask Image', 'brain-divi-addons' ),
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
			// Divider.
			'content_alignment' => array(
				'label'           => esc_html__( 'Content Alignment', 'brain-divi-addons' ),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'    => 'module_align',
				'default'         => 'left',
				'toggle_slug'     => 'divider',
				'tab_slug'        => 'advanced',
			),
			'use_shape'         => array(
				'label'           => esc_html__( 'Use Bottom Shape', 'brain-divi-addons' ),
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
				'type'           => 'range',
				'default'        => '280px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
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
				'type'           => 'custom_margin',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'divider',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
				'show_if'        => array(
					'use_shape' => 'on',
				),
			),
			'type'              => array(
				'label'       => esc_html__( 'Border Type', 'brain-divi-addons' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'divider',
				'default'     => 'solid_border',
				'options'     => array(
					'none_all'       => esc_html__( 'None', 'brain-divi-addons' ),
					'solid_border'   => esc_html__( 'Solid', 'brain-divi-addons' ),
					'double_border'  => esc_html__( 'Double', 'brain-divi-addons' ),
					'dotted_border'  => esc_html__( 'Dotted', 'brain-divi-addons' ),
					'dashed_border'  => esc_html__( 'Dashed', 'brain-divi-addons' ),
					'curved_pattern' => esc_html__( 'Curved', 'brain-divi-addons' ),
					'zigzag_pattern' => esc_html__( 'Zigzag', 'brain-divi-addons' ),
				),
				'show_if_not' => array(
					'use_shape' => 'on',
				),
			),
			'border_gap'        => array(
				'label'          => esc_html__( 'Border Spacing', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '20px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'divider',
				'show_if_not'    => array(
					'type'      => 'none_all',
					'use_shape' => 'on',
				),
			),
			'border_color'      => array(
				'label'       => esc_html__( 'Border Color', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'divider',
				'default'     => '#dddddd',
				'show_if_not' => array(
					'type'      => 'none_all',
					'use_shape' => 'on',
				),
			),
			'border_weight'     => array(
				'label'           => esc_html__( 'Weight', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '1px',
				'fixed_unit'      => 'px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 15,
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'divider',
				'show_if_not'     => array(
					'type'      => 'none_all',
					'use_shape' => 'on',
				),
			),
			'border_height'     => array(
				'label'           => esc_html__( 'Height', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '10px',
				'fixed_unit'      => 'px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'divider',
				'show_if_not'     => array(
					'type'      => 'none_all',
					'use_shape' => 'on',
				),
				'show_if'         => array(
					'type' => array( 'curved_pattern', 'zigzag_pattern' ),
				),
			),
			// Icon.
			'icon_color'        => array(
				'label'       => esc_html__( 'Icon Color', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'default'     => '#333',
				'show_if'     => array(
					'active_element' => 'icon',
					'use_mask'       => 'off',
				),
			),
			'icon_bg'           => array(
				'label'       => esc_html__( 'Icon Background', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'default'     => 'transparent',
				'show_if'     => array(
					'active_element' => 'icon',
					'use_mask'       => 'off',
				),
			),
			'icon_size'         => array(
				'label'           => esc_html__( 'Icon Size', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '30px',
				'fixed_unit'      => 'px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'icon',
				'show_if'         => array(
					'active_element' => 'icon',
				),
			),
			'icon_padding'      => array(
				'label'          => esc_html__( 'Icon Padding', 'brain-divi-addons' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'toggle_slug'    => 'icon',
				'show_if'        => array(
					'active_element' => 'icon',
				),
			),
			'img_width'         => array(
				'label'           => esc_html__( 'Image Width', 'brain-divi-addons' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '100px',
				'fixed_unit'      => 'px',
				'range_settings'  => array(
					'min'  => 0,
					'max'  => 500,
					'step' => 1,
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'icon',
				'show_if'         => array(
					'active_element' => 'image',
				),
			),
			// text mask.
			'mask_repeat'       => array(
				'label'       => esc_html__( 'Image Repeat', 'brain-divi-addons' ),
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
			'mask_size'         => array(
				'label'       => esc_html__( 'Image Size', 'brain-divi-addons' ),
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
			'mask_pos'          => array(
				'label'       => esc_html__( 'Image Position', 'brain-divi-addons' ),
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
			'mask_hz_pos'       => array(
				'label'       => esc_html__( 'Horizontal  Value', 'brain-divi-addons' ),
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
			'mask_vr_pos'       => array(
				'label'       => esc_html__( 'Vertical  Value', 'brain-divi-addons' ),
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

		return $fields;
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

	public function hexToRgb( $hex ) {
		$hex      = str_replace( '#', '', $hex );
		$length   = strlen( $hex );
		$rgb['r'] = hexdec( 6 === $length ? substr( $hex, 0, 2 ) : ( 3 === $length ? str_repeat( substr( $hex, 0, 1 ), 2 ) : 0 ) );
		$rgb['g'] = hexdec( 6 === $length ? substr( $hex, 2, 2 ) : ( 3 === $length ? str_repeat( substr( $hex, 1, 1 ), 2 ) : 0 ) );
		$rgb['b'] = hexdec( 6 === $length ? substr( $hex, 4, 2 ) : ( 3 === $length ? str_repeat( substr( $hex, 2, 1 ), 2 ) : 0 ) );

		return sprintf( 'rgba(%1$s,%2$s,%3$s,1)', $rgb['r'], $rgb['g'], $rgb['b'] );
	}

	public function render_title() {
		$title                 = $this->props['title'];
		$title_level           = $this->props['title_level'];
		$processed_title_level = et_pb_process_header_level( $title_level, 'h2' );
		$processed_title_level = esc_html( $processed_title_level );

		if ( ! empty( $title ) ) {
			return sprintf(
				'<%1$s class="ba-divider__element ba-divider__text">%2$s</%1$s>',
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
			'
            <div class="ba-module ba-divider">
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

		$use_mask          = $this->props['use_mask'];
		$mask_url          = $this->props['mask_url'];
		$active_element    = $this->props['active_element'];
		$content_alignment = $this->props['content_alignment'];
		$border_gap        = $this->props['border_gap'];
		$mask_size         = $this->props['mask_size'];
		$mask_pos          = $this->props['mask_pos'];
		$mask_hz_pos       = $this->props['mask_hz_pos'];
		$mask_vr_pos       = $this->props['mask_vr_pos'];
		$icon_color        = $this->props['icon_color'];
		$icon_size         = $this->props['icon_size'];
		$icon_bg           = $this->props['icon_bg'];
		$img_width         = $this->props['img_width'];
		$type              = $this->props['type'];
		$border_height     = $this->props['border_height'];
		$border_color      = $this->props['border_color'];
		$border_weight     = $this->props['border_weight'];
		$mask_repeat       = $this->props['mask_repeat'];
		$use_shape         = $this->props['use_shape'];
		$shape_weight      = $this->props['shape_weight'];
		$shape_color       = $this->props['shape_color'];

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

			if ( 'custom' === $mask_pos ) {
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

			// Border type.
			if ( 'none_all' !== $type ) {
				if ( '#' === $border_color[0] ) {
					$border_color = $this->hexToRgb( $border_color );
				}

				$curved_pattern = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='none' overflow='visible' height='100%' viewBox='0 0 24 24' stroke='" . $border_color . "' stroke-width='" . $this->props['border_weight'] . "' fill='none' stroke-linecap='square' stroke-miterlimit='10'%3E%3Cpath d='M0,6c6,0,6,13,12,13S18,6,24,6'/%3E%3C/svg%3E";
				$zigzag_pattern = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='none' overflow='visible' height='100%' viewBox='0 0 24 24' stroke='" . $border_color . "' stroke-width='" . $this->props['border_weight'] . "' fill='none' stroke-linecap='square' stroke-miterlimit='10'%3E%3Cpolyline points='0,18 12,6 24,18 '/%3E%3C/svg%3E";
				$_type          = explode( '_', $type );

				if ( 'border' === $_type[1] ) {

					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .ba-divider__border',
							'declaration' => sprintf(
								'border-top: %1$s %2$s %3$s;',
								$border_weight,
								$_type[0],
								$border_color
							),
						)
					);
				} else {
					if ( 'curved' === $_type[0] ) {
						$pattern_bg = $curved_pattern;
					} elseif ( 'zigzag' === $_type[0] ) {
						$pattern_bg = $zigzag_pattern;
					}
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .ba-divider__border',
							'declaration' => sprintf(
								'
                            background-image: url("%1$s");
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
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-divider__icon i',
						'declaration' => sprintf(
							'
                        background: %1$s; color: %2$s;',
							$icon_bg,
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
						'
                    width: %1$s;',
						$img_width
					),
				)
			);
		}

	}
}


new BA_Advanced_Divider();
