<?php
class BA_News_Ticker extends BA_Builder_Module_Type_PostBased {

	public $slug       = 'ba_news_ticker';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'https://divi.brainaddons.com/demo/news-ticker/',
		'author'     => 'BrainAddons',
		'author_uri' => 'https://brainaddons.com/',
	);

	public function init() {
		$this->name = esc_html__( 'Brain News Ticker', 'brain-divi-addons' );
		$this->icon_path = plugin_dir_path( __FILE__ ) . 'post-ticker.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content'  => esc_html__( 'Content', 'brain-divi-addons' ),
					'settings' => esc_html__( 'Settings', 'brain-divi-addons' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'title'      => esc_html__( 'Title Style', 'brain-divi-addons' ),
					'title_text' => esc_html__( 'Title Text', 'brain-divi-addons' ),
					'text'       => esc_html__( 'News Text', 'brain-divi-addons' ),
					'border'     => esc_html__( 'Border', 'brain-divi-addons' ),
				),
			),
		);
	}

	public function get_fields() {

		$fields = array(

			// Content.
			'use_title'          => array(
				'label'           => esc_html__( 'Use Title', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'on',
				'toggle_slug'     => 'content',
			),

			'title'              => array(
				'label'       => esc_html__( 'Title Text', 'brain-divi-addons' ),
				'type'        => 'text',
				'default'     => 'Breaking News',
				'toggle_slug' => 'content',
				'show_if'     => array(
					'use_title' => 'on',
				),
			),

			'include_categories' => array(
				'label'            => esc_html__( 'Included Categories', 'brain-divi-addons' ),
				'type'             => 'categories',
				'renderer_options' => array(
					'use_terms' => false,
				),
				'option_category'  => 'basic_option',
				'toggle_slug'      => 'content',
				'computed_affects' => array( '__news' ),
			),

			'order_by'           => array(
				'label'            => esc_html__( 'Order By', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Choose how your News should be ordered.', 'brain-divi-addons' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'toggle_slug'      => 'content',
				'default'          => 'date',
				'options'          => array(
					'date'  => esc_html__( 'Date', 'brain-divi-addons' ),
					'title' => esc_html__( 'Title', 'brain-divi-addons' ),
				),

				'default_on_front' => 'date',
				'computed_affects' => array( '__news' ),
			),

			'order'              => array(
				'label'            => esc_html__( 'Sorted By', 'brain-divi-addons' ),
				'description'      => esc_html__( 'Choose how your News should be sorted.', 'brain-divi-addons' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'toggle_slug'      => 'content',
				'default'          => 'ASC',
				'options'          => array(
					'ASC'  => esc_html__( 'Ascending', 'brain-divi-addons' ),
					'DESC' => esc_html__( 'Descending', 'brain-divi-addons' ),
				),
				'default_on_front' => 'ASC',
				'computed_affects' => array( '__news' ),
			),

			'news_count'         => array(
				'label'            => esc_html__( 'News Limit', 'brain-divi-addons' ),
				'type'             => 'text',
				'default'          => '5',
				'toggle_slug'      => 'content',
				'computed_affects' => array( '__news' ),
			),
			'exclude_posts'      => array(
				'label'            => esc_html__( 'Exclude news by IDs', 'brain-divi-addons-pro' ),
				'description'      => esc_html__( 'eg. 10, 22, 19 etc. If this is used by IDs, Selected news will be ignored.', 'brain-divi-addons-pro' ),
				'type'             => 'text',
				'toggle_slug'      => 'content',
				'computed_affects' => array( '__news' ),
			),
			'post_offset'        => array(
				'label'            => esc_html__( 'News Offset', 'brain-divi-addons-pro' ),
				'type'             => 'range',
				'default'          => '0',
				'unitless'         => true,
				'range_settings'   => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'toggle_slug'      => 'content',
				'computed_affects' => array( '__news' ),
			),

			// settings.
			'title_pos'          => array(
				'label'            => esc_html__( 'Title Position', 'brain-divi-addons' ),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options( array( 'justified', 'center' ) ),
				'options_icon'     => 'module_align',
				'default_on_front' => 'left',
				'toggle_slug'      => 'settings',
				'show_if'          => array(
					'use_title' => 'on',
				),
			),
			'speed'              => array(
				'label'          => esc_html__( 'Moving Speed', 'brain-divi-addons' ),
				'type'           => 'range',
				'fixed_unit'     => 'ms',
				'default_unit'   => 'ms',
				'default'        => '30000ms',
				'range_settings' => array(
					'min'  => 1000,
					'step' => 1000,
					'max'  => 100000,
				),
				'toggle_slug'    => 'settings',
			),
			'slide_dir'          => array(
				'label'            => esc_html__( 'Moving Direction', 'brain-divi-addons' ),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options( array( 'justified', 'center' ) ),
				'options_icon'     => 'module_align',
				'default_on_front' => 'left',
				'toggle_slug'      => 'settings',
			),
			'item_spacing'       => array(
				'label'          => esc_html__( 'Item Spacing', 'brain-divi-addons' ),
				'type'           => 'range',
				'fixed_unit'     => 'px',
				'default_unit'   => 'px',
				'default'        => '20px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 250,
				),
				'toggle_slug'    => 'settings',
			),
			'pause_on_hover'     => array(
				'label'           => esc_html__( 'Pause on Hover ', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'on',
				'toggle_slug'     => 'settings',
			),
			'use_bullet'         => array(
				'label'           => esc_html__( 'Use Bullet Before Item', 'brain-divi-addons' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'brain-divi-addons' ),
					'off' => esc_html__( 'No', 'brain-divi-addons' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'settings',
			),
			'bullet_color'       => array(
				'label'       => esc_html__( 'Bullet Color', 'brain-divi-addons' ),
				'type'        => 'color-alpha',
				'toggle_slug' => 'settings',
				'default'     => '#8a8585',
				'show_if'     => array(
					'use_bullet' => 'on',
				),
			),

			// title.
			'title_padding'      => array(
				'label'          => __( 'Title Padding', 'brain-divi-addons' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'title',
				'default'        => '20px|20px|20px|20px',
				'mobile_options' => true,
			),

			'__news'             => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'BA_News_Ticker', 'get_news' ),
				'computed_depends_on' => array(
					'include_categories',
					'news_count',
					'exclude_posts',
					'post_offset',
					'order_by',
					'order',
				),
			),

		);

		$title_bg = $this->custom_background_fields( 'title', 'Title', 'advanced', 'title', array( 'color', 'gradient', 'hover' ), array(), '#333' );

		return array_merge( $fields, $title_bg );
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['borders']['title'] = array(
			'label_prefix' => esc_html__( 'Title', 'brain-divi-addons' ),
			'toggle_slug'  => 'title',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .ba-news-title',
					'border_styles' => '%%order_class%% .ba-news-title',
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

		$advanced_fields['fonts']['title'] = array(
			'label'           => esc_html__( 'Title', 'brain-divi-addons' ),
			'css'             => array(
				'main'      => '%%order_class%% .ba-news-title',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'title_text',
			'font_size'       => array(
				'default' => '16px',
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

		$advanced_fields['fonts']['text'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .ba-news-wrap li',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'text',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '14px',
			),
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

	public static function get_news( $args = array(), $conditional_tags = array(), $current_page = array() ) {
		$defaults = array(
			'include_categories' => '',
			'order_by'           => '',
			'order'              => '',
			'news_count'         => '',
			'post_offset'        => '',
			'exclude_posts'      => '',
		);

		$args               = wp_parse_args( $args, $defaults );
		$include_categories = $args['include_categories'];
		$order_by           = $args['order_by'];
		$order              = $args['order'];
		$news_count         = $args['news_count'];
		$exclude_posts      = $args['exclude_posts'];
		$post_offset        = $args['post_offset'];

		$query_args = array(
			'posts_per_page' => intval( $news_count ),
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'orderby'        => $order_by,
			'order'          => $order,
			'offset'         => intval( $post_offset ),
		);

		if ( ! empty( $exclude_posts ) ) {
			$exclude_posts              = str_replace( ' ', '', $exclude_posts );
			$exclude_posts              = explode( ',', $exclude_posts );
			$query_args['post__not_in'] = $exclude_posts;
		}

		$post_id           = isset( $current_page['id'] ) ? (int) $current_page['id'] : 0;
		$query_args['cat'] = implode( ',', self::filter_include_categories( $include_categories, $post_id ) );
		$query             = new WP_Query( $query_args );

		ob_start();

		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
				$query->the_post();
				echo '<li><a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li>';
			endwhile;
		endif;

		$output = ob_get_clean();

		if ( ! $output ) {
			$output = '<li>No News Found</li>';
		}

		return $output;
	}



	protected function render_title() {
		$use_title = $this->props['use_title'];
		$title     = $this->props['title'];

		if ( 'on' === $use_title ) {
			return sprintf( '<div class="ba-news-title">%1$s</div>', $title );
		}
	}

	public function render( $attrs, $content = null, $render_slug ) {

		$this->render_css( $render_slug );

		$include_categories = $this->props['include_categories'];
		$order_by           = $this->props['order_by'];
		$order              = $this->props['order'];
		$news_count         = $this->props['news_count'];
		$post_offset        = $this->props['post_offset'];
		$exclude_posts      = $this->props['exclude_posts'];

		$post_query_var = array(
			'include_categories' => $include_categories,
			'order_by'           => $order_by,
			'order'              => $order,
			'news_count'         => $news_count,
			'post_offset'        => $post_offset,
			'exclude_posts'      => $exclude_posts,
		);

		return sprintf(
			'<div class="ba-module ba-news-tricker">
                %1$s
                <div id="parent" class="ba-news-container">
                    <ul class="ba-news-wrap">
                        %2$s
                    </ul>
                </div>
            </div>',
			$this->render_title(),
			self::get_news( $post_query_var )
		);
	}

	protected function render_css( $render_slug ) {

		$title_pos                       = $this->props['title_pos'];
		$speed                           = $this->props['speed'];
		$use_bullet                      = $this->props['use_bullet'];
		$slide_dir                       = 'right' === $this->props['slide_dir'] ? 'reverse' : 'normal';
		$bullet_color                    = $this->props['bullet_color'];
		$item_spacing                    = $this->props['item_spacing'];
		$pause_on_hover                  = $this->props['pause_on_hover'];
		$title_padding                   = $this->props['title_padding'];
		$title_padding_tablet            = $this->props['title_padding_tablet'];
		$title_padding_phone             = $this->props['title_padding_phone'];
		$title_padding_last_edited       = $this->props['title_padding_last_edited'];
		$title_padding_responsive_status = et_pb_get_responsive_status( $title_padding_last_edited );

		if ( 'on' === $use_bullet ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-news-wrap li a',
					'declaration' => 'display: inline-block; position:relative;',
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-news-wrap li a:before',
					'declaration' => sprintf(
						'
                    content: "";
                    position: absolute;
                    height: 6px;
                    width: 6px;
                    background: %1$s;
                    top: 50%%;
                    left: -15px;
                    transform: translateY(-50%%);
                    border-radius: 50%%;',
						$bullet_color
					),
				)
			);
		}

		// title Padding.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-news-title',
				'declaration' => $this->process_margin_padding( $title_padding, 'padding', false ),
			)
		);

		// title Padding Tablet.
		if ( $title_padding_tablet && $title_padding_responsive_status ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-news-title',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => $this->process_margin_padding( $title_padding_tablet, 'padding', false ),
				)
			);
		}

		// title Padding Phone.
		if ( $title_padding_phone && $title_padding_responsive_status ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-news-title',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => $this->process_margin_padding( $title_padding_phone, 'padding', false ),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-news-wrap',
				'declaration' => sprintf(
					'
                animation: %1$s linear 0s infinite %2$s none running news-move;',
					$speed,
					$slide_dir
				),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .ba-news-wrap li',
				'declaration' => sprintf(
					'
                padding: 0 %1$s;',
					$item_spacing
				),
			)
		);

		if ( 'on' === $pause_on_hover ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%:hover .ba-news-wrap',
					'declaration' => '
                    -webkit-animation-play-state: paused!important;
                    animation-play-state: paused!important;',
				)
			);
		}

		if ( 'right' === $title_pos ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-news-tricker',
					'declaration' => 'flex-direction: row-reverse;',
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-news-title',
					'declaration' => 'margin-left: 10px;',
				)
			);
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .ba-news-title',
					'declaration' => 'margin-right: 10px;',
				)
			);
		}

		// title bg.
		$this->get_custom_bg_style( $render_slug, 'title', '%%order_class%% .ba-news-title', '%%order_class%%:hover .ba-news-title' );

	}
}

new BA_News_Ticker();
