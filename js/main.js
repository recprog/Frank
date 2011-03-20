jQuery(document).ready(function() {
			
	if(jQuery(document).find('.colorbox').length) {
		jQuery.getScript(colorBoxURL, function() {
			jQuery('.colorbox').colorbox();
		});
	}
	
	jQuery("a[href^='http:']").not("[href*='" + window.location.host + "']").each(function (i) {
		if(jQuery(this).find('img').length) return;
		jQuery(this).attr('target','_blank');
		jQuery(this).addClass('external')
	});
		
});