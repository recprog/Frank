$(document).ready(function()
{
	$('.p-wrap, .n-wrap').hide();
});
$(window).load(function()
{
	$('.p-wrap, .n-wrap').fadeIn();
});

function positionFollowers(e)
{
	insetTop = $('.inset').offset().top - parseInt($('.inset').css("marginTop"), 10);
	scrollerVisualTop = insetTop + $('.inset').outerHeight(true);
	mainVisualTop = $('#main').offset().top;
	scrollerCssTop = scrollerVisualTop - mainVisualTop;
	scrollerVisualBottom = $('#main').offset().top + $('#main').height() - 200;
	
	/* Window's too Narrow */
	if($(window).width() < 785)
	{
		$('.p-wrap, .n-wrap').css('position','static');
		$('#next-page, #prev-page').removeClass('fixed');
		$('#next-page, #prev-page').parent().removeClass('anchored');
	}
	
	/* Anchor to Bottom */
	else if ($(window).scrollTop() > scrollerVisualBottom)
	{
		$('.p-wrap, .n-wrap').css('position','absolute');
		$('#next-page, #prev-page').removeClass('fixed');
		$('#next-page, #prev-page').parent().addClass('anchored');
	}
	
	/* Scroll with Page */
	else if ($(window).scrollTop() > scrollerVisualTop)
	{
		$('.p-wrap, .n-wrap').css('position','absolute');
		$('#next-page, #prev-page').addClass('fixed');
		$('#next-page, #prev-page').parent().removeClass('anchored');
	}
	
	/* Fix to Top */
	else
	{
		$('.p-wrap, .n-wrap').css('position','absolute');
		$('#next-page, #prev-page').removeClass('fixed');
		$('#next-page, #prev-page').parent().removeClass('anchored');
		
		$('.p-wrap, .n-wrap').css({
			position: 'absolute',
			top: scrollerCssTop
		});
	}
}

$(window).resize(positionFollowers);
$(window).scroll(positionFollowers);
$(window).load(positionFollowers);