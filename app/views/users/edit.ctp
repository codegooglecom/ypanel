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

	//FORM
	
	echo $form->create('User', array('name'=>'form1')). $FDL;
	echo $form->input('id', array('type'=>'hidden')). $FDL;
	$UserName = (isset($this->data['User']['username']))?$this->data['User']['username']:$this->data['User']['user'];
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
															$form->input('user', array('value'=>$UserName,'readonly'=>'true', 'label'=>false)).$FDL,
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
															$form->label(__('group',true).':').$FDL,
															array('width'=>'160', 'class'=>'align-right')
														),
														array(
															$form->input('group_id', array('options'=>$Group, 'label'=>false)).$FDL.
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
															$form->input('telephone', array('label'=>false)).$FDL,
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
															$form->input('email', array('label'=>false)).$FDL.
															$html->tag('div','(Aqui se enviara informacion confidencial al usuario. Por favor verificar que sea correcto.)'),
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
	, array('class'=>'span-20'))
	, array('id'=>'text'));
	//FORM FIN 
	echo $form->end(). $FDL;
?>
