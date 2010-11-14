/*this will be where all JS specific to SRD.com shows up*/

/*content pulldowns are AJAX driven*/
var expandTimeout;
var req;

jQuery(document).ready(function() {
		
	jQuery('#content.home #content_secondary .post, #content.home #content_tertiary .post').mouseenter(function(){
		jQuery(this).toggleClass('active', true);
	})
	jQuery('#content.home #content_secondary .post, #content.home #content_tertiary .post').mouseleave(function(){
		jQuery(this).toggleClass('active', false);
	})
	
	jQuery('#content.home #content_primary section p').wrapInner('<a href="'+jQuery('#content.home #content_primary header a').attr('href')+'" />');
	jQuery('#content.home #content_secondary a img').unwrap();
	
	/*categories*/
	jQuery("#menu-item-216 a").mouseenter(function() {
		expandAjaxElement('#menu-item-216', 'http://localhost/wordpress/?page_id='+jQuery(this).attr('rel'), "#categories_pullout", "#categories_pullout #categories_container");
	});
	
	jQuery('#menu-item-216').mouseleave(function(){
		contract('#menu-item-216', "#categories_pullout");
	});
	
	/*follow*/	
	jQuery('#menu-item-217 a').mouseenter(function(){
		expandAjaxElement('#menu-item-217', 'http://localhost/wordpress/?page_id='+jQuery(this).attr('rel'));	
	});
		
	jQuery('#menu-item-217').mouseleave(function(){
		contract('#menu-item-217');			
	});
		
	/*work*/
	jQuery('#menu-item-214 a').mouseenter(function(){
		expandAjaxElement('#menu-item-214', 'http://localhost/wordpress/?page_id='+jQuery(this).attr('rel'));
	});

	jQuery('#menu-item-214').mouseleave(function(){
		contract('#menu-item-214');
	});
		
});
	
function expandAjaxElement(elem, url, heightElem, heightTarget) {
	if(req) req.abort();
	clearTimeout(expandTimeout);
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
	expandTimeout = setTimeout("jQuery('"+elem+" .ajax_insert').toggleClass('expanded', true);", time);
	if(heightElem&&heightTarget) jQuery(elem+' '+heightElem).css('height', jQuery(heightTarget).height());
}