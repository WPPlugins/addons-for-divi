<?php

defined( 'ABSPATH' ) || die();

$modules             = self::get_modules();
$inactive_modules    = self::get_inactive_modules();
$total_modules_count = count( $modules );

?>

<div class="ba-admin-panel">
	<div class="ba-modules-body">
		<form class="ba-form-admin ba-modules-admin" id="ba-admin-modules-form">
			<div class="ba-row ba-admin-modules-row">
				<div class="ba-col">
					<div class="ba-admin-modules">
					<?php
						foreach ( $modules as $module_key => $module_data ) :

							$title      = isset( $module_data['title'] ) ? $module_data['title'] : '';
							$icon       = isset( $module_data['icon'] ) ? $module_data['icon'] : '';
							$is_pro     = isset( $module_data['is_pro'] ) && $module_data['is_pro'] ? true : false;
							$demo_url   = isset( $module_data['demo'] ) && $module_data['demo'] ? $module_data['demo'] : '';
							$class_attr = 'ba-admin-modules-item';
							$checked = '';

							if ( $is_pro ) {
								$class_attr .= ' ba-module-is-pro';
							}
							if ( !in_array( $module_key, $inactive_modules ) ) {
								$checked = 'checked="checked"';
							}

							$is_placeholder = $is_pro && !divitorque_has_pro();
							
							if ( $is_placeholder ) {
								$class_attr .= ' ba-module-is-placeholder';
								$checked = 'disabled="disabled"';
							}

					?>

							<div class="<?php echo $class_attr; ?>">
								
							<?php if ( $is_placeholder ): ?>
									<span class="ba-admin-modules-item-badge badge-pro">pro</span>
								<?php endif;?>

							<span class="ba-admin-modules-item-icon ba-icon-svg">
								<?php echo et_core_intentionally_unescaped( BrainAddons_Static_Icons::icon( $icon ), 'html' ); ?>
							</span>
							<h3 class="ba-admin-modules-item-title">
								<label for="ba-module-<?php echo $module_key; ?>"><?php echo $title; ?></label>
								<?php if ( $demo_url ): ?>
									<a href="<?php echo esc_url( $demo_url ); ?>"
										target="_blank"
										rel="noopener"
										data-tooltip="<?php echo esc_attr_e( 'Click and view demo', 'addons-for-divi' ); ?>"
										class="ba-admin-modules-item-preview">
										<img class="ba-img-fluid ba-item-icon-size" src="<?php echo DIVI_TORQUE_PLUGIN_ASSETS . '/imgs/admin/desktop.svg'; ?>" alt="demo-link">
									</a>
								<?php endif;?>
							</h3>
							<div class="ba-admin-modules-item-toggle ba-toggle">
								<input
									id="ba-module-<?php echo $module_key; ?>" <?php echo $checked; ?>
									type="checkbox"
									class="ba-toggle-check"
									name="modules[]"
									value="<?php echo $module_key; ?>"
								>
								<b class="ba-toggle-switch"></b>
								<b class="ba-toggle-track"></b>
							</div>
						</div>

						<?php
							endforeach;
						?>

					</div>
				</div>
			</div>

			<div class="ba-row ba-admin-button-panel">
				<div class="ba-col">
					<button disabled class="ba-btn ba-btn-save ba-btn-lg" type="submit">
						<?php esc_html_e( 'Save Settings', 'addons-for-divi' );?>
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
