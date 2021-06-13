<?php

$class_array = array(
    'ba-popup',
    'ba-popup-front-mode',
    'ba-popup-hide-state',
    'ba-popup-animation-' . $animation,
    'ba-popup-custom-height-' . $popup_settings['ba_use_container_height'],
);

$class_attr     = implode( ' ', $class_array );
$popup_styles   = ba_custom_css( esc_attr( $popup_id ) );

?>
<div id="ba-popup-<?php echo esc_attr( $popup_id ); ?>" class="<?php echo esc_attr( $class_attr ); ?>" data-settings="<?php echo esc_attr( $popup_json_data ); ?>">
	<div class="ba-popup-inner">
		<?php echo $overlay_html; //phpcs:ignore     ?>
		<div class="ba-popup-container">
			<div class="ba-popup-container-inner">
				<div class="ba-popup-container-overlay"></div>
				<div class="ba-popup-container-content">
					<?php
						$this->print_location_content( esc_attr( $popup_id ) );
						$styles['et-builder-advanced-style']    = ET_Builder_Element::get_style();
						$styles['et-builder-page-custom-style'] = et_pb_get_page_custom_css();
						foreach ( $styles as $style_id => $style ) {
							if ( !$style ) {
								continue;
							}
							$style = str_replace( "body #page-container", " ", $style );
							echo '<style type="text/css" id="ba-style-popup-' . $style_id . '"> ' . $style . ' </style>'; //phpcs:ignore
						}
					?>
				</div>
			</div>
			<?php echo $close_button_html; //phpcs:ignore     ?>
		</div>
	</div>
</div>
<style type="text/css" id="ba-popup-style-<?php echo esc_attr( $popup_id ); ?>">
	<?php echo esc_attr( $popup_styles ); ?>
</style>