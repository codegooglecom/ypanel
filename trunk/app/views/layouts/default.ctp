<?php
/* SVN FILE: $Id: default.ctp 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
*/
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php
		echo $html->charset();
		?>
		<title>
			<?php
			__('YPanel: Multi-Cpanel Administrator:');
			?>
			<?php
			echo $title_for_layout;
			?>
		</title>
		<!--[if IE]><link rel="stylesheet" href="blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]--><!-- Import fancy-type plugin. -->		
		<?php
		echo $html->meta('icon');
		
		//echo $html->css('cake.generic');
		//Framework CSS

		
		echo $html->css(array(
							'blueprint/screen',
							'blueprint/plugins/fancy-type/screen',
							'screen'), 
						null, 
						array('media'=>'screen,projection'));
		echo $html->css(array(
							'blueprint/plugins/buttons/screen',
							'blueprint/plugins/align/screen',
							'blueprint/plugins/tabs/screen'), null, array('media'=>'screen'));
		echo $html->css('blueprint/print',
						null, 
						array('media'=>'print'));
						
		echo $javascript->link('jquery-1.3.2.min');
		
		if($this->params['action']=='index'){
			echo $html->css('themes/blue/style', 
							null, 
							array('media'=>'print,screen,projection'));
			echo $javascript->link('jquery.tablesorter.min');
		?>
			<script type="text/javascript">
	           $(document).ready(function(){
	                $("#myTable").tablesorter({sortList:[[0,0],[2,1]], widgets: ['zebra']});
	            });
	        </script>

		<?php
			
		}
		//JS
		
		
		echo $scripts_for_layout;
		?>
	</head>
	<body>
		<div class="container">
			<div id="header" class="span-24 last">
				<div class="span-18"><h1 style="display:inline">YPanel</h1></div>
				<div class='span-5 align-right'>
					<span  style="text-align: right">
						<?=$cU['User']['username'].' ['.$html->link(__('logout',true).']', '/users/logout', array('alt'=>'Cerrar sesión', 'title'=>'Cerrar seción'));?>
					</span>
				</div>
			</div>
			<div class="span-24 last" id='tab-set'>
				<ul class='tabs'>
					<? 
					//$cU=parent::$this->Auth->user();
					if($cU['User']['group_id']==1):?>
					<li>
					 <?=$html->link(__("servers",true),'/servers/', array('id'=>'servers')); ?>
					</li>
					
					<? 
						endif;
						$url = ($cU['User']['group_id']==2)?"/users/edit/{$cU['User']['id']}":'/users/';
					?>
					<li>
					 <?=$html->link(__("users",true),$url, array('id'=>'users')); ?>
					</li>
					<li>
					 <?=$html->link(__("domains",true),'/domains/', array('id'=>'domains')); ?>
					</li>
				</ul>
				<?php
				$session->flash();
				?>
				<div class="span-24 last" id="actionBar">
					<?=$this->element('buttoninside');?>
				</div>
				<?php
				echo $content_for_layout;
				?>
				
			</div>
			<div class="span-24 last" id="footer">
				<a href="http://www.yaao.com.ve/">yaao.com.ve</a>
			</div>
			<script type="text/javascript">
				$("ul.tabs a.selected").removeClass('selected');
				$("ul.tabs #<? echo $this->params['controller']?>").addClass('selected');
			</script>
			<br>
			<?php
			echo $cakeDebug;
			?>
			</body>
		</html>
