/*this will be where all JS specific to SRD.com shows up*/

jQuery(document).ready(function() {	
	jQuery("<style type='text/css'> a{ -webkit-transition-property: background, color; -webkit-transition-duration: .3s; -webkit-transition-timing-function: cubic-bezier(0.02, 0, 0.18, 1.0); -moz-transition-property: background, color; -moz-transition-duration: .3s; -moz-transition-timing-function: cubic-bezier(0.02, 0, 0.18, 1.0); -o-transition-property: background, color; -o-transition-duration: .3s; -o-transition-timing-function: cubic-bezier(0.02, 0, 0.18, 1.0); } </style>").appendTo("head");	
	
	var root=jQuery('link[rel=index]').attr('href');
	
	jQuery('#content.home .oneup.large section p').each(function() {
		jQuery(this).wrapInner('<a href="'+jQuery(this).parents("article").find('header a').attr('href')+'" />');
	});
	
	jQuery("a[href^='http:']").not("[href*='" + window.location.host + "']").each(function (i) {
		if(jQuery(this).find('img').length) return;
		jQuery(this).attr('target','_blank');
		jQuery(this).addClass('external')
	});	
	
	
	/*page-specific*/
	jQuery('#hero_slideshow .slideshow').srdslideshow({spriteSlideshow:true, width:725, height:210, captionTarget:jQuery('#hero_slideshow_caption')});
	
	/*projects*/
	if(jQuery("#p72").length) {
		jQuery('#projects_navigation dd').click(function() {
			jQuery('#projects_navigation dd.active').removeClass('active');
			jQuery(this).addClass('active');
			(jQuery.support.opacity)?highlightItems(jQuery(this).attr('rel')):highlightItemsIE(jQuery(this).attr('rel'));

		});
	}
	
	/*coordy*/
	if(jQuery("#p5215").length) {
		var container = jQuery('#coordy_examples_nav');
		var list = container.append("<ul class='accordion'></ul>");
		var group;
		var examples;
		var group_uid=0;
		var item_uid=0;
		var xmlData;

		jQuery('#coordy_examples_nav').mouseenter(function() {
			jQuery(this).addClass('active');
		});

		jQuery('#coordy_examples_nav').mouseleave(function() {
			jQuery(this).removeClass('active');
		});

		jQuery.get("/wp-content/data/pages/coordy/coordy_examples.xml", function(data){
			xmlData=data;
		  	jQuery(data).find('example_group').each(function(){
				group_uid++;
				jQuery('ul.accordion').append("<li class='uid"+group_uid+"'>"+jQuery(this).attr('title')+"</li>");
				jQuery("li.uid"+group_uid).append("<ul></ul>");
				jQuery(this).find('example').each(function(){
					item_uid++;
					jQuery("li.uid"+group_uid+" ul").append("<li><a class='"+jQuery(this).attr('id')+"' href=''>"+jQuery(this).attr('title')+"</a></li>");
				})
			});

			jQuery('#coordy_examples_nav ul.accordion li li a:not(.source)').click(function () { 
				jQuery('#hero_slideshow .examples').append('<div class="swf_container"></div>').flash({   
					 	swf: jQuery(xmlData).find('example[title="'+jQuery(this).text()+'"] swf').text(),   
					 	width: 725,   
					 	height: 350,
					 	hasVersion: 10,
					 	id:'organizers3d',
					 	name:'organizers3d',
					 	params: 
					 	{   
							bgcolor: "#f0eceb",
					 		menu: "false",
							scale: "noScale",
							salign: "TL",
							wmode:"transparent"
					 	}  
					 });
				jQuery('#coordy_examples_nav a.selected').removeClass('selected');
				jQuery(this).addClass('selected');
				jQuery('#hero_slideshow p.caption').remove();
				jQuery('#hero_slideshow').append('<p class="caption">'+jQuery(xmlData).find('example[title="'+jQuery(this).text()+'"] caption').text()+' (<a class="source" href="'+jQuery(xmlData).find('example[title="'+jQuery(this).text()+'"] source').text()+'" target="_blank">view source</a>)</p>')
				return false;
			});

			jQuery('#coordy_examples_nav li li a:first').click();	
		});
	}
	
});

function highlightItems(category) {
	if(category=='all') {
		jQuery('#projects_list li').removeClass('deselected');
		return;
	}
	
	jQuery('#projects_list li.'+category).removeClass('deselected');
	jQuery('#projects_list li:not(.'+category+')').addClass('deselected');
}
