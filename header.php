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
		<link href="<?php bloginfo('template_directory') ?>/stylesheets/screen.css" media="screen, projection" rel="stylesheet" type="text/css" />
		<link href="<?php bloginfo('template_directory') ?>/stylesheets/print.css" media="print" rel="stylesheet" type="text/css" />
		<!--[if IE]>
		    <link href="/stylesheets/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
		<![endif]-->
		<link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/style.css" type="text/css" media="screen" />
		<link rel="Shortcut Icon" type="image/x-icon" href="<?php //the_option('favicon');?>" />
		<!--[if lte IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<style type="text/css"><?php //the_option('custom_css');?></style>
		<?php //the_option('headcode');?>
	</head>
	<body>
		<?php //if( is_option('fb_appid') ): ?>
		<div id="fb-root"></div>
		<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/zh_TW/all.js#xfbml=1&appId=<?php //the_option('fb_appid');?>";
				fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
		</script>
		<?php //endif;?>
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
		<div class="container">