<?php
	/**
	 *      Página: index.ctp de FTPAccounts
	 *      Tipo: vista
	 *      Versión: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Vista para mostrar los FTP Accounts.
	 *      
	 *  
	 */
	//pr($this->params);
	$param=(isset($this->params['pass']['0']))?$this->params['pass']['0']:'';
	$cont = 1;
	$Domain = $Ftps['Domain'];
	?>
<div id="text">
	<div class="span-24 last">
<?php
	e('<table id="myTable" class="tablesorter"><thead>');
	e($html->tableHeaders(array('Item','Cuenta', 'Directorio', 'Espacio', 'Cuota', 'Eliminar')));
	e('</thead><tbody>');
			
			foreach ($Ftps as $address => $data):
				if($cU['User']['group_id']==1||($cU['User']['group_id']==2&&(strpos(substr($address, 0, strpos($address, '@')), $Domain)!==false))):
					if($address!='Domain'):
						$addr = ($cU['User']['group_id']==1)?$address:substr($address, 0, strpos($address, '@')+1).$Domain
			?>
			<tr>
				<td><?=$cont++;?></td>
				<td><?=$html->link($addr, "/ftpaccounts/edit/{$param}/{$address}/{$data['quota']}");?></td>
				<td width="280"><?=$data['directory'];?></td>
				<td><?=($data['usage']!='None')?$data['usage']:'0 Bytes';?></td>
				<td><?=$data['quota'];?></td>
				<td align="center"><?=$html->link($html->image('cross.png'),"delete/{$address}/{$param}", array('alt'=>'Eliminar', 'title'=>'Eliminar'), false, false);?></td>
			</tr>
			<? 		endif;
				endif;
			endforeach;?>
			</tbody>
		</table>	
	</div>
</div>