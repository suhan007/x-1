
<h1>카페 만들기</h1>
<?
	if ( ! login() ) return include login_first();
?>



<form action='?'>
<input type='hidden' name='module' value='multisite'>
<input type='hidden' name='action' value='create_submit'>


	도메인 : http://<input type='text' name='sub_domain'>.<?=etc::base_domain()?><br>
	홈페이지 제목 : <input type='text' name='title'><br>


<br>

<input type='submit' value='카페 만들기'>
</form>

