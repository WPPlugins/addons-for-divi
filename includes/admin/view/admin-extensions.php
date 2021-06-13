<?php
	$extensions             = self::get_extensions();
	$inactive_extensions    = self::get_inactive_extensions();
	$total_extensions_count = count( $extensions );
?>
<div class="ba-admin-panel">
	<div class="ba-extensions-body">
		<form class="ba-extensions-admin" id="ba-admin-extensions-form">
		<div class="ba-row">
			<div class="ba-col">
				<h2 class="ba-section-title">
					<?php esc_html_e( 'Extensions', 'brain-divi-addons' ); ?>
				</h2>
				<p class="ba-text f18">
				You can disable the modules you are not using on your site. That will disable all associated assets of those modules to improve your site loading.
				</p>
			</div>
		</div>

		<div class="ba-admin-extensions">
			<?php
				foreach ( $extensions as $extension_key => $extension_data ) :
					$title    = isset( $extension_data['title'] ) ? $extension_data['title'] : '';
					$desc     = isset( $extension_data['desc'] ) ? $extension_data['desc'] : '';
					$icon     = isset( $extension_data['icon'] ) ? $extension_data['icon'] : '';
					$demo_url = isset( $extension_data['demo'] ) && $extension_data['demo'] ? $extension_data['demo'] : '';
					$class_attr = 'ba-admin-extensions-item';
					$badge = '';
					$checked = '';

					if ( ! in_array( $extension_key, $inactive_extensions ) ) {
						$checked = 'checked="checked"';
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
						<p class="ba-text f16">
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
				<?php
					endforeach;
				?>
		</div>

		<div class="ba-row ba-admin-button-panel">
			<div class="ba-col">
				<button disabled class="ba-btn ba-btn-save ba-btn-lg" type="submit">
					<?php esc_html_e( 'Save Settings', 'brain-divi-addons' ); ?>
				</button>
			</div>
		</div>
		</form>
	</div>
</div>
