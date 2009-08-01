<?php
	/**
	 *      P�gina: index.ctp
	 *      Tipo: View
	 *      Versi�n: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripci�n: Vista de usuarios.
	 */
	$FDL = chr(10);
	$TAB = chr(9);
	
	//FORM
	echo $form->create('User', array('name'=>'form1')). $FDL;
	echo $form->input('id', array('type'=>'hidden')). $FDL;
	echo $form->input('user_id', array('type'=>'hidden')). $FDL;
	
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
															$form->input('username', array('label'=>false)).$FDL,
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
															$form->input('passwd', array('label'=>false)).$FDL,
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
															$form->input('passwordcheck', array('type'=>'password', 'label'=>false)).$FDL.
															$html->tag('div',__('passwordConfirmMsg',true),
															array('class'=>'quiet')),
															array()
														)
													)
												)
											).$FDL.
								$html->tableCells(array(
													array(
														array(
															$form->label(__('group',true).':').$FDL,
															array('width'=>'160', 'class'=>'align-right')
														),
														array(
															$form->input('group_id', array('options'=>$Group, 'label'=>false)).$FDL.
															$html->tag('div',__('groupMsg',true),
															array('class'=>'quiet')),
															array()
														)
													)
												)
											).$FDL.
								$html->tableCells(array(
													array(
														array(
															$form->label(__('client',true).':').$FDL,
															array('width'=>'160', 'class'=>'align-right')
														),
														array(
															$form->input('businessname', array('label'=>false)).$FDL,
															array()
														)
													)
												)
											).$FDL.
								$html->tableCells(array(
													array(
														array(
															$form->label(__('phoneNumber',true).':').$FDL,
															array('width'=>'160', 'class'=>'align-right')
														),
														array(
															$form->input('telephone', array('label'=>false)).$FDL,
															array()
														)
													)
												)
											).$FDL.
								$html->tableCells(array(
													array(
														array(
															$form->label(__('email',true).':').$FDL,
															array('width'=>'160', 'class'=>'align-right')
														),
														array(
															$form->input('email', array('label'=>false)).$FDL.
															$html->tag('div',__('emailMsg',true),
															array('class'=>'quiet')),
															array()
														)
													)
												)
											).$FDL.
								$html->tableCells(array(
													array(
														array(
															$form->label(__('services',true).':').$FDL,
															array('width'=>'160', 'class'=>'align-right')
														),
														array(
															$form->input('services', array(
																						'label'=>false, 
																						'options'=>array('D'=>__('domain', true),
																										'H'=>__('hosting', true),
																										'D+H'=>__('domain+hosting', true)), 
																						'empty'=>'Seleccione...')).$FDL,
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
	, array('class'=>'span-20'))
	, array('id'=>'text'));
	//FORM FIN
	echo $form->end(). $FDL;
?>
