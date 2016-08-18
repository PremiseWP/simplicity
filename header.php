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

				<div class="pwps-logo">
					<?php pwps_the_logo(); ?>
				</div>

				<div class="pwps-nav">
					<div class="pwps-nav-toggle">
						<a href="javascript:void(0);" id="pwps-nav-toggle-a">
							<i class="fa <?php echo pwps_get_nav_icon(); ?>"></i>
						</a>
					</div>
					<!-- The search field -->
					<div class="pwps-nav-search">
						<input type="text" id="pwps-nav-search-input" name="nav_search" placeholder="Search anything.. Pages, Posts, Plugins, Themes, etc">
					</div>
					<div class="premise-clear"></div>
					<!-- The nav -->
					<a href="javascript:;" id="pwps-nav-back"><i class="fa fa-angle-left"></i></a>
					<?php pwps_main_nav(); ?>
					<!-- The overlay -->
					<div class="pwps-nav-overlay"></div>
				</div>

			</div>

			<div class="pwps-header-overlay"></div>
		</header>

		<div id="pwps-content" class="pwps-container">
