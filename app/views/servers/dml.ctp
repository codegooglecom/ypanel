<?php
	/**
	 *      Página: index.ctp
	 *      Tipo: View
	 *      Versión: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Vista de Servers.
	 */
	$FDL = chr(10);
	$TAB = chr(9);
	//
	//e($html->link('Nuevo', "/servers/add").' ');
	//e('<br>');
	//e($html->link('Lista', "/servers"));
	
	
	//FORM
	echo $form->create('Server', array('name'=>'form1')). $FDL;
	//INPUT's
	echo $form->input('id', array('type'=>'hidden')). $FDL;
	$form->input('user_id', array('type'=>'hidden')). $FDL;
	echo $html->tag('div',
	 		$html->tag('div',
				'<table border="0">'.$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label(__('name',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->text('name').$FDL,
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label(__('domain',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->text('domain').$FDL,
											array()
										)
									)
								)
							).$FDL.
			$html->tableCells(array(
									array(
										array(
											$form->label(__('userId',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->text('user').$FDL.
											$html->tag('div',__('userCpanelMsg',true)),
											array('class'=>'quiet'),
											array()
										)
									)
								)
							).$FDL.
			$html->tableCells(array(
									array(
										array(
											$form->label(__('password',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->text('pass', array('type'=>'password')).$FDL.
											$html->tag('div','Contraseña para acceder al CPanel del servidor.'),
											array('class'=>'quiet'),
											array()
										)
									)
								)
							).$FDL.
			$html->tableCells(array(
									array(
										array(
											$form->label(__('provider',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->text('provider').$FDL,
											array()
										)
									)
								)
							).$FDL.
			$html->tableCells(array(
									array(
										array(
											$form->label(__('cpanelSkin',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->text('skin').$FDL,
											array()
										)
									)
								)
							).$FDL.
			$html->tableCells(array(
									array(
										array(
											$form->label(__('port',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->text('port').$FDL.
											$html->tag('div','(Puerto por defecto 2082.)'),
											array('class'=>'quiet'),
											array()
										)
									)
								)
							).$FDL.
			/*$html->tableCells(array(
									array(
										array(
											$form->label(__('domains',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->textarea('domains', array('rows'=>'3')).$FDL.
											$html->tag('div','si son mas de un dominio separar por coma ej. ejemplodo1.com, ejemplodom2.com'),
											array('class'=>'quiet')
										)
									)
								)
							).$FDL.*/
		$html->tableCells(array(
								array(
									array(
										$html->tag('button', $html->image('tick.png').__('save',true), array('type'=>'submit', 'class'=>'button positive', 'alt'=>__('save',true))). $FDL,
										array('colspan'=>'2', 'align'=>'right')
									)
								)
							)
						).$FDL.
		'</table>'.$FDL
	, array('class'=>'span-20'))
	, array('id'=>'text'));
	//END FORM
	echo $form->end(). $FDL;
?>