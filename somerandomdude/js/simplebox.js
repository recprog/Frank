/**
 * @version		1.0
 * @package		SimpleBox
 * @author    Fotis Evangelou - http://nuevvo.com/labs/simplebox
 * @copyright	Copyright (c) 2008-2011 Fotis Evangelou / Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// Parameters
var sbLoaderSide = 100;
var resizeImage = 1;
var imgDisplayDelay = 600;
var sbOverlayId = "jwSBoverlay";
var sbContainerId = "jwSBcontainer";
var sbContentId = "jwSBcontent";
var sbImageId = "jwSBimage";
var sbImageAlt = "Preview...";
var sbCaptionId = "sbcaption";
var sbButtonCloseId = "jwSBclose";
var sbCloseTitle = "Click anywhere on the screen to close the image...";

// Do not change below this line
//var sbRelTag = "simplebox";
var isIE6 = navigator.userAgent.toLowerCase().indexOf('msie 6') != -1;

// Main simpleBox function
function simpleBox() {
	if(!document.getElementsByTagName) return false;
	if(!document.getElementById) return false;
	var a = document.getElementsByTagName("a");
	for(var i=0; i<a.length; i++){
		
		if(/simplebox/.test(a[i].getAttribute("rel"))){
			a[i].onclick = function(){
				var imgSource = this.getAttribute("href");
				var imgTitle = this.getAttribute("title");
				if(!imgTitle) imgTitle = 'Images from the article '+document.title;
				buildImgPopup(imgSource,imgTitle);
				return false;
			}
		}
	}
}

function buildImgPopup(sbImg,sbTitle){
	var sbImg;
	var sbTitle;

	// create and append the HTML
	var jwlbcontainer = document.createElement('div');
	jwlbcontainer.setAttribute("id",sbOverlayId);
	if(isIE6){
		document.getElementsByTagName('html')[0].style.overflow = 'hidden';
		var IEwidth = document.documentElement.clientWidth+'px';
		var IEheight = document.documentElement.clientHeight+'px';
	}
	jwlbcontainer.innerHTML = '<div id="'+sbContainerId+'" style="width:'+IEwidth+';height:'+IEheight+';"><a href="#" title="'+sbCloseTitle+'" class="closingElement">&nbsp;</a></div><div id="'+sbContentId+'"><a id="'+sbImageId+'" class="closingElement" href="#" title="'+sbCloseTitle+'"></a><span id="'+sbCaptionId+'">'+sbTitle+'</span><a id="'+sbButtonCloseId+'" class="closingElement" href="#" title="'+sbCloseTitle+'">&nbsp;</a></div>';

	document.getElementsByTagName("body")[0].appendChild(jwlbcontainer);

	// container div
	var div = document.getElementById(sbContentId);
	div.style.width = sbLoaderSide+'px';
	div.style.height = sbLoaderSide+'px';
	div.style.margin = '-'+(sbLoaderSide/2)+'px 0 0 -'+(sbLoaderSide/2)+'px';
	if(isIE6){
		jwlbcontainer.style.top = document.documentElement.scrollTop+'px';
		div.style.top = (document.documentElement.clientHeight/2)+'px';
		div.style.position = 'absolute';
	}

	// define the popup image
	var imgContainer = document.getElementById(sbImageId);
	imgContainer.style.background = "url("+sbImg+") no-repeat 50% 50%";
	imgContainer.style.display = "none";
	
	var imgCaption = document.getElementById(sbCaptionId);
	imgCaption.style.display = "none";

	// create the image object
	var image = new Image();
	image.onload = function(){
	
		// Grab image dimensions and do some resizing
		if(resizeImage){
			var resizeHeight = document.documentElement.clientHeight-40;
			if(image.height<resizeHeight){
				imgHeight = image.height;
				imgWidth = image.width;
			} else {
				imgHeight = resizeHeight;
				imgWidth = Math.round(resizeHeight*image.width/image.height);
				image.height = imgHeight;
				image.width = imgWidth;
			}
		} else {
			imgHeight = image.height;
			imgWidth = image.width;
		}
		
		// Hide the loading icon
		setTimeout(function(){div.style.background = "#060606";},300);			
		// provide new dimensions for the container
		setTimeout(function(){
			div.style.width = imgWidth+'px';
			div.style.height = imgHeight+'px';
			div.style.margin = '-'+((imgHeight+28)/2)+'px 0 0 -'+(imgWidth/2)+'px';
		},600);

		// Display the image - imgDisplayDelay
		setTimeout(function(){
			imgContainer.style.display="block";
			imgCaption.style.display="";
		},900);

	}
	
	// Append the image source so IE can read image dimensions properly
	image.src = sbImg;
	
	// Destroy HTML created for the popup
	var closeLinks = jwlbcontainer.getElementsByTagName("a");
	for(var j=0; j<closeLinks.length; j++){
		if (closeLinks[j].className == "closingElement") {
			closeLinks[j].onclick = function(){
				jwlbcontainer.style.display='none';
				document.getElementsByTagName("body")[0].removeChild(jwlbcontainer);
				if(isIE6){
					document.getElementsByTagName('html')[0].style.overflow = '';
				}
				return false;
			}
		}
	}
}

// Loader
function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      if (oldonload) {
        oldonload();
      }
      func();
    }
  }
}

// Load SimpleBox
addLoadEvent(simpleBox);
