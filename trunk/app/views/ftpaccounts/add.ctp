<?php
	/**
	 *      P�gina: add.ctp
	 *      Tipo: View
	 *      Versi�n: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripci�n: Vista de EmailAccounts.
	 */
	$FDL = chr(10);
	$TAB = chr(9);
	
	//FORM
	echo $form->create('Ftpaccount', array('name'=>'form1')). $FDL;
	e($form->input('Domain.id', array('type'=>'hidden')));
	echo $html->tag('div',
	 		$html->tag('div',
				'<table border="0">'.$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label('Dominio:').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->text('domain', array('readonly'=>'true')).$FDL,
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label('Nombre:').$FDL,
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
											$form->label('Contrase�a:').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->text('password', array('type'=>'password')).$FDL,
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label('Cuota:').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->text('quote', array('value'=>'100')).$form->label('Mbytes').$FDL,
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label('Directorio:').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->text('directory').$FDL.
											$html->tag('div',$this->data['Ftpaccount']['pathdirectory'],
											array('class'=>'quiet')),
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
								array(
									array(
										$html->tag('button', $html->image('tick.png').'Guardar', array('type'=>'submit', 'class'=>'button positive', 'alt'=>'Guardar')). $FDL,
										array('colspan'=>'2', 'align'=>'right')
									)
								)
							)
						).$FDL.
			'</table>'.$FDL
	, array('class'=>'span-20'))
	, array('id'=>'text'));
	echo $form->end(). $FDL;
?>