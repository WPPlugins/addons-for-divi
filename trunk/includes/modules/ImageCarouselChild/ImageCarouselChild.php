<?php
class DTQ_Image_Carousel_Child extends BA_Builder_Module {

	public $slug                     = 'ba_image_carousel_child';
	public $vb_support               = 'on';
	public $type                     = 'child';
	public $child_title_var          = 'admin_title';
	public $child_title_fallback_var = 'title';

	public function init() {

		$this->name = esc_html__( 'Item', 'addons-for-divi' );

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'carousel_content' => esc_html__( 'Content', 'addons-for-divi' ),
				),
			),

			'advanced' => array(
				'toggles' => array(
					'image'   => esc_html__( 'Image', 'addons-for-divi' ),
					'overlay' => esc_html__( 'Overlay', 'addons-for-divi' ),
					'content' => esc_html__( 'Content', 'addons-for-divi' ),
					'texts'   => array(
						'title'             => esc_html__( 'Title & Subtitle', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'title_tab'    => array(
								'name' => esc_html__( 'Title', 'addons-for-divi' ),
							),
							'subtitle_tab' => array(
								'name' => esc_html__( 'Subtitle', 'addons-for-divi' ),
							),
						),
					),
					'borders' => esc_html__( 'Border', 'addons-for-divi' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'image_wrap'  => array(
				'label'    => esc_html__( 'Image Wrapper', 'addons-for-divi' ),
				'selector' => '%%order_class%% figure',
			),
			'image'  => array(
				'label'    => esc_html__( 'Image', 'addons-for-divi' ),
				'selector' => '%%order_class%% figure img',
			),
			'title'  => array(
				'label'    => esc_html__( 'Title', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-image-title',
			),
			'sub_title'  => array(
				'label'    => esc_html__( 'Sub Title', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba-image-subtitle',
			),
		);
	}

	public function get_fields() {

		$fields = array(

			'photo'                 => array(
				'label'              => esc_html__( 'Upload Image', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload an image or type in the URL of the image you would like to display.', 'addons-for-divi' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'toggle_slug'        => 'carousel_content',
				'upload_button_text' => esc_attr__( 'Upload an image', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Image', 'addons-for-divi' ),
				'hover'              => 'tabs',
				'mobile_options'     => true,
			),

			'photo_alt'             => array(
				'label'       => esc_html__( 'Image Alt Text', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the HTML ALT text for your image here.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'carousel_content',
			),

			'title'                 => array(
				'label'       => esc_html__( 'Title', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the title text for the item.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'carousel_content',
			),

			'sub_title'             => array(
				'label'       => esc_html__( 'Subtitle', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the sub-title text for the item.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'carousel_content',
			),

			'content_alignment'     => array(
				'label'            => esc_html__( 'Content Text Alignment', 'addons-for-divi' ),
				'description'      => esc_html__( 'Align texts to the left, right or center.', 'addons-for-divi' ),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'     => 'module_align',
				'default_on_front' => 'left',
				'toggle_slug'      => 'content',
				'tab_slug'         => 'advanced',
			),

			'content_width'         => array(
				'label'          => esc_html__( 'Content Width', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define custom content width.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default'        => '100%',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'content',
			),

			'content_type'          => array(
				'label'       => esc_html__( 'Content Type', 'addons-for-divi' ),
				'description' => esc_html__( 'Define content type. By selecting absolute type content can be placed as image overlay.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'content',
				'tab_slug'    => 'advanced',
				'default'     => 'normal',
				'options'     => array(
					'normal'   => esc_html__( 'Normal', 'addons-for-divi' ),
					'absolute' => esc_html__( 'Absolute', 'addons-for-divi' ),
				),
			),

			'content_position'      => array(
				'label'       => esc_html__( 'Content Position', 'addons-for-divi' ),
				'description' => esc_html__( 'Define content position.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'content',
				'tab_slug'    => 'advanced',
				'default'     => 'bottom',
				'options'     => array(
					'top'    => esc_html__( 'Top', 'addons-for-divi' ),
					'bottom' => esc_html__( 'Bottom', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'content_type' => 'normal',
				),
			),

			'content_pos_x'         => array(
				'label'       => esc_html__( 'Content Horizontal Placement', 'addons-for-divi' ),
				'description' => esc_html__( 'Select content horizontal placement.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'content',
				'tab_slug'    => 'advanced',
				'default'     => 'center',
				'options'     => array(
					'center'     => esc_html__( 'Center', 'addons-for-divi' ),
					'flex-start' => esc_html__( 'Left', 'addons-for-divi' ),
					'flex-end'   => esc_html__( 'Right', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'content_type' => 'absolute',
				),
			),

			'content_offset_x'      => array(
				'label'          => esc_html__( 'Content Horizontal Position', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define the value for the content horizontally offset.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '0px',
				'mobile_options' => true,
				'toggle_slug'    => 'content',
				'tab_slug'       => 'advanced',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'show_if'        => array(
					'content_type'  => 'absolute',
					'content_pos_x' => array( 'flex-start', 'flex-end' ),
				),
			),

			'content_pos_y'         => array(
				'label'       => esc_html__( 'Content Vertical Placement', 'addons-for-divi' ),
				'description' => esc_html__( 'Select content vertical placement.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'content',
				'tab_slug'    => 'advanced',
				'default'     => 'center',
				'options'     => array(
					'center'     => esc_html__( 'Center', 'addons-for-divi' ),
					'flex-start' => esc_html__( 'Top', 'addons-for-divi' ),
					'flex-end'   => esc_html__( 'Bottom', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'content_type' => 'absolute',
				),
			),

			'content_offset_y'      => array(
				'label'          => esc_html__( 'Content Vertical Position', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define the value for the content vertically offset.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '0px',
				'toggle_slug'    => 'content',
				'mobile_options' => true,
				'tab_slug'       => 'advanced',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'show_if'        => array(
					'content_type'  => 'absolute',
					'content_pos_y' => array( 'flex-start', 'flex-end' ),
				),
			),

			'content_padding'       => array(
				'label'          => esc_html__( 'Content Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define custom padding for the content area.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'content',
				'mobile_options' => true,
			),

			// image.
			'image_height'          => array(
				'label'          => esc_html__( 'Image Height', 'addons-for-divi' ),
				'description'    => esc_html__( '.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => 'auto',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 600,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
			),

			'image_hover_animation' => array(
				'label'       => esc_html__( 'Image Hover Animation', 'addons-for-divi' ),
				'description' => esc_html__( 'Select image hover animation.', 'addons-for-divi' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'image',
				'default'     => 'none',
				'options'     => $this->get_image_hover_animations(),
			),

			// Text.
			'title_bottom_spacing'  => array(
				'label'          => esc_html__( 'Title Spacing Bottom', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the bottom of the title.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '5px',
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
				'sub_toggle'     => 'title_tab',
			),

		);

		$label = array(
			'admin_title' => array(
				'label'       => esc_html__( 'Admin Label', 'addons-for-divi' ),
				'description' => esc_html__( '.', 'addons-for-divi' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the item', 'addons-for-divi' ),
				'toggle_slug' => 'admin_label',
			),
		);

		$content = $this->custom_background_fields(
			'content',
			esc_html__( 'Content', 'addons-for-divi' ),
			'advanced',
			'content',
			array( 'color', 'gradient', 'image', 'hover' ),
			array(),
			''
		);
		$overlay = $this->get_overlay_option_fields( 'overlay', 'off', array() );

		return array_merge( $label, $fields, $content, $overlay );
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['max_width']   = false;
		$advanced_fields['fonts']       = false;
		$advanced_fields['borders']     = false;

		$advanced_fields['box_shadow']['content'] = array(
			'label'       => esc_html__( 'Box Shadow', 'addons-for-divi' ),
			'css'         => array(
				'main'      => '%%order_class%% .content .content-inner',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'content',
		);

		$advanced_fields['fonts']['title'] = array(
			'label'           => esc_html__( 'Title', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-image-title, .et-db #et-boc %%order_class%% .ba-image-title',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'title_tab',
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
			'hide_text_align' => true,
			'header_level'    => array(
				'default' => 'h3',
			),
		);

		$advanced_fields['fonts']['subtitle'] = array(
			'label'           => esc_html__( 'Subtitle', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-image-subtitle, .et-db #et-boc %%order_class%% .ba-image-subtitle',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'subtitle_tab',
			'hide_text_align' => true,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
			'header_level'    => array(
				'default' => 'h5',
			),
		);

		$advanced_fields['borders']['item'] = array(
			'label_prefix' => esc_html__( 'Item', 'addons-for-divi' ),
			'css'          => array(
				'main'      => '%%order_class%%',
				'important' => 'all',
			),
			'tab_slug'     => 'advanced',
			'toggle_slug'  => 'borders',
		);

		return $advanced_fields;
	}

	public function render_figure() {

		$photo                  = $this->props['photo'];
		$photo_alt              = $this->props['photo_alt'];
		$processed_overlay_icon = esc_attr( et_pb_process_font_icon( $this->props['overlay_icon'] ) );
		$overlay_icon           = ! empty( $processed_overlay_icon ) ? $processed_overlay_icon : '';
		$data_schema            = $this->get_swapped_img_schema( 'photo' );
		$parent_module          = self::get_parent_modules( 'page' )['ba_image_carousel'];
		$use_lightbox           = $parent_module->shortcode_atts['use_lightbox'];

		if ( ! empty( $photo ) ) {
			return sprintf(
				'<figure class="ba-figure">
                    <div class="ba-overlay" data-icon="%3$s"></div>
                    <img class="ba-swapped-img %4$s" data-mfp-src="%1$s" src="%1$s" %2$s alt="%5$s"/>
                </figure>',
				$photo,
				$data_schema,
				$overlay_icon,
				$use_lightbox === 'on' ? 'ba-lightbox' : '',
				$photo_alt
			);
		}
	}

	public function render_title() {
		$title_text            = $this->props['title'];
		$title_level           = $this->props['title_level'];
		$processed_title_level = et_pb_process_header_level( $title_level, 'h3' );
		$processed_title_level = esc_html( $processed_title_level );

		if ( ! empty( $title_text ) ) {
			return sprintf( '<%2$s class="ba-image-title">%1$s</%2$s>', $title_text, $processed_title_level );
		}
	}

	public function render_subTitle() {

		$sub_title                = $this->props['sub_title'];
		$subtitle_level           = $this->props['subtitle_level'];
		$processed_subtitle_level = et_pb_process_header_level( $subtitle_level, 'h5' );
		$processed_subtitle_level = esc_html( $processed_subtitle_level );

		if ( ! empty( $sub_title ) ) {
			return sprintf( '<%2$s class="ba-image-subtitle">%1$s</%2$s>', $sub_title, $processed_subtitle_level );
		}
	}

	public function render_content() {

		if ( empty( $this->props['title'] ) && empty( $this->props['sub_title'] ) ) {
			return;
		}

		$content_type = $this->props['content_type'];

		if ( empty( $content_type ) ) {
			$content_type === 'absolute';
		}

		return sprintf(
			'<div class="content content--%3$s content--%4$s"><div class="content-inner"> %1$s %2$s </div></div>',
			$this->render_title(),
			$this->render_subTitle(),
			$this->props['content_alignment'],
			$content_type
		);
	}

	public function render( $attrs, $content = null, $render_slug ) {

		$content_pos_x                     = $this->props['content_pos_x'];
		$content_pos_y                     = $this->props['content_pos_y'];
		$content_type                      = $this->props['content_type'];
		$content_alignment                 = $this->props['content_alignment'];
		$content_position                  = $this->props['content_position'];
		$image_hover_animation             = $this->props['image_hover_animation'];
		$image_height                      = $this->props['image_height'];
		$image_height_tablet               = $this->props['image_height_tablet'];
		$image_height_phone                = $this->props['image_height_phone'];
		$image_height_last_edited          = $this->props['image_height_last_edited'];
		$image_height_responsive_status    = et_pb_get_responsive_status( $image_height_last_edited );
		$content_padding                   = $this->props['content_padding'];
		$content_padding_tablet            = $this->props['content_padding_tablet'];
		$content_padding_phone             = $this->props['content_padding_phone'];
		$content_padding_last_edited       = $this->props['content_padding_last_edited'];
		$content_padding_responsive_status = et_pb_get_responsive_status( $content_padding_last_edited );

		if ( 'absolute' === $content_type ) {
			if ( empty( $content_padding ) ) {
				$content_padding = '10px|20px|10px|20px';
			}
		} else {
			if ( empty( $content_padding ) ) {
				$content_padding = '15px|0|15px|0';
			}
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-image-carousel-item .content-inner',
				'declaration' => sprintf( 'text-align: %1$s;', $content_alignment ),
			)
		);

		// Image Height.
		if ( 'auto' !== $image_height ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-image-carousel-item figure',
					'declaration' => sprintf( 'height: %1$s;', $image_height ),
				)
			);
			if ( $image_height_tablet && $image_height_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-image-carousel-item figure',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
						'declaration' => sprintf( 'height: %1$s;', $image_height_tablet ),
					)
				);
			}

			if ( $image_height_phone && $image_height_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-image-carousel-item figure',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
						'declaration' => sprintf( 'height: %1$s;', $image_height_phone ),
					)
				);
			}
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-image-carousel-item figure img',
					'declaration' => 'height: 100%; object-fit: cover;width:100%;',
				)
			);
		}

		// Texts.
		$this->get_responsive_styles(
			'title_bottom_spacing',
			'%%order_class%% .ba-image-carousel-item h3',
			array( 'primary' => 'padding-bottom' ),
			array( 'default' => '5px' ),
			$render_slug
		);

		// Content.
		if ( 'absolute' === $content_type ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .content--absolute',
					'declaration' => sprintf(
						'align-items: %1$s; justify-content: %2$s;',
						$content_pos_x,
						$content_pos_y
					),
				)
			);

			if ( 'flex-start' === $content_pos_x ) {

				$this->get_responsive_styles(
					'content_offset_x',
					'%%order_class%% .content--absolute',
					array( 'primary' => 'padding-left' ),
					array( 'default' => '0px' ),
					$render_slug
				);

			} elseif ( 'flex-end' === $content_pos_x ) {

				$this->get_responsive_styles(
					'content_offset_x',
					'%%order_class%% .content--absolute',
					array( 'primary' => 'padding-right' ),
					array( 'default' => '0px' ),
					$render_slug
				);

			}

			if ( 'flex-start' === $content_pos_y ) {

				$this->get_responsive_styles(
					'content_offset_y',
					'%%order_class%% .content--absolute',
					array( 'primary' => 'padding-top' ),
					array( 'default' => '0px' ),
					$render_slug
				);

			} elseif ( 'flex-end' === $content_pos_y ) {

				$this->get_responsive_styles(
					'content_offset_y',
					'%%order_class%% .content--absolute',
					array( 'primary' => 'padding-bottom' ),
					array( 'default' => '0px' ),
					$render_slug
				);

			}
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-image-carousel-item .content .content-inner',
				'declaration' => sprintf(
					'%1$s',
					$this->process_margin_padding( $content_padding, 'padding', false )
				),
			)
		);

		$this->get_responsive_styles(
			'content_width',
			'%%order_class%% .ba-image-carousel-item .content .content-inner',
			array( 'primary' => 'width' ),
			array( 'default' => '100%' ),
			$render_slug
		);

		if ( $content_padding_tablet && $content_padding_responsive_status ) :

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-image-carousel-item .content .content-inner',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => $this->process_margin_padding( $content_padding_tablet, 'padding', false ),
				)
			);
		endif;

		if ( $content_padding_phone && $content_padding_responsive_status ) :

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-image-carousel-item .content .content-inner',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => $this->process_margin_padding( $content_padding_phone, 'padding', false ),
				)
			);
		endif;

		// Content background.
		$this->get_custom_bg_style( $render_slug, 'content', '%%order_class%% .ba-image-carousel-item .content .content-inner', '%%order_class%% .ba-image-carousel-item .content .content-inner:hover' );

		// Overlay Styles.
		$this->get_overlay_style( $render_slug, 'photo', '%%order_class%% .ba-image-carousel-item' );

		$is_bottom = true;

		if ( $content_type === 'normal' ) {
			if ( $content_position === 'top' ) {
				$is_bottom = false;
			}
		}

		$this->remove_classname( 'et_pb_module' );
		$this->add_classname( 'ba_et_pb_module' );

		return sprintf(
			'<div class="ba-carousel-item ba-image-carousel-item ba-swapped-img-selector ba-hover--%3$s">
                %4$s %1$s %2$s
			</div>',
			$this->render_figure(),
			$is_bottom ? $this->render_content() : '',
			$image_hover_animation,
			! $is_bottom ? $this->render_content() : ''
		);
	}
}

new DTQ_Image_Carousel_Child();
