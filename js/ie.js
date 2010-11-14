jQuery(document).ready(function() {
	
	jQuery('#content.home #content_secondary .post').each(function(index) {
		jQuery(this).addClass('item-'+index);
	});
	
	jQuery('#content.home #content_tertiary .post').each(function(index) {
		jQuery(this).addClass('item-'+index);
	});
	
	jQuery('#sub_header .widget').each(function(index) {
		jQuery(this).addClass('item-'+index);
	});
	
	jQuery('#page_footer .widget').each(function(index) {
		jQuery(this).addClass('item-'+index);
	});
	
	jQuery('#page_heel .widget').each(function(index) {
		jQuery(this).addClass('item-'+index);
	});
	
	jQuery('#post_footer .widget').each(function(index) {
		jQuery(this).addClass('item-'+index);
	});
		
});

