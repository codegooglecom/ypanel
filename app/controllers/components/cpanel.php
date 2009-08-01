<?php



class CpanelComponent extends Object
{	
	var $name = 'Cpanel';
	//called before Controller::beforeFilter()
	function initialize(&$controller, $settings = array()) {
		// saving the controller reference for later use
		$this->controller =& $controller;
	}
	
	//called after Controller::beforeFilter()
	function startup(&$controller) {
	}

	//called after Controller::beforeRender()
	function beforeRender(&$controller) {
	}

	//called after Controller::render()
	function shutdown(&$controller) {
	}

	//called before Controller::redirect()
	function beforeRedirect(&$controller, $url, $status=null, $exit=true) {
	}

	function redirectSomewhere($value) {
		// utilizing a controller method
		$this->controller->redirect($value);
	}
	/*function __construct($username, $password, $server='127.0.0.1', $skin='x', $port=2082) {
        $this -> username = $username; // cpanel login
        $this -> password = $password;
		if(is_null($server))
        	$server = $_SERVER['SERVER_ADDR'];
        $this -> url = "http://{$server}:{$port}/frontend/{$skin}/";
    }*/
	
	function connect($settings = array()) {
		$this -> username = $settings['username']; // cpanel login
        $this -> password = $settings['password']; //cpanel password
		$port = isset($settings['port'])?$settings['port']:'2082';
		$skin = isset($settings['skin'])?$settings['skin']:'x';
        $server = isset($settings['server'])? $settings['server']: $_SERVER['SERVER_ADDR'];
		//$server = $settings['server'];
		$this -> Domain = $server;
        $this -> url = "http://{$server}:{$port}/frontend/{$skin}/";
	}
    
