var bottomY;

var colorBoxURL='http://localhost/wordpress/wp-content/themes/Franklin-Street-Theme/js/jquery.colorbox-min.js';


jQuery(document).ready(function() {
	
	
	if(window.location.hash) { 
	        if(window.location.hash.indexOf("#comments") != -1||window.location.hash.indexOf("#respond") != -1) openComments(); 
	}
	
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
		
		if(jQuery("#content.single #comments_ajax").children().length&&jQuery("#content.single #comments_ajax").hasClass('open'))
		{
			jQuery("#content.single #comments_ajax").css('height', 0);
			jQuery("#content.single #comments_ajax").removeClass('open');
			jQuery("#comments_toggle").html('Show Comments')
		} else if(jQuery("#content.single #comments_ajax").children().length) {
			var h = jQuery("#content.single #comments_content").height();
			jQuery("#content.single #comments_ajax").css('height', h);
			jQuery("#content.single #comments_ajax").addClass('open');
			jQuery("#comments_toggle").html('Hide Comments');
		}
		else {
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
				jQuery("#content.single #comments_ajax").addClass('open');
				jQuery("#comments_toggle").html('Hide Comments');
			  }
			});
		}
		return false;
	});
	
});

function closeComments() {
	jQuery("#content.single #comments_ajax").css('height', 0);
	jQuery("#content.single #comments_ajax").removeClass('open');
	jQuery("#comments_toggle").html('Show Comments');
}

function openComments() {
	if(!jQuery("#content.single #comments_ajax").length) return;
	
	if(jQuery("#content.single #comments_ajax").children().length) {
		var h = jQuery("#content.single #comments_content").height();
		jQuery("#content.single #comments_ajax").css('height', h);
		jQuery("#content.single #comments_ajax").addClass('open');
		jQuery("#comments_toggle").html('Hide Comments');
	}
	else {
		var post_id = jQuery("#content.single #comments_toggle").attr("rel");
		var url = jQuery("#content.single #comments_toggle").attr("rev");

		jQuery.ajax({
		  url: url,
		  type: "POST",
		  cache: true,
		  data: ({id : post_id}),
		  success: function(data) {
		    jQuery("#content.single #comments_ajax").html(data);
			var h = jQuery("#content.single #comments_content").height();
			jQuery("#content.single #comments_ajax").css('height', h);
			jQuery("#content.single #comments_ajax").addClass('open');
			jQuery("#comments_toggle").html('Hide Comments');
			jQuery(document).scrollTop(jQuery("#comments").position().top);
		  }
		});
	}
}

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