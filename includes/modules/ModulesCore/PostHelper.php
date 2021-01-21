<?php
class BaPostHelper {

	public static function get_post_thumb( $args, $render_empty_figure ) {

		$thumb_id               = get_post_thumbnail_id( get_the_ID() );
		$alt                    = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
		$overlay_icon           = $args['overlay_icon'];
		$processed_overlay_icon = esc_attr( et_pb_process_font_icon( $overlay_icon ) );
		$overlay_icon           = ! empty( $processed_overlay_icon ) ? $processed_overlay_icon : '';

		if ( has_post_thumbnail() ) {
			return sprintf(
				'
                <figure class="ba-post-thumb">
                    <a href="%1$s">
                        <div class="ba-overlay" data-icon="%4$s"></div>
                        <img src="%2$s" alt="%3$s">
                    </a>
                </figure>',
				esc_url( get_the_permalink() ),
				esc_url( get_the_post_thumbnail_url() ),
				$alt,
				$overlay_icon
			);
		} else {
			if ( $render_empty_figure === true ) {
				return '<figure class="ba-post-thumb ba-empty-thumb"></figure>';
			}
		}
	}

	public static function get_post_title( $tag ) {
		return sprintf(
			'
            <%1$s class="ba-post-title">
                <a href="%2$s">%3$s</a>
            </%1$s>
        ',
			$tag,
			esc_url( get_the_permalink() ),
			get_the_title()
		);
	}

	public static function get_post_categories() {
		return '<div class="ba-post-categories">' . et_builder_get_the_term_list( ', ' ) . '</div>';
	}

	public static function get_post_button(
		$button_text = 'Read More',
		$icon_name = '5',
		$classes = ''
		) {
		return sprintf(
			'
            <div class="ba-post-btn-wrap %4$s">
                <a href="%1$s" target="_self" class="et_pb_button ba-post-btn" data-icon="%2$s">
                    %3$s
                </a>
            </div>',
			esc_url( get_the_permalink() ),
			$icon_name,
			$button_text,
			$classes
		);
	}

	public static function get_post_excerpt( $length = '-1' ) {
		global $post;
		$content = '';

		if ( ! has_excerpt() ) {

			$content = $post->post_content;
			$content = preg_replace( '@\[caption[^\]]*?\].*?\[\/caption]@si', '', $content );
			$content = preg_replace( '@\[et_pb_post_nav[^\]]*?\].*?\[\/et_pb_post_nav]@si', '', $content );
			$content = preg_replace( '@\[audio[^\]]*?\].*?\[\/audio]@si', '', $content );
			$content = preg_replace( '@\[embed[^\]]*?\].*?\[\/embed]@si', '', $content );
			$content = wp_strip_all_tags( $content );
			$content = et_builder_strip_dynamic_content( $content );
			$content = apply_filters( 'et_truncate_post', $content, get_the_ID() );
		} else {

			$content = apply_filters( 'the_excerpt', $post->post_excerpt );
		}

		if ( $length > 0 ) {

			if ( strlen( $content ) <= $length ) {

				$str_end = '';
			} else {

				$str_end = '...';
			}

			$content = rtrim( et_wp_trim_words( $content, $length, '' ) );

			if ( ! empty( $str_end ) ) {

				$new_words_array = (array) explode( ' ', $content );
				array_pop( $new_words_array );
				$content  = implode( ' ', $new_words_array );
				$content .= $str_end;
			}

			return et_core_intentionally_unescaped( $content, 'html' );
		} else {

			return et_core_intentionally_unescaped( $content, 'html' );
		}
	}

	public static function get_post_excerpt_html( $length = '-1' ) {
		return sprintf( '<div class="ba-post-excerpt">%1$s</div>', self::get_post_excerpt( $length ) );
	}

}
