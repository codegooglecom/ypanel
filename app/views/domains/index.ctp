<?php
	/**
	 *      Página: find.ctp de dominios
	 *      Tipo: vista
	 *      Versión: 2008-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Vista para mostrar las dominios existentes en index.ctp.
	 */
	?>
<div id="text">
	<div class="span-24 last">
<?php
	
	//__("serverName");
	e('<table id="myTable" class="tablesorter"><thead>');
	e($html->tableHeaders(array(__("item",true),__("domain",true),__("server",true), __("user",true), __("delete",true), __("email",true), __("ftp",true))));
	e('</thead><tbody>');
			$cont = 1;
			foreach ($Domains as $Domain):?>
			<tr>
				<td><?=$cont++;?></td>
				<td><?=$html->link($Domain['Domain']['name'], "/domains/edit/".$Domain['Domain']['id']);?></td>
				<td><?=$Domain['Server']['name'];?></td>
				<td><?=$Domain['User']['username'];?></td>
				<td align="center"><?=$html->link($html->image('cross.png'),'delete/'.$Domain['Server']['id'], array('alt'=>'Eliminar', 'title'=>'Eliminar'), false, false);?></td>
				<td align="center"><?=$html->link(__("new",true), '/emailaccounts/add/'.$Domain['Domain']['id'], array('alt'=>'Nuevo', 'title'=>'Nuevo Correo Electrónico')).' '.$html->link(__("view",true), '/emailaccounts/index/'.$Domain['Domain']['id'], array('alt'=>'Ver', 'title'=>'Ver Correos Electrónicos'));?></td>
				<td align="center"><?=$html->link(__("new",true), '/ftpaccounts/add/'.$Domain['Domain']['id'], array('alt'=>'Nuevo', 'title'=>'Nuevo Cuenta FTP')).' '.$html->link(__("view",true), '/ftpaccounts/index/'.$Domain['Domain']['id'], array('alt'=>'Ver', 'title'=>'Ver Cuentas FTP\'s'));?></td>
			</tr>
			<? endforeach;?>
			</tbody>
		</table>
	</div>
</div>