<?php



class EmailaccountsController extends AppController
{
	var $name = 'Emailaccounts';
	var $components = array('Cpanel');
	var $uses = array('Emailaccount','Server', 'Domain');
	
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allowedActions = array('cPanelConnect');
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
	
	function checkAccount($DomainName){
		$emails = $sum = $result = null;
		$count = 0;
		$emails = $this->Cpanel->getEmail();
		foreach ($emails as $address => $data){
			if(strpos(substr($address, 0, strpos($address, '@')), $DomainName)!==false){
			//if(strpos ($address, '@'.$DomainName)!==false){
				if(strpos($data['quota'], 'MB')!==false){
					$quote = substr($data['quota'], 0, strpos($data['quota'], 'MB'));
				}
				elseif(strpos($data['quota'], 'KB')!==false){
					$quote = substr($data['quota'], 0, strpos($data['quota'], 'KB'));
					$quote = $data['quota']/1024;
				}
				elseif(strpos($data['quota'], 'Bytes')!==false){
					$quote = substr($data['quota'], 0, strpos($data['quota'], 'KB'));
					$quote = $data['quota']/1048576;
				}
				$sum += $quote;
				$count++;
				//$e[] = $address;
			}
		}
		$result['count'] = $count;
		$result['quote'] = $sum;
		//$result['emails'] = $e;
		
		return $result;
		
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
		$DoId = !is_null($DomainId)? $DomainId : $this->data['Domain']['id'];
		//e($DoId);
		
		$dm = $this->cPanelConnect($DoId);
		$this->set('Domain', $dm);
		$AccCheck = $this->checkAccount($dm['Domain']['name']);
		$this->set('AccCheck', $AccCheck);
		if(!empty($this->data)){
			$count = 0;
			$this->Emailaccount->set($this->data); 
			if($this->Emailaccount->validates()){
				if(strpos($this->data['Emailaccount']['name'],',',0)!==false){
					$Emails = explode(",", $this->data['Emailaccount']['name']);
					if(count($Emails)>1){//SI ES UN ARREGLO DE CORREOS\
						foreach ($Emails as $e) {
							//e($AccCheck['count']+($count++).'<br />');
							//e($dm['Domain']['emailscount'].'<br />');
							if(($AccCheck['count']+($count++)) >= $dm['Domain']['emailscount']){//SI NO SOBRE PASA EL LIMITE DE CONTIDAD CORREOS
								break;
							}
							$this->Cpanel->addEmail(trim($e), 
													$this->data['Emailaccount']['domain'], 
													$this->data['Emailaccount']['passwd'], 
													$this->data['Emailaccount']['quote']);
						}
						$this->flash('Registro Guardado.', "/emailaccounts/index/{$DoId}", 1);
					}
					else{
						if($this->Cpanel->addEmail(	$this->data['Emailaccount']['name'], 
													$this->data['Emailaccount']['domain'], 
													$this->data['Emailaccount']['passwd'], 
													$this->data['Emailaccount']['quote'])){
							$this->flash('Registro Guardado.', "/emailaccounts/index/{$DoId}", 1);
						}
						else $this->flash('Error al crear cuenta.', "/emailaccounts/add/{$DoId}", 1);
					}
				}
				else{
					if($this->Cpanel->addEmail(	$this->data['Emailaccount']['name'], 
												$this->data['Emailaccount']['domain'], 
												$this->data['Emailaccount']['passwd'], 
												$this->data['Emailaccount']['quote'])){
						$this->flash('Registro Guardado.', "/emailaccounts/index/{$DoId}", 1);
					}
					else $this->flash('Error al crear cuenta.', "/emailaccounts/add/{$DoId}", 1);
				}
			}
		}
		if(empty($this->data)){
			$this->data['Emailaccount']['quote']= $dm['Domain']['emailsquote'];
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