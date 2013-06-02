<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article class="article-inside">
		<div class="article-cont">
			<h1 class="cont-title">
				<?php the_title(); ?>
			</h1>
			<aside class="sidebar">
				<?php get_sidebar(); ?>
			</aside>
			<div class="cont">
				<?php the_content(); ?>
				<div class="gad">
					<div class="gad-code"><?php the_option('gad_end') ?></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</article>
	<?php endwhile; wp_reset_query(); ?>
<?php get_footer(); ?>