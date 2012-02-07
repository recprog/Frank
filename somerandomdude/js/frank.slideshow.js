function frank_slideshow(s,o) {
	if(!document.querySelectorAll) return;
	
	var e = document.querySelectorAll(s);
	if(!e) return;
	for(var i=0; i<e.length; i++) new FSS(e[i], o);
}

function FSS(e,o) {
	if( Object.prototype.toString.call(o) === '[object Object]' ) this.opt=o;
	
	//slideshow container
	this.con=e;
	
	//slides
	this.slds=[];
	
	//options
	
	//navigation element
	this.nv;
	
	//caption
	this.cpt
	
	//current index
	this.ci=-1;
	
	//dimensions
	if(!this.opt.width) this.opt.width=this.con.offsetWidth;
	if(!this.opt.height) this.opt.height=this.con.offsetHeight;
	
	//interval
	this.to;
	
	//autoplay
	this.autoplay=true;
	
	//duration
	this.dur=5000;
	
	this.init(e)
	this.gotoslide(0);
	if(this.autoplay) this.play();
	
}

FSS.prototype.init = function(e) {
	
	var ref=this;
	
	//container
	this.con.style.width=this.opt.width+'px';
	this.con.style.height=this.opt.height+'px';
		
	if(!this.con.className.match(new RegExp('(\\s|^)'+'fss'+'(\\s|$)'))) this.con.className += " "+'fss';
	
	//slides
	var cs = e.childNodes;
	
	if(!e.hasChildNodes) return;
	c=e.firstChild;
	var n=0;
	while(c) {
		if(c&&c.nodeType!=3) this.slds.push({ndx:n++, el:c.childNodes})
		c=c.nextSibling;
		
	}
	
	//navigation
	this.nv = document.createElement("ul");
	var a = document.createAttribute("class");
	a.nodeValue="fss-nav";
	this.nv.setAttributeNode(a);
	for(var i=0; i<this.slds.length; i++) {
		var l = document.createElement("li");
		l.appendChild(document.createTextNode(String(i+1)));
		l.onclick = function() { ref.navclick(this); }
		this.nv.appendChild(l);
	}
	
	this.con.appendChild(this.nv)

	//caption
	
	this.cpt = document.createElement("div");
	a = document.createAttribute("class");
	a.nodeValue="fss-caption";
	this.cpt.setAttributeNode(a);
	this.con.parentNode.insertBefore(this.cpt, this.con.nextSibling);
	
	//events 
	this.con.onmouseover = function(e) {
		if(!e) return;
		
		if(e.target!=ref.con) {
			e.cancelBubble=true;
			e.stopPropagation();
			return false;
		}
		
		ref.pause();
		if(!ref.nv.className.match(new RegExp('(\\s|^)'+'active'+'(\\s|$)'))) ref.nv.className += " "+'active';
	}
	this.con.onmouseout = function(e) {
		if(!e) return;
		
		if(ref.ischild(e.relatedTarget, ref.con)) {
			e.cancelBubble=true;
			e.stopPropagation();
			return false;
		}
	
		ref.play();
		if(ref.nv.className.match(new RegExp('(\\s|^)'+'active'+'(\\s|$)'))) ref.nv.className=ref.nv.className.replace(new RegExp('(\\s|^)'+'active'+'(\\s|$)'),'');
	}
}

FSS.prototype.ischild = function(c,p) {
	if (p===c) { return false; }
	      while (c&&c!==p)
	   { c=c.parentNode; }

	   return c===p;
}

FSS.prototype.autoNext = function(c) {
	if(!c) return;
	c.next();
	c.play();
}

FSS.prototype.next = function() {
	this.gotoslide(((this.ci<this.slds.length-1)?this.ci+1:0))
}

FSS.prototype.navclick = function(e) {
	this.pause();
	var i=0;
	while(this.nv.childNodes.item(i)) {
		if(this.nv.childNodes.item(i)==e) {
			this.gotoslide(i);
			return;
		}
		i++;
	}
}

FSS.prototype.gotoslide = function(n) {
	if(this.ci==n) return;
	
	//update slides
	this.con.style.backgroundPosition=String(this.opt.width*(n)*-1)+"px 0px";
	
	//--update navigation--

	//remove 'active' class if exists
	var a = this.nv.querySelector(".active");
	if(a) a.removeAttribute("class");
	
	//add new 'active' class
	a = document.createAttribute("class");
	a.nodeValue="active";
	this.nv.childNodes.item(n).setAttributeNode(a);
		
	//--update caption--
	
	//remove caption if exists
	while(this.cpt.hasChildNodes()) this.cpt.removeChild(this.cpt.firstChild);
	
	//add new caption
	for(var i=0; i<this.slds[n]["el"].length; i++) {
		var cl = this.slds[n]["el"].item(i).cloneNode(true);
		this.cpt.appendChild(cl)
	}
	
	this.ci=n;
	
}

FSS.prototype.pause = function() {
	clearTimeout(this.to);
}

FSS.prototype.play = function() {
	clearTimeout(this.to);
	this.to = setTimeout(this.autoNext, this.dur, this);
}