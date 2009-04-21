<?php
	/**
	 *      Página: add.ctp
	 *      Tipo: View
	 *      Versión: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Vista de EmailAccounts.
	 */
	$FDL = chr(10).chr(9);
	
	//FORM
	echo $form->create('Backup', array('name'=>'form1', 'action'=>"/add/{$this->params['pass']['0']}")). $FDL;
	//e($form->input('Domain.id', array('type'=>'hidden', 'value'=>$Domain['Domain']['id'])).$FDL);

	
	echo $html->tag('div',
		 		$html->tag('div',
					'<table border="0">'.$FDL.
					$html->tableCells(array(
									array(
										array(
											$form->label(__('email',true).':').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->input('email', array('label'=>false)).$FDL.
											$html->tag('div','Email para la notificación.',
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