    private function _curl( $url = '', $post = false ) { // returns html contents of a cpanel path or exits if status is not OK
		$url=$this->url.$url;
        $ch = curl_init( );
		$useragent="Mozilla/5.0 (Windows; U; Windows NT 6.0; es-ES; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 GTB5 (.NET
 		CLR 3.5.30729) FirePHP/0.3";
        $op = array(
            CURLOPT_URL => $url,
			CURLOPT_HEADER => false,
			CURLOPT_USERAGENT => $useragent,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_TIMEOUT_MS=>10000,
			/*CURLOPT_HTTPHEADER => array(
									'Authorization:Basic c25ha2U6eWFjajI0MDU=',
									$useragent
									),*/
			//CURLOPT_REFERER => 'FALSE',
            //CURLOPT_UNRESTRICTED_AUTH => true,
			CURLOPT_USERPWD => base64_encode($this -> username . ':' . $this -> password),
			//CURLOPT_USERPWD => $this -> username . ':' . $this -> password,
			CURLOPT_HTTPAUTH=> CURLAUTH_BASIC ,
            
        );
        //curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        if( $post ) {
            $op[CURLOPT_POST] = true;
            $op[CURLOPT_POSTFIELDS] = $post;
        }
        
        curl_setopt_array( $ch, $op );
        $return = curl_exec( $ch );
        $response = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        curl_close( $ch );
        if( $response == 200 ) return $return;
        else die( "Failed to open <a href='{$url}'>{$url}</a><br/>Returned <a href='http://en.wikipedia.org/wiki/List_of_HTTP_status_codes'>{$response}</a> error");
    }
	
	private function _curlTest( $url = '', $post = false ) { // returns html contents of a cpanel path or exits if status is not OK
		$url=$this->url.$url;
        $ch = curl_init( );
        $op = array(
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_UNRESTRICTED_AUTH => true,
            CURLOPT_USERPWD => $this -> username . ':' . $this -> password
        );
        
        if( $post ) {
            $op[CURLOPT_POST] = true;
            $op[CURLOPT_POSTFIELDS] = $post;
        }
        
        curl_setopt_array( $ch, $op );
        $return = curl_exec( $ch );
        $response = curl_getinfo( $ch );
		return $response;

    }
    
    private function dom( $html ) { // returns domdocument object from html string
        $doc = new DOMDocument( );
        @$doc -> loadHTML( $html );
        @$doc -> normalizeDocument( );
        return $doc;
    }
    
    private function textify( $node ) { // returns textContent property if it exists
        if( is_object( $node ) ) return ( property_exists( $node, 'textContent' ) ) ? trim( $node -> textContent ) : false;
        else return false;
    }
	
	function connectTest($url=null){
		if(is_null($url))$url = 'yosipcuriel.com:2082';
		// Se crea un manejador CURL
		$ch = curl_init($url);
		
		// Se establece la URL y algunas opciones
		//curl_setopt($ch, CURLOPT_URL, $url);
		//curl_setopt($ch, CURLOPT_HEADER, 0);
		
		// Se obtiene la URL indicada
		$return = curl_exec( $ch );
		$response = curl_getinfo( $ch );
		// Se cierra el recurso CURL y se liberan los recursos del sistema
		curl_close($ch);
		//return $this -> _curlTest( $url );
		return $response;
	}
	
	
    /*FUNCTION FOR EMAILS ACCOUNTS
     * 
     * 
     */
    function getEmail( ) { // returns array containing disk quota and usage for each email address
        $doc = $this -> dom( $this -> _curl( 'mail/pops.html?itemsperpage=500' ) );
        $table = $doc -> getElementById( 'mailtbl' );
        foreach( $table -> getElementsByTagName( 'tr' ) as $row ) {
            if( $address = $this -> textify( $row -> getElementsByTagName( 'td' ) -> item( 0 ) ) ) {
                $email = &$return[$address];
                $email['usage'] = $this -> textify( $row -> getElementsByTagName( 'td' ) -> item( 2 ) );
                $email['quota'] = $this -> textify( $row -> getElementsByTagName( 'td' ) -> item( 3 ) );
            }
        }
        ksort( $return ); // sort by address
        return $return; // return array
    }
    function addEmail( $email, $domain, $password, $quota = 0 ) { // quick and dirty example of using post in my curl function
        $post = "email={$email}&domain={$domain}&password={$password}&quota={$quota}";
        $doc = $this -> dom( $this -> _curl( 'mail/doaddpop.html', $post ) );
        if( $details = $doc -> getElementById( 'details' ) ) return false;//echo "\n<div class='error'>{$this -> textify( $details )}</div>";
        else return true;//echo "\n<div class='success'>{$email}@{$domain} created successfully!</div>";
    }
	function delEmail($email, $domain){
		$post = "email={$email}&domain={$domain}";
		$doc = $this -> dom( $this -> _curl( 'mail/realdelpop.html', $post ) );
		if( $details = $doc -> getElementById( 'details' ) ) return false;
		else return true;
	}
	function setEmailQuota($email, $domain, $quota){
		$post="email={$email}&domain={$domain}&quota={$quota}";
		$doc = $this -> dom( $this -> _curl( 'mail/doeditquota.html', $post ) );
		if( $details = $doc -> getElementById( 'details' ) ) return false;
		else return true;
	}
	function setEmailPassword($email, $domain, $password){
		$post="email={$email}&domain={$domain}&password={$password}";
		$doc = $this -> dom( $this -> _curl( 'mail/dopasswdpop.html', $post ) );
		if( $details = $doc -> getElementById( 'details' ) ) return false;
		else return true;
	}
	/*FUNCTION FOR FTP'S ACCOUNTS
     * 
     * 
     */
	function getFTP( ) { // returns array containing disk quota and usage for each email address
        $doc = $this -> dom( $this -> _curl( 'ftp/accounts_pure-ftpd.html?itemsperpage=500' ) );
        $table = $doc -> getElementById( 'ftptbl' );
		//e($table);
        foreach( $table -> getElementsByTagName( 'tr' ) as $row ) {
            if( $address = $this -> textify( $row -> getElementsByTagName( 'td' ) -> item( 0 ) ) ) {
                $ftp = &$return[$address];
				$ftp['directory'] = $this -> textify( $row -> getElementsByTagName( 'td' ) -> item( 2 ) );
                $ftp['usage'] = $this -> textify( $row -> getElementsByTagName( 'td' ) -> item( 3 ) );
                $ftp['quota'] = $this -> textify( $row -> getElementsByTagName( 'td' ) -> item( 4 ) );
            }
        }
        ksort( $return ); // sort by address
        return $return; // return array
    }
	function addFtp($login, $domain, $password, $quota = 0, $directory) { // quick and dirty example of using post in my curl function
		$l = $login.'_'.$domain;
        $post = "login={$l}&domain={$domain}&password={$password}&password2={$password}&quota={$quota}&homedir={$directory}";
        $doc = $this -> dom( $this -> _curl( 'ftp/doaddftp.html', $post ) );
        if( $details = $doc -> getElementById( 'details' ) ) return false;//echo "\n<div class='error'>{$this -> textify( $details )}</div>";
        else return true;//echo "\n<div class='success'>{$email}@{$domain} created successfully!</div>";
    }
	function delFtp($login, $domain){
		$post = "login={$login}";
		$doc = $this -> dom( $this -> _curl( 'ftp/realdodelftp.html', $post ) );
		if( $details = $doc -> getElementById( 'details' ) ) return false;
		else return true;
	}
	function setFtpQuota($acct, $domain, $quota){
		$post="acct={$acct}&domain={$domain}&quota={$quota}";
		$doc = $this -> dom( $this -> _curl( 'ftp/doeditquota.html', $post ) );
		if( $details = $doc -> getElementById( 'details' ) ) return false;
		else return true;
	}
	function setFtpPassword($acct, $domain, $password){
		$post="acct={$acct}&domain={$domain}&password={$password}&password2={$password}";
		$doc = $this -> dom( $this -> _curl( 'ftp/dopasswdftp.html', $post ) );
		if( $details = $doc -> getElementById( 'details' ) ) return false;
		else return true;
	}
	/*FUNCTION FOR BACKUP's
     * 
     * 
     */
	function getBackups(){
		$return = null;
		//http://kaaiweb.com:2082/frontend/bluehost/backup/fullbackup.html
		$doc = $this -> dom( $this -> _curl( 'backup/fullbackup.html' ) );
        $content = $doc -> getElementById( 'content' );
		foreach ($content->childNodes as $nodos) {
			if($nodos->nodeName=='div' && $nodos->attributes->item(0)->name=='class' && $nodos->attributes->item(0)->value=='body-content'){
				foreach ($nodos->childNodes as $nodo) {
					if($nodo->nodeName=='div' && $nodo->attributes->item(0)->name=='class' && $nodo->attributes->item(0)->value=='okmsg'){
						$b = $nodo->childNodes->item(0);//<b></b>
						$a = $b->childNodes->item(0);//<a href=""></a>
						$aAttr = $a->attributes->item(0);//href=""
						$backup = &$return[$a->nodeValue];
						$backup['href'] = $this->url.substr($aAttr->value,1);
						//$backup['href'] = substr($aAttr->value,1);
						$backup['type'] = 'link';
					}
					elseif($nodo->nodeName=='div' && $nodo->attributes->item(0)->name=='class' && $nodo->attributes->item(0)->value=='warningmsg'){
						$backup = &$return[$nodo->nodeValue];
						$backup['type'] = 'text';
					}
				}
			}
		}
		return $return;
	}
	
	function addBackup($email){//dest=homedir email=ejemplo@host.com
		$post="dest=homedir&email={$email}";
		$doc = $this -> dom( $this -> _curl( 'backup/dofullbackup.html', $post ) );
		if( $details = $doc -> getElementById( 'details' ) ) return false;
		else return true;
	}
	
	function downloadBackup($url){
		$this -> _curl( $url );
	}
	
	
	
}

?>