<?php
	/**
	 *      Página: index.ctp de Servidores
	 *      Tipo: vista
	 *      Versión: 2008-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Vista para mostrar los servidores existentes para editar.
	 */?>
<div id="text">
	<div class="span-24 last">
<?php
	
	e('<table id="myTable" class="tablesorter"><thead>');
	e($html->tableHeaders(array(__('item',true),__('server',true),__('provider',true), __('created',true), __('delete',true), __('domains',true))));
	e('</thead><tbody>'); 
			$cont = 1;
			foreach ($Servers as $Server):?>
			<tr>
				<td><?=$cont++;?></td>
				<td><?=$html->link($Server['Server']['name'], "/servers/edit/".$Server['Server']['id']);?></td>
				<td><?=$Server['Server']['provider'];?></td>
				<td><?=$Server['Server']['created'];?></td>
				<td align="center"><?=$html->link($html->image('cross.png'),'delete/'.$Server['Server']['id'], array('alt'=>'Eliminar', 'title'=>'Eliminar'), 'Do you want to delete this Server?', false);?></td>
				<td align="center"><?=$html->link(__('view',true), '/domains/index/'.$Server['Server']['id'].'/SER', array('alt'=>'Ver', 'title'=>'Ver Dominios'));?></td>
			</tr>
			<? endforeach;?>
			</tbody>
		</table>	
	</div>
</div>