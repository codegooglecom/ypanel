<?php



class Emailaccount extends AppModel
{
	var $name = 'Emailaccount';
	var $useTable = false;
	
	var $validate = array (
						'name' => array(
									'rule' => 'notEmpty',
									'message'=>'El Nombre de la cuenta es obligatorio.'
							),
						'passwd' => array(
									'notEmpty'=>array(
										'rule' => 'notEmpty',
										'message'=>'La Contraseņa es obligatoria.',
										'last'=>true
									),
									'minLength'=>array(
										'rule' => array('minLength', '6'),  
										'message' => 'La Contraseņa deben tener un largo de al menos 6 caracteres.'
									)
							),
						'quote' => array(
									'rule' => 'notEmpty',
									'message'=>'La Cuota es obligatorio.'
							)
					);
	
}

?>