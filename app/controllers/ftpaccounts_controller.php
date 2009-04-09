<?php



class FtpaccountsController extends AppController
{
	var $name = 'Ftpaccounts';
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
											'Domain.pathdirectory',
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
			$ftp = $this->Cpanel->getFTP();
			$ftp['Domain']=$dm['Domain']['name']; 
		}
		$this->set('Ftps', $ftp);
	}
	function add($DomainId=null){
		$DoId = !is_null($DomainId)? $DomainId : $this->data['Domain']['id'];
		$dm = $this->cPanelConnect($DoId);
		if(!empty($this->data)){
			//$this->Ftpaccount->set($this->data);
			//if($this->Ftpaccount->validates()){
				//echo $this->Cpanel->Domain;
				if($this->Cpanel->addFtp(	$this->data['Ftpaccount']['name'], 
											$this->data['Ftpaccount']['domain'], 
											$this->data['Ftpaccount']['password'], 
											$this->data['Ftpaccount']['quote'],
											$this->data['Ftpaccount']['directory'])){
					$this->flash('Registro Guardado.', '/ftpaccounts/index/'.$this->data['Domain']['id'], 1);
				}
				else $this->flash('Error al crear cuenta.', '/ftpaccounts/add/'.$this->data['Domain']['id'], 1);
			//}
		}
		else{
			$this->data['Domain']['id'] = $dm['Domain']['id'];
			$this->data['Ftpaccount']['domain'] = $dm['Domain']['name'];
			$this->data['Ftpaccount']['directory'] = $dm['Domain']['pathdirectory'];
		}
	}
	function edit($DomainId=null, $account=null, $quote=null){
		$DoId = !is_null($DomainId)? $DomainId : $this->data['Domain']['id'];
		$dm = $this->cPanelConnect($DoId);
		$result=$result2=true;
		if(!empty($this->data)){
			if(!empty($this->data['Ftpaccount']['quote']))
				$result = $this->Cpanel->setFtpQuota($this->data['Ftpaccount']['login'], 
											$this->data['Ftpaccount']['domain'], 
											$this->data['Ftpaccount']['quote']);
			if(!empty($this->data['Ftpaccount']['password']))
				$result2 = $this->Cpanel->setFtpPassword($this->data['Ftpaccount']['login'], 
												$this->data['Ftpaccount']['domain'], 
												$this->data['Ftpaccount']['password']);
			if($result&&$result2){							
			$this->flash('Cuenta Actualizada.', "/ftpaccounts/index/{$DomainId}", 1);
			}
			else $this->flash('Error al actualizar cuenta.', "/ftpaccounts/index/{$DomainId}", 1);
		}
		else{
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
			$this->data['Domain']['id']=$dm['Domain']['id'];
			$this->data['Ftpaccount']['domain']=$dm['Domain']['name'];
			$this->data['Ftpaccount']['quote']=trim($quote);
			$this->data['Ftpaccount']['login']=substr($account, 0, strpos($account, '@'));
			$this->data['Ftpaccount']['name']=substr($account, 0, strpos($account, '_'));
		}
		
	}
	function delete($account=null, $DomainId=null){
		$this->cPanelConnect($DomainId);
		$email = substr($account, 0, strpos($account, '@'));
		$domain = substr($account, strpos($account, '@')+1);
		if($this->Cpanel->delFtp($email, $domain)){
			$this->flash('Cuenta Eliminada.', "/ftpaccounts/index/{$DomainId}", 1);
		}
		else $this->flash('Error al crear cuenta.', "/ftpaccounts/index/{$DomainId}", 1);
		
	}
}

?>