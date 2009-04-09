<?php
	/**
	 *      Página: index.ctp
	 *      Tipo: View
	 *      Versión: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Vista de Domains.
	 */
	$FDL = chr(10);
	$TAB = chr(9);

	echo $form->create('Domain', array('name'=>'form1')). $FDL;
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
											$form->text('Domain.name').$FDL.
											$html->tag('div','Ej. yaao.com.ve'),
											array('class'=>'quiet'),
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label(__('addonDomain',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->text('Domain.pathdirectory').$FDL.
											$html->tag('div','Ruta del Directorio en el Servidor.'),
											array('class'=>'quiet'),
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label(__('server',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->select('Domain.server_id', $Servers).$FDL.
											$html->tag('div','Servidor donde se encuentra el dominio.'),
											array('class'=>'quiet'),
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label(__('user',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->select('Domain.user_id', $Users).$FDL.
											$html->tag('div','Usuario administrador.'),
											array('class'=>'quiet'),
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
								array(
									array(
										$html->tag('button', $html->image('tick.png').__('save',true), array('type'=>'submit', 'class'=>'button positive', 'alt'=>'Guardar')). $FDL,
										array('colspan'=>'2', 'align'=>'right')
									)
								)
							)
						).$FDL.
		'</table>'.$FDL
	, array('class'=>'span-24 last'))
	, array('id'=>'text'));
	//END FORM
	echo $form->end(). $FDL;

?>