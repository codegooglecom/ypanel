<?php
	/**
	 *      Pï¿½gina: find.ctp de dominios
	 *      Tipo: vista
	 *      Versiï¿½n: 2008-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripciï¿½n: Vista para mostrar las dominios existentes en index.ctp.
	 */
	?>

	
	
<div id="text">
	<div class="span-24 last">
<?php
	
	//__("serverName");
	e('<table id="myTable" class="tablesorter"><thead>');
	if($cU['User']['group_id']==1){//Usuario administrador
		$header = array(
				__('Exp',true),//Semaforo
				__("domain",true),
				
				//__("user",true), 
				//__("",true), 
				//__("",true),
				__("server",true),
				__("",true), 
			);
	}
	else{//cuando es un usuario normal
		$header = array(
				'',//Semaforo
				__("domain",true),
				//__("user",true),
				//__("",true),
				//__("",true),
				__("server",true),
			);
	}
	
	e($html->tableHeaders($header));
	e('</thead><tbody>');
			
			foreach ($Domains as $Domain):
				if($Domain['Domain']['expirationdate']!='0000-00-00 00:00:00' && !empty($Domain['Domain']['expirationdate'])){
					$eDate = date('d/m/Y', strtotime($Domain['Domain']['expirationdate']));
					$eDate2 = date('d/M/Y', strtotime($Domain['Domain']['expirationdate']));
					$dias = floor((strtotime($Domain['Domain']['expirationdate']) - time()) / (86400));
					if( $dias < 0 ){
						//$dias = abs($dias);
						$d = dmy($dias);
						$result = "<a id='daysDivR' href='#' title='Expira:<br />{$eDate2}<br />{$eDate}<br />{$d}'>{$dias}</a>";
					}
					elseif($dias >= 0 && $dias <=5){
						//$dias = abs($dias);
						$d = dmy($dias);
						$result = "<a id='daysDivO' href='#' title='Expira:<br />{$eDate2}<br />{$eDate}<br />{$d}'>{$dias}</a>";
					}
					elseif($dias > 5 && $dias <= 30){
						//$dias = abs($dias);
						$d = dmy($dias);
						$result = "<a id='daysDivY' href='#' title='Expira:<br />{$eDate2}<br />{$eDate}<br />{$d}'>{$dias}</a>";
					}
					else{
						//$dias = abs($dias);
						$d = dmy($dias);
						$result = "<a id='daysDivG' href='#' title='Expira:<br />{$eDate2}<br />{$eDate}<br />{$d}'>{$dias}</a>";
						//$result = 'verde.gif';
					}
					
					//e($dias);
				}
				else{
					$eDate = '--/--/----';
					$result = 'gris.gif';
				}
				//$eDate = date('d/m/Y', strtotime($Domain['Domain']['expirationdate']));
				if($cU['User']['group_id']==1){
					$semaforo = $result;//$html->image($result, array('alt'=>$eDate, 'title'=>$eDate)).' ';
					$cpanel = ' '.$html->tag('span',$html->link('cPanel', 'javascript:void(0);', array('alt'=>'cPanel', 'title'=>'Ir a cPanel de '.$Domain['Server']['dns'], 'onclick'=>"http://".$Domain['Server']['dns'].':'.$Domain['Server']['port'].'/login?user='.$Domain['Server']['user'].'&pass='.$Domain['Server']['pass'])), array('id'=>'cPanelDiv'));
					//$cpanel = ' '.$html->link($html->image('go.gif'), "http://".$Domain['Server']['dns'].':'.$Domain['Server']['port'].'/login?user='.$Domain['Server']['user'].'&pass='.$Domain['Server']['pass'], array('target'=>'_blank', 'alt'=>$Domain['Server']['dns'].' cPanel', 'title'=>$Domain['Server']['dns'].' cPanel'), null, null, false);
				}
				else{
					$semaforo = '';
					$cpanel = '';
				}
			?>	
			<tr>
				<td><?=$semaforo;?></td>
				<td>
					<div id="domainDiv">
					<?=$html->link(str_pad($Domain['Domain']['name'],' ', 25), "/domains/edit/".$Domain['Domain']['id'], array('alt'=>__('edit', true), 'title'=>__('edit', true))).' '.
						$html->link($html->image('external.png'), "http://www.".$Domain['Domain']['name'], array('target'=>'_blank', 'alt'=>'ir a http://www.'.$Domain['Domain']['name'], 'title'=>'ir a http://www.'.$Domain['Domain']['name']), null, null, false);?>
					</div>
					<div  id="emailFTPDiv">
						<?=$html->link(__("email",true), '/emailaccounts/index/'.$Domain['Domain']['id'], array('alt'=>'Ver', 'title'=>'Ver Correos Electr&oacute;nicos'));?>
					</div>	
					<div  id="emailFTPDiv">
						<?=$html->link(__("FTP",true), '/ftpaccounts/index/'.$Domain['Domain']['id'], array('alt'=>'Ver', 'title'=>'Ver Cuentas FTP\'s'));?>
					</span>
				</td>
				<!--<td><?//=$Domain['User']['username'];?></td>
				<td align="center">
					<?//=$html->link(__("new",true), '/emailaccounts/add/'.$Domain['Domain']['id'], array('alt'=>'Nuevo', 'title'=>'Nuevo Correo Electrï¿½nico')).' '.
						//$html->link(__("email",true), '/emailaccounts/index/'.$Domain['Domain']['id'], array('alt'=>'Ver', 'title'=>'Ver Correos Electr&oacute;nicos'));?>
				</td>
				<td align="center">
					<?//=$html->link(__("new",true), '/ftpaccounts/add/'.$Domain['Domain']['id'], array('alt'=>'Nuevo', 'title'=>'Nuevo Cuenta FTP')).' '.
					//$html->link(__("FTP",true), '/ftpaccounts/index/'.$Domain['Domain']['id'], array('alt'=>'Ver', 'title'=>'Ver Cuentas FTP\'s'));?>
				</td>-->
				<td><?=$Domain['Server']['name'].$cpanel;?></td>
				<?php if($cU['User']['group_id']==1):?>
					<td align="center"><?=$html->link($html->image('cross.png'),'delete/'.$Domain['Server']['id'], array('alt'=>'Eliminar', 'title'=>'Eliminar'), 'Do you want to delete this Domain?', false);?></td>
				<?php endif;?>
			</tr>
			<? endforeach;?>
			</tbody>
		</table>
	</div>
</div>
<?php
	function dmy($dias){
		$result = $dias.' dia(s)';
		if(abs($dias) >=30){
			$result = floor($dias / 30) . ' mes(es)';
		}
		if(abs($dias) >=365){
			$result = floor($dias / 365) . ' año(s)';
		}
		
		return $result;
	}
?>