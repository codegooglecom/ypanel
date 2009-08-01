<?php



class ServersController extends AppController
{
	var $name = 'Servers';
	var $components = array('Cpanel');
	var $uses = array('Server', 'Domain');
	
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allowedActions = array('cPanelConnect', 'serverTest');
	}
	
	function index(){
		$this->set('Servers', $this->Server->find('all', array('recursive' => 1)));
	}
	
	function cPanelConnect($DomainId=null){
		//e('DOMINIO: '.$DomainId);
		if(!is_null($DomainId))
			$cond = array('Domain.id' => $DomainId);
		else
			$cond = array();
		$Domains = $this->Domain->find('first',array(
								'conditions' => $cond, 
								'recursive' => 1, 
								'fields' => array(
											'Domain.id',
											'Domain.name',
											'Domain.emailscount',
											'Domain.emailsquote',
											'Domain.ftpcount',
											'Domain.ftpquote',
											'Server.user',
											'Server.pass',
											'Server.port',
											'Server.skin')));
		if(!empty($Domains)){
			$this->Cpanel->connect(array(
							'username'=>$Domains['Server']['user'],
							'password'=>$Domains['Server']['pass'],
							'port'=>$Domains['Server']['port'],
							'skin'=>$Domains['Server']['skin'],
							'server'=>$Domains['Domain']['name']
			 			));
			return $Domains;
		}
		else{
			return false;
		}
	}
	
	function serverTest($url = null){
		$this->set('test', $this->Cpanel->connectTest($url));
		$this->render('empty', 'login');
	}
	
	function add(){
		if (!empty($this->data)){
			//$cU = parent::$this->Auth->user();
			//$this->data['Persona']['usuario_id'] = $cU['User']['id'];
			if ($this->Server->save($this->data)) {
				$this->flash('Registro Guardado.', '/servers', 1);
			}
			else
				$this->render('dml');
		}
		else {
			$this->data['Server']['port']='2082';
			$this->data['Server']['skin']='x';
			$this->render('dml');
		}
	}
	function edit($id=null){
		
		$this->Server->id = $id;
		if (empty($this->data)){
			
			$this->data = $this->Server->read();
			$this->render('dml');
		} else {
			if ($this->Server->save($this->data)) {
				$this->flash('Registro Actualizado.', '/servers', 1);
			}
			else
				$this->render('dml');
		}
	}
	
	function delete($id=null){
		$this->Server->del($id);
		$this->flash('Registro Eliminado.', '/servers',1);
	}
}

?>