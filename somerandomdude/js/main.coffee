###global FSS:true, FLB:true, _gaq:true, console:true###
#This will be where all JS specific to SRD.com shows up

window.onload = ->
	return if not document.querySelector

	navClickHandler = (elem, navItems) ->
		return () ->
			a = elem.getAttribute('rel')
			elem.className+=' active';
			for item in navItems 
				if item.className.match(new RegExp('(\\s|^)' + 'active' + '(\\s|$)'))
					item.className = item.className.replace(new RegExp('(\\s|^)' + 'active' + '(\\s|$)'), '') 

			projectItems = document.querySelectorAll('#projects_list li');
			for projectItem in projectItems
				projectItem.className = projectItem.className.replace(new RegExp('(\\s|^)' + 'deselected' + '(\\s|$)'), '') if projectItem.className.match(new RegExp('(\\s|^)' + 'deselected' + '(\\s|$)'))
				if a != 'all' and !projectItem.className.match(new RegExp('(\\s|^)' + a + '(\\s|$)'))
					if !projectItem.className.match(new RegExp('(\\s|^)' + 'deselected' + '(\\s|$)'))
						projectItem.className += ' '+ 'deselected'
			return

	trackClickHandler = (elem, cat, action, label) ->
		return () ->
			gaTrack(cat, if action then elem.querySelector(action).firstChild.nodeValue else elem.firstChild.nodeValue)
			#setTimeout('document.location = "' + elem.href + '"', 100);

			if elem.getAttribute("target")
				window.open(@href, @getAttribute("target"))
			else 
				setTimeout('document.location = "' + elem.href + '"', 100)
			return false

	
	# Google Analytics event tracking
	trackElems = (elems, cat, action, label) ->
		return if not elems
		for elem in elems
			elem.onclick = trackClickHandler(elem, cat, action, label)
		return false

	gaTrack = (cat, action, label, val) ->
		try
			_gaq.push(['_trackEvent', cat, action, label, val])
		catch error
			print error
		return

	slideshows = document.querySelectorAll('#hero_slideshow .slideshow')
	if slideshows.length
		for slideshow in slideshows
			fss = new FSS(slideshow, {width: 725, height: 210}) 

	lightboxes = document.querySelectorAll('a[rel=simplebox]')
	if lightboxes.length
		for lightbox in lightboxes  
			flb = new FLB(lightbox, {});

	if document.querySelector('#p72')
		navItems = document.querySelectorAll('#projects_navigation dd');
		for navItem in navItems
			navItem.onclick = navClickHandler(navItem, navItems)

	postTweet = document.querySelector('#post_tweet')
	if postTweet
		postTweet.onclick = (e) ->
			gaTrack('Tweet Post', @firstChild.nodeValue, document.title)
			centerLeft = window.screen.width/2 - 550/2
			centerTop = window.screen.height/2 - 470/2
			window.open(@href, @getAttribute("target"), 'width=550, height=470, location=0, left='+centerLeft+', top='+centerTop)
			return false

	#trackElems(document.querySelectorAll('#post_tweet'), 'Tweet Post', null, document.title);
	trackElems(document.querySelectorAll('#menu-primary li a'), 'Top Nav', null, document.title);
	trackElems(document.querySelectorAll('#bio_pic'), 'Bio Pic', null, document.title);
	trackElems(document.querySelectorAll('#previous_post a'), 'Previous Post', '.arrow', document.title);
	trackElems(document.querySelectorAll('#download_follow a.twitter, #download_follow a.rss'), 'Projects Follow', null, document.title);
	trackElems(document.querySelectorAll('#other_projects #projects_list li a'), 'Other Projects', 'small', document.title);
	trackElems(document.querySelectorAll('#footer_main_promo'), 'Footer Promo', '.header', document.title);
	trackElems(document.querySelectorAll('#text-12 .recommended a'), 'Recommended', null, document.title);
	trackElems(document.querySelectorAll('#page_footer #twitter_follow a.button'), 'Footer Twitter', null, document.title);

	return

# Track client-side JS errors
window.error = (message, file, line) -> 
	_gaq.push(['_trackEvent', 'Exceptions', 'Application', '[' + file + ' (' + line + ')] ' + message, null, true]);
	return


###
function getOffset( el ) {
		var _x = 0;
		var _y = 0;
		while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
				_x += el.offsetLeft - el.scrollLeft;
				_y += el.offsetTop - el.scrollTop;
				el = el.offsetParent;
		}
		return { top: _y, left: _x };
}
var x = getOffset( document.getElementById('yourElId') ).left;
###