<div class='span-18'>
<?
	//pr($this->params);
	//VOLVER
	e($html->tag('span',$html->link('<<', "javascript:history.back(-1);", array('class'=>'bi', 'title'=>'Volver', 'alt'=>'<<'))));
	
	//NUEVO
		$url = "/{$this->params['controller']}/add";
		foreach ($this->params['pass'] as $number_variable=>$variable) {
			//echo $number_variable;
			if(!($this->params['controller']=='emailaccounts'&&$number_variable>0))
			$url .= '/'.$variable;
		}
		e($html->tag('span',$html->link(__('new',true), $url, array('class'=>'bi', 'title'=>'Nuevo registro', 'alt'=>'Nuevo'))));

	//LISTAR
	if($this->params['action']!='index'&&isset($this->params['pass']['0'])){
		$url = "/{$this->params['controller']}/index";
		foreach ($this->params['pass'] as $number_variable=>$variable) {
			if(!($this->params['controller']=='emailaccounts'&&$number_variable>0))
				$url .= '/'.$variable;
		}
		e($html->tag('span',$html->link(__('list',true), $url, array('class'=>'bi', 'title'=>'Listar registros', 'alt'=>'Lista'))));
	}
	elseif($this->params['action']!='index'){
		e($html->tag('span',$html->link(__('list',true), "/{$this->params['controller']}", array('class'=>'bi', 'title'=>'Listar registros', 'alt'=>'Lista'))));
	}
	if($this->params['action']=='edit' && $this->params['controller']=='users'){
		e($html->tag('span',$html->link(__('changeUserId',true),'/users/chlogin/'.$this->data['User']['id'], array('class'=>'bi', 'title'=>'Cambio de Usuario Id', 'alt'=>__('changeUserId',true)))));
		e($html->tag('span',$html->link(__('changePassword',true),'/users/chpass/'.$this->data['User']['id'], array('class'=>'bi', 'title'=>'Cambio de contraseña', 'alt'=>__('changePassword',true)))));
	}
?>
</div>
<div class='span-5 align-right'><span class='title'>
<?
if($this->params['controller']=='emailaccounts'){
	__('emailAccounts');
}
if($this->params['controller']=='ftpaccounts'){
	__('ftpAccounts');
}?>
</span></div>