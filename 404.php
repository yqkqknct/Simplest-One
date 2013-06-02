<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article class="article-inside">
		<div class="article-cont">
			<h1 class="cont-title">
				404 找不到網頁
			</h1>
			<aside class="sidebar">
				<?php get_sidebar(); ?>
			</aside>
			<div class="cont">
				OOps! 找不到你要的網頁，該網頁可能已經刪除、暫時關閉或發生意外。你可以稍後再進來此網頁，或者看看其他文章。
				<h2>隨選文章</h2>
				<?php random_lists() ?>
				<div class="gad">
					<div class="gad-code"><?php the_option('gad_end') ?></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</article>
	<?php endwhile; wp_reset_query(); ?>
<?php get_footer(); ?>