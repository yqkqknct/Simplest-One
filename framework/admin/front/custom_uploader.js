jQuery(document).ready(function() {
	var uploadInput = '';
	jQuery('.upload_image_button').click(function() {
		formfield = jQuery('.upload_input').attr('name');
		uploadInput = jQuery(this).parent().prev('input.upload_input');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html) {
		imgurl = jQuery('img', html).attr('src');
		uploadInput.val(imgurl);
		tb_remove();
	}
});
