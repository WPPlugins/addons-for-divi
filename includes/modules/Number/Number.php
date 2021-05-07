<?php
class BA_Number extends BA_Builder_Module {

	public $slug       = 'ba_number';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/demo/number/',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {
		$this->name = esc_html__( 'Brain Number', 'brain-divi-addons' );
		$this->icon_path = plugin_dir_path( __FILE__ ) . 'number.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__( 'Content', 'brain-divi-addons' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'number'     => esc_html__( 'Number', 'brain-divi-addons' ),
					'text'       =>  esc_html__( 'Text', 'brain-divi-addons' ),
					'border'     => esc_html__( 'Border', 'brain-divi-addons' ),
					'box_shadow' => esc_html__( 'Box Shadow', 'brain-divi-addons' ),
				),
			),
		);
	}

	public function get_fields() {

		$fields = array();

		// Content.
		$fields['number'] = array(
			'label'       => esc_html__( 'Number', 'brain-divi-addons' ),
			'type'        => 'text',
			'toggle_slug' => 'content',
			'default'     => esc_html__( '99', 'brain-divi-addons' ),
		);

		// Number.
		$fields['number_alignment'] = array(
			'label'            => esc_html__( 'Alignment', 'brain-divi-addons' ),
			'type'             => 'text_align',
			'option_category'  => 'layout',
			'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
			'options_icon'     => 'module_align',
			'default_on_front' => 'center',
			'toggle_slug'      => 'number',
			'tab_slug'         => 'advanced',
		);

		$fields['number_height'] = array(
			'label'          => esc_html__( 'Height', 'brain-divi-addons' ),
			'type'           => 'range',
			'default'        => '100px',
			'mobile_options' => true,
			'range_settings' => array(
				'min'  => 1,
				'step' => 1,
				'max'  => 1000,
			),
			'toggle_slug'    => 'number',
			'tab_slug'       => 'advanced',
		);

		$fields['number_width'] = array(
			'label'          => esc_html__( 'Width', 'brain-divi-addons' ),
			'type'           => 'range',
			'default'        => '100px',
			'mobile_options' => true,
			'range_settings' => array(
				'min'  => 1,
				'step' => 1,
				'max'  => 1000,
			),
			'toggle_slug'    => 'number',
			'tab_slug'       => 'advanced',
		);

		$fields['number_padding'] = array(
			'label'          => esc_html__( 'Number Padding', 'brain-divi-addons' ),
			'type'           => 'custom_padding',
			'default'        => '0px|0px|0px|0px',
			'mobile_options' => true,
			'toggle_slug'    => 'number',
			'tab_slug'       => 'advanced',
		);

		$fields['number_rotate'] = array(
			'label'          => esc_html__( 'Rotate', 'brain-divi-addons' ),
			'type'           => 'range',
			'default'        => '0deg',
			'fixed_unit'     => 'deg',
			'range_settings' => array(
				'min'  => -360,
				'max'  => 360,
				'step' => 1,
			),
			'toggle_slug'    => 'number',
			'tab_slug'       => 'advanced',
		);

		$fields['number_inner_rotate'] = array(
			'label'          => esc_html__( 'Inner Text Rotate', 'brain-divi-addons' ),
			'type'           => 'range',
			'default'        => '0deg',
			'fixed_unit'     => 'deg',
			'range_settings' => array(
				'min'  => -360,
				'max'  => 360,
				'step' => 1,
			),
			'toggle_slug'    => 'number',
			'tab_slug'       => 'advanced',
		);

		$number_bg = $this->custom_background_fields( 'number', 'Number', 'advanced', 'number', array( 'color', 'gradient', 'hover' ), array(), '' );

		return array_merge( $fields, $number_bg );
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text_shadow'] = false;

		$advanced_fields['borders']['number'] = array(
			'label_prefix' => esc_html__( 'Number', 'brain-divi-addons' ),
			'toggle_slug'  => 'number',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-number-wrap',
					'border_styles' => '%%order_class%% .ba-number-wrap',
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

		$advanced_fields['box_shadow']['number'] = array(
			'label'       => esc_html__( 'Number Box Shadow', 'brain-divi-addons' ),
			'css'         => array(
				'main'      => '%%order_class%% .ba-number-wrap',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'number',
		);

		$advanced_fields['box_shadow']['main'] = array(
			'label'       => esc_html__( 'Box Shadow', 'brain-divi-addons' ),
			'css'         => array(
				'main'      => '%%order_class%%',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'box_shadow',
		);

		$advanced_fields['fonts']['number'] = array(
			'label'           => esc_html__( 'Number', 'brain-divi-addons' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-number-text',
				'important' => 'all',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'text',
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '26px',
			),
		);

		return $advanced_fields;
	}

	public function render_number() {
		$number = $this->props['number'];

		if ( ! empty( $number ) ) {
			return sprintf(
				'
                <div class="ba-number-wrap">
                    <div class="ba-number-text">
                        %1$s
                    </div>
                </div>',
				$number
			);
		};
	}


	public function render_ref_attr() {
		$url    = $this->props['link_option_url'];
		$is_new = $this->props['link_option_url_new_window'];

		if ( ! empty( $url ) ) {
			$target = $is_new === 'off' ? '_self' : '_blank';
			return sprintf( 'target="%1$s" href="%2$s"', $target, $url );
		}
	}

	public function render( $attrs, $content = null, $render_slug ) {

		$tag = ! empty( $this->props['link_option_url'] ) ? 'a' : 'div';

		// Render CSS
		$this->render_css( $render_slug );

		return sprintf(
			'
            <%1$s %2$s class="ba-module ba-number">
                %3$s
            </%1$s>',
			$tag,
			$this->render_ref_attr(),
			$this->render_number()
		);
	}

	protected function render_css( $render_slug ) {

		$number_height                   = $this->props['number_height'];
		$number_height_tablet            = $this->props['number_height_tablet'];
		$number_height_phone             = $this->props['number_height_phone'];
		$number_height_last_edited       = $this->props['number_height_last_edited'];
		$number_height_responsive_status = et_pb_get_responsive_status( $number_height_last_edited );

		$number_width                   = $this->props['number_width'];
		$number_width_tablet            = $this->props['number_width_tablet'];
		$number_width_phone             = $this->props['number_width_phone'];
		$number_width_last_edited       = $this->props['number_width_last_edited'];
		$number_width_responsive_status = et_pb_get_responsive_status( $number_width_last_edited );

		$number_padding                   = $this->props['number_padding'];
		$number_padding_tablet            = $this->props['number_padding_tablet'];
		$number_padding_phone             = $this->props['number_padding_phone'];
		$number_padding_last_edited       = $this->props['number_padding_last_edited'];
		$number_padding_responsive_status = et_pb_get_responsive_status( $number_padding_last_edited );

		$number_rotate       = $this->props['number_rotate'];
		$number_inner_rotate = $this->props['number_inner_rotate'];
		$number_alignment    = $this->props['number_alignment'];

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-number-wrap',
				'declaration' => sprintf( '%1$s', $this->process_margin_padding( $number_padding, 'padding', false ) ),
			)
		);

		if ( $number_padding_tablet && $number_padding_responsive_status ) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-number-wrap',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => $this->process_margin_padding( $number_padding_tablet, 'padding', false ),
				)
			);
		endif;

		if ( $number_padding_phone && $number_padding_responsive_status ) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-number-wrap',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => $this->process_margin_padding( $number_padding_phone, 'padding', false ),
				)
			);
		endif;

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-number-wrap',
				'declaration' => sprintf( 'height: %1$s;', $number_height ),
			)
		);

		if ( $number_height_tablet && $number_height_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-number-wrap',
					'declaration' => sprintf( 'height: %1$s;', $number_height_tablet ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
				)
			);
		}

		if ( $number_height_phone && $number_height_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-number-wrap',
					'declaration' => sprintf( 'height: %1$s;`', $number_height_phone ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-number-wrap',
				'declaration' => sprintf( 'width: %1$s;', $number_width ),
			)
		);

		if ( $number_width_tablet && $number_width_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-number-wrap',
					'declaration' => sprintf( 'width: %1$s;', $number_width_tablet ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
				)
			);
		}

		if ( $number_width_phone && $number_width_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-number-wrap',
					'declaration' => sprintf( 'width: %1$s;`', $number_width_phone ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
				)
			);
		}

		// alignment
		if ( $number_alignment === 'right' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-number',
					'declaration' => 'justify-content: flex-end;',
				)
			);
		} elseif ( $number_alignment === 'center' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-number',
					'declaration' => 'justify-content: center;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-number-wrap',
				'declaration' => sprintf( 'transform: rotate(%1$s);', $number_rotate ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-number-text',
				'declaration' => sprintf( 'transform: rotate(%1$s);', $number_inner_rotate ),
			)
		);

		// number BG.
		$this->get_custom_bg_style( $render_slug, 'number', '%%order_class%% .ba-number-wrap', '%%order_class%%:hover .ba-number-wrap' );

	}
}

new BA_Number();
