<?php
get_header();
?>
	<section>
			<?php  if ( have_posts()) : the_post(); ?>
			<?php breadcrumb_init(); ?>
			<?php $i = 0; while (have_posts()) : the_post(); $i++; ?>
				<article class="article">
					<div class="article-thumb">
						<img src="<?php echo get_timthumb('small'); ?>" title="<?php the_title(); ?>">
					</div>
					<div class="article-cont">
						<h1 class="cont-title-small">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h1>
						<div class="cont">
							<?php the_content(); ?>
							<div class="clearfix"></div>
						</div>			
						<div class="article-meta-small">
								<div class="meta-time"><i class="icon-time icon-white"></i>  <span title="<?php the_time('G:i'); ?>"><?php the_time('m / j , Y'); ?></span></div>
								<div class="meta-comment"><i class="icon-comment icon-white"></i>  <a href="<?php the_permalink(); ?>#comments" title="查看迴響"><?php comments_number('0','1','%','',''); ?> 迴響</a></div>
								<div class="meta-category"><i class="icon-tag icon-white"></i>  <?php the_category(' , '); ?></div>
						</div>
					</div>
				</article>
			<?php 	endwhile;
					else: ?>
			<p>抱歉，找不到符合條件的文章。<br /><h2>隨選文章：</h2></p>
			<?php random_lists() ?>
			<?php endif;?>
			
			
			<?php $max_page = $wp_query->max_num_pages; if($max_page > 1){ pagenavi(); } ?>
			<?php wp_reset_query();?>
	</section>	
<?php get_footer();?>