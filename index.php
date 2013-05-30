<?php get_header(); ?>
<div class="column-left">
<?php while ( have_posts() ) : the_post(); ?>
	<article class="article">
		<div class="article-thumb">
			<?php //get_thumb_images('thumb_img'); ?>
		<div class="article-meta">
				<div class="meta-time"><i class="icon-time icon-white"></i> <span title="<?php the_time('G:i'); ?>"><?php the_time('F ‧ j, Y'); ?></span></div>
				<div class="meta-category"><i class="icon-tag icon-white"></i> <?php the_category(' , '); ?></div>
				<div class="meta-comment"><i class="icon-comment icon-white"></i> <a href="<?php the_permalink(); ?>#comments" title="查看迴響"><?php comments_number('0','1','%','',''); ?> 迴響</a></div>
		</div>
		</div>
		<div class="article-cont">
			<h1 class="cont-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<div class="cont">
				<?php the_content(); ?>
				<div class="clearfix"></div>
			</div>
		</div>
	</article>
	<?php endwhile; wp_reset_query(); ?>
	<div class="pagenavi">
		<?php //pagenavi(); ?>
	</div>
</div>
<?php get_footer(); ?>