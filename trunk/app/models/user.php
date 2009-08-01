<?php



class User extends AppModel
{
	var $name = 'User';
	var $belongsTo = array('Group');
	var $actsAs = array('Acl' => array('requester'));
	
	function parentNode(){
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
	function beforeSave(){
		if (isset($this->data['User']['passwd'])){
			$this->data['User']['password'] = Security::hash($this->data['User']['passwd'], null, true);  
			unset($this->data['User']['passwd']);
		}  
		if (isset($this->data['User']['passwordcheck']))
			unset($this->data['User']['passwordcheck']);
		
		return true;
	}
	var $validate = array (
						'username' => array(
									'notEmpty'=>array(
										'rule' => 'notEmpty',
										'message'=>'El usuario ID es obligatorio.',
										'last'=>true
									),
									'isUnique'=>array(
										'rule' => 'isUnique',
										'message' => 'El usuario ID ya existe, intente con otro.'
									)
								),
						'currentpassword' => array(
								'notEmpty'=>array(
										'rule' => 'notEmpty',
										'message'=>'Ingrese la Contraseña actual.',
										'last'=>true
									),
								'validateCurrentPassword'=>array(
										'rule'=>'validatePasswdCurrent',
										'message'=>'La Contraseña actual es incorrecta.',
									)
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
						'passwordcheck' => array(
								'rule'=>'validatePasswdConfirm',
								'message'=>'Las Contraseñas no son iguales.'
							),
						'telephone'=>array(
									'rule'=>'numeric',
									'required' => false,
									'allowEmpty' => true,
									'message'=>'Please only number'
								),
						'email' => array(
									'rule' => array('email', true),
									'required' => false,
									'allowEmpty' => true,
									'message' => 'Please supply a valid email address.'
								)
					);
					
	function validatePasswdConfirm($data){
		if ($this->data['User']['passwd']!==$data['passwordcheck']){
			return false;
		}
		return true;
	}
	function validatePasswdCurrent($data){
		$CurrenPassword = $this->find( 'first', array('conditions' => array ('User.id'=>$this->data['User']['id']), 'recursive' => -1, 'fields'=> array ('User.password')) );
        if(Security::hash($data['currentpassword'], null, true) != $CurrenPassword['User']['password']){
        	return false;
        }
		else return true;
	}
}

?>