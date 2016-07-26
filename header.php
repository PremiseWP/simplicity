<?php
/**
 * Header Template
 *
 * @package Simplicity
 */

?><!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">

		<!-- Make Responsive -->
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class( '' ); ?>>
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
						<input type="text" id="pwps-nav-search-input" name="nav_search" placeholder="Find episodes, recipes, and more">
					</div>
					<!-- The nav -->
					<?php pwps_main_nav(); ?>
					<!-- The overlay -->
					<div class="pwps-nav-overlay"></div>
				</div>

			</div>

		</header>

		<div id="pwps-content" class="pwps-container">