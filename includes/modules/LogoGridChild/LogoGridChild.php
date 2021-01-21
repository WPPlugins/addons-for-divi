<?php
class BA_Logo_Grid_Child extends BA_Builder_Module {

	public $slug                     = 'ba_logo_grid_child';
	public $vb_support               = 'on';
	public $type                     = 'child';
	public $child_title_var          = 'brand_name';
	public $child_title_fallback_var = 'tooltip_text';

	public function init() {

        $this->name = esc_html__( 'Logo', 'brain-divi-addons' );

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Content', 'brain-divi-addons' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'tooltip' => esc_html__( 'Tooltip', 'brain-divi-addons' ),
					'border'  => esc_html__( 'Border', 'brain-divi-addons' ),
				),
			),
		);
	}

	public function get_fields() {

		$fields = array(

			'logo_url'     => array(
				'label'              => esc_html__( 'Upload Logo', 'brain-divi-addons' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload a Logo', 'brain-divi-addons' ),
				'choose_text'        => esc_attr__( 'Choose a Logo', 'brain-divi-addons' ),
				'update_text'        => esc_attr__( 'Set As Logo', 'brain-divi-addons' ),
				'toggle_slug'        => 'main_content',
			),

			'brand_name'   => array(
				'label'       => esc_html__( 'Brand Name', 'brain-divi-addons' ),
				'type'        => 'text',
				'default'     => esc_html__( 'Brand Name', 'brain-divi-addons' ),
				'toggle_slug' => 'main_content',
			),

			'use_tooltip'  => array(
				'type'        => 'multiple_checkboxes',
				'default'     => 'off',
				'toggle_slug' => 'main_content',
				'options'     => array(
					'tooltip' => esc_html__( 'Use Tooltip', 'brain-divi-addons' ),
				),
			),

			'tooltip_text' => array(
				'label'       => esc_html__( 'Tooltip Text', 'brain-divi-addons' ),
				'type'        => 'text',
				'default'     => esc_html__( 'Tooltip!', 'brain-divi-addons' ),
				'toggle_slug' => 'main_content',
				'show_if'     => array(
					'use_tooltip' => 'on',
				),
			),

			'theme'        => array(
				'label'       => esc_html__( 'Theme', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'tooltip',
				'tab_slug'    => 'advanced',
				'default'     => 'dark',
				'options'     => array(
					'dark'  => esc_html__( 'Dark', 'brain-divi-addons' ),
					'light' => esc_html__( 'Light', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'use_tooltip' => 'on',
				),
			),

			'position'     => array(
				'label'       => esc_html__( 'Position', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'tooltip',
				'tab_slug'    => 'advanced',
				'default'     => 'top',
				'options'     => array(
					'top'    => esc_html__( 'Top', 'brain-divi-addons' ),
					'bottom' => esc_html__( 'Bottom', 'brain-divi-addons' ),
					'left'   => esc_html__( 'Left', 'brain-divi-addons' ),
					'right'  => esc_html__( 'Right', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'use_tooltip' => 'on',
				),
			),

			'animation'    => array(
				'label'       => esc_html__( 'Animation', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'tooltip',
				'tab_slug'    => 'advanced',
				'default'     => 'scale',
				'options'     => array(
					'fade'  => esc_html__( 'Fade', 'brain-divi-addons' ),
					'scale' => esc_html__( 'Scale', 'brain-divi-addons' ),
				),
				'show_if'     => array(
					'use_tooltip' => 'on',
				),
			),

		);

		return $fields;
	}


	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['fonts']       = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['max_width']   = false;

		$advanced_fields['background'] = array(
			'css' => array(
				'main'      => '%%order_class%% .ba-logo-grid__item',
				'important' => 'all',
			),
		);

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '%%order_class%% .ba-logo-grid__item',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['default'] = array(
			'label_prefix' => esc_html__( 'Logo', 'brain-divi-addons' ),
			'toggle_slug'  => 'border',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-logo-grid__item',
					'border_styles' => '%%order_class%% .ba-logo-grid__item',
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

		return $advanced_fields;
	}


	public function render_logo() {

		$logo_url   = $this->props['logo_url'];
		$brand_name = $this->props['brand_name'];

		if ( ! empty( $logo_url ) ) {
			return sprintf(
				'<img src="%1$s" alt="%2$s"/>',
				$logo_url,
				$brand_name
			);
		}

	}

	public function render( $attrs, $content = null, $render_slug ) {

		$tag          = ! empty( $this->props['link_option_url'] ) ? 'a' : 'div';
		$use_tooltip  = $this->props['use_tooltip'];
		$tooltip_text = $this->props['tooltip_text'];
		$position     = $this->props['position'];
		$animation    = $this->props['animation'];
		$theme        = $this->props['theme'];
		$tippy_opts   = '';

		// CSS Classes.
		$this->remove_classname( 'et_pb_module' );
		$this->add_classname( 'ba_et_pb_module' );

		if ( $use_tooltip === 'on' ) {
			$tippy_opts = sprintf(
				'
                data-tippy-content="%1$s"
                data-tippy-placement="%2$s"
                data-tippy-animation="%3$s"
                data-tippy-theme="%4$s"',
				$tooltip_text,
				$position,
				$animation,
				$theme
			);
		}

		return sprintf(
			'
                <div class="ba-module ba-child ba-logo-grid__item">
                    <%1$s class="ba-logo-grid__item__inner %3$s" %4$s>
					    %2$s
				    </%1$s>
                </div>',
			$tag,
			$this->render_logo(),
			$use_tooltip === 'on' ? 'ba-tooltip' : '',
			$tippy_opts
		);
	}
}

new BA_Logo_Grid_Child();
