<?php
	/**
	 *      Página: edit.ctp
	 *      Tipo: View
	 *      Versión: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Vista de para editar cuentas de FTP.
	 */
	$FDL = chr(10);
	$TAB = chr(9);
	//pr($this->data);
	//FORM 
	$url = '/edit';
	foreach ($this->params['pass'] as $variable) {
		$url .= '/'.$variable;
	}
	
	echo $form->create('Ftpaccount', array('name'=>'form1', 'id'=>'FtpaccountEditForm', 'action'=>$url)). $FDL;
	e($form->input('Domain.id', array('type'=>'hidden')).$FDL);
	e($form->input('login', array('type'=>'hidden')).$FDL);
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
											$form->text('name', array('readonly'=>'true')).$FDL,
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label('Contraseña:').$FDL,
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
											$form->text('quote').$form->label('Mbytes').$FDL,
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