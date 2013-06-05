<?php
get_header();
?>
	<section>
		
			<?php  if ( have_posts()) : the_post(); ?>
			
			<?php  breadcrumb_init(get_the_author()); ?>
			<?php  if ( is_author() ) { ?>
			<section class="article-author-archive">
				<div class="author-top"><span>關於作者</span></div>
				<div class="author-avatar"><?php echo get_avatar($curauth->id, 100);?></div>
				<div class="author-text">
					<h3 class="author-name"><?php the_author(); ?></h3>
					<div class="author-social">
						<?php if ( get_the_author_meta( 'google' ) ): ?>
							<a href="<?php the_author_meta('google');?>?rel=author" title="我的G+">Google+</a> | <?php endif;?>
						<?php if ( get_the_author_meta( 'facebook' ) ): ?>
							<a href="<?php the_author_meta('facebook');?>" title="我的臉書">Facebook</a> | <?php endif;?>
						<?php if ( get_the_author_meta( 'description_url' ) ): ?>
							<a href="<?php the_author_meta('description_url');?>" title="<?php the_author(); ?> 個人介紹">個人介紹</a> | <?php endif;?>
							<a href="<?php echo get_author_posts_url(get_the_author_ID()); ?>" title="更多<?php the_author(); ?>的文章">更多文章 &gt; </a></span>
					</div>		
					<p class="author-description">
						<?php the_author_meta( 'description' ); ?>
					</p>
				</div>
			</section>			
			<?php } rewind_posts(); ?>
			
			<?php while ( have_posts() ) : the_post(); ?>
			
				<article class="article">
					<div class="article-thumb">
						<?php if ( get_feature_image() && is_option("post_on") ): ?>
						<img src="<?php echo get_timthumb('small'); ?>" title="<?php the_title(); ?>">
						<?php endif; ?>	
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