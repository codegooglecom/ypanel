<?php
	/**
	 *      Página: index.ctp
	 *      Tipo: View
	 *      Versión: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Vista de usuarios.
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
															$form->text('username').$FDL,
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
															$form->text('password', array('type'=>'password')).$FDL,
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
															$form->text('passwordcheck', array('type'=>'password')).$FDL.
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
															$form->label(__('client',true).':').$FDL,
															array('width'=>'160', 'class'=>'align-right')
														),
														array(
															$form->text('businessname').$FDL,
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
															$form->select('group_id', $Group).$FDL.
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
															$form->label(__('phoneNumber',true).':').$FDL,
															array('width'=>'160', 'class'=>'align-right')
														),
														array(
															$form->text('telephone').$FDL,
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
															$form->text('email').$FDL.
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
										$html->tag('button', $html->image('tick.png').__('save',true), array('type'=>'submit', 'class'=>'button positive', 'alt'=>'Guardar')). $FDL,
										array('colspan'=>'2', 'align'=>'right')
									)
								)
							)
						).$FDL.
		'</table>'.$FDL
	, array('class'=>'span-20'))
	, array('id'=>'text'));
	
	echo $form->input('prueba');
	//FORM FIN <div class="input text"><label for="UserPrueba">Prueba</label><input name="data[User][prueba]" type="text" value="" id="UserPrueba" /></div>
	echo $form->end(). $FDL;
?>
