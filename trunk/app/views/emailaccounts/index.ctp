<?php
	/**
	 *      Página: index.ctp de EmailAccounts
	 *      Tipo: vista
	 *      Versión: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Vista para mostrar los EmailAccounts .
	 *      
	 *  
	 */
	//pr($this->params);
	$param=(isset($this->params['pass']['0']))?$this->params['pass']['0']:'';
	
	?>
<div id="text">
	<div class="span-24 last">
<?php
	e('<table id="myTable" class="tablesorter"><thead>');
	e($html->tableHeaders(array('Item','Usuario', 'Espacio', 'Cuota', 'Eliminar')));
	e('</thead><tbody>'); 
			$cont = 1;
			foreach ($Emails as $address => $data):
				if(strpos ($address, '@'.$Emails['Domain'])!==false):
			?>
			<tr>
				<td><?=$cont++;?></td>
				<td><?=$html->link($address, "/emailaccounts/edit/{$param}/{$address}/{$data['quota']}");?></td>
				<td><?=($data['usage']!='None')?$data['usage']:'0 Bytes';?></td>
				<td><?=$data['quota'];?></td>
				<td align="center"><?=$html->link($html->image('cross.png'),"delete/{$address}/{$param}", array('alt'=>'Eliminar', 'title'=>'Eliminar'), 'Do you want to delete this Email Account?', false);?></td>
			</tr>
			<? 	endif;
			endforeach;?>
			</tbody>
		</table>	
	</div>
</div>