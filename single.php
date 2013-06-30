<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article class="article-inside">
		<div class="article-cont">
			<div class="bread"><?php breadcrumb_init(); ?></div>
			<h1 class="cont-title">
				<?php the_title(); ?>
			</h1>
			<aside class="sidebar">
				<section class="sidebar-meta">
					<div class="meta-time"><i class="icon-time"></i> <span title="<?php the_time('G:i'); ?>"><?php the_time('F ‧ j, Y'); ?></span></div>
					<div class="meta-comment"><i class="icon-comment"></i> <a href="<?php the_permalink(); ?>#comments" title="查看迴響"><?php comments_number('0','1','%','',''); ?> 迴響</a></div>
					<div class="meta-category"><i class="icon-folder-close-alt"></i> <?php the_category(' , '); ?></div>
					<div class="meta-category"><i class="icon-tag"></i> <?php the_tags('', ' , ', ''); ?></div>
				</section>
				<?php get_sidebar(); ?>
			</aside>
			<div class="cont">
				<?php the_content(); ?>
				<div class="link_pages"><?php wp_link_pages(array('before' => '<strong>文章未完，請翻下一頁： </strong> ', 'after' => '', 'next_or_number' => 'number')); ?></div>
				<div class="gad">
					<div class="gad-code"><?php the_option('gad_end') ?></div>
				</div>
				<?php social_button(); ?>
				<div class="clearfix"></div>
				<div class="like">
					<div class="like-fb">
						<div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-width="450" data-show-faces="true" data-font="tahoma"></div>
					</div>
					<div class="like-g">
						<div class="g-plusone" data-annotation="inline" data-width="450"></div>
					</div>
				</div>
			</div>
			</div>
		<?php postauthor_init(); ?>
			<?php endwhile; wp_reset_query(); ?>
	<div id="comments" class="comments">
		<?php comments_template();?>
	</div>
	</article>

<?php get_footer(); ?>