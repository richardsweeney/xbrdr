<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>XP1 - CrossBorder - Moving Cargo Through Innovation</title>
		<title><?php echo bloginfo('name'); ?> <?php wp_title('-'); ?></title>
		<link rel="shortcut icon" href="<?php echo IMG; ?>/favicon.ico">
		<meta name="description" content="" />
		<meta name="author" content="Emma Larsson, ID kommunikation ab" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<?php wp_head(); ?>

		<!--css-->
		<!--stylefix for ie-->
		<!--[if lt IE 10]>
		<style type="text/css">
			.navbar-inner  { filter: none; }
			.navbar-white .nav > .active > a { filter: none; }
			#page { margin-top: 120px; max-width: 900px; }
			.container, .navbar-static-top .container, .navbar-fixed-top .container, .navbar-fixed-bottom .container { max-width: 980px; }
			.navbar-white .brand { display: block; float: left; padding: 15px 20px; margin-left: -20px; font-size: 20px; font-weight: 200; color: #707070; }
			.navbar-white .nav { font-size: 14px; font-weight: 600; margin-top: 35px; float: right; }
			.navbar-white .nav li { line-height: 61px; }
			.below-header { height: 13px; width: 100%; margin-top:1px;}
		</style>
		<![endif]-->
		<!-- JS for IE -->
		<!--[if lt IE 9]>
			<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script>
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-35754072-1']);
			_gaq.push(['_trackPageview']);
			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();
		</script>

	</head>
	<body data-spy="scroll" data-target=".navbar" <?php body_class(); ?>>
		<!--[if lt IE 8]><p class=chromeframe>Din webbläsare är <em>föråldrad!</em> <a href="http://browsehappy.com/">Uppgradera till en annan webbläsare</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
		<div class="navbar navbar-white navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a id="mobile-nav-toggle-switch" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="<?php echo URL; ?>" title="CrossBorder">
						<img src="<?php header_image(); ?>" alt="<?php echo bloginfo('name'); ?>" />
					</a>
					<div class="nav-collapse collapse">
						<?php rps_print_main_navigation() ?>
					</div>

					<?php if (is_front_page()): ?>
						<?php rps_print_parallax_navigation(); ?>
        	<?php endif; ?>

				</div>
				<div class="below-header"></div>
			</div>
		</div>
