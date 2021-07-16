<?php
class BA_Logo_Grid extends BA_Builder_Module {

	public $slug       = 'ba_logo_grid';
	public $vb_support = 'on';
	public $child_slug = 'ba_logo_grid_child';

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/demo/logo-grid/',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {

		$this->name      = esc_html__( 'Brain Logo Grid', 'brain-divi-addons' );
		$this->icon_path = plugin_dir_path( __FILE__ ) . 'logo-grid.svg';

		$this->settings_modal_toggles = array(
			'general' => array(
				'toggles' => array(
					'grid' => esc_html__( 'Grid Settings', 'brain-divi-addons' ),
				),

			),
		);

		$this->custom_css_fields = array(
			'logo'  => array(
				'label'    => esc_html__( 'Logo', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-logo-grid__item img',
			),
		);
	}

	public function get_fields() {

		$fields = array(
			'column_count'  => array(
				'label'          => esc_html__( 'Column', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can define grid columns number.', 'brain-divi-addons' ),
				'type'           => 'select',
				'default'        => '4',
				'options'        => array(
					'1'  => esc_html__( '1', 'brain-divi-addons' ),
					'2'  => esc_html__( '2', 'brain-divi-addons' ),
					'3'  => esc_html__( '3', 'brain-divi-addons' ),
					'4'  => esc_html__( '4', 'brain-divi-addons' ),
					'5'  => esc_html__( '5', 'brain-divi-addons' ),
					'6'  => esc_html__( '6', 'brain-divi-addons' ),
					'7'  => esc_html__( '7', 'brain-divi-addons' ),
					'8'  => esc_html__( '8', 'brain-divi-addons' ),
					'9'  => esc_html__( '9', 'brain-divi-addons' ),
					'10' => esc_html__( '10', 'brain-divi-addons' ),
				),
				'toggle_slug'    => 'grid',
				'mobile_options' => true,
			),

			'grid_height'   => array(
				'label'          => esc_html__( 'Column Height', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can define grid column height.', 'brain-divi-addons' ),
				'type'           => 'range',
				'toggle_slug'    => 'grid',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 800,
					'step' => 1,
				),
			),

			'grid_gap'      => array(
				'label'          => esc_html__( 'Grid Gap', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can define the spacing between grid columns.', 'brain-divi-addons' ),
				'type'           => 'range',
				'toggle_slug'    => 'grid',
				'default'        => '5px',
				'allowed_units'  => array( 'px', '%', 'em' ),
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
			),

			'logo_size'     => array(
				'label'          => esc_html__( 'Logo Size', 'brain-divi-addons' ),
				'description'    => esc_html__( 'Here you can define static logo width.', 'brain-divi-addons' ),
				'type'           => 'range',
				'toggle_slug'    => 'grid',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 1000,
					'step' => 1,
				),
			),

			'image_hover'   => array(
				'label'       => esc_html__( 'Logo Hover Style', 'brain-divi-addons' ),
				'description' => esc_html__( 'Select logo hover animation.', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'grid',
				'default'     => 'zoom_in',
				'options'     => array(
					'no_hover'      => esc_html__( 'None', 'brain-divi-addons' ),
					'zoom_in'       => esc_html__( 'Zoom In', 'brain-divi-addons' ),
					'zoom_out'      => esc_html__( 'Zoom Out', 'brain-divi-addons' ),
					'fade'          => esc_html__( 'Fade Out', 'brain-divi-addons' ),
					'black_n_white' => esc_html__( 'Black and White', 'brain-divi-addons' ),
				),
			),

			'logo_overflow' => array(
				'label'       => esc_html__( 'Logo Overflow', 'brain-divi-addons' ),
				'description' => esc_html__( 'Here you can control logo image overflow on the X and Y axis. If set to hidden, logo will be clipped.', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'grid',
				'default'     => 'visible',
				'options'     => array(
					'hidden'  => esc_html__( 'Hidden', 'brain-divi-addons' ),
					'visible' => esc_html__( 'Visible', 'brain-divi-addons' ),
				),
			),

		);

		return $fields;
	}


	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		return $advanced_fields;
	}


	public function render( $attrs, $content = null, $render_slug ) {

		$this->render_css( $render_slug );

		return sprintf(
			'<div class="ba-module ba-parent ba-logo-grid %2$s">
                %1$s
            </div>',
			$this->props['content'],
			$this->props['image_hover']
		);
	}

	protected function render_css( $render_slug ) {

		$grid_height                   = $this->props['grid_height'];
		$grid_height_tablet            = $this->props['grid_height_tablet'];
		$grid_height_phone             = $this->props['grid_height_phone'];
		$grid_height_last_edited       = $this->props['grid_height_last_edited'];
		$grid_height_responsive_status = et_pb_get_responsive_status( $grid_height_last_edited );
		$logo_size                     = $this->props['logo_size'];
		$logo_size_tablet              = $this->props['logo_size_tablet'];
		$logo_size_phone               = $this->props['logo_size_phone'];
		$logo_size_last_edited         = $this->props['logo_size_last_edited'];
		$logo_size_responsive_status   = et_pb_get_responsive_status( $logo_size_last_edited );
		$grid_gap                      = $this->props['grid_gap'];
		$grid_gap_tablet               = $this->props['grid_gap_tablet'];
		$grid_gap_phone                = $this->props['grid_gap_phone'];
		$grid_gap_last_edited          = $this->props['grid_gap_last_edited'];
		$grid_gap_responsive_status    = et_pb_get_responsive_status( $grid_gap_last_edited );
		$column_count                  = $this->props['column_count'];
		$column_count_tablet           = $this->props['column_count_tablet'];
		$column_count_phone            = $this->props['column_count_phone'];
		$logo_overflow                 = $this->props['logo_overflow'];

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-logo-grid__item',
				'declaration' => sprintf( 'overflow: %1$s;', $logo_overflow ),
			)
		);

		if ( ! empty( $grid_height ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba_logo_grid_child',
					'declaration' => sprintf( 'height: %1$s;', $grid_height ),
				)
			);

			if ( ! empty( $grid_height_tablet ) && $grid_height_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba_logo_grid_child',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
						'declaration' => sprintf( 'height: %1$s;', $grid_height_tablet ),
					)
				);
			}

			if ( ! empty( $grid_height_phone ) && $grid_height_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba_logo_grid_child',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
						'declaration' => sprintf( 'height: %1$s;', $grid_height_phone ),
					)
				);
			}
		}

		if ( ! empty( $logo_size ) ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.ba-logo-grid__item img',
					'declaration' => sprintf( 'width: %1$s;', $logo_size ),
				)
			);

			if ( ! empty( $logo_size_tablet ) && $logo_size_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '.ba-logo-grid__item img',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
						'declaration' => sprintf( 'width: %1$s;', $logo_size_tablet ),
					)
				);
			}

			if ( ! empty( $logo_size_phone ) && $logo_size_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '.ba-logo-grid__item img',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
						'declaration' => sprintf( 'width: %1$s;', $logo_size_phone ),
					)
				);
			}
		} else {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.ba-logo-grid__item img',
					'declaration' => 'width: 100%;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-logo-grid',
				'declaration' => sprintf( 'margin: -%1$s;', $grid_gap ),
			)
		);

		if ( ! empty( $grid_gap_tablet ) && $grid_gap_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-logo-grid',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'margin: -%1$s;', $grid_gap_tablet ),
				)
			);
		}

		if ( ! empty( $grid_gap_phone ) && $grid_gap_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-logo-grid',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'margin: -%1$s;', $grid_gap_phone ),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba_logo_grid_child',
				'declaration' => sprintf( 'flex: 0 0 calc(100%%/%1$s);padding:%2$s;', $column_count, $grid_gap ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba_logo_grid_child',
				'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
				'declaration' => sprintf( 'flex: 0 0 calc(100%%/%1$s);padding:%2$s;', $column_count_tablet, $grid_gap_tablet ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba_logo_grid_child',
				'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
				'declaration' => sprintf( 'flex: 0 0 calc(100%%/%1$s);padding:%2$s;', $column_count_phone, $grid_gap_phone ),
			)
		);

	}
}

new BA_Logo_Grid();
