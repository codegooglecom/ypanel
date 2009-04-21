<?php



class Ftpaccount extends AppModel
{
	var $name = 'Ftpaccount';
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
										'message'=>'La quota se ha excedido a su limite establecido.'
									)
							)
					);
					
	function validatequote($data){
		//echo $this->data['Domain']['ftpquote']."<br />";
		//print_r($data);
        if($this->data['Domain']['ftpquote'] < $data['quote']){
        	return false;
        }
		else return true;
	}
}

?>