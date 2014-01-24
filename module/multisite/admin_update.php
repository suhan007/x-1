<?php

?>
<div class='create-site'>
<form action='?'>
	<input type='hidden' name='module' action='multisite'>
	<input type='hidden' name='action' action='admin_update_submit'>
	<input type='hidden' name='idx' action='<?=$_GET[idx]?>'>
	<?php
		$domain_update_value = ms::update_domain("$_GET[idx]");
		$domainexplode = explode(".",$domain_update_value['domain']);
	?>
	<div>Domain: http://<input type='text' name='sub_domain' value='<?=$domainexplode[0]?>'>.<?=etc::base_domain()?></div>
	<div>Site Title: <input type='text' name='title'></div>
	<input type='submit' value='Update Site'>
</form>
</div>
 