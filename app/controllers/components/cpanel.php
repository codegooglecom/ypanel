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
		//e($url);
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
        $response = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        curl_close( $ch );
        
        if( $response == 200 ) return $return;
        else die( "Failed to open <a href='{$url}'>{$url}</a><br/>Returned <a href='http://en.wikipedia.org/wiki/List_of_HTTP_status_codes'>{$response}</a> error");
		//else die( $this->flash('Error de conexion.', $this->params['url']['url'], 1) );
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
                $email = &$return[$address];
				$email['directory'] = $this -> textify( $row -> getElementsByTagName( 'td' ) -> item( 2 ) );
                $email['usage'] = $this -> textify( $row -> getElementsByTagName( 'td' ) -> item( 3 ) );
                $email['quota'] = $this -> textify( $row -> getElementsByTagName( 'td' ) -> item( 4 ) );
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
}

?>