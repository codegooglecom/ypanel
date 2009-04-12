<div id="text">
	<div class="span-24 last">
<?php
	//e($html->link('Nuevo', "/users/add").' ');

e('<table id="myTable" class="tablesorter"><thead>');
	e($html->tableHeaders(array(__('id',true),__('user',true),__('client',true), __('group',true), __('created',true), __('delete',true), __('domains',true))));
	?>
			</thead>
			<tbody>
			<? foreach ($Users as $User):?>
			<tr>
				<td><?=$User['User']['id'];?></td>
				<td><?=$html->link($User['User']['username'], "/users/edit/".$User['User']['id']);?></td>
				<td><?=$User['User']['businessname'];?></td>
				<td><?=$User['Group']['name'];?></td>
				<td><?=$User['User']['created'];?></td>
				<td align="center"><?=$html->link($html->image('cross.png'),'delete/'.$User['User']['id'], array('alt'=>'Eliminar', 'title'=>'Eliminar'), 'Do you want to delete this User?', false);?></td>
				<td align="center"><?=$html->link(__('view',true), '/domains/index/'.$User['User']['id'].'/USU', array('alt'=>'Ver', 'title'=>'Ver Dominios'));?></td>
			</tr>
			<? endforeach;?>
			</tbody>
		</table>	
	</div>
</div>
