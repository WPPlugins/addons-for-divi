<?php
class BA_Image_Carousel extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/demo/image-carousel/',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {

		$this->vb_support = 'on';
		$this->slug       = 'ba_image_carousel';
		$this->child_slug = 'ba_image_carousel_child';
		$this->name       = esc_html__( 'Brain Image Carousel', 'brain-divi-addons' );

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'carousel_settings' => array(
						'title'             => esc_html__( 'Carousel Settings', 'brain-divi-addons' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'general'  => array(
								'name' => esc_html__( 'General', 'brain-divi-addons' ),
							),
							'advanced' => array(
								'name' => esc_html__( 'Advanced', 'brain-divi-addons' ),
							),
						),
					),
				),
			),

			'advanced' => array(
				'toggles' => array(
					'nav'  => array(
						'title'             => esc_html__( 'Navigation', 'brain-divi-addons' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'nav_common' => array(
								'name' => esc_html__( 'Common', 'brain-divi-addons' ),
							),
							'nav_left'   => array(
								'name' => esc_html__( 'Left', 'brain-divi-addons' ),
							),
							'nav_right'  => array(
								'name' => esc_html__( 'Right', 'brain-divi-addons' ),
							),
						),
					),
					'pagi' => array(
						'title'             => esc_html__( 'Pagination', 'brain-divi-addons' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'pagi_common' => array(
								'name' => esc_html__( 'Common', 'brain-divi-addons' ),
							),
							'pagi_active' => array(
								'name' => esc_html__( 'Active', 'brain-divi-addons' ),
							),
						),
					),
				),
			),
		);
	}

	public function get_fields() {
		return $this->get_carousel_option_fields( array( 'lightbox' ) );
	}

	public function get_advanced_fields_config() {

		$advanced_fields = array();

		$advanced_fields['text']         = false;
		$advanced_fields['borders']      = false;
		$advanced_fields['text_shadow']  = false;
		$advanced_fields['link_options'] = false;
		$advanced_fields['fonts']        = false;

		return $advanced_fields;
	}

	public function render( $attrs, $content = null, $render_slug ) {

		$content          = $this->props['content'];
		$is_center        = $this->props['is_center'];
		$center_mode_type = $this->props['center_mode_type'];
		$use_lightbox     = $this->props['use_lightbox'];
		$custom_cursor    = $this->props['custom_cursor'];

		// Render CSS.
		$this->render_css( $render_slug );

		$classes = array();

		array_push( $classes, "ba-lightbox-{$use_lightbox}" );

		if ( $is_center === 'on' ) {
			array_push( $classes, 'ba-centered' );
			array_push( $classes, "ba-centered--{$center_mode_type}" );
		}

		if ( $custom_cursor === 'on' ) {
			array_push( $classes, 'ba-cursor' );
		}

		$output = sprintf(
			'
			    <div class="ba-carousel ba-image-carousel ba-carousel-frontend %3$s" %2$s >
                    %1$s
                </div>',
			$content,
			$this->get_carousel_options_data(),
			join( ' ', $classes )
		);

		return $output;
	}

	public function render_css( $render_slug ) {

		// Carousel CSS
		$this->render_carousel_css( $render_slug );

	}

}

new BA_Image_Carousel();
