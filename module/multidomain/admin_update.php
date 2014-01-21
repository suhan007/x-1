<?
/** @file admin_multi_site_configuration.php
	@page ms_config MultiSite Configuration
		사이트를 여러개 지정할 경우, 각 도메인 별로 설정을 한다.
	@section ms_domain 도메인
		@note 도메인을 입력하고 저장하면 해당 도메인에 대한 설정이 저장된다.
		<ul>
			<li>도메인 입력 예: 'abc' 또는 'abc.com'
			<li>도메인에 지정된 단어 또는 문자열이 매치가 되면 해당 설정을 사용한다.
			<li>이 때 비교 순서는 @ref ms_priority "도메인 비교 순서"에 따라서 비교를 한다.
		</ul>
	@section ms_priority 도메인 비교 순서
	@note priority 는 HTTP 입력에 지정된 도메인을 비교 할 때 우선 순위를 결정하는 값이다.
		<ul>
			<li>기본적으로 우선순위 값은 10 이다.
		</ul>
		
		@ref ms_domain "도메인 지정 방법"
*/
module_css();
if ( empty($in['idx']) ) {
}
else {
	$cfg = multisite_config($in['idx']);
}
if ( empty($cfg['priority']) ) $cfg['priority'] = 10;
module_css();
?>
<?=form::begin( array('name'=>'config') )?>
<input type='hidden' name='idx' value="<?=$cfg['idx']?>">
<table>
	<tr>
		<td>Domain</td>
		<td>
			<?=form::text('domain', $cfg['domain'])?>
			<?
				echo form::select_number( array(
							'name' => 'priority',
							'title' => 'Matching Priority',
							'select' => $cfg['priority'],
							'from' => 0,
							'to' => 10,
							'order'=>'desc'
							)
						);
			?>
		</td>
	</tr>
	<tr>
		<td>Theme</td>
		<td>
			<?
				$dirs = file::getDirs(DIR_THEME);
				$option = array();
				foreach ( $dirs as $dir ) {
					if ( $dir == 'CVS' ) continue;
					$path = DIR_THEME . "/$dir/config.php";
					if ( file_exists($path) ) {
						$theme_config = array();
						include $path;
						$option[$dir] = "$theme_config[name] ($dir) $theme_config[desc]";
					}
					else {
						echo "<div class='error'>ERROR: $dir has no theme configuration file(config.php)</div>";
					}
					 
				}
				echo form::select(
					array(
						'name'=>'domain_theme',
						'title'=>'Select Theme ...',
						'select'=>$cfg['theme'],
						'option'=>$option
					)
				);
			?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td><input type='submit' value='UPDATE'><a href="<?=url_module('', 'admin_multisite')?>">LIST</a></td>
	</tr>
	
	<tr>
		<td>Site Title</td>
		<td>
			<input type='text' name="site_title" value="<?=$cfg['site_title']?>">
		</td>
	</tr>
	
	<tr>
		<td>Site Description</td>
		<td>
			<textarea name="site_description"><?=$cfg['site_description']?></textarea>
		</td>
	</tr>
	
	
	<tr>
		<td>Test Value</td>
		<td>
			<input type='text' name="test_value" value="<?=$cfg['test_value']?>">
		</td>
	</tr>
	
	
	
	<tr>
		<td>Register Widget</td>
		<td><?=widget_select(array(
											'type'=>'member_register',
											'name'=>'widget_member_register',
											'select'=>$cfg['widget_member_register'],
						)					
					)
				?>
		</td>
	</tr>
	
	<tr>
		<td>Resign Widget</td>
		<td>
				<?=widget_select(array(
											'type'=>'member_resign',
											'name'=>'widget_member_resign',
											'select'=>$cfg['widget_member_resign'],
						)					
					)
				?>
		</td>
	</tr>
	

	<tr>
		<td>ID and Password Find Widget</td>
		<td>
				<?=widget_select(array(
											'type'=>'member_find_id_password',
											'name'=>'member_find_id_password',
											'select'=>$cfg['member_find_id_password'],
						)					
					)
				?>
		</td>
	</tr>

	
	<tr>
		<td></td>
		<td>
			<input type='submit' value='UPDATE'>
			<a href="<?=url_module('', 'admin_multisite')?>">LIST</a>
		</td>
	</tr>
		
		
</table>
<?=form::end()?>