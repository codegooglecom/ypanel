<?php
	/**
	 *      P�gina: add.ctp
	 *      Tipo: View
	 *      Versi�n: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripci�n: Vista de Domains.
	 */
	$FDL = chr(10).chr(9);

	echo $form->create('Domain', array('name'=>'form1')). $FDL;
	//INPUT's
	echo $form->input('id', array('type'=>'hidden')). $FDL;
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
											$form->input('Domain.name', array('label'=>false)).$FDL.
											$html->tag('div','Ej. yaao.com.ve',
											array('class'=>'quiet')),
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
											$form->input('Domain.pathdirectory', array('label'=>false)).$FDL.
											$html->tag('div','Ruta del Directorio en el Servidor.',
											array('class'=>'quiet')),
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
											$form->input('Domain.server_id', array('options'=>$Servers, 'label'=>false, 'empty'=>true)).$FDL.
											$html->tag('div','Servidor donde se encuentra el dominio.',
											array('class'=>'quiet')),
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
											$form->input('Domain.user_id', array('options'=>$Users, 'label'=>false, 'empty'=>true)).$FDL.
											$html->tag('div','Usuario administrador del dominio.',
											array('class'=>'quiet')),
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label(__('emailsCount',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->input('emailscount', array('label'=>false)).$FDL,
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label(__('emailsQuote',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->input('emailsquote', array('label'=>false)).$FDL.
											$html->tag('div','Mbytes.',
											array('class'=>'quiet')),
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label(__('ftpCount',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->input('ftpcount', array('label'=>false)).$FDL,
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label(__('ftpQuote',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->input('ftpquote', array('label'=>false)).$FDL.
											$html->tag('div','Mbytes.',
											array('class'=>'quiet')),
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label(__('expirationdate',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->input('expirationdate', array('label'=>false, 'dateFormat'=>'DMY', 'type'=>'date')).$FDL,
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