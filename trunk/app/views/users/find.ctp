<?php
	$controlNombre = $this -> params['controller'];
	$modeloNombre = ucfirst(substr($controlNombre, 0, (strlen($controlNombre) - 1)));

?>
<table>
	<tr>
		<th>id</th>
		<th>Usuario ID</th>
		<th>Nombre</th>
		<th>Grupo</th>
		<th>Creado</th>
	</tr>
	<? foreach ($Users as $usuario):?>
	<tr>
		<td><?=$usuario['User']['id'];?></td>
		<td><?=$html->link($usuario['User']['username'], "/users/edit/".$usuario['User']['id']);?></td>
		<td><?=$usuario['User']['businessname'];?></td>
		<td><?=$usuario['Group']['name'];?></td>
		<td><?=$usuario['User']['created'];?></td>
	</tr>
	<? endforeach;?>
</table>	
	
	
