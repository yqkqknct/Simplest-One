<?php

function framework_options_init( $type = 'list'){

	if ( $type == 'list') {
		$framework_options['general'] = array(
			array(	"title" => "Logo 圖片",
					"id" => "logo",
					"desc" => "填入 Logo 圖片網址",
					"std" => "",
					"type" => "upload"
				),
			array(	"title" => "Favicon 圖標",
					"id" => "favicon",
					"desc" => "填入 Favicon 圖標",
					"std" => "",
					"type" => "upload"
				),
			array(	"title" => "網頁背景圖片",
					"id" => "background_image",
					"desc" => "填入背景圖片網址（若留空則使用單色）",
					"std" => "",
					"type" => "upload"
				),
		);
		$framework_options['color'] = array(
			array(	"title" => "背景顏色",
					"id" => "background_color",
					"desc" => "選擇背景顏色",
					"std" => "#DDDDDD",
					"type" => "color"
				),
			array(	"title" => "Footer 背景顏色",
					"id" => "background_color_footer",
					"desc" => "選擇背景顏色",
					"std" => "#000000",
					"type" => "color"
				)
		);
		$framework_options['layout'] = array(
			array(	"title" => "欄數",
					"id" => "layout_count",
					"desc" => "選擇欄數",
					"options" => array( "1", "2", "3", "4"),
					"type" => "select"
				),
			array(	"title" => "開啟文章縮圖",
					"id" => "post_on",
					"desc" => "選擇欄數",
					"type" => "radio"
				),
			array(	"title" => "首頁顯示分類",
					"id" => "cat",
					"desc" => "選擇欄數",
					"options" => array( array( "id" => "news" , "title" => "First"), array( "id" => "water" , "title" => "Second")),
					"type" => "checkbox"
				),							
		);			
		$framework_options['custom'] = array(
			array(	"title" => "自定義 CSS",
					"id" => "custom_css",
					"desc" => "自定義",
					"type" => "textarea"
				),					
		);				
	} else if ( $type == 'nav') {
		$framework_options = array( "General", "Color", "Layout", "Custom" );
	}
	return $framework_options;
}

function framework_header(){
	wp_enqueue_style("style", get_bloginfo('template_directory') . "/framework/admin/front/admin-styles.css");
	wp_enqueue_style('thickbox');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_bloginfo('template_directory') . "/framework/admin/front/custom_uploader.js", array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
	wp_register_script('normal-js', get_bloginfo('template_directory') . "/framework/admin/front/admin-javascript.js");
	wp_enqueue_script('normal-js');
}

