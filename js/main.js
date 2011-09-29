jQuery(document).ready(function() {
			
	if(jQuery(document).find('.colorbox').length) {
		jQuery.getScript(colorBoxURL, function() {
			jQuery('.colorbox').colorbox();
		});
	}
});