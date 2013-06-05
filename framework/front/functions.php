<?php
function social_button(){
	global $post;
?>
	<div id="share_button">
		<div id="fb_button" style="padding: 5px 0 5px 14px;">
			<div class="fb-like" data-href="<?php the_permalink() ?>" data-send="false" data-layout="box_count" data-width="45" data-show-faces="false" data-font="trebuchet ms"></div>
		</div>
		<div id="gplus_button" style="padding: 5px 0 5px 8px;">
			<g:plusone size="tall"></g:plusone>
		</div>
	</div>
<?php
}

function add_user_porfile( $contactmethods ) {
	$contactmethods['google'] = 'Google+ 個人網址';
	$contactmethods['facebook'] = 'Facebook 個人網址';
	$contactmethods['description_url'] = '個人介紹頁';
	return $contactmethods;
}
add_filter('user_contactmethods','add_user_porfile',10,1);

function postauthor_init(){
	global $post;
	if (is_option('author_on')){
?>
<section class="article-author">
	<div class="author-top"><span>關於作者</span></div>
	<div class="author-avatar"><?php echo get_avatar(get_the_author_meta('ID'), 100);?></div>
	<div class="author-text">
		<h3 class="author-name"><?php the_author_meta('display_name');?></h3>
		<div class="author-social">
			<?php if ( get_the_author_meta( 'google' ) ): ?>
				<a href="<?php the_author_meta('google');?>?rel=author" title="我的G+">Google+</a> | <?php endif;?>
			<?php if ( get_the_author_meta( 'facebook' ) ): ?>
				<a href="<?php the_author_meta('facebook');?>" title="我的臉書">Facebook</a> | <?php endif;?>
			<?php if ( get_the_author_meta( 'twitter' ) ): ?>
				<a href="<?php the_author_meta('twitter');?>" title="我的推特">Twitter</a> | <?php endif;?>
			<?php if ( get_the_author_meta( 'description_url' ) ): ?>
				<a href="<?php the_author_meta('description_url');?>" title="<?php the_author_meta('display_name');?> 個人介紹">個人介紹</a> | <?php endif;?>
				<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="更多<?php the_author_meta('display_name');?>的文章">更多文章 &gt; </a></span>
		</div>		
		<p class="author-description">
				<?php the_author_meta('description');?>
		</p>

	</div>
</section>
<?php
	}
}

add_action('init', 'need_use_jquery');
function need_use_jquery() {
    if( !is_admin() ) {
        wp_enqueue_script('jquery');
    }
}

function insert_fb_in_head() {
	global $post;
	if ( is_home()) {
		echo '<meta property="og:image" content="'.f_option('logo').'" />' ;
		echo "\n";
		echo '<meta property="fb:admins" content="'. f_option('fb_admins') .'" />';
		echo "\n";
        echo '<meta property="fb:app_id" content="'. f_option('fb_appid') .'" />';
		echo "\n";
        echo '<meta property="og:type" content="website"/>';
		echo "\n";
        echo '<meta property="og:title" content="' . get_bloginfo('name') . '"/>';
		echo "\n";
        echo '<meta property="og:description" content="' . get_bloginfo('description'). '"/>';
		echo "\n";
        echo '<meta property="og:url" content="' . get_bloginfo('url'). '"/>';
		echo "\n";
        echo '<meta property="og:site_name" content="'. get_bloginfo('name'). '"/>';
		echo "\n";
	}
	if ( !is_singular()) return;
	$img = get_feature_image();
	$post_excerpt =  ( $post->post_excerpt ) ? $post->post_excerpt : trim( str_replace( "\r\n", ' ', strip_tags( $post->post_content ) ) );
	$description = mb_substr( $post_excerpt, 0, 160, 'UTF-8' );
	$description .= ( mb_strlen( $post_excerpt, 'UTF-8' ) > 160 ) ? '…' : '';
        echo "\n";
		echo '<meta property="fb:admins" content="'. f_option('fb_adminid') .'" />';//管理員ID
		echo "\n";
        echo '<meta property="fb:app_id" content="'. f_option('fb_appid') .'" />';//APP_ID
		echo "\n";
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';//標題
		echo "\n";
        echo '<meta property="og:description" content="' . $description . '"/>';//截取字數
		echo "\n";
        echo '<meta property="og:type" content="article"/>';//內容格式
		echo "\n";
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';//連結
		echo "\n";
        echo '<meta property="og:site_name" content="' . get_bloginfo('name'). '"/>';//網站名稱
		echo "\n";
		echo '<meta property="og:image" content="'.$img.'" />' ;//圖片
		echo "\n";
		echo '<link rel="image_src" type="image/jpeg" href="'.$img.'" />' ;//圖片
		echo "\n";
		echo '<meta property="og:locale" content="zh_tw">';
		echo "\n";
}


