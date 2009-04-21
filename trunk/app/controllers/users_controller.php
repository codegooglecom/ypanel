<?php

/**
 *      Página: usurio_controller.php
 *      Tipo: Controller
 *      Versión: 2009-XX-XX
 *      Autor: snake77se
 *      Email: snake77se@gmail.com
 *      Descripción: Controlador de usuario.
 */

class UsersController extends AppController
{
	var $name = 'Users';
	var $uses = array ('Group', 'User');

	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allowedActions = array('login','logout', 'groupList', 'buildAcl', 'actionAcl');
	}

	function login()
	{
		$this->layout ='login';
	}

	function logout()
	{
		$this->Session->setFlash(__('bye',true));
		$this->redirect($this->Auth->logout());
	}



	function groupList()
	{
		$cU =parent::$this->Auth->user();
		if ( isset ($cU['User']['group_id']))
		{
			if ($cU['User']['group_id'] != 1)
				$cond = array ('Group.id > '=>1);
			else
				$cond = array ();
		}
		else
			$cond = array ();

		$this->set('Group', $this->Group->find('list', array (
									'conditions'=>$cond, //array of conditions
									'recursive'=>-1, //int
									'fields'=> array ('Group.id', 'Group.name'), //array of field names
									'order'=> array ('Group.name ASC')
									)
								)
							);
	}

	function index()
	{
		$this->set('Users', $this->User->find('all', array ('recursive'=>1)));
	}

	function add(){
		if (!empty($this->data)){
			$cU = parent::$this->Auth->user();
			$this->data['User']['user_id']= $cU['User']['id'];
			if ($this->User->save($this->data))
			{
				$this->flash(__('infoInserted',true), '/users', 1);
			}
			else{
				unset($this->data['User']['passwd']);
				unset($this->data['User']['passwordcheck']);
				$this->groupList();
			}
		}
		else
		{
			unset($this->data['User']['passwd']);
			unset($this->data['User']['passwordcheck']);
			$this->groupList();
		}
	}
	function edit($id = null){
		if(!empty($this->data)){
			$cU = parent::$this->Auth->user();
			$this->data['User']['user_id']= $cU['User']['id'];
			if ($this->User->save($this->data)){
				$this->flash(__('infoSaved',true), '/users', 1);
			}
			else
				$this->groupList();
			
		}
		else{
			$this->groupList();
			$this->User->id = $id;
			$this->data = $this->User->read();
		}
	}

	function delete($id)
	{	
		$this->User->del($id);
		$this->flash(__('infoDeleted',true), '/users', 1);
	}

	function chlogin($id = null)
	{
		if (!empty($this->data)){
			$cU = parent::$this->Auth->user();
			$this->data['User']['user_id']= $cU['User']['id'];
			if($this->User->save($this->data)){
				$this->flash(__('infoSaved',true), '/users', 1);
			}
			//else e('NO GUARDO!!!');
			
		}
		else{
			//print_r(parent::$this->Auth->user());
			$this->User->id = $id;
			$this->data = $this->User->read();
		}
	}

	function chpass($id = null){
		if (!empty($this->data)){
			$cU = parent::$this->Auth->user();
			$this->data['User']['user_id']= $cU['User']['id'];
			if($this->User->save($this->data)){
				$this->flash(__('infoSaved',true), '/users', 1);
			}
			else{
				unset($this->data['User']['passwd']);
				unset($this->data['User']['passwordcheck']);
				unset($this->data['User']['currentpassword']);
			}
		}
		else{
			$this->User->id = $id;
			$this->data = $this->User->read();
		}
	}
	
	
	
	
	
	//var $components = array('Acl');
	function actionAcl()
	{
		$aro = new Aro();
		$aco = new Aco();
		/*$groups = array (
							0=> array (	'alias'=>'SuperAdministrador', 
										'parent_id'=>null, 
										'model'=>'Group', 
										'foreign_key'=>'1'),
							1=> array (	'alias'=>'Administradores', 
										'parent_id'=>null, 
										'model'=>'Group', 
										'foreign_key'=>'2')
					);
	
		foreach ($groups as $data)
		{
			$aro->create();
			$aro->save($data);
		}
	
		$users = array (
						0=> array (
							'alias'=>'admin1',
							'parent_id'=>1,
							'model'=>'User',
							'foreign_key'=>'1'
							),
						1=> array (
							'alias'=>'a1',
							'parent_id'=>2,
							'model'=>'User',
							'foreign_key'=>'2'
							)
				);
		//Iterar y crear los AROs (como hijos)
		foreach ($users as $data)
		{
			///Recuerda llamar a create() cuando estés guardando información dentro de bucles...
			$aro->create();
			//Guardar datos
			$aro->save($data);
		}*/
	
		$groups = array(
		 0=>array('alias'=>'add', 'parent_id'=>'39'),
		 1=>array('alias'=>'index', 'parent_id'=>'39'),
		 2=>array('alias'=>'cPanelConnect', 'parent_id'=>'39'),
		 3=>array('alias'=>'downloadBackup', 'parent_id'=>'39')
		 );
		 
		 foreach($groups as $data){
		 $aco->create();
		 $aco->save($data);
		 }
		 /*
		 $this->Acl->allow('SuperAdministrador', 'controllers');
		 
		 $this->Acl->deny('Administradores', 'controllers');
		 $this->Acl->allow('Administradores', 'controllers/Domains');
		 $this->Acl->allow('Administradores', 'controllers/Emailaccounts');
		 $this->Acl->allow('Administradores', 'controllers/Ftpaccounts');*/
		 
	}



	function buildAcl()
	{
		$log = array ();
		$aco = & $this->Acl->Aco;
		$root = $aco->node('controllers');
		if (!$root)
		{
			$aco->create( array ('parent_id'=>null, 'model'=>null, 'alias'=>'controllers'));
			$root = $aco->save();
			$root['Aco']['id'] = $aco->id;
			$log[] = 'Creado el nodo Aco para los controladores';
		}
		else
		{
			$root = $root[0];
		}
		App::import('Core', 'File');
		$Controllers = Configure::listObjects('controller');
		$appIndex = array_search('App', $Controllers);
		if ($appIndex !== false)
		{
			unset ($Controllers[$appIndex]);
		}
		$baseMethods = get_class_methods('Controller');
		$baseMethods[] = 'buildAcl';
		
		// miramos en cada controlador en app/controllers
		foreach ($Controllers as $ctrlName)
		{
			App::import('Controller', $ctrlName);
			$ctrlclass = $ctrlName.'Controller';
			$methods = get_class_methods($ctrlclass);
			
			//buscar / crear nodo de controlador
			$controllerNode = $aco->node('controllers/'.$ctrlName);
			if (!$controllerNode)
			{
				$aco->create( array ('parent_id'=>$root['Aco']['id'], 'model'=>null, 'alias'=>$ctrlName));
				$controllerNode = $aco->save();
				$controllerNode['Aco']['id'] = $aco->id;
				$log[] = 'Creado el nodo Aco del controlador '.$ctrlName;
			}
			else
			{
				$controllerNode = $controllerNode[0];
			}
		
			//Limpieza de los metodos, para eliminar aquellos en el controlador
			//y en las acciones privadas
			foreach ($methods as $k=>$method)
			{
				if (strpos($method, '_', 0) === 0)
				{
					unset ($methods[$k]);
					continue ;
				}
				if (in_array($method, $baseMethods))
				{
					unset ($methods[$k]);
					continue ;
				}
				$methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);
				if (!$methodNode)
				{
					$aco->create( array ('parent_id'=>$controllerNode['Aco']['id'], 'model'=>null, 'alias'=>$method));
					$methodNode = $aco->save();
					$log[] = 'Creado el nodo Aco para '.$method;
				}
			}
		}
		debug($log);
	}
}
?>