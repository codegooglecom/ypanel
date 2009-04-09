<?php



class Domain extends AppModel
{
	var $name = 'Domain';
	var $belongsTo = array('Server', 'User');
}

?>