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
}