<?php
/**
 * Header Template
 *
 * @package Simplicity
 */

?><!DOCTYPE html>
<html>
	<head>
		<title><?php wp_title( '&raquo;', true, 'right' ); ?> <?php bloginfo( 'name' ); ?></title>
		<meta charset="<?php bloginfo( 'charset' ); ?>">

		<!-- Make Responsive -->
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

		<?php wp_head(); ?>

		<?php pwps_google_analytics_script(); ?>
	</head>

	<body <?php body_class( 'pwps-site-body' ); ?>>
		<?php echo '<!-- ' . basename( get_page_template() ) . ' -->'; ?>

		<header id="pwps-header">

			<div class="pwps-container">

				<?php pwps_the_logo(); ?>

				<div class="pwps-nav">
					<div class="pwps-nav-toggle">
						<a href="javascript:void(0);" id="pwps-nav-toggle-a">
							<i class="fa <?php echo pwps_get_nav_icon(); ?>"></i>
						</a>
					</div>
					<div class="pwps-nav-wrapper">

						<div class="pwps-nav-search">
							<input type="text" id="pwps-nav-search-input" name="nav_search" placeholder="Search anything.. Pages, Posts, Plugins, Themes, etc">
						</div>
						<div class="premise-clear"></div>
						<!-- The nav -->
						<?php pwps_main_nav(); ?>
						<?php if ( (boolean) premise_get_value( 'pwps_customizer_options[header][mobile-sidebar]' ) && pwps_uses_sidebar( 'pwps-sidebar' ) ) : ?>
							<div class="premise-clear premise-show-on-mobile">
								<div class="premise-align-center">
									<a href="#" class="pwps-toggle-mobile-sidebar">
										<?php echo esc_html( (string) premise_get_value( 'pwps_customizer_options[header][mobile-sidebar-link]' ) ); ?>
									</a>
								</div>
								<div class="pwps-mobile-sidebar">
									<ul class="pwps-sidebar">
										<?php dynamic_sidebar( 'pwps-sidebar' ); ?>
									</ul>
								</div>
							</div>
						<?php endif; ?>
						<?php if ( pwps_uses_sidebar( 'pwps-nav-footer', false ) ) : ?>
							<div class="pwps-nav-footer-sidebar">
								<ul class="pwps-nav-footer-sidebar">
									<?php dynamic_sidebar( 'pwps-nav-footer' ); ?>
								</ul>
							</div>
						<?php endif; ?>
						<!-- The overlay -->
						<div class="pwps-nav-overlay"></div>
					</div>
				</div>

			</div>

			<div class="pwps-header-overlay"></div>
		</header>

		<!-- <div id="pwps-content" class="pwps-container"> -->
