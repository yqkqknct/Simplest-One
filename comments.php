<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('請不要使用別的途徑觀看本檔案，謝謝。');

	if ( post_password_required() ) { ?>
		<p class="nocomments">本文需要密碼才能查看，請輸入密碼。</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

	<h3><?php comments_number('沒有迴響', '迴響 (1)', '迴響 (%)' );?> </h3>
<?php if ( have_comments() ) : ?>
	<ol class="comment_list">
		<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
	</ol>
	<div class="clearfix"></div>

	<?php $page = ($_GET['cpage'])? $_GET['cpage'] : 1 ; ?>
	<div class="pagenavi">
		<div class="paviinfo">共 <?php echo comments_number('0','1','%'); ?> 條迴響、第<?php echo $page; ?>頁</div>
		<?php paginate_comments_links('prev_text=上一頁&next_text=下一頁');?>
	</div>
<div class="clearfix"></div>

 <?php else :  ?>
	<?php if ( comments_open() ) : ?>
		<p>本文還沒有迴響，快來搶頭香！</p>
	<?php else : ?>
		<p class="nocomments">本文不開放迴響。</p>
	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div id="respond">

<h3><?php comment_form_title( '留下迴響', '回應給  %s' ); ?></h3>

<div class="cancel-comment-reply">
	<?php cancel_comment_reply_link(); ?>
</div>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p> 你需要先  <a href="<?php echo wp_login_url( get_permalink() ); ?>">登入 </a> 才能留下迴響 。</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( is_user_logged_in() ) : ?>

<p>登入為 <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author"><small>名稱<?php if ($req) echo "(必填)"; ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email"><small>信箱<?php if ($req) echo "(必填)"; ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
<label for="url"><small>網站</small></label></p>

<?php endif; ?>

<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

<p><input name="submit" class="m-btn black" type="submit" id="submit" tabindex="5" value="發表" />
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; ?>
</div>

<?php endif; ?>