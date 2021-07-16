<?php
class BA_Post_List extends BA_Builder_Module_Type_PostBased {

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/post-list/',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {

		$this->vb_support = 'on';
		$this->slug       = 'ba_post_list';
		$this->name       = esc_html__( 'Brain Post List', 'brain-divi-addons' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'post-list.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content'  => esc_html__( 'Content', 'brain-divi-addons' ),
					'settings' => esc_html__( 'Elements', 'brain-divi-addons' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'common'    => esc_html__( 'General', 'brain-divi-addons' ),
					'list_icon' => esc_html__( 'List Icon', 'brain-divi-addons' ),
					'image'     => esc_html__( 'Featured Image', 'brain-divi-addons' ),
					'texts'     => array(
						'title'             => esc_html__( 'Title & Excerpt', 'brain-divi-addons' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'title'   => array(
								'name' => esc_html__( 'Title', 'brain-divi-addons' ),
							),
							'content' => array(
								'name' => esc_html__( 'Excerpt', 'brain-divi-addons' ),
							),
						),
					),
					'meta'      => esc_html__( 'Meta', 'brain-divi-addons' ),
					'border'    => esc_html__( 'Border', 'brain-divi-addons' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'image'  => array(
				'label'    => esc_html__( 'Featured Image', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-post-list-thumb img',
			),
			'title'  => array(
				'label'    => esc_html__( 'Title', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-post-list-title',
			),
			'excerpt'  => array(
				'label'    => esc_html__( 'Excerpt', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-post-list-excerpt',
			),
			'author'  => array(
				'label'    => esc_html__( 'Author', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-post-list-author',
			),
			'date'  => array(
				'label'    => esc_html__( 'Date', 'brain-divi-addons' ),
				'selector' => '%%order_class%% .ba-post-list-date',
			),
		);
	}

	public function get_fields() {

		$fields = array(
			'post_type'             => array(
				'label'            => esc_html__( 'Post Type', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Choose posts of which post type you would like to display.', 'brain-divi-addons' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => et_get_registered_post_type_options( false, false ),
				'description'      => esc_html__( 'Choose posts of which post type you would like to display.', 'brain-divi-addons' ),
				'computed_affects' => array(
					'__posts',
				),
				'toggle_slug'      => 'content',
				'default'          => 'post',
			),

			'include_categories'    => array(
				'label'            => esc_html__( 'Included Categories', 'brain-divi-addons' ),
				'description'            => esc_html__( 'Choose which categories you would like to include in the news ticker.', 'brain-divi-addons' ),
				'type'             => 'categories',
				'option_category'  => 'basic_option',
				'meta_categories'  => array(
					'current' => esc_html__( 'Current Category', 'brain-divi-addons' ),
				),
				'renderer_options' => array(
					'use_terms' => false,
				),
				'description'      => esc_html__( 'Choose which categories you would like to include in the List.', 'brain-divi-addons' ),
				'toggle_slug'      => 'content',
				'computed_affects' => array(
					'__posts',
				),
				'show_if'          => array(
					'post_type' => 'post',
				),
			),

			'order_by'              => array(
				'label'            => esc_html__( 'Order By', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Choose how your posts should be ordered.', 'brain-divi-addons' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'toggle_slug'      => 'content',
				'default'          => 'date',
				'options'          => array(
					'date'  => esc_html__( 'Date', 'brain-divi-addons' ),
					'title' => esc_html__( 'Title', 'brain-divi-addons' ),
				),

				'default_on_front' => 'date',
				'computed_affects' => array( '__posts' ),
			),

			'order'                 => array(
				'label'            => esc_html__( 'Sorted By', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Choose how your posts should be sorted.', 'brain-divi-addons' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'toggle_slug'      => 'content',
				'default'          => 'ASC',
				'options'          => array(
					'ASC'  => esc_html__( 'Ascending', 'brain-divi-addons' ),
					'DESC' => esc_html__( 'Descending', 'brain-divi-addons' ),
				),

				'default_on_front' => 'ASC',
				'computed_affects' => array( '__posts' ),
			),

			'posts_number'          => array(
				'label'            => esc_html__( 'Post Count', 'brain-divi-addons' ),
				'description'      => esc_html__( '.', 'brain-divi-addons' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how much posts you would like to display per List.', 'brain-divi-addons' ),
				'computed_affects' => array(
					'__posts',
				),
				'toggle_slug'      => 'content',
				'default'          => 6,
			),
			'exclude_posts'         => array(
				'label'            => esc_html__( 'Exclude posts by IDs', 'brain-divi-addons' ),
				'description'      => esc_html__( 'eg. 10, 22, 19 etc. If this is used by IDs, Selected Posts will be ignored.', 'brain-divi-addons' ),
				'type'             => 'text',
				'toggle_slug'      => 'content',
				'computed_affects' => array( '__posts' ),
			),
			'post_offset'           => array(
				'label'            => esc_html__( 'Post Offset', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Choose how many news you would like to skip. These news will not be shown.', 'brain-divi-addons' ),
				'type'             => 'range',
				'default'          => '0',
				'unitless'         => true,
				'range_settings'   => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'toggle_slug'      => 'content',
				'computed_affects' => array( '__posts' ),
			),
			'posts_only_with_image' => array(
				'label'            => esc_html__( 'Post only With Thumbnail', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Enable to display posts only with thumbnail image', 'brain-divi-addons' ),
				'type'             => 'yes_no_button',
				'options'          => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'          => 'on',
				'toggle_slug'      => 'content',
				'computed_affects' => array( '__posts' ),
			),
			// Settings.
			'show_thumb'            => array(
				'label'            => esc_html__( 'Show Featured Image', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Here you can choose whether thumbnail should be used.', 'brain-divi-addons' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'          => 'on',
				'toggle_slug'      => 'elements',
				'computed_affects' => array( '__posts' ),
			),

			'show_icon'             => array(
				'label'            => esc_html__( 'Show List Icon', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Here you can choose whether icon should be used before list items.', 'brain-divi-addons' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'          => 'on',
				'toggle_slug'      => 'elements',
				'computed_affects' => array( '__posts' ),
				'show_if'          => array(
					'show_thumb' => 'off',
				),
			),

			'list_icon'             => array(
				'label'            => esc_html__( 'Select List Icon', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Select icon for the list.', 'brain-divi-addons' ),
				'type'             => 'select_icon',
				'option_category'  => 'basic_option',
				'toggle_slug'      => 'elements',
				'computed_affects' => array( '__posts' ),
				'show_if'          => array(
					'show_thumb' => 'off',
					'show_icon'  => 'on',
				),
			),

			'show_excerpt'          => array(
				'label'            => esc_html__( 'Show Excerpt', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Here you can choose whether excerpt should be used.', 'brain-divi-addons' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'          => 'on',
				'toggle_slug'      => 'elements',
				'computed_affects' => array( '__posts' ),
			),

			'excerpt_length'        => array(
				'label'            => esc_html__( 'Excerpt Length', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Define the length of automatically generated excerpts. Leave blank for default ( 150 ) ', 'brain-divi-addons' ),
				'type'             => 'text',
				'default'          => '150',
				'toggle_slug'      => 'elements',
				'computed_affects' => array( '__posts' ),
				'show_if'          => array(
					'show_excerpt' => 'on',
				),
			),

			'show_author'           => array(
				'label'            => esc_html__( 'Show Author', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Here you can choose whether author should be used.', 'brain-divi-addons' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'          => 'off',
				'toggle_slug'      => 'elements',
				'computed_affects' => array( '__posts' ),
			),

			'show_date'             => array(
				'label'            => esc_html__( 'Show Date', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Here you can choose whether date should be used.', 'brain-divi-addons' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'          => 'off',
				'toggle_slug'      => 'elements',
				'computed_affects' => array( '__posts' ),
			),

			'date_format'           => array(
				'label'            => esc_html__( 'Date Format', 'brain-divi-addons' ),
				'description'      => esc_html__( 'If you would like to adjust the date format, input the appropriate PHP date format here.', 'brain-divi-addons' ),
				'type'             => 'text',
				'default'          => 'M d, Y',
				'toggle_slug'      => 'content',
				'show_if'          => array(
					'show_date'            => 'on',
					'show_date_over_image' => 'off',
				),
				'computed_affects' => array( '__posts' ),
				'show_if'          => array(
					'show_date' => 'on',
				),
			),

			// common.
			'list_type'             => array(
				'label'       => esc_html__( 'List Type', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Select post list layout type.', 'brain-divi-addons' ),
				'type'        => 'select',
				'toggle_slug' => 'common',
				'tab_slug'    => 'advanced',
				'default'     => 'list',
				'options'     => array(
					'list' => esc_html__( 'List', 'brain-divi-addons' ),
					'grid' => esc_html__( 'Grid', 'brain-divi-addons' ),
				),
			),

			'items'                 => array(
				'label'          => esc_html__( 'Items per Row', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Define items count per row.', 'brain-divi-addons' ),
				'type'           => 'select',
				'toggle_slug'    => 'common',
				'tab_slug'       => 'advanced',
				'default'        => '4',
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
				'show_if'        => array(
					'list_type' => 'grid',
				),
			),

			'item_spacing'          => array(
				'label'          => esc_html__( 'Post Spacing', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Define spacing between post items.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '15px',
				'allowed_units'  => array( 'px' ),
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'common',
				'tab_slug'       => 'advanced',
			),

			'item_padding'          => array(
				'label'          => __( 'Post Padding', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Define custom padding for the post items.', 'brain-divi-addons' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'common',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
			),

			'alignment'             => array(
				'label'        => __( 'Post Alignment', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Align content to the left, right or center.', 'brain-divi-addons' ),
				'type'         => 'text_align',
				'options'      => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon' => 'module_align',
				'default'      => 'left',
				'toggle_slug'  => 'common',
				'tab_slug'     => 'advanced',
			),

			// list icon.
			'icon_size'             => array(
				'label'          => esc_html__( 'Icon Size', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Here you can define a custom size for list icons.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '18px',
				'allowed_units'  => array( 'px' ),
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'list_icon',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'show_thumb' => 'off',
					'show_icon'  => 'on',
				),
			),

			'icon_color'            => array(
				'label'       => esc_html__( 'Icon Color', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Here you can define a custom color for list icons.', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'list_icon',
				'default'     => '#555',
				'show_if'     => array(
					'show_thumb' => 'off',
					'show_icon'  => 'on',
				),
			),

			'icon_spacing'          => array(
				'label'          => esc_html__( 'Icon Spacing', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Define spacing between icon and texts.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '20px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'list_icon',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'show_thumb' => 'off',
					'show_icon'  => 'on',
				),
			),

			// Image.
			'image_width'           => array(
				'label'          => esc_html__( 'Image Width', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Define static width for pot thumbnail.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '60px',
				'allowed_units'  => array( 'px' ),
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 300,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'show_thumb' => 'on',
				),
			),

			'image_height'          => array(
				'label'          => esc_html__( 'Image Height', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Define static height for pot thumbnail.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '60px',
				'allowed_units'  => array( 'px' ),
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 300,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'show_thumb' => 'on',
				),
			),

			'image_spacing'         => array(
				'label'          => esc_html__( 'Image Spacing', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Define spacing between image and texts.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '12px',
				'allowed_units'  => array( 'px' ),
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'show_thumb' => 'on',
				),
			),

			// Texts.
			'meta_spacing'          => array(
				'label'          => esc_html__( 'Meta Spacing Top', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Here you can define a custom spacing at the top of the meta area.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '0px',
				'allowed_units'  => array( 'px' ),
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'meta',
				'tab_slug'       => 'advanced',
			),

			'excerpt_spacing'       => array(
				'label'          => esc_html__( 'Excerpt Spacing Top', 'brain-divi-addons' ),
				'description'      => esc_html__( '.', 'brain-divi-addons' ),
				'type'           => 'range',
				'default'        => '0px',
				'allowed_units'  => array( 'px' ),
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'texts',
				'sub_toggle'     => 'content',
				'tab_slug'       => 'advanced',
			),

			'__posts'               => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'BA_Post_List', 'get_post' ),
				'computed_depends_on' => array(
					'post_type',
					'include_categories',
					'order_by',
					'order',
					'posts_number',
					'post_offset',
					'exclude_posts',
					'posts_only_with_image',
					'show_thumb',
					'show_icon',
					'list_icon',
					'show_excerpt',
					'excerpt_length',
					'show_author',
					'show_date',
					'date_format',
				),
			),

		);

		$post_bg = $this->custom_background_fields( 'post', 'Post', 'advanced', 'common', array( 'color', 'gradient', 'hover' ), array(), '' );

		return array_merge( $fields, $post_bg );
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['borders']['image'] = array(
			'label_prefix' => esc_html__( 'Image', 'brain-divi-addons' ),
			'toggle_slug'  => 'image',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-post-list figure',
					'border_styles' => '%%order_class%% .ba-post-list figure',
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

		$advanced_fields['borders']['post'] = array(
			'label_prefix' => esc_html__( 'Post', 'brain-divi-addons' ),
			'toggle_slug'  => 'common',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-post-list-child-inner',
					'border_styles' => '%%order_class%% .ba-post-list-child-inner',
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

		$advanced_fields['box_shadow']['post'] = array(
			'label'       => esc_html__( 'Post Box Shadow', 'brain-divi-addons' ),
			'toggle_slug' => 'common',
			'css'         => array(
				'main'      => '%%order_class%% .ba-post-list-child-inner',
				'important' => 'all',
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

		$advanced_fields['fonts']['title'] = array(
			'label'           => esc_html__( 'Title', 'brain-divi-addons' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-post-list-title',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'title',
			'font_size'       => array(
				'default' => '20px',
			),
			'hide_text_align' => true,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
		);

		$advanced_fields['fonts']['content'] = array(
			'label'           => esc_html__( 'Content', 'brain-divi-addons' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-post-list-excerpt',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'content',
			'hide_text_align' => true,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
			'font_size'       => array(
				'default' => '14px',
			),
		);

		$advanced_fields['fonts']['meta'] = array(
			'label'           => esc_html__( 'Meta', 'brain-divi-addons' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-post-list-meta, %%order_class%% .ba-post-list-meta a',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'meta',
			'hide_text_align' => true,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
		);

		return $advanced_fields;
	}

	static function get_post( $args = array(), $conditional_tags = array(), $current_page = array() ) {

		$defaults = array(
			'post_type'             => '',
			'include_categories'    => '',
			'order_by'              => '',
			'order'                 => '',
			'posts_number'          => '',
			'exclude_posts'         => '',
			'post_offset'           => '',
			'posts_only_with_image' => '',
			'show_thumb'            => '',
			'show_icon'             => '',
			'list_icon'             => '',
			'show_excerpt'          => '',
			'excerpt_length'        => '',
			'show_author'           => '',
			'show_date'             => '',
			'date_format'           => '',
		);

		$args                  = wp_parse_args( $args, $defaults );
		$post_type             = $args['post_type'];
		$include_categories    = $args['include_categories'];
		$order_by              = $args['order_by'];
		$order                 = $args['order'];
		$posts_number          = $args['posts_number'];
		$post_offset           = $args['post_offset'];
		$exclude_posts         = $args['exclude_posts'];
		$posts_only_with_image = $args['posts_only_with_image'];
		$show_thumb            = $args['show_thumb'];
		$show_icon             = $args['show_icon'];
		$list_icon             = esc_attr( et_pb_process_font_icon( $args['list_icon'] ) );
		$list_icon             = ! empty( $list_icon ) ? $list_icon : '9';
		$show_excerpt          = $args['show_excerpt'];
		$excerpt_length        = $args['excerpt_length'];
		$show_author           = $args['show_author'];
		$show_date             = $args['show_date'];
		$date_format           = $args['date_format'];

		$query_args = array(
			'posts_per_page' => intval( $posts_number ),
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'orderby'        => $order_by,
			'order'          => $order,
			'offset'         => intval( $post_offset ),
		);

		if ( 'on' === $posts_only_with_image ) {
			$query_args['meta_key'] = '_thumbnail_id';
		}

		if ( ! empty( $exclude_posts ) ) {
			$exclude_posts              = str_replace( ' ', '', $exclude_posts );
			$exclude_posts              = explode( ',', $exclude_posts );
			$query_args['post__not_in'] = $exclude_posts;
		}

		$post_id = isset( $current_page['id'] ) ? (int) $current_page['id'] : 0;

		if ( $post_type === 'post' ) {
			$query_args['cat'] = implode( ',', self::filter_include_categories( $include_categories, $post_id ) );
		}

		$query = new WP_Query( $query_args );

		ob_start();

		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
				$query->the_post();
				include 'templates/list-content.php';
			endwhile;
		endif;

		$output = ob_get_clean();

		if ( ! $output ) {
			$output = self::get_no_results_template();
		}

		return $output;
	}

	public function render( $attrs, $content = null, $render_slug ) {

		$this->render_css( $render_slug );

		$list_type             = $this->props['list_type'];
		$post_type             = $this->props['post_type'];
		$include_categories    = $this->props['include_categories'];
		$order_by              = $this->props['order_by'];
		$order                 = $this->props['order'];
		$posts_number          = $this->props['posts_number'];
		$exclude_posts         = $this->props['exclude_posts'];
		$post_offset           = $this->props['post_offset'];
		$posts_only_with_image = $this->props['posts_only_with_image'];
		$show_thumb            = $this->props['show_thumb'];
		$show_icon             = $this->props['show_icon'];
		$list_icon             = $this->props['list_icon'];
		$show_excerpt          = $this->props['show_excerpt'];
		$excerpt_length        = $this->props['excerpt_length'];
		$show_author           = $this->props['show_author'];
		$show_date             = $this->props['show_date'];
		$date_format           = $this->props['date_format'];

		$post_query_var = array(
			'post_type'             => $post_type,
			'include_categories'    => $include_categories,
			'order_by'              => $order_by,
			'order'                 => $order,
			'posts_number'          => $posts_number,
			'exclude_posts'         => $exclude_posts,
			'post_offset'           => $post_offset,
			'posts_only_with_image' => $posts_only_with_image,
			'show_thumb'            => $show_thumb,
			'show_icon'             => $show_icon,
			'list_icon'             => $list_icon,
			'show_excerpt'          => $show_excerpt,
			'excerpt_length'        => $excerpt_length,
			'show_author'           => $show_author,
			'show_date'             => $show_date,
			'date_format'           => $date_format,
		);

		return sprintf(
			'<div class="ba-module ba-post-list type-%2$s">
                <ul class="ba-post-list-parent">
                    %1$s
                </ul>
            </div>',
			self::get_post( $post_query_var ),
			$list_type
		);
	}

	protected function render_css( $render_slug ) {

		$alignment                         = $this->props['alignment'];
		$list_type                         = $this->props['list_type'];
		$show_thumb                        = $this->props['show_thumb'];
		$show_icon                         = $this->props['show_icon'];
		$items                             = $this->props['items'];
		$img_width_property                = 'flex';
		$items_tablet                      = ! empty( $this->props['items_tablet'] ) ? $this->props['items_tablet'] : $items;
		$items_phone                       = ! empty( $this->props['items_phone'] ) ? $this->props['items_phone'] : $items_tablet;
		$item_spacing                      = $this->props['item_spacing'];
		$item_spacing_tablet               = ! empty( $this->props['item_spacing_tablet'] ) ? $this->props['item_spacing_tablet'] : $item_spacing;
		$item_spacing_phone                = ! empty( $this->props['item_spacing_phone'] ) ? $this->props['item_spacing_phone'] : $item_spacing_tablet;
		$item_spacing_last_edited          = $this->props['item_spacing_last_edited'];
		$item_spacing_responsive_status    = et_pb_get_responsive_status( $item_spacing_last_edited );
		$image_spacing                     = $this->props['image_spacing'];
		$image_spacing_tablet              = $this->props['image_spacing_tablet'];
		$image_spacing_phone               = $this->props['image_spacing_phone'];
		$image_spacing_last_edited         = $this->props['image_spacing_last_edited'];
		$image_spacing_responsive_status   = et_pb_get_responsive_status( $image_spacing_last_edited );
		$icon_color                        = $this->props['icon_color'];
		$icon_size                         = $this->props['icon_size'];
		$icon_size_tablet                  = $this->props['icon_size_tablet'];
		$icon_size_phone                   = $this->props['icon_size_phone'];
		$icon_size_last_edited             = $this->props['icon_size_last_edited'];
		$icon_size_responsive_status       = et_pb_get_responsive_status( $icon_size_last_edited );
		$icon_spacing                      = $this->props['icon_spacing'];
		$icon_spacing_tablet               = $this->props['icon_spacing_tablet'];
		$icon_spacing_phone                = $this->props['icon_spacing_phone'];
		$icon_spacing_last_edited          = $this->props['icon_spacing_last_edited'];
		$icon_spacing_responsive_status    = et_pb_get_responsive_status( $icon_spacing_last_edited );
		$meta_spacing                      = $this->props['meta_spacing'];
		$meta_spacing_tablet               = $this->props['meta_spacing_tablet'];
		$meta_spacing_phone                = $this->props['meta_spacing_phone'];
		$meta_spacing_last_edited          = $this->props['meta_spacing_last_edited'];
		$meta_spacing_responsive_status    = et_pb_get_responsive_status( $meta_spacing_last_edited );
		$excerpt_spacing                   = $this->props['excerpt_spacing'];
		$excerpt_spacing_tablet            = $this->props['excerpt_spacing_tablet'];
		$excerpt_spacing_phone             = $this->props['excerpt_spacing_phone'];
		$excerpt_spacing_last_edited       = $this->props['excerpt_spacing_last_edited'];
		$excerpt_spacing_responsive_status = et_pb_get_responsive_status( $excerpt_spacing_last_edited );
		$item_padding                      = $this->props['item_padding'];
		$item_padding_tablet               = $this->props['item_padding_tablet'];
		$item_padding_phone                = $this->props['item_padding_phone'];
		$item_padding_last_edited          = $this->props['item_padding_last_edited'];
		$item_padding_responsive_status    = et_pb_get_responsive_status( $item_padding_last_edited );

		$spacing_term = 'bottom';
		if ( 'left' === $alignment ) {
			$spacing_term = 'right';

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-child-inner',
					'declaration' => 'align-items: flex-start;',
				)
			);
		} elseif ( 'right' === $alignment ) {
			$spacing_term = 'left';
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-child-inner',
					'declaration' => 'flex-direction: row-reverse;align-items: flex-start;',
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-meta',
					'declaration' => 'justify-content: flex-end;',
				)
			);
		} else {
			$img_width_property = 'width';

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-child-inner',
					'declaration' => 'flex-direction: column;align-items: center;',
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-meta',
					'declaration' => 'justify-content: center;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-post-list-child-inner',
				'declaration' => 'text-align:' . $alignment . '!important;',
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-post-list-child-inner',
				'declaration' => $this->process_margin_padding( $item_padding, 'padding', false ),
			)
		);

		if ( $item_padding_tablet && $item_padding_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-child-inner',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => $this->process_margin_padding( $item_padding_tablet, 'padding', false ),
				)
			);
		}

		if ( $item_padding_phone && $item_padding_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-child-inner',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => $this->process_margin_padding( $item_padding_phone, 'padding', false ),
				)
			);
		}

		if ( 'grid' === $list_type ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-child',
					'declaration' => sprintf(
						'
                    flex: 0 0 calc(100%%/%1$s);
                    max-width:calc(100%%/%1$s);
                    padding:%2$s;',
						$items,
						$item_spacing
					),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-parent',
					'declaration' => sprintf( 'margin: -%1$s;', $item_spacing ),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-child',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf(
						'flex: 0 0 calc(100%%/%1$s);
                    	max-width:calc(100%%/%1$s);
                    	padding:%2$s;',
						$items_tablet,
						$item_spacing_tablet
					),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-parent',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'margin: -%1$s;', $item_spacing_tablet ),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-child',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf(
						'flex: 0 0 calc(100%%/%1$s);
						max-width:calc(100%%/%1$s);
						padding:%2$s;',
						$items_phone,
						$item_spacing_phone
					),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-parent',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'margin: -%1$s;', $item_spacing_phone ),
				)
			);
		} elseif ( 'list' === $list_type ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-child',
					'declaration' => sprintf( 'padding-bottom:%1$s;', $item_spacing ),
				)
			);

			if ( ! empty( $item_spacing_tablet ) && $item_spacing_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-post-list-child',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
						'declaration' => sprintf( 'padding-bottom:%1$s;', $item_spacing_tablet ),
					)
				);
			}

			if ( ! empty( $item_spacing_phone ) && $item_spacing_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-post-list-child',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
						'declaration' => sprintf( 'padding-bottom:%1$s;', $item_spacing_phone ),
					)
				);
			}
		}

		// texts.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-post-list-meta',
				'declaration' => sprintf( 'padding-top:%1$s;', $meta_spacing ),
			)
		);

		if ( ! empty( $meta_spacing_tablet ) && $meta_spacing_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-meta',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'padding-top:%1$s;', $meta_spacing_tablet ),
				)
			);
		}

		if ( ! empty( $meta_spacing_phone ) && $meta_spacing_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-meta',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'padding-top:%1$s;', $meta_spacing_phone ),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-post-list-content p',
				'declaration' => sprintf( 'padding-top:%1$s;', $excerpt_spacing ),
			)
		);

		if ( ! empty( $excerpt_spacing_tablet ) && $excerpt_spacing_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-content p',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'padding-top:%1$s;', $excerpt_spacing_tablet ),
				)
			);
		}

		if ( ! empty( $excerpt_spacing_phone ) && $excerpt_spacing_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-content p',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'padding-top:%1$s;', $excerpt_spacing_phone ),
				)
			);
		}

		// Thumbnail.
		if ( 'on' === $show_thumb ) {
			$this->get_responsive_styles(
				'image_width',
				'%%order_class%% .ba-post-list-thumb',
				array(
					'primary'   => $img_width_property,
					'important' => true,
				),
				array( 'default' => '60px' ),
				$render_slug
			);

			$this->get_responsive_styles(
				'image_height',
				'%%order_class%% .ba-post-list-thumb',
				array(
					'primary'   => 'height',
					'important' => true,
				),
				array( 'default' => '60px' ),
				$render_slug
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-thumb',
					'declaration' => sprintf( 'margin-%2$s:%1$s;', $image_spacing, $spacing_term ),
				)
			);

			if ( ! empty( $image_spacing_tablet ) && $image_spacing_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-post-list-thumb',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
						'declaration' => sprintf( 'margin-%2$s:%1$s;', $image_spacing_tablet, $spacing_term ),
					)
				);
			}

			if ( ! empty( $image_spacing_phone ) && $image_spacing_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-post-list-thumb',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
						'declaration' => sprintf( 'margin-%2$s:%1$s;', $image_spacing_phone, $spacing_term ),
					)
				);
			}
		}

		if ( 'on' === $show_icon ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-icon',
					'declaration' => sprintf( 'font-size:%1$s;color: %2$s;', $icon_size, $icon_color ),
				)
			);

			if ( ! empty( $icon_size_tablet ) && $icon_size_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-post-list-icon',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
						'declaration' => sprintf( 'font-size:%1$s;', $icon_size_tablet ),
					)
				);
			}

			if ( ! empty( $icon_size_phone ) && $icon_size_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-post-list-icon',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
						'declaration' => sprintf( 'font-size:%1$s;', $icon_size_phone ),
					)
				);
			}
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-post-list-icon',
					'declaration' => sprintf( 'margin-%2$s:%1$s;', $icon_spacing, $spacing_term ),
				)
			);

			if ( ! empty( $icon_spacing_tablet ) && $icon_spacing_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-post-list-icon',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
						'declaration' => sprintf( 'margin-%2$s:%1$s;', $icon_spacing_tablet, $spacing_term ),
					)
				);
			}

			if ( ! empty( $icon_spacing_phone ) && $icon_spacing_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .ba-post-list-icon',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
						'declaration' => sprintf( 'margin-%2$s:%1$s;', $icon_spacing_phone, $spacing_term ),
					)
				);
			}
		}

		// Title bg.
		$this->get_custom_bg_style( $render_slug, 'post', '%%order_class%% .ba-post-list-child a', '%%order_class%%:hover .ba-post-list-child a' );

	}
}

new BA_Post_List();
