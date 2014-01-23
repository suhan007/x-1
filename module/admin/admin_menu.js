$(function(){
	$('li.name').mouseover(function(){
		$(this).addClass('selected').siblings().removeClass('selected');
		$('li.selected > ul.submenu').css('display','block');
	
	});
	$('li.name').mouseout(function(){
		$(this).removeClass('selected')
		$('li > ul.submenu').css('display','none');
	});
});