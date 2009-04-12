<?php



class User extends AppModel
{
	var $name = 'User';
	var $belongsTo = array('Group');
	var $actsAs = array('Acl' => array('requester'));
	 
	function parentNode() {
	    if (!$this->id && empty($this->data)) {
	        return null;
	    }
	    $data = $this->data;
	    if (empty($this->data)) {
	        $data = $this->read();
	    }
	    if (!$data['User']['group_id']) {
	        return null;
	    } else {
	        return array('Group' => array('id' => $data['User']['group_id']));
	    }
	}
	var $validate = array (
						
						'username' => array(
									'notEmpty'=>array(
										'rule' => 'notEmpty',
										'required' => true,
										'allowEmpty' => false,
										'message'=>'Nombre usuario es obligatorio.',
										'last'=>true
									),
									'isUnique'=>array(
										'rule' => 'isUnique',
										'message' => 'Nombre de usuario ya existe, intente de nuevo.',
										'required' => true
									)
								),
						'password' => array(
								'notEmpty'=>array(
								        'rule' => 'notEmpty',
										'required' => true,
										'allowEmpty' => false,
										'message'=>'Ingrese una Contraseña.'
									),
								'minLength' => array(
										'rule' => array('minLength', '6'),  
										'message' => 'La Contraseña deben tener un largo de al menos 6 caracteres.'
									)
								
							),
						'confirmpassword' => array(
								'notEmpty'=>array(
								        'rule' => 'notEmpty',
										'required' => true,
										'allowEmpty' => false,
										'message'=>'Ingrese una Contraseña de validación.'
									),
								'minLength' => array(
										'rule' => array('minLength', '6'),  
										'message' => 'La Contraseña deben tener un largo de al menos 6 caracteres.'
									)
								
							),
						'currentpassword' => array(
								'notEmpty'=>array(
								        'rule' => 'notEmpty',
										'required' => true,
										'allowEmpty' => false,
										'message'=>'Ingrese una Contraseña de validación.'
									),
								'minLength' => array(
										'rule' => array('minLength', '6'),  
										'message' => 'La Contraseña deben tener un largo de al menos 6 caracteres.'
									)
								
							),
						'group_id' => array(
									'rule' => 'notEmpty',
									'required' => true,
									'allowEmpty' => false,
									'message'=>'El usuario debe pertenecer a un grupo.',
								)
						
					
					);
	
	
}

?>