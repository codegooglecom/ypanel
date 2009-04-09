<?php
	/**
	 *      Página: chpass.ctp
	 *      Tipo: View
	 *      Versión: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Cambio de Contraseña de usuario.
	 */
	
	$FDL = chr(10);
	$TAB = chr(9);
	
	$controlNombre = $this -> params['controller'];
	$modeloNombre = $this -> params['models']['0'];
	
	echo '<table><tr>'.$FDL;
	echo '<td id="tdLogin" height="55"><div>Usuario: '.$cU['User']['username'].'</div>'.$html->link('[Salir]', '/users/logout', array('alt'=>'Cerrar sesión', 'title'=>'Cerrar seción')).'</td></tr></table>';
	
	echo $form->create('User', array('name'=>'form1')). $FDL;
	echo $html->tag('div',
				$form->label('Contraseña actual').$FDL.
				$form->text('passwordactual', array('type'=>'password')). $FDL,
				array('class'=>'input text required')
		);
	echo $form->input('password',array('label'=>'Nueva Contraseña', 'value'=>'')). $FDL;
	echo $form->input('passwordcheck',array('label'=>'Verificación de la Contraseña', 'type'=>'password', 'value'=>'')). $FDL;
	echo '<br>';
	echo $form->button('Retornar', array('type'=>'button', 'onclick'=>'document.location ="'.$this->base.'/users/edit/'.$this->data['User']['id'].'";', 'alt'=>'Retornar', 'title'=>'Retornar'));
	echo $form->button('Guardar', array('type'=>'submit', 'alt'=>'Guardar', 'title'=>'Guardar registro'));
	echo $form->end(). $FDL;
	
?>