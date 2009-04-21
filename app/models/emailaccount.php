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
										'message'=>'La Contraseña es obligatoria.',
										'last'=>true
							 		),
									'minLength'=>array(
										'rule' => array('minLength', '6'),  
										'message' => 'La Contraseña deben tener un largo de al menos 6 caracteres.'
									)
							),
						'quote' => array(
								'notEmpty'=>array(
										'rule' => 'notEmpty',
										'message'=>'La Cuota es obligatorio.'
									),
								'validatequote' => array(
										'rule'=>'validatequote',
										//'rule'=>array('range', 0, $this->data['Emailaccount']['emailsquote']),
										'message'=>'La quota se ha excedido a su limite establecido.'
									)
							)
					);
					
	function validatequote($data){
        if($this->data['Domain']['emailsquote'] < $data['quote'] ){
        	return false;
        }
		else return true;
	}
	
}

?>