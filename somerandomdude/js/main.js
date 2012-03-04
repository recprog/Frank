/*this will be where all JS specific to SRD.com shows up*/
window.onload = function() {
	if (!document.querySelector) return;

	var style = document.createElement('style');
	var a = document.createAttribute('type');
	a.nodeValue = 'text/css';
	style.setAttributeNode(a);

	var t = document.createTextNode('a{ -webkit-transition-property: background-color, color; -webkit-transition-duration: .3s; -webkit-transition-timing-function: cubic-bezier(0.02, 0, 0.18, 1.0); -moz-transition-property: background, color; -moz-transition-duration: .3s; -moz-transition-timing-function: cubic-bezier(0.02, 0, 0.18, 1.0); -o-transition-property: background, color; -o-transition-duration: .3s; -o-transition-timing-function: cubic-bezier(0.02, 0, 0.18, 1.0); }');
	document.getElementsByTagName('head').item(0).appendChild(style);
	try {style.appendChild(t); }
	catch (err) {}

	frank_slideshow('#hero_slideshow .slideshow', {width: 725, height: 210});
	simpleBox();

	if (document.querySelector('#p72')) {
		var items, a, ref, i, k, j, itms, b;
		items = document.querySelectorAll('#projects_navigation dd');
		for (i = 0; i < items.length; i++) {
			ref = items[i];

			ref.onclick = function() {
				items = document.querySelectorAll('#projects_navigation dd');
				a = this.getAttribute('rel');

				for (k = 0; k < items.length; k++) {
					b = items[k].getAttribute('rel');

					if (b != a) {
						if (items[k].className.match(new RegExp('(\\s|^)' + 'active' + '(\\s|$)'))) items[k].className = items[k].className.replace(new RegExp('(\\s|^)' + 'active' + '(\\s|$)'), '');
					}
					else {
						if (!items[k].className.match(new RegExp('(\\s|^)' + 'active' + '(\\s|$)'))) items[k].className += ' '+ 'active';
					}

				}

				itms = document.querySelectorAll('#projects_list li');
				for (j = 0; j < itms.length; j++) {
					if (itms[j].className.match(new RegExp('(\\s|^)' + 'deselected' + '(\\s|$)'))) itms[j].className = itms[j].className.replace(new RegExp('(\\s|^)' + 'deselected' + '(\\s|$)'), '');
					if (a != 'all' && !itms[j].className.match(new RegExp('(\\s|^)' + a + '(\\s|$)'))) if (!itms[j].className.match(new RegExp('(\\s|^)' + 'deselected' + '(\\s|$)'))) itms[j].className += ' '+ 'deselected';
				}
			}
		}
	}

	/*custom tracking events*/
	trackElems(document.querySelectorAll('#menu-primary li a'), 'Top Nav', null, document.title);
	trackElem(document.querySelector('#bio_pic'), 'Bio Pic', null, document.title);

	trackElem(document.querySelector('#content.single .post-info .previous a'), 'Previous Post', '.arrow', document.title);
	
	trackElems(document.querySelectorAll('#download_follow a.twitter, #download_follow a.rss'), 'Projects Follow', null, document.title);
	trackElems(document.querySelectorAll('#other_projects #projects_list li a'), 'Other Projects', 'small', document.title);
	
	trackElem(document.querySelector('#footer_main_promo'), 'Footer Promo', '.header', document.title);
	trackElems(document.querySelectorAll('#text-12 .recommended a'), 'Recommended', null, document.title);
	trackElem(document.querySelector('#page_footer #twitter_follow a.button'), 'Footer Twitter', null, document.title);
	

	function trackElem(elem, cat, action, label) {
		if(!elem) return;
		elem.onclick = function() { gaTrack(cat, (action) ? this.querySelector(action).firstChild.nodeValue : this.firstChild.nodeValue, document.title);
		setTimeout('document.location = "' + this.href + '"', 100);
		return false; }
	}

	function trackElems(elems, cat, action, label) {
		if(!elems) return;
		for (i = 0; i < elems.length; i++) {
			elems[i].onclick = function() { gaTrack(cat, (action) ? this.querySelector(action).firstChild.nodeValue : this.firstChild.nodeValue, label);
			setTimeout('document.location = "' + this.href + '"', 100);
			return false; }
		}
	}

	function gaTrack(cat, action, label, val) {
		try { _gaq.push(['_trackEvent', cat, action, label, val]); } catch (err) {}
	}

};
