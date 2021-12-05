<div class="ba-admin wrapper">
	<h1 class="screen-reader-text"><?php esc_html_e( 'DiviTorque Settings', 'addons-for-divi' ); ?></h1>
	<div class="ba-admin-header">
		<div class="ba-admin-logo-inline">
			<?php $logo_url = DIVI_TORQUE_PLUGIN_ASSETS . 'imgs/admin/'; ?>
			<div class="ba-header-left">
				<?php esc_attr_e( 'DiviTorque Settings', 'addons-for-divi' ); ?>
			</div>
		</div>
		<div class="ba-nav" role="tablist">
			<nav class="ba-tabs-nav">
				<?php
					$tab_count = 1;

				foreach ( self::get_tabs() as $slug => $tab ) :

					$slug = esc_attr( strtolower( $slug ) );
					if ( divitorque_has_pro() && 'pro' === $slug ) {
						continue;
					}

					$class = ' ba-admin-nav-item-link';
					if ( $tab_count === 1 ) {
						$class .= ' active-tab';
					}

					if ( ! empty( $tab['href'] ) ) {
						$href = esc_url( $tab['href'] );
					} else {
						$href = '#' . $slug;
					}

					printf(
						'<a href="%1$s" aria-controls="tab-content-%2$s" id="tab-nav-%2$s" class="%3$s" role="tab">
							<span>%4$s</span>
                        </a>',
						$href,
						$slug,
						$class,
						$tab['title']
					);

					++$tab_count;
					endforeach;
				?>
			</nav>
		</div>
	</div>

	<?php if ( ! divitorque_has_pro() ) : ?>
	<div class="baa-get-pro-notify">
		<?php $badge_url = DIVI_TORQUE_PLUGIN_ASSETS . 'imgs/admin/'; ?>
		<img class="baa-fly" src="<?php echo $badge_url; ?>/fly.webp" alt="">
		<div class="baa-ct-left">
			<h2>DiviTorque Pro</h2>
			<h3>Unlock a Faster Divi Experience</h3>
		</div>
		<div class="baa-ct-right">
			<a class="baa-btn-pro" href="https://divitorque.com/pricing/">UPGRADE TO PRO</a>
			<img src="<?php echo $badge_url; ?>/sale-price.svg" alt="">
		</div>
	</div>
	<?php endif; ?>

	<div class="ba-admin-tabs">
		<div class="ba-admin-tabs-content">
			<?php
				$tab_count = 1;

			foreach ( self::get_tabs() as $slug => $tab ) :

				$class = 'ba-admin-tabs-content-item';

				if ( $tab_count === 1 ) {
					$class .= ' active-tab';
				}

				if ( divitorque_has_pro() && 'pro' === $slug ) {
					continue;
				}

				$slug = esc_attr( strtolower( $slug ) );

				?>
					<div class="<?php echo $class; ?>" id="tab-content-<?php echo $slug; ?>" role="tabpanel" aria-labelledby="tab-nav-<?php echo $slug; ?>">
					<?php call_user_func( $tab['renderer'], $slug, $tab ); ?>
					</div>
				<?php
				++$tab_count;
				endforeach;
			?>
		</div>
	</div>
</div>
