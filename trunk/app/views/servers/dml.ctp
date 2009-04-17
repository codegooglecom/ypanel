<?php
	/**
	 *      Página: index.ctp
	 *      Tipo: View
	 *      Versión: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Vista de Servers.
	 */
	$FDL = chr(10).chr(9);
	
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
											$form->input('name', array('label'=>false)).$FDL,
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
											$form->input('domain', array('label'=>false)).$FDL,
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
											$form->input('user', array('label'=>false)).$FDL.
											$html->tag('div',__('userCpanelMsg',true),
											array('class'=>'quiet')),
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
											$form->input('pass', array('type'=>'password', 'label'=>false)).$FDL.
											$html->tag('div','Contraseña para acceder al CPanel del servidor.',
											array('class'=>'quiet')),
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
											$form->input('provider', array('label'=>false)).$FDL,
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
											$form->input('skin', array('label'=>false)).$FDL,
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
											$form->input('port', array('label'=>false)).$FDL.
											$html->tag('div','(Puerto por defecto 2082.)',
											array('class'=>'quiet')),
											array()
										)
									)
								)
							).$FDL.
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