<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111777644-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-111777644-1');
		</script>

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<header id="typology-header" class="typology-header">
			<div class="container">
					<?php get_template_part('template-parts/header/layout-' . typology_get_option( 'header_layout' ) ); ?>
			</div>
		</header>
