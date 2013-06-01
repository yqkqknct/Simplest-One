<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article class="article-inside">
		<div class="article-cont">
			<h1 class="cont-title">
				<?php the_title(); ?>
			</h1>
			<aside class="sidebar">
				<section class="sidebar-meta">
					<div class="meta-time"><i class="icon-time icon-white"></i> <span title="<?php the_time('G:i'); ?>"><?php the_time('F ‧ j, Y'); ?></span></div>
					<div class="meta-comment"><i class="icon-comment icon-white"></i> <a href="<?php the_permalink(); ?>#comments" title="查看迴響"><?php comments_number('0','1','%','',''); ?> 迴響</a></div>
					<div class="meta-category"><i class="icon-tag icon-white"></i> <?php the_category(' , '); ?></div>
				</section>
				<?php get_sidebar(); ?>
			</aside>
			<div class="cont">
				<?php the_content(); ?>
				<div class="clearfix"></div>
			</div>
		</div>
		<?php postauthor_init(); ?>
	</article>
	<?php endwhile; wp_reset_query(); ?>
	<div id="comments" class="comments">
		<?php comments_template();?>
	</div>
<?php get_footer(); ?>