<?php



class Backup extends AppModel
{
	var $name = 'Backup';
	var $useTable = false;
	
	
	var $validate = array (
						'email' => array(
							'notEmpty'=>array(
									'rule'=>'notEmpty',
									'message'=>'Campo requerido.',
									'last'=>true
								),
							'email'=>array(
									'rule' => array('email', true),
									'message'=>'No es una dirección valida.'
							)
						)
					);
}

?>