add_action( 'wp_head', 'insert_fb_in_head', 10 );


add_filter('the_content', 'adsense_adder_at_more_tag');
function adsense_adder_at_more_tag($text) {
	if( is_single() && is_option('gad_top')) {
		$ads_text = '
		<div class="gad">
			<div class="gad-code">'.f_option('gad_top').'</div>
		</div>
		';
	}
	$pos1 = strpos($text, '<span id="more-');
	$pos2 = strpos($text, '</span>', $pos1);
	$text1 = substr($text, 0, $pos2);
	$text2 = substr($text, $pos2);
	$text = $text1 . $ads_text . $text2;
	return $text;
}

register_nav_menus(
		array(
			'primary-menu' => __( '主選單' )
		)
);

if ( function_exists('register_sidebar') ){
	register_sidebar(array(
		'name' => '邊欄',
		'id' => 'sidebar',
		'description' => '顯示於其他面邊欄處.',
		'before_widget' => '<section id="%1$s" class="right-sidebar">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="sidebar-title">',
		'after_title' => '</h3>'
	));
}

$options = get_option(FRAMEWORK_NAME);

function the_option($name){
	global $shortname;
	$options = get_option(FRAMEWORK_NAME);
	$array = $options[$name];
	if($array){
		echo stripslashes($array);
		return 0;
	}else{
		return 0;
	}
}

function f_option($name){
	global $shortname;
	$options = get_option(FRAMEWORK_NAME);
	$array = $options[$name];
	if($array){
		return stripslashes($array);
	}else{
		return 0;
	}
}

function is_option($name){
	global $shortname;
	$options = get_option(FRAMEWORK_NAME);
	$array = $options[$name];
	if($array){
		return ture;
	}else{
		return false;
	}
}


if ( function_exists( 'add_theme_support'  ) ) {
    add_theme_support( 'post-thumbnails' );
}

// Scopio http://steachs.com
function pagenavi($range = 5){
	global $paged, $wp_query;
	if ( !$max_page ) {
		$max_page = $wp_query->max_num_pages;
	}
	if($max_page > 1){
		if(!$paged){
			$paged = 1;
		}
		echo '<ul class="pagenavi"><li class="navi-info disabled">第'.$paged.'頁、共'.$max_page.'頁</li>';
		if($paged != 1){
			echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='首頁'>首頁</a>";
		}
    	previous_posts_link(' « ');
		if($max_page > $range){
			if($paged < $range){
				for($i = 1; $i <= ($range + 1); $i++){
					if ($i==$paged){  $dis = "disabled"; }else{ $dis = "";}
					echo "<li class='navi-num ".$dis."'><a title=".'"第'.$i.'頁"'. " href='" . get_pagenum_link($i) ."'>$i</a></li>";
				}
			}

			elseif($paged >= ($max_page - ceil(($range/2)))){
				for($i = $max_page - $range; $i <= $max_page; $i++){
					if ($i == $paged){ $dis = "disabled"; } else { $dis = "";}
						echo "<li class='navi-num ".$dis."'><a title=".'"第'.$i.'頁"'. " href='" . get_pagenum_link($i) ."'>$i</a></li>";
					}
				}

			elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
				if ($i == $paged){ $dis = "disabled"; } else { $dis = "";}
				for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
					echo "<li class='navi-num ".$dis."'><a title=".'"第'.$i.'頁"'. " href='" . get_pagenum_link($i) ."'>$i</a></li>";
				}
			}
		} else {
			for($i = 1; $i <= $max_page; $i++){
				if ($i == $paged){ $dis = "disabled"; } else { $dis = "";}
				echo "<li class='navi-num ".$dis."'><a title=".'"第'.$i.'頁"'. " href='" . get_pagenum_link($i) ."'>$i</a></li>";
			}
		}
		echo "<li class='navi-num'>";
		next_posts_link(' » ');
		echo "</li>";
		if($paged != $max_page){
			echo "<li class='navi-num'><a href='" . get_pagenum_link($max_page) . "' class='extend' title='最後一頁'>最後一頁</a></li></ul>";
		}
	}
}

