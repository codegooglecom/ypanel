<?php



class Domain extends AppModel
{
	var $name = 'Domain';
	var $belongsTo = array('Server', 'User');
	
	function beforeSave(){
		$this->data['Domain']['pathdirectory']= trim($this->data['Domain']['pathdirectory']);
		return true;
	}
	
	var $validate = array (
						'name' => array(
									'rule' => 'notEmpty',
									'message' => 'El Nombre es obligatorio.'
								),
						'pathdirectory' => array(
									'rule' => 'notEmpty',
									'message'=>'El Dominio es obligatorio.'
								),
						'server_id'=>array(
									'rule' => 'notEmpty',
									'message'=>'Seleccione un Servidor.'
								),
						'user_id'=>array(
									'rule' => 'notEmpty',
									'message'=>'Seleccione un Usuario.'
								),
						'emailscount'=>array(
								'notEmpty'=>array(
									'rule' => 'notEmpty',
									'message'=>'La cantidad maxima es obligatorio.',
									'last'=>true
									),
								'numeric'=>array(
										'rule' => 'numeric',  
										'message' => 'Solo se acepta caracteres numericos.'
									)
								),
						'emailsquote'=>array(
								'notEmpty'=>array(
									'rule' => 'notEmpty',
									'message'=>'La cantidad maxima es obligatorio.',
									'last'=>true
									),
								'numeric'=>array(
										'rule' => 'numeric',  
										'message' => 'Solo se acepta caracteres numericos.'
									)
								),
						'emailscount'=>array(
								'notEmpty'=>array(
									'rule' => 'notEmpty',
									'message'=>'La cantidad maxima es obligatorio.',
									'last'=>true
									
									),
								'numeric'=>array(
										'rule' => 'numeric',  
										'message' => 'Solo se acepta caracteres numericos.'
									)
									
								),
						'ftpquote'=>array(
								'notEmpty'=>array(
									'rule' => 'notEmpty',
									'message'=>'La cantidad maxima es obligatorio.',
									'last'=>true
									),
								'numeric'=>array(
										'rule' => 'numeric',  
										'message' => 'Solo se acepta caracteres numericos.'
									)
								)
					);
}

?>