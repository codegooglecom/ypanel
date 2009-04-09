<?php



class DomainsController extends AppController
{
	var $name = 'Domains';
	var $uses = array('Domain', 'Server', 'User');
	
	function index($id=null, $mod=null){
		$cU=parent::$this->Auth->user();
		//pr($cU);
		if($cU['User']['group_id']==2){
			$id = $cU['User']['id'];
			$mod='USU';
		}
		if($id==null){
			$cond = array();
		}
		else{
			if($mod=='SER'){
				$cond = array('Domain.server_id' => $id);
			}
			elseif($mod=='USU'){
				$cond = array('Domain.user_id' => $id);
			}
		}
		$this->set('Domains', $this->Domain->find('all', array('conditions' => $cond, 'recursive' => 1)));
	}
	function add($serverId=null){
		$this->set('Users', $this->User->find('list', array('fields' => array('User.id', 'User.username'))));
		$this->set('Servers', $this->Server->find('list'));
		if (!empty($this->data)){
			//$cU = parent::$this->Auth->user();
			//$this->data['Persona']['usuario_id'] = $cU['User']['id'];
			if ($this->Domain->save($this->data)) {
				$this->flash(__('infoInserted',true), '/domains', 1);
			}
			else
				$this->render('dml');
		}
		else {
			$this->data['Domain']['server_id']=$serverId;
			$this->render('dml');
		}
	}
	function edit($id=null){
		$this->set('Users', $this->User->find('list', array('fields' => array('User.id', 'User.username'))));
		$this->set('Servers', $this->Server->find('list'));
		$this->Domain->id = $id;
		if (empty($this->data)){
			$this->data = $this->Domain->read();
			$this->render('dml');
		} else {
			if ($this->Domain->save($this->data)) {
				$this->flash(__('infoSaved',true), '/domains', 1);
			}
			else
				$this->render('dml');
		}
	}
	function delete($id=null){
		$this->Domain->del($id);
		$this->flash(__('infoDeleted',true), '/domains',1);
	}
}

?>