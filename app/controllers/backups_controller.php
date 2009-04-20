<?php



class BackupsController extends AppController
{
	var $name = 'Backups';
	var $components = array('Cpanel');
	var $uses = array('Backup','Server', 'Domain');
	
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allowedActions = array('cPanelConnect', 'index');
	}
	
	function cPanelConnect($ServerId=null){
		//e('DOMINIO: '.$DomainId);
		if(!is_null($ServerId))
			$cond = array('Server.id' => $ServerId);
		else
			$cond = array();
		$Server = $this->Domain->find('first',array(
								'conditions' => $cond, 
								'recursive' => 1, 
								'fields' => array(
											'Domain.name',
											'Server.user',
											'Server.pass',
											'Server.port',
											'Server.skin')));
		if(!empty($Server)){
			$this->Cpanel->connect(array(
							'username'=>$Server['Server']['user'],
							'password'=>$Server['Server']['pass'],
							'port'=>$Server['Server']['port'],
							'skin'=>$Server['Server']['skin'],
							'server'=>$Server['Domain']['name']
			 			));
			return $Server;
		}
		else{
			return false;
		}
	}
	
	function index($ServerId=null){
		$Backups = null;
		$cPconn = $this->cPanelConnect($ServerId);
		if($cPconn!==false){
			$Backups = $this->Cpanel->getBackups();
		}
		//pr($Backups);
		$this->set('Backups', $Backups);
	}
	
}

?>