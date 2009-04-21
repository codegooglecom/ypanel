<?php
	/**
	 *      Página: add.ctp
	 *      Tipo: View
	 *      Versión: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripción: Vista de FTP Accounts.
	 */
	$FDL = chr(9).chr(10);
	
	if($Domain['Domain']['ftpcount']<=$AccCheck['count']){
		e($html->tag('div','Cantidad de cuentas FTP excedida',array('class'=>'error')).$FDL);
	}
	elseif($Domain['Domain']['ftpcount']*$Domain['Domain']['ftpquote']<=$AccCheck['quote']){
		e($html->tag('div','Cuota de cuentas FTP excedida',array('class'=>'error')).$FDL);
	}
	else{
		//FORM
		echo $form->create('Ftpaccount', array('name'=>'form1','action'=>"/add/{$this->params['pass']['0']}")). $FDL;
		e($form->input('Domain.id', array('type'=>'hidden')));
		e($form->input('Domain.ftpquote', array('type'=>'hidden', 'value'=>$Domain['Domain']['ftpquote'])).$FDL);
		echo $html->tag('div',
	 		$html->tag('div',
				'<table border="0">'.$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label('Dominio:').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->input('domain', array('readonly'=>'true', 'label'=>false)).$FDL,
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label('Nombre:').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->input('name', array('label'=>false)).$FDL,
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
											$form->input('passwd', array('type'=>'password','label'=>false)).$FDL,
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label('Cuota:').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->input('quote', array('label'=>false)).
											$html->tag('div','Mbytes',
											array('class'=>'quiet')),
											array()
										)
									)
								)
							).$FDL.
				$html->tableCells(array(
									array(
										array(
											$form->label('Directorio:').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->input('directory',array('label'=>false)).$FDL.
											$html->tag('div',$this->data['Ftpaccount']['pathdirectory'],
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
	}
?>