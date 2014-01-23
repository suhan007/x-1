$(function(){
	$('li.active-page').siblings().removeClass('not-active-page');
	$('li.active-page').parent().css('display','block');
	$('li.active-page').parent().parent('li').css('background','#333333').css('color','#ffffff');
	
	$('li.name').mouseenter(function(){
		$(this).addClass('selected');
		$('li.selected > ul.submenu').css('display','block');
		if($('li.active-page').parent().parent('li').mouseenter()) {}
		else $('li.active-page').parent().css('display','hide');
	});
	$('li.name').mouseleave(function(){
		$(this).removeClass('selected');
		$('li.active-page').parent().css('display','block');
		$('li.not-active-page').parent().css('display','none');
	}); 

});







