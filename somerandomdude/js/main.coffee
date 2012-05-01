#this will be where all JS specific to SRD.com shows up

window.onload = ->
  return if not document.querySelector

  slideshows = document.querySelectorAll('#hero_slideshow .slideshow')
  if slideshows.length
    for slideshow in slideshows
      new FSS(slideshow, {width: 725, height: 210}) 

  lightboxes = document.querySelectorAll('a[rel=simplebox]')
  if lightboxes.length
    for lightbox in lightboxes  
      new FLB(lightbox, {});

  if document.querySelector('#p72')
    navItems = document.querySelectorAll('#projects_navigation dd');
    for navItem in navItems
      navItem.onclick = (e) ->
        a = @.getAttribute('rel')
        @.className+=' active';
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
  
  # Google Analytics event tracking
  trackElems = (elems, cat, action, label) ->
    return if not elems
    for elem in elems
      elem.onclick = ->
        gaTrack(cat, if action then @.querySelector(action).firstChild.nodeValue else @.firstChild.nodeValue)
        setTimeout('document.location = "' + @.href + '"', 100); 
        return false
    return false

  trackElems(document.querySelectorAll('#post_tweet'), 'Tweet Post', null, document.title);
  trackElems(document.querySelectorAll('#menu-primary li a'), 'Top Nav', null, document.title);
  trackElems(document.querySelectorAll('#bio_pic'), 'Bio Pic', null, document.title);
  trackElems(document.querySelectorAll('#content.single .post-info .previous a'), 'Previous Post', '.arrow', document.title);
  trackElems(document.querySelectorAll('#download_follow a.twitter, #download_follow a.rss'), 'Projects Follow', null, document.title);
  trackElems(document.querySelectorAll('#other_projects #projects_list li a'), 'Other Projects', 'small', document.title);
  trackElems(document.querySelectorAll('#footer_main_promo'), 'Footer Promo', '.header', document.title);
  trackElems(document.querySelectorAll('#text-12 .recommended a'), 'Recommended', null, document.title);
  trackElems(document.querySelectorAll('#page_footer #twitter_follow a.button'), 'Footer Twitter', null, document.title);

  gaTrack = (cat, action, label, val) ->
    try
      _gaq.push(['_trackEvent', cat, action, label, val])
    catch error
      print error
    return

  return

# Track client-side JS errors
window.error = (message, file, line) -> 
  _gaq.push(['_trackEvent', 'Exceptions', 'Application', '[' + file + ' (' + line + ')] ' + message, null, true]);
  return