<div class="ba-admin wrapper">
	<h1 class="screen-reader-text"><?php esc_html_e( 'BrainAddons Options', 'brain-divi-addons' ); ?></h1>
	<div class="ba-admin-header">
		<div class="ba-admin-logo-inline">
			<?php $logo_url = BRAIN_ADDONS_PLUGIN_ASSETS . 'imgs/admin/'; ?>
			<div class="ba-header-left">
				<div class="ba-admin-logo-inline-svg">
					<img class="ba-logo-icon-size" src="<?php echo $logo_url . 'brain-addons-icon.svg'; ?>" alt="BrainAddons">
				</div> 
				<?php esc_attr_e( 'Brain Addons Settings', 'brain-divi-addons' ); ?>
			</div>
		</div>
		<div class="ba-nav" role="tablist">
			<nav class="ba-tabs-nav">
				<?php
					$tab_count = 1;

				foreach ( self::get_tabs() as $slug => $tab ) :

					$slug = esc_attr( strtolower( $slug ) );
					if ( ba_has_pro() && 'pro' === $slug ) {
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
							<img src="%4$s" alt="%5$s">
							<span>%5$s</span>
                        </a>',
						$href,
						$slug,
						$class,
						$tab['icon'],
						$tab['title']
					);

					++$tab_count;
					endforeach;
				?>
			</nav>
		</div>
	</div>
	<div class="ba-admin-tabs">
		<div class="ba-admin-tabs-content">
			<?php
				$tab_count = 1;

				foreach ( self::get_tabs() as $slug => $tab ) :

				$class = 'ba-admin-tabs-content-item';

				if ( $tab_count === 1 ) {
					$class .= ' active-tab';
				}

				if ( ba_has_pro() && 'pro' === $slug ) {
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
