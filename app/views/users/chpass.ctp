<?php
	/**
	 *      P�gina: chpass.ctp
	 *      Tipo: View
	 *      Versi�n: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripci�n: Cambio de Contrase�a de usuario.
	 */
	
	$FDL = chr(10);
	$TAB = chr(9);
	
	$controlNombre = $this -> params['controller'];
	$modeloNombre = $this -> params['models']['0'];
	
	echo '<table><tr>'.$FDL;
	echo '<td id="tdLogin" height="55"><div>Usuario: '.$cU['User']['username'].'</div>'.$html->link('[Salir]', '/users/logout', array('alt'=>'Cerrar sesi�n', 'title'=>'Cerrar seci�n')).'</td></tr></table>';
	
	echo $form->create('User', array('name'=>'form1')). $FDL;
	echo $html->tag('div',
				$form->label('Contrase�a actual').$FDL.
				$form->text('passwordactual', array('type'=>'password')). $FDL,
				array('class'=>'input text required')
		);
	echo $form->input('password',array('label'=>'Nueva Contrase�a', 'value'=>'')). $FDL;
	echo $form->input('passwordcheck',array('label'=>'Verificaci�n de la Contrase�a', 'type'=>'password', 'value'=>'')). $FDL;
	echo '<br>';
	echo $form->button('Retornar', array('type'=>'button', 'onclick'=>'document.location ="'.$this->base.'/users/edit/'.$this->data['User']['id'].'";', 'alt'=>'Retornar', 'title'=>'Retornar'));
	echo $form->button('Guardar', array('type'=>'submit', 'alt'=>'Guardar', 'title'=>'Guardar registro'));
	echo $form->end(). $FDL;
	
?>