<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$siteName = __('Prept',true);
$siteDescription = __('Prept: your web-based study app',true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $siteDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('cake.generic','main'));
		//Google Web Fonts
		//http://www.google.com/webfonts (Avro is an alternative to Rockwell)
		echo $this->Html->css('http://fonts.googleapis.com/css?family=Arvo:700,400');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		//Google libraries
		echo $this->Html->script('https://www.google.com/jsapi');
	?>
	<script type="text/javascript">
	  google.load("search", "1");
	  google.load("jquery", "1.4.2");
	  google.load("jqueryui", "1.7.2");
	</script>
	<?php
		//Must be invoked after the jQuery libraries load
		echo $this->Html->script('jquery.utils');
		echo $this->Html->script('jquery.fittext');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<!-- Main nav -->
			<div class="main-nav">
				<div class="logo"><?php echo $this->Html->link($this->Html->image('/img/common/site-logo-99x81.jpg',array('alt' => $siteDescription,'border'=>'0')), 'http://prept.com',array('escape' => false)); ?></div>
				<ul>
				<?php
					echo "<li>".$this->Html->link('Search Studycards','#')."</li>";
					echo "<li>".$this->Html->link('Make Studycards',array('controller'=>'stacks','action'=>'make'))."</li>";
					echo "<li>".$this->Html->link('Features Tour','#')."</li>";
				?>
				</ul>
			</div>
			<?php
			$hide_user_panel = false;
			//Check to make sure the panel should show on the view
			$ignored_views = array('/users/login','/users/signup');
			foreach($ignored_views as $view){
				if($view == $this->request->here){
					$hide_user_panel = true;
				}
			}
			
			if(!$hide_user_panel):
			?>
			<div class="user-panel">
			<?php
			//Check to see if the user is logged in
			if(!empty($logged_in)):	
				echo 'Hi '.$this->Html->link($current_user['fullname'],array('controller'=>'users','action'=>'backpack','admin'=>false))."! -  ".$this->Html->link('Logout',array('admin'=>false,'controller'=>'users','action'=>'logout'));
			else:
				echo $this->Html->link('Login',array('admin'=>false,'controller'=>'users','action'=>'login'));
				echo " | ".$this->Html->link('Create Account',array('admin'=>false,'controller'=>'users','action'=>'signup'));
			endif; 
			?>
			</div>
			<?php endif; ?>
			<div class="clear"></div>
			<!-- Subnav -->
			<div class="sub-nav">
				<?php 
					//echo $this->Form->create('Search'); 
					//echo $this->Form->input('query',array('label'=>'Search'));
					//echo $this->Form->end(__('Search'));
				?>
			</div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php /*echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $siteDescription, 'border' => '0')),
					'http://www.prepty.com/',
					array('target' => '_blank', 'escape' => false)
				);*/
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