function breadcrumb_init($nickname = ''){
	global $post,$theme_dir;
?>

<ul class="breadcrumb">
	
<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
	<i class="icon-home"></i>	
	<a href="<?php bloginfo('url');?>" itemprop="url" title="<?php bloginfo('name');?>">
		<span itemprop="title"><?php bloginfo('name');?></span></a> 
</li>

<?php
if( is_single() ):
foreach ((get_the_category()) as $category) {
	echo '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
	echo '<span class="divider">›</span> <a href="' . get_category_link($category -> term_id) . '" itemprop="url" title=' . $category -> cat_name . '> <span itemprop="title">' . $category -> cat_name . '</span> </a>';
	echo '</li>';
}
else:
?>
<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="active">
		<span class="divider">›</span> <span itemprop="title">
			<?php
	if (is_category()) {
		echo single_cat_title();
	} elseif (is_author()) {
		echo $nickname;
	} elseif (is_tag()) {
		echo single_tag_title('', true);
	} elseif (is_day()) {
		the_time(get_option('date_format'));
	} elseif (is_month()) {
		the_time('F, Y');
	} elseif (is_year()) {
		the_time('Y');
	}
?></span>
</li>
<?php
endif;
?>
</ul>
<?php

}

function get_timthumb( $size = 'small' ){
	global $post;
	$img1 = get_feature_image();
	if ( $img1 ):
		if( $size == 'small'):
			return bloginfo('template_url') . "/framework/thumb/timthumb.php?src=" . $img1 . "&w=400&h=225&zc=1";	
		endif;
		if( $size == 'banner'):
			return bloginfo('template_url') . "/framework/thumb/timthumb.php?src=" . $img1 . "&w=720&h=405&zc=1";	
		endif;
	endif;
}

function get_feature_image(){
	$first_img = '';
	global $post, $posts;
	if (has_post_thumbnail()){
		$first_img  = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	} else {
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].+>/i', $post->post_content, $matches);
		$first_img = $matches[1][0];
	}
	return $first_img;
}

function mytheme_comment($comment, $args, $depth){
	$GLOBALS['comment'] = $comment;

?>
<li id="comment-id-<?php comment_ID() ?>" class="comment-list-box">
	<div id="comment-<?php comment_ID();?>">
		<div class="comment-author">
			<?php echo get_avatar( $comment, 40 ); ?>
		</div>
		<div class="comment-fn">
			<?php printf(__('<span class="fn">%s</span>'), get_comment_author_link()) ?>
		</div>
		<div class="comment-meta">
			<?php printf(__('%1$s @ %2$s'), get_comment_date(),  get_comment_time()) ?><?php edit_comment_link(__('(Edit)'),'  ','') ?>
		</div>

		<?php if ($comment->comment_approved == '0') : ?>
			<em class="comment-approved"><?php _e('Your comment is awaiting moderation.') ?></em>
		<?php endif;?>

		<?php comment_text() ?>
		<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
</div>

<?php }

function fixeds(){
?>
<div class="sc hidden-phone">
<?php if( is_option('fb_page') ) { ?>
<div class="sc_facebook">
	<div>
		<div class="fb-like-box" data-href="<?php the_option('fb_page'); ?>" data-width="280" data-height="300" data-show-faces="true" data-border-color="#FFF" data-stream="false" data-header="false"></div>
	</div>
</div>
<?php } if( is_option('g_page') ) { ?>
<div class="sc_google">
	<div>
		<div class="g-plus" data-href="<?php the_option('g_page'); ?>" data-rel="publisher" data-width="280"></div>
	</div>
</div>
<?php
} if(is_single()){
?>
<div class="sc_comments" id="sc_comments" title="移到迴響區域">
</div>
<?php } ?>
<div class="sc_gotop" id="gotop" title="回到網頁頂部">
</div>
</div>

<?php
}

function random_lists($num_limit = 7){
    query_posts('showposts='.$num_limit.'&orderby=rand');
	if ( have_posts() ) : while ( have_posts() ) : the_post();
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
								<div class="meta-category"><i class="icon-tag icon-white"></i>  <?php the_category(' , '); ?></div>
						</div>
					</div>
				</article>
<?php
    endwhile; else:
	endif;
    }


?>