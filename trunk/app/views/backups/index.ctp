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
				<td><a href="<?=$data['href']?>"><?=$Backup?></a></td>
			</tr>
			<? endforeach;?>
			</tbody>
		</table>	
	</div>
</div>