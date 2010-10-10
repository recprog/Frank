var bottomY;

jQuery(document).ready(function() {
	
	jQuery("a[href^='http:']").not("[href*='" + window.location.host + "']").each(function (i) {
		jQuery(this).attr('target','_blank');
		jQuery(this).addClass('external')
	});
	
	bottomY=getBottomY();
	updateStickyFooter();
	
	jQuery('#content #sidebar').clone().appendTo('#content').attr('id', 'faux_sidebar');
	
	jQuery(window).resize(function() {
		updateStickyFooter()
	});
	
	jQuery(this).scroll(function() {
		updateStickyFooter();
	});
	
	jQuery('body').click(function() {
		jQuery('#search').removeClass('active');
	 });
		
	jQuery('#search').click(function(event) {
		event.preventDefault();
		jQuery('#search').addClass('active');
		event.stopPropagation();
	});	
		
	jQuery("#content.single #comments_toggle").click(function(){
		var post_id = jQuery(this).attr("rel");
		var url = jQuery(this).attr("rev");

		jQuery.ajax({
		  url: url,
		  type: "POST",
		  cache: true,
		  data: ({id : post_id}),
		  success: function(data) {
		    jQuery("#content.single #comments_ajax").html(data);
			var h = jQuery("#content.single #comments_content").height();
			jQuery("#content.single #comments_ajax").css('height', h);
		  }
		});
		return false;
	});
	
});

function updateStickyFooter() {
	bottomY=getBottomY();
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