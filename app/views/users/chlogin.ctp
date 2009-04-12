<?php
	/**
	 *      Página: chlogin.ctp
	 *      Tipo: View
	 *      Versión: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Cambio de Login de usuario.
	 */
	
	$FDL = chr(9).chr(10);
	
	echo $form->create('User', array('name'=>'form1', 'action'=>'/chlogin')). $FDL;
	echo $form->input('id', array('type'=>'hidden')). $FDL;
	echo $html->tag('div',
			 		$html->tag('div',
								'<table border="0">'.$FDL.
								$html->tableCells(array(
													array(
														array(
															$form->label(__('currentPassword',true).':').$FDL,
															array('width'=>'160', 'class'=>'align-right')
														),
														array(
															$form->text('currentpassword', array('type'=>'password')).$FDL,
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
															$form->text('username').$FDL,
															array()
														)
													)
												)
											).$FDL.
								$html->tableCells(array(
								array(
									array(
										$html->tag('button', $html->image('tick.png').__('save',true), array('type'=>'submit', 'class'=>'button positive', 'alt'=>'Guardar')). 
										/*$html->tag('button', $html->image('cross.png').__('save',true), array('type'=>'button', 'class'=>'button positive', 'onclick'=>'document.location ="'.$this->base.'/users/edit/'.$this->data['User']['id'].'";', 'alt'=>'Retornar', 'title'=>'Retornar')).*/$FDL,
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