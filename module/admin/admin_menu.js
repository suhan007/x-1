$(function(){
	$('li.name').mouseover(function(){
		$(this).addClass('selected').siblings().removeClass('selected');
		setTimeout(function(){$('li.selected > ul.submenu').css('display','block');},300);
	
	});
	$('li.name').mouseout(function(){
		$(this).removeClass('selected')
		setTimeout(function(){$('li > ul.submenu').css('display','none');},300);
	});
});