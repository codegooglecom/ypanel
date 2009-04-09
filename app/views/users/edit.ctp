<?php
	/**
	 *      Página: edit.ctp
	 *      Tipo: View
	 *      Versión: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Vista de usuarios para editar.
	 */
	$FDL = chr(10);
	$TAB = chr(9);
	
	//e($html->link('Nuevo', "/users/add").' ');
	//e('<br>');
	//e($html->link('Lista', "/users").' ');
	
	
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
															$form->text('username', array('readonly'=>'true')).$FDL,
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
															$html->tag('div','Nivel de Acceso del Usuario.'),
															array('class'=>'quiet'),
															array()
														)
													)
												)
											).$FDL.
								$html->tableCells(array(
													array(
														array(
															$form->label(__('phoneNumber'.':',true)).$FDL,
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
															$form->label(__('email'.':',true)).$FDL,
															array('width'=>'160', 'class'=>'align-right')
														),
														array(
															$form->text('email').$FDL.
															$html->tag('div','(Aqui se enviara informacion confidencial al usuario. Por favor verificar que sea correcto.)'),
															array('class'=>'quiet'),
															array()
														)
													)
												)
											).$FDL.
								/*$html->tableCells(array(
										array(
											array(
												$html->link('Cambio de Nombre de usuario','/users/chlogin/'.$this->data['User']['id']). $FDL,
												array('colspan'=>'2')
											)
										)
									)
								).$FDL.
								$html->tableCells(array(
										array(
											array(
												$html->link('Cambio de contraseña','/users/chpass/'.$this->data['User']['id']). $FDL,
												array('colspan'=>'2')
											)
										)
									)
								).$FDL.*/
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
