<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset');?>" />
		<title><?php
				if (is_home()) {
					bloginfo('name');
					echo ' - ';
					bloginfo('description');
				} else {
					wp_title(' - ', true, 'right');
					bloginfo('name');
				} ?>
		</title>
		<link rel="pingback" href="<?php bloginfo('pingback_url');?>" />
		<link rel="alternate" type="application/rss+xml" title="訂閱 RSS 2.0" href="<?php bloginfo('rss2_url');?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="generator" content="WordPress" />
		<?php wp_head(); ?>
		<script src="<?php bloginfo('template_directory') ?>/framework/front/macho.js" type="text/javascript" /></script>
		<script src="<?php bloginfo('template_directory') ?>/framework/front/base.js" type="text/javascript" /></script>
		<link rel="Shortcut Icon" type="image/x-icon" href="<?php the_option('favicon');?>" />
		<link href="<?php bloginfo('template_directory') ?>/stylesheets/screen.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
		<!--[if lte IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<style type="text/css">
		<?php if ( f_option('background_color') ){ $color = f_option('background_color'); } ?>
		<?php if ( f_option('background_image') ){ $image = f_option('background_image'); } ?>
			body { background: <?php if ( $color ){ echo $color; } ?> <?php if ( $image ){ echo "url('" . $image . "');"; } ?>}
		<?php the_option('custom_css');?>
		</style>
		<?php the_option('custom_head'); ?>
	</head>
	<body>
		<?php if( is_option('fb_appid') ): ?>
		<div id="fb-root"></div>
		<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/zh_TW/all.js#xfbml=1&appId=<?php the_option('fb_appid');?>";
				fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
		</script>
		<?php endif; ?>
		<script type="text/javascript">
			window.___gcfg = {
				lang : 'zh-TW'
			}; (function() {
				var po = document.createElement('script');
				po.type = 'text/javascript';
				po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(po, s);
			})();
		</script>

		<div class="wrapper">
			<div class="inner">
				<header role="header" class="header">
					<hgroup class="header-gp">
						<?php if ( is_option( 'logo') ): ?>
							<h1 class="header-logo"><a href="<?php bloginfo( 'url' ) ?>" title="<?php bloginfo( 'description' ) ?>"><img src="<?php the_option('logo') ?>" alt="<?php bloginfo( 'name' ) ?>"></a></h1>
						<?php else: ?>
							<h1 class="header-logo"><a href="<?php bloginfo( 'url' ) ?>" title="<?php bloginfo( 'description' ) ?>"><?php bloginfo( 'name' ) ?></a></h1>
							<h2 class="header-description"><?php bloginfo( 'description' ) ?></h2>
						<?php endif; ?>
					</hgroup>
					<div class="float-primarymenu">
						<?php wp_nav_menu( array( 'items_wrap' => '<ul class="nav">%3$s</ul>', 'theme_location' => 'primary-menu' ) ); ?>
					</div>
				</header>
				<div class="container">