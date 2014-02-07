<?php

x::hook_register('head_begin', function() {
} );
x::hook_register('tail_begin', function() {
	if($_SERVER['PHP_SELF'] == '/index.php') {
		?>
		<style>
			#aside {
				display: none;
			}
			#container {
				border: 0 !important;
				width: 939px;
			}
		</style><?
	}
} );
