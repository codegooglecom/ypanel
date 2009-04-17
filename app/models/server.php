<?php



class Server extends AppModel
{
	var $name = 'Server';
	
	var $validate = array (
						'name' => array(
									'rule' => 'notEmpty',
									'message'=>'El nombre es obligatorio.'
								),
						'domain' => array(
									'rule' => 'notEmpty',
									'message'=>'El Dominio es obligatorio.'
								),
						'user' => array(
									'rule' => 'notEmpty',
									'message'=>'El usuario es obligatorio.'
								),
						'pass' => array(
									'rule' => 'notEmpty',
									'message'=>'La Contraseña es obligatoria.'
								),
						'skin' => array(
									'rule' => 'notEmpty',
									'message'=>'El Skin es obligatorio.'
								),
						'port' => array(
									'rule' => 'notEmpty',
									'message'=>'El puerto es obligatorio.'
								)
					);
}

?>