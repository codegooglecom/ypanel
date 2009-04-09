<?php



class EmailaccountsController extends AppController
{
	var $name = 'Emailaccounts';
	var $components = array('Cpanel');
	var $uses = array('Server', 'Domain');
	
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
	function index($DomainId = null){
		$emails = null;
		$dm = $this->cPanelConnect($DomainId);
		if($dm!==false){
			$emails = $this->Cpanel->getEmail();
			$emails['Domain']=$dm['Domain']['name']; 
		}
		$this->set('Emails', $emails);
	}
	function add($DomainId=null){
		$DoId = !is_null($DomainId)? $DomainId : $this->data['Emailaccount']['domain_id'];
		//e($DoId);
		$dm = $this->cPanelConnect($DoId);
		$this->set('Domain', $dm);
		if(!empty($this->data)){
			//$this->Emailaccount->set($this->data);
			//if($this->Emailaccount->validates()){
				//echo $this->Cpanel->Domain;
				if($this->Cpanel->addEmail(	$this->data['Emailaccount']['name'], 
											$this->data['Emailaccount']['domain'], 
											$this->data['Emailaccount']['password'], 
											$this->data['Emailaccount']['quote'])){
					$this->flash('Registro Guardado.', '/emailaccounts/index/'.$this->data['Emailaccount']['id'], 1);
				}
				else $this->flash('Error al crear cuenta.', '/emailaccounts/add/'.$this->data['Emailaccount']['id'], 1);
			//}
		}
	}
	function edit($DomainId=null, $account=null, $quote=null){
		$DoId = !is_null($DomainId)? $DomainId : $this->data['Domain']['id'];
		$dm = $this->cPanelConnect($DoId);
		$result=$result2=true;
		if(!empty($this->data)){
			if(!empty($this->data['Emailaccount']['quote']))
				$result = $this->Cpanel->setEmailQuota($this->data['Emailaccount']['name'], 
											$this->data['Emailaccount']['domain'], 
											$this->data['Emailaccount']['quote']);
			if(!empty($this->data['Emailaccount']['password']))
				$result2 = $this->Cpanel->setEmailPassword($this->data['Emailaccount']['name'], 
												$this->data['Emailaccount']['domain'], 
												$this->data['Emailaccount']['password']);
			if($result&&$result2){							
			$this->flash('Cuenta Actualizada.', "/emailaccounts/index/{$DomainId}", 1);
			}
			else $this->flash('Error al actualizar cuenta.', "/emailaccounts/index/{$DomainId}", 1);
		}
		else{
			$email = substr($account, 0, strpos($account, '@'));
			if(strpos($quote, 'MB')!==false){
				$quote = substr($quote, 0, strpos($quote, 'MB'));
			}
			elseif(strpos($quote, 'KB')!==false){
				$quote = substr($quote, 0, strpos($quote, 'KB'));
				$quote = $quote/1024;
			}
			elseif(strpos($quote, 'Bytes')!==false){
				$quote = substr($quote, 0, strpos($quote, 'KB'));
				$quote = $quote/1048576;
			}
			//$this->Emailaccount->id = 1;
			//$this->Emailaccount->read();
			$this->data['Domain']['id']=$dm['Domain']['id'];
			$this->data['Emailaccount']['domain']=$dm['Domain']['name'];
			$this->data['Emailaccount']['quote']=trim($quote);
			$this->data['Emailaccount']['name']=substr($account, 0, strpos($account, '@'));
		}
		
	}
	function delete($account=null, $DomainId=null){
		$this->cPanelConnect($DomainId);
		$email = substr($account, 0, strpos($account, '@'));
		$domain = substr($account, strpos($account, '@')+1);
		if($this->Cpanel->delEmail($email, $domain)){
			$this->flash('Cuenta Eliminada.', "/emailaccounts/index/{$DomainId}", 1);
		}
		else $this->flash('Error al crear cuenta.', "/emailaccounts/index/{$DomainId}", 1);
		
	}
	
}

?>