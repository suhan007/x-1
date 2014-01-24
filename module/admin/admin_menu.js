$(function(){
	
	$('li.active-page').parent().css('display','block');
	$('li.active-page').parent().parent('li').css('color','#ffffff').css('background','#333333');


	$('li.name').mouseenter(function(){
		$(this).addClass('selected');
		$('li.active-page').parent().css('display','none');
		$('li.selected > ul.submenu').css('display','block');

	});
	$('li.name').mouseleave(function(){
		$(this).removeClass('selected');
		$('li.not-active-page').parent().css('display','none');
		$('li.active-page').parent().css('display','block');
	}); 

});







