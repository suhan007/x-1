	
<h1>Create Your Site</h1>
<?
	if ( ! login() ) return include login_first();
?>

<div class='create-site'>
	<form action='?'>
		<input type='hidden' name='module' value='multisite'>
		<input type='hidden' name='action' value='create_submit'>


			Domain : http://<input type='text' name='sub_domain'>.<?=etc::base_domain()?><br>
			Site Title : <input type='text' name='title'><br>


		<br>

		<input type='submit' value='Create Site'>
	</form>
</div>