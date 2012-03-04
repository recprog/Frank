function frank_slideshow(s,o) {
	if(!document.querySelectorAll) return;
	
	var e = document.querySelectorAll(s);
	if(!e) return;
	for(var i=0; i<e.length; i++) new FSS(e[i], o);
}

function FSS(e,o) {
	if( Object.prototype.toString.call(o) === '[object Object]' ) this.opt=o;
	
	//slideshow target
	this.trgt=e;
	
	//slideshow container
	this.con;
	
	//slides
	this.slds=[];
	
	//options
	
	//navigation element
	this.nv;
	
	//slide a
	this.sa;
	
	//slide b
	this.sb;
	
	//caption
	this.cpt
	
	//current index
	this.ci=-1;
	
	//dimensions
	if(!this.opt.width) this.opt.width=this.trgt.offsetWidth;
	if(!this.opt.height) this.opt.height=this.trgt.offsetHeight;
	
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
	var a;
		
	if(!this.trgt.className.match(new RegExp('(\\s|^)'+'fss'+'(\\s|$)'))) this.trgt.className += " "+'fss';
	
	//slides
	
	//caption
	this.cpt = this.trgt.querySelector('.captions');
	
	if(!this.cpt) return;
	c=this.cpt.firstChild;
	var n=0;
	while(c) {
		if(c&&c.nodeType!=3) this.slds.push({ndx:n++, el:c})
		c=c.nextSibling;
	}
	
	//slide container
	this.con = document.createElement("div");
	a = document.createAttribute("class");
	a.nodeValue="slide-container";
	this.con.setAttributeNode(a);
	
	
	
	//dual slides
	this.sa = document.createElement("div");
	a = document.createAttribute("class");
	a.nodeValue="slide-a visible";
	this.sa.setAttributeNode(a);
	
	this.sb = document.createElement("div");
	a = document.createAttribute("class");
	a.nodeValue="slide-b";
	this.sb.setAttributeNode(a);
	
	this.trgt.insertBefore(this.con, this.cpt)
	this.con.appendChild(this.sa);
	this.con.appendChild(this.sb);
	
	
	this.sa.style.width=this.opt.width+'px';
	this.sa.style.height=this.opt.height+'px';
	this.sb.style.width=this.opt.width+'px';
	this.sb.style.height=this.opt.height+'px';
	
	//navigation
	this.nv = document.createElement("ul");
	a = document.createAttribute("class");
	a.nodeValue="fss-nav";
	this.nv.setAttributeNode(a);
	for(var i=0; i<this.slds.length; i++) {
		var l = document.createElement("li");
		l.appendChild(document.createTextNode(String(i+1)));
		l.onclick = function() { ref.navclick(this); }
		this.nv.appendChild(l);
	}
	
	this.con.appendChild(this.nv)

	var g =  this.con
	
	//events 
	this.con.onmouseover = function(e) {
		if(!e) return;
		if(!ref.ischild(e.target, ref.con)) {
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
	var a;
	
	//switch-a-roo 
	var a = this.trgt.parentNode.querySelector(".visible")
	if(a&&a==this.sa) {
		this.sb.style.backgroundPosition="0px "+String(this.opt.height*(n)*-1)+"px";
		this.sa.className=this.sa.className.replace(new RegExp('(\\s|^)'+'visible'+'(\\s|$)'),'');
		this.sb.className += " "+'visible';
	} else {
		this.sa.style.backgroundPosition="0px "+String(this.opt.height*(n)*-1)+"px";
		this.sb.className=this.sb.className.replace(new RegExp('(\\s|^)'+'visible'+'(\\s|$)'),'');
		this.sa.className += " "+'visible';
	}
	
	//--update navigation--

	//remove 'active' class if exists
	a = this.nv.querySelector(".active");
	if(a) a.removeAttribute("class");
	
	//add new 'active' class
	a = document.createAttribute("class");
	a.nodeValue="active";
	this.nv.childNodes.item(n).setAttributeNode(a);
		
	//--update caption--
	
	//remove caption if exists
	
	var m = (this.ci==-1)?0:this.ci;
	
	this.slds[m]['el'].className=this.slds[m]['el'].className.replace(new RegExp('(\\s|^)'+'active'+'(\\s|$)'),'');
	this.slds[n]['el'].className += " "+'active';
	
	this.ci=n;
	
}

FSS.prototype.pause = function() {
	clearTimeout(this.to);
}

FSS.prototype.play = function() {
	clearTimeout(this.to);
	this.to = setTimeout(this.autoNext, this.dur, this);
}