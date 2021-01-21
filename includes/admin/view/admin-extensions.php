<?php

$extensions             = self::get_extensions();
$inactive_extensions    = self::get_inactive_extensions();
$total_extensions_count = count( $extensions );

?>
<div class="ba-admin-panel">
	<div class="ba-extensions-body">
		<div class="ba-row ba-admin-extensions-row">
			<div class="ba-col">
				<div class="ba-admin-extensions">

					<?php
					foreach ( $extensions as $extension_key => $extension_data ) :

						$title    = isset( $extension_data['title'] ) ? $extension_data['title'] : '';
						$desc     = isset( $extension_data['desc'] ) ? $extension_data['desc'] : '';
						$icon     = isset( $extension_data['icon'] ) ? $extension_data['icon'] : '';
						$demo_url = isset( $extension_data['demo'] ) && $extension_data['demo'] ? $extension_data['demo'] : '';

						$class_attr = 'ba-admin-extensions-item';

						$checked = '';

						if ( ! in_array( $extension_key, $inactive_extensions ) ) {
							$checked = 'checked="checked"';
						}

						if ( empty( $demo_url ) ) {
							$class_attr .= ' ba-extensions-is-placeholder';
							$checked     = 'disabled="disabled"';
						}

						$badge = '';
						if ( empty( $demo_url ) ) {
							$badge = sprintf(
								'<span class="ba-ext-badge ba-text f11">%1$s</span>',
								__( 'UPCOMING', 'brain-divi-addons' )
							);
						}

						?>

					<div class="<?php echo $class_attr; ?>">

						<div class="ba-admin-icon">
							<i class="dashicons dashicons-admin-plugins centered"></i>
						</div>

						<div class="ba-admin-content">
							<div class="ba-admin-extensions-item-title ba-text f20">
								<?php echo $title . ' ' . $badge; ?>
							</div>
							<p class="ba-text f15">
								<?php echo $desc; ?>
							</p>
						</div>

						<div class="ba-toggle-action">
							<div class="ba-admin-extensions-item-toggle ba-toggle">
								<input 
									id="ba-extension-<?php echo $extension_key; ?>" <?php echo $checked; ?> 
									type="checkbox" 
									class="ba-ext-switch ba-toggle-check" 
									name="extensions[]" 
									value="<?php echo $extension_key; ?>"
								>
								<b class="ba-toggle-switch"></b>
								<b class="ba-toggle-track"></b>
							</div>
						</div>
					</div>
					<div class="divider"></div>
						<?php
						endforeach;
					?>
				</div>
			</div>
		</div>
	</div>
</div>
