/*this will be where all JS specific to SRD.com shows up*/

/*content pulldowns are AJAX driven*/
var expandTimeout;
var req;

jQuery(document).ready(function() {
	
	
	
	jQuery("<style type='text/css'> a{ -webkit-transition-property: background, color; -webkit-transition-duration: .3s; -webkit-transition-timing-function: cubic-bezier(0.02, 0, 0.18, 1.0); -moz-transition-property: background, color; -moz-transition-duration: .3s; -moz-transition-timing-function: cubic-bezier(0.02, 0, 0.18, 1.0); -o-transition-property: background, color; -o-transition-duration: .3s; -o-transition-timing-function: cubic-bezier(0.02, 0, 0.18, 1.0); } </style>").appendTo("head");	
	
	var root=jQuery('link[rel=index]').attr('href');	
		
	jQuery('#content.home #content_secondary .post, #content.home #content_tertiary .post').mouseenter(function(){
		jQuery(this).toggleClass('active', true);
	})
	jQuery('#content.home #content_secondary .post, #content.home #content_tertiary .post').mouseleave(function(){
		jQuery(this).toggleClass('active', false);
	})
	
	jQuery('#content_aside').mouseenter(function(){
		jQuery(this).toggleClass('active', true);
	})
	jQuery('#content_aside').mouseleave(function(){
		jQuery(this).toggleClass('active', false);
	})
	
	jQuery('#content.home #content_primary section p').wrapInner('<a href="'+jQuery('#content.home #content_primary header a').attr('href')+'" />');
	jQuery('#content.home #content_secondary a img').unwrap();
	
	/*categories*/
	jQuery("#menu-primary .topics a").mouseenter(function() {
		expandAjaxElement('#menu-primary .topics', root+'/?page_id='+jQuery(this).attr('rel'), "#categories_pullout", "#categories_pullout #categories_container");
	});
	
	jQuery('#menu-primary .topics').mouseleave(function(){
		contract('#menu-primary .topics', "#categories_pullout");
	});
	
	/*follow*/	
	jQuery('#menu-primary .follow a').mouseenter(function(){
		expandAjaxElement('#menu-primary .follow', root+'/?page_id='+jQuery(this).attr('rel'));	
	});
		
	jQuery('#menu-primary .follow').mouseleave(function(){
		contract('#menu-primary .follow');			
	});
		
	/*work*/
	jQuery('#menu-primary .work a').mouseenter(function(){
		expandAjaxElement('#menu-primary .work', root+'/?page_id='+jQuery(this).attr('rel'));
	});

	jQuery('#menu-primary .work').mouseleave(function(){
		contract('#menu-primary .work');
	});
		
});
	
function expandAjaxElement(elem, url, heightElem, heightTarget) {
	if(req) req.abort();
	clearTimeout(expandTimeout);
	
	console.log(url);
	
	if(jQuery(elem).find('.ajax_insert').length) {
		expand(elem, 300, heightElem, heightTarget);
		return;
	}
	
	var d = new Date();
	var start = d.getTime();
	req = jQuery.ajax({
	   type: "GET",
	   url: url,
	   dataType: "html",
		success: function(data) {
			var itm = jQuery(elem).append('<div class="ajax_insert">'+data+'</div>');
			expand(elem, Math.max(0, 300-(d.getTime()-start)), heightElem, heightTarget);
		}
	})
}

function contract(elem, heightTarget) {
	clearTimeout(expandTimeout)
	if(jQuery(elem).find('.ajax_insert').length&&req) req.abort();
	jQuery(elem+' .ajax_insert').toggleClass('expanded', false);
	if(heightTarget) jQuery(elem+' '+heightTarget).css('height', 0);
}

function expand(elem, time, heightElem, heightTarget) {
	if(heightElem&&heightTarget) {
		jQuery(elem+' .ajax_insert').toggleClass('expanded', true);
		expandTimeout = setTimeout("jQuery('"+elem+" "+heightElem+"').css('height', jQuery('"+heightTarget+"').height());", time);
		return;
	}
	
	expandTimeout = setTimeout("jQuery('"+elem+" .ajax_insert').toggleClass('expanded', true);", time);
}


/*Scroll follow
 * Taken and tweaked from Happy Cog's blog (thanks)
*/

var scrollID = '#text-23'

jQuery(document).ready(function()
{
	jQuery(scrollID).hide();
});
jQuery(window).load(function()
{
	jQuery(scrollID).fadeIn();
});

function positionFollowers(e) {
	scrollerVisualTop = jQuery('#content_main').offset().top;
	mainVisualTop = jQuery('#content_main').offset().top;
	scrollerCssTop = mainVisualTop;
	scrollerVisualBottom = jQuery('article footer').offset().top + jQuery('article footer').height() - jQuery(scrollID).outerHeight();
	
	/* Anchor to Bottom */
	if (jQuery(window).scrollTop() > scrollerVisualBottom)
	{
		jQuery(scrollID).css({
			position: 'absolute',
			top: jQuery('#content_main').outerHeight(true)+jQuery('article footer').outerHeight(true) - jQuery(scrollID).outerHeight() -30
		});
	}
	
	/* Scroll with Page */
	else if (jQuery(window).scrollTop() > scrollerVisualTop)
	{
		jQuery(scrollID).css({
			position: 'fixed',
			top: 0
		});
	}
	
	/* Fix to Top */
	else
	{		
		jQuery(scrollID).css({
			position: 'absolute',
			top: 0
		});
	}
}

jQuery(window).resize(positionFollowers);
jQuery(window).scroll(positionFollowers);
jQuery(window).load(positionFollowers);
