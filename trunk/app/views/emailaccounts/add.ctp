<?php
	/**
	 *      P�gina: add.ctp
	 *      Tipo: View
	 *      Versi�n: 2009-XX-XX
	 *      Autor: snake77se
	 *      Email: snake77se@gmail.com
	 *      Descripci�n: Vista de EmailAccounts.
	 */
	$FDL = chr(10).chr(9);
	
	if($Domain['Domain']['emailscount']<=$AccCheck['count']){
		e($html->tag('div','Cantidad de Correos excedida',array('class'=>'error')).$FDL);
	}
	elseif($Domain['Domain']['emailscount']*$Domain['Domain']['emailsquote']<=$AccCheck['quote']){
		e($html->tag('div','Cuota de Correos excedida',array('class'=>'error')).$FDL);
	}
	else{
		//FORM
		echo $form->create('Emailaccount', array('name'=>'form1', 'action'=>"/add/{$this->params['pass']['0']}")). $FDL;
		e($form->input('Domain.id', array('type'=>'hidden', 'value'=>$Domain['Domain']['id'])).$FDL);
		e($form->input('Domain.emailsquote', array('type'=>'hidden', 'value'=>$Domain['Domain']['emailsquote'])).$FDL);
		
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
											$form->text('domain', array('value'=>$Domain['Domain']['name'], 'readonly'=>'true')).$FDL,
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
											$form->input('name', array('label'=>false, 'rows'=>2)).$FDL.
											$html->tag('div',__('addEmailUserMsg',true),
											array('class'=>'quiet')),
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
											$form->label('Cuota:').$FDL,
											array('width'=>'160', 'class'=>'align-right')
										),
										array(
											$form->input('quote', array('label'=>false)).$FDL,
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