add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
function mw_enqueue_color_picker() {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('my-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

function framework_addition(){
	add_menu_page('kentframework', 'Kent', 'administrator', 'kentframework', 'framework_admin','', 50);
	add_action('admin_head', 'framework_save');
	framework_header();
}

add_action('admin_menu', 'framework_addition');

function framework_save() {
?>
	
    <script type="text/javascript">
	jQuery(document).ready(function($) {

		jQuery('form#framework').submit(function() {
			jQuery('.saved').attr({ disabled:"disabled"});
			jQuery('.saved').addClass("disabled");
			jQuery('#save').html('<i class="icon-spinner icon-spin"></i>').show();
			var data = jQuery(this).serialize();
			jQuery.post(ajaxurl, data, function(response) {
				if(response == 1) {
					show_message(1);
					t = setTimeout('fade_message()', 4000);
				} else {
					show_message(2);
					t = setTimeout('fade_message()', 4000);
				}
			});
			return false;
		});  
	});
	
	function show_message(n) {
		jQuery('#save i').hide();
		if(n == 1) {
			jQuery('#save').html('<div class="successful fade"><i class="icon-ok"></i>  <?php _e("Options saved."); ?></div>').show();
		} else {
			jQuery('#save').html('<div class="error fade"><i class="icon-remove"></i>  <?php _e("Options could not be saved."); ?></div>').show();
		}
		jQuery('.saved').removeAttr("disabled");
		jQuery('.saved').removeClass("disabled");
	}
	
	function fade_message() {
		jQuery('#save').fadeOut(2000);	
		clearTimeout(t);
	}
	</script>

<?php    
}


add_action('wp_ajax_save', 'framework_save_ajax');

function framework_save_ajax() {
	
	check_ajax_referer('framework_options', 'security');

	$data = $_POST;
	unset($data['security'], $data['action']);
	
	if(!is_array(get_option('framework'))) {
		$options = array();
	} else {
		$options = get_option('framework');
	}

	if(!empty($data)) {
		$diff = array_diff($options, $data);
		$diff2 = array_diff($data, $options);
		$diff = array_merge($diff, $diff2);
	} else {
		$diff = array();
	}
		
	if(!empty($diff)) {	
		if(update_option('framework', $data)) {
			die('1');
		} else {
			die('0');
		}
	} else {
		die('1');	
	}
}

function framework_admin(){
	$framework_options = framework_options_init('list');
	$framework_nav = framework_options_init('nav');
	$options = get_option('framework');
?>
<div class="warp">
	<div class="top">
		<span class="brand">Kent Framework</span>
		<div class="version">V 1.0</div>
	</div>
	<div class="container">
		<div class="w-widget">
			<ul class="navigation">
			<?php
				foreach ($framework_nav as $key => $value) {
			?>				
				<li id="<?php echo $framework_nav[$key]; ?>"<?php if ($key == 0): ?> class="active"<?php endif; ?>><?php echo $framework_nav[$key]; ?><i class="icon-angle-right"></i></li>
			<?php
				}
			?>
			</ul>
		</div>
		<div class="main">
			<form name="framework" id="framework" method="post">
			<?php
				foreach ($framework_nav as $key => $value) {
				$title = strtolower($framework_nav[$key]);
			?>			
			<div class="<?php echo $title ?><?php if ($key != 0): ?> hide<?php endif; ?>">
				<h1 class="main-title"><?php echo $framework_nav[$key] ?></h1>
				<?php
					foreach ($framework_options[$title] as $data) {
						switch ($data['type']) {
						 	case 'upload':
				?>
								<div class="row-data">
									<div class="title"><span><?php echo $data['title']; ?></span></div>
									<div class="std">
										<input id="<?php echo $data['id']; ?>" class="upload_input" type="text" name="<?php echo $data['id']; ?>" value="<?php echo $options[$data['id']]; ?>" />
										<div class="upload_button">
											<input class="upload_image_button button-secondary" id="upload_image_button" type="button" value="上傳圖片" />
										</div>
									</div>
									<div class="desc">
										<span><?php echo $data['desc']; ?></span>
									</div>
								</div>
				<?php
						 	break;
						 	case 'text':
				?>
								<div class="row-data">
									<div class="title"><span><?php echo $data['title']; ?></span></div>
									<div class="std"><input type="text" name="<?php echo $data['id']; ?>" value="<?php echo $options[$data['id']]; ?>"></div>
									<div class="desc"><span><?php echo $data['desc']; ?></span></div>
								</div>
				<?php
						 	break;
						 	case 'color':
				?>
								<div class="row-data">
									<div class="title"><span><?php echo $data['title']; ?></span></div>
									<div class="std"><input class="color-field" type="text" name="<?php echo $data['id']; ?>" value="<?php echo $options[$data['id']]; ?>" data-default-color="<?php echo $data['std']; ?>"></div>
									<div class="desc"><span><?php echo $data['desc']; ?></span></div>
								</div>
				<?php
						 	break;						 	
						 	case 'textarea':
				?>
								<div class="row-data">
									<div class="title"><span><?php echo $data['title']; ?></span></div>
									<div class="std"><textarea name="<?php echo $data['id']; ?>"><?php echo $options[$data['id']]; ?></textarea></div>
									<div class="desc"><span><?php echo $data['desc']; ?></span></div>
								</div>
				<?php
						 	break;						 	
						 	case 'select':
				?>
								<div class="row-data">
									<div class="title"><span><?php echo $data['title']; ?></span></div>
									<div class="std">
										<select name="<?php echo $data['id']; ?>" id="<?php echo $data['id']; ?>">
											<?php foreach ($data['options'] as $option) { ?>
												<option <?php if ($options[$data['id']] == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option>
											<?php } ?>
										</select>										
									</div>
									<div class="desc"><span><?php echo $data['desc']; ?></span></div>
								</div>
				<?php
						 	break;
						 	case 'checkbox':
				?>
								<div class="row-data">
									<div class="title"><span><?php echo $data['title']; ?></span></div>
									<div class="std">

										<?php
										$i = 1;
										foreach ($data['options'] as $value) {
											if( $options[$value['id']] == $value['id'] ){ $checked = "checked=\"checked\""; }else{  $checked = "";} ?>
											<label class="checkbox checked" for="<?php echo $value['id']; ?>">
												<input class="checkbox" type="checkbox" name="<?php echo $value['id']; ?>" value="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" <?php echo $checked; ?> />
												<?php echo $value['title']; ?>
											</label>	
										<?php $i++; } ?>
									</div>
									<div class="desc"><span><?php echo $data['desc']; ?></span></div>
								</div>
				<?php
						 	break;
						 	case 'radio':
				?>
								<div class="row-data">
									<div class="title"><span><?php echo $data['title']; ?></span></div>
									<div class="std">
										<div class="toggle">
											<?php 	if( $options[$data['id']] == 1 ||
													( $options[$data['id']] == '' && $data['options']['std'] == 1 )){
														$checked = "checked=\"checked\"";  $checked2 = ""; }
													else {  
														$checked = "";
														$checked2 = "checked=\"checked\"";
													} ?>
											<label class="toggle-radio" for="<?php echo $data['id']; ?>2">ON</label>		
											<input type="radio" name="<?php echo $data['id']; ?>" id="<?php echo $data['id']; ?>1" value="1" <?php echo $checked; ?> /><br />
											<label class="toggle-radio" for="<?php echo $data['id']; ?>1">OFF</label>
											<input type="radio" name="<?php echo $data['id']; ?>" id="<?php echo $data['id']; ?>2" value="0" <?php echo $checked2; ?> /><br />
										</div>
									</div>
									<div class="desc"><span><?php echo $data['desc']; ?></span></div>
								</div>
				<?php
						 	break;						 	
						 }								 					 						 
				?>
				<?php
					}
				?>
			</div>

			<?php
				}
			?>			
			
			<input type="hidden" name="action" value="save" />
        	<input type="hidden" name="security" value="<?php echo wp_create_nonce('framework_options'); ?>" />
			<input type="submit" value="Save" class="saved"><div id="save"></div>
			</form>
		</div>
	</div>
</div>
<?php
}

?>