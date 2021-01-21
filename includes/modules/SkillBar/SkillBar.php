<?php

class BA_Skill_Bar extends BA_Builder_Module {

	public $slug       = 'ba_skill_bar';
	public $vb_support = 'on';
	public $child_slug = 'ba_skill_bar_child';

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/demo/skill-bars',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {

		$this->name = esc_html__( 'Brain Skill Bars', 'brain-divi-addons' );

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html( 'Content', 'brain-divi-addons' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'common' => esc_html( 'Common', 'brain-divi-addons' ),
					'title'  => esc_html( 'Title', 'brain-divi-addons' ),
				),
			),
		);
	}

	public function get_fields() {

		$fields = array(

			'title'                => array(
				'label'       => esc_html__( 'Title', 'brain-divi-addons' ),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),

			'title_spacing_bottom' => array(
				'label'          => esc_html__( 'Spacing Bottom', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '10px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'title',
			),

			'bar_spacing_bottom'   => array(
				'label'          => esc_html__( 'Bar Spacing Bottom', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '20px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'common',
				'mobile_options' => true,
			),

		);

		return $fields;

	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['fonts']['title'] = array(
			'css'             => array(
				'main' => '%%order_class%% .ba-skill__title',
			),
			'important'       => 'all',
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'title',
			'header_level'    => array(
				'default' => 'h1',
			),
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '30px',
			),
		);

		return $advanced_fields;
	}

	public function render_title() {

		$title                 = $this->props['title'];
		$title_level           = $this->props['title_level'];
		$processed_title_level = et_pb_process_header_level( $title_level, 'h2' );
		$processed_title_level = esc_html( $processed_title_level );

		if ( ! empty( $title ) ) {
			return sprintf(
				'<%1$s class="ba-skill__title">%2$s</%1$s>',
				$processed_title_level,
				$title
			);
		}
	}


	public function render( $attrs, $content = null, $render_slug ) {

		$content                              = $this->props['content'];
		$title_spacing_bottom                 = $this->props['title_spacing_bottom'];
		$bar_spacing_bottom                   = $this->props['bar_spacing_bottom'];
		$bar_spacing_bottom_tablet            = $this->props['bar_spacing_bottom_tablet'];
		$bar_spacing_bottom_phone             = $this->props['bar_spacing_bottom_phone'];
		$bar_spacing_bottom_last_edited       = $this->props['bar_spacing_bottom_last_edited'];
		$bar_spacing_bottom_responsive_status = et_pb_get_responsive_status( $bar_spacing_bottom_last_edited );

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-skill__title',
				'declaration' => sprintf( 'margin-bottom: %1$s;', $title_spacing_bottom ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba_skill_bar_child',
				'declaration' => sprintf( ' margin-bottom: %1$s!important;', $bar_spacing_bottom ),
			)
		);

		if ( $bar_spacing_bottom_tablet && $bar_spacing_bottom_responsive_status ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-form-header-container',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'margin-bottom: %1$s!important;', $bar_spacing_bottom_tablet ),
				)
			);
		}

		if ( $bar_spacing_bottom_phone && $bar_spacing_bottom_responsive_status ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-form-header-container',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'margin-bottom: %1$s!important;', $bar_spacing_bottom_phone ),
				)
			);
		}

		return sprintf( '<div class="ba-module ba-parent ba-skill">%1$s %2$s </div>', $this->render_title(), $content );
	}
}

new BA_Skill_Bar();
