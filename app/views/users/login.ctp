<?php
	$FDL = chr(10);
	$TAB = chr(9);
	
	if ($session->check('Message.flash')) {
		$session->flash();
	}
	if ($session->check('Message.auth')) {
		$session->flash('auth');
	}
    echo $form->create('User', array('action' => 'login'));
	
	echo $html->tag('div',
	 		$html->tag('div',
				'<table border="0">'.$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label('Nombre de usuario:').$FDL,
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
										$html->tag('button', 'Login', array('type'=>'submit', 'class'=>'button positive', 'alt'=>'Login')). $FDL,
										array('colspan'=>'2', 'align'=>'right')
									)
								)
							)
						).$FDL.
				'</table>'.$FDL
	, array('class'=>'span-20'))
	, array('id'=>'text'));
    echo $form->end();
?>