var bottomY;

jQuery(document).ready(function() {
	
	bottomY=getBottomY();
	updateStickyFooter();
	
	jQuery(window).resize(function() {
		updateStickyFooter()
	});
	
	jQuery(this).scroll(function() {
		
		updateStickyFooter();
	});
});

function updateStickyFooter() {
	var scrT = jQuery(this).scrollTop();
	var winH = jQuery(window).height();
	var fH = jQuery('#sticky_footer').height();
	var bMw = bottomY-winH;
	
	if(bMw-scrT+fH<0) jQuery('#sticky_footer').toggleClass('light', true);
	else jQuery('#sticky_footer').toggleClass('light', false);
}

function getBottomY() {
	return jQuery('#page_bottom').offset().top;
}