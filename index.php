<?php get_header(); ?>
<div class="gallery">
<?php while ( have_posts() ) : the_post();  ?>
	<?php if ( $wp_query->current_post <= 1) { ?>
			<?php if ( get_feature_image()  && is_option("post_on") ): ?>
			<div class="gallery-half" id="gallery<?php echo $wp_query->current_post; ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_timthumb('banner'); ?>"></a></div>
			<?php endif; ?>
<?php 
		}
	endwhile; 
?>
</div>
<?php while ( have_posts() ) : the_post(); ?>
	<?php if ( $wp_query->current_post <= 1) { ?>
	<article class="article" id="article-gallery<?php echo $wp_query->current_post; ?>">
		<div class="article-cont">
			<h1 class="cont-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>		
			<div class="article-meta">
					<div class="meta-time"><i class="icon-time icon-white"></i>  <span title="<?php the_time('G:i'); ?>"><?php the_time('m / j , Y'); ?></span></div>
					<div class="meta-comment"><i class="icon-comment icon-white"></i>  <a href="<?php the_permalink(); ?>#comments" title="查看迴響"><?php comments_number('0','1','%','',''); ?> 迴響</a></div>
					<div class="meta-category"><i class="icon-tag icon-white"></i>  <?php the_category(' , '); ?></div>
			</div>	
			<div class="cont">
				<?php the_content(); ?>
				<div class="clearfix"></div>
			</div>
		</div>
	</article>
	<?php } else { 
	if ( $wp_query->current_post % 2 != 0 ){ $var = 2; } else { $var = 1; }
	?>
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
					<div class="meta-category"><i class="icon-folder-close-alt"></i> <?php the_category(' , '); ?></div>
					<div class="meta-category"><i class="icon-tag"></i> <?php the_tags('', ' , ', ''); ?></div>
			</div>
		</div>
	</article>
	<?php } endwhile; wp_reset_query(); ?>
	<div class='clearfix'></div>
	<?php pagenavi(); ?>
<?php get_footer(); ?>