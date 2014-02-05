$(function() {

});

function callback_create_board( board_id, subject ) {
	$(".board_list").append("<tr>" + 
							"<td>"+board_id+"</td>"+
							"<td>" + subject + "</td>" + 
							"<td>0</td>"+
							"<td><a href='?module=multisite&action=config_forum&mode=forum_setting&bo_table="+board_id+"'>Setting</a></td>" +
							"</tr>");
	$(".no_of_board").before("<div class='message'>"+board_id+"("+subject+") has been created.</div>");
}