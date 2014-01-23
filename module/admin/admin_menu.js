$(function(){
	$('li.name').mouseenter(function(){
		$(this).addClass('selected');
		setTimeout(function(){$('li.selected > ul.submenu').css('display','block');},300);
	
	});
	$('li.name').mouseleave(function(){
		$(this).removeClass('selected');
		setTimeout(function(){$('li > ul.submenu').css('display','none');},300);
	});
});







