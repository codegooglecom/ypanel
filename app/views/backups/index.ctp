<?php
	/**
	 *      Página: index.ctp de Backups
	 *      Tipo: vista
	 *      Versión: 2008-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Vista para mostrar los backups existentes.
	 */?>
<div id="text">
	<div class="span-24 last">
<?php
	
	e('<table id="myTable" class="tablesorter"><thead>');
	e($html->tableHeaders(array(__('item',true),
								__('backup',true)
								)
							)
						);
	e('</thead><tbody>'); 
			$cont = 1;
			foreach ($Backups as $Backup=>$data):?>
			<tr>
				<td><?=$cont++;?></td>
				<? if($data['type']=='link'):?>
				<td><a href="<?=$data['href'];?>"><?=$Backup;?></a></td>
				<td><?//=$html->link($Backup, '/backups/downloadbackup/'.$this->params['pass'][0].'/'.$data['href'],array('alt'=>'Backup{$cont}', 'title'=>'Backup{$cont}'));?></td>
				<? else:?>
				<td><?=$Backup?></td>
				<? endif;?>
			</tr>
			<? endforeach;?>
			</tbody>
		</table>	
	</div>
</div>