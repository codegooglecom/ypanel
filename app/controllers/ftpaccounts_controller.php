<?php



class FtpaccountsController extends AppController
{
	var $name = 'Ftpaccounts';
	var $components = array('Cpanel');
	var $uses = array('Ftpaccount', 'Server', 'Domain');
	
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allowedActions = array('cPanelConnect', 'checkAccount');
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
	function checkAccount($DomainName){
		$emails = $sum = $result = null;
		$count = 0;
		$emails = $this->Cpanel->getEmail();
		foreach ($emails as $address => $data){
			if(strpos ($address, '@'.$DomainName)!==false){
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
		$ftps = null;
		$dm = $this->cPanelConnect($DomainId);
		if($dm!==false){
			$ftps = $this->Cpanel->getFTP();
			$ftps['Domain']=$dm['Domain']['name']; 
		}
		$this->set('Ftps', $ftps);
	}
	function add($DomainId=null){
		$DoId = !is_null($DomainId)? $DomainId : $this->data['Domain']['id'];
		$dm = $this->cPanelConnect($DoId);
		if(!empty($this->data)){
			$this->Ftpaccount->set($this->data);
			if($this->Ftpaccount->validates()){
				//echo $this->Cpanel->Domain;
				if($this->Cpanel->addFtp(	$this->data['Ftpaccount']['name'], 
											$this->data['Ftpaccount']['domain'], 
											$this->data['Ftpaccount']['password'], 
											$this->data['Ftpaccount']['quote'],
											trim($dm['Domain']['pathdirectory'].'/'.$this->data['Ftpaccount']['directory']))){
					$this->flash(__('infoInserted',true), '/ftpaccounts/index/'.$this->data['Domain']['id'], 1);
				}
				else $this->flash('Error al crear cuenta.', '/ftpaccounts/add/'.$this->data['Domain']['id'], 1);
			}
			$this->data['Ftpaccount']['pathdirectory'] = $dm['Domain']['pathdirectory'];
		}
		else{
			$this->data['Domain']['id'] = $dm['Domain']['id'];
			$this->data['Ftpaccount']['domain'] = $dm['Domain']['name'];
			$this->data['Ftpaccount']['pathdirectory'] = $dm['Domain']['pathdirectory'];
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
			$this->flash(__('infoSaved',true), "/ftpaccounts/index/{$DomainId}", 1);
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
			$this->flash(__('infoDeleted',true), "/ftpaccounts/index/{$DomainId}", 1);
		}
		else $this->flash('Error al eliminar cuenta.', "/ftpaccounts/index/{$DomainId}", 1);
		
	}
}

?>