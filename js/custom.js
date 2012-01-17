/*this will be where all JS specific to SRD.com shows up*/
window.onload = function() { 
	if(!document.querySelector) return;
	
	var style = document.createElement("style");
	var a = document.createAttribute("type");
	a.nodeValue="text/css";
	style.setAttributeNode(a);
	
	var t = document.createTextNode('a{ -webkit-transition-property: background, color; -webkit-transition-duration: .3s; -webkit-transition-timing-function: cubic-bezier(0.02, 0, 0.18, 1.0); -moz-transition-property: background, color; -moz-transition-duration: .3s; -moz-transition-timing-function: cubic-bezier(0.02, 0, 0.18, 1.0); -o-transition-property: background, color; -o-transition-duration: .3s; -o-transition-timing-function: cubic-bezier(0.02, 0, 0.18, 1.0); }');
	document.getElementsByTagName('head').item(0).appendChild(style);
	try {style.appendChild(t); }
	catch (err) {};
	
	frank_slideshow("#hero_slideshow .slides", {width:725, height:210}); 
	
	if(document.querySelector('#p72')) {
		var items = document.querySelectorAll('#projects_navigation dd');
		var a;
		var ref;
		for(var i=0; i<items.length; i++) {
			ref=items[i];
			
			ref.onclick = function() {
				items = document.querySelectorAll('#projects_navigation dd');
				a=this.getAttribute('rel');
			
				for(var k=0; k<items.length; k++) {
					var b = items[k].getAttribute('rel');
					
					if(b!=a) {
						if(items[k].className.match(new RegExp('(\\s|^)'+'active'+'(\\s|$)'))) items[k].className=items[k].className.replace(new RegExp('(\\s|^)'+'active'+'(\\s|$)'),'');
					} 
					else {
						if(!items[k].className.match(new RegExp('(\\s|^)'+'active'+'(\\s|$)'))) items[k].className += " "+'active';
					}
					
				}

				var itms=document.querySelectorAll('#projects_list li');
				for(var j=0; j<itms.length; j++) {
					if(itms[j].className.match(new RegExp('(\\s|^)'+'deselected'+'(\\s|$)'))) itms[j].className=itms[j].className.replace(new RegExp('(\\s|^)'+'deselected'+'(\\s|$)'),'');
					if(a!='all'&&!itms[j].className.match(new RegExp('(\\s|^)'+a+'(\\s|$)'))) if(!itms[j].className.match(new RegExp('(\\s|^)'+'deselected'+'(\\s|$)'))) itms[j].className += " "+'deselected';					
				}
			}
		}
	}
	
	/*custom tracking events*/
	
	/*top navigation*/
	var tnav = document.querySelectorAll('#menu-primary li a');
	for(var i=0; i<tnav.length; i++) {
		ref=tnav[i];	
		ref.onclick = function() { gaTrack('Top Nav', this.firstChild.nodeValue, document.title); 
		setTimeout('document.location = "' + this.href + '"', 100);
		return false; }
	}
	
	/*projects twitter & rss*/
	var proj = document.querySelectorAll('#download_follow a.twitter, #download_follow a.rss');
	for(var i=0; i<proj.length; i++) {
		ref=proj[i];	
		ref.onclick = function() { gaTrack('Projects Follow', this.firstChild.nodeValue, document.title); 
		setTimeout('document.location = "' + this.href + '"', 100);
		return false; }
	}
	
	/*other projects list*/
	var projects = document.querySelectorAll('#other_projects #projects_list li a');
	for(var i=0; i<projects.length; i++) {
		ref=projects[i];	
		ref.onclick = function() { gaTrack('Other Projects', this.querySelector('small').firstChild.nodeValue, document.title); 
		setTimeout('document.location = "' + this.href + '"', 100);
		return false; }
	}
	
	/*previous post*/
	var previous = document.querySelector('#content.single .post-info .previous a');
	if(previous) { 
		previous.onclick = function() { gaTrack('Previous Post', this.childNodes.item(1).nodeValue, document.title); 
		setTimeout('document.location = "' + this.href + '"', 100);
		return false; } 
	}
	
	/*footer promo*/
	var promo = document.querySelector('#footer_main_promo');
	if(promo) { 
		promo.onclick = function() { gaTrack('Footer Promo', this.querySelector('.header').firstChild.nodeValue, document.title); 
		setTimeout('document.location = "' + this.href + '"', 100);
		return false; }
	}
	
	/*footer recommended*/
	var recommended = document.querySelectorAll('#text-12 .recommended li a');
	for(var i=0; i<recommended.length; i++) {
		ref=recommended[i];	
		ref.onclick = function() { gaTrack('Recommended', this.firstChild.nodeValue, document.title); 
		setTimeout('document.location = "' + this.href + '"', 100);
		return false; }
	}
	
	/*footer topics*/
	var topics = document.querySelectorAll('#text-13 .recommended li a');
	for(var i=0; i<topics.length; i++) {
		ref=topics[i];	
		ref.onclick = function() { gaTrack('Topics', this.firstChild.nodeValue, document.title); 
		setTimeout('document.location = "' + this.href + '"', 100);
		return false; }
	}
	
	/*footer follow list*/
	var follow = document.querySelectorAll('#footer_follow_list li a');
	for(var i=0; i<follow.length; i++) {
		ref=follow[i];	
		ref.onclick = function() { gaTrack('Follow Me', this.querySelector('span').firstChild.nodeValue, document.title); 
		setTimeout('document.location = "' + this.href + '"', 100);
		return false; }
	}
	
	var twitter = document.querySelector('#tweet-button a');
	if(twitter) { 
		twitter.onclick = function() { gaTrack('Twitter Button', '', document.title); 
		setTimeout('document.location = "' + this.href + '"', 100);
		return false; }
	}
	
	function gaTrack(cat, action, label, val) {
		try { _gaq.push(['_trackEvent', cat, action, label, val]); } catch(err) {}
	}
		
}