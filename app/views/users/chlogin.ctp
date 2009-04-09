<?php
	/**
	 *      Página: chlogin.ctp
	 *      Tipo: View
	 *      Versión: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Cambio de Login de usuario.
	 */
	
	$FDL = chr(10);
	$TAB = chr(9);
	//print_r($this->params);
	$controlNombre = $this -> params['controller'];
	$modeloNombre = $this -> params['models']['0'];
	
	echo '<table><tr>'.$FDL;
	echo '<td id="tdLogin" height="55"><div>Usuario: '.$cU['User']['username'].'</div>'.$html->link('[Salir]', '/users/logout', array('alt'=>'Cerrar sesión', 'title'=>'Cerrar seción')).'</td></tr></table>';
	
	echo $form->create($modeloNombre, array('name'=>'form1', 'action'=>'/chlogin')). $FDL;
	echo $form->input('id', array('type'=>'hidden')). $FDL;
	echo $html->tag('div',
				$form->label('Contraseña actual').$FDL.
				$form->text('passwordactual', array('type'=>'password')). $FDL,
				array('class'=>'input text required')
		);
	echo $form->input('username', array('label'=>'Nombre de Usuario')). $FDL;
	echo '<br>';
	echo $form->button('Retornar', array('type'=>'button', 'onclick'=>'document.location ="'.$this->base.'/users/edit/'.$this->data['User']['id'].'";', 'alt'=>'Retornar', 'title'=>'Retornar'));
	echo $form->button('Guardar', array('type'=>'submit', 'alt'=>'Guardar', 'title'=>'Guardar registro'));
	echo $form->end(). $FDL;
	
?>