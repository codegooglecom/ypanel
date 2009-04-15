<?php
	/**
	 *      Página: chpass.ctp
	 *      Tipo: View
	 *      Versión: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Cambio de Contraseña de usuario.
	 */
	
	$FDL = chr(9).chr(10);
	$Username = (isset($this->data['User']['username']))?$this->data['User']['username']:$this->data['User']['user'];
	echo $form->create('User', array('name'=>'form1', 'action'=>'/chpass')). $FDL;
	echo $form->input('id', array('type'=>'hidden'));
	echo $html->tag('div',
			 		$html->tag('div',
								'<table border="0">'.$FDL.
								$html->tableCells(array(
													array(
														array(
															$form->label(__('userId',true).':').$FDL,
															array('width'=>'160', 'class'=>'align-right')
														),
														array(
															$form->text('user', array('readonly'=>'true', 'value'=>$Username)).$FDL,
															array()
														)
													)
												)
											).$FDL.
								$html->tableCells(array(
													array(
														array(
															$form->label(__('currentPassword',true).':').$FDL,
															array('width'=>'160', 'class'=>'align-right')
														),
														array(
															$form->input('currentpassword', array('type'=>'password', 'label'=>false)).$FDL,
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
															$form->input('passwd', array('type'=>'password', 'label'=>false)).$FDL,
															array()
														)
													)
												)
											).$FDL.
								$html->tableCells(array(
													array(
														array(
															$form->label(__('confirmPassword',true).':').$FDL,
															array('width'=>'160', 'class'=>'align-right')
														),
														array(
															$form->input('passwordcheck', array('type'=>'password', 'label'=>false)).$FDL,
															array()
														)
													)
												)
											).$FDL.
							$html->tableCells(array(
								array(
									array(
										$html->tag('button', $html->image('tick.png').__('save',true), array('type'=>'submit', 'class'=>'button positive', 'alt'=>'Guardar')).$FDL, 
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