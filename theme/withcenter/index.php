<div class='layout'>
	<table class='main-content' cellpadding=0 cellspacing=0 width='100%' border=0>
		<tr valign='top'>
			<td class='left' width='210'><?=outlogin('withcenter')?></td>
			<td width='10'></td>
			<td class='content'>
				<?php
					if ( $in['page'] ) include x::theme( $in['page'] );
				?>
			</td>
		</tr>
	</table>
</div>
