<?php



class ServersController extends AppController
{
	var $name = 'Servers';
	
	function index(){
		$this->set('Servers', $this->Server->find('all', array('recursive' => 1)));
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