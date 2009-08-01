<?php
	/**
	 *      P�gina: index.ctp de Servidores
	 *      Tipo: vista
	 *      Versi�n: 2008-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripci�n: Vista para mostrar los servidores existentes para editar.
	 */?>
<div id="text">
	<div class="span-24 last">
<?php
	
	e('<table id="myTable" class="tablesorter"><thead>');
	e($html->tableHeaders(array(__('item',true),
								'',//Semaforo
								__('server',true),
								__('provider',true),
								__('created',true), 
								__('delete',true), 
								__('domains',true),
								__('backups',true)
								)
							)
						);
	e('</thead><tbody>'); 
			$cont = 1;
			foreach ($Servers as $Server):
				if($Server['Server']['expirationdate']!='0000-00-00 00:00:00' && !empty($Server['Server']['expirationdate'])){
					$dias = floor((strtotime($Server['Server']['expirationdate']) - time()) / (86400));
					if( $dias <= 15 ){
						$result = 'rojo.gif';
					}
					elseif($dias > 15 && $dias <= 30){
						$result = 'amarillo.gif';
					}
					else{
						$result = 'verde.gif';
					}
					//e($dias);
				}
				else{
					$result = 'gris.gif';
				}
				$eDate = date('d/m/Y', strtotime($Server['Server']['expirationdate']));
				if($cU['User']['group_id']==1){
					$semaforo = $html->image($result, array('alt'=>$eDate, 'title'=>$eDate)).' ';
				}
				else{
					$semaforo = '';
				}
			
			
			?>
			<tr>
				<td><?=$cont++;?></td>
				<td><?=$semaforo;?></td>
				<td>
					<?=$html->link($Server['Server']['name'], "/servers/edit/".$Server['Server']['id']).' '.
						$html->link($html->image('go.gif'), "http://".$Server['Server']['dns'].':'.$Server['Server']['port'].'/login?user='.$Server['Server']['user'].'&pass='.$Server['Server']['pass'], array('target'=>'_blank', 'alt'=>$Server['Server']['dns'].' cPanel', 'title'=>$Server['Server']['dns'].' cPanel'), null, null, false);
					?>
				</td>
				<td><?=$Server['Server']['provider'];?></td>
				<td><?=$Server['Server']['created'];?></td>
				<td align="center"><?=$html->link($html->image('cross.png'),'delete/'.$Server['Server']['id'], array('alt'=>'Eliminar', 'title'=>'Eliminar'), 'Do you want to delete this Server?', false);?></td>
				<td align="center"><?=$html->link(__('view',true), '/domains/index/'.$Server['Server']['id'].'/SER', array('alt'=>'Ver', 'title'=>'Ver Dominios'));?></td>
				<td align="center"><?=$html->link(__('new',true), '/backups/add',array('alt'=>'Nuevo', 'title'=>'nuevo Backup')).' '.
				 						$html->link(__('view',true), "/backups/index/{$Server['Server']['id']}",array('alt'=>'Ver', 'title'=>'Ver Backup'));?></td>
			</tr>
			<? endforeach;?>
			</tbody>
		</table>	
	</div>
